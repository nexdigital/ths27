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

			$get  = $this->db->query('select a.id_type,a.type,b.*,c.access FROM user_type_table as a
				 						LEFT JOIN user_role_table as b on a.id_type  = b.id_type 
										LEFT JOIN user_access_table as c on c.id = b.access_level
										where a.id_type = "'.$id_type.'"');
			return $get->result();
 		}

 	}

 ?>