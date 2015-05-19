<?php

class Index_landscapem extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_apage($cat_id)
	{
		$qc = $this->db->query("select * from `ch_category` where parent_id = (select a.cat_id from `ch_category` a,`ch_category` b where a.cat_id=b.parent_id and b.cat_id= $cat_id and a.status=1 ) order by sort desc");
		$data['cat'] = $qc->result();
		$q = $this->db->query("select * from `ch_apage` where status=1 and cat_id='$cat_id'");
		$data['a'] = $q->result();
		
		return $data;
	}

	public function get_apage_category_2_index()
	{
		$this->db->order_by('sort desc');
		$cat1 = $this->db->get_where('ch_category', array('cat_id' => 2))->result();
		$this->db->order_by('sort desc');
		$cat2 = $this->db->get_where('ch_category', array('parent_id' => 2))->result();
		
		foreach ($cat2 as $row_item) {
			$cat_query = $this->db->query("select * from ch_category where status=1 and `parent_id`=" . $row_item->cat_id . ' and cat_id!=11 order by sort desc limit 4');
			$cat3[$row_item->cat_id] = $cat_query->result();
		}
		
		return array('level1' => $cat1,'level2' => $cat2,'level3' => $cat3);
	}

	public function get_category_by_catid($cat_id)
	{
		return $this->db->get_where('ch_category', array('cat_id' => $cat_id))->result();
	}

	public function get_apage_category_2_view()
	{
		$cat2 = $this->db->get_where('ch_category', array('parent_id' => 2))->result();
		if (isset($cat2) and is_array($cat2)) {
			foreach ($cat2 as $c2val) {
				$catq = $this->db->query("select * from `ch_category` where status=1 and `parent_id`=" . $c2val->cat_id . ' order by sort limit 1');
				$cat3[$c2val->cat_id] = $catq->result();
			}
		}
		return array($cat2,$cat3);
	}

	public function get_photos($cat_id, $limit)
	{
		$q = $this->db->query("select * from `ch_photos` where cat_id='$cat_id' and status=1 order by photo_id desc limit $limit[0],$limit[1]");
		return $q->result();
	}

	public function get_photos_by_catid($cat_id)
	{
		$q = $this->db->query("select * from `ch_photos` where cat_id='$cat_id' and status=1");
		return count($q->result());
	}

	public function get_photos_thumb_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("select * from ch_photos p left join ch_photos_thumb pt on p.photo_id = pt.photo_id where cat_id='$cat_id' order by sort desc ,thumb_id desc limit $limit");
		return $q->result();
	}

	public function get_vedio_thumb_by_catid($cat_id, $limit)
	{
		$q = $this->db->query("select * from `ch_vedio` where cat_id='$cat_id' and status=1 order by vid desc limit $limit");
		return $q->result();
	}

	public function get_vedio_thumb_nums_by_catid($cat_id)
	{
		$q = $this->db->query("select * from `ch_vedio` where cat_id='$cat_id' and status=1");
		return count($q->result());
	}

	public function get_article_by_catid($cat_id, $limits)
	{
		$q = $this->db->query("select * from `ch_photos` where cat_id='$cat_id' order by photo_id desc limit $limit[0],$limit[1]");
		return $q->result();
	}

	public function get_article_nums_by_catid($cat_id)
	{
		$this->db->where(array('cat_id' => $cat_id,'status' => 1));
		return $this->db->count_all_results('ch_articles');
	}

	public function do_type2add_handle($data)
	{
		$this->db->set('title', $data['title']);
		$this->db->set('addtime', $data['addtime']);
		$this->db->set('rel_date', $data['rel_date']);
		$this->db->set('cat_id', $data['cat_id']);
		$this->db->set('content', $data['content'], false);
		return $this->db->insert('ch_articles');
	}

	public function get_left_nav()
	{
		// $this->db->order_by('sort desc');
		$left_nav = $this->db->get_where('ch_category', array('parent_id' => 2))->result();
		return $left_nav;
	}

	public function get_right_top_nav($parent_id)
	{
		$query = $this->db->query("select * from ch_category where parent_id=" . $parent_id . " order by sort desc");
		return $query->result();
	}
}
	