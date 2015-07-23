<?php

class Tool_model extends CI_Model {
	function list_country(){
	/*	$country = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
		return $country;*/
		$this->db->where('is_active','active');
		$get = $this->db->get('master_country_table');
		return $get->result();
	}

	function list_partner(){
	/*	$country = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
		return $country;*/
		$this->db->where('is_active','active');
		$get = $this->db->get('partner');
		return $get->result();
	}

	function get_tax(){
		$this->db->where('is_active','active');
		$get = $this->db->get('master_tax');
		return $get->result();

	}

	function generate_file_id(){
		$count = $this->db->count_all('manifest_file_table');
		$count += 1;

		switch (strlen($count)) {
			case '1':
				return "F" . date('ymd') . "000" .$count;
			break;
			case '2':
				return "F" . date('ymd') . "00" .$count;
			break;
			case '3':
				return "F" . date('ymd') . "0" .$count;
			break;					
			default:
				return "F" . date('ymd') . $count;
			break;
		}
	}
	function generate_data_id(){
		$count = $this->db->count_all('manifest_data_table');
		$count += 1;

		switch (strlen($count)) {
			case '1':
				return "D" . date('ymd') . "000" .$count;
			break;
			case '2':
				return "D" . date('ymd') . "00" .$count;
			break;
			case '3':
				return "D" . date('ymd') . "0" .$count;
			break;					
			default:
				return "D" . date('ymd') . $count;
			break;
		}
	}
	function generate_hawb(){
		$this->db->where('left(created_date,10)',date('Y-m-d'));
		$this->db->where('lower(manifest_type) !=','import');
		$get = $this->db->get('manifest_data_table');
		$count = $get->num_rows();
		$count += 1;

		switch (strlen($count)) {
			case '1':
				return "T" . date('ymd') . "000" .$count;
			break;
			case '2':
				return "T" . date('ymd') . "00" .$count;
			break;
			case '3':
				return "T" . date('ymd') . "0" .$count;
			break;					
			default:
				return "T" . date('ymd') . $count;
			break;
		}		
	}
	function format_header_file(){
		$header = array('no','hawb_no','shipper','consignee','pkg','description','pcs','kg','value','pp','cc','remarks','other_charge_tata','other_charge_pml','mawb_type','rate');
		return $header;
	}

