<?php

class Admin_adsm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_ads($cat_id = 0, $limits = null)
	{
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_ads')->result();
		}
		if ($cat_id !== '0' and $limits !== null) {
			$q = $this->db->query("select * from `ch_ads` where cat_id=$cat_id order by sort desc,ads_id desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function do_add_handle($data)
	{
		return $this->db->insert('ch_ads', $data);
	}

	public function get_ads_nums($cat_id = 0)
	{
		if ($cat_id == '0') {
			
			return $this->db->count_all_results('ch_ads');
		}
		if ($cat_id !== '0') {
			
			$this->db->where(array('cat_id' => $cat_id));
			$result = $this->db->count_all_results('ch_ads');
			return $result;
		}
	}

	public function get_ads_by_adsid($vid = 0)
	{
		if ($vid !== '0') {
			$q = $this->db->get_where("ch_ads", array('ads_id' => $vid));
			return $q->result();
		}
	}

	public function do_edit_handle($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_ads', $data);
	}

	public function do_delete_handle($where)
	{
		$this->db->where($where);
		return $this->db->delete('ch_ads');
	}
}
	