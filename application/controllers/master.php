<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	function view($master = null,$page = null) {
		switch ($master) {
			case 'currency':
				switch ($page) {
					case 'index':
						$data['data']	= $this->master_currency->list_currency();
						$data['title']	= 'Master Currency';
						$this->set_content('master/currency_list',$data);
					break;
					case 'add':
						$this->set_content('master/currency_add',array('title' => 'Create New Currency'));
					break;
					default:
						header("HTTP/1.0 404 Not Found");
					break;
				}
				break;
			default:
				header("HTTP/1.0 404 Not Found");
			break;
		}
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

	function ajax($page = null, $method = null){
		switch ($page) {
			case 'currency':
				switch ($method) {
					case 'add':
						$currency_name = $_POST['currency_name'];
						$currency_type = array('Kurs Transaction' => $_POST['kurs_transaction'], 'Kurs Special' => $_POST['kurs_special']);
						$currency_id = $this->master_currency->add($currency_name);
						foreach($currency_type as $key => $value) {
							$this->master_currency->add_type($currency_id,$key,$value);
						}
						echo json_encode(array('status' => 'success', 'message' => '<strong>Success</strong><br/>New currency has been added'));
					break;
					case 'check_available_currency':
						$currency_name = $_GET['currency_name'];
						$get = $this->db->query("select * from master_currency_table where lower(currency_name) = '".strtolower($currency_name)."'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
					break;
					default:
						header("HTTP/1.0 404 Not Found");
					break;
				}
			break;
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
			default:
				header("HTTP/1.0 404 Not Found");
			break;
		}
	}
}