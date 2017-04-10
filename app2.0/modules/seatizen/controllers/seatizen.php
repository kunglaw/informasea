<?php
	// controller seatizen, module seatizen;
	
	class Seatizen extends MX_Controller{
		
		private $db;
    	private $dbadmin;
		function __construct()
		{
			
			parent::__construct();
			//echo "test";
			//error_reporting(E_ALL);
			$this->authentification->underconst_access();
//			$this->authentification_model->close_access();
			// authentification
			//$this->session->all_userdata(); exit;
			
			//BAHASA
			load_all_language();
			// =================================
			
			$username = $this->session->userdata('username');
			$id_pelaut = $this->session->userdata("pelaut_id");
			$user = $this->session->userdata("user");

			$this->load->model('seatizen_model'); 
			$this->load->model('department_model');
			//$this->load->model('authentification_model');
			$this->load->model('rank_model');
			$this->load->model('vacantsea/vacantsea_model');
			$this->load->model('users/user_model');
			$this->load->model('ship_model');
			$this->load->model('coc_model');
			$this->load->model('nation_model');
			$this->load->model('vessel_model');

			$this->load->helper('tracker_helper');
			$this->load->model('tracker_model');
			
			$this->load->model("user_history_model","uhm");
			$this->load->model("Profile_resume_model","prm");
			// akses : seaman, guest
			
			//if($user == "agent")
//			{
//				header("location:".base_url("agent"));
//			}
//			else if($user == "company")
//			{
//				header("location:".base_url("company"));	
//				
//			}
		
		}
	function getData()
	{	
    	$id_nation = $this->input->post("id_nation");
    	$id_ship = $this->input->post("id_ship");
        $id_dept = $this->input->post("id_dept");
        $id_rank = $this->input->post("id_rank");
        $id_coc = $this->input->post("id_coc");

        $data_nation = !empty($id_nation) ? $this->nation_model->get_detail_nationality($id_nation):"";
	    $data_ship = !empty($id_ship) ? $this->ship_model->get_ships_type($id_ship):"";
        $data_dept = !empty($id_dept) ? $this->department_model->get_detail_department($id_dept):"";
        $data_rank = !empty($id_rank) ? $this->rank_model->get_rank_detail($id_rank):"";
        $data_coc = !empty($id_coc) ? $this->coc_model->get_coc_detail($id_coc):"";

      	$nation = empty($data_nation) ? "":$data_nation['name'];
      	$ship = empty($data_ship) ? "":$data_ship['ship_type'];
        $department = empty($data_dept) ? "":$data_dept['department'];
        $rank = empty($data_rank) ? "":$data_rank['rank'];
        $coc = empty($data_coc) ? "":$data_coc['coc_class'];

        $nation = strtolower($nation);
        $ship = strtolower($ship);
        $department = strtolower($department);
        $rank = strtolower($rank);
        $coc = strtolower($coc);

        echo $nation."&".$ship."&".$department."&".$rank."&".$coc;
    }
		
	function list_department(){

        $idnya = $this->input->post("idnya");
        $data['idnya'] = "kosong";
        if($idnya!=0 || $idnya != "") $data["idnya"] = $idnya;
        $data["dept_jx"] = $this->department_model->get_department();
        $this->load->view("list_dept",$data);
    }

    function list_rank(){

            $s = strpos($this->input->post("s"), "Security") ? $this->input->post("s") : str_replace('-', ' ', $this->input->post("s"));
            $data["s"] = $s;
            $data_dept = $this->department_model->get_detail_department_by_name($s);
        $id_dept = !empty($s) ? $data_dept['department_id']:$this->input->post("id_department");
        $idnya = $this->input->post("idnya");
        $data['idnya'] = "kosong";
        if($idnya!=0 || $idnya != "") $data["idnya"] = $idnya;
        $data["rank_jx"] = $this->rank_model->get_rank_bydept($id_dept);
        $this->load->view("list_rank",$data);
    }

	
		function list_ship(){
			$id_shipnya = $this->input->post("idshipnya");
			$data['idshipnya'] = "kosong";
			if($id_shipnya !=0 || $id_shipnya != "") $data['idshipnya'] = $id_shipnya;
		$data['ship_jx'] = $this->ship_model->get_list_ship();
		$this->load->view("list_ship",$data);
		}

		function list_nation(){
			$id_nation = $this->input->post('idnation');
			$data['id_nation'] = "kosong";
			if($id_nation != 0 || $id_nation != "") $data['id_nation'] = $id_nation;
			$data['nation'] = $this->nation_model->get_nationality();
			$this->load->view("list_nation",$data);
		}
	
		function list_coc(){
        $id_dept = $this->input->post("id_department");
		$data['coc_class'] = $this->coc_model->get_coc_bydept($id_dept);
		$this->load->view("list_coc",$data);		
		}
		
		function show_all_complete_resume()
		{
			// $data['only_complete_resume'] = true;
			$offset = $this->uri->segment(4);
			if($offset == "") $offset = 0;
			else $offset *= 10;
			// echo $offset;
			$this->index($offset, true);

		}

		function index($offset=0, $only_complete = false)
		{
			$data = fill_ads_data();
			
			// $this->db = $this->load->database(DB_SETTING, true);
			$data['page'] = 'index';
			//$data['keyword'] = '';
			$sess_data = $this->session->all_userdata();
			
			$data['only_complete'] = $only_complete;
			/*$url = $_SERVER['REQUEST_URI'];
			$url = trim($url,'/').'/';
			$url = explode("/",$url);
			$limit = empty($url[3]) ? 0 : $url[3];*/
			$limit = $this->uri->segment(3);

			if($limit!=""){
				$limit *=10;
				if($limit >=10){
					$limit -= 10;
				}
			}else $limit = 0;
			
			$list_seatizen = $this->seatizen_model->seatizen_list();
			$complete_resume = array();
			$zz=0;
			$this->load->model('profile_resume_model');
			foreach ($list_seatizen as $key => $seatizen) {
				$crl = $this->profile_resume_model->cek_lengkap_resume($seatizen['pelaut_id']);
				if($crl['result']){
					$complete_resume[$zz++] = $list_seatizen[$key];
				}
			}
			// echo "<pre>";
			// print_r($complete_resume);
			
			$seatiz = $this->seatizen_model->list_seatizen(true,$limit);
			$data['total_seatiz'] = count($seatiz);
			
			// $data['total_seatiz'] = count($seatiz);

			if($only_complete){
				//inisialisasi ulang untuk seatiz
				$seatiz = array();
				$xx=0;
				// echo $offset;
				if($offset == 0) {
					$batas_bawah = 0;
					$batas_atas = $batas_bawah+10;
				}
				else {
					$batas_bawah = ($offset-10);
					$batas_atas = $offset;
				}
				// echo "$batas_bawah - $batas_atas";
				// $batas_atas = ($offset+10);
				for ($i=$batas_bawah; $i < $batas_atas; $i++) { 
					$seatiz[$xx++] = $complete_resume[$i];
				}
			$data['total_seatiz'] = count($complete_resume);

			}

			// print_r($complete_resume);
			// echo "</pre>";
			
			

			if(empty($sess_data["userdata"])){
				/* tanpa login */
					
			} else {
				
				/* login */
				$username = $this->session->userdata('username');
				$data['seatizen'] = $this->seatizen_model->list_seatizen_notfriend($username);
				$data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
				
				$data["pelaut"] = $this->user_model->get_detail_pelaut_byid($sess_data["id_user"]);
            	$data["rank_pelaut"] = $this->rank_model->get_rank_bydept(@$data["pelaut"]["department"]);
				
					
			}
			
			
			
			$data['seatizen'] = $this->seatizen_model->list_seatizen(false,$limit);
			if($only_complete) $data['seatizen'] = $seatiz;
			
			// echo "<pre>";
			// print_r($data['seatizen']);
			// echo "</pre>";

			// untuk keperluan complete resume list
			$data["seatizen_all"] = $this->seatizen_model->seatizen_list();
			
			
			
			run_tracker("seatizen");
			
			
			
			$this->directPage($data);
			
		}
		
		protected function directPage($data = ''){
			
			$data['keyword'] = "informasea seatizen";
			$data['title'] = "Seatizen";
			$data['template'] = "template";
			
			/*begin pagination */
			$this->load->library('pagination');
			$paging_page = "seatizen/".$data['page'];
			if($data['only_complete']) $paging_page = "seatizen/complete/resume";
			$config['base_url'] = base_url($paging_page);
			$config['total_rows'] = $data['total_seatiz'];
			$config['per_page'] = 10;
			 
			 $config['use_rsegment'] = TRUE;
			 // $config['uri_segment'] = 4;
			 // $config["cur_page"] = 2;
			 $config["use_page_numbers"] = true;
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
			
			if($data['only_complete']){
				// echo "saya complete resume";
				$data['pagination'] = $this->generate_manual_pagination($config);
			}
			else {
				$data['pagination'] = $this->pagination->create_links();
				// echo "saya seatizen biasa";

			}

			// echo $data['pagination'];
			/*end*/
			
       	 	$data['ship_type'] = $this->vacantsea_model->call_ship_type();
       	    $data['department'] = $this->vacantsea_model->call_department();
		  $data['rank'] = $this->vacantsea_model->call_rank();
		  $data['coc'] = $this->vacantsea_model->call_coc();
		  
		  $username = $this->session->userdata('username');
		  $data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
		  
		  //exit("why ?");
		  
		  //print_r($data);
		  //error_reporting(E_ALL); 
		  //$this->load->view('faq',$data);
		  $this->load->view('index',$data);
		}

		function generate_manual_pagination($config)
		{
			$paging = "
				<ul>";
				$page_active = $this->uri->segment(4) == "" ? 1 : $this->uri->segment(4);
				$next_page = $page_active+1;
				$prev_page = $page_active-1;

				if($page_active > 1){
					$paging .= "<li><a href='".base_url("seatizen/complete/resume/")."'>First</a></li>";
					$paging .= "<li><a href='".base_url("seatizen/complete/resume/$prev_page")."'>Previous</a></li>";
				}
				
				for ($x=1; $x <= ceil($config['total_rows']/$config['per_page']); $x++) { 
					$active = "";
					if($page_active == $x) $active = "class='active'";
					$paging .= "<li $active><a href='".base_url("seatizen/complete/resume/$x")."'>$x</a></li>";
				}
				// echo "$page_active : $x";
				$x-=1;
				if($page_active < $x){
					
					$paging .= "<li><a href='".base_url("seatizen/complete/resume/$next_page")."'>Next</a></li>";
					$paging .= "<li><a href='".base_url("seatizen/complete/resume/$x")."'>Last</a></li>";
				}
				$paging .= "</ul>
				";
				return $paging;
		}
		
		
		function profile()
		{
			$data['title'] = "seatizen";
			$data['template'] = "seaman/profile/template";
			$this->load->view('index',$data);
		}
		
		
		function seatizen_list()
		{	
			if($this->input->post('x') != 1)
			{
			header("location:".base_url());
			}
			$data['seatizen'] = $this->seatizen_model->list_seatizen_lim();	
			$this->load->view('seatizen_list',$data);
			
				
		}
		
		function get_seatizen_list_plus()
		{			
			//echo "oooiii";
			$data['seatizen_plus'] = $this->seatizen_model->list_seatizen_lim_plus();
			$data['uri'] = $this->input->post('uri'); 
			
			$this->load->view('seatizen_list_plus',$data); 
			
		}


		function testsearch(){

			$a = $this->uri->uri_string;
			$b = explode("/",$a);

			$url1 = $b[2];
			$url2 = $b[3];
			$url3 = $b[4];
			echo $url3;
			$url4 = $b[5];

			$get_ship = $this->ship_model->get_detail_ship_type_by_name($url1);
			$ship = $get_ship['ship_type'];
			//url 1 
			$get_dept =$this->department_model->get_detail_department_by_name($url1);
			$deptx = $get_dept['department'];
			if($ship){

					echo "url 1 adalah ship $ship <Br>";
					if($url2 != ""){

					$get_dept = $this->department_model->get_detail_department_by_name($url2);
					$dept = $get_dept['department'];



					if($dept){
						echo "url 2 adalah dept  $dept <br />";
						$get_rank = $this->rank_model->get_rank_detail_by_rank($url3);
						$rank = $get_rank['rank'];
							if($rank){
							echo "url 3 adalah rank <br />";
							$get_coc = $this->coc_model->get_coc_by_name($url4);
							$coc = $get_coc['coc_class'];

							if($coc){

								echo "test";
							}

						}

					}
				}

			} else if($deptx){
				echo "url  1 adalah department ";
			}

		}

		function search(){


			$this->search_process();
		}


		function search_dashboard(){
		//search dari page dashboard
			//komponen pencarian :
			//1.vessel type
			//2. department
			//3 . nationality

			$this->search_process("search_dashboard",true);
		}

		function search_process($from = "search",$from_dashboard = false){
			
			$url = $from;
			$segment1 = $this->uri->segment(3); //nationality
			$segment2 = $this->uri->segment(6); //keyword
			$segment5 = $this->uri->segment(4); //ship
			$segment3 = $this->uri->segment(5); //department
			$segment4 = $this->uri->segment(7); //pagination

			$offset = 0;

			 if($from_dashboard) {
//            	
			
			 	$vessel_type = $this->input->get('vessel_type',true);
			 	$department = $this->input->get('department',true);
			 	$nationality = $this->input->get('nationality',true);
 				
			 	$vessel_type = str_replace('-',' ',$vessel_type);
			 	$department = str_replace('-',' ', $department);
			 	$nationality = str_replace('-',' ',$nationality);

			 	
	
			 	
				// $vessel_type = preg_replace("'",' ',$vessel_type);
				// $department = preg_replace("'",' ', $department);

				// echo "<div style='display:none;'>";
			 // 	echo "Vessel type :".$vessel_type."<br>";
			 // 	echo "Department :".$department."<br>";
			 // 	echo "nationality :".$nationality."<br>";
			 // 	echo "</div>";
				

			$data_vessel = $this->vessel_model->detail_ship_by_name($vessel_type);
			$data_dept = $this->department_model->get_detail_department_by_name($department);
			$data_nationality = $this->nation_model->get_detail_nationality($nationality);
    
	        	$keyword = $this->uri->segment(3);

	        $v1 = empty($data_vessel) ? false : true;
	        $v2 = empty($data_dept) ? false : true;
	        $v3 = empty($data_nationality) ? false : true;

            $semua_terisi = $v1 && $v2 && $v3;
            $vessel_dan_department = $v1 && $v2 && !$v3;
            $vessel_dan_nationality = $v1 && !$v2 && $v3;
            $department_dan_nationality = !$v1 && $v2 && $v3;
            $hanya_nationality = !$v1 && !$v2 && $v3;
            $hanya_department = !$v1 && $v2 && !$v3;
            $hanya_vessel = $v1 && !$v2 && !$v3;

            	if($semua_terisi){
            		//echo "<br> <b> Semua Terisi uy </b> <br>";
            		if(!empty($keyword)){
            			$url .= "/$keyword/?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]&nationality=$data_nationality[name]";
            		} else{
            			$url .= "?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]&nationality=$data_nationality[name]";
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

            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],$data_dept['department_id'],$data_nationality['name'],false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],$data_dept['department_id'],$data_nationality['id'],true,$offset));
            	} else if($vessel_dan_department){
					echo "vessel dan department";

					if(!empty($keyword)){
						$url .= "/$keyword/?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]";
					} else{
						$url .= "?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]";
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

            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],$data_dept['department_id'],'',false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],$data_dept['department_id'],'',true,$offset));
            	} else if($vessel_dan_nationality){
          		//  		echo "vessel dan nationality";
            		if(!empty($keyword)){
            			$url .= "/$keyword/?vessel_type=$data_vessel[ship_type]&nationality=$data_nationality[name]";
            		} else{
            			$url .= "?vessel_type=$data_vessel[ship_type]&nationality=$data_nationality[name]";
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



            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],0,$data_nationality['name'],false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],0,$data_nationality['name'],true,$offset));
            	}else if($department_dan_nationality){
            	//	echo "Department dan nationality";

            		if(!empty($keyword)){
            			$url .= "/$keyword/?department=$data_dept[department]&nationality=$data_nationality[name]";
            		} else{
            			$url .= "?department=$data_dept[department]&nationality=$data_nationality[name]";
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

            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,0,$data_dept['department_id'],$data_nationality['name'],false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,0,$data_dept['department_id'],$data_nationality['name'],true,$offset));
            	}else if($hanya_nationality){
            	//		echo "hanya nationality";
            		if(!empty($keyword)){
            			$url .= "/$keyword/?nationality=$data_nationality[name]";
            		}else{
            			$url .= "?nationality=$data_nationality[name]";
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


            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,0,0,$data_nationality['name'],false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,0,0,$data_nationality['name'],true,$offset));
            	}else if($hanya_department){
            	//	echo "hanya department";

            		if(!empty($keyword)){
            			$url .= "/$keyword/?department=$data_dept[department]";
            		} else{
            			$url .= "?department=$data_dept[department]";
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

            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,0,$data_dept['department_id'],'',false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,0,$data_dept['department_id'],'',true,$offset));

            	}else if($hanya_vessel){
            	//	echo "hanya vessel";
            		if(!empty($keyword)){
            			$url .= "/$keyword/?vessel_type=$data_vessel[ship_type]";
            		}else{
            			$url .= "?vessel_type=$data_vessel[ship_type]";
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

            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],0,'',false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,$data_vessel['type_id'],0,'',true,$offset));
            	}else{
            		//echo "Just keyword";
            		if(!empty($keyword)){
            			$url .= "/$keyword?";

            		}else{
            			$url .= "?";
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

            		$seatizen = $this->seatizen_model->getSearchSeatizenDashboard($keyword,0,0,0,false,$offset);
            		$total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($keyword,0,0,0,true,$offset));
            	}
            
              }

			 else{
			 	//pencarian search
				$nationality = $this->input->get('nationality',true);
				$ship = $this->input->get('ship',true);
				$department = $this->input->get('department',true);
				$rank = $this->input->get('rank',true);
				$coc = $this->input->get('coc_class',true);
				$keyword = @$this->uri->segment(3);

				$nationality = str_replace('-',' ',$nationality);
				// $nationality = preg_replace("'","",$nationality);
				// echo $nationality;
				$ship = str_replace('-', ' ', $ship);
				$department = str_replace('-',' ', $department);
				$rank = str_replace('-', ' ' , $rank);
				$coc = str_replace('-', ' ', $coc);
				
				$nationality = preg_replace("/[^a-zA-Z0-9]/"," ",$nationality);
				$ship = preg_replace("/[^a-zA-Z0-9]/", " ", $ship);
				$department = preg_replace("/[^a-zA-Z0-9]/", " ", $department);
				$rank = preg_replace("/[^a-zA-Z0-9]/", " ", $rank);
				$coc = preg_replace("/[^a-zA-Z0-9]/", " ", $coc);
				
				$this->load->library('form_validation');

				$this->form_validation->set_rules('department','Department','xss_clean');
				$this->form_validation->set_rules('nationality','Nationality','xss_clean');
				$this->form_validation->set_rules('ship','Ship','xss_clean');
				$this->form_validation->set_rules('rank','Rank','xss_clean');
				$this->form_validation->set_rules('coc','Coc','xss_clean');
				

				$data_nationality = $this->nation_model->get_detail_nationality($nationality);
				$data_dept = $this->department_model->get_detail_department_by_name($department);
 				$data_ship = $this->ship_model->get_detail_ship_type_by_name($ship);
 				$data_rank = $this->rank_model->get_rank_detail_by_rank($rank);
 				$data_coc = $this->coc_model->get_detail_coc_by_name($coc);
 				

				$v1 = empty($data_nationality) ? false : true;
				$v2 = empty($data_ship) ? false : true;
				$v3 = empty($data_dept) ? false: true;
				$v4 = empty($data_rank) ? false : true;
				$v5 = empty($data_coc) ? false : true;

				$semua_terisi = $v1 && $v2 && $v3 && $v4 && $v5; //nation/ship/department/rank/coc
				$semua_tanpa_coc = $v1 && $v2 && $v3 && $v4 && !$v5; //nation/ship/department/rank
				$semua_tanpa_rank = $v1 && $v2 && $v3 && !$v4 && $v5; //nation/ship/department/coc
				$tanpa_rank_coc = $v1 && $v2 && $v3 && !$v4 && !$v5; //nation/ship/department
				$tanpa_department = $v1 && $v2 && !$v3 && !$v4 && !$v5;  //nation/ship
				$tanpa_ship = $v1 && !$v2 && $v3 && $v4 && $v5; //nation/department/rank/coc
				$tanpa_ship_coc = $v1 && !$v2 && $v3 && $v4 && !$v5; //nation/department/rank
				$tanpa_ship_rank = $v1 && !$v2 && $v3 && !$v4 && $v5; //nation/department/coc
				$tanpa_ship_rank_coc = $v1 && !$v2 && $v3 && !$v4 && !$v5; //nation/department
				$tanpa_nation = !$v1 && $v2 && $v3 && $v4 && $v5; //ship/department/rank/coc
				$tanpa_nation_coc = !$v1 && $v2 && $v3 && $v4 && !$v5; //ship/department/rank
				$tanpa_nation_rank = !$v1 && $v2 && $v3 && !$v4 && $v5; //ship/department/coc
				$tanpa_nation_rank_coc = !$v1 && $v2 && $v3 && !$v4 && !$v5; //ship_department
				$just_nation = $v1 && !$v2 && !$v3 && !$v4 && !$v5; //nation
				$just_ship = !$v1 && $v2 && !$v3 && !$v4 && !$v5; //ship
				$just_department = !$v1 && !$v2 && $v3 && !$v4 && !$v5; //department
				$department_full = !$v1 && !$v2 && $v3 && $v4 && $v5; //department/rank/coc
				$department_rank = !$v1 && !$v2 && $v3 && $v4 && !$v5; //department/rank
				$department_coc = !$v1 && !$v2 && $v3 && !$v4 && $v5; //department/coc
				$just_rank = !$v1 && !$v2 && !$v3 && $v4 && !$v5;


				if($semua_terisi){
					

					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&data_dept[department]&data_rank[rank]&data_coc[coc_class]";
						$data['search_data'] = array(
							'nationality' => $data_nationality['id'],
							'ship' => $data_ship['type_id'],
							'department' => $data_dept['department_id'],
							'rank' => $data_rank['rank_id'],
							'coc' => $data_coc['id_coc_class'],
							'keyword' => $keyword);


					}else{
						$url .= "?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&data_dept[department]&data_rank[rank]&data_coc[coc_class]";
							$data['search_data'] = array(
							'nationality' => $data_nationality['id'],
							'ship' => $data_ship['type_id'],
							'department' => $data_dept['department_id'],
							'rank' => $data_rank['rank_id'],
							'coc' => $data_coc['id_coc_class']);

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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
				}else if($semua_tanpa_coc){
					echo "Semua tanpa coc";

					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&department=$data_dept[department]&rank=$data_rank[rank]";
					} else{
						$url .= "?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&department=$data_dept[department]&rank=$data_rank[rank]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset));

				} else if($semua_tanpa_rank){
				//echo "semua tanpa rank";

				if(!empty($keyword)){
					$url .= "/$keyword?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&department=$data_dept[department]&coc_class=$data_coc[coc_class]";
				} else{
					$url .= "?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&department=$data_dept[department]&coc_class=$data_coc[coc_class]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));

				} else if($tanpa_rank_coc){
					//echo "tanpa rank coc";

					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&department=$data_dept[department]";

					}else{
						$url .= "?nationality=$data_nationality[name]&ship=$data_ship[ship_type]&department=$data_dept[department]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],$data_dept['department_id'],0,0,true,$offset));


				} else if($tanpa_department){
					//echo "tanpa department";

					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&ship=$data_ship[ship_type]";
					}else{
						$url .= "?nationality=$data_nationality[name]&ship=$data_ship[ship_type]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],0,0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],$data_ship['type_id'],0,0,0,true,$offset));
				} else if($tanpa_ship){
					//echo "tanpa ship";


					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&department=$data_dept[department]&rank=$data_rank[rank]&coc_class=$data_coc[coc_class]";
					} else{
						$url .= "?nationality=$data_nationality[name]&department=$data_dept[department]&rank=$data_rank[rank]&coc_class=$data_coc[coc_class]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
				} else if ($tanpa_ship_coc){
					//echo "tanpa ship coc";

					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&department=$data_dept[department]&rank=$data_rank[rank]";
					}else{
						$url .= "?nationality=$data_nationality[name]&department=$data_dept[department]&rank=$data_rank[rank]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));

				} else if($tanpa_ship_rank){
					//echo "tanpa ship rank";

					if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&department=$data_dept[department]&coc_class=$data_coc[coc_class]";
					} else{
						$url .= "?nationality=$data_nationality[name]&department=$data_dept[department]&coc_class=$data_coc[coc_class]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));

				} else if($tanpa_ship_rank_coc){
					//echo "tanpa ship rank coc";

						if(!empty($keyword)){
						$url .= "/$keyword?nationality=$data_nationality[name]&department=$data_dept[department]";
					} else{
						$url .= "?nationality=$data_nationality[name]&department=$data_dept[department]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,$data_dept['department_id'],0,0,true,$offset));

				} else if($tanpa_nation){
					//echo "tanpa nation";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));

				} else if($tanpa_nation_coc){
				//echo "tanpa nation coc";

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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));

				} else if($tanpa_nation_rank){
				//echo "tanpa nation rank";
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
					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));

				} else if($tanpa_nation_rank_coc){
				//echo "tanpa nation rank coc";

				$url .= "/$keyword?ship=$data_ship[ship_type]&department=$data_dept[department]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],$data_dept['department_id'],0,0,false,$offset));


				} else if($just_nation){
				//echo "just nation";
					if(!empty($keyword)){

					$url .= "/$keyword?nationality=$data_nationality[name]";

					$data['search_data'] = array(
						'nationality' => $data_nationality['name'],
						'keyword' => $keyword);


				}else{
					$url .= "?nationality=$data_nationality[name]";
					$data['search_data'] = array(
						'nationality' => $data_nationality['name']);
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,0,0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,$data_nationality['name'],0,0,0,0,true,$offset));

				}else if($just_ship){
					//echo "Just Ship";
					if(!empty($keyword)){

					$url .= "/$keyword?ship=$data_ship[ship_type]";
				}else{
					$url .= "?ship=$data_ship[ship_type]";
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


					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],0,0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',$data_ship['type_id'],0,0,0,true,$offset));

				}else if($just_department){
					//echo "Just department";

					if(!empty($keyword)){
					$url.= "/$keyword?department=$data_dept[department]";
					} else{
						$url .= "?department=$data_dept[department]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],0,0,true,$offset));

				} else if($department_full){
					//echo "department full";

					if(!empty($department_full)){
						$url .= "/$keyword?department=$data_dept[department]&rank=$data_rank[rank]&coc_class=$data_coc[coc_class]";
					}else{

						$url .= "?department=$data_dept[department]&rank=$data_rank[rank]&coc_class=$data_coc[coc_class]";
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


					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));

				} else if($department_rank){
					//echo "department rank";
					if(!empty($department_rank)){
					$url .= "/$keyword?department=$data_dept[department]&rank=$data_rank[rank]";
					} else {
							$url .= "?department=$data_dept[department]&rank=$data_rank[rank]";
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


					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));

				} else if($department_coc){
				//echo "department coc";

				if(!empty($department_coc)){
					$url .= "/$keyword?department=$data_dept[department]&coc_class=$data_coc[coc_class]";
					} else {
							$url .= "?department=$data_dept[department]&coc_class=$data_coc[coc_class]";
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



					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',0,$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));

				} else if($just_rank){
					//echo "Hanya Rank";

					if(!empty($keyword)){
					$url .= "/$keyword?rank=$data_rank[rank]";
					} else {
							$url .= "?rank=$data_rank[rank]";
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

					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',0,0,$data_rank['rank_id'],0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',0,0,$data_rank['rank_id'],0,true,$offset));


				}


				else{
					//echo "search keyword";
					if(!empty($keyword)){

					$url .= "/$keyword?";
					
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
					$seatizen = $this->seatizen_model->seatizenSearch($keyword,'',0,0,0,0,false,$offset);
					$total_seatiz = count($this->seatizen_model->seatizenSearch($keyword,'',0,0,0,0,true,$offset));


				}
		

			}

			run_tracker("search");
			$data['seatizen'] = $seatizen;
			$data['total_seatiz'] = $total_seatiz;
			$data['page'] = $url;

			$data['keyword'] = "informasea seatizen";
			$data['title'] = "Seatizen";
			$data['template'] = "template";
			
			/*begin pagination */
			$this->load->library('pagination');
			$config['base_url'] = base_url("seatizen/".$data['page']);
			$config['total_rows'] = $data['total_seatiz'];
			$config['first_url'] = base_url("seatizen/".$data['page']."&page=1"); 
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
			/*end*/
			
		    $data['ship_type'] = $this->vacantsea_model->call_ship_type();
		    $data['department'] = $this->vacantsea_model->call_department();
		    $data['rank'] = $this->vacantsea_model->call_rank();
		    $data['coc'] = $this->vacantsea_model->call_coc();
		  
		    $username = $this->session->userdata('username');
		    $data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
  
		    //$this->directPage($data);
		    $this->load->view('index',$data);
		}
		
	}

?>