<?php if(!defined("BASEPATH")) exit ("NO Direct Script Access Allowed");

class Home_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();	
		
		$this->load->model("users/company_model","ucompany");
		$this->load->model("company/company_model","ccompany");
		
		$this->load->model("users/user_model");
		$this->load->model("vacantsea/vacantsea_model");
		$this->load->model('nation_model');
		
		$this->load->library("token");
	}
	
	function create_vacantsea()
	{
		$this->input->is_ajax_request();
		$this->load->library("check_data");
		
		// insert vacantsea
		$this->load->library("form_validation");	
		$this->form_validation->set_error_delimiters('<div>', '</div>');	
		
		$vacantsea_title = $this->input->post("vacantsea_title",TRUE);
		//$id_perusahaan = $this->input->post("id_perusahaan",TRUE);
		//$perusahaan	 = $this->input->post("perusahaan",TRUE);
		//$description	 = $this->input->post("description",TRUE);
		
		$department	  = $this->input->post("department_id",TRUE);
		$rank_id 		 = $this->input->post("rank",TRUE);
		$ship_type	   = $this->input->post("ship_type",TRUE);
		
		//$nav_area		 = $this->input->post("navigation_area",TRUE);
		$annual_sallary  = $this->input->post("annual_sallary",TRUE);
		$sallary_range   = $this->input->post("sallary_range",TRUE); 
		$range_sallary   = $this->input->post("range_sallary",TRUE);
		
		//$contract_dynamic = $this->input->post("contract_dynamic",TRUE);
		//$benefits		    = $this->input->post("benefits",TRUE);
		//$nationality	    = $this->input->post("nationality",TRUE); 
		
		/* 
		Array
		(
			[vacantsea_title] => rewdgfdeswf
			[department_id] => 4
			[rank] => 201
			[ship_type] => 
			[sallary_curr] => IDR
			[annual_sallary_] => 1500
			[range_sallary_] => /Day
		)*/
		
		$this->form_validation->set_rules("vacantsea_title","Vacantsea Title","required|xss_clean");
		//$this->form_validation->set_rules("description","Description","required|xss_clean");
		$this->form_validation->set_rules("department_id","Department","required|xss_clean");
		$this->form_validation->set_rules("rank","Rank","required|xss_clean");
		$this->form_validation->set_rules("ship_type","Ship Type","required|xss_clean");
		
		//$this->form_validation->set_rules("navigation_area","Navigation Area","xss_clean");
		$this->form_validation->set_rules("annual_sallary","Annual Sallary","integer|xss_clean");
		$this->form_validation->set_rules("sallary_range","Sallary Range","xss_clean");
		$this->form_validation->set_rules("range_sallary","Range Sallary","xss_clean");
		
		
		//$this->form_validation->set_rules("contract_dynamic","Contract Dynamic","xss_clean");
		//$this->form_validation->set_rules("benefits","Benefits","xss_clean");
		//$this->form_validation->set_rules("nationality","Nationality","xss_clean");
		
		$username 		= $this->input->post("username"		   ,true);
		$nama_perusahaan = $this->input->post("agentsea_name"	,true);
		$contact_person  = $this->input->post("contact_person"	 ,true);
		
		$ext_num		 = $this->input->post("ext_num"			,true);
		$phone_number    = $this->input->post("phone_number"	   ,true);
		$a	 		   = explode("&",$ext_num);
		$nationality 	 = $this->nation_model->get_detail_nationality($a[1]); 
		
		//$role			= $this->input->post("role"			   ,true);
		
		//$nationality 	 = $this->input->post("nationality"		,true);
		$email 		   = $this->input->post("email"			  ,true);
		$reemail		 = $this->input->post("reemail"			,true);
		
		$password		= md5($this->input->post("password"	   ,true)); // encrypt
		$repassword	  = $this->input->post("re_password"		,true);
		
		/* Array
		(
			[agentsea_name] => asdasdasd
			[ext_num] => +62				
			[phone_number] => 94894854
			[nama_perusahaan] => username
			[contact_person] => dimas
			[email] => alhusna901@gmail.com
			[password] => 999999
			[re-password] => 999999
		)*/
		
		$this->form_validation->set_rules("username",		"Username","required|xss_clean|min_length[6]|alpha_dash");
		//$this->form_validation->set_rules("ext_num",		 "Extention Number", "required|xss_clean");
		$this->form_validation->set_rules("phone_number",	"Phone Number","required|numeric|xss_clean");
		//$this->form_validation->set_rules("role"		, 	"Role","required|xss_clean");
		$this->form_validation->set_rules("agentsea_name",  "Company Name","required|xss_clean"); 
		$this->form_validation->set_rules("contact_person", "Contact Person","required|xss_clean");
		
		$this->form_validation->set_rules('email',		   'Email','required|valid_email|xss_clean|min_length[6]');
		$this->form_validation->set_rules('password',		'Password','required|matches[re_password]|xss_clean|min_length[6]');
		
		$check_username = $this->check_data->check_username($username);
		$check_email	= $this->check_data->check_email($email);
		
		if($this->form_validation->run() == true && $check_email == true && $check_username == true)
		{
			$this->load->model("home_model");
			$ab = $this->home_model->create_vacantsea();
			
			if($ab == true)
			{
			  // EMAIL
			  $this->load->library("my_email");
			  
			  $content['subject'] 		= "Informasea Activation Account"; // string
			  $content["subject_title"]  = "Informasea Activation Account"; //string
			  $content["to"]			 = $email;
			  
			  $content['message']		= "users/email/email-activation-agentsea"; // String, bisa sebuah path untuk di view
			  $content["mv"]   			 = TRUE; // BOOLEAN , apakah message ini 
			  $content["alt_message"]	= "users/email/email-activation-agentsea-alt"; // string
			  $content["amv"]			= TRUE;
			  
			  // get data company
			  $company = $this->ccompany->get_detail_company($username);
			  
			  if(!empty($company))
			  {
				  $content["data"]['nama_perusahaan'] = $company["nama_perusahaan"];
				  $content["data"]['username']	    = $company['username'];
				  $content["data"]['password']	    = $company['password']; // ini jangan di md5
				  $content["data"]['email']	       = $company['email'];
				  
				  //create token
				  $no_token = $this->token->generate(64);
				  $data_token = array(
				  		
						"page"  	  => "login_agentsea_modal",
				 		"email" 	 => $email,
				  		"type_user" => "company",
				 	 	"no_token"  => $no_token,
				  		"jml"       => "+1",
				  		"satuan"    => "hours"
						
				   );
									  
				  $insert_token = $this->token->insert_token($data_token);
				  $read_token = $this->token->read_token($no_token);
				  
				  $str_url  = "home/home_process/activate/?";
				  $str_url .= "a=$company[activation_code]&";
				  $str_url .= "x=1&"; 
				  $str_url .= "u=$company[username]&";
				  $str_url .= "p=$company[password]&";
				  $str_url .= "email=$company[email]&";
				  $str_url .= "t=$read_token[no_token]";
				  
				  $bstr_url = base_url($str_url);
				  
				  $content["data"]['str_url'] 	 = $bstr_url;
				  $content["data"]["email_to"]    = $email;
				  $user = "info";
				  
				  $this->my_email->send_email($user,$content);
				  
				  // tracker
				  track_agentsea($company["id_perusahaan"],"register_create_vacantsea");
			  }
			  
			  
			}
			
		}
		else
		{
			echo validation_errors();
		}
		
		//echo " <br> kenapa ? ";
		
	}
	
	function request_activation_code()
	{
		
		 //jika no_token ada di database tp sudah expired, maka jalankan request token 
		 $t = $this->input->get("t",TRUE);
		 $now = date("H-m-d H:i:s");
		 $data_token = array("no_token"=>$t,"expiry_date <"=>"$now");
		 $check_token = $this->token->check_token();
		 
		 //get data company
		 $this->db->where("email",$check_token['email']);
		 $q = $this->db->get("perusahaan");
		 $company = $q->row_array();
		 
		 if(!empty($check_token))
		 {
		  
		    $content['subject'] 		= "Request Activation Account"; // string
			$content["subject_title"]  = "Request Activation Account"; //string
			$content["to"]			 = $email;
			
			$content['message']		= "users/email/email-activation-agentsea"; // String, bisa sebuah path untuk di view
			$content["mv"]   			 = TRUE; // BOOLEAN , apakah message ini 
			$content["alt_message"]	= "users/email/email-activation-agentsea_alt"; // string
			$content["amv"]			= TRUE;
		  
		  //create token baru
		  $no_token = $this->token->generate(64);
		  $data_token = array("page"=>"login_agentsea_modal",
							  "email"=>$company["email"],
							  "type_user"=>"company",
							  "no_token"=>$no_token,
							  "jml"=>"+1",
							  "satuan"=>"hours");
		  $insert_token = $this->token->insert_token($data_token);
		  $read_token = $this->token->read_token($no_token);
		  
		  $str_url  = "home/home_process/activate/?";
		  $str_url .= "a=$company[activation_code]&";
		  $str_url .= "x=1&"; 
		  $str_url .= "u=$company[username]&";
		  $str_url .= "p=$company[password]&";
		  $str_url .= "email=$company[email]&";
		  $str_url .= "t=$read_token[no_token]";
		  
		  $bstr_url = base_url($str_url);
		  
		  $content["data"]['str_url'] 	 = $bstr_url;
		  $user = "info";
		  
		   // delete token lama
		  $dt_del_tok = array("no_token"=>$t);
		  $this->token->delete_token($dt_del_tok);
		  
		  $this->my_email->send_email($user,$content);
		  
		  $data_cookie = array(
				  "company_name"     => $data_user["nama_perusahaan"],
				  "photo_company"    => $logo,
				  "username_company" => $data_user['username'],
				  "cover_company"	=> $cover,
				  "success_company"  => "<div class='alert alert-success'> We already send you an activation code with new token. please activated your account soon </div>"
		  );
		  
		  define_cookie_company($data_cookie);
		  
		 }
		 else
		 {
			 
		 }
		 
		 header("location:".base_url("users/login/agentsea_modal")."");
		
	}
	
	/* function insert_vacantsea()
	{
		
		
		$info["err"] 	 = FALSE;
		$info["success"] = FALSE;
		
		if($this->form_validation->run() == true)
		{
			$q = $this->vacantsea_model->insert_vacantsea();
			
			if($q)
			{
				$info['success'] = TRUE;
				$info['s_message'] = "<div class='alert alert-danger'> Data Successfully Inserted </div>";
			}
			else
			{
				$info['err'] = TRUE;
				$info['err_message'] = "<div class='alert alert-danger'> Data couldn't Inserted </div>";
					
			}
		}
		else
		{
			$info['err'] = TRUE;
			$info['err_message'] = "<div class='alert alert-danger'> ".validation_errors()."</div>";	
		}
		
		echo json_encode($info);
		
	}*/
	
	/* function insert_agentsea()
	{
		$this->load->library("form_validation");
		
		
		
		$info["err"] 	 = FALSE;
		$info["success"] = FALSE;
		
		if($this->form_validation->run() == TRUE)
		{
			// users/company_model
			$q = $this->ucompany->register_company();
			
			if($q)
			{
				// email confirmation
				
				$info['success']	 = TRUE;
				$info["s_message"]   = "<div class='alert alert-success'> Data Successfully Inserted </div>";
			}
			else
			{
				$info["err"] 		 = TRUE;
				$info["err_message"] = "<div class='alert alert-danger'> data couldn't inserted </div>";	
			}
			
		}
		else
		{
			$info["err"] 		 = TRUE;
			$info["err_message"] = "<div class='alert alert-danger'> ".validation_errors()." </div>";	
		}
		
		echo json_encode($info);
	}*/
	
	function activate()
	{
		$this->load->model("users/user_model");
		$this->load->helper("user_cookie");
		
		$a = $this->input->get('a',true);
		$e = $this->input->get('email',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);
		$t = $this->input->get("t",true);
		
		clear_cookie_company(); // clear cookie
		
		// check token terlebih dahulu
		$now = date("Y-m-d H:i:s");
		$data_token = array("no_token"=>$t,"expiry_date >"=>"$now");
		$check_token = $this->token->check_token($data_token);
		
		$f = $this->user_model->check_activation_company();
		
		if(!empty($f))
		{
		  if(!empty($check_token))
		  {
			// panggil function activation
			// check di database
			
			// activasi di table database
			
			$this->user_model->update_activation_company($e);
			// halaman login dengan header pengguna
			
			/* kondisi klo username ada tp pass salah */
			$str_cu = "select * from perusahaan where username = '$u'";
			$q_cu   = $this->db->query($str_cu);
			$f_cu   = $q_cu->row_array();
			
			$data_user = array(
			  "username"	   => $f_cu['username'],
			  "nama_perusahaan"=> $f_cu["nama_perusahaan"],
			  "email"		  => $f_cu['email'],
			  "password"	   => $f_cu['password'],
			  "activation"     => $f_cu['activation']
			);
			
			clear_cookie_company(); // clear cookie
	
			$logo = check_logo_agentsea($data_user["username"]);
			$cover = check_cover_agentsea($data_user['username']);
			
			$data_cookie = array(
					"company_name"     => $data_user["nama_perusahaan"],
					"photo_company"    => $logo,
					"username_company" => $data_user['username'],
					"cover_company"	=> $cover,
					"success_company"  => "<div class='alert alert-success'> Congratulation! you already activated your account at informasea.com, please login to use our feature at informasea.com </div>"
			);
			
			define_cookie_company($data_cookie);
			
			// halaman login dengan header pengguna
			header("location:".base_url("users/login/agentsea_modal?t=$t")); // users/login/agentsea_modal
			

		  }
		  else
		  {
  
			  $str_url  = "home/home_process/request_activation_code?t=$t";
			  
			  $url_url = base_url($str_url);
			  
			  $data_cookie['error'] = "<div class='alert alert-warning'> Your token has expired, please request a new token for activate your account again <a href='".$url_url."'> Request activation code </a> </div>";
			  $this->session->set_flashdata("error",$data_cookie['error']);
			  
			  $this->session->set_flashdata("error",$data_cookie['error']);  
			  // halaman login dengan header pengguna
			  header("location:".base_url("users/login/agentsea")); // users/login/agentsea_modal
			  
		  }
		}
		else
		{
			
			$data_cookie['error'] = "<div class='alert alert-warning'> You actually has been activated your account with this activation code. please login to continue    </div>";
			
			$this->session->set_flashdata("error",$data_cookie['error']);  
			// halaman login dengan header pengguna
			header("location:".base_url("users/login/agentsea")); // users/login/agentsea_modal
		}
		

	}
	
	function get_rank()
	{
		$this->load->model("rank_model");
		
		$id 	  = $this->input->post("department_id");
		//$id_rank = $this->input->post("id_rank"); 
		
		$rank = $this->rank_model->get_rank_bydept($id);

		
		if(!empty($rank))
		{
		  foreach($rank as $row)
		  {
			  $sr = "";
			  if($row['rank_id'] == $id_rank ){
				//$sr = "selected='selected'";  
			  }
			  echo "<option value='$row[rank_id]' $sr >$row[rank]</option>";
		  }
		}
		else
		{
			echo "<option value='0' >- Select -</option>";
			
		}
	}
	
	function check_username()
	{
		$is_ajax = $this->input->is_ajax_request();
		
		if($is_ajax == true)
		{
			$username = $this->input->post("username");
			
			$this->load->library("check_data");
			$check_username = $this->check_data->check_username($username);
			
			if($check_username == true)
			{
				echo "true";
				//echo "";
			}
			else
			{
				//echo "Username already exists";
				echo "false";
			}
		}
		else
		{
			show_404();	
		}
		
	}
	
	function check_email()
	{
		$is_ajax = $this->input->is_ajax_request();
		
		if($is_ajax == true)
		{
			
			$this->load->model("users/company_model");
			
			$email = $this->input->post("email");
			
			
			$this->load->library("check_data");
			$check_email = $this->check_data->check_email($email);
			$cajax_genemail = $this->company_model->cajax_genemail($email); // generic - table generic email
			
			if($check_email == true)
			{
				$m["val_a"] = TRUE;	
				$m["msg_a"] = "";
			}
			else
			{
				$m["val_a"] = FALSE;
				$m["msg_a"] = "<div> Email already Exists </div>";
			}
			
			if(!empty($cajax_genemail))
			{
				$m["val_b"] = FALSE;	
				$m["msg_b"] = "<div> Please use your company email address </div>";
			}
			else
			{
				$m["msg_b"] = "";
				$m["val_b"] = TRUE;	
			}
			
			if($m["val_a"] === TRUE && $m["val_b"] === TRUE)
			{
				echo "true";
				//return TRUE;
			}
			else
			{
				echo "false";
				//return FALSE;
			}
			
		}
		else
		{
			show_404();	
		}
	}
	
	function test()
	{
		
		echo "ini test";	
	}
	
	function __destruct()
	{
		
	}
	
	
	
}