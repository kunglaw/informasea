<?php if(!defined("BASEPATH")) exit ('no direct script access allowed');

// controller home, module general / seaman / guest

class under_const extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		/* under construction nigga */ 
		
		//$this->authentification->underconst_access();
		/* ======================== */
		
	}
	
	function index()
	{
		
		$this->load->view('under_const');
		
		
	}	
	
}

	
	
	