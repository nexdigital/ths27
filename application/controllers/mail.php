<?php

class Mail extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('email'));
	}

	function send(){
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
			$this->email->set_newline("\r\n");
			$this->email->from( "tataharmoni18@gmail.com", "No Reply" );
			$this->email->to($_POST['to']);
			$this->email->subject($_POST['subject']);
			$this->email->message($_POST['message']);
			if(!$this->email->send()) {
				echo json_encode(array('status' => 'failed','message'=>$this->email->print_debugger()));
			} else {
				echo json_encode(array('status' => 'success'));
			}
		}
	}
}

?>