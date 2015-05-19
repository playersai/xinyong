<?php

class Index_grade extends CI_Model
{
	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}
	public function do_handle($data)
	{ 
		/* 评级申请入库 */
		return $this->db->insert('ch_grade', $data);
	}
}	