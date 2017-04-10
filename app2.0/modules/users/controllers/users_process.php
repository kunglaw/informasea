<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class users_process extends MX_Controller{
	
	private $attemp=0;
	
	function __construct()
	{
		//authentification
		//echo "<pre>";
		parent::__construct();
		$this->authentification->open_access();
		
		$this->load->model('user_model');
		$this->load->model('company_model');
		
		$this->load->model('nation_model');
		$this->load->model("notifications/notifications_model");
		
        $this->load->library('form_validation');
        $this->load->helper('list_error_users_helper');
		
		$this->load->helper('user_cookie_helper');
		// define_cookie_seaman();
		// clear_cookie_seaman();
		// define_cookie_company();
		// clear_cookie_company();
	}

    public function login_process()
    {
        $this->processing_login();
    }

    /* Function buatan radit yang berfungsi untuk memproses login saat membuka halaman tertentu dan user belum login */
    function login_first_process()
    {
        $this->processing_login(true);
    }
	
	// cancel 
	function cancel_account()
	{
		$username = $this->input->get("username",TRUE);
		
		//check username	
		$str = "SELECT * FROM pelaut_ms WHERE username = '$username' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		if(!empty($f))
		{
			$str  = "UPDATE pelaut_ms SET activation = 'NOT OWNER' WHERE username = '$username' ";
			$q 	= $this->db->query($str);
			
			header("location:".base_url("users/login/seaman"));	
		}
		else
		{
			show_404();
		}
				
	}
	
	function login_universal()
	{
		// clear_cookie_seaman();
		// clear_cookie_company();	
		session_start();
		
		$username = filter((string)$this->input->post("username_lg",TRUE));
        $password = filter(md5((string)$this->input->post("password_lg")));
		
		$this->form_validation->set_rules('username_lg','Username','required|xss_clean');
        $this->form_validation->set_rules('password_lg','Password','required|xss_clean');
		
		// apakah username itu termasuk company/agentsea atau seaman
		$str_p = "select * from pelaut_ms where username = '$username' OR email = '$username' ";
		$q_p = $this->db->query($str_p);
		$f_p = $q_p->row_array();
		//print_r($f_p);
		
		$str_a = "select * from perusahaan where username = '$username' OR email = '$username' ";
		$q_a = $this->db->query($str_a);
		$f_a = $q_a->row_array();
		//print_r($f_a);
		
		$str_ag = "select * from agent_ms where username = '$username' OR email = '$username' ";
		$q_ag = $this->db->query($str_ag);
		$f_ag = $q_ag->row_array();
		
		if($this->form_validation->run() == TRUE)
        {			
			// PELAUT
			if(!empty($f_p)) // Jika username yang tertangkap adalah pelaut
			{
				$check 		= $this->user_model->login($username,$password); // check username active dan password benar dan password
            	$check_user   = $this->user_model->check_user($username); // check user active
            	$check_nauser = $this->user_model->check_nauser($username); // check user tidak active
				$check_blocked_user = $this->user_model->check_blocked_user($username);
				
				// KONDISI USERNAME DAN PASSWORD BENAR
				if(!empty($check[0]))
				{
					$this->attemp = 0;
					
					if($check['user'] == "pelaut")
					{
						$dt = array('id_user' => $check[0]['pelaut_id'],
							'username' 	 => $check[0]['username'],
							'email' 		=> $check[0]['email'],
							'user' 	 	 => $check['user'],
							'nama' 	 	 => $check[0]['nama_depan']." ".$check[0]['nama_belakang'],
							'type_user'	 => "pelaut"
						);
						
						// session untuk iFlyChat
						$pelaut_id 		  = $check[0]['pelaut_id'];
						$username_pelaut	= $check[0]['username'];

						$get_avatar 		 = $this->user_model->get_profile_pic($pelaut_id);
						$get_avatar2 		= explode(".", $get_avatar);
						$name_avatar 		= $get_avatar2[0];
						$type_file 		  = $get_avatar2[1];
						
						$_SESSION['username_agent']		= $check[0]['username'];
						$_SESSION['id_user2']			= $check[0]['pelaut_id'];
						$_SESSION['avatar_url']			= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
						// end iFlyChat
						
						$nama_user = $check[0]['nama_depan']." ".$check[0]['nama_belakang'];
	
						$this->session->set_userdata($dt);
						
						// tracker kunglaw 2016
						track_seatizen_login($check[0]['pelaut_id']);
						track_seatizen($check[0]['pelaut_id'],"login_universal"); // catat
						

						$this->notifications_model->resume_uncomplete($username_pelaut);
						
                        $this->notifications_model->expired_certificate($username_pelaut);
						
						
						if($login_first) 
						{ 
							echo "success||<div class='alert alert-success'>Welcome to Informasea $nama_user||$page</div>"; 
							
						} //user active, username salah pass salah; //user active, username benar pass benar
						
						else {
					
							header("location:".base_url("seaman/resume")); 
						
						 }
						//else header("location:".$page));
	
					}
					/*else if($check['user'] == "agent")
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
	
						//$data['show_modal'] = 1;
						$data['err']		= md5(1);
	
						if($login_first) echo "warning||<div class='alert alert-warning'>Sorry you're not register in informasea</div>";
						else{ 
							
							$dtt['redirect'] = base_url("users/login/?sm=1&err=$data[err]&c=2&
							login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]");
							$this->load->view("redirect-page",$dtt);
							
							header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&
							login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]")); 
						}
					}
				}
	
				// KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH
				else if(!empty($check_user))
				{
					session_start();
					//session untuk iFlyChat
					$pelaut_id 		  = $check_user['pelaut_id'];
					$username_pelaut	= $check_user['username'];

					$get_avatar 		 = $this->user_model->get_profile_pic($pelaut_id);
					$get_avatar2 		= explode(".", $get_avatar);
					$name_avatar 		= $get_avatar2[0];
					$type_file 			= $get_avatar2[1];
					
					$_SESSION['username_agent'] 	= $check_user['username'];
					$_SESSION['id_user2']			= $check_user['pelaut_id'];
					$_SESSION['avatar_url']			= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
					// end iFlyChat

					$data['err'] = md5(1);
	
					$this->load->model('photo/photo_mdl');
	
					$photo = $this->photo_mdl->get_photo_pp($check_user['username']);
					$cover = $this->photo_mdl->get_photo_cover($check_user['username']);
	
					$ss = explode(".",$photo['nama_gambar']);
					$url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);
	
					if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
					{
	
						$url = asset_url("img/img_default.png");
					}
	
					$url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);
	
					if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
					{
	
						$url_cover = asset_url("img/blur-background09.jpg");
					}
					
					$data_cookie = array(
						"name"     => $check_user['nama_depan']." ".$check_user['nama_belakang'],
						"photo"    => $url,
						"username" => $check_user['username'],
						"cover"	=> $url_cover,
					);
					define_cookie_seaman($data_cookie);
	
					// HARUSS REDIRECTTT !!!
					if($login_first) echo "warning||<div class='alert alert-warning'>The Username or Password you entered is incorrect</div>";
					else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
	
	
				}
	
				// KONDISI USERNAME belom ACTIVE dan PASSWORD benar atau SALAH
				else if(!empty($check_nauser))
				{
					$data['err'] = md5(2);
	
					//echo "check_nauser"; exit;
					$url = asset_url("img/img_default.png");
					$url_cover = asset_url("img/blur-background09.jpg");
					
					$data_cookie = array(
						"name"     => $check_nauser['nama_depan']." ".$check_nauser['nama_belakang'],
						"photo"    => $url,
						"username" => $check_nuser['username'],
						"cover"	=> $url_cover,
					);
					
					define_cookie_seaman($data_cookie);
	
					// HARUSS REDIRECTTT !!!
					//header("location:".base_url("users/formactivation/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				else if(!empty($check_blocked_user))
				{
					
					$data['err']		= md5(4);
					if($login_first) echo "failed||<div class='alert alert-danger'>Your Account has been blocked , please contact administrator </div>";
					else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
	
				// KONDISI USERNAME dan PASSWORD SALAH
				if(empty($check_user) && empty($check[0]) && empty($check_nauser) && empty($check_blocked_user))
				{
	
					// username and password are invalid
	
					$data['err']		= md5(1);
					if($login_first) echo "failed||<div class='alert alert-danger'>The Username or Password you entered is incorrect 1</div>";
					else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				
				
			}
			
			// PERUSAHAAN 
			else if(!empty($f_a))
			{
				
				$check_a 	   = $this->company_model->login($username,$password); // check username active dan password benar dan password
				$check_agent   = $this->company_model->check_company($username); // check company active
				$check_naagent = $this->company_model->check_nacompany($username); // check company tidak active
				
				// print_r($check_a);
				// die();exit();
				
				if(!empty($check_a[0]))
				{			
					// echo "masuk level 1";
					// die();exit();
				
					if($check_a['user'] == "company")
					{	
						// echo $check_a[0]['account_type']." : masuk dimarih ...";
						// die();
										
						$dt = array(
						
							'id_perusahaan' 	 => $check_a[0]['id_perusahaan'],
							'username_company'  => $check_a[0]['username'], 
							'email_perusahaan'  => $check_a[0]['email'], 
							'user_company' 	  => $check_a['user'], 
							'nama_perusahaan'   => $check_a[0]['nama_perusahaan'], 
							'type_user'		 => $check_a['user'],
							'contact_person' 	=> $check_a[0]['contact_person'],
							'official'		  => $check_a[0]['official'], 
							'account_type' 	  => $check_a[0]['account_type']
							
						);
						
						$this->session->set_userdata($dt);

						if ($remember_me) {
							// Set remember me value in session
							$this->session->set_userdata('remember_me', TRUE);
						}
						
						// tracker kunglaw 2016
						track_agentsea_login($check_a[0]['id_perusahaan']);
						track_agentsea($check_a[0]['id_perusahaan'],"login_universal"); // catat
						
						$location = "";
						if($check_a[0]['account_type'] == "Alpha"){
							
							// login
							
							$location = alpha_url("$dt[username_company]/welcome");
						}
						// else if($check_a[0]['account_type'] != "Alpha" AND $check_a[0]['tampil'] == 0){

						// 	$location = agent_url("$dt[username_company]/welcome");

						// }
						else{
							
							$this->session->set_userdata($dt);
						
							// locationnya harus beda 
							/*
								kalau local
								http://localhost/company.informasea/home
								
								kalau hosting
								informasea.com/company.informasea/home
							*/
							
							$location = base_url("agentsea/$dt[username_company]/home");
						}

						header("location: $location");
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
						$err = "$taw Username or password are invalid1 $tak ";
						
						//$data['show_modal'] = 1;
						$data['err']		= md5(1);
						
						header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
					}
					
				}
	
				// KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH v
				else if(!empty($check_agent))
				{
					//echo "KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH v"; exit;
					$data['err'] = md5(1);
	
					$this->load->model('photo/photo_mdl');
					
					$photo = $this->photo_mdl->get_photo_pp($check_agent['username']);
					$cover = $this->photo_mdl->get_photo_cover($check_agent['username']);
					
					$ss = explode(".",$photo['nama_gambar']);
					$url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);
					
					if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
					{
						
						$url = asset_url("img/img_default.png");
					}
					
					$url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);
					
					if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
					{
						
						$url_cover = asset_url("img/blur-background09.jpg");
					}
					
					$data_cookie = array(
						"company_name"     => $check_agent['nama_perusahaan'],
						"photo_company"    => $url,
						"username_company" => $check_agent['username'],
						"cover_company"	=> $url_cover,
					);
					define_cookie_company($data_cookie);
					
					// HARUSS REDIRECTTT !!!				
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
					
				}
				
				// KONDISI USERNAME belom ACTIVE dan PASSWORD benar
				else if(!empty($check_naagent))
				{
					$data['err'] = md5(2);
					
					//echo "check_nauser"; exit;
					$url = asset_url("img/img_default.png");
					$url_cover = asset_url("img/blur-background09.jpg");
					
					$data_cookie = array(
						"company_name"     => $check_agent['nama_perusahaan'],
						"photo_company"    => $url,
						"username_company" => $check_agent['username'],
						"cover_company"	=> $url_cover,
					);
					define_cookie_company($data_cookie);
					
					// HARUSS REDIRECTTT !!!				
					// header("location:".base_url("users/formactivation_agent/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				
				// KONDISI USERNAME dan PASSWORD SALAH  v
				else if(empty($check_agent) && empty($check_a[0]) && empty($check_naagent))
				{
					// username and password are invalid
					
					$data['err']		= md5(1);
									
					
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));	
				}
			}
			
			//AGENT
			else if(!empty($f_ag))
			{
				$login_agent = $this->company_model->login($username,$password);
				$check_agent = $this->company_model->check_agent($username);
				
				// Login agent benar	
				if(!empty($login_agent[0]))
				{
					//print_r($login_agent);
					//echo "<div>Perusahaan_id = $login_agent[0][perusahaan_id]</div>";
					$ccompany = $this->company_model->get_detail_company_byid($login_agent[0]['perusahaan_id']);
					//print_r($ccompany);
					
					$dt = array('id_perusahaan' => $login_agent[0]['perusahaan_id'],
					'username_agent' 		    => $login_agent[0]['username'], 
					'email_agent' 		  	   => $login_agent[0]['email'], 
					'user_company' 			  => $login_agent['user'],
					'account_type'			  => $ccompany['account_type'], 
					'type_user'				 => $login_agent['user'],
					'nama_perusahaan' 		   => $login_agent[0]['nama_perusahaan'], 
					'official'				  => $login_agent[0]['official'],
					'contact_person' 			=> $login_agent[0]['nama']); // nama agent
					
					//exit("<p> login_universal: </p>".print_r($dt));
					
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
	
					$this->load->model('photo/photo_mdl');
					
					$photo = $this->photo_mdl->get_photo_pp($check_a['username']);
					$cover = $this->photo_mdl->get_photo_cover($check_a['username']);
					
					$ss = explode(".",$photo['nama_gambar']);
					$url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);
					
					if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
					{
						
						$url = asset_url("img/img_default.png");
					}
					
					$url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);
					
					if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
					{
						
						$url_cover = asset_url("img/blur-background09.jpg");
					}
					
					//print_r($check_a); echo "<hr>";
					$data_cookie = array(
						"company_name"     => $check_a['nama_perusahaan'],
						"agent_name"	   => $check_agent['nama'],
						"photo_company"    => $url,
						"username_company" => $check_a['username'],
						"cover_company"	=> $url_cover,
					);
					
					//exit("<p> login_universal: </p>".print_r($data_cookie));
					define_cookie_company($data_cookie);
					
					// HARUSS REDIRECTTT !!!				
					header("location:".base_url("users/login/agentsea?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				else
				{
					// LOGIN UNIVERSAL FORM	
					// KONDISI ISIAN SALAH
					// username and password are invalid
	
					$data['err']		= md5(1);
					if($login_first) echo "failed||<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
					else header("location:".base_url("users/login_univ/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				}
				
			}
			
			else
			{
				// LOGIN UNIVERSAL FORM	
				// KONDISI ISIAN SALAH
				 // username and password are invalid

				$data['err']		= md5(1);
				if($login_first) echo "failed||<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
				else header("location:".base_url("users/login_univ/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				
			}
		}
		else
		{
			// KONDISI ISIAN SALAH
			// LOGIN UNIVERSAL FORM
			
			$data['err']		= md5(1);
			if($login_first) echo "failed||<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
			else header("location:".base_url("users/login_univ/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
		}
	
	}

    function processing_login($login_first=false){
		
        $new_login_attemp = $this->attemp++;
        $username = filter($this->input->post("username_lg",TRUE));
        $password = filter(md5($this->input->post("password_lg")));

        if(!$login_first) $page 	 = $this->input->post("page",TRUE);
        else {
            $dest = explode('-',$this->input->post("dest"));
            $page = base_url($dest[1]."/".$dest[0]);
            if($dest[2] != "" || $dest[2] != null){
            	$page = base_url($dest[2]."/".$dest[1]."/".$dest[0]);
            }
            // echo $page;
        }
        // echo $page; exit;
        $this->form_validation->set_rules('username_lg','Username','required|xss_clean');
        $this->form_validation->set_rules('password_lg','Password','required|xss_clean');
        $taw = "<p>";
        $tak = "</p>";

        if(!$login_first) {
            // TAMPILAN
            $data['title'] = "Registration";
            $data['template'] = "template";
            $data['js_top']	   = "js_top";
			$data['js_under']	   = "js_top";
            $data['css'] = "css";
            $data['meta'] = "meta";

            $data['rwnation'] = $this->nation_model->get_nationality();
            $data['rwuser'] = $this->user_model->get_pelaut();
            /* end TAMPILAN */
        }
		
        /* kondisi klo username ada tp pass salah */
        $str_cu = "select * from pelaut_ms where username = '$username'";
        $q_cu   = $this->db->query($str_cu);
        $f_cu 	  = $q_cu->row_array();

        /* kondisi klo username ada and pass bener */
        $str_ca = "select * from pelaut_ms where username = '$username' and password = '$password'";
        $q_ca   = $this->db->query($str_ca);
        $f_ca   = $q_ca->row_array();

        //$data['show_modal'] 	 = 1;
        //$data['err'] 			= md5(1);
        $data['u']			  = !empty($f_cu) ? "t" : "f";
        $data['a']			  = !empty($f_ca) ? "t" : "f";

        if($this->form_validation->run() == TRUE)
        {
            $check 		= $this->user_model->login($username,$password); // check username active dan password benar dan password
            $check_user   = $this->user_model->check_user($username); // check user active
            $check_nauser = $this->user_model->check_nauser($username); // check user tidak active
			$check_blocked_user = $this->user_model->check_blocked_user($username);

            // echo "<pre>";
            // print_r($check); 
            // echo "<br>";
            // print_r($check_user); 
            // echo "<br>";
            // print_r($check_nauser); 
            // echo "</pre>";
            // exit;

            // KONDISI USERNAME DAN PASSWORD BENAR
            if(!empty($check[0]))
            {
                $this->attemp=0;
                if($check['user'] == "pelaut")
                {
                    $dt = array('id_user' => $check[0]['pelaut_id'],
                        'username' 		=> $check[0]['username'],
                        'email' 		   => $check[0]['email'],
                        'user' 			=> $check['user'],
                        'nama' 			=> $check[0]['nama_depan']." ".$check[0]['nama_belakang']);

                    $nama_user = $check[0]['nama_depan']." ".$check[0]['nama_belakang'];

                    $this->session->set_userdata($dt);
					
					// tracker kunglaw 2016
					track_seatizen_login($check[0]['pelaut_id']);
					track_seatizen($check[0]['pelaut_id'],"login_universal"); // catat
					
					$this->notifications_model->resume_uncomplete($this->session->userdata('username'));
                    $this->notifications_model->expired_certificate($this->session->userdata('username'));
                    
                    
                    if($login_first)
					{ echo "success||<div class='alert alert-success'>Welcome to Informasea $nama_user</div>||$page"; } //user active, username salah pass salah; //user active, username benar pass benar
                    else { 
						// echo "saya tidak login dulu => $login_first == $page"; exit;
						// $dtt['redirect'] = $page; 
						// $this->load->view("redirect-page",$dtt);

						header("location:".base_url('seaman/resume')); 
						
					}

                }
                /*else if($check['user'] == "agent")
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

                    //$data['show_modal'] = 1;
                    $data['err']		= md5(1);

                    if($login_first) echo "warning||<div class='alert alert-warning'>Sorry you're not register in informasea</div>";
                    else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
                }
            }

            // KONDISI USERNAME ACTIVE BENAR tetapi PASSWORD SALAH
            else if(!empty($check_user))
            {
                $data['err'] = md5(1);

                
                $this->load->model('photo/photo_mdl');

                $photo = $this->photo_mdl->get_photo_pp($check_user['username']);
                $cover = $this->photo_mdl->get_photo_cover($check_user['username']);

                $ss = explode(".",$photo['nama_gambar']);
                $url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);

                if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
                {

                    $url = asset_url("img/img_default.png");
                }

                $url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);

                if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
                {

                    $url_cover = asset_url("img/blur-background09.jpg");
                }

                $data_cookie = array(
						"name"     => $check_user['nama_depan']." ".$check_user['nama_belakang'],
						"photo"    => $url,
						"username" => $check_user['username'],
						"cover"	=> $url_cover,
				);
				define_cookie_seaman($data_cookie);
				
                // HARUSS REDIRECTTT !!!
                if($login_first) echo "warning||<div class='alert alert-warning'>The Username or Password you entered is incorrect</div>";
                else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));


            }

            // KONDISI USERNAME belom ACTIVE dan PASSWORD benar atau SALAH
            else if(!empty($check_nauser))
            {
                $data['err'] = md5(2);

                $this->load->model('photo/photo_mdl');

                $photo = $this->photo_mdl->get_photo_pp($check_nauser['username']);
                $cover = $this->photo_mdl->get_photo_cover($check_nauser['username']);

                $ss = explode(".",$photo['nama_gambar']);
                $url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);

                if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
                {

                    $url = asset_url("img/img_default.png");
                }

                $url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);

                if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
                {

                    $url_cover = asset_url("img/blur-background09.jpg");
                }
				
				$data_cookie = array(
					"name"     => $check_nauser['nama_depan']." ".$check_nauser['nama_belakang'],
					"photo"    => $url,
					"username" => $check_nauser['username'],
					"cover"	=> $url_cover,
				);
				define_cookie_seaman($data_cookie);

                // HARUSS REDIRECTTT !!!
                header("location:".base_url("users/formactivation/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
            }
			
			else if(!empty($check_blocked_user))
			{
				$data['err']		= md5(4); 
                if($login_first) echo "failed||<div class='alert alert-danger'>Your Account has been Blocked </div>";
                else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));
				
			}
            // KONDISI USERNAME dan PASSWORD SALAH
            else if(empty($check_user) && empty($check[0]) && empty($check_nauser) && empty($check_blocked_user))
            {

                // username and password are invalid

                $data['err']		= md5(1);
                if($login_first) echo "failed||<div class='alert alert-danger'>The Username or Password you entered is incorrect</div>";
                else header("location:".base_url("users/login/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]&aa"));
            }
        }
        else
        {
            $data['err'] = md5(1);

            $user = $this->uri->segment(3);

            $data['head']	 = "head";
            $data['title']	= "Login as Seaman";
            $data['css']	  = "css"; //css tambahan, di head
            $data['meta']	 = "login/meta"; // meta tambahan, di head
            $data['js_top']   = "js_top"; // js tambahan, di head

            $data['navbar']   = "navbar-login";
            $data['template'] = "login/login.php";

            $data['footer']   = "footer";
            $data['js_under'] = "js_under";

            $data['desc']     = validation_errors();
            if($login_first) echo "not valid||<div class='alert alert-danger'>".$data['desc']."</div>";
            else $this->load->view('register',$data);


        }

    }
	// delete cookie 
	public function change_cusername()
	{
		
		clear_cookie_seaman();
			
		$this->load->helper('list_error_users_helper');
		
		$login_attemp = $this->input->get("login_attemp",true); // int
		$new_login_attemp = $login_attemp + 1;
		
		//$data['show_modal'] 	 = 1;
		$data['err'] 			= md5(1);
		$data['u']			  = !empty($f_cu) ? "t" : "f";
		$data['a']			  = !empty($f_ca) ? "t" : "f";
		
		header("location:".base_url("users/login/?login_attemp=$new_login_attemp"));
		
	}
	
	public function cajax_username()
	{
		// CEK VALIDASI USERNAME
		
		$username = $this->input->post("username");
		$cajax_username = $this->user_model->cajax_username($username);
		
		echo $cajax_username;
		
	}
	
	public function cajax_email()
	{
		// CEK VALIDASI EMAIL
		
		$email = $this->input->post("email");
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		
		$info['value'] = "true";
		
		$this->form_validation->set_rules('email',"Email","valid_email|xss_clean|min_length[6]");
		$cajax_email = $this->user_model->cajax_email($email);
		
		if($this->form_validation->run() == false)
		{
			$info['email'] = validation_errors();	
			$info['value'] = "false";
		}
		else if($cajax_email > 0)
		{
			$info['email'] = " Email already exists ";
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
	
	//cek username dan email
	public function check_username()
	{
		$taw = "<li>";
		$tak = "</li>";
		
		$this->load->library("check_data");
		
		$name_post	  = $this->input->post('username_reg');
		$username 	   = $this->check_data->check_username($name_post);
		
		$email_post	 = $this->input->post('email');
		$email 		  = $this->check_data->check_email($email_post);	
		
		if($name_post == "" && $email_post == "") {
			$info['username'] = "$taw username can't be empty $tak"; // kosongkan karena akan dijalankan saat pertama kali load form 
			$info['email'] 	= "$taw email can't be empty $tak"; // kosongkan karena akan dijalankan saat pertama kali load form 
			$nilai = "false";
		} else {
			if ($username == TRUE) {
				$info['username'] = "";
				$nilai['username'] = "true"; 
				//echo "kondisi 1 jalan <br> ";
			} else {
				$info['username'] = "$taw this username has been used $tak ";
				$nilai['username'] = "false";
				//echo "kondisi 2 jalan <br> ";
			}
			
			if ($email == TRUE) {
				$info['email'] = "";
				$nilai['email'] = "true"; 
				//echo "kondisi 3 jalan <br> ";
			} else {
				$info['email'] = "$taw this email has been used $tak";
				$nilai['email'] = "false";
				//echo "kondisi 4 jalan <br> ";
			}
			
			//print_r($nilai); exit;
		}
		
		$arr = array(
		  'info'=>array('username'=>$info['username'],'email' => $info['email']),
		  'nilai'=>array('username'=>$nilai['username'],'email' => $nilai['email'])
		);
		
		return $arr;
	}

	public function check_username_from_universal()
	{
		$taw = "<li>";
		$tak = "</li>";
		
		$this->load->library("check_data");
		
		$name_post	  = $this->input->post('username_seaman');
		$username 	   = $this->check_data->check_username($name_post);
		
		$email_post	 = $this->input->post('email_seaman');
		$email 		  = $this->check_data->check_email($email_post);	
		
		if($name_post == "" && $email_post == "") {
			$info['username'] = "$taw username can't be empty $tak"; // kosongkan karena akan dijalankan saat pertama kali load form 
			$info['email'] 	= "$taw email can't be empty $tak"; // kosongkan karena akan dijalankan saat pertama kali load form 
			$nilai = "false";
		} else {
			if ($username == TRUE) {
				$info['username'] = "";
				$nilai['username'] = "true"; 
				//echo "kondisi 1 jalan <br> ";
			} else {
				$info['username'] = "$taw this username has been used $tak ";
				$nilai['username'] = "false";
				//echo "kondisi 2 jalan <br> ";
			}
			
			if ($email == TRUE) {
				$info['email'] = "";
				$nilai['email'] = "true"; 
				//echo "kondisi 3 jalan <br> ";
			} else {
				$info['email'] = "$taw this email has been used $tak";
				$nilai['email'] = "false";
				//echo "kondisi 4 jalan <br> ";
			}
			
			//print_r($nilai); exit;
		}
		
		$arr = array(
		  'info'=>array('username'=>$info['username'],'email' => $info['email']),
		  'nilai'=>array('username'=>$nilai['username'],'email' => $nilai['email'])
		);
		
		return $arr;
	}
	
	public function logoutsos()
	{
		require '../informasea_asset/plugin/facebook-php-sdk-master/src/facebook.php';
		$facebook = new Facebook(array(
			   'appId'  => '1655530184684604',
			   'secret' => 'a8a9dba6baa508dde1df0d8977fa18da',
			   /* 'default_graph_version' => 'v2.4', */
			   // 'cookie' => true
		));
		
		//track kunglaw 2016
		$pelaut_id = $this->session->userdata("id_user");
		track_seatizen($pelaut_id,"logout");
		track_seatizen_logout($pelaut_id);
		
		$redir_url = base_url("users/users_process/logout");
		$facebook->destroySession();
	 	$logoutUrl = $facebook->getLogoutUrl(array('next'=>$redir_url));
		header("location:".$logoutUrl);
	}
	
	public function logout()
	{
		session_start();
		
		
		
		// $access_token = $facebook->getAccessToken();
		
		/* $facebook = new Facebook\Facebook([
		  'appId'  => '1655530184684604',
		  'secret' => 'a8a9dba6baa508dde1df0d8977fa18da',
		  'default_graph_version' => 'v2.4',
		]); */

		$user 			= $this->session->userdata("user");
		$user_company 	= $this->session->userdata("user_company");
		
		if ($user_company == "company" || $user_company == "agent") {
			
			$data 	= array(
					'session_id'		=> NULL,
					'ip_address'		=> NULL,
					'user_agent'		=> NULL,
					'last_activity'	 => NULL,
					'user_data'		 => NULL,
					'id_perusahaan' 	 => NULL,
					'username_company'  => NULL,
					'username_agent'	=> NULL,
					'email_agent'	   => NULL,
					'email_perusahaan'  => NULL,
					'user_company'	  => NULL,
					'nama_perusahaan'   => NULL,
					'contact_person'	=> NULL
			);
			
			//track kunglaw 2016
			$id_perusahaan = $this->session->userdata("id_perusahaan");
			
			if($id_perusahaan != "")
			{
				//echo "error";
				track_agentsea($id_perusahaan,"logout");
				track_agentsea_logout($id_perusahaan);
			}
			
			$this->session->unset_userdata($data);
			session_destroy();
			header("location:".base_url('home'));

		}elseif ($user == "pelaut") {
			
			$this->attemp=0;
			
			//track kunglaw 2016
			$pelaut_id = $this->session->userdata("id_user");
			track_seatizen($pelaut_id,"logout");
			track_seatizen_logout($pelaut_id);
			
			$dt = array('id_user' =>NULL,'username' => NULL, 'email' =>NULL, 'user' => NULL, 'nama' => NULL);
			$this->session->unset_userdata($dt);
			
			// clear_cookie_seaman();
			// clear_cookie_company();
			
			//$this->session->sess_destroy();
			
			session_destroy();
			header("location:".base_url("home"));
		}
		//$a = $this->session->all_userdata();
		//print_r($a);
	}
	
	function send_activation_code_for_universal()
	{
		$username = $this->input->post('username_seaman');
		
		$str_cu = "select * from pelaut_ms where username = '$username'";
		$q_cu   = $this->db->query($str_cu);
		$f_cu   = $q_cu->row_array();
		
		$data_user = array(
		  "username"	 => $f_cu['username'],
		  "first_name"   => $f_cu['nama_depan'],
		  "last_name"	=> $f_cu['nama_belakang'],
		  "email"		=> $f_cu['email'],
		  "password"	 => $f_cu['password'],
		  "activation"   => $f_cu['activation'],
		  "user_type"    => "seatizen"
		);
		
		$this->send_email($data_user);
		clear_cookie_seaman(); // sesudah kirim email, hapus dahulu cookie nya 
		
		$this->load->model('photo/photo_mdl');

		$photo = $this->photo_mdl->get_photo_pp($data_user['username']);
		$cover = $this->photo_mdl->get_photo_cover($data_user['username']);

		$ss = explode(".",$photo['nama_gambar']);
		$url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);

		if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
		{

			$url = asset_url("img/img_default.png");
		}

		$url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);

		if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
		{

			$url_cover = asset_url("img/blur-background09.jpg");
		}
		
		$data_cookie = array(
				"name"     => $f_cu['nama_depan']." ".$f_cu['nama_belakang'],
				"photo"    => $url,
				"username" => $data_user['username'],
				"cover"	=> $url_cover,
				"success"  => "<div class='alert alert-success'> The Activation Code has been send to your email,  <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>"
		);
		define_cookie_seaman($data_cookie);
		
		header("location:".base_url("users/login/seaman"));
		
	}

	function send_activation_code()
	{
		$username = $this->input->post('username_lg');
		
		$str_cu = "select * from pelaut_ms where username = '$username'";
		$q_cu   = $this->db->query($str_cu);
		$f_cu   = $q_cu->row_array();
		
		$data_user = array(
		  "username"	 => $f_cu['username'],
		  "first_name"   => $f_cu['first_name'],
		  "last_name"	=> $f_cu['last_name'],
		  "email"		=> $f_cu['email'],
		  "password"	 => $f_cu['password'],
		  "activation"   => $f_cu['activation'],
		  "user_type"	=> "seatizen"
		);
		
		$this->send_email($data_user);
		clear_cookie_seaman(); // sesudah kirim email, hapus dahulu cookie nya 
		
		$this->load->model('photo/photo_mdl');

		$photo = $this->photo_mdl->get_photo_pp($data_user['username']);
		$cover = $this->photo_mdl->get_photo_cover($data_user['username']);

		$ss = explode(".",$photo['nama_gambar']);
		$url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);

		if(empty($photo) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
		{

			$url = asset_url("img/img_default.png");
		}

		$url_cover = img_url("photo/$username/cover/".$cover['nama_gambar']);

		if(empty($cover) || !is_file(pathup("photo/$username/cover/".$cover['nama_gambar'])))
		{

			$url_cover = asset_url("img/blur-background09.jpg");
		}
		
		$data_cookie = array(
				"name"     => $f_cu['nama_depan']." ".$f_cu['nama_belakang'],
				"photo"    => $url,
				"username" => $data_user['username'],
				"cover"	=> $url_cover,
				"success"  => "<div class='alert alert-success'> The Activation Code has been send to your email,  <a href='#'>$email</a>. please confirm the activation code to your email to complete registration </div>"
		);
		define_cookie_seaman($data_cookie);
		
		header("location:".base_url("users/login/seaman"));
		
	}

	private function send_email_for_universal($user)
	{
		
		if(empty($user))
		{
			$username = $this->input->post("username_seaman");
	
			$user = $this->user_model->check_nauser($username);
			
			
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['password']	= $user['password']; // ini jangan di md5
			$data['email']	   = $user['email'];
			$data['str_url'] 	 = 
			base_url("users/activation/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			
		}
		else
		{
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['password']	= $user['password']; // jangan di md5 juga
			$data['email']	   = $user['email'];
			$data['str_url'] 	 = 
			base_url("users/activation/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
		}
		
		// buat email 
		$this->load->library('email');
		
		// set email config
		$config = array();
		$config['protocol']  = 'smtp';
		$config['mailtype']  = 'html';
		$config['priority']  = '1';
		$config['wordwrap']  = FALSE;
        $config['smtp_host'] = 'ssl://mail.informasea.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'info@informasea.com';
        $config['smtp_pass'] = 'uA8Q_MOh%%Ol';
		
		// set config ke page view
		$data['config'] = $config;
		// $config_email['smtp_user'] = 'dummybadr@yahoo.co.id';
        // $config_email['smtp_pass'] = 'gantengganteng';
		$config['charset']  = 'utf-8';
		$this->email->initialize($config);
		//
		//exit('email_jalan');
		
		$this->email->from($config['smtp_user'], 'informasea.com');
		$this->email->to($user['email']); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('informasea.com Confirmation Account');
		$my['content_template'] = $this->load->view("users/email/template_2016/email-activation-seatizen", $data, true);
		$content = $this->load->view("template_email2016/new_email_template", $my, true);
		// $content = $this->load->view('users/email2',$data,true);
		$this->email->message($content);
		
		$contenti = $this->load->view("template_email2016/new_email_template", $my, true);
		// $contenti = $this->load->view('users/email2',$data,true);
		$this->email->set_alt_message($contenti);	
	
		$this->email->send();
		
		
		//echo $this->email->print_debugger();
		
	}
	
	private function send_email($user)
	{
		
		if(empty($user))
		{
			$username = $this->input->post("username_lg");
	
			$user = $this->user_model->check_nauser($username);
			
			
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['password']	= $user['password']; // ini jangan di md5
			$data['email']	   = $user['email'];
			$data['str_url'] 	 = 
			base_url("users/users_process/activate/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			
		}
		else
		{
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['password']	= $user['password']; // jangan di md5 juga
			$data['email']	   = $user['email'];
			$data['str_url'] 	 = 
			base_url("users/users_process/activate/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
		}
		
		// buat email 
		$this->load->library('email');
		
		// set email config
		$config = array();
		$config['protocol']  = 'smtp';
		$config['mailtype']  = 'html';
		$config['priority']  = '1';
		$config['wordwrap']  = FALSE;
        $config['smtp_host'] = 'ssl://mail.informasea.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'info@informasea.com';
        $config['smtp_pass'] = 'uA8Q_MOh%%Ol';
		
		// set config ke page view
		$data['config'] = $config;
		// $config_email['smtp_user'] = 'dummybadr@yahoo.co.id';
        // $config_email['smtp_pass'] = 'gantengganteng';
		$config['charset']  = 'utf-8';
		$this->email->initialize($config);
		//
		//exit('email_jalan');
		
		$this->email->from($config['smtp_user'], 'informasea.com');
		$this->email->to($user['email']); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('informasea.com Confirmation Account');
		$my['content_template'] = $this->load->view("users/email/template_2016/email-activation-seatizen", $data, true);
		$content = $this->load->view("template_email2016/new_email_template", $my, true);
		// $content = $this->load->view('users/email2',$data,true);
		$this->email->message($content);
		
		$contenti = $this->load->view("template_email2016/new_email_template", $my, true);
		$this->email->set_alt_message($contenti);	
	
		$this->email->send();
		
		
		//echo $this->email->print_debugger();
		
	}
	
	// lanjutan dari forgot pass
	function send_email_pass($user)
	{
		if(empty($user))
		{
			$username = $user['username'];
	
			$user = $this->user_model->check_nauser($username);
			
			
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['email']	   = $user['email'];
			$data["str_url"]	 = $user["url"];
			// tanpa perlu activation code 
		}
		else
		{
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['email_to']	= $user['email'];
			$data["str_url"]	 = $user["url"];
			// tanpa perlu activation 
		}
		
		// buat email 
		$this->load->library("my_email");
		
		//user email
		$user_email  ="info";
		
		$config = $this->config->item($user_email);
		$data['content_template'] = $this->load->view("users/forgotpass/forgotpassmail", $data, true);
		$data['config'] = $config;
		
		$content = array(
				
			"subject" 	   => "Forgot Password",
			"subject_title" => "informasea.com",
			"to" 		  => $data["email_to"],
			"message" 	 => /*"users/forgotpass/forgotpassmail"*/"template_email2016/new_email_template", // message ini bukan path, jadi bukan load view
			"alt_message" => /*"users/forgotpass/forgotpassmail2"*/"template_email2016/new_email_template",
			"mv" 		  => TRUE,
			"amv" 		 => TRUE,
			"data" 		=> $data
			
		);
		
		$this->my_email->send_email($user_email,$content);
		
	}
	
	// change password , belum selesai
	function change_password() // process
	{
		$this->load->library("form_validation");
		$this->load->library("token");
		
		$email		 	 = $this->input->post("email_fr",true);
		$username		  = $this->input->post("username_fr",true);
		$new_password	  = $this->input->post("new_password",true);
		$retype_password   = $this->input->post("retype_new_password",true);
		$no_token		  = $this->input->post("no_token",true);
		
		$str_url  = "users/change_password/?";
		$str_url .= "x=1&"; 
		$str_url .= "u=$username&";
		$str_url .= "email=$check_activation[email]&";
		$str_url .= "t=$no_token";
		
		$bstr_url = base_url($str_url);
		
		$this->form_validation->set_rules("email_fr","Email","required|xss_clean|valid_email");
		$this->form_validation->set_rules("username_fr","Username","required|xss_clean");
		$this->form_validation->set_rules("no_token","Token","required|xss_clean");
		$this->form_validation->set_rules("new_password","New Password","required|xss_clean");
		$this->form_validation->set_rules("retype_new_password","Retype Password","required|xss_clean|matches[new_password]");
		
		$now = date("Y-m-d H:i:s");
		$data_token       = array("email"=>$email,"type_user"=>"pelaut","page"=>"forgotpass","expiry_date >"=>$now,"no_token"=>$no_token);  
		$check_token	  = $this->token->check_token($data_token);
		
		if($this->form_validation->run() == true && !empty($check_token))
		{
			 
		  $new_pass = md5($new_password);
		  $str  	  = "UPDATE pelaut_ms set password = '$new_pass' WHERE email = '$email' ";
		  $q		= $this->db->query($str);
		  
		  if($q)
		  {
			  // read_token
			  $data = $this->token->read_token($no_token);
			  
			  // hapus token
			  $this->token->delete_token($data);
			  
			  $hasil['info'] = "<div class='alert alert-success'> Update Password Success </div>";
			  $hasil['reload'] = "true";
			  
			  $this->session->set_flashdata('success',$hasil['info']);
			  header("location:".base_url("users/login"));
		  }
		  else
		  {
			  
			  $hasil['info'] = "<div class='alert alert-danger'> There is something wrong </div>";
			  $this->session->set_flashdata('error',$hasil['info']);
			  header("location:".base_url("users/change_password/?bstr_url"));
		  }
		  
		 
		}
		else
		{
			$hasil['info'] = "<div class='alert alert-danger'>".validation_errors()."</div>";
			$this->session->set_flashdata("error",$hasil['info']);	
			header("location:".base_url("users/change_password/?$bstr_url"));
			
		}
	}

	function activate_process(){
		// error_reporting(E_ALL);
		// session_start();
		$ajax = $this->input->post("x");
		if(!$ajax) show_404();
		
		$this->load->library("form_validation");
		
		$this->load->library("my_email");
		
		$email 	 = $this->input->post("email_seatizen");
		$username  = $this->input->post("username_seatizen");
		$f_name 	= $this->input->post("first_name");
		$l_name 	= $this->input->post("last_name");
		$nat 	   = $this->input->post("ext_num");
		$department = $this->input->post("dept_choice");
		$rank 	   = $this->input->post("rank_choice");
		
		//$this->form_validation->set_values("first_name","First Name","required|xss_clean");
		//$this->form_validation->set_values("last_name","Last Name","required|xss_clean");
		//$this->form_validation->set_values("ext_num","Extension Number","required|xss_clean");
		//$this->form_validation->set_values("dept_choice","Department","required|xss_clean");
		//$this->form_validation->set_values("rank_choice","Rank","required|xss_clean");
		//$this->form_validation->set_values("email_seatizen","Email","required|xss_clean");
		//$this->form_validation->set_values("username","Username","required|xss_clean");

		$str_cu = "select * from pelaut_ms where username = '$username'";
			$q_cu   = $this->db->query($str_cu);
			$f_cu   = $q_cu->row_array();
			
	    $kode_telp = explode('&', $nat)[0];
		$kode_negara = explode('&', $nat)[1];

		$q = "select * from nationality where id = '$kode_negara'";
		$exec = $this->db->query($q);
		$hasil = $exec->row_array();

		$str_delete = "DELETE FROM document_tr WHERE pelaut_id = '$f_cu[pelaut_id]' AND type_document = 'document' AND
		  	country = '$hasil[name]' AND bawaan = 1";
		  	$qqz = $this->db->query($str_delete);

		  		$ip_ad = $_SERVER['REMOTE_ADDR'];
		  	$str = "INSERT INTO document_tr (type,pelaut_id,ip_address,date_issued,datetime,type_document,country,bawaan) 
		  	VALUES ('Passport','$f_cu[pelaut_id]','$ip_ad','',now(),'document','$hasil[name]',1)";
		  	$qq = $this->db->query($str);
			
		  	$str2 = "INSERT INTO document_tr(type,pelaut_id,ip_address,date_issued,datetime,type_document,country,bawaan)
		  	VALUES ('Seaman Book','$f_cu[pelaut_id]','$ip_ad','',now(),'document','$hasil[name]',1)";
		  	$aa = $this->db->query($str2);
		
			
			$data_user = array(
			  "username"	 => $f_cu['username'],
			  "first_name"   => $f_cu['nama_depan'],
			  "last_name"	=> $f_cu['nama_belakang'],
			  "email"		=> $f_cu['email'],
			  "password"	 => $f_cu['password'],
			  "activation"   => $f_cu['activation']
			);
			
			clear_cookie_seaman(); // clear cookie
			
			$url = check_profile_seaman($data_user['username']);
			$url_cover = check_cover_seaman($data_user['username']);
			
			$data_cookie = array(
					"name"     => $f_cu['nama_depan']." ".$f_cu['nama_belakang'],
					"photo"    => $url,
					"username" => $data_user['username'],
					"cover"	=> $url_cover,
					"success"  => "<div class='alert alert-success'> Congratulation! you already activated your account at informasea.com, please login to use our feature at informasea.com </div>"
			);
			define_cookie_seaman($data_cookie);
			
			// send email
			
			$dt["name"] = $f_cu['nama_depan']." ".$f_cu['nama_belakang'];
			$dt["username"] = $f_cu["username"]; // kunglaw 26/08/2016
			$template = $this->load->view("email/template_2016/email-seatizen-active",$dt,TRUE);
			
			$content = array(
		
			  "subject" 		=> "Your account is activated, Please complete your resume here",
			  "subject_title"  => WEBSITE,
			  "to" 			 =>  $f_cu['email'], //ganti dengan email seatizen
			  "data" 		   => array("email_to"=> $f_cu['email'],"content_template"=>$template,"name"=>$data_user['first_name']." ".$data_user['last_name'],"user_type"=>"seatizen"),
			  
			  "message" 		=> "template_email2016/new_email_template",
			  "mv" 			 => TRUE
		
			);
			
			$user = "info";
			
			$data = $content["data"];
			$data["config"] = $this->config->item($user);
			
			
			$this->my_email->send_email($user,$content);
			
			// halaman login dengan header pengguna
			$dt = array('id_user' => $f_cu['pelaut_id'],
                        'username' 		=> $f_cu['username'],
                        'email' 		   => $f_cu['email'],
                        'user' 			=> 'pelaut',
                        'nama' 			=> $f_cu['nama_depan']." ".$f_cu['nama_belakang']);

                    $nama_user = $f_cu['nama_depan']." ".$f_cu['nama_belakang'];

                    $this->session->set_userdata($dt);
					
					// tracker kunglaw 2016
					track_seatizen_login($f_cu['pelaut_id']);
					track_seatizen($f_cu['pelaut_id'],"activation"); // catat
			$q = "update pelaut_ms set nama_depan = '$f_name', nama_belakang = '$l_name', kebangsaan = '$hasil[name]', activation = 'ACTIVE' where pelaut_id = '$f_cu[pelaut_id]' ";
			$this->db->query($q);

			$q = "insert into profile_resume_tr values ('$f_cu[pelaut_id]',0,0,0, $rank, '','',0,0,'',0, '$department','', now())";
			$this->db->query($q);
			echo "|Congratulation! you already activated your account at informasea.com|success";
	}
	
	function activate()
	{
		
		//authentification
		$this->authentification->open_access();
		$this->load->library("my_email");
		
		$a = $this->input->get('a',true);
		$e = $this->input->get('email',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);
		
		// check di database
		$f = $this->user_model->check_activation();
		
		// kondisi kalau data benar
		if(!empty($f))
		{
			// jika nama belum terisi 
			if(empty($f["nama_depan"]) || empty($f["nama_belakang"]))
			{
				$data['title'] = "Activation Step Seatizen";
				$this->load->view("step-activation-seatizen",$data);
			}
			else
			{
				$this->user_model->update_activation($e);
			
			/* kondisi klo username ada tp pass salah */ 
			$str_cu = "select * from pelaut_ms where username = '$u'";
			$q_cu   = $this->db->query($str_cu);
			$f_cu   = $q_cu->row_array();
			
			$data_user = array(
			  "username"	 => $f_cu['username'],
			  "first_name"   => $f_cu['first_name'],
			  "last_name"	=> $f_cu['last_name'],
			  "email"		=> $f_cu['email'],
			  "password"	 => $f_cu['password'],
			  "activation"   => $f_cu['activation']
			);
			
			clear_cookie_seaman(); // clear cookie
			
			$url = check_profile_seaman($data_user['username']);
			$url_cover = check_cover_seaman($data_user['username']);
			
			$data_cookie = array(
					"name"     => $f_cu['nama_depan']." ".$f_cu['nama_belakang'],
					"photo"    => $url,
					"username" => $data_user['username'],
					"cover"	=> $url_cover,
					"success"  => "<div class='alert alert-success'> Congratulation! you already activated your account at informasea.com, please login to use our feature at informasea.com </div>"
			);
			define_cookie_seaman($data_cookie);
			
			// send email
			
			$dt["name"] = $f_cu['nama_depan']." ".$f_cu['nama_belakang'];
			$template = $this->load->view("email/template_2016/email-seatizen-active",$dt,TRUE);
			
			$content = array(
		
			  "subject" 		=> "Your account is activated, Please complete your resume here",
			  "subject_title"  => WEBSITE,
			  "to" 			 =>  $f_cu['email'], //ganti dengan email seatizen
			  "data" 		   => array("email_to"=> $f_cu['email'],"content_template"=>$template,"name"=>$data_user['first_name']." ".$data_user['last_name'],"user_type"=>"seatizen"),
			  
			  "message" 		=> "template_email2016/new_email_template",
			  "mv" 			 => TRUE
		
			);
			
			$user = "info";
			
			$data = $content["data"];
			$data["config"] = $this->config->item($user);
			
			
			$this->my_email->send_email($user,$content);
			
			// halaman login dengan header pengguna
			// $dt = array('id_user' => $check[0]['pelaut_id'],
   //                      'username' 		=> $check[0]['username'],
   //                      'email' 		   => $check[0]['email'],
   //                      'user' 			=> $check['user'],
   //                      'nama' 			=> $check[0]['nama_depan']." ".$check[0]['nama_belakang']);

   //                  $nama_user = $check[0]['nama_depan']." ".$check[0]['nama_belakang'];

   //                  $this->session->set_userdata($dt);
					
			// 		// tracker kunglaw 2016
			// 		track_seatizen_login($check[0]['pelaut_id']);
			// 		track_seatizen($check[0]['pelaut_id'],"activation"); // catat
			// echo $data_cookie['success']."|success";
			header("location:".base_url("users/login"));
			}
		}
		//kondisi kalau data salah
		else
		{
			// ke halaman send_activation code 
			show_404();
			
		}
	}
	
	
	
	public function forgotpass()
	{
	  $g_captcha_response = $_POST['g-recaptcha-response'];
		
	  $json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
	  
	  $response = json_decode($json, true);
		 
	  $this->load->library('form_validation');
	  $this->load->library("token");
	  
	  $email = $this->input->post('email',true);
	  $this->form_validation->set_rules('email',"Email","valid_email|required");
	  
	  
	  if($this->form_validation->run() == true && $response['success'] == true)
	  {
		// email harus active 
		$now = date("Y-m-d H:i:s");
		$check_activation = $this->user_model->check_activation_code($email);
		$data_token       = array("email"=>$email,"type_user"=>"pelaut","page"=>"forgotpass","expiry_date >"=>$now);  
		$check_token	  = $this->token->check_token($data_token);
		
		//print_r($check_token); exit;
		
		if(!empty($check_activation) && empty($check_token))
		{
			
			// create token
			$no_token = $this->token->generate(64);// generate_token
			$data_token = array(
			
				"type_user" => "pelaut",
				"email"	 => $email,
				"no_token"  => $no_token,
				"page"	  => "forgotpass" 
			
			); 
			$insert_token = $this->token->insert_token($data_token);
			//$read_token   = $this->token->read_token($no_token);
			
			$str_url  = "users/change_password/?";
			$str_url .= "x=1&"; 
			$str_url .= "u=$check_activation[username]&";
			$str_url .= "email=$check_activation[email]&";
			$str_url .= "t=$no_token";
			
			$bstr_url = base_url($str_url);
			
			//send_email
			$data_user = array(
			  "username"	 => $check_activation['username'],
			  "first_name"   => $check_activation['nama_depan'],
			  "last_name"	=> $check_activation['nama_belakang'],
			  "email"		=> $check_activation['email'],
			  "url"		  => $bstr_url,
			  "user_type"	=> "seatizen", 	
			);
			
			if($no_token == TRUE)
			{
				// send email
				$this->send_email_pass($data_user);
			
				$data_cookie = array(
					
				"success"  => "<div class='alert alert-success'> Change Password now! we are sending you link for change your old password trough your email. if you are after 24 hours not Click this link, the token will expire and you can't change the password. </div>"
				);
			
				$this->session->set_flashdata("success",$data_cookie['success']);
			}
			else
			{
				$data_cookie['error'] = "<div class='alert alert-warning'> There is something Error, We cant send you a link to your Email </div>"; 
				$this->session->set_flashdata("error",$data_cookie['error']);
			}
		}
		else
		{
			$data_cookie['error'] = "<div class='alert alert-warning'> 
					<div> your email has not valid, please input a valid email </div>
					<div> Or, you already send a request for forgot password. please check your email for the link </div>
			</div>"; 
			$this->session->set_flashdata("error",$data_cookie['error']);	
		}
			
		// halaman login dengan header pengguna
		header("location:".base_url("users/forgotpass")); 	  
	  }
	  else
	  {
		$data_cookie['error'] = "<div class='alert alert-warning'> Data Validation Error </div>";
		$this->session->set_flashdata("error",$data_cookie['error']);
		// output
		header("location:".base_url("users/forgotpass"));
	  }
			
	}

	function register_process_all()
	{
		//error_reporting(E_ALL);
		session_start();
		/*$g_captcha_response = $_POST['g-recaptcha-response'];
		
		$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);*/
		//var_dump($response);
		
		//echo $response['success']; exit;
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->input->post("input_capt") == $_SESSION["captcha"])
		{
		  
		  $this->load->library('form_validation');
		  $this->form_validation->set_error_delimiters('','');
		  
		  // Array ( [username_reg] => [first_name] => [last_name] => [email] => [reemail] => [password_reg] => [re_password] => ) 
		  
		  $username  		= strtolower($this->input->post('username_seaman',true));
		  // $first_name	  = $this->input->post('first_name',true);
		  // $last_name	   = $this->input->post('last_name',true);
		  $email		   = $this->input->post('email_seaman',true);
		  // $re_email		= $this->input->post('re_email',true);
		  $password        = $this->input->post('password_reg_seaman',true);
		  // $re_password     = $this->input->post('re_password',true);
		  
		  //validation_error cuma nangkap error dari yg ini aja.
		  $this->form_validation->set_rules('username_seaman','Username','required|xss_clean|alpha_dash');
		  // $this->form_validation->set_rules('first_name','First Name','required|xss_clean');
		  // $this->form_validation->set_rules('last_name','Last Name','required|xss_clean');
		  $this->form_validation->set_rules('email_seaman','Email','required|valid_email|xss_clean|min_length[6]');
		  // $this->form_validation->set_rules('re_email','Re Email','required|valid_email|matches[email]|xss_clean|min_length[6]');

		  $this->form_validation->set_rules('password_reg_seaman','Password','required|xss_clean|min_length[6]');		
			  
		  $check = $this->check_username_from_universal();
		  // print_r($check);
		  // KONDISI REGISTER SALAH
		  if($this->form_validation->run() == FALSE || $check['nilai']['username'] == "false" || $check['nilai']['email'] == "false") 
		  {
			 
			print_r($check);
			  //exit('$this->form_validation->run() == FALSE || $check[nilai][username] == "false" || $check[nilai][email] == "false"');
			  
			//   $data['head']	 = "head";
			//   $data['title']	= "Register";
			//   $data['css']	  = "css"; //css tambahan, di head
			//   $data['meta']	 = "meta"; // meta tambahan, di head
			//   $data['js_top']   = "js_top"; // js tambahan, di head
 			  
			//   //$check = $this->check_username();
			  
			  
			// $data['template'] = "template-register-all";
			  
			  
			//   $data['footer']   = "footer";
			//   $data['js_under'] = "js_under";
			  
			//   //$check = $this->check_username();
			//   $data['info'] = $check['info'];
			  
			//   $data['ve']	= validation_errors();
			  
			//   $data["username_reg"]   = $username;
			//   $data["first_name"]     = $first_name;
			//   $data["last_name"]      = $last_name;
			//   $data["email"]	      = $email;
			  
			//   $this->load->view('register-all',$data);	
			  echo validation_errors()."|error";	
		  } 
		  
		  // KONDISI ISIAN BENAR
		  
		  else {
			 // echo "isian benar"; echo "<br>";
			 // exit('test mo ...');
			  
			  $this->user_model->register_all();
			  
			  // ambil data yang ada di database
			  $str_user = "select * from pelaut_ms where username = '$username' ";
			  $q_user   = $this->db->query($str_user);
			  $f_user   = $q_user->row_array(); 
			  
			  // run tracker 	
			  track_seatizen($f_user['pelaut_id'],"register_all");
			  
			  $data_user = array(
			  	"username"	 => $username,
			  	"first_name"   => "",
				"last_name"	=> "",
				"email"		=> $email,
				"password"	 => md5($password),
				"activation"   => $f_user['activation'],
				"user_type"	=> "seatizen"
			  );
			  
			  // kirim email, activation code
			  $this->send_email_for_universal($data_user);
			 	
			  // $data['title']    = "Registration";
			  // $data['template'] = "template";
			  // $data['css']   = "css";
			  // $data['meta']  = "meta";
			  // $data['footer']   = "footer";
			  
			  // //$data['rwnation'] = $this->nation_model->get_nationality();
			  // //$data['rwuser'] = $this->user_model->get_pelaut();
			  
			  // //$check = $this->check_username();
			  // $data['info'] 	 = $check['info'];
			  // $data['js_top']   = "js_top";
			  // $data['js_under'] = "js_under";
			  // track_seatizen($f_user["id_perusahaan"],"register_all");
			  echo $data['success']  = "Congratulations, you already registered at informasea.com. we're already send confirmation data to your email at $email, if there is no email activation from ".WEBSITE.", please check your spam menu/section on your email. please confirm the activation code to your email to complete registration |success";
 			  
			  // $this->load->view('register-all',$data);
		  }
		}
		else
		{
			// $data['title'] 	= "Registration";
			// $data['template'] = "template";
			// $data['css']   	  = "css";
			// $data['meta']  	 = "meta";
			
			// $data['ve'] 			= "You Must Entered a Right Captcha Text";
			// $data['js_top']	    = "js_top";
			// $data['js_under']	  = "js_under";
			// $data['footer']   		= "footer";
		
			
			// $this->load->view('register-all',$data);
			echo "You Must Entered a Right Captcha Text. you must <a href='".base_url("users/register_all")."'> reload page </a> |error";
		}
	}
	
	public function register_process()
	{
		session_start();
		/*$g_captcha_response = $_POST['g-recaptcha-response'];
		
		$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);*/
		//var_dump($response);
		
		//echo $response['success']; exit;
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->input->post("input_capt") == $_SESSION["captcha"])
		{
		  
		  $this->load->library('form_validation');
		  $this->form_validation->set_error_delimiters('<li >', '</li> ');
		  
		  // Array ( [username_reg] => [first_name] => [last_name] => [email] => [reemail] => [password_reg] => [re_password] => ) 
		  
		  $username  		= strtolower($this->input->post('username_reg',true));
		  $first_name	  = $this->input->post('first_name',true);
		  $last_name	   = $this->input->post('last_name',true);
		  $email		   = $this->input->post('email',true);
		  $re_email		= $this->input->post('re_email',true);
		  $password        = $this->input->post('password_reg',true);
		  $re_password     = $this->input->post('re_password',true);
		  
		  //validation_error cuma nangkap error dari yg ini aja.
		  $this->form_validation->set_rules('username_reg','Username','required|xss_clean|alpha_dash');
		  $this->form_validation->set_rules('first_name','First Name','required|xss_clean');
		  $this->form_validation->set_rules('last_name','Last Name','required|xss_clean');
		  $this->form_validation->set_rules('email','Email','required|valid_email|matches[re_email]|xss_clean|min_length[6]');
		  $this->form_validation->set_rules('re_email','Re Email','required|valid_email|matches[email]|xss_clean|min_length[6]');

		  $this->form_validation->set_rules('password_reg','Password','required|matches[re_password]|xss_clean|min_length[6]');		
			  
		  $check = $this->check_username();
		  
		  // KONDISI REGISTER SALAH
		  if($this->form_validation->run() == FALSE || $check['nilai']['username'] == "false" || $check['nilai']['email'] == "false") 
		  {
			  //exit('$this->form_validation->run() == FALSE || $check[nilai][username] == "false" || $check[nilai][email] == "false"');
			  
			  $data['head']	 = "head";
			  $data['title']	= "Register";
			  $data['css']	  = "css"; //css tambahan, di head
			  $data['meta']	 = "meta"; // meta tambahan, di head
			  $data['js_top']   = "js_top"; // js tambahan, di head
 			  
			  //$check = $this->check_username();
			  
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
			  
			  //$check = $this->check_username();
			  $data['info'] = $check['info'];
			  
			  $data['ve']	= validation_errors();
			  
			  $data["username_reg"]   = $username;
			  $data["first_name"]     = $first_name;
			  $data["last_name"]      = $last_name;
			  $data["email"]	      = $email;
			  
			  $this->load->view('register',$data);		
		  } 
		  
		  // KONDISI ISIAN BENAR
		  
		  else {
			 // echo "isian benar"; echo "<br>";
			 // exit('test mo ...');
			  
			  $this->user_model->register();
			  
			  // ambil data yang ada di database
			  $str_user = "select * from pelaut_ms where username = '$username' ";
			  $q_user   = $this->db->query($str_user);
			  $f_user   = $q_user->row_array(); 
			  
			  // run tracker 	
			  track_seatizen($f_user['pelaut_id'],"register");
			  
			  $data_user = array(
			  	"username"	 => $username,
			  	"first_name"   => $first_name,
				"last_name"	=> $last_name,
				"email"		=> $email,
				"password"	 => md5($password),
				"activation"   => $f_user['activation'],
				"user_type"	=> "seatizen"
			  );
			  
			  // kirim email, activation code
			  $this->send_email($data_user);
			 	
			  $data['title']    = "Registration";
			  $data['template'] = "template";
			  $data['css']   = "css";
			  $data['meta']  = "meta";
			  $data['footer']   = "footer";
			  
			  //$data['rwnation'] = $this->nation_model->get_nationality();
			  //$data['rwuser'] = $this->user_model->get_pelaut();
			  
			  //$check = $this->check_username();
			  $data['info'] 	 = $check['info'];
			  $data['js_top']   = "js_top";
			  $data['js_under'] = "js_under";
			  
			  $data['success']  = "<div class='alert alert-success'> Congratulations, you already registered at informasea.com. we're already send confirmation data to your email at <a href='#'>$email</a>, if there is no email activation from ".WEBSITE.", please check your spam menu/section on your email. please confirm the activation code to your email to complete registration </div>";
 			  
			  $this->load->view('register',$data);
		  }
		}
		else
		{
			$data['title'] 	= "Registration";
			$data['template'] = "template";
			$data['css']   	  = "css";
			$data['meta']  	 = "meta";
			
			$data['ve'] 			= "You Must Entered a Right Captcha Text";
			$data['js_top']	    = "js_top";
			$data['js_under']	  = "js_under";
			$data['footer']   		= "footer";
		
			
			$this->load->view('register',$data);
		}

	}
	
	function __destruct()
	{
		//echo "</pre>";
		
	}
	
	
}