<?php

class Index_homem extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_index_top($_table, $_where, $limits = null)
	{
		if (! empty($_table) and isset($limits)) {
			$query = $this->db->query("select * from $_table where index_top=1 and status=1 and $_where order by sort desc, aid desc limit " . $limits);
			return $query->result();
		}
	}

	public function get_index_article($_where, $limits = null)
	{
		if (! empty($_where) and isset($limits)) {
			$q = $this->db->query("select * from `ch_articles` where status=1 and $_where order by sort desc,rel_date desc,aid desc limit " . $limits);
			return $q->result();
		}
	}

	public function get_index_thumb_article($limit)
	{
		$q = $this->db->query("SELECT * FROM `ch_articles` where cat_id=5 and status=1 and thumb<>'' ORDER BY sort desc,rel_date desc,aid desc limit $limit");
		return $q->result();
	}

	public function get_article_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("SELECT * FROM ch_articles where status=1 and cat_id=$cat_id ORDER BY aid DESC limit $limit");
		return $q->result();
	}

	public function get_vote_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("SELECT * FROM `ch_vote_list` where cat_id='$cat_id' and status=1 ORDER BY sort DESC,vote_id DESC limit $limit");
		return $q->result();
	}

	public function get_feedback_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("SELECT * FROM ch_feedback where cat_id=$cat_id and status=1 ORDER BY sort DESC, f_id DESC limit $limit");
		return $q->result();
	}

	public function get_index_topic($limit)
	{
		$q = $this->db->query("SELECT * FROM ch_category where cat_thumb<>'' and cat_type_id=7 and status=1 and level=2 ORDER BY sort desc,cat_id DESC limit $limit");
		return $q->result();
	}

	public function get_cat_by_catid($catid)
	{
		$q = $this->db->query("SELECT * FROM `ch_category` where cat_id=$catid and status=1");
		return $q->result();
	}

	public function get_link($where = NULL, $limit = NULL)
	{
		if ($where != NULL) $where .= " and status=1";
		
		if ($limit == NULL) {
			$query = $this->db->query("select * from ch_link " . $where . " order by sort desc");
			return $query->result();
		}
		$query = $this->db->query("select * from ch_link " . $where . " order by sort desc" . " limit " . $limit);
		return $query->result();
	}
}
	