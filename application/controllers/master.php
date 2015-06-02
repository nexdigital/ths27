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
						$country_id = $this->master_country->country_new_id();

						$this->set_content('master/country_add',array('title' => 'Add New Country','country_id' => $country_id));
					break;					
					case 'edit':
						$country_id = $_POST['country_id'];
						$get_country = $this->master_country->get_row_country($country_id);
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


	function business($page=null, $id=null){

			switch ($page) {
				case 'index':
					$data['get_business']	= $this->master_business->get_business();
					$data['title']			= 'Master Business';
					$this->set_content('master/master_business',$data);

				break;

				case 'add_business' :
				
					$data['title']			= 'Add Business';
					$this->set_content('master/business_form',$data);

				break;

				case 'edit_business' :
					$data['get_business_row']	= $this->master_business->get_row($id);
					$data['title']				= 'Edit Business';
					$this->set_content('master/business_edit',$data);

				break;

				case 'delete':
					$data['get_business_row']	= $this->master_business->get_row($id);
					$data['title']				= 'Delete Business';
					$this->set_content('master/business_delete',$data);

				break;
			}

	}

	

	
	function ajax($page = null, $method = null, $id = null){
		switch ($page) {
			case 'bank':
				switch ($method) {
					case 'add':
						$bank['bank_id'] 			= $_POST['bank_id'];
						$bank['bank_name'] 			= $_POST['bank_name'];
						$bank['bank_swift_code'] 	= $_POST['bank_swift_code'];
						$bank['country_id'] 		= $_POST['country_id'];	
						$bank['description'] 		= $_POST['description'];
						$bank['is_active'] 			= (isset($_POST['is_active'])) ? 'active' : 'inactive';
						$bank['entry_date']			= date('Y-m-d h:i:s');
						$bank['entry_by']			= $this->session->userdata('user_id');

						$this->db->where('lower(bank_id)',strtolower($bank['bank_id']));
						$get = $this->db->get('master_bank_table');
						if($get->num_rows() > 0) {
							echo 'false';
							echo json_encode(array('status' => 'warning', 'message' => 'Sorry BANK ID has been used!'));
						} else {
							$this->db->insert('master_bank_table',$bank);
							echo json_encode(array('status' => 'success', 'message' => 'New bank has been added'));
						}
					break;

					case 'edit':
					/*	$bank['bank_name'] 			= $_POST['bank_name'];
						$bank['bank_swift_code'] 	= $_POST['bank_swift_code'];
						$bank['country_id'] 		= $_POST['country_id'];	
						$bank['description'] 		= $_POST['description'];
						$bank['is_active'] 			= (isset($_POST['is_active'])) ? 'active' : 'inactive';
						$this->db->where('bank_id',$id);
						$this->db->update('master_bank_table',$bank);
						echo json_encode(array('status' => 'success', 'message' => 'Bank successfully updated'));*/
						$status = TRUE;
						$message = "teast";
						echo json_encode(array('status' =>$status, 'message' => $message));
					break;
					
					case 'delete':
						$bank['is_active'] 			= 'deleted';
						$this->db->where('lower(bank_id)',strtolower($id));
						$this->db->update('master_bank_table',$bank);
						echo json_encode(array('status' => 'success', 'message' => 'Bank successfully deleted'));
					break;
					case 'check_available_bank_id':
						$bank_id = $_GET['bank_id'];
						$this->db->where('lower(bank_id)',strtolower($bank_id));
						$get = $this->db->get('master_bank_table');
						if($get->num_rows() > 0) echo 'false';
						else echo 'true';
					break;
					case 'autoComplete':
						$bank_id = $_GET['q'];
						$this->db->like('bank_id',$bank_id);
						$this->db->where_in('is_active',array('active'));
						$get = $this->db->get('master_bank_table');

						$bank_id_list = array();
						foreach($get->result() as $row) {
							$bank_id_list[] = $row->bank_id;
						}

						echo json_encode($bank_id_list);
					break;
					default:
					# code...
					break;
				}
			break;


			case 'business':

					switch ($method) {
						case 'add':

							$business_id 		= $_POST['business_id'];
							$business_name 		= $_POST['business_name'];
							$description		= $_POST['description'];
							$check_business = $this->master_business->check_available_business($business_id);

							if($check_business){
								$status = FALSE;
								$message = "ID business has been created before";	

							}else{

								$component  = array('business_id' 	=> $business_id,
													'business_name' => $business_name,	
													'description'	=> $description,
													'is_active'		=> (isset($_POST['is_active'])) ? 'active' : 'inactive',
													'created_date'	=> date("Y-m-d"),
													'created_by'	=> "Admin"
													 );	

								$this->master_business->add_business($component);
								$status = TRUE;
								$message = "Save Success";	

							}
								
							
							echo json_encode(array('status' => $status, 'message' =>$message ));
						break;

						case 'check_available':
							
								$business_name = $_GET['business_name'];
								$get = $this->db->query("select * from master_business where business_name = '".strtolower($business_name)."'");
								if($get->num_rows() == 0) echo "true";
								else echo "false";
						break;	

						case 'business_edit':

								$business_id 		= $_POST['business_id'];
								$business_name 		= $_POST['business_name'];
								$description		= $_POST['description'];

								$check_name = $this->master_business->check_available_name($business_id,$business_name );

								if($check_name){

										$status = FALSE;
										$message = "Business name has been created before";

								}else{
								$component  = array(	
													'business_name' => $business_name,	
													'description'	=> $description,
													'is_active'		=> (isset($_POST['is_active'])) ? 'active' : 'inactive'
													 );	

								$this->master_business->edit_business($business_id,$component);
								$status = TRUE;
								$message = "Edit Success";	

								}
							

								echo json_encode(array('status' => $status, 'message' =>$message ));


						break;

						case 'delete':

						$get_business = $this->master_business->get_row($id);

						if($get_business->is_active == "deleted"){

							$status = FALSE;
							$message = "Business Has been deleted before";

						}else{
							$this->master_business->delete($id);
							$status = TRUE;
							$message = "Business successfully deleted";
						}

						echo json_encode(array('status' => $status, 'message' => $message));
						break;


						default:
							# code...
							break;
					}

			break;
			case 'country':
				switch ($method) {
					case 'add':
					
					$country_id =  $_POST['country_id'];
					$country_name = $_POST['country_name'];
					$check_country = $this->master_country->check_id_country($country_id);		

					if($check_country){

						$status  = FALSE;
			 			$message = "Country has been added. Try another Id";

					}else{

						$is_active = isset($_POST['is_active']);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}			

				 		$component = array(
				 					'country_id'	 => $country_id,
									'country_name'	 => $country_name,
									'currency_symbol'=> $_POST['currency_symbol'],
									'currency_name'	 => $_POST['currency_name'],
									'description'	 => $_POST['description'],
									'is_active'		 => $v_isActive,
									'created_by'	 => "Admin",
									'created_date'	 => date("Y-m-d H:i:s")
									);


						$this->master_country->add_component($component); 
						$status  = TRUE;
			 			$message = "Success new Country";

					}
					
					echo json_encode(array('status' => $status , 'message' => $message));
					
					 		
					 	
					break;

					case 'edit' :

						$country_id   = $_POST['country_id'];
						$country_name = $_POST['country_name'];

						$is_active = isset($_POST['is_active']);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}		

						$check_name = $this->master_country->check_country_name($country_id,$country_name);

						if($check_name){
							$status = FALSE;
							$message = "Country Name Has been Created before";
						}else{

									$component = array(
				 					'country_id'	 => $country_id,
									'country_name'	 => $country_name,
									'currency_symbol'=> $_POST['currency_symbol'],
									'currency_name'	 => $_POST['currency_name'],
									'description'	 => $_POST['description'],
									'is_active'		 => $v_isActive,
									'modified_by'	 => "Admin",
									'modified_date'	 => date("Y-m-d H:i:s")
									);
								$this->master_country->edit_country($country_id,$component);

								$status  = TRUE;
								$message = "Edit Country Success";


						}


					
						echo json_encode(array('status' => $status , 'message' => $message));

					break;

					case 'delete':

						$get_country = $this->master_country->get_row_country($id);

						if($get_country->is_active == "deleted"){

							$status = FALSE;
							$message = "Country Has been deleted before";

						}else{
							$this->master_country->delete($id);
							$status = TRUE;
							$message = "Country successfully deleted";
						}

						echo json_encode(array('status' => $status, 'message' => $message));
					break;

					case 'check_available_country':
						$country_name = $_GET['country_name'];
						$get = $this->db->query("select * from master_country_table where country_name = '".strtolower($country_name)."'");
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

			case 'tax':
				switch ($method) {
					case 'add_tax':

						$tax_id  			= $_POST['tax_id'];
						$tax_name  			= $_POST['tax_name'];
						$description  		= $_POST['description'];
						$tax_base_amount  	= $_POST['tax_base_amount'];
						$tax_rate  			= $_POST['tax_rate'];
						$check_tax          = $this->master_tax->check_tax($tax_id);

						$is_active = isset($_POST['is_active']);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}		

						if($check_tax){
							$status = FALSE;
							$message = "Tax Id Has been created before";

						}else{
								$component = array(
							 			   'tax_id' 			=> $tax_id, 
										   'tax_name' 			=> $tax_name, 
										   'description'		=> $description,
										   'tax_base_amount'	=> $tax_base_amount,
										   'is_active'			=> $v_isActive,
										   'tax_rate'			=> $tax_rate,
										   'created_by'			=> "Admin"
						);
						
						$this->master_tax->add_tax($component);
						$status = TRUE;
						$message = "Save success!";

						}	

					
						echo json_encode(array('status'=>$status,'message'=>$message));

					break;

				case 'check_available_tax':
						$tax_name = $_GET['tax_name'];
						$get = $this->db->query("select * from master_tax where lower(tax_name) = '".strtolower($tax_name)."'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
				break;

				case 'edit_tax':

						$id 				= $_POST['tax_id'];
						$tax_name  			= $_POST['tax_name'];
						$description  		= $_POST['description'];
						$tax_base_amount  	= $_POST['tax_base_amount'];
						$tax_rate  			= $_POST['tax_rate'];

						$check_tax          = $this->master_tax->check_tax_name($id,$tax_name);

						$is_active = isset($_POST['is_active']);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}	


						if($check_tax){
							$status = FALSE;
							$message = "Tax Name Has been created before";

						}else{

							$component = array('tax_name' 			=> $tax_name, 
										   'description'		=> $description,
										   'tax_base_amount'	=> $tax_base_amount,
										   'tax_rate'			=> $tax_rate,
										   'created_by'			=> "Admin",
										   'is_active'			=> $v_isActive
								);
						
							$this->master_tax->edit_tax($id,$component);
							$status = TRUE;
							$message = "Edit success!";

						}		

					
						echo json_encode(array('status'=>$status,'message'=>$message));


				break;	

				case 'delete_tax':

						$get_tax_row   = $this->master_tax->get_tax_row($id);

						if($get_tax_row->is_active == "deleted"){

							$status = FALSE;
							$message = "Tax Has been deleted before";

						}else{

							$component['is_active'] = "deleted";
							$this->master_tax->edit_tax($id,$component);
							$status = TRUE;
							$message = "tax successfully deleted";
						} 
				
						

						echo json_encode(array('status' => $status, 'message' => $message));


				break;


			}

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
				$data['list_country']	= $this->master_country->list_country();
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
				$data['list_country']	= $this->master_country->list_country();
				$data['data'] = $this->master_bank->get_by_bank_id($id);
				$data['title'] = 'Bank #'.$id;
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


	function tax($page=null, $id=null){

		switch ($page) {
			case 'index':

						$get_tax = $this->master_tax->get_tax();	
						$data['get_tax']	= $get_tax ;
						$data['title']	= 'Tax';
						$this->set_content('master/tax',$data);
			break;

			case'add_tax':

						$data['data']	= '';
						$data['title']	= 'Add Tax';
						$this->set_content('master/tax_form',$data);
			break;

			case'edit_tax':

						$get_tax_row    		= $this->master_tax->get_tax_row($id);
						$data['get_tax_row']	= $get_tax_row;
						$data['title']			= 'Edit Tax';
						$this->set_content('master/tax_edit',$data);
			break;

			case'delete_tax':

						$get_tax_row    		= $this->master_tax->get_tax_row($id);
						$data['get_tax_row']	= $get_tax_row;
						$data['title']			= 'delete Tax';
						$this->set_content('master/tax_delete',$data);
			break;
		}

	}

	function generate_record($table) {
		switch ($table) {
			case 'master_bank_table':
				for($i = 1; $i <= 5000; $i++) {
					$bank['bank_id'] 			= 'BANKID7-'.$i;
					$bank['bank_name'] 			= 'BANKNAME-'.$i;
					$bank['bank_swift_code'] 	= 'BANKSWIFTCODE-'.$i;
					$bank['country_id'] 		= 0000000002;
					$bank['description'] 		= 'BANKDESCRIPTION-'.$i;
					$bank['is_active'] 			= 'active';
					$bank['entry_date']			= date('Y-m-d h:i:s');
					$bank['entry_by']			= $this->session->userdata('user_id');
					$this->db->insert('master_bank_table',$bank);
				}
			break;
			
			default:
				# code...
				break;
		}
	}

	function server($master) {
		switch ($master) {
			case 'master_bank':
				# Advance Search
				$bank_id = (isset($_POST['bank_id'])) ? $_POST['bank_id'] : '';
				$bank_name = (isset($_POST['bank_name'])) ? $_POST['bank_name'] : '';
				$country = (isset($_POST['country'])) ? $_POST['country'] : '';
				$swift_code = (isset($_POST['swift_code'])) ? $_POST['swift_code'] : '';

				$entry_date_start = (isset($_POST['entry_date_start'])) ? $_POST['entry_date_start'] : '';
				$entry_date_end = (isset($_POST['entry_date_end'])) ? $_POST['entry_date_end'] : '';
				$entry_by = (isset($_POST['entry_by'])) ? $_POST['entry_by'] : '';

				$update_date_start = (isset($_POST['update_date_start'])) ? $_POST['update_date_start'] : '';
				$update_date_end = (isset($_POST['update_date_end'])) ? $_POST['update_date_end'] : '';
				$update_by = (isset($_POST['update_by'])) ? $_POST['update_by'] : '';

				$sort_by =  (isset($_POST['sort_by'])) ? $_POST['sort_by'] : 'bank_id';
				$sort_order =  (isset($_POST['sort_order'])) ? $_POST['sort_order'] : 'asc';

				$all_data_search = $this->master_bank->advance_search($bank_id,$bank_name,$country,$swift_code,$entry_date_start,$entry_date_end,$entry_by,$update_date_start,$update_date_end,$update_by,$sort_by,$sort_order);

				# Pagination
				$page = (isset($_POST['page'])) ? $_POST['page'] : 1;
				$limit = (isset($_POST['limit'])) ? $_POST['limit'] : 50;
				$total_row = count($all_data_search);
				$total_page = ceil($total_row/$limit);
				$start_limit = ($page - 1) * $limit;


				$this->session->set_userdata(array(
					'master_bank_bank_id' => $bank_id,
					'master_bank_bank_name' => $bank_name,
					'master_bank_country' => $country,
					'master_bank_swift_code' => $swift_code,
					'master_bank_entry_date_start' => $entry_date_start,
					'master_bank_entry_date_end' => $entry_date_end,
					'master_bank_entry_by' => $entry_by,
					'master_bank_limit' => $limit
				));

				$data = $this->master_bank->advance_search($bank_id,$bank_name,$country,$swift_code,$entry_date_start,$entry_date_end,$entry_by,$update_date_start,$update_date_end,$update_by,$sort_by,$sort_order,$start_limit,$limit);

				$json['data'] = $this->load->view('advance_search/master_bank',array('data' => $data),true);
				$json['paging'] = $this->tool_model->generate_pagination($page,$total_page);
				echo json_encode($json);
			break;
				
			default:
				# code...
				break;
		}
	}


	function country($page=null,$id=null){
		switch ($page) {
			case 'edit':
			//	$id = $_POST['country_id'];
				$data['title']       = "Edit Country";
				$data['get_country'] = $this->master_country->get_row_country($id);
				$this->set_content('master/country_edit',$data);
			break;

			case 'delete':
				$data['title']       = "Delete Country";
				$data['get_country'] = $this->master_country->get_row_country($id);
				$this->set_content('master/country_delete',$data);
			break;
		}

	}
}