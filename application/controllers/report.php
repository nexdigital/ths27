<?php

class Report extends MY_Controller {
	
	private $flightcountry = array('taiwan' => 'tw','china' => 'chn','hongkong' => 'hkg','indonesia' => 'id');

	function __construct() {
		parent::__construct();
		$this->load->model('report_model');
	}

	function index() {
		$this->set_layout();
	}

	function customer_card() {
		$this->set_layout('report/snow_card',array('title' => 'Debit Note'));
	}

	function snow(){
		$date = $_GET['date'];
		$from = strtolower($_GET['from']);
		$to = strtolower($_GET['to']);

		switch ($from) {
			case 'tw':
				switch ($to) {
					case 'id':
						$this->snow_taiwan_jakarta();
						break;					
					default:
						echo 'Not Found';
						break;
				}
				break;
			case 'vn':
				switch($to) {
					case 'id':
						$this->snow_vietnam_jakarta();
						break;
					default:
						echo 'Not Found!';
						break;
				}
				break;
			case 'id':
				switch ($to) {
					case 'tw':
						$this->snow_jakarta_taiwan();
						break;
					case 'vn':
						$this->snow_jakarta_vietnam();
						break;
					default:
						echo 'Not Found';
						break;
				}
				break;
			default:
				echo 'Not Found';
				break;
		}
	}

