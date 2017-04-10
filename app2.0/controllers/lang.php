<?php

class Lang extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();	
			
		}
		
		function change()
		{
			
			$lang_sess = $this->session->userdata("lang");
			
			if(empty($lang_sess) || $lang_sess == "english")
			{
				$this->session->set_userdata("lang","indonesian");	
			}
			else
			{
				$this->session->set_userdata("lang","english");	
				
			}
			
			//header("location:javascript://history.go(-1)");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}
		
	}