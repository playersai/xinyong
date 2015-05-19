<?php

class Admin_articlem extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_article($cat_id = 0, $limits = null,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0' and $limits == null) {
			return $this->db->get('ch_articles')->result();
		}
		if ($cat_id !== '0' and $limits !== null) {
			 $a_date2=$a_date+86399;
			 $where='';
			  if(!empty($a_date)){
			     $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			 } 
			$q = $this->db->query("select * from `ch_articles`  
			WHERE (status='$a_status' or '$a_status'='' )
			AND (title like '%$a_title%' or '$a_title'='')
			".$where."
			AND (add_user like '%$a_user%' or '$a_user'='')
			AND cat_id=$cat_id order by sort desc,aid desc limit $limits[0],$limits[1]");
			return $q->result();
		}
	}

	public function get_article_by_where($where, $limits)
	{
		$query = $this->db->query("select * from ch_articles where $where order by settop desc,aid desc limit $limits[0],$limits[1]");
		return $query->result();
	}

	function get_acticle_thumb_by_aid($aid)
	{
		$this->db->where(array('aid' => $aid));
		$query = $this->db->get('ch_articles_thumb');
		return $query->result();
	}

	function get_acticle_thumb_by_thumbid($thumbid)
	{
		$this->db->where(array('thumb_id' => $thumbid));
		$query = $this->db->get('ch_articles_thumb');
		return $query->result();
	}

	public function get_article_nums($cat_id = 0,$a_title,$a_date,$a_user,$a_status)
	{
		if ($cat_id == '0') {
			return $this->db->count_all_results('ch_articles');
		}
		if ($cat_id !== '0') {
			 $a_date2=$a_date+86399;
			  $where='';
			 if(!empty($a_date)){
			     $where ="AND (rel_date>=".$a_date." AND rel_date<=".$a_date2.")";
			 } 
			//$this->db->where(array('cat_id' => $cat_id));
            $q = $this->db->query("select count(*) as count from `ch_articles`  
			WHERE (status='$a_status' or '$a_status'='' )
			AND (title like '%$a_title%' or '$a_title'='')
			".$where."
			AND (add_user like '%$a_user%' or '$a_user'='')
			AND cat_id=$cat_id ") ;
	 
            $count=$q->result();
			 
			return (int)$count[0]->count;
		    //$this->db->count_all_results('ch_articles');
		}
	}

	public function get_article_by_aid($aid)
	{
		$q = $this->db->get_where("ch_articles", array('aid' => $aid));
		return $q->result();
	}

	public function update_article_thumb($thumb_id, $data)
	{
		$this->db->where(array('thumb_id' => $thumb_id));
		return $this->db->update('ch_articles_thumb', $data);
	}

	public function delete_article_thumb($thumb_id)
	{
		$this->db->where(array('thumb_id' => $thumb_id));
		return $this->db->delete('ch_articles_thumb');
	}

	public function do_add_handle($data)
	{
		$result = $this->db->insert('ch_articles', $data);
		 
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

	public function do_add_thumb_handle($data)
	{
		$result = $this->db->insert('ch_articles_thumb', $data);
		return $result;
	}

	public function do_edit_handle($data, $aid)
	{
		$this->db->where(array('aid' => $aid));
		return $this->db->update('ch_articles', $data);
	}

	public function do_update_category_nums($where, $act = 0)
	{
		if ($act == '0') {
			$this->db->set('nums', 'nums-1', FALSE);
		}
		if ($act == '1') {
			$this->db->set('nums', 'nums+1', FALSE);
		}
		$this->db->where($where);
		return $this->db->update('ch_category');
	}

	public function do_update_category_daishennums($where, $act = 0)
	{
		if ($act == '0') {
			$this->db->set('daishen_nums', 'daishen_nums-1', FALSE);
		}
		if ($act == '1') {
			$this->db->set('daishen_nums', 'daishen_nums+1', FALSE);
		}
		$this->db->where($where);
		return $this->db->update('ch_category');
	}

	public function do_delete($aid, $sid = null)
	{
		if (! empty($aid)) {
			
			$this->db->where(array('aid' => $aid));
			return $this->db->delete('ch_articles');
		}
	}
	public function do_delete_arr($id_val,$aids, $table)
	{    
		if (!empty($aids)&&!empty($table)) {
			$aids=$this->dowith_sql($aids); 
			$aids=str_replace("-",",",rtrim($aids,'-')); 
			$this->db->where_in($id_val, $aids);
			return $this->db->delete($table);
		}
	}

	public function do_update_arr($id_val,$aids, $table,$status)
	{    
		if (!empty($aids)&&!empty($table)) {
			$aids=$this->dowith_sql($aids); 
			$aids=str_replace("-",",",rtrim($aids,'-'));
			$aids_arr=explode(",",$aids); 

			foreach($aids_arr as $val){
			    if ($status == '0') {
					$this->db->set('status', '0', FALSE);
				}
				if ($status == '1') {
					$this->db->set('status', '1', FALSE);
				}
				$this->db->where_in($id_val, $val); 
				$this->db->update($table);
			}
			return true;
		}
	}
	public function dowith_sql($str)
   {
	   $str = str_replace("and","",$str);
	   $str = str_replace("execute","",$str);
	   $str = str_replace("update","",$str);
	   $str = str_replace("count","",$str);
	   $str = str_replace("chr","",$str);
	   $str = str_replace("mid","",$str);
	   $str = str_replace("master","",$str);
	   $str = str_replace("truncate","",$str);
	   $str = str_replace("char","",$str);
	   $str = str_replace("declare","",$str);
	   $str = str_replace("select","",$str);
	   $str = str_replace("create","",$str);
	   $str = str_replace("delete","",$str);
	   $str = str_replace("insert","",$str);
	   $str = str_replace("'","",$str);
	   $str = str_replace("\"","",$str);
	   $str = str_replace(" ","",$str);
	   $str = str_replace("or","",$str);
	   $str = str_replace("=","",$str);
	   $str = str_replace("%20","",$str);
	   //echo $str;
	   return $str;
	}
}
	