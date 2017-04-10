<?php



class Account_setting extends MX_Controller{

	

	

	function __construct()

	{

		parent::__construct();

		$this->authentification->underconst_access();

		

		//BAHASA

		$lang_session = $this->session->userdata("lang");

		if(empty($lang_session)) $lang_session = "english"; // nama folder

		$this->lang->load('general', $lang_session);

		$this->lang->load("seatizen",$lang_session);

		$this->lang->load("vacantsea",$lang_session);

		// =================================	

	}

	

	function change_password_modal()

	{

		$is_ajax = $this->input->is_ajax_request();	

		

		if(!$is_ajax){ show_404(); }

		else

		{

			

			$this->load->view("account/modal/change_password");

			

		}

		

	}

	

	function change_email_modal()

	{

		$is_ajax = $this->input->is_ajax_request();

		

		if(!$is_ajax){ show_404(); }

		else

		{

			$this->load->model("resume_model");

			

			$username = $this->session->userdata("username");

			$a = $this->resume_model->get_detail_pelaut($username);

			$data['email'] = $a['email'];

			

			$this->load->view("account/modal/change_email",$data);

			

			

		}

		

	}

	

	function change_name_modal()

	{

		$is_ajax = $this->input->is_ajax_request();

		

		if(!$is_ajax){ show_404(); }

		else

		{

			

			$this->load->model("resume_model");

			

			$username = $this->session->userdata("username");

			$a = $this->resume_model->get_detail_pelaut($username);

			$data['first_name'] = $a['nama_depan'];

			$data['last_name']  = $a['nama_belakang'];

			

			$this->load->view("account/modal/change_name",$data);

			

			

		}

		

	}

	

	function cover_letter_modal()

	{

		$is_ajax = $this->input->is_ajax_request();

		

		if(!$is_ajax){ show_404(); }

		else

		{

			

			$this->load->model("resume_model");

			

			$username = $this->session->userdata("username");

			$id_pelaut = $this->session->userdata("id_user");

			

			$data["pelaut"]  = $this->resume_model->get_profile_resume($id_pelaut);

			

			$this->load->view("account/modal/form-update-cover-letter",$data);

			

			

		}

		

	}



	function delete_email2(){

		$is_ajax = $this->input->is_ajax_request();



		if(!$is_ajax){

			show_404();

		}else{



			$username = $this->session->userdata('username');



			$s = "UPDATE pelaut_ms SET email2 = '' WHERE username = '$username'";

			$q =  $this->db->query($s);



			if($q){



					  $hasil['info'] = "<div class='alert alert-success'> Email has been removed </div>";

					  $hasil['reload'] = "true";

			}else{

				$hasil['info'] = "<div class='alert alert-danger'> Email failed to removed </div>";



			}



		}



		echo json_encode($hasil);

	}



	function new_primary_email(){

		$is_ajax = $this->input->is_ajax_request();



		if(!$is_ajax){

			show_404();

		}else{

			$this->load->model('resume_model');

			$email_lama = $this->input->post('email_lama');

			$email_baru = $this->input->post('email_baru');

			$username = $this->session->userdata('username');

			$str = "UPDATE pelaut_ms SET email = '$email_baru', email2 = '$email_lama' WHERE username = '$username'";

			$q = $this->db->query($str);



			if($q){

				$this->load->library('email');

				//echo "aa";

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

		$list = array($email_baru);

		

		$this->email->from($config['smtp_user'], 'informasea.com');

		$this->email->to($list); 

		//$this->email->cc('another@another-example.com'); 

		//$this->email->bcc('them@their-example.com'); 

		

		$this->email->subject('informasea.com Primary Email');

		

		$content = $this->load->view('seaman/account/email/email_to_baru',$data,true);

		$this->email->message($content);

		

		$contenti = $this->load->view('seaman/account/email/email_to_baru',$data,true);

		$this->email->set_alt_message($contenti);	

	

		$this->email->send();



					

					  

					  $hasil['info'] = "<div class='alert alert-success'> Primary email has been changed. please check your new primary email  </div>";

					  $hasil['reload'] = "true";





			}else{



				$hasil['info'] = "<div class='alert alert-danger'> Primary email failed to change </div>";



			}





		}



				echo json_encode($hasil);





	}

	



