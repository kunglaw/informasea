<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed');

class resume_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->authentification->close_access();
		
		//BAHASA
		$lang_session = $this->session->userdata("lang");
		if(empty($lang_session)) $lang_session = "english"; // nama folder
		$this->lang->load('general', $lang_session);
		$this->lang->load("seatizen",$lang_session);
		// =================================
		
		if($this->session->userdata("id_user") == NULL)
		{
			header("location:custom404");
		}
		 
		$this->load->model('resume_model');
		
		$this->load->helper('nonull');
		$this->load->helper("username_folder_helper");	
	}
	
	function resume_download()
	{
		$this->authentification->close_access();
		
		$this->uri->segment();
		$this->load->helper('download');
		
		force_download($name, $data); 	
		
	}
	
	function download_attachment()
	{
		//$this->authentification->close_access();
		error_reporting(E_ALL);
		$this->load->helper('download');
		$pelaut_id = $this->session->userdata("id_user");
		
		$type_file_document = $this->input->get("t");
		$id_document 		= $this->input->get("id");
		$username		   = $this->input->get("u");
		
		if(empty($username))
		{
			$username  = $this->session->userdata("username");
		}
		
		$this->load->model("document_model");
		$this->load->model("competency_model");
		$this->load->model("proficiency_model");
		
		switch($type_file_document)
		{
			case "document":
				
			  $doc 		   = $this->document_model->get_document_tr($id_document,$pelaut_id);
			  $path 		  = img_path("document/$username/doc/document_record/$doc[attachment]");
			  $file_name 	 = $doc['attachment'];
			  $content 	   = file_get_contents($path);
			  
			  if(!$content)
			  {
				  show_404();
				  exit;
			  }
			  
			break;
			case "visa":
			  
			  $visa 		  = $this->document_model->get_detail_visa($id_document); 
			  $path 		  = img_path("document/$username/doc/visa/$visa[attachment]");
			  $file_name 	 = $visa['attachment'];
			  $content 	   = file_get_contents($path);	
			  
			  if(!$content)
			  {
				  show_404();
				  exit;
			  }
			
			break;
			case "medical_record":
			
			  $mr 		    = $this->document_model->get_detail_medical($id_document); 
			  $path 		  = img_path("document/$username/doc/medical_record/$mr[attachment]");
			  $file_name 	 = $mr['attachment'];
			  $content 	   = file_get_contents($path);
			  
			  if(!$content)
			  {
				  show_404();
				  exit;
			  }
			  
			
			break;
			case "coc":
			  
			  $coc 		   = $this->competency_model->get_competency_tr($pelaut_id,$id_document);
			  $path 		  = img_path("document/$username/coc/$coc[attachment]");
			  $file_name 	 = $coc['attachment'];
			  $content 	   = file_get_contents($path);
			  
			  if(!$content)
			  {
				  show_404();
				  exit;
			  }
			
			
			break;
			case "proficiency":
			  
			  $prof 		   = $this->proficiency_model->get_proficiency_tr($pelaut_id,$id_document);
			  $path 		  = img_path("document/$username/proficiency/$prof[attachment]");
			  $file_name 	 = $prof['attachment'];
			  $content 	   = file_get_contents($path);
			  
			  if(!$content)
			  {
				  show_404();
				  exit;
			  }
			
			break;
			
		}
		
		force_download($file_name,$content);
		
		
	}
	
	function edit_profile_process()
	{
		
		if($this->input->is_ajax_request()){
		return $this->resume_model->profile_edit_process();
		} else{
			header('location:'.base_url('custom404'));
		}
	}



	function tes_edit_kepelautan(){
		
		$this->load->model('coc_model');
		$this->load->library('form_validation');
		$pelaut_id = $this->session->userdata('id_user');
		
		$ecs  			   = $this->input->post("exp_sallary_curr",true);
		$expected_sallary  = $this->input->post("expected_sallary",true);
		$sallary_range	 = $this->input->post("sallary_range",true);
		
		$vessel_type	   = $this->input->post("vessel_type",true);
		$department		= $this->input->post("department",true);
		$coc_class		 = $this->input->post("coc_class",true);
		$rank			  = $this->input->post("rank",true);
		$last_education    = $this->input->post("last_education",true);
		
		$this->form_validation->set_rules("exp_sallary_curr","Currency",'');
		$this->form_validation->set_rules("expected_sallary","Expected Sallary",'numeric');
		
		if($this->form_validation->run() == TRUE){

			$str_check = "SELECT * FROM profile_resume_tr WHERE pelaut_id = '$pelaut_id'";
			$qc = $this->db->query($str_check);
			$fc = $qc->row_array();

			if(!empty($fc)){

				$str = "UPDATE profile_resume_tr SET ";

				$str .= "vessel_type = '$vessel_type',";
				$str .= "department = '$department' ,";
				$str .= "coc_class = '$coc_class' ,";
				$str .= "rank = '$rank' ,";
				$str .= "exp_sallary_curr = '$exp_sallary_curr' ,";
				$str .= "expected_sallary = '$expected_sallary' ,";
				$str .= "last_education = '$last_education' ,";
				$str .= "last_update = now() , ";
				$str .= "sallary_range = '$sallary_range' ";

				$str .= "WHERE pelaut_id = '$pelaut_id'";


				//for competency tr
				$coc = $this->coc_model->get_coc_detail($coc_class);

				$str_delete = "DELETE FROM competency_tr WHERE type = 'coc' AND pelaut_id = '$pelaut_id'";
				//$q_delete_com = $this->db->query($str_delete);


				$str_incom  = "insert into competency_tr set 		 ";
			$str_incom .= "grade_license 	= '$coc[coc_class]'	,";
			$str_incom .= "pelaut_id 		= '$pelaut_id'		,";  
			$str_incom .= "last_update	= now() 			,"; 
			$str_incom .= "type			= 'coc' 			 "; 
			//$qin_com =  $this->db->query($str_incom); 
			
			$coe = "Certificate of Endorsement";
			
			$str_incom2  = "insert into competency_tr set 		 ";
			$str_incom2 .= "grade_license 	= '$coe'			,";
			$str_incom2 .= "pelaut_id 		= '$pelaut_id'		,";  
			$str_incom2 .= "last_update	= now() 			,"; 
			$str_incom2 .= "type			= 'coc' 			 "; 
			//$qin_com =  $this->db->query($str_incom); 

			echo $str."<br>";
			echo $str_delete ."<br>";
			echo $str_incom."<br>";
			echo $str_incom2."<br>";
			}
		}
	}
	
	function edit_kepelautan_process()
	{
		if($this->input->is_ajax_request()){
			
			return $this->resume_model->kepelautan_edit_process();	

		} else{
			header('location:'.base_url('custom404'));
		}
	}
	
	function update_cover_letter_process()
	{
		if($this->input->is_ajax_request()){
			
			return $this->resume_model->update_cover_letter_process();	

		} else{
			header('location:'.base_url('custom404'));
		}
		
	}
	
	function update_describe_process()
	{
		if($this->input->is_ajax_request()){
			
			return $this->resume_model->update_describe_process();	

		} else{
			header('location:'.base_url('custom404'));
		}	
		
	}
	
	/* START COMPETENCY */
	function add_competency_process()
	{	
		if($this->input->is_ajax_request()){

			$this->load->model('competency_model');
			$result = $this->competency_model->add_competency_process();
			echo json_encode($result);
			
		} else {
			
			header('location:'.base_url('custom404'));
		}
		
	}
	
	function delete_competency_process()
	{	
		if($this->input->is_ajax_request()){

			$this->load->model('competency_model');
			return $this->competency_model->delete_competency_process();
			
		} else {
			header('location:'.base_url('custom404'));
		}
		
	}		
	
	function edit_competency_process()
	{
		if($this->input->is_ajax_request()){
			
			$this->load->model('competency_model');
			$result =  $this->competency_model->edit_competency_process();
			echo json_encode($result);
			
		}else {
			
			header('location:'.base_url('custom404'));
		}
	}
	
	/*function get_data_competency()
	{
		$this->load->model("ajax_data_table");
		return $this->ajax_data_table->get_data_competency();
			
	}*/
	
	/* ========= END COMPETENCY ========== */
	
	/* Start proficiency */
	
	function add_proficiency_process()
	{
		$this->load->model('proficiency_model');
		//echo "add_proficiency_process controller";
		$result = $this->proficiency_model->add_proficiency_process();	
		echo json_encode($result);
	}
	
	function edit_proficiency_process()
	{
		$this->load->model('proficiency_model');
		$result = $this->proficiency_model->edit_proficiency_process();
		echo json_encode($result);
	}
	
	function delete_proficiency_process()
	{
		$this->load->model('proficiency_model');
		return $this->proficiency_model->delete_proficiency_process();	
	}
	
	/*function get_data_proficiency()
	{
		$this->load->model("ajax_data_table");
		return $this->ajax_data_table->get_data_proficiency();	
		
	}*/
	
	/*  ========= END proficiency ========== */
	
	/* Experience */
	function add_experience_process()
	{
		//print_r($this->input->post()); exit;
		
		$this->load->model('experience_model');
		return $this->experience_model->add_experience_process();
		
	}
	
	function update_experience_process()
	{
		//print_r($this->input->post()); exit;
		
		$this->load->model('experience_model');
		return $this->experience_model->update_experience_process();
		
	}
	
	function delete_experience_process()
	{
		$this->load->model('experience_model');
		return $this->experience_model->delete_experience_process();	
		
	}
	
	function cancel_apply_vacantsea(){
		
		$this->load->model('vacantsea/vacantsea_model');
		echo "<script>alert('berada disini')</script>";
		$pelaut_id     = $this->session->userdata('id_user');
		$aplicant_id = $this->input->post('id_update',true); // dari modal ( id_license ) 
		echo "<script>alert('$aplicant_id')</script>";
		$str = "delete from applicant_tr where id_aplicant = '$aplicant_id' ";
		$q = $this->db->query($str);
		
		if(!$q)
		{
			$this->db->_error_message();
			
		}
		else
		{
			echo "<div class='alert alert-success'>this data Experience has Successfully Deleted </div> ";
		}
	}

	/* ============ Document =========== */
	
		/* === Visa ===*/
	function delete_visa_process(){
		
		if($this->input->is_ajax_request()){
			
			$visa_id = $this->input->post('id_update');

			$str = "DELETE FROM document_tr WHERE document_id = '$visa_id'";
			$q = $this->db->query($str);;
			if($q){
				echo "<div class='alert alert-success'> Visa has been delete </div>";
				
			}else{
				echo "";
			}
			
		} else {
			header('location:'.base_url('custom404'));
		}
		
	}

	function update_visa_process(){

		if($this->input->is_ajax_request()){

			$visa_id 		= $this->input->post('visa_id');
			$type 		   = $this->input->post('type');
			$number 		 = $this->input->post('number');
			$issued_place   = $this->input->post('place');
			$issued_date 	= $this->input->post('date_issued');
			$expired_date   = $this->input->post('date_expired');
			$type_document  = "visa";
			$pelaut_id 	  = $this->session->userdata('id_user');
			$ip_address	 = $_SERVER['REMOTE_ADDR'];
			
			$this->form_validation->set_rules('type','Type','required');			
			$this->form_validation->set_rules('date_expired','Expiry Date','required');

			if($this->form_validation->run() == TRUE){
			  
			  $attachment_query = "";
			  if(!empty($_FILES['attachment']["name"]))
			  {
				$this->load->helper("upload_file_document");
				$username   = $this->session->userdata("username");
				$attachment = $_FILES['attachment'];
  				
				// buat foldernya dahulu
				// dari username_folder_helper
				make_username_folder_doc($username,"doc");
				
				$nama_file  = (str_replace(' ', '_', strtolower($type))).".";
				$nama_file .= end(explode('.', $attachment['name']));
				
				$attachment['name'] = $nama_file;
				$upload_file = upload_document_pelaut($attachment, $username, "visa"); // "visa" itu subfolder
				
				
				if($upload_file["pesan"] == "sukses")
				{
					$data_upload 		= $upload_file['data'];
					$attachment_query   = "attachment				= '$data_upload[file_name]'				,";
		  
				}
				else
				{
					$result['message']  = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
					$result['status']			      = "error";
					echo json_encode($result);
					exit;	
				}
				
			  }
			  
			  $str = "UPDATE document_tr SET 
					  type 					= '$type'			,
					  number 				= '$number'			,
					  place 				= '$issued_place'	,
					  date_issued 			= '$issued_date'	,
					  date_expired  		= '$expired_date'	,
					  pelaut_id 	 		= '$pelaut_id'		,
					  $attachment_query
					  ip_address 			= '$ip_address'		,
					  datetime 				= now()				,
					  type_document 		= '$type_document'
					  WHERE document_id 	= '$visa_id'			";
					  
			  $q = $this->db->query($str);
		  		echo $this->db->last_query();
			  if($q){
				  
				  $result["message"]  = "<div class='alert alert-success'> Visa has been updated </div>";
				  $result["message"] .= "<script> setTimeout(function() { location.reload(); }, 3000); </script>";
				  $result["status"]   = "success";
				  
			  }else{
	  
			  }
			 
			}
			else
			{
				// validasi error
				$result["message"] = "<div class='alert alert-danger'>".validation_errors()." </div>";
				$result["status"]  = "error";	
			}
			 echo json_encode($result);
	
		} else {
			header('location:'.base_url('custom404'));
		}
	}

	function add_document_visa(){
		
		if($this->input->is_ajax_request()){

			$this->load->library('form_validation');
			$type 		  = $this->input->post('visa_type');
			
			if($type == "other"){
				$type = $this->input->post('type');
			}
			
			$number 		= $this->input->post('number');
			$issued_place  = $this->input->post('place_issue');
			$issued_date   = $this->input->post('date_issued');
			$expired_date  = $this->input->post('expired_date');
			$type_document = "visa";
			$pelaut_id 	 = $this->session->userdata('id_user');
			$ip_address 	= $_SERVER['REMOTE_ADDR'];


			if($type == "other"){ 

				$this->form_validation->set_rules('type','Type','required');

			}else{
				$this->form_validation->set_rules('visa_type','Visa','required');
			}
			
			$this->form_validation->set_rules('expired_date','Expiry Date','required');


			if($this->form_validation->run() == TRUE){ 
				
				if(!empty($_FILES['attachment']["name"]))
				{
				  $this->load->helper("upload_file_document");
				  $username   = $this->session->userdata("username");
				  $attachment = $_FILES['attachment'];
  				  
				  // buat foldernya dahulu
				  // dari username_folder_helper
				  make_username_folder_doc($username,"doc");
				  
				  $nama_file  = (str_replace(' ', '_', strtolower($type))).".";
				  $nama_file .= end(explode('.', $attachment['name']));
				  
				  $attachment['name'] = $nama_file;
				  $upload_file = upload_document_pelaut($attachment, $username, "visa"); // "visa" subfolder
  
				  if($upload_file["pesan"] == "sukses")
				  {
					  $data_upload = $upload_file['data'];
				  }
				  else
				  {
					  $result["message"] = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
					  $result["status"]  = "error";
					  echo json_encode($result);
					  exit;	
				  }
				}

				$str = "INSERT INTO document_tr (type,number,place,date_issued,date_expired,pelaut_id,ip_address,datetime,type_document, attachment)
				VALUES ('$type','$number','$issued_place','$issued_date','$expired_date','$pelaut_id','$ip_address',now(),'$type_document', '".$data_upload['file_name']."')";
				
				$q = $this->db->query($str);
				
				if($q){
					
					$result["message"]  = "<div class='alert alert-success'> Visa has been inserted </div>";
					$result["message"] .= "<script> setTimeout(function() { location.reload(); }, 3000); </script>";
					$result["status"]   = "success";
					
				} else{
					
					echo $this->db->_error_message();
					
				}

			} else {
				
				$result["message"] = "<div class='alert alert-danger'>" . validation_errors() . " </div>";
				$result["status"]  = "error";
			}
			
			echo json_encode($result);

		} else {
			header('location:'.base_url('custom404'));
		}

	}
		/* === end Visa ===*/
	
	function add_document_medical(){
		
		$this->load->model('document_model');
		$this->load->library('form_validation');
		
		$type 	= $this->input->post('document_type');

		if($type == "other"){
			
			$type = $this->input->post('type');
			
		}else{
			
			$this->form_validation->set_rules('document_type','Medical','required');
		}

		$place 		= $this->input->post('place');
		$source 	   = $this->input->post('source');
		$number 	   = $this->input->post('number');
		$date_issued  = $this->input->post('date_issued');
		$date_expired = $this->input->post('date_expired');
		$id_pelaut    = $this->input->post('pelaut_id',true);
		$country 	  = '';

		$this->form_validation->set_rules("place","Place","");
        $this->form_validation->set_rules("number","Number","");
//        $this->form_validation->set_rules("date_issued","Date Issued","required");
        $this->form_validation->set_rules("date_expired","Expired Date","required");
		
        $hasil = $this->form_validation->run() ? "berhasil":"gagal";

        if($hasil == "berhasil"){
			
			if(!empty($_FILES["attachment"]["name"]))
			{
        		$this->load->helper("upload_file_document");
        		$username = $this->session->userdata("username");
        		$attachment = $_FILES['attachment'];
				
				// buat foldernya dahulu
				// dari username_folder_helper
				make_username_folder_doc($username,"doc");
				
        		$nama_file = (str_replace(' ', '_', strtolower($type))).".";
        		$nama_file .= end(explode('.', $attachment['name']));
        		$attachment['name'] = $nama_file;
        		$upload_file = upload_document_pelaut($attachment, $username, "medical_record");

        		if($upload_file["pesan"] == "sukses")
				{
					$data_upload = $upload_file['data'];
				}
				else
				{
					$result["message"] = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
					$result["status"]  = "error";
					exit;	
				}
			}

			$q = $this->document_model->add_document_process($id_pelaut, 
			$type, 
			$number, 
			$place, 
			$date_issued, 
			$date_expired, 
			$source,
			$country, 
			$data_upload['file_name']) or die("gagal di query tambah document tr nih");
	//          
				if (!$q) {
					$this->db->_error_message();
				} else {
					$result["message"]  =  "<div class='alert alert-success'> Data document Successfully Added </div>";
					$result["message"] .=  "<script> setTimeout(function() { location.reload(); }, 3000); </script>";
					$result["status"]   =  "success";
				}
	
			} 
			else {
				$result["message"] = "<div class='alert alert-danger'>" . validation_errors() . " </div>";
				$result["status"] = "error";
			}
			
			echo json_encode($result);
	} 
	
	function update_medical_process(){
    	
    	$this->load->model('document_model');
		
    	$result = $this->document_model->update_medical_process();
		
		echo json_encode($result);
    }

		/* document record */
    //function radit with modified
    function add_document_process()
    {
        /*print_r($this->input->post()); 
		print_r($_FILES);
		exit;*/
    	
        $this->load->model('document_model');
        $this->load->library('form_validation');
      	
		$type_document 		= "Seaman Book";
        $country			  = $this->input->post('national');
        $type 				 = $type_document;
        $place 				= $this->input->post("place");
        $source 			   = $this->input->post("source");
        $number 			   = $this->input->post("number");
        $date_issued		  = $this->input->post("date_issued");
        $date_expired		 = $this->input->post("date_expired");
        $id_pelaut			= $this->input->post("pelaut_id",true);

        // $this->form_validation->set_rules("doc_type","Type Document",'required');
        // if($type == "") $this->form_validation->set_rules("type","Type Document",'');
        $this->form_validation->set_rules('national','Nationality','required');
        $this->form_validation->set_rules("place","Place","");
        $this->form_validation->set_rules("number","Number","");
//        $this->form_validation->set_rules("date_issued","Date Issued","required");
        $this->form_validation->set_rules("date_expired","Expired Date","required");

        $hasil = $this->form_validation->run() ? "berhasil":"gagal";

//        echo $type." -> ".$place." -> ".$number." -> ".$date_issued." -> ".$date_expired."<br>".$hasil;
        if($hasil == "berhasil") {
			
			if(!empty($_FILES['attachment']["name"]))
			{
			  $this->load->helper("upload_file_document");
			  $username = $this->session->userdata("username");
			  $attachment = $_FILES['attachment'];
  
			  $nama_file  = (str_replace(' ', '_', strtolower($country)))."_seaman_book.";
			  $nama_file .= end(explode('.', $attachment['name']));
			  
			  // buat foldernya dahulu
			  // dari username_folder_helper
			  make_username_folder_doc($username,"doc");
			  
			  $attachment['name'] = $nama_file;
			  $upload_file = upload_document_pelaut($attachment, $username, "document_record");
			  
			  if($upload_file["pesan"] == "sukses")
			  {
				  $data_upload = $upload_file['data'];
			  }
			  else
			  {
				  $result["message"] = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
				  $result["status"]  = "error";
				  exit;	
			  }
			  
			}

        	
            // $tb_name = $show_source(e."_ms";
            // $table = strpos('cert', $tb_name) ? str_replace('_cert','', $tb_name) : $tb_name;
            // $jml = $this->document_model->check_table_ms($table,$type);// or die("<br>gagal di query search = $jml");
            // if ($jml == 0) //artinya belum ada medical di medical_ms
            // {
            //     $this->document_model->add_table_ms($table,$type);// or die("Gagal di query tambah document ms");
            // }
            $q = $this->document_model->add_document_process($id_pelaut, 
			$type, 
			$number, 
			$place, 
			$date_issued, 
			$date_expired, 
			$source, 
			$country, 
			$data_upload['file_name']) or die("gagal di query tambah document tr nih");
			
//            echo "<br>berhasil lewat";
            if (!$q) {
                $this->db->_error_message();
            } else {
                $result["message"]  = "<div class='alert alert-success'> Data document Successfully Added </div>";
                $result["message"] .= "<script> setTimeout(function() { location.reload(); }, 3000); </script>";
				$result["status"]   = "success";
            }

        }
        else {
        	
            $result["message"] = "<div class='alert alert-danger'>" . validation_errors() . " </div>";
			$result["status"]  = "error";
            
        }
		
		echo json_encode($result);
    }

    function tes_update_document(){
			
			/*print_r($_POST); 
			print_r($_FILES); exit;*/
			
    		$this->load->model('document_model');
    		$this->load->library('form_validation');
			
			$pelaut_id 		   = $this->session->userdata("id_user");
			//Array ( [certificate] => [no_certificate] => [date_issue] => [place_issue] => )
			$document_id		 = $this->input->post("id_update",true);
			$typee 			   = "Seaman Book";
			$country			 = $this->input->post('national');
			$tipe 				= $this->input->post('tipenya');
			
			if($tipe == 'Passport'){
				
				$type  ='Passport';
				
			} else{
			
				$type = 'Seaman Book';
			}

			$number 			  = $this->input->post("number",true);
			$place 			   = $this->input->post("place",true);
			$date_issued		 = $this->input->post("date_issued");
			$date_expired		= $this->input->post("date_expired",true);
			
			$this->form_validation->set_rules("type","Type Document",'');
			$this->form_validation->set_rules("place","Place","");
			$this->form_validation->set_rules("number","Number","");
			$this->form_validation->set_rules("date_issued","Date Issue","");
			$this->form_validation->set_rules("date_expired","Expired Date","required");
			
			if($this->form_validation->run() == TRUE)
			{
				$attachment_query = "";
				if(!empty($_FILES['attachment']["name"]))
				{
				  $this->load->helper("upload_file_document");
				  $username = $this->session->userdata("username");
				  $attachment = $_FILES['attachment'];
	  			  
				  // ingat, ini rule hanya untuk UPDATE/EDIT document record 
				  if($type == "Seaman Book")
				  {
				  	$nama_file  = (str_replace(' ', '_', strtolower($country)))."_seaman_book.";
				  	$nama_file .= end(explode('.', $attachment['name']));
				  }
				  else if($type == "Passport")
				  {
					$nama_file  = (str_replace(' ', '_', strtolower($country)))."_passport.";
				  	$nama_file .= end(explode('.', $attachment['name']));  
				  }
				  
				  // buat foldernya dahulu
				  // dari username_folder_helper
				  make_username_folder_doc($username,$type);
				  
				  $attachment['name'] = $nama_file;
				  $upload_file = upload_document_pelaut($attachment, $username, "document_record");
				  
				  // pesan error kalau gambar tidak sesuai ketentuan
				  // data sql pun tidak masuk
				  if($upload_file["pesan"] == "sukses")
				  {
					  $data_upload = $upload_file['data'];
					  $attachment_query = "attachment				= '$data_upload[file_name]'				,";
					  
				  }
				  else
				  {
					  $result['message'] = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
					  $result['status']			     = "error";
					  echo json_encode($result);
					  exit;	
				  }
				  
				}
				
				$str  = "update document_tr set 			 	 		 				 ";
				$str .= "type 					= '$type'			 					,";
				$str .= "place				    = '$place' 								,";
				$str .= "number				    = '$number'								,";
				
				$str .= $attachment_query;
				
				$str .= "date_issued			= '$date_issued'						,";
				$str .= "date_expired			= '$date_expired'						,";
				$str .= "ip_address				= '".$_SERVER['REMOTE_ADDR']."'		   ,";
				$str .= "datetime				= now()					 				 ";
				$str .= "where		 							 						 ";
				$str .= "pelaut_id				= '$pelaut_id'	 and 	 				 ";
				$str .= "document_id			= '$document_id'	 	 				 ";
				
				//echo $str;
				
				$q = $this->db->query($str);
				
				if(!$q)
				{
					$this->db->_error_message();	
				}
				else
				{
					$result["message"]  =  "<div class='alert alert-success'> Data document Successfully Edited </div>"; 
					$result["message"] .= "<script> setTimeout(function() { location.reload(); }, 3000); </script>";
          			$result["status"]   = "success";
				}
			}
			else
			{
				$result["message"] = "<div class='alert alert-danger'>".validation_errors()." </div>";
				$result["status"]  = "error";
			}
			
			echo json_encode($result);

    }
	
	function delete_document_process()
	{
		$this->load->model('document_model');
		return $this->document_model->delete_document_process();	
		
	}
    	/* end document record */
		
	/* ============ END Document =========== */	
		
	
	/* file resume upload */
	function add_file_resume()
	{
		$this->load->library('upload');
		$this->load->helper('username_folder_helper');
		
		$username = $this->session->userdata("username");
		
		//$type = explode("/",$_FILES['file_resume']['type']);
		$new_file_name = strtolower(str_replace(" ","-",$_FILES['file_resume']['name']));
		
		$mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            /* 'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',*/

            /* // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe*/
            'pdf' => 'application/pdf',
            /*'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',  */

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            //'xls' => 'application/vnd.ms-excel',
            //'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            //'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
		
		//cari nama file untuk nama folder 
		$type = array_search($_FILES['file_resume']['type'],$mime_types);
		
		$configupload['upload_path'] = pathup("document/$username/$type"); // uplaod path itu gak usah pake nama filenya segala 
		$configupload['file_name'] = $new_file_name;
		$configupload['allowed_types'] = "pdf|doc|docx|html";
		$configupload['max_size']	=  1024 * 1024 * 1024 * 100; // 10MB;
		//echo $_FILES['picture']['size']; exit;
		//$configupload['max_width']  = '1024';
		//$configupload['max_height']  = '1024';
		
		
		
		//print $configupload['upload_path'];
		$this->upload->initialize($configupload);
		//print_r($configupload); exit;
		$file_resume = 'file_resume'; // name dari form file
		
		// buat foldernya dahulu
		// dari username_folder_helper
		make_username_folder_doc($username,$type);
		
		/*check folder selesai */
		
		$this->upload->do_upload($file_resume);
		$dt_resume = $this->upload->data();
		
		
		//var_dump(is_dir("../infrasset/document/alhusna_99/"));
		//echo "<hr>";
		//print_r($_FILES['file_resume']);
		//echo "<hr>";
		//print_r($configupload);
		//echo "<hr>";
		//print_r($dataphoto);
		echo $error_upload = $this->upload->display_errors('<p class="alert alert-danger"> Upload : ', '</p>');
		
		if(empty($error_upload))
		{
			$id_pelaut = $this->session->userdata("id_user");
			$this->resume_model->add_file_resume($id_pelaut,$dt_resume);
			//header("location:".base_url("seaman/resume/resume_upload"));
			echo "<script>location.reload()</script>";
		}
	}

	function delete_file_resume()
	{
		
	}
		
	/* end resume upload */
	
	function __destruct()
	{
		
		
	}
	
	
	
}