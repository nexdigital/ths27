<?php


class Manifest extends MY_Controller {

	function __construct(){
		parent::__construct();
		//  session_start();
	}

	function index(){
		exit;
	}

	function view($page = null) {
		switch ($page) {
			case 'upload':
				$this->set_content('manifest/upload',array('title' => 'Upload File'));
			break;
			case 'create_host':
				$this->set_content('manifest/create_host',array('title' => 'Create Host'));
			break;
			case 'data':
				$data['data']	= '';
				$data['title']	= 'Master Data Manifest';
				$this->set_content('manifest/master_data',$data);
			break;
			case 'verification':
				$data['data']	= $this->manifest_model->get_data_unverified();
				$data['title']	= 'List Manifest Unverified';
				$this->set_content('manifest/verification',$data);				
			break;
			case 'verification_details':
				$mawb_no = $_GET['mawb_no'];
				$data['data']	= $this->manifest_model->get_data__details_unverified($mawb_no);
				$data['title']	= 'Host Unverified From Master Airwaybill #'.$mawb_no;
				$this->set_content('manifest/verification_details',$data);				
			break;
			case 'similar_question':
				$hawb_no = $_GET['hawb_no'];
				$customer_type = $_GET['customer_type'];

				$data['data']				= $this->manifest_model->get_data($hawb_no);
				$data['file']				= $this->manifest_model->get_file($data['data']->file_id);
				$data['similar_customer']	= $this->manifest_model->get_similar_customer($hawb_no,$customer_type);
				$data['customer_type']		= $customer_type;
				$data['title']				= 'List Similar Customer';
				$this->set_content('manifest/similar_customer',$data);
			break;
			case 'download':
				$data['data']	= '';
				$data['title']	= 'Download Manifest Data';
				$this->set_content('manifest/download',$data);
			break;
			case 'details':
				$hawb_no = $_GET['hawb_no'];
				$data['data'] = $this->manifest_model->get_by_hawb($hawb_no);
				$data['discount'] = $this->manifest_model->get_discount($hawb_no);
				$data['extra_charge'] = $this->manifest_model->get_extra_charge($hawb_no);
				$data['title'] = 'Details Host #'.$hawb_no;
				$this->set_content('manifest/details',$data);
			break;
			case 'edit':
				$hawb_no = $_GET['hawb_no'];
				$data['data'] = $this->manifest_model->get_by_hawb($hawb_no);
				$data['title'] = 'Edit Host #'.$hawb_no;
				$this->set_content('manifest/edit',$data);
			break;
			case 'invoice':
				$data['data']	= '';
				$data['title']	= 'Print Invoice';
				$this->set_content('manifest/invoice',$data);				
			break;
		}
	}

