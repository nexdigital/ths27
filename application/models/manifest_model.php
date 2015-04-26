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
	function get_by_hawb($hawb_no) {
		$query = $this->db->query("select d.*, f.mawb_no from manifest_data_table d join manifest_file_table f on f.file_id = d.file_id where d.hawb_no='$hawb_no'");
		if($query->num_rows() > 0) return $query->row();
		else return false;
	}
	function get_data_unverified(){
		$query = $this->db->query("select f.* from manifest_file_table f join manifest_data_table d on d.file_id = f.file_id where lower(d.status) = 'unverified' group by d.file_id order by d.created_date desc");
		return $query->result();
	}
	function get_data__details_unverified($mawb_no){
		$query = $this->db->query("select d.*, f.mawb_no from manifest_data_table d join manifest_file_table f on f.file_id = d.file_id where lower(f.mawb_no) = '$mawb_no' and lower(d.status) = 'unverified' order by d.created_date desc");
		return $query->result();		
	}
	function get_similar_customer($hawb_no,$customer_type) {
		$data = $this->get_by_hawb($hawb_no);
		$address = $data->$customer_type;

		$array = explode(' ',$address);
		$QUERY = "
			SELECT
				*
			FROM
				(
					SELECT
						CUST.cust_id,
						CUST.name,
						CUST.address,
						CUST.country,
						CONCAT(
							CUST. name,
							' ',
							CUST.address,
							' ',
							CUST.phone,
							' ',
							CUST.email,
							' ',
							CUST.country
						)AS FULL_ADDRESS
					FROM
						customer_table CUST
				)CUST
			WHERE
		";
		for ($i=0;$i<=count($array)-1;$i++) {
			if(trim($array[$i])) {
				$QUERY .= "CUST.FULL_ADDRESS LIKE '%".trim(strip_tags(str_ireplace(array(',','/',"'"),'',trim($array[$i]))))."%'";
				$QUERY .= " OR ";
			}
		}
		$QUERY = substr($QUERY, 0, -4);
		$get = $this->db->query($QUERY);
		if($get->num_rows() > 0) {
			$similar['cust_id'] = array();
			foreach ($get->result() as $key => $value) {
				similar_text($value->FULL_ADDRESS, $address, $percent);
				$percent = round($percent);
				if($percent > 50) {
					$similar['percent'][] = $percent;
					$similar['cust_id'][] = $value->cust_id;
				}
			}
			if(count($similar['cust_id']) > 0) {
				$this->db->where_in('cust_id',$similar['cust_id']);
				$this->db->where('reference_id !=','0');
				$get = $this->db->get('customer_table');
				if($get->num_rows() > 0) return $get->result();
				else return FALSE;
			} else return FALSE;
		} else return FALSE;
	}
}
?>