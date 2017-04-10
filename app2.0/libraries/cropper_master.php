<?php if(!defined("BASEPATH")) exit ("No Direct Script Access Allowed");

class Cropper_master {
	
    private $src;
    private $data;
    private $file;
	public  $files; // kunglaw
    private $dst;
    private $type;
    private $extension;
    private $msg;
	
	// kunglaw
	private $username;
	private $username_company;
	private $username_agent;
	private $user_type;	
	public  $setFile;
	private $setSrc;
	private $setData;
	private $nama_gambar;
	private $err;
	
	private $photo_type;
	private $crop_width;
	private $crop_height;
	
    function __construct() {
		
	  $CI =& get_instance();
	  $src = $CI->input->post("img_src",true);
	  
	  $CI->load->helper("username_folder");
	  $CI->load->helper("image_thumb_helper");
	  $CI->load->helper("file_url");
	  
	  $this->username  			= $CI->session->userdata("username");
	  $this->username_company 	= $CI->session->userdata("username_company");
	  $this->username_agent	  = $CI->session->userdata("username_agent");
	  $this->user_type  		   = $CI->session->userdata("user");
	  
	  $this->photo_type = $CI->input->post("photo_type");
	  $this->crop_width = $CI->input->post("crop_width",true);
	  $this->crop_height= $CI->input->post("crop_height",true);
	  $data 	   		 = $CI->input->post("img_data",true);
	  $this->nama_gambar= $CI->input->post("nama_gambar"); // kalau gambar sudah ada saat show modal
	  
	  $this->files 	  = $_FILES["img_input"];
	  $file 	   		 = $_FILES["img_input"];
	  
	  /* echo "<pre>";
	  echo "<h4> libraries </h4>";
	  print_r($this->files);
	  echo "</pre>";*/
	  
      $this->setSrc  	 = $this -> setSrc($src);
      $this->setData 	= $this -> setData($data); // data ukuran, tinggi, dimensi dari cropping 
      $this->setFile 	= $this -> setFile();
      $crop   		  	 = $this -> crop($this -> src, $this -> dst, $this -> data);
    }
	
