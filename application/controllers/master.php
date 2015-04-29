<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	function view($master = null,$page = null) {
		switch ($master) {
			case 'country':
				switch ($page) {
					case 'index':
						$data['data']	= $this->master_country->list_country();
						$data['title']	= 'Master Country';
						$this->set_content('master/country_list',$data);
					break;
					case 'add':
						$this->set_content('master/country_add',array('title' => 'Create New Country'));
					break;					
					default:
						header("HTTP/1.0 404 Not Found");
					break;
				}
			break;
			case 'currency':
				switch ($page) {
					case 'index':
						$data['list_currency']	= $this->master_currency->list_currency();
						$data['list_currency_type'] = $this->master_currency->list_currency_type();
						$data['title']	= 'Master Currency';
						$this->set_content('master/currency_list',$data);
					break;
					case 'type_index':
						$data['list_currency']	= $this->master_currency->list_currency();
						$data['list_currency_type'] = $this->master_currency->list_currency_type();
						$data['title']	= 'Master Currency';
						$this->set_content('master/currency_type_list',$data);
					break;
					case 'add':
						$data['list_country']	= $this->master_country->list_country();
						$data['list_currency_type'] = $this->master_currency->list_currency_type();
						$data['title']			= 'Create Currency';
						$this->set_content('master/currency_add',$data);
					break;
					case 'add_type':
						$data['title']			= 'Add Rate Type';
						$this->set_content('master/currency_type_add',$data);
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

	function business(){
		$data['get_customers']	= $this->customers_model->get_data();
		$data['title']			= 'Master Business';
		$this->set_content('master/master_business',$data);

	}

	function add_business(){
		$data['get_customers']	= array('');
		$data['title']			= 'Add Business';
		$this->set_content('master/business_form',$data);
	}

	function ajax($page = null, $method){
		switch ($page) {
			case 'country':
				switch ($method) {
					case 'add':
						$this->db->set('country_name',$_POST['country_name']);
						$this->db->set('country_symbol',$_POST['country_symbol']);
						$this->db->insert('master_country_table');
						echo json_encode(array('status' => 'success', 'message' => '<strong>Success</strong><br/>New country has been added'));
					break;
					case 'check_available_country':
						$country_name = $_GET['country_name'];
						$get = $this->db->query("select * from master_country_table where lower(country_name) = '".strtolower($country_name)."'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
					break;
					default:
						header("HTTP/1.0 404 Not Found");
					break;
				}
			break;
			case 'currency':
				switch ($method) {
					case 'add':
						$this->db->set('currency_from',$_POST['currency_from']);
						$this->db->set('currency_to',$_POST['currency_to']);
						$this->db->set('currency_type',$_POST['currency_type']);
						$this->db->set('currency_date',$_POST['currency_date']);
						$this->db->set('currency_rate',$_POST['currency_rate']);
						$this->db->insert('master_currency_table');
						echo json_encode(array('status' => 'success', 'message' => '<strong>Success</strong><br/>New currency has been added'));
					break;
					case 'add_type':
						$this->db->set('currency_type_name',$_POST['currency_type_name']);
						$this->db->insert('master_currency_type_table');
						echo json_encode(array('status' => 'success', 'message' => '<strong>Success</strong><br/>New rate type has been added'));
					break;
					case 'check_available_currency':
						$currency_name = $_GET['currency_name'];
						$get = $this->db->query("select * from master_currency_table where lower(currency_name) = '".strtolower($currency_name)."'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
					break;
					case 'check_available_rate_type':
						$currency_type_name = $_GET['currency_type_name'];
						$get = $this->db->query("select * from master_currency_type_table where lower(currency_type_name) = '".strtolower($currency_type_name)."'");
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

			case 'create_business':

			break;
		}
	}
}