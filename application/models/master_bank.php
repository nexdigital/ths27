<?php

class Master_bank extends CI_Model {
	
	function get_list(){
		$query = $this->db->query("select * from master_bank_table where is_active in ('active','inactive') limit 10");
		return $query->result();
	}
	function get_by_bank_id($bank_id = null) {
		$query = $this->db->query("select * from master_bank_table where bank_id = '$bank_id' and is_active in ('active','inactive')");
		return $query->row();
	}
	function advance_search($bank_id = null,$bank_name = null, $country = null,$swift_code = null,$entry_date = null,$entry_by = null, $page = null, $limit = null) {
		if($bank_id != null && trim($bank_id) != '') $this->db->like('lower(bank_id)',strtolower($bank_id));
		if($bank_name != null && trim($bank_name) != '') $this->db->like('lower(bank_name)',strtolower($bank_name));
		if($swift_code != null && trim($swift_code) != '') $this->db->like('lower(bank_swift_code)',strtolower($swift_code));
		if($entry_date != null && trim($entry_date) != '') $this->db->like('left(entry_date,10)',strtolower($entry_date));
		if($entry_by != null && trim($entry_by) != '') $this->db->like('lower(entry_by)',strtolower($entry_by));
		if(is_array($country)) $this->db->where_in('country_id',$country);
		if(is_numeric($page)) $this->db->limit($limit,$page);
		$get = $this->db->get('master_bank_table');
		return $get->result();
	}
}
?>