<?php

class Master_tax extends CI_Model {
		
    function add_tax($component){
         $this->db->insert('master_tax',$component);
    }

    function get_tax(){

    	$query = $this->db->get('master_tax');
    	return $query->result();
    }

    function get_tax_row($id){

    	$this->db->where('tax_id',$id);
    	$get = $this->db->get('master_tax');
    	return $get->row();

    }

    function edit_tax($id,$component){

    	$this->db->where('tax_id',$id);
    	$this->db->update('master_tax',$component);	
    }

    function delete_tax($id){

        $data['is_active'] = "deleted";    
        $this->db->where('tax_id',$id);
        $this->db->update('master_tax',$data); 

    }







 
}

?>