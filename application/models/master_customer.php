<?php

class Master_customer extends CI_Model {
		
    function add_group($data){
         $this->db->insert('customer_group',$data);
    }
}

?>