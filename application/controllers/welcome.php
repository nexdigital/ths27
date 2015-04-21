<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function index() {
		
		$data['heading']	= "Dashboard";
		$data['view'] 		= "welcome_message";
		$this->load->view('content/body_content',$data);
	//	$this->set_layout('')
	}

	function upload(){
		$data['heading']	= "Upload";
		$data['view'] 		= "upload_page";
		$this->load->view('content/body_content',$data);
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */