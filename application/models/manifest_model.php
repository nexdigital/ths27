<?php
class Manifest_model extends CI_Model {
	function check_available_mawb($mawb_no) {
		$query = $this->db->query("select * from manifest_file_table where mawb_no = '$mawb_no' limit 1");
		if($query->num_rows() > 0) return false;
		else return true;
	}
	function check_available_hawb($hawb_no) {
		$query = $this->db->query("select * from manifest_data_table where hawb_no = '$hawb_no' limit 1");
		if($query->num_rows() > 0) return false;
		else return true;
	}
	function insert_file($file) {
		$this->db->insert('manifest_file_table',$file);
	}
	function insert_data($data) {
		$this->db->insert('manifest_data_table',$data);
	}
	function update_data($hawb_no,$data) {
		$this->db->where('hawb_no',$hawb_no);
		$this->db->update('manifest_data_table',$data);
	}
	function update_value_field($hawb_no,$field,$value) {
		$this->db->query("update manifest_data_table set ".$field." = ".$field." + ".$value." where hawb_no = '".$hawb_no."'");
	}
	function get_by_hawb($hawb_no) {
		$query = $this->db->query("select * from manifest_data_table where hawb_no='$hawb_no'");
		if($query->num_rows() > 0) return $query->row();
		else return false;
	}
	function get_data_unverified(){
		$query = $this->db->query("select f.* from manifest_file_table f join manifest_data_table d on d.file_id = f.file_id where lower(d.status) = 'unverified' group by d.file_id order by d.created_date desc");
		return $query->result();
	}
	function get_data__details_unverified($mawb_no){
		$query = $this->db->query("select d.* from manifest_data_table d join manifest_file_table f on f.file_id = d.file_id where lower(f.mawb_no) = '$mawb_no' and lower(d.status) = 'unverified' order by d.created_date desc");
		return $query->result();		
	}
	function get_similar_customer($hawb_no,$customer_type) {
		$data = $this->get_by_hawb($hawb_no);
		$address = $data->$customer_type;

		$array = explode(' ',$address);
		$QUERY = "
			SELECT
				*
			FROM
				(
					SELECT
						CUST.cust_id,
						CUST.name,
						CUST.address,
						CUST.country,
						CONCAT(
							CUST. name,
							' ',
							CUST.address,
							' ',
							CUST.phone,
							' ',
							CUST.email,
							' ',
							CUST.country
						)AS FULL_ADDRESS
					FROM
						customer_table CUST
				)CUST
			WHERE
		";
		for ($i=0;$i<=count($array)-1;$i++) {
			if(trim($array[$i])) {
				$QUERY .= "CUST.FULL_ADDRESS LIKE '%".trim(strip_tags(str_ireplace(array(',','/',"'"),'',trim($array[$i]))))."%'";
				$QUERY .= " OR ";
			}
		}
		$QUERY = substr($QUERY, 0, -4);
		$get = $this->db->query($QUERY);
		if($get->num_rows() > 0) {
			$similar['cust_id'] = array();
			foreach ($get->result() as $key => $value) {
				similar_text($value->FULL_ADDRESS, $address, $percent);
				$percent = round($percent);
				if($percent > 50) {
					$similar['percent'][] = $percent;
					$similar['cust_id'][] = $value->cust_id;
				}
			}
			if(count($similar['cust_id']) > 0) {
				$this->db->where_in('cust_id',$similar['cust_id']);
				$this->db->where('reference_id !=','0');
				$get = $this->db->get('customer_table');
				if($get->num_rows() > 0) return $get->result();
				else return FALSE;
			} else return FALSE;
		} else return FALSE;
	}

	function get_data($hawb_no) {
		$query = $this->db->query("select * from manifest_data_table where lower(hawb_no) = '$hawb_no'");
		if($query->num_rows() > 0) return $query->row();
		else return false;
	} 

	function get_file($file_id) {
		$query = $this->db->query("select * from manifest_file_table where lower(file_id) = '$file_id'");
		if($query->num_rows() > 0) return $query->row();
		else return false;
	}

	function get_discount($hawb_no) {
		$query = $this->db->query("select * from discount_table where hawb_no = '$hawb_no' and status = 'active'");
		if($query->num_rows() > 0) return $query->result();
		else return false;
	}
	function get_by_discount($discount_id) {
		$query = $this->db->query("select * from discount_table where discount_id = '$discount_id' and status = 'active'");
		if($query->num_rows() > 0) return $query->row();
		else return false;		
	}

	function insert_discount($discount) {
		$this->db->insert('discount_table',$discount);
	}
	function update_discount($discount_id, $discount) {
		$this->db->where('discount_id',$discount_id);
		$this->db->update('discount_table',$discount);
	}

