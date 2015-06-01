<?php

class Invoice extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}

	function edit($hawb_no) {
		$data['data']	= $this->manifest_model->get_data($hawb_no);
		$data['title']	= 'Edit Invoice';
		$this->set_content('manifest/invoice_edit',$data);
	}

	function printout($hawb_no) {
		echo 'rw';
	}

}

?>