<?php

class Master_country extends CI_Model {
	
	function add_component($component){

		$this->db->insert('master_country_table',$component);
	}


	function edit_country($country_id,$component){

		$this->db->where('country_id', $country_id);
		$this->db->update('master_country_table', $component); 

	}

	function delete($country_id){

		$data['is_active'] = "deleted";
		$this->db->where('country_id', $country_id);
		$this->db->update('master_country_table', $data); 
	}

	function check_id_country($country_id){
		
		$this->db->where('country_id',$country_id);
		$query = $this->db->get('master_country_table');
  		$count_row = $query->num_rows();

        if($count_row>0){
          return TRUE;
        }else{
          return FALSE;
        }

	}

	function get_row_country($id){

		$this->db->where('country_id',$id);
		$get = $this->db->get('master_country_table');
		return $get->row();
	}

	function check_country_name($country_id,$country_name){

		$this->db->where('country_id != ',$country_id);
		$this->db->where('country_name',$country_name);
		$query = $this->db->get('master_country_table');

	    if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}


	




	//hafiz//




	function add($currency_name){
		$this->db->insert('master_currency_table', array('currency_name' => $currency_name, 'created_date' => date('Y-m-d h:i:s'), 'created_by' => $this->session->userdata('user_id'), 'modified_date' => date('Y-m-d h:i:s')));
		return $this->db->insert_id();
	}
	function add_type($currency_id,$currency_type,$currency_value){
		$this->db->insert('master_currency_type_table',array('currency_id' => $currency_id, 'currency_type' => $currency_type, 'currency_value' => $currency_value, 'created_date' => date('Y-m-d h:i:s'), 'modified_date' => date('Y-m-d h:i:s')));
	}
	function list_country() {
		$get = $this->db->query("select * from master_country_table");
		return $get->result();		
	}	
	function list_currency_by_type($type) {
		$get = $this->db->query("select * from master_currency_table join master_currency_type_table on master_currency_type_table.currency_id = master_currency_table.currency_id where lower(master_currency_type_table.currency_type) = '".strtolower($type)."' ");
		return $get->result();		
	}
	function get_currency_value($name,$type) {
		$get = $this->db->query("select * from master_currency_table join master_currency_type_table on master_currency_type_table.currency_id = master_currency_table.currency_id where lower(master_currency_table.currency_name) = '".strtolower($name)."' and lower(master_currency_type_table.currency_type) = '".strtolower($type)."' ");
		return $get->row('currency_value');
	}
	function get_by_country_id($country_id) {
		$query = $this->db->query("select * from master_country_table where country_id = '$country_id' ");
		return $query->row();
	}

	function country_new_id() {
	
		$this->db->from( "master_country_table" );
		$get = $this->db->count_all_results();
		$get = $get + 001;
		$len = strlen( $get );
		
		switch ( $len ) {
			case "1": return "CNT00000" . $get; break;
			case "2": return "CNT0000" . $get; break;
			case "3": return "CNT000" . $get; break;
			case "4": return "CNT00" . $get; break;
			case "5": return "CNT0" . $get; break;
			default: return "".$get; break;
		}
	
	}
}

?>