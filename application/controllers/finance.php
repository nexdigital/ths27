<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance extends MY_Controller {

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
		$data['title']			= 'Data Payment';
		$this->set_content('finance/data_manifest_finish',$data);
	}

	function data_payment() {
	//	$data['get_customers']	= $this->customers_model->get_data();
		$data['title']			= 'Data Payment';
		$this->set_content('finance/data_payment',$data);
	}

	function data_payment_finish() {
	//	$data['get_customers']	= $this->customers_model->get_data();
		$data['title']			= 'Data Payment';
		$this->set_content('finance/data_payment_finish',$data);
	}


	function payment($page = null,$hawb_no=null){
		switch ($page) {
				case 'add_payment':
						$data['data']	= array('');
						$data['title']  = 'Add Payment';
						$this->set_content('finance/add_payment',$data);	
				break;

				case 'edit_payment':
						$data['get_manifest']	= $this->finance_payment->get_manifest_by_hawb($hawb_no);
						$data['title']  = 'Edit Payment';
						$this->set_content('finance/edit_payment',$data);	
				break;

				case 'autoComplete':
						$hawb_no = $_GET['q'];
						$this->db->like('lower(hawb_no)',strtolower($hawb_no));
						$this->db->where('collect !=','');
						$this->db->where('lower(status)','finish');
						$this->db->where('lower(status_payment)','unpaid');
						$get = $this->db->get('manifest_data_table');

						$hawb_no_list = array();
						foreach($get->result() as $row) {
							$hawb_no_list[] = $row->hawb_no;
						}
						echo json_encode($hawb_no_list);
				break;

				case 'insert_payment':

						if($_POST['payment_amount'] > $_POST['total_payment'] ){

							$status  = FALSE;
							$message = "should not exceed the amount of payment";
						}else{

							$data['hawb_no'] 				= $_POST['hawb_no'];
							$data['customer_payment'] 		= $_POST['customer'];
							$data['total_payment'] 			= $_POST['total_payment'];
							$data['payment_amount'] 		= $_POST['payment_amount'];
							$data['remaining_payment'] 		= $_POST['total_payment'] - $_POST['payment_amount'];

							if($_POST['payment_amount'] == $_POST['total_payment']){
								
								$status_payment  = "full";
								$payment['status_payment'] = "Paid";
								$this->finance_payment->payment_manifest_update($_POST['hawb_no'],$payment);	
							}else{

								$status_payment  = "partially";
							}
							
							$data['status'] 				= $status_payment;
							$data['date_payment'] 			= date('Y-m-d');
							$data['created_by'] 			= $this->session->userdata('user_id');

							$this->finance_payment->insert_payment($data);

							

							$status  = TRUE;
							$message = "Payment Success";

						}
						
						echo json_encode(array('status' => $status,'message'=> $message));
				break;
		}

	}

	//function view_customer($reference_id){
	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */