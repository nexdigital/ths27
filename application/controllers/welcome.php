<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','email'));
	}

	function index () {
		$data['data']	= $this->manifest_model->get_data_unverified();
		$data['title']	= 'List Manifest Unverified';
		$this->set_content('manifest/verification',$data);				
	}
}