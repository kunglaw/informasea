<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class About extends MX_Controller {

		function index()
		{
			$data['head']	 = "head";
			$data['title']	= "About";	
			$data['css']	  = "css"; //css tambahan, di head
			$data['meta']	 = "meta"; // meta tambahan, di head
			$data['js_top']   = "js_top"; // js tambahan, di head
			
			//include
			//$data['navbar']   = "";
			$data['template'] = "about";
			$data['footer']   = "footer";
			$data['js_under'] = "js_under"; 
			
			$this->load->view('index',$data);	
		}
		
		function privacy()
		{

				$data['head'] = "head";
				$data['title'] = "Privacy Policy";
				$data['css'] = "css";
				$data['meta'] = "meta";
				$data['js_top'] = "js_top";


				$data['template'] = "privasi";
				$data['footer'] = "footer";
				$data['js_under'] = "js_under";

				$this->load->view('index',$data);


		}
		
	}