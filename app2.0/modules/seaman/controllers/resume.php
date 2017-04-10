<?php if(!defined('BASEPATH')) exit('no direct script access allowed ');

class Resume extends MX_Controller{
	
	function __construct()
	{

		parent::__construct();
		
		//BAHASA
		$lang_session = $this->session->userdata("lang");
		if(empty($lang_session)) $lang_session = "english"; // nama folder
		$this->lang->load('general', $lang_session);
		$this->lang->load("seatizen",$lang_session);
		// =================================
		
		// yang boleh mengakses ini hanya user type :
		// - Company 
		// - Agent
		// - Pelaut yang punya resume itu sendiri
		//$this->authentification->close_access();
		
		$this->load->model('nation_model');
		$this->load->model('resume_model');
		$this->load->model('photo/photo_mdl');
		
		$this->load->helper('nonull');
		$this->load->helper('notification');
		
		
		
	}

	function print_pdf()
 	{
 		// if(!isset($_GET)) show_404();

 		// $id_seatizen = $this->input->get("ids");
 		$data['resume'] = $this->resume_model->get_resume();
 		$nama_lengkap_pelaut = $data['resume']['pelaut']['nama_depan']." ".$data['resume']['pelaut']['nama_belakang'];
 		$data['nama_pelaut'] = $nama_lengkap_pelaut;
 		$this->load->library("m_pdf");
 		$html = $this->load->view("resume/template-print", $data, true);
 		$this->m_pdf->generate_pdf($html, "Resume $nama_lengkap_pelaut.pdf");
 	}
	
	function print_process()
	{
		error_reporting(E_ALL);
		
		$this->load->helper("tracker");
		$username = $this->session->userdata("username");
		$cv_type = $this->input->post("cv_type",TRUE);
		
		$str = "SELECT * FROM cv_template WHERE id_cv_template = '$cv_type' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		if($f["template"] == "default")
		{
			$arr = array("type"=>"default");
			track_print_resume($arr);
			$this->print_pdf();
		}
		else
		{
			$arr = array("type"=>"fancy1");
			track_print_resume($arr);
			
			$full_link  = $f["link"]."/$username";
			redirect($full_link);
		}
		
	}
	
	function index()
	{	
		$data = fill_ads_data();
		// http://localhost/informasea/seaman/resume
		// print_r($this->session->all_userdata());
		// echo $this->session->userdata("id_user");
		// if($this->session->userdata("id_user")) echo "kkosong";
		if($this->session->userdata('id_user') == ''){
			header('location:'.base_url());
		}

		// untuk label 
		$data['date_issued_lbl']  = "Issued date";
		$data['date_expired_lbl'] = "Expiry date";
		$data['sign_on_lbl']	  = "Sign On";
		$data['sign_off_lbl']	 = "Sign Off";
		
		//jalankan beberapa model 
		$this->load->model('vessel_model'); // vessel model
		$this->load->model("ship_model");
		$this->load->model("rank_model");
		$this->load->model('department_model');
		$this->load->model("coc_model");
			
		//echo $this->session->userdata('id_pelaut'); 
		//print_r($this->session->all_userdata());
		
		$data['title'] 	= "Resume";
		$data['meta'] 	 = "resume/meta";
		$data['css'] 	  = "resume/css";
		$data['js_top']   = "resume/js_top";
		$data['template'] = 'resume/template';
		$data['js_under'] = "resume/js_under";
 		
		expired_certificate($this->session->userdata('username'));

		$data['resume'] = $this->resume_model->get_resume();	
		$id_pelaut = $this->session->userdata("id_user");

		$data['file_resume'] = $this->resume_model->list_upload_resume($id_pelaut);
		$this->load->view('index',$data);
	}	


	function resume_upload()
	{
		if($this->session->userdata('id_user') == ''){
			header('location:'.base_url());
		}
		$this->load->model('vessel_model'); // vessel model
		$this->load->model("rank_model");
		$this->load->model('department_model');
		$this->load->model("coc_model");
		
		$id_pelaut = $this->session->userdata("id_user");

		$data['template'] = 'resume-upload/template';
		$data['title'] = "Resume Upload";
		$data['meta'] = "resume-upload/meta";
		$data['css']   = "resume-upload/resume-upload-css";
		$data['js_top'] = "resume-upload/js_top";
		$data['js_under'] = "resume-upload/js_under";

		$data['header'] = "header";

		$data['file_resume'] = $this->resume_model->list_upload_resume($id_pelaut); 


		$this->load->view('index',$data);
	}

