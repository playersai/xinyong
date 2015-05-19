<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ads extends CI_Controller
{

	public function index($id = 0, $per_pages = null)
	{
		check_adminstatus(100);
		
		if ($id !== '0') {
			
			$this->load->model("admincategorym", 'amc');
			$crows = $this->amc->get_category($id);
			
			$this->load->model('admin_adsm', 'adsm');
			$article_nums = $this->adsm->get_ads_nums($id);
		}
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'admin_ads/' . $id . '/';
		$config['total_rows'] = $article_nums;
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['per_page'] = $configs['article'];
		$this->pagination->initialize($config);
		$pagenums = ceil($article_nums / $configs['article']);
		$_page = $get_pages < $configs['article'] ? 0 : $get_pages;
		$data['pages'] = $this->pagination->create_links();
		$data['page_info'] = array('nums' => $article_nums,'page_nums' => $pagenums,'now_page' => $_page / $configs['link'] + 1);
		$data['config']['base_url'] = $this->config->item("base_url");
		
		$limit0 = $_page;
		$limitarr = array($limit0,$config['per_page']);
		
		$arows = $this->adsm->get_ads($id, $limitarr);
		$data['crows'] = $crows;
		$data['arows'] = $arows;
		
		// print_r($data);die;
		$this->load->view('admin/admin_ads_index', $data);
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
		
		// print_r($data);
		$this->load->view('admin/admin_ads_add', $data);
	}

	public function add_handle()
	{
		check_adminstatus(100);
		
		$data = $this->input->post(NULL, TRUE); 
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		 
		if(is_int(intval($data['cat_id']))==false||is_int(intval($data['sort']))==false||is_int(intval($data['status']))==false){
		    action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
		}
		$status = empty($data['status']) ? 0 : $data['status'];
		//var_dump($data);exit;
		unset($data['sv']);
		
		// print_r($data); exit;
		$this->load->model('admin_adsm', 'adsm');
		$ist = $this->adsm->do_add_handle($data);
		
		if ($ist) {
			$this->load->model('admincategorym', 'acm');
			$this->acm->do_update_category_nums($data['cat_id'], $status, 1);
			action_message("/index.php/admin_ads/index/" . $data['cat_id'], 5, '添加成功', 1);
		} else {
			action_message("/index.php/admin_ads/index/" . $data['cat_id'], 4, '添加失败', 0);
		}
	}

	public function edit($aid, $cat_id)
	{
		/* 编辑视图输出 */
		check_adminstatus(100);
		
		if (isset($cat_id) and $cat_id !== NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2,3));
		if (is_array($cats) and isset($cats[1][0])) {
			$data['cats']['parent'] = $cats[1][0];
			$data['cats']['son'] = isset($cats[2]) ? $cats[2] : "";
			$data['cats']['sonson'] = isset($cats[3]) ? $cats[3] : array();
		}
		$data['selected_catid'] = $cat_id;
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_ads/", 3, '传入参数错误', 0);
		$this->load->model('admin_adsm', 'adsm');
		$rows = $this->adsm->get_ads_by_adsid($aid);
		$data['rows'] = $rows[0];
		$data['user_group'] = $_SESSION['group_id'];
		
		$this->load->view('admin/admin_ads_edit', $data);
	}

	public function edit_handle($vote_id, $cat_id, $status)
	{
		/* 编辑图片处理 */
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		if(is_int(intval($data['cat_id']))==false||is_int(intval($data['sort']))==false||is_int(intval($data['status']))==false){
		    action_message("/index.php", 4, '恶意输入参数，编辑不成功', 1);
		}
		$this->load->model("admin_articlem", 'aam');
		if (! isset($vote_id)) {
			action_message("/index.php/admin_ads/", 3, '传入参数错误', 0);
		}
		if ($cat_id != $_POST['cat_id']) {
			/* 当新传入的分类不等于原分类ID 执行更新分类统计 */
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
		
		$this->load->model('admin_adsm', 'adsm');
		$result = $this->adsm->do_edit_handle($data, array('ads_id' => $vote_id));
		
		if ($result) {
			action_message("/index.php/admin_ads/" . $cat_id . '/1', 3, '编辑成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function delete($id = 0, $sid = null, $cat_id = null)
	{
		check_adminstatus(13);
		if ($id !== '0' and $sid != null) {
			
			$this->load->model('admin_adsm', 'adsm');
			$vid = intval($id);
			$arr = array('ads_id' => $id);
			$result = $this->adsm->do_delete_handle($arr);
			
			if ($result) {
				$this->load->model('admincategorym', 'acm');
				$this->acm->do_update_category_nums($cat_id, $sid, 0);
				action_message("javascript:history.back(-1);", 3, "删除成功", 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}
}
