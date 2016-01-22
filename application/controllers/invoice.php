<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends MY_Controller {
	
	private $ppn_handling_jakarta = 10;
	private $nt_handling_jakarta = 50;
	private $charge_materai = 6000; //On Rupiah

	function __construct(){
		parent::__construct();
	}

	function priview($hawb_no){
		//Check tax
		$this->invoice_model->checked_tax($hawb_no);
		
		$data['data'] = $this->manifest_model->get_by_hawb($hawb_no);
		$data['shipper'] = $this->customers_model->get_by_id($data['data']->shipper);
		$data['consignee'] = $this->customers_model->get_by_id($data['data']->consignee);
		
		$data['freight'] = $this->manifest_model->get_freight($hawb_no) * $data['data']->exchange_rate;
		$data['handling_jakarta'] = $this->manifest_model->get_handling_jakarta($hawb_no) * $data['data']->exchange_rate;
		
		$data['materai'] = $this->invoice_model->is_charge_materai();
		
		$data['reimbursement'] = $this->invoice_model->get_item($hawb_no,'reimbursement');
		$data['non_reimbursement'] = $this->invoice_model->get_item($hawb_no,'non_reimbursement');
		
		//$data['extra_charge'] = $this->manifest_model->get_extra_charge($data['data']->hawb_no);
		
		$data['is_tax'] = $this->invoice_model->is_tax($hawb_no);
		$data['total_tax'] = $this->invoice_model->get_total_tax($hawb_no);
		$data['total_invoice'] = $this->manifest_model->get_total($hawb_no); //return on rupiah
		
		$this->load->view('manifest/airwaybill',$data);
	}

	function total($hawb_no){
		$get_total = $this->manifest_model->get_total($hawb_no);
		echo number_format($get_total);
	}

	function add_item(){
		$hawb_no = $_POST['hawb_no'];
		$type = $_POST['type'];
		$name = $_POST['name'];	
		$value = $_POST['value'];
		$id = $this->invoice_model->add_item($hawb_no,$type,$name,$value);
		echo json_encode(array('id'=>$id,'type'=>$type,'name'=>$name,'value'=>number_format($value)));
	}
	
	function remove_item(){
		$id = $this->input->post('item_id');
		$this->invoice_model->remove_item($id);
	}
	
	function updatetax($status){
		$hawb_no = $this->input->post('hawb_no');
		$this->invoice_model->update_tax($hawb_no,($status === 'true') ? 'active' : 'nonactive');
		return true;
	}
	
	function gettax($hawb_no){
		$get_total = $this->invoice_model->get_total_tax($hawb_no);
		echo number_format($get_total);
	}

	function edit($hawb_no) {
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
		try {
			$this->invoice_model->create($hawb_no);
		} catch (Exception $e) {
			redirect('asset/invoice/'.$hawb_no.'.pdf');
		}
	}
}

?>