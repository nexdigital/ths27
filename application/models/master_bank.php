<?php

class Master_bank extends CI_Model {
	
	function get_list(){
		$query = $this->db->query("select * from master_bank_table where is_active in ('active','inactive')");
		return $query->result();
	}
	function get_by_bank_id($bank_id = null) {
		$query = $this->db->query("select * from master_bank_table where bank_id = '$bank_id' and is_active in ('active','inactive')");
		return $query->row();
	}
}

?>