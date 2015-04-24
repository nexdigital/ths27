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

				$data['similar_customer']	= $this->manifest_model->get_similar_customer($hawb_no,$customer_type);
				$data['title']				= 'List Similar Customer';
				$this->set_content('manifest/similar_customer',$data);
			break;
			case 'download':
				$data['data']	= '';
				$data['title']	= 'Download Manifest Data';
				$this->set_content('manifest/verification',$data);
			break;
			default:
				header("HTTP/1.0 404 Not Found");
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
									$mapping[$no]['exchange_rate']  	= $this->master_currency->get_currency_value('NT','kurs Transaction');
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
						$data['hawb_no']		= $_POST['hawb_no'];
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

						$data['created_date']	= date('Y-m-d');
						$data['status_payment'] = 'Paid';
						$data['status_delivery'] = 'New Data';
						$data['currency']		= $_POST['currency'];
						$data['exchange_rate']	= $this->master_currency->get_currency_value($data['currency'],'Kurs Transaction');
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

	function get($page = null) {
		switch ($page) {
			case 'generate_hawb':
				echo $this->tool_model->generate_hawb();
			break;
			case 'sum_amount_host':
				$rate = $_POST['rate'];
				$kg = $_POST['kg'];
				$currency = $_POST['currency'];
				$exchange_rate = $this->master_currency->get_currency_value($currency,'Kurs Transaction');

				$amount = $kg * $rate;
				$amount = $amount * $exchange_rate;
				echo number_format($amount);
			break;
			case 'sum_total_host':
				$rate = $_POST['rate'];
				$kg = $_POST['kg'];
				$currency = $_POST['currency'];
				$exchange_rate = $this->master_currency->get_currency_value($currency,'Kurs Transaction');

				$charge_tata = $_POST['charge_tata'];
				$charge_pml = $_POST['charge_pml'];

				$amount = $kg * $rate;

				$amount = ($charge_tata + $charge_pml) + $amount;

				$amount = $amount * $exchange_rate;
				echo number_format($amount);
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
			
			default:
				header("HTTP/1.0 404 Not Found");
			break;
		}
	}

}

?>