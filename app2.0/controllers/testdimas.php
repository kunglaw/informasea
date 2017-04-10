<?php

	class testdimas extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();
			
			
		}
		
		function index()
		{
			
		}
		
		function lang()
		{
			$lang_session = $this->session->userdata("lang");
			if(empty($lang_session)) $lang_session = "english"; // nama folder
			$this->lang->load('test', $lang_session);
			
			$data["hello"] = $this->lang->line("hello"); // cara pemakaian
			$data["footer"] = "footer2";
			$data["title"] 	= "Language";
			$data["template"] = "dummy/dummy-text-new";
			$this->load->view("index",$data);
		}
		
		function view_lang()
		{
			print_r($this->lang);	
			
		}
		
		function lang_process()
		{
			
			$lang = $this->input->post("lang");
			//$this->session->unset();
			
			
			$this->session->set_userdata("lang",$lang); 
			
			header("location:".base_url("testdimas/lang"));
			
		}
		
		function faq()
		{
			$data["title"] 	= "Frequently asked question";
			$data["content"]  = "faq/content";
			$data["template"] = "faq/template";
			$this->load->view("index",$data);
		}
		
		function like_page()
		{
			//error_reporting(E_ALL);
			
			$data["title"] 	= "Like Page";
			$data["template"] = "dummy/like_page";

			$this->load->view("index",$data);
			
		}
		
		
	}
	