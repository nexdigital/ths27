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
					$address = $_POST['address'];
					$city = $_POST['city'];
					$country = $_POST['country'];
					$pos_code = $_POST['zip_code'];
					$phone = $_POST['phone'];
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
							$data['name'] 		  = $name;
							$data['email'] 		  = $email;
							$data['address'] 	  = $address;
							$data['attn'] 		  = $attn;
							$data['city']         = $city;
							$data['country']      = $country;
							$data['pos_code'] 	  = $pos_code;
							$data['phone'] 		  = $phone;
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

					$reference_id = $_POST['reference'];
					$data['reference_id'] = str_replace(' ', '', $reference_id );
				//	$data['id_group'] 	  = $_POST['id_group'];
					$data['name'] 		  = $_POST['name'];
					$data['email'] 		  = $_POST['email'];
					$data['address'] 	  = $_POST['address'];
					$data['attn'] 		  = $_POST['attn'];
					$data['city']         = $_POST['city'];
					$data['country']      = $_POST['country'];
					$data['pos_code'] 	  = $_POST['post_code'];
					$data['phone'] 		  = $_POST['phone'];
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
							
					
						foreach($to as $key => $value){
							
							
							if($_SERVER['HTTP_HOST'] != 'ths27.nexdigital.net') {
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
								
								$component = array( 'to' => $value,
													'subject' => $subject,
													'message' => $message,
													'create_by' => $this->session->userdata('username'),
													'date'		=> date('Y-m-d'));			
								$this->customers_model->save_email($component);

								$status		= true;
								$message	= "Email has been sent.";
			                } 
						}
						
						echo json_encode(array("status"=> $status, "message" => $message ));


				break;

				case 'print_label':

						$name = "test";
						$file_path = base_url('asset/pdf').$name.'.pdf';
						$this->load->library('pdf');
						$pdf = $this->pdf->load();
						$data = "testr";
						$html = $this->load->view('download/airwaybill',$data,true);  
						$pdf->WriteHTML($html);
						$pdf->Output($file_path, 'I');
						echo json_encode(array("status"=> true, "message" => "test"));
				break;
		}
	}
	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */