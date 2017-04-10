<?php

	// INI HANYA UNTUK PERCOBAAN SAJA 

	class cv extends CI_Controller{

		

		function __construct()
		{

			parent::__construct();

			

			//BAHASA

			$lang_session = $this->session->userdata("lang");

			if(empty($lang_session)) $lang_session = "english"; // nama folder

			$this->lang->load('general', $lang_session);

			$this->lang->load("seatizen",$lang_session);

			$this->lang->load("vacantsea",$lang_session);

			// =================================

			

			$this->load->model("seaman/sea_record_model");

			$this->load->model("seaman/resume_model");

			$this->load->model("department_model");

			$this->load->model("rank_model");

			$this->load->model("vessel_model"); 

			

			$this->load->model("competency_model");

			$this->load->model("document_model");

			$this->load->model("coc_model");

			$this->load->model("competency_model");

			$this->load->model("proficiency_model");

			$this->load->model("experience_model");

			$this->load->helper("check_file"); 

			

		}

		

		function type1()
		{
			//error_reporting(E_ALL);
			$username = $this->session->userdata("username");
			$data["resume"] = $this->resume_model->get_resume($username);
			$data["rank"]   = $this->rank_model->get_rank_detail(); 
			$this->load->view("dummy/cv/index",$data);

		}
		
		function test_days()
		{
			
			echo days_to_format(2000,"f");	
		}
		
		function test_chart()
		{
			
			
			//$this->load->view("");	
		}

		

		

		

		

	}