	function ajax($page = null) {
		switch ($page) {
			case 'upload':
				include path_app . 'libraries/PHPExcel/IOFactory.php';
					
				//Upload file excel to attachment
				$config['allowed_types'] = '*';
				$config['upload_path'] = path_attachment;
				$this->load->library('upload', $config);

				$this->form_validation->set_rules('mawb_no', 'mawb_no', 'required');
				$this->form_validation->set_rules('consign_to', 'consign_to', 'required');
				$this->form_validation->set_rules('flight_from', 'flight_from', 'required');
				$this->form_validation->set_rules('flight_to', 'flight_to', 'required');
				$this->form_validation->set_rules('gross_weight', 'gross_weight', 'required');
				$this->form_validation->set_rules('partner_id', 'partner_id', 'required');
				$this->form_validation->run();

				if ($this->upload->do_upload()) {
					$data_file = $this->upload->data();

					/*UPLOAD FILE================================================================*/
					$file = array(
						'file_id'		=> $this->tool_model->generate_file_id(),
						'file_name'		=> $data_file['file_name'],
						'mawb_no'		=> set_value('mawb_no'),
						'consign_to'	=> set_value('consign_to'),
						'flight_from'	=> set_value('flight_from'),
						'flight_to'		=> set_value('flight_to'),
						'gross_weight'	=> set_value('gross_weight'),
						'partner_id'	=> set_value('partner_id'),
						'created_date'	=> date('Y-m-d h:i:s')
					);
					/*UPLOAD FILE END =============================================================*/

					$inputFileName = $data_file['full_path'];
					$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
					$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					
					$mergeData = $objPHPExcel->getActiveSheet()->getMergeCells();
					$merge_cell = array();
					foreach ($mergeData as $value) {
						$explode = explode(':', $value);
						$merge_cell[$explode[0]] = $explode[1];
					}

					$header_format 	= $this->tool_model->format_header_file();
					$header 		= array();
					$header_error 	= array();

					foreach ($sheetData[1] as $key => $value) {
						$value_trim = strtolower(trim(str_ireplace(' ', '_', trim($value))));
						if(strlen($value_trim) > 0) {
							if(in_array(trim($value_trim), $header_format)) {
								$header[trim($value_trim)] = $key;
							} else {
								$header_error[] = $value;
							}
						}
					}
					unset($sheetData[1]);
					if(count($header_format) == count($header)) {
						$this->manifest_model->insert_file($file);
						$no = 0;

						$mawb_type_list = array('ftz','hc','pouchen_ftz','pouchen_hc','fengtay_ftz','fengtay_hc','pibk');
						foreach ($sheetData as $key => $value) {
							$mawb_type = trim(str_ireplace(' ','_',strtolower($value[$header['mawb_type']])));

							if($value[$header['hawb_no']] || in_array($header['hawb_no'].$key, $merge_cell)) {
								$data_id = $this->tool_model->generate_data_id();
								$rand_data_id = str_shuffle($data_id.time());

								$mapping[$no]['hawb_no'] 			= (!in_array($header['hawb_no'].$key, $merge_cell)) ? $value[$header['hawb_no']] : $sheetData[$this->tool_model->get_key_cell($header['hawb_no'].$key,$merge_cell)][$header['hawb_no']];
								$mapping[$no]['pkg'] 				= (!in_array($header['pkg'].$key, $merge_cell)) ? $value[$header['pkg']] : $sheetData[$this->tool_model->get_key_cell($header['pkg'].$key,$merge_cell)][$header['pkg']];
								$mapping[$no]['pcs'] 				= (!in_array($header['pcs'].$key, $merge_cell)) ? $value[$header['pcs']] : $sheetData[$this->tool_model->get_key_cell($header['pcs'].$key,$merge_cell)][$header['pcs']];
								$mapping[$no]['kg']					= (!in_array($header['kg'].$key, $merge_cell)) ? $this->tool_model->rounded_kg($value[$header['kg']]) : $this->tool_model->rounded_kg($sheetData[$this->tool_model->get_key_cell($header['kg'].$key,$merge_cell)][$header['kg']]);
								$mapping[$no]['value'] 				= (!in_array($header['value'].$key, $merge_cell)) ? $value[$header['value']] : $sheetData[$this->tool_model->get_key_cell($header['value'].$key,$merge_cell)][$header['value']];
								$mapping[$no]['prepaid']			= (!in_array($header['pp'].$key, $merge_cell)) ? $value[$header['pp']] : $sheetData[$this->tool_model->get_key_cell($header['pp'].$key,$merge_cell)][$header['pp']];
								$mapping[$no]['collect']			= (!in_array($header['cc'].$key, $merge_cell)) ? $value[$header['cc']] : $sheetData[$this->tool_model->get_key_cell($header['cc'].$key,$merge_cell)][$header['cc']];

								if(!$this->manifest_model->check_available_hawb($mapping[$no]['hawb_no'])) {
									if($value[$header['pkg']]) $this->manifest_model->update_value_field($mapping[$no]['hawb_no'],'pkg',$value[$header['pkg']]);
									if($value[$header['pcs']]) $this->manifest_model->update_value_field($mapping[$no]['hawb_no'],'pcs',$value[$header['pcs']]);
									if($value[$header['kg']]) $this->manifest_model->update_value_field($mapping[$no]['hawb_no'],'kg',$value[$header['kg']]);
									if($value[$header['value']]) $this->manifest_model->update_value_field($mapping[$no]['hawb_no'],'value',$value[$header['value']]);
									if($value[$header['pp']]) $this->manifest_model->update_value_field($mapping[$no]['hawb_no'],'prepaid',$value[$header['pp']]);
									if($value[$header['cc']]) $this->manifest_model->update_value_field($mapping[$no]['hawb_no'],'collect',$value[$header['cc']]);
								} else {
									$mapping[$no]['data_id'] 			= $data_id;
									$mapping[$no]['file_id'] 			= $file['file_id'];
									$mapping[$no]['data_no'] 			= (!in_array($header['no'].$key, $merge_cell)) ? $value[$header['no']] : $sheetData[$this->tool_model->get_key_cell($header['no'].$key,$merge_cell)][$header['no']];
									$mapping[$no]['shipper'] 			= (!in_array($header['shipper'].$key, $merge_cell)) ? $this->tool_model->remove_tags_excel($value[$header['shipper']]) : $this->tool_model->remove_tags_excel($sheetData[$this->tool_model->get_key_cell($header['shipper'].$key,$merge_cell)][$header['shipper']]);
									$mapping[$no]['consignee'] 			= (!in_array($header['consignee'].$key, $merge_cell)) ? $this->tool_model->remove_tags_excel($value[$header['consignee']]) : $this->tool_model->remove_tags_excel($sheetData[$this->tool_model->get_key_cell($header['consignee'].$key,$merge_cell)][$header['consignee']]);
									$mapping[$no]['description'] 		= (!in_array($header['description'].$key, $merge_cell)) ? $value[$header['description']] : $sheetData[$this->tool_model->get_key_cell($header['description'].$key,$merge_cell)][$header['description']];
									$mapping[$no]['rate'] 				= (!in_array($header['rate'].$key, $merge_cell)) ? $value[$header['rate']] : $sheetData[$this->tool_model->get_key_cell($header['rate'].$key,$merge_cell)][$header['rate']];
									$mapping[$no]['remarks'] 			= (!in_array($header['remarks'].$key, $merge_cell)) ? $value[$header['remarks']] : $sheetData[$this->tool_model->get_key_cell($header['remarks'].$key,$merge_cell)][$header['remarks']];
									$mapping[$no]['status']				= 'Unverified';
									$mapping[$no]['exchange_rate']  	= $this->master_currency->get_exchange_rate_value('nt');
									$mapping[$no]['created_date']		= date('Y-m-d h:i:s');
									$mapping[$no]['last_update']		= date('Y-m-d h:i:s');
									$mapping[$no]['user_id']			= $this->session->userdata('user_id');
									$mapping[$no]['status_payment']		= ($value[$header['cc']]) ? 'Unpaid' : null;
									$mapping[$no]['status_delivery']	= 'New data';
									$mapping[$no]['other_charge_tata']	= (!in_array($header['other_charge_tata'].$key, $merge_cell)) ? $value[$header['other_charge_tata']] : $sheetData[$this->tool_model->get_key_cell($header['other_charge_tata'].$key,$merge_cell)][$header['other_charge_tata']];
									$mapping[$no]['other_charge_pml']	= (!in_array($header['other_charge_pml'].$key, $merge_cell)) ? $value[$header['other_charge_pml']] : $sheetData[$this->tool_model->get_key_cell($header['other_charge_pml'].$key,$merge_cell)][$header['other_charge_pml']];
									$mapping[$no]['mawb_type']			= ($mawb_type && strlen($mawb_type) > 0 && in_array($mawb_type, $mawb_type_list)) ? $mawb_type : 'ftz';
									$mapping[$no]['rand_data_id']		= $rand_data_id;
									$mapping[$no]['deadline']			= $this->tool_model->set_deadline('+7');
									$mapping[$no]['currency']			= 'NT';
									if($mapping[$no]['hawb_no'] && $mapping[$no]['shipper'] && $mapping[$no]['consignee']) {
										$this->manifest_model->insert_data($mapping[$no]);
									} else {
										unset($mapping[$no]);
									}
								}
								$no++;
							}
						}
						$json['status'] 	= "success";
						$json['message'] 	= "<strong>Upload Success!</strong><br/>Total Rows: ".count($mapping)."<br/>Manifest need to verification";
						echo json_encode($json);
					} else {
						$errorHeader = implode("</li><li>", $header_error);
						$errorHeader = "<ul style=\"padding:0px 0px 0px 20px; list-style:disc;\"><li>".$errorHeader."</li><ul>";
						$json['status'] 	= "warning";
						$json['message'] 	= "<strong>Upload Error!</strong><br/>Please fixing your header file, bellow header need correction: <br/>".$errorHeader;
						echo json_encode($json);
					}
				}
			break;

			case 'insert':
				$this->form_validation->set_rules('shipper','shipper','required');
				$this->form_validation->set_rules('consignee','consignee','required');
				$this->form_validation->run();

				if(set_value('shipper') && set_value('consignee')) {
					if(set_value('shipper') != set_value('consignee')) {
						$data['data_id']		= $this->tool_model->generate_data_id();
						$data['hawb_no']		= trim($_POST['hawb_no']);
						$data['pkg']			= $_POST['pkg'];
						$data['pcs']			= $_POST['pcs'];
						$data['value']			= $_POST['value'];
						$data['kg']				= $_POST['kg'];
						$data['rate']			= $_POST['rate'];

						$data['collect']		= ($_POST['type_payment'] == 'collect') ? str_ireplace(',','',$_POST['amount']) : null;
						$data['prepaid']		= ($_POST['type_payment'] == 'prepaid') ? str_ireplace(',','',$_POST['amount']) : null;

						$data['shipper']		= $_POST['shipper'];
						$data['consignee']		= $_POST['consignee'];
						$data['description']	= $_POST['description'];
						$data['remarks']		= $_POST['remarks'];
						$data['other_charge_tata'] = $_POST['other_charge_tata'];
						$data['other_charge_pml'] = $_POST['other_charge_pml'];

						$data['status']			= 'verified';
						$data['created_date']	= date('Y-m-d');
						$data['status_payment'] = 'Paid';
						$data['status_delivery'] = 'New Data';
						$data['currency']		= $_POST['currency'];
						$data['exchange_rate']	= $this->master_currency->get_exchange_rate_value($_POST['currency']);
						$data['manifest_type']  = $_POST['manifest_type'];
						$this->manifest_model->insert_data($data);
						$json['status'] 	= "success";
						$json['message'] 	= "<strong>Save Success!</strong>";
						echo json_encode($json);
					} else {
						$json['status'] 	= "warning";
						$json['message'] 	= "<strong>Save Failed!</strong><br/>Shipper and consginee can't same!";
						echo json_encode($json);											
					}
				} else {
					$json['status'] 	= "warning";
					$json['message'] 	= "<strong>Save Failed!</strong><br/>Please completed the shipper and consginee!";
					echo json_encode($json);					
				}

			break;

			case 'update':
				$hawb_no = $_GET['hawb_no'];
				$data['pkg']			= $_POST['pkg'];
				$data['pcs']			= $_POST['pcs'];
				$data['value']			= $_POST['value'];
				$data['kg']				= $_POST['kg'];
				$data['rate']			= $_POST['rate'];

				$data['collect']		= ($_POST['type_payment'] == 'collect') ? str_ireplace(',','',$_POST['amount']) : null;
				$data['prepaid']		= ($_POST['type_payment'] == 'prepaid') ? str_ireplace(',','',$_POST['amount']) : null;

				$data['description']	= $_POST['description'];
				$data['remarks']		= $_POST['remarks'];
				$data['other_charge_tata'] = $_POST['other_charge_tata'];
				$data['other_charge_pml'] = $_POST['other_charge_pml'];

				$data['currency']		= $_POST['currency'];
				$data['exchange_rate']	= $this->master_currency->get_exchange_rate_value($_POST['currency']);
				$this->manifest_model->update_data($hawb_no, $data);

				$json['status'] 	= "success";
				$json['message'] 	= "<strong>Save Success!</strong>";
				echo json_encode($json);
			break;

			case 'check_available_mawb':
				$mawb_no = $_GET['mawb_no'];
				$available_mawb = $this->manifest_model->check_available_mawb($mawb_no);
				if($available_mawb) echo 'true';
				else echo 'false';
			break;
			
			case 'set_customer':
				$hawb_no = $_POST['hawb_no'];
				$customer_type = $_POST['customer_type'];
				$reference_id = $_POST['reference_id'];
				$this->manifest_model->set_customer($hawb_no,$customer_type,$reference_id);
			break;

			case 'verification_host':
				$hawb_no = $_POST['hawb_no'];
				$data = $this->manifest_model->get_data($hawb_no);

				$get_shipper = $this->db->query("select * from customer_table where reference_id = '$data->shipper'");
				$get_consignee = $this->db->query("select * from customer_table where reference_id = '$data->consignee'");

				if($get_shipper->num_rows() > 0 && $get_consignee->num_rows() > 0) {
					$this->manifest_model->update_status($hawb_no,'verified');
					echo json_encode(array('status' => 'success','message' => 'Host #'.$hawb_no.' Verified!'));
				} else {
					echo json_encode(array('status' => 'failed','message' => 'Please completed the shipper or consignee'));
				}

			break;

			case 'hold_host':
				$hawb_no = $_POST['hawb_no'];
				$data = $this->manifest_model->get_data($hawb_no);

				$get_shipper = $this->db->query("select * from customer_table where reference_id = '$data->shipper'");
				$get_consignee = $this->db->query("select * from customer_table where reference_id = '$data->consignee'");

				if($get_shipper->num_rows() > 0 && $get_consignee->num_rows() > 0) {
						$this->manifest_model->update_status($hawb_no,'hold');
					echo json_encode(array('status' => 'success','message' => 'Host #'.$hawb_no.' Hold!'));
				} else {
					echo json_encode(array('status' => 'failed','message' => 'Please completed the shipper or consignee'));
				}


			/*	$this->manifest_model->update_status($hawb_no,'hold');
				echo json_encode(array('status' => 'success','message' => 'Host #'.$hawb_no.' has been hold!')); */
			break;

			case 'add_discount':
				$discount['hawb_no'] = $_POST['hawb_no'];
				$discount['type'] = $_POST['type'];
				$discount['value'] = $_POST['value'];
				$discount['created_date'] = date('Y-m-d h:i:s');
				$discount['created_by'] = null;
				$this->manifest_model->insert_discount($discount);
			break;
			case 'edit_discount':
				$discount['type'] = $_POST['type'];
				$discount['value'] = $_POST['value'];
				$this->manifest_model->update_discount($_GET['discount_id'],$discount);
			break;
			case 'delete_discount':
				$discount_id = $_POST['discount_id'];
				$this->db->where('discount_id',$discount_id);
				$this->db->set('status','inactive');
				$this->db->update('discount_table');
			break;

			case 'add_charge':
				$charge['hawb_no'] = $_POST['hawb_no'];
				$charge['type'] = $_POST['type'];
				$charge['description'] = $_POST['description'];
				$charge['currency'] = $_POST['currency'];
				$charge['value'] = $_POST['value'];
				$charge['created_date'] = date('Y-m-d h:i:s');
				$charge['created_by'] = null;
				$this->manifest_model->insert_charge($charge);
			break;
			case 'edit_charge':
				$charge['type'] = $_POST['type'];
				$charge['description'] = $_POST['description'];
				$charge['currency'] = $_POST['currency'];
				$charge['value'] = $_POST['value'];
				$this->manifest_model->update_charge($_GET['charge_id'],$charge);
			break;
			case 'delete_charge':
				$charge_id = $_POST['charge_id'];
				$this->db->where('charge_id',$charge_id);
				$this->db->set('status','inactive');
				$this->db->update('manifest_extra_charge_table');
			break;
			case 'print':
				$master = explode(',', $_POST['master']);
				$host = explode(',', $_POST['host']);

				foreach ($master as $row) {
					$file = $this->manifest_model->get_mawb($row);
					if($file) {
						$query = $this->db->query("select * from manifest_data_table where file_id = '".$file->file_id."' and lower(status) in ('verified','success','finish')");
						if($query->num_rows() > 0) {
							foreach($query->result() as $rows) {
								if(!in_array($rows->hawb_no, $host)) {
									$host[] = $rows->hawb_no;
								}
							}
						}						
					}
				}

				error_reporting(0);
				$invoice = array();
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				foreach($host as $hawb_no) {
					if(trim($hawb_no)){
						$this->manifest_model->update_status($hawb_no,'Finish');
						if(!file_exists(path_invoice . $hawb_no .'.pdf')) {
							$this->invoice_model->create($hawb_no);
						}
						$invoice[] = $hawb_no;
					}
				}
				echo json_encode(array('status' => 'success','host' => $invoice));
			break;
		}
	}

