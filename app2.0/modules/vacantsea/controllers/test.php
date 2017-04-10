<?php

	class Test extends MX_Controller{
		
		function __construct()
		{
			
			parent::__construct();
				
			$this->load->model("vacantsea/vacantsea_model");
			$this->load->model("seatizen/seatizen_model");
			$this->load->model("company/company_model");
		}
		
		function index()
		{
			$dt["applicant"]["nama_depan"] = "Aries Dimas";
			$dt["applicant"]["nama_belakang"] = "Yudhistira";
			$dt["vacantsea"] = $this->vacantsea_model->get_last_vacantsea();
			
			$data["content_template"] = $this->load->view("email_template/incomplete-resume",$dt,true);
			//$data["content_template"] = $this->load->view("email_template/complete-resume",$dt,true);
			$this->load->view("template_email2016/new_email_template",$data);	
		}
		
		function complete()
		{
			$dt["applicant"]["nama_depan"] = "Aries Dimas";
			$dt["applicant"]["nama_belakang"] = "Yudhistira";
			$dt["vacantsea"] = $this->vacantsea_model->get_last_vacantsea();
			
			// $data["content_template"] = $this->load->view("email_template/incomplete-resume",$dt,true);
			$data["content_template"] = $this->load->view("email_template/complete-resume",$dt,true);
			$this->load->view("template_email2016/new_email_template",$data);		
			
		}
		
		function applicant()
		{	
			//error_reporting(E_ALL);
			
			$this->load->model("experience_model");
			
			$straa = "SELECT * FROM applicant_tr WHERE username = 'Yudiwachyudi' ORDER BY id_aplicant DESC";
			$qaa = $this->db->query($straa);
			$faa = $qaa->row_array();
			
			$seaman  = $this->seatizen_model->detail_seatizen($faa["username"]);
			
			
			$vacantsea = $this->vacantsea_model->get_vacantsea_id($faa["id_vacantsea"]);
			$company = $this->company_model->get_detail_company($vacantsea["id_perusahaan"]);
			
			
			$dt["applicant"]	  = $faa;
			$dt["contact_person"] = $company["contact_person"];
			$dt["applicant_name"] = $seaman["nama_depan"]." ".$seaman["nama_belakang"];
			$dt["vacantsea"] = $vacantsea;
			$dt["experience"] 	 = count_experience($seaman["pelaut_id"]);
			
			$dt["str_btn"] = "https://agent.informasea.com/beranda/
			$company[id_perusahaan]&$company[username]&applicant&company&$company[password]";
			
			// $data["content_template"] = $this->load->view("email_template/incomplete-resume",$dt,true);
			$data["user_type"] = "agentsea";
			$data["content_template"] = $this->load->view("email_template/new_applicant",$dt,true);
			$this->load->view("template_email2016/new_email_template",$data);
		}
		
		
	}