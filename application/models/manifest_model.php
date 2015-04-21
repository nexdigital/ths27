<?php
class Manifest_model extends CI_Model {
	function check_available_mawb($mawb_no) {
		$query = $this->db->query("select * from manifest_file_table where mawb_no = '$mawb_no' limit 1");
		if($query->num_rows() > 0) return false;
		else return true;
	}
}
?>