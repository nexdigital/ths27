<?php

class Master_user extends CI_Model {
		

	function insert_type($data){

			$this->db->insert('user_type_table',$data);


	}

	function insert_role($component){

			$this->db->insert('user_role_table',$component);


	}

	function update_type($id_type, $data){

		

			$this->db->where('id_type',$id_type);
			$this->db->update('user_type_table',$data);

	}

	function update_role($id_type,$component){

			$this->db->where('id_type',$id_type);
			$this->db->update('user_role_table',$component);

	}

	function delete_role($id_type){

			$this->db->where('id_type',$id_type);
			$this->db->delete('user_role_table');

	}
		

	function get_access(){

			$query = $this->db->query('select * from user_type_table ORDER BY created_date ASC');
			return $query->result();

	}

	function insert_user($data){

			$this->db->insert('user_table',$data);

	}

	function user_new_id(){
		$get = $this->db->count_all('user_table');
		$get = $get + 111;
		$len = strlen($get);
			switch ($len) {
			case '1': return 'USR00000' . $get; break;
			case '2': return 'USR0000' . $get; break;
			case '3': return 'USR000' . $get; break;
			case '4': return 'USR00' . $get; break;   
			case '5': return 'USR0' . $get; break;   
			default: return 'USR'.$get; break;
			}
	}

	function get_all_user(){


			$query = $this->db->query('select a.*, b.`type` from user_table as a LEFT JOIN  user_type_table as b  on a.`type`= b.`id_type`');
			return $query->result();

	}

	function get_user_by_id($user_id){

			$this->db->where('user_id',$user_id);
			$get = $this->db->get('user_table');
			return $get->row();

	}

	function edit_user($user_id,$data){

		$this->db->where('user_id',$user_id);
		$this->db->update('user_table',$data);
	}

	function check_available_update($user_id,$username)
	{

		$this->db->where('user_id != ',$user_id);
		$this->db->where('username',$username);

		$get	= $this->db->get( "user_table" );

		if( $get->num_rows() > 0 )

			return true;
			
		else
			return FALSE;

	}

	function check_available($username)
	{

	//	$this->db->where('user_id',$user_id);
		$this->db->where('username',$username);

		$get	= $this->db->get( "user_table" );

		if( $get->num_rows() > 0 )
			return $get->row();
		else
			return FALSE;

	}

	function check_available_id($user_id)
	{
		$this->db->where('user_id',$user_id);

		$get	= $this->db->get( "user_table" );

		if( $get->num_rows() > 0 )
			return $get->row();
		else
			return FALSE;
	}

	function get_role(){


			$get = $this->db->get('user_access_table');
			return $get->result();

	}

	function get_role_by_row($id_type){

			$get  = $this->db->query('select a.* ,c.access FROM user_type_table as a
				 						LEFT JOIN user_role_table as b on a.id_type  = b.id_type 
										LEFT JOIN user_access_table as c on c.id = b.access_level
										where a.id_type = "'.$id_type.'"');
			return $get->row();

	}

	function get_checked_by_row($id_type){

			$get  = $this->db->query('select a.id_type,a.type,b.*,c.access FROM user_type_table as a
				 						LEFT JOIN user_role_table as b on a.id_type  = b.id_type 
										LEFT JOIN user_access_table as c on c.id = b.access_level
										where a.id_type = "'.$id_type.'"');
			return $get->result();

	}

	function get_user_login($user_id,$login = "1"){

			$this->db->where('user_id != ',$user_id);
			$this->db->where('login',$login);
			$get = $this->db->get('user_table');
			return $get->result();

	}

	function get_access_level($id_type){

			$this->db->where('id_type',$id_type);
			$sql = $this->db->get('user_role_table');
			return $sql->row();

	}

}

?>