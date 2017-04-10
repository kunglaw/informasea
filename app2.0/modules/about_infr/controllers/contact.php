<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Contact extends MX_Controller {

		function __construct(){
			parent::__construct();
		}

		function index(){

			$data['template'] = "contact/template";
			$data['title'] = "Contact";
			$data['css'] = "contact/css";
			$this->load->view('index',$data);

		// 		$data['head']	 = "head";
		// $data['title']	= "Informasea | Contact Page";	
		// $data['css']	  = "css"; //css tambahan, di head
		// $data['meta']	 = "meta"; // meta tambahan, di head
		// $data['js_top']   = "js_top"; // js tambahan, di head
		
		// //include
		// //$data['navbar']   = "";
		// $data['template'] = "template";
		// $data['footer']   = "footer";
		// $data['js_under'] = "js_under"; 
		
		// $this->load->view('index',$data);

		}

        function send_mail(){


			$this->load->library('form_validation');

            $g_captcha_response = $_POST['g-recaptcha-response'];

            $json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);

            $response = json_decode($json, true);

            if($response['success'] == true) {

                $nama = $this->input->post("nama", true);
                $email = $this->input->post("email", true);
                $phone = $this->input->post("phone", true);
                $subject = $this->input->post("subject", true);
                $message = $this->input->post("message", true);

                $this->form_validation->set_rules('nama', 'nama', 'required|xss_clean');
                $this->form_validation->set_rules('subject', 'subject', 'required|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                $this->form_validation->set_rules('message', 'message', 'required|xss_clean');

                if ($this->form_validation->run() == TRUE) {
                        
                    $f = array(
                        'nama_pengirim' => $nama,
                        'email' => $email,
                        'subject' => "From CU - ".$subject,
                        'message' => $message,
                        'waktu_pengirim' => date('Y-m-d H:i:s')
					);

                    $this->db->insert("contact_us",$f);


                    // // $this->load->library('email');

                    // // $this->email->from($email, $nama);
                    // // $this->email->to('maulanaiqbal1311@gmail.com');
                    // // $this->email->subject($subject);
                    // // $this->email->message($message);

                    // // $url = base_url("contact");
                    // // $this->email->send();


                    //  echo $this->email->print_debugger();


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
				  //  $list = array($email_baru);
						$subjectnya = $email." | ".$subject;
			
					$this->email->from($config['smtp_user'], $subjectnya);
					$this->email->to($config['smtp_user']); 
					//$this->email->cc('another@another-example.com'); 
					//$this->email->bcc('them@their-example.com'); 
					
					$this->email->subject("From CU - ".$subject);
					
					$this->email->message($message);
					$a =  $this->email->send();



				   //   $this->load->library("my_email");
						
				   //   $str_url = base_url("contact");
				   //   $user = "admin";
						
				   //   $content = array(
									
				   //               "subject" => $subject,
				   //               "subject_title"=> $subject,
				   //               "from" => $email,
				   //               "to" => "maulanaiqbal1311@gmail.com", 
				   //               "data" => array('str_url'=>$str_url),
									
				   //               "message" => $message,
				   //               "mv" => TRUE,
				   //               "alt_message" => $message,
				   //               "amv" => TRUE
								
				   //           );
						
				   // $a =  $this->my_email->send_email($user,$content);
		
				   if($a){  
					//echo "berhasil";
				   
						$data['template'] = "contact/template";
						$data['title'] = "Contact";
						$data['css'] = "contact/css";

						$data['success'] = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-ok'> </span> Thank you </div>";
						//$this->load->view('index', $data);
				   }
				   
				   else{
		
						$data['template'] = "contact/template";
						$data['title'] = "Contact";
						$data['css'] = "contact/css";
						$data['ve'] = validation_errors();
						
						$this->load->view('index', $data);
				  
		
		
				   }
		
							// if ($this->email->send()) {
		
							//     $data['template'] = "contact/template";
							//     $data['title'] = "Contact";
							//     $data['css'] = "contact/css";
		
							//     $data['success'] = "<div class='alert alert-success'>
							//     <span class='glyphicon glyphicon-ok'> </span> Thank you </div>";
							//     $this->load->view('index', $data);
							// }
							// else
							// {
		
							//     $data['template'] = "contact/template";
							//     $data['title'] = "Contact";
							//     $data['css'] = "contact/css";
							//     $data['ve'] = validation_errors();
							//     $this->load->view('index', $data);
							// }
		
				  }
		   }
			else
			{
				$data['template'] = "contact/template";
				$data['title'] = "Contact";
				$data['css'] = "contact/css";
				$data['ve'] = "you must click the recaptha checklist to complete the message";
				
				$this->load->view('index', $data);
			}

                //$this->email->cc('another@another-example.com');
                //$this->email->bcc('them@their-example.com');


                //echo $this->email->print_debugger();
           
        }
	}