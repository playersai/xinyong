<?php 
/*--友情链接管理模型--*/
class Admin_system_logm extends CI_Model {

    function __construct()
    {
		$this->load->database();
        parent::__construct();
    }
	
	
	
	
	public function get_system_log($limits=null)
	{
		if($limits==null){
			$query=$this->db->get('system_log');
			return $result=$query->result();
		}
		if($limits!==null)
		{
			
			$limitstr=join(",",$limits); 
			$q=$this->db->query("SELECT * FROM `ch_system_log`  order by log_id desc limit ".$limitstr);
			
				return $q->result();
				
			
		}
	
	}
	
	public function get_system_log_nums()
	{
		return  $this->db->count_all_results('system_log');
	
	}
	
	public function do_add_system_log($data)
	{
		if(is_array($data))
		{
		
			return $this->db->insert('ch_system_log',$data);
		
		
		}
	
	
	}
	
	
	
	
}
	