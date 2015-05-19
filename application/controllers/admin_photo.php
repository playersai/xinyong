<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_photo extends CI_Controller
{

	public function index($id = 0, $queryStr = NULL,$per_pages = null)
	{
		check_purview("admin_photo-" . $id);
		check_adminstatus(100);
		
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
			
			$this->load->model('admin_photom', 'apm');
			$article_nums = $this->apm->get_photos_nums($id,$a_title,$a_date,$a_user,$a_status);
		}
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'admin_photo/index/' . $id . '/';
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
		
		$arows = $this->apm->get_photos($id, $limitarr,$a_title,$a_date,$a_user,$a_status);
		$data['crows'] = $crows;
		$data['arows'] = $arows;
        $data['id'] = $id;
		$data['per_pages'] = $per_pages;
		$data['a_title'] = $a_title;
		$data['a_date'] = $a_date2;
		$data['a_user'] = $a_user;
		$data['a_status'] = $a_status;
		// print_r($data);die;
		$this->load->view('admin/admin_photo_index', $data);
	}

	public function add($id = null)
	{
		check_adminstatus(100);
		
		if (isset($id) and $id !== NULL) {
			$cat_id = intval($id);
			$this->load->model('admincategorym', 'amc');
			
			$cats = $this->amc->get_cat_by_level(array(1,2,3));
			
			if (is_array($cats) and isset($cats[1][0])) {
				$data['cats']['parent'] = $cats[1][0];
				$data['cats']['son'] = isset($cats[2]) ? $cats[2] : "";
				$data['cats']['sonson'] = isset($cats[3]) ? $cats[3] : array();
			}
			$data['selected_catid'] = $cat_id;
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$data['user_group'] = $_SESSION['group_id'];
		
		$this->load->view('admin/admin_photo_add', $data);
	}

	public function add_handle()
	{
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		if(is_int(intval($data['cat_id']))==false||is_int(intval($data['stats']))==false||is_int(intval($data['status']))==false||is_int(intval($data['settop']))==false||is_int(intval($data['index_top']))==false||is_int(intval($data['is_redirect']))==false){
		    action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
		}
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		$data['rel_date'] = strtotime($data['rel_date']);
		$data['status'] = empty($data['status']) ? 0 : $data['status'];
		$data['settop'] = isset($data['settop']) ? $data['settop'] : 0;
		$data['index_top'] = isset($data['index_top']) ? $data['index_top'] : 0;
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		
		$photos = array('cat_id' => $data['cat_id'],'title' => $data['title'],'rel_date' => $data['rel_date'],'first_thumb' => $data['thumb'],'content' => $data['content'],'add_user' => $data['add_user'],'addtime' => $data['addtime'],'status' => $data['status'],'settop' => $data['settop'],'index_top' => $data['index_top']);
		
		$this->load->model('admin_photom', 'apm');
		$photo_id = $this->apm->do_add_handle($photos);
		
		if ($photo_id) {
			for ($i = 1; $i < 16; $i ++) {
				$tkey = 'thumbs' . $i;
				if (! empty($data[$tkey])) {
					$tarr[] = array($i);
					$sort = isset($data['sort'][$i]) ? intval($data['sort'][$i]) : 0;
					$f_link = isset($pdata['f_link'][$i]) ? htmlspecialchars($pdata['f_link'][$i]) : "";
					$t_content = isset($data['t_content'][$i]) ? $data['t_content'][$i] : null;
					$thumbs_arr = array('photo_id' => $photo_id,'thumb_path' => $data[$tkey],'sort' => $sort,'content' => $t_content,'f_link'=>$f_link);
					$this->apm->do_add_thumbs_handle($thumbs_arr);
				}
			}
			$nums = array('photo_nums' => count($tarr));
			$this->apm->do_update_photos_nums($nums, array('photo_id' => $photo_id));
			
			action_message("/index.php/admin_photo/index/" . $data['cat_id'], 3, '添加成功', 1);
		} else {
			action_message("/index.php/admin_photo/index/" . $data['cat_id'], 3, '添加失败', 0);
		}
	}

	public function edit($aid, $cat_id)
	{
		/* 编辑图片视图输出 */
		check_adminstatus(100);
		if (isset($cat_id) and $cat_id !== NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
		}
		// $parent=$this->amc->get_category_by_cat_type_id(3);
		
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		$this->load->model('admin_photom', 'apm');
		$rows = $this->apm->get_photos_by_photoid($aid);
		$data['rows'] = $rows[0];
		$data['selected_catid'] = $cat_id;
		$cats = $this->amc->get_cat_by_level(array(1,2,3));
		
		if (is_array($cats) and isset($cats[1][0])) {
			$data['cats']['parent'] = $cats[1][0];
			
			$data['cats']['son'] = isset($cats[2]) ? $cats[2] : "";
			$data['cats']['sonson'] = isset($cats[3]) ? $cats[3] : array();
		}
		$data['thumbs'] = $this->apm->get_thumb_by_photoid($aid);
		$data['user_group'] = $_SESSION['group_id'];
		
		$this->load->view('admin/admin_photo_edit', $data);
	}

	public function add_thumbs($aid, $cat_id)
	{
		// 添加更多图片视图输出
		check_adminstatus(100);
		
		$this->load->model('admin_photom', 'apm');
		if (isset($_POST['submit'])) {
			$pdata = $this->input->post(NULL, TRUE);
			
			if ($aid) {
				for ($i = 1; $i < 16; $i ++) {
					$tkey = 'thumbs' . $i;
					if (! empty($pdata[$tkey])) {
						$tarr[] = array($i);
						$sort = isset($pdata['sort'][$i]) ? intval($pdata['sort'][$i]) : 0;
						$f_link = isset($pdata['f_link'][$i]) ? htmlspecialchars($pdata['f_link'][$i]) : "";
						$t_content = isset($pdata['t_content'][$i]) ? $pdata['t_content'][$i] : null;
						$thumbs_arr = array('photo_id' => $aid,'thumb_path' => $pdata[$tkey],'sort' => $sort,'content' => $t_content,'f_link'=>$f_link);
						$this->apm->do_add_thumbs_handle($thumbs_arr);
						$this->apm->do_update_photos_nums_set(1, array('photo_id' => $aid));
					}
				}
			}
		}
		
		if (isset($cat_id) and $cat_id !== NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$parent = $this->amc->get_category_by_cat_type_id(3);
		
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		
		$this->load->model('admin_photom', 'apm');
		$rows = $this->apm->get_photos_by_photoid($aid);
		$data['rows'] = $rows[0];
		$data['selected_catid'] = $cat_id;
		$data['cats'] = $parent;
		$data['thumbs'] = $this->apm->get_thumb_by_photoid($aid);
		$data['user_group'] = $_SESSION['group_id'];
		
		$this->load->view('admin/admin_thumb_add', $data);
	}

	public function edit_handle($vote_id, $cat_id, $status)
	{
		/* 编辑图片处理 */
		check_adminstatus(100);
		
		$this->load->model('admin_photom', 'apm');
		$this->load->model("admin_articlem", 'aam');
		if (! isset($vote_id)) {
			action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		}
		
		if ($cat_id != $_POST['cat_id']) {
			// 当新传入的分类不等于原分类ID 执行更新分类统计
			$this->aam->do_update_category_nums(array('cat_id' => $cat_id), 0);
			$this->aam->do_update_category_nums(array('cat_id' => intval($_POST['cat_id'])), 1);
			if ($status == '0' and $status == $this->input->post('status')) {
				$this->aam->do_update_category_daishennums(array('cat_id' => $cat_id), 0);
				$this->aam->do_update_category_daishennums(array('cat_id' => intval($_POST['cat_id'])), 1);
			}
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
		$data['settop'] = isset($data['settop']) ? '1' : '0';
		$data['index_top'] = isset($data['index_top']) ? '1' : '0';
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		
		$photos = array('cat_id' => $data['cat_id'],'title' => $data['title'],'rel_date' => $data['rel_date'],'first_thumb' => $data['thumb'],'content' => $data['content'],'status' => $data['status'],'settop' => $data['settop'],'index_top' => $data['index_top'],'stats' => $data['stats'],'sorter' => $data['sorter']);
		
		for ($i = 1; $i < 16; $i ++) {
			$tkey = 'thumbs' . $i;
			if (! empty($data[$tkey])) {
				$sort = isset($data['sort'][$i]) ? intval($data['sort'][$i]) : 0;
				$f_link = isset($data['f_link'][$i]) ? htmlspecialchars($data['f_link'][$i]) : "";
				$t_content = isset($data['t_content'][$i]) ? $data['t_content'][$i] : null;
				$thumbs_arr = array('photo_id' => $vote_id,'thumb_path' => $data[$tkey],'sort' => $sort,'content' => $t_content,'f_link'=>$f_link);
				$this->apm->do_add_thumbs_handle($thumbs_arr);
				$this->apm->do_update_photos_nums_set(1, array('photo_id' => $vote_id));
			}
		}
		
		$result = $this->apm->do_edit_handle($photos, array('photo_id' => $vote_id));
		
		if ($result) {
			action_message("/index.php/admin_photo/" . $cat_id . '/1', 3, '编辑成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function delete_thumb($thumb_id, $photo_id)
	{
		check_adminstatus(100);
		$this->load->model('admin_photom', 'apm');
		if (! empty($thumb_id) and ! empty($photo_id)) {
			$this->apm->do_update_photos_nums_set(0, array('photo_id' => $photo_id));
			$result = $this->apm->do_delete_thumb(array('thumb_id' => $thumb_id));
			if ($result) {
				action_message("javascript:history.back(-1);", 3, '删除成功', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}

	public function edit_thumb($thumb_id)
	{
		/* 编辑图片信息 */
		check_adminstatus(100);
		$this->load->model('admin_photom', 'apm');
		if (isset($_POST['submit'])) {
			$pdata = $this->input->post(NULL, TRUE);
			
			$_where = array('thumb_id' => $pdata['thumb_id']);
			
			unset($pdata['thumb_id']);
			unset($pdata['submit']);
			$this->apm->do_update_thumb($_where, $pdata);
			action_message("javascript:history.back(-1);", 3, '操作成功', 1);
		}
		
		$trows = $this->apm->get_thumb_by_thumbid($thumb_id);
		$data['rows'] = $trows[0];
		$this->load->view('admin/admin_thumb_edit', $data);
	}

	public function delete($pid = NULL)
	{
		check_adminstatus(100);
		$this->load->model('admin_photom', 'apm');
		
		$result = $this->apm->do_delete_handle($pid);
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "删除成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
		public function delete_arr($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('photo_id',$id,'ch_photos');
		
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
		$result = $this->aam->do_update_arr('photo_id',$id,'ch_photos',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
}

/* Location: ./application/controllers/admin_vote.php */