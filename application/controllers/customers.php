<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {

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

	public function index()
	{
		
		$data['get_customers']  = $this->customers_model->get_data();
		$json['content']		= $this->load->view('customers/customers',$data,true);
		$json['title']			= 'Customers';
		echo json_encode($json);
		//break;
		
	
	}

	function view_customer($reference_id){

		$data['get_customers']  = $this->customers_model->get_by_id($reference_id);
		$json['content']		= $this->load->view('customers/customers',$data,true);
		$json['title']			= 'Customers';
		echo json_encode($json);
	}



	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */