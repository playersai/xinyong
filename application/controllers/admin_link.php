<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_link extends CI_Controller
{

	public function index($queryStr = NULL,$per_pages =0 )
	{
		check_adminstatus(100);
		$get_pages = $per_pages !== null ? intval($per_pages) : 1; 
		$this->load->library('pagination');
		$this->load->model('adminlinkm', 'alk');
		$this->load->helper('myurl');
		
        if ($queryStr == null) {
			$queryStr = 'QEA=';
		}
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		 
		$website_name = trim($queryArr[0]);
		$type_id = $queryArr[1];
		$l_status = $queryArr[2];
		
		$data['website_name'] = $website_name;
		$data['add_user'] = $add_user;
		$data['type_id'] = $type_id;
		$data['l_status'] = $l_status;
	
		$result = $this->alk->get_link(null, null,$website_name,$l_status,$type_id);
		 

		
		$config['base_url'] = $this->config->item("base_url") . 'admin_link/index/'.$queryStr.'/';
		$config['total_rows'] = count($result);
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		$config['prev_link'] = '上一页';
		$config['next_link'] = "下一页";
		$config['last_link'] = '尾页';
		$config['first_link'] = '首页';
		$config['per_page'] = $configs['link'];
		$config['uri_segment'] = 4;//页码参数在第几个变量
		$this->pagination->initialize($config);
		$pagenums = ceil(count($result) / $configs['link']);
		$_page = $get_pages < $configs['link'] ? 0 : $get_pages;
		$data['pages'] = $this->pagination->create_links();
	 
		$data['page_info'] = array('nums' => count($result),'page_nums' => $pagenums,'now_page' => $_page / $configs['link'] + 1);
		
		$data['config']['base_url'] = $this->config->item("base_url");
		// $limit0=$get_pages<=1?0:($_page /$configs['link'])*$config['per_page'];
		$limit0 = $_page;
		$limitarr = array($limit0,$config['per_page']);
		
		$linkrows = $this->alk->get_link(null, $limitarr,$website_name,$l_status,$type_id);
		
		$data['links'] = $linkrows;
		$data['website_name'] = $website_name;
		$data['l_status'] = $l_status;
		$data['type_id'] = $type_id;
		$data['per_pages'] = $per_pages;
		
		$this->load->view('admin/link', $data);
	}

	public function edit($id)
	{
		check_adminstatus(10);
		$data['config']['base_url'] = $this->config->item("base_url");
		$this->load->model('adminlinkm', 'alk');
		$data['rows'] = $this->alk->get_alink($id);
		$this->load->view('admin/link_edit', $data);
	}

	public function edit_handle($id)
	{
		check_adminstatus(10);
		$idv = intval($id);
		$this->load->model('adminlinkm', 'alk');
		$data = $this->input->post(NULL, TRUE);
		$updt = $this->alk->do_edit_handle($data, $idv);
		if ($updt) {
			action_message($this->config->item("base_url") . "/admin_link/", 3, '编辑成功', 1);
		} else {
			action_message($this->config->item("base_url") . "/admin_link/", 3, '编辑失败', 0);
		}
	}

	public function add()
	{
		check_adminstatus(10);
		$data['config']['base_url'] = $this->config->item("base_url");
		$this->load->view('admin/link_add', $data);
	}

	public function add_handle()
	{
		check_adminstatus(10);
		$data = $this->input->post(NULL, TRUE);
		$this->load->model('adminlinkm', 'alk');
		$ist = $this->alk->do_add_handle($data);
		if ($ist) {
			action_message($this->config->item("base_url") . "/admin_link/", 3, '添加友情链接成功', 1);
		} else {
			action_message($this->config->item("base_url") . "/admin_link/", 3, '添加失败', 0);
		}
	}

	public function delete($id = 0, $sid = null)
	{
		check_adminstatus(10);
		if ($id !== '0' and $sid != null) {
			
			$this->load->database();
			$link_id = intval($id);
			if (isset($sid)) {
				switch (intval($sid)) {
					case 0:
						$data = array("status" => 1);
						$text = "当前状态已经修改为通过审核";
						break;
					case 1:
						$data = array("status" => 0);
						$text = "当前状态已经修改为待审核";
						break;
				}
			}
			$this->db->where(array("link_id" => $link_id));
			$result = $this->db->update("ch_link", $data);
			if ($result) {
				action_message("javascript:history.back(-1);", 3, $text, 1);
			} else {
				action_message("javascript:history.back(-1);", 3, '操作失败', 0);
			}
		}
	}
	
		public function delete_arr($id = NULL)
	{
		check_adminstatus(13);
		
		$this->load->model('Admin_articlem', 'aam'); 
		$result = $this->aam->do_delete_arr('link_id',$id,'ch_link');
		
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
		$result = $this->aam->do_update_arr('link_id',$id,'ch_link',$status);
		
		if ($result) {
			action_message("javascript:history.back(-1);", 3, "操作成功", 1);
		} else {
			action_message("javascript:history.back(-1);", 3, '操作失败', 0);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */