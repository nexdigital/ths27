<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	//	  session_start();
	}

	function edit($hawb_no) {
		//Create temp invoice
		$this->db->insert('invoice_table',array('created_date' => date('Y-m-d h:i:s')));

		$data['invoice_id'] = $this->db->insert_id();
		$data['data']	= $this->manifest_model->get_data($hawb_no);
		$data['discount'] = $this->manifest_model->get_discount($hawb_no);
		$data['extra_charge'] = $this->manifest_model->get_extra_charge($hawb_no);
		$data['title']	= 'Edit Invoice #'.$hawb_no;
		$this->set_content('manifest/invoice_edit',$data);
	}

	function save(){
		$invoice['hawb_no'] = $_POST['hawb_no'];
		$invoice['shipper_name'] = $_POST['shipper_name'];
		$invoice['shipper_address'] = $_POST['shipper_address'];
		$invoice['shipper_attn'] = $_POST['shipper_attn'];
		$invoice['consignee_name'] = $_POST['consignee_name'];
		$invoice['consignee_address'] = $_POST['consignee_address'];
		$invoice['consignee_attn'] = $_POST['consignee_attn'];
		$invoice['status'] = 'active';

		$this->db->where('invoice_id',$_POST['invoice_id']);
		$this->db->update('invoice_table',$invoice);
	}

	function printout($hawb_no) {
		$this->manifest_model->update_status($hawb_no,'Finish');
		$this->manifest_model->update_status_delivery($hawb_no,'On Progress');
		if(file_exists(path_invoice . $hawb_no .'.pdf')) {
			redirect('asset/invoice/'.$hawb_no.'.pdf');
		} else {
			$this->invoice_model->create($hawb_no);
			redirect('asset/invoice/'.$hawb_no.'.pdf');
		}
	}
}

?>