	function snow_taiwan_jakarta(){
		$date = $_GET['date'];
		$from = strtolower($_GET['from']);
		$to = strtolower($_GET['to']);

		$get_file_id = $this->report_model->get_file_id_by_upload_date($date,array('taiwan','china','hongkong'));
		$snow['host'] = array();

		if($get_file_id) {
			foreach ($get_file_id as $key => $row) {
				$flight = (isset($this->flightcountry[$row->flight_from])) ? $this->flightcountry[$row->flight_from] : false;

				#GW
				$gw_hc 					= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array('hc'),strtolower($flight));
				$gw_ftz 				= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array('ftz'),strtolower($flight));
				$gw_docftz				= $this->report_model->get_count_where($row->file_id,'mawb_type',array('ftz'),strtolower($flight));
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $this->report_model->get_total('prepaid',$row->file_id,strtolower($flight));
				$in_cc					= $this->report_model->get_total('collect',$row->file_id,strtolower($flight));
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $this->report_model->get_total('other_charge_pml',$row->file_id,strtolower($flight));
				$cost_pml_freight 		= $gw_total * 56;
				$cost_tata_hc			= $gw_hc * 192;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $this->report_model->get_total('other_charge_tata',$row->file_id,strtolower($flight));
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$debit_credit 			= ($profit/2) + $cost_pml_charge + $cost_pml_freight - $in_pp;


				$snow['host'][] = array(
					'date' 					=> substr($row->created_date,0,10),
					'host' 					=> $row->mawb_no,
					'gw_hc' 				=> $gw_hc,
					'gw_ftz' 				=> $gw_ftz,
					'gw_docftz'				=> $gw_docftz,
					'gw_total'				=> $gw_total,

					'in_pp' 				=> $in_pp,
					'in_cc'					=> $in_cc,
					'in_total'				=> $in_total,

					'cost_pml_charge' 		=> $cost_pml_charge,
					'cost_pml_freight' 		=> $cost_pml_freight,

					'cost_tata_hc'			=> $cost_tata_hc,
					'cost_tata_ftz'			=> $cost_tata_ftz,
					'cost_tata_charge' 		=> $cost_tata_charge,
					'cost_total'			=> $cost_total,

					'profit' 				=> $profit,
					'debit_credit'			=> $debit_credit
				);

				//Pouchen Fengtay
				$list_mawb_type = array('pouchen','fengtay');
				foreach ($list_mawb_type as $type) {
					if($this->report_model->get_manifest_by_mawb_type_and_file_id($row->file_id,$type,strtolower($row->flight_from))) {
						#GW
						$gw_hc 					= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_hc'),strtolower($flight));
						$gw_ftz 				= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_ftz'),strtolower($flight));
						$gw_docftz				= $this->report_model->get_count_where($row->file_id,'mawb_type',array($type . '_ftz'),strtolower($flight));
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $this->report_model->get_total_where('prepaid',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($flight));
						$in_cc					= $this->report_model->get_total_where('collect',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($flight));
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $this->report_model->get_total_where('other_charge_pml',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($flight));
						$cost_pml_freight 		= $gw_total * 56;
						$cost_tata_hc			= $gw_hc * 192;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $this->report_model->get_total_where('other_charge_tata',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),strtolower($flight));
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$profit_split			= ($type == 'pouchen') ? 3 : 2;

						$debit_credit 			= ($profit/$profit_split) + $cost_pml_charge + $cost_pml_freight - $in_pp;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> ucwords($type),
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,
								'debit_credit'			=> $debit_credit
						);
					}
				}

				//PIBK
				if($pibk_data = $this->report_model->get_manifest_by_mawb_type_and_file_id($row->file_id,'pibk',strtolower($row->flight_from))) {
					foreach ($pibk_data as $key => $pibk_row) {
						#GW
						$gw_hc 					= $this->report_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array('hc'),strtolower($flight));
						$gw_ftz 				= $this->report_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array('ftz'),strtolower($flight));
						$gw_docftz				= $this->report_model->get_count_where_by_hawb($pibk_row->hawb_no,'mawb_type',array('ftz'),strtolower($flight));
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $pibk_row->prepaid;
						$in_cc					= $pibk_row->collect;
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $pibk_row->other_charge_pml;
						$cost_pml_freight 		= $gw_total * 56;
						$cost_tata_hc			= $gw_hc * 192;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $pibk_row->other_charge_tata;
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$debit_credit 			= ($profit/2) + $cost_pml_charge + $cost_pml_freight - $in_pp;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> $pibk_row->hawb_no .' P.I.B.K',
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,
								'debit_credit'			=> $debit_credit
						);
					}
				}

				$get_from_other_country = $this->report_model->get_data_by_other_country($row->file_id,strtolower($flight));
				if($get_from_other_country) {
					foreach ($get_from_other_country as $key => $other_country_row) {
						#GW
						$gw_hc 					= $this->report_model->get_total_where_by_hawb('kg',$other_country_row->hawb_no,'mawb_type',array('hc'));
						$gw_ftz 				= $this->report_model->get_total_where_by_hawb('kg',$other_country_row->hawb_no,'mawb_type',array('ftz'));
						$gw_docftz				= $this->report_model->get_count_where_by_hawb($other_country_row->hawb_no,'mawb_type',array('ftz'));
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $other_country_row->prepaid;
						$in_cc					= $other_country_row->collect;
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $other_country_row->other_charge_pml;

						if(strtolower($other_country_row->country) == 'china') {
							if($gw_total <= 45) {
								$cost_pml_freight = $gw_total * 87;
							}
							if($gw_total > 45 && $gw_total <= 250) {
								$cost_pml_freight = $gw_total * 78;
							}
							if($gw_total > 250 && $gw_total <= 500) {
								$cost_pml_freight = $gw_total * 77;
							}
							if($gw_total > 500) {
								$cost_pml_freight = $gw_total * 76;
							}								
						} else {
							$cost_pml_freight 		= $gw_total * 56;
						}

						$cost_tata_hc			= $gw_hc * 192;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $other_country_row->other_charge_tata;
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$debit_credit 			= ($profit/2) + $cost_pml_charge + $cost_pml_freight - $in_pp;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> $other_country_row->hawb_no,
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,
								'debit_credit'			=> $debit_credit
						);
					}
				}
			}
		}
		$snow['title'] = 'Debit Note '.$_GET['from'].' -> '.$_GET['to'].'';
		$this->set_content('report/snow_taiwan',$snow);
	}

	function snow_vietnam_jakarta() {
		$date = $_GET['date'];
		$from = strtolower($_GET['from']);
		$to = strtolower($_GET['to']);

		$get_file_id = $this->report_model->get_file_id_by_upload_date($date,'vietnam');

		$snow['host'] = array();

		if($get_file_id) {
			foreach ($get_file_id as $key => $row) {
					$flight = (isset($this->flightcountry[$row->flight_from])) ? $this->flightcountry[$row->flight_from] : false;

					#GW
					$gw_hc 					= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array('hc'),$flight);
					$gw_ftz 				= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array('ftz'),$flight);
					$gw_docftz				= $this->report_model->get_count_where($row->file_id,'mawb_type',array('ftz'),$flight);
					$gw_total				= $gw_hc + $gw_ftz;

					#INCOME
					$in_pp 					= $this->report_model->get_total('prepaid',$row->file_id,$flight);
					$in_cc					= $this->report_model->get_total('collect',$row->file_id,$flight);
					$in_total				= $in_pp + $in_cc;

					#COST
					$cost_pml_charge 		= $this->report_model->get_total('other_charge_pml',$row->file_id,$flight);

					if($gw_total < 100) {
						$cost_pml_freight 		= $gw_total * (39 + 38);
					}
					if($gw_total >= 100 && $gw_total < 300) {
						$cost_pml_freight 		= $gw_total * (34 + 38);
					}
					if($gw_total >= 300 && $gw_total < 500) {
						$cost_pml_freight 		= $gw_total * (28 + 38);
					}
					if($gw_total >= 500) {
						$cost_pml_freight 		= $gw_total * (26 + 38);
					}

					$cost_tata_hc			= $gw_hc * 64;
					$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
					$cost_tata_charge 		= $this->report_model->get_total('other_charge_tata',$row->file_id,$flight);
					$cost_tata_tpe	 		= $gw_total * (56 + 26);
					$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

					$profit 				= $in_total - $cost_total;

					$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
					$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
					$pml 					= $profit * 0.3 + $cost_tata_tpe;

					$snow['host'][] = array(
						'date' 					=> substr($row->created_date,0,10),
						'host' 					=> $row->mawb_no,
						'gw_hc' 				=> $gw_hc,
						'gw_ftz' 				=> $gw_ftz,
						'gw_docftz'				=> $gw_docftz,
						'gw_total'				=> $gw_total,

						'in_pp' 				=> $in_pp,
						'in_cc'					=> $in_cc,
						'in_total'				=> $in_total,

						'cost_pml_charge' 		=> $cost_pml_charge,
						'cost_pml_freight' 		=> $cost_pml_freight,

						'cost_tata_hc'			=> $cost_tata_hc,
						'cost_tata_ftz'			=> $cost_tata_ftz,
						'cost_tata_charge' 		=> $cost_tata_charge,
						'cost_tata_tpe'			=> $cost_tata_tpe,
						'cost_total'			=> $cost_total,

						'profit' 				=> $profit,

						'tata'					=> $tata,
						'lita'					=> $lita,
						'pml'					=> $pml
				);

				//Pouchen Fengtay
				$list_mawb_type = array('pouchen','fengtay');
				foreach ($list_mawb_type as $type) {
					if($this->report_model->get_manifest_by_mawb_type_and_file_id($row->file_id,$type,'vietnam')) {
						#GW
						$gw_hc 					= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_hc'),$flight);
						$gw_ftz 				= $this->report_model->get_total_where('kg',$row->file_id,'mawb_type',array($type . '_ftz'),$flight);
						$gw_docftz				= $this->report_model->get_count_where($row->file_id,'mawb_type',array($type . '_ftz'),$flight);
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $this->report_model->get_total_where('prepaid',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),$flight);
						$in_cc					= $this->report_model->get_total_where('collect',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),$flight);
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $this->report_model->get_total_where('other_charge_pml',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),$flight);
						

						if($gw_total < 100) {
							$cost_pml_freight 		= $gw_total * (39 + 38);
						}
						if($gw_total >= 100 && $gw_total < 300) {
							$cost_pml_freight 		= $gw_total * (34 + 38);
						}
						if($gw_total >= 300 && $gw_total < 500) {
							$cost_pml_freight 		= $gw_total * (28 + 38);
						}
						if($gw_total >= 500) {
							$cost_pml_freight 		= $gw_total * (26 + 38);
						}


						$cost_tata_hc			= $gw_hc * 64;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $this->report_model->get_total_where('other_charge_tata',$row->file_id,'mawb_type',array($type . '_ftz',$type . '_hc'),$flight);
						$cost_tata_tpe	 		= $gw_total * (56 + 26);
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
						$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
						$pml 					= $profit * 0.3 + $cost_tata_tpe;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> ucwords($type),
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_tata_tpe'			=> $cost_tata_tpe,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,

								'tata'					=> $tata,
								'lita'					=> $lita,
								'pml'					=> $pml
						);
					}
				}

				//PIBK
				if($pibk_data = $this->report_model->get_manifest_by_mawb_type_and_file_id($row->file_id,'pibk','vietnam')) {
					foreach ($pibk_data as $key => $pibk_row) {
						#GW
						$gw_hc 					= $this->report_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array('pibk'),$flight);
						$gw_ftz 				= $this->report_model->get_total_where_by_hawb('kg',$pibk_row->hawb_no,'mawb_type',array(''),$flight);
						$gw_docftz				= $this->report_model->get_count_where_by_hawb($pibk_row->hawb_no,'mawb_type',array(''),$flight);
						$gw_total				= $gw_hc + $gw_ftz;

						#INCOME
						$in_pp 					= $pibk_row->prepaid;
						$in_cc					= $pibk_row->collect;
						$in_total				= $in_pp + $in_cc;

						#COST
						$cost_pml_charge 		= $pibk_row->other_charge_pml;

						if($gw_total < 100) {
							$cost_pml_freight 		= $gw_total * (39 + 38);
						}
						if($gw_total >= 100 && $gw_total < 300) {
							$cost_pml_freight 		= $gw_total * (34 + 38);
						}
						if($gw_total >= 300 && $gw_total < 500) {
							$cost_pml_freight 		= $gw_total * (28 + 38);
						}
						if($gw_total >= 500) {
							$cost_pml_freight 		= $gw_total * (26 + 38);
						}
						
						$cost_tata_hc			= $gw_hc * 64;
						$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
						$cost_tata_charge 		= $pibk_row->other_charge_tata;
						$cost_tata_tpe	 		= $gw_total * (56 + 26);
						$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

						$profit 				= $in_total - $cost_total;

						$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
						$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
						$pml 					= $profit * 0.3 + $cost_tata_tpe;


						$snow['host'][] = array(
								'date' 					=> '',
								'host' 					=> $pibk_row->hawb_no .' P.I.B.K',
								'gw_hc' 				=> $gw_hc,
								'gw_ftz' 				=> $gw_ftz,
								'gw_docftz'				=> $gw_docftz,
								'gw_total'				=> $gw_total,

								'in_pp' 				=> $in_pp,
								'in_cc'					=> $in_cc,
								'in_total'				=> $in_total,

								'cost_pml_charge' 		=> $cost_pml_charge,
								'cost_pml_freight' 		=> $cost_pml_freight,

								'cost_tata_hc'			=> $cost_tata_hc,
								'cost_tata_ftz'			=> $cost_tata_ftz,
								'cost_tata_charge' 		=> $cost_tata_charge,
								'cost_tata_tpe'			=> $cost_tata_tpe,
								'cost_total'			=> $cost_total,

								'profit' 				=> $profit,

								'tata'					=> $tata,
								'lita'					=> $lita,
								'pml'					=> $pml
						);
					}
				}
			}
		}

		$data_on_other_manifest = $this->report_model->get_file_id_by_upload_date_and_country($date,'vietnam');
		if($data_on_other_manifest) {
			foreach ($data_on_other_manifest as $key => $other_manifest) {
				#GW
				$gw_hc 					= $this->report_model->get_total_where_by_hawb('kg',$other_manifest->hawb_no,'mawb_type',array('hc'),$flight);
				$gw_ftz 				= $this->report_model->get_total_where_by_hawb('kg',$other_manifest->hawb_no,'mawb_type',array('ftz'),$flight);
				$gw_docftz				= $this->report_model->get_count_where_by_hawb($other_manifest->hawb_no,'mawb_type',array('ftz'),$flight);
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $other_manifest->prepaid;
				$in_cc					= $other_manifest->collect;
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $other_manifest->other_charge_pml;
				$cost_pml_freight 		= $gw_total * (50 + 38);
				$cost_tata_hc			= $gw_hc * 64;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $other_manifest->other_charge_tata;
				$cost_tata_tpe	 		= $gw_total * (56 + 26);
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
				$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
				$pml 					= $profit * 0.3 + $cost_tata_tpe;


				$snow['host'][] = array(
						'date' 					=> '',
						'host' 					=> $other_manifest->hawb_no,
						'gw_hc' 				=> $gw_hc,
						'gw_ftz' 				=> $gw_ftz,
						'gw_docftz'				=> $gw_docftz,
						'gw_total'				=> $gw_total,

						'in_pp' 				=> $in_pp,
						'in_cc'					=> $in_cc,
						'in_total'				=> $in_total,

						'cost_pml_charge' 		=> $cost_pml_charge,
						'cost_pml_freight' 		=> $cost_pml_freight,

						'cost_tata_hc'			=> $cost_tata_hc,
						'cost_tata_ftz'			=> $cost_tata_ftz,
						'cost_tata_charge' 		=> $cost_tata_charge,
						'cost_tata_tpe'			=> $cost_tata_tpe,
						'cost_total'			=> $cost_total,

						'profit' 				=> $profit,

						'tata'					=> $tata,
						'lita'					=> $lita,
						'pml'					=> $pml
				);
			}
		}
		$snow['title'] = 'Debit Note '.$_GET['from'].' -> '.$_GET['to'].'';
		$this->set_content('report/snow_vietnam',$snow);
	}

	function snow_jakarta_taiwan(){
		$date = $_GET['date'];
		$from = strtolower($_GET['from']);
		$to = strtolower($_GET['to']);

		$snow['host'] = array();


		$get_manifest = $this->report_model->get_snow_jakarta_to_country_by_upload_date($date,'taiwan');
		if($get_manifest) {
			foreach ($get_manifest as $key => $row) {
				$snow_jakarta_taiwan = $this->report_model->get_snow_local_from_to($row->file_id,$from,$to);
				if($snow_jakarta_taiwan) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,$from,$to,'kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,$from,$to,'kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,$from,$to,'prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,$from,$to,'collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,$from,$to,'other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,$from,$to,'other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_tw',
						'date'				=> substr($row->created_date,0,10),
						'host'				=> $row->mawb_no,
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_jakarta_hongkong = $this->report_model->get_snow_local_from_to($row->file_id,'id','hkg');
				if($snow_jakarta_hongkong) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'id','hkg','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'id','hkg','kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'id','hkg','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'id','hkg','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'id','hkg','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'id','hkg','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_hkg',
						'date'				=> '',
						'host'				=> 'JKT - HKG',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_jakarta_china = $this->report_model->get_snow_local_from_to($row->file_id,'id','chn');
				if($snow_jakarta_china) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'id','chn','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'id','chn','kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'id','chn','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'id','chn','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'id','chn','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'id','chn','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_chn',
						'date'				=> '',
						'host'				=> 'JKT - CHN',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}

				$snow_surabaya_taiwan = $this->report_model->get_snow_local_from_to($row->file_id,'surabaya','taiwan');
				if($snow_surabaya_taiwan) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * 20;
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','taiwan','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$total_kg_cc		= $this->report_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','taiwan','kg');

					$acu_total_cc 		= $total_kg_cc * 260;
					$acu_cost			= $total_kg_cc * 210;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_tw',
						'date'				=> '',
						'host'				=> 'SUB - TW',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_surabaya_hongkong = $this->report_model->get_snow_local_from_to($row->file_id,'surabaya','hongkong');
				if($snow_surabaya_hongkong) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * (20+55);
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','hongkong','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$total_kg_cc		= $this->report_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','hongkong','kg');

					$acu_total_cc 		= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 450) + 850 : 0;
					$acu_cost			= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 400) + 800 : 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_hkg',
						'date'				=> '',
						'host'				=> 'SUB - HKG',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
				$snow_surabaya_china = $this->report_model->get_snow_local_from_to($row->file_id,'surabaya','china');
				if($snow_surabaya_china) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','china','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','china','kg');;
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','china','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','china','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','china','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * 96;
					$cost_pml_handling 	= $gw_mawb * (20+92);
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','china','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;
					$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
					$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;

					$total_kg_cc		= $this->report_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','china','kg');

					$acu_total_cc 		= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 450) + 850 : 0;
					$acu_cost			= ($total_kg_cc > 1) ? (($total_kg_cc-1) * 400) + 800 : 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_chn',
						'date'				=> '',
						'host'				=> 'SUB - CHN',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'credit_to_ths' 	=> $credit_to_ths,
						'credit_to_pml' 	=> $credit_to_pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
			}
		}
		$snow['title'] = 'Debit Note '.$_GET['from'].' -> '.$_GET['to'].'';
		$this->set_content('report/snow_jakarta_taiwan',$snow);
	}

	function snow_jakarta_vietnam(){
		$date = $_GET['date'];
		$snow['host'] = array();


		$get_manifest = $this->report_model->get_snow_jakarta_to_country_by_upload_date($date,'vietnam');
		if($get_manifest) {
			foreach ($get_manifest as $key => $row) {
				$snow_jakarta_vietnam = $this->report_model->get_snow_local_from_to($row->file_id,'id','vn');
				if($snow_jakarta_vietnam) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'id','vn','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'id','vn','kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'id','vn','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'id','vn','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_tpe		= $gw_mawb * (26+52);				
					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'id','vn','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * (64+33);
					$cost_pml_handling 	= $gw_mawb * 64;
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'id','vn','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;

					$tata 				= ($in_pp) ? ($profit * 0.4) + ($cost_tata_freight + $cost_tata_charge) - $in_pp : ($profit * 0.3) + ($cost_tata_freight + $cost_tata_charge) - $in_pp;
					$lita 				= ($in_cc) ? ($profit * 0.4) + ($cost_pml_handling + $cost_pml_charge) - $in_cc : ($profit * 0.3) + ($cost_pml_handling + $cost_pml_charge) - $in_cc;
					$pml 				= $profit * 0.3 + $cost_tata_tpe;

					$acu_total_cc 		= 0;
					$acu_cost			= 0;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'jkt_vn',
						'date'				=> substr($row->created_date,0,10),
						'host'				=> $row->mawb_no,
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_tpe' 	=> $cost_tata_tpe,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'tata' 				=> $tata,
						'lita' 				=> $lita,
						'pml' 				=> $pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}

				$snow_surabaya_vietnam = $this->report_model->get_snow_local_from_to($row->file_id,'surabaya','vietnam');
				if($snow_surabaya_vietnam) {
					$gw_selling 		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','kg');
					$gw_mawb    		= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','kg');
					$in_pp 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','prepaid');
					$in_cc 				= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','collect');
					$in_total			= $in_pp + $in_cc;

					$cost_tata_tpe		= $gw_mawb * (26+52);				
					$cost_tata_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','other_charge_tata');				
					$cost_tata_freight	= $gw_mawb * (64+33);
					$cost_pml_handling 	= $gw_mawb * 64;
					$cost_pml_charge	= $this->report_model->snow_local_get_total_where($row->file_id,'surabaya','vietnam','other_charge_pml');
					$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

					$profit 			= $in_total - $cost_total;

					$tata 				= ($in_pp) ? ($profit * 0.4) + ($cost_tata_freight + $cost_tata_charge) - $in_pp : ($profit * 0.3) + ($cost_tata_freight + $cost_tata_charge) - $in_pp;
					$lita 				= ($in_cc) ? ($profit * 0.4) + ($cost_pml_handling + $cost_pml_charge) - $in_cc : ($profit * 0.3) + ($cost_pml_handling + $cost_pml_charge) - $in_cc;
					$pml 				= $profit * 0.3 + $cost_tata_tpe;

					$total_kg_cc		= $this->report_model->snow_local_get_total_where_on_collect($row->file_id,'surabaya','vietnam','kg');

					$acu_total_cc 		= $total_kg_cc * 400;
					$acu_cost			= $total_kg_cc * 350;
					$acu_refund			= $acu_total_cc - $acu_cost;

					$snow['host'][]		= array(
						'snow_type'			=> 'sub_vn',
						'date'				=> '',
						'host'				=> 'SUB - VN',
						'gw_selling' 		=> $gw_selling,
						'gw_mawb' 			=> $gw_mawb,
						'in_pp' 			=> $in_pp,
						'in_cc' 			=> $in_cc,
						'in_total' 			=> $in_total,
						'cost_tata_tpe' 	=> $cost_tata_tpe,
						'cost_tata_charge' 	=> $cost_tata_charge,
						'cost_tata_freight' => $cost_tata_freight,
						'cost_pml_handling' => $cost_pml_handling,
						'cost_pml_charge' 	=> $cost_pml_charge,
						'cost_total' 		=> $cost_total,
						'profit' 			=> $profit,
						'tata' 				=> $tata,
						'lita' 				=> $lita,
						'pml' 				=> $pml,
						'acu_total_cc' 		=> $acu_total_cc,
						'acu_cost' 			=> $acu_cost,
						'acu_refund' 		=> $acu_refund
						);
				}
			}
		}
		$snow['title'] = 'Debit Note '.$_GET['from'].' -> '.$_GET['to'].'';
		$this->set_content('report/snow_jakarta_vietnam',$snow);
	}

	function calc(){
		$host = $_POST['snow'];
		switch ($host) {
			case 'taiwan':
				$mawb_host = $_POST['host'];
				$get_data_from = $this->report_model->get_hawb_from($mawb_host);

				#GW
				$gw_hc 					= $_POST['gw_hc'];
				$gw_ftz 				= $_POST['gw_ftz'];
				$gw_docftz				= $_POST['gw_docftz'];
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $_POST['in_pp'];
				$in_cc					= $_POST['in_cc'];
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $_POST['cost_pml_charge'];

				if($get_data_from) {
					if(strtolower($get_data_from->country) == 'china') {
						if($gw_total <= 45) {
							$cost_pml_freight = $gw_total * 87;
						}
						if($gw_total > 45 && $gw_total <= 250) {
							$cost_pml_freight = $gw_total * 78;
						}
						if($gw_total > 250 && $gw_total <= 500) {
							$cost_pml_freight = $gw_total * 77;
						}
						if($gw_total > 500) {
							$cost_pml_freight = $gw_total * 76;
						}								
					} else {
						$cost_pml_freight 		= $gw_total * 56;
					}
				} else {
					$cost_pml_freight 		= $gw_total * 56;
				}
				
				$cost_tata_hc			= $gw_hc * 192;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $_POST['cost_tata_charge'];
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$profit_split			= (trim($_POST['host'],'<br>') == 'pouchen') ? 3 : 2;

				$debit_credit 			= ($profit/$profit_split) + $cost_pml_charge + $cost_pml_freight - $in_pp;


				$snow = array(
					'date' 					=> '',
					'host' 					=> $mawb_host,
					'gw_hc' 				=> $gw_hc,
					'gw_ftz' 				=> $gw_ftz,
					'gw_docftz'				=> $gw_docftz,
					'gw_total'				=> $gw_total,

					'in_pp' 				=> $in_pp,
					'in_cc'					=> $in_cc,
					'in_total'				=> $in_total,

					'cost_pml_charge' 		=> $cost_pml_charge,
					'cost_pml_freight' 		=> $cost_pml_freight,

					'cost_tata_hc'			=> $cost_tata_hc,
					'cost_tata_ftz'			=> $cost_tata_ftz,
					'cost_tata_charge' 		=> $cost_tata_charge,
					'cost_total'			=> $cost_total,

					'profit' 				=> $profit,
					'debit_credit'			=> $debit_credit
				);				
				echo json_encode($snow);
			break;

			case 'vietnam':
				#GW
				$mawb_host = $_POST['host'];
				$get_data_from = $this->report_model->get_hawb_from($mawb_host);

				$gw_hc 					= $_POST['gw_hc'];
				$gw_ftz 				= $_POST['gw_ftz'];
				$gw_docftz				= $_POST['gw_docftz'];
				$gw_total				= $gw_hc + $gw_ftz;

				#INCOME
				$in_pp 					= $_POST['in_pp'];
				$in_cc					= $_POST['in_cc'];
				$in_total				= $in_pp + $in_cc;

				#COST
				$cost_pml_charge 		= $_POST['cost_pml_charge'];

				if($get_data_from) {
					$cost_pml_freight 		= $gw_total * (50 + 38);
				} else {
					if($gw_total < 100) {
						$cost_pml_freight 		= $gw_total * (39 + 38);
					}
					if($gw_total >= 100 && $gw_total < 300) {
						$cost_pml_freight 		= $gw_total * (34 + 38);
					}
					if($gw_total >= 300 && $gw_total < 500) {
						$cost_pml_freight 		= $gw_total * (28 + 38);
					}
					if($gw_total >= 500) {
						$cost_pml_freight 		= $gw_total * (26 + 38);
					}
				}

				$cost_tata_hc			= $gw_hc * 64;
				$cost_tata_ftz			= ($gw_ftz * 16) + (640 * $gw_docftz);
				$cost_tata_charge 		= $_POST['cost_tata_charge'];
				$cost_tata_tpe	 		= $gw_total * (56 + 26);
				$cost_total				= $cost_pml_charge + $cost_pml_freight + $cost_tata_hc + $cost_tata_ftz + $cost_tata_charge;

				$profit 				= $in_total - $cost_total;

				$tata 					= ($in_cc) ? $profit * 0.4 + $cost_tata_hc + $cost_tata_ftz - $in_cc : $profit * 0.3 + $cost_tata_hc + $cost_tata_ftz - $in_cc;
				$lita 					= ($in_pp) ? $profit * 0.4 + $cost_pml_charge + $cost_pml_freight - $in_pp : $profit * 0.3 + $cost_pml_charge + $cost_pml_freight - $in_pp;
				$pml 					= $profit * 0.3 + $cost_tata_tpe;

				$snow = array(
					'date' 					=> '',
					'host' 					=> $mawb_host,
					'gw_hc' 				=> $gw_hc,
					'gw_ftz' 				=> $gw_ftz,
					'gw_docftz'				=> $gw_docftz,
					'gw_total'				=> $gw_total,

					'in_pp' 				=> $in_pp,
					'in_cc'					=> $in_cc,
					'in_total'				=> $in_total,

					'cost_pml_charge' 		=> $cost_pml_charge,
					'cost_pml_freight' 		=> $cost_pml_freight,

					'cost_tata_hc'			=> $cost_tata_hc,
					'cost_tata_ftz'			=> $cost_tata_ftz,
					'cost_tata_charge' 		=> $cost_tata_charge,
					'cost_tata_tpe'			=> $cost_tata_tpe,
					'cost_total'			=> $cost_total,

					'profit' 				=> $profit,

					'tata'					=> $tata,
					'lita'					=> $lita,
					'pml'					=> $pml
			);
			echo json_encode($snow);
			break;

			case 'jakarta_taiwan':
				$snow_type = $_POST['snow_type'];
				switch ($snow_type) {
					default:
						$gw_mawb    		= $_POST['gw_mawb'];
						$in_pp 				= $_POST['in_pp'];
						$in_cc 				= $_POST['in_cc'];
						$in_total			= $in_pp + $in_cc;

						$cost_tata_charge	= $_POST['cost_tata_charge'];
						$cost_tata_freight	= $gw_mawb * 96;
						
						if($snow_type == 'sub_chn') {
							$cost_pml_handling 	= $gw_mawb * (20+92);
						} else if($snow_type == 'sub_hkg') {
							$cost_pml_handling 	= $gw_mawb * (20+55);
						} else {
							$cost_pml_handling 	= $gw_mawb * 20;
						}

						$cost_pml_charge	= $_POST['cost_pml_charge'];
						$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

						$profit 			= $in_total - $cost_total;
						$credit_to_ths 		= $profit/2 + $cost_tata_freight + $cost_tata_charge - $in_pp;
						$credit_to_pml 		= $profit/2 + $cost_pml_handling + $cost_pml_charge - $in_cc;
						$snow		= array(
							'in_total' 			=> $in_total,
							'cost_tata_freight' => $cost_tata_freight,
							'cost_pml_handling' => $cost_pml_handling,
							'cost_total' 		=> $cost_total,
							'profit' 			=> $profit,
							'credit_to_ths' 	=> $credit_to_ths,
							'credit_to_pml' 	=> $credit_to_pml
							);
						echo json_encode($snow);
					break;
				}
			break;

			case 'jakarta_vietnam':
				$snow_type = $_POST['snow_type'];
				switch ($snow_type) {
					default:
						$gw_mawb    		= $_POST['gw_mawb'];
						$in_pp 				= $_POST['in_pp'];
						$in_cc 				= $_POST['in_cc'];
						$in_total			= $in_pp + $in_cc;

						$cost_tata_tpe		= $gw_mawb * (26+52);				
						$cost_tata_charge	= $_POST['cost_tata_charge'];
						$cost_tata_freight	= $gw_mawb * (64+33);
						$cost_pml_handling 	= $gw_mawb * 64;
						$cost_pml_charge	= $_POST['cost_tata_charge'];
						$cost_total			= $cost_tata_charge + $cost_tata_freight + $cost_pml_handling + $cost_pml_charge;

						$profit 			= $in_total - $cost_total;

						$tata 				= ($in_pp) ? ($profit * 0.4) + ($cost_tata_freight + $cost_tata_charge) - $in_pp : ($profit * 0.3) + ($cost_tata_freight + $cost_tata_charge) - $in_pp;
						$lita 				= ($in_cc) ? ($profit * 0.4) + ($cost_pml_handling + $cost_pml_charge) - $in_cc : ($profit * 0.3) + ($cost_pml_handling + $cost_pml_charge) - $in_cc;
						$pml 				= $profit * 0.3 + $cost_tata_tpe;
						$snow		= array(
							'in_total' 			=> $in_total,
							'cost_tata_tpe' 	=> $cost_tata_tpe,
							'cost_tata_freight' => $cost_tata_freight,
							'cost_pml_handling' => $cost_pml_handling,
							'cost_total' 		=> $cost_total,
							'profit' 			=> $profit,
							'tata'	 			=> $tata,
							'lita'	 			=> $lita,
							'pml' 				=> $pml
							);
						echo json_encode($snow);
					break;
				}
			break;
		}
	}

	function formula($formula){
		switch ($formula) {
			case 'sum':
				$val = $_POST['val'];
				$sum = 0;
				foreach ($val as $row) { $sum += $row; }
				echo $sum;
				break;
			
			default:
				echo 'Error';
				break;
		}
	}
}

?>