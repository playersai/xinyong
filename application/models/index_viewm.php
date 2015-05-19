<?php

class Index_viewm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_article_by_aid($aid, $cat_id)
	{
		$cats = array();
		$result = array();
		$catq = $this->db->query("select * from `ch_category` where cat_id in(select parent_id  FROM `ch_category` where 
			cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id))  union  select * from `ch_category` 
			where cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id) union  select * from `ch_category` where cat_id=$cat_id");
		$cats = $catq->result();
		$q = $this->db->query("select * from ch_articles where  status=1 and aid='$aid'");
		$result = $q->result();
		$thumbq = $this->db->query("select * from `ch_articles_thumb` where  aid='$aid' order by sort");
		$thumbs = $thumbq->result();

		return array('news' => $result,'cats' => $cats,'thumbs' => $thumbs);
	}

	public function get_vote_by_vid($vid, $cat_id)
	{
		$cats = array();
		$result = array();
		$catq = $this->db->query("select * from `ch_category` where cat_id in(select parent_id  FROM `ch_category` where 
			cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id))  union  select * from `ch_category` 
			where cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id) union  select * from `ch_category` where cat_id=$cat_id");
		$cats = $catq->result();
		$q = $this->db->query("select * from ch_vote_list where  status=1 and vote_id='$vid'");
		$result = $q->result();
		
		return array('votes' => $result,'cats' => $cats);
	}

	public function get_photo_by_photoid($photo_id)
	{
		$this->db->where(array('photo_id' => $photo_id));
		$photo = $this->db->get('ch_photos');
		$p_thumb = $this->db->query('select b.*,a.title,a.content as pcontent,a.addtime from ch_photos a,ch_photos_thumb b where a.status=1 and a.photo_id=b.photo_id and a.photo_id=' . $photo_id . ' order by sort desc,rel_date desc')->result();
		return array('photo' => $photo->result(),'p_thumb' => $p_thumb);
	}

	public function get_nav_locaiton($cat_id)
	{
		$catq = $this->db->query("select * from `ch_category` where cat_id in(select parent_id  FROM `ch_category` where 
			cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id))  union  select * from `ch_category` 
			where cat_id=(SELECT parent_id  FROM `ch_category` where cat_id=$cat_id) union  select * from `ch_category` where cat_id=$cat_id");
		return $cats = $catq->result();
	}

	public function get_vote_question_option_by_catid($vote_id)
	{
		$question = $this->db->query("select * from `ch_vote_question` where vote_id='$vote_id' ORDER BY 'sort' ASC ,'op_id' ASC");
		$qrows = $question->result();
		foreach ($qrows as $qval) {
			$rows['qt'][$qval->q_id] = $qval;
			$where[] = $qval->q_id;
		}
		
		if (is_array($where)) $_where = join(',', $where);
		if (isset($_where)) {
			$option = $this->db->query("select * from `ch_vote_options` where q_id in($_where) ORDER BY 'sort' ASC ,'op_id' ASC");
			$oprows = $option->result();
			foreach ($oprows as $opval) {
				$rows['op'][$opval->q_id][$opval->op_id] = $opval;
			}
		}
		
		return $rows;
	}

	public function get_feedback_by_fid($fid, $cat_id)
	{
		// $cats = array();
		// $result = array();
		$cats = $this->db->query(" select * from ch_category where cat_id in(select parent_id  FROM ch_category where " . " cat_id=(SELECT parent_id  FROM ch_category where cat_id=$cat_id))  union  select * from ch_category " . " where cat_id=(SELECT parent_id  FROM ch_category where cat_id=$cat_id) union select * from ch_category where cat_id=$cat_id")->result();
		$result = $this->db->query("select * from `ch_feedback` where status=1 and f_id='$fid'")->result();
		$select_value = $result[0]->select_value;
		
		if ($select_value) {
			$qfv = $this->db->query("select * from `ch_feedback_value` where  f_v_id in($select_value) order by sort desc");
			$fv = $qfv->result();
		}
		return array('feedback' => $result,'cats' => $cats,'fvrows' => $fv);
	}

	public function get_feedback_content_by_fid($fid, $limit)
	{
		$q = $this->db->query("select * from `ch_feedback_content` where f_id='$fid' and status!=0 order by f_c_id desc limit " . $limit);
		return $q->result();
	}

	public function get_feedback_content_nums_by_fid($where)
	{
		$this->db->where($where);
		return $this->db->count_all_results('ch_feedback_content');
	}

	public function get_article_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("select * from `ch_articles` where cat_id='$cat_id' and status=1 order by sort desc,rel_date desc, aid desc limit " . $limit);
		return $q->result();
	}

	public function get_topic_by_level($limit, $offset)
	{
		if ($limit == null) $limit = 0;
		$qeuery = $this->db->query("select * from `ch_category` where  status=1 and cat_type_id=7 and level=2 order by sort desc,addtime desc limit " . $limit . ',' . $offset);
		return $qeuery->result();
	}
	
	// public function get_topic_by_level($limit)
	// {
	// $q = $this->db->query("select * from `ch_category` where status=1 and cat_type_id=7 and level=2 order by cat_id desc limit " . $limit);
	// return $q->result();
	// }
	public function get_topic_by_level_nums()
	{
		$q = $this->db->query("select * from `ch_category` where  status=1 and cat_type_id=7 and level=2");
		return count($q->result());
	}

	public function get_vedio_by_vid($_vid)
	{
		$q = $this->db->query("select * from ch_vedio where status=1 and vid='$_vid'");
		return $q->result();
	}
}
	