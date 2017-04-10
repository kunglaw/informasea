<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed');

class dashboard extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		//authentification
		$this->authentification->close_access();	
	}
	
	function index()
	{		
		//sementara
		header("location:".base_url("seaman/resume")); exit;
	
		$data['head']	 = "head";
		$data['title']	= "Dashboard";	
		$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = ""; // meta tambahan, di head
		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['template'] = "template";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view('index',$data);	
		
	}
	
	function __destruct()
	{
		
		
	}
	
	
	
}