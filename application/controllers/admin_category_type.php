<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_category_type extends CI_Controller
{
 
	public function index($id = 0)
	{
		check_adminstatus(100);
		if ($id !== '0') {
			$this->load->model("admincategorym", 'amc');
			$row = $this->amc->get_category_by_cat_type_id($id);
		}
		
		$data['cat_type'] = $this->amc->get_cat_type_array();
		// $sons=$this->amc->get_category_level(array(2,3));
		
		$data['cat'] = $row;
				
		$this->load->view('admin/admin_category_type_index' . $id, $data);
	}

	public function topics()
	{ 
		check_adminstatus(100);
		
		$this->load->model("admincategorym", 'amc');
		$data['cat_type'] = $this->amc->get_cat_type_array();
		$data['rows'] = $this->amc->get_cat_by_parent_id(30);
		
		$this->load->view('admin/admin_category_type_index7', $data);
	}
}

/* Location: ./application/controllers/admin_category_type.php */