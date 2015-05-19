<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_topic extends CI_Controller
{

	public function index($id = 0, $queryStr = NULL,$per_pages = null)
	{
		check_purview('admin_topic-' . $id);
		check_adminstatus(100);
		// echo $perpage;
       if ($queryStr == null) {
			$queryStr = 'QEA=';
		}
		$this->load->library('pagination');
		$this->load->helper('myurl');
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
	    $a_title = $queryArr[0];  
		$a_date2=$queryArr[1];
		$a_date = strtotime($queryArr[1]);
		$a_user = $queryArr[2];
		$a_status = $queryArr[3];
		if ($id !== '0') {
			$this->load->model("admincategorym", 'amc');
			$crows = $this->amc->get_category($id);
			$this->load->model('admin_topicm', 'aam');
			
			$article_nums = $this->aam->get_article_nums($id,$a_title,$a_date,$a_user,$a_status);
		}
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'admin_topic/index/' . $id . '/';
		$config['total_rows'] = $article_nums;
	    $config['uri_segment'] = 5;//页码参数在第几个变量
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['per_page'] = $configs['article'];
		$config['prev_link'] = '上一页';
		$config['next_link'] = "下一页";
		$config['last_link'] = '尾页';
		$config['first_link'] = '首页';
		$this->pagination->initialize($config);
		$pagenums = ceil($article_nums / $configs['article']);
		$_page = $get_pages < $configs['article'] ? 0 : $get_pages;
		$data['pages'] = $this->pagination->create_links();
		$data['page_info'] = array('nums' => $article_nums,'page_nums' => $pagenums,'now_page' => $_page / $configs['link'] + 1);
		$data['config']['base_url'] = $this->config->item("base_url");
		
		$limit0 = $_page;
		$limitarr = array($limit0,$config['per_page']);
		
		$arows = $this->aam->get_topic($id, $limitarr,$a_title,$a_date,$a_user,$a_status);
		
		// print_r($arows);die;
		$data['crows'] = $crows;
		$data['arows'] = $arows;
		$data['id'] = $id;
		$data['per_pages'] = $per_pages;
		$data['a_title'] = $a_title;
		$data['a_date'] = $a_date2;
		$data['a_user'] = $a_user;
		$data['a_status'] = $a_status;
		
		$this->load->view('admin/admin_topic_index', $data);
	}

	public function add($id = null)
	{
		check_adminstatus(100);
		if (isset($id) and $id !== NULL) {
			$cat_id = intval($id);
			$this->load->model('admincategorym', 'amc');
			$parent = $this->amc->get_category_by_cat_type_id(7);
			$data['cats'] = $parent;
			$data['selected_catid'] = $cat_id;
			
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$data['user_group'] = $_SESSION['group_id'];
		
		$this->load->view('admin/admin_topic_add', $data);
	}

	public function add_handle()
	{
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		$data['rel_date'] = strtotime($data['rel_date']);
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		
		$this->load->model('admin_topicm', 'aam');
		$result = $this->aam->do_add_handle($data);
		if ($result) {
			action_message("/index.php/admin_topic/index/" . $data['cat_id'], 3, '添加成功', 1);
		} else {
			action_message("/index.php/admin_topic/index/", 3, '添加失败', 0);
		}
	}

	public function add_thumb($aid, $cat_id)
	{
		/* 给文章加图集提交页面 */
		$this->load->model('admin_topicm', 'aam');
		$data['ainfo'] = $this->aam->get_article_by_aid($aid);
		$this->load->view('admin/admin_topic_thumb_add', $data);
	}

	public function add_thumb_handle($aid, $cat_id)
	{
		/* 给文章加图集提交处理 */
		$data = $this->input->post(NULL, TRUE);
		$this->load->model('admin_topicm', 'aam');
		for ($i = 1; $i < 16; $i ++) {
			$tkey = 'thumbs' . $i;
			if (! empty($data[$tkey])) {
				$tarr[] = array($i);
				$sort = isset($data['sort'][$i]) ? intval($data['sort'][$i]) : 0;
				$t_content = isset($data['t_content'][$i]) ? $data['t_content'][$i] : null;
				$thumbs_arr = array('aid' => $aid,'thumb_path' => $data[$tkey],'sort' => $sort,'content' => $t_content,'cat_id' => $cat_id);
				$result = $this->aam->do_add_thumb_handle($thumbs_arr);
			}
		}
		if ($result) {
			action_message("/index.php/admin_topic/" . $cat_id, 3, '添加成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function edit($aid, $cat_id)
	{
		check_adminstatus(100);
		if (isset($cat_id) and $cat_id !== NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$parent = $this->amc->get_category_by_cat_type_id(7);
		// print_r($parent);die;
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_article/", 3, '传入参数错误', 0);
		$this->load->model('admin_topicm', 'aam');
		$rows = $this->aam->get_article_by_aid($aid);
		$data['rows'] = $rows[0];
		$data['cats'] = $parent;
		$data['user_group'] = $_SESSION['group_id'];
		$this->load->view('admin/admin_topic_edit', $data);
	}

	public function edit_handle($aid, $cat_id, $status)
	{
		check_adminstatus(100);
		$this->load->model("admin_topicm", 'aam');
		if (! isset($aid)) {
			action_message("/index.php/admin_article/", 3, '传入参数错误', 0);
		}
		if ($cat_id != $_POST['cat_id']) {
			/* 当新传入的分类不等于原分类ID 执行更新分类统计 */
			$this->aam->do_update_category_nums(array('cat_id' => $cat_id), 0);
			$this->aam->do_update_category_nums(array('cat_id' => intval($_POST['cat_id'])), 1);
		}
		if ($status != $this->input->post('status')) {
			switch ($status) {
				case 0:
					$this->aam->do_update_category_daishennums(array('cat_id' => $cat_id), 0);
					break;
				case 1:
					$this->aam->do_update_category_daishennums(array('cat_id' => intval($_POST['cat_id'])), 1);
					break;
			}
		}
		$data = $this->input->post(NULL, TRUE);
		$data['rel_date'] = strtotime($data['rel_date']);
		$data['is_redirect'] = isset($data['is_redirect']) ? '1' : '0';
		$data['settop'] = isset($data['settop']) ? '1' : '0';
		$data['index_top'] = isset($data['index_top']) ? '1' : '0';
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		
		$result = $this->aam->do_edit_handle($data, $aid);
		
		if ($result) {
			action_message("/index.php/admin_topic/" . $cat_id, 3, '编辑成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function delete($id = NULL)
	{
		check_adminstatus(100);
		
		$this->load->model('admin_topicm', 'atm');
		$result = $this->atm->do_delete($id);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, '成功删除', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
	public function delete_arr($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('aid',$id,'ch_topics');
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "删除成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
	
		public function status_arr($id = NULL,$status)
	{ 
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_update_arr('aid',$id,'ch_topics',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
}

/* Location: ./application/controllers/admin_category.php */