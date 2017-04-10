<?php
	if(!defined('BASEPATH')) exit ('No direct script access allowed ');

	// company , module company

	class Company extends MX_Controller
	{

		function __construct()
		{
			parent::__construct();
			
			$usernamenya = $this->uri->segment(2);
			// echo $usernamenya;
			$id = $this->session->userdata('id_perusahaan');
			
			
			//BAHASA
			load_all_language();
			// =================================
			
			$this->authentification->underconst_access();
			
			/* if($usernamenya != "") // backgroundnya jadi error 
			{
				$this->authentification->cek_tampil($usernamenya);
				//exit;
			} */
			
			$this->load->model('company_model');
			$this->load->model('vacantsea_model');
			$this->load->library('pagination');
			$this->load->helper('url');
			$this->load->helper('tracker_helper');
		}

		function ajaxPagination(){
			// error_reporting(E_ALL);
			$page = $this->uri->segment(4); 
			//$offset = 0;
			$offset    = $page-1;
			$offset   *= 10;
			$limit 	 = 10;
			$data['title'] 		= "Agentsea";
			$data['template'] 	= "template";
			$data['css'] 		= "";
			$data['list'] 		= $this->company_model->company_index(false,$offset);
			$company = $this->company_model->company_index(true,$limit);
			$data['total_company'] = count($company);


			
			/*end*/
		 $data['nationality'] 	= $this->company_model->get_nationality("order by name asc");

       	//  $data['ship_type'] = $this->vacantsea_model->call_ship_type();
       	//  $data['department'] = $this->vacantsea_model->call_department();
        // $data['rank'] = $this->vacantsea_model->call_rank();
        // $data['coc'] = $this->vacantsea_model->call_coc();
		
		$username = $this->session->userdata('username');
		//$data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
		
		$this->load->view('index',$data);
			// $this->index($data);
		}

		function list_nation(){
			$this->load->model('nation_model');
			$id_nation = $this->input->post('idnation');
			$data['id_nation'] = "kosong";
			if($id_nation != 0 || $id_nation != "") $data['id_nation'] = $id_nation;
			$data['nation'] = $this->nation_model->get_nationality();
			$this->load->view("list_nation",$data);
		}

		private function loadPagination($total_data)
		{
			# code...
			$this->load->library('pagination');
			$config['base_url'] = base_url("agentsea/list/page/");
			$config['total_rows'] = $total_data;
			$config['per_page'] = 10;

			 $config["use_page_numbers"] = true;
			 $config["uri_segment"] = 4; //ini wajib di ubah saat url != (http|https://yourdomain.com/controller/function) atau saaa uri segment > 3, karena defaultnya page di ambil dari uri_segment = 3
			 
			 // $config["cur_page"] = 2;
			// $config['num_tag_open'] = "<a class=\"text-gray\">";
			// $config['num_tag_close'] = "</a> &nbsp;&nbsp;";
			// $config['cur_tag_open'] = "<a class='text-link disabled'><b>";
			// $config['cur_tag_close'] = "</b></a>&nbsp;&nbsp;";
			// $config['next_link'] = 'Next ';
			// $config['next_tag_open'] = "<a class='text-link'>";
			// $config['next_tag_close'] = "</a>&nbsp;&nbsp;";
			// $config['prev_link'] = 'Previous';
			// $config['prev_tag_open'] = "<a class='text-link'>";
			// $config['prev_tag_close'] = "</a>&nbsp;";
			// $config['last_link'] = 'Last &gt;';
			// $config['last_tag_open'] = "<a class='text-link'>";
			// $config['last_tag_close'] = "</a>&nbsp;";
			// $config['first_link'] = '&lt; First';
			// $config['first_tag_open'] = "<a class='text-link'>";
			// $config['first_tag_close'] = "</a>&nbsp;";
			  	$config['first_tag_open'] 	= "<li>";
			$config['first_link'] 		= "First";
			$config['first_tag_close'] 	= "</li>";
			$config['prev_link'] 		= "Prev";
			$config['prev_tag_open'] 	= "<li>";
			$config['prev_tag_close'] 	= "</li>";
			$config['cur_tag_open'] 	= "<li class='active'><a href>";
			$config['cur_tag_close'] 	= "</a></li>";
			$config['next_link'] 		= "Next";
			$config['next_tag_open'] 	= "<li>";
			$config['next_tag_close'] 	= "</li>";
			$config['num_tag_open'] 	= "<li>";
			$config['num_tag_close'] 	= "</li>";
			$config['last_tag_open'] 	= "<li>";
			$config['last_link'] 		= "Last";
			$config['last_tag_close'] 	= "</li>";

			$this->pagination->initialize($config);
			return $this->pagination->create_links();
		}
		

		function index()
		{
			$data = fill_ads_data();
			// $this->db = $this->load->database(DB_SETTING, true);
			// echo "tet";exit;
			// $data['page'] = "index";
			// echo "test "; exit;
			$data['title'] 		= "Agentsea";
			$data['template'] 	= "template";
			$data['css'] 		= "";


			// $url = $_SERVER['REQUEST_URI'];
			// $url = trim($url,'/').'/';
			// $url = explode("/",$url);
			/*$url = $_SERVER['REQUEST_URI'];
			$url = trim($url,'/').'/';
			$url = explode("/",$url);
			$limit = empty($url[3]) ? 0 : $url[3];

			// $limit = empty($url) ? 0 : $url;

			$limit *=5;
			if($limit >=5){
				$limit -= 5;
			}*/
			$page = $this->uri->segment(4); 
			//$offset = 0;
			if($page != ''){
				$offset  = $page-1;
				$offset *= 10;
				$limit   = 10;
			}else $offset = 0;
			


			$data['list'] = $this->company_model->company_index(false,$offset);

			$company = $this->company_model->company_index(true,$offset);
			$data['total_company'] = count($company);
		//	echo $data['total_company'];

			$data['pagination'] = $this->loadPagination($data['total_company']);
			
			//print_r($config); exit;
			/*end*/
		 $data['nationality'] 	= $this->company_model->get_nationality("order by name asc");

       	//  $data['ship_type'] = $this->vacantsea_model->call_ship_type();
       	//  $data['department'] = $this->vacantsea_model->call_department();
        // $data['rank'] = $this->vacantsea_model->call_rank();
        // $data['coc'] = $this->vacantsea_model->call_coc();
		
		$username = $this->session->userdata('username');
		//$data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
		
		$this->load->view('index',$data);
		

			//run_tracker("seatizen");



			// $data['title'] 		= "Agentsea";
			// $data['template'] 	= "template";
			// $data['css'] 		= "";
			// $data['divpaginationid'] = "listnya";
			// $page = $this->uri->segment(4);

			// $data['page'] = 1;
			// if($page > 0) {
			// 	$offset = $page;
			// 	$offset -= 1;
			// 	$offset *= 5;
			// 	$data['page'] = $page;
			// }
			// else $offset = 0;
			
			// $limit 	 = 5;
			// // $limit 		= 5;

			// $data['list'] 		= $this->company_model->get_company("where activation_code = 'ACTIVE' limit $offset, $limit");
			// $data['totaldata']   = $this->company_model->count_company();
			// // $config 			 = array();

			// $data['dest_page'] 	= base_url().'agentsea/list/page/';
			// $data['error'] 			= "";

			 $data['nationality'] 	= $this->company_model->get_nationality("order by name asc");
				
			// /*Tracker*/
			// run_tracker("company");
			// $this->load->view('index',$data);
			// $this->redirectIndexPage($data);
			

		}
		

		// function index()
		// {
		// 	// echo "tet";exit;
		// 	$data['title'] 		= "Agentsea";
		// 	$data['template'] 	= "template";
		// 	$data['css'] 		= "";
		// 	$data['divpaginationid'] = "listnya";
		// 	$page = $this->uri->segment(4);

		// 	$data['page'] = 1;
		// 	if($page > 0) {
		// 		$offset = $page;
		// 		$offset -= 1;
		// 		$offset *= 5;
		// 		$data['page'] = $page;
		// 	}
		// 	else $offset = 0;
			
		// 	$limit 	 = 5;
		// 	// $limit 		= 5;

		// 	$data['list'] 		= $this->company_model->get_company("where activation_code = 'ACTIVE' limit $offset, $limit");
		// 	$data['totaldata']   = $this->company_model->count_company();
		// 	// $config 			 = array();

		// 	$data['dest_page'] 	= base_url().'agentsea/list/page/';
		// 	$data['error'] 			= "";

		// 	$data['nationality'] 	= $this->company_model->get_nationality("order by name asc");
			
		// 	/*Tracker*/
		// 	run_tracker("company");
		// 	$this->load->view('index',$data);
		// 	// $this->redirectIndexPage($data);
			

		// }

		function detail()
		{
			$data = fill_ads_data();
			$this->db = $this->load->database(DB_SETTING, true);
			//echo ""; exit;
			$data['template']   = "template";
			$data['css'] 		= "";
			

			//cek type server
			if($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']){
		        $url = "localhost/agent.informasea";    
		    }else{
		        $url = "https://agent.informasea.com";   
		    }

			$username_uri 		= $this->uri->segment(2);
			
			$username_login	  = $this->session->userdata("username");
			$username_company 	= $this->session->userdata("username_company");
			$username_agent 	  = $this->session->userdata("username_agent");
			
			$data['company']	  = $this->company_model->get_company("WHERE username='$username_uri' AND role = 'manager'")->row_array();
			
			if(empty($data["company"]))
			{
				show_404();
				exit;	
			}

			$data['title'] 	    = $data["company"]["nama_perusahaan"];
			
			$data['photo']		= $this->company_model->get_photo("WHERE username='$username_uri' AND profile_pic='0' AND cover='0' AND 
			profile_manager = 0 limit 0, 5")->result_array();
			
			//$data['cek_profile']  = $this->company_model->get_photo("where username='$username' AND profile_pic='1' AND cover='0'");
			//$data['cek_cover']	= $this->company_model->get_photo("where username='$username' AND profile_pic='0' AND cover='1'");
			$data['profil_pic']   = check_logo_agentsea_thumb($username_uri);

			if ((!empty($username_company) && $username_company == $username_uri) || !empty($username_agent)) {
				
				$id_perusahaan 		   = $this->session->userdata("id_perusahaan");
				$username_company    	= $this->session->userdata("username_company");
				
				if(!empty($username_company))
				{
					$uurl = $username_company;
					$type_user = "company";
					$pass = $data['company']['password'];

				}
				else
				{
					$uurl = $username_agent;	
					$type_user = "agent";

					$str = "SELECT * FROM agent_ms WHERE username = '$uurl'";
					$q = $this->db->query($str);
					$f = $q->row_array();

					$pass  = $f['password'];

				}
									

			// btn dashboard 					
			//$data['btn_dasboard'] 	= "<a href='http://$url/beranda/$id_perusahaan&$uurl&dashboard&$type_user' class='btn btn-filled pull-left btn-custom-font' target='_blank'>View Dashboard</a>";
			if($this->session->userdata('account_type') != "Alpha"){
				
				$data['btn_dasboard'] = "<a class='btn btn-filled pull-left btn-custom-font' target='_blank' href='".agent_url("beranda/".$id_perusahaan."&".$uurl."&dashboard&".$type_user."&".$pass)."'> View Dashboard </a>";
				
				$data["btn_new_vacant"] = "| <a class='' target='_blank' href='".agent_url("new_vacant/".$id_perusahaan."&".$uurl."&vacantsea&".$type_user."&".$pass)."'> Create new vacantsea </a>";
				
				
			}else{
				$data['btn_dasboard'] = "<a class='btn btn-filled pull-left btn-custom-font' target='_blank' href='".alpha_url($uurl."/home")."'> 
				View Dashboard </a>";
			}
				$data['btn_applicant']	= "<button class='btn btn-filled btn-full block'>3 Applicants</button>";
				
			}
			else{
				$data['btn_dasboard'] 	= "";
				$data['btn_applicant']	= "<button class='btn btn-filled btn-full block'>Apply</button><div class='text-gray applicants ft-12'>3 Applicants</div>";
				
			}
			
			$menu 	= $this->uri->segment(3);
			
			$data["meta"]	   = "detail_company/meta";// $this->load->view("detail_company/meta"); 
			
			if ($menu == "more") 
			{

				$data['detail']		= "detail_company";
				$data['content']	   = "content_more";
					/*Tracker kunglaw 2016*/
				$dt = array("page"=>"company/more","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				$this->load->view('index',$data);
				
			}
			elseif ($menu == "profile") {
				
				$data['detail']		= "detail_company";
				$data['content']	   = "content_profile";
					/*Tracker*/
				$dt = array("page"=>"company/profile","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				$this->load->view('index',$data);

			}
			elseif ($menu == "vacantsea") {
				
				$data['detail']		= "detail_company";
				$data['content']	= "content_vacantsea";

				if($this->uri->segment(4)==""){
					$offset = 0;
				}else{
					$offset = $this->uri->segment(4);
				}

				$offset = $offset > 0 ? ($offset-1)*5:0;
				$limit 		= 5;
				

				$data['get_vacantsea']	= $this->company_model->vacantsea("where username='$username_uri' AND stat = 'open' order by create_date desc limit $offset,$limit ");
				$data['count'] 			= $this->company_model->vacantsea("where username='$username_uri' AND stat = 'open' ")->num_rows();
				
				
				$config 				= array();
				$config["use_page_numbers"] = true;
				$config['base_url'] 	= base_url().'agentsea/'.$username_uri.'/vacantsea';
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 4;
				$config['num_links'] 	= 5;
			   	$config['first_tag_open'] 	= '<li>';
				$config['first_link'] 		= 'First';
				$config['first_tag_close'] 	= '</li>';
				$config['prev_link'] 		= 'Prev';
				$config['prev_tag_open'] 	= '<li>';
				$config['prev_tag_close'] 	= '</li>';
				$config['cur_tag_open'] 	= '<li class="active"><a href>';
				$config['cur_tag_close'] 	= '</a></li>';
				$config['next_link'] 		= 'Next';
				$config['next_tag_open'] 	= '<li>';
				$config['next_tag_close'] 	= '</li>';
				$config['num_tag_open'] 	= '<li>';
				$config['num_tag_close'] 	= '</li>';
				$config['last_tag_open'] 	= '<li>';
				$config['last_link'] 		= 'Last';
				$config['last_tag_close'] 	= '</li>';
				$config['total_rows'] 		= $data['count'];

				$this->pagination->initialize($config);
				$data['error'] 			= "";
				$data['pagination'] = $this->pagination->create_links();
					/*Tracker*/
				$dt = array("page"=>"vacantsea","category"=>"company","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				$this->load->view('index',$data);

			}
			elseif ($menu == "information") {
				
				$data['detail']		= "detail_company";
				$data['content']	   = "content_information";
					/*Tracker*/
				$dt = array("page"=>"company/information","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				$this->load->view('index',$data);

			}
			elseif ($menu == "photos") {
				
				$data['detail']		= "detail_company";
				$data['content']	= "content_photos";

				if($this->uri->segment(4)==""){
					$offset = 0;
				}else{
					$offset = $this->uri->segment(4);
				}
				$limit 		= 35;
				

				$data['photos'] 	= $this->company_model->get_photo("where username='$username_uri' AND profile_pic='0' AND cover='0' AND profile_manager = 0 limit $offset, $limit");
				$data['count'] 	 = $this->company_model->get_photo("where username='$username_uri' AND profile_pic='0' AND cover='0'")->num_rows();
				$config 			= array();

				$config['base_url'] 	= base_url().'company/'.$username_uri.'/photos';
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 4;
				$config['num_links'] 	= 5;
			   	$config['first_tag_open'] 	= '<li>';
				$config['first_link'] 		= 'First';
				$config['first_tag_close'] 	= '</li>';
				$config['prev_link'] 		= 'Prev';
				$config['prev_tag_open'] 	= '<li>';
				$config['prev_tag_close'] 	= '</li>';
				$config['cur_tag_open'] 	= '<li class="active"><a href>';
				$config['cur_tag_close'] 	= '</a></li>';
				$config['next_link'] 		= 'Next';
				$config['next_tag_open'] 	= '<li>';
				$config['next_tag_close'] 	= '</li>';
				$config['num_tag_open'] 	= '<li>';
				$config['num_tag_close'] 	= '</li>';
				$config['last_tag_open'] 	= '<li>';
				$config['last_link'] 		= 'Last';
				$config['last_tag_close'] 	= '</li>';
				$config['total_rows'] 		= $data['count'];

				$this->pagination->initialize($config);
				$data['error'] 			= "";
					/*Tracker*/
				$dt = array("page"=>"company/photos","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				$this->load->view('index',$data);

			}
			elseif ($menu == "ships") {
				
				$data['detail']	 = "detail_company";
				$data['content']	= "content_ships";

				if($this->uri->segment(4)==""){
					$offset = 0;
				}else{
					$offset = $this->uri->segment(4);
				}
				$limit 		= 35;
				

				$data['GetShips'] 	= $this->company_model->ship("where username='$username_uri' limit $offset, $limit");
				$data['count'] 		= $this->company_model->ship("where username='$username_uri'")->num_rows();
				$config 			= array();

				$config['base_url'] 	= base_url().'company/'.$username_uri.'/ships';
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 4;
				$config['num_links'] 	= 5;
			   	$config['first_tag_open'] 	= '<li>';
				$config['first_link'] 		= 'First';
				$config['first_tag_close'] 	= '</li>';
				$config['prev_link'] 		= 'Prev';
				$config['prev_tag_open'] 	= '<li>';
				$config['prev_tag_close'] 	= '</li>';
				$config['cur_tag_open'] 	= '<li class="active"><a href>';
				$config['cur_tag_close'] 	= '</a></li>';
				$config['next_link'] 		= 'Next';
				$config['next_tag_open'] 	= '<li>';
				$config['next_tag_close'] 	= '</li>';
				$config['num_tag_open'] 	= '<li>';
				$config['num_tag_close'] 	= '</li>';
				$config['last_tag_open'] 	= '<li>';
				$config['last_link'] 		= 'Last';
				$config['last_tag_close'] 	= '</li>';
				$config['total_rows'] 		= $data['count'];

				$this->pagination->initialize($config);
				$data['error'] 			= "";
					/*Tracker*/
				$dt = array("page"=>"company/ships","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				$this->load->view('index',$data);

			}
			else{
				
				$data['detail']		= "detail_company";
				$data['content']	   = "content_company";
					/*Tracker*/
				
				// tracker
				$dt = array("page"=>"company","action"=>"view","username_company"=>$username_uri,"id"=>$data["company"]["id_perusahaan"]);
				run_tracker($dt);
				
				$this->load->view('index',$data);
			}
		}

		function ajaxPaginationSearch(){

			if(isset($_POST["x"])) $offset = $this->input->post("x");
			else $offset = 0;

			$ada_perusahaan = 1;
			$ada_nationality = 1;

			if(isset($_POST["perusahaan"])) $perusahaan = $this->input->post("perusahaan");
			else $ada_perusahaan = 0;
			if(isset($_POST["nationality"])) $nationality = $this->input->post("nationality");
			else $ada_nationality=0;
			$offset -= 1;
			$offset *= 10;
			$limit   = 10;

			
			if ($ada_nationality) { // jika nama_perusahaan == '' Or nationality == ''
				$cek_perusahaan 		= $this->company_model->get_company("WHERE id_nationality='$id_nationality'");
				if ($cek_perusahaan->num_rows() > 0) {	
					$data['perusahaan'] = $this->company_model->get_company("WHERE id_nationality='$id_nationality' limit $offset, $limit");;
					$data['count']		= $cek_perusahaan->num_rows();
					
				}else{
					//jika data tidak ditemukan
					$data['notfound']	= "SORRY, DATA NOT FOUND";
					$data['perusahaan'] = $this->company_model->get_company("WHERE 0");
				}
			}elseif ($ada_perusahaan) {
				# code... //Jika uri 3 adalah nama perusahaan
				$cek_perusahaan 		= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$perusahaan%'");
				if ($cek_perusahaan->num_rows > 0) {
					$data['perusahaan']	= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$perusahaan%' limit $offset, $limit");
					$data['count'] 		= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$perusahaan%'")->num_rows();
					
				}else{
					//jika data tidak ditemukan
					$data['notfound']	= "SORRY, DATA NOT FOUND";
					$data['perusahaan'] = $this->company_model->get_company("WHERE 0");
				}
				
			}
			else{ // jika nama_perusahaan != '' and nationality !='' 
				
				$cek_perusahaan 		= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$perusahaan%' AND id_nationality='$id_nationality'");
				if ($cek_perusahaan->num_rows() > 0) {
					$data['perusahaan']	= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$perusahaan%' AND id_nationality='$id_nationality' limit $offset, $limit");
					$data['count']		= $cek_perusahaan->num_rows();	
					// $data['param_search'] = "&perusahaan=".$segment3."&nationality=".$id_nationality;
				}else{
					$data['notfound']	= "SORRY, DATA NOT FOUND";
					$data['perusahaan'] = $this->company_model->get_company("WHERE 0");
				}
			}
			//$data['perusahaan'] = $this->company_model->get_company("where activation_code = 'ACTIVE' limit $offset, $limit");
			$data['totaldata'] 	= $data['count'];

			$this->load->view("company/search_result",$data);
		}

		// function search(){

		// 	$data['title'] 		 	= "company";
		// 	$data['template'] 	  	= "template";
		// 	$data['css'] 		   	= "";
		// 	$data['search']			=   "search";

		// 	$username_login		= $this->session->userdata("username");
		// 	$username_company 	= $this->session->userdata("username_company");
		// 	$segment3 			= $this->uri->segment(3);
		// 	$segment4 			= $this->uri->segment(4);
		// 	$segment5 			= $this->uri->segment(5);

		// 	//cek segment 4
		// 	$uri_4 		= str_replace('-', ' ', $segment4);
		// 	$cek_uri4 	= $this->company_model->get_nationality("where name='$uri_4'");

		// 	$data['yangdicari'] = array(
		// 		'perusahaan' => "",
		// 		'nationality' => ""
		// 		);

		// 	$data['param_search'] = "";
		// 	$paging_destination = "agentsea/search/";
		// 	if ($cek_uri4->num_rows() == 0 ) { // jika nama_perusahaan == '' Or nationality == ''
		// 		if($this->uri->segment(4)==""){
		// 			$offset = 0;
		// 		}else{
		// 			$offset = $this->uri->segment(4);
		// 		}
		// 		$limit 		= 5;

		// 		//cek segment 3
		// 		$uri_3 		= str_replace('-', ' ', $segment3);
		// 		$cek_uri3 	= $this->company_model->get_nationality("where name='$uri_3'");

				

		// 		if ($cek_uri3->num_rows() > 0) { // jika uri 3 adalah nama negara
		// 			$nationality 			= $cek_uri3->row_array(); 
		// 			$id_nationality			= $nationality['id']; // ambil ID negara

		// 			$cek_perusahaan 		= $this->company_model->get_company("WHERE id_nationality='$id_nationality'");
		// 			if ($cek_perusahaan->num_rows() > 0) {	
		// 				$data['perusahaan'] = $this->company_model->get_company("WHERE id_nationality='$id_nationality' limit $offset, $limit");;
		// 				$data['count']		= $cek_perusahaan->num_rows();
		// 				$data['param_search'] = "&nationality=".$id_nationality;

						
		// 			}else{
		// 				//jika data tidak ditemukan
		// 				$data['notfound']	= "SORRY, DATA NOT FOUND";
		// 				$data['perusahaan'] = $this->company_model->get_company("WHERE 0");
		// 			}

		// 			$data['yangdicari'] = array(
		// 		'perusahaan' => "",
		// 		'nationality' => $id_nationality
		// 		);

		// 		}else{ //Jika uri 3 adalah nama perusahaan
		// 			$cek_perusahaan 		= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$segment3%'");
		// 			if ($cek_perusahaan->num_rows > 0) {
		// 				$data['perusahaan']	= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$segment3%' limit $offset, $limit");
		// 				$data['count'] 		= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$segment3%'")->num_rows();
		// 				$data['param_search'] = "&perusahaan=".$segment3;

		// 			}else{
		// 				//jika data tidak ditemukan
		// 				$data['notfound']	= "SORRY, DATA NOT FOUND";
		// 				$data['perusahaan'] = $this->company_model->get_company("WHERE 0");
		// 			}
		// 			$data['yangdicari'] = array(
		// 		'perusahaan' => $segment3,
		// 		'nationality' => ""
		// 		);
					
		// 		}
		// 		$paging_destination .= "$segment3/";

		// 	}elseif ($cek_uri4->num_rows() > 0) { // jika nama_perusahaan != '' and nationality !='' 
		// 		if($this->uri->segment(5)==""){
		// 			$offset = 0;
		// 		}else{
		// 			$offset = $this->uri->segment(5);
		// 		}
		// 		$limit 		= 2;

		// 		$nationality 			= $cek_uri4->row_array(); 
		// 		$id_nationality			= $nationality['id'];

		// 		$cek_perusahaan 		= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$segment3%' AND id_nationality='$id_nationality'");
		// 		if ($cek_perusahaan->num_rows() > 0) {
		// 			$data['perusahaan']	= $this->company_model->get_company("WHERE nama_perusahaan LIKE '%$segment3%' AND id_nationality='$id_nationality' limit $offset, $limit");
		// 			$data['count']		= $cek_perusahaan->num_rows();	
		// 			$data['param_search'] = "&perusahaan=".$segment3."&nationality=".$id_nationality;
		// 		}else{
		// 			$data['notfound']	= "SORRY, DATA NOT FOUND";
		// 			$data['perusahaan'] = $this->company_model->get_company("WHERE 0");
		// 		}

		// 		$data['yangdicari'] = array(
		// 		'perusahaan' => $segment3,
		// 		'nationality' => $id_nationality
		// 		);
		// 		$paging_destination .= "$segment3/$segment4/";
		// 	}
		// 	$data['divpaginationid'] = "listnya";
		// 	$data['totaldata'] = $data["count"];

		// 	//paging search
		// 	// $config 					= array();
		// 	$data['dest_page'] 		= base_url().$paging_destination."page/";
		// 	/*$config['per_page'] 		= $limit;
		// 	$config['uri_segment'] 		= 4;
		// 	$config['num_links'] 		= 2;
		//    	$config['first_tag_open'] 	= "<li>";
		// 	$config['first_link'] 		= "First";
		// 	$config['first_tag_close'] 	= "</li>";
		// 	$config['prev_link'] 		= "Prev";
		// 	$config['prev_tag_open'] 	= "<li>";
		// 	$config['prev_tag_close'] 	= "</li>";
		// 	$config['cur_tag_open'] 	= "<li class='active'><a href>";
		// 	$config['cur_tag_close'] 	= "</a></li>";
		// 	$config['next_link'] 		= "Next";
		// 	$config['next_tag_open'] 	= "<li>";
		// 	$config['next_tag_close'] 	= "</li>";
		// 	$config['num_tag_open'] 	= "<li>";
		// 	$config['num_tag_close'] 	= "</li>";
		// 	$config['last_tag_open'] 	= "<li>";
		// 	$config['last_link'] 		= "Last";
		// 	$config['last_tag_close'] 	= "</li>";
		// 	$config['total_rows'] 		= $data['count'];

		// 	$this->pagination->initialize($config);*/
		// 	$data['nationality']= $this->company_model->get_nationality("order by name asc");
			
		// 	//tracker kunglaw 2016
		// 	$dt = array("page"=>"company","action"=>"search","username_company"=>$username,"id"=>$data["company"]["id_perusahaan"]);
		// 	run_tracker($dt);
			
		// 	$this->load->view('index',$data);

		// }

		function search(){
			
			$this->load->model('nation_model');
			$url = "search";
			// echo "KEYWORD :".$this->uri->segment(3)."<br>";
			// echo "Nationality : ".$_GET['nationality']; 
			$data['title'] = "Company";
			$data['template'] = "template";
			$data['css'] = "";

			$nationality = $this->input->get('nationality');

			$nationality = str_replace('-',' ',$nationality);	
			$keyword = $this->uri->segment(3);


			$data_nationality = $this->nation_model->get_detail_nationality($nationality);

			$v1 = empty($data_nationality) ? false : true;

			if($v1){

				if(!empty($keyword)){
					$url .="/$keyword/?nationality=$data_nationality[name]";
				}else{
					$url .="?nationality=$data_nationality[name]";
				}

					if(isset($_GET['page'])){
						
						$offset = $_GET['page'];
						if($offset != 0){

						$offset *= 10;
						$offset -= 10;
						}
						if($offset == ""){
							$offset = 0;
						}else{
							$offset = $offset;
						}
					}
					else{
					$offset = 0;
					}

					$list = $this->company_model->get_search_company($keyword,$data_nationality['id'],false,$offset);
					$total_company = $this->company_model->get_search_company($keyword,$data_nationality['id'],true,$offset);


			}else{

				if(!empty($keyword)){
					$url .="/$keyword?";
				}else{
					$url .="?";
				}

					if(isset($_GET['page'])){
						
						$offset = $_GET['page'];
						if($offset != 0){

						$offset *= 10;
						$offset -= 10;
						}
						if($offset == ""){
							$offset = 0;
						}else{
							$offset = $offset;
						}
					}
					else{
					$offset = 0;
					}

					$list = $this->company_model->get_search_company($keyword,0,false,$offset);
					$total_company = $this->company_model->get_search_company($keyword,0,true,$offset);



			}
			$data['page'] = $url;

			$data['list'] = $list;
			$data['total_company'] = $total_company;

			$this->load->library('pagination');
			$config['base_url'] = base_url("company/".$data['page']);
			$config['total_rows'] = count($data['total_company']);
			$config['first_url'] = base_url("company/".$data['page']."&page=1"); 
			$config['per_page'] = 10;
			$config["use_page_numbers"] = true;
			$config['page_query_string'] = true;
			$config['first_tag_open'] 	= "<li>";
			$config['first_link'] 		= "First";
			$config['first_tag_close'] 	= "</li>";
			$config['prev_link'] 		= "Prev";
			$config['prev_tag_open'] 	= "<li>";
			$config['prev_tag_close'] 	= "</li>";
			$config['cur_tag_open'] 	= "<li class='active'><a href>";
			$config['cur_tag_close'] 	= "</a></li>";
			$config['next_link'] 		= "Next";
			$config['next_tag_open'] 	= "<li>";
			$config['next_tag_close'] 	= "</li>";
			$config['num_tag_open'] 	= "<li>";
			$config['num_tag_close'] 	= "</li>";	
			$config['query_string_segment'] = "page";
			$config['last_tag_open'] 	= "<li>";
			$config['last_link'] 		= "Last";
			$config['last_tag_close'] 	= "</li>";

			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		$data['search']			=   "search";
		$data['nationality']= $this->company_model->get_nationality("order by name asc");

		

			$this->load->view('index',$data);

		}

		function EditProfile(){
			
			$id_perusahaan 		= $this->input->post('id_perusahaan');
			$nama_perusahaan 	= $this->input->post('nama_perusahaan');
			$national 			= explode('|', $this->input->post('nationality'));
			$id_nationality 	= $national[0];
			$nationality 		= $national[1];
			$description 		= $this->input->post('description');
			$website 			= $this->input->post('website');
			$no_telp 			= $this->input->post('no_telp');
			$fax 				= $this->input->post('fax');
			$email 				= $this->input->post('email');
			$contact 			= $this->input->post('contact');
			$address 			= $this->input->post('address');

			$data 	= array(
					'nama_perusahaan'		=> $nama_perusahaan,
					'id_nationality'		 => $id_nationality,
					'nationality' 			=> $nationality,
					'description'			=> $description,
					'website'				=> $website,
					'no_telp'				=> $no_telp,
					'fax'					=> $fax,
					'email' 				  => $email,
					'contact_person' 		 => $contact,
					'address' 				=> $address);

			$where 	= array('id_perusahaan' => $id_perusahaan);
			$upd_company 	= $this->db->update('perusahaan', $data, $where);
			
			//tracker kunglaw 2016
			$dt = array("page"=>"company","action"=>"edit_profile","username_company"=>$username,"id"=>$id_perusahaan);
			run_tracker($dt);
			
			if ($upd_company == true) {
				echo "<div class='alert alert-success' role='alert'>success !! data has been update</div>";
			}else{
				echo "<div class='alert alert-danger' role='alert'>warning !! data can't update</div>";
			}
			
		}

		function EditVacant(){
			$x 			= $this->input->post("x");
			$modal 		= $this->input->post("modal");
			$id_update 	= $this->input->post("id_update");
			echo $x."&".$modal."&".$id_update;
		}

		function information()
		{
			//tidak perlu ditambahkan close access karena sudah ada di function directPageDetails()
			$this->directPageDetails("information");
		}

		function company_photos()
		{
			//tidak perlu ditambahkan close access karena sudah ada di function directPageDetails()
			$type = $this->uri->segment(5);
			$data = $this->photo->company_photos();
			$this->directPageDetails("gallery_company/list_photo_company","",$data);
		}

		function getData(){

			$keyword 		= strtolower($this->input->post("keyword"));
			$id_nationality = $this->input->post("id_nationality");
			$get_nationality= $this->company_model->get_nationality("where id='$id_nationality'")->result_array();
			$nationality 	= strtolower($get_nationality[0]['name']);
			echo $keyword."&".$nationality;
		}

		function ships_list()
		{
			//tidak perlu ditambahkan close access karena sudah ada di function directPageDetails()
			$id = $this->uri->segment(3);

			$data['ships'] = $this->ship_model->get_company_ships($id);
			// $data['ships_type'] = $this->
			$this->directPageDetails("ships/ships","",$data);
		}

		function ship_detail()
		{
			//tidak perlu ditambahkan close access karena sudah ada di function directPageDetails()
			$id_kapal = $this->uri->segment(5);
			// echo $id_kapal;
			$data['ship'] = $this->ship_model->get_detail_ship($id_kapal);
			$data['detail_ship'] = $this->ship_model->get_ships_type($data['ship']['id_ship_type']);
			$template = "vacantsea/template_detail"; //memanggil template selain di dalam company
			$new_page = "company/detail_company/ships/ships_detail"; //halaman detail yang baru jika tidak menggunakan template detail company
			$this->directPageDetails("ships/ships_detail","",$data, $template, $new_page);
		}

		function directGeneralPage($data='', $offset=0)
		{
			//$this->authentification_model->close_access();

			# code...
			//$this->authentification_model->close_access();
			//echo $this->session->userdata('id_user');

			if($this->session->userdata("id_user") == NULL)
			{
				//header("location: custom404");
				// echo "testing";
			}
			$data['title'] 		= "company";
			$data['template'] 	= "template";
			$data['css'] 		= "";

	}
	function search_company()
	{
		//$this->authentification_model->close_access();

		$dt = explode(',', $this->input->post('x'));
		$x = $dt[0];
		$keyword = $dt[1];
		$ship_type = $dt[2];
		$page = $dt[3];
		// print_r($dt);
		if(empty($keyword) && empty($ship_type))
		{

			$this->index();
		}
		else
		{
			
			if($x != 1)
			{
				header("location:".base_url());
			}
			// echo "<br>test".$keyword;
			$data['keyword'] 	= $keyword;
			$data['department'] = $department;
			$data['rank_id']	= $rank_id;
			$data['ship_type']  = $ship_type;
			$data['page']	   	= $page;
			$data['coc_class']	= $coc_class;
			$data['sallary']	= $sallary;
			$data['company'] = $this->company_model->search_company($keyword,$ship_type);
			
			//tracker kunglaw 2016
			$dt = array("page"=>"company","action"=>"search_company");
			run_tracker($dt);
			
			// $data['company'] = $data['hasil'];
			$this->load->view('company_list',$data);
		}
	}

	function search_company_plus()
	{
		$this->authentification_model->close_access();

		//echo "search vacantsea plus ... "; exit;
		$keyword = $this->input->post('keyword');
		$ship_type = $this->input->post('ship_type');

		$vacantsea_id = $this->input->post('vacantsea_id');
		$jml_setting = $this->input->post('jml_setting');

		// echo $keyword." - ".$vacantsea_id." = ".$jml_setting;

		if($this->input->post('x') != 1)
		{
			header("location:".base_url());
		}
		// echo "Hallo";
		$data['job_plus'] = $this->company_model->search_company_plus($keyword, $department,$rank_id,$ship_type,$sallary);
		// print_r($data);
		$data['uri'] = $this->input->post('uri');

		$data['keyword'] 	= $keyword;
		$data['department'] = $department;
		$data['rank_id']	= $rank_id;
		$data['ship_type']  = $ship_type;
		$data['page']	   = $page;
		// print_r($data);
		$this->load->view('list_vacantsea_plus',$data);

	}

		protected function directPageDetails($page, $css = "", $data = "", $template = "", $new_page="")
		{
			$this->authentification_model->close_access();

			$id = $this->uri->segment(3);
			$nama_perusahaan = $this->uri->segment(4);
			$data['company_name'] = str_replace('%20', '_', $nama_perusahaan);
			$data['comp_id'] = $id;
			$data['title'] = str_replace('%20', ' ', $nama_perusahaan);
			$data['template'] = $template == "" ? "detail_company/template" : $template;
			$data['halaman_detail'] = $new_page == "" ? "detail_company/".$page : $new_page;
			$data['css'] = $css;
			$data['vacantsea'] = $this->vacantsea_model->get_company_vacantsea($id);
			$data['company'] = $this->company_model->get_detail_company($id);
			// echo $id."-".$id_kapal."-".$nama_perusahaan;
			// print_r($data);
			$this->load->view('index',$data);
		}

		function searching()
		{
			$data['keyword'] = $this->input->get("keyword", true);
			$data['ship_type'] = $this->input->get("ship_type", true);
			$data['page'] = $this->input->get("page", true);

			$this->directGeneralPage($data);
		}

		function home()
		{
			$this->directPageDetails("home","detail_company/carousel");
		}

		function list_company_vacantsea()
		{
			$this->directPageDetails("list_company_vacantsea");
		}

		function company_list()
		{
		$this->authentification_model->close_access();

			if($this->input->post('x') != 1)
			{
				header("location:".base_url());
			}
			$data['company'] = $this->company_model->list_company_lim();
			$this->load->view('company_list',$data);

		}

		function get_company_list_plus()
		{
			$this->authentification_model->close_access();

			//echo "oooiii";
			$data['company_plus'] = $this->company_model->list_company_lim_plus();
			$data['uri'] = $this->input->post('uri');

			$this->load->view('company_list_plus',$data);

		}

		function modal_company(){
			$modal_type 	= $this->input->post("modal_type");

			if ($modal_type == "vacant_add") {
				$data['ship_type']		= $this->company_model->general_table("ship_type", "order by ship_type asc");
				$data['department']		= $this->company_model->general_table("department", "order by department asc");
				$data['nationality']	= $this->company_model->general_table("nationality", "order by name asc");

				$this->load->view('include/modal_vacantsea', $data);

			}elseif ($modal_type == "ship_name") {
				$id_ship_type 			= $this->input->post("id_ship_type");
				$q_ship 				= $this->company_model->general_table("ship", "where id_ship_type='$id_ship_type'");

				foreach ($q_ship->result_array() as $rows) {
					echo "<option value='".$rows['ship_id']."'>".$rows['ship_name']."</option>";
				}

			}elseif ($modal_type == "rank") { 
				$department_id 			= $this->input->post("department_id");
				$q_rank 				= $this->company_model->general_table("rank", "where id_department='$department_id'");

				foreach ($q_rank->result_array() as $rows) {
					echo "<option value='".$rows['rank_id']."'>".$rows['rank']."</option>";
				}
			}
		}

		public function vacantsea_add(){
			$type_user 			= $this->session->userdata("type_user");
			if ($type_user == "company") {
				$id_perusahaan 	= $this->session->userdata("id_perusahaan");
				$perusahaan 	= $this->session->userdata("nama_perusahaan");
				$id_agent 		= "";

			}elseif ($type_user == "agent") {
				$id_perusahaan 	= $this->session->userdata("id_perusahaan_agent");
				$perusahaan 	= $this->session->userdata("nama_company");
				$id_agent 		= $this->session->userdata("id_agent");
				
			}
			$title 				= $this->input->post("title");
			$nav_area 			= $this->input->post("nav_area");
			$ship_type 			= $this->input->post("ship_type");
			$ship_id 			= $this->input->post("ship_id");
			$department_id 		= $this->input->post("department_id");
			$rank_id 			= $this->input->post("rank_id");
			$salary_curr 		= $this->input->post("salary_curr");
			$salary 			= str_replace(".", "", $this->input->post("salary"));
			$salary_type 		= $this->input->post("salary_type");
			$contract_dyn 		= $this->input->post("contract_dyn");
			$benefits 			= $this->input->post("benefits");
			$req_cert 			= $this->input->post("req_cert");
			$req_coc 			= $this->input->post("req_coc");
			$nationality_id  	= $this->input->post("nationality_id");
			$sign_on 			= $this->input->post("sign_on");
			$experience			= $this->input->post("experience");
			$detail 			= $this->input->post("detail");
			$expired_date 		= $this->input->post('expired_dt');
			$create_date 		= date('Y-m-d');

			if ($expired_date =="1970-01-01" || $expired_date == "0000-00-00") {
				$expired_date 	= date('Y-m-d', strtotime('+7 days', strtotime($create_date))); // vacantsea free, default expired date 1 minggu
			}else{
				$expired_date 	= $expired_date;
			}

			$data 	= array(
				'vacantsea'			=> isset($title) ? $title : '',
				'id_perusahaan'		=> isset($id_perusahaan) ? $id_perusahaan : '',
				'perusahaan'		=> isset($perusahaan) ? $perusahaan : '',
				'description'		=> isset($detail) ? $detail : '',
				'department'		=> isset($department_id) ? $department_id : '',
				'rank_id'			=> isset($rank_id) ? $rank_id : '', 
				'ship_type' 		=> isset($ship_type) ? $ship_type : '',
				'navigation_area'	=> isset($nav_area) ? $nav_area : '',
				'annual_sallary'	=> isset($salary) ? $salary : '',
				// 'contract_type'		=> isset($contract_type) ? $contract_type : '',
				'contract_dynamic'	=> isset($contract_dyn) ? $contract_dyn : '',
				'ship'				=> isset($ship_id) ? $ship_id : '',
				'requested_certificates'		=> isset($req_cert) ? $req_cert : '',
				'requested_coc'		=> isset($req_coc) ? $req_coc : '',
				'id_nationality'	=> isset($nationality_id) ? $nationality_id : '',
				'create_date'		=> $create_date,
				'expired_date'		=> isset($expired_date) ? $expired_date : '',
				'benefits'			=> isset($benefits) ? $benefits : '',
				'sallary_range'		=> isset($salary_type) ? $salary_type : '',
				'sallary_curr'		=> isset($salary_curr) ? $salary_curr : '',
				'experience'		=> isset($experience) ? $experience : '',
				'author' 			=> isset($id_agent) ? $id_agent : '',
				);
			$this->db->insert("vacantsea", $data);
			echo "success !! vacantsea has been saved";

		}

		 
		function __desturct(){}

	}
