<?php if(!defined('BASEPATH')) exit ("No Direct Script Access Allowed ");

class under_const_model extends CI_Model{
	
	function close_access()
	{
		//echo $this->session->userdata("user"); exit;
		
		if($this->session->userdata("user") == "pelaut")
		{
			if($this->uri->segment(1) == "")
			{
				header("location:".base_url("home"));
				//echo $this->uri->segment(1);
				//echo "<p> segment tak aktif alias kosong  </p>";	
			}
			
			else
			{
				//echo $url = current_url();	
				//header("location:".base_url($uri));
				//echo "<p> segment active </p>";
			}
		}
		else if($this->uri->segment(1) != "" && $this->session->userdata("user") == "")
		{
			header("location:".base_url());
		}
		
	}
	
	
}

