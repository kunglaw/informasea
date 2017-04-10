<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Profile_resume_model extends CI_Model{
	
	function last_profile_resume($id_pelaut = '')
	{
		$id_pelaut = $this->session->userdata('id_user');
		
		$str = "select * from profile_resume_tr where pelaut_id = '$id_pelaut' ORDER BY last_update DESC LIMIT 1 ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
	}
	
	function get_profile_pelaut($id_pelaut)
	{
		$str  = "SELECT * FROM pelaut_ms a, profile_resume_tr b WHERE 				    ";
		$str .= "( a.pelaut_id = b.pelaut_id			   							   )";	
		$str .= "AND a.pelaut_id = '$id_pelaut' OR username = '$id_pelaut'			    ";
		
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
	}
	
	function get_profile_resume($id_pelaut = '')
	{
		$str = "select * from profile_resume_tr where pelaut_id = '$id_pelaut' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;

	}
	
	function last_experience($id_pelaut)
	{
		if(!empty($id_pelaut))
		{
		  $str = "SELECT * FROM experiences WHERE pelaut_id = '$id_pelaut' ORDER BY periode_to DESC LIMIT 1";
		  $q   = $this->db->query($str);
		  $f   = $q->row_array(); 
		  
		 
		  
		  $str2 = "SELECT ship_name,rank_id,company,periode_from,periode_to,pelaut_id FROM experiences WHERE pelaut_id = '$id_pelaut' AND 
		  rank_id = '$f[rank_id]' ORDER BY periode_to DESC";
		  $q2  = $this->db->query($str2);
		  $f2   = $q2->result_array();
		  $jml_hari = 0;
		  foreach ($f2 as $data) {
		  	// echo "$data[periode_from] -> $data[periode_to] <br>";
		  	$date1 = new DateTime($data['periode_from']);
			$date2 = new DateTime($data['periode_to']);
			
			$interval = $date1->diff($date2);
			$jml_hari += $interval->format("%a");
			// echo "$data[periode_from] -> $data[periode_to] = ".$interval->format("%a")."<br>";
		  }
		  $tahun = floor($jml_hari/365);
		  $bulan = $jml_hari/30;
		  if($tahun > 0) $bulan = ($jml_hari-365)/30;
		  $bulan = floor($bulan);
		  // echo "$tahun y $bulan m";
		  // print_r($f2);
		  // get last data
		  $last_array = end($f2);
		  //print_r($last_array);
		  
		  $first_array = reset($f2);
		  
		  return array("data"=>$f2,"first_date"=>$first_array["periode_from"],"last_date"=>$last_array["periode_to"]);
		}
		else
		{
		  return ""; 	
		}
		
	}

	function cek_lengkap_resume($id_pelaut = ''){
		
		/* $str = "SELECT * FROM profile_resume_tr WHERE pelaut_id = '$id_pelaut' AND 
		(height != '' and weight != '' AND clothes_size != '' and last_education != '' 
		and shoes_size != '' and expected_sallary != 0 and exp_sallary_curr != '' and vessel_type != 0 
		and department != 0 and sallary_range != '')";
		//echo $str;
		$q = $this->db->query($str);
		$f = $q->row_array();
		return $f; */
		$str_prtr = "SELECT * FROM profile_resume_tr WHERE 
			pelaut_id = '$id_pelaut' AND 
			(
			clothes_size != '' and 
			last_education != '' 
			and shoes_size != '' 
			
			and vessel_type != 0 
			and department != 0 )"; 
			
			/* and 
			height != '' and weight != '' AND 
			and expected_sallary != 0 
			and exp_sallary_curr != '' 
			sallary_range != ''
			
			)";*/
			//echo $str;
			$q_prtr = $this->db->query($str_prtr);
			$f_prtr = $q_prtr->row_array();
			
			// document -> type document 											bawaan <> 1
			$str_document = "SELECT * FROM document_tr WHERE type_document = 'document' AND pelaut_id = '$id_pelaut' ";
			$q_document   = $this->db->query($str_document);
			$f_document   = $q_document->result_array();
			
			/* $str_visa	 = "SELECT * FROM document_tr WHERE type_document = 'visa' AND pelaut_id = '$id_pelaut'";
			$q_visa 	   = $this->db->query($str_visa);
			$f_visa 	   = $q_visa->result_array(); */
			
			/* $str_medical  = "SELECT * FROM document_tr WHERE type_document = 'medical_cert' AND pelaut_id = '$id_pelaut'";
			$q_medical	= $this->db->query($str_medical);
			$f_medical	= $q_medical->result_array(); */   
			
			$str_competency = "SELECT * FROM competency_tr WHERE pelaut_id = '$id_pelaut' ";
			$q_competency   = $this->db->query($str_competency);
			$f_competency   = $q_competency->result_array();
			
			$str_proficiency = "SELECT * FROM proficiency_tr WHERE pelaut_id = '$id_pelaut'";
			$q_proficiency   = $this->db->query($str_proficiency);
			$f_proficiency   = $q_proficiency->result_array();
			
			$str_experience  = "SELECT * FROM experiences WHERE  pelaut_id = '$id_pelaut' ";
			$q_experience	= $this->db->query($str_experience);
			$f_experience	= $q_experience->result_array();
			
			if( empty($f_prtr) || 
				empty($f_document) || 
				/* empty($f_visa) || */
				/* empty($f_medical) || */
				empty($f_competency) || 
				empty($f_proficiency) ||
				empty($f_experience))
			{
				$result = FALSE; // salah, resume gak lengkap	
			}
			else
			{
				$result = TRUE;	
			}
			
			
			return array("result"=>$result,"profile_resume_tr"=>$f_prtr,"document"=>$f_document,/*"visa"=>$f_visa,*//* "medical"=>$f_medical,*/
			"competency"=>$f_competency,"proficiency"=>$f_proficiency,"experience"=>$f_experience);  
	}

	function expired_certificate($id_pelaut = ''){

		$str1 = "select * from document_tr WHERE pelaut_id = '$id_pelaut'";
		$q = $this->db->query($str1);
		$f = $q->result_array();

		$now = date('Y-m-d');
		$expired = 0;
		foreach($f as $r){
			if($r['date_expired'] <= $now){
				$expired = $expired + 1;
			}
		}

		$str2 = "SELECT * FROM competency_tr WHERE pelaut_id = '$id_pelaut'";
		$q = $this->db->query($str2);
		$ff = $q->result_array();

			foreach($ff as $x){
				if($x['expired_date'] <= $now){
					$expired = $expired + 1;
				}
			}

			$str3 = "SELECT * FROM proficiency_tr WHERE pelaut_id = '$id_pelaut'";
			$qq = $this->db->query($str3);
			$fff = $qq->result_array();

			foreach($fff as $zz){
				if($zz['expired_date'] <= $now){
					$expired = $expired + 1;
				}

			}

			return $expired;

			


	}

	
	
	
}