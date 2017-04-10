<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Report_process extends MX_Controller{

		function __construct(){
			parent::__construct();

		}

		function add_report_process(){

			//$this->load->library('pagination');
			$sess =  $this->session->userdata('userame');
			$id_user = $this->input->post('id_user');
			$message = $this->input->post('report');
				
			$page = $this->input->post('page');
			$url = $this->input->post('url');
			$gambar = 'gambar';

			if($page != "friends" OR $page != "resume"){
				$urlbaru = base_url().$page;
			} else if($page == "resume"){
				$urlbaru = base_url().$sess."/resume";
			}	else if($page == "agentsea"){
				$urlbaru = base_url()."company";
			} else { 
				$urlbaru = $url;
			}
			
			$ip_address=  $_SERVER['REMOTE_ADDR'];
			$this->load->library('image_lib');
			$this->load->library('upload');


			$config['upload_path'] = pathup("report"); //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	     	$config['overwrite'] = TRUE;
	      							 	
			$this->upload->initialize($config);
			
       	  if($_FILES['gambar']['name']) {
        	
        	if ($this->upload->do_upload($gambar))
            {
            	$error = array('error' => $this->upload->display_errors());
                $gbr = $this->upload->data();
                $nama_gmbr = $_FILES['gambar']['name'];
               } else{
               	$nama_gmbr = "";
               }
           } else {
           	$nama_gmbr = '';
           	$error = array('error' => $this->upload->display_errors());
           }
        
			$a = $this->db->query("INSERT INTO report_problem (id_user,pesan,url_halaman,gambar_report,kategori,time,ip_address) 
				VALUES ('$id_user','$message','$urlbaru','$nama_gmbr','$page',now(),'$ip_address')");
			
			if($a){
				echo "<div class='alert alert-success'> Thanks for your report... </div>";
			}else{
				echo "<div class='alert alert-danger'> Failed to report </div>";
			}

		}


	}