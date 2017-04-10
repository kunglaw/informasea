<?php 

class general extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();	
		
	}
	
	function modal()
	{
		//$dt_modal['include'];
		//$dt_modal['data'];
		
		/*
			$dt_modal[data] = array('title','desc');
		
		*/

		
		$include = $this->input->post("include",true);
		$title   = $this->input->post("title",true);
		$desc	= $this->input->post("desc",true);
		
		//echo "include : ".$include;
		
		$data = array("title"=>$title,"desc"=>$desc);
		
		$this->load->view($include,$data);	
		
	}
	
	function generate_captcha()
	{
		session_start();
		$this->load->library("captcha");
		return $this->captcha->CreateImage();
	}

	
	
}