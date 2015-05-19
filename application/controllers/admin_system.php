<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_system extends CI_Controller
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

	public function index($per_pages = null)
	{
		check_adminstatus(100);
		$this->load->model('adminsystemm', 'asm');
		$data['info'] = $this->asm->get_website_info();
		$data['config']['base_url'] = $this->config->item('base_url');
		$this->load->view('admin/system_index', $data);
	}

	public function save_handle()
	{
		check_adminstatus(100);
		$data = $this->input->post(NULL, TRUE);
		$this->load->model('adminsystemm', 'asm');
		$updt = $this->asm->do_save_handle($data);
		if ($updt) {
			action_message($this->config->item("base_url") . "/admin_system/", 3, '编辑成功', 1);
		} else {
			action_message($this->config->item("base_url") . "/admin_system/", 3, '编辑失败', 0);
		}
	}

	public function stats($queryStr, $cur_page = 0)
	{
		check_adminstatus(100);
		
		$this->load->library('pagination');
		$this->load->helper('myurl');
		$this->load->model('adminsystemm', 'asm');
		
		if ($queryStr == null) $queryStr = 'QA==';
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
		
		$s_username = $queryArr[0];
		$s_deptcode = $queryArr[1];
		$data['s_username'] = $s_username;
		$data['s_deptcode'] = $s_deptcode;
		
		$rows_num = count($this->asm->get_addIinfo($s_username, $s_deptcode));
		$data['userGroup'] = $this->asm->get_user_group();
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/admin_system/stats/' . $queryStr . '/';
		$config['total_rows'] = $rows_num;
		$config['uri_segment'] = 4;
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		
		$limit_Arr = array($cur_page,$config['per_page']);
		$data['rows'] = $this->asm->get_addIinfo($s_username, $s_deptcode, $limit_Arr);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		
		// $s_username = urlencode(urlencode($queryArr[0]));
		// $s_deptcode = urlencode(urlencode($queryArr[1]));
		// $data['s_username'] = $s_username;
		// $data['s_deptcode'] = $s_deptcode;
		
		$this->load->view('admin/stats', $data);
	}

	public function log($per_pages = null)
	{
		check_adminstatus(100);
		$configs = $this->config->item("page_size"); // 获取配置文件分页数
		
		$get_pages = $per_pages !== null ? intval($per_pages) : 1;
		$this->load->model('admin_system_logm', 'asl');
		
		$data['config']['base_url'] = $this->config->item('base_url');
		$row_nums = $this->asl->get_system_log_nums();
		$pagenums = ceil($row_nums / $configs['system_log']);
		$_page = $get_pages < $configs['system_log'] ? 0 : $get_pages;
		/* 引入分页类 */
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item("base_url") . 'admin_system/log/';
		$config['total_rows'] = $row_nums;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['per_page'] = $configs['system_log'];
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links(); // 输出分页信息
		/* 分页类end */
		$limit0 = $_page;
		$limitarr = array($limit0,$config['per_page']);
		$data['rows'] = $this->asl->get_system_log($limitarr);
		
		$data['page_info'] = array('nums' => $row_nums,'page_nums' => $pagenums,'now_page' => $_page / $configs['link'] + 1);
		$this->load->view('admin/system_log', $data);
	}
}

/* End of file Admin_system.php */
/* Location: ./application/controllers/Admin_system.php */