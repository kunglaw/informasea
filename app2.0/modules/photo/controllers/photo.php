<?php if(!defined('BASEPATH')) exit ('No direct script access allowed'); 

	class Photo extends MX_Controller{
		
		function __construct()
		{
			parent::__construct();
			
			//$this->authentification_model->close_access();
			
			$this->load->model('photo/photo_mdl');

		}
		
		function index()
		{
			$data['head']	 = "head";
			$data['title']	= $this->session->userdata("nama");
			$data['css']	  = "css"; //css tambahan, di head
			$data['meta']	 = "meta"; // meta tambahan, di head
			$data['js_top']   = "js_top"; // js tambahan, di head
			
			$data['footer']   = "footer";
			$data['js_under'] = "js_under";
			
			$data['template'] = "photo/template";
			$this->load->view('index',$data);
		}
		
		function test()
		{
			$data['head']	 = "head";
			$data['title']	= "Test Photo";
			$data['css']	  = "css"; //css tambahan, di head
			$data['meta']	 = "meta"; // meta tambahan, di head
			$data['js_top']   = "js_top"; // js tambahan, di head
			
			$data['template'] = "test_photo";
			
			$data['footer']   = "footer";
			$data['js_under'] = "js_under";
			
			$this->load->view('index',$data);
			
		}
		/*halaman detail photo 
		PUBLIC 
		*/
		function detail()
		{
			// nanti dihilangkan
			$this->authentification->close_access();
			
			$uri3 = $this->uri->segment(2);
			$check_gambar = $this->photo_mdl->check_photo($uri3); // uri3 = nama photo 
			
			
			if(!empty($check_gambar))
			{
			  // link contoh untuk 
			  // http://localhost/informasea/photo/detail/94755B7057CB8C46993B24352C364FF620150123075951
			  $this->load->model("users/user_model"); // dari module users
			  $data['detail_pelaut'] = $this->user_model->get_detail_pelaut($check_gambar['username']);
			  //print_r($data['detail_pelaut']);
			  //echo "<br>";
			  
			  $this->load->model('timeline/timeline_model');
			  $data['timeline']	= $this->timeline_model->get_timeline_byphoto($check_gambar['nama_gambar']);
			  //print_r($data['timeline']);
			  
			  
			  $title = $check_gambar['title'];
			  if($check_gambar['title'] == "")
			  {
				  $title = $check_gambar['description'];
				  if($check_gambar['description'] == "" )
				  {
					  $title = $data["detail_pelaut"]["nama_depan"]." ".$data["detail_pelaut"]["nama_belakang"];
				  }
			  }
			  
			  /* buat paging */
			  $username = $check_gambar['username'];
			 
			  $data['curr'] = $check_gambar;
			  $data['prev'] = $this->photo_mdl->prevp($username,$check_gambar['id_pptr']);
			  $data['next'] = $this->photo_mdl->nextp($username,$check_gambar['id_pptr']);
			  
			  
			  /*echo "Current: <hr>";
			  print_r($data['curr']);
			  echo "<hr> Previous: ";
			  print_r($data['prev']);
			  echo "<hr> Next : ";
			  print_r($data['next']);*/
			 
			  
			  $data['title'] = $title;
			  $data['css'] = "seaman/detail/head";
			  $data['ctrl'] = "detail";
			  
			  /* image */
			  $data['detail_image'] = $check_gambar['nama_gambar'];
			  $data['data_image'] = $check_gambar;
			   
			  $data['template'] = "detail-photo/template";
			  
			  //print_r($data['detail_image']);
			  
			  $this->load->view('index',$data);
			}
			else
			{
				show_404();	
			}
		}	
		
		// AJAX = proses dari form image-crop-temp
		// function ini dimatikan untuk backup
		//function crop_resume()
//		{
//			$x = $this->input->post("x");
//			$this->load->helper('image_thumb_helper');
//			
//			if($x == 1)
//			{
//			  //$this->load->helper('image_thumb_helper');
//			  $this->load->model('timeline/timeline_model');
//			  
//			  $file_name 		= $this->input->post("file_name");
//			  $file_size 		= $this->input->post("file_size");
//			  $file_type 		= $this->input->post("file_type");
//			  $type 	  		 = $this->input->post("type");
//			  $file_title	   = $this->input->post("file_title");
//			  $file_description = $this->input->post("file_description");
//			  
//			  //print_r($this->input->post()); exit;
//			  
//			  if(empty($file_name))
//			  {
//				  $file_name = $this->input->get("file_name");
//			  }
//			  //echo "image telah di cropping .. ";
//			  image_cropping($file_name,$destination = $type, $source = $type);
//			  echo "the image has been cropping .. ";
//			  			  
//			  // cek photo berdasarkan file_name
//			  $check_photo = $this->photo_mdl->check_photo($file_name);
//			  
//			 /* echo "check_photo : ";
//			  print_r($check_photo); echo "<hr>";*/
//			  
//			  $a = array(
//				0=>TRUE,
//				"file_name" => $file_name,
//				"file_size" => $file_size,
//				"file_type" => $file_type,
//				"file_title" => $file_title,
//				"file_description" => $file_description,
//				"type" => $type); // untuk info di timeline 
//				// output function
//			  
//			  if(empty($check_photo))
//			  {
//			 	$this->just_insert($a); // belakangan bisa kali yaa
//				//$this->just_insert_tml($a,"Update Photo Resume","Resume");
//			  }

//			  // masukkan script ini jika sudah melakukan proses cropping 
//			  $id_pptr = mysql_insert_id();
//			  $photo_dlr = $this->photo_mdl->get_photo_id($id_pptr);
//			  if(!empty($photo_dlr))
//			  {
//				if($type == "resume")
//				{  
//				  //echo "yok kita nonton ondel2, nyok";
//				  $resume_pic = $this->photo_mdl->get_photo_resume();
//				  if(!empty($resume_pic))
//				  {
//					  // ubah profile pic menjadi gambar biasa
//					  $this->photo_mdl->update_resume_deselect($resume_pic['id_pptr']);	
//				  }
//				  $this->photo_mdl->update_resume_pic($id_pptr);
//				}
//				else if($type == "profile_pic")
//				{
//				  $profile_pic = $this->photo_mdl->get_photo_pp();
//				  //print_r($profile_pic);
//				  if(!empty($profile_pic))
//				  {
//					  // ubah profile pic menjadi gambar biasa
//					  $this->photo_mdl->update_pp_deselect($profile_pic['id_pptr']);	
//				  }
//				  $this->photo_mdl->update_profile_pic($id_pptr);
//				}
//				else if($type == "cover")
//				{
//				  $cover = $this->photo_mdl->get_photo_cover();
//				 // print_r($cover);
//				  if(!empty($cover))
//				  {
//					  // ubah profile pic menjadi gambar biasa
//					  $this->photo_mdl->update_cover_deselect($cover['id_pptr']);	
//				  }
//				  $this->photo_mdl->update_cover($id_pptr);
//				}
//			  }
//			  
//			  // paling belakang, jika proses croping sudah selesai, masukkan ke timeline 
//			  $check_tml = $this->timeline_model->get_timeline_byphoto($file_name);
//			  //print_r($check_tml);
//			  if(empty($check_tml))
//			  {
//				if($type == "resume")
//				{
//			  		$this->just_insert_tml($a,"Update Photo Resume","Resume");
//				}
//				else if($type == "profile_pic")
//				{
//					$this->just_insert_tml($a,"Update Profile Picture","profile_pic");
//				}
//				else if($type == "cover")
//				{
//					$this->just_insert_tml($a,"Update Cover","cover");
//				}
//			  }
//			  
//			  
//			}
//			else
//			{
//				show_404();
//			}
//			
//		}
		
		function __destruct()
		{
			
			
		}
	}