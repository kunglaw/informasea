<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Controller users, module users

class Users extends MX_Controller {
	
	private $db;
	
	function __construct()
	{
		
		parent::__construct();
		
		
		$this->db = $this->load->database(DB_SETTING,TRUE);
		load_all_language();
		
		//authentification
		$this->authentification->open_access();
		
		
		$this->load->model('user_model');
		$this->load->model("company_model");
		$this->load->model('nation_model');


        $this->load->config("meta");
	}
	
	function register_fb()
	{
		$this->load->library("token");
		
		$t = $this->input->get("t",true);
		$now = date("Y-m-d H:i:s");
		
		$data_token = array("no_token"=>$t,"expiry_date >"=>$now);
		$check_token = $this->token->check_token($data_token);
		
		if(!empty($check_token) || $t=="test")
		{
			$data['head']	    = "head";
			$data['title']	    = "Register by Facebook";
			$data['css']	    = "css"; //css tambahan, di head

            $data['meta']	    = "register-fb/meta"; // meta tambahan, di head
            $meta_user          = $this->config->item("meta_user");
            $data["meta_user"]  = $meta_user["register_fb"];

			$data['js_top']     = "js_top"; // js tambahan, di head
		
			$data['navbar']     = "include/navbar-login";
			$data['template']   = "register-fb/register-fb.php";
		
			$data['footer']     = "footer";
			$data['js_under']   = "js_under";
		
			$this->load->view("register",$data);  
		}
		else
		{
			//echo "why ?";
			header("location:".base_url("users/register"));	
		}  
	}

	
	function get_rank()
	{
		$id_department = $this->input->post("dept_id");
		$q = "select * from rank where id_department = '$id_department'";
		$exec = $this->db->query($q);
		$hasil = $exec->result_array();
		echo "<option value='' selected disabled>- Select Your Rank -</option>";
		foreach ($hasil as $value) {
			echo "<option value='$value[rank_id]'>$value[rank]</option>";
		}
	}
	
	function register_google()
	{
		$data['head']	  = "head";
		$data['title']	 = "Register by Google";
		$data['css']	   = "css"; //css tambahan, di head

        $data['meta']	   = "register-google/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["register_fb"];

        $data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "register-google/register-google.php";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view("register",$data);
	}
	
	public function create_vacantsea()
	{
		// check dari table admin_send_email_agentsea, pada database informasea_admin
		/* $check_invitation["val"] = TRUE;//$this->user_model->check_invitation(); // untuk sementara di non aktifkan
		$db = $this->load->database(DB_SETTING,true);

		if($check_invitation["val"] == TRUE)
		{*/
		
		  $this->load->model('vessel_model'); 
		  $this->load->model('vacantsea/vacantsea_model');
		  $this->load->model("seaman/resume_model");
		  //echo "test"; exit;
		  $data['vessel_type']   = $this->vessel_model->get_ship_type();
		  //$data['coc_class'] 	 = $this->resume_model->get_coc_class();
		  $data['department'] 	= $this->vacantsea_model->call_department();
		  $data['rank'] 	      = $this->resume_model->get_rank();
		  
		  $data['head']	   = "head";
		  $data['title']	  = "Create Vacantsea";
		  $data['css']	    = "css"; //css tambahan, di head
  
		  $data['meta']	   = "create-vacantsea/meta"; // meta tambahan, di head
		  $meta_user          = $this->config->item("meta_user");
		  $data["meta_user"]  = $meta_user["register_fb"];
  
		  $data['js_top']     = "js_top"; // js tambahan, di head
		  
		  $data['navbar']     = "include/navbar-login";
		  $data['template']   = "create-vacantsea/create-vacantsea.php";
		  
		  $data['footer']     = "footer";
		  $data['js_under']   = "js_under"; 
		  
		  $data["cprofile"]   = $check_invitation["dt"];		  
		  $this->load->view("register",$data);
		/* }
		else
		{
			show_404();	
		}*/
		
	}
	
	public function login()
	{
		$session_set_value = $this->session->all_userdata();
		
		if($session_set_value['remember_me'] == 1){
			
            header("location:".base_url("dashboard"));
			
        }
		
		$data['head']	  = "head";
		$data['title']	 = "Login as Seaman";
		$data['css']	   = "css"; //css tambahan, di head

		$data['meta']	   = "login/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["login_"];

        $data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "login/login.php";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$data["remember_me"] = isset($session_set_value['remember_me']) ? $session_set_value['remember_me'] : 0;
		
		$this->load->view('register',$data);
	}
	
	function login_univ() // is this necessary ? 
	{
		$session_set_value = $this->session->all_userdata();
		
		if($session_set_value['remember_me'] == 1){
            header("location:".base_url("dashboard"));
        }
		
		$data['head']	 = "head";
		$data['title']	= "Login";	
		$data['css']	  = "css"; //css tambahan, di head

		$data['meta']	 = "login-universal/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["login_universal"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "login-universal/login.php";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$data["remember_me"] = isset($session_set_value['remember_me']) ? $session_set_value['remember_me'] : 0;
		
		$this->load->view('register',$data);
		
	}
	
	function login_company()
	{
		$session_set_value = $this->session->all_userdata();
		
		/* if($session_set_value['remember_me'] == 1){
            header("location:".base_url("dashboard"));
        }*/
		
		$data['head']	 = "head";
		$data['title']	= "Login as Company";	
		$data['css']	  = "css"; //css tambahan, di head

		$data['meta']	 = "login-company/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["login_agentsea"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "login-company/login.php";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$data["remember_me"] = isset($session_set_value['remember_me']) ? $session_set_value['remember_me'] : 0;
		
		$this->load->view('register',$data);
	}
	
	function login_company_modal()
	{
		
		// halaman ini hanya bisa dibuka sekali
		
		$this->load->library("token");
		
		$t = $this->input->get("t",true);
		
		$data_token = array("no_token"=>$t);
		$check_token = $this->token->check_token($data_token);
		
		if(!empty($check_token))
		{
		  $session_set_value = $this->session->all_userdata();
		  
		  if($session_set_value['remember_me'] == 1){
			  header("location:".base_url("dashboard"));
		  }
		  
		  $data['head']	 = "head";
		  $data['title']	= "Login as Company";	
		  $data['css']	  = "css"; //css tambahan, di head
		  $data['meta']	 = "login-company-modal/meta"; // meta tambahan, di head
		  $data['js_top']   = "js_top"; // js tambahan, di head
		  
		  $data['navbar']   = "include/navbar-login";
		  $data['template'] = "login-company-modal/login.php";
		  
		  $data['footer']   = "footer";
		  $data['js_under'] = "js_under"; 
		  
		  $data["remember_me"] = isset($session_set_value['remember_me']) ? $session_set_value['remember_me'] : 0;
		  
		  $this->load->view('register',$data);	
		}
		else
		{
			header("location:".base_url("users/login/agentsea"));	
		}
	}
	
	function formactivation_agent()
	{
		$user = $this->uri->segment(3);
		
		$data['head']	 = "head";
		$data['title']	= "Form Activation ";	
		$data['css']	  = "css"; //css tambahan, di head

		$data['meta']	 = "formactivation/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["formactivation_agent"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "formactivation/formactivation-agentsea";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view('register',$data);	
	}
	
	function formactivation()
	{
		$user = $this->uri->segment(3);
		
		$data['head']	  = "head";
		$data['title']	  = "Form Activation Seaman";
		$data['css']	  = "css"; //css tambahan, di head

		$data['meta']	  = "formactivation/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["formactivation"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "formactivation/formactivation";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view('register',$data);
			
	}
	
	public function forgotpass()
	{
		$user = $this->uri->segment(3);
		
		$data['head']	 = "head";
		$data['title']	= "Forgot Password";	
		$data['css']	  = "css"; //css tambahan, di head

		$data['meta']	 = "forgotpass/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["forgotpass"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "forgotpass/forgotpass_bak";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under";
		
		//exit(print_r($data));
		
		$this->load->view('register',$data);
	}
	
	public function change_password()
	{
		// check token -> ada atau tidak di database
		$this->load->library("token");
		
		$u = $this->input->get("u",TRUE);
		$t = $this->input->get("t",TRUE); // token
		$email = $this->input->get("email",TRUE);
		
		$now = date("Y-m-d H:i:s");
		$data_token       = array("email"=>$email,"type_user"=>"pelaut","page"=>"forgotpass","expiry_date >"=>$now,"no_token"=>$t);  
		$check_token	  = $this->token->check_token($data_token);
		
		if(!empty($check_token))
		{
			$data["email"]    = $check_token["email"];
			$data["no_token"] = $t;
			$data["username"] = $u;
			// buat dahulu form nya
			 
			$data['head']	 = "head";
			$data['title']	 = "Change Password ";
			$data['css']	 = "css"; //css tambahan, di head

			$data['meta']	    = "change_password/meta"; // meta tambahan, di head
            $meta_user          = $this->config->item("meta_user");
            $data["meta_user"]  = $meta_user["change_password"];

			$data['js_top']   = "js_top"; // js tambahan, di head
			
			$data['navbar']   = "include/navbar-login";
			$data['template'] = "change_password/change_password";
			
			$data['footer']   = "footer";
			$data['js_under'] = "js_under"; 
			
			$this->load->view("register",$data);	
			
		}
		else
		{
			show_404();	
		}
	}
	
	public function forgotpass_company()
	{
		$user = $this->uri->segment(3);
		
		$data['head']	 = "head";
		$data['title']	= "Forgot Password Agentsea";	
		$data['css']	  = "css"; //css tambahan, di head

		$data['meta']	 = "forgotpass-company/meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["forgotpass_agent"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		$data['navbar']   = "include/navbar-login";
		$data['template'] = "forgotpass-company/forgotpass";
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under";
		
		//exit(print_r($data));
		
		$this->load->view('register',$data);
		
	}

	function activate_account(){
		$a = $this->input->get('a',true);
		$e = $this->input->get('email',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);
		if($a == "" && $e == "" && $x == "" && $u == "" && $p == "") show_404();
		else{
			$f = $this->user_model->check_activation();
			if(!empty($f)) {
				$data['dt_username']=$u;
				$data['dt_email']=$e;
				$q = "select * from pelaut_ms where username = '$u'";
				$exec = $this->db->query($q);
				$hasil = $exec->row_array();
				$data['first_name'] = $hasil['nama_depan'];
				$data['last_name'] = $hasil['nama_belakang'];
		// $key = $this->input->get("k");
		// if($key == "sembil4n"){
		// 	$data['first_name'] = "Raditya";
		// 		$data['last_name'] = "pratama";
				$data['title'] = "Activation Step Seatizen";
				$this->load->view("step-activation-seatizen",$data);
			// }else show_404();
		
			}
			else show_404();
		}
		
	}

	function activate_agentsea(){
		
		$a = $this->input->get('a',true);
		$e = $this->input->get('email',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);
		
		//print_r($_GET); exit;
		
		if($a == "" && $e == "" && $x == "" && $u == "" && $p == "") show_404();
		else{
			
			$f = $this->user_model->check_activation_company();
			
			//print_r($f); exit;
			
			if(!empty($f)) {
				
				$data['dt_username']=$u;
				$data['dt_email']=$e;
				$q = "select * from perusahaan where username = '$u'";
				$exec = $this->db->query($q);
				$hasil = $exec->row_array();
				
				// if($hasil != null)
				$data['company_name'] = $hasil['nama_perusahaan'];
				
				// echo "test";
				$data['kenegaraan'] = $hasil['nationality'];
				$data['no_telp'] = $hasil['no_telp'];
				
				// echo "test1";
				// $key = $this->input->get("k");
				// if($key == "sembil4n"){
				// 	$data['first_name'] = "Raditya";
				// 		$data['last_name'] = "pratama";
				// $data['company_name'] = "PT. Primetech Multinovative";
				
				$data['email_agentsea'] = $hasil['email'];
				$data['id_agentsea']   = $hasil['id_perusahaan'];
				
				// echo "test2";
				
				$data['title'] = "Activation Step Agentsea";
				$this->load->view("step-activation-agentsea",$data);
				
				// }else show_404();
		
			}
			else show_404();
		}
		
	}
	
	function verified_page()
	{
		$session_set_value = $this->session->all_userdata();
		
		if($session_set_value['remember_me'] == 1){
            header("location:".base_url("dashboard"));
        }
		
		$data['head']	 = "head";
		$data['title']	= "Verified page";
		$data['css']	  = "users/css"; //css tambahan, di head
		$data['meta']	 = "users/meta"; // meta tambahan, di head
		$data['js_top']   = "users/js_top"; // js tambahan, di head
		$data['js_under'] = "users/js_under"; // js tambahan, di head
		$data['template'] = "users/verified-page";
		
		$this->load->view('users/register',$data);	
		
	}

	public function index($dt)
	{
		
		$session_set_value = $this->session->all_userdata();
		
		if($session_set_value['remember_me'] == 1){
            header("location:".base_url("dashboard"));
        }
		
		$user = $this->uri->segment(3);
		
		$data['head']	  = "head";
		$data['title']	  = $dt['title'];
		$data['css']	  = "css"; //css tambahan, di head

        $data['meta']	  = "meta"; // meta tambahan, di head
        $meta_user          = $this->config->item("meta_user");
        $data["meta_user"]  = $meta_user["register"];

		$data['js_top']   = "js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";		
		$data['rwnation'] = $this->nation_model->get_nationality();
		$data['rwuser'] = $this->user_model->get_pelaut();
		
		//$check = $this->check_username();
		//$data['info'] = $check['info'];
		
		if($user == "agentsea")
		{
			$data['title']	= "Register as Agentsea";
			$data['template'] = "register-agentsea";
		}
		else
		{
			$data['template'] = $dt['template'];
		}
		
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		
		$this->load->view($dt['destination'],$data);
		
	}
	
	public function register()
	{
		$data['template'] = "template";
		$data['destination'] = "register";
		$data['title']	  = "Register as Seaman";
		$this->index($data);
	}

	public function register_all()
	{
		$data['template'] = "template-register-all";
		$data['destination'] = "register-all";
		$data['title']	  = "Register to Informasea";
		$this->index($data);
	}
	
	
	function __destruct()
	{
		
		
	}
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */