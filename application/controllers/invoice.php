<?php

class Invoice extends MY_Controller {
	
	function __construct(){
		parent::__construct();
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
		$this->load->library('pdf');
		$pdf = $this->pdf->load();

		$data['data'] = $this->manifest_model->get_by_hawb($hawb_no);
		$data['shipper'] = $this->customers_model->get_by_id($data['data']->shipper);
		$data['consignee'] = $this->customers_model->get_by_id($data['data']->consignee);
		$data['extra_charge'] = $this->manifest_model->get_extra_charge($data['data']->hawb_no);

		$this->barcode_qrcode($data['data']->hawb_no);
		$this->barcode_1d($data['data']->hawb_no);


		$html = $this->load->view('manifest/airwaybill',$data,true);
		$pdf->WriteHTML($html);
		$pdf->Output($file_path, 'I');
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