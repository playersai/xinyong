<?php

class Index_get_adsm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_ads_by_catid($where, $limits)
	{
		$query = $this->db->query("select * from `ch_ads` where status=1 and $where order by sort desc,ads_id desc limit " . $limits);
		return $query->result();
	}

	public function get_float_ad($cat_id)
	{
		$this->db->select('is_float_ad,float_ad,float_ad_link');
		$query = $this->db->get_where('ch_category', array('cat_id' => $cat_id));
		return $query->result();
	}
}
	