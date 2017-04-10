<?php


	class seatizen_ajax extends MX_Controller {

		function __construct(){
			parent::__construct();

			$username = $this->session->userdata('username');
			$id_pelaut = $this->session->userdata("pelaut_id");
			$user = $this->session->userdata("user");
			$this->load->model('seatizen_model'); 
			$this->load->model('department_model');
			$this->load->model('authentification_model');
			$this->load->model('rank_model');
			$this->load->model('vacantsea/vacantsea_model');
			$this->load->model('users/user_model');
			$this->load->model('ship_model');
			$this->load->model('coc_model');
			$this->load->model('nation_model');
			$this->load->model('vessel_model');

			$this->load->helper('notification');

		}

		function add_friend() {
			if($this->input->is_ajax_request()){
				$username = $this->session->userdata('username');
				$id_teman = $this->input->post('id_teman');
				$pribadi = $this->seatizen_model->detail_seatizen($username);
				$teman = $pribadi['friend_request'];
					$id_pribadi = $pribadi['pelaut_id'];
				$daftar_teman = explode("|",$teman);
		

				if($daftar_teman != "" OR !empty($daftar_teman)){
				
					$daftar_teman = "$teman|$id_teman";
				} else {
					$daftar_teman = "$id_teman";
				}
				$data_teman = $this->seatizen_model->get_detail_pelaut_by_id($id_teman);
				$username_teman = $data_teman['username'];
				$a = $data_teman['receive_request'];
				$receive_req = explode("|",$a);;
				
				
				if($receive_req != ""){
					$receive_req = "$a|$id_pribadi";
				} else if($receive_req == "") {
					$receive_req = "$id_pribadi";
				}	
				$a = $this->db->query("UPDATE pelaut_ms SET receive_request = '$receive_req' WHERE pelaut_id = '$id_teman'");
				$b = $this->db->query("UPDATE pelaut_ms SET friend_request = '$daftar_teman' WHERE username = '$username'");
		

				request_friend($username,$username_teman,"Add Friend");
			} else {
			header("location:".base_url("custom404"));
			}
				
				//for notification 
				// $title_notif = "Request for Friend";
				// $description = " want be your friends";
				// $type 		 = "Add Friend";
				// $from_user 	 = $username;
				// $to_user 	 = $username_teman;
				// $nama_pengirim = $pribadi['nama_depan']." ".$pribadi['nama_belakang'];
				
				// $ip_address  = $_SERVER['REMOTE_ADDR'];
				// $url 		  = base_url()."profile/".$from_user."/resume";

				// $str = "INSERT INTO notification_tr (title_notif,description,type,nama_pengirim,from_user,to_user,datetime,ip_address,url)
				//  VALUES ('$title_notif','$description','$type','$nama_pengirim','$from_user','$to_user',now(),'$ip_address','$url')";
				//  $q = $this->db->query($str);
				
		}	

		//fungsi terima pertmanan

		function terima_teman(){
			if($this->input->is_ajax_request()){
			$username = $this->session->userdata('username');
			$id_teman = $this->input->post('id_teman');
			$pribadi = $this->seatizen_model->detail_seatizen($username);
			$id_pribadi = $pribadi['pelaut_id'];
			$teman = $pribadi['array_teman'];
			$daftar_teman = explode("|",$teman);
			$receive_req = explode("|",$pribadi['receive_request']);
			foreach($receive_req as $key => $value){
				if($value == $id_teman){
					unset($receive_req[$key]);
				}
			}

			$receive_baru = implode("|",$receive_req);

			if($teman == ""){
				$daftar_teman = $id_teman;
			}else{
				$daftar_teman = "$teman|$id_teman";
			}




			$data_teman = $this->seatizen_model->get_detail_pelaut_by_id($id_teman);
			$teman_disisiteman = $data_teman['array_teman'];
			$data_request= $data_teman['friend_request'];
			$username_teman = $data_teman['username'];
			$data_disisiteman = explode("|",$teman_disisiteman);
			$request_teman = explode("|",$data_request);
			foreach($request_teman as $key => $value){
				if($value == $id_pribadi){
					unset($request_teman[$key]);
				}
			}

			$friend_request_baru = implode("|",$request_teman);


			if($teman_disisiteman == ""){
				$data_disisiteman = $id_pribadi;
			} else{
				$data_disisiteman = "$teman_disisiteman|$id_pribadi";
			}

			//query notif
			$this->db->query("UPDATE notification_tr SET read_user = 1 WHERE (from_user = '$username_teman' AND to_user = '$username')");

				request_friend($username,$username_teman,"Confirm");

			// $title_notif = "Receive Friends";
			// $description = " has accepted you as friend in Informasea";
			// $type = "Accept Friend";
			// $from_user = $username;
			// $to_user = $username_teman;
			// $nama_pengirim = $pribadi['nama_depan']." ".$pribadi['nama_belakang'];
			// $ip_address = $_SERVER['REMOTE_ADDR'];
			// $url = base_url()."profile/".$username."/resume";
		

			// $this->db->query("INSERT INTO notification_tr (title_notif,description,type,nama_pengirim,from_user,to_user,datetime,ip_address,url) 
			// 	VALUES ('$title_notif','$description','$type','$nama_pengirim','$from_user','$to_user',now(),'$ip_address','$url')");


			$this->db->query("UPDATE pelaut_ms SET array_teman = '$daftar_teman',receive_request = '$receive_baru' WHERE username = '$username'");
			$this->db->query("UPDATE pelaut_ms SET array_teman = '$data_disisiteman', friend_request = '$friend_request_baru' WHERE pelaut_id ='$id_teman'");
		} else {
			header("location:".base_url("custom404"));

		}
		}
		//fungsi batal terima pertemanan
		function batal_terima(){
			if($this->input->is_ajax_request()){
				$username = $this->session->userdata('username');
			$id_teman = $this->input->post('id_teman');

			$pribadi = $this->seatizen_model->detail_seatizen($username);
				$id_pribadi = $pribadi['pelaut_id'];
				$terima = $pribadi['receive_request'];
				$daftar_terima = explode("|",$terima);

				foreach($daftar_terima as $key => $value){
					if($value == $id_teman){
						unset($daftar_terima[$key]);
					}
				}

				$daftar_terima_baru = implode("|",$daftar_terima);

				$data_teman = $this->seatizen_model->get_detail_pelaut_by_id($id_teman);
				$list_request = $data_teman['friend_request'];
				$username_teman = $data_teman['username'];
				$request = explode("|",$list_request);

				foreach($request as $key => $value){
					if($value == $id_pribadi){
						unset($request[$key]);
					}
				}


			


				$daftar_request_baru = implode("|",$request);

				$this->db->query("UPDATE pelaut_ms SET receive_request = '$daftar_terima_baru' WHERE username = '$username'");
				$this->db->query("UPDATE pelaut_ms SET friend_request = '$daftar_request_baru' WHERE pelaut_id = '$id_teman'");
			} else {
			header("location:".base_url("custom404"));

			}
			
		}
		

		//fungsi batalin request pertemanan

		function batalrequestfriend(){
			if($this->input->is_ajax_request()){
				$username = $this->session->userdata('username');
			$id_teman = $this->input->post('id_teman');

			$pribadi = $this->seatizen_model->detail_seatizen($username);
				$id_pribadi = $pribadi['pelaut_id'];

				$teman = $pribadi['friend_request'];
				$daftar_teman = explode("|",$teman);
				$b  = print_r($daftar_teman);

				foreach($daftar_teman as $key => $value){
					if($value == $id_teman){
						unset($daftar_teman[$key]);
					}
				}
				


				
			$data_teman = $this->seatizen_model->get_detail_pelaut_by_id($id_teman);
			$list_terima = $data_teman['receive_request'];
			$username_teman = $data_teman['username'];
			$list = explode("|",$list_terima);
			$c = print_r($list_terima);
			foreach($list as $key => $value){
				if($value == $id_pribadi){
					unset($list[$key]);
				}
			}

				$str = "DELETE FROM notification_tr WHERE from_user = '$username' AND to_user = '$username_teman'";
				$q = $this->db->query($str);
				echo $str;

			$list_baru = implode("|",$list);



			$daftar_teman_baru = implode("|",$daftar_teman);
			$this->db->query("UPDATE pelaut_ms SET friend_request = '$daftar_teman_baru' WHERE username = '$username'");
			$this->db->query("UPDATE pelaut_ms SET receive_request = '$list_baru' WHERE pelaut_id = '$id_teman'");
		} else {
						header("location:".base_url("custom404"));

		}
			
		}	

		//fungsi delete teman
		function delete_friend(){
			if($this->input->is_ajax_request()){

			$username = $this->session->userdata('username');
			$id_teman = $this->input->post('id_teman');
			$pribadi = $this->seatizen_model->detail_seatizen($username);
				$id_pribadi = $pribadi['pelaut_id'];
			$teman = $pribadi['array_teman'];
			$daftar_teman = explode("|",$teman);
					
			foreach($daftar_teman as $key => $value){
				if($value == $id_teman){
					unset($daftar_teman[$key]);
				}
			}

			$data_teman = $this->seatizen_model->get_detail_pelaut_by_id($id_teman);
			$teman_t = $data_teman['array_teman'];
			$daftar_diteman = explode("|",$teman_t);
				foreach($daftar_diteman as $key => $value){
				if($value == $id_pribadi){
			unset($daftar_diteman[$key]);
		 	}
		 }
			$data_temanbaru = implode("|",$daftar_diteman);
			
			$daftar_teman_baru = implode("|",$daftar_teman);
			$a = $this->db->query("UPDATE pelaut_ms SET array_teman = '$daftar_teman_baru' WHERE username = '$username'");	
			$b = $this->db->query("UPDATE pelaut_ms SET array_teman = '$data_temanbaru' WHERE pelaut_id = '$id_teman'");
		
			} else {
				header("location:".base_url('custom404'));
			}
			
		}
	
		function modal(){
			//alert('masuk disini');
			$x = $this->input->post("x");
		if($x == 1)
		{
		  
		  $modal_type = $this->input->post("modal");
		  //echo "<script>alert('$modal_type')</script>";
		  $id_update = $this->input->post('id_update');
		  if($modal_type == "delete-friend-modal")
		  {
		  		$data['seatizen'] = $this->seatizen_model->get_detail_pelaut_by_id($id_update);
			 //echo "<script>alert('hai')</script>";
			  $this->load->view("modal_delete",$data);	
		  }	 else if($modal_type == "modal-login") {
		  	$this->load->view("modal-login");
		  }
		  
		}
		else
		{
			header("location:".base_url("custom404"));
		}

		}

	}