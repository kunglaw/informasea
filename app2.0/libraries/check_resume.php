<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class check_resume{
	
	function check_time()
	{
		
		$CI =& get_instance();
		// masing - masing resume memiliki 6 bagian, 1 bagian 1 tabel pada database 
		/*
			1. profile_resume_tr -> last_profile_resume
			2. resume_file ->
			3. document_tr 
			4. competency_tr -> last_
			5. proficiency_tr 
			6. experience_tr 
			
			langkah2 : 
			- petama2 check semua tabel dengan mengurutkan berdasarkan datetime/last_update dari yang terbaru sampai yang terlama
			  DESC LIMIT 1
			- ambil bagian yang terbaru tersebut 
			- hitung dengan tanggal sekarang ( gunakan helper "date_format_helper" function since_int ) 
			- return int --> 1 , 2
			
			  untuk di view 
			- apabila sudah 1 tahun maka keluarkan alert 
		*/
		
		$CI->load->model('seaman/resume_model'); // profile_resume_model and resume file
		$CI->load->model('profile_resume_model');
		$CI->load->model('competency_model');
		$CI->load->model('document_model');
		$CI->load->model('experience_model');
		$CI->load->model('proficiency_model');
		
		$CI->load->helper('date_format_helper');
		
		$file_resume 		= $CI->resume_model->last_file_resume();
		$profile_resume 	 = $CI->profile_resume_model->last_profile_resume();
		$competency 		 = $CI->competency_model->last_competency();
		$document 		   = $CI->document_model->last_document();
		$experience 		 = $CI->experience_model->last_experience();
		$proficiency 		= $CI->proficiency_model->last_proficiency();
		
		//ambil waktunya saja
		$fr = since_int($file_resume['datetime']);
		$pr = since_int($profile_resume['last_update']);
		$c  = since_int($competency['last_update']);
		$d  = since_int($document['datetime']);
		$e  = since_int($experience['last_update']);
		$p  = since_int($proficiency['last_update']);
		
		$check_time = array("file_resume" => $fr, "profile_resume" => $pr,
		"competency" => $c, "document" => $d, "experience" => $e, "proficiency" => $p);
		
		return $check_time;
	}
	
	function check_data()
	{
		$CI =& get_instance();
		
		$CI->load->model('seaman/resume_model'); // profile_resume_model and resume file
		$CI->load->model('profile_resume_model');
		$CI->load->model('competency_model');
		$CI->load->model('document_model');
		$CI->load->model('experience_model');
		$CI->load->model('proficiency_model');	
		
		$file_resume 		= $CI->resume_model->last_file_resume();
		$profile_resume 	 = $CI->profile_resume_model->last_profile_resume();
		$competency 		 = $CI->competency_model->last_competency();
		$document 		   = $CI->document_model->last_document();
		$experience 		 = $CI->experience_model->last_experience();
		$proficiency 		= $CI->proficiency_model->last_proficiency();
		
		$check_data = array("file_resume" => $file_resume, "profile_resume" => $profile_resume,
		"competency" => $competency, "document" => $document, "experience" => $experience, "proficiency" => $proficiency);
		
		return $check_data;
		
		
	}
	
	
	
	
}