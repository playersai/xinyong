<?php

class Index_interactionm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_feedback_content($f_id, $_limits)
	{
		$q = $this->db->query("select a.*,b.name from `ch_feedback_content` a ,`ch_feedback_type` b where a.type_id=b.type_id and a.f_id='$f_id' order by a.f_c_id desc limit $_limits[0],$_limits[1]");
		return $q->result();
	}

	public function get_feedback_content2($f_id, $_limits)
	{
		/* 前台交流互动调取已办结投诉信息 */
		$q = $this->db->query("select a.*,b.name from `ch_feedback_content` a ,`ch_feedback_type` b where a.type_id=b.type_id and a.status=2 and a.f_id='$f_id' order by a.f_c_id desc limit $_limits[0],$_limits[1]");
		return $q->result();
	}

	public function get_feedback_content3($where, $limit, $offset)
	{
		if ($offset == null) $offset = 0;
		
		if ($limit == NULL) {
			$query = $this->db->query("select * from ch_feedback_content join ch_feedback_type on ch_feedback_type.type_id = ch_feedback_content.type_id where " . $where . " order by f_c_id desc");
			return $query;
		}
		
		$query = $this->db->query("select * from ch_feedback_content join ch_feedback_type on ch_feedback_type.type_id = ch_feedback_content.type_id where " . $where . " order by f_c_id desc limit " . $offset . "," . $limit);
		return $query;
	}

	public function get_fb_nums_by_catid($cat_id)
	{
		$this->db->where(array('cat_id' => $cat_id,'status' => 1));
		return $this->db->count_all_results('ch_feedback');
	}

	public function get_article_nums_by_catid($cat_id)
	{
		$this->db->where(array('cat_id' => $cat_id,'status' => 1));
		return $this->db->count_all_results('ch_articles');
	}

	public function get_feedback_c_nums_by_fid($fid)
	
	{
		$this->db->where(array('f_id' => $fid));
		return $this->db->count_all_results('ch_feedback_content');
	}

	public function get_feedback_c_nums_by_fid2($fid)
	
	{
		/* 前台交流互动首页调取已完结投诉信息 */
		$this->db->where(array('f_id' => $fid,'status' => 2));
		return $this->db->count_all_results('ch_feedback_content');
	}

	public function get_fb_content_by_fcid($fcid)
	{
		$this->db->where(array('f_c_id' => $fcid,'status' => 1));
		return $this->db->get('ch_feedback_content')->result();
	}

	public function get_fb_content_by_fcid2($fcid)
	{
		$this->db->where(array('f_c_id' => $fcid,'status' => 2));
		return $this->db->get('ch_feedback_content')->result();
	}

	public function get_feedback_type()
	{
		/* 获取feedback_type */
		$q = $this->db->query("select * from `ch_feedback_type`  order by sort desc");
		return $q->result();
	}

	public function get_feedback_by_catid($cat_id)
	{
		return $this->db->get_where('ch_feedback', array('cat_id' => $cat_id,'status' => 1))->result();
	}

	public function get_feedback_by_catid_limit($cat_id, $limit)
	{
		$q = $this->db->query("select * from ch_feedback where cat_id='$cat_id' and status=1 order by sort desc,f_id desc limit $limit");
		return $q->result();
	}

	public function get_article_by_catid_limit($cat_id, $limit)
	
	{
		$q = $this->db->query("select * from ch_articles where cat_id='$cat_id' and status=1 order by sort desc, aid desc limit $limit");
		return $q->result();
	}

	public function get_vote_by_catid($cat_id)
	{
		return $this->db->get_where('ch_vote_list', array('cat_id' => $cat_id,'status' => 1))->result();
	}

	public function get_vote_by_catid_limit($cat_id, $limit)
	{
		$query = $this->db->query("select * from ch_vote_list where status=1 and cat_id='$cat_id' order by sort desc,vote_id desc limit $limit");
		return $query->result();
	}

	public function get_vote_nums_by_catid($cat_id)
	{
		$this->db->where(array('cat_id' => $cat_id,'status' => 1));
		return $this->db->count_all_results('ch_vote_list');
	}

	public function get_fc_new_handleid_num()
	{
		// 获取当天投诉ID的新4位流水
		$date = date('Y-m-d', time());
		$this->db->select_max('handle_id');
		$this->db->where(array('adddate' => "$date"));
		$result = $this->db->get('ch_feedback_content')->result();
		
		$handleid_num = $result[0]->handle_id;
		
		if ($handleid_num) {
			$handleid_num = intval(substr($handleid_num, - 4)) + 1;
		} else {
			$handleid_num = 1;
		}
		
		$handleid_num = sprintf("%04d", $handleid_num);
		return $handleid_num;
	}

	public function do_handle($data)
	{
		/* 我要投诉入库 */
		return $this->db->insert('ch_feedback_content', $data);
	}

	public function do_search_handle($where, $limit)
	{
		$q = $this->db->query("SELECT * FROM `ch_feedback_content` where $where limit " . $limit);
		return $q->result();
	}

	public function check_vote_user($where)
	{
		/* 检测同一IP 是否24小时内提交过投票 */
		$q = $this->db->query("select * from `ch_vote_user` where $where limit 10");
		return $q->result();
	}

	public function add_vote_user($data)
	{
		$this->db->insert("ch_vote_user", $data);
		return $this->db->insert_id();
	}

	public function do_add_vote_stats_handle($data)
	{
		return $this->db->insert("ch_vote_stats", $data);
	}

	public function do_add_vote_ch_vote_type3_stats_handle($data)
	{
		return $this->db->insert("ch_vote_type3_stats", $data);
	}

	public function do_feedback_handle($data)
	{
		return $this->db->insert("ch_feedback_content", $data);
	}

	public function get_vote_by_voteid($vote_id)
	{
		return $this->db->get_where('vote_list', array('vote_id' => $vote_id))->result();
	}

	public function get_vote_stats_by_voteid($vote_id)
	{
		$result = $this->db->get_where('ch_vote_stats', array('vote_id' => $vote_id))->result();
  	 
	    $qnum=array();
		$opnum=array();
		foreach ($result as $key=>$val) {
			
			if( $result[$key]->q_id == $val->q_id ){
			    $qnum[$val->q_id]++;
			}
            if( $result[$key]->op_id == $val->op_id ){
				$opnum[$val->q_id][$val->op_id]++;
			}
            
			//$qnum[$val->q_id] = $this->db->query("SELECT count(q_id) as qid_sam FROM `ch_vote_stats` where  q_id=$val->q_id")->result();
			//$opnum[$val->q_id][$val->op_id] = $this->db->query("SELECT count(*) as op_sam FROM `ch_vote_stats` where  op_id=$val->op_id")->result();
		}
	 //$opnum=(object)$opnum;
	  
		return array('qnums' => $qnum,'opnums' => $opnum);
	}

	public function get_feedback_reply_by_fcid($fcid)
	{
		return $this->db->get_where('ch_feedback_reply', array('f_c_id' => $fcid))->result();
	}
}
	