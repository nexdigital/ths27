<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	function master_customer_group(){
		$this->set_content('master/master_group',array('title' => 'Master Customers Group'));

		/**
		$data				= array();
		$json['content'] 	= $this->load->view('master/master_group',$data,true);
		$json['title']		= 'Customers Group';
		echo json_encode($json);
		**/
	}

	function ajax($page = null){
		switch ($page) {
			case 'create_group':

					$originalDate = $_POST['payment_date'];
					$newDate = date("Y-m-d", strtotime($originalDate));
					$data['group_name']			= $_POST['group_name'];
					$data['customer_country']	= $_POST['customer_country'];
					$data['payment_date']		= $newDate ;
					$data['business_type']		= $_POST['bussines_type'];
					$this->master_customer->add_group($data);
					$status = TRUE;
					$message = "Save success!";
				/*	if($this->master_customer->add_group($data)){
						$status = TRUE;
						$message = "Save success!";
					}else{
						$status = FALSE;
						$message = "Not success!";
					} */
				
					echo json_encode(array('status'=>$status,'message'=>$message));
			break;
		}
	}
}