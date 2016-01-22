<?php

class Master_customer extends CI_Model {
		
    function add_group($data){
         $this->db->insert('customer_group',$data);
    }


    function get_group(){

    	$query = $this->db->get('customer_table');
    	$query->result();

    }
}

?>