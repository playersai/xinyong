<?php

class model_stats extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}
	
	// 文章
	function stats_addonce_act($aid)
	{
		$this->db->select('stats');
		$this->db->where(array('aid' => $aid));
		$result = $this->db->get('ch_articles')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('aid', $aid);
			$this->db->update('ch_articles', $data);
			return true;
		}
		return false;
	}
	
	// 单页
	function stats_addonce_page($cat_id)
	{
		$this->db->select('stats');
		$this->db->where(array('cat_id' => $cat_id));
		$result = $this->db->get('ch_apage')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('cat_id', $cat_id);
			$this->db->update('ch_apage', $data);
			return true;
		}
		return false;
	}
	
	// 网上调查
	function stats_addonce_vote($vote_id)
	{
		$this->db->select('stats');
		$this->db->where(array('vote_id' => $vote_id));
		$result = $this->db->get('ch_vote_list')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('vote_id', $vote_id);
			$this->db->update('ch_vote_list', $data);
			return true;
		}
		return false;
	}
	
	// 网上征集
	function stats_addonce_feedback($f_id)
	{
		$this->db->select('stats');
		$this->db->where(array('f_id' => $f_id));
		$result = $this->db->get('ch_feedback')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('f_id', $f_id);
			$this->db->update('ch_feedback', $data);
			return true;
		}
		return false;
	}
	
	// 图片集
	function stats_addonce_photo($photo_id)
	{
		$this->db->select('stats');
		$this->db->where(array('photo_id' => $photo_id));
		$result = $this->db->get('ch_photos')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('photo_id', $photo_id);
			$this->db->update('ch_photos', $data);
			return true;
		}
		return false;
	}
	
	// 视频集
	function stats_addonce_video($video_id)
	{
		$this->db->select('stats');
		$this->db->where(array('vid' => $video_id));
		$result = $this->db->get('ch_vedio')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('vid', $video_id);
			$this->db->update('ch_vedio', $data);
			return true;
		}
		return false;
	}
	
	// 专题集
	function stats_addonce_topic($aid)
	{
		$this->db->select('stats');
		$this->db->where(array('aid' => $aid));
		$result = $this->db->get('ch_topics')->result();
		$stats = $result[0]->stats;
		
		if ($stats != "" && $stats != null) {
			$data['stats'] = intval($stats) + 1;
			$this->db->where('aid', $aid);
			$this->db->update('ch_topics', $data);
			return true;
		}
		return false;
	}
}