	function delete_resume_upload(){
		
		$id = $this->input->post('id_update');
		$username = $this->session->userdata('username');
		$str1 = "SELECT * FROM resume_file WHERE id_resume_file = '$id'";
		$q1 = $this->db->query($str1);
		$f = $q1->row_array();
		$type = $f['file_type'];
		$type = explode("/",$type);
		$type = $type[1];
		$nama_filenya = $f['file_name'];
		$pathfile = pathup("document/$username/$nama_filenya");
		unlink($pathfile);

		$str = "DELETE FROM resume_file WHERE id_resume_file = '$id'";
		$q = $this->db->query($str);
		echo "<script>alert('$str');</script>";

		
		if(!$q)
		{
			$this->db->_error_message();
			
		}
		else
		{
			echo "<div class='alert alert-success'>This Resume has Successfully Deleted </div> ";
			echo "<script> setTimeout(function() { location.reload(); }, 2000); </script>";
		}
	}


	function download_resume($id_resume_file = ''){
		
		$this->load->helper('download');
		$this->load->helper('username_folder_helper');
		//$id_resume_file = $this->input->post('id_resume_file');
		$username =  $this->session->userdata('username');

		$b = $this->resume_model->detail_upload_resume($id_resume_file);
		$type = $b['file_type'];
		$typenya = explode("/",$type);
		$n = $typenya[1];
		$nama_filenya = $b['file_name'];
			$data = file_get_contents(pathup("document/$username/$n/$nama_filenya")); // Read the file's contents
		
			//$data = file_get_contents(pathup("document/$username/$n/$nama_filenya")); // Read the file's contents

			if($data == NULL){
				$data = file_get_contents(pathup("document/$username/$nama_filenya"));
			}else{
				$data = $data;
			}

		$name = $nama_filenya;
		

		force_download($name, $data); 
	}

