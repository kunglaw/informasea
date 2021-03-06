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
		
		function getData(){
			
			$id_dept = $this->input->post('id_dept');
			$id_rank = $this->input->post('id_rank');
			$keyword = $this->input->post('keyword');
			$id_ship = $this->input->post('id_ship');
			$id_coc = $this->input->post('id_coc');
		
		$data_dept = !empty($id_dept) ? $this->department_model->get_detail_department($id_dept):"";
		$data_rank = !empty($id_rank) ? $this->rank_model->get_rank_detail($id_rank):"";
		$data_ship = !empty($id_ship) ? $this->ship_model->get_ships_type($id_ship):"";
		$data_coc = !empty($id_coc) ? $this->coc_model->get_coc_detail($id_coc):"";
		echo $data_ship['ship_type']."&".$data_dept['department']."&".$data_rank['rank']."&".$data_coc['coc_class'];

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
	
		function list_coc(){
        $id_dept = $this->input->post("id_department");
		$data['coc_class'] = $this->coc_model->get_coc_bydept($id_dept);
		$this->load->view("list_coc",$data);		
		}
		
		function add_friend(){
					
			
		
		}
		
		
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
				
			}
			$data["pelaut"] = $this->user_model->get_detail_pelaut_byid($sess_data["id_user"]);
            $data["rank_pelaut"] = $this->rank_model->get_rank_bydept($data["pelaut"]["department"]);
			$data['seatizen'] = $this->seatizen_model->list_seatizen(false,$limit);
			$data['total_seatizen'] = $this->seatizen_model->record_seatizen();
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
			$config['num_tag_open'] = "<a class=\"text-gray\">";
			$config['num_tag_close'] = "</a> &nbsp;&nbsp;";
			$config['cur_tag_open'] = "<a class='text-link disabled'><b>";
			$config['cur_tag_close'] = "</b></a>&nbsp;&nbsp;";
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = "<a class='text-link'>";
			$config['next_tag_close'] = "</a>&nbsp;&nbsp;";
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = "<a class='text-link'>";
			$config['prev_tag_close'] = "</a>&nbsp;";
			$config['last_link'] = 'Last &gt;';
			$config['last_tag_open'] = "<a class='text-link'>";
			$config['last_tag_close'] = "</a>&nbsp;";
			$config['first_link'] = '&lt; First';
			$config['first_tag_open'] = "<a class='text-link'>";
			$config['first_tag_close'] = "</a>&nbsp;";

			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			/*end*/
			
        $data['ship_type'] = $this->vacantsea_model->call_ship_type();
        $data['department'] = $this->vacantsea_model->call_department();
        $data['rank'] = $this->vacantsea_model->call_rank();
        $data['coc'] = $this->vacantsea_model->call_coc();
		
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
		
		function search(){
			$url = "search";
			$segment1 = $this->uri->segment(3); /*ship */
			$segment2 = $this->uri->segment(4); /*dept */
			$segment3 = $this->uri->segment(5); /* rank */
			$segment4 = $this->uri->segment(6); /* coc */
			$segment5 = $this->uri->segment(7); /* keyword */
			$segment6 = $this->uri->segment(8); /* index pagination */
			
			
			$v3 = false; $v4 = false;
			$segment1 = strpos($segment1, "Security") ? $segment1 : str_replace('-',' ',$segment1);
			$segment2 = str_replace('-',' ',$segment2);
			$segment3 = str_replace('-',' ',$segment3);
			$segment4 = str_replace('-',' ',$segment4);
			$segment5 = str_replace('-',' ',$segment5);
			$segment5 = str_replace('-',' ',$segment5);
			$segment6 = str_replace('-',' ',$segment6);
			
			$data_ship = $this->ship_model->get_detail_ship_type_by_name($segment1);
			$data_dept = $this->department_model->get_detail_department_by_name($segment2);
			$data_rank = $this->rank_model->get_rank_detail_by_rank($segment3);
			$data_coc = $this->coc_model->get_coc_by_name($segment4);
			
			$v1 = empty($data_ship) ? false : true;
			$v2 = empty($data_dept) ? false : true;
			if($v2) {
			$v3 = empty($data_rank) ? false : true;
			$v4 = empty($data_coc) ? false : true;
			}
			
			if(empty($segment5)) $segment5 = "";
			
			$offset = 0;
			 	if($v1 AND $v2 AND $v3 AND $v4) {
				$url .= "/$segment1/$segment2/$segment3/$segment4/";
				if(is_numeric($segment5)){
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'department' => $data_dept['department_id'],
					'rank' => $data_rank['rank_id'],
					'coc' => $data_coc['id_coc_class']
					);
					$offset = empty($segment5) ? 0 : $segment5;
				} 
				else {
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'department' => $data_dept['department_id'],
					'rank' => $data_rank['rank_id'],
					'coc' => $data_coc['id_coc_class'],
					'keyword' => $segment5
					);
					$offset = empty($segment6) ? 0 : $segment6;
					$url .= $segment5;
				}
				
				$data['seatizen'] = $this->seatizen_model->searchSeatizen($segment5,$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],false,$offset);
				$data['total_seatiz'] = count($this->seatizen_model->searchSeatizen($segment5,$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],$data_coc['id_coc_class'],true,$offset));
				
			} else if ($v1 && !$v2){
				$url .= "/$segment1/";
				
				if(is_numeric($segment2)){
					$offset = empty($segment2) ? 0 : $segment2;
					$data['search_data'] = array(
					'ship' => $data_ship['type_id']
					);
					
				} else {
					$offset = empty($segment3) ? 0 : $segment3;
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'keyword' => $segment2
					);
					$url.=$segment2;
				}
				$data['seatizen'] = $this->seatizen_model->searchSeatizen($segment2,$data_ship['type_id'],0,0,0,false,$offset);
				$data['total_seatiz'] = count($this->seatizen_model->searchSeatizen($segment2,$data_ship['type_id'],0,0,0,true,$offset));
			
				
			} else if($v1 && $v2 && !$v3 && $v4) {
				$url .="/$segment1/$segment2/$segment3/";
				
				if(is_numeric($segment4)) {
					$offset = empty($segment4) ? 0 : $segment4;
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'department' => $data_dept['department_id'],
					'coc' => $data_coc['id_coc_class']					
					);
				} else {
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'department' => $data_dept['department_id'],
					'coc' => $data_coc['id_coc_class'],
					'keyword' => $segment4
					);
					$url .= $segment4;
				}
				$data['seatizen'] = $this->seatizen_model->searchSeatizen($segment4,$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],false,$offset);
				$data['total_seatiz'] = count($this->seatizen_model->searchSeatizen($segment4,$data_ship['type_id'],$data_dept['department_id'],0,$data_coc['id_coc_class'],true,$offset));
				
				
				
			} else if($v1 && $v2 && $v3 && !$v4) {
				$url .="/$segment1/$segment2/$segment3/";
				
				if(is_numeric($segment4)) {
					$offset = empty($segment4) ? 0 : $segment4;
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'department' => $data_dept['department_id'],
					'rank' => $data_rank['rank_id']
					);
					
				} else {
					$data['search_data'] = array(
					'ship' => $data_ship['type_id'],
					'department' => $data_dept['department_id'],
					'rank' => $data_rank['rank_id'],
					'keyword' => $segment4
					);
						$url .= $segment4;
				}
				
				$data['seatizen'] = $this->seatizen_model->searchSeatizen($segment4,$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,false,$offset);
				$data['total_seatiz'] =count($this->seatizen_model->searchSeatizen($segment4,$data_ship['type_id'],$data_dept['department_id'],$data_rank['rank_id'],0,true,$offset));				
				
				
			} else { 
				$url .= "/$segment1/";
				if(is_numeric($segment2)) {
						$offset = empty($segment2) ? 0 : $segment2;
				}	else {
					$offset = empty($segment3) ? 0 : $segment3;
					$data['search_data'] = array(
					'keyword' => $segment1
					);
					$url .= $segment2;
					
				}
				$data['seatizen'] = $this->seatizen_model->searchSeatizen($segment1,0,0,0,0,false,$offset);
				$data['total_seatiz'] = count($this->seatizen_model->searchSeatizen($segment1,0,0,0,0,true,$offset));
			
			}
			
			$data['page'] = $url;
			$this->directPage($data);
			
				
		}
	}

?>