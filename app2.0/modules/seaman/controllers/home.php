<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed');	
	
	// home, kepunyaan seaman
	
	class Home extends MX_Controller{
		
		function __construct()
		{
			parent::__construct();
			//$this->authentification_model->close_access();
        	//$this->CI =& get_instance();
			$this->authentification->underconst_access();
			$this->load->model('timeline/timeline_model');
			$this->load->model('users/user_model');

			$this->load->model('nation_model');
		}
		
		// tidak di lock
		// tapi bisa diakses
		function timeline_rule($type = "general",$id_timeline = "")
		{
			
			// check timeline sebelum di tampilkan 
			
			// session user 
			$username_login = $this->session->userdata('username');
			$pelaut_id_login = $this->session->userdata("id_user");
			
			 $this->load->model('seaman/friendship_model');
			 
			 // munculkan timeline berdasarkan 
			 if($type == "general")
			 {
			 	$timeline = $this->timeline_model->get_tml($id_timeline); // dari timeline model 
				//$timeline = array_slice($timeline_full,0,5);
			 }
			 else if($type == "self")
			 {
				$timeline = $this->timeline_model->get_self_tml($id_timeline); // dari timeline model 
				//$timeline = array_slice($timeline_full,0,5);
			 }
 
			 $i = 0;
			
			 while($row = $timeline[$i])
			 { 
				
				
				"<p> pelaut_id_timeline: ".$pelaut_id_timeline = !empty($row['pelaut_id']) ? $row['pelaut_id'] : "" ;//print "</p>";
				"<p> username_timeline: ".$username_timeline  = !empty($row['username']) ? $row['username'] : "";//print "</p>";
				"<p> identitas: ".$identitas = !empty($pelaut_id_timeline) ? $pelaut_id_timeline : $username_timeline;//print "</p>";
				//echo "pelaut_id_login : ".$pelaut_id_login; echo "<br>";
				
				// manggil function check pertemanan 
				if(!empty($pelaut_id_login))
				{
					$check_friendship = $this->friendship_model->check_friends($identitas,$pelaut_id_login); 
				}
				else
				{
					$check_friendship = FALSE;	
				}
				
				// rule untuk menampilkan timeline
				$rule = FALSE;
				
				if($check_friendship == TRUE || $username_login == $username_timeline)
				{
					$rule = TRUE;
					
				}
				
				
				if(empty($username_login))
				{
					$rule = TRUE;
						
				}
				// ==============================================
				
				// MAIN EXECUTE
				if($rule == TRUE){	
					$hasil[] = $row;
					if(count($hasil) == 5)
					{
						break;	
					}
					//$hasil = array_slice($timeline_baru,0,5); //array 
				
				}
				
				//print_r($row);echo "jalan .. <br> ";
		
				$i++;
				 
					 
			 }
			
			/*foreach($timeline as $row){
			  "<p> pelaut_id_timeline: ".$pelaut_id_timeline = !empty($row['pelaut_id']) ? $row['pelaut_id'] : "" ;//print "</p>";
			  "<p> username_timeline: ".$username_timeline  = !empty($row['username']) ? $row['username'] : "";//print "</p>";
			  "<p> identitas: ".$identitas = !empty($pelaut_id_timeline) ? $pelaut_id_timeline : $username_timeline;//print "</p>";
			  //echo "pelaut_id_login : ".$pelaut_id_login; echo "<br>";
			  
			  // manggil function check pertemanan 
			  if(!empty($pelaut_id_login))
			  {
				  $check_friendship = $this->friendship_model->check_friends($identitas,$pelaut_id_login); 
			  }
			  else
			  {
				  $check_friendship = FALSE;	
			  }
			  
			  // rule untuk menampilkan timeline
			  $rule = FALSE;
			  
			  if($check_friendship == TRUE || $username_login == $username_timeline)
			  {
				  $rule = TRUE;
				  
			  }
			  
			  
			  if(empty($username_login))
			  {
				  $rule = TRUE;
					  
			  }
			  
			  if(empty($username_login))
			  {
				  $rule = TRUE;
				  
			  }
			  
			  // ==============================================
			  
			  // MAIN EXECUTE
			  if($rule == TRUE){	
				  $timeline_baru[] = $row;
				  $hasil = array_slice($timeline_baru,0,5); //array 
			  
			  }
			  else
			  {
				  // id_timeline terakhir 
				  $hasil = $row['id_timeline']; // hasilnya integer   
			  }
			}*/
			
			return $hasil;
		}
	
		// ====================== Module Default ======================== //
		
		// AJAX
		function get_list_timeline()
		{
			$this->authentification_model->ajax_access();
			
			// check di timeline rule
			$timeline = $this->timeline_rule("general");
			
			/*while(is_int($timeline))
			{
				$timeline = $this->timeline_rule("general",$id_timeline = $timeline); // <--- berarti $timeline itu integer 	
			}*/
			
			// suatu saat akan diubah sesuai petemanan
			$data['timeline'] = $timeline;
			
			/*foreach($timeline as $row)
			{
				$hasil[]= $row['id_timeline'];
			}
			print_r($hasil);*/
			
			$j = end($timeline);
			$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline']);
			//print_r($data['timeline']);
			
			//print_r($data['timeline']);exit;
			$this->load->view('list_timeline',$data);
		}
		
		
		// AJAX
		function get_list_timeline_plus()
		{
			$this->authentification_model->ajax_access();
			// check di timeline rule
			$timeline = $this->timeline_rule("general"); // output bisa integer , maupun array
			
			/*while(is_int($timeline))
			{
				$timeline = $this->timeline_rule("general",$id_timeline = $timeline); // <--- berarti $timeline itu integer 	
			}*/
			
			$data['timeline_plus'] = $timeline;
			
			/*foreach($timeline as $row)
			{
				$hasil[]= $row['id_timeline'];
			}
			echo "<hr>";
			print_r($hasil);*/
			
			$j = end($timeline);
			$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline']);
			//$data['jml_data'] = $this->timeline_model->jml_data();
			$data['uri'] = $this->input->post('uri'); 
			
			$this->load->view('list_timeline_plus',$data);
			
		}
		
		// ===================== Module seaman , Profile ======================== //
		
		// AJAX
		function get_self_timeline_plus()
		{
			$this->authentification_model->ajax_access();
			// check di timeline rule
			//$timeline = $this->timeline_rule("self");
			
			$ctrl = $this->input->post('ctrl'); //echo "<br>";
			$username = $this->input->post('username'); //echo "<br>";
			
			if($ctrl == "profile" && ($username == $this->session->userdata("username")))
			{
				$data['timeline_plus'] = $this->timeline_model->get_self_tml();
				
				$data['jml_data'] = $this->timeline_model->jml_data();
				$data['ctrl'] = $this->input->post('ctrl'); 
			}
			else if($ctrl == "detail" && ($username != $this->session->userdata("username")))
			{
			
				$data['timeline_plus'] = $this->timeline_model->get_person_timeline($username);
				$data['jml_data'] = $this->timeline_model->jml_data();
				$data['ctrl'] = $this->input->post('ctrl'); 
				
			}
			
			$this->load->view('list_timeline_plus',$data);
			
		}
		
		// AJAX
		function get_self_timeline()
		{
			//$this->authentification_model->ajax_access();
			// input data ini berasal dari ajax nya : 
			//get_list_timeline() yang ada di : profile/view/content.php
			$ctrl = $this->input->post('ctrl'); // dikirim oleh ajax yang ada di content, index, module default
			
			//$ctrl = $this->input->post('ctrl'); // dikirim oleh ajax yang ada di content, index, module default
			$username = $this->input->post('username');
			//print_r($_POST); echo "<br>";
			
			if($ctrl == "profile" && ($username == $this->session->userdata("username")))
			{
				$data['timeline'] = $this->timeline_model->get_self_tml();
				
			}
			else if($ctrl == "detail" && ($username != $this->session->userdata("username")))
			{
				//echo "bazingan";
				$data['timeline'] = $this->timeline_model->get_person_timeline($username);
				
				
			}
			
			
			$data['username'] = $username;
			
			
			$this->load->view('list_timeline',$data);
		}	
		
		function get_comment()
		{
			Modules::run("timeline/comment_tml/get_comment");	
		}

        function processUpdate()
        {
            $this->authentification_model->ajax_access();
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


?>