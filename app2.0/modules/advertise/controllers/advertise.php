<?php 

	class Advertise extends MX_Controller{
		
		private $db3;
		
		function __construct()
		{
			parent::__construct();
			$this->db3 = $this->load->database(DB_SETTING3,TRUE); 
			$this->load->model("Advertise/advertise_model");
		}

		function get_thumbnail()
		{
			$ajax = $this->input->post("x");
			if($ajax){
				$id_area = $this->input->post("id_area");
				$q = "select area_name from admin_ad_area where id_area = '$id_area'";
				$exec = $this->db->query($q);
				$hasil = $exec->row_array();
				$position = substr($hasil['area_name'], 3);
				$size = "cube size (width = height)";
				if($position == 'top_left' || $position == 'bottom_left') $size = "size 700 x 90 pixel";
				elseif ($position["horizontal_position"] == 'left') $size = "size 90 x 400 pixel";

				echo "
				<img src='".asset_url()."img/$hasil[area_name].png' style='width: 100%'/>

				<center><a href='".base_url()."vacantsea/preview?pos=$position' target='_blank'>See Original Preview On Page</a><p><b>$size</b></p></center>
				
				";
				// echo "";
			}
		}
		
		function index(){
			
			//error_reporting(E_ALL);
			
			$data['template'] = "template";
			$data['title'] 	= "Advertise";
			$data['css'] 	  = "css";
			$data["js_under"] = "js_bottom";
			
			$data["ad_periode"]= $this->advertise_model->list_ad_periode();
			$data["ad_area"]  = $this->advertise_model->list_ad_area(); 
			$data["ad_page"]  = $this->advertise_model->list_ad_page();
			
			$this->load->view('index',$data);
		}
		
		function payment_confirmation()
		{
			//error_reporting(E_ALL);
			$id_order     = $this->input->get("id_order");
			$detail_order = $this->advertise_model->detail_ad_request($id_order);
			$detail_confirm = $this->advertise_model->detail_ad_payment($id_order);
			// check apakah no_order ini sudah mengirimkan konfirmasi
			
			if(!empty($detail_order) && empty($detail_confirm))
			{
			  
			  $user_ad = $this->advertise_model->detail_ad_user($detail_order["id_user_ad"]); 
			  
			  $data['template'] = "payment_conf/template";
			  $data['title'] 	= "Advertise - Payment Confirmation";
			  $data['css'] 	  = "css";
			  $data["js_under"] = "js_bottom";
			  
			  $data["order"]   = $detail_order;
			  $data["user_ad"] = $user_ad;
			  
			  $data["page"]    = $this->advertise_model->detail_ad_page($detail_order["id_page"]);
			  $data["periode"] = $this->advertise_model->detail_ad_periode($detail_order["id_periode"]); 
			  $data["area"]    = $this->advertise_model->detail_ad_area($detail_order["id_area"]);
			  
			  $data["total"]   = $this->advertise_model->total_payment($detail_order["id_ad"]);
			  
			  $this->load->view('index',$data);
			}
			else
			{
				if(!empty($detail_confirm))
				{
					header("location:".base_url("advertise/summary/?id_order=$id_order"));	
				}
				else
				{
					show_404();
				}
				
			}
			
			
		}
		
		function order_id()
		{
			
			$m = date("m");
			$d = date("d");
			
			$id_order = 1000;
			$stat 	  = strlen(1000);
			$sid_order = strlen($id_order);
			
			$zero = $stat - $sid_order;
			$gen_zero = "";
			for($i=1;$i<=$zero;$i++)
			{
				
				$gen_zero .= "0";	
			}
			
			echo $no_invoice = "OAD0".$m.$gen_zero.$id_order;	
			echo "<br>";
			//echo strlen("OAD0".$m.$d.$gen_zero.$id_order);	
			
		}
		
		function test()
		{
			$id_order = $_GET["id_order"];
			$detail_order = $this->advertise_model->detail_ad_request($id_order);
			
			if(!empty($detail_order))
			{
			  
			  $user_ad = $this->advertise_model->detail_ad_user($detail_order["id_user_ad"]); 
			  
			  $data['template'] = "payment_conf/template";
			  $data['title'] 	= "Advertise - Payment Confirmation";
			  $data['css'] 	  = "css";
			  $data["js_under"] = "js_bottom";
			  
			 
			  
			  $data["order"]  = $detail_order;
			  $data["user_ad"] = $user_ad;
			  
			  $data["page"] = $this->advertise_model->detail_ad_page($detail_order["id_page"]);
			  $data["periode"] = $this->advertise_model->detail_ad_periode($detail_order["id_periode"]); 
			  $data["area"] = $this->advertise_model->detail_ad_area($detail_order["id_area"]);
			  
			  $data["total"] = $this->advertise_model->total_payment($detail_order["id_ad"]);
			  
			  $this->load->view('payment_conf/email_invoice',$data);
			  //$this->load->view("payment_conf/email_invoice_back",$data);
			}
			else
			{
				show_404();	
			}
			
		}
		
		function request_process()
		{
			$this->load->library("form_validation");
			/*
				Array
			  (
				  [ad_name] => my first ad
				  [ad_area] => 1
				  [quantity_periode] => 12
				  [ad_alternative_text] => sasdasd
				  [ad_target_url] => asdasdasd
				  [ad_description] => asdasdasd
				  [name] => asdasd
				  [email] => alhusna901@gmail.com
				  [no_telp] => 213123213
			  )
			*/
			
			$ad_name = $this->input->post("ad_name",TRUE);
			$id_page = $this->input->post("ad_page",TRUE);
			$ad_area = $this->input->post("ad_area",TRUE);
			$id_periode = $this->input->post("ad_periode",TRUE);
			
			$quantity_periode 	= $this->input->post("quantity_periode",TRUE);
			$ad_alternative_text = $this->input->post("ad_alternative_text",TRUE);
			$ad_target_url  = $this->input->post("ad_target_url",TRUE);	
			$name 		   = $this->input->post("name",TRUE);
			$email 		  = $this->input->post("email",true);
			$no_telp 		= $this->input->post("no_telp",TRUE);
			$ad_description = $this->input->post("ad_description",TRUE);
			$start_date 	 = $this->input->post("start_date",TRUE); 	
			$purpose_bank   = $this->input->post("purpose_bank",TRUE);

			$this->form_validation->set_rules("ad_name","Ad Name","required|trim");
			//$this->form_validation->set_rules("ad_page","Ad Page","required|trim");
			$this->form_validation->set_rules("ad_area","Ad Area","required|trim");
			$this->form_validation->set_rules("ad_periode","Ad Periode","required|trim");
			$this->form_validation->set_rules("quantity_periode","Quantity of Periode","required|trim");
			$this->form_validation->set_rules("ad_alternative_text","Ad Alternative Text","required|trim");
			$this->form_validation->set_rules("ad_target_url","Ad Terget Url","required|trim");
			$this->form_validation->set_rules("start_date","Start Date","required|trim");
			$this->form_validation->set_rules("purpose_bank","Payment Method","required");
			
			$this->form_validation->set_rules("name","Name","required|trim");
			$this->form_validation->set_rules("email","Email","required|valid_email|trim");
			$this->form_validation->set_rules("no_telp","No Telp","required|trim");
			
			if($this->form_validation->run() == TRUE)
			{
				$check_user = $this->advertise_model->detail_ad_user($email);
				
				if(empty($check_user))
				{
				  $dt_aad = array(
					  
					  "name"=>$name,
					  "email"=>$email,
					  "no_telp"=>$no_telp
					  
				  );
				  $id_user_ad = $this->advertise_model->insert_ad_user($dt_aad);
				}
				else
				{
				  $id_user_ad = $check_user["id_user_ad"];	
				  $user_ad = $this->advertise_model->detail_ad_user($id_user_ad); // buat kirim data ke email
				}
				
				$ext = pathinfo($_FILES["media"]["name"],PATHINFO_EXTENSION);
				$n = date("Ymdhis");
				$u = explode("@",$email);
				$username = $u[0].$id_user_ad;
				$filename = $username.$n.".$ext";
				
				$config['upload_path']     = img_path('/advertise');
                $config['allowed_types']   = 'gif|jpg|png|jpeg';
                $config['max_size']        = 10000;
				$config["file_name"]	   = $filename;
                /* $config['max_width']            = 1024;
                $config['max_height']           = 768;*/

                $this->load->library('upload', $config);
				
				if ( $this->upload->do_upload('media'))
                {
					$check_request = $this->advertise_model->list_ad_request();
					// generate no invoice
					
					if(empty($check_request))
					{
						
						
						$id_order  = 1;
						$no_order = $this->advertise_model->generate_no_order($id_order);
					}
					else
					{
						$no_order1 = $check_request["id_ad"];
						$a = substr($no_order1,0,-3);
						$aa = intval($a); // aman
						
						if($aa < 999) // di check untuk di reset 
						{
							$id_order = $aa + 1;
						}
						else
						{
							$id_order = 1; // reset dari ulang	
						}
						
						
						$no_order = $this->advertise_model->generate_no_order($id_order);
					}
					
					$dt_ara = array(
						
						"id_ad"		  =>$no_order,
						"id_user_ad" 	 =>$id_user_ad,
						//"id_page"		=>$id_page,
						"id_area"		=>$ad_area,
						"id_periode"	 =>$id_periode,
						
						"ad_name"			 =>$ad_name,
						"quantity_periode"    =>$quantity_periode,
						"ad_alternative_text" =>$ad_alternative_text,
						"ad_target_url"  	   =>$ad_target_url,
						"start_date"	 	  =>$start_date,
						"ad_description" 	  =>$ad_description,
						"filename"			=>$filename,
						"purpose_bank"		=>$purpose_bank
						
					);
					
					$id_order = $this->advertise_model->insert_request_ad($dt_ara);
					$order = $this->advertise_model->detail_ad_request($id_order); // buat kirim data ke email
					//$page  = $this->advertise_model->detail_ad_page($order["id_page"]); 
					$periode = $this->advertise_model->detail_ad_periode($order["id_periode"]);
					$area  = $this->advertise_model->detail_ad_area($order["id_area"]);
					$total = $this->advertise_model->total_payment($id_order);
					
					//kirim email, data username dan password
					$this->load->library("my_email");
					$user = "info";
	  
					$data = array("user_ad"=>$user_ad,"order"=>$order,"periode"=>$periode,"area"=>$area,"total"=>$total);
					$message = $this->load->view("payment_conf/email_invoice", $data, true);
					
					$content = array(
						
						"subject" 		=> "Informasea Invoice - $id_order",
						"subject_title"  => WEBSITE,
						"to" 			 => array($email,"alhusna901@gmail.com","admin@informasea.com"), 						
						"message" 		=> $message,
						"mv" 			 => FALSE/*,
						//"alt_message"  => "users/email/email-create-alt", // buat alt nya 
						"amv" 		    => FALSE*/
					
					);
					
					$this->my_email->send_email($user,$content);
					
					$result["status"]  = "success";
					$result["message"] = "<div class='alert alert-success'> You successfully send an Ad request </div>";
					$result["id_order"] = $id_order;
     
                }
				else
				{
					$result["status"] = "error";
					$result["message"] = "<div class='alert alert-danger'>".$this->upload->display_errors()." </div>";
					
				}
				
				
			}
			else
			{
				
				$result["status"] = "error";
				$result["message"] = "<div class='alert alert-danger'>".validation_errors()." </div>";
			}
			
			echo json_encode($result);
			
			
		}
		
		function payment_process()
		{
			$this->load->library("form_validation");
			/*
			[an_account] => asdasd
			[bank_account] => 2323435345
			[total_transfer] => sdasd
			[purpose_bank] => Mandiri*/
			
			$an_account   = $this->input->post("an_account",TRUE);
			$bank_account = $this->input->post("bank_account",TRUE);
			$total_transfer = $this->input->post("total_transfer",TRUE);
			$purpose_bank = $this->input->post("purpose_bank",TRUE); 
			$id_ad 		= $this->input->post("id_ad",TRUE);
			$transfer_note= $_FILES["transfer_note"]["name"];
			$due_date	 = $this->input->post("due_date",TRUE);
			
			$email 		= $this->input->post("email",TRUE);
			
			$now 		  = date("Y-m-d H:i:s");
			
			$user_ad = $this->advertise_model->detail_ad_user($email); 
			$id_user_ad = $user_ad["id_user_ad"];
			
			$total = $this->advertise_model->total_payment($id_ad); // total_payment
			
			$this->form_validation->set_rules("an_account","A/n","required|trim");
			$this->form_validation->set_rules("bank_account","Bank Account","required|trim");
			$this->form_validation->set_rules("total_transfer","Total Transfer","required|trim|greater_than[$total[total]]");
			$this->form_validation->set_rules("purpose_bank","Purpose Bank","required|trim");
			$this->form_validation->set_rules("id_ad","Id Order","required|trim");
			$this->form_validation->set_rules("email","Email","required|valid_email|trim");
			$this->form_validation->set_rules("due_date","Due Date","required");
		
			if($this->form_validation->run() == TRUE)
			{
				
				$stat = TRUE;
				$msg  = ""; 
				
				//no id_ad , check id_ad , jika ada tidak bisa melakukan confirmasi lagi ***
				$check_payment = $this->advertise_model->detail_ad_payment($id_ad);
				if(!empty($check_payment))
				{
				  $stat  = FALSE;
				  $msg  .= "<div> This Payment confirmation is already send </div>";	
				}
				
				$check_request = $this->advertise_model->detail_ad_request($id_ad);
				if(empty($check_request))
				{
				  $stat  = FALSE;
				  $msg  .= "<div> This Request is not exists </div>";
				}
				
				if($now > $due_date)
				{
				  $stat  = FALSE;
				  $msg  .= "<div> This Payment confirmation for this transaction was expired </div>"; 				  
				  
				}

				if(empty($transfer_note))
				{
				  $stat  = FALSE;
				  $msg  .= "<div> You must uploaded screenshot of Transfer Note </div>"; 		
				}
				
				if($stat == TRUE)
				{
				  $ext = pathinfo($transfer_note,PATHINFO_EXTENSION);
				  $n = date("Ymdhis");
				  $u = explode("@",$email);
				  $username = $u[0].$id_user_ad;
				  $filename = "PN".$username.$n.".$ext";
				  
				  $config['upload_path']     = img_path('/advertise/payment_conf');
				  $config['allowed_types']   = 'jpg|png|jpeg';
				  $config['max_size']        = 10000;
				  $config["file_name"]	   = $filename;
				  /* $config['max_width']            = 1024;
				  $config['max_height']           = 768;*/
  
				  $this->load->library('upload', $config);
				  
				  if ( !$this->upload->do_upload('transfer_note'))
				  {
					 $stat  = FALSE;
					 $msg  .= "<div>".$this->upload->display_errors()."</div>";
				  }
				}
				
				if($stat == TRUE)
				{
					$arr = array(
							
						"an_account"   =>$an_account,
						"bank_account" => $bank_account,
						"total_transfer" => $total_transfer,
						"purpose_bank" => $purpose_bank,						
						"id_ad"=>$id_ad,
						"transfer_note"=>$transfer_note
	
					);
					
					$this->advertise_model->payment_process($arr);
					
					//update paid status 
					$this->advertise_model->update_paid_status($id_ad);
					
					$result["status"] = "success";
					$result["message"] = "<div class='alert alert-success'> 
						
						Thank you for your confirmation, we will check your payment confirmation soon
						
					</div>";
					$result["id_order"] = $id_ad; // id_ad
				}
				else
				{
					$result["status"] = "error";
					$result["message"] = "<div class='alert alert-danger'>".$msg."</div>";
				}

			}
			else 
			{
				$result["status"] = "error";
				$result["message"] = "<div class='alert alert-danger'>".validation_errors()."</div>";
			}
			
			echo json_encode($result);
			
		}
		
		
		function list_ad_area()
		{
			
			$is_ajax = $this->input->is_ajax_request();
			if($is_ajax)
			{
			
			  $id_page = $this->input->post("id_page",TRUE);
			  
			  $detail_page = $this->advertise_model->detail_ad_page($id_page);
			  
			  $dt = json_decode($detail_page["area"]); 
			  
			  foreach($dt as $row)
			  {
				  $detail_area = $this->advertise_model->detail_ad_area($row); //area_name
				  
				  echo "<option value='$detail_area[id_area]'>$detail_area[title] - $detail_area[currency] ".number_format($detail_area['price'])."</option>";
				  
			  }
			}
			else
			{
				show_404();	
			}
				
			
		}
		
		function summary()
		{
			$id_order = $_GET["id_order"];
			
			$detail_order   = $this->advertise_model->detail_ad_request($id_order);
			$detail_confirm = $this->advertise_model->detail_ad_payment($id_order);
			$user_ad 		= $this->advertise_model->detail_ad_user($detail_order["id_user_ad"]);
			$total		  = $this->advertise_model->total_payment($id_order);
			$area		   = $this->advertise_model->detail_ad_area($detail_order["id_area"]);
			
			if(!empty($detail_order) && !empty($detail_confirm))
			{
			 
			  $data['template'] = "summary/template";
			  $data['title'] 	= "Advertise - Summary";
			  $data['css'] 	  = "css";
			  $data["js_under"] = "js_bottom";
			  
			  $data["order"]   = $detail_order;
			  $data["confirm"] = $detail_confirm;
			  $data["user_ad"] = $user_ad;
			  $data["total"]   = $total;
			  $data["area"]	= $area;
			
			  $this->load->view("index",$data);
			}
			else
			{
				show_404();	
			}
		}
		
		function a()
		{
			$action = base_url("advertise/b");
			echo "<form action=''>";
					
			echo "</form>";
		}
		
		function b()
		{
			 $this->session->set_userdata('test', $user); // a cookie has been created
			  if($this->input->post('remember_me'))
			  {
				  $this->load->helper('cookie');
				  $cookie = $this->input->cookie('ci_session'); // we get the cookie
				  $this->input->set_cookie('ci_session', $cookie, '35580000'); // and add one year to it's expiration
			  }	
		}
		
		function test_analityc()
		{
			//$this->load->view("google_app/goolgle_platform");
			//$this->load->view("advertise/test_analitycs");
			//$this->load->view("advertise/test_analytics");
			
			$this->load->view("advertise/sample_analitycs");
			
		}
		
		function __destruct()
		{
			
			
		}
		
		
		
		
		
	}