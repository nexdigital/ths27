<?php


class Manifest extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		exit;
	}

	function view($page = null) {
		switch ($page) {
			case 'upload':
				$data = array('list_partners');
				$json['content'] 	= $this->load->view('manifest/upload',$data,true);
				$json['title']		= 'Upload Manifest';
				echo json_encode($json);
			break;
			
			default:
				header("HTTP/1.0 404 Not Found");
			break;
		}
	}

	function ajax($page = null) {
		switch ($page) {
			case 'check_available_mawb':
				$mawb_no = $_GET['mawb_no'];
				$available_mawb = $this->manifest_model->check_available_mawb($mawb_no);
				if($available_mawb) echo 'true';
				else echo 'false';
			break;
			
			default:
				header("HTTP/1.0 404 Not Found");
			break;
		}
	}

}

?>