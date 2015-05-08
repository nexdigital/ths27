<?php

class Master_country extends CI_Model {
	
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
}

?>