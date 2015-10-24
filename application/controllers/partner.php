<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends MY_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));

	}

	function index()
	{
			$data['menu']			= "Master";
			$data['submenu']		= "Partner";
			$data['get_partner']	= $this->partner_model->get_partner();
			$data['title']			= 'Partner';
			$this->set_content('partner/partner',$data);

	}

	function partner_form()
	{
		$data['menu']			= "Partner";
		$data['submenu']		= "Create Partner";
		$data['title']	= 'Create Partner';
		$this->set_content('partner/partner_add',$data);
	}

	function edit_form($id)
	{
			$data['get_partner']	= $this->partner_model->get_partner_row($id);
			$data['title']	= 'Edit Partner';
			$this->set_content('partner/partner_edit',$data);
	}

	function delete_form($id)
	{
		$data['get_partner']	= $this->partner_model->get_partner_row($id);
		$data['title']	= 'Delete Partner';
		$this->set_content('partner/partner_delete',$data);
	}


	function add_proses()
	{
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

					$angka  = $partner_id;
					$cus  = substr($angka,0,4);
					$back  = substr($angka,4);
					$tambah = $back + 1;
					$status = "no_available";
					$message = "Partner Id has been used before. Please use another Partner ID";
					$new_id = $cus.sprintf('%06d',$tambah);

				}else{

				
								$data = array(
												'partner_id'		=> $partner_id,
												'company_name'		=> htmlspecialchars($partner_name) ,
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
								$new_id = "";
					

				}
					
					echo json_encode(array('status' => $status,'message'=>$message,'new_id'=>$new_id));
	}

	function edit_proses()
	{
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
														'telephone_number'	=> $_POST['c_phone'].$_POST['telephone'],
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
	}


	function check_available_partner()

	{
		$partner_name = $_GET['partner_name'];
		$get = $this->db->query("select * from partner where lower(company_name) = '".strtolower($partner_name)."'");
		if($get->num_rows() == 0) echo "true";
		else echo "false";
						
	}

	function autoComplete()
	{

			$partner_id = $_GET['q'];
			$this->db->like('partner_id',$partner_id);
			$this->db->where_in('is_active',array('active'));
			$get = $this->db->get('partner');

			$partner_id_list = array();
			foreach($get->result() as $row) {
				$partner_id_list[] = $row->partner_id;
			}
			echo json_encode($partner_id_list);

	}

	function autoCompleteName()
	{

			$partner_name = $_GET['q'];
			$this->db->like('company_name',$partner_name);
			$this->db->where_in('is_active',array('active'));
			$get = $this->db->get('partner');

			$partner_name_list = array();
			foreach($get->result() as $row) {
				$partner_name_list[] = $row->company_name;
			}
			echo json_encode($partner_name_list);

	}

	function search()
	{
			$partner_id        	= $this->input->post('partner_id');
			$partner_name      	= $this->input->post('partner_name');
			$country        	= $this->input->post('country');
			$email        		= $this->input->post('email');
			$phone        		= $this->input->post('phone');
			$entry_by       	= $this->input->post('entry_by');
			$entry_date        	= $this->input->post('entry_date');
			$modified_date      = $this->input->post('modified_date');
			$modified_by       	= $this->input->post('modified_by');
			$status       		= $this->input->post('status');

			$where 				= "";
			$message 			= '<table id="example2" class="table  table-striped table-hovered">         
									  <thead>
									    <th>ID</th>
										<th row_name="partner_id">Partner ID</th>
										<th row_name="partner_name">Partner Name</th>
										<th row_name="country">Country</th>
										<th row_name="email">Email</th>
										<th row_name="telephone">Telephone</th>
										<th row_name="entry_by">Entry By</th>
										<th row_name="entry_date">Entry Date</th>
										<th row_name="modified_by">Modified By</th>
										<th row_name="modified_date">Modified Date</th>
										<th row_name="status">Status</th>	

									</thead>';

			if($partner_id  != "")
			{		
				$where .= "WHERE a.partner_id like '%".$partner_id."%'" ;
			}
			if($partner_name  != "")
			{		
				  $where .= $where != "" ? " AND a.company_name like '%".$partner_name."%'" : "WHERE a.company_name like '%".$partner_name."%'" ; 
		 	}
		 	if($country  != "")
			{		
				  $where .= $where != "" ? " AND a.country_id like '%".$country."%'" : "WHERE a.country_id like '%".$country."%'" ; 
		 	}
		 	if($email  != "")
			{		
				  $where .= $where != "" ? " AND a.email like '%".$email."%'" : "WHERE a.email like '%".$email."%'" ; 
		 	}
		 	if($phone  != "")
			{		
				  $where .= $where != "" ? " AND a.telephone_number like '%".$phone."%'" : "WHERE a.telephone_number like '%".$phone."%'" ; 
		 	}
		 	if($entry_date  != "")
			{		
				  $where .= $where != "" ? " AND a.entry_date like '%".$entry_date."%'" : "WHERE a.entry_date like '%".$entry_date."%'" ; 
		 	}

		 	if($entry_by  != "")
			{		
				  $where .= $where != "" ? " AND a.entry_by like '%".$entry_by."%'" : "WHERE a.entry_by like '%".$entry_by."%'" ; 
		 	}
		 	if($modified_date  != "")
			{		
				  $where .= $where != "" ? " AND a.update_date like '%".$modified_date."%'" : "WHERE a.update_date like '%".$modified_date."%'" ; 
		 	}
		 	if($modified_by  != "")
			{		
				  $where .= $where != "" ? " AND a.update_by like '%".$modified_by."%'" : "WHERE a.update_by like '%".$modified_by."%'" ; 
		 	}

		 	if($status  != "")
			{		
				  $where .= $where != "" ? " AND a.is_active like '%".$status."%'" : "WHERE a.is_active like '%".$status."%'" ; 
		 	}
		 	


		 	$get_partner =  $this->partner_model->get_partner_search($where);	

		 	if(sizeof($get_partner) > 0){
		 		foreach ($get_partner as $key => $value) {
		 		$message       .= 
									'<tr>
										    <td>'.$value->id.'</td>
											<td><a href="javascript:;" onClick="setPage(\''.base_url('partner/edit_form/'.$value->partner_id.'').'\')">'.$value->partner_id.'</a></td>
											<td>'.$value->company_name.'</td>
											<td>'.$value->country_name.'</td>
											<td>'.$value->email.'</td>
											<td>'.$value->telephone_number.'</td>
											<td>'.$value->entry_by.'</td>
											<td>'.$value->entry_date.'</td>
											<td>'.$value->update_by.'</td>
											<td>'.$value->update_date.'</td>
											<td>'.$value->is_active.'</td>
									</tr>';
		 		}


		 	
			$status = true;

		 	}else{
		 		$status 	=  FALSE;
				 $message 	.= '<tr>
				 					<td>No available data</td>
				 				</tr>
				 				';
				
		 	}	
		 	$message .= '</tbody></table>';			
		 	
			echo json_encode(array('status' => $status , 'message' => $message));	
	}
							


}

?>