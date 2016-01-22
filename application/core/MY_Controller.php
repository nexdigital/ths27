<?php

class MY_Controller extends CI_Controller {

	function __construct() {
		  parent::__construct();
		        session_start();
		  #$this->system->set_all_activity_log();
		  if(count($_POST) > 0) {

		   	foreach($_POST as $key => $row) {
		    	if(!is_array($_POST[$key])) $_POST[$key] = htmlspecialchars($row);
		   	}
		  }
		  
		  if(count($_GET) > 0) {
		   	foreach($_GET as $key => $row) {
		    	if(!is_array($_GET[$key])) $_GET[$key] = htmlspecialchars($row);
		   	}
		  }
 }


	function set_content($page,$data){
		
		$this->load->view('content/top_content',$data);
		$this->load->view($page,$data);
		$this->load->view('content/bottom_content',$data);
	}

	function set_page($page = null, $data = null) {
		$this->load->view('content/header');
		if($page != null) $this->load->view($page,$data);
		$this->load->view('content/footer');
	}

	function set_layout($page = null, $data = null) {
		$this->load->view('content/header',$data);
		$this->load->view('content/navigation-menu',$data);
		if($page != null) $this->load->view($page,$data); else $this->load->view('content/blank');
		$this->load->view('content/footer');
	}

	function set_modal($page = null,$data = null) {
		$this->load->view('content/header');
		if($page != null) $this->load->view($page,$data); else $this->load->view('content/blank');
		$this->load->view('content/footer');
	}
}

?>