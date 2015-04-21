<?php

class Master_currency extends CI_Model {
		
	function list_currency($type) {
		$get = $this->db->query("select * from master_currency_table join master_currency_type_table on master_currency_type_table.currency_id = master_currency_table.currency_id where lower(master_currency_type_table.currency_type) = '".strtolower($type)."' ");
		return $get->result();		
	}
	function get_currency_value($name,$type) {
		$get = $this->db->query("select * from master_currency_table join master_currency_type_table on master_currency_type_table.currency_id = master_currency_table.currency_id where lower(master_currency_table.currency_name) = '".strtolower($name)."' and lower(master_currency_type_table.currency_type) = '".strtolower($type)."' ");
		return $get->row('currency_value');
	}
}

?>