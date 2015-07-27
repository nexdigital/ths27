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
		$this->set_content('finance/data_payment',$data);
	}


	function ajax($page = null){
		switch ($page) {
				case 'add_payment':
						$data['data']	= array('');
						$data['title']  = 'Add Payment';
						$this->set_content('finance/add_payment',$data);	
				break;
		}

	}

	//function view_customer($reference_id){
	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */