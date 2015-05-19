<?php

class Admin_votem extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_vote($cat_id = 0, $limits = null,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_vote_list')->result();
		}
		
		if ($cat_id != '0' and $limits != null) {
			 $a_date2=$a_date+86399;
			 $where='';
			  if(!empty($a_date)){
			     $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			 } 
			$q = $this->db->query("select * from ch_vote_list where (status='$a_status' or '$a_status'='' )
			AND (title like '%$a_title%' or '$a_title'='')
			".$where."
			AND (add_user like '%$a_user%' or '$a_user'='')
			AND cat_id=$cat_id order by sort desc,vote_id desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function get_vote_nums($cat_id = 0,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0') {
			
			return $this->db->count_all_results('ch_vote_list');
		}
		if ($cat_id !== '0') {
			$a_date2=$a_date+86399;
			$where='';
			if(!empty($a_date)){
			   $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			} 
			$q = $this->db->query("select count(*) as count from `ch_vote_list`  
				WHERE (status='$a_status' or '$a_status'='' )
				AND (title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (add_user like '%$a_user%' or '$a_user'='')
				AND cat_id=$cat_id ") ;

			$count=$q->result();

			return (int)$count[0]->count;
			//$this->db->where(array('cat_id' => $cat_id));
			//$result = $this->db->count_all_results('ch_vote_list');
			//return $result;
		}
	}

	public function get_vote_by_voteid($vid = 0)
	{
		if ($vid !== '0') {
			$q = $this->db->get_where("ch_vote_list", array('vote_id' => $vid));
			return $q->result();
		}
	}

	public function do_add_handle($data)
	{
		$result = $this->db->insert('ch_vote_list', $data);
		
		if ($result) {
			$this->db->set('nums', 'nums+1', FALSE);
			if ($data['status'] == '0') {
				$this->db->set('daishen_nums', 'daishen_nums+1', FALSE);
			}
			$this->db->where('cat_id', $data['cat_id']);
			$this->db->update('ch_category');
		}
		return $result;
	}

	public function do_edit_handle($data, $vid)
	{
		$this->db->where(array('vote_id' => $vid));
		return $this->db->update('ch_vote_list', $data);
	}

	public function do_delete_handle($vote_id)
	{
		$query = $this->db->query("select q_id from ch_vote_question where vote_id='$vote_id'");
		$rows = $query->result();
		
		$result = $this->db->delete('ch_vote_list', array('vote_id' => $vote_id));
		
		if ($result and is_array($rows)) {
			foreach ($rows as $row_item) {
				$this->db->delete('ch_vote_options', array('q_id' => $row_item->q_id));
			}
			$this->db->delete('ch_vote_question', array('vote_id' => $vote_id));
		}
		return $result;
	}

	public function do_add_question_handle($data)
	{
		$this->db->insert('ch_vote_question', $data);
		$q_id = $this->db->insert_id();
		$this->db->set('nums', 'nums+1', FALSE);
		$this->db->where(array('vote_id' => $data['vote_id']));
		$this->db->update('ch_vote_list');
		return $q_id;
	}

	public function do_edit_question_handle($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_vote_question', $data);
	}

	public function do_add_options_handle($data)
	{
		$this->db->insert('ch_vote_options', $data);
		$this->db->set('nums', 'nums+1', FALSE);
		$this->db->where(array('q_id' => $data['q_id']));
		return $this->db->update('ch_vote_question');
	}

	public function get_question_options_by_vid($vote_id)
	{
		$question_rows = $this->db->query("select * from ch_vote_question where vote_id='$vote_id'")->result();
		
		$option_rows = array();
		foreach ($question_rows as $qval) {
			$option_rows[$qval->q_id] = $this->db->query("select * from ch_vote_options where q_id='$qval->q_id' order by sort desc")->result();
		}
		return array($question_rows,$option_rows);
	}

	public function get_question_by_qid($_qid)
	{
		$q = $this->db->get_where('ch_vote_question', array('q_id' => $_qid));
		return $q->result();
	}

	public function get_options_by_qid($_qid)
	{
		$this->db->order_by('sort desc,op_id asc');
		$q = $this->db->get_where('ch_vote_options', array('q_id' => $_qid));
		return $q->result();
	}

	public function do_edit_options_handle($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_vote_options', $data);
	}

	public function do_del_options($op_id)
	{
		return $this->db->delete('ch_vote_options', array('op_id' => $op_id));
	}

	public function do_del_question($q_id, $vote_id = null)
	{
		$result = $this->db->delete('ch_vote_question', array('q_id' => $q_id));
		if ($result) {
			
			if ($vote_id != NULL) {
				// $this->db->set('nums','nums-1',false);
				// $this->db->where('vote_id'=>$vote_id);
				// $this->db->update('ch_vote_list',$data);
				$q = $this->db->query("UPDATE `ch_vote_list` set nums=nums-1 where vote_id=" . $vote_id);
			}
			$results = $this->db->delete('ch_vote_options', array('q_id' => $q_id));
		}
		return $results;
	}
}
	