<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed '); 
	
	// class controller Profile , Module seaman, 
	
	class Profile extends MX_Controller
	{
		
		function __construct()
		{
			//echo "hai"; exit;
			parent::__construct();
			//error_reporting(E_ALL);
			$this->authentification->underconst_access();
			//BAHASA
			$lang_session = $this->session->userdata("lang");
			if(empty($lang_session)) $lang_session = "english"; // nama folder
			$this->lang->load('general', $lang_session);
			$this->lang->load("seatizen",$lang_session);
			$this->lang->load("vacantsea",$lang_session);
			// =================================
			
			$this->load->model('seatizen/seatizen_model');
			$this->load->model('timeline_model');
			$this->load->model('users/user_model');
			$this->load->model('friendship_model');
			$this->load->model('photo/photo_mdl');
			$this->load->model('vacantsea/vacantsea_model');
			$this->load->model('nation_model');
			$this->load->model('resume_model');
			$this->load->library("check_data");
		}

		public function index()
		{
			
			$this->load->model("department_model");
			$this->load->model("rank_model");
			$this->load->model("experience_model");
			
			//header('location:'.base_url("seaman/resume"));
			$username = $this->uri->segment(2);//username yang ada di url 
			// check username
			$check_username = $this->check_data->check_username_seaman($username);
			
			if(empty($check_username))
			{			
				show_404();
				exit;
				
			}
			
			$data = $this->template("profile");
			
			//tracker kunglaw 2016
			if($username != "" && $username != $this->session->userdata("username")){
				
				$dtSeatizenSession = $this->seatizen_model->detail_seatizen($this->session->userdata("username"));
				$dtSeatizenUrl = $this->seatizen_model->detail_seatizen($username);

				$data['is_friend'] = $this->friendship_model->cekProfileFriends($dtSeatizenUrl['pelaut_id'], $dtSeatizenSession['pelaut_id']);
			}
			else $data['is_friend'] = true;

			$dt = array("username"=>$username,"action"=>"view","category"=>"seatizen","page"=>"timeline");
			run_tracker($dt);
			
			$this->load->view('index',$data);
			
		}
		
		private function template($page)
		{
			$arr = fill_ads_data();
			
			$username_url = $this->uri->segment(2);//username yang ada di url 
			$username = $username_url;
			$username_login = $this->session->userdata("username");
			
			$this->load->model("department_model");
			$this->load->model("rank_model");
			$this->load->model("experience_model");
			
			// meta 
			  $check_username = $this->check_data->check_username_seaman($username_url);
			  $resume = $this->resume_model->get_resume($username);
		  
			  $pelaut = $resume["pelaut"];
			  $profile = $resume["profile"];
			  
			  $rank = $this->rank_model->get_rank_detail_byid($profile["rank"]);
			  $department = $this->department_model->get_detail_department($profile["department"]);
			  $name = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];
			  $years = $this->experience_model->total_exp_rank($check_username["pelaut_id"]);
			  
			  $md = "desc:";
			  $meta_description = $md;
			  
			  $school = "";
			  if(!empty($profile["last_education"])) $school = $profile["last_education"].",";
			  
			  $rankd = "";
			  if(!empty($rank["rank"])) $rankd = "$rank[rank] for $years";
			  
			  $desc = "Hello seafarer, i am $name from $school $pelaut[kebangsaan]. i am $rankd. 
			  Join with me on informasea.com ";
			  
			  $md .= "name:$name,";
			  $md .= "department:$department[department],";
			  $md .= "rank:$rank[rank],";
			  $md .= "nationality:$pelaut[kebangsaan],";
			  
			  $meta_description = $md;
			  
		  //end meta
		  
			  $arr['username'] = !empty($username) ? $username : $this->session->userdata("username");
	
			  // meta
			  $arr["desc"]	 	= $desc;
			  $arr["md"]	   	  = $md;
			  $arr["meta_description"] = $meta_description;
			  $arr["rank"] 		= $rank["rank"];
			  $arr["department"]  = $department["department"];
			  $arr["name"] 		= $name;
			  $arr["pelaut"] 	  = $pelaut;
			  $arr["profile"] 	 = $profile;

			// echo $page;
			// exit;
			if($page == "index" || $page == "profile")
			{
				$arr['ctrl']     = "profile";
				$arr['title'] 	= "Profile";
				$arr['meta']	 = "profile/meta";
				$arr['css'] 	  = "profile/css";
				$arr['js_top']   = "profile/js_top"; 
				
				$arr['header']   = "seatizen/header";
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] = "seaman/profile/template";
				//$data['footer'] = "";
				$data['js_under'] = "profile/js_under";
			}
			else if($page == "seatizen")
			{
				$arr['ctrl']			= "seatizen";
				$arr['title'] 		   = "Seatizen";
				$arr['meta'] 	 		= "seatizen/meta";
				$arr['css'] 	  		 = "seatizen/css";
				$arr['js_top']   		  = "seatizen/js_top";
				
				$arr['header']   		  = "seatizen/header";
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] 		= 'seatizen/template';
				$arr['js_under'] 		= "seatizen/js_under";
			}
			else if($page == "resume")
			{
				$arr['ctrl']			= "resume";
				$arr['title'] 		   = "Resume";
				$arr['meta'] 	 		= "seatizen/meta-resume";
				$arr['css'] 	  		 = "seatizen/css";
				$arr['js_top']   		  = "seatizen/js_top";
				
				$arr['header']   		  = "seatizen/header";
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] 		= 'seatizen/template';
				$arr['js_under'] 		= "seatizen/js_under";	
			}
			else if($page == "recommendation")
			{
				$arr['ctrl']			= "recommendation";
				$arr['title'] 		   = "Recommendation";
				$arr['meta'] 	 		= "seatizen/meta-resume";
				$arr['css'] 	  		 = "recommendation/css";
				$arr['js_top']   		  = "recommendation/js_top";
				
				$arr['header']   		  = "recommendation/header";
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] 		= 'recommendation/template';
				$arr['js_under'] 		= "recommendation/js_under";	
			
			}
			else if($page == "resume_print")
			{
				$arr['ctrl']			= "resume_print";
				$arr['title'] 		   = "Print fancy resume";
				$arr['meta'] 	 		= "seatizen/meta-resume";
				$arr['css'] 	  		 = "resume_print/css";
				$arr['js_top']   		  = "resume_print/js_top";
				
				$arr['header']   		  = "resume_print/header";
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] 		= 'resume_print/template';
				$arr['js_under'] 		= "resume_print/js_under";	
				
			}
			else if($page == "appraisal")
			{
				$arr['ctrl']			= "appraisal";
				$arr['title'] 		   = "Appraisal";
				$arr['meta'] 	 		= "seatizen/meta-resume";
				$arr['css'] 	  		 = "seatizen/css";
				$arr['js_top']   		  = "seatizen/js_top";
				
				$arr['header']   		  = "seatizen/header";
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] 		= 'appraisal/template';
				$arr['js_under'] 		= "seatizen/js_under";	
			}
			else if($page == "friends")
			{
				$arr['ctrl']			= "friends";
				$arr['title'] 		   = "Friends";
				$arr['meta'] 	 		= "friends/meta";
				$arr['css'] 	  		 = "friends/css";
				$arr['js_top']   		  = "friends/js_top";
				
				//$arr['header']   		  = "seatizen/header";

				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
					$arr['header']  			= "header";

				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
					$arr['header'] = "seatizen/header";
				}
				$arr['template'] 		= 'friends/template';
				$arr['js_under'] 		= "friends/js_under";
			}
			else if($page == "account")
			{
				$arr['ctrl']			= "account";
				
				$arr['title'] 		   = "account";
				$arr['meta'] 	 		= "account/meta";
				$arr['css'] 	  		 = "account/css";
				$arr['js_top']   		  = "account/js_top";
				
	//				$arr['header']   		  = "seatizen/header";
				//$arr['header'] = "header";

				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
					$arr['header'] = "header";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
					$arr['header'] =  "seatizen/header";
				}
				$arr['template'] 		= 'account/template';
				$arr['js_under'] 		= "account/js_under";
				
			}  
			else if($page == "applied"){

				/*echo "<script>alert('berada disini')</script>";*/

				$arr['ctrl'] 	 = "appliedvacantsea";
				$arr['title'] 	= "Applied Vacantsea";
				$arr['meta']	 = "applied/meta";
				$arr['css']	  = "applied/css";
				$arr['js_top']   = "applied/js_top";

				$arr['header']   = "header";
				$reserve = $this->authentification->reserve();
				if($reserve==true){
					$arr['navbar_profile'] = "navbar-profile";

				} else{

					$arr['navbar-profile'] = "navbar-profile-free";
				}

				$arr['template'] = "applied/template";
				$arr['js_under'] = "applied/js_under";

			}

			else if($page == "experience")
			{
				/*echo "<script>alert('experience');</script>";*/
				$arr['ctrl']			= "experience";				
				$arr['title'] 		   = "experience";
				$arr['meta'] 	 		= "experience/meta";
				$arr['css'] 	  		 = "experience/css";
				$arr['js_top']   		  = "experience/js_top";
				
				$arr['header']   		  = "experience/header";
				
				$reserve = $this->authentification->reserve();
				if($reserve==true)
				{
					$arr['navbar_profile']  = "navbar-profile";
				}
				else
				{
					$arr['navbar_profile']  = "navbar-profile-free";
				}
				$arr['template'] 		= 'experience/template';
				$arr['js_under'] 		= "experience/js_under";
			
			} 
			
			else if($page == "detail_tml" )
			{
				/*echo "<script>alert('experience');</script>";*/
				$arr['ctrl']			= "detail_tml";				
				$arr['title'] 		   = "detail_tml";
				$arr['meta'] 	 		= "detail_tml/meta";
				$arr['css'] 	  		 = "detail_tml/css";
				$arr['js_top']   		  = "detail_tml/js_top";
				
				$arr['header']   		  = "detail_tml/header";
				
				
				$arr['template'] 		= 'detail_tml/template';
				$arr['js_under'] 		= "detail_tml/js_under";
					
			}
			
			return $arr;
		}

		function save_session(){
			/* Page yang khusus mengakses appraisal dengan menembak langsung username perusahaan */
			show_404();
			// $username_comp = $this->uri->segment(4);
			// $username_pelaut = $this->uri->segment(2);
			// $this->load->model("company/company_model", "comp");

			// $dtPerusahaan = $this->comp->get_company("where username = '$username_comp'");
			// $dtPerusahaan = $dtPerusahaan->row_array();

			// $dt = array(
			// 	'id_perusahaan' 	 => $dtPerusahaan['id_perusahaan'],
			// 	'username_company'  => $dtPerusahaan['username'], 
			// 	'email_perusahaan'  => $dtPerusahaan['email'], 
			// 	'user_company' 	  => "company", 
			// 	'nama_perusahaan'   => $dtPerusahaan['nama_perusahaan'], 
			// 	'type_user'		 => "company",
			// 	'contact_person' 	=> $dtPerusahaan['contact_person'],
			// 	'account_type' => $dtPerusahaan['account_type']
			// );
						
			// $this->session->set_userdata($dt);
			// header("location: ".base_url("profile/$username_pelaut/appraisal"));
		}
		
		function detail_tml()
		{
			$data = fill_ads_data();

			$id_timeline = $this->uri->segment(5);
			// error_reporting(E_ALL);
			$this->load->model("timeline/timeline_model");
			$this->load->model("timeline/comment_tml_model");
			$this->load->helper("text");
			
			$data 		  = $this->template("detail_tml");
			$data["tml"]   = $this->timeline_model->detail_timeline($id_timeline);
			$this->db->where("username", $data['tml']['username']);
			$exec = $this->db->get("pelaut_ms");
			$data['dt_pelaut'] = $exec->row_array();
			// print_r($data['dt_pelaut']);
			$data['title'] = $data["tml"]["username"]." - ".word_limiter($data["tml"]["content"],6); 
			
			// echo check_img_timeline($data['tml']['id_timeline']);exit;
			//print_r($data['tml']);
			
			$this->load->view("index",$data);
		}
		
		function resume_print()
		{
			$data 			 = $this->template("resume_print");
			$username_url 	 = $this->uri->segment(2);//username yang ada di url 
			
			$this->load->view("index",$data);
			
		}
		
		function recommendation()
		{
			$data = fill_ads_data();
			//exit("why ? ");
			//error_reporting(E_ALL);
			$this->load->model('vessel_model'); // vessel model
			$this->load->model("recommendation_model");
			$this->load->model("experience_model");
			$this->load->model("company/company_model");


			$data 			 = $this->template("recommendation");
			$username_url 	 = $this->uri->segment(2);//username yang ada di url 
			
			$id_perusahaan 	= $this->session->userdata("id_perusahaan");

			$data['pelaut']  		 = $this->seatizen_model->detail_seatizen($username_url); // data penerima recommendation
			$experience			 = $this->experience_model->get_experience_pelaut($username_url);
			$recommendation 		 = $this->recommendation_model->rec_exp_pelaut_group($data["pelaut"]["pelaut_id"]);
			$rec_company 			= $this->recommendation_model->rec_comp_groupbyrank($data["pelaut"]["pelaut_id"]);
			
			//$rec2 = array();
			foreach($recommendation as $row)
			{
				$rec2[] = $row["experience_id"];	
					
			}
			
			//print_r($rec2); exit;
			
			// experience dari table experience
			//$exp2 = array();
			foreach($experience as $row)
			{
				if(in_array($row["experience_id"],$rec2))
				{
					$exp2[] = $row["experience_id"];
				}
				
			}
			
			//print_r($exp2); exit;
			
			// generate experience full
			foreach($exp2 as $row)
			{
				$data["experience"][] = $this->experience_model->get_experience_detail($row);
				
			}
			
			
			$data["rec_company"] = $rec_company;
			
			$this->load->view("index",$data);
		}
		
		function appraisal()
		{
			# code...
			// echo "test";exit;
			$type_user = $this->session->userdata("type_user");
			$id_perusahaan = 0;
			if($type_user == "company") $id_perusahaan    = $this->session->userdata("id_perusahaan");
			else if($type_user == "agent") $id_perusahaan = $this->session->userdata("id_perusahaan_agent");
			
			$data['username'] 		= !empty($username) ? $username : $this->session->userdata("username");
			$data['username_url'] 	= $username_url;
			$data['pelaut_id'] 	   = $check_username['pelaut_id'];
			
			if($id_perusahaan > 0){
				
				
				if(isset($_GET['t']))
				{
					$this->load->library("token");
					$token = $_GET['t'];
					$dtToken = $this->token->read_token($token);
					$data_token = array('no_token' => $token);
					$this->token->delete_token($data_token);
					$page = $dtToken['page'];
					$page = explode('/', $page);
					header("location: ".base_url("profile/$page[1]/appraisal"));
				}
				$data = $this->template("appraisal");
				
				$this->load->model("sea_record_model", "exp");
				$this->load->model("rank_model", "rank");
				$username_url = $this->uri->segment(2);
				$dtSeatizen = $this->seatizen_model->detail_seatizen($username_url);
				$data['pelaut'] = $dtSeatizen;
				$data['username'] 		= !empty($username_url) ? $username_url : $this->session->userdata("username");
				$data['experiences'] = $this->exp->getLatestAppraisalSeatizen($dtSeatizen['pelaut_id'], false);
				$this->load->view("index",$data);
			}
			else
			{
				
				if(isset($_GET['t']))
				{
					// echo $_GET['t'];
					// echo $id_perusahaan;
					$this->load->library("token");
					$token = $_GET['t'];
					$dtToken = $this->token->read_token($token);
					// echo count($dtToken);
					if(count($dtToken) > 0){
						// print_r($dtToken);
						$this->load->model("company/company_model", "comp");
						$dtCompany = $this->comp->get_company("where email = '$dtToken[email]'");
						$dtPerusahaan = $dtCompany->row_array();
						// print_r($dtPerusahaan);
						$dt = array(
							'id_perusahaan' 	 => $dtPerusahaan['id_perusahaan'],
							'username_company'  => $dtPerusahaan['username'], 
							'email_perusahaan'  => $dtPerusahaan['email'], 
							'user_company' 	  => "company", 
							'nama_perusahaan'   => $dtPerusahaan['nama_perusahaan'], 
							'type_user'		 => "company",
							'contact_person' 	=> $dtPerusahaan['contact_person'],
							'account_type' => $dtPerusahaan['account_type']
						);
					}

					$this->session->set_userdata($dt);
					$data_token = array('no_token' => $token);
					$this->token->delete_token($data_token);
					$page = $dtToken['page'];
					$page = explode('/', $page);
					header("location: ".base_url("profile/$page[1]/appraisal"));
					// $this->appraisal();
				}
				else {
					
				  $username_url = $this->uri->segment(2);
				  $enkrip_tujuan = base64_encode("profile/$username_url/appraisal");
				  $disallowed_char = array('+','=','[',']');
				  $enkrip_tujuan = str_replace("=", '_', $enkrip_tujuan);
				  //base_url("users/login/agentsea/$enkrip_tujuan");
				  redirect(base_url("users/login/agentsea/$enkrip_tujuan"));
				  
				}
			}
		}
		
		// public
		
		public function detail()
		{
			
			if($this->uri->segment(3) == "post")
			{
				$this->post();
				return false;
			}
			
			$username_url = $this->uri->segment(2);//username yang ada di url 
			$username = $username_url;
			$username_login = $this->session->userdata("username");
			
			$nama = $this->session->userdata("nama");
			
			// artinya ini adalah person dimana dia bukan yang login 
			if($username_url != $username_login)
			{
				//echo "tidak sama"; exit;
				$check_username = $this->check_data->check_username_seaman($username_url);
				//print_r($check_username);
				
				if(empty($check_username))
				{
					/*$this->load->model("users/user_model"); // dari module users
					$data['detail_pelaut'] = $this->user_model->get_detail_pelaut();
					
					$data['title'] = $check_username['nama_depan']." ".$check_username["nama_belakang"];
					$data['css'] = "seaman/detail/head";
					$data['template'] = "seaman/detail/template";
					$data['ctrl'] = "detail";
					$data['username'] = !empty($username) ? $username : $this->session->userdata("username"); 
					$data['username_url'] = !empty($username) ? $username : $this->uri->segment(2);*/
					
					show_404();
					
					
				}
				else
				{
					$data = $this->template("seatizen");
					
					$this->load->model("users/user_model"); // dari module users
					$data['detail_pelaut'] = $this->user_model->get_detail_pelaut($username);
					$data['username'] 	  = !empty($username) ? $username : $this->session->userdata("username"); 
					//$data['ctrl']          = "detail";
			 		$data['nama']  		  = $data['title'];
					
					//tracker kunglaw 2016
					$dt = array("username"=>$username,"action"=>"view","category"=>"seatizen","page"=>"resume");
					run_tracker($dt);
					// menugaskan list timeline untuk mengambil datanya dari controller profile/detail
				    $this->load->view('index',$data);	
					
				}
			}
			else
			{
				
				$data['title']    = $nama;
				$data['css']      = "profile/css";
				$data['header']   = "header";
				$data['js_top']   = "profile/js_top";
				$data['js_under'] = "profile/js_under";
				$data['template'] = "profile/template";
				$data['ctrl']     = "profile";
				$data['username'] = $username_login;
				
				//tracker kunglaw 2016
				$dt = array("username"=>$username,"action"=>"view","category"=>"seatizen","page"=>"resume");
				run_tracker($dt);
				
				// menugaskan list timeline untuk mengambil datanya dari controller profile/detail
				$this->load->view('index',$data);	
				
			}
			
		}
		
		/* routes = profile/$username/experiences 
		public */
		public function experience()
		{
			/*echo "<script>alert('expre');</script>";*/
			$this->load->model('vessel_model'); // vessel model
			$this->load->model("rank_model");
			$this->load->model('department_model');
			$this->load->model("coc_model");
			$this->load->model('seaman/resume_model');
			$this->load->model('experience_model');
			// experience controller profile
			$username_url = $this->uri->segment(2); // username dari url
			$username_login = $this->session->userdata("username");
			
			$check_username = $this->check_data->check_username_seaman($username_url);
			if($check_username)
			{
			  
			  // cek jika username login sama username url sama atau tidak 
			    $reserve = $this->authentification->reserve();		
				if($reserve == true)
				{
				  $data = $this->template("experience");	
				  $data['detail_pelaut'] = $this->seatizen_model->detail_seatizen($username_url);
				  $data['experience']    = $this->experience_model->get_experience_pelaut($username_login);
				  $nama = $data['detail_pelaut']['nama_depan']." ".$data['detail_pelaut']['nama_belakang'];
				  
				 
				}
				else
				{
				  $this->load->model("users/user_model"); // dari module users
				  
				  $data = $this->template("experience");
				  
				  $data['detail_pelaut'] = $this->seatizen_model->detail_seatizen($username_url);
				  $data['experience'] 	= $this->experience_model->get_experience_pelaut($username_url);
				  $data['username'] 	  = !empty($username_url) ? $username_url : $this->session->userdata("username"); 
				  $data['nama'] 		  = $check_username['nama_depan']." ".$check_username["nama_belakang"];
					
				}
				
				//tracker kunglaw 2016
				$dt = array("username"=>$username_url,"action"=>"view","category"=>"seatizen","page"=>"experience");
				run_tracker($dt);
				//print_r($data); exit;
				$this->load->view("index",$data);
			  
			  
			}
			else
			{
			  show_404();
			}
			//echo "jalan";	
		}
		
		// untuk resume. company
		public function resume()
		{

			// http://localhost/informasea/profile/username/resume
			
			$username_url = str_replace('%20',' ',$this->uri->segment(2)); // username dari url
			$username_login = $this->session->userdata("username");
			
			$company_username = $this->authentification->company_loggedin();
			
			// if($company_username == false)
			// {
			// 	header("location:".base_url("profile/$username_url/resume"));
			// }
			
			$this->load->model('resume_model');
			
			$check_username = $this->check_data->check_username_seaman($username_url);
			//print_r($check_username); exit;
			
			if($check_username)
			{
				$data = $this->template("resume");
				
				// untuk label 
				$data['date_issued_lbl']  = "Issued date";
				$data['date_expired_lbl'] = "Expiry date";
				$data['sign_on_lbl']	  = "Sign On";
				$data['sign_off_lbl']	 = "Sign Off";
				
				//jalankan beberapa model 
				$this->load->model('vessel_model'); // vessel model
				$this->load->model("rank_model");
				$this->load->model('department_model');
				$this->load->model("coc_model");
				
				//echo $this->session->userdata('id_pelaut'); 
				//print_r($this->session->all_userdata());

				$data['username'] 		= !empty($username) ? $username : $this->session->userdata("username");
				$data['resume']   		  = $this->resume_model->get_resume($check_username['username']);
				
				$data['username_url'] = $username_url;
				//run_tracker("Resume of $data[username]");
				$data['pelaut_id'] = $check_username['pelaut_id'];
				$data['file_resume'] = $this->resume_model->list_upload_resume_by_username($username_url); 
				
				//tracker kunglaw 2016
				$dt = array("username"=>$username_url,"action"=>"view","category"=>"seatizen","page"=>"resume");
				run_tracker($dt);
				
				$this->load->view('index',$data);
			}
			else
			{
				show_404();	
			}
		}	


		public function appliedvacantsea(){
			// $data = fill_ads_data();

			/* echo "<script>alert('tessss disini')</script>"; */
			// echo "aku disinii";
			// //$data['ctrl'] 	 = "appliedvacantsea";
			// 	$data['title'] 	= "Applied Vacantsea";
			// 	$data['meta']	 = "applied/meta";
			// 	$data['css']	  = "applied/css";
			// 	$data['js_top']   = "applied/js_top";

			// 	$data['header']   = "header";
			// 	$reserve = $this->authentification->reserve();
			// 	if($reserve==true){
			// 		$data['navbar_profile'] = "navbar-profile";

			// 	} else{

			// 		$data['navbar-profile'] = "navbar-profile-free";
			// 	}

			// 	$data['template'] = "applied/template";
			// 	$data['js_under'] = "applied/js_under";
			$this->load->library('pagination');
			$username_url = $this->uri->segment(2);
			$username_login = $this->session->userdata("username");
			$id_user = $this->session->userdata("id_user");

			$check_username = $this->check_data->check_username_seaman($username_url);

			if($check_username){
				$data = $this->template("applied");

				
				if($this->uri->segment(4)==""){
					$offset = 0;
				}else{
					$offset = $this->uri->segment(4);
				}

				$limit 		= 5;

				$data['username'] 			= !empty($username) ? $username : $this->session->userdata("username");
				$data['vacantsea']   		  = $this->vacantsea_model->list_applied_vacantsea_seaman($id_user,false,$offset);
				$data['count'] = count($this->vacantsea_model->list_applied_vacantsea_seaman($id_user,true,$offset));

				$config 				= array();

				$config['base_url'] 	= base_url().'profile/'.$username_url.'/applied-vacantsea';
				$config['per_page'] 	= $limit;
			
				$config['uri_segment'] 	= 4;
				$config['num_links'] 	= 5;
			   	$config['first_tag_open'] 	= '<li>';
				$config['first_link'] 		= 'First';
				$config['first_tag_close'] 	= '</li>';
				$config['prev_link'] 		= 'Prev';
				$config['prev_tag_open'] 	= '<li>';
				$config['prev_tag_close'] 	= '</li>';
				$config['cur_tag_open'] 	= '<li class="active"><a href>';
				$config['cur_tag_close'] 	= '</a></li>';
				$config['next_link'] 		= 'Next';
				$config['next_tag_open'] 	= '<li>';
				$config['next_tag_close'] 	= '</li>';
				$config['num_tag_open'] 	= '<li>';
				$config['num_tag_close'] 	= '</li>';
				$config['last_tag_open'] 	= '<li>';
				$config['last_link'] 		= 'Last';
				$config['last_tag_close'] 	= '</li>';
				$config['total_rows'] 		= $data['count'];
				$data['error'] = '';
				$this->pagination->initialize($config);
				//$data['pagination'] = $this->pagination->initialize($config);
				
				//tracker kunglaw 2016
				$dt = array("username"=>$username_url,"action"=>"view","category"=>"seatizen","page"=>"applied_vacantsea");
				run_tracker($dt);

			}


			$this->load->view("index",$data);



		}

		/* routes = profile/$username/friends 
		public */
		public function friends()
		{
			// $data = fill_ads_data();
			// error_reporting(E_ALL);
			$username_url = $this->uri->segment(2); // username dari url
			$username_login = $this->session->userdata("username");
			
			$check_username = $this->check_data->check_username_seaman($username_url);
			//print_r($check_username); exit;
			
			if($check_username)
			{
				
				// cek jika username login sama username url sama atau tidak 		
				if($username_url == $username_login)
				{
				  $data = $this->template("friends");
				  $data['detail_pelaut'] = $this->seatizen_model->detail_seatizen($username_url);
				  $nama = $data['detail_pelaut']['nama_depan']." ".$data['detail_pelaut']['nama_belakang'];
				  $data['nama'] = $nama;
				  //exit("friends ... ");
				}
				else
				{
				  $data = $this->template("friends");
				  $this->load->model("users/user_model"); // dari module users
				  $data['detail_pelaut'] = $this->user_model->get_detail_pelaut();
				  $data['username'] = !empty($username_url) ? $username_url : $this->session->userdata("username"); 
				  //$data['username'] = $username_url;
				  $data['nama'] = $check_username['nama_depan']." ".$check_username["nama_belakang"];
					
				}
				
				//tracker kunglaw 2016
				$dt = array("username"=>$username_url,"action"=>"view","category"=>"seatizen","page"=>"friends");
				run_tracker($dt);
				
				//print_r($data); exit;
				$this->load->view("index",$data);
			}
			else
			{
			  show_404();
			}
		}
		
		public function account()
        {
			$data = fill_ads_data();
			
			$username_url = $this->uri->segment(2); // username dari url
            $username_login = $this->session->userdata("username");
//			echo $username_login." == ".$username_url;
            $check_username = $this->check_data->check_username_seaman($username_login);
            //print_r($check_username); exit;
//            echo "Hello";
			
			$reserve = $this->authentification->reserve();
			if(!$reserve)
			{
				header("location:".base_url("profile/$username_url"));
			}
	
            if($check_username)
            {
                // cek jika username login sama username url sama atau tidak
                if($username_url == $username_login)
                {
					$data = $this->template("account");
                    $data['detail_pelaut'] = $this->seatizen_model->detail_seatizen($username_url);
                    $nama = $data['detail_pelaut']['nama_depan']." ".$data['detail_pelaut']['nama_belakang'];
                    $data['username'] = $username_url;
                    $data['nama'] = $nama;
//                    print_r($data['detail_pelaut']);

                                                  $data['edit_username'] = $this->resume_model->cek_edit_username($this->session->userdata('id_user'));

                }
                else
                {
					$this->load->model("users/user_model"); // dari module users
					$data = $this->template("account");
                    $data['detail_pelaut'] = $this->user_model->get_detail_pelaut();
                    $data['username'] = !empty($username_url) ? $username_url : $this->session->userdata("username");
                    //$data['username'] = $username_url;
                    $data['nama'] = $check_username['nama_depan']." ".$check_username["nama_belakang"];
                }
				
				run_tracker("Account of $data[username]");
				
                //print_r($data); exit;
                $this->load->view("index",$data);
            }
            else
            {
                show_404();
            }
        }
		
		/* routes = profile/$username/about 
		public */
		public function about()
		{
			$data = fill_ads_data();

			$username_url = $this->uri->segment(2); // username dari url
			$username_login = $this->session->userdata("username");
			
			$check_username = $this->check_data->check_username_seaman($username_url);
			//print_r($check_username); exit;
			if($check_username)
			{
				
				// cek jika username login sama username url sama atau tidak 		
				if($username_url == $username_login)
				{		
				  $data['detail_pelaut'] = $this->seatizen_model->detail_seatizen($username_url);
				  $nama = $data['detail_pelaut']['nama_depan']." ".$data['detail_pelaut']['nama_belakang'];
				  $data["title"] = "About Me";
				  $data["template"] = "about/template";
				  $data['header']   = "header"; //luar
				  $data['username'] = $username_url;
				  $data['nama'] = $nama;
				}
				else
				{
				  $this->load->model("users/user_model"); // dari module users
				  $data['detail_pelaut'] = $this->user_model->get_detail_pelaut();
				  
				  $data['title'] = "About ".$check_username['nama_depan']." ".$check_username["nama_belakang"];
				  //$data['css'] = "seaman/detail/head";
				  $data['header']   = "about/header"; //dalam folder about
				  $data['template'] = "seaman/about/template";
				  $data['ctrl'] = "detail";
				  $data['username'] = !empty($username_url) ? $username_url : $this->session->userdata("username"); 
				  //$data['username'] = $username_url;
				  $data['nama'] = $check_username['nama_depan']." ".$check_username["nama_belakang"];
					
				}
				
				//tracker kunglaw 2016
				$dt = array("username"=>$username_url,"action"=>"view","category"=>"seatizen","page"=>"about");
				run_tracker($dt);
				//print_r($data); exit;
				$this->load->view("index",$data);
			}
			else
			{
			  show_404();
			}
		}
		
		function post()
		{
			// detail posting timeline
			
			$id_timeline = $this->uri->segment(4);	
			
			$username = $this->uri->segment(2);//username yang ada di url
			$check_username = $this->check_data->check_username_seaman($username_url);
			
			
			$data['title'] = $check_username['nama_depan']." ".$check_username["nama_belakang"];
			//$data['css'] = "seaman/detail/head";
			$data['template'] = "seaman/detail_timeline/template";
			//$data['ctrl'] = "detail";
			//$data['username'] = !empty($username) ? $username : $this->session->userdata("username"); 
			$data['row'] = $this->timeline_model->detail_timeline($id_timeline);
			//print_r($data['timeline']);
			//$data['username_url'] = !empty($username) ? $username : $this->uri->segment(2); 
		
			$this->load->view('index',$data);
			

		}
		
		
		
		public function photo()
		{
			
			$username_url = $this->uri->segment(2);
			run_tracker("Photo of $username_url");
			// CARA BENAR
			$obj = modules::load("photo/photo_ajax");
			$obj->content_photo_person();
			
			/* // CARA BENAR 
			modules::load("photo/photo")->test();
			
			// CARA BENAR
			$this->load->module("photo/photo");
			$this->photo->test();
			
			// CARA BENAR , TAPI GAK BISA
			//modules::run("photo/photo/test"); */
			
		}
		
		function processUpdate()
        {
            $this->authentification->ajax_access();
			
            $id_pelaut = $this->input->post("id_pelaut",true);
            $username = $this->input->post("username",true);
            $old_pass = $this->input->post("old_pass",true);


            $valid = $this->user_model->checkPassword($username, $old_pass);
            $data['query'] = $valid[1];
            if($valid[0] > 0)
            {
                $password = $this->input->post("password",true);
                $email = $this->input->post("email",true);
                $repass = $this->input->post("repass",true);

                if(empty($password) || empty($repass)) $data['hasil'] = "kosong";
                else {
                    if ($password == $repass) {
                        $update = $this->user_model->changePassword($id_pelaut, $username, $email, $password);
                        $data['hasil'] = "berhasil update";
                    }
                    else $data['hasil'] = "password tidak match";
                }
            }
            else $data['hasil'] = "password lama salah";

            $this->load->view("seaman/account/message-alert",$data);
        }

        	
		
		function __destruct()
		{
			
			
		}
		
		
	}
	
