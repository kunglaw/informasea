<?php
	// controller seatizen, module seatizen;
	
	class Seatizen extends MX_Controller{
		
		function __construct()
		{
			
			parent::__construct();
//			$this->authentification_model->close_access();
			// authentification
			//$this->session->all_userdata(); exit;
			$username = $this->session->userdata('username');
			$id_pelaut = $this->session->userdata("pelaut_id");
			$user = $this->session->userdata("user");
			$this->load->model('seatizen_model'); 
			$this->load->model('department_model');
			$this->load->model('authentification_model');
			$this->load->model('rank_model');
			$this->load->model('vacantsea/vacantsea_model');
			$this->load->model('users/user_model');
			$this->load->model('ship_model');
			$this->load->model('coc_model');
			$this->load->model('nation_model');
			$this->load->model('vessel_model');

			$this->load->helper('tracker_helper');
			$this->load->model('tracker_model');

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
		
		//fungsi add teman
		

		
		
		function index($offset=0)
		{
			$data['page'] = 'index';
			//$data['keyword'] = '';
			$sess_data = $this->session->all_userdata();
		
			$url = $_SERVER['REQUEST_URI'];
			$url = trim($url,'/').'/';
			$url = explode("/",$url);
			$limit = empty($url[3]) ? 0 : $url[3];
			$data['seatizen'] = $this->seatizen_model->list_seatizen();
			$seatiz = $this->seatizen_model->list_seatizen(true,$limit);
			$data['total_seatiz'] = count($seatiz);
		
			if(empty($sess_data)){
				/* tanpa login */
					
			} else {
				/* login */
				$username = $this->session->userdata('username');
				$data['seatizen'] = $this->seatizen_model->list_seatizen_notfriend($username);
				$data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
				
					
			}
			
			$data["pelaut"] = $this->user_model->get_detail_pelaut_byid($sess_data["id_user"]);
            $data["rank_pelaut"] = $this->rank_model->get_rank_bydept($data["pelaut"]["department"]);
			$data['seatizen'] = $this->seatizen_model->list_seatizen(false,$limit);

			run_tracker("seatizen");

			$this->directPage($data);
		}
		
		protected function directPage($data = ''){
			
			$data['keyword'] = "informasea seatizen";
			$data['title'] = "Seatizen";
			$data['template'] = "template";
			
			/*begin pagination */
			$this->load->library('pagination');
			$config['base_url'] = base_url("seatizen/".$data['page']);
			$config['total_rows'] = $data['total_seatiz'];
			$config['per_page'] = 10;
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
			$data['pagination'] = $this->pagination->create_links();
			/*end*/
			
       	 $data['ship_type'] = $this->vacantsea_model->call_ship_type();
       	 $data['department'] = $this->vacantsea_model->call_department();
        $data['rank'] = $this->vacantsea_model->call_rank();
        $data['coc'] = $this->vacantsea_model->call_coc();
		
		$username = $this->session->userdata('username');
		$data['pribadi'] = $this->seatizen_model->detail_seatizen($username);
		
		$this->load->view('index',$data);
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

// function coba_search(){
		
// 		$nation = $this->input->post('nation');
// 		$ship = $this->input->post('ship');
// 		$department = $this->input->post('department');
// 		$rank = $this->input->post('rank');
// 		$coc = $this->input->post('coc');
// 		$keyword = $this->input->post("keyword");
		
// 		if($nation!="") $nation= str_replace(' ','-', $this->nation_model->get_detail_nationality($nation)["name"]);
// 		if($ship!="") $ship = str_replace(' ','-', $this->vessel_model->get_shiptype_byshipid($ship)["ship_type"]);
//         if($department!="") $department = str_replace(' ','-', $this->department_model->get_detail_department($department)["department"]);
//         if($rank!= "") $rank = str_replace(' ','-',$this->rank_model->get_rank_detail_by_rank($rank)['rank']);
// 		if($coc!= "") $coc = str_replace(' ','-',$this->coc_model->get_coc_class($coc)['coc_class']);
		
		
//         $url = "seatizen/search";
		
// 		if($nation != "" && $ship != "" && $department != "" && $rank != "" && $coc != "") $url.="$nation/$ship/$department/$rank/$coc";
// 		else if($nation != "" && $ship != "" && $department != "" && $rank != "" && $coc == "") $url.="$nation/$ship/$department/$rank";
// 		else if($nation != "" && $ship != "" && $department != "" && $rank == "" && $coc == "") $url .="$nation/$ship/$department/$coc";
// 		else if($nation != "" && $ship != "" && $department != "" && $rank == "" && $coc == "") $url .= "$nation/$ship/$department";
// 		else if($nation != "" && $ship != "" && $department == "" && $rank == "" && $coc == "") $url .= "$nation/$ship";
// 		else if($nation != "" && $ship =="" && $department != "" && $rank != "" && $coc != "") $url .= "$nation/$department/$rank/$coc";
// 		else if($nation != "" && $ship =="" && $department != "" && $rank != "" && $coc =="") $url .= "$nation/$department/$rank";
// 		else if($nation != "" && $ship == "" && $department != "" && $rank == "" && $coc =="") $url .="$nation/$department";
// 		else if($nation =="" && $ship != "" && $department != "" && $rank != "" && $coc != "") $url .= "$ship/$department/$rank/$coc";
// 		else if($nation =="" && $ship != "" && $department != "" && $rank != "" && $coc =="") $url .= "$ship/$department/$rank";
// 		else if($nation =="" && $ship != "" && $department != "" && $rank =="" && $coc == "") $url .= "$ship/$department";
// 		else if($nation =="" && $ship =="" && $department != "" && $rank != "" && $coc != "") $url .= "$department/$rank/$coc";
// 		else if($nation =="" && $ship =="" && $department != "" && $rank != "" && $coc =="") $url .= "$department/$rank";
// 		else if($nation =="" && $ship =="" && $department != "" && $rank =="" && $coc=="") $url.= "$department";
// 		else if($nation != "" && $ship == "" && $department == "" && $rank =="" && $coc =="") $url.="$nation";
// 		else if($nation == "" && $ship != "" && $department =="" && $rank =="" && $coc =="") $url.="$ship";
		
		
//         $url .= "/$keyword";
//         echo base_url($url);
// }

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
			$segment2 = $this->uri->segment(4); //ship
			$segment3 = $this->uri->segment(5); //department
			$segment4 = $this->uri->segment(6); //keyword
			$segment5 = $this->uri->segment(7); //pagination

			$offset = 0;

			 if($from_dashboard) {
//            echo "$segment1, $segment2";
            /*Searcing dari Dashboard dimulai di sini*/
            $department = empty($segment2) ? str_replace('-',' ',segment2) : str_replace('-',' ',$segment1);
            $department = strpos($segment2, "Security") ? $segment2 : str_replace('-', ' ', $segment2);
            $department = strpos($segment1, "Security") ? $segment1 : str_replace('-', ' ', $segment1);
            $vessel = str_replace('-',' ', $segment1);
            $nationality = empty($segment3) ? empty($segment2) ? str_replace('-',' ', $segment1) : str_replace('-',' ', $segment2) : str_replace('-',' ', $segment3);

            $data_vessel = $this->vessel_model->get_ship_type_detail_byname($vessel);
            $data_dept = $this->department_model->get_detail_department_by_name($department);
            $data_nationality = $this->nation_model->get_detail_nationality($nationality);

            $v1 = empty($data_vessel) ? false : true;
            $v2 = empty($data_dept) ? false : true;
            $v3 = empty($data_nationality) ? false : true;

//            echo "$v1 & $v2 & $v3";
            $semua_terisi = $v1 && $v2 && $v3;
            $vessel_dan_department = $v1 && $v2 && !$v3;
            $vessel_dan_nationality = $v1 && !$v2 && $v3;
            $department_dan_nationality = !$v1 && $v2 && $v3;
            $hanya_nationality = !$v1 && !$v2 && $v3;
            $hanya_department = !$v1 && $v2 && !$v3;
            $hanya_vessel = $v1 && !$v2 && !$v3;

//            echo "$semua_terisi & $vessel_dan_department & $vessel_dan_nationality & $department_dan_nationality & $hanya_nationality & $hanya_department & $hanya_vessel";

            if ($semua_terisi) {
                /* Semua terpilih */
                $url .= "/$segment1/$segment2/$segment3/";
                if (is_numeric($segment4)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $segment4 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type'],
                        'nationality' => $data_nationality['name'],
                        'keyword' => $segment4
                    );
                    $offset = empty($segment5) ? 0 : $segment5;
                    $url .= $segment4;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment4, $data_vessel["type_id"], $data_dept["department_id"], $data_nationality['name'], false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment4, $data_vessel["type_id"], $data_dept["department_id"], $data_nationality['name'], true, $offset));
            } else if ($vessel_dan_department) {
                /* Vessel dan Department terisi */
                $url .= "/$segment1/$segment2/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type']
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'ship_type' => $data_vessel['ship_type'],
                        'keyword' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $url .= $segment3;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], $data_dept["department_id"],'', false, $offset);
                $total_seatiz= count($this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], $data_dept["department_id"], '', true, $offset));
            } else if ($vessel_dan_nationality) {
                /* Vessel dan Nationality terisi */
                $url .= "/$segment1/$segment2/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name'],
                        'ship_type' => $data_vessel['ship_type'],
                        'keyword' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $url .= $segment3;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], 0, $data_nationality['name'], false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment3, $data_vessel["type_id"], 0, $data_nationality['name'], true, $offset));
            } else if ($department_dan_nationality) {
                /* Department dan Nationality terisi */
                $url .= "/$segment1/$segment2/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name'],
                        'department' => $data_dept['department_id'],
                        'keyword' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $url .= $segment3;
                }
                $seatize = $this->seatizen_model->getSearchSeatizenDashboard($segment3, 0, $data_dept['department_id'], $data_nationality['name'], false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment3, 0, $data_dept['department_id'], $data_nationality['name'], true, $offset));
            } else if ($hanya_nationality) {
                /* Hanya Nationality terisi */
                $url .= "/$segment1/";
                if (is_numeric($segment3)) {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                } else {
                    $data['search_data'] = array(
                        'nationality' => $data_nationality['name'],
                        'keyword' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $url .= $segment2;

                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, 0, $data_nationality['name'], false, $offset);
              
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, 0, $data_nationality['name'], true, $offset));
            } elseif ($hanya_department) {
                /* Hanya Department terisi */
                $url .= "/$segment1/";
                if (is_numeric($segment2)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id']
                    );
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'keyword' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $url .= $segment2;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, $data_dept["department_id"], '', false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment2, 0, $data_dept["department_id"], '', true, $offset));
            } elseif ($hanya_vessel) {
                /* Hanya Vessel terisi */
                $url .= "/$segment1/";
                if (is_numeric($segment2)) {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type']
                    );
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                } else {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type'],
                        'keyword' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $url .= $segment2;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment2, $data_vessel["type_id"],0, '', false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment2, $data_vessel["type_id"],0,'', true, $offset));
            }
            else{
                /* Hanya Keyword */
                $data['search_data'] = array(
                    'keyword' => $segment1
                );
                $url .= "/$segment1/";

                if (is_numeric($segment2)) {
                    $offset = empty($segment2) ? 0 : $segment2;
                }
                $seatizen = $this->seatizen_model->getSearchSeatizenDashboard($segment1, 0,0, '', false, $offset);
                $total_seatiz = count($this->seatizen_model->getSearchSeatizenDashboard($segment1, 0,0,'', true, $offset));
            }
        }

			 else{
			 	//pencarian search
			$segment1 = $this->uri->segment(3);
			$segment2 = $this->uri->segment(4);

						
				$url .= "/$segment1/";
				// if(is_numeric($segment2)) {
				// 		$offset = empty($segment2) ? 0 : $segment2;
				// }	else {
				// 	$offset = empty($segment3) ? 0 : $segment3;
				// 	$data['search_data'] = array(
				// 	'keyword' => $segment1
				// 	);
				// 	$url .= $segment2;
					
				// }

				if(is_numeric($segment2)){
					$offset = empty($segment2) ? 0 : $segment2;
					$data['search_data'] = array(
						'keyword' => $segment1);
					$url .= "/$segment1/";
				}else if(is_numeric($segment1)){
					$offset = empty($segment1) ? 0 : $segment1;
					$segment1 = "";
				} else {
					$data['search_data'] = array(
						'keyword' => $segment1);
					$url .= "/$segment1/";
				}
				$seatizen = $this->seatizen_model->searchSeatizen($segment1,false,$offset);
				$total_seatiz = count($this->seatizen_model->searchSeatizen($segment1,true,$offset));

			}

			run_tracker("search");
			$data['seatizen'] = $seatizen;
        $data['total_seatiz'] = $total_seatiz;
        $data['page'] = $url;
        $this->directPage($data);

		}
		
	}

?>