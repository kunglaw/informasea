
<?php if(!defined('BASEPATH')) exit('No direct script access allowed ');

// controller vacantsea , module vacantsea 

class Vacantsea extends MX_Controller
{
    private $db;
    private $dbadmin;
    function __construct(){

        parent::__construct();
		$this->db = $this->load->database(DB_SETTING, true);
		$this->authentification->underconst_access();
        // authentification
        //$this->session->all_userdata(); exit;
		
		
		//BAHASA
		load_all_language();
		
        $username = $this->session->userdata('username');
        $user = $this->session->userdata("user");
		
        $this->load->helper('tracker_helper');
        $this->load->model('tracker_model');
        $this->load->model('vacantsea_model');
        $this->load->model('department_model');
        $this->load->model('nation_model');
        $this->load->model('vessel_model');
        $this->load->model('authentification_model');
        $this->load->model('rank_model');
        $this->load->model('users/user_model');
		
        $this->load->helper('notification');
		$this->load->helper("link_stuff_helper"); // 
        //second version
        $this->load->model('company/company_model');
    }

    function next_id($keterangan)
    {
        $id_terakhir = $this->input->post("id_terakhir");
        $data['vacantsea'] = $keterangan == "next" ? $this->vacantsea_model->get_vacantsea_panel_plus($id_terakhir) : $this->vacantsea_model->get_vacantsea_panel_minus($id_terakhir);
        $data['vacantsea'] = $keterangan != "next" ? array_reverse($data['vacantsea']): $data['vacantsea'];
        $x=0;
        $id_awal=0;
        foreach($data['vacantsea'] as $row) {
            if($x==0) $id_awal = $row['vacantsea_id'];
            $id_terakhir = $row['vacantsea_id'];
            $x++;
        }
        echo $id_awal."&".$id_terakhir;
    }

    function next_data($keterangan)
    {
        $data['title']	= "Vacantsea";
        $data['template'] = "template";
        $id_terakhir = $this->input->post("id_terakhir");

        $data['vacantsea'] = $keterangan == "next" ? $this->vacantsea_model->get_vacantsea_panel_plus($id_terakhir) : $this->vacantsea_model->get_vacantsea_panel_minus($id_terakhir);
        $data['vacantsea'] = $keterangan != "next" ? array_reverse($data['vacantsea']): $data['vacantsea'];
        $this->load->view("content-item",$data);
    }

    function getData()
    {   
        $this->load->model('ship_model');
        $id_dept = $this->input->post("id_dept");
        $id_rank = $this->input->post("id_rank");
        $id_ship = $this->input->post('id_ship');
        $data_dept = !empty($id_dept) ? $this->department_model->get_detail_department($id_dept):"";
        $data_rank = !empty($id_rank) ? $this->rank_model->get_rank_detail($id_rank):"";

        $data_ship = !empty($id_ship) ? $this->ship_model->get_ships_type($id_ship):"";


        $department = empty($data_dept) ? "":$data_dept['department'];
        $rank = empty($data_rank) ? "":$data_rank['rank'];
        $ship = empty($data_ship) ? "":$data_ship['ship_type'];

        echo $ship."&".$department."&".$rank;
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

        $this->load->model('ship_model');
        $id_shipnya = $this->input->post("idshipnya");
            $data['idshipnya'] = "kosong";
            if($id_shipnya !=0 || $id_shipnya != "") $data['idshipnya'] = $id_shipnya;
        $data['ship_jx'] = $this->ship_model->get_list_ship();
        $this->load->view("list_ship",$data);
    }

    /* Function Search buatan radit */

    function search(){
        /* Search dari Page Vacantsea */
        /** =========================
         * Komponen Pencarian :
         * 1. Department
         * 2. Rank
         * 3. Sallary
         * 4. Keyword
         * */
        $this->search_process();
    }

    function search_dashboard(){
        /* Search dari page dashboard */
        /** ==========================
         * Komponen Pencarian :
         * 1. Vessel (Ship) Type
         * 2. Department
         * 3. Nationality
         * 4. Keyword
         * */
        $this->search_process("search_dashboard",true);
//        echo "<div align='center' style='font-size: 16pt'><b >Coming soon ...</b><hr>Please Wait :)<br>still searching an effective logic for this function<br><a href='".base_url()."'>Back to Home</a></div>";
    }