	function get_key_cell($key,$array){
		$string = array_search($key,$array);
		preg_match_all('!\d+!', $string, $result);
		if(isset($result[0][0])) return $result[0][0];		
		else return false;
	}
	function rounded_kg($num) {
		$exp = explode('.', $num);
		if(is_array($exp) && count($exp) == 2) {
			if(is_numeric($exp[0]) && is_numeric($exp[1])) {
				if(end($exp) >= 1 && end($exp) <= 5) {
					return $exp[0].'.5';
				} else if(end($exp) >= 6 && end($exp) <= 9) {
					return $exp[0] + 1 . '.0';
				}
			} return $num;
		} return $num;
	}
	function remove_tags_excel($string){
		$string = str_ireplace('_x000D_', ' ',$string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', ' ',$string);
		$string = str_ireplace('-', ' ',$string);
		$string = preg_replace('!\s+!', ' ',$string);
		return $string;
	}
	function set_deadline($days) {
		$date = strtotime($days . " day");
		return date('Y-m-d', $date);
	}

	function generate_pagination($page,$total_page) {
		if($total_page > 1) {
			$start_loop = $page - 2;
			$end_loop = $page + 2;

			if($start_loop < 1) $start_loop = 1;
			if($end_loop > $total_page) $end_loop = $total_page;

			if($page < 4) {
				$start_loop = 1;
				$end_loop = 5;
			}

			if(($total_page - $page) < 4) {
				$start_loop = $total_page - 5;
				$end_loop = $total_page;
			}

			if($start_loop < 1) $start_loop = 1;
			if($end_loop > $total_page) $end_loop = $total_page;

			$pagination =  '
				<nav>
				  <ul class="pagination">
				    <li>
				      <a href="javascript:;" onCLick="gotopage(1)">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				';
			for($i = $start_loop; $i <= $end_loop; $i++) {
				$active = ($i == $page) ? 'active' : ''; 
				$pagination = $pagination . '
				    <li class="'.$active.'"><a href="javascript:;" onCLick="gotopage('.$i.')">'.$i.'</a></li>
				';
			}
			$pagination = $pagination . '
				    <li>
				      <a href="javascript:;" onCLick="gotopage('.$total_page.')">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			';
			return $pagination;
		}
	}

	function satuan($inp) {
	    if ($inp == 1) {
	        return "satu ";
	    } else if ($inp == 2) {
	        return "dua ";
	    } else if ($inp == 3) {
	        return "tiga ";
	    } else if ($inp == 4) {
	        return "empat ";
	    } else if ($inp == 5) {
	        return "lima ";
	    } else if ($inp == 6) {
	        return "enam ";
	    } else if ($inp == 7) {
	        return "tujuh ";
	    } else if ($inp == 8) {
	        return "delapan ";
	    } else if ($inp == 9) {
	        return "sembilan ";
	    } else {
	        return "";
	    }
	}

	function belasan($inp) {
	    $proses = $inp; //substr($inp, -1);
	    if ($proses == '11') {
	        return "sebelas ";
	    } else {
	        $proses = substr($proses,1,1);
	        return $this->satuan($proses)."belas ";
	    }
	}

	function puluhan($inp) {
	    $proses = $inp; //substr($inp, 0, -1);
	    if ($proses == 1) {
	        return "sepuluh ";
	    } else if ($proses == 0) {
	        return '';
	    } else {
	        return $this->satuan($proses)."puluh ";
	    }
	}

	function ratusan($inp) {
	    $proses = $inp; //substr($inp, 0, -2);
	    if ($proses == 1) {
	        return "seratus ";
	    } else if ($proses == 0) {
	        return '';
	    } else {
	        return $this->satuan($proses)."ratus ";
	    }
	}

	function ribuan($inp) {
	    $proses = $inp; //substr($inp, 0, -3);
	    if ($proses == 1) {
	        return "seribu ";
	    } else if ($proses == 0) {
	        return '';
	    } else {
	        return $this->satuan($proses)."ribu ";
	    }
	}

	function jutaan($inp) {
	    $proses = $inp; //substr($inp, 0, -6);
	    if ($proses == 0) {
	        return '';
	    } else {
	        return $this->satuan($proses)."juta ";
	    }
	}

	function milyaran($inp) {
	    $proses = $inp; //substr($inp, 0, -9);
	    if ($proses == 0) {
	        return '';
	    } else {
	        return $this->satuan($proses)."milyar ";
	    }
	}

	function terbilang($rp) {
	    $kata = "";
	    $rp = trim($rp);

	    if (strlen($rp) >= 10) {
	        $angka = substr($rp, strlen($rp)-10, -9);
	        $kata = $kata.$this->milyaran($angka);
	    }

	    $tambahan = "";
	    if (strlen($rp) >= 9) {
	        $angka = substr($rp, strlen($rp)-9, -8);
	        $kata = $kata.$this->ratusan($angka);
	        if ($angka > 0) { $tambahan = "juta "; }
	    }

	    if (strlen($rp) >= 8) {
	        $angka = substr($rp, strlen($rp)-8, -7);
	        $angka1 = substr($rp, strlen($rp)-7, -6);
	        if (($angka == 1) && ($angka1 > 0)) {
	            $angka = substr($rp, strlen($rp)-8, -6);
	            //echo " belasan".($angka)." ";
	            $kata = $kata.$this->belasan($angka)."juta ";
	        } else {
	            $angka = substr($rp, strlen($rp)-8, -7);
	            //echo " puluhan".($angka)." ";
	            $kata = $kata.$this->puluhan($angka);
	            if ($angka > 0) { $tambahan = "juta "; }
	            
	            $angka = substr($rp, strlen($rp)-7, -6);
	            //echo " ribuan".($angka)." ";
	            $kata = $kata.$this->ribuan($angka);
	            if ($angka == 0) { $kata = $kata.$tambahan; }
	        }   
	    }
	    if (strlen($rp) == 7) {
	        $angka = substr($rp, strlen($rp)-7, -6);
	        $kata = $kata.$this->jutaan($angka);
	        if ($angka == 0) { $kata = $kata.$tambahan; }
	    }

	    $tambahan = "";
	    if (strlen($rp) >= 6) {
	        $angka = substr($rp, strlen($rp)-6, -5);
	        $kata = $kata.$this->ratusan($angka);
	        if ($angka > 0) { $tambahan = "ribu "; }
	    }

	    if (strlen($rp) >= 5) {
	        $angka = substr($rp, strlen($rp)-5, -4);
	        $angka1 = substr($rp, strlen($rp)-4, -3);
	        if (($angka == 1) && ($angka1 > 0)) {
	            $angka = substr($rp, strlen($rp)-5, -3);
	            //echo " belasan".($angka)." ";
	            $kata = $kata.$this->belasan($angka)."ribu ";
	        } else {
	            $angka = substr($rp, strlen($rp)-5, -4);
	            //echo " puluhan".($angka)." ";
	            $kata = $kata.$this->puluhan($angka);
	            if ($angka > 0) { $tambahan = "ribu "; }
	            
	            $angka = substr($rp, strlen($rp)-4, -3);
	            //echo " ribuan".($angka)." ";
	            $kata = $kata.$this->ribuan($angka);
	            if ($angka == 0) { $kata = $kata.$tambahan; }
	        }
	    }

	    if (strlen($rp) == 4)
	    {
	        $angka = substr($rp, strlen($rp)-4, -3);
	        //echo " ribuan".($angka)." ";
	        $kata = $kata.$this->ribuan($angka);
	        if ($angka == 0) { $kata = $kata.$tambahan; }
	    }

	    if (strlen($rp) >= 3)
	    {
	        $angka = substr($rp, strlen($rp)-3, -2);
	        //echo " ratusan".($angka)." ";
	        $kata = $kata.$this->ratusan($angka);
	    }

	    if (strlen($rp) >= 2)
	    {
	        $angka = substr($rp, strlen($rp)-2, -1);
	        $angka1 = substr($rp, strlen($rp)-1);
	        if (($angka == 1) && ($angka1 > 0))
	        {
	            $angka = substr($rp, strlen($rp)-2);
	            //echo " belasan".($angka)." ";
	            $kata = $kata.$this->belasan($angka);
	        }
	        else
	        {
	            //echo " puluhan".($angka)." ";
	            $kata = $kata.$this->puluhan($angka);
	            
	            $angka = substr($rp, strlen($rp)-1);
	            //echo " satuan".($angka)." ";
	            $kata = $kata.$this->satuan($angka);
	        }
	    }
	    if (strlen($rp) == 1)
	    {
	        $angka = substr($rp, strlen($rp)-1);
	        //echo " satuan".($angka)." ";
	        $kata = $kata.$this->satuan($angka);
	    }
	    return $kata . ' Rupiah';
	}


	function check_login( $username, $password ) {
		
		$this->db->where( "username", $username );
		$this->db->where( "password",  $password);
		$this->db->where( "status = 'active'");
		$get	= $this->db->get( "user_table" );
		if( $get->num_rows() > 0 )
			return $get->row();
		else
			return FALSE;
	
	}


	function set_session_login( $active_user){
		
		
		$session	= array(
			"login"			=> TRUE,
			"user_id"		=> $active_user->user_id,
			"username"		=> $active_user->username,
			"type"			=> $active_user->type	
		);
		$this->session->set_userdata( $session );
		$_SESSION['username'] = $active_user->username;
	
	}

	function remove_session_login( ){
		
		
		 $session	= array( "login"=>FALSE, "user_id"=>"", "username"=>"", "password"=>"");
	     $this->session->set_userdata( $session );
	     session_destroy();
	}
}

?>