<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends CI_Controller
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

	public function index($queryStr = NULL, $cur_page = 0)
	{
		check_adminstatus(100);
		
		if ($queryStr == null) {
			$queryStr = 'QEA=';
		}
		
		$this->load->library('pagination');
		$this->load->helper('myurl');
		$this->load->model('admin_userm', 'aum');
		$this->load->model('adminsystemm', 'asm');
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		
		$s_username = $queryArr[0];
		$s_nickname = $queryArr[1];
		$s_deptcode = $queryArr[2];
		$s_status = $queryArr[3];
		$data['s_username'] = $s_username;
		$data['s_nickname'] = $s_nickname;
		$data['s_deptcode'] = $s_deptcode;
		$data['s_status'] = $s_status;
		
		$rows_num = count($this->aum->get_user($s_username, $s_nickname, $s_deptcode,$s_status));
		$data['userGroup'] = $this->asm->get_user_group();
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/admin_user/index/' . $queryStr . '/';
		$config['total_rows'] = $rows_num;
		$config['uri_segment'] = 4;
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		
		$limit_Arr = array($cur_page,$config['per_page']);
		$data['rows'] = $this->aum->get_user($s_username, $s_nickname, $s_deptcode,$s_status, $limit_Arr);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		$this->load->view('admin/user', $data);
	}

	public function add()
	{
		check_adminstatus(100);
		if ($_SESSION['group_id'] != '1') {
			action_message("javascript:history.back(-1);", 3, '无权此操作，请稍后重试!', 0);
			exit();
		}
		
		$this->load->model('admin_userm', 'aum');
		$data['rows'] = $this->aum->get_user_group();
		$data['config']['base_url'] = $this->config->item('base_url');
		$this->load->view('admin/user_add', $data);
	}

	public function add_handle()
	{
		$pdata = $this->input->post(NULL, TRUE);
	    if(is_int(intval($data['group_id']))==false||is_int(intval($data['status']))==false){
		    action_message("/index.php", 4, '恶意输入参数，添加不成功', 1);
		}
		$this->load->model('admin_userm', 'aum');
		$quser = $this->aum->get_auser(array('username' => $pdata['username']));
		$pdata['addtime'] = time();
		$pdata['last_login_time'] = time();
		$pdata['password'] = md5($pdata['password']);
		if (! $quser) {
			$quser = $this->aum->do_add_handle($pdata);
			if ($quser) {
				action_message("javascript:history.back(-1);", 3, '新增成功!', 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败!', 0);
			}
		} else {
			action_message("javascript:history.back(-1);", 3, '用户名已存在!', 0);
		}
	}

	public function edit($uid)
	{
		check_adminstatus(100);
		
		if ($_SESSION['group_id'] != '1') {
			$uid = $_SESSION['user_id'];
		}
		
		$this->load->model('admin_userm', 'aum');
		$quser = $this->aum->get_auser(array('user_id' => $uid));
		$data['rows'] = $this->aum->get_user_group();
		$data['user_info'] = $quser;
		$data['config']['base_url'] = $this->config->item('base_url');
		$this->load->view('admin/user_edit', $data);
	}

	public function edit_handle($uid)
	{
		check_adminstatus(100);
		$pdata = $this->input->post(NULL, TRUE);
		if ($pdata['password'] == '') {
			unset($pdata['password']);
		} else {
			$pdata['password'] = md5($pdata['password']);
		}
		
		$this->load->model('admin_userm', 'aum');
		$result = $this->aum->do_edit_handle($pdata, $uid);
		if ($result) {
			action_message("javascript:history.back(-1);", 3, '编辑成功！', 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '无权此操作，请稍后重试!', 0);
		}
	}

	public function delete($uid, $sid)
	{
		check_adminstatus(100);
		
		if ($_SESSION['group_id'] != '1') {
			action_message("javascript:history.back(-1);", 3, '无权此操作，请稍后重试!', 0);
			exit();
		}
		
		$this->load->model('admin_userm', 'aum');
		$result = $this->aum->do_delete($uid, $sid);
		if ($result) {
			action_message($this->config->item('base_url') . 'admin_user/', 3, '修改成功！', 1);
		} else {
			action_message($this->config->item('base_url') . 'admin_user/', 3, '修改失败', 0);
		}
	}
	  public function delete_arr($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('user_id',$id,'ch_user');
		
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
		$result = $this->aam->do_update_arr('user_id',$id,'ch_user',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
}
