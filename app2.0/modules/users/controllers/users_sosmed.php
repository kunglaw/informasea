<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class users_sosmed extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();	
		
		$this->load->model("users/user_model");
		$this->load->model("photo/photo_mdl");
		$this->load->helper("cookie");
		$this->load->helper('user_cookie_helper');
		$this->load->helper('list_error_users_helper');
		
	}
	
	/* function fb_modal()
	{		
		$this->load->view("users/email_confirmation");	
	} */
	
	private function send_email($user)
	{
		
		if(empty($user))
		{
			$username = $user['username'];
	
			$user = $this->user_model->check_nauser($username);
			
			
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['password']	= $user['password']; // ini jangan di md5
			$data['true_pass']   = $user['true_pass'];
			$data['email']	   = $user['email'];
			$data['str_url'] 	 = 
			base_url("users/users_process/activate/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
			
		}
		else
		{
			$data['nama']		= $user['first_name']." ".$user['last_name'];
			$data['username']	= $user['username'];
			$data['password']	= $user['password']; // jangan di md5 juga
			$data['true_pass']   = $user['true_pass'];
			$data['email']	   = $user['email'];
			$data['str_url'] 	 = 
			base_url("users/users_process/activate/?a=$user[activation]&x=1&u=$data[username]&p=$data[password]&email=$data[email]");
		}
		
		// buat email 
		$this->load->library('email');
		
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
		
		$data['config'] = $config;
		
		$this->email->initialize($config);
		//exit('email_jalan');
		
		$this->email->from('info@informasea.com', 'informasea.com');
		$this->email->to($user['email']); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('informasea.com Confirmation Account');
		
		$content = $this->load->view('users/email3',$data,true);
		$this->email->message($content);
		
		$contenti = $this->load->view('users/email-pass',$data,true);
		$this->email->set_alt_message($contenti);	
	
		$this->email->send();
		
		
		//echo $this->email->print_debugger();
		
	}
	
	function waiting()
	{
		if( $this->input->is_ajax_request() == TRUE)
		{
			$this->load->view("facebook_app/modal_waiting");
		}
		else
		{
			
			show_404();
		}
		
	}
	
	function fb_modal_prompt()
	{
		if( $this->input->is_ajax_request() == TRUE)
		{
			$this->load->view("facebook_app/modal_prompt");
		}
		else
		{
			
			show_404();
		}
		
		
	}
	
	function info_changefb()
	{
		if( $this->input->is_ajax_request() == TRUE)
		{
			$this->load->view("facebook_app/modal_info_changefb");
		}
		else
		{
			
			show_404();
		}
		
		
	}
	
	function check_all_username($username)
	{
		$this->load->library("check_data");
		if(empty($username))
		{
			$username = $this->input->post("username");	
		}
		
		$check_username = $this->check_data->check_username($username);
		if($check_username == TRUE)
		{
			echo "true";	
		}
		else if($check_username == FALSE)
		{
			echo "false";
		}
	}
	
	function check_all_email($email)
	{
		$this->load->library("check_data");
		
		if(empty($email))
		{
			$email = $this->input->post("email");	
		}
		
		$check_email = $this->check_data->check_email($email);
		if($check_email == TRUE)
		{
			echo "true";	
		}
		else if($check_email == FALSE)
		{
			echo "false";
		}
		
	}
	
	//cek username dan email
	public function check_username()
	{
		$taw = "<li>";
		$tak = "</li>";
		
		$this->load->library("check_data");
		
		$name_post	  = $this->input->post('fb_username');
		$username 	   = $this->check_data->check_username($name_post);
		
		$email_post	 = $this->input->post('fb_email');
		$email 		  = $this->check_data->check_email($email_post);	
		
		if(!empty($name_post))
		{
		  if ($username == TRUE) {
			  $info['username'] = "";
			  $nilai['username'] = "true"; 
			  //echo "kondisi 1 jalan <br> ";
		  } else {
			  $info['username'] = "$taw this username has been used $tak ";
			  $nilai['username'] = "false";
			  //echo "kondisi 2 jalan <br> ";
		  }
		}
		
		if(!empty($email_post))
		{
		  if ($email == TRUE) {
			  $info['email'] = "";
			  $nilai['email'] = "true"; 
			  //echo "kondisi 3 jalan <br> ";
		  } else {
			  $info['email'] = "$taw this email has been used $tak";
			  $nilai['email'] = "false";
			  //echo "kondisi 4 jalan <br> ";
		  }
		}
		
		$arr = array(
		  'info'=>array('username'=>$info['username'],'email' => $info['email']),
		  'nilai'=>array('username'=>$nilai['username'],'email' => $nilai['email'])
		);
		
		return $arr;
	}
	
	function register_fb_process()
	{
		
		$g_captcha_response = $_POST['g-recaptcha-response'];
		
		$json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
		
		$response = json_decode($json, true);
		
		$this->load->library("token");
		$t 				= $this->input->post("no_token",true);
		
		$now 			  = date("Y-m-d H:i:s");
		$data_token 	   = array("no_token"=>$t,"expiry_date >"=>$now);
		$check_token 	  = $this->token->check_token($data_token);
		
		if($response["success"] == true && !empty($check_token) )
		{
			$this->load->model("users/user_model");
			$this->load->helper("username_folder_helper"); 
			$this->load->library("form_validation");
			$this->form_validation->set_error_delimiters('<li >', '</li> ');
			
			/* Array
			(
				[fb_id] => 101615020201920
				[fb_gender] => male
				[fb_religion] => 
				[fb_username] => dimas_9937
				[fb_first_name] => Dimas
				[fb_last_name] => Dimas
				[fb_email] => dimas_9937@yahoo.co.id
				[re_email] => 
				[fb_password] => 999999
				[re_password] => 999999
				[g-recaptcha-response] => 
			)*/
			
			// get data
			$fb_id 			= $this->input->post("fb_id",true);
			$fb_username	  = strtolower($this->input->post("fb_username",true));
			$fb_first_name	= $this->input->post("fb_first_name",true);
			$fb_last_name	 = $this->input->post("fb_last_name",true);
			$fb_email		 = $this->input->post("fb_email",true);
			$fb_religion	  = $this->input->post("fb_religion",true);
			$fb_gender		= $this->input->post("fb_gender",true);
			$fb_password	  = $this->input->post("fb_password",true);
			
			$re_email		 = $this->input->post("re_email",true);
			$re_password	  = $this->input->post("re_password",true);
			
			$activation	   = md5(uniqid(rand(), true));
			$password 		 = md5($fb_password);
			
			$this->form_validation->set_rules("no_token","Token","xss_clean|required");
			$this->form_validation->set_rules("fb_id","Facebook Id","xss_clean|required");
			$this->form_validation->set_rules("fb_username","Username","xss_clean|required");
			$this->form_validation->set_rules("fb_first_name","First Name","xss_clean|required");
			$this->form_validation->set_rules("fb_last_name","Last Name","xss_clean|required");
			$this->form_validation->set_rules("fb_email","Email","valid_email|xss_clean|required|matches[re_email]");
			$this->form_validation->set_rules("fb_religion","religion","xss_clean");
			$this->form_validation->set_rules("fb_gender","Gender","xss_clean|required");
			$this->form_validation->set_rules("fb_password","password","xss_clean|required|matches[re_password]");
			
			$check = $this->check_username();
			
			if($this->form_validation->run() == true && $check['nilai']['username'] == "true" && $check['nilai']['email'] == "true")
			{
				
				$str_in  = "INSERT INTO pelaut_ms SET 		 		 	    ";
				$str_in .= "username 			= '$fb_username'		   ,";
				$str_in .= "password			= '".md5($fb_password)."'  ,"; 
				$str_in .= "nama_depan			= '$fb_first_name'		   ,";
				$str_in .= "nama_belakang  	= '$fb_last_name'		   ,";
				$str_in .= "agama				= '$fb_religion'		   ,";
				$str_in .= "email				= '$fb_email'			   ,";
				$str_in .= "gender				= '$fb_gender'			   ,";
				//$str_in .= "activation	   = '$activation'	          ,";
				$str_in .= "activation			= '$activation'			   ,";
				$str_in .= "create_date		= now()					   ,";
				$str_in .= "facebook_id		= '$fb_id'				    ";
				
				$this->db->query($str_in);
				
				make_username_folder_pt($fb_username);
				
				// login berdasarkan data yang telah dimasukkan
				$str_pelaut = "SELECT * FROM pelaut_ms WHERE facebook_id = '$fb_id' ";
				$q		  = $this->db->query($str_pelaut);
				$fp		 = $q->row_array();
				
				// login
				/* $dt = array('id_user'  => $fp['pelaut_id'],
							'username' => $fp['username'],
							'email' 	=> $fp['email'],
							'user' 	 => "pelaut",
							'type_user'=> "pelaut",
							'nama' 	 => $fb_first_name." ".$fb_last_name);
				$this->session->set_userdata($dt); */
				
				// kirim email activasi
				$this->load->library("my_email");
				
				$str_url = base_url("users/users_process/activate/?a=$activation&x=1&u=$fb_username&p=$password&email=$fb_email");
				$user = "info";
				
				$content = array(
							
							"subject" => "Informasea activation account",
							"subject_title"=> WEBSITE,
							"to" => $fb_email, 
							"data" => array('str_url'=>$str_url),
							
							"message" => "users/email/email-activation-seatizen",
							"mv" => TRUE,
							"alt_message" => "users/email/email-activation-seatizen-alt",
							"amv" => TRUE
						
						);
				
				$this->my_email->send_email($user,$content);
				
				$photo = check_profile_seaman();
				$cover = check_cover_seaman();
				
				$data_cookie = array(
					"name"     => $fb_first_name." ".$fb_last_name,
					"username" => $fb_username,
					"photo"	   => $photo, 
					"cover"	   => $cover
				);
			
				define_cookie_seaman($data_cookie);
				
				// cookie tambahan
				$arr_cookie = array(
				  array(
					  'name'   => "register_fb_nope",
					  'value'  => TRUE,
					  'expire' => '3'
					 
				  ),
				  array(
					  'name'   => "register_fb_email",
					  'value'  => FALSE,
					  'expire' => '3'
				  )
				);
				
				foreach($arr_cookie as $cookie){
					$this->input->set_cookie($cookie);	
				}
				
				// session untuk iFlyChat
				/* $pelaut_id 		  = $pelaut_id;
				$username_pelaut	= $username;

				$get_avatar 		 = $this->user_model->get_profile_pic($pelaut_id);
				$get_avatar2 		= explode(".", $get_avatar);
				$name_avatar 		= $get_avatar2[0];
				$type_file 		  = $get_avatar2[1];
				$pic_small 		  = "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
				$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
				if (file_exists($pic_small)) {
					$avatar_url 	= $pic_small;
				}else{
					$avatar_url 	= $pic_default;
				}
				
				$_SESSION['id_user2']			  = $pelaut_id;
				$_SESSION['username_agent']		= $username_pelaut;
				$_SESSION['avatar_url']			= $avatar_url; */ 
				// end iFlyChat
				
				// ==== end login ========
				
				// hapus token
				$this->token->delete_token($data_token);
				
				//tracker
				$action  = $this->config->item("fb");
				track_seatizen($fp["pelaut_id"],$action["reg_noemail"]);
				
				$dtt['redirect'] = $page; 
				$this->load->view("redirect-page",$dtt);
				header("location:".base_url("users/login/seaman"));
				
			}
			else
			{
				 $error_alert  = "<div>".validation_errors()."</div>";
				 $error_alert .= "<div>".$check["info"]["username"]."</div>";
				
				if($check['nilai']['username'] == "false")
				{
					$error_alert .= "<div>".$check["info"]["username"]."</div>";
						
				}
				
				if($check['nilai']['email'] == "false")
				{
					$error_alert .= "<div>".$check["info"]["email"]." </div>";
						
				}
				
				$hasil['info'] = "<div class='alert alert-danger'>".$error_alert."</div>";
			  	$this->session->set_flashdata('error',$hasil['info']);
				
				header("location:".base_url("users/register/register-fb?t=$t"));
			}				
		}
		else
		{
			if(empty($check_token))
			{
				$hasil['info']  = "<div class='alert alert-danger'> Token expired </div>";
			}
			
			if($response["success"] == false)
			{
				$hasil['info'] .= "<div class='alert alert-danger'> You must click the google captcha  </div>";
			  		
			}
			
			$this->session->set_flashdata('error',$hasil['info']);
			header("location:".base_url("users/register/register-fb?t=$t"));	
		}
		
	}
	
	function facebook()
	{
		session_start();
		//print_r($_POST); exit;
		
		$this->load->library("form_validation");
		$this->load->helper("username_folder_helper"); 
		
		/* Array ( [fb_id] => 10203185849228742 
		[fb_first_name] => Aries Dimas 
		[fb_last_name] => Yudhistira 
		[fb_cover] => 
		[fb_picture] =>
		[fb_email] => 
		[fb_religion] => 
		[fb_gender] => male 
		[fb_username] => 
		[fb_password] => )*/
		 
		// get data
		$fb_id 			= $this->input->post("fb_id",true);
		$fb_first_name	= $this->input->post("fb_first_name",true);
		$fb_last_name	 = $this->input->post("fb_last_name",true);
		$fb_cover 		 = $this->input->post("fb_cover",true);
		$fb_picture	   = $this->input->post("fb_picture",true);
		$fb_email		 = $this->input->post("fb_email",true);
		$fb_religion	  = $this->input->post("fb_religion",true);
		$fb_gender		= $this->input->post("fb_gender",true);
		
		$activation	   = md5(uniqid(rand(), true));
		$password 	     = mt_rand(100000,999999); // default password bagi pendaftar baru dengan facebook. password harus beda
		
		// cek data
		$this->form_validation->set_rules("fb_id","fb_id","required|xss_clean");
		$this->form_validation->set_rules("fb_first_name","fb_first_name","required|xss_clean");
		$this->form_validation->set_rules("fb_last_name","fb_last_name","required|xss_clean");
		$this->form_validation->set_rules("fb_email","fb_email","valid_email|xss_clean"); // tidak required
		
		//echo json_encode(array("saasasasas")); exit;
		
		if($this->form_validation->run("fb_email") == true)
		{
			$u = explode("@",$fb_email);
			$username = $u[0];
		}
		else
		{
			$username = "";	
		}
		
		if($this->form_validation->run() == true )
		{
			// cek fb_id
			$str = "SELECT * FROM pelaut_ms where facebook_id = '$fb_id' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array(); // data dari fb_id
			
			// cek email 
			$stre = "SELECT * FROM pelaut_ms where email = '$fb_email'	";
			$qe   = $this->db->query($stre);
			$fe   = $qe->row_array();
			
			// cek username 
			$stru = "SELECT * FROM pelaut_ms where username = '$username' ";
			$qu   = $this->db->query($stru);
			$fu   = $qu->row_array();
			
			// cek activation_code 
			$strac = "SELECT * FROM pelaut_ms where facebook_id = '$fb_id' AND activation <> 'ACTIVE' "; 
			$sac   = $this->db->query($strac);
			$fac   = $sac->row_array();
			
			
			// kalau username sudah ada berdasarkan email , maka di update 
			if(!empty($fu) || !empty($fe) || !empty($f))
			{				
				if($fu['facebook_id'] == 0 || $fe['facebook_id'] == "")
				{
				  $strfu  = "UPDATE pelaut_ms SET 			 					 ";
				  $strfu .= "facebook_id	= '$fb_id', activation = 'ACTIVE' ";
				  $strfu .= "WHERE username	= '$username' OR email = '$fb_email' ";
				  
				  $qfu   = $this->db->query($strfu);
				}
				
				// cek activation 
				if(!empty($fac))
				{					
					$data['err'] = md5(2);
					$this->load->helper("check_file");
					
					//$check_nauser = $this->user_model->check_nauser($username); // check user tidak active
					$photo = check_profile_seaman($check_nauser['username']);
					$cover = check_cover_seaman($check_nauser['username']);
					
					$url = $photo;
					$url_cover = $cover;
					
					$data_cookie = array(
						"name"     => $fac['nama_depan']." ".$fac['nama_belakang'],
						"photo"    => $url,
						"username" => $fac['username'],
						"cover"	=> $url_cover,
					);
	
					// HARUSS REDIRECTTT !!!
					
					$dt['msg'] = "You must activate your account before login";
					$dt['url'] = base_url("users/formactivation/?sm=1&err=$data[err]&c=2&
					login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]");
					$dt['cookie'] = $data_cookie;
					
					echo json_encode($dt);
					/* echo "<script>location.href ='".base_url("users/formactivation/?sm=1&err=$data[err]&c=2&
					login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]")."' </script>";*/
					
					/* header("location:".base_url("users/formactivation/?sm=1&err=$
					data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]"));*/ 
				}
				
				else //if(!empty($f) || !empty($fe) || !empty($fu))
				{
					
					// login
					if(!empty($f))
					{
						
					    $dtf = array('id_user'   =>  $f['pelaut_id'],
								    'username'   =>  $f['username'],
								    'email' 	  =>  $f['email'],
								    'user' 	   =>  "pelaut",
								    'type_user'  =>  "pelaut",
								    'nama' 	   =>  $f['nama_depan']." ".$f['nama_belakang']);
					}
					else if(!empty($fe))
					{
						
						$dtf = array('id_user'  => $fe['pelaut_id'],
								    'username'  => $fe['username'],
								    'email' 	 => $fe['email'],
								    'user' 	  => "pelaut",
								    'type_user' => "pelaut",
								    'nama' 	  => $fe['nama_depan']." ".$fe['nama_belakang']);
					}
					else if(!empty($fu))
					{
						
						$dtf = array('id_user'  => $fu['pelaut_id'],
								    'username'  => $fu['username'],
								    'email' 	 => $fu['email'],
								    'user' 	  => "pelaut",
								    'type_user' => "pelaut",
								    'nama' 	  => $fu['nama_depan']." ".$fu['nama_belakang']);
					}
					
					// session untuk iFlyChat
					
					if(!empty($f))
					{
						$pelaut_id = $f["pelaut_id"];	
					}
					else if(!empty($fe))
					{
						$pelaut_id = $fe["pelaut_id"];	
					}
					else if(!empty($fu))
					{
						$pelaut_id = $fu["pelaut_id"];
					}
					
					$username_pelaut	= $fe['username'];
	
					$get_avatar 		 = $this->user_model->get_profile_pic($pelaut_id);
					$get_avatar2 		= explode(".", $get_avatar);
					$name_avatar 		= $get_avatar2[0];
					$type_file 		  = $get_avatar2[1];
					$pic_small 		  = "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
					$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
					if (file_exists($pic_small)) {
						$avatar_url 	= $pic_small;
					}else{
						$avatar_url 	= $pic_default;
					}
					
					$_SESSION['id_user2']			  = $fe['pelaut_id'];
					$_SESSION['username_agent']		= $fe['username'];
					$_SESSION['avatar_url']			= $avatar_url;
					// end iFlyChat
					
					$dt["dtf"] = $dtf;
					$this->session->set_userdata($dtf);
				
					$dt['msg'] = "You're Login Sucessfully";
					$dt['url'] = base_url("seaman/resume");
					
					//$a["xzz"] = "deswfhaewfhuwerfuew";
					
					//tracker
					$action  = $this->config->item("fb");
					track_seatizen($pelaut_id,$action["login"]);
					
					//track login
					track_seatizen_login($pelaut_id);
					
					echo json_encode($dt);
				}
				
			}
			else
			{
				// jika fb_id yg di table pelaut_ms kosong
				// maka buat data baru
				// check, apakah emailnya ada 
				/*
					kalau ada maka langsung masuk ke halaman resume dan mengirimkan generate username dan password ke user 
				*/ 
				// check fb_id kosong apa tidak di database
				if(empty($f))
				{
					
					// kalau emailnya tidak ada 
					
					if(empty($fb_email)){ // email
					  
					  //create token
					  $this->load->library("token");
					  $no_token   = $this->token->generate(64);
					  $data_token = array("no_token"=>$no_token,"jml"=>"+1","satuan"=>"hours","email"=>$fb_email,"page"=>"fb_register","type_user"=>"pelaut");
					  $insert_token = $this->token->insert_token($data_token);
					  
					  //$dt['msg'] = "You successfully Login with Facebook ";
					  $dt["cookie"] = array("username"=>$username,
					  "fb_first_name"=>$fb_first_name,"fb_last_name"=>$fb_last_name,"fb_email"=>$fb_email,
					  "fb_religion"=>$fb_religion,"fb_gender"=>$fb_gender,"fb_id"=>$fb_id,"no_token"=>$no_token);
					  
					  $dt['url'] = base_url("users/register/register-fb?t=$no_token");
					  
					}
					else if(!empty($fb_email)) // emailnya tidak kosong
					{
						/* === proses === */
					
						//insert data pelaut dahulu 
						$str_in  = "INSERT INTO pelaut_ms SET 		 		 	 ";
						$str_in .= "username 			= '$username'			,";
						$str_in .= "password			= '".md5($password)."'  ,"; 
						$str_in .= "nama_depan			= '$fb_first_name'		,";
						$str_in .= "nama_belakang  	= '$fb_last_name'		,";
						$str_in .= "agama				= '$fb_religion'		,";
						$str_in .= "email				= '$fb_email'			,";
						$str_in .= "gender				= '$fb_gender'			,";
						//$str_in .= "activation	   = '$activation'	       ,";
						$str_in .= "activation			= 'ACTIVE'				,";
						$str_in .= "create_date		= now()					,";
						$str_in .= "facebook_id		= '$fb_id'				 ";
						
						$this->db->query($str_in);
						
						$pelaut_id = $this->db->insert_id();
						
						// create folder username
						make_username_folder_pt($username);
						
						//kirim email, data username dan password
						$this->load->library("my_email");
						$user = "info";
						
						$content = array(
							
							"subject" => "Informasea Account",
							"subject_title"=> WEBSITE,
							"to" => $fb_email, 
							"data" => array("username"=>$username,"password"=>$password),
							
							"message" => "users/email/email-activation-seatizen-fbpass",
							"mv" => TRUE,
							"alt_message" => "users/email/email-activation-seatizen-fbpass-alt",
							"amv" => TRUE
						
						);
						
						$this->my_email->send_email($user,$content); 
						
						// cover
						/* if(!empty($fb_cover))
						{
						  // cover
						  $dt_cover = getimagesize($fb_cover);
						  $cv_size  = filesize($fb_cover);
						  $cv_name  = basename($fb_cover);
						  $c = explode("?",$cv_name);
						  
						  if(!empty($c))
						  {
							  $cv_name = $c[0];	
						  }	
						  
						  $aa = explode(".",$cv_name);
						  $cv_name_thumb = $aa[0]."_thumb.".$aa[1]; 
						  
						  //CARA COPY KE - 1upload cover
						  $copy_cover = copy($fb_cover,pathup("photo/$username/cover/$cv_name"));
						  
						  if(!$copy_cover)
						  {
							echo "data cover tidak berhasil di copy";  
						  }
						  
						  $copy_cover = file_put_contents(pathup("photo/$username/cover/$cv_name_thumb"), fopen($fb_cover, 'r')); 
						  //END CARA KE-1
						  
						  
						  //CARA COPY KE - 2
						  /* $content = file_get_contents($fb_cover);
						  //Store in the filesystem.
						  $fp = fopen(pathup("photo/$username/cover/$cv_name"), "w");
						  $copy_cover = fwrite($fp, $content);
						  
						  if(!$copy_cover)
						  {
							echo "data cover tidak berhasil di copy";  
						  }
						  
						  fclose($fp);
						  END CARA KE-2
						  
						  
						  // insert cover ke database
						  $str_cv  = "INSERT INTO photo_pelaut_tr SET 			 	 ";
						  $str_cv .= "nama_gambar	= '$cv_name'					,";
						  $str_cv .= "size_gambar	= '$cv_size'					,";
						  $str_cv .= "id_pelaut		= '$pelaut_id'					,";
						  $str_cv .= "type_gambar	= '$dt_cover[mime]'				,";
						  $str_cv .= "datetime		= now()							,";
						  $str_cv .= "ip_address		= '".$_SERVER['REMOTE_ADDR']."' ,";
						  $str_cv .= "username		= '$username'					,";
						  $str_cv .= "cover			= '1'							 ";
						  
						  $this->db->query($str_cv);
						} */ // end cover
						
						if(!empty($fb_picture))
						{
						  // profile_picture 
						  $dt_prof  = getimagesize($fb_picture);
						  $pr_size  = filesize($fb_picture);
						  $pr_name  = basename($fb_picture);
						  $p = explode("?",$pr_name);
						  if(!empty($p))
						  {
							  $pr_name = $p[0];
						  }
						  
						  $aa = explode(".",$pr_name);
						  $pr_name_thumb = $aa[0]."_thumb.".$aa[1]; 
						  
						  //CARA COPY KE - 1upload cover
						  $copy_picture = copy($fb_picture,pathup("photo/$username/profile_pic/$pr_name"));
						  
						  if(!$copy_picture)
						  {
							echo "data profile tidak berhasil di copy";  
						  }
						  
						  $copy_picture = file_put_contents(pathup("photo/$username/profile_pic/$pr_name_thumb"), fopen($fb_picture, 'r'));
						  
						  // insert cover ke database
						  $str_pr  = "INSERT INTO photo_pelaut_tr SET 			 	 ";
						  $str_pr .= "nama_gambar	= '$pr_name'					,";
						  $str_pr .= "size_gambar	= '$pr_size'					,";
						  $str_pr .= "id_pelaut		= '$pelaut_id'					,";
						  $str_pr .= "type_gambar	= '$dt_cover[mime]'				,";
						  $str_pr .= "datetime		= now()							,";
						  $str_pr .= "ip_address		= '".$_SERVER['REMOTE_ADDR']."' ,";
						  $str_pr .= "username		= '$username'					,";
						  $str_pr .= "profile_pic	= '1'							 ";
						  
						  $this->db->query($str_pr);
						  
							// tak bisa jalan, disini 
							
							$data_user = array(
							  "username"	 => $username,
							  "first_name"   => $fb_first_name,
							  "last_name"	=> $fb_last_name,
							  "email"		=> $fb_email,
							  "password"	 => md5($password),
							  "true_pass" 	=> $password,
							  "activation"   => $f['activation'],
							);
							
							
							// send_email activation code
							$this->send_email($data_user);
						}
						
						// login
						$dt = array('id_user'  => $pelaut_id,
									'username' => $username,
									'email' 	=> $fb_email,
									'user' 	 => "pelaut",
									'type_user'=> "pelaut",
									'nama' 	 => $fb_first_name." ".$fb_last_name);
			
						$this->session->set_userdata($dt);
	
						// session untuk iFlyChat
						$pelaut_id 		  = $pelaut_id;
						$username_pelaut	= $username;
	
						$get_avatar 		= $this->user_model->get_profile_pic($pelaut_id);
						$get_avatar2 		= explode(".", $get_avatar);
						$name_avatar 		= $get_avatar2[0];
						$type_file 			= $get_avatar2[1];
						$pic_small 			= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
						$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
						if (file_exists($pic_small)) {
							$avatar_url 	= $pic_small;
						}else{
							$avatar_url 	= $pic_default;
						}
						
						$_SESSION['id_user2']			  = $pelaut_id;
						$_SESSION['username_agent']		= $username_pelaut;
						$_SESSION['avatar_url']			= $avatar_url; 
						// end iFlyChat
						
						// === end process === 
						
						//$dt['msg'] = "You successfully Login with Facebook ";
						$dt["cookie"] = array("register_fb_email"=>TRUE,"register_fb_nope"=>FALSE,"username"=>$username,"fb_first_name"=>$fb_first_name,
						"fb_last_name"=>$fb_last_name,"fb_email"=>$fb_email,"fb_religion"=>$fb_religion,
						"fb_gender"=>$fb_gender,"fb_id"=>$fb_id,"no_token"=>$no_token);
						
						//tracker
						$action  = $this->config->item("fb");
						track_seatizen($pelaut_id,$action["reg_email"]);
						
						$dt["action"] = $action;
						$dt['url'] = base_url("seaman/resume");
					} // end email tidak kosong 
					
					echo json_encode($dt);
					
				}
				else // login
				{
					$dtf = array('id_user'  => $f['pelaut_id'],
								'username' => $f['username'],
								'email' 	=> $f['email'],
								'user' 	 => "pelaut",
								'type_user'=> "pelaut",
								'nama' 	 => $f['nama_depan']." ".$f['nama_belakang']);
		
					$this->session->set_userdata($dtf);
					
					// session untuk iFlyChat
					$pelaut_id 		  = $f['pelaut_id'];
					$username_pelaut	= $f['username'];

					$get_avatar 		 = $this->user_model->get_profile_pic($pelaut_id);
					$get_avatar2 		= explode(".", $get_avatar);
					$name_avatar 		= $get_avatar2[0];
					$type_file 		  = $get_avatar2[1];
					$pic_small 		  = "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
					$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
					if (file_exists($pic_small)) {
						$avatar_url 	= $pic_small;
					}else{
						$avatar_url 	= $pic_default;
					}
					
					$_SESSION['id_user2']			= $f['pelaut_id'];
					$_SESSION['username_agent']		= $f['username'];
					$_SESSION['avatar_url']			= $avatar_url;
					// end iFlyChat
					
					
					$dt['msg'] = "You successfully Login with Facebook ";
					$dt["cookie"] = array("username"=>$username,"fb_first_name"=>$fb_first_name,
					"fb_last_name"=>$fb_last_name,"fb_email"=>$fb_email,"fb_religion"=>$fb_religion,
					"fb_gender"=>$fb_gender,"fb_id"=>$fb_id);
					
					$dt['url'] = base_url("users/register/register-fb?t=kjsFDasSfDKASFHSdfaisdf");
					
					//tracker
					$action  = $this->config->item("fb");
					track_seatizen($pelaut_id,$action["reg_email"]);
					
					//track login
					track_seatizen_login($pelaut_id);
					
					echo json_encode($dt);
				}
			
			}
		
		}
		else
		{
			echo "Data Facebook is not complete, unable to Login";
		}
		
	}
	
	// gmail belum di taruh tracker
	function gmail()
	{
		session_start();
		$this->load->library("form_validation");
		$this->load->helper("username_folder_helper");
		
		/*
			[google_id] => 113783419024544150221
			[google_firstname] => Kunglaw
			[google_lastname] => Ady
			[google_cover] => https://lh3.googleusercontent.com/-c92l0lhLWOw/VP2LPQ0HYEI/AAAAAAAAAds/DqiDZeW8ncQ/s630-fcrop64=1,04f1293dfa45f7d3/Dreamy-Colorful-Nature.jpg
			[google_picture] => https://lh4.googleusercontent.com/-fdg7guplt1I/AAAAAAAAAAI/AAAAAAAAAIU/32TvCHGq834/photo.jpg?sz=50
			[google_email] => alhusna901@gmail.com
			[google_gender] => male
		*/
				
		// get data
		$google_id 			= $this->input->post("google_id",true);
		$google_firstname	 = $this->input->post("google_firstname",true);
		$google_lastnmae	  = $this->input->post("google_lastname",true);
		$google_cover		 = $this->input->post("google_cover",true);
		$google_picture	   = $this->input->post("google_picture",true);
		$google_email		 = $this->input->post("google_email",true);
		$google_gender		= $this->input->post("google_gender",true);
		$google_city 		  = $this->input->post("google_city",true);
		
		$activation	   = md5(uniqid(rand(), true));
		$password 		 = mt_rand(100000,999999); // default password bagi pendaftar baru dengan facebook
		
		$u = explode("@",$google_email);
		$username = $u[0]; // cek apakah username sama atau tidak di database
		
		$this->form_validation->set_rules("google_id","Google Id","required|xss_clean");
		$this->form_validation->set_rules("google_firstname","First Name","required|xss_clean");
		$this->form_validation->set_rules("google_lastname","Last Name","required|xss_clean");
		$this->form_validation->set_rules("google_cover","cover","xss_clean");
		$this->form_validation->set_rules("google_picture","Picture","xss_clean");
		$this->form_validation->set_rules("google_email","Email","required|valid_email|xss_clean");
		$this->form_validation->set_rules("google_gender","gender","xss_clean");
		$this->form_validation->set_rules("google_city","City","xss_clean");
		
		if($this->form_validation->run() == true)
		{
			// cek email 
			$stre = "SELECT * FROM pelaut_ms where email = '$google_email'	";
			$qe   = $this->db->query($stre);
			$fe   = $qe->row_array($qe);
			
			// cek google_id
			$str = "SELECT * FROM pelaut_ms where google_id = '$google_id' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array();
			
			// cek username 
			$stru = "SELECT * FROM pelaut_ms where username = '$username' ";
			$qu   = $this->db->query($stru);
			$fu   = $qu->row_array($qu);	
			
			// cek activation_code 
			$strac = "SELECT * FROM pelaut_ms where username = '$username' AND activation <> 'ACTIVE' AND activation <> 'BLOCK' ";
			$sac   = $this->db->query($strac);
			$fac   = $sac->row_array();
			
			// kalau username sudah ada berdasarkan email , maka di update 
			if(!empty($fu) || !empty($fe))
			{

				if($fu['google_id'] == 0)
				{
				  $strfu  = "UPDATE pelaut_ms SET 			 					     ";
				  $strfu .= "google_id	= '$google_id', activation = 'ACTIVE'		 					     ";
				  $strfu .= "WHERE username	= '$username' OR email = '$google_email' ";
				  
				  $qfu   = $this->db->query($strfu);
				}
				
				// cek activation 
				if(!empty($fac))
				{
					// ACTIVATION TIDAK AKTIF 
					$data['err'] = md5(2);

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
						"name"     => $fac['nama_depan']." ".$fac['nama_belakang'],
						"photo"    => $url,
						"username" => $fac['username'],
						"cover"	=> $url_cover,
					);
					
					//define_cookie_seaman($data_cookie);
					
					$dt['msg'] = "You must activate your account before login";
					$dt['url'] = base_url("users/formactivation/?sm=1&err=$data[err]&c=2&login_attemp=$new_login_attemp&u=$data[u]&a=$data[a]");
					$dt['cookie'] = $data_cookie;
					
					echo json_encode($dt);
					
				}
				else
				{
				
					// login
					if(!empty($fu))
					{
					  $dt = array('id_user'  => $fu['pelaut_id'],
								  'username' => $fu['username'],
								  'email' 	=> $fu['email'],
								  'user' 	 => "pelaut",
								  'type_user'=> "pelaut",
								  'nama' 	 => $fu['nama_depan']." ".$fu['nama_belakang']);
					}
					else if(!empty($fe))
					{
						$dt = array('id_user'  => $fe['pelaut_id'],
								  'username' => $fe['username'],
								  'email' 	=> $fe['email'],
								  'user' 	 => "pelaut",
								  'type_user'=> "pelaut",
								  'nama' 	 => $fe['nama_depan']." ".$fe['nama_belakang']);
					}
					
					// session untuk iFlyChat
					$pelaut_id 			= $fe['pelaut_id'];
					$username_pelaut	= $fe['username'];
	
					$get_avatar 		= $this->user_model->get_profile_pic($pelaut_id);
					$get_avatar2 		= explode(".", $get_avatar);
					$name_avatar 		= $get_avatar2[0];
					$type_file 			= $get_avatar2[1];
					$pic_small 			= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
					$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
					if (file_exists($pic_small)) {
						$avatar_url 	= $pic_small;
					}else{
						$avatar_url 	= $pic_default;
					}
	
					$_SESSION['id_user2']			= $fe['pelaut_id'];
					$_SESSION['username_agent']		= $fe['username'];
					$_SESSION['avatar_url']			= $avatar_url;
					// end iFlyChat
	
					$this->session->set_userdata($dt);
					
					$dt['msg'] = "You're Login Sucessfully";
					$dt['url'] = base_url("seaman/resume");
					
					echo json_encode($dt);
				}
				
			}
			else
			{
				
				// jika google_id yg di table pelaut_ms kosong
				// maka buat data baru
				if(empty($f))
				{
					// insert data pelaut dahulu 
					$str_in  = "INSERT INTO pelaut_ms SET 		 		 	 ";
					$str_in .= "username 			= '$username'			,";
					$str_in .= "password			= '".md5($password)."'  ,"; 
					$str_in .= "nama_depan			= '$google_firstname'	,";
					$str_in .= "nama_belakang  	= '$google_lastname'	,";
					
					$str_in .= "email				= '$google_email'		,";
					$str_in .= "gender				= '$google_gender'		,";
					//$str_in .= "activation			= '$activation'			,";
					$str_in .= "activation			= 'ACTIVE'				,";
					$str_in .= "create_date		= now()					,";
					$str_in .= "google_id			= '$google_id'			 ";
					
					$this->db->query($str_in);
					
					$pelaut_id = $this->db->insert_id();
					
					// create folder username
					make_username_folder_pt($username);
					
					// cover
					if(!empty($google_cover))
					{
					  // cover
					  $dt_cover = getimagesize($google_cover);
					  $cv_size  = filesize($google_cover);
					  $cv_name  = basename($google_cover);
					  $c = explode("?",$cv_name);
					  if(!empty($c))
					  {
						  $cv_name = $c[0];	
					  }	
						
					  //upload cover
					  $copy_cover = copy($google_cover,pathup("photo/$username/cover/$cv_name"));
					  
					  if(!$copy_cover)
					  {
						echo "data cover tidak berhasil di copy";  
					  }
					  
					  // insert cover ke database
					  $str_cv  = "INSERT INTO photo_pelaut_tr SET 			 	 ";
					  $str_cv .= "nama_gambar	= '$cv_name'					,";
					  $str_cv .= "size_gambar	= '$cv_size'					,";
					  $str_cv .= "id_pelaut		= '$pelaut_id'					,";
					  $str_cv .= "type_gambar	= '$dt_cover[mime]'				,";
					  $str_cv .= "datetime		= now()							,";
					  $str_cv .= "ip_address		= '".$_SERVER['REMOTE_ADDR']."' ,";
					  $str_cv .= "username		= '$username'					,";
					  $str_cv .= "cover			= 1							 	 ";
					  
					  $this->db->query($str_cv);
					  
					  
					}
					
					if(!empty($google_picture))
					{
					  // profile_picture 
					  $dt_prof  = getimagesize($google_picture);
					  $pr_size  = filesize($google_picture);
					  $pr_name  = basename($google_picture);
					  $p = explode("?",$pr_name);
					  if(!empty($p))
					  {
						  $pr_name = $p[0];
					  }	
					  
					  //upload picture
					  $copy_prof = copy($google_picture,pathup("photo/$username/profile_pic/$pr_name"));
					  
					  if(!$copy_prof)
					  {
						echo "data profile tidak berhasil di copy";  
					  }
					  
					  // insert cover ke database
					  $str_pr  = "INSERT INTO photo_pelaut_tr SET 			 	 ";
					  $str_pr .= "nama_gambar	= '$pr_name'					,";
					  $str_pr .= "size_gambar	= '$pr_size'					,";
					  $str_pr .= "id_pelaut		= '$pelaut_id'					,";
					  $str_pr .= "type_gambar	= '$dt_cover[mime]'				,";
					  $str_pr .= "datetime		= now()							,";
					  $str_pr .= "ip_address		= '".$_SERVER['REMOTE_ADDR']."' ,";
					  $str_pr .= "username		= '$username'					,";
					  $str_pr .= "profile_pic	= 1							 	 ";
					  
					  $this->db->query($str_pr);
					  
					  
					}
					
					$data_user = array(
					  "username"	 => $username,
					  "first_name"   => $google_firstname,
					  "last_name"	=> $google_lastname,
					  "email"		=> $google_email,
					  "password"	 => md5($password),
					  "true_pass"	=> $password,
					  "activation"   => $f['activation'],
					);
					
					
					// send_email activation code
					$this->send_email($data_user);
					
					
					// login
					$dt = array('id_user'  => $pelaut_id,
								'username' => $username,
								'email' 	=> $google_email,
								'user' 	 => "pelaut",
								'type_user'=> "pelaut",
								'nama' 	 => $google_firstname." ".$google_lastname);
		
					$this->session->set_userdata($dt);
					// session untuk iFlyChat
					$pelaut_id 			= $pelaut_id;
					$username_pelaut	= $username;

					$get_avatar 		 = $this->user_model->get_profile_pic($pelaut_id);
					$get_avatar2 		= explode(".", $get_avatar);
					$name_avatar 		= $get_avatar2[0];
					$type_file 			= $get_avatar2[1];
					$pic_small 			= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
					$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
					if (file_exists($pic_small)) {
						$avatar_url 	= $pic_small;
					}else{
						$avatar_url 	= $pic_default;
					}
					
					$_SESSION['id_user2']			  = $pelaut_id;
					$_SESSION['username_agent']		= $username;
					$_SESSION['avatar_url']			= $avatar_url;
					// end iFlyChat
					
					$dt['msg'] = "You're Login Sucessfully with Google+";
					$dt['url'] = base_url("seaman/resume");
					
					//tracker
					$action  = $this->config->item("google");
					track_seatizen($pelaut_id,$action["reg"]);
					
					echo json_encode($dt);
					
				}
				else // login
				{
					$dt = array('id_user'  => $f['pelaut_id'],
								'username' => $f['username'],
								'email' 	=> $f['email'],
								'user' 	 => "pelaut",
								'type_user'=> "pelaut",
								'nama' 	 => $f['nama_depan']." ".$f['nama_belakang']);
		
					$this->session->set_userdata($dt);
					
					// session untuk iFlyChat
					$pelaut_id 			= $f['pelaut_id'];
					$username_pelaut	= $f['username'];

					$get_avatar 		= $this->user_model->get_profile_pic($pelaut_id);
					$get_avatar2 		= explode(".", $get_avatar);
					$name_avatar 		= $get_avatar2[0];
					$type_file 			= $get_avatar2[1];
					$pic_small 			= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar."_small.".$type_file;
					$pic_default 		= "http://informasea.com/infrasset/photo/".$username_pelaut."/profile_pic"."/".$name_avatar.".".$type_file;
					if (file_exists($pic_small)) {
						$avatar_url 	= $pic_small;
					}else{
						$avatar_url 	= $pic_default;
					}
					
					$_SESSION['id_user2']			= $f['pelaut_id'];
					$_SESSION['username_agent']		= $f['username'];
					$_SESSION['avatar_url']			= $avatar_url;
					// end iFlyChat
					
					$dt['msg'] = "You're Login Sucessfully";
					$dt['url'] = base_url("seaman/resume");
					
					echo json_encode($dt);
				}
			
			}
			
		}
		
		// insert data 
		
		// login 
		
		// load
		
		
	}
	
	function __destruct()
	{
		
	}
	
	
	
}