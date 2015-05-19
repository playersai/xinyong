<?php
 
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_category extends CI_Controller
{

	public function index($id = 0)
	{
		check_adminstatus(13);
		
		$this->load->model("admincategorym", 'amc');
		$row = $this->amc->get_category();
		$data['cat_type'] = $this->amc->get_cat_type_array();
		$sons = $this->amc->get_category_level(array(2,3));
		
		$data['cat'] = $row;
		if (is_array($sons) and isset($sons[2])) {
			$data['son'] = $sons[2];
		}
		
		if (is_array($sons) and isset($sons[3])) {
			$data['son_son'] = $sons[3];
		}
		
		$this->load->view('admin/admin_category_index', $data);
	}

	public function add($cat_id = null, $cat_type_id = null)
	{
		check_adminstatus(100);
		
		if ($cat_id != '' && $cat_id != NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
		}
		
		$this->load->model('admincategorym', 'amc');
		$this->amc->get_auth_rule_pid(60);
		
		$data['select_type_id'] = $cat_type_id != null ? $cat_type_id : 1;
		$data['cat_type'] = $this->amc->get_cat_type();
		$cats = $this->amc->get_category($cat_id);
		$data['cats'] =$cats[0];
		$this->load->view('admin/admin_category_add', $data);
	}

	public function add_handle($type_id = NULL)
	{
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		if(is_int(intval($data['parent_id']))==false||is_int(intval($data['sort']))==false||is_int(intval($data['status']))==false||is_int(intval($data['cat_type_id']))==false||is_int(intval($data['level']))==false){
		    action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
		}
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		
		$this->load->model('admincategorym', 'amc');
		$result = $this->amc->do_add_category($data);
		if ($result) {
			switch ($type_id) {
				case '7':
					action_message("/index.php/admin_category_type/topics", 3, '添加成功', 1);
					break;
				case '8':
					action_message("/index.php/admin_category_type/index/8", 3, '添加成功', 1);
					break;
				default:
					action_message("/index.php/admin_category", 3, '添加成功', 1);
			}
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function edit($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		$data['select_type_id'] = $select_type_id;
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		$data['cats_son'] = is_array($cats[2]) ? $cats[2] : "";
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit1($cat_id)
	{
		check_purview("admin_category-edit1-" . $cat_id);
		check_adminstatus(13);
		$cat_id = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cat_id);
		$page_info = $this->amc->get_apage($cat_id);
		
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		
		$data['rel_date'] = $page_info[0]->rel_date;
		$data['content1'] = $page_info[0]->content;
		$data['stats'] = $page_info[0]->stats;
		$data['cat'] = $row;
		$data['category'] = $row;
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		if (is_array($cats) and isset($cats[1][0])) {
			$data['cats'] = $cats[1][0];
			$data['cats_son'] = isset($cats[2]) ? $cats[2] : "";
		}
		
		$this->load->view('admin/admin_category_edit1', $data);
	}

	public function edit2($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		$data['select_type_id'] = $select_type_id;
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit3($cat_id)
	{
		check_adminstatus(13);
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit4($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		$data['select_type_id'] = $select_type_id;
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit5($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		$data['select_type_id'] = $select_type_id;
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit6($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		$data['select_type_id'] = $select_type_id;
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit7($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		$data['select_type_id'] = $select_type_id;
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit8($cat_id, $cat_type_id = null)
	{
		check_adminstatus(13);
		$select_type_id = $cat_type_id !== null ? $cat_type_id : 1;
		$data['select_type_id'] = $select_type_id;
		$cid = isset($cat_id) ? intval($cat_id) : action_message("/index.php/admin_category/", 3, '传入参数错误', 0);
		$this->load->model("admincategorym", "amc");
		$data['cat_type'] = $this->amc->get_cat_type();
		$row = $this->amc->get_category($cid);
		if ($row[0]->parent_id !== '0') {
			$data['father'] = $this->amc->get_category($row[0]->parent_id);
		}
		$cats = $this->amc->get_cat_by_level(array(1,2));
		
		$data['cat'] = $row;
		$data['cats'] = $cats[1][0];
		if (is_array($cats) and isset($cats[2])) {
			$data['cats_son'] = $cats[2];
		}
		$this->load->view('admin/admin_category_edit', $data);
	}

	public function edit1_handle($cid)
	{
		check_adminstatus(13);
		if (empty($cid)) {
			action_message("/index.php/admin_category/", 3, '操作失败', 0);
		}
		$this->load->model("admincategorym", 'amc');
		
		$data_cat = $this->input->post(NULL, TRUE);
		$data_cat['is_redirect'] = isset($data_cat['is_redirect']) ? '1' : '0';
		
		$data_apage['content'] = $_POST['content1'];
		unset($data_cat['content1']);
		$data_apage['rel_date'] = strtotime($this->input->post('rel_date'));
		unset($data_cat['rel_date']);
		
		// if ($data['parent_id'] != 0) {
		// $levels = $this->amc->get_level_by_catid($data['parent_id']);
		// var_dump($levels);
		// return ;
		// if ($levels)
		// $data['level'] = $levels[0]->level + 1;
		// } else {
		// $data['level'] = 1;
		// }
		
		if (is_array($data_apage)) {
			$result = $this->amc->do_edit1_handle($data_apage, $data_cat, $cid);
		}
		
		if ($result) {
			// action_message("/index.php/admin_category/", 3, '编辑成功', 1);
			action_message("javascript:history.back(-1);", 3, '编辑成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function edit_handle($cid)
	{
		check_adminstatus(13);
		if (empty($cid)) {
			action_message("/index.php/admin_category/", 3, '操作失败', 0);
		}
		$data = $this->input->post(NULL, TRUE);
		$data['is_redirect'] = ! isset($_POST['is_redirect']) ? '0' : '1';
		$data['is_float_ad'] = ! isset($_POST['is_float_ad']) ? '0' : '1';
		if(is_int(intval($data['parent_id']))==false||is_int(intval($data['sort']))==false||is_int(intval($data['status']))==false||is_int(intval($data['shenhe']))==false||is_int(intval($data['is_menu']))==false){
		    action_message("/index.php", 4, '恶意输入参数，编辑不成功', 1);
		}
		$this->load->model("admincategorym", 'amc');
		if ($data['parent_id'] != 0) {
			$levels = $this->amc->get_level_by_catid($data['parent_id']);
			if ($levels) $data['level'] = $levels[0]->level + 1;
		} else {
			
			$data['level'] = 1;
		}
		$result = $this->amc->do_edit_handle($data, $cid);
		
		if ($result) {
			// action_message("/index.php/admin_category/", 3, '编辑成功', 1);
			action_message("javascript:history.back(-1);", 3, '操作成功', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function delete($id = 0, $sid = null)
	{
		check_adminstatus(13);
		if ($id !== '0' and $sid != null) {
			
			$this->load->model("admincategorym", 'amc');
			$cat_info = $this->amc->get_category($id);
			$son = $this->amc->get_son_by_catid($id);
			
			if (count($son) > 0) {
				action_message("javascript:history.back(-1);", 3, '本分类存在子分类，请先删除子分类', 0);
			} else {
				$result = $this->amc->do_delete_handle($id);
				
				if ($result) {
					switch ($cat_info[0]->cat_type_id) {
						case 1:
							$this->amc->do_delete_by_where('ch_apage', $id);
							break;
						case 2:
							$this->amc->do_delete_by_where('ch_articles', $id);
							$this->amc->do_delete_by_where('ch_articles_thumb', $id);
							break;
						case 3:
							$this->amc->do_delete_by_where('ch_photos', $id);
							$this->amc->do_delete_by_where('ch_photos_thumb', $id);
							break;
						case 4:
							$this->amc->do_delete_by_where('ch_vedio', $id);
							break;
						case 5:
							$this->amc->do_delete_by_where('ch_vote_list', $id);
							break;
						case 6:
							$this->amc->do_delete_by_where('ch_feedback', $id);
							break;
						case 7:
							$this->amc->do_delete_by_where('ch_topics', $id);
							$this->amc->do_delete_by_where('ch_topics_thumb', $id);
							break;
						case 8:
							$this->amc->do_delete_by_where('ch_ads', $id);
							break;
					}
					action_message("javascript:history.back(-1);", 3, "删除成功", 1);
				} else {
					action_message("javascript:history.back(-1);", 3, '操作失败', 0);
				}
			}
		}
	}
}

/* Location: ./application/controllers/admin_category.php */