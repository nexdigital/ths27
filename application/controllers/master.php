<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	function dashboard(){
		$this->set_content('content/blank',array('title' => 'Dashboard'));
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
						$this->set_content('master/country_add',array('title' => 'Add New Country'));
					break;					
					case 'edit':
						$this->set_content('master/country_add',array('title' => 'Edit Country'));
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
						$data['title']			= 'Add Currency Rate';
						$this->set_content('master/currency_add',$data);
					break;
					case 'edit':
						$data['list_country']	= $this->master_country->list_country();
						$data['list_currency_type'] = $this->master_currency->list_currency_type();
						$data['title']			= 'Edit Currency Rate';
						$this->set_content('master/currency_add',$data);
					break;
					case 'edit_type':
						$data['title']			= 'Edit Rate Type';
						$this->set_content('master/currency_type_add',$data);
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
				case 'term_of_payment':
					switch ($page) {
						case 'index':
							$data['title']			= 'Term Of Payment';
							$this->set_content('master/top_list',$data);
						break;						
						case 'add':
							$data['title']			= 'Add Term Of Payment';
							$this->set_content('master/top_add',$data);
						break;						
						default:
							header("HTTP/1.0 404 Not Found");
						break;
					}
				break;
				case 'airlines':
					switch ($page) {
						case 'index':
							$data['title']			= 'Airlines';
							$this->set_content('master/airlines_list',$data);
						break;
						case 'add':
							$data['list_country']	= $this->master_country->list_country();
							$data['title']			= 'Add Airlines';
							$this->set_content('master/airlines_add',$data);
						break;						
						default:
							header("HTTP/1.0 404 Not Found");
						break;
					}
				break;
				case 'holiday':
					switch ($page) {
						case 'index':
							$data['title']			= 'Holiday';
							$this->set_content('master/holiday_list',$data);
						break;
						case 'add':
							$data['list_country']	= $this->master_country->list_country();
							$data['title']			= 'Add Holiday';
							$this->set_content('master/holiday_add',$data);
						break;						
						default:
							header("HTTP/1.0 404 Not Found");
						break;
					}
				break;
				case 'add_group':
						$data['title']			= 'Add Group Customer';
						$this->set_content('master/group_form',$data);
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

	function ajax($page = null, $method = null, $id = null){
		switch ($page) {
			case 'bank':
				switch ($method) {
					case 'add':
						$bank['bank_id'] 			= $_POST['bank_id'];
						$bank['bank_name'] 			= $_POST['bank_name'];
						$bank['bank_swift_code'] 	= $_POST['bank_swift_code'];
						$bank['description'] 		= $_POST['description'];
						$bank['is_active'] 			= (isset($_POST['is_active'])) ? 'active' : 'inactive';
						$bank['entry_date']			= date('Y-m-d');
						$bank['entry_by']			= $this->session->userdata('user_id');
						$this->db->insert('master_bank_table',$bank);
						echo json_encode(array('status' => 'success', 'message' => 'New bank has been added'));
					break;

					case 'edit':
						$bank['bank_name'] 			= $_POST['bank_name'];
						$bank['bank_swift_code'] 	= $_POST['bank_swift_code'];
						$bank['description'] 		= $_POST['description'];
						$bank['is_active'] 			= (isset($_POST['is_active'])) ? 'active' : 'inactive';
						$this->db->where('bank_id',$id);
						$this->db->update('master_bank_table',$bank);
						echo json_encode(array('status' => 'success', 'message' => 'Bank successfully updated'));
					break;
					
					case 'delete':
						$bank['is_active'] 			= 'deleted';
						$this->db->where('bank_id',$id);
						$this->db->update('master_bank_table',$bank);
						echo json_encode(array('status' => 'success', 'message' => 'Bank successfully deleted'));
					break;

					default:
					# code...
					break;
				}
			break;
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


	function user($page=null){

		switch ($page) {
			case 'index':
						$data['data']	= '';
						$data['title']			= 'User Access';
						$this->set_content('master/master_user',$data);
			break;

			case'add_user':

						$data['data']	= '';
						$data['title']	= 'Add User';
						$this->set_content('master/user_form',$data);
			break;
		}

	}

	function bank($page=null,$id=null){
		switch ($page) {
			case 'index':
				$data['list_country']	= $this->master_country->list_country();
				$data['title']			= 'Cash / Bank book';
				$this->set_content('master/book',$data);
			break;
			case'add_book':
						$data['list_country']	= $this->master_country->list_country();
						$data['title']	= 'Add Cash / Bank book';
						$this->set_content('master/book_form',$data);

						
			break;
			case 'index_bank_branch':
				$data['data']			= $this->master_bank->get_list();
				$data['title']			= 'Master Bank';
				$this->set_content('master/bank_branch',$data);
			break;
			case 'details_bank_branch':
				$data['data'] = $this->master_bank->get_by_bank_id($id);
				$data['title'] = 'Details bank #'.$id;
				$this->set_content('master/bank_branch_details',$data);
			break;
			case 'edit_bank_branch':
				$data['data'] = $this->master_bank->get_by_bank_id($id);
				$data['title'] = 'Edit bank #'.$id;
				$this->set_content('master/bank_branch_edit',$data);
			break;
			case 'delete_bank_branch':
				$data['data'] = $this->master_bank->get_by_bank_id($id);
				$data['title'] = 'Delete bank #'.$id;
				$this->set_content('master/bank_branch_delete',$data);
			break;
			case 'bank_branch_form':
						$data['list_country']	= $this->master_country->list_country();
						$data['title']			= 'Add Bank';
						$this->set_content('master/bank_branch_form',$data);
			break;

			case 'add_bank':
						$data['id_currency']    = $_POST['currency_from'];
						$data['bank_name']      = $_POST['bank_name'];
						$data['swift_code']     = $_POST['swift_code'];
						$data['date']  			= date("Y-m-d");   
						//$data['user_created']   = $this->session->userdata('');
						$data['user_created']   = "Admin";
						$this->masters->add_bank($data);

						echo json_encode(array('test' => 'coli'));
			break;
		}

	}


	function tax($page=null){

		switch ($page) {
			case 'index':
						$data['data']	= '';
						$data['title']			= 'Tax';
						$this->set_content('master/tax',$data);
			break;

			case'add_tax':

						$data['data']	= '';
						$data['title']	= 'Add Tax';
						$this->set_content('master/tax_form',$data);
			break;
		}

	}

	
}