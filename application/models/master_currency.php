<?php

class Master_currency extends CI_Model {
	
	function get_exchange_rate_list() {
		$get = $this->db->query(" select * from master_exchange_rate_table order by entry_date DESC ");
		return $get->result();
	}

	function get_exchange_rate_value($name = 'NT') {
		$get = $this->db->query("select * from master_exchange_rate_table  where lower(exchange_rate_name) = '".strtolower($name)."'");
		return $get->row('exchange_rate_value');
	}
	

	function check_currency( $currency_name ) {
		
		$this->db->where( "exchange_rate_name",  $currency_name);
		$this->db->where( "status = 'active'");
		$get	= $this->db->get( "master_exchange_rate_table" );
		if( $get->num_rows() > 0 )
			return $get->row();
		else
			return FALSE;
	
	}



	/*
	function list_currency_type(){
		$get = $this->db->query("select * from master_currency_type_table");
		return $get->result();
	}
	function add($currency_name){
		$this->db->insert('master_currency_table', array('currency_name' => $currency_name, 'created_date' => date('Y-m-d h:i:s'), 'created_by' => $this->session->userdata('user_id'), 'modified_date' => date('Y-m-d h:i:s')));
		return $this->db->insert_id();
	}
	function add_type($currency_id,$currency_type,$currency_value){
		$this->db->insert('master_currency_type_table',array('currency_id' => $currency_id, 'currency_type' => $currency_type, 'currency_value' => $currency_value, 'created_date' => date('Y-m-d h:i:s'), 'modified_date' => date('Y-m-d h:i:s')));
	}
	function list_currency() {
		$get = $this->db->query("select (select ctr1.country_name from master_country_table ctr1 where ctr1.country_id = crc.currency_from) as 'currency_from', (select ctr2.country_name from master_country_table ctr2 where ctr2.country_id = crc.currency_to) as 'currency_to', (select ctp.currency_type_name from master_currency_type_table ctp where ctp.currency_type_id = crc.currency_type) as 'currency_type', crc.currency_date from master_currency_table crc");
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
	*/
}

?>