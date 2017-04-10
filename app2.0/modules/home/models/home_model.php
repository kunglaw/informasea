<?php if(!defined("BASEPATH")) exit ("No direct script access allowed");

class Home_model extends CI_Model{
	
	
	function create_vacantsea()
	{
		// insert agentsea 
		$agentsea_name 	= $this->input->post("agentsea_name");
		$ext_num		  = $this->input->post("ext_num");
		$ph 	 		   = $this->input->post("phone_number");
		
		$a	 		   = explode("&",$ext_num);
		$phone_number    = $a[0]."-".$ph;
		$nationality 	 = $this->nation_model->get_detail_nationality($a[1]);
		
		$username		 = $this->input->post("username");
		$contact_person   = $this->input->post("contact_person");
		$email			= $this->input->post("email");
		$password		 = md5($this->input->post("password"));
		
		$activation 	   = md5(uniqid(rand(), true));
		
		$now = date("Y-m-d H:i:s");
		$next = strtotime("+3 months");
		$expired = date("Y-m-d H:i:s",$next);
		
		$str_a  = "INSERT INTO perusahaan set 			   		   ";
		$str_a .= "id_nationality		  = '$nationality[id]'	  	  ,";
		$str_a .= "nationality 		  = '$nationality[name]'	  ,";
		$str_a .= "nama_perusahaan	  = '$agentsea_name'  		  ,";
		$str_a .= "no_telp			  = '$phone_number'	  		  ,";
		$str_a .= "username			  = '$username'		  		  ,";
		$str_a .= "contact_person		  = '$contact_person' 		  ,"; 
		$str_a .= "email				  = '$email'		  		  ,";
		$str_a .= "password			  = '$password'		     	  ,";
		$str_a .= "create_date		  =	'$now'					  ,";
		$str_a .= "expired_date		  =	'$expired'				  ,";
		$str_a .= "activation_code	  = '$activation'			   ";
		
		$qc = $this->db->query($str_a);
		
		$aaa = mysql_insert_id();
		
		// insert vacantsea  	
		$vacantsea_title = $this->input->post("vacantsea_title");
		$department_id   = $this->input->post("department_id");
		$rank			= $this->input->post("rank");
		$ship_type	   = $this->input->post("ship_type");
		$sallary_curr	= $this->input->post("sallary_curr");
		$annual_sallary  = $this->input->post("annual_sallary");
		$range_sallary   = $this->input->post("range_sallary");
		
		// get data perusahaan 
		$id_perusahaan   = $aaa;
		
		$now = date("Y-m-d H:i:s");
		$next = strtotime("+2 weeks");
		$expired = date("Y-m-d H:i:s",$next);
		
		$str  = "INSERT INTO vacantsea set 					 ";
		$str .= "vacantsea			= '$vacantsea_title'	,";
		$str .= "id_perusahaan		= '$id_perusahaan'		,";
		$str .= "perusahaan			= '$agentsea_name'		,";
		$str .= "rank_id			= '$rank'				,";
		$str .= "department			= '$department_id'		,";
		$str .= "ship_type			= '$ship_type'			,";
		$str .= "sallary_curr		= '$sallary_curr'		,";
		$str .= "sallary_range		= '$range_sallary'		,";
		$str .= "create_date		= '$now'				,";
		$str .= "expired_date		= '$expired'			,";	
		$str .= "annual_sallary		= '$annual_sallary'		 "; 
		
		$qv = $this->db->query($str);
		
		if($qc == true && $qv == true)
		{
			return TRUE;	
		}
		else
		{
			return FALSE;	
		}
		
	}
	
	
}