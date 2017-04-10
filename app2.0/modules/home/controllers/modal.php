<?php if(!defined("BASEPATH")) exit("No Direct Script Access Allowed");

class Modal extends MX_Controller{
	
	/*function quick_vacantsea()
	{
		$is_ajax = $this->input->is_ajax_request();	
		
		if($is_ajax == TRUE)
		{
			
			$this->load->view("modal/modal-vacantsea");
			
			
		}
		else
		{
			show_404();	
		}
		
	}*/
	
	function create_vacantsea()
	{
		$is_ajax = $this->input->is_ajax_request();
		
		if($is_ajax == TRUE)
		{
			$this->load->model("department_model");
			$this->load->model("vessel_model");
			$this->load->model("nation_model");
			
			$data['department']  = $this->department_model->get_department(); 
			$data['ship_type'] = $this->vessel_model->get_ship_type();
			$data["nationality"] = $this->nation_model->get_nationality();
			
			$this->load->view("modal/modal-vacantsea2",$data);
			
		}
		else
		{
			show_404();	
		}
		
	}
	
}