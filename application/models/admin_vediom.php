<?php

class Admin_vediom extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_vedio($cat_id = 0, $limits = null,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_vedio')->result();
		}
		if ($cat_id !== '0' and $limits !== null) {
			$a_date2=$a_date+86399;
			$where='';
			if(!empty($a_date)){
			   $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			} 
			$q = $this->db->query("select * from `ch_vedio` where  (status='$a_status' or '$a_status'='' )
				AND (title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (add_user like '%$a_user%' or '$a_user'='')
				AND cat_id=$cat_id order by settop desc,vid desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function get_vedio_nums($cat_id = 0)
	{
		if ($cat_id == '0') {
			
			return $this->db->count_all_results('ch_vedio');
		}
		if ($cat_id !== '0') {
			
			$a_date2=$a_date+86399;
			$where='';
			if(!empty($a_date)){
			   $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			} 
			$q = $this->db->query("select count(*) as count from `ch_vedio`  
				WHERE (status='$a_status' or '$a_status'='' )
				AND (title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (add_user like '%$a_user%' or '$a_user'='')
				AND cat_id=$cat_id ") ;

			$count=$q->result();

			return (int)$count[0]->count;
			//$this->db->where(array('cat_id' => $cat_id));
			//$result = $this->db->count_all_results('ch_vedio');
			//return $result;
		}
	}

	public function get_vedio_by_vedioid($vid = 0)
	{
		if ($vid !== '0') {
			
			$q = $this->db->get_where("ch_vedio", array('vid' => $vid));
			return $q->result();
		}
	}

	public function do_add_handle($data)
	{
		$result = $this->db->insert('ch_vedio', $data);
		
		if ($result) {
			$this->db->set('nums', 'nums+1', FALSE);
			if ($data['status'] == '0') {
				$this->db->set('daishen_nums', 'daishen_nums+1', FALSE);
			}
			$this->db->where('cat_id', $data['cat_id']);
			$this->db->update('ch_category');
		}
		return $result;
	}

	public function do_edit_handle($data, $vid)
	{
		$this->db->where(array('vid' => $vid));
		return $this->db->update('ch_vedio', $data);
	}

	public function do_update_category_nums($where, $act = 0)
	{
		if ($act == '0') {
			$this->db->set('nums', 'nums-1', FALSE);
		}
		if ($act == '1') {
			$this->db->set('nums', 'nums+1', FALSE);
		}
		$this->db->where($where);
		return $this->db->update('ch_category');
	}

	public function do_delete($vid)
	{
		$this->db->where(array('vid' => $vid));
		return $this->db->delete('ch_vedio');
	}
}
	