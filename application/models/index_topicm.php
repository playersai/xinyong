<?php

class Index_topicm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_topic_by_catid($cat_id)
	{
		if (! empty($cat_id)) {
			// $q = $this->db->query("select * from `ch_category` where cat_type_id=7 and cat_id='$cat_id'");
			$q = $this->db->query("select * from `ch_category` where cat_id='$cat_id'");
			return $q->result();
		}
	}

	public function get_topic_by_son_catid($cat_id)
	{
		if (! empty($cat_id)) {
			// $q = $this->db->query("select b.* from `ch_category` a , `ch_category` b where a.cat_type_id=7 and a.parent_id=b.cat_id and a.cat_id='$cat_id'");
			$q = $this->db->query("select b.* from `ch_category` a , `ch_category` b where a.parent_id=b.cat_id and a.cat_id='$cat_id'");
			return $q->result();
		}
	}

	public function get_topic_nav_by_catid($cat_id)
	{
		if (! empty($cat_id)) {
			// $q = $this->db->query("select * from `ch_category` where cat_type_id=7 and parent_id='$cat_id' order by sort desc");
			$q = $this->db->query("select * from `ch_category` where parent_id='$cat_id' order by sort desc,addtime desc");
			return $q->result();
		}
	}

	public function get_article_nums($cat_id = 0)
	{
		if ($cat_id == '0') {
			$this->db->where(array('status' => 1));
			return $this->db->count_all_results('ch_topics');
		}
		if ($cat_id !== '0') {
			$this->db->where(array('status' => 1));
			$this->db->where(array('cat_id' => $cat_id));
			return $this->db->count_all_results('ch_topics');
		}
	}

	public function get_topic($cat_id = 0, $limits = null)
	{
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_topics')->result();
		}
		if ($cat_id !== '0' and $limits !== null) {
			$q = $this->db->query("select a.*,b.name from `ch_topics` a,ch_category b where a.status=1 and a.cat_id=$cat_id and a.cat_id=b.cat_id order by a.sort desc,a.rel_date desc,a.aid desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function get_article_by_aid($aid = 0)
	{
		if ($aid !== '0') {
			
			$q = $this->db->get_where("ch_topics", array('aid' => $aid));
			
			return $q->result();
		}
	}

	public function get_index_thumb_article($limit, $cat_id)
	{ 
		/* 首页幻灯图文 index silde pic */
		if (isset($cat_id)) {
			$q = $this->db->query("SELECT *,t.is_redirect as is_re,t.redirect_url as re_url FROM `ch_topics` AS t LEFT JOIN `ch_category` AS c ON t.cat_id=c.cat_id where t.status=1 AND t.thumb<>'' and t.cat_id in($cat_id) ORDER BY   c.sort  DESC, t.sort  DESC, t.rel_date  DESC, t.aid   DESC limit $limit");
			return $q->result();
		}
	}

	public function get_topic_thumbs($limit, $cat_id)
	{
		if (isset($cat_id)) {
			$q = $this->db->query("SELECT * FROM `ch_topics_thumb` where thumb_path<>'' and cat_id in($cat_id) group by aid ORDER BY `aid`  DESC limit $limit");
			return $q->result();
		}
	}

	public function get_thumbs_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("SELECT * FROM ch_photos join ch_photos_thumb on ch_photos.photo_id = ch_photos_thumb.photo_id where cat_id=$cat_id ORDER BY ch_photos_thumb.sort DESC limit $limit");
		return $q->result();
	}
}
	