<?php

class model_zxsx extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	function get_article_count($catid)
	{
		$this->db->where(array('cat_id' => $catid,'status' => 1));
		return $this->db->count_all_results('ch_articles');
	}

	function get_article_limitPage($catid, $limit, $offset)
	{
		if ($offset == null) $offset = 0;
		
		$query = $this->db->query('select * from ch_articles where status=1 and cat_id=' . $catid . ' order by sort desc,rel_date desc limit ' . $offset . ',' . $limit);
		return $query->result();
	}

	function get_acticle_by_catid($catid, $limit)
	{
		if ($limit == NULL) {
			$query = $this->db->query('select * from ch_articles where status=1 and cat_id=' . $catid . ' order by sort desc,aid desc');
			return $query->result();
		}
		$query = $this->db->query('select * from ch_articles where status=1 and cat_id=' . $catid . ' order by sort desc,aid desc limit ' . $limit);
		return $query->result();
	}

	function get_acticle_by_aid($aid)
	{
		$query = $this->db->query('select * from ch_articles where aid=' . $aid);
		return $query->result();
	}

	function get_acticle_thumb_by_aid($aid)
	{
		$this->db->where(array('aid' => $aid));
		$query = $this->db->get('ch_articles_thumb');
		return $query->result();
	}

	function get_apage_by_catid($catid)
	{
		$query = $this->db->query('select * from ch_apage where cat_id=' . $catid);
		return $query->result();
	}

	function get_category_by_catid($catid)
	{
		$query = $this->db->query('select cat_id,name from ch_category where cat_id=' . $catid);
		return $query->result();
	}

	function get_category_by_parentid($parentid, $limit = NULL)
	{
		if ($limit == NULL) {
			$query = $this->db->query('select * from ch_category where parent_id=' . $parentid . ' order by cat_id');
			return $query->result();
		}
		$query = $this->db->query('select * from ch_category where parent_id=' . $parentid . ' order by cat_id limit ' . $limit);
		return $query->result();
	}

	function get_video_count($catid)
	{
		$this->db->where(array('cat_id' => $catid));
		return $this->db->count_all_results('ch_vedio');
	}

	function get_video_limitPage($catid, $limit, $offset)
	{
		if ($offset == null) $offset = 0;
		
		$query = $this->db->query('select * from ch_vedio where cat_id=' . $catid . ' order by sort desc,vid desc limit ' . $offset . ',' . $limit);
		return $query->result();
	}
	
	function get_guanyu()
	{
		$query = $this->db->query('select cat_id,title,content,status from ch_articles where cat_id=225 order by sort asc,aid asc limit 0,12');
		return $query->result();
	}
}