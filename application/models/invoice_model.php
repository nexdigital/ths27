<?php

class Invoice_model extends CI_Model {

	private $ppn_handling_jakarta = 10;
	private $nt_handling_jakarta = 50;

	private $allow_charge_materai = true;
	private $charge_materai = 6000; //On Rupiah

	function add_item($hawb_no,$type,$name,$value){
		$this->db->set('hawb_no',$hawb_no);
		$this->db->set('type',$type);
		$this->db->set('name',$name);
		$this->db->set('value',$value);
		$this->db->insert('invoice_items');
		return $this->db->insert_id();
	}
	
	function remove_item($id){
		$this->db->where('id',$id);
		$this->db->delete('invoice_items');
		return true;
	}
	
	function get_item($hawb_no,$type){
		$query = "SELECT * FROM invoice_items WHERE hawb_no = '".$hawb_no."' AND type = '".$type."'";
		$get = $this->db->query($query);
		return $get->result();
	}
	
	function get_total_item($hawb_no,$type){
		$total = 0;
		if($type === 'reimbursement' && $this->allow_charge_materai) $total += $this->charge_materai;		
		$query = "SELECT SUM(value) as total FROM invoice_items WHERE hawb_no = '".$hawb_no."' AND type = '".$type."'";
		$get = $this->db->query($query);
		$total += $get->row('total');
		return $total;
	}
	
	function get_tax_value(){
		$query = $this->db->query('select * from master_tax where is_active = ?',array('active'));
		return $query->row('tax_rate');
	}
	
	function is_tax($hawb_no){
		$query = "SELECT * FROM invoice_tax WHERE hawb_no = '$hawb_no'";
		$get = $this->db->query($query);
		if($get->num_rows() > 0 && $get->row('status') === 'active') return true;
		else return false;
	}
	
	function update_tax($hawb_no,$status){
		$this->db->where('hawb_no',$hawb_no);
		$this->db->set('status',$status);
		$this->db->update('invoice_tax');
	}
	
	function get_total_tax($hawb_no){
		$get = $this->manifest_model->get_by_hawb($hawb_no);
		$nt = $get->exchange_rate;
		
		$handling_jakarta = $this->manifest_model->get_handling_jakarta($hawb_no); //on nt
		$handling_jakarta = $handling_jakarta * $nt;
		
		$non_reimbursement = $this->invoice_model->get_total_item($hawb_no,'non_reimbursement'); //on rupiah
				
		$is_tax = $this->invoice_model->is_tax($hawb_no);
		$tax_rate = $this->get_tax_value();
		$total_tax = 0;
		if($is_tax){
			$total_tax = ($handling_jakarta + $non_reimbursement) * $tax_rate / 100;
		}
		
		return $total_tax;
	}
	
	function checked_tax($hawb_no){
		$query = "SELECT * FROM invoice_tax WHERE hawb_no = '$hawb_no'";
		$get = $this->db->query($query);
		if($get->num_rows() === 0){
			$this->db->set('hawb_no',$hawb_no);
			$this->db->set('status','active');
			$this->db->insert('invoice_tax');
			return $this->db->insert_id();
		} else return true;
	}
	
	function is_charge_materai(){
		if($this->allow_charge_materai) return $this->charge_materai;
		else return false;
	}
	
	function create($hawb_no) {
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
		
		$html = $this->load->view('manifest/airwaybill_printout',$data,true);
		include_once APPPATH . 'libraries/mpdf60/mpdf.php';
		$mpdf=new mPDF('c','A4'); 
		
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	}

	function barcode_1d($string) {
		require_once(path_app . 'libraries/phpbarcode/class/BCGFontFile.php');
		require_once(path_app . 'libraries/phpbarcode/class/BCGColor.php');
		require_once(path_app . 'libraries/phpbarcode/class/BCGDrawing.php');
		require_once(path_app . 'libraries/phpbarcode/class/BCGcode39.barcode.php');

		$font = new BCGFontFile(path_app . 'libraries/phpbarcode/font/Arial.ttf', 8);
		$color_black = new BCGColor(0, 0, 0);
		$color_white = new BCGColor(255, 255, 255);

		$drawException = null;
		try {
		    $code = new BCGcode39();
		    $code->setScale(1);
		    $code->setThickness(30);
		    $code->setForegroundColor($color_black);
		    $code->setBackgroundColor($color_white);
		    $code->setFont($font);
		    $code->parse($string);
		} catch(Exception $exception) {
		    $drawException = $exception;
		}

		$path = path_barcode.'1D_'.$string.'.png';

		$drawing = new BCGDrawing($path, $color_white);
		if($drawException) {
		    $drawing->drawException($drawException);
		} else {
		    $drawing->setBarcode($code);
		    $drawing->draw();
		}

		header('Content-Type: image/png');
		header('Content-Disposition: inline; filename="'.path_barcode.'1d_'.$string.'.png"');
		$drawing->finish(BCGDrawing::IMG_FORMAT_PNG,100);
    }

    function barcode_qrcode($string) {
    	require_once(path_app . 'libraries/phpqrcode/qrlib.php');

    	$path = path_barcode.'QR_'.$string.'.png';
    	if(!file_exists($path)) {
	    	QRcode::png($string,$path);
	    }
    }
}

?>