	function get($page = null) {
		switch ($page) {
			case 'generate_hawb':
				echo $this->tool_model->generate_hawb();
			break;
			case 'sum_amount_host':
				$rate = $_POST['rate'];
				$kg = $_POST['kg'];
				$currency = $_POST['currency'];
				$exchange_rate = $this->master_currency->get_exchange_rate_value($currency);

				$amount = $kg * $rate;
				$amount = $amount * $exchange_rate;
				echo number_format($amount);
			break;
			case 'sum_total_host':
				$rate = $_POST['rate'];
				$kg = $_POST['kg'];
				$currency = $_POST['currency'];
				$exchange_rate = $this->master_currency->get_exchange_rate_value($currency);

				$charge_tata = $_POST['charge_tata'];
				$charge_pml = $_POST['charge_pml'];

				$amount = $kg * $rate;

				$amount = ($charge_tata + $charge_pml) + $amount;

				$amount = $amount * $exchange_rate;
				echo number_format($amount);
			break;
			case 'sum_total_after_discount':
				$hawb_no = $_POST['hawb_no'];
				$disc_type = $_POST['type'];
				$disc_value = $_POST['value'];

				$data = $this->manifest_model->get_by_hawb($hawb_no);
				$discount = $this->manifest_model->get_discount($hawb_no);

				$rate = $data->rate;
				$kurs = $data->exchange_rate;
				$total = $this->manifest_model->subtotal($data->hawb_no,'all');

				if(in_array($disc_type, array('rate','kurs'))) {
					$disc_rate = 0;
					$disc_kurs = 0;
					$disc_total = 0;

					if($discount) {
						foreach($discount as $row) {
							if($row->type == 'rate') {
								$disc_rate += $row->value;
							}
							if($row->type == 'kurs') {
								$disc_kurs += $row->value;
							}
							if($row->type == 'total') {
								$disc_total += $row->value;
							}
						}
					}
					
					if($disc_type == 'rate') {
						$disc_rate += $disc_value;
					}
					if($disc_type == 'kurs') {
						$disc_kurs += $disc_value;
					}
					$rate -= $disc_rate;
					$kurs -= $disc_kurs;

					$total = ($data->kg * $rate) * $kurs - $disc_total;
				} else {
					$total -= $disc_value;
				}

				echo number_format($total);
			break;
			case 'customer':
				$query = $_GET['term'];
				$query_array = explode(" ", $query);
				$this->db->select('reference_id as "id", name, address');
				foreach($query_array as $row) {
					$this->db->or_like('lower(reference_id)',strtolower($row));
					$this->db->or_like('lower(name)',strtolower($row));
				}
				$get = $this->db->get('customer_table');
				echo json_encode($get->result());
				break;
			case 'master_manifest':
				$query = $_GET['term'];
				$query_array = explode(" ", $query);
				$this->db->select('mawb_no as id,file_name');
				foreach($query_array as $row) {
					$this->db->or_like('lower(mawb_no)',strtolower($row));
					$this->db->or_like('lower(file_name)',strtolower($row));
				}
				$get = $this->db->get('manifest_file_table');
				echo json_encode($get->result());
				break;

			case 'host_manifest':
				$query = $_GET['term'];
				$query_array = explode(" ", $query);
				$this->db->select('hawb_no as id');
				foreach($query_array as $row) {
					$this->db->like('lower(hawb_no)',strtolower($row));
				}
				$this->db->where_in('lower(status)',array('verified','success','finish'));
				$get = $this->db->get('manifest_data_table');
				echo json_encode($get->result());
				break;
		}
	}

	function modal($method) {
		switch ($method) {
			case 'add_charge':
				$hawb_no = $_GET['hawb_no'];
				$this->load->view('manifest/modal_add_charge',array('data' => $this->manifest_model->get_by_hawb($hawb_no)));
				break;
			case 'edit_charge':
				$hawb_no = $_GET['hawb_no'];
				$charge_id = $_GET['charge_id'];
				$this->load->view('manifest/modal_edit_charge',array('data' => $this->manifest_model->get_by_hawb($hawb_no), 'charge' => $this->manifest_model->get_by_charge($charge_id)));
				break;
			case 'add_discount':
				$hawb_no = $_GET['hawb_no'];
				$this->load->view('manifest/modal_add_discount',array('data' => $this->manifest_model->get_by_hawb($hawb_no)));
				break;
			case 'edit_discount':
				$hawb_no = $_GET['hawb_no'];
				$discount_id = $_GET['discount_id'];
				$this->load->view('manifest/modal_edit_discount',array('data' => $this->manifest_model->get_by_hawb($hawb_no), 'discount' => $this->manifest_model->get_by_discount($discount_id)));
				break;
			
			default:
				# code...
				break;
		}
	}

}

?>