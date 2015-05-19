<?php 
/*--友情链接管理模型--*/
class Adminlinkm extends CI_Model {

    function __construct()
    {
		$this->load->database();
        parent::__construct();
    }
	
	
	
	public function get_link($status=null,$limits=null,$website_name,$l_status,$type_id)
	{
		if($status==null and $limits==null){
		
			$q=$this->db->query("SELECT * FROM `ch_link` 
			WHERE (status='$l_status' or '$l_status'='' )
			AND (type_id='$type_id' or '$type_id'='' )
			AND (website_name like '%$website_name%' or '$website_name'='')
			order by sort desc,link_id asc ");
  
			return  $q->result();
			 
		}
		if($status==null and $limits!==null)
		{ 
			 
			$limitstr=join(",",$limits); 
			$q=$this->db->query("SELECT * FROM `ch_link` 
			WHERE (status='$l_status' or '$l_status'='' )
			AND (type_id='$type_id' or '$type_id'='' )
			AND (add_user like '%$add_user%' or '$add_user'='')
			AND (website_name like '%$website_name%' or '$website_name'='')
			order by sort desc limit ".$limitstr);
			
				return $q->result();
				
			
		}
		if($status!==null and $limits!==null)
		{
			$status=intval($status);
	        $q=$this->db->query("SELECT * FROM `ch_link` 
			WHERE (status='$l_status' or '$l_status'='' )
			AND (type_id='$type_id' or '$type_id'='' )
			AND (add_user like '%$add_user%' or '$add_user'='')
			AND (website_name like '%$website_name%' or '$website_name'='')
			order by sort desc,link_id desc limit ".$limits[0],$limits[1]);
			
			return $q->result();
		 
		}			
		
	
	}
	
	public function get_alink($id)
	{
		$ids=intval($id);
		$query=$this->db->get_where('ch_link',array('link_id'=>$ids));
		return $result=$query->result();
	
	}
	public function do_add_handle($data)
	{
		/*=====添加分类=====*/
		if( is_array($data) ){
			$data['addtime']=time();
			$data['add_user']=$_SESSION['manage'];
			
			return $this->db->insert('ch_link',$data);
		
			
		} 
	
	}
	
	public function  do_edit_handle($data,$link_id)
	{
		$this->db->where(array('link_id'=>$link_id));
		return $this->db->update('ch_link',$data);
		
	
	}
	
	
}
	