	function download_resume2($id_resume_file = ''){
		
		$this->load->helper('download');
		$this->load->helper('username_folder_helper');
		//$id_resume_file = $this->input->post('id_resume_file');
		//$username =  $this->session->userdata('username');
		//$username = $this->uri->segment(2);

		$username = $_GET['username'];
		$b = $this->resume_model->detail_upload_resume($id_resume_file);
		$type = $b['file_type'];
		$typenya = explode("/",$type);
		$n = $typenya[1];
		$nama_filenya = $b['file_name'];
		
		$data = file_get_contents(pathup("document/$username/$n/$nama_filenya")); // Read the file's contents
	
		//$data = file_get_contents(pathup("document/$username/$n/$nama_filenya")); // Read the file's contents

		if($data == NULL){
			$data = file_get_contents(pathup("document/$username/$nama_filenya"));
		}else{
			$data = $data;
		}

		$name = $nama_filenya;
		
		force_download($name, $data); 
	}


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
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'odt' => 'application/vnd.oasis.opendocument.text'
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
			echo "<div class='alert alert-success'>Resume has successfully upload </div>";
			echo "<script> setTimeout(function() { location.reload(); }, 3000); </script>";
		}
	}
	
	function cv_print(){

		$data['date_issued'] = "Issued Date";
		$data['date_expired'] = "Expiry Date";
		// $data['title'] 	= "Resume";
		// $data['meta'] 	 = "resume/meta";
		// $data['css'] 	  = "resume/css";
		// $data['js_top']   = "resume/js_top";
		// $data['template'] = 'resume/template';
		// $data['js_under'] = "resume/js_under";
		$id_se = $this->session->userdata('id_user');
		$this->load->model('seatizen/seatizen_model');
		//$data['pelaut'] = $this->seatizen_model->get_detail_pelaut_by_id($id_se);
		$this->load->model('vessel_model');
		$this->load->model('department_model');
		$this->load->model('rank_model');
		$this->load->model('coc_model');
		$data['resume'] = $this->resume_model->get_resume();


		$this->load->view('resume/print_resume',$data);
	}

	function doc_download(){
		
		$data['date_issued'] = "Issued Date";
		$data['date_expired'] = "Expiry Date";
		// $data['title'] 	= "Resume";
		// $data['meta'] 	 = "resume/meta";
		// $data['css'] 	  = "resume/css";
		// $data['js_top']   = "resume/js_top";
		// $data['template'] = 'resume/template';
		// $data['js_under'] = "resume/js_under";
		$id_se = $this->session->userdata('id_user');
		$this->load->model('seatizen/seatizen_model');
		//$data['pelaut'] = $this->seatizen_model->get_detail_pelaut_by_id($id_se);
		$this->load->model('vessel_model');
		$this->load->model('department_model');
		$this->load->model('rank_model');
		$this->load->model('coc_model');
		$data['resume'] = $this->resume_model->get_resume();

		$this->load->view('resume/convertdoc',$data);
	}

	function cv_preview(){

		$this->load->view('resume/preview_resume',$data);
	}
	
	
	
	function get_coc_class()
	{
		
		$this->load->model("coc_model");
		
		$id 		   = $this->input->post("department_id");
		$id_coc_class = $this->input->post("id_coc_class"); 
		
		$coc = $this->coc_model->get_coc_bydept($id);
		
		if(!empty($coc))
		{
			  if(empty($id_coc_class)){ $se = 'selected=selected'; }else{ $se = ''; }
			  echo "<option value='' $se  >- Select Coc Class -</option>";
		  foreach($coc as $row)
		  {
			  $scc = "";
			  
			  if($id_coc_class == $row['id_coc_class'])
			  {
				  $scc = "selected='selected'";	
			  }
			  
			  echo "<option value='$row[id_coc_class]' $scc >$row[coc_class]</option>";
		  }
		}
		else
		{
			echo "<option value='0' > none </option>";
			
		}
	}
	
	function get_rank()
	{
		$this->load->model("rank_model");
		
		$id 	  = $this->input->post("department_id");
		$id_rank = $this->input->post("id_rank"); 
		
		$rank = $this->rank_model->get_rank_bydept($id);

		
		if(!empty($rank))
		{
			  if(empty($id_rank)){ $se = 'selected=selected'; }else{ $se = ''; }
			  echo "<option value='' $se  >- Select Rank -</option>";
		  foreach($rank as $row)
		  {
			  $sr = "";
			  if($row['rank_id'] == $id_rank ){
				$sr = "selected='selected'";  
			  }
			  echo "<option value='$row[rank_id]' $sr >$row[rank]</option>";
		  }
		}
		else
		{
			echo "<option value='0' selected >- Other -</option>";
			
		}
	}
	
	function resume_data() // semua resume data dijalankan disini 
	{
		
		$this->load->model("resume_data");
		//print $this->resume_data->get_json_ship(); exit;		
		
		$function_post = $this->input->post("function");
		$function_get = $this->input->get("function");
		//print $this->resume_data->get_json_ship();
		
		$function = !empty($function_post) ? $function_post : $function_get;
		
		//$function = $this
		
		if($function == "ship_json")
		{	
			print $this->resume_data->get_json_ship();
		}
		else if($function == "ship_type_json")
		{
			print $this->resume_data->get_json_ship_type();	
			
		}
		else if($function == "rank_json")
		{
			return $this->resume_data->get_json_rank();	
		}	
		
		/* ===================================================== */
		if($function == "get_ship_type")
		{
			return $this->resume_data->get_ship_type();
		}
		else if($function == "get_ship")
		{
			return $this->resume_data->get_ship();	
		}
		else if($function == "get_ship_bytype")
		{
			//$type_id = $this->input->post("type_id");
			return $this->resume_data->get_ship_bytype();
		}
		else if($function == "get_ship_type_byvi")
		{
			return $this->resume_data->get_ship_type_byvi();	
		}
	}
	
	function load_data_profile()
	{
		$this->load->model('vessel_model'); // vessel model
		$this->load->model("rank_model");
		$this->load->model('department_model');
		$this->load->model("coc_model");
		$data['resume'] = $this->resume_model->get_resume();
		$this->load->view('resume/ajax-data-profile',$data);	
	}
	
	function __destruct()
	{
		//echo "<!-- end class -->";	
	}
}