<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_feedback extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->page_config['first_link'] = '首页';
		$this->page_config['last_link'] = '尾页';
		$this->page_config['prev_link'] = '上一页';
		$this->page_config['next_link'] = '下一页';
		$this->page_config['cur_tag_open'] = '<span class="page_now">';
		$this->page_config['cur_tag_close'] = '</span>';
		$this->page_config['per_page'] = 10;
	}

	public function index($id = 0, $queryStr = NULL,$per_pages =0)
	{ 
		check_adminstatus(100);
		
		if ($id == '38') {
			header("location:/index.php/admin_feedback/result_list/" . $id . "/1");
			exit();
		}
		if ($queryStr == null) {
			$queryStr = 'QEA=';
		}
		check_purview('admin_feedback-' . $id);
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
			
			$this->load->model('admin_feedbackm', 'afm');
			$article_nums = $this->afm->get_feedback_nums($id,$a_title,$a_date,$a_user,$a_status);
		}
		
		/* 引入分页类 */
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'admin_feedback/index/' . $id . '/'.$queryStr . '/';
		$config['total_rows'] = $article_nums;
		$config['uri_segment'] = 5;//页码参数在第几个变量
		$config['last_link'] = '尾页';
		$config['first_link'] = '首页';
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
		
		$arows = $this->afm->get_feedback($id, $limitarr,$a_title,$a_date,$a_user,$a_status);
		$data['crows'] = $crows;
		$data['arows'] = $arows;
		$data['id'] = $id;
		$data['per_pages'] = $per_pages;
		$data['a_title'] = $a_title;
		$data['a_date'] = $a_date2;
		$data['a_user'] = $a_user;
		$data['a_status'] = $a_status;
		// print_r($data);die;
		$this->load->view('admin/admin_feedback_index', $data);
	}

	public function add($id = null)
	{
		check_adminstatus(100);
		$this->load->model('admin_feedbackm', 'afm');
		$vrows = $this->afm->get_feedback_value();
		
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
		$data['vrow'] = $vrows;
		
		$this->load->view('admin/admin_feedback_add', $data);
	}

	public function add_handle()
	{
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		if(is_int(intval($data['cat_id']))==false||is_int(intval($data['stats']))==false||is_int(intval($data['status']))==false||is_int(intval($data['settop']))==false||is_int(intval($data['index_top']))==false){
		    action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
		}
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		$data['rel_date'] = strtotime($data['rel_date']);
		$data['start_time'] = strtotime($data['start_time']);
		$data['exp_time'] = strtotime($data['exp_time']);
		$status = empty($data['status']) ? 0 : $data['status'];
		$data['settop'] = isset($data['settop']) ? $data['settop'] : 0;
		$data['index_top'] = isset($data['index_top']) ? $data['index_top'] : 0;
		
		$this->load->model('admin_feedbackm', 'afm');
		$ist = $this->afm->do_add_handle($data);
		
		if ($ist) {
			$this->load->model('admincategorym', 'acm');
			$this->acm->do_update_category_nums($data['cat_id'], $status, 1);
			action_message("/index.php/admin_feedback/index/" . $data['cat_id'], 3, '添加成功', 1);
		} else {
			action_message("/index.php/admin_feedback/index/" . $data['cat_id'], 3, '添加失败', 0);
		}
	}

	public function edit($aid, $cat_id)
	{
		/* 编辑图片视图输出 */
		check_adminstatus(100);
		$this->load->model('admin_feedbackm', 'afm');
		$vrows = $this->afm->get_feedback_value();
		if (isset($cat_id) and $cat_id !== NULL) {
			$cat_id = intval($cat_id);
			$this->load->model('admincategorym', 'amc');
			$data['category'] = $this->amc->get_category($cat_id);
		}
		// $parent=$this->amc->get_category_by_cat_type_id(6);
		$cats = $this->amc->get_cat_by_level(array(1,2,3));
		if (is_array($cats) and isset($cats[1][0])) {
			$data['cats']['parent'] = $cats[1][0];
			
			$data['cats']['son'] = isset($cats[2]) ? $cats[2] : "";
			$data['cats']['sonson'] = isset($cats[3]) ? $cats[3] : array();
		}
		
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		$this->load->model('admin_feedbackm', 'apm');
		$rows = $this->apm->get_feedback_by_fid($aid);
		$data['rows'] = $rows[0];
		$data['selected_catid'] = $cat_id;
		// $data['cats']=$parent;
		$data['user_group'] = $_SESSION['group_id'];
		$data['vrow'] = $vrows;
		$this->load->view('admin/admin_feedback_edit', $data);
	}

	public function result_edit($aid, $cat_id = null)
	{
		/* 编辑调查结果视图输出 */
		check_adminstatus(100);
		// $this->load->model('admin_feedbackm', 'afm');
		$this->load->model('admin_feedbackm', 'apm');
		
		$cid = isset($aid) ? intval($aid) : action_message("/index.php/admin_vote/", 3, '传入参数错误', 0);
		if ($cat_id == '1') {
			
			$data['f_reply'] = $this->apm->get_feedback_reply_by_fcid($aid);
			$data['user_rows'] = $this->apm->get_user_group();
			$rows = $this->apm->get_feedback_content_by_fcid($aid);
			$data['rows'] = $rows[0];
			$data['selected_catid'] = $cat_id;
			$data['user_group'] = $_SESSION['group_id'];
			$this->load->view('admin/admin_feedback_result_view', $data);
		} else {
			
			$data['f_reply'] = $this->apm->get_feedback_reply_by_fcid($aid);
			$data['user_rows'] = $this->apm->get_user_group();
			$rows = $this->apm->get_feedback_content_by_fcid2($aid);
			$data['rows'] = $rows[0];
			$data['selected_catid'] = $cat_id;
			$data['user_group'] = $_SESSION['group_id'];
			$this->load->view('admin/admin_feedback_result_view_other', $data);
		}
	}

	public function handle_user($f_c_id)
	{
		/* 指派回复权限 */
		if ($_SESSION['group_id'] == '1' and ! empty($f_c_id)) {
			$pdata = $this->input->post(NULL, TRUE);
			$this->load->model('admin_feedbackm', 'apm');
			$data['handle_user'] = $pdata['handle_user'];
			$result = $this->apm->do_handle_user($data, array('f_c_id' => $f_c_id));
			if ($result) {
				action_message("javascript:history.back(-1);", 3, '指派成功', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}

	public function edit_handle($f_id, $cat_id)
	{
		/* 编辑处理 */
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		if(is_int(intval($data['cat_id']))==false||is_int(intval($data['stats']))==false||is_int(intval($data['status']))==false||is_int(intval($data['settop']))==false||is_int(intval($data['index_top']))==false){
		    action_message("/index.php", 4, '恶意输入参数，编辑不成功', 1);
		}
		$data['content'] = $_POST['content1'];
		unset($data['content1']);
		$data['add_user'] = $_SESSION['manage'];
		$data['addtime'] = time();
		$data['rel_date'] = strtotime($data['rel_date']);
		$data['start_time'] = strtotime($data['start_time']);
		$data['exp_time'] = strtotime($data['exp_time']);
		$status = empty($data['status']) ? 0 : $data['status'];
		$data['settop'] = isset($data['settop']) ? $data['settop'] : 0;
		$data['index_top'] = isset($data['index_top']) ? $data['index_top'] : 0;
		
		$this->load->model('admin_feedbackm', 'afm');
		$_where = array('f_id' => $f_id);
		$update = $this->afm->do_edit_handle($data, $_where);
		
		if ($update) {
			$this->load->model('admincategorym', 'acm');
			$this->acm->do_update_category_nums($data['cat_id'], $status, 1);
			action_message("/index.php/admin_feedback/index/" . $data['cat_id'], 3, '编辑成功', 1);
		} else {
			action_message("/index.php/admin_feedback/index/" . $data['cat_id'], 3, '编辑失败', 0);
		}
	}

	public function reply_handle($f_c_id, $f_id, $act = 0)
	{
		$this->load->model('admin_feedbackm', 'afm');
		
		if ($act == '0') {
			if (isset($_POST['status'])) {
				$data2['content'] = $_POST['content1'];
				$data2['f_c_id'] = $f_c_id;
				$data2['f_id'] = $f_id;
				$data2['addtime'] = time();
				$data2['add_user'] = $_SESSION['manage'];
				$data['status'] = intval($_POST['status']);
				
				$update = $this->afm->do_update_fc_status($data, array('f_c_id' => $f_c_id));
				$update = $this->afm->do_update_reply_handle($data2, array('f_c_id' => $f_c_id), $f_c_id, $data['status']);
			} else {
				
				$data['content'] = $_POST['content1'];
				$data['f_c_id'] = $f_c_id;
				$data['f_id'] = $f_id;
				$data['addtime'] = time();
				$data['add_user'] = $_SESSION['manage'];
				
				$update = $this->afm->do_reply_handle($data);
			}
		}
		if ($act == '1') {
			if (isset($_POST['status'])) {
				$data2['content'] = $_POST['content1'];
				$data['status'] = intval($_POST['status']);
				
				$update = $this->afm->do_update_fc_status($data, array('f_c_id' => $f_c_id));
				$update = $this->afm->do_update_reply_handle($data2, array('f_c_id' => $f_c_id), $f_c_id, $data['status']);
			} else {
				$data['content'] = $_POST['content1'];
				
				$update = $this->afm->do_update_reply_handle($data, array('f_c_id' => $f_c_id), $f_c_id, 1);
			}
		}
		
		if ($update) {
			$this->load->model('admincategorym', 'acm');
			$this->acm->do_update_category_nums($data['cat_id'], $status, 1);
			action_message("/index.php/admin_feedback/result_list/38/" . $f_id, 3, '更新成功', 1);
		} else {
			action_message("/index.php/admin_feedback/result_list38/" . $f_id, 3, '更新失败', 0);
		}
	}

	public function delete($id = NULL)
	{
		check_adminstatus(100);
		
		$this->load->model('admin_feedbackm', 'afm');
		$result = $this->afm->do_delete_handle($id);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "删除成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}

	public function result_list($cat_id, $id = 0, $cur_page = 0)
	{
		check_purview("admin_feedback-result_list-" . $cat_id);
		check_adminstatus(100);
		$this->load->library('pagination');
		$this->load->helper('myurl');
		$this->load->model('admin_feedbackm', 'afm');
		
		if ($id != '0') {
			$cat = $this->afm->get_feedback_by_fid($id);
			$data['cat'] = $cat;
			$rows_num = $this->afm->get_feedback_content_nums($id);
		}
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/admin_feedback/result_list/' . $cat_id . '/' . $id . '/';
		$config['total_rows'] = $rows_num;
		$config['uri_segment'] = 5;
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		
		$data['f_id'] = $id;
		
		if ($id == 1) {
			$limit = $cur_page . ',' . $config['per_page'];
			$rows = $this->afm->get_feedback_content($id, $limit);
			$data['rows'] = $rows;
		} else {
			$limit = $cur_page . ',' . $config['per_page'];
			$rows = $this->afm->get_feedback_content2($id, $limit);
			$data['rows'] = $rows;
		}
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$this->load->view('admin/admin_feedback_result_list', $data);
	}

	public function result_delete($fcid = 0)
	{
		check_adminstatus(13);
		if ($fcid !== '0') {
			$this->load->model('admin_feedbackm', 'afm');
			
			$arr = array('f_c_id' => $fcid);
			$result = $this->afm->do_result_delete_handle($arr);
			
			if ($result) {
				$this->load->model('admincategorym', 'acm');
				$this->acm->do_update_category_nums($cat_id, $sid, 0);
				action_message("javascript:history.back(-1);", 3, "删除成功", 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}

	public function result_search($queryStr = null, $cur_page = 0)
	{
		$this->load->library('pagination');
		$this->load->helper('myurl');
		$this->load->model('admin_feedbackm', 'afm');
		
		if ($queryStr == null) {
			$queryStr = 'QDlAMA==';
		}
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		
		$keyword = $queryArr[0];
		$search_status = $queryArr[1];
		$search_type = $queryArr[2];
		
		$data['keywords'] = $keyword;
		$data['status'] = $search_status;
		$data['type_id'] = $search_type;
		
		$where = ' f_id=1 ';
		if ($keyword) {
			$where .= "and a.title like '%" . $keyword . "%'";
		}
		
		if ($search_status != '9') {
			$where .= " and a.status='" . $search_status . "'";
		}
		
		if ($search_type != "0") {
			$where .= " and a.type_id='" . $search_type . "'";
		}
		
		$rows_num = $this->afm->do_result_search_nums($where);
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/admin_feedback/result_search/' . $queryStr . '/';
		$config['total_rows'] = $rows_num;
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		
		$limit = $cur_page . ',' . $config['per_page'];
		$rows = $this->afm->do_result_search($where, $limit);
		$data['rows'] = $rows;
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$this->load->view('admin/admin_feedback_result_search', $data);
	}
		public function delete_arr($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('f_id',$id,'ch_feedback');
		
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
		$result = $this->aam->do_update_arr('f_id',$id,'ch_feedback',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
			public function delete_arr2($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('f_c_id',$id,'ch_feedback_content');
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "删除成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
	
		public function status_arr2($id = NULL,$status)
	{ 
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_update_arr('f_c_id',$id,'ch_feedback_content',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
}

/* Location: ./application/controllers/admin_vote.php */