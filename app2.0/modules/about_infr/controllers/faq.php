<?php
	
	class faq extends CI_Controller{
		
		function __contruct()
		{
			parent::__construct();	
			
		}
		
		function index()
		{
			$data["title"] 	= "Frequently asked question";
			$data["content"]  = "faq/content";
			$data["template"] = "faq/template";
			$this->load->view("index",$data);
		}
	
	}