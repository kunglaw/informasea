<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed ');

class company_process extends MX_Controller{		

	function __construct()
	{

		parent::__construct();
	}
	
	function edit_map_process()
	{
		$this->load->library("form_validation");
		
		$latitude 	  = $this->input->post("latitude",true);
		$longitude 	 = $this->input->post("longitude",true);
		$id_perusahaan = $this->input->post("id_perusahaan",true);  
		
		$this->form_validation->set_rules("latitude","Latitude","required|decimal");
		$this->form_validation->set_rules("longitude","Longitude","required|decimal");
		
		if($this->form_validation->run() == TRUE)
		{
			$str = "UPDATE perusahaan_setting SET latitude = '$latitude', longitude = '$longitude' WHERE id_perusahaan = '$id_perusahaan' ";
			$q   = $this->db->query($str);
			  
		
			$result["status"] = "success";
			$result["msg"]	= "Map location has been update";			
		}
		else
		{
			$result["status"] = "error";
			$result["msg"]	= "";
			
		}
		
		echo json_encode($result);
		
	}
	
	function show_edit_map()
	{
		$this->load->view("include/edit_map");	
		
	}
	
	
	




}

