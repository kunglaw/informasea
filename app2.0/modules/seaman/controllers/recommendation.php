<?php

	class recommendation extends MX_Controller{
		
		function __construct()
		{
			parent::__construct();
				
			$this->load->model("recommendation_model");
			$this->load->model("vacantsea/vacantsea_model");
			
			$this->load->model('resume_model');
			//jalankan beberapa model 
			$this->load->model('vessel_model'); // vessel model
			$this->load->model("ship_model");
			$this->load->model("rank_model");
			$this->load->model('department_model');
			$this->load->model("coc_model");
			$this->load->model("experience_model");
		}
		
		function add_recommendation()
		{
			//error_reporting(E_ALL);
			
			//$username_url 	= $this->uri->segment(1);//username yang ada di url 
			$username 		   = $this->input->post("username",TRUE);
			$id_pelaut_sender   = $this->session->userdata("id_user");
			$id_perusahaan	  = $this->session->userdata("id_perusahaan"); 
			
			$data['resume']	 = $this->resume_model->get_resume($username); // resume receiver 
			$resume 			 = $data["resume"];
			$profile			= $resume["profile"];
			
			$profile_sender = $this->resume_model->get_pelaut_ms($id_pelaut_sender); //resume_sender
			$data["resume_sender"] = $this->resume_model->get_resume($profile_sender["username"]);
			
			
			$data["department"] = $this->vacantsea_model->call_department();
			
			
			$experience		 = $this->experience_model->get_experience_pelaut($username);
			
			if(!empty($id_pelaut_sender))
			{
				$rec_byexp 	 	  = $this->recommendation_model->check_rec_bysender($id_pelaut_sender,$resume["profile"]["pelaut_id"]);
			}
			else if(!empty($id_perusahaan))
			{
				//echo $resume["profile"]["pelaut_id"];
				$rec_bycomp 		 = $this->recommendation_model->rec_comp_groupbyrank($resume["profile"]["pelaut_id"]);	
				//print_r($rec_bycomp);
			}
		
			
			if(!empty($id_perusahaan))
			{
				//selected_department 
				//echo $rec_bycomp[0]["rank_receiver"]; 
				$rankrank = $rec_bycomp[0]["rank_receiver"];
				if(empty($rankrank))
				{
					$rankrank = $profile["rank"];
				}
				
				$selected_department = $this->rank_model->get_rank_detail_byid($rankrank);
				//print_r($selected_department);
				
				$rec_bycomp2 = array();
				if(!empty($rec_bycomp))
				{
				  foreach($rec_bycomp as $rowa)
				  {
					  $rec_bycomp2[] = $rowa["rank_receiver"];	
				  }
				}
				
				//rank
				$rank = $this->rank_model->get_rank_bydept($selected_department["id_department"]); 
				if(!empty($rec_bycomp2))
				{
				  foreach($rank as $row)
				  {
					  if(!in_array($row["rank_id"],$rec_bycomp2))
					  {
						  $rank2[] = $row;
					  }
				  }
				}
				else
				{
					$rank2 = $rank;	
				}
				
				$data["list_rank"] = $rank2;
				
				$this->load->view("seaman/recommendation/add_recommendation_modal_comp",$data);
				//$this->load->view("seaman/recommendation/test_modal");
			}
			else if(!empty($id_pelaut_sender))
			{
				if(!empty($rec_byexp))
				{
				  foreach($rec_byexp as $rowa)
				  {
					  $exp1[] = $rowa["experience_id"];
					  
				  }
				}
				
				// untuk sesama pelaut
				if(!empty($exp1))
				{
				  foreach($experience as $rowb)
				  {
					  if(!in_array($rowb["experience_id"],$exp1))
					  {
						  $data["experience"][] = $this->experience_model->get_experience_detail($rowb["experience_id"]);	
					  }
				  }
				}
				else
				{
					$data["experience"] = $experience;
				}
				
				$this->load->view("seaman/recommendation/add_recommendation_modal",$data);	
			}
		}
		
		function update_recommendation()
		{
			$id_recommendation  = $this->input->post("id_recommendation",TRUE); 
			$username 		   = $this->input->post("username",TRUE);
			$id_perusahaan	  = $this->session->userdata("id_perusahaan");
			$id_pelaut_sender   = $this->session->userdata("id_user");
			
			$data["recommendation"] = $this->recommendation_model->detail_recommendation($id_recommendation);
			$data['resume']	 = $this->resume_model->get_resume($username);
			$data["department"] =  $this->vacantsea_model->call_department();	
			
			$profile_sender = $this->resume_model->get_pelaut_ms($id_pelaut_sender); //resume_sender
			$data["resume_sender"] = $this->resume_model->get_resume($profile_sender["username"]);
			$resume 			 = $data["resume"];
			$profile			= $resume["profile"];
			
			if(!empty($id_pelaut_sender))
			{
				
				$this->load->view("seaman/recommendation/update_recommendation_modal",$data);
			}
			else if(!empty($id_perusahaan))
			{				
				$this->load->view("seaman/recommendation/update_recommendation_modal_comp",$data);
			}
			
		}
		
		function add_recommendation_process()
		{
			
			$this->load->library("form_validation");
			
			$username_sess = $this->session->userdata("username"); //sender
			$id_pelaut_sender = $this->session->userdata("id_user"); // sender
			$id_perusahaan	= $this->session->userdata("id_perusahaan");
			
			$id_recommendation= $this->input->post("id_recommendation",TRUE);
			$id_pelaut 		= $this->input->post("id_pelaut",TRUE);
			$rank 	  		 = $this->input->post("rank",TRUE); // rank sender 
			$experience_id	= $this->input->post("sea_record",TRUE); // sea record row pelaut 
			$position		 = $this->input->post("position",TRUE);
			
			if(empty($experience_id))
			{
				$experience_id = $this->input->post("sea_record2",TRUE);
			}
			$recommendation    = $this->input->post("recommendation",TRUE); 
			
			$detail_pelaut 	= $this->resume_model->get_resume($id_pelaut);
			$fullname 		 = $detail_pelaut["nama_depan"]." ".$detail_pelaut["nama_belakang"];
			
			if(!empty($id_perusahaan))
			{
				//$check_recommendation = $this->recommendation_model->check_recommendation_comp($id_perusahaan,$id_pelaut,$experience_id);
				$check_recommendation = $this->recommendation_model->detail_recommendation($id_recommendation);
			}
		
			
			$this->form_validation->set_rules("id_pelaut","ID pelaut","required|trim");
			//kalau perusahaan atau pelaut yang sender
			if(!empty($id_pelaut_sender))
			{
				
				$this->form_validation->set_rules("rank","Rank","required|trim");
				//$this->form_validation->set_rules("sea_record","Experience","required|trim");	
				//$check_recommendation = $this->recommendation_model->check_recommendation($id_pelaut_sender,$id_pelaut,$experience_id);
				$check_recommendation = $this->recommendation_model->detail_recommendation($id_recommendation);
			}
			
			$this->form_validation->set_rules("recommendation","Recommendation","required|trim");
			
			if($this->form_validation->run() == TRUE)
			{
				$arr["id_pelaut"] 		= $id_pelaut;
				$arr["rank"]	  		 = $rank;
				$arr["experience_id"]	= $experience_id;
				$arr["recommendation"]   = $recommendation;
				$arr["id_recommendation"] = $check_recommendation["id_recommendation"];
				$arr["position"]		 = $position;
				
				if(!empty($check_recommendation))
				{
					$this->recommendation_model->update_recommendation($arr);
					//exit;
					
				}
				else
				{
					$this->recommendation_model->add_recommendation($arr); 	
					
				}
				
				
				$reload = "<script>setInterval(function(){ location.reload() }, 3000);</script>";
				$result["status"] = "success";
				$result["message"] = "<div class='alert alert-success'> Thanks, for giving $fullname a recommendation </div> $reload";
			}
			else
			{
				$result["status"] = "error";
				$result["message"] = "<div class='alert alert-danger'>".validation_errors()." </div>";
			}
			
			
			echo json_encode($result);

		}
		
		function load_check_recommendation()
		{
			$id_pelaut_sender = $this->session->userdata("id_user"); // sender
			$id_pelaut 		= $this->input->post("id_pelaut",TRUE);
			$experience_id	= $this->input->post("experience_id",TRUE); 
			
			$check_recommendation = $this->recommendation_model->check_recommendation($id_pelaut_sender,$id_pelaut,$experience_id);
			
			echo json_encode($check_recommendation);
			
			
		}
		
		
		
		
	}