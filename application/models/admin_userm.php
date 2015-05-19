<?php

class Admin_userm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_user($userName, $nickName, $groupID,$status,$limit_arr)
	{
		$sql = "SELECT u.*,ug.name FROM ch_user u join ch_user_group ug on ug.group_id = u.group_id 
				WHERE (u.status='$status' or '$status'='' )
				AND (ug.group_id='$groupID' or '$groupID'='' )
				AND (u.nickname like '%$nickName%' or '$nickName'='')
				AND (u.username like '%$userName%' or '$userName'='')
				order by user_id desc ";
		
		if (isset($limit_arr) && ! empty($limit_arr)) {
			$sql .= " limit $limit_arr[0],$limit_arr[1]";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_user_nums()
	{
		return $this->db->count_all_results('ch_user');
	}

	public function get_user_group($_groupid = null)
	{
		if ($_groupid == null) {
			$q = $this->db->get('ch_user_group');
			return $q->result();
		} else {
			$this->db->from('user_group');
			$this->db->where('group_id', $_groupid);
			return $this->db->get()->row_array();
		}
	}

	public function get_auser($where)
	{
		// print_r($where); eixt;
		$q = $this->db->get_where('ch_user', $where);
		return $q->result();
	}

	public function do_add_handle($data)
	{
		$this->db->insert('ch_user', $data);
		$uid = $this->db->insert_id();
		
		$gdata = array('uid' => $uid,'group_id' => $data['group_id']);
		return $this->db->insert('auth_group_access', $gdata);
	}

	public function do_edit_handle($data, $uid)
	{
		if ($data['group_id']) {
			$this->db->where(array('uid' => $uid));
			$this->db->update('auth_group_access', array('group_id' => $data['group_id']));
		}
		
		// $this->db->set("username <> admin");
		$this->db->where(array('user_id' => $uid));
		return $this->db->update('ch_user', $data);
	}

	public function do_delete($uid, $sid)
	{
		if (! empty($uid) and isset($sid)) {
			if ($sid == '0') {
				$data['status'] = 1;
			}
			if ($sid == '1') {
				$data['status'] = 0;
			}
			
			$this->db->where(array('user_id' => $uid));
			return $this->db->update('ch_user', $data);
		}
	}
}
	