	function get_extra_charge($hawb_no) {
		$query = $this->db->query("select * from manifest_extra_charge_table where hawb_no = '$hawb_no' and status = 'active'");
		if($query->num_rows() > 0) return $query->result();
		else return false;
	}
	function get_by_charge($charge_id) {
		$query = $this->db->query("select * from manifest_extra_charge_table where charge_id = '$charge_id' and status = 'active'");
		if($query->num_rows() > 0) return $query->row();
		else return false;		
	}
	function insert_charge($charge) {
		$this->db->insert('manifest_extra_charge_table',$charge);
	}
	function update_charge($charge_id,$charge) {
		$this->db->where('charge_id',$charge_id);
		$this->db->update('manifest_extra_charge_table',$charge);
	}

	function set_customer($hawb_no,$customer_type,$reference_id){
		$this->db->where('hawb_no',$hawb_no);
		$this->db->set($customer_type,$reference_id);
		$this->db->update('manifest_data_table');
	}

	function update_status($hawb_no,$status){
		$this->db->set('status',$status);
		$this->db->where('hawb_no',$hawb_no);
		$this->db->update('manifest_data_table');
	}

	function subtotal($hawb_no,$type = 'all') {
		$data = $this->get_by_hawb($hawb_no);
		$subtotal = 0;
		switch ($type) {
			case 'all':
				$discount = $this->get_discount($data->hawb_no);
				$charge = $this->get_extra_charge($data->hawb_no);

				$rate = $data->rate;
				$kurs = $data->exchange_rate;
				$disc_total = 0;

				if($discount) {
					foreach($discount as $row) {
						if($row->type == 'rate') {
							$rate -= $row->value;
						}
						if($row->type == 'kurs') {
							$kurs -= $row->value;
						}
						if($row->type == 'total') {
							$disc_total += $row->value;
						}
					}
				}

				$charge_rate = 0;
				$charge_total = 0;
				if($charge) {
					foreach ($charge as $row) {
						if($row->currency == $data->currency) {
							$charge_rate += ($row->value * $data->exchange_rate);
						} else if($row->currency == 'IDR') {
							$charge_total += $row->value;
						} else {
							$exchange_rate = $this->master_currency->get_exchange_rate_value($row->currency);
							$charge_total += ($row->value * $exchange_rate);
						}
					}
				}

				$total_rate = $data->kg * $rate;
				$total_rate += $charge_rate;

				$total_rate += $data->other_charge_tata;
				$total_rate += $data->other_charge_pml;

				$subtotal = $total_rate * $kurs;
				$subtotal -= $disc_total;
				$subtotal += $charge_total;

				return $subtotal;
			break;
			case 'normal':
				$subtotal += $data->kg * $data->rate;

				$subtotal += $data->other_charge_tata;
				$subtotal += $data->other_charge_pml;
				
				$subtotal = $subtotal * $data->exchange_rate;
				return $subtotal;
			break;

			case 'amount':
				$subtotal += $data->kg * $data->rate;
				$subtotal = $subtotal * $data->exchange_rate;
				return $subtotal;
			break;
			
			case 'charge':
				$charge = $this->get_extra_charge($data->hawb_no);
				$total_charge = 0;
				if($charge) {
					foreach ($charge as $row) {
						if($row->currency == $data->currency) {
							$total_charge += ($row->value * $data->exchange_rate);
						} else if($row->currency == 'IDR') {
							$total_charge += $row->value;
						} else {
							$rate = $this->master_currency->get_exchange_rate_value($row->currency);
							$total_charge += ($row->value * $rate);
						}
					}
				}
				return $total_charge;
				break;

			case 'discount':
				$discount = $this->get_discount($data->hawb_no);
				$disc_rate = $data->rate;
				$disc_kurs = $data->exchange_rate;
				$disc_total = 0;

				if($discount) {
					foreach($discount as $row) {
						if($row->type == 'rate') {
							$disc_rate -= $row->value;
						}
						if($row->type == 'kurs') {
							$disc_kurs -= $row->value;
						}
						if($row->type == 'total') {
							$disc_total += $row->value;
						}
					}
				}
				//Count Total Discount
				$total_discount = ($data->kg * $disc_rate) * $disc_kurs;
				$total_discount -= $disc_total;
				$total_normal = ($data->kg * $data->rate) * $data->exchange_rate;

				$sub_total_discount = $total_normal - $total_discount;

				return $sub_total_discount;
				break;
			default:
				return '0';
			break;
		}
	}

	function discount($hawb_no,$type) {
		$query = $this->db->query("select * from discount_table where hawb_no = '".$hawb_no."' and type = '".$type."' and status = 'active'");
		if($query->num_rows() > 0) return $query->row();
		else return false;
	}
}
?>