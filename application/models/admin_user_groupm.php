<?php 
/*--用户管理模型--*/
class Admin_user_groupm extends CI_Model {

    function __construct()
    {
		$this->load->database();
        parent::__construct();
    }
	
	public function get_user_group($user_group,$s_status,$_groupid=null)
	{
		if($_groupid==null)
		{   
			$sql = "SELECT * FROM  ch_user_group 
				WHERE (name like '%$user_group%' or '$user_group'='')
				AND (status like '%$s_status%' or '$s_status'='')
				order by group_id desc ";
			$query = $this->db->query($sql);
		    return $query->result();
		}else
		{
			$this->db->from('user_group');
			$this->db->where('group_id',$_groupid);
			return $this->db->get()->row_array();
		}
	}
	
	public function do_add_handle($data)
	{
		
		return $this->db->insert('user_group',$data);
	
	}
	public function do_edit_handle($data, $uid)
	{
		$this->db->where(array('group_id'=>$uid));
		return $this->db->update('ch_user_group',$data);
	}
	
	
	public function do_delete($uid)
	{
		if(!empty($uid)){

			return $this->db->delete('user_group', array('group_id' => $uid));

		}		

	}
	
	
}
	