<?php

class Invoice_model extends CI_Model {

	function create($hawb_no) {
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
		$pdf->Output(path_invoice . $hawb_no.'.pdf', 'F');
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