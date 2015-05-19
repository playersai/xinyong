<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
/* -----后台用户组管理控制器------- */
class Admin_user_group extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_user_groupm', 'augm');
	}

	public function index($queryStr = NULL,$per_pages = null)
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
 
		$user_group = $queryArr[0];
		$s_status = $queryArr[1];
		 
		$rows = $this->augm->get_user_group($user_group,$s_status);
		$data['user_group']=$user_group;
		$data['s_status']=$s_status;
		$data['rows'] = $rows;
		$this->load->view('admin/user_group', $data);
	}

	public function add()
	{
		check_adminstatus(100);
		
		$data['rows'] = $this->augm->get_user_group();
		$this->load->view('admin/user_group_add', $data);
	}

	public function add_handle()
	{
		$pdata = $this->input->post(NULL, TRUE);
		
		if ($pdata['name'] == '') {
			action_message("javascript:history.back(-1);" . $uid, 3, '用户组名称不能为空', 1);
		}
		
		$result = $this->augm->do_add_handle($pdata);
		if ($result) {
			action_message(admin_url('admin_user_group'), 1, '新增成功！', 1);
		} else {
			action_message("javascript:history.back(-1);", 1, '未知错误', 0);
		}
	}

	public function edit($uid)
	{
		check_adminstatus(100);
		$this->load->model('admin_userm', 'aum');
		
		$data['group_info'] = $this->aum->get_user_group($uid);
		$this->load->view('admin/user_group_edit', $data);
	}

	public function edit_handle($uid)
	{
		check_adminstatus(100);
		$pdata = $this->input->post(NULL, TRUE);
		
		if ($pdata['name'] == '') {
			action_message("javascript:history.back(-1);" . $uid, 3, '用户组名称不能为空', 1);
		}
		
		$result = $this->augm->do_edit_handle($pdata, $uid);
		if ($result) {
			action_message(admin_url('admin_user_group'), 1, '编辑成功！', 1);
		} else {
			action_message("javascript:history.back(-1);" . $uid, 1, '无权此操作，请稍后重试', 0);
		}
	}

	public function delete($uid)
	{
		check_adminstatus(100);
		$result = $this->augm->do_delete($uid);
		if ($result) {
			action_message(admin_url('admin_user_group'), 1, '删除成功！', 1);
		} else {
			action_message(admin_url('admin_user_group'), 3, '删除失败', 0);
		}
	}

	public function access()
	{
		test();
	}
}