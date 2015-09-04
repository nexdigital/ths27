<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */




	function __construct() {
		parent::__construct();
		//  session_start();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	public function home() {
		$data['get_customers']	= $this->customers_model->get_data();
		$data['title']			= 'Customers';
		$this->set_content('customers/customers_list',$data);

		/**
		$data['get_customers']  = $this->customers_model->get_data();
		$json['content']		= $this->load->view('customers/customers_list',$data,true);
		$json['title']			= 'Customers';
		echo json_encode($json);
		//break;
		**/
	}

	//function view_customer($reference_id){
	function view_customer($reference_id){

		$data['get_tax']		= $this->tool_model->get_tax();
		$data['get_customers'] 	= $this->customers_model->get_by_id($reference_id);
	//	$data        	        = array();
		$data['title']			= 'Edit Customer';
		$this->set_content('customers/customer_view',$data);

		/**
		$data['get_customers']  = $this->customers_model->get_by_id($reference_id);
		$json['content']		= $this->load->view('customers/customer_view',$data,true);
		$json['title']			= 'View Customers';
		echo json_encode($json);
		**/
	}

	function add_customer(){
		$data['reference_id']	= $this->customers_model->customer_new_id();
		$data['get_group']		= $this->master_customer->get_group();
		if(isset($_GET['hawb_no'])) {
			$data['data_host']		= $this->manifest_model->get_data($_GET['hawb_no']);
			$data['customer_type']		= $_GET['customer_type'];
		}
		$data['title']			= 'Add Customer';
		$this->set_content('customers/customer_add',$data);

		/**
		$reference_id = $this->customers_model->customer_new_id();
		$get_group = $this->master_customer->get_group();
		$data = array('reference_id'=> $reference_id,
				       'get_group'  =>$get_group
					  );
		$json['content'] 	= $this->load->view('customers/customer_add',$data,true);
		$json['title']			= 'Add Customers';
		echo json_encode($json);
		**/
	}


	function delete_customer($reference_id){
				$data['get_tax']		= $this->tool_model->get_tax();
				$data['get_customers'] 	= $this->customers_model->get_by_id($reference_id);
			//	$data        	        = array();
				$data['title']			= 'Customer Delete';
				$this->set_content('customers/customer_delete',$data);
	}

	function email(){
		$data['data']		= array('');
		$data['title']		= 'Email Form';
		$this->set_content('customers/email',$data);
	}

	function ajax($page = null){
			switch ($page) {
				case 'add_customer':

					$reference_id =  $_POST['reference_id'];
					$name =  $_POST['name'];
					$attn =  $_POST['attn'];
					$email = $_POST['email'];
					$second_email = $_POST['second_email'];
					$third_email = $_POST['third_email'];
					$address = $_POST['address'];
					$city = $_POST['city'];
					$country = $_POST['country'];
					$pos_code = $_POST['zip_code'];

					$phone = $_POST['phone'];
					$c_phone = $_POST['c_phone'];

					$second_phone = $_POST['second_phone'];
					$second_c_phone = $_POST['second_c_phone'];

					$third_phone = $_POST['third_phone'];
					$third_c_phone = $_POST['third_c_phone'];

					$mobile = $_POST['mobile'];
					$fax = $_POST['fax'];
					$tax_class = $_POST['tax_class'];
					$description = $_POST['description'];
					

					$regex = "/^[A-Za-z0-9_\-.\/]+$/";
						// if (preg_match($regex, $reference_id) && preg_match($regex, $name) 
						// 	&& preg_match($regex, $attn) && preg_match($regex, $city)
						// 	&& preg_match($regex, $pos_code) && preg_match($regex, $phone) &&preg_match($regex, isset($mobile))
						// 	&& preg_match($regex, $fax)) {

							$data['reference_id'] = str_replace(' ', '', $reference_id );
							$data['name'] 		  = htmlspecialchars($name);
							$data['email'] 		  = $email;
							$data['second_email'] = $second_email;
							$data['third_email']  = $third_email;
							$data['address'] 	  = htmlspecialchars($address);
							$data['attn'] 		  = htmlspecialchars($attn);
							$data['city']         = htmlspecialchars($city);
							$data['country']      = $country;
							$data['pos_code'] 	  = htmlspecialchars($pos_code);
							$data['code_phone']   = $c_phone;
							$data['phone'] 		  = $phone;

							$data['second_c_phone']   = $second_c_phone;
							$data['second_phone'] 		  = $second_phone;

							$data['third_c_phone']   = $third_c_phone;
							$data['third_phone'] 		  = $third_phone;


							$data['mobile'] 	  = $mobile;
							$data['fax'] 		  = $fax;
							$data['tax_class'] 	  = $tax_class;
							$data['description']  = $description;
							$data['status_active']= "Active";
							$data['create_date']  = date('Y-m-d H:i:s');
							$data['create_by']	  = $this->session->userdata('username'); 

							$this->customers_model->save_customer($data);


							if(isset($_POST['hawb_no']) && $_POST['hawb_no'] && isset($_POST['customer_type']) && in_array($_POST['customer_type'], array('shipper','consignee'))) {
								$this->manifest_model->set_customer($_POST['hawb_no'],$_POST['customer_type'],$data['reference_id']);
								$data = $this->manifest_model->get_data($_POST['hawb_no']);
								$file = $this->manifest_model->get_file($data->file_id);

								$status = "redirect";
								$message = base_url('manifest/view/verification_details?mawb_no='.urlencode($file->mawb_no));
								//echo json_encode(array('status'=> 'redirect', 'message'=> $message ));
							} else {
								$status = "success";
								$message = "Save success";
								//echo json_encode(array('status'=> 'success', 'message'=> 'Save success'));
							}


						// }else{

						// 		$status = "unsuccess";
						// 		$message = "wrong input format";
						// }
								
								echo json_encode(array('status'=> $status, 'message'=> $message));

				break;

				case 'edit_customer':


					$second_email = $_POST['second_email'];
					$third_email = $_POST['third_email'];

					$second_phone = $_POST['second_phone'];
					$second_c_phone = $_POST['second_c_phone'];

					$third_phone = $_POST['third_phone'];
					$third_c_phone = $_POST['third_c_phone'];


					$reference_id = $_POST['reference_id'];
					$data['reference_id'] = str_replace(' ', '', $reference_id );
				//	$data['id_group'] 	  = $_POST['id_group'];
					$data['name'] 		  = htmlspecialchars($_POST['name']);
					$data['email'] 		  = $_POST['email'];
					$data['second_email'] = $second_email;
					$data['third_email']  = $third_email;
					$data['address'] 	  = htmlspecialchars($_POST['address']);
					$data['attn'] 		  = htmlspecialchars($_POST['attn']);
					$data['city']         = htmlspecialchars($_POST['city']);
					$data['country']      = $_POST['country'];
					$data['pos_code'] 	  = htmlspecialchars($_POST['zip_code']);

					$data['code_phone']   = $_POST['c_phone'];
					$data['phone'] 		  = $_POST['phone'];

					$data['second_c_phone']   		= $second_c_phone;
					$data['second_phone'] 		  	= $second_phone;

					$data['third_c_phone']   		= $third_c_phone;
					$data['third_phone'] 		  	= $third_phone;

					$data['mobile'] 	  = $_POST['mobile'];
					$data['fax'] 		  = $_POST['fax'];
					$data['tax_class'] 	  = $_POST['tax_class'];
					$data['description']  = $_POST['description'];
					$data['status_active']= (isset($_POST['is_active'])) ? 'Active' : 'inactive';
					$data['update_date']  = date('Y-m-d H:i:s');
					$data['update_by']	  = $this->session->userdata('username'); 
					$this->customers_model->customer_edit($reference_id,$data);
					$status  = TRUE;
					$message = "Edit success";
					echo json_encode(array("status"=> $status, "message" => $message));

				break;

				case 'delete_customer':

						$reference_id = $_POST['reference'];
						$data['status_active']= "deleted";
						$this->customers_model->customer_edit($reference_id,$data);

						echo json_encode(array("status"=> TRUE, "message" => "Delete Success"));


				break;

				case 'check_available_customers':

						$reference_id = $_GET['reference_id'];
						$get = $this->db->query("select * from customer_table where reference_id = '".strtolower($reference_id)."'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
				break;

				case 'send_email':

							$to 		= $_POST['to'];
							$subject 	= $_POST['subject'];
							$message 	= $_POST['message'];

							/*if($_SERVER['HTTP_HOST'] != 'ths27.nexdigital.net') {
								$config = array(

										'protocol' => 'smtp',
										'smtp_host' => 'ssl://smtp.gmail.com',
										'smtp_port' => 465,
										'smtp_user' => 'sahala161189@gmail.com',
										'smtp_pass' => 'sahalamorgantobings',
										'mailtype'	=> 'html'
								);
								$this->email->initialize( $config );
							}
							$this->email->set_newline( "\r\n" );
							$this->email->from( "tataharmoni18@gmail.com", "No Reply" );
							$this->email->to( $to );
							$this->email->subject( $subject);
							$this->email->message( $message );
							if( !$this->email->send() ) {
								$status		= false;
								$message	= show_error($this->email->print_debugger());
							} else {
								
								$component = array( 'to' => $to,
													'subject' => $subject,
													'message' => $message,
													'create_by' => $this->session->userdata('username'),
													'date'		=> date('Y-m-d'));			
								$this->customers_model->save_email($component);

								$status		= true;
								$message	= "Email has been sent.";
			                } */
							
						if($_SERVER['HTTP_HOST'] != 'ths27.nexdigital.net') {
								$config = array(

										'protocol' => 'smtp',
										'smtp_host' => 'ssl://smtp.gmail.com',
										'smtp_port' => 465,
										'smtp_user' => 'sahala161189@gmail.com',
										'smtp_pass' => 'sahalamorgantobings',
										"mailtype"	=> "html",
										"charset"	=> "utf-8",
										"newline"	=> "\n",
										"wordwrap"	=> true
								);
								$this->email->initialize( $config );
							}
					
						foreach($to as $key => $value){
							$this->email->set_newline( "\r\n" );
							$this->email->from( "tataharmoni18@gmail.com", "No Reply" );
							$this->email->to( $value );
							$this->email->subject( $subject);
							$this->email->message( $message );
							if( !$this->email->send() ) {
								$status		= false;
								$message_alert	= show_error($this->email->print_debugger());
								break;
							} else {
								
								$component = array( 'to' => $value,
													'subject' => $subject,
													'message' => $message,
													'create_by' => $this->session->userdata('username'),
													'date'		=> date('Y-m-d'));			
								$this->customers_model->save_email($component);

							
			                } 
			                	$status		= true;
								$message_alert	= "Email has been sent.";
						}
						
						echo json_encode(array("status"=> $status, "message" => $message_alert ));


				break;

				case 'print_label':

						error_reporting( 0 );
						$this->load->library('pdf');
						$pdf = $this->pdf->load();

						$name = $_POST['name'];

						$filename = time().'_'.str_ireplace(' ','_',trim($name));

						$data['name'] =$name   ;
						$data['attn'] =  $_POST['attn'];
						$data['address'] =  $_POST['address'];
						$data['phone'] =  $_POST['phone'];

						$get_country_name = $this->master_country->get_row_country($_POST['country']);
						$data['country'] =  $get_country_name->country_name;

						$html = $this->load->view('customers/pdf',$data,true);
						$pdf->WriteHTML($html);
						$pdf->Output(path_pdf . $filename .'.pdf', 'F');
						echo json_encode(array('redirect' => base_url('asset/pdf/'.$filename.'.pdf')));				
				break;

				case 'autoComplete':
						$name = $_GET['q'];
						$this->db->like('name',$name);
						$this->db->where_in('status_active',array('active'));
						$get = $this->db->get('customer_table');

						$name_customers_list = array();
						foreach($get->result() as $row) {
							$name_customers_list[] = $row->name;
						}

						echo json_encode($name_customers_list);
				break;

			case 'check_available_name':

						$name = $_GET['name'];
						$reference_id = $_GET['reference_id'];
						$get = $this->db->query("select * from customer_table where name = '".strtolower($name)."' And status_active = 'Active' And reference_id != '".$reference_id."' ");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
			break;

			case 'search':

						
						$search        = $_POST['search_input'];
						$message = "";
						
						if(isset($search))
						{
									$get_customers =  $this->customers_model->get_customer_search($search);
				
						}else{
									$get_customers =  $this->customers_model->get_data();
						}

						if(sizeof($get_customers) > 0){

									foreach ($get_customers as $key => $value) {
											
											$message 	.= "<tr>
																	<td>".$value->reference_id."</td>
																	<td>".$value->name."</td>
																	<td>".$value->attn."</td>
																	<td>".$value->country_name."</td>
																	<td>(".$value->code_phone.")".$value->phone."</td>
																	<td>".$value->create_by."</td>
																	<td>".$value->create_date."</td>
																	<td>".$value->update_by."</td>
																	<td>".$value->update_date."</td>
																	<td>".$value->status_active."</td>
														   <tr>";
												   
									}
						}else{
							$message 	= "No available data";
						}
						
								
						$status 	=  TRUE;
						echo json_encode(array('status' => $status , 'message' => $message));				
			break;

			case 'print_csv' :

						$search        = $_POST['search_input'];
						//$message = "";
						
						if(isset($search))
						{
									$get_customers =  $this->customers_model->get_customer_search($search);
				
						}else{
									$get_customers =  $this->customers_model->get_data();
						}
								
						$status 	=  TRUE;
						echo json_encode(array('status' => $status , 'message' => $message));				


			break;

		}
	}
	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */