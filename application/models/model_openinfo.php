<?php

class model_openinfo extends CI_Model
{

	function get_openList_by_parentid($parentid)
	{
		$query = $this->db->query('select * from ch_openinfo_set where parentid=' . $parentid);
		return $query->result();
	}

	function get_openJsonLink_by_id($id)
	{
		$query = $this->db->query('select link from ch_openinfo_set where id=' . $id);
		$result = $query->result();
		return $result[0];
	}

	function get_openDefaultid_by_id($id)
	{
		$query = $this->db->query('select defaultid from ch_openinfo_set where id=' . $id);
		$result = $query->result();
		return $result[0];
	}
	
	function get_openinfo_by_id($id)
	{
		$query = $this->db->query('select * from ch_openinfo_set where id=' . $id);
		$result = $query->result();
		return $result[0];
	}
}