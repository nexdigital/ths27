<?php
class Users_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	 
	function __Construct()
    {
        parent::__Construct();
    }
	
	
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsers($conditions=array(),$fields='')
	 {
	 	
		parent::__construct(); 
		
		
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('ci_users');
 
		$this->db->order_by("ci_users.user_id", "asc");
 
		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('ci_users.user_id,ci_users.user_name,ci_users.user_email,ci_users.online');
		
		$result = $this->db->get();
		
		return $result;
		
 
      }//End of getUsers Function

     function get_active($user_id){

     		$this->db->where('user_id');
     		$get = $this->db->get('user_table');
     		return $get->row();
     }


     function get_menu($id_type){

     		$this->db->select('*');
     		$this->db->from("user_role_table a");
     		$this->db->join("user_access_table b","b.id = a.access_level");
     		$this->db->where('a.id_type',$id_type);	
     		$this->db->where('b.parent','0');	
     		$get  = $this->db->get();
     		// echo $this->db->last_query(); die();
     		return $get->result();


     		// $sql = $this->db->query("SELECT * from user_role_table as a LEFT JOIN user_access_table as b ON `b.id` = `a.access_level` WHERE `a.id_type` = '".$id_type."' and b.parent = 0");
			// return $sql->result();
 		}


 		function get_child($id_type,$id_access)
 		{	
 			$query = $this->db->query("SELECT * FROM (`user_role_table` a) JOIN `user_access_table` b ON `b`.`id` = `a`.`access_level` WHERE `a`.`id_type` = '".$id_type."' AND `b`.`parent` = '".$id_access."'");
 			return $query->result();
 		}


 	   function get_username()
 	   {
 	   		$get = $this->db->get("user_table");
 	   		return $get->result();
 	   }
 	
 	}

 ?>