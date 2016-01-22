<?php

class Partner_model extends CI_Model {



	function partner_new_id(){
		$get = $this->db->count_all('partner');
		$get = $get + 111;
		$len = strlen($get);
			switch ($len) {
			case '1': return 'PART00000' . $get; break;
			case '2': return 'PART0000' . $get; break;
			case '3': return 'PART000' . $get; break;
			case '4': return 'PART00' . $get; break;   
			case '5': return 'PART0' . $get; break;   
			default: return 'PART'.$get; break;
			}
	}

	function get_partner(){

		$this->db->select('a.country_id,a.country_name,b.*');
		$this->db->join('master_country_table a','a.country_id = b.country_id','LEFT');
		$query = $this->db->get('partner b');	
		return $query->result();


	}

	function get_partner_row($id){
		$this->db->select('a.country_id,a.country_name,b.*');
		$this->db->join('master_country_table a','a.country_id = b.country_id','LEFT');
		$this->db->where('b.partner_id',$id);
		$query = $this->db->get('partner b');	
		return $query->row();


	}

	function check_partner_id($partner_id){

		$this->db->where('partner_id ',$partner_id);
	//	$this->db->where('company_name',$partner_name);
		$query = $this->db->get('partner');
		if($query->num_rows()> 0){
			return true;
		}else{
			return false;
		}


	}

	function check_avaiable_partner($partner_id,$partner_name){

		$this->db->where('partner_id !=',$partner_id);
		$this->db->where('company_name',$partner_name);
		$query = $this->db->get('partner');
		if($query->num_rows()> 0){
			return true;
		}else{
			return false;
		}

	}

	function add_partner($data){

		$this->db->insert('partner',$data);
	}

	function update_partner($partner_id,$data){

		$this->db->where('partner_id',$partner_id);
		$this->db->update('partner',$data);


	}

	function get_partner_search($where)
	{
		$query = $this->db->query("select a.* ,b.country_id, b.country_name from partner as a LEFT JOIN master_country_table as b ON a.country_id = b.country_id ".$where." ");
		return $query->result();
	}




}	








?>