<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_todo extends CI_Controller
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

	public function index($queryStr = NULL,$cur_page = 0)
	{
		check_adminstatus(100);
		
		$this->load->library('pagination');
		$this->load->model('adminsystemm', 'asm');
 
		$this->load->library('pagination');
		$this->load->helper('myurl');
	    //var_dump($this->asm->get_toDoList($a_title,$a_date,$a_user));exit;
	    if ($queryStr == null) {
			$queryStr = 'QEA=';
		}
		
		$queryDeStr = urlsafe_b64decode($queryStr);
		$queryArr = explode('@', $queryDeStr);
 
		$a_title = $queryArr[0];
		$a_date2=$queryArr[1];
		$a_date = strtotime($queryArr[1]);
		$a_user = $queryArr[2];
        $rows_num = count($this->asm->get_toDoList(null,$a_title,$a_date,$a_user));
		
		$config = $this->page_config;
		$config['base_url'] = $this->config->item("base_url") . '/admin_todo/index/'.$queryStr . '/';
		$config['total_rows'] = $rows_num;
		$config['uri_segment'] = 4;
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		
		$limit_str = $cur_page . ',' . $config['per_page'];
		$data['rows'] = $this->asm->get_toDoList($limit_str,$a_title,$a_date,$a_user);
		
		$data['totalRows'] = $config['total_rows'];
		$data['totalPages'] = ceil($config['total_rows'] / $config['per_page']);
		$data['pageLink'] = $this->pagination->create_links();
		$data['id'] = $id;
		$data['per_pages'] = $per_pages;
		$data['a_title'] = $a_title;
		$data['a_date'] = $a_date2;
		$data['a_user'] = $a_user;
		$data['a_status'] = $a_status;
		$this->load->view('admin/todo_list', $data);
	}
}