	function search_process($from="search",$from_dashboard=false)
    {
        $url = $from;
        $segment1 = $this->uri->segment(3); /* Department ID if choosen */
        $segment2 = $this->uri->segment(4); /* Rank ID if choosen */
        $segment3 = $this->uri->segment(5); /* Sallary if choosen */
        $segment4 = $this->uri->segment(6); /* Keyword if not null */
        $segment5 = $this->uri->segment(7); /* Index Pagination */


        $offset = 0;
        if($from_dashboard) {
            $keyword = $this->uri->segment(3);
            $vessel = @$_GET['vessel_type'];
            $department = @$_GET['department'];
            $nationality = @$_GET['nationality'];

            $vessel = str_replace('-',' ',$vessel);
            $department = str_replace('-', ' ', $department);
            $nationality = str_replace('-',' ',$nationality);

            $vessel = preg_replace("'",' ',$vessel);
            $department = preg_replace("'",' ', $department);

            $nationality = preg_replace("'",'', $nationality);

            // echo "<b> Keyword </b> ".$keyword."<br>";
            // echo "<b> Vessel </b> ".$vessel."<br>";
            // echo "<b> Department </b> ".$department."<br>";
            // echo "<b> Nationality </b> ".$nationality."<br>";
           
            $data_vessel 	  = $this->vessel_model->get_ship_type_detail_byname($vessel);
            $data_dept 		= $this->department_model->get_detail_department_by_name($department);
            $data_nationality = $this->nation_model->get_detail_nationality($nationality);

            // echo "Data Vessel : "; print_r($data_vessel);
            // echo "<br> Data Department : "; print_r($data_dept);
            // echo "<br> Data Nationality : "; print_r($data_nationality);
            // echo "<br>";

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
                if(!empty($keyword)){
                    $url .= "/$keyword/?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]&nationality=$data_nationality[name]";
                }else{
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

                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment4, $data_vessel["type_id"], $data_dept['department_id'], $data_nationality['id'], false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment4, $data_vessel["type_id"], $data_dept['department_id'], $data_nationality['id'], true, $offset));
            

            } else if($vessel_dan_department){
                if(!empty($keyword)){
                    $url .= "/$keyword/?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]";
                }else{
                    $url .= "?vessel_type=$data_vessel[ship_type]&department=$data_dept[department]";
                }


                 if(isset($_GET['page'])){

                        $offset = $_GET['page'];
                        if($offset != 0){

                        $offset *= 10;
                        $offset -= 10;
                        //$offset -= 10;
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

                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,$data_vessel['type_id'],$data_dept['department_id'],0,false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,$data_vessel['type_id'],$data_dept['department_id'],0,true,$offset));

            } else if($vessel_dan_nationality){
                if(!empty($keyword)){
                    $url .= "/$keyword/?vessel_type=$data_vessel[ship_type]&nationality=$data_nationality[name]";
                }else{
                    $url .= "?vessel_type=$data_vessel[ship_type]&nationality=$data_nationality[name]";
                }

                 if(isset($_GET['page'])){

                        $offset = $_GET['page'];
                        if($offset != 0){

                        $offset *= 10;
                        $offset -= 10;
                        //$offset -= 10;
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


                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,$data_vessel['type_id'],0,$data_nationality['id'],false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,$data_vessel['type_id'],0,$data_nationality['id'],true,$offset));
            
            } else if($department_dan_nationality){
                if(!empty($keyword)){
                    $url .= "/$keyword/?department=$data_dept[department]&nationality=$data_nationality[name]";
                }else{
                    $url .= "?department=$data_dept[department]&nationality=$data_nationality[name]";
                }

                 if(isset($_GET['page'])){

                        $offset = $_GET['page'];
                        if($offset != 0){

                        $offset *= 10;
                        $offset -= 10;
                        //$offset -= 10;
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



                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,0,$data_dept['department_id'],$data_nationality['id'],false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,0,$data_dept['department_id'],$data_nationality['id'],true,$offset));

            } else if($hanya_vessel){
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
                        //$offset -= 10;
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


                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,$data_vessel['type_id'],0,'',false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,$data_vessel['type_id'],0,'',true,$offset));
            
            } else if($hanya_department){
                if(!empty($keyword)){
                    $url .= "/$keyword/?department=$data_dept[department]";
                } else {
                    $url .= "?department=$data_dept[department]";
                }

                 if(isset($_GET['page'])){

                        $offset = $_GET['page'];
                        if($offset != 0){

                        $offset *= 10;
                        $offset -= 10;
                        //$offset -= 10;
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


                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,0,$data_dept['department_id'],'',false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,0,$data_dept['department_id'],'',true,$offset));  
            
            } else if($hanya_nationality){
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

                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,0,0,$data_nationality['id'],false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,0,0,$data_nationality['id'],true,$offset));  
            }else{
                if(!empty($keyword)){
                    $url .= "/$keyword/?";
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

                $keyword =  str_replace('%20',' ',$keyword);

                $vacant = $this->vacantsea_model->getSearchVacantDashboard($keyword,0,0,0,false,$offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($keyword,0,0,0,true,$offset));

            }


            $data['vacantsea'] = $vacant;
            $data['total_vacant'] = $tvacant;
            $data['page'] = $url;
            $this->load->library('pagination');
            $config['base_url'] = base_url("vacantsea/".$data['page']);
            $config['total_rows'] = $data['total_vacant'];
            $config['per_page'] = 10;
            $config["use_page_numbers"] = true;
            $config['page_query_string'] = true;
            $config['first_tag_open']   = "<li>";
            $config['first_link']       = "First";
            $config['first_url'] = base_url("vacantsea/".$data['page']."&page=1"); 
            $config['first_tag_close']  = "</li>";
            $config['prev_link']        = "Prev";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['cur_tag_open']     = "<li class='active'><a href>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_link']        = "Next";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['num_tag_open']     = "<li>";
            $config['num_tag_close']    =    "</li>";  
            $config['query_string_segment'] = "page";
            $config['last_tag_open']    = "<li>";
            $config['last_link']        = "Last";
            $config['last_tag_close']   = "</li>";
             

            $data['dt_js_under'] = "vacantsea/js_under";
            $data['keyword']  = "informasea, vacantsea, informasea vacantsea";
            $data['title']  	= "Vacantsea";
            $data['template'] = "template";
            $this->pagination->initialize($config);
            
			$data['pagination']=$this->pagination->create_links();
            $data['ship_type'] = $this->vacantsea_model->call_ship_type();
            $data['department'] = $this->vacantsea_model->call_department();
            $data['rank'] = $this->vacantsea_model->call_rank();
            $data['coc'] = $this->vacantsea_model->call_coc();
            $this->load->view('index',$data);

//           
        }
        else {
            /* Searching dari page vacantsea di muali di sini */
          
       $this->load->model('ship_model');
                $vessel_type = @$_GET['vessel_type'];
               // echo $vessel_type;

             $department = @$_GET['department'];
             $rank = @$_GET['rank'];
             //$sallary = @$_GET['sallary'];
             $keyword = $this->uri->segment(3);
            
            
                // if($sallary == "more-than-10000000"){
                //     $sallary_query = "10000000-500000000";
                // } else if($sallary == "less-than-1000000"){
                //     $sallary_query = "0-1000000";
                // }


             $vessel_type = str_replace('-',' ',$vessel_type);
             $department = str_replace('-',' ',$department);
             $rank = str_replace('-',' ',$rank);

             $data_ship = $this->ship_model->get_detail_ship_type_by_name($vessel_type);
             $data_dept = $this->department_model->get_detail_department_by_name($department);
             $data_rank = $this->rank_model->get_rank_detail_by_rank($rank);
             //$sallary = $sallary;

             $v1 = empty($data_ship) ? false : true;
             $v2 = empty($data_dept) ? false : true;
             $v3 = empty($data_rank) ? false : true;
            // $v3 = empty($sallary) ? false : true;

            if ($v1 && $v2 && $v3) {
               
                /* /vessel /  department   /rank  / */

                if(!empty($keyword)){
                    $url .= "/$keyword?vessel_type=$data_ship[ship_type]&department=$data_dept[department]&rank=$data_rank[rank]";
                } else{
                    $url .= "?vessel_type=$data_ship[ship_type]&department=$data_dept[department]&rank=$data_rank[rank]";
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

                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantnew($keyword, $data_ship['type_id'],$data_dept["department_id"], $data_rank["rank_id"], false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantnew($keyword, $data_ship['type_id'],$data_dept["department_id"], $data_rank["rank_id"], true, $offset));
            } else if ($v1 && $v2) {
                    //        echo "tanpa rank <hr>";
                /* /Department/  rank  / */
                if(!empty($keyword)){
                    $url .= "/$keyword?vessel_type=$data_ship[ship_type]&department=$data_dept[department]";
                } else {
                    $url .= "?vessel_type=$data_ship[ship_type]&department=$data_dept[department]";
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

                $vacant = $this->vacantsea_model->getSearchVacantnew($keyword,$data_ship['type_id'], $data_dept["department_id"], 0, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantnew($keyword, $data_ship['type_id'],$data_dept["department_id"], 0, true, $offset));
            }else if ($v2 && $v3) {
                //echo "tanpa rank $segment2 <hr>";
                /* /Department/  sallary  / */
                  if(!empty($keyword)){
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

                $vacant = $this->vacantsea_model->getSearchVacantnew($keyword,0, $data_dept["department_id"], $data_rank['rank_id'], false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantnew($keyword,0, $data_dept["department_id"], $data_rank['rank_id'], true, $offset));
            }else if ($v2) {
                //echo "hanya department <hr>";
                /*/ department / */
                if(!empty($keyword)){
                    $url .="/$keyword?department=$data_dept[department]";
                } else {
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


                $vacant = $this->vacantsea_model->getSearchVacantnew($keyword,0, $data_dept["department_id"], 0, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantnew($keyword, 0,$data_dept["department_id"], 0, true, $offset));
            } else if ($v1) {
               // echo "hanya salary <hr>";
                if(!empty($keyword)){
                    $url .= "/$keyword?vessel_type=$data_ship[ship_type]";
                } else {
                    $url .= "?vessel_type=$data_ship[ship_type]";
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


                $vacant = $this->vacantsea_model->getSearchVacantnew($keyword, $data_ship['type_id'], 0, 0, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantnew($keyword, $data_ship['type_id'], 0, 0, true, $offset));
            } else {
            
                if(!empty($keyword)){
                    $url .="/$keyword?";
                } else{
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

                $vacant = $this->vacantsea_model->getSearchVacantnew($keyword, 0, 0, 0, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantnew($keyword, 0, 0, 0, true, $offset));
            }  

            $data['vacantsea'] = $vacant;
            $data['total_vacant'] = $tvacant;
            $data['page'] = $url;
                $this->load->library('pagination');
            $config['base_url'] = base_url("vacantsea/".$data['page']);
            $config['total_rows'] = $data['total_vacant'];
            $config['per_page'] = 10;
            $config["use_page_numbers"] = true;
            $config['page_query_string'] = true;
            $config['first_tag_open']   = "<li>";
            $config['first_link']       = "First";
                $config['first_url'] = base_url("vacantsea/".$data['page']."&page=1"); 
            $config['first_tag_close']  = "</li>";
            $config['prev_link']        = "Prev";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['cur_tag_open']     = "<li class='active'><a href>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_link']        = "Next";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['num_tag_open']     = "<li>";
            $config['num_tag_close']    =    "</li>";  
            $config['query_string_segment'] = "page";
            $config['last_tag_open']    = "<li>";
            $config['last_link']        = "Last";
            $config['last_tag_close']   = "</li>";
             

            $data['dt_js_under'] = "vacantsea/js_under";
            $data['keyword'] = "informasea, vacantsea, informasea vacantsea";
            $data['title']  = "Vacantsea";
            $data['template'] = "template";
            $this->pagination->initialize($config);
               $data['pagination']=$this->pagination->create_links();
            $data['ship_type'] = $this->vacantsea_model->call_ship_type();
            $data['department'] = $this->vacantsea_model->call_department();
            $data['rank'] = $this->vacantsea_model->call_rank();
            $data['coc'] = $this->vacantsea_model->call_coc();
			
            $this->load->view('index',$data);


        }

      
    }


    function index()
    {
        $data = fill_ads_data();
        // $this->db = $this->load->database(DB_SETTING, true);
        $data['page'] = "index";
        $sess_data = $this->session->all_userdata();
        $username = $this->session->userdata("username");
        $data['can_apply'] = empty($username) ? "0":"1";
        $vacant_akhir = $this->vacantsea_model->get_last_vacantsea();

        $url    = $this->uri->segment(3);
        $limit  = empty($url) ? 0 : $url;
        $limit -= $limit == 0 ? 0 : 1;
        $limit *= 10;
        
        if($sess_data['username'] == ""){ 
            //echo "hei";
			//$data["vacantsea"] = $this->vacantsea_model->getSearchVacantnew("",0,0,0,false, $limit);
			$data['vacantsea'] = $this->vacantsea_model->get_vacantsea_panel_a(false,$limit);
			//$vacant = $this->vacantsea_model->getSearchVacantnew("",0,0,0,true, $limit);
			$vacant = $this->vacantsea_model->get_vacantsea_panel_a(true,$limit);
        }
		else if ($sess_data['username'] != ""){
            /* Untuk konten Login Di mulai di sini */
			$data["pelaut"] = $this->user_model->get_profile_resume($sess_data["id_user"]);
			
			$data["rank_pelaut"] = $this->rank_model->get_rank_bydept($data["pelaut"]["department"]);
	
			$data["vacantsea"] = 
			empty($data["pelaut"]['department']) ? $this->vacantsea_model->get_vacantsea_panel_a(false, $limit) : 
			$this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"], false,$limit);
			//$valid = $this->authentification->cek_tampil($data['vacantsea']['id_perusahaan']);
			
			$vacant = empty($data['pelaut']["department"]) ? $this->vacantsea_model->get_vacantsea_panel_a(true, $limit) : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"], true, $limit);
        
        }
        
        $data["total_vacant"] = count($vacant);
        // echo $this->uri->segment(2);
       // echo $data['total_vacant'];
        //foreach ($vacant_akhir as $row) $data['id_paling_akhir'] = $row['vacantsea_id'];
        
        //foreach ($data['vacantsea'] as $row) $data['id_pertama'] = $row['vacantsea_id'];
        $this->directPage($data);
    }


  //   function index()
  //   {
  //       $data['page'] = "index";
  //       $sess_data = $this->session->all_userdata();
  //       $username = $this->session->userdata("username");
		
  //       $data['can_apply'] = empty($username) ? "0":"1";
  //       $vacant_akhir = $this->vacantsea_model->get_last_vacantsea();

  //       $url    = $this->uri->segment(3);
  //       $limit  = empty($url) ? 0 : $url;
  //       $limit -= $limit == 0 ? 0 : 1;
  //       $limit *= 10;
		
  //       //$data["vacantsea"] = $this->vacantsea_model->getSearchVacantnew("",0,0,0,false, $limit);
  //       $data['vacantsea'] = $this->vacantsea_model->get_vacantsea_panel(true,$limit);
		// //$vacant = $this->vacantsea_model->getSearchVacantnew("",0,0,0,true, $limit);
  //       $vacant = $this->vacantsea_model->get_vacantsea_panel(true,$limit);

  //       if (!empty($sess_data['username'])){
			
  //           /* Untuk konten Login Di mulai di sini */
  //           $data["pelaut"] = $this->user_model->get_detail_pelaut_byid($sess_data["id_user"]);
  //           $data["rank_pelaut"] = $this->rank_model->get_rank_bydept($data["pelaut"]["department"]);
  //           $data["vacantsea"] = empty($data["rank_pelaut"]) ? $this->vacantsea_model->get_vacantsea_panel_a(false, $limit) : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"], $limit);
			
  //           $vacant = empty($data["rank_pelaut"]) ? $this->vacantsea_model->get_vacantsea_panel(true, $limit) : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"], true, $limit);
  //       }
        
		// $data["total_vacant"] = count($vacant);
		
  //       //foreach ($vacant_akhir as $row) $data['id_paling_akhir'] = $row['vacantsea_id'];
		
  //       //foreach ($data['vacantsea'] as $row) $data['id_pertama'] = $row['vacantsea_id'];
		
		// //profiler();
  //       $this->directPage($data);
  //   }

    function all(){
		
        $data['page'] = "all";
        $username = $this->session->userdata("username");
        $data['can_apply'] = empty($username) ? "0":"1";

        $url = $this->uri->segment(3);
        $data['x'] = 1;
        $limit = empty($url) ? 0 : $url;
        $limit -= $limit == 0 ? 0:1;
        $limit *= 5;
        $data["vacantsea"] = $this->vacantsea_model->getSearchVacant("",0,0,"",false, $limit);
        $vacant = $this->vacantsea_model->getSearchVacant("",0,0,"",true, $limit);
        $data["total_vacant"] = count($vacant);
        $this->directPage($data);
    }

    private function directPage($data="")
    {
        /* Data untuk di halaman index paling luar */
        $data['dt_js_under'] = "vacantsea/js_under";
        $data['keyword']     = "informasea, vacantsea, informasea vacantsea";
        $data['title']	   = "Vacantsea";
		$data["meta"]	    = "meta";
        $data['template']    = "template";

//        echo $data['search_data']['sallary'];
        /* Pagination Begin Here */
        $this->load->library("pagination");
		
        $config["base_url"]         =  base_url("vacantsea/".$data['page']);
        $config["total_rows"]       =  $data['total_vacant'];
        $config["per_page"]         =  10;
        $config["use_page_numbers"] =  true;

            $config['first_tag_open']   = "<li>";
            $config['first_link']       = "First";
            $config['first_tag_close']  = "</li>";
            $config['prev_link']        = "Prev";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['cur_tag_open']     = "<li class='active'><a href>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_link']        = "Next";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['num_tag_open']     = "<li>";
            $config['num_tag_close']    =    "</li>";  
            $config['query_string_segment'] = "page";
            $config['last_tag_open']    = "<li>";
            $config['last_link']        = "Last";
            $config['last_tag_close']   = "</li>";

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();

        /* Pagination End Here */

        $data['ship_type']  = $this->vacantsea_model->call_ship_type();
        $data['department'] = $this->vacantsea_model->call_department();
        $data['rank']       = $this->vacantsea_model->call_rank();
        $data['coc']        = $this->vacantsea_model->call_coc();
		
        run_tracker("vacantsea");
		
        $this->load->view('index',$data);
    }

    function detail()
    {
		$data = fill_ads_data();
//        $this->authentification_model->close_access();
        $this->load->model("department_model");
        $this->load->model('rank_model');
        $this->load->model('vessel_model');
        $this->load->model('nation_model');
        $this->load->model('ship_model');

        $segment3 = $this->uri->segment(3); // id
		
        if ($segment3 !="") {

            $username_login     = $this->session->userdata("username");
            $username_company   = $this->session->userdata("username_company");
            if(!empty($username_login))
            {
                track_seatizen("vacantsea detail");
            }
            else if(!empty($username_company))
            {
                track_agentsea("vacantsea detail");
            }
        }
		
        $username 				= $this->session->userdata("username");
        $data['can_apply']   	   = empty($username) ? "0":"1";
		$data["meta"]	 		= "meta_detail"; // karena ini halaman detail 
		$data["head"]			= "head_detail";
		$data["social_platform"] = "vacantsea_detail/social_platform";

        $data['vacantsea']  	   = $this->vacantsea_model->detail_vacantsea($segment3);
        $check_applicant 	 	 = $this->vacantsea_model->check_applicant($data['vacantsea']['vacantsea_id']);
        $data['already_applied'] = !empty($check_applicant) ? true:false;
        $data['dt_js_under'] 	 = "vacantsea/js_under";
        $data['title'] 		   = ucfirst($data['vacantsea']['vacantsea']);
        $data['template'] 		= "vacantsea_detail/template_detail"; // punya detail
		
        $id_perusahaan 		   = $data['vacantsea']['id_perusahaan'];
        $data['company'] 		 = !empty($id_perusahaan) ? $this->vacantsea_model->get_data_perusahaan($id_perusahaan) : 
									json_decode($data["vacantsea"]["data_scrap"],TRUE);
        $data["nationality"] 	 = $this->nation_model->get_detail_nationality($data["vacantsea"]["id_nationality"]);
        $data["department"] 	  = $this->department_model->get_detail_department($data["vacantsea"]["department"]);
        $data["rank"] 			= $this->rank_model->get_rank_detail($data["vacantsea"]["rank_id"]);
        $data["ship_type"] 	   = $this->ship_model->get_ships_type($data["vacantsea"]["ship_type"]);
        $data["ship"] 		    = $this->ship_model->get_detail_ship($data["vacantsea"]["ship"]);
		
                $data['vacantsea_terkait'] = $this->vacantsea_model->vacantsea_terkait($data['vacantsea']['rank_id'],$data['vacantsea']['ship'],$data['vacantsea']['vacantsea_id']);

		track_vacantsea_visitor($data['vacantsea']['vacantsea_id']);
		
		
        $this->load->view('index', $data);

    }

    function apply()
    {
        $sess_data = $this->session->all_userdata();
        if (empty($sess_data['username'])) {
			
            $id 				  = $this->input->post("idapply");
            $data['destination'] = "$id-apply-vacantsea";
            $this->load->view("modal-login", $data);
			
        } else {
// harus login terlebih dahulu
            $segment2 = $this->uri->segment(3); // id
            $dt_applicant = $this->vacantsea_model->check_applicant($segment2);

            if (!empty($dt_applicant)) {
                /* Jika sudah pernah mengapply di vacantsea tersebut */
                $data['isinya'] = "Sorry, you have already applied for this vacant";
                $this->load->view("modal-confirmation",$data);
            } else {
                /* Jika belum mengapply di vacantsea tersebut */
                $this->load->model("department_model");
                $this->load->model('rank_model');
                $this->load->model('vessel_model');
                $this->load->model('nation_model');
                $this->load->model('seaman/resume_model');

                $pelaut_id = $this->session->userdata("id_user");

                $data['vacantsea'] = $this->vacantsea_model->detail_vacantsea($segment2);
                $data['profile_resume'] = $this->resume_model->get_profile_resume($pelaut_id);
                $data['pelaut_ms']  = $this->resume_model->get_pelaut_ms($pelaut_id);

                $data['title'] = $data['vacantsea']['vacantsea'];

                //$data['css'] = "apply/head_detail"; // punya detail
                // content
                $data['template'] = "apply_vacantsea/template"; // punya detail
                //$data['include'] = "content/vacatsea/detail"; // detail content yang ada di vacantsea

                //data dari tabel perusahaan
                $id_perusahaan = $data['vacantsea']['id_perusahaan'];
                $data['company'] = $this->vacantsea_model->get_data_perusahaan($id_perusahaan);

                //data array tiap vacantsea
                $data['perusahaan'] = $data['vacantsea']['perusahaan'];

                $username_login     = $this->session->userdata("username");
                $username_company   = $this->session->userdata("username_company");
                if(!empty($username_login))
                {
                    track_seatizen("vacantsea apply");
                }
                else if(!empty($username_company))
                {
                    track_agentsea("vacantsea apply");
                }
                $this->load->view('index', $data);
            }
        }
    }

    function list_applicant()
    {
        $this->authentification_model->close_access();

        $this->load->model("seaman/resume_model");

        $id_vacantsea = $this->input->post("id_vacantsea");
        $id_pelaut 	= $this->input->post("id_pelaut");
        /* view melalui ajax */
        $data['list_applicant'] = $this->vacantsea_model->applicant_vacantsea($id_vacantsea,$id_pelaut);
        $data['vacantsea']	  = $this->vacantsea_model->detail_vacantsea($id_vacantsea);
        //$data['resume']		 = $this->resume_model->get_resume();

        $this->load->view('list-applicant/list-applicant',$data);
    }

    function test_list_applicant()
    {
        $this->authentification_model->close_access();

        $this->load->view('list-applicant/list-applicant-bak');
    }

    function applied_job()
    {
        $this->authentification_model->close_access();

        $this->load->model('photo/photo_mdl');
        $this->load->model('company/company_model');
        $id_user = $this->session->userdata("id_user");

        $data['title'] = "Applied Job";
        $data['applied_job'] = $this->vacantsea_model->list_applied($id_user);
        $data['template'] = "applied-list-new/template";
        $this->load->view('index',$data);
    }
	
    function apply_submit()
    {
		//error_reporting(E_ALL);
        //$this->authentification_model->close_access(); //sementara non-active
		
		//print_r($_POST); exit;
		
		$this->load->model("experience_model");
		$this->load->library("form_validation");
		$this->load->library("my_email");
		
        $username =  $this->session->userdata("username");
        $id 	   = $this->input->post('vacantsea_id');
      	
		$id_pelaut  	= $this->input->post("id_pelaut",true);
        $promotion  	= $this->input->post("promotion",true);
        $file_resume  = $this->input->post("file_resume",true);
        // $id_vacantsea = $this->input->post("id_vacantsea",true);
		$id_vacantsea = $this->input->post("vacantsea_id",true);
		
		$this->form_validation->set_rules("id_pelaut","Pelaut","required");
		$this->form_validation->set_rules("promotion","Promotion","required");
		$this->form_validation->set_rules("vacantsea_id","vacantsea","required");
		$this->form_validation->set_rules("name_company","Company Name","required");
		
		// check apply_submit
		$check_vacantsea = $this->vacantsea_model->check_applicant($id_vacantsea);
		
        if(!isset($username) || $username == "" || $this->form_validation->run() == FALSE || !empty($check_vacantsea))
        {
			$err = "";
			if(!empty($check_vacantsea))
			{
				$err = "<div> you already apply this vacantsea </div>";	
			}
			
            //header("location:".base_url());
			$data["desc"]  = validation_errors()." ".$err;
			$data["title"] = "error";
			$data["bg"]    = "bg-danger";
			
			$this->load->view("content/modal/alert",$data);
        }
        else
        {
			$this->load->model("Profile_resume_model","prtr"); // model diluar
			$this->load->model("seatizen/seatizen_model","sm");
			
			
            $this->vacantsea_model->insert_applicant();
			
			$vacantsea 	  		  = $this->vacantsea_model->detail_vacantsea($id);
			$company_name     	   = $this->input->post('name_company') ;
			
			if(empty($vacantsea["data_scrap"]))
			{
				$company_detail   		 = $this->vacantsea_model->get_data_perusahaan($vacantsea['id_perusahaan']);
				$dt["str_btn"] = "https://agent.informasea.com/beranda/
				$company_detail[id_perusahaan]&$company_detail[username]&applicant&company&$company_detail[password]";
			}
			else
			{
				$company_detail		 = json_decode($vacantsea["data_scrap"],TRUE);	
				$dt["str_btn"]	   = base_url("vacantsea/detail/$vacantsea[vacantsea_id]");
			}
			
			$seatizen_detail  		= $this->sm->detail_seatizen($username);
			$vacantsea_byapplicant  = $this->vacantsea_model->list_vacantsea_byapplicant($seatizen_detail["pelaut_id"]);
			
			$check_resume = $this->prtr->cek_lengkap_resume($seatizen_detail["pelaut_id"]);
			
			// kirim email ke perusahaan
			
			$dt["contact_person"] = $company_detail["contact_person"];
			$dt["applicant_name"] = $seatizen_detail["nama_depan"]." ".$seatizen_detail["nama_belakang"];
			$dt["vacantsea"] 	  = $vacantsea;
			$dt["applicant"]	  = $seatizen_detail;
			$dt["experience"] 	 = count_experience($seatizen_detail["pelaut_id"],"bulat");
			$dt["promotion"]	  = $promotion;
			
			
			
			$template["content_template"] = $this->load->view("email_template/new_applicant",$dt,true);
			$user 	= "vacantsea";
			$user_type = "agentsea";
			$content = array(
			
				"subject" 		 => "$dt[applicant_name] applied your vacantsea",
				"subject_title"  => WEBSITE,
				"to" 			 => array($company_detail["email"],"alhusna901@gmail.com"),
			
				"message"		=> $this->load->view("template_email2016/new_email_template",$template,true),
				"mv" 			 => FALSE,
			
			);
			
			$this->my_email->send_email($user,$content);
			
			
			// kirim email ke applicant kalau resume belum lengkap 
			if($check_resume["result"] == FALSE) // FALSE kalau resume belum lengkap
			{
				// kirim email dulu
				$this->load->library("my_email");
				
				$user 	= "vacantsea";
				$user_type = "seatizen";
				$subject = "$seatizen_detail[nama_depan], uncompleted resume as applicant"; // sudah ,
				
				$dt_email["applicant"] 	  = $seatizen_detail;
				$dt_email["vacantsea"]	  = $vacantsea_byapplicant;
				$dt_email["config"]		 = $this->config->item($user);
				
				$template["content_template"] = $this->load->view("email_template/incomplete-resume",$dt_email,true);
				
				
				
				$content = array(
			
					"subject" 		=> $subject,
					"subject_title"  => WEBSITE,
					"to" 			 => array($seatizen_detail["email"]),
				
					//"message" 		=> $this->load->view("email_template/default_template",$template,true),
					"message"		=> $this->load->view("template_email2016/new_email_template",$template,true),
					"mv" 			 => FALSE,
				
				);
				
				$this->my_email->send_email($user,$content);
			}
			else // kalau lengkap
			{
				
				// kirim email dulu
				$this->load->library("my_email");
				
				$user 	  = "vacantsea";
				$user_type = "seatizen";
				$subject   = "$seatizen_detail[nama_depan], Thanks for apply. Your resume has been send to $company_name "; // sudah ,
				
				$dt_email["applicant"] 	  = $seatizen_detail;
				$dt_email["vacantsea"]	  = $vacantsea_byapplicant;
				$dt_email["config"]		 = $this->config->item($user);
				
				$template["content_template"] = $this->load->view("email_template/complete-resume",$dt_email,true);
				
				
				
				$content = array(
			
					"subject" 		=> $subject,
					"subject_title"  => WEBSITE,
					"to" 			 => array($seatizen_detail["email"]),
				
					//"message" 		=> $this->load->view("email_template/default_template",$template,true),
					"message"		=> $this->load->view("template_email2016/new_email_template",$template,true),
					"mv" 			 => FALSE,
				
				);
				
				$this->my_email->send_email($user,$content);
				
			}
			
            // $data['isinya'] 		= "Data has been successfully saved";
            
            $username_company   	   = $data['company_detail']['username'];
			$data['vacantsea']  	  = $vacantsea;
            $data['company']    	= $company_name;
            $data['company_detail'] = $company_detail;
			
			//notification_helper
            applied_vacantsea($username,$username_company,$id);
            $this->load->view("modal-confirmation",$data);
        }
    }
	
	function process_apply(){
        $ajax = $this->input->post("x", true);
        if(!$ajax) exit("not authorized");
        $id_pelaut 	= $this->input->post("id_pelaut", true);
        $nama_pelaut  = $this->input->post("name", true);
        $id_vacantsea = $this->input->post("id_vacantsea", true);
        $email_pelaut = $this->input->post("email", true);

        $q = "select * from vacantsea where vacantsea_id = '$id_vacantsea'";
        $exec = $this->db->query($q);
        $vacant = $exec->row_array();
        $exec->free_result();

        $email_perusahaan = $this->input->post("email_perusahaan", true);
        $q = "select * from perusahaan where email = '$email_perusahaan'";
        $exec = $this->db->query($q);
        $perusahaan = $exec->row_array();
        $exec->free_result();

        $kalimat_promosi = $this->input->post("promotion", true);
        $this->load->library("my_email");
                
                $user   = "vacantsea";
                $subject = "A new Applicant";
                
                $dt_email["contact_person"]    = $perusahaan['contact_person'];
                $dt_email["applicant_name"]    = $nama_pelaut;
                $dt_email["vacantsea"]      = $vacant['vacantsea'];
                
                $template["body"] = $this->load->view("email_template/new_applicant",$dt_email,true);
                
                
                
                $content = array(
                    "subject"       => $subject,
                    "subject_title"  => WEBSITE,
                    "to"             => array($email_pelaut, "alhusna901@gmail.com"),
                    "message"       => $this->load->view("email_template/default_template",$template,true),
                    "mv"             => FALSE,
                );
                
                $this->my_email->send_email($user,$content);
                echo $this->my_email->get_status_sent();

    }

    function search_vacantsea()
    {
        $this->authentification_model->close_access();

        $dt = explode(',', $this->input->post('x'));
        $keyword = $dt[1];
        $department = $dt[2];
        $rank_id = $dt[3];
        $ship_type = $dt[4];
        $page = $dt[5];
        $coc_class = $dt[6];
        $sallary = $dt[7];
//        echo ""
        if(empty($keyword) && empty($department) && empty($rank_id) && empty($ship_type) && empty($coc_class) && empty($sallary))
        {
            $this->index();
        }
        else
        {
            if($this->input->post('x') != 1)
            {
                header("location:".base_url());
            }
            // echo "<br>test".$keyword;
            $data['keyword'] 	= $keyword;
            $data['department_id'] = $department;
            $data['rank_id']	= $rank_id;
            $data['ship_type']  = $ship_type;
            $data['page']	   	= $page;
            $data['coc_class']	= $coc_class;
            $data['sallary']	= $sallary;
            // echo $data['keyword'];
            $data['job'] = $this->vacantsea_model->search_vacantsea($keyword, $department, $rank_id, $ship_type);
            // print_r($data['hasil']);
            // $data['job'] = $data['hasil']['job'];

            // print_r($data);
            // echo $data['keyword']." testing ";
            $this->load->view('list_vacantsea',$data);
        }
    }

    function search_vacantsea_plus()
    {
        // echo "test";
        $this->authentification_model->close_access();

        //echo "search vacantsea plus ... "; exit;
        $keyword = $this->input->post('keyword');
        $sallary = $this->input->post('sallary');
        $ship_type = $this->input->post('ship_type');
        $department = $this->input->post('department');
        $rank_id = $this->input->post('rank_id');
        $coc_class = $this->input->post('coc_class');

        $vacantsea_id = $this->input->post('vacantsea_id');
        $jml_setting = $this->input->post('jml_setting');

        // echo $keyword." - ".$vacantsea_id." = ".$jml_setting;

        if($this->input->post('x') != 1)
        {
            header("location:".base_url());
        }
        // echo "Hallo";
        $data['job_plus'] = $this->vacantsea_model->search_vacantsea_plus($keyword, $department, $rank_id, $ship_type, $vacantsea_id, $jml_setting);
        // print_r($data);
        $data['uri'] = $this->input->post('uri');

        $data['keyword'] 	= $keyword;
        $data['department_id'] = $department;
        $data['rank_id']	= $rank_id;
        $data['ship_type']  = $ship_type;
        $data['page']	   = $page;
        // print_r($data);
        $this->load->view('list_vacantsea_plus',$data);

    }

    /* =================================================================== */

    function get_list_vacantsea()
    {
        $this->authentification_model->close_access();
        $username = $this->session->userdata("username");

        //echo "coba dong";exit;
        if($this->input->post('x') != 1)
        {
            header("location:".base_url());
        }
        // echo "hallo";
        $data['job'] = $this->vacantsea_model->vacantsea_limit();
        $data['department'] = $this->vacantsea_model->department_list();

        if(!empty($username))
        {
            $data['user'] = $this->user_model->get_detail_pelaut($username);
            $data['job'] = $this->vacantsea_model->vacantsea_limit_by_department($data['user']['department']);
        }

        // $data['rank'] = $this->vacantsea_model->rank_department($data['department'][0]['department_id']);
        // print_r($data['rank']);
        // echo $data['rank'][0]['rank'];
        // print_r($data['department']);
        // print_r($data);
        // echo $data['department'][0]['department_id'];
//        echo $data['user']['department'];
        $this->load->view('list_vacantsea',$data);
    }

    function get_list_vacantsea_plus()
    {
        $this->authentification_model->close_access();

        $data['job_plus'] = $this->vacantsea_model->vacantsea_limit_plus();
        $data['uri'] = $this->input->post('uri');

        $this->load->view('list_vacantsea_plus',$data);

    }

    function rank_ajax()
    {
        $this->authentification_model->close_access();

        $data['rank'] = $this->vacantsea_model->call_rank();
        $this->load->view("list_rank",$data);
    }

    function get_coc_class()
    {
        $this->authentification_model->close_access();

        $this->load->model("coc_model");

        $id = $this->input->post("department_id");

        $coc = $this->coc_model->get_coc_bydept($id);

        if(!empty($coc))
        {
            foreach($coc as $row)
            {
                echo "<option value='$row[id_coc_class]' >$row[coc_class]</option>";
            }
        }
        else
        {
            echo "<option value='0' >- Other -</option>";

        }
    }

    function get_rank()
    {
        $this->authentification_model->close_access();

        $this->load->model("rank_model");

        $id = $this->input->post("department_id");

        $rank = $this->rank_model->get_rank_bydept($id);


        if(!empty($rank))
        {
            foreach($rank as $row)
            {
                echo "<option value='$row[rank_id]' >$row[rank]</option>";
            }
        }
        else
        {
            echo "<option value='0' >- Other -</option>";

        }
    }

    function __desturct(){}

}


