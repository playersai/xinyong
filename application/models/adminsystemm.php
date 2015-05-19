<?php

class Adminsystemm extends CI_Model
{

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function get_website_info()
	{
		$query = $this->db->get('ch_website_info');
		return $result = $query->result();
	}

	public function do_save_handle($data)
	{
		if (is_array($data)) {
			$this->db->truncate('ch_website_info');
			foreach ($data as $key => $val) {
				$data2 = array('ch_name' => $key,'ch_value' => $val);
				$result = $this->db->insert('ch_website_info', $data2);
			}
			
			return $result;
		}
	}

	public function get_user_group()
	{
		$query = $this->db->get('ch_user_group');
		$result = $query->result();
		return $result;
	}

	public function get_user_group_by_groupid($group_id = NULL)
	{
		$this->db->where(array(group_id => $group_id));
		$query = $this->db->get('ch_user_group');
		$result = $query->result();
		return $result;
	}

	public function get_toDoList($limit = NULL,$a_title,$a_date,$a_user)
	{
		 $a_date2=$a_date+86399;
		 $where='';
		  if(!empty($a_date)){
			 $where ="AND (a.rel_date>=".$a_date." AND a.rel_date<=".$a_date2.")";
		 } 
		$sql = "select a.*,c.name from (
					SELECT aid as id,cat_id,title,addtime,rel_date,add_user,status,stats,2 as type_id FROM ch_articles WHERE status = 0
					UNION ALL
					SELECT f_id,cat_id,title,addtime,rel_date,add_user,status,stats,6 FROM ch_feedback WHERE status = 0
					UNION ALL
					SELECT photo_id,cat_id,title,addtime,rel_date,add_user,status,stats,3 FROM ch_photos WHERE status = 0
					UNION ALL 
					SELECT vote_id,cat_id,title,addtime,rel_date,add_user,status,stats,5 FROM ch_vote_list WHERE status = 0
					UNION ALL
					SELECT aid,cat_id,title,addtime,rel_date,add_user,status,stats,7 FROM ch_topics WHERE status = 0
					UNION ALL 
					SELECT vid,cat_id,title,addtime,rel_date,add_user,status,stats,4 FROM ch_vedio WHERE status = 0
				) a 
				LEFT JOIN ch_category c on c.cat_id = a.cat_id where  (a.title like '%$a_title%' or '$a_title'='')
				".$where."
				AND (a.add_user like '%$a_user%' or '$a_user'='')
				order by a.addtime desc ";
		
		if (isset($limit)) {
			$sql .= "limit $limit";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_addIinfo($username, $group_id, $limit_arr)
	{
		$sql = "SELECT c1.`name` as name1 ,c2.`name` as name2 , c3.`name` as name3 ,a.add_user,u.nickname,ug.name as dept,count(a.id) as count_id FROM (
					SELECT aid as id,cat_id,add_user FROM ch_articles
					UNION ALL
					SELECT f_id,cat_id,add_user FROM ch_feedback
					UNION ALL
					SELECT photo_id,cat_id,add_user FROM ch_photos
					UNION ALL 
					SELECT vote_id,cat_id,add_user FROM ch_vote_list
					UNION ALL
					SELECT aid,cat_id,add_user FROM ch_topics
					UNION ALL 
					SELECT vid,cat_id,add_user FROM ch_vedio
				) a
				LEFT JOIN ch_category c3 on c3.cat_id = a.cat_id 
				LEFT JOIN ch_category c2 on c2.cat_id = c3.parent_id 
				LEFT JOIN ch_category c1 on c1.cat_id = c2.parent_id 
				LEFT JOIN ch_user u on u.username = a.add_user
				LEFT JOIN ch_user_group ug on ug.group_id = u.group_id
				WHERE (ug.group_id='$group_id' or '$group_id'='' )
				AND (u.nickname like '%$username%' or '$username'='')
				GROUP BY c3.`name`, a.add_user, u.nickname
				ORDER BY count_id DESC, name1, name2, name3 ";
		
		if (isset($limit_arr) && ! empty($limit_arr)) {
			$sql .= "limit $limit_arr[0],$limit_arr[1]";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
}
	