	function change_primary_email(){

		$is_ajax = $this->input->is_ajax_request();



		if(!$is_ajax){

			show_404();

		}else{

			$this->load->model('resume_model');



			$username = $this->session->userdata('username');

			$a = $this->resume_model->get_detail_pelaut($username);



			$data['email'] = $a['email'];

			$data['email2'] = $a['email2'];



			$this->load->view("account/modal/primary-email",$data);



		}

	}





	function change_password_process()

	{

		$is_ajax = $this->input->is_ajax_request();

		

		

		

		if(!$is_ajax){ show_404(); }

		else

		{

			

			$this->load->library("form_validation");

			

			$username 		= $this->session->userdata("username");

			

			$password 		= $this->input->post("old_password");

			$new_password	= $this->input->post("new_password");

			$retype_password = $this->input->post("retype_new_password");

			

			$this->form_validation->set_rules("old_password","Old Password","required|xss_clean");

			$this->form_validation->set_rules("new_password","New Password","required|xss_clean");

			$this->form_validation->set_rules("retype_new_password","Retype Password","required|xss_clean|matches[new_password]");

			

			if($this->form_validation->run() == true)

			{

				$pass = md5($password); 

				$str  = "SELECT * FROM pelaut_ms WHERE username = '$username' AND password = '$pass' ";

				$q 	= $this->db->query($str);

				$fq   = $q->row_array(); 

				 

				if(!empty($fq))

				{

				  $new_pass = md5($new_password);

				  $str  = "UPDATE pelaut_ms set password = '$new_pass' WHERE username = '$username' ";

				  $q	= $this->db->query($str);

				  

				  if($q)

				  {

					  $hasil['info'] = "<div class='alert alert-success'> Update Password Success </div>";

					  $hasil['reload'] = "true";

				  }

				  else

				  {

					  

					  $hasil['info'] = "<div class='alert alert-danger'> There is something wrong </div>";

				  }

				}

				else

				{

					$hasil['info'] = "<div class='alert alert-danger'> Password failed to changed </div>";

				}

			}

			else

			{

				$hasil['info'] = "<div class='alert alert-danger'>".validation_errors()."</div>";	

			}

			

			

		}

		//$mob = array("mobil"=>"avanza");

		echo json_encode($hasil);

		

	}



	function change_email_process()

	{

		

		$is_ajax = $this->input->is_ajax_request();

		

		if(!$is_ajax){ show_404(); }

		else

		{

			$this->load->library("form_validation");

			

			$username 		= $this->session->userdata("username");

					

			$new_email 		 = $this->input->post("another_email",true);

			

			$this->form_validation->set_rules("another_email","Another Email","required|valid_email");



			if($this->form_validation->run() == true)

			{

				$str  = "SELECT * FROM pelaut_ms WHERE username = '$username'";

				$q 	= $this->db->query($str);

				$fq   = $q->row_array(); 

				

				// check email tidak boleh sama 

				$this->load->library("check_data");



				$check_email = $this->check_data->check_email($new_email);

				 

				if(!empty($fq) && $check_email == TRUE)

				{  	



					//	$activation_email = md5(uniqid(rand(), true));



					  $str  = "UPDATE pelaut_ms set email2 = '$new_email' WHERE username = '$username' ";

					  $q	= $this->db->query($str);

					  $target = $fq['email2'];

				  



				  if($q)

				  {		



				  		$this->load->library('email');

						//echo "aa";

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

		$list = array($fq['email'],$fq['email2']);

		

		$this->email->from($config['smtp_user'], 'informasea.com');

		$this->email->to($list); 

		//$this->email->cc('another@another-example.com'); 

		//$this->email->bcc('them@their-example.com'); 

		

		$this->email->subject('informasea.com Change Email');

		$data['email_baru'] = $fq['email2'];

		$data['email_lama'] = $fq['email'];

		$data['date'] = "Y-m-d H:i:s";

		$content = $this->load->view('seaman/account/email/new_change_email',$data,true);

		$this->email->message($content);

		

		$contenti = $this->load->view('seaman/account/email/new_change_email',$data,true);

		$this->email->set_alt_message($contenti);	

	

		$this->email->send();



					

					  

					  $hasil['info'] = "<div class='alert alert-success'> New Email has been inserted  </div>";

					  $hasil['reload'] = "true";

				  }

				  else

				  {

					  

					  $hasil['info'] = "<div class='alert alert-danger'> There is something wrong </div>";

				  }

				}

				else

				{

					$reason = "";

					

					if($check_email == false)

					{

						$reason = "<br> - Email unavailable "; 	

					}

					

					$hasil['info'] = "<div class='alert alert-danger'> Email failed to changed $reason </div>";

				}

			}

			else

			{

				$hasil['info'] = "<div class='alert alert-danger'>".validation_errors()."</div>";	

			}

			

			

		}

		//$mob = array("mobil"=>"avanza");

		echo json_encode($hasil);



		

	}

	

