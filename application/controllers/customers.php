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
	function view_customer(){
		//$data['get_customers'] 	= $this->customers_model->get_by_id($reference_id);
		$data        	        = array();
		$data['title']			= 'Customer View';
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

	function email(){
		$data['data']		= array('');
		$data['title']		= 'Email Form';
		$this->set_content('customers/email',$data);
	}

	function ajax($page = null){
			switch ($page) {
				case 'add_customer':
					$data['reference_id'] = str_replace(' ', '', $_POST['reference_id']);
				//	$data['id_group'] 	  = $_POST['id_group'];
					$data['name'] 		  = $_POST['name'];
					$data['email'] 		  = $_POST['email'];
					$data['address'] 	  = $_POST['address'];
					$data['attn'] 		  = $_POST['attn'];
					$data['city']         = $_POST['city'];
					$data['country']      = $_POST['country'];
					$data['pos_code'] 	  = $_POST['zip_code'];
					$data['phone'] 		  = $_POST['phone'];
					$data['mobile'] 	  = $_POST['mobile'];
					$data['fax'] 		  = $_POST['fax'];
					$data['tax_class'] 	  = $_POST['tax_class'];
				//	$data['vat_doc'] 	  = $_POST['vat_doc'];
					$data['status'] 	  = $_POST['status'];
					//$data['register_date']= $_POST['register_date'];
					$data['register_date']= "2015-02-12";
					$data['payment_type'] = $_POST['payment_type'];
					$data['description']  = $_POST['description'];
					$data['status_active']= "Active";
					$this->customers_model->save_customer($data);


					if(isset($_POST['hawb_no']) && $_POST['hawb_no'] && isset($_POST['customer_type']) && in_array($_POST['customer_type'], array('shipper','consignee'))) {
						$this->manifest_model->set_customer($_POST['hawb_no'],$_POST['customer_type'],$data['reference_id']);
						$data = $this->manifest_model->get_data($_POST['hawb_no']);
						$file = $this->manifest_model->get_file($data->file_id);

						echo json_encode(array('status'=> 'redirect', 'message'=> base_url('manifest/view/verification_details?mawb_no='.urlencode($file->mawb_no))));
					} else {
						echo json_encode(array('status'=> 'success', 'message'=> 'Save success'));
					}
				break;
		}
	}
	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */