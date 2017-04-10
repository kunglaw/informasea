<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class company_model extends CI_Model{
	
	public function get_company()
	{
		
		$sql = "select * from perusahaaan ";
		$q = $this->db->query($sql);
		$f = $q->result_array();
		
		return $f; 	
		
	}
	
	public function get_detail_company($username = "")
	{
		if($username == "")
		{
			$username = $this->uri->segment(2);
		}
		
		$str = "select * from perusahaan where username = '$username' ";
		
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
	}
	
	public function get_detail_company_byid($id = "")
	{
		$str = "select * from perusahaan where id_perusahaan = '$id' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;		
	}
	
	public function get_detail_company_byemail($email)
	{
		$str = "select * from perusahaan where email = '$email' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
			
	}
	
	public function get_last_company()
	{
		// Mengetahui user terakhir / baru daftar 
		$str = "select * from perusahaan order by pelaut_id desc limit 1 ";
		$q = $this->db->query($str);
		$f = $q->row_array();	
		
		return $f;
	}
	
	public function check_activation()
	{
		/*$a = $this->input->get('a',true);
		$e = $this->input->get('e',true);
		$x = $this->input->get('x',true);
		$u = $this->input->get('u',true);
		$p = $this->input->get('p',true);*/
		
		$activate_url = $this->input->get("a");
		$email_url 	= $this->input->get("email");
		$username_url = $this->input->get("u");
		$password	 = $this->input->get("p");
		
		$str = "select * from perusahaan where username = '$username_url' and email = '$email_url' and password = '$password' and activation_code = '$activate_url' ";
		
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;	
		
	}
	
	// check activation code
	// digunakan di forgot_pass
	function check_activation_code($value) // email, username, id
	{
		$str = "SELECT * FROM perusahaan WHERE ( username = '$value' OR email = '$value' OR id_perusahaan = '$value' ) AND activation_code = 'ACTIVE'  ";	
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
	}
	
	function forgot_pass($password,$email)
	{
		$password = md5($password);
		$str = "update perusahaan set password = '$password' where email = '$email' AND activation_code = 'ACTIVE' ";
		
		return $q = $this->db->query($str);
		
	}
	
	public function update_activation($email)
	{
		$str = "update perusahaan set activation_code = 'ACTIVE' where email = '$email' ";
		$q = $this->db->query($str);
		
		return $q;
	}
	
	public function get_logo_pic($id_perusahaan)
	{
		$str = "select nama_gambar from photo_perusahaan_tr where (id_perusahaan = '$id_perusahaan' or `username` = '$id_perusahaan') and profile_pic = 1 ";
		
		$sql = $this->db->query($str);
		
		$profile_pic = $sql->row_array();
		
		if(empty($profile_pic))
		{
			$gambar = "";	
		}
		else
		{
			$gambar = $profile_pic['nama_gambar'];	
		}
		
		return $gambar; 
		
	}
	
	/*login ada di company.informasea */
	public function login($username,$password)
	{
		// pelaut , agent , company		
		
		$sql = "select * from perusahaan where (username = '$username' or email = '$username') and password = '$password' and activation_code = 'ACTIVE' ";
		$q = $this->db->query($sql);
		$fcompany = $q->row_array();
		
		$sqla = "select * from agent_ms where (username = '$username' or email = '$username') and password = '$password' ";
		$qa   = $this->db->query($sqla);
		$fa   = $qa->row_array(); 
		
		
		$user = "company";
		$f = array('user' => $user,$fcompany);
		
		if(empty($fcompany))
		{
			$user = "agent"; 
			$f = array('user'=>$user,$fa);
		}
		
		return $f;
			
	}
	
	// penting
	/* function check_expired_company()
	{
		
		// sql expired 
		$sql = "select * from perusahaan where (username = '$username' or email = '$username') and password = '$password' 
		and activation_code = 'ACTIVE' ";
		$q = $this->db->query($sql);
		$fcompany = $q->row_array();
		
		// call 
		
		return $fcompany;
	} */
	
	// agent
	function check_agent($username)
	{
		$stra  = "select * from agent_ms where username = '$username '";
		$qa 	= $this->db->query($stra);
		$fa 	= $qa->row_array();
		
		return $fa;	
	}
	// ==== end of agent ===
	
	// username tidak active dan password benar 
	public function check_company($username, $testing=false) {
		
		//cek username ada atw ga di db		
		if(empty($username))
		{		
			$username	  = $this->input->post('username');
		}
		$tmbh = "";
		if($testing) $tmbh = "_bayangan";
		//echo $username;
		$sql = "SELECT * FROM perusahaan$tmbh WHERE (username = '$username' OR email = '$username') and activation_code = 'ACTIVE' ";
		//echo $sql;
		$q = $this->db->query($sql);
		$r=$q->row_array();
		return $r; 
	}
	
	public function cajax_username_agent($username)
	{
		$str = "select * from agent_ms where username = '$username' ";
		$q = $this->db->query($str);
		$f = $q->num_rows();
		
		return $f;
	}
	
	public function cajax_username($username)
	{
		$str = "select * from perusahaan where username = '$username' ";
		$q = $this->db->query($str);
		$f = $q->num_rows();
		
		return $f;	
	}
	
	public function cajax_email_agent($email)
	{
		$str = "select * from perusahaan where email = '$email' ";
		$q = $this->db->query($str);
		$f = $q->num_rows();
		
		return $f;	
	}
	
	public function cajax_email($email, $testing=false)
	{
		$tmbh = "";
		if($testing) $tmbh = "_bayangan";
		/*echo */$str = "select * from perusahaan$tmbh where email = '$email' ";
		$q = $this->db->query($str);
		$f = $q->num_rows();
		
		return $f;	
	}
	
	public function cajax_genemail($email)
	{
		// potong dahulu domain email nya 
		$a = explode("@",$email); //ottoman@gmail.com => array("ottoman","gmail.com")
		$b = explode(".",$a[1]); // gmail.com => array("gmail","com")
		
		$str = "select * from generic_email where email_domain = '$b[0]' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
	}
	
	// USERNAME yang tidak ACTIVE dan password benar
	public function check_nacompany($username)
	{
		//cek username ada atw ga di db		
		if(empty($username))	
		{	
			$username	  = $this->input->post('username_lg');
		}
		
		$password = $this->input->post('password_lg');
		if(empty($password))
		{
			
			$password	  = md5($this->input->post('password_reg'));
		}
		else
		{
			$password	  = md5($password);	
		}
		
		//echo $username;
		$sql = "SELECT * FROM perusahaan WHERE ( username = '$username' or email = '$username' ) and password = '$password' and activation_code != 'ACTIVE' ";
		//echo $sql;
		$q = $this->db->query($sql);
		$r=$q->row_array();
		return $r; 	
	}
	
	public function check_email($email, $testing=false) {
		//cek email ada atw ga di db				
		// $email	  = $this->input->post('email');
		//echo $email;
		$tmbh = "";
		if($testing) $tmbh = "_bayangan";
		$sql = "SELECT * FROM perusahaan$tmbh WHERE email = '$email'";
		//echo $sql;
		$q = $this->db->query($sql);
		$r=$q->row_array();
		return $r; 
	}
	
	
	public function register_agent()
	{
		
		// 2. input hasil masukan form
		$this->load->library("form_validation");
		
		$username 		= $this->input->post("username"		   ,true);
		$nama_perusahaan = $this->input->post("nama_perusahaan"	,true);
		$contact_person  = $this->input->post("contact_person"	 ,true);
		
		$ext_num		 = $this->input->post("ext_num"			,true);
		$phone_number    = $this->input->post("phone_number"	   ,true);
		$a	 		   = explode("-",$ext_num);
		$nationality 	 = $this->nation_model->get_detail_nationality($a[1]); 
		$phone_number	= $a[0]."-".$ph;
		
		$id_nationality  = $this->input->post("nationality"		,true);
		$a = $this->nation_model->get_detail_nationality($id_nationality);
		$nationality = $a['name'];
		
		$email 		   = $this->input->post("email"			  ,true);		
		$password		= md5($this->input->post("password"));
		
		$activation 	  = md5(uniqid(rand(), true)); // kode untuk diaktivasi 
		
		//3. query proses input form dr controler
		$sql  = "INSERT INTO agent_ms set username = '$username'	   ,";
		$sql .= "perusahaan_id	 	= '$id_perusahaan'			   	   ,";
		$sql .= "no_telp			= '$phone_number'				   ,";
		$sql .= "nama				= '$contact_person'				   ,";
		$sql .= "email				= '$email'						   ,";
		$sql .= "nationality		= '$nationality[id]'			   ,";
		$sql .= "id_nationality		= '$id_nationality[name]'		   ,";
		$sql .= "password			= '$password'					   ,";
		$sql .= "account_type		= 'Free_trial'					   ,"; // default account type
		$sql .= "official			= 'Agent'						   ,"; // default official
		$sql .= "activation_code	= '$activation'						";
		
				
		$q = $this->db->query($sql); 
		
		return $q;
		
		
	}
	
	public function register_company()
	{
		
		// 2. input hasil masukan form
		$this->load->library("form_validation");
		$this->load->model("nation_model");
		$this->load->model("account_type_model","atml");
		
		$dt_at = $this->atml->detail_account_type("Free_trial"); // awal mula free_trial
		$max_crew = $dt_at['max_crew'];
		
		$username 		= $this->input->post("username"		   ,true);
		$nama_perusahaan = $this->input->post("nama_perusahaan"	,true);
		$contact_person  = $this->input->post("contact_person"	 ,true);
		$role			= $this->input->post("role"			   ,true);
		$ext_num		 = $this->input->post("ext_num"			,true);
		$ph    		  = $this->input->post("phone_number"	   ,true);
		$a	 		   = explode("&",$ext_num);
		$nationality 	 = $this->nation_model->get_detail_nationality($a[1]); 
		$phone_number	= $a[0]."-".$ph;
		
		$email 		   = $this->input->post("email"			  ,true);		
		$password		= md5($this->input->post("password"));
		
		$activation 	  = md5(uniqid(rand(), true)); // kode untuk diaktivasi 

		
		//3. query proses input form dr controler
		$sql  = "INSERT INTO perusahaan set username = '$username'	   ,";
		$sql .= "nama_perusahaan 	= '$nama_perusahaan'			   ,";
		$sql .= "no_telp			= '$phone_number'				   ,";
		$sql .= "role				= '$role'						   ,";
		$sql .= "contact_person		= '$contact_person'				   ,";
		$sql .= "email				= '$email'						   ,";
		$sql .= "nationality		= '$nationality[name]'			   ,";
		$sql .= "id_nationality		= '$nationality[id]'			   ,";
		$sql .= "password			= '$password'					   ,";
		$sql .= "create_date		= now()							   ,";
		$sql .= "active_until		= now()							   ,"; // last upgrade untuk upgrade account 
		$sql .= "account_type		= 'Free_trial'					   ,"; // default account type
		$sql .= "official			= 'Agent'						   ,"; // default official
		$sql .= "activation_code	= 'ACTIVE'							"; // feb 2017 langsung AKTIF
				
		$q = $this->db->query($sql); 
		
		$pid = mysql_insert_id();
		
		$sql2 = "INSERT INTO perusahaan_setting set id_perusahaan = '$pid', max_crew = '$max_crew' AND valid_email = 'INVALID' ";
		
		$q = $this->db->query($sql2);
		
		
		return $q;
	}

	public function register_company_all($testing = false)
	{
		
		// 2. input hasil masukan form
		$this->load->library("form_validation");
		$this->load->model("nation_model");
		$this->load->model("account_type_model","atml");
		
		$dt_at = $this->atml->detail_account_type("Free_trial"); // awal mula free_trial
		$max_crew = $dt_at['max_crew'];
		
		$username 		= $this->input->post("username_agentsea"		   ,true);
		$nama_perusahaan = $this->input->post("nama_agentsea"			   ,true);
		$website		 = $this->input->post("website"					 ,true);
		// $contact_person  = $this->input->post("contact_person"	 ,true);
		// $role			= $this->input->post("role"			   ,true);
		$ext_num		 = $this->input->post("ext_num_agentsea"			,true);
		$ph    		  = $this->input->post("phone_number_agentsea"	   ,true);
		$a	 		   = explode("&",$ext_num);
		$nationality 	 = $this->nation_model->get_detail_nationality($a[1]); 
		$phone_number	= $a[0]."-".$ph;
		
		$email 		   = $this->input->post("email_agentsea"			  ,true);		
		$password		= md5($this->input->post("password_agentsea"));
		
		$activation 	  = md5(uniqid(rand(), true)); // kode untuk diaktivasi 

		$tambahan = "";
		if($testing) $tambahan = "_bayangan";
		//3. query proses input form dr controler
		$sql  = "INSERT INTO perusahaan$tambahan set username = '$username'	   ,";
		// $sql .= "id_nationality 	= '$nationality[id]'			   ,";
		$sql .= "nama_perusahaan 	= '$nama_perusahaan'			   ,";
		$sql .= "no_telp			= '$phone_number'				   ,";
		$sql .= "role				= 'manager'						   ,";
		$sql .= "contact_person		= ''				   			   ,";
		$sql .= "website			= '$website'					   ,";
		$sql .= "email				= '$email'						   ,";
		$sql .= "nationality		= '$nationality[name]'			   ,";
		$sql .= "id_nationality		= '$nationality[id]'			   ,";
		$sql .= "password			= '$password'					   ,";
		$sql .= "create_date		= now()							   ,";
		$sql .= "active_until		= now()							   ,"; // last upgrade untuk upgrade account 
		$sql .= "account_type		= 'Free_trial'					   ,"; // default account type
		$sql .= "official			= 'Agent'						   ,"; // default official
		$sql .= "activation_code	= 'ACTIVE'						    "; // feb 2017 langsung AKTIF
				
		$q = $this->db->query($sql); 
		
		$pid = mysql_insert_id();
		
		$sql2 = "INSERT INTO perusahaan_setting$tambahan set id_perusahaan = '$pid', max_crew = '$max_crew' ";
		
		$q = $this->db->query($sql2);
		
		
		return $q;
	}
	
	
}