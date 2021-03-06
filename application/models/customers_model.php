<?php

class Customers_model extends CI_Model {
	
	function get_list($type = null) {
		if($type != null) $this->db->where('LOWER(type)',$type);
		$get = $this->db->get('customer_table');
		if($get->num_rows() > 0) return $get->result();
		else return FALSE;
	}

	function get_customer($address = null, $type = null) {
		$customer = $this->get_by_id($address);
		if($customer != FALSE) {
			return $customer;
		} else {
			$customer = $this->check_speeling_address($address, $type);
			return $customer;
		}
	}
	
	function get_by_id($ref_id) {
		$this->db->where('reference_id',$ref_id);
		$get = $this->db->get('customer_table');
		if($get->num_rows() > 0) return $get->row();
		else return FALSE;
	}

	function save_customer($data)
	{
		
		$this->db->insert('customer_table',$data);	
		
	}
	
	function get_data(){

		$this->db->select('a.*,b.country_id,b.country_name');
		$this->db->from('customer_table a');
		$this->db->join('master_country_table b','b.country_id = a.country');
		$this->db->order_by('a.create_date',"DESC");
		$query = $this->db->get();
		return $query->result();
		// $query = $this->db->query("select a.*,b.country_id,b.country_name from customer_table as a LEFT JOIN master_country_table as b  ON  b.country_id = a.country  ORDER BY  a.create_date ASC ");
		// return $query->result();
		
	}
	
	function getuser($reference_id)
	{
		$this->db->where('reference_id',$reference_id);
		$query = $this->db->get('customer_table');
		return $query->row();
	}
	
	function rahasia( $cust_id,$data)
	{
			$this->db->where('cust_id',$cust_id);
			$this->db->update('customer_table', $data); 	
	}
	
	
	function customer_new_id(){
		/*$get = $this->db->count_all('customer_table');
		$get = $get + 111;
		$len = strlen($get);
			switch ($len) {
			case '1': return 'CUST00000' . $get; break;
			case '2': return 'CUST0000' . $get; break;
			case '3': return 'CUST000' . $get; break;
			case '4': return 'CUST00' . $get; break;   
			case '5': return 'CUST0' . $get; break;   
			default: return 'CUST'.$get; break;
			}*/
		$db = $this->db->query('select * from customer_table ORDER BY cust_id DESC LIMIT 1');
		return $db->result();
		
    		
	}

	function customer_edit($reference_id,$data)
	{
		$this->db->where('reference_id', $reference_id);
		$this->db->update('customer_table', $data); 	
		
	}


	
	function customer_delete($reference_id)
	{
		$this->db->where('reference_id', $reference_id);
		$this->db->delete('customer_table'); 
		
	}

  function get_status_paid($refference_id,$status_payment="paid")
	{
		//$this->db->where('shipper',$refference_id);
     	$this->db->or_where('consignee',$refference_id);
        $this->db->where('status_payment',$status_payment);
		$query = $this->db->get('manifest_data_table');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;

	}

     function get_status_Unpaid($refference_id,$status_payment="Unpaid")
	{
	 	//$this->db->where('shipper',$refference_id);
       	$this->db->or_where('consignee',$refference_id);
        $this->db->where('status_payment',$status_payment);
		$query = $this->db->get('manifest_data_table');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;

	}


	

	function check_speeling_address($address){
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

	function search($keyword) {
		$keyword = $this->tools->remove_tags_excel($keyword);
		$keyword = explode(' ', $keyword);
		if(is_array($keyword) && count($keyword) > 0){
			foreach($keyword as $val) {
				if(strlen($val) > 1) {
					$this->db->like('name',$val);
					$this->db->or_like('address',$val);
					$this->db->or_like('country',$val);
				}
			}
			$get = $this->db->get('customer_table');
			if($get->num_rows() > 0) return $get->result();
			else FALSE;
		} else return FALSE;
	}

	function list_country() {
		
		$get = $this->db->get('country');
		return $get->result();

	}

	function check_customers($reference_id){

		$this->db->where('reference_id',$reference_id);
		$query = $this->db->get('customer_table');
  		$count_row = $query->num_rows();

        if($count_row>0){
          return TRUE;
        }else{
          return FALSE;
        }

	}

	function save_email($component){

		$this->db->insert('email_table',$component);	
	}

	function get_customer_all(){
		$this->db->select('a.country_id,a.country_name,b.*');
		$this->db->join('master_country_table a','a.country_id = b.country_id');
		$get = $this->db->get('customer_table b');
		return $get->result();
	}

	function get_customer_active($status="Active"){

		
		$this->db->select('a.*,b.country_id,b.country_name');
		$this->db->from('customer_table a');
		$this->db->join('master_country_table b','b.country_id = a.country');
		$this->db->where('a.status_active',$status);
		$query = $this->db->get();
		return $query->result();
		
	}

	function get_customer_by_id($reference_id){

			$this->db->where('reference_id',$reference_id);
			$get = $this->db->get('customer_table');
			return $get->row();
	}

	// function get_customer_search($search)
	// {
	// 		$this->db->select('a.*,b.country_id,b.country_name');
	// 		$this->db->distinct();
	// 		$this->db->from('customer_table a');
	// 		$this->db->join('master_country_table b','b.country_id = a.country');
	// 		$this->db->like('a.name',$search);
	// 		$this->db->or_like('a.reference_id',$search);
	// 		$this->db->or_like('a.attn',$search);
	// 		//$this->db->where('country',$search);
	// 		$this->db->or_like('a.phone',$search);
	// 		$this->db->or_like('a.create_by',$search);
	// 		$this->db->or_like('a.create_date',$search);
	// 		$this->db->or_like('a.update_by',$search);
	// 		$this->db->or_like('a.update_date',$search);
	// 		$this->db->or_like('a.status_active',$search);
	// 		$sql = $this->db->get('customer_table');
	// 		return $sql->result();
	// }

	function get_customer_search($where)
	{
		$query = $this->db->query("select a.* ,b.country_id, b.country_name from customer_table as a LEFT JOIN master_country_table as b ON a.country = b.country_id ".$where." ");
		return $query->result();
	}

	 function get_tech()
    {
        $db = $this->db->query('select cust_id from customer_table');
        return $db->result();
    }

    function update_tech($array)
    {
        // $con = mysql_connect('localhost','root','','smart_platform');
        foreach ($array as $key => $value) {

             
             $sql = mysql_query("UPDATE  customer_table set cust_id = '".$value."' where `cust_id` = '".$key."'");

        }
        // mysqli_close($con);
       

    }

    function get_by_cust_id($max)
    {
    	$this->db->where('cust_id',$max);
    	$db = $this->db->get('customer_table');
    	return $db->row();
    }
    function max_id()
    {
    	$this->db->select_max('cust_id');
		$query = $this->db->get('customer_table');
		return $query->row();
    }

    



	

}

?>