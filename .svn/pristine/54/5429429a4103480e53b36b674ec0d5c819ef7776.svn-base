<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Location: ./application/modules/agent/controllers/agent.php */
class agent extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->authentification->logged_out();
		$this->load->model('agent_model');
	}
		
	
	public function index()
	{
		$data['title']		= 'Agent';
		
		$tab = $this->uri->segment(1); //echo $tab;exit;
		if ($tab == 'agent'){
			$data['agent'] = 'active';
			$data['dashboard'] = '';
			$data['tab_vessel'] = '';
			$data['crew'] = '';
			$data['tab_vacantsea'] = '';
			$data['schedule'] = '';
			$data['calendar'] = '';
			$data['mailbox'] = '';
		}
		
		$data['template'] = 'template';
		
		$data['call_agent']	= $this->agent_model->get_agent();
		
		$this->load->view('index',$data);
	}
	
	
	
	function check_username() {
		 
	  $usr = $this->input->post('username');
	  $resultusername = $this->agent_model->check_username_exist($usr);
	  if($resultusername)
	   {
	   echo "false";
	   }
	   else
	   {
	   echo "true"; return TRUE;
	   }
	 }//function check_username
	 
	 
	 
	 
	 function check_email() {
		 
	  $em = $this->input->post('email');
	  $result = $this->agent_model->check_email_exist($em);
	  if($result)
	   {
	   echo "false";
	   }
	   else
	   {
	   echo "true"; return TRUE;
	   }
	 } 
	
	
	function add_agent() {
		
		if($this->check_email() == true && $this->check_username() == true) {
			
			$this->agent_model->add_agent();	
			
		}
	}
	
	function modal() 
	{
		//echo "ini function";exit;// alert (data) di aktifkan kalo mau coba ini
		$x = $this->input->post("x");
		if($x == 1)
		{
			
			$modal_type = $this->input->post("modal");//echo $modal_type;exit;
			
			if($modal_type == "data_agent_modal")	//edit tab1
			{
				$data["agent_edit"]	= $this->agent_model->get_agent_tr();
				$this->load->view("data_agent_modal",$data);
				
			} else if($modal_type == "assign_vessel_modal") // edit tab2
			{
				$data["assign_edit"]	= $this->agent_model->get_agent_tr();
				$this->load->view("assign_vessel_modal",$data);
				
			} else  // delete
			{
				//echo "ini function";exit;
				$this->load->view("delete_modal");
			}
			
		} //end if
	}
	
	function update_process()
	{
		return $this->agent_model->edit_agent_process();
	}
	
	
	
	////////////////  TAB 2 ASSIGN VESSEL   //////////////////////
	function call_vessel() {
		$this->agent_model->get_vessel();
	}
	
	function call_assign()
	{
		$this->agent_model->assign_agent();
	}
}

