<?php
	// controller timeline , module guest , seaman
	
	if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed ');
	
	class timeline extends MX_Controller{
		
		function __construct()
		{
			
			parent::__construct();
			//$this->authentification_model->close_access();
			
			$user = $this->session->userdata("user");
			
			if($user != "pelaut")
			{
				if($user == "agent")
					header("location:".base_url("agent"));
					
				else if($user == "company")
					header("location:".base_url("company"));
				
			}
			
			/* $uri3 = $this->uri->segment(4);
			
			if($this->input->post("x") != 1 && $uri3 != "detail")
			{
				header("location:".base_url());

			} */
			
			
			
			$this->load->model("timeline_model");
			$this->load->model('users/user_model');
			$this->load->model('comment_tml_model');

		}

		/*function destEditable(){
			$datanya = json_decode($this->input->post('dt'), true);
			echo 'hai';
		}*/

		// function delete_timeline()
		// {
		// 	# code...
		// 	$id = $this->input->post("id");
		// 	$q = "delete from timeline where id_timeline = '$id'";
		// 	$this->db->query($q);
		// }

		public function show_modal()
		{
			# code...
			$for = $this->input->post('for');
			$id = $this->input->post("id");

			$data['id_timeline'] = $id;
			$this->load->view("modal_delete_timeline", $data);
		}
		
		function index()
		{

			// $this->load->view('formupload');	
			$this->timeline_rule();
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
			 $username = $this->input->post("username");
			 // munculkan timeline berdasarkan 
			 if($type == "general")
			 {
			 	$timeline = $this->timeline_model->get_tml($id_timeline, $username); // dari timeline model 
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
			$this->authentification->ajax_access();
			
			// check di timeline rule
			$timeline = $this->timeline_rule("general");
			
			/*while(is_int($timeline))
			{
				$timeline = $this->timeline_rule("general",$id_timeline = $timeline); // <--- berarti $timeline itu integer 	
			}*/
			
			// suatu saat akan diubah sesuai petemanan
			$data['timeline'] = $timeline;
			// print_r($data['timeline']);
			
			/*foreach($timeline as $row)
			{
				$hasil[]= $row['id_timeline'];
			}
			print_r($hasil);*/

			$username = $this->input->post("username");
			
			$j = end($timeline);
			$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
			
			
			$this->load->view('list-timeline',$data);
		}
		
		
		// AJAX
		function get_list_timeline_plus()
		{
			$this->authentification->ajax_access();
			// check di timeline rule
			$timeline = $this->timeline_rule("general"); // output bisa integer , maupun array
			
			/*while(is_int($timeline))
			{
				$timeline = $this->timeline_rule("general",$id_timeline = $timeline); // <--- berarti $timeline itu integer 	
			}*/
			
			$data['timeline_plus'] = $timeline;
			print_r($timeline);
			/*foreach($timeline as $row)
			{
				$hasil[]= $row['id_timeline'];
			}
			echo "<hr>";
			print_r($hasil);*/
			$username = $this->input->post("username");
			$j = end($timeline);
			$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
			$data['jml_data'] = $this->timeline_model->jml_data($username);
			$data['uri'] = $this->input->post('uri'); 
			
			$this->load->view('list-timeline-plus',$data);
			
		}

		function get_list_timeline_person()
		{
			$this->authentification->ajax_access();
			
			// check di timeline rule
			// $timeline = $this->timeline_rule("general");
			$username = $this->input->post("username");
			$timeline = $this->timeline_model->get_person_timeline($username);
			/*while(is_int($timeline))
			{
				$timeline = $this->timeline_rule("general",$id_timeline = $timeline); // <--- berarti $timeline itu integer 	
			}*/
			
			// suatu saat akan diubah sesuai petemanan
			$data['timeline'] = $timeline;
			// print_r($data['timeline']);
			
			/*foreach($timeline as $row)
			{
				$hasil[]= $row['id_timeline'];
			}
			print_r($hasil);*/
			
			$j = end($timeline);
			$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'],$username);
			
			
			$this->load->view('list-timeline',$data);
		}
		
		
		// AJAX
		function get_list_timeline_person_plus()
		{
			$this->authentification->ajax_access();
			// check di timeline rule
			//$timeline = $this->timeline_rule("general"); // output bisa integer , maupun array
			$timeline = $this->timeline_model->get_person_timeline($username);
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
			$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
			$data['jml_data'] = $this->timeline_model->jml_data($username);
			$data['uri'] = $this->input->post('uri'); 
			
			$this->load->view('list-timeline-plus',$data);
			
		}
		
		// ===================== Module seaman , Profile ======================== //
		
		// AJAX
		function get_self_timeline_plus()
		{
			$this->authentification->ajax_access();
			// check di timeline rule
			//$timeline = $this->timeline_rule("self");
			// id_timeline 
			$id_timeline = $this->input->post("id_timeline");
			$ctrl = $this->input->post('ctrl'); //echo "<br>";
			$username = $this->input->post('username'); //echo "<br>";
			
			if($ctrl == "profile" && ($username == $this->session->userdata("username")))
			{
				
				$data['timeline_plus'] = $this->timeline_model->get_self_tml($id_timeline);				
				
				$j = end($data['timeline_plus']);
				$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
				$data['jml_data'] = $this->timeline_model->jml_data($username);
				$data['ctrl'] = $this->input->post('ctrl');
				 
			}
			else if($ctrl == "seatizen" && ($username != $this->session->userdata("username")))
			{
			
				$data['timeline_plus'] = $this->timeline_model->get_person_timeline($username);
				$j = end($data['timeline_plus']);
				$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
				$data['jml_data'] = $this->timeline_model->jml_data($username);
				$data['ctrl'] = $this->input->post('ctrl'); 
				
			}
			
			
			$this->load->view('list-timeline-plus',$data);
			
		}
		
		// AJAX
		function get_self_timeline()
		{
			
			$this->authentification->ajax_access();
			// input data ini berasal dari ajax nya : 
			//
			$ctrl = $this->input->post('ctrl'); // dikirim oleh ajax yang ada di content, index, module default
			
			//$ctrl = $this->input->post('ctrl'); // dikirim oleh ajax yang ada di content, index, module default
			$username = $this->input->post('username');
			//print_r($_POST); echo "<br>";
			
			
			if($ctrl == "profile" && ($username == $this->session->userdata("username")))
			{
				$data['timeline'] = $this->timeline_model->get_self_tml();
				
				$j = end($data['timeline']);
				$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
				
			}
			else if($ctrl == "seatizen" && ($username != $this->session->userdata("username")))
			{
				
				$data['timeline'] = $this->timeline_model->get_person_timeline($username);
				//print_r($data['timeline']);
				$j = end($data['timeline']);
				$data['jml_data_angka'] = $this->timeline_model->jml_data_angka($j['id_timeline'], $username);
				
				
			}
			
			// print_r($data);
			
			$data['username'] = $username;
			
			// print_r($data);
			
			$this->load->view('list-timeline',$data);
		}	
		
		function get_comment()
		{
			
			Modules::run("timeline/comment_tml/get_comment");	
		}
		
		function modal_alert()
		{
			$data = $this->input->post();
			
			/*str_data_url untuk yes-btn*/
			$str_url = "";
			for($i = 0; $i <= count($data)-1; $i++)
			{
				$key = array_keys($data);
				$str_url .= $key[$i]."=".$data[$key[$i]]."&"; 	
			}
			$str_url .= "x=1";
			/* ============ */
			$data['str_url'] = $str_url;
			
			
			$this->load->view("timeline/modal-alert",$data);
		}
		
		public function resize_dimension($image_width = 0,$image_height = 0)
		{
			// PENGATURAN RESOLUSI GAMBAR 
						
			//$x = isset(number_format($_FILES['picture']['size'])) ? number_format($_FILES['picture']['size']) : 0; 
			//$dimension = getimagesize($_FILES['picture']['tmp_name']); // dimension , ukuran pixel
			
			$ratio = 0;
			if($image_width < $image_height)
			{
				$ratio = $image_width / $image_height;
			}
			else
			{
				$ratio = $image_height / $image_width;
				
			}
			
		
			if(($image_height >= 480 && $image_height <= 720) || ($image_width >= 480 && $image_width <= 720))
			{
			  //echo "480 x 720 <br>";
			  $quality 			  = '100%';
			  $width 	  			= $image_width * $ratio ;
			  $height 	 	  	   = $image_height * $ratio ; //echo "<hr>";
			  
			}
			else if(($image_height >= 960 && $image_height <= 1440) || ($image_width >= 960 && $image_width <= 1440))
			{
			  //echo "960 x 144 <br>";
			  $quality 			  = '100%';
			  $width 	  			= $image_width * $ratio * $ratio ;
			  $height 	 		   = $image_height * $ratio * $ratio ;
			}
			else if(($image_height >= 1441) || ($image_width >= 1441))
			{
			  //echo "960 x 144 <br>";
			  $quality 			  = '90%';
			  $width 	  			= $image_width * $ratio * $ratio * $ratio;
			  $height 	 		   = $image_height * $ratio * $ratio * $ratio;
			}
			else
			{
			  $quality 			  = '100%';
			  $width 	  			= $image_width;
			  $height 	 		   = $image_height;	
			}
			
			
			return array('quality' => $quality,'width' => $width,'height' => $height);
			
		}
		
		private function upload_image()
		{
			
			$this->authentification->close_access();
			//$this->authentification_model->ajax_access();
			
			
			$this->load->library('image_lib');
			$this->load->library('upload');
			
			$username = $this->session->userdata("username");
			
			//$x = number_format($_FILES['picture']['size']); echo "<br>";// size, ukuran KB
			//$dimension = getimagesize($_FILES['picture']['tmp_name']); // dimension , ukuran pixel
			
			// ukuran image
			$ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
			$a = $this->db->query("SHOW TABLE STATUS FROM `infr6975_informaseadb2015` LIKE 'timeline' ");
			$b = $a->row_array();
			$b['Auto_increment'];
			
			$configupload['upload_path']   = pathup("timeline/$username/big");
			$configupload['file_name']     = strtoupper(md5($b['Auto_increment'].$_FILES['picture']['name'])).date('YmdHis').".".$ext;
			$configupload['allowed_types'] = "gif|jpg|png|jpeg";
			$configupload['max_size']	  =  1024 * 1024 * 1; // 10MB
			
			//$configupload['max_width']  = '1024';
			//$configupload['max_height']  = '1024';
			
			//print $configupload['upload_path']; 
			
			$photo = 'picture'; // name dari form file
			$this->upload->initialize($configupload);
			
			$this->load->helper("username_folder_helper");
			make_username_folder_tml($username);
			
			$this->upload->do_upload($photo);
			$dataphoto = $this->upload->data(); //echo "<hr>";
			//print_r($dataphoto);echo "<hr>";
			
			$error_upload = $this->upload->display_errors('<p> Upload : ', '</p>');
			// exit;
			
			if(empty($error_upload))
			{
				$config['image_library'] = 'gd2';
				$config['source_image'] = pathup("timeline/$username/big/$dataphoto[file_name]");
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = FALSE;
				
				$quality = 0;
				$width = 0;
				$height = 0;
				
				$hrd = $this->resize_dimension($dataphoto['image_width'],$dataphoto['image_height']);	
				
				//echo "w: ".$dataphoto['image_width']."&nbsp; h: ".$dataphoto['image_height']."<hr>";
				//print_r($hrd);exit;
								
				$config['quality'] 	= $hrd['quality'];
				$config['width'] 	  = $hrd['width'] * (3/4);
				$config['height']	 = $hrd['height'] * (3/4);
				
				$this->image_lib->initialize($config);
				
				if ( ! $this->image_lib->resize())
				{
					$error_resize =  $this->image_lib->display_errors('<p> Image Lib : ','</p>');
					return array(FALSE,$error_resize);
				}
				else
				{
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = pathup("timeline/$username/big/$dataphoto[file_name]");
					$nama_gambar = explode(".",$dataphoto['file_name']);
					$config['new_image']	= pathup("timeline/$username/small/$nama_gambar[0]"."_small."."$nama_gambar[1]");
					//$config['create_thumb'] = TRUE;
					//$config['quality'] = '85%';
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 40;
					$config['height'] = 40;
					
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					// Medium or Thumnail
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = pathup("timeline/$username/big/$dataphoto[file_name]");
					$config['new_image']	= pathup("timeline/$username/thumbnail/$nama_gambar[0]"."_thumb."."$nama_gambar[1]");
					//$config['create_thumb'] = TRUE;
					//$config['quality'] = '85%';
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 150;
					$config['height'] = 150;
					
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				
					return array(TRUE,$dataphoto['file_name']);
				}
			}
			else
			{
				return array(FALSE,$error_upload);
			}
			
		}
		
		function insert() 
		{   
			$this->authentification->close_access();
			//$this->authentification_model->ajax_access();
			
			$this->load->library("timeline_stuff");
			$this->load->helper("notification");
			$this->load->library('form_validation');
			
			$photo = !empty($_FILES['picture']['name']) ? $_FILES['picture']['name'] : "";
			
			//print_r($photo);

			//$this->form_validation->set_rules('timeline', 'Timeline', 'required');
			$tml = $this->input->post("timeline",TRUE); //echo "lalalala";
			$to = $this->input->post('to',TRUE);
	
			if($photo == "" && $tml == "")
			{
				echo "x|your post can't be empty";
			}
			else
			{	
			  
			  if($photo != "")
			  {
				  $photo =  $this->upload_image();
			  }
			  
			  if($photo[0] == TRUE)
			  {
				  $photo = $photo[1];
			  }		
			  else
			  {
				  
				  $photo = "";  
			  }
			    
			  
			  $this->load->model("timeline_model");
			  
			  //* == Filtering == */
			  $this->load->helper("link_stuff");
			  $tml = htmlentities($tml,ENT_QUOTES);
			  $tml = str_replace(chr(13),"<br>",$tml);
			  $tml = autolink($tml);
			  
			  $arr_mention = $this->timeline_stuff->arr_mention($tml);
			  
			  $mention_arr = "";
			  if(!empty($arr_mention))
			  {
				foreach($arr_mention as $row)
				{
			
					if(end($arr_mention) == $row)
					{
						$mention_arr .= "$row";	
					}
					else
					{
						$mention_arr .= "$row,";	
					}
				}
				
			  }
			  
			  $dt_tml = array
			  (
			  	'content'   => $tml, 
			  	'photo'	 => $photo, 
			  	'pelaut_id' => $this->session->userdata('id_user'), 
			  	'username' =>  $this->session->userdata('username'), 
			  	'title' 	=> '', 
			  	'type' 	 => 'status',
			  	'mention' => $mention_arr,
			  	'hashtag' => '',
			  	'to' 	  => $to 
			  );
	
			  
			  $i = $this->timeline_model->insert_timeline($dt_tml);
			  
			  
			  // notification write a wall
			  if(!empty($to))
			  {
				  //notif
				  
				  
				  //fetch username object
				  $strt = "SELECT * from pelaut_ms WHERE username = '$to' "; // to nya kosong 
				  $qt   = $this->db->query($strt);
				  $ft   = $qt->row_array(); 
				  
				  // send_email
				  $dt["name"]		   = $fr['nama_depan']." ".$fr["nama_belakang"]; // nama pelaku
				  $dt["image"]		  = check_profile_seaman($username_session); // photo pelaku
				  $dt["datetime"]	   = date("d F Y")." at ".date("H:i");
				  $dt["action"]		 = " Writing on your wall"; //action pelaku kepada object
				  
				  $arr["subject"]	   = $fr['nama_depan']." ".$fr["nama_belakang"]." Writing on your wall";
				  $arr["dt_template"]   = array("content"=>$this->load->view("timeline/email/person",$dt,true));
				  $arr["email_to"]	  = $ft['email']; //di detect dahulu / username penerima 
				  $arr["content_email"] = "content/email_template/new-email-template";
				  
				  $this->timeline_stuff->email_notif($arr); 
			  }
			  
			  //notification mention
			  $this->timeline_stuff->is_mentioned($tml);
			  
			  if(!empty($arr_mention))
			  {
				foreach($arr_mention as $row)
				{ 
				 
				  //fetch username object
				  $strt = "SELECT * from pelaut_ms WHERE username = '$row' "; // to nya kosong 
				  $qt   = $this->db->query($strt);
				  $ft   = $qt->row_array(); 
				  
				  // send_email
				  $dt["name"]		   = $fr['nama_depan']." ".$fr["nama_belakang"]; // nama pelaku
				  $dt["image"]		  = check_profile_seaman($username_session); // photo pelaku
				  $dt["datetime"]	   = date("d F Y")." at ".date("H:i");
				  $dt["action"]		 = "Mention you in status"; //action pelaku kepada object
				  
				  $arr["subject"]	   = $fr['nama_depan']." ".$fr["nama_belakang"]." Mention you in status";
				  $arr["dt_template"]   = array("content"=>$this->load->view("timeline/email/person",$dt,true));
				  $arr["email_to"]	  = $ft['email']; //di detect dahulu / username penerima 
				  $arr["content_email"] = "content/email_template/new-email-template";
				  
				  $this->timeline_stuff->email_notif($arr); 
				}
			  }
				
			  if(!$i)
			  {
				 echo "x|<span class='label label-danger'> data not inserted </span>";	
				  
			  }
			  else echo "y|<span class='label label-success'> success </span> ";
			  
			}
			
		}	
		
		function delete_timeline()
		{
			$this->authentification_model->close_access();
			//$this->authentification_model->ajax_access();
			
			$id_timeline = $this->input->post("id_tml");
			$q = $this->timeline_model->delete_timeline($id_timeline);	
			
			if($q)
			{
				echo "Delete timeline success";	
			}
			else
			{
				echo "Delete timeline failed";	
			}
			

		}

		

		function self_detail(){
			$dt_sendiri = $this->input->post("username");
			$str = "SELECT * FROM pelaut_ms WHERE username = '$dt_sendiri' ";
			$q = $this->db->query($str);
			$f = $q->row_array();

			echo json_encode($f);
		}
		
		function list_friend()
		{
			$username = $this->session->userdata("username");
			
			$str = "SELECT * FROM pelaut_ms WHERE username = '$username' ";
			$q = $this->db->query($str);
			$f = $q->row_array();
			
			$a = $f['array_teman'];
			$array_teman = explode("|",$a);
			
			
			if(!empty($array_teman))
			{
			  foreach($array_teman as $pelaut_id)
			  {
				  $stra = "SELECT * FROM pelaut_ms WHERE pelaut_id = '$pelaut_id' ";
				  $qa   = $this->db->query($stra);
				  $fa   = $qa->row_array();
				  
				  $profile_pic = check_profile_seaman($fa['username']);
				  
				  $result[] = array("username"=>$fa['username'],"fullname"=>$fa['nama_depan']." ".$fa['nama_belakang'],
				  "profile_pic"=>$profile_pic);
			  }
			}
			else
			{
				$result = array();	
			}
			
			echo json_encode($result);
		}
		
		
		
        function update()
        {

            $dt = $this->input->post("dt");
			$dt = json_decode($dt);
			
			$id_timeline = $dt->pk;
			$value 	   = $dt->value; 
			
            $this->timeline_model->update_timeline($id_timeline, $value);
        }

		
		function __destruct()
		{
			
				
		}
		
		
		
	}
