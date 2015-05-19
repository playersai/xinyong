<?php
/* --调查模型-- */
class Admin_feedbackm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_feedback_value()
	{
		/* 获取反馈填写项 */
		$this->db->order_by('sort desc');
		return $this->db->get('ch_feedback_value')->result();
	}

	public function get_feedback($cat_id = 0, $limits = null,$a_title,$a_date,$a_user,$a_status)
	{ 
		/* 按分类CAT_ID获取文章 */
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_feedback')->result();
		}
		
		if ($cat_id !== '0' and $limits !== null) {
			 $a_date2=$a_date+86399;
			 $where='';
			  if(!empty($a_date)){
			     $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			 } 
			$q = $this->db->query("select * from `ch_feedback` where (status='$a_status' or '$a_status'='' )
			AND (title like '%$a_title%' or '$a_title'='')
			".$where."
			AND (add_user like '%$a_user%' or '$a_user'='')
			AND cat_id=$cat_id order by sort desc,rel_date desc,f_id desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function get_feedback_content($f_id = 0, $limits = null)
	{
		/* 我要投诉 留言反馈内容数据调取 */
		if ($f_id == '0' and $limits == null) {
			return $this->db->get('ch_feedback_content')->result();
		}
		if ($f_id != '0' and $limits != null) {
			$q = $this->db->query("select a.*,b.name from `ch_feedback_content` a,ch_feedback_type b where a.f_id=$f_id and a.type_id=b.type_id order by a.status asc,a.f_c_id desc limit $limits");
			return $q->result();
		}
	}

	public function get_feedback_content2($f_id = 0, $limits = null)
	{
		/* 非我要投诉 留言反馈内容数据调取 */
		if ($f_id != '0' and $limits != null) {
			$q = $this->db->query("select * from `ch_feedback_content` where f_id=$f_id  order by f_c_id desc limit $limits");
			return $q->result();
		}
	}
	
	public function get_feedback_content3( $limits = null)
	{
		$q = $this->db->query("select fc.*,f.title as f_title from `ch_feedback_content` AS fc LEFT JOIN `ch_feedback` AS f ON fc.f_id=f.f_id where fc.status=0 AND  fc.f_id NOT IN (0,1) order by f_c_id desc limit $limits");
		return $q->result();
	 
	}

	public function get_feedback_content_by_fcid($fcid, $where = null)
	{
		$q = $this->db->query("select a.*,b.name from `ch_feedback_content` a,ch_feedback_type b where a.f_c_id=$fcid and a.type_id=b.type_id $where");
		return $q->result();
	}

	public function get_feedback_content_by_fcid2($fcid, $where = null)
	{
		$q = $this->db->query("select fc.*,f.title as f_title from `ch_feedback_content` AS fc LEFT JOIN `ch_feedback` AS f ON fc.f_id=f.f_id where fc.f_c_id=$fcid $where");
		return $q->result();
	}

	public function get_user_group()
	{
		$this->db->where(array('status' => 1));
		return $this->db->get('ch_user')->result();
	}

	public function get_feedback_reply_by_fcid($fcid)
	{
		return $this->db->get_where('ch_feedback_reply', array('f_c_id' => $fcid))->result();
	}

	public function do_handle_user($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_feedback_content', $data);
	}

	public function do_update_fc_status($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_feedback_content', $data);
	}

	public function do_reply_handle($data)
	{
		$ist = $this->db->insert("ch_feedback_reply", $data);
		if ($ist) {
			$result = $this->db->update('ch_feedback_content', array('status' => 1), array('f_c_id' => $data['f_c_id']));
		}
		return $result;
	}

	public function do_update_reply_handle($data, $where, $f_c_id, $status = 1)
	{
		$qr = $this->db->get_where('ch_feedback_reply', $where);
		if ($qr->result()) {
			$this->db->where($where);
			$upt = $this->db->update('ch_feedback_reply', $data);
		} else {
			$data['f_c_id'] = $f_c_id;
			$upt = $this->db->insert('ch_feedback_reply', $data);
		}
		if ($upt) {
			$result = $this->db->update('ch_feedback_content', array('status' => $status), array('f_c_id' => $f_c_id));
		}
		return $result;
	}

	public function do_add_handle($data)
	{
		return $this->db->insert('ch_feedback', $data);
	}

	public function do_edit_handle($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('ch_feedback', $data);
	}

	public function get_feedback_nums($cat_id = 0,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0') {
			
			return $this->db->count_all_results('ch_feedback');
		}
		if ($cat_id !== '0') {
			$a_date2=$a_date+86399;
			$where='';
			if(!empty($a_date)){
			   $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			} 
			$q = $this->db->query("select count(*) as count from `ch_feedback`  
				WHERE (status='$a_status' or '$a_status'='' )
				AND (title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (add_user like '%$a_user%' or '$a_user'='')
				AND cat_id=$cat_id ") ;

			$count=$q->result();

			return (int)$count[0]->count;
			//$this->db->where(array('cat_id' => $cat_id));
			//$result = $this->db->count_all_results('ch_feedback');
			//return $result;
		}
	}

	public function get_feedback_content_nums($f_id = 0)
	{
		if ($f_id == '0') {
			return $this->db->count_all_results('ch_feedback_content');
		}
		
		if ($f_id != '0') {
			$this->db->where(array('f_id' => $f_id));
			return $this->db->count_all_results('ch_feedback_content');
		}
	}

	public function get_feedback_by_fid($vid = 0)
	{
		if ($vid !== '0') {
			
			$q = $this->db->get_where("ch_feedback", array('f_id' => $vid));
			return $q->result();
		}
	}

	public function do_delete_handle($id)
	{
		$this->db->where(array('f_id' => $id));
		return $this->db->delete('ch_feedback');
	}

	public function do_result_delete_handle($_where)
	{
		$this->db->where($_where);
		return $this->db->delete('ch_feedback_content');
	}

	public function do_result_search($where, $limits = 10)
	{
		// $query = $this->db->query("select * from `ch_feedback_content` where $where order by f_c_id desc limit " . $limits);
		// $query = $this->db->query("select a.*,b.name from `ch_feedback_content` a,ch_feedback_type b where a.f_id=1 and a.type_id=b.type_id order by a.status asc,a.f_c_id desc limit $limits");
		$query = $this->db->query("select a.*,b.name from ch_feedback_content a left join ch_feedback_type b on a.type_id=b.type_id where $where order by a.status asc,a.f_c_id desc limit $limits");
		return $query->result();
	}

	public function do_result_search_nums($where)
	{
		$query = $this->db->query("select f_c_id from ch_feedback_content a where $where");
		return $query->num_rows();
	}

	public function get_fc_by_handle_user($where, $limits)
	{
		$q = $this->db->query("select * from `ch_feedback_content` where $where order by f_c_id desc limit " . $limits);
		return $q->result();
	}
}
	