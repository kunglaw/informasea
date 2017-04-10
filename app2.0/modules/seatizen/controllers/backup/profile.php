<?php
	/**
	*  
	*/
	class profile extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			# code...
			// $this->authentification_model->close_access();
			// echo $this->session->userdata("id_perusahaan");
			if($this->session->userdata("id_user") == NULL)
			{
				header("location: custom404");
			}
			$this->load->model("authentification_model");
			$this->load->model('vessel_model'); // vessel model
			$this->load->model("rank_model");
			$this->load->model('department_model');
			$this->load->model("coc_model");
		}

		public function index()
		{
			
		}

		public function detail()
		{
			
			$this->load->model('seatizen/seatizen_model');
			$this->load->model('seaman/resume_model');

			$username = $this->uri->segment(2);
//            echo $username;
			$data['username'] = $username;

			$data['pelaut'] = $this->seatizen_model->check_seatizen($username);
//            print_r($data['pelaut']);
			// print_r($data['pelaut']['pelaut_id']);
			$data['resume'] = $this->resume_model->get_resume($data['pelaut']['pelaut_id']);
//			 print_r($data['resume']['document']);
			$data['title'] = "Resume";
			$data['template'] = 'seaman/resume/template_free_access';
			$data['left_content'] = "company/left_content";
			// $data['resume'] = $this->resume_model->get_resume();
			// print_r($data['resume']);
//            echo "test";
			$this->load->view('index',$data);
		}
	}
?>