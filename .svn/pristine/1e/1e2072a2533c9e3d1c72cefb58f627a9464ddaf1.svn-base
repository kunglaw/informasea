<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed');

class photo_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('photo/photo_mdl');
	}
	
	// login
	function rotate()
	{
		$this->authentification_model->close_access();
		
		// nama gambar 
		$nama_gambar = $this->input->post("nama_gambar");
		$username 	= $this->session->userdata("username");
		
		//rotate		
		$this->load->helper("image_thumb_helper");
		image_big_rotate($nama_gambar);
		image_thumb_rotate($nama_gambar);
		image_small_rotate($nama_gambar);
	
	}
	
	function crop_rpc()
	{
		$this->authentification_model->ajax_access();
		
		$this->load->model('timeline/timeline_model');
		$this->load->library('upload');
		$this->load->helper('image_thumb_helper');
		$this->load->helper('username_folder_helper');
		
		$username = $this->session->userdata("username");
		
		$file_name 		= $_FILES['picture']['name'];
		$file_size 		= $_FILES['picture']['size'];
		$file_type 		= $_FILES['picture']['type'];
		$file_title	   = $_FILES['picture']['name'];
		
		$type 	  		 = $this->input->post("type"); echo "<br>";
		$nama_gambar 	  = $this->input->post("nama_gambar");
		$file_description = $this->input->post("file_description");
		$file_crop		= $this->input->post("file-crop");
		
		// jika file upload kosong, maka hanya kirimkan yang cropnya saja , tanpa mengubah database
		// jika file upload isi, maka kirimkan data asli , crop , ubah database
		if(empty($_FILES))
		{
			// jika file upload kosong, maka hanya kirimkan yang cropnya saja , tanpa mengubah database
			if(!empty($file_crop))
			{
			  // jika file_crop tidak kosong 
			  // ambil dari database profile_pic yang aktif
			  if($type == "resume")
			  {  
			   
				$pic = $this->photo_mdl->get_photo_resume();
			  }
			  else if($type == "profile_pic")
			  {
				$pic = $this->photo_mdl->get_photo_pp();
			  }
				
			  // function utama cropping
			  $explodesi = explode(".",$pic['nama_gambar']);
			  list($kk, $file_crop)   = explode(';', $file_crop);
			  list(,$file_crop)       = explode(',', $file_crop);
			  $file_crop 			  = base64_decode($file_crop);
			  file_put_contents(pathup("photo/$username/$type/$explodesi[0]"."_thumb.".$explodesi[1]), $file_crop);
			  /* end cropping */
			  
			  $info =  pathup("photo/$username/$type/$explodesi[0]"."_thumb.".$explodesi[1]);
			  
			  // dari database
			  image_small_fr(/*$file_name = */$pic['nama_gambar'],/*$destination =*/ $type, /*$source =*/ $type);
			  
			  // edit description aja 
			  if($type == "resume")
			  {  
			   
				 $str = "update photo_pelaut_tr set description = '$file_description' where id_pptr = '$pic[id_pptr]' ";
				 $this->db->query($str);
			  }
			  else if($type == "profile_pic")
			  {
				 $str = "update photo_pelaut_tr set description = '$file_description' where id_pptr = '$pic[id_pptr]' ";
				 $this->db->query($str);
				 
				 $str2 = "update timeline set content = '$file_description' where photo = '$pic[nama_gambar]' ";
				 $this->db->query($str2);
			  }
			 
			}
		}
		else
		{
			// jika file upload isi, maka kirimkan data asli , crop , ubah database
			
			/*extention*/
			$extt = explode("/",$_FILES['picture']['type']);// echo "<br>";
			
			$ext = $extt[1];
			$a = $this->db->query("SHOW TABLE STATUS FROM `infr6975_informaseadb2014` LIKE 'photo_pelaut_tr' ");
			$b = $a->row_array();
			$b['Auto_increment'];
			/*end extention */
			
			$config['upload_path'] 	   = pathup("photo/$username/$type");
			$config['file_name']		 = strtoupper(md5($b['Auto_increment'].$_FILES['picture']['name'])).date('YmdHis').".".$ext;
			$config['allowed_types'] 	 = 'gif|jpg|png|jpeg|tiff';
			$config['max_size']		  =  1024 * 1024 * 10; // 10MB;
			//$config['max_width'] 		 = '1024';
			//$config['max_height'] 	 = '768';
			
			$photo = 'picture'; // name dari form file
			$this->upload->initialize($config);
		
			// buat foldernya dahulu
			// dari username_folder_helper
			make_username_folder_pt($username);
			/*check folder selesai */
			
			$this->upload->do_upload($photo);
			
			$dataphoto = $this->upload->data();
			
			/*Array
			(
				[file_name] => 9C3BE8902FFBAB97950B4C8F5131A1E620150415162624.jpeg
				[file_type] => image/jpeg
				[file_path] => D:/xampp/htdocs/infrasset/photo/alhusna_99/profile_pic/
				[full_path] => D:/xampp/htdocs/infrasset/photo/alhusna_99/profile_pic/9C3BE8902FFBAB97950B4C8F5131A1E620150415162624.jpeg
				[raw_name] => 9C3BE8902FFBAB97950B4C8F5131A1E620150415162624
				[orig_name] => 9C3BE8902FFBAB97950B4C8F5131A1E620150415162624.jpeg
				[client_name] => C360_2013-08-12-13-07-25-018.jpg
				[file_ext] => .jpeg
				[file_size] => 50.61
				[is_image] => 1
				[image_width] => 640
				[image_height] => 480
				[image_type] => jpeg
				[image_size_str] => width="640" height="480"
			)*/

			
			$error_upload = $this->upload->display_errors("<p class='alert alert-danger'> Upload : ", "</p>");
			
			if(empty($error_upload))
			{
			  // function utama cropping
			  $explodesi = explode(".",$dataphoto['file_name']);
			  list($kk, $file_crop) = explode(';', $file_crop);
			  list(,$file_crop)       = explode(',', $file_crop);
			  $file_crop = base64_decode($file_crop);
			  file_put_contents(pathup("photo/$username/$type/$explodesi[0]"."_thumb.".$explodesi[1]), $file_crop);
			  /* end cropping */
			  
			  // upload tiny image
			 image_small_fr($file_name = $dataphoto['file_name'],$destination = $type, $source = $type);
			  
			  $dt_photo = array(
			  'nama_gambar' 		=>	$dataphoto['file_name'], // $photo = $photo[1] *MINDBLOWN*
			  'size_gambar'		=>	$dataphoto['file_size'], 
			  'id_pelaut' 	  	  =>	$this->session->userdata('id_user'), 
			  'type_gambar' 		=>	$dataphoto['file_type'],
			  "username"	   	   =>	$this->session->userdata('username'),
			  "title"		  	  => 	$_FILES['picture']['name'],
			  "file_description"   =>    $file_description
			  );
			  
			  // pemberitahuan ke timeline bahwa user mengupload photo baru
			  $dt_tml = array(
			  
				'content' => $file_description, 
				'photo'=>$dataphoto['file_name'], 
				'pelaut_id' => $this->session->userdata('id_user'), 
				'username' => $this->session->userdata('username'), 
				'title' => "Added a New Profile Picture", 
				'type' => 'profile_pic'
			  
			  );
			  
			  // masukkan dahulu photo 
			  $this->photo_mdl->insert_photo($dt_photo);

			  //masukkan script ini jika sudah melakukan proses cropping dan insert photo
			  $id_pptr = mysql_insert_id();
			  $photo_dlr = $this->photo_mdl->get_photo_id($id_pptr);
			  if(!empty($photo_dlr))
			  {
				if($type == "resume")
				{  
				 
				  $resume_pic = $this->photo_mdl->get_photo_resume();
				  if(!empty($resume_pic))
				  {
					   //ubah profile pic menjadi gambar biasa
					  //$this->photo_mdl->update_resume_deselect($resume_pic['id_pptr']);	
				  }
				  //$this->photo_mdl->update_resume_pic($id_pptr);
				}
				else if($type == "profile_pic")
				{
				  $profile_pic = $this->photo_mdl->get_photo_pp();
				  
				  if(!empty($profile_pic))
				  {
					   //ubah profile pic menjadi gambar biasa
					  $this->photo_mdl->update_pp_deselect($profile_pic['id_pptr']);	
				  }
				  $this->photo_mdl->update_profile_pic($id_pptr);
				}
				else if($type == "cover")
				{
				  $cover = $this->photo_mdl->get_photo_cover();
				  
				  if(!empty($cover))
				  {
					   //ubah profile pic menjadi gambar biasa
					  $this->photo_mdl->update_cover_deselect($cover['id_pptr']);	
				  }
				  $this->photo_mdl->update_cover($id_pptr);
				}
			  }
			  
			  //paling belakang, jika proses croping sudah selesai, masukkan ke timeline 
			  $check_tml = $this->timeline_model->get_timeline_byphoto($file_name);
			  
			  if(empty($check_tml))
			  {
				if($type == "resume")
				{
					//$this->just_insert_tml($dt_tml,"Update Photo Resume","Resume");
				}
				else if($type == "profile_pic")
				{
					$this->just_insert_tml($dt_tml,"Update Profile Picture","profile_pic");
				}
				else if($type == "cover")
				{
					$this->just_insert_tml($dt_tml,"Update Cover","cover");
				}
			  }
			  
			 
			}
			else
			{
				
				echo $error_upload;
					
			}
			
			/*
			*/
			

			$info =  "<img src='".img_url("photo/$username/$type/$file_name")."'>". 
					pathup("photo/$username/$type/$file_name");
			
		}
		
	}
		
		function delete_crop()
		{
			$username = $this->session->userdata("username");
			$file_name = $this->input->post("file_name");
			$x = $this->input->post("x");
			$type = $this->input->post("type");
			
			if($x == 1)
			{				
				$a = unlink(pathup("photo/$username/$type/$file_name"));
				$ss = explode(".",$file_name);
				$b = unlink(pathup("photo/$username/$type/$ss[0]"."_small.".$ss[1]));
				//var_dump($a);
				//var_dump($b);
			}
			
		}
		
		function delete_photo()
		{
			$this->authentification_model->close_access();
			//$this->authentification_model->ajax_access();
			
			$x = $this->input->post("x");
			$id_pptr = $this->input->post("id_pptr");
			$username = $this->session->userdata("username");
			
			if($x == 1)
			{
			  $strww = "select * from photo_pelaut_tr where id_pptr = '$id_pptr' ";
			  $q = $this->db->query($strww);
			  $f = $q->row_array();
			  
			  if(!empty($f))
			  {
				$nama_photo = explode(".",$f['nama_gambar']);
				unlink(pathup("photo/$username/big/$f[nama_gambar]"));
				unlink(pathup("assets/photo/$username/thumbnail/$nama_photo[0]"."_thumb.".$nama_photo[1]));
				unlink(pathup("assets/photo/$username/small/$nama_photo[0]"."_small.".$nama_photo[1]));
				
				// delete photo di timeline
				$str2 = "delete from timeline where photo = '$f[nama_gambar]' ";
				$q2 = $this->db->query($str2);
				
				// diproses belakangan
				$str = "delete from photo_pelaut_tr where id_pptr = '$id_pptr' ";
				$q = $this->db->query($str);
			  }
			  else
			  {
				  echo "picture not selected";	
			  }
			}
			else
			{
				show_404();	
			}
		}

        function delete_photo_timeline()
        {
            $this->authentification_model->close_access();
            //$this->authentification_model->ajax_access();

            $x = $this->input->post("x");
            $id_pptr = $this->input->post("id_pptr");
            $username = $this->session->userdata("username");

            if($x == 1)
            {
                $strww = "select * from timeline where id_timeline = '$id_pptr' ";
                $q = $this->db->query($strww);
                $f = $q->row_array();

                if(!empty($f))
                {
                    $nama_photo = explode(".",$f['nama_gambar']);
                    unlink(pathup("photo/$username/big/$f[nama_gambar]"));
                    unlink(pathup("assets/timeline/$username/thumbnail/$nama_photo[0]"."_thumb.".$nama_photo[1]));
                    unlink(pathup("assets/timeline/$username/small/$nama_photo[0]"."_small.".$nama_photo[1]));

//                    // delete photo di timeline
//                    $str2 = "delete from timeline where photo = '$f[nama_gambar]' ";
//                    $q2 = $this->db->query($str2);

                    // diproses belakangan
                    $str = "delete from timeline where id_timeline = '$id_pptr' ";
                    $q = $this->db->query($str);
                }
                else
                {
                    echo "picture not selected";
                }
            }
            else
            {
                show_404();
            }
        }
		
		// AJAX
		function upload_photo()
		{
			//ini_set('upload_max_filesize','20M');  
			$this->authentification->close_access();
			//$this->authentification->ajax_access();
			
			$username = $this->session->userdata("username");
			$this->load->library('image_lib');
			$this->load->library('upload');
			$this->load->helper('image_thumb_helper');
			$this->load->helper("username_folder_helper");
			
			/*extention*/
			$extt = explode("/",$_FILES['picture']['type']);// echo "<br>";
			
			$ext = $extt[1];
			$a = $this->db->query("SHOW TABLE STATUS FROM `infr6975_informaseadb2014` LIKE 'photo_pelaut_tr' ");
			$b = $a->row_array();
			$b['Auto_increment'];
			
			$configupload['upload_path'] = pathup("photo/$username/big");
			$configupload['file_name'] = strtoupper(md5($b['Auto_increment'].$_FILES['picture']['name'])).date('YmdHis').".".$ext;
			$configupload['allowed_types'] = "gif|jpg|png|jpeg";
			$configupload['max_size']	=  1024 * 1024 * 10; // 10MB;
			//echo $_FILES['picture']['size']; exit;
			//$configupload['max_width']  = '1024';
			//$configupload['max_height']  = '1024';
			
			//print $configupload['upload_path']; 
			
			$photo = 'picture'; // name dari form file
			$this->upload->initialize($configupload);
			
			// buat foldernya dahulu
			// dari username_folder_helper
			make_username_folder_pt($username);
			/*check folder selesai */
			
			$this->upload->do_upload($photo);
			
			$dataphoto = $this->upload->data();
			//print_r($dataphoto); //exit;
			
			$error_upload = $this->upload->display_errors('<p class="alert alert-danger"> Upload : ', '</p>');
			//echo($error_upload); //exit;
			
			if(empty($error_upload))
			{
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = pathup("photo/$username/big/$dataphoto[file_name]");
				$config['maintain_ratio'] = TRUE;
				
				//echo "true way ... ";
				
				$hrd = resize_dimension($dataphoto['image_width'],$dataphoto['image_height']);
				//print_r($dataphoto); exit;
				
				$config['quality'] 	= $hrd['quality'];
				$config['width'] 	  = $hrd['width'];
				$config['height']	 = $hrd['height'];
				
				$this->image_lib->initialize($config);
				
				if ( ! $this->image_lib->resize())
				{
					$error_resize =  $this->image_lib->display_errors('<p> Image Lib : ','</p>');
					return array(FALSE,$error_resize);
				}
				else
				{
					$this->image_lib->clear();
					// dari image_thumb_helper
					image_small($file_name = $dataphoto['file_name'],$destination = "photo");
					
					/* Medium or Thumnail */
					image_thumb($file_name = $dataphoto['file_name'],$destination = "photo");
					
					//image_resize_photo($dataphoto['file_name']);
								  //0			1                        2                        3
					return array(TRUE,$dataphoto['file_name'],$_FILES['picture']['size'],$_FILES['picture']['type']); // output function
				}
			}
			else
			{
				//echo "false ...";
				return array(FALSE,$error_upload);
			}
			//echo "out ... ";
			
		}
		
		function insert_photo()
		{   
			$this->authentification->close_access();
			//$this->authentification_model->ajax_access();
			
			$this->load->library('form_validation');
			
			$photo = "";
			$photo = $this->upload_photo(); // dari function upload_photo
			
			//print_r($photo); exit;
			//$this->form_validation->set_rules('timeline', 'Timeline', 'required');
			//$tml = $this->input->post("timeline",TRUE); //echo "lalalala";
			//$to = $this->input->post('to',TRUE);
	
			if($_FILES['picture']['name'] == "" )
			{
				echo "You must choose a Photo";
			}
			
			else
			{
			  //$this->load->model("timeline_model");
			  
			  if($photo[0] == TRUE)

			  {
				  $photo_tmp = $photo[1]; // jika gambar ada 
				  
				  $dt_photo = array(
				  'nama_gambar' 	=>	$photo_tmp, // $photo = $photo[1] *MINDBLOWN*
				  'size_gambar'	=>	$photo[2], 
				  'id_pelaut' 	  =>	$this->session->userdata('id_user'), 
				  'type_gambar' 	=>	$photo[3],
				  "username"	   =>	$this->session->userdata('username'),
				  "title"		  => 	$_FILES['picture']['name']
				  );
				  
				  // pemberitahuan ke timeline bahwa user mengupload photo baru
				  $dt_tml = array(
				  
					  'content' => "", 
					  'photo'=>$photo_tmp, 
					  'pelaut_id' => $this->session->userdata('id_user'), 
					  'username' => $this->session->userdata('username'), 
					  'title' => "Added a New Photo", 
					  'type' => 'photo'
				  
				  );
				  
				  //print_r($this->session->all_userdata());
				  
				  //print_r($dt_tml); exit;			
				  
				  $i = $this->photo_mdl->insert_photo($dt_photo);
				  $this->load->model('timeline_model');
				  $this->timeline_model->insert_photo_timeline($dt_tml);
			  
			  
				  if(!$i)
				  {
					 echo "data tidak berhasil di input ... ";	
					  
				  }
			  }		
			  else
			  {
				  
				  $photo = $photo[1];  // jika terjadi kesalahan upload gambar
				  echo $photo;
			  }

			}
			
		}
	
	// digunakan untuk keperluan upload photo resume dan profile pic secara langsung
	// gak perlu pakek sok2an inform ke timeline
	// PRIVATE
	function just_insert($photo)
	{
		$this->authentification_model->close_access();
		/*echo "Photo : ";
		print_r($photo);
		echo "<hr>";*/
		
		$this->load->library('form_validation');
		
		if(empty($photo))
		{
			echo "You must choose a Photo";
		}
		
		else
		{
		  
		  if($photo[0] == TRUE)
		  {
			  $dt_photo = array(
			  'nama_gambar' 	=>	$photo["file_name"], // $photo = $photo[1] *MINDBLOWN*
			  'size_gambar'	=>	$photo["file_size"], 
			  'id_pelaut' 	  =>	$this->session->userdata('id_user'), 
			  'type_gambar' 	=>	$photo["file_type"],
			  "username"	   =>	$this->session->userdata('username'),
			  "title"		  => 	$photo["file_title"],
			  "description"	=> 	$photo["file_description"]
			  );
			  
			  //print_r($this->session->all_userdata());
			  
			/*  echo "dt_photo: ";
			  print_r($dt_tml); echo "<hr>";*/	
			  
			  $i = $this->photo_mdl->insert_photo($dt_photo);
			 
			  
		  
			  if(!$i)
			  {
				 echo "data tidak berhasil di input ... ";	
				  
			  }
		  }		
		  else
		  {
			  
			  $photo = $photo[1];  // jika terjadi kesalahan upload gambar
			  echo $photo;
		  }

		}
	}
	
	// PRIVATE
	function just_insert_tml($photo,$title = "",$type = "")
	{
		$this->authentification_model->close_access();
		
		$dt_tml = $photo;
		
		$this->load->model('timeline/timeline_model');
		$this->timeline_model->insert_timeline($dt_tml);
	}
	
	function __destruct()
	{
		
		
	}
	
	
	
}