	// belum selesai 

	// function change_email_process()

	// {

		

	// 	$is_ajax = $this->input->is_ajax_request();

		

	// 	if(!$is_ajax){ show_404(); }

	// 	else

	// 	{

	// 		$this->load->library("form_validation");

			

	// 		$username 		= $this->session->userdata("username");

			

	// 		$password 		= $this->input->post("password",true);

	// 		$new_email	   = $this->input->post("new_email",true);

			

	// 		$this->form_validation->set_rules("new_email","New Email","required|xss_clean|valid_email");

	// 		$this->form_validation->set_rules("password","Password","required|xss_clean");

			

			

	// 		if($this->form_validation->run() == true)

	// 		{

	// 			$pass = md5($password); 

	// 			$str  = "SELECT * FROM pelaut_ms WHERE username = '$username' AND password = '$pass' ";

	// 			$q 	= $this->db->query($str);

	// 			$fq   = $q->row_array(); 

				

	// 			// check email tidak boleh sama 

	// 			$this->load->library("check_data");

	// 			$check_email = $this->check_data->check_email($new_email);

				 

	// 			if(!empty($fq) && $check_email == TRUE)

	// 			{

				  

	// 			  $this->load->model("resume_model");	

				  

	// 			  // generate virification code

	// 			  $generate_activation_code = md5(uniqid(rand(), true));

				  

	// 			  // ini nanti digunakan kalau sudah ada konsep yg tepat

	// 			  // $str  = "UPDATE pelaut_ms set email = '$new_email' ,activation = '$generate_activation_code' WHERE username = '$username' ";

	// 			   $str  = "UPDATE pelaut_ms set email = '$new_email' WHERE username = '$username' ";

	// 			  $q	= $this->db->query($str);

				  

	// 			  $a    = $this->resume_model->get_detail_pelaut($username);

				  

	// 			  if($q)

	// 			  {				  

	// 				  // kirim email konfirmasi

	// 				  /* $this->load->library("my_email");

					  

	// 				  $content['subject'] 		= "Informasea"; // string

	// 				  $content["subject_title"]  = "Confirmation Change Email"; //string

	// 				  $content["to"]			 = $new_email;

					  

	// 				  // alt email

	// 				  //$content['cc']			 = $content["cc"]; // string

	// 				  //$content["bcc"]			= $content["bcc"]; // string

					  

	// 				  // set data

	// 				  $data['nama'] 	= $a['nama_depan']; 

	// 				  $data['str_url'] = "";

					  

	// 				  $content['data']		   = $data;

	// 				  $content['message']		= "account/email/change_email_confirmation"; // String, bisa sebuah path untuk di view

	// 				  $content["mv"]   			 = TRUE; // BOOLEAN , apakah message ini view atau string biasa, true artinya view

	// 				  $content["alt_message"]	= $content["alt_message"]; // string

	// 				  $content["amv"]			= TRUE;

					  

	// 				  $this->my_email->send_email("noreply",$content); */

					  

	// 				  $hasil['info'] = "<div class='alert alert-success'> Update Email Success </div>";

	// 				  $hasil['reload'] = "true";

	// 			  }

	// 			  else

	// 			  {

					  

	// 				  $hasil['info'] = "<div class='alert alert-danger'> There is something wrong </div>";

	// 			  }

	// 			}

	// 			else

	// 			{

	// 				$reason = "";

					

	// 				if($check_email == false)

	// 				{

	// 					$reason = "<br> - Email unavailable "; 	

	// 				}

					

	// 				$hasil['info'] = "<div class='alert alert-danger'> Email failed to changed $reason </div>";

	// 			}

	// 		}

	// 		else

	// 		{

	// 			$hasil['info'] = "<div class='alert alert-danger'>".validation_errors()."</div>";	

	// 		}

			

			

	// 	}

	// 	//$mob = array("mobil"=>"avanza");

	// 	echo json_encode($hasil);



		