	// hapus photo fisik
	public function delete_all_resume($username)
	{
		$files = glob('../infrasset/photo/$username/resume/*'); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
			unlink($file); // delete file
		}	
	}
	
	// hapus photo fisik
	public function delete_all_profilepic($username)
	{
		$files = glob('../infrasset/photo/$username/profile_pic/*'); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
			unlink($file); // delete file
		}	
		
	}
	
	public function image_data()
	{
		$setFile = $this->setFile;		
		return $setFile;
	}
	
    private function setSrc($src) {
      if (!empty($src)) {
        $type = exif_imagetype($src);

        if ($type) {
          $this -> src = $src;
          $this -> type = $type;
          $this -> extension = image_type_to_extension($type);
          $this -> setDst();
        }
      }
    }

    private function setData($data) {
      if (!empty($data)) {
        $this -> data = json_decode(stripslashes($data));
      }
    }
	
	// private
    public function setFile() {
	  
	  // kunglaw edit
	  $file = $this->files;
	  
	  /* echo "<pre>";
	  echo "<h4> setFile() </h4>";
	  print_r($file);
	  echo "</pre>";*/
	  
	  $CI =& get_instance();
	  $user_type  = $this->user_type;
	  $username   = $this->username;	
	  $photo_type = $this->photo_type;
	  $nama_gambar= $this->nama_gambar;
	  
      $errorCode = $file["error"];

      if ($errorCode === UPLOAD_ERR_OK) 
	  {
        $type = exif_imagetype($file["tmp_name"]);

        if ($type) {
		  
          $extension = image_type_to_extension($type);
		  
		   // kunglaw edit
		   // PELAUT
		   if($user_type == "pelaut")
		   {
			  // ganti nama table bila di hosting 
			  $a = $CI->db->query("SHOW TABLE STATUS FROM `".$CI->db->database."` LIKE 'photo_pelaut_tr' ");
			  $b = $a->row_array();
			  $b["Auto_increment"];
			  /*end extention */
			  
			  // cek dan buat folder dahulu 
			  make_username_folder_pt($username);
			  
			  //aktifkan kembali nanti 
			  // $nama_file = strtoupper(md5($b["Auto_increment"].$_FILES["img_input"]["name"])).date("YmdHis");
			  
			  if($photo_type == "resume")
			  {
				  $nama_file = "resume"; // nanti dihapus
				  $src 	   = "../infrasset/photo/$username/resume/" .$nama_file.$extension; // Penamaan file 

			  }
			  else if($photo_type == "profile")
			  {
				  $nama_file = "profile"; // nanti dihapus
				  $src = "../infrasset/photo/$username/profile_pic/" .$nama_file.$extension; // Penamaan file 
			  }
			  else if($photo_type == "cover")
			  {
				  $src = "../infrasset/photo/$username/cover/" .$nama_file.$extension; // Penamaan file 
			  }
			  
			  
		   }
		   // PERUSAHAAN
		   else if($user_type == "company")
		   {
			  // ganti nama table bila di hosting 
			  $a = $CI->db->query("SHOW TABLE STATUS FROM `".$CI->db->database."` LIKE 'photo_perusahaan_tr' ");
			  $b = $a->row_array();
			  $b["Auto_increment"];
			  /*end extention */
			  
			  // cek dan buat folder dahulu 
			  make_username_company($username_company);
			  
			  $nama_file = strtoupper(md5($b["Auto_increment"].$_FILES["img_input"]["name"])).date("YmdHis");
			  
			  if($photo_type == "logo")
			  {
				 // nama file sama 
				 // jadi bisa langsung di tiban
			  	 $src = "../infrasset/company/$username/logo/"."$username_company".$extension; // Penamaan file 
			  }
			  else if($photo_type == "manager_profile")
			  {
				 // nama file sama, jadi bisa langsung di tiban
				 $src = "../infrasset/company/$username/profile_pic/" .$username_company.$extension; // Penamaan file 
			  }
			  else if($photo_type == "agent_profile")
			  {
				 $src = "../infrasset/company/$username/profile_pic/" .$username_agent.$extension; // Penamaan file  
			  }
		   }
		   

          if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

            if (file_exists($src)) {
              unlink($src);
            }
			
			// Upload file yang asli 
			/* echo "<pre>";
			echo "<h4> tmp_name </h4>";
			var_dump($file["tmp_name"]); echo "<hr>";
			echo $src;
			echo "</pre>";*/
			
            $result = move_uploaded_file($file["tmp_name"], $src);

            if ($result) {
              $this -> src = $src;
              $this -> type = $type;
              $this -> extension = $extension;
              $this -> setDst(); // setDst dijalankan disini 
            } else {
               $this -> msg = "Failed to save file";
			   $this->err = "error";
            }
          } else {
            $this -> msg = "Please upload image with the following types: JPG, PNG, GIF";
			$this->err = "error";
          }
        } 
		else {
          $this -> msg = "Please upload image file";
		  $this->err = "error";
        }
      } 
	  else 
	  {
        $this -> msg = $this -> codeToMessage($errorCode);
      }
	  
	  // kunglaw
	  // insert data photo disini 
	  // lalu ambil data hasil insert 
	  
	  return  $dt_gambar = array('nama_gambar'=>$nama_file.$extension,
				  'size_gambar' => $file['size'],
				  'type_gambar' => $file['type'],
				  'title' => $file['name'],
				  'tmp_name' => $file['tmp_name'],
				  "id" => "" // id_user
				  ); // data image
    }

    private function setDst() {
	  // file hasil crop 
	  // destinasi, penamaan file dari upload 
	 
	  // kunglaw edit
	  $CI =& get_instance();
	  $user_type  = $this->user_type;
	  $username   = $this->username;	
	  $photo_type = $this->photo_type; 
	  $nama_gambar= $this->nama_gambar;
	  
	  // fleksible extention
	  /* if(!empty($_FILES["img_input"]["name"] ))
	  {
		$type = exif_imagetype($_FILES["img_input"]["tmp_name"]);
	    $extension = image_type_to_extension($type);
	  }
	  else if(!empty($nama_gambar))
	  {
		 $e = explode(".",$nama_gambar);
		 $extension = ".".$e[1];
	  } */
	  
	   $e = explode(".",$nama_gambar);
	   if($e[1] == "jpg")
	   {
		  $e[1] = "jpeg";	 
	   }
	   
	   $extension = ".".$e[1];
	  
	  if(!empty($_FILES["img_input"]["name"]))
	  {
		  $e = explode(".",$_FILES["img_input"]["name"]);
		  if($e[1] == "jpg")
		  {
			$e[1] = "jpeg";	 
		  }
		  $extension = ".".$e[1];
	  }
	 
	 // kunglaw edit
	 // PELAUT
	 if($user_type == "pelaut")
	 {
		// ganti nama table bila di hosting 
		$a = $CI->db->query("SHOW TABLE STATUS FROM `".$CI->db->database."` LIKE 'photo_pelaut_tr' ");
		$b = $a->row_array();
		$b["Auto_increment"];
		/*end extention */
		
		// cek dan buat folder dahulu 
		make_username_folder_pt($username);
		
		//matikan sementara
		//$nama_file = strtoupper(md5($b["Auto_increment"].$_FILES["img_input"]["name"])).date("YmdHis");
		if(empty($_FILES['img_input']["name"]))
		{
			$nama_file = $e[0]; // nama_gambar yang telah di explode
		}
		
		if($photo_type == "resume")
		{
			$nama_file = "resume"; // matikan nanti 
			$dst = "../infrasset/photo/$username/resume/".$nama_file."_thumb".$extension; // Penamaan file 
		}
		else if($photo_type == "profile")
		{
			$nama_file = "profile"; // matikan nanti
			$dst = "../infrasset/photo/$username/profile_pic/" .$nama_file."_thumb".$extension; // Penamaan file 
		}
		else if($photo_type == "cover")
		{
			$dst = "../infrasset/photo/$username/cover/" .$nama_file."_thumb".$extension; // Penamaan file 
		}
		
		
	 }
	 // PERUSAHAAN
	 else if($user_type == "company")
	 {
		// ganti nama table bila di hosting 
		$a = $CI->db->query("SHOW TABLE STATUS FROM `".$CI->db->database."` LIKE 'photo_perusahaan_tr' ");
		$b = $a->row_array();
		$b["Auto_increment"];
		/*end extention */
		
		// cek dan buat folder dahulu 
		make_username_company($username_company);
		
		$nama_file = strtoupper(md5($b["Auto_increment"].$_FILES["img_input"]["name"])).date("YmdHis");
		
		if($photo_type == "logo")
		{
		   // nama file sama 
		   // jadi bisa langsung di tiban
		   $dst = "../infrasset/company/$username/logo/"."$username_company"."_logo".$extension; // Penamaan file 
		}
		else if($photo_type == "manager_profile")
		{
		   // nama file sama, jadi bisa langsung di tiban
		   $dst = "../infrasset/company/$username/profile_pic/" .$username_company."_thumb".$extension; // Penamaan file 
		}
		else if($photo_type == "agent_profile")
		{
		   $dst = "../infrasset/company/$username/profile_pic/" .$username_agent."_thumb".$extension; // Penamaan file  
		}
	 }
      
	  $this -> dst = $dst;
    }

    private function crop($src, $dst, $data) {
      if (!empty($src) && !empty($dst) && !empty($data)) {
        switch ($this -> type) {
          case IMAGETYPE_GIF:
            $src_img = imagecreatefromgif($src);
            break;

          case IMAGETYPE_JPEG:
            $src_img = imagecreatefromjpeg($src);
            break;

          case IMAGETYPE_PNG:
            $src_img = imagecreatefrompng($src);
            break;
        }

        if (!$src_img) {
          $this -> msg = "Failed to read the image file";
		  $this->err = "error";
          return;
        }

        $size = getimagesize($src);
        $size_w = $size[0]; // natural width
        $size_h = $size[1]; // natural height

        $src_img_w = $size_w;
        $src_img_h = $size_h;

        $degrees = $data -> rotate;

        // Rotate the source image
        if (is_numeric($degrees) && $degrees != 0) {
          // PHP"s degrees is opposite to CSS"s degrees
          $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

          imagedestroy($src_img);
          $src_img = $new_img;

          $deg = abs($degrees) % 180;
          $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

          $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
          $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

          // Fix rotated image miss 1px issue when degrees < 0
          $src_img_w -= 1;
          $src_img_h -= 1;
        }
		
		// kunglaw edit
        $tmp_img_w = $data -> width; // TMP = asal data . 
        $tmp_img_h = $data -> height;
        
		$dst_img_w = $this -> crop_width; // DST = Destination. tujuan upload 
        $dst_img_h = $this -> crop_height;

        $src_x = $data -> x;
        $src_y = $data -> y;

        if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
          $src_x = $src_w = $dst_x = $dst_w = 0;
        } else if ($src_x <= 0) {
          $dst_x = -$src_x;
          $src_x = 0;
          $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
        } else if ($src_x <= $src_img_w) {
          $dst_x = 0;
          $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
        }

        if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
          $src_y = $src_h = $dst_y = $dst_h = 0;
        } else if ($src_y <= 0) {
          $dst_y = -$src_y;
          $src_y = 0;
          $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
        } else if ($src_y <= $src_img_h) {
          $dst_y = 0;
          $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
        }

        // Scale to destination position and size
        $ratio = $tmp_img_w / $dst_img_w;
        $dst_x /= $ratio;
        $dst_y /= $ratio;
        $dst_w /= $ratio;
        $dst_h /= $ratio;

        $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

        // Add transparent background to destination image
        imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
        imagesavealpha($dst_img, true);

        $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

        if ($result) {
          if (!imagepng($dst_img, $dst)) {
            $this -> msg = "Failed to save the cropped image file";
			$this->err = "error";
          }
        } else {
          $this -> msg = "Failed to crop the image file";
		  $this->err = "error";
        }

        imagedestroy($src_img);
        imagedestroy($dst_img);
      }
    }

    private function codeToMessage($code) {
      switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
          $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
          break;

        case UPLOAD_ERR_FORM_SIZE:
          $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
          break;

        case UPLOAD_ERR_PARTIAL:
          $message = "The uploaded file was only partially uploaded";
          break;

        case UPLOAD_ERR_NO_FILE:
          $message = "No file was uploaded";
          break;

        case UPLOAD_ERR_NO_TMP_DIR:
          $message = "Missing a temporary folder";
          break;

        case UPLOAD_ERR_CANT_WRITE:
          $message = "Failed to write file to disk";
          break;

        case UPLOAD_ERR_EXTENSION:
          $message = "File upload stopped by extension";
          break;

        default:
          $message = "Unknown upload error";
      }
	  $this->err = "error";

      return $message;
    }

    public function getResult() {
      return !empty($this -> data) ? $this -> dst : $this -> src;
    }

    public function getMsg() {
      return $this -> msg;
    }
	
	public function getErr()
	{
	  return $this->err;	
	}

}