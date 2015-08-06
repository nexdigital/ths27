<?php

class finance_payment extends CI_Model {

	function get_manifest_finish($status = "finish") {

		$this->db->where('status',$status);
		$get = $this->db->get("manifest_data_table");
		return $get->result();
		
	}


	function insert_payment($data){	

		$this->db->insert('payment_table',$data);
	}

	function get_manifest_by_hawb($hawb_no){

			 $this->db->where('hawb_no',$hawb_no);	
			 $get = $this->db->get('manifest_data_table');
			 return $get->row();

	}

	function payment_manifest_update($hawb_no,$payment){
		
		$this->db->where('hawb_no',$hawb_no);
		$this->db->update('manifest_data_table',$payment);
	}

	function get_data_payment(){

		$this->db->select('a.reference_id,a.name,b.*,c.user_id,c.username');
		$this->db->join('customer_table a','a.reference_id = b.customer_payment');
		$this->db->join('user_table c','c.user_id = b.created_by');
		$get  = $this->db->get('payment_table b');
		return $get->result();
	}

	function get_finish(){

			$this->db->where('collect !=','');
			$this->db->where('lower(status)','finish');
			$this->db->where('lower(status_payment)','unpaid');
			$get = $this->db->get('manifest_data_table');
			return $get->result();
	}

	function data_payment_full(){
		$this->db->select('a.reference_id,a.name,b.*,c.user_id,c.username');
		$this->db->join('customer_table a','a.reference_id = b.customer_payment');
		$this->db->join('user_table c','c.user_id = b.created_by');
		$this->db->where('b.status','full');
		$get  = $this->db->get('payment_table b');
		return $get->result();
	}

	
}

?>