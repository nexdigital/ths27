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
		$data['menu']			= "Master";
		$data['submenu']		= "Customers";
		$data['get_customers']	= $this->customers_model->get_data();
		$data['title']			= 'Customers';
		$this->set_content('customers/customers_list',$data);

	}

	//function view_customer($reference_id){
	function view_customer($reference_id){

		$data['get_tax']		= $this->tool_model->get_tax();
		$data['get_customers'] 	= $this->customers_model->get_by_id($reference_id);
		$data['menu']			= "Master > Customers";
		$data['submenu']		= "View Customer";
		$data['title']			= 'Edit Customer';
		$this->set_content('customers/customer_view',$data);
	}

	function view_customer_name($name)
	{
		$data['get_tax']		= $this->tool_model->get_tax();
		$data['get_customers'] 	= $this->customers_model->get_by_name($name);
		$data['title']			= 'Edit Customer';
		$this->set_content('customers/customer_view',$data);
	}

	function add_customer(){

		foreach ($this->customers_model->customer_new_id() as $key => $value) {
			$angka  = $value->reference_id;
			$cus  = substr($angka,0,4);
			$back  = substr($angka,4);
			$tambah = $back + 1;
			
			$data['reference_id'] = $cus.sprintf('%06d',$tambah) ;
		}
		
		$data['get_group']		= $this->master_customer->get_group();
		if(isset($_GET['hawb_no'])) {
			$data['data_host']		= $this->manifest_model->get_data($_GET['hawb_no']);
			$data['customer_type']		= $_GET['customer_type'];
		}
		$data['menu']			= "Master > Customers";
		$data['submenu']		= "Add Customer";
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
					$data['menu']			= "Master > Customers";
					$data['submenu']		= "Delete Customer";
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
					if($this->session->userdata('login') == TRUE){


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
					

					$check_customers = $this->customers_model->check_customers($reference_id);
					if($check_customers)
					{
						$angka  = $reference_id;
						$cus  = substr($angka,0,4);
						$back  = substr($angka,4);
						$tambah = $back + 1;
			
						

						$status = "no_available";
						$message = "Reference Id has been used before. Please try again to submit after window is close";
						$new_reference = $cus.sprintf('%06d',$tambah);
					}else{
						
							$regex = "/^[A-Za-z0-9_\-.\/]+$/";
						
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
								$new_reference = "";
								//echo json_encode(array('status'=> 'redirect', 'message'=> $message ));
							} else {
								$status = "success";
								$message = "Save success";
								$new_reference = "";
								//echo json_encode(array('status'=> 'success', 'message'=> 'Save success'));
							}

	
					}

				}
						echo json_encode(array('status'=> $status, 'message'=> $message,'new_reference'=>$new_reference));

				break;

				case 'edit_customer':

					if($this->session->userdata('login') == TRUE){
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
				}
					echo json_encode(array("status"=> $status, "message" => $message));

				break;

				case 'delete_customer':

				//	$update_by = $this->session->userdata('username');
					if( $this->session->userdata('login') == TRUE){

						$data['update_date']  = date('Y-m-d H:i:s');
						$data['update_by']	  = $this->session->userdata('username'); 
						$reference_id = $_POST['reference'];
						$data['status_active']= "deleted";
						$this->customers_model->customer_edit($reference_id,$data);
						$status =  TRUE;
						$message = "Delete Success";
					}else{
						$status =  FALSE;
						$message = "Delete Unsuccessfully";
					}

						echo json_encode(array("status"=> $status , "message" => $message));


				break;

				case 'check_available_customers':

						$reference_id = $_GET['reference_id'];
						$get = $this->db->query("select * from customer_table where reference_id = '".strtolower($reference_id)."'");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
				break;

				case 'send_email':
						if($this->session->userdata('login') == TRUE){
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
						
					}else{
								$status		= lose;
								$message_alert	= "Failed to sent email.";
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

				case 'autoCompleteID':
						$reference_id = $_GET['q'];
						$this->db->like('reference_id',$reference_id);
					//	$this->db->where_in('status_active',array('active'));
						$get = $this->db->get('customer_table');

						$ID_customers_list = array();
						foreach($get->result() as $row) {
							$ID_customers_list[] = $row->reference_id;
						}

						echo json_encode($ID_customers_list);
				break;

				case 'autoComplete':
						$name = $_GET['q'];
						$this->db->like('name',$name);
				//		$this->db->where_in('status_active',array('active'));
						$get = $this->db->get('customer_table');

						$name_customers_list = array();
						foreach($get->result() as $row) {
							$name_customers_list[] = $row->name;
						}

						echo json_encode($name_customers_list);
				break;

				case 'autoComplete_attn':
						$attn = $_GET['q'];
						$this->db->like('attn',$attn);
				//		$this->db->where_in('status_active',array('active'));
						$get = $this->db->get('customer_table');

						$name_customers_attn = array();
						foreach($get->result() as $row) {
							$name_customers_attn[] = $row->attn;
						}

						echo json_encode($name_customers_attn);
				break;

				case 'autoComplete_phone':
						$phone = $_GET['q'];
						$this->db->like('phone',$phone);
					//	$this->db->where_in('status_active',array('active'));
						$get = $this->db->get('customer_table');

						$name_customers_phone = array();
						foreach($get->result() as $row) {
							$name_customers_phone[] = $row->phone;
						}

						echo json_encode($name_customers_phone);
				break;

			case 'check_available_name':

						$name = $_GET['name'];
						$reference_id = (isset($_GET['reference_id'])) ? $_GET['reference_id'] : null ;
						$get = $this->db->query("select * from customer_table where name = '".strtolower($name)."' And status_active = 'Active' And reference_id != '".$reference_id."' ");
						if($get->num_rows() == 0) echo "true";
						else echo "false";
			break;

			case 'search':

						
						$reference_id        	= $this->input->post('reference_id');
						$name 		   			= $this->input->post('name');
						$attn 					= $this->input->post('attn');
						$country 				= $this->input->post('country');
						$phone 					= $this->input->post('phone');
						$country 				= $this->input->post('country');
						$entry_date 			= $this->input->post('entry_date');
						$entry_by 				= $this->input->post('entry_by');
						$modified_by 			= $this->input->post('modified_by');
						$modified_date 			= $this->input->post('modified_date');
						$status 				= $this->input->post('status');

						$message 				= '<table id="example2" class="table  table-striped table-hovered">         
													  <thead>
													    <th row_name="cust_ref_id">Reference ID</th>
													    <th row_name="cust_name">Name</th>
													    <th row_name="cust_attn">Attn</th>
													    <th row_name="cust_country">Country</th>
													    <th row_name="cust_telp_number">Telepon Number</th>
													    <th row_name="cust_entry_by">Entry by</th>
													    <th row_name="cust_entry_date">Entry date</th>
													    <th row_name="cust_modified_by">Modified by</th>
													    <th row_name="cust_modified_date">Modified date</th>
													    <th row_name="cust_status">Status</th>

 													 </thead>';
						$where   				= "" ;

						if($reference_id  != "")
						{		
							$where .= "WHERE a.reference_id like '%".$reference_id."%'" ;
						}
						if($name  != "")
						{		
							  $where .= $where != "" ? " AND a.name like '%".$name."%'" : "WHERE a.name like '%".$name."%'" ; 
					 	}
					 	 if($attn  != "")
						{		
							  $where .= $where != "" ? " AND a.attn like '%".$attn."%'" : "WHERE a.attn like '%".$attn."%'" ; 
						}
						 if($country  != "")
						{		
							  $where .= $where != "" ? " AND a.country like '%".$country."%'" : "WHERE a.country like '%".$country."%'" ; 
						}
						if($phone  != "")
						{		
							  $where .= $where != "" ? " AND a.phone like '%".$phone."%'" : "WHERE a.phone like '%".$phone."%'" ; 
						}
						 if($entry_date  != "")
						{		
							  $where .= $where != "" ? " AND a.create_date like '%".$entry_date."%'" : "WHERE a.create_date like '%".$entry_date."%'" ; 
						}
						 if($entry_by  != "")
						{		
							  $where .= $where != "" ? " AND a.create_by like '%".$entry_by."%'" : "WHERE a.create_by like '%".$entry_by."%'" ; 
						}
						 if($modified_by  != "")
						{		
							  $where .= $where != "" ? " AND a.update_by like '%".$modified_by."%'" : "WHERE a.update_by like '%".$modified_by."%'" ; 
						}
						 if($modified_date  != "")
						{		
							  $where .= $where != "" ? " AND a.update_date like '%".$modified_date."%'" : "WHERE a.update_date like '%".$modified_date."%'" ; 
						}
						 if($status  != "")
						{		
							  $where .= $where != "" ? " AND a.status_active like '%".$status."%'" : "WHERE a.status_active like '%".$status."%'" ; 
						}
						//echo  $where;
						$get_customers =  $this->customers_model->get_customer_search($where);
						//echo $get_customers;
						//exit;
						if(sizeof($get_customers) > 0){

									foreach ($get_customers as $key => $value) {
									  if(strlen($value->name) >20 ){ $name = substr($value->name,0,20).'...';}else{ $name = $value->name; }
								      if(strlen($value->phone) >20 ){ $phone = substr($value->phone,0,20).'...';}else{$phone = $value->phone; }
								      if(strlen($value->attn) >20 ){ $attn = substr($value->attn,0,20).'...';}else{$attn = $value->attn; }

											$message       .= 
																	'<tr>
																      <td><a href="javascript:;" onClick="setPage(\''.base_url('customers/view_customer/'.$value->reference_id.'').'\')">'.$value->reference_id.'</a></td>
																      <td>'.$name.'</td>
																      <td>'.$attn.'</td>
																      <td>'.$value->country_name.'</td>
																      <td>('.$value->code_phone.') '.$phone.'</td>
																      <td>'.$value->create_by.'</td>
																      <td>'.$value->create_date.'</td>
																      <td>'.$value->update_by.'</td>
																      <td>'.$value->update_date.'</td>
																      <td>'.$value->status_active.'</td>
      																</tr>';

									}
											$message .= '</tbody></table>

														<a href="#" onClick="setPage()"><button class="btn btn-primary">Add Customer</button></a>
														<a id="MyLinks" onClick="print_csv();"><button class="btn btn-primary" id="Print_csv">Print CSV</button></a>
														<a id="download_all" style="display:none;"><button id="button_all">Download</button> </a>
													   


				      						$head[] = array('Reference ID', 'Name', 'Attn','Email', 'Address','Country','Telephone Number', 'Tax', 'Status','Entry By', 'Entry Date', 'Modified By', 'Modifed Date','Status');
											foreach($get_customers as $row) {
												$head[] = array($row->reference_id,$row->name,$row->attn,$row->email,$row->address, $row->country_name,$row->phone,$row->tax_class,$row->status_active,$row->create_by,$row->create_date,$row->update_by,$row->update_date,$row->status_active);
											}

											//print_r($head);
											$file_name = time()."_customer_file.csv";
											$fp = fopen(path_pdf.$file_name, 'w');


											foreach ($head as $fields) {

											    fputcsv($fp, $fields);
											}

											$link_result     = base_url('asset/pdf/'.$file_name);								
												   

												$status 	=  TRUE;	

							}else{

								$status 	=  FALSE;
								$message 	= "No available data";
								$link_result       = "javascript();";

							}
						
								
					
						echo json_encode(array('status' => $status , 'message' => $message , 'link_result' => $link_result));				
			break;

				case 'print_csv' :

				
						
						$get_customers =  $this->customers_model->get_data();
						
						if(sizeof($get_customers) > 0){

									$head[] = array('Reference ID', 'Name','First Email','Second Email','Third Email','Address','Attn','City','Country','Zip Code','Phone Number','Second Phone Number','Third Phone Number','Mobile','Fax','Tax Class','Status Active','Entry Date','Entry By','Modified Date','Modified By');
									foreach($get_customers as $row) {
										$phone = "(".$row->code_phone.")".$row->phone;
										if ($row->second_c_phone == "")
											{
												$second_phone = "";
												
											}else{
												$second_phone = "(".$row->second_c_phone.")".$row->second_phone;
											}
										
										if($row->third_c_phone == "")
										{
											$third_phone ="";
											
										}else{
											$third_phone = "(".$row->third_c_phone.")".$row->third_phone;
										}

										if($row->update_date =="0000-00-00 00:00:00")
										{
											$updated_date = "";
										}else
										{
												$updated_date = $row->update_date;
										}
										$head[] = array($row->reference_id,$row->name,$row->email,$row->second_email,$row->third_email,$row->address,$row->attn,$row->city,$row->country_name,$row->pos_code,$phone,$second_phone,$third_phone,$row->mobile,$row->fax,$row->tax_class,$row->status_active,$row->create_date,$row->create_by,$updated_date,$row->update_by);
									}
									//print_r($head);
									$file_name = time()."_customer_file.csv";
									$fp = fopen(path_pdf.$file_name, 'w');

									$dir = base_url('asset/pdf/'.$file_name);	

									foreach ($head as $fields) {

									    fputcsv($fp, $fields);
									}
									$status  = TRUE;
									$message = "";

							}else{
								$status     = FALSE;
								$message 	= "There's no available data"; 
								$dir 		= "";
							}	
							echo json_encode(array('status'=> $status,'message'=> $message,'link_result' => $dir));	



			break;

			
		}
	}


	function rubah_id()
	{
		
		$array = array();
        	$no = 1;

    	    foreach ($this->customers_model->get_tech() as $key => $value) {

   
        			$array[$value->cust_id] = $no;
    		    	$no++;

    	    }
    	    $this->customers_model->update_tech($array);    	


	}
	function rahasia()
	{
		$array = array();
        $no = 1;
				/*$array = array();
        		$no = 1;
        		$angka  = "CUST000111";
				$cus  = substr($angka,0,4);
				$back  = substr($angka,4);
				$tambah = $back;

    	    foreach ($this->customers_model->get_tech() as $key => $value) {

   
        			$array[$value->cust_id] = $no;
    		    	
					for($i=1;$i<=20;$i++){
					      $tambah;
					      $data['reference_id'] =  $cus.sprintf('%06d',$tambah);
					     // $this->customers_model->rahasia($value->cust_id,$data);
					     
					      $tambah++;
					      					 echo $no."--". $cus.sprintf('%06d',$tambah)."<br/>";
					}

					$no++;	
    	    }
    	    $this->customers_model->update_tech($array);    	*/
    	    $angka  = "CUST000111";
			$cus  = substr($angka,0,4);
			$back  = substr($angka,4);
			$tambah = $back;
    	    for ($i=1; $i <= 64 ; $i++) { 

    	    	// echo $no;
    	    	 $data['reference_id'] =  $cus.sprintf('%06d',$tambah);
    	    	 $this->customers_model->rahasia($no,$data);

    	    	$tambah++;
    	    	$no++;
    		}	


	}



	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */