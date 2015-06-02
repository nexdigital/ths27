<?php

	class Master_business extends CI_Model {

	function check_available_business($id) {

		$this->db->where('business_id',$id);
		$get = $this->db->get('master_business');
		return $get->result();

		
	}

	function add_business($component){

		$this->db->insert('master_business',$component);
	}

	function edit_business($id,$component){

		$this->db->where('business_id',$id);
		$this->db->update('master_business',$component);
	}

	function get_business(){
		
		$get = $this->db->get('master_business');
		return $get->result();
		
	}

	function get_row($id){

		$this->db->where('business_id',$id);
		$get = $this->db->get('master_business');
		return $get->row();
	}

	function check_available_name($business_id,$business_name){

		$this->db->where('business_id !=',$business_id);
		$this->db->where('business_name',$business_name);
		$get = $this->db->get('master_business');

		if($get->num_rows() > 0){
			return true;
		}else{
			return false;
		}


	}


	function delete($id){

		$data['is_active'] = "deleted";
		$this->db->where('business_id', $id);
		$this->db->update('master_business', $data); 

	}
}

?>