<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();
		

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	function dashboard(){
		$data['title']	= 'Dashboard';
		$data['new_manifest']	= $this->manifest_model->get_data_unverified();
		$data['deadline'] = $this->manifest_model->get_host_deadline('+7');
		$this->set_content('content/dashboard',$data);
	}

	function charts(){
		$chart = (isset($_GET['chart'])) ? $_GET['chart'] : 'column';
		$type_user = (isset($_GET['type_user'])) ? $_GET['type_user'] : 'shipper';
		$sort_by = (isset($_GET['sort_by'])) ? $_GET['sort_by'] : false;
		$sort_order = (isset($_GET['sort_order'])) ? $_GET['sort_order'] : 'asc';
		$limit = (isset($_GET['limit'])) ? $_GET['limit'] : false;
		$start_date = (isset($_GET['start_date'])) ? $_GET['start_date'] : false;
		$start_end = (isset($_GET['start_end'])) ? $_GET['start_end'] : false;

		if($sort_by == 'total_kg') {
			$query = $this->db->query("select m.*, sum(m.kg) as 'total_kg', c.* from manifest_data_table m join customer_table c on m.".$type_user." = c.reference_id group by m.".$type_user." order by total_kg ".$sort_order." limit ".$limit);
			$data['chart'] = $query;
		} else {
			$query = $this->db->query("select m.*, sum(m.kg) as 'total_kg', c.* from manifest_data_table m join customer_table c on m.".$type_user." = c.reference_id group by m.".$type_user." order by total_kg ".$sort_order);
			$data['chart'] = $query;			
		}

		switch ($chart) {
			case 'column':
				$this->load->view('charts/line',$data);
				break;
			case 'pie':
				$this->load->view('charts/pie',$data);
				break;			
			default:
				$this->load->view('charts/line',$data);
				break;
		}
	}


	function view($master = null,$page = null,$id_currency = null) {
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
						$data['list_currency']	= $this->master_currency->get_exchange_rate_list();
						$data['title']	= 'Master Currency';
						$this->set_content('master/currency_list',$data);
					break;
					case 'add':
						$data['title']			= 'Add Currency';
						$this->set_content('master/currency_add',$data);
					break;
					case 'edit':
						 // $id = $_GET['id'];

						$query = $this->db->query("select * from master_exchange_rate_table where exchange_rate_id = '$id_currency'");

						$data['data']			= $query->row();
						$data['title']			= 'Currency #'.$query->row("exchange_rate_name");
						$this->set_content('master/currency_edit',$data);
					break;

					case 'delete':
							// $id = $_GET['id'];
							$query = $this->db->query("select * from master_exchange_rate_table where exchange_rate_id = '$id_currency'");
							$data['data']			= $query->row();
							$data['title']			= 'Delete Currency';
						$this->set_content('master/currency_delete',$data);
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
	
	function ajax($page = null, $method = null, $id = null){
		switch ($page) {
		
			case 'country':
				switch ($method) {
					case 'add':
					
					$country_id = str_replace(' ', '', $_POST['country_id']);
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
							$regex = "/^[a-zA-Z0-9_ ]*$/";
							if (preg_match($regex, $country_name) && preg_match($regex, $country_id) ) {
						 		$component = array(
						 					'country_id'	 => $country_id,
											'country_name'	 => $country_name,
											'currency_symbol'=> $_POST['currency_symbol'],
											'currency_name'	 => $_POST['currency_name'],
											'description'	 => $_POST['description'],
											'is_active'		 => "active",
											'created_by'	 => $this->session->userdata("username"),
											'created_date'	 => date("Y-m-d H:i:s")
											);


								$this->master_country->add_component($component); 
								$status  = TRUE;
					 			$message = "Success new Country";
					 		}else{

					 			$status = FALSE;
					 			$message = "Wrong format input";

					 		}

					}
					
					echo json_encode(array('status' => $status ,'message' => $message));
					
					 		
					 	
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
									$regex = "/^[a-zA-Z0-9_ ]*$/";
									if (preg_match($regex, $country_name)) {
											$component = array(
						 					'country_id'	 => $country_id,
											'country_name'	 => $country_name,
											'currency_symbol'=> $_POST['currency_symbol'],
											'currency_name'	 => $_POST['currency_name'],
											'description'	 => $_POST['description'],
											'is_active'		 => $v_isActive,
											'modified_by'	 => $this->session->userdata("username"),
											'modified_date'	 => date("Y-m-d H:i:s")
											);
										$this->master_country->edit_country($country_id,$component);

										$status  = TRUE;
										$message = "Edit Country Success";
							}else{
										$status  = FALSE;
										$message = "wrong format input";
							}

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
						$get = $this->db->query("select * from master_country_table where country_name = '".strtolower($country_name)."' and is_active = 'active'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
					break;

					case 'autoComplete':
						$country_id = $_GET['q'];
						$this->db->like('country_id',$country_id);
						$this->db->where_in('is_active',array('active'));
						$get = $this->db->get('master_country_table');

						$country_id_list = array();
						foreach($get->result() as $row) {
							$country_id_list[] = $row->country_id;
						}

						echo json_encode($country_id_list);
					break;

				
					default:
						header("HTTP/1.0 404 Not Found");
					break;
				}
			break;
			case 'currency':
				switch ($method) {
					case 'add':

							$currency_name = $_POST['currency_name'];
							$check_currency = $this->master_currency->check_currency( $currency_name );
/*
							if(!$check_currency)
							{*/
								$this->db->set('exchange_rate_name',$_POST['currency_name']);
								$this->db->set('exchange_rate_value',$_POST['rate']);
								$this->db->set('entry_date',date('Y-m-d h:i:s'));
								$this->db->set('entry_by',$this->session->userdata('username'));
								$this->db->set('status','active');
								$this->db->insert('master_exchange_rate_table');
								$status  = 'success'; 
								$message = 'New currency has been added';
						/*	}
							else
							{
								$status  = 'warning'; 
								$message = 'Currency Name Has been created before';
							}*/
							


						echo json_encode(array('status' => $status, 'message' => $message));
					break;
					case 'edit':
						$this->db->where("exchange_rate_id",$_POST['exchange_rate_id']);
						$this->db->set('exchange_rate_name',$_POST['exchange_rate_name']);
						$this->db->set('exchange_rate_value',$_POST['exchange_rate_value']);
					//	$this->db->set('status',$_POST['status']);
						$this->db->set('update_date',date('Y-m-d h:i:s'));
						$this->db->set('update_by',$this->session->userdata('username'));
						$this->db->update('master_exchange_rate_table');
						echo json_encode(array('status' => 'success', 'message' => 'Currency has been updated'));
					break;
					case 'delete':
						$this->db->where("exchange_rate_id",$_POST['exchange_rate_id']);
						$this->db->set('update_by',$this->session->userdata('username'));
						$this->db->set('status','deleted');
						$this->db->update('master_exchange_rate_table');
						// echo json_encode(array('status' => 'success', 'message' => 'Currency has been Deleted'));
						$status = "success";
						$message = "Currency has been Deleted";
						echo json_encode(array('status' =>$status, 'message' => $message));

					break;

					case 'check_available_currency':
						$currency_name = $_GET['currency_name'];
						$get = $this->db->query("select * from master_exchange_rate_table where exchange_rate_name = '".strtolower($currency_name)."'");
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

						$tax_id  			= str_replace(' ', '', $_POST['tax_id']);
						$tax_name  			= $_POST['tax_name'];
						$description  		= $_POST['description'];
					//	$tax_base_amount  	= $_POST['tax_base_amount'];
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

							$regex = "/^[a-zA-Z0-9_ ]*$/";
								if (preg_match($regex, $tax_name) && preg_match($regex, $tax_id) ) {
											$component = array(
										 			   'tax_id' 			=> $tax_id, 
													   'tax_name' 			=> $tax_name, 
													   'description'		=> $description,
													 //  'tax_base_amount'	=> $tax_base_amount,
													   'is_active'			=> $v_isActive,
													   'tax_rate'			=> $tax_rate,
													   'created_by'			=> $this->session->userdata("username")
									);
									
									$this->master_tax->add_tax($component);
									$status = TRUE;
									$message = "Save success!";
							}else{
								$status = FALSE;
								$message = "Wrong format input";
							}
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
						//$tax_base_amount  	= $_POST['tax_base_amount'];
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

								$regex = "/^[a-zA-Z0-9_ ]*$/";
								if (preg_match($regex, $tax_name)) {
										$component = array('tax_name' 		=> $tax_name, 
													   'description'		=> $description,
													//   'tax_base_amount'	=> $tax_base_amount,
													   'tax_rate'			=> $tax_rate,
													   'update_by'			=> $this->session->userdata("username"),
													   'is_active'			=> $v_isActive,
													   'update_date'		=> date('Y-m-d')

											);
									
										$this->master_tax->edit_tax($id,$component);
										$status = TRUE;
										$message = "Edit success!";
								}else{

									$status = FALSE;
									$message = "Wrong format input";

								}
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

				case 'autoComplete':
								$business_id = $_GET['q'];
								$this->db->like('tax_id',$business_id);
								$this->db->where_in('is_active',array('active'));
								$get = $this->db->get('master_tax');

								$tax_id_list = array();
								foreach($get->result() as $row) {
									$tax_id_list[] = $row->tax_id;
								}
								echo json_encode($tax_id_list);
				break;
			}
			break;

				case 'partner':
						switch ($method) {
							case 'partner_add':

							$is_active = isset($_POST['is_active']);

								if($is_active != "" ){
										$v_isActive = "active";
								}else{
										$v_isActive = "inactive";
								}		

							$partner_id =  str_replace(' ', '', $_POST['partner_id']);
							$partner_name = $_POST['partner_name'];
							$check_partner = $this->partner_model->check_avaiable_partner($partner_id,$partner_name);
							$check_partner_id = $this->partner_model->check_partner_id($partner_id);

							if($check_partner_id){
								$status = FALSE;
								$message = "Partner Id has been used before. Please use another Partner ID";
							}else{

								$regex = "/^[a-zA-Z0-9_ ]*$/";
								if (preg_match($regex, $partner_name) && preg_match($regex, $partner_id) ) {
											$data = array(
															'partner_id'		=> $partner_id,
															'company_name'		=> $partner_name ,
															'telephone_number'	=> $_POST['telephone'],
															'email'				=> $_POST['email'],
															'second_email'		=> $_POST['second_email'],
															'third_email'		=> $_POST['third_email'],
															'fourth_email'		=> $_POST['fourth_email'],
															'address'			=> $_POST['address'],
															'city'				=> htmlspecialchars($_POST['city']),
															'country_id'		=> $_POST['country'],
															'zipcode'			=> htmlspecialchars($_POST['zipcode']),
															'description'		=> $_POST['description'],
															'is_active'			=> "active",
															'entry_by'			=> $this->session->userdata("username"),
															'entry_date'		=> date('Y-m-d h:m:s')
														);
											$this->partner_model->add_partner($data);

											$status = TRUE;
											$message = "Save Success";
								}else{
											$status = FALSE;
											$message = "wrong format input";

								}

							}
								
								echo json_encode(array('status' => $status,'message'=>$message));

							break;

							case 'edit':

								$is_active = isset($_POST['is_active']);

								if($is_active != "" ){
										$v_isActive = "active";
								}else{
										$v_isActive = "inactive";
								}		

								$partner_id 	= $_POST['partner_id'];
								$partner_name 	= $_POST['partner_name'];
								$check_partner 	= $this->partner_model->check_avaiable_partner($partner_id,$partner_name);

								if($check_partner){
									$status  = FALSE;
									$message = "Partner has been created before";
								}else{

									$regex = "/^[a-zA-Z0-9_ ]*$/";
									if (preg_match($regex, $partner_name)) {
										$data = array(
														'partner_id'		=> $partner_id,
														'company_name'		=> $partner_name,
														'telephone_number'	=> $_POST['telephone'],
														'email'				=> $_POST['email'],
														'second_email'		=> $_POST['second_email'],
														'third_email'		=> $_POST['third_email'],
														'fourth_email'		=> $_POST['fourth_email'],
														'address'			=> $_POST['address'],
														'city'				=> htmlspecialchars($_POST['city']),
														'country_id'		=> $_POST['country'],
														'zipcode'			=> htmlspecialchars($_POST['zipcode']),
														'description'		=> $_POST['description'],
														'is_active'			=> $v_isActive,
														'update_by'			=> $this->session->userdata("username"),
														'update_date'		=> date('Y-m-d')
													);
										$this->partner_model->update_partner($partner_id,$data);

										$status = TRUE;
										$message = "Update Success";
									}else{
										$status = FALSE;
										$message = "wrong format input";
									}
								}

									echo json_encode(array('status' => $status,'message'=>$message));



							break;

							case 'check_available_partner':

									$partner_name = $_GET['partner_name'];
									$get = $this->db->query("select * from partner where lower(company_name) = '".strtolower($partner_name)."'");
									if($get->num_rows() == 0) echo "true";
									else echo "false";
							break;

							case 'delete_partner':

								$get_partner = $this->partner_model->get_partner_row($id);

								if($get_partner->is_active == "deleted"){

									$status = FALSE;
									$message = "Partner has been deleted before";	

								}else{
								$data['is_active'] = "deleted";
								$this->partner_model->update_partner($id,$data);
								$status = TRUE;
								$message = "Deleted Success";
								
								}
								echo json_encode(array('status' => $status,'message'=>$message));
							break;

							case 'autoComplete':
								$partner_id = $_GET['q'];
								$this->db->like('partner_id',$partner_id);
								$this->db->where_in('is_active',array('active'));
								$get = $this->db->get('partner');

								$partner_id_list = array();
								foreach($get->result() as $row) {
									$partner_id_list[] = $row->partner_id;
								}
								echo json_encode($partner_id_list);
							break;
						}

				break;
		}
	}


	function user($page=null,$user_id=null){

		switch ($page) {
			case 'index':
						$data['get_user']			= $this->master_user->get_all_user();
						$data['title']			= 'User Access';
						$this->set_content('master/master_user',$data);
			break;

			case'add_user':

						$data['get_type']			= $this->master_user->get_access();
						$data['title']	= 'Add User';
						$this->set_content('master/user_form',$data);
			break;

			case 'update':

						$data['get_type']			= $this->master_user->get_access();
						$data['get_user']			= $this->master_user->get_user_by_id($user_id);
						$data['title']				= 'Edit Form';
						$this->set_content('master/user_edit_form',$data);

			break;

			case 'delete':

						$data['get_type']			= $this->master_user->get_access();
						$data['get_user']			= $this->master_user->get_user_by_id($user_id);
						$data['title']				= 'Delete Form';
						$this->set_content('master/user_delete_form',$data);

			break;

			case 'insert_user':

						$user_id 		=  $_POST['user_id'];
						$username 		=  $_POST['username'];
						$password 		=  $_POST['password'];
						$email			=  $_POST['email'];
						$user_level 	=  $_POST['user_level'];
						$description	=  $_POST['description'];
						$is_active 		=  isset($_POST['status_active']);
						$check_id		=  $this->master_user->check_available_id($user_id);
						$check_user		=  $this->master_user->check_available($username);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}	


					if($check_id) {

							$status = FALSE;
							$message = "User Id has been added before";	

					}else{
						
							if($check_user){

								$status = FALSE;
								$message = "Username has been added before";	

							}else{


								$regex = "/^[a-zA-Z0-9_ ]*$/";
								if (preg_match($regex, $username) && preg_match($regex, $user_id) ) {
								    // Indeed, the expression "[a-zA-Z]+ \d+" matches "June 24"
								    $data['user_id']		= $user_id;
									$data['username']		= $username;
									$data['password']		= $password;
									$data['email']			= $email;
									$data['type']			= $user_level;
									$data['description']	= $description;
									$data['status']			= $v_isActive;
									$data['created_by']		= $this->session->userdata('username');
									$data['created_date']	= date('Y-m-d');
									$this->master_user->insert_user($data);

									$status = TRUE;
									$message = "Save Success";	

								} else {

								   	$status = FALSE;
									$message = "Wrong format input";	
								}


								
							}


					}

						
						
						echo json_encode(array('status'=>$status ,'message' => $message));



			break;

			case 'update_user':

						$user_id 		=  $_POST['user_id'];
						$username 		=  $_POST['username'];
						$password 		=  $_POST['password'];
						$email			=  $_POST['email'];
						$user_level 	=  $_POST['user_level'];
						$description	=  $_POST['description'];
						$is_active 		=  isset($_POST['status_active']);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}	

						$check_user		=  $this->master_user->check_available_update($user_id,$username);
						if($check_user){

							$status = FALSE;
							$message = "User has been added before";	

						}else{
						

						$regex = "/^[a-zA-Z0-9_ ]*$/";
						if (preg_match($regex, $username)) {
									$data['username']		= $username;
									$data['password']		= $password;
									$data['email']			= $email;
									$data['type']			= $user_level;
									$data['description']	= $description;
									$data['status']			= $v_isActive;
									$data['update_by']		= $this->session->userdata('username');
									$data['update_date']	= date('Y-m-d');


									$this->master_user->edit_user($user_id,$data);
									$status = TRUE;
									$message = "Edit Success";
						}else{

									$status = FALSE;
									$message = "Wrong format input";	
						}
					}
						echo json_encode(array('status'=>$status ,'message' => $message));

			break;

			case 'delete_user':

						$user_id 				=  $_POST['user_id'];
						$data['status']			= "deleted";
						$this->master_user->edit_user($user_id,$data);
						echo json_encode(array('message' => "Delete Success"));
			break;

			case 'autoComplete':
								$user_id = $_GET['q'];
								$this->db->like('user_id',$user_id);
								$this->db->where_in('status',array('active'));
								$get = $this->db->get('user_table');

								$user_id_list = array();
								foreach($get->result() as $row) {
											$user_id_list[] = $row->user_id;
								}
								echo json_encode($user_id_list);
				break;

		

		

				
		}

	}

	function add_user_role($page=null, $id_type=null){

		switch ($page) {
			case 'index':
						$data['get_type']			= $this->master_user->get_access();
						$data['title']			= 'User Role';
						$this->set_content('master/user_role',$data);
			break;

			case'add_form':

						$data['data']	= '';
						$data['title']	= 'Add Role';
						$this->set_content('master/role_add',$data);
			break;

			case'edit_form':
						//get_access_level
						$data['get_role']		= $this->master_user->get_role_by_row($id_type);
						$data['get_checked']	= $this->master_user->get_checked_by_row($id_type);
						$data['title']			= 'Edit Role';
						$this->set_content('master/role_edit',$data);
			break;

			case'delete_form':
						//get_access_level
						$data['get_role']		= $this->master_user->get_role_by_row($id_type);
						$data['get_checked']	= $this->master_user->get_checked_by_row($id_type);
						$data['title']			= 'Edit Role';
						$this->set_content('master/role_delete',$data);
			break;

			case 'add_role':

					$type = $_POST['type'];
					$role = $_POST['role'];
					$description = $_POST['description'];
					$is_active = isset($_POST['status_active']);

					$check_id_type = $this->master_user->check_id_type($id_type);

					if($check_id_type){
						$status = FALSE;
						$message = "Type Id Has been created before";
					}else{

						//$message = "";

						if($is_active != "" ){
								$v_isActive = "active";
						}else{
								$v_isActive = "inactive";
						}	

						

										// $data['id_type']		= $id_type;
										$data['type']			= htmlspecialchars($type);
										$data['created_by']		= $this->session->userdata('user_id');
										$data['created_date']	= date('Y-m-d');
										$data['status']			= $v_isActive;
										$data['description']	= htmlspecialchars($description);
										$this->master_user->insert_type($data);

										$id_type = $this->db->insert_id();


										 for ($i=0; $i < sizeof($role) ; $i++) { 
												
												$component['id_type']		= $id_type;
												$component['access_level']	= $role[$i];

												$this->master_user->insert_role($component);
										
										 }

								    $status = TRUE;		 
									$message = "Save Success";
							

					}

					
					
					echo json_encode(array('status' => $status , 'message' => $message));
			break;

			case 'edit_role':


					$id_type = $_POST['id_type'];
					$type = $_POST['type'];
					$role = $_POST['role'];
					$description = $_POST['description'];
					$is_active 		=  isset($_POST['status_active']);

						if($is_active != "" ){
							$v_isActive = "active";
						}else{
							$v_isActive = "inactive";
						}	

						$regex = "/^[a-zA-Z0-9_ ]*$/";
						if (preg_match($regex, $type)) {
					$data['type']			= $type;
					$data['update_by']		= $this->session->userdata('user_id');
					$data['update_date']	= date('Y-m-d');
					$data['description']	= $description;
					$data['status']			= $v_isActive ;
					$this->master_user->update_type($id_type,$data); 

					 for ($i=0; $i < sizeof($role) ; $i++) { 

					 		$this->master_user->delete_role($id_type);
					 }
						
					 for ($i=0; $i < sizeof($role) ; $i++) { 
							
						

							$component['id_type']		= $id_type;
							$component['access_level']	= $role[$i];

							$this->master_user->insert_role($component);
					
					 }
					$status = TRUE; 
					$message = "Edit success";

				}else{
					$status = FALSE; 
					$message = "Wrong format input";

				}
					echo json_encode(array('status'=>$status,'message' =>$message));



			break;

			case 'delete_role':

						$id_type = $_POST['id_type'];
						$data['status'] = "deleted";
						$this->master_user->update_type($id_type,$data);

						$message = "Delete Success";
						echo json_encode(array('message' => $message));
			break;


		case 'autoComplete':
				$id_type = $_GET['q'];
				$this->db->like('id_type',$id_type);
				$this->db->where_in('status',array('active'));
				$get = $this->db->get('user_type_table');

				$id_type_list = array();
				foreach($get->result() as $row) {
					$id_type_list[] = $row->id_type;
				}
				echo json_encode($id_type_list);
		break;

		case 'check_available_type':

				$type = $_GET['type'];
				$get = $this->db->query("select * from user_type_table where lower(type) = '".strtolower($type)."'");
				if($get->num_rows() == 0) echo "true";
				else echo "false";
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