	// }

	

	function change_name_process()

	{

		$is_ajax = $this->input->is_ajax_request();

		

		if(!$is_ajax){ show_404(); }

		else

		{

			$this->load->library("form_validation");

			

			$username = $this->session->userdata("username");

			

			$first_name = $this->input->post("first_name",true);

			$last_name  = $this->input->post("last_name",true);

			

			$this->form_validation->set_rules("first_name","First Name","required|xss_clean");

			$this->form_validation->set_rules("last_name","Last Name","required|xss_clean");

			

			if($this->form_validation->run() == true)

			{

				$str = "UPDATE pelaut_ms set nama_depan = '$first_name', nama_belakang = '$last_name' WHERE username = '$username' ";

				$q = $this->db->query($str);

				

				if($q)

				{

					$hasil['info'] = "<div class='alert alert-success'> Update Name Success </div>";

					$hasil['reload'] = "true";

				}

				else

				{

					$hasil['info'] = "<div class='alert alert-danger'> There is something wrong </div>";

				}



			}

			else

			{

				$hasil['info'] = "<div class='alert alert-danger'>".validation_errors()."</div>";

			}

			

			echo json_encode($hasil);

		}

	}



	function change_username_modal(){



		$is_ajax = $this->input->is_ajax_request();



		if(!$is_ajax){

			show_404();

		} else{



			$this->load->model('resume_model');



			$data['username'] = $this->session->userdata('username');

			$a= $this->resume_model->get_detail_pelaut($username);



			$this->load->view('account/modal/change_username',$data);





		}



	}



	function change_username_process(){



		$is_ajax = $this->input->is_ajax_request();

		if(!$is_ajax){

			

			show_404();



		}else{



			$this->load->library('form_validation');



			$username_lama = $this->session->userdata('username');

			$username_baru = $this->input->post('username');



			$id = $this->session->userdata('id_user');



			$this->form_validation->set_rules("username","Username","required|xss_clean|alpha_dash");



			if($this->form_validation->run() == true){



				$str  	= "SELECT * FROM pelaut_ms WHERE pelaut_id = '$id'";

				$q 		= $this->db->query($str);

				$f  	= $q->row_array();



				$this->load->library('check_data');

				$check_username = $this->check_data->check_username($username_baru);



				if(!empty($f) AND $check_username == TRUE){



					$zz = "UPDATE log_seatizen SET username = '$username_baru' WHERE seatizen_id = '$id'";

					$qz = $this->db->query($zz);



					$zzz = "UPDATE applicant_tr SET username = '$username_baru' WHERE id_pelaut = '$id'";

					$qzzz = $this->db->query($zzz);



					$str = "UPDATE pelaut_ms SET username = '$username_baru' WHERE pelaut_id = '$id'";

					$q = $this->db->query($str);





						if($q){	



						$hasil['info'] = "<div class='alert alert-success'> Update Username Success </div>";

					  	$hasil['reload'] = "true";



					  		$this->session->unset_userdata("username");

					  		$this->session->set_userdata("username",$username_baru);



					  		edit_username($id);



					  		$hasil['username'] = $username_baru;

							$st = "SELECT * FROM photo_pelaut_tr WHERE id_pelaut = '$id'";

							$ffz = $this->db->query($st);

							$qz = $ffz->num_rows();



								if($qz != 0){



										$str = "UPDATE photo_pelaut_tr SET username = '$username_baru' WHERE id_pelaut = '$id'";

										$x = $this->db->query($str);





										if($x){

											$folder_lama = "../infrasset/photo/".$username_lama;

											$folder_baru = "../infrasset/photo/".$username_baru;

											





											chmod($folder_lama,0777);

											rename($folder_lama,$folder_baru);



										}else{



										}





								}else{

									//kalau foto ga ada



								}







						} else {



							//kalau gagal diubah

							$hasil['info'] = "<div class='alert alert-danger'> Username Failed to change </div>";



						}







				} else{

					//username telah terpakai 

					$reason = "";

					

					if($check_username == false)

					{

						$reason = "Username unavailable "; 	

					}



						$hasil['info'] = "<div class='alert alert-danger'>".$reason."</div>"; 

				}





			}else{



				//validasi user gagal

								$hasil['info'] = "<div class='alert alert-danger'>".validation_errors()."</div>";	



			}







		}



				echo json_encode($hasil);





	}

	

}