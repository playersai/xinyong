<?php

class model_online_services extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	function get_apage_by_catid($catid)
	{
		$query = $this->db->query('select * from ch_apage where cat_id=' . $catid);
		return $query->result();
	}

	function get_category_by_parentid($parentid, $limit)
	{
		$query = $this->db->query('select * from ch_category where status=1 and parent_id=' . $parentid . ' order by sort desc, cat_id limit ' . $limit);
		return $query->result();
	}

	function get_legal_apage($limit = NULL)
	{
		if ($limit == NULL) {
			$query = $this->db->query('select * from ch_category c join ch_apage a on c.cat_id=a.cat_id where c.status=1 and c.parent_id = 86 order by sort desc, c.cat_id');
			return $query->result();
		}
		$query = $this->db->query('select * from ch_category c join ch_apage a on c.cat_id=a.cat_id where c.status=1 and c.parent_id = 86' . ' order by sort desc, c.cat_id limit ' . $limit);
		return $query->result();
	}
}