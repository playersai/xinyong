<?php

class Admin_photom extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_photos($cat_id = 0, $limits = null,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_photos')->result();
		}
		if ($cat_id !== '0' and $limits !== null) {
			$a_date2=$a_date+86399;
			$where='';
			if(!empty($a_date)){
			   $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			} 
			$q = $this->db->query("select * from `ch_photos` where (status='$a_status' or '$a_status'='' )
				AND (title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (add_user like '%$a_user%' or '$a_user'='')
				AND cat_id=$cat_id order by settop desc,photo_id desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function get_photos_nums($cat_id = 0,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0') {
			return $this->db->count_all_results('ch_photos');
		}
		if ($cat_id !== '0') {
		    $a_date2=$a_date+86399;
			$where='';
			if(!empty($a_date)){
			   $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			} 
			$q = $this->db->query("select count(*) as count from `ch_photos`  
				WHERE (status='$a_status' or '$a_status'='' )
				AND (title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (add_user like '%$a_user%' or '$a_user'='')
				AND cat_id=$cat_id ") ;

			$count=$q->result();

			return (int)$count[0]->count;
			//$this->db->where(array('cat_id' => $cat_id));
			//$result = $this->db->count_all_results('ch_photos');
			//return $result;
		}
	}

	public function do_add_handle($data)
	{
		$result = $this->db->insert('ch_photos', $data);
		$last_id = $this->db->insert_id();
		if ($result) {
			
			$this->db->set('nums', 'nums+1', FALSE);
			if ($data['status'] == '0') {
				$this->db->set('daishen_nums', 'daishen_nums+1', FALSE);
			}
			$this->db->where('cat_id', $data['cat_id']);
			$this->db->update('ch_category');
		}
		return $last_id;
	}

	public function do_add_thumbs_handle($data)
	{
		$result = $this->db->insert('ch_photos_thumb', $data);
		return $result;
	}

	public function do_update_photos_nums($data, $where)
	{
		return $this->db->update('ch_photos', $data, $where);
	}

	public function do_update_photos_nums_set($s, $where)
	{
		if ($s == 0) {
			$this->db->set('photo_nums', 'photo_nums-1', false);
		}
		if ($s == 1) {
			$this->db->set('photo_nums', 'photo_nums+1', false);
		}
		$this->db->where($where);
		return $this->db->update('ch_photos');
	}

	public function do_delete_thumb($_where)
	{
		return $this->db->delete('ch_photos_thumb', $_where);
	}

	public function get_photos_by_photoid($vid = 0)
	{
		if ($vid !== '0') {
			$q = $this->db->get_where("ch_photos", array('photo_id' => $vid));
			return $q->result();
		}
	}

	public function get_thumb_by_photoid($vid = 0)
	{
		if ($vid !== '0') {
			$this->db->order_by('sort desc,thumb_id desc');
			$q = $this->db->get_where("ch_photos_thumb", array('photo_id' => $vid));
			return $q->result();
		}
	}

	public function get_thumb_by_thumbid($th_id)
	{
		$q = $this->db->get_where("ch_photos_thumb", array('thumb_id' => $th_id));
		return $q->result();
	}

	public function do_update_thumb($_where, $data)
	{
		$this->db->where($_where);
		return $this->db->update('ch_photos_thumb', $data);
	}

	public function do_edit_handle($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_photos', $data);
	}

	public function do_delete_handle($pid)
	{
		$this->db->where(array('photo_id' => $pid));
		return $this->db->delete('ch_photos');
	}
}
	