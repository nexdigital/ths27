<?php

class Master_currency extends CI_Model {
	
	function list_currency(){
		$get = $this->db->get('Master_currency_table');
		return $get->result();
	}

	function insert($data){

		$this->db->insert("Master_currency_table",$data);
	}
}

?>