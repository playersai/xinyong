<?php

class Upload extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	function index($form_name = null, $input_name = null)
	{
		$this->load->view('public/up_form', array('f_name' => $form_name,'i_name' => $input_name));
	}

	function do_upload($form_name = null, $input_name = null)
	{
		$config['upload_path'] = './public/attached/thumb/';
		$config['allowed_types'] = 'gif|jpg|png|flv|rar|doc|docx';
		$config['max_size'] = '293928090';
		$config['overwrite'] = FALSE; // 重写false
		$config['encrypt_name'] = TRUE; // 随机文件名
		                                // $config['remove_spaces']= TRUE;
		                                // $config['max_width'] = '1024';
		                                // $config['max_height'] = '768';
		
		$this->load->library('upload', $config);
		
		if (! $this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('public/up_form', $error);
		} else {
			$data = array('upload_data' => $this->upload->data(),'f_name' => $form_name,'i_name' => $input_name);
			// print_r($data);
			$this->load->view('public/upload_success', $data);
		}
	}
}
?>