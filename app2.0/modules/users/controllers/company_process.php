<?php if(!defined('BASEPATH')) exit ("No Direct Script access allowed ");

class Company_process extends MX_Controller{
	
	private $db;
	
	function __construct()
	{
		parent::__construct();	
		//$this->load->model('company/company_model');
		$this->load->model("company_model");
		$this->load->model("users/user_model");
		$this->load->helper("user_cookie_helper");
		
		$this->db = $this->load->database(DB_SETTING,true);

	}
	
	private function index()
	{
		$session_set_value = $this->session->all_userdata();
		
		if($session_set_value['remember_me'] == 1){
            header("location:".base_url("dashboard"));
        }
		
		$user = $this->uri->segment(3);
		
		$data['head']	 = "head";
		$data['title']	= "Register as Seaman";	
		$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "meta"; // meta tambahan, di head
		$data['js_top']   = "js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";		
		$data['rwnation'] = $this->nation_model->get_nationality();
		$data['rwuser'] = $this->user_model->get_pelaut();
		
		//$check = $this->check_username();
		//$data['info'] = $check['info'];
		
		if($user == "agentsea")
		{
			$data['template'] = "register-agentsea";
		}
		else
		{
			$data['template'] = "template";
		}
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		
		$this->load->view('register',$data);	
		
	}
	function login_process()
	{
		// error_reporting(E_ALL);
		$this->load->helper('cookie');
		
		clear_cookie_company();
		
		$this->load->library('form_validation');
		$this->load->helper('list_error_users_helper');
		
		$username = filter($this->input->post("username_lg",TRUE));
		$password = filter(md5($this->input->post("password_lg")));
		
		// remember_me value antara 1=TRUE / 0=FALSE
		$remember_me = $this->input->post('remember_me');
		
		//$page 	 = $this->input->post("page",TRUE);
		
		//print_r($this->input->post()); exit;
 		
		$login_attemp = $this->input->post("login_attemp",true); // int
		$new_login_attemp = $login_attemp + 1;
		
		//$this->form_validation->set_error_delimiters('<li >', '</li> ');
		
		$this->form_validation->set_rules('username_lg','Username','required|xss_clean');
		$this->form_validation->set_rules('password_lg','Password','required|xss_clean');
		$this->form_validation->set_rules('remember_me','Remember Me','xss_clean');
		
		$taw = "<p>";
		$tak = "</p>";
		
		// TAMPILAN 	
		$data['title']    = "Login";
		$data['template'] = "template";
		$data['js']	   = "js";
		$data['css']	  = "css";
		$data['meta']	 = "meta";
		
		//$data['rwnation'] = $this->nation_model->get_nationality();
		//$data['rwuser'] = $this->user_model->get_pelaut();
		/* end TAMPILAN */
		
		/* kondisi klo username ada tp pass salah */
		$str_cu = "select * from perusahaan where username = '$username'";
		$q_cu   = $this->db->query($str_cu);
		$f_cu   = $q_cu->row_array();
		
		/* kondisi klo username ada and pass bener */
		$str_ca = "select * from perusahaan where username = '$username' and password = '$password'";
		$q_ca   = $this->db->query($str_ca);
		$f_ca   = $q_ca->row_array(); 
		
		$str_ag = "select * from agent_ms where username = '$username' ";
		$q_ag = $this->db->query($str_ag);
		$f_ag = $q_ag->row_array();
		
		//$data['show_modal'] 	= 1;
		//$data['err'] 			= md5(1);
		$data['u']			  = !empty($f_cu) ? "t" : "f";
		$data['a']			  = !empty($f_ca) ? "t" : "f";
		
		
		if($this->form_validation->run() == TRUE)
		{
			
			$check 		 = $this->company_model->login($username,$password);    // check username active dan password dan password benar
			//$check_expired = $this->company_model->check_expired_company($username);	nanti aktifkan kalau sudah pasti 			
			$check_user 	= $this->company_model->check_company($username); 	   // check user active 			
			$check_nauser  = $this->company_model->check_nacompany($username); 	 // check user tidak active
			
			// KONDISI USERNAME DAN PASSWORD BENAR
			if(!empty($check[0]))
			{ 
			
				if($check['user'] == "company")
				{		
									// account_type
					if($check_user['official'] != "Alpha")
					{
						//if(!empty($check_expired))
						//{
							$dt = array('id_perusahaan' => $check[0]['id_perusahaan'],
							'username_company' => $check[0]['username'], 
							'email_perusahaan' => $check[0]['email'], 
							'user_company'     => $check['user'], 
							'account_type'	 => $check[0]['account_type'],
							'nama_perusahaan'  => $check[0]['nama_perusahaan'], 
							'contact_person'   => $check[0]['contact_person'],
							'official'		 => $check[0]['official'],
							'type_user'        => "company");
							
							if ($remember_me) {
								// Set remember me value in session
								$this->session->set_userdata('remember_me', TRUE);
							}
							
							$this->session->set_userdata($dt);
							
							// locationnya harus beda 
							/*
								kalau local
								http://localhost/company.informasea/home
								
								kalau hosting
								informasea.com/company.informasea/home
							*/
							
							//tracker kunglaw 2016
							track_agentsea_login($dt["id_perusahaan"]);
							track_agentsea($check[0]['id_perusahaan'],"login");
							
							//header("location:http://localhost/company.informasea/home");
							
							//header("location:http://informasea.com/company.informasea/home");
							
							$dtt['redirect'] = base_url("agentsea/$dt[username_company]/home");
									$this->load->view("redirect-page",$dtt);
							
							header("location:".base_url("agentsea/$dt[username_company]/home"));
						//}
						//else
						//{
						//	$err = "$taw Your Account has been expired, please <a> upgrade </a>  $tak ";
					
							//$data['show_modal'] = 1;
						//	$data['err']		= md5(2);
						//	header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&
						//	login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));	
						//}
						
					}
					else
					{

					  $dt = array(
					  
						'id_perusahaan' 	=> $check[0]['id_perusahaan'],
						'username_company' => $check[0]['username'], 
						'email_perusahaan' => $check[0]['email'], 
						'user_company'     => $check['user'], 
						"account_type"	 => $check[0]["account_type"],
						'nama_perusahaan'  => $check[0]['nama_perusahaan'], 
						'contact_person'   => $check[0]['contact_person'],
						'official'		 => $check[0]['official'],
						'type_user'        => "company" 
					  
					  );
  
					  $this->session->set_userdata($dt);
											  //	$this->session->set_userdata($dt);

					  $location = alpha_url("$dt[username_company]/welcome");
					  header("location:".$location);
					
					}
				}
				/* else if($check['user'] == "agent")
				{
					
					$dt = array('id_user' => $check[0]['agent_id'],'username' => $check[0]['username'], 'email' => $check[0]['email'], 'user' => $check['user'], 'nama' => $check['nama']);
					$this->session->set_userdata($dt);
					ob_start();
					header("location:".base_url("agent"));
				}
				else if($check['user'] == "company")
				{
					$dt = array('id_user' => $check[0]['id_perusahaan'],'username' => $check[1]['username'], 'email' => $check[1]['email'], 'user' => $check['user'], 'nama' => $check['perusahaan']);
					$this->session->set_userdata($dt);	
					
					header("location:".base_url("agentsea"));
					
				}*/
				else
				{
					// username and password are invalid
					$err = "$taw Username or password are invalid $tak ";
					
					//$data['show_modal'] = 1;
					$data['err']		= md5(1);
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				
			}

			// KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH v
			else if(!empty($check_user))
			{ 				
				//echo "KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH v"; exit;
				
				/* COOKIES COMPANIE				
				$cookie = $_COOKIE;
				$uag_cookie = $cookie['username_agent'];
				$cp_cookie = $cookie['contact_person']
				$u_cookie = $cookie['username_company']; 
				
				$n_cookie = $cookie['company_name'];
				$p_cookie = $cookie['photo_company'];
				$c_cookie = $cookie['cover_company'];
				$s_cookie = $cookie['success_company']; */
				
				$data['err'] = md5(1);

				$this->load->model('photo/photo_mdl');
				
				$url 	   = check_logo_agentsea($check_user["username"]);
				$url_cover = check_cover_agentsea($check_user["username"]);
				
				$data_cookie = array(
					
					"company_name"     => $check_user['nama_perusahaan'],
					"contact_person"   => $check_user['contact_person'],
					"photo_company"    => $url,
					"username_company" => $check_user['username'],
					"cover_company"    => $url_cover
				
				);
				
				define_cookie_company($data_cookie);
				
				// HARUSS REDIRECTTT !!!				
				header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				
			}
			
			// KONDISI USERNAME belom ACTIVE dan PASSWORD benar
			else if(!empty($check_nauser))
			{
				
				$data['err'] = md5(2);
				
				//echo "check_nauser"; exit;
				$url = base_url("assets/img/img_default.png");
				$url_cover = base_url("assets/img/blur-background09.jpg");
				
				$data_cookie = array(
					
					"company_name"     => $check_user['nama_perusahaan'],
					"contact_person"   => $check_user["contact_person"],
					"photo_company"    => $url,
					"username_company" => $check_user['username'],
					"cover_company"    => $url_cover
				
				);
				define_cookie_company($data_cookie);
				
				
				header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				// HARUSS REDIRECTTT !!!				
				//header("location:".base_url("users/formactivation_agent/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
			}
			
			//AGENT
			else if(!empty($f_ag))
			{
				// DAFTAR COOKIE untuk agent  
				/* $cookie = $_COOKIE;
				$uag_cookie = $cookie['username_agent'];
				$cp_cookie = $cookie['agent_name'];
				$u_cookie = $cookie['username_company']; 
				$n_cookie = $cookie['company_name'];
				$p_cookie = $cookie['photo_company'];
				$c_cookie = $cookie['cover_company'];
				$s_cookie = $cookie['success_company'];*/
				
				//$this->load->model("company/company_model");
				$login_agent = $this->company_model->login($username,$password);
				$check_agent = $this->company_model->check_agent($username);
				
				// Login agent benar	
				if(!empty($login_agent[0]))
				{
					//print_r($login_agent);
					//echo "<div>Perusahaan_id = $login_agent[0][perusahaan_id]</div>";
					$ccompany = $this->company_model->get_detail_company_byid($login_agent[0]['perusahaan_id']);
					//print_r($ccompany);
					
					$dt = array(
					
					'id_perusahaan' 			 => $login_agent[0]['perusahaan_id'],
					'username_agent' 		    => $login_agent[0]['username'], 
					'email_agent' 		  	   => $login_agent[0]['email'], 
					"account_type"			  => $ccompany["account_type"],
					'user_company' 			  => $login_agent['user'], 
					'nama_perusahaan' 		   => $login_agent[0]['nama_perusahaan'], 
					'contact_person' 			=> $login_agent[0]['nama'],
					'official'				  => $login_agent[0]['official'],
					'type_user'			     => "agent"); // nama agent
					
					
					if ($remember_me) {
						// Set remember me value in session
						$this->session->set_userdata('remember_me', TRUE);
					}
					
					$this->session->set_userdata($dt);
					
					// locationnya harus beda 
					/*
						kalau local
						http://localhost/company.informasea/home
						
						kalau hosting
						informasea.com/company.informasea/home
					*/
					header("location:".base_url("agentsea/$ccompany[username]/home"));
				}
				// username agent benar tapi password salah 
				else if(!empty($check_agent))
				{
					$check_a   = $this->company_model->get_detail_company_byid($check_agent['perusahaan_id']); // check company active	
						
					$data['err'] = md5(1);
	
					$url 		= check_profile_agent($check_agent["username"]);
					$url_cover  = check_cover_agentsea($check_agent["username"]);
					
					$data_cookie = array(
						
						"company_name"     => $check_user['nama_perusahaan'],
						"contact_person"   => $check_a['contact_person'],
						"photo_company"    => $url,
						"username_agent"   => $check_a['username'],
						"cover_company"    => $url_cover
					
					);

					define_cookie_agent($data_cookie);
					
					// HARUSS REDIRECTTT !!!				
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				else
				{					
					// KONDISI ISIAN SALAH
					// username and password are invalid
					$data['err']		= md5(1);
					if($login_first) echo "failed//<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
					else header("location:".base_url("users/login_univ/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
			}
			
			else
			{
				// LOGIN AGENTSEA FORM	
				// KONDISI ISIAN SALAH
				 // username and password are invalid

				$data['err']		= md5(1);
				if($login_first) echo "failed//<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
				else header("location:".base_url("users/login/agentsea/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
			}
		}
		else
		{
			//exit(print_r($check) /*print_r($check_user) print_r($check_nauser)*/);
			
			$data['err'] = md5(1);
			
			$user = $this->uri->segment(3);
		
			$data['head']	 = "head";
			$data['title']	= "Login as Agentsea";	
			$data['css']	  = "css"; //css tambahan, di head
			$data['meta']	 = "login/meta"; // meta tambahan, di head
			$data['js_top']   = "js_top"; // js tambahan, di head
			
			$data['navbar']   = "navbar-login";
			$data['template'] = "login/login.php";
			
			$data['footer']   = "footer";
			$data['js_under'] = "js_under";
			
			$data['desc']     = validation_errors(); 
			
			$this->load->view('register',$data);
			
		}
	}
	
	function change_role()
	{
		$role = $this->input->post("role");
		
		if($role == "manager")
		{
			echo "<input type='text' class='form-control' id='nama_perusahaan' name='nama_perusahaan' placeholder='Company Name' 
                      value='".set_value('nama_perusahaan')."'>";
		}
		else
		{
			//$this->load->model("");
			$company = $this->company_model->get_company();
			
			echo "<select class='form-control' id='nama_perusahaan_select' name='nama_perusahaan' >";
			foreach($company as $row)
			{
				echo "<option value='$row[id_perusahaan]'>$row[nama_perusahaan]</option>";
			}
			echo "</select>";
		}
	}
	
	public function cajax_username_agent()
	{
		// CEK VALIDASI USERNAME
		$username = $this->input->post("username");
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span>', '<span>');
		$info['value'] = "true";
		
		//$info and $value
		
		$this->form_validation->set_rules('username',"Username","alpha_dash|xss_clean|min_length[6]");
		$cajax_username = $this->company_model->cajax_username_agent($username); // table agent_ms
		
		if($this->form_validation->run() == false)
		{
			$info['username'] = validation_errors();	
			$info['value'] = "false";
		}
		else if($cajax_username > 0)
		{
			$info['username'] = " Agent's Username has been used ";
			$info['value'] = "false";
		}
		else
		{
			$info['username'] = " Agent's Username available ";
			$info['value'] = "true";
		}	
		
		//return JSON
		$a = array("info" =>  $info['username'],"value" => $info['value']);
		
		$x = $this->input->post("x");
		if($x == 1)
		{
			echo json_encode($a);
		}else
		{
			return json_encode($a);
		}
	}
	
	public function cajax_username()
	{
		// CEK VALIDASI USERNAME
		$username = $this->input->post("username");
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		$info['value'] = "true";
		
		//$info and $value
		
		$this->form_validation->set_rules('username',"Username","alpha_dash|xss_clean|min_length[6]");
		$cajax_username = $this->company_model->cajax_username($username);
		
		if($this->form_validation->run() == false)
		{
			$info['username'] = validation_errors();	
			$info['value'] = "false";
		}
		else if($cajax_username > 0)
		{
			$info['username'] = " Username has been used ";
			$info['value'] = "false";
		}
		else
		{
			$info['username'] = " Username available ";
			$info['value'] = "true";
		}	
		
		//return JSON
		$a = array("info" =>  $info['username'],"value" => $info['value']);
		
		$x = $this->input->post("x");
		if($x == 1)
		{
			echo json_encode($a);
		}else
		{
			return json_encode($a);
		}
		
	}
	
	/*  agak sulit
		public function cajax_nama_perusahaan()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan",true);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		$info['value'] = "true";
		
		$this->form_validation->set_rules("nama_perusahaan","Company Name","xss_clean|min_length[6]|");
		
		
		
	} */
	
	public function cajax_email_agent()
	{
		// CEK VALIDASI EMAIL
		$email = $this->input->post("email");
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		$info['value'] = "true";
		
		//$info and $value
		
		$this->form_validation->set_rules('email',"Email","valid_email|xss_clean|min_length[6]");
		$cajax_email = $this->company_model->cajax_email_agent($email); // agent
		$cajax_genemail = $this->company_model->cajax_genemail($email); // generic - table generic email
		
		if($this->form_validation->run() == false)
		{
			$info['email'] = validation_errors();	
			$info['value'] = "false";
		}
		else if($cajax_email > 0)
		{
			$info['email'] = " Agent's Email already exists ";
			$info['value'] = "false";
		}
		else if(!empty($cajax_genemail))
		{
			$info['email'] = " Click link below to use free email address ";
			$info['value'] = "false";
			
		}
		else
		{
			$info['email'] = " Agent's Email available ";
			$info['value'] = "true";
		}
		
		// return JSON
		$a = array("info" =>  $info['email'],"value" => $info['value']);
		
		$x = $this->input->post("x");
		if($x == 1)
		{
			echo json_encode($a);
		}else
		{
			return json_encode($a);
		}
	}
	
	function create_vacantsea_process() // bukan dr modal home , tp dr halaman create vacantsea 
	{
		
		session_start();
		
		//error_reporting(E_ALL);
		
		$DB3 	  = $this->load->database(DB_SETTING3,true);
		$this->db = $this->load->database("default",true);
		
		
		$this->load->library('form_validation');
		$this->load->helper('list_error_users_helper');
		$this->load->library("check_data");
		
		$title_vacantsea = filter($this->input->post("title_vacantsea",true));
		$vessel_type 	 = filter($this->input->post("vessel_type",true));
		$department	  = filter($this->input->post("department",true));
		$rank			= filter($this->input->post("rank",true));
		
		$currency 		= filter($this->input->post("sallary_curr",true));
		$sallary 		 = filter($this->input->post("sallary",true));
		$sallary_range   = filter($this->input->post("sallary_range",true));
		
		$description	 = filter($this->input->post("description",true));
		$nama_perusahaan = filter($this->input->post("nama_perusahaan",true));
		$email		   = filter($this->input->post("email",true));
		$contact_person  = filter($this->input->post("contact_person",true));
		$t 			   = filter($this->input->post("t",true));
		
		$input_capt	  = filter($this->input->post("input_capt",true));
		
		$this->form_validation->set_rules("title_vacantsea","Title Vacantsea","required|xss_clean");
		$this->form_validation->set_rules("vessel_type","Vessel Type","required|xss_clean");
		$this->form_validation->set_rules("department","Department","required|xss_clean");
		$this->form_validation->set_rules("rank","Rank","required|xss_clean");
		
		$this->form_validation->set_rules("sallary","Sallary","xss_clean"); // tidak required
		
		$this->form_validation->set_rules("description","Description","xss_clean");
		$this->form_validation->set_rules("nama_perusahaan","Company Name","required|xss_clean");
		$this->form_validation->set_rules("email","Email","valid_email|required|xss_clean"); // check email, tidak boleh sama dengan yg ada di database
		$this->form_validation->set_rules("contact_person","Contact Person","required|xss_clean");
		// username dan password di generate
		// check generic email
		// kondisi kalau dia pakai generic email, account_type = 'Alpha' 
		$u	 = explode("@",$email);
		$strge = "SELECT * FROM generic_email where provider = '$u[1]' ";
		$qge   = $this->db->query($strge);
		$fge   = $qge->row_array();
		
		$generic = FALSE;
		if(!empty($fge))
		{
			//$username	 = $u[0]; // kalau ada, ambil depan 
			//$account_type = "Free_trial"; // alpha ?
			//$official	 = 'Alpha'; 
			$generic = TRUE;
		}
		else
		{
			$uu 		   = explode(".",$u[1]);
			$username	 = $uu[0]; // kalau tidak ada, ambil belakang	
			$account_type = "Free_trial"; // Free ? 
			$official	 = 'Agent';
		}
		// kalau bukan generic, ambil bagian belakang email, account_type = 'Free' ? 
		
		$true_pass		= mt_rand(100000,999999);
		$password 		 = md5($true_pass);
		
		//captcha-response
		/* $g_captcha_response = $_POST['g-recaptcha-response'];
		
$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);*/
		
		if(!empty($t))
		{
			// check code_invitation
			$stra = "SELECT * FROM infr6975_informasea_admin.admin_send_email_agentsea WHERE code_invitation = '$t' ";
			$qa   = $DB3->query($stra);
			$fa   = $qa->row_array();	
		}
		
		// $cajax_email = json_decode($this->cajax_email(),true);
		// check email disemua table
		$check_email = $this->check_data->check_email($email);
		
		if($input_capt == $_SESSION["captcha"] && $generic == FALSE)
		{
		  if($this->form_validation->run() == true && $check_email == TRUE )
		  {
			  $account_type 	= "Free_trial"; // SET FREE
			  $activation_code = "ACTIVE"; // set active atau tidak ? 
			  
			  // insert dahulu ke table perusahaan
			  $strp  = "INSERT INTO perusahaan SET 		 	  "; 
			  $strp .= "nama_perusahaan	= '$nama_perusahaan' ,";
			  $strp .= "email				= '$email'			 ,";
			  $strp .= "contact_person		= '$contact_person'	 ,";
			  $strp .= "username			= '$username'	 	 ,";
			  $strp .= "password			= '$password'	 	 ,";
			  $strp .= "activation_code	= '$activation_code' ,";
			  $strp .= "create_date		= now() 			 ,";
			  $strp .= "expired_date		= ''				 ,";
			  $strp .= "account_type		= '$account_type'	 ,";
			  $strp .= "official			= '$official'		 ,";
			  $strp .= "role				= 'Manager'			 ,";
			  $strp .= "tampil				= '1'			 	  "; // untuk pengetesan, set 0
			  
			  $q	 = $this->db->query($strp) ;
			  
			  // get data perusahaan
			  $strgp = "SELECT * FROM perusahaan WHERE username	= '$username' ";
			  $qgp   = $this->db->query($strgp);
			  $fgp   = $qgp->row_array(); 
			  
			  // INSERT ke perusahaan_setting
			  $strs = "INSERT INTO perusahaan_setting SET		   		 ";
			  $strs.= "id_perusahaan		 = '$fgp[id_perusahaan]'	,";
			  $strs.= "status				 = 'VERIFIED'				 ";
			  $qs   = $this->db->query($strs);
			  
			  $create_date = date('Y-m-d');
			  $vacantsea_exp_date = date('Y-m-d', strtotime('+7 days', strtotime($create_date))); // exp_date tidak di set
			  
			  // insert ke vacantsea
			  $strv  = "INSERT INTO vacantsea set 					 ";
			  $strv .= "vacantsea			= '$title_vacantsea'	,";
			  $strv .= "id_perusahaan		= '$fgp[id_perusahaan]'	,";
			  $strv .= "description		= '$description'		,";
			  
			  $strv .= "department			= '$department'			,";
			  $strv .= "rank_id			= '$rank'				,";
			  $strv .= "ship_type			= '$vessel_type'		,";
			  
			  $strv .= "create_date		= now()					,";
			  $strv .= "expired_date		= '$vacantsea_exp_date'	,"; // 2 minggu
			  
			  $strv .= "annual_sallary		= '$sallary'			,";
			  $strv .= "sallary_curr		= '$currency'			,";
			  $strv .= "sallary_range		= '$sallary_range'		,";
			  
			  $strv .= "stat				= 'open'				 ";
			  
			  $qstrv = $this->db->query($strv);
			  
			  // insert ke log_agentsea 
			  track_agentsea($fgp["id_perusahaan"],"register_inv_create_vacantsea");
			  
			  if(!empty($t))
			  {
			  	// hapus di table infr6975_informasea_admin.admin_send_email_agentsea
			  	$strhasea = "DELETE FROM infr6975_informasea_admin.admin_send_email_agentsea WHERE code_invitation = '$t' ";
			  	$qhasea = $this->db->query($strhasea);
			  }
			  
			  
			  //kirim email, data username dan password
			  $this->load->library("my_email");
			  $user = "info";

			  $data = array("username"=>$username,"password"=>$true_pass,"email_to"=>$email,"contact_person"=>$contact_person);
			  $template = $this->load->view("users/email/template_2016/email-create-vacantsea", $data, true);
			  
			  $content = array(
				  
				  "subject" 		=> "Informasea Create Vacantsea Account",
				  "subject_title"  => WEBSITE,
				  "to" 			 => array($email,"alhusna901@gmail.com","admin@informasea.com"), 
				  "data" 		   => array("content_template" => $template),
				  
				  "message" 		=> "template_email2016/new_email_template",
				  "mv" 			 => TRUE/*,
				  //"alt_message"  => "users/email/email-create-alt", // buat alt nya 
				  "amv" 		    => FALSE*/
			  
			  );
			  
			  $this->my_email->send_email($user,$content);
			  
			  // header ke register 
			   $success_company = "Congratulations, you already registered at informasea.com. we're already send username and password to your email at <a href='#'>$email</a>, if there is no email from ".WEBSITE.", please check your spam menu/section on your email. please confirm the activation code to your email to complete registration.";
			   			   
			   $this->session->set_flashdata("success_company",$success_company);
			   header("location:".base_url("users/login/agentsea"));
		  }
		  else
		  {
			  
			  if($check_email == false)
			  {
				  $err_email = "<p> Email has been used </p>";
			  }
			  
			  //$error  = "<div class='alert alert-danger'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <p> <div class='glyphicon glyphicon-exclamation-sign'></div> Error </p> ";
			  $error .= validation_errors();
			  $error .= $err_email; 
			  //$error .= "</div>"; 
			  
			  $this->session->set_flashdata("error",$error);
			  header("location:".base_url("users/create_vacantsea/?t=$t"));	
		  }
		}
		else
		{
			//$error  = "<div class='alert alert-danger'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <p> <div class='glyphicon glyphicon-exclamation-sign'></div> Error </p> ";
			$error  = "you must complete captcha to complete a registration or your email is generic email";    
			//$error .= "</div>";
			
			$err_modal = $error;
			
			$this->session->set_flashdata("error",$err_modal);
			header("location:".base_url("users/create_vacantsea/?t=$t"));
		}
		
		
	}
	
	// agentsea yang mendaftar dari modal / create vacantsea
	function agentsea_login_modal_process()
	{
		$this->load->helper('cookie');
		
		clear_cookie_company();
		
		$this->load->library('form_validation');
		$this->load->helper('list_error_users_helper');
		$this->load->library("token");
		
		$username = $this->input->post("username_lg",TRUE);
		$password = md5($this->input->post("password_lg",TRUE));
		$t 		= $this->input->get("t",TRUE); // ini TOKEN bro 
		
		//$page 	 = $this->input->post("page",TRUE);
		
		//print_r($this->input->post()); exit;
 		
		$login_attemp = $this->input->post("login_attemp",true); // int
		$new_login_attemp = $login_attemp + 1;
		
		$this->form_validation->set_rules("username_lg","Username","xss_clean|required");
		$this->form_validation->set_rules("password_lg","Password","xss_clean|required");
		
		$taw = "<p>";
		$tak = "</p>";
		
		// TAMPILAN 	
		$data['title']    = "Registration";
		$data['template'] = "template";
		$data['js']	   = "js";
		$data['css']	  = "css";
		$data['meta']	 = "meta";
		
		//$data['rwnation'] = $this->nation_model->get_nationality();
		//$data['rwuser'] = $this->user_model->get_pelaut();
		/* end TAMPILAN */
		
		/* kondisi klo username ada tp pass salah */
		$str_cu = "select * from perusahaan where username = '$username'";
		$q_cu   = $this->db->query($str_cu);
		$f_cu   = $q_cu->row_array();
		
		/* kondisi klo username ada and pass bener */
		$str_ca = "select * from perusahaan where username = '$username' and password = '$password'";
		$q_ca   = $this->db->query($str_ca);
		$f_ca   = $q_ca->row_array(); 
		
		$str_ag = "select * from agent_ms where username = '$username' ";
		$q_ag = $this->db->query($str_ag);
		$f_ag = $q_ag->row_array();
		
		//$data['show_modal'] 	 = 1;
		//$data['err'] 			= md5(1);
		$data['u']			  = !empty($f_cu) ? "t" : "f";
		$data['a']			  = !empty($f_ca) ? "t" : "f";
		
		
		if($this->form_validation->run() == TRUE)
		{
			
			$check 		 = $this->company_model->login($username,$password);    // check username active dan password dan password benar			
			$check_user 	= $this->company_model->check_company($username); 	   // check user active 			
			$check_nauser  = $this->company_model->check_nacompany($username); 	 // check user tidak active
			
			// KONDISI USERNAME DAN PASSWORD BENAR
			if(!empty($check[0]))
			{ 
			
				if($check['user'] == "company")
				{									
					$dt = array('id_perusahaan' => $check[0]['id_perusahaan'],
					'username_company' => $check[0]['username'], 
					'email_perusahaan' => $check[0]['email'], 
					'user_company'     => $check['user'], 
					"account_type"	 => $check[0]["account_type"],
					'nama_perusahaan'  => $check[0]['nama_perusahaan'], 
					'contact_person'   => $check[0]['contact_person'],
					'official'		 => $check[0]['official'],
					'type_user'        => "company");
					
					/* if ($remember_me) {
                        // Set remember me value in session
                        $this->session->set_userdata('remember_me', TRUE);
                    } */
					
					$this->session->set_userdata($dt);
					
					// load data vacantsea nya 
					/*
						contoh
						http://dev.informasea.com/vacantsea/detail/86/ini-pekerjaan-dari-modal-1
					*/
					$this->load->model("company/vacantsea_model","cvacantsea_mdl");
					$cvac = $this->cvacantsea_mdl->get_company_vacantsea($dt['id_perusahaan']);
					$title_vac = url_title($cvac[0]["vacantsea"]);
					$vacantsea_id = $cvac[0]["vacantsea_id"];
					
					// delete token
					$dt_del_token = array("no_token"=>$t);
					$this->token->delete_token($dt_del_token);
					
					//tracker kunglaw 2016
					track_agentsea_login($dr["id_perusahaan"]);
					track_agentsea($dr["id_perusahaan"],"login_create_vacantsea");
					
					// ini harus diganti
					header("location:".base_url("vacantsea/detail/$vacantsea_id/$title_vac"));
					
				}
				/* else if($check['user'] == "agent")
				{
					
					$dt = array('id_user' => $check[0]['agent_id'],'username' => $check[0]['username'], 'email' => $check[0]['email'], 'user' => $check['user'], 'nama' => $check['nama']);
					$this->session->set_userdata($dt);
					ob_start();
					header("location:".base_url("agent"));
				}
				else if($check['user'] == "company")
				{
					$dt = array('id_user' => $check[0]['id_perusahaan'],'username' => $check[1]['username'], 'email' => $check[1]['email'], 'user' => $check['user'], 'nama' => $check['perusahaan']);
					$this->session->set_userdata($dt);	
					
					header("location:".base_url("agentsea"));
					
				}*/
				else
				{
					// username and password are invalid
					$err = "$taw Username or password are invalid $tak ";
					
					//$data['show_modal'] = 1;
					$data['err']		= md5(1);
					header("location:".base_url("users/login/agentsea_modal?t=$t&sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				
			}

			// KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH v
			else if(!empty($check_user))
			{ 				
				//echo "KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH v"; exit;
				
				/* COOKIES COMPANIE				
				$cookie = $_COOKIE;
				$uag_cookie = $cookie['username_agent'];
				$cp_cookie = $cookie['contact_person']
				$u_cookie = $cookie['username_company']; 
				
				$n_cookie = $cookie['company_name'];
				$p_cookie = $cookie['photo_company'];
				$c_cookie = $cookie['cover_company'];
				$s_cookie = $cookie['success_company']; */
				
				$data['err'] = md5(1);
				
				$url 	   = check_logo_agentsea($check_user["username"]);
				$url_cover = check_cover_agentsea($check_user["username"]);
				
				$data_cookie = array(
					
					"company_name"     => $check_user['nama_perusahaan'],
					"contact_person"   => $check_user['contact_person'],
					"photo_company"    => $url,
					"username_company" => $check_user['username'],
					"cover_company"    => $url_cover
				
				);
				
				define_cookie_company($data_cookie);
				
				// HARUSS REDIRECTTT !!!				
				header("location:".base_url("users/login/agentsea_modal?t=$t&sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				
			}
			
			// KONDISI USERNAME belom ACTIVE dan PASSWORD benar
			else if(!empty($check_nauser))
			{
				
				$data['err'] = md5(2);
				
				//echo "check_nauser"; exit;
				$url = base_url("assets/img/img_default.png");
				$url_cover = base_url("assets/img/blur-background09.jpg");
				
				$data_cookie = array(
					
					"company_name"     => $check_user['nama_perusahaan'],
					"contact_person"   => $check_user["contact_person"],
					"photo_company"    => $url,
					"username_company" => $check_user['username'],
					"cover_company"    => $url_cover
				
				);
				define_cookie_company($data_cookie);
				
				// HARUSS REDIRECTTT !!!				
				header("location:".base_url("users/login/agentsea_modal?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
			}
			
			else
			{
				// LOGIN AGENTSEA FORM	
				// KONDISI ISIAN SALAH
				 // username and password are invalid

				$data['err']		= md5(1);
				if($login_first) echo "failed//<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
				else header("location:".base_url("users/login/agentsea_modal?t=$t&sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
			}
		}
		else
		{
			//exit(print_r($check) /*print_r($check_user) print_r($check_nauser)*/);
			
			$data['err'] = md5(1);
			
			$user = $this->uri->segment(3);
		
			$data['head']	 = "head";
			$data['title']	= "Login as Seaman";	
			$data['css']	  = "css"; //css tambahan, di head
			$data['meta']	 = "login-company-modal/meta"; // meta tambahan, di head
			$data['js_top']   = "js_top"; // js tambahan, di head
			
			$data['navbar']   = "navbar-login";
			$data['template'] = "login-company-modal/login.php";
			
			$data['footer']   = "footer";
			$data['js_under'] = "js_under";
			
			$data['desc']     = validation_errors(); 
			
			$this->load->view('register',$data);
			
		}
	}
	
	public function cajax_email($universal=false)
	{
		// CEK VALIDASI EMAIL
		$ema = "email";
		$this->load->library("check_data");
		if($universal) $ema = "email_agentsea";
		$email = $this->input->post($ema);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		$info['value'] = "true";
		
		//$info and $value
		
		$this->form_validation->set_rules($ema,"Email","valid_email|xss_clean|min_length[6]");
		
		$check_email = $this->check_data->check_email($email);
		$cajax_email = $this->company_model->cajax_email($email);
		$cajax_genemail = $this->company_model->cajax_genemail($email); // generic
		
		if($this->form_validation->run() == false)
		{
			$info['email'] = validation_errors();	
			$info['value'] = "false";
		}
		else if($cajax_email > 0 || $check_email == FALSE)
		{
			$info['email'] = " Email already exists ";
			$info['value'] = "false";
		}
		else if(!empty($cajax_genemail))
		{
			$info['email'] = " Click link below to use free email address ";
			$info['value'] = "false";
			
		}
		else
		{
			$info['email'] = " Email available ";
			$info['value'] = "true";
		}
		
		// return JSON
		$a = array("info" =>  $info['email'],"value" => $info['value']);
		
		$x = $this->input->post("x");
		if($x == 1)
		{
			echo json_encode($a);
		}else
		{
			return json_encode($a);
		}
		
	}
	
	function check_username_company($universal=false)
	{
		
		$taw = "<li>";
		$tak = "</li>";
		$usr = "username_reg";
		$ema = "email";
		if($universal){
			$usr = "username_agentsea";
			$ema = "email_agentsea";
		}
		$name_post	  = $this->input->post($usr);
		$username 	   = $this->company_model->check_company($name_post);
		
		$email_post	 = $this->input->post($ema);
		$email 		  = $this->company_model->check_email($email_post);
		//print_r($username);
		//var_dump($username);			
		
		if($name_post == "" && $email_post == "") {
			$info['username'] = "$taw username can't be empty $tak"; // kosongkan karena akan dijalankan saat pertama kali load form 
			$info['email'] 	= "$taw email can't be empty $tak"; // kosongkan karena akan dijalankan saat pertama kali load form 
			$nilai['email']    = "false";
			$nilai['username'] = "false";
		} else {
			if (empty($username)) {
				$info['username']  = "";
				$nilai['username'] = "true"; 
			} else {
				$info['username']  = "$taw this username has been used $tak ";
				$nilai['username'] = "false";
			}
			
			if (empty($email)) {
				$info['email']  = "";
				$nilai['email'] = "true"; 
			} else {
				$info['email']  = "$taw this email has been used $tak";
				$nilai['email'] = "false";
			}
			
			
		}
		
		$arr = array('info'=>array('email'=>$info['email'],'username'=>$info['username']),
					 'nilai'=>array('email'=>$nilai['email'],'username'=>$nilai['username']));
	
					 
		return $arr;
		
	}
	
	// delete cookie 
	public function change_cusername()
	{
		clear_cookie_company();
		
		$this->load->helper('list_error_users_helper');
		
		
		$login_attemp = $this->input->get("login_attemp",true); // int
		$new_login_attemp = $login_attemp + 1;
		
		//$data['show_modal'] 	 = 1;
		$data['err'] 			= md5(1);
		$data['u']			  = !empty($f_cu) ? "t" : "f";
		$data['a']			  = !empty($f_ca) ? "t" : "f";
		
		header("location:".base_url("users/login/agentsea?login_attemp=$new_login_attemp"));
		
	}
	
	function send_activation_code()
	{
		
		$username = $this->input->post('username_lg');
		
		/* kondisi klo username ada tp pass salah */
		$str_cu = "select * from perusahaan where username = '$username'";
		$q_cu   = $this->db->query($str_cu);
		$f_cu   = $q_cu->row_array();
		
		$data_user = array(
			  "username"	 		=> $f_cu['username'],
			  "nama_perusahaan"     => $f_cu['nama_perusahaan'],
			  "contact_person"      => $f_cu['contact_person'],
			  "email"			   => $f_cu['email'],
			  "password"	 		=> $f_cu['password'],
			  "activation"   		  => $f_cu['activation'],
			);
		
		$this->send_email($data_user);
		//$this->clear_cookies(); // sesudah kirim email, hapus dahulu cookie nya 
		
		// harus diganti gambarnya dengan yg real dari database
		$url = base_url("assets/img/img_default.png");
		$url_cover = base_url("assets/img/blur-background09.jpg");
		
		$data_cookie = array(
					
			"company_name"     => $data_user['nama_perusahaan'],
			"photo_company"    => $url,
			"username_company" => $data_user['username'],
			"cover_company"    => $url_cover,
			"success_company"  => "<div class='alert alert-success'> The Activation Code has been send to your email,  <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>"
		
		);
		define_cookie_company($data_cookie);
		
		header("location:".base_url("users/login/agentsea"));
		
	}
	
	function send_email($user)
	{
		
		/*
			$data_user = array(
			  "username"	 		=> $username,
			  "nama_perusahaan"     => $nama_perusahaan,
			  "contact_person"      => $contact_person,
			  "email"			   => $email,
			  "password"	 		=> md5($password),
			  "activation"   		  => $f_user['activation']
			);
		*/
		
		if(empty($user))
		{
			// sesuatu dari login
			$username = $this->input->post("username_lg"); // ? kenapa ini ada 
	
			$user = $this->user_model->check_nauser($username);
			
			
			$data['nama_perusahaan'] = $user['nama_perusahaan'];
			$data['contact_person']  = $user['contact_person'];
			$data['username']		= $user['username'];
			$data['password']		= $user['password'];
			$data['email']	   	   = $user['email'];
			$data['activation']	  = $user['activation'];
			$data['str_url'] 	 = 
			// base_url("users/company_process/activate2017/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			base_url("users/company_process/activate2017/?x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			// ganti ke activate2017
			
		}
		else
		{
			$data['nama_perusahaan'] = $user['nama_perusahaan'];
			$data['contact_person']  = $user['contact_person'];
			$data['username']		= $user['username'];
			$data['password']		= $user['password'];
			$data['email']	   	   = $user['email'];
			$data['activation']	  = $user['activation'];
			$data['str_url'] 	 = 
			// base_url("users/company_process/activate2017/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			base_url("users/company_process/activate2017/?x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			// ganti ke activate2017
		}
		
		// buat email 
		$this->load->library('email');
		
		// set email config
		// set email config
		$config = array();
		$config['protocol'] = 'smtp';
		$config['mailtype'] = 'html';
		$config['priority'] = '1';
		$config['wordwrap'] = FALSE;
        $config['smtp_host'] = 'ssl://mail.informasea.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'info@informasea.com';
        $config['smtp_pass'] = 'uA8Q_MOh%%Ol';
		// $config_email['smtp_user'] = 'dummybadr@yahoo.co.id';
        // $config_email['smtp_pass'] = 'gantengganteng';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = "html";
		$this->email->initialize($config);
		//exit('email_jalan');
		
		$this->email->from($config['smtp_user'], 'informasea.com');
		$this->email->to($user['email']); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('informasea.com Confirmation Account');
		$my['content_template'] = $this->load->view("users/email/template_2016/email-activation-agentsea", $data, true);
		$content = $this->load->view("template_email2016/new_email_template", $my, true);
		// $content = $this->load->view('users/email2',$data,true);
		$this->email->message($content);
		
		// $contenti = $this->load->view('users/email',$data,true);
		$contenti = $this->load->view("template_email2016/new_email_template", $my, true);
		$this->email->set_alt_message($contenti);	
	
		$this->email->send();
		
		
		//echo $this->email->print_debugger();
		
	}
	
	function forgotpass()
	{
		$g_captcha_response = $_POST['g-recaptcha-response'];
		
		$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);
		   
		$this->load->library('form_validation');
		
		$email = $this->input->post('email',true);
		$this->form_validation->set_rules('email',"Email","valid_email|required");
		
		if($this->form_validation->run() == true && $response['success'] == true)
		{
		  // email harus active 
		  $check_activation = $this->company_model->check_activation_code($email);
		  
		  if(!empty($check_activation))
		  {
			  
			  // create new password
			  $new_pass = mt_rand(100000,999999);
			  
			  // set new pass
			  $forgot_pass = $this->company_model->forgot_pass($new_pass,$email);
			  
			  //send_email
			  $data_user = array(
				"username"	 => $check_activation['username'],
				"contact_person" => $check_activation["contact_person"],
				"email"		=> $check_activation['email'],
				"password"	 => $new_pass
				
			  );
			  
			  //print_r($data_user); exit;
			  
			  // send email
			  $this->send_email_pass($data_user);
			  
			  $data_cookie = array(
					  
					  "success"  => "<div class='alert alert-success'> Congratulation! we are sending your new password to your email </div>"
			  );
			  
			  $this->session->set_flashdata("success",$data_cookie['success']);
			  
			  
		  }
		  else
		  {
			  $data_cookie['error'] = "<div class='alert alert-warning'> your email has not valid, please input a valid email </div>"; 
			  $this->session->set_flashdata("error",$data_cookie['error']);	
		  }
			  
		  // halaman login dengan header pengguna
		  header("location:".base_url("users/forgotpass/agentsea")); 	  
		}
		else
		{
		  $data_cookie['error'] = "<div class='alert alert-warning'> Data Validation Error </div>";
		  $this->session->set_flashdata("error",$data_cookie['error']);
		  // output
		  header("location:".base_url("users/forgotpass/agentsea"));
		}
	}
	
	private function send_email_pass($user)
	{
		/*
			$data_user = array(
			  "username"	 		=> $username,
			  "nama_perusahaan"     => $nama_perusahaan,
			  "contact_person"      => $contact_person,
			  "email"			   => $email,
			  "password"	 		=> md5($password),
			  "activation"   		  => $f_user['activation']
			);
		*/
		
		if(empty($user))
		{
			// sesuatu dari login
			$username = $this->input->post("username_lg"); // ? kenapa ini ada 
	
			$user = $this->user_model->check_nauser($username);
			
			
			$data['nama_perusahaan'] = $user['nama_perusahaan'];
			$data['contact_person']  = $user['contact_person'];
			$data['username']		= $user['username'];
			$data['password']		= $user['password'];
			$data['email']	   	   = $user['email'];
			
			
		}
		else
		{
			$data['nama_perusahaan'] = $user['nama_perusahaan'];
			$data['contact_person']  = $user['contact_person'];
			$data['username']		= $user['username'];
			$data['password']		= $user['password'];
			$data['email']	   	   = $user['email'];
			
		}
		
		// buat email 
		$this->load->library('email');
		
		// set email config
		// set email config
		$config = array();
		$config['protocol'] = 'smtp';
		$config['mailtype'] = 'html';
		$config['priority'] = '1';
		$config['wordwrap'] = FALSE;
        $config['smtp_host'] = 'ssl://mail.informasea.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'info@informasea.com';
        $config['smtp_pass'] = 'uA8Q_MOh%%Ol';
		// $config_email['smtp_user'] = 'dummybadr@yahoo.co.id';
        // $config_email['smtp_pass'] = 'gantengganteng';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = "html";
		$this->email->initialize($config);
		//exit('email_jalan');
		
		$data["config"] = $config;
		$data["email_to"] = $user["email"];
		
		$this->email->from($config['smtp_user'], 'informasea.com');
		$this->email->to($user['email']); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('informasea.com New Password');
		
		$content = $this->load->view('users/forgotpass-company/email/forgotpassmail',$data,true);
		$this->email->message($content);
		
		$contenti = $this->load->view('users/forgotpass-company/email/forgotpassmail2',$data,true);
		$this->email->set_alt_message($contenti);	
	
		$this->email->send();
		
		
		//echo $this->email->print_debugger();
		
	}

	function activate_process()
	{
		$ajax = $this->input->post("x");
		if(!$ajax) show_404();
		
		$ext_num = $this->input->post("ext_num");
		
		$pecah = explode('&', $ext_num);
		$kode_telp = $pecah[0];
		$id_nationality = $pecah[1];
		
		$phone_number = $this->input->post("phone_number");
		$contact_person = $this->input->post("contact_person");
		$id_perusahaan = $this->input->post("id_agentsea");
		
		$q = "select name,id from nationality where id = '$id_nationality'";
		$exec = $this->db->query($q);
		$hasil = $exec->row_array();
		
		$q = "update perusahaan set contact_person = '$contact_person', id_nationality = '$hasil[id]', nationality = '$hasil[name]', no_telp = '$kode_telp - $phone_number' where id_perusahaan = '$id_perusahaan'";
		
		$this->db->query($q);

		//echo "0|Your Account completely Active Welcome to Informasea.com. |success";
		
		$response["int"] = 0;
		$response["message"] = "Your Account completely Active Welcome to Informasea.com.";
		$response["status"] = "status";
		
		echo json_encode($response);
		
	}
	
	function activate2017()
	{
		//di proses di halaman email
		
		//authentification
		$this->authentification->open_access();
		
		$a = $this->input->get('a',true);
		$e = $this->input->get('email',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);
		
		// check di database
		$f = $this->user_model->check_activation_company();
		 
		if(!empty($f))
		{
			// tidak perlu proses aktivasi karena sudah aktif
			// yang ada hanyalah proses VALIDASI EMAIL
			//$this->user_model->update_activation_company($e);
			$this->user_model->update_activation_company2017($e);
			
			// halaman login dengan header pengguna

			$str_cu = "select * from perusahaan where email = '$e'";
			$q_cu   = $this->db->query($str_cu);
			$f_cu   = $q_cu->row_array();
			
			$data_user = array(
			  "username"	 => $f_cu['username'],
			  "first_name"   => $f_cu['nama_perusahaan'],
			  "email"		=> $f_cu['email'],
			  "password"	 => $f_cu['password'],
			  "activation"   => $f_cu['activation_code']
			);
			
			clear_cookie_company(); // clear cookie
			
			$url 	   = check_logo_agentsea($data_user['username']);
			$url_cover = check_cover_agentsea($data_user['username']);
			
			$data_cookie = array(
					"company_name"     => $f_cu['nama_perusahaan'],
					"contact_person" => $f_cu['contact_person'],
					"photo_company"    => $url,
					"username_company" => $data_user['username'],
					"cover_company"	=> $url_cover,
					"success_company"  => "<div class='alert alert-success'> Congratulation! you already activated your account at informasea.com, please login to use our feature at informasea.com </div>"
			);
			define_cookie_company($data_cookie);
			
			
			// halaman login dengan header pengguna
			//header("location:".base_url("users/activate_agentsea/?a=$a&email=$e&x=$x&u=$u&p=$p")); //harus dari register_all
			header("location:".base_url("users/login/agentsea"));

		}
		else
		{
			show_404();	
		}
		
	}
	
	function activate()
	{
		//di proses di halaman email
		
		//authentification
		$this->authentification->open_access();
		
		$a = $this->input->get('a',true);
		$e = $this->input->get('email',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);
		
		// check di database
		$f = $this->user_model->check_activation_company();
		 
		if(!empty($f))
		{
			
			$this->user_model->update_activation_company($e);
			
			// halaman login dengan header pengguna

			$str_cu = "select * from perusahaan where email = '$e'";
			$q_cu   = $this->db->query($str_cu);
			$f_cu   = $q_cu->row_array();
			
			$data_user = array(
			  "username"	 => $f_cu['username'],
			  "first_name"   => $f_cu['nama_perusahaan'],
			  "email"		=> $f_cu['email'],
			  "password"	 => $f_cu['password'],
			  "activation"   => $f_cu['activation_code']
			);
			
			clear_cookie_company(); // clear cookie
			
			$url = check_logo_agentsea($data_user['username']);
			$url_cover = check_cover_agentsea($data_user['username']);
			
			$data_cookie = array(
					"company_name"     => $f_cu['nama_perusahaan'],
					"contact_person" => $f_cu['contact_person'],
					"photo_company"    => $url,
					"username_company" => $data_user['username'],
					"cover_company"	=> $url_cover,
					"success_company"  => "<div class='alert alert-success'> Congratulation! you already activated your account at informasea.com, please login to use our feature at informasea.com </div>"
			);
			define_cookie_company($data_cookie);
			
			// halaman login dengan header pengguna
			header("location:".base_url("users/activate_agentsea/?a=$a&email=$e&x=$x&u=$u&p=$p")); //harus dari register_all
			//header("location:".base_url("users/login/agentsea"));

		}
		else
		{
			show_404();	
		}
	}
	
	function register()
	{
		session_start();
		/* $g_captcha_response = $_POST['g-recaptcha-response'];
		
		$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);
		//var_dump($response);*/
		
		$this->load->library("form_validation");
		$this->load->model('nation_model');
		
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		
		$username 		= $this->input->post("username"		   ,true);
		$nama_perusahaan = $this->input->post("nama_perusahaan"	,true);
		$contact_person  = $this->input->post("contact_person"	 ,true);
		
		$ext_num		 = $this->input->post("ext_num"			,true);
		$phone_number    = $this->input->post("phone_number"	   ,true);
		$a	 		   = explode("&",$ext_num);
		$nationality 	 = $this->nation_model->get_detail_nationality($a[1]); 
		
		$role			= $this->input->post("role"			   ,true);
		
		//$nationality 	 = $this->input->post("nationality"		,true);
		
		$email 		   = $this->input->post("email"			  ,true);
		$reemail		 = $this->input->post("reemail"			,true);
		
		$password		= $this->input->post("password"		   ,true);
		$repassword	  = $this->input->post("repassword"		 ,true);
		
		$this->form_validation->set_rules("username",		"Username","required|xss_clean|min_length[6]|alpha_dash");
		$this->form_validation->set_rules("ext_num",		 "Extention Number", "required|xss_clean");
		$this->form_validation->set_rules("phone_number",	"Phone Number","required|numeric|xss_clean");
		$this->form_validation->set_rules("role"		, 	"Role","required|xss_clean");
		$this->form_validation->set_rules("nama_perusahaan","Company Name","required|xss_clean"); 
		$this->form_validation->set_rules("contact_person", "Contact Person","required|xss_clean");
		
		$this->form_validation->set_rules('email',		   'Email','required|valid_email|xss_clean|min_length[6]');
		$this->form_validation->set_rules('password',		'Password','required|matches[repassword]|xss_clean|min_length[6]');
		
		$check = $this->check_username_company();
		$cajax_email = json_decode($this->cajax_email(),true);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->input->post("input_capt") == $_SESSION["captcha"])
		{  
		  if($this->form_validation->run() == false || $check['nilai']['username'] == "false" || $check['nilai']['email'] == "false" || $cajax_email['value'] == "false")
		  {			  
			  $session_set_value = $this->session->all_userdata();
		  
			  if($session_set_value['remember_me'] == 1){
				  header("location:".base_url("dashboard"));
			  }
			  
			  $user = $this->uri->segment(3);
			  
			  $data['head']	 = "head";
			  $data['title']	= "Register as Agentsea";	
			  $data['css']	  = "css"; //css tambahan, di head
			  $data['meta']	 = "meta"; // meta tambahan, di head
			  $data['js_top']   = "js_top"; // js tambahan, di head
			  			  
			  $data['template'] = "register-agentsea";
			  $data['info'] 	 = $check['info']."<li>$cajax_email[info]<li>";
			  $data['ve']       = validation_errors("<div>","</div>"); 
			  $data['footer']   = "footer";
			  $data['js_under'] = "js_under"; 
			  
			  $this->load->view('register',$data);
		  
		  }
		  // KONDISI ISIAN BENAR
		  else 
		  {
			  $this->company_model->register_company(); // tidak boleh dalam keadaan comment
			  
			  /*if($role == "manager")
			  {
			 	 $this->company_model->register_company(); // tidak boleh dalam keadaan comment
			  }
			  else if($role == "agent")
			  {
				 $this->company_model->register_agent(); // tidak boleh dalam keadaan comment
			  }*/
			  
			 
			  // ambil data yang ada di database
			  $str_user = "select * from perusahaan where username = '$username' ";
			  $q_user   = $this->db->query($str_user);
			  $f_user   = $q_user->row_array(); 
			  
			  /*
			  $data_user = array(
				"username"	 		=> $username,
				"nama_perusahaan"     => $nama_perusahaan,
				"contact_person"      => $contact_person,
				"email"			   => $email,
				"password"	 		=> md5($password),
				"activation"   		  => $f_user['activation']
			  );*/
			  
			  // kirim email ke admin@informasea.com dan rifalqori@informasea.com
			  $this->load->library("my_email");
			  
			  $content_email = "
			  	<h2> New Agentsea has been register </h2>
				<div> Company : $nama_perusahaan </div>
				<div> Contact Person : $contact_person </div>
				<div> Email : $email </div>
			  ";
			  
			  $content = array(
		
				  "subject" 		=> "test class email",
				  "subject_title"  => "informasea.com",
				  "to" 			 => array("admin@informasea.com","rifalqori@informasea.com"),
				  "message" 		=> "template_email2016/new_email_template", // path message
				  "data"		 => array("content_template" => $content_email),
	  
				  "mv" 			 => true,
				  "amv" 			=> FALSE
				  
			  );
			  
			  $user = "info";
			  
			  $this->my_email->send_email($user,$content);
			 
			 
			  
			  // kirim email, activation code
			  /* $this->send_email($data_user);
			  
			  $check_nauser = $this->company_model->check_nacompany($username); // check user tidak active
			  //exit(print_r($check_nauser));
			  
			  $url = base_url("assets/img/img_default.png");
			  $url_cover = base_url("assets/img/blur-background09.jpg");
			  
			  $data_cookie = array(
					
				"company_name"     => $data_user['nama_perusahaan'],
				"photo_company"    => $url,
				"username_company" => $data_user['username'],
				"cover_company"    => $url_cover,
				"success_company"  => "<div class='alert alert-success'> The Activation Code has been send to your email,  <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>"
		
			  );
			  define_cookie_company($data_cookie);
			  */
			  
			  //tracker kunglaw 2016
			  track_agentsea($f_user["id_perusahaan"],"register");
			  
			  // HARUSS REDIRECTTT !!!				
			  header("location:".base_url("users/verified_page"));
			  
			  /*$data['success']  = "<div class='alert alert-success'> Congratulations, you already registered at informasea.com. we're already send confirmation data to your email at <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>";
			  
			  $this->load->view('register',$data);*/
		  }
		}
		else
		{
			$data['title'] 	= "Registration";
			$data['template'] = "register-agentsea";
			$data['css']   	  = "css";
			$data['meta']  	 = "meta";
			$data['js_top']   = "js_top"; // js tambahan, di head
			  
			//include
			//$data['navbar']   = "";		
			//$data['rwnation'] = $this->nation_model->get_nationality();
			//$check = $this->check_username();
			$data['ve'] 			= "You Must Entered a Right Captcha Text";
			  
			$data['template'] = "register-agentsea";
			
			$data['footer']   = "footer";
			$data['js_under'] = "js_under"; 
		
			
			$this->load->view('register',$data);
		}
	}

	function admin_decission()
	{
		echo $this->uri->segment(4);
		echo $this->uri->segment(5);
	}

	function register_process_all()
	{
		session_start();
		/* $g_captcha_response = $_POST['g-recaptcha-response'];
		
		$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);
		//var_dump($response);*/
		
		$this->load->library("form_validation");
		$this->load->model('nation_model');
		
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		
		$username 		= $this->input->post("username_agentsea"		   ,true);
		// $nama_company 		= $this->input->post("nama_agentsea"		   ,true);
		// $nama_perusahaan = $this->input->post("nama_perusahaan"	,true);
		// $contact_person  = $this->input->post("contact_person"	 ,true);
		
		// $ext_num		 = $this->input->post("ext_num"			,true);
		// $phone_number    = $this->input->post("phone_number"	   ,true);
		// $a	 		   = explode("&",$ext_num);
		// $nationality 	 = $this->nation_model->get_detail_nationality($a[1]); 
		
		// $role			= $this->input->post("role"			   ,true);
		
		//$nationality 	 = $this->input->post("nationality"		,true);
		
		$email 		   = $this->input->post("email_agentsea"			  ,true);
		// $reemail		 = $this->input->post("reemail"			,true);
		
		$password		= $this->input->post("password_agentsea"		   ,true);
		// $repassword	  = $this->input->post("repassword"		 ,true);
		
		$this->form_validation->set_rules("username_agentsea",		"Username","required|xss_clean|min_length[6]|alpha_dash");
		$this->form_validation->set_rules("nama_agentsea",			"Company Name","required|xss_clean");
		$this->form_validation->set_rules("ext_num_agentsea",		 "Extention Number", "required|xss_clean");
		$this->form_validation->set_rules("phone_number_agentsea",	"Phone Number","required|numeric|xss_clean");
		$this->form_validation->set_rules("website",				  "Website"	,"required");
		// $this->form_validation->set_rules("role"		, 	"Role","required|xss_clean");
		// $this->form_validation->set_rules("nama_perusahaan","Company Name","required|xss_clean"); 
		// $this->form_validation->set_rules("contact_person", "Contact Person","required|xss_clean");
		
		$this->form_validation->set_rules('email_agentsea',		   'Email','required|valid_email|xss_clean|min_length[6]');
		$this->form_validation->set_rules('password_agentsea',		'Password','required|xss_clean|min_length[6]');
		
		$check = $this->check_username_company(true);
		// print_r($check);
		$cajax_email = json_decode($this->cajax_email(true),true);
		// echo $cajax_email;
		// print_r($cajax_email);
		// echo $_SESSION["captcha"]." and ".$this->input->post("input_capt");
		// print_r($check);
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->input->post("input_capt") == $_SESSION["captcha"])
		{  
		  if($this->form_validation->run() == false || $check['nilai']['username'] == "false" || $check['nilai']['email'] == "false" || $cajax_email['value'] == "false")
		  {			  
			  $session_set_value = $this->session->all_userdata();
		  
			  if($session_set_value['remember_me'] == 1){
				  header("location:".base_url("dashboard"));
			  }
			  
			  $user = $this->uri->segment(3);
			  
			  $response["message"] = validation_errors();
			  $response["status"]  = "error";
			  
			  echo json_encode($response);
		  }
		  // KONDISI ISIAN BENAR
		  else 
		  {
			  $this->company_model->register_company_all(); // tidak boleh dalam keadaan comment
			  
			  /*if($role == "manager")
			  {
			 	 $this->company_model->register_company(); // tidak boleh dalam keadaan comment
			  }
			  else if($role == "agent")
			  {
				 $this->company_model->register_agent(); // tidak boleh dalam keadaan comment
			  }*/
			  
			 
			  // ambil data yang ada di database
			  $str_user = "select * from perusahaan where username = '$username' ";
			  $q_user   = $this->db->query($str_user);
			  $f_user   = $q_user->row_array(); 
			  
			  
			  $data_user = array(
				"username"	 		=> $username,
				"nama_perusahaan"     => $nama_perusahaan,
				// "contact_person"      => $contact_person,
				"email"			   => $email,
				"password"	 		=> md5($password) 
				//"activation"   		  => $f_user['activation'] // feb 2017
			  );
			  
			  
			  // kirim email, activation code
			  $this->send_email($data_user);
			  
			  /*
			  $check_nauser = $this->company_model->check_nacompany($username); // check user tidak active
			  //exit(print_r($check_nauser));
			  
			  $url = base_url("assets/img/img_default.png");
			  $url_cover = base_url("assets/img/blur-background09.jpg");
			  
			  $data_cookie = array(
					
				"company_name"     => $data_user['nama_perusahaan'],
				"photo_company"    => $url,
				"username_company" => $data_user['username'],
				"cover_company"    => $url_cover,
				"success_company"  => "<div class='alert alert-success'> The Activation Code has been send to your email,  <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>"
		
			  );
			  define_cookie_company($data_cookie);
			  */
			  
			  // kirim email ke admin@informasea.com dan rifalqori@informasea.com
			  $this->load->library("my_email");
			  
			  $data['idnya'] 			= $f_user['id_perusahaan'];
			  $data['company_name'] 	 = $f_user['nama_perusahaan'];
			  $data['username_company'] = $username;
			  $data['email_company'] 	= $email;
			  $content_email 			= $this->load->view("users/email/approval_agentsea_by_admin", $data, true);
			  
			  $content = array(
		
				  "subject" 		=> "New Agentsea registered",
				  "subject_title"  => "informasea.com",
				  "to" 			 => array("admin@informasea.com","alhusna901@gmail.com","soesetyo@informasea.com","rifalqori@informasea.com"),
				  "message" 		=> "template_email2016/new_email_template", // path message
				  "data"		   => array("content_template" => $content_email),
	  
				  "mv" 			 => true,
				  "amv" 			=> FALSE
				  
			  );
			  
			  $user = "info";
			  
			  $this->my_email->send_email($user,$content);
			  
			  //tracker kunglaw 2016
			  track_agentsea($f_user["id_perusahaan"],"register_all");
			  
			  // echo "Congratulations, you already registered at informasea.com. we're already send confirmation data to your email at $email. please confirm the activation code to your email to complete registration|success";
			  
			  $a = $f_user['activation'];
			  $e = $email;
			  $x = "x";
			  $u = $username;
			  $p = md5($password);
			  
			  $response["a"]	   = $a;
			  $response["e"]	   = $e;
			  $response["x"]	   = $x;
			  $response["u"]	   = $u;
			  $response["p"]	   = $p;
			  
			  $response["message"] = "Thank you for signing up.
				Please wait a moment, we will verified your account then send you activation code.
				Check your inbox or spam folder and activate your account.";
			  $response["status"] =  "success";
			  
			  echo json_encode($response);
			  
			  // HARUSS REDIRECTTT !!!				
			  // header("location:".base_url("users/verified_page"));
			  
			  /*echo $data['success']  = "<div class='alert alert-success'> Congratulations, you already registered at informasea.com. we're already send confirmation data to your email at <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>";
			  
			  $this->load->view('register',$data);*/
		  }
		}
		else
		{
			// $data['title'] 	= "Registration";
			// $data['template'] = "register-agentsea";
			// $data['css']   	  = "css";
			// $data['meta']  	 = "meta";
			// $data['js_top']   = "js_top"; // js tambahan, di head
			  
			//include
			//$data['navbar']   = "";		
			//$data['rwnation'] = $this->nation_model->get_nationality();
			//$check = $this->check_username();
			//echo $data['ve'] 			= "You Must Entered a Right Captcha Text";
			$response["message"] = "You must Entered a Right Captcha text";
			$response["status"]  = "error";
			echo json_encode($response);
			  
			// $data['template'] = "register-agentsea";
			
			// $data['footer']   = "footer";
			// $data['js_under'] = "js_under"; 
		
			
			// $this->load->view('register',$data);
		}
	}
		
		
	
	
}