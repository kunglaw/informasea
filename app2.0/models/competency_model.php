<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class competency_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper("username_folder_helper");	
	}
	
	function get_competency_pelaut($username = "")
	{
		
		
		if($username == "")
		{
			$pelaut_id = $this->session->userdata('id_user');
		}
		else
		{
			$this->load->model("users/user_model");
			$pelaut = $this->user_model->get_detail_pelaut22($username);
			$pelaut_id = $pelaut['pelaut_id'];	
		}
	
		
		$str_competency_tr = "SELECT * from competency_tr where pelaut_id = '$pelaut_id' order by `type` ASC"; // COMPETENCY
		$q_competency_tr = $this->db->query($str_competency_tr);
		$f_competency_tr = $q_competency_tr->result_array();
		
		return $f_competency_tr;
			
	}
	
	function competency_byname($name = "")
	{
		$str = "select * from competency_tr where grade_license = '$name' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		return $f;
	}
	
	function last_competency($id_pelaut = '')
	{
		$id_pelaut = $this->session->userdata('id_user');
		
		$str = "select * from competency_tr where pelaut_id = '$id_pelaut' order by last_update DESC LIMIT 1";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;	
	}
	
	function get_competency_tr($pelaut_id='',$id_license='')
	{
		if(empty($pelaut_id)) $pelaut_id = $this->session->userdata('id_user');
		if(empty($id_license)) $id_license = $this->input->post("id_update"); // id_update dari javasecript
		
		$str_competency_tr = "SELECT * from competency_tr where pelaut_id = '$pelaut_id' and id_licenses = '$id_license'"; // COMPETENCY
		$q_competency_tr = $this->db->query($str_competency_tr);
		$f_competency_tr = $q_competency_tr->row_array();
		
		return $f_competency_tr;
		
	}
	
	function delete_competency_process()
	{
		$pelaut_id  = $this->session->userdata('id_user');
		$id_license = $this->input->post('id_update',true); // dari modal ( id_license ) 
		
		$str = "delete from competency_tr where id_licenses = '$id_license' ";
		$q = $this->db->query($str);
		
		// $cc = "SELECT * FROM competency_crew WHERE id_competency_tr = '$id_license' AND crew_id = '$pelaut_id'";
		// $qq = $this->db->query($cc);
		// $qk = $qq->row_array();


		// 	if(!empty($qk)){
		// 		$strbaru = "DELETE FROM competency_crew WHERE id_competency_tr = '$id_license' AND crew_id = '$pelaut_id'";
		// 		$strrun = $this->db->query($strbaru);
		// 	}



		if(!$q)
		{
			$this->db->_error_message();
			
		}
		else
		{
			echo "<div class='alert alert-success'>this data Competency has Successfully Deleted </div> ";
			echo "<script> setTimeout(function() { location.reload(); }, 2000); </script>";
		}
	}
	
	function edit_competency_process()
	{
		
		// form_validation 
		$this->load->library('form_validation');	
		
		$pelaut_id  = $this->session->userdata('id_user');
		$id_license = $this->input->post('id_license',true);
		
		$grade_license = $this->input->post('grade_license',true);
		$no_license 	= $this->input->post('no_license',true);
		$place_issue   = $this->input->post('place_issue',true);
		$date_issue	= $this->input->post('date_issue',true);
		$expired_date  = $this->input->post('expired_date',true);
		$negara		= $this->input->post('negara',true);
		$type		  = $this->input->post('type',true);
		
		$this->form_validation->set_rules('grade_license','Grade License','');
		$this->form_validation->set_rules('no_license','No License','');
		$this->form_validation->set_rules('place_issue','Place Issue','');
		
		if($type == 'coc'){

			$this->form_validation->set_rules('negara','Country','');
			if(empty($negara))
			{
				$this->form_validation->set_rules('grade_license','Grade License','required');
			}
			
		}else{
		
			$this->form_validation->set_rules('negara','Country','required');	
		}
		
		if($this->form_validation->run() == TRUE && $expired_date >= $date_issue)
		{
			$attachment_query = "";
			if(!empty($_FILES["attachment"]["name"]))
			{
        		$this->load->helper("upload_file_document");
        		$username = $this->session->userdata("username");
        		$attachment = $_FILES['attachment'];
				
				
				if(!empty($attachment))
				{
					$set_nama_file = "$negara"." "."$grade_license";
					
					 // buat foldernya dahulu
					 // dari username_folder_helper
					 make_username_folder_doc($username,"coc");
					
					$nama_file = (str_replace(' ', '_', strtolower($set_nama_file))).".";
					$nama_file .= end(explode('.', $attachment['name']));
					$attachment['name'] = $nama_file;
					$upload_file = upload_coc_pelaut($attachment, $username);
				}

        		if($upload_file["pesan"] == "sukses")
				{
					$data_upload = $upload_file['data'];
					$attachment_query = " attachment = '$data_upload[file_name]', ";
				}
				else
				{
					
					$result["message"] = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
					$result["status"]  = "error";
					
					return $result;
					
					exit;	
				}
			}
			
			$str  = " update competency_tr set 	 		 	 ";
			$str .= " grade_license 	= '$grade_license' 	,";
			$str .= " no_license 		= '$no_license'		,";
			$str .= " place_issued		= '$place_issue'	,";
			$str .= " date_issued		= '$date_issue'		,";
			$str .= " expired_date		= '$expired_date'	,";
			$str .= " negara			= '$negara'			,";
			$str .= " $attachment_query						 ";
			$str .= " type				= '$type'			,";
			$str .= " last_update		= now()				 ";
			$str .= " where		 						     ";
			$str .= " pelaut_id 		= '$pelaut_id'	and	 ";
			$str .= " id_licenses 		= '$id_license'		 ";
			
			
			
			$q = $this->db->query($str);
			
			if(!$q)
			{
				$this->db->_error_message();
				
			}
			else
			{
				$arr = json_encode($upload_file);
				$files = json_encode($_FILES);
				$result["message"]  = "<div class='alert alert-success'>This data Competency has Successfully Edited </div> ";
				$result["message"] .= "<script> setTimeout(function() { location.reload(); }, 2000); </script>";
				$result["status"]   = "success"; 
			}
			   
		}
		else
		{
			if($expired_date <= $date_issue)
			{
				$err_add = "<div> Expired date must be higher than date_issue </div> ";
			}
			
			$result["message"] = "<div class='alert alert-danger'>".$err_add.validation_errors()."</div>";
			$result["status"]  = "error";
		}
		
		return $result;
	}

	function callback_select_validate(){
		
	}
	
	function add_competency_process()
	{
		
		
		// form_validation 
		$this->load->library('form_validation');
		$pelaut_id = $this->session->userdata('id_user');
	
		$grade_license = $this->input->post('grade_license',true);
		$no_license 	= $this->input->post('no_license',true);
		$place_issue   = $this->input->post('place_issue',true);
		$date_issue	= $this->input->post('date_issue',true);
		$expired_date  = $this->input->post('expired_date',true);
		$negara		= $this->input->post('negara');
		$type		  = $this->input->post('type',true);
		
		$this->form_validation->set_rules('negara','negara','callback_select_validate');
		if(empty($negara))
		{
			$this->form_validation->set_rules('grade_license','Grade License','required');

		}
		else if(empty($grade_license))
		{
			$this->form_validation->set_rules('negara','negara','required|callback_select_validate');
			$grade_license = "Certificate of Endorsement";
		}
		
		$this->form_validation->set_rules('no_license','No License','');
		$this->form_validation->set_rules('place_issue','Place Issue','');
		
		$this->form_validation->set_rules('expired_date','Expired date','required');

		if($this->form_validation->run() == TRUE)
		{
			
			if(!empty($_FILES["attachment"]["name"]))
			{
        		$this->load->helper("upload_file_document");
        		$username = $this->session->userdata("username");
        		$attachment = $_FILES['attachment'];
				
				if(!empty($attachment))
				{
				
					$set_nama_file = "$negara"." "."$grade_license";
					
					 // buat foldernya dahulu
					// dari username_folder_helper
					make_username_folder_doc($username,"coc");
					
					$nama_file = (str_replace(' ', '_', strtolower($set_nama_file))).".";
					$nama_file .= end(explode('.', $attachment['name']));
					$attachment['name'] = $nama_file;
					$upload_file = upload_coc_pelaut($attachment, $username);
				}

        		if($upload_file["pesan"] == "sukses")
				{
					$data_upload = $upload_file['data'];
				}
				else
				{
					$result["message"] = $data_upload = "<div class='alert alert-danger'>".$upload_file["data"]."</div>";
					$result["status"]  = "error";
					
					return $result;	
					exit;	
				}
			}
			
			$str  = " insert into competency_tr set 	 		";
			$str .= " grade_license = '$grade_license' 			,";
			$str .= " no_license 	= '$no_license'				,";
			$str .= " place_issued	= '$place_issue'			,";
			$str .= " date_issued	= '$date_issue'				,";
			$str .= " expired_date	= '$expired_date'			,";
			$str .= " attachment	= '$data_upload[file_name]'	,";
			$str .= " negara		= '$negara'					,";
			$str .= " type			= '$type'					,";
			$str .= " last_update	= now()						,";
			$str .= " pelaut_id 	= '$pelaut_id'		 		 ";
			
			$q = $this->db->query($str);
			
			if(!$q)
			{
				$this->db->_error_message();
				
			}
			else
			{
				$result["message"]  = "<div class='alert alert-success'>Data Competency has Successfully Added </div> ";
				$result["message"] .= "<script> setTimeout(function() { location.reload(); }, 2000); </script>";
				$result["status"]   = "success";
			}
			
			   
		}
		else
		{
			$result["message"]   = "<div class='alert alert-danger'>".validation_errors()."</div>";			
			$result["status"]	= "error";
		}
		
		return $result;
	}
	
}