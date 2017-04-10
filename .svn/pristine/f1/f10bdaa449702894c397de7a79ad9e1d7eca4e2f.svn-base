<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed '); 
	
	// class home Module agent
	
	class Home extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->authentification_model->close_access();	
		}
		
		public function index()
		{
			$data['title'] = "Agent";
			$this->load->view('index',$data);
			
		}
		
		
	}
	
