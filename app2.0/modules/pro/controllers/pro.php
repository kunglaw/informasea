<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pro extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$type_user 	= $this->session->userdata('type_user');
		if ($type_user != "company") {
			redirect("pro/message");
		}
		$this->load->model('pro_model');
	}
		
	
	public function index()
	{
		$data['title']		= 'Upgrade Account';
		$data['nationality'] =$this->pro_model->nationality("order by name asc");
		
		$this->load->view('pro',$data);
		
	}

	function proses_upgrade()
	{
		
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("full_name","Full Name","required");
		$this->form_validation->set_rules("no_telp","Telephone","required|numeric");
		$this->form_validation->set_rules("form_bank","Company Bank","required");
		$this->form_validation->set_rules("postal_code",'Postal Code',"numeric");
		$this->form_validation->set_rules("company_name","Company Name","required");
		$this->form_validation->set_rules("email","Email","required|valid_email");
		$this->form_validation->set_rules("account_pilihan","Choosen Account","required");
		
		$full_name 		  = $this->input->post('full_name');
		$no_telp 	  		= $this->input->post('no_telp');
		$your_bank 		  = $this->input->post('from_bank');
		$postal_code  		= $this->input->post('postal_code');
		$name_company 	   = $this->input->post('company_name');
		$email 			  = $this->input->post('email');
		$purpose_bank 	   = $this->input->post('purpose_bank');
		$location 	 		= $this->input->post('location');
		$account_pilihan 	 = $this->input->post('location');
		
		// check_email_perusahaan
		
		if($this->form_validation->run() == TRUE)
		{
		  $data = array(
		  
			  'full_name' 	=> $full_name,
			  'no_telp' 	  => $no_telp,
			  'from_bank' 	=> $your_bank,
			  'postal_code'  => $postal_code,
			  'company_name' => $name_company,
			  'email' 		=> $email,
			  'purpose_bank' 	=> $purpose_bank,
			  'account_pilihan' => $account_pilihan,
			  "location"		=> $location
			  
		  );
  
		  $a = $this->db->insert("request_upgrade",$data);
		  
		  if($a){
			
			$result["message"] =  "<div class='alert alert-success'> Permintaan anda telah kami terima silahkan menunggu </div> ";
			$result["status"]  = "success";
			
		  }else{
			 
			$result["message"] = "<div class='alert alert-danger'> Your data cannot be Inserted </div>";
			$result["status"] = "error";
		  }
		}
		else
		{
			
			$result["message"] = "<div class='alert alert-danger'>".validation_errors()."</div>";
			$result["status"] = "error";
		}
		
		echo json_encode($result);

	}
}
	