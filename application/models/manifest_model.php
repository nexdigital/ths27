<?php
class Manifest_model extends CI_Model {
	function check_available_mawb($mawb_no) {
		$query = $this->db->query("select * from manifest_file_table where mawb_no = '$mawb_no' limit 1");
		if($query->num_rows() > 0) return false;
		else return true;
	}
	function check_available_hawb($hawb_no) {
		$query = $this->db->query("select * from manifest_data_table where hawb_no = '$hawb_no' limit 1");
		if($query->num_rows() > 0) return false;
		else return true;
	}
	function insert_file($file) {
		$this->db->insert('manifest_file_table',$file);
	}
	function insert_data($data) {
		$this->db->insert('manifest_data_table',$data);
	}
	function update_value_field($hawb_no,$field,$value) {
		$this->db->query("update manifest_data_table set ".$field." = ".$field." + ".$value." where hawb_no = '".$hawb_no."'");
	}
}
?>