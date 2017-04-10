
<?php if(!defined('BASEPATH')) exit('No direct script access allowed ');

// controller vacantsea , module vacantsea 

class Vacantsea extends MX_Controller
{
    function __construct(){

        parent::__construct();
        // authentification
        //$this->session->all_userdata(); exit;
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
        $id_dept = $this->input->post("id_dept");
        $id_rank = $this->input->post("id_rank");
        $data_dept = !empty($id_dept) ? $this->department_model->get_detail_department($id_dept):"";
        $data_rank = !empty($id_rank) ? $this->rank_model->get_rank_detail($id_rank):"";

        $department = empty($data_dept) ? "":$data_dept['department'];
        $rank = empty($data_rank) ? "":$data_rank['rank'];

        echo $department."&".$rank;
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

    function cobacobasince()
    {
        $date_db = $this->input->post("z");
        $this->load->helper("date_format_helper");

        echo $this->input->post("z")." hei";
        $results = since($date_db);
        $data['results'] = $results;
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
            $v2 = false;
            // echo "segment 1 : ".$segment1."<hr>";
            // echo "segment 2 : ".$segment2."<hr>";
            // echo "segment 3 : ".$segment3."<br>";

            $vessel = str_replace('-',' ', $segment1);

            $department = empty($segment2) ? str_replace('-', ' ', $segment1) : str_replace('-', ' ', $segment2);
            
            // echo "vessel : ".$vessel."<br><br>";
            // echo "department : ".$department."<br><br>";

           // $str1 = "SELECT * FROM ship_type WHERE ship_type = '$vessel'";
           // echo $str1; echo "<br><bR>";
            $data_vessel = $this->db->query("SELECT * FROM ship_type WHERE ship_type = '$vessel'")->row_array();
            $data_dept = $this->department_model->get_detail_department_by_name($department);
            

            // print_r($data_vessel);
            // echo "<br>";
            // print_r("data department : ".$data_dept);
            // echo "<br />";
            //$data_nationality = $this->nation_model->get_detail_nationality($nationality);

            if(!empty($data_vessel)){
                $v1 = true;
            }else if(!empty($data_dept)){
                $v2 = true;
            }else{
                $v1 = false OR $v2 = false;
            }

          //  $v3 = empty($data_nationality) ? false : true;
            // echo "data vessel : "; print_r($data_vessel);
            // echo "<br>";
            // echo "data dept :"; print_r($data_dept);
            // echo "<br />";
            // echo "data nationality :"; print_r($data_nationality);
            // echo "<Br/><br />";


            $v1 = empty($data_vessel) ? false : true;
            $v2 = empty($data_dept) ? false : true;
            $v3 = empty($data_nationality) ? false : true;


           //  echo "v1 : ".$v1."<br />";
           //  echo "V2 : ".$v2."<br />";
           //  echo "v3 : ".$v3."<br />";

           // echo "$v1 & $v2 & $v3";
            // $semua_terisi = $v1 && $v2 && $v3;
            // $vessel_dan_department = $v1 && $v2 && $v3;
            // $vessel_dan_nationality = $v1 && !$v2 && $v3;
            // $department_dan_nationality = !$v1 && $v2 && $v3;
            // $hanya_nationality = !$v1 && !$v2 && $v3;
            // $hanya_department = !$v1 && $v2 && !$v3;
            // $hanya_vessel = $v1 && !$v2 && !$v3;

            $vessel_dan_department = $v1 && $v2;
            $hanya_vessel = $v1 && !$v2;
            $hanya_department = !$v1 && $v2;


//            echo "$semua_terisi & $vessel_dan_department & $vessel_dan_nationality & $department_dan_nationality & $hanya_nationality & $hanya_department & $hanya_vessel";

            if ($semua_terisi) {                /* Semua terpilih */
                //echo "<script>alert('semua terisi');</script>";
                $url .= "/$segment1/$segment2/$segment3/";
                if (is_numeric($segment4)) {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type'],
                        'department' => $data_dept['department'],
                        'nationality' => $data_nationality['name']
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $segment4 = "";
                } else {
                    $data['search_data'] = array(
                        'ship_type' => $data_vessel['ship_type'],
                        'department' => $data_dept['department'],
                        'nationality' => $data_nationality['name'],
                        'keyword' => $segment4
                    );
                    $offset = empty($segment5) ? 0 : $segment5;
                    $url .= $segment4;
                }

                    // print_r($data['search_data']['department']);


                    // echo "<b> Data vessel : </b>".$data_vessel['type_id']."<br>";
                    // echo "<b> Data department : </b>".$data_dept['department_id']."<br />";
                    // echo "<b> Data Nationality : </b> ".$data_nationality['id'];
                    // echo "<br>";
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment4, $data_vessel["type_id"], $data_dept['department_id'], $data_nationality['id'], false, $offset);




                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment4, $data_vessel["type_id"], 6, $data_nationality['id'], true, $offset));
            } else if ($vessel_dan_department) {
                /* Vessel dan Department terisi */
               // echo "<script>alert('vessel dan department');</script>";
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
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment3, $data_vessel["type_id"], $data_dept['department_id'], '', false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment3, $data_vessel["type_id"], $data_dept["department_id"], '', true, $offset));
            } else if ($vessel_dan_nationality) {
                //echo "<script>alert('vessel dan nationality');</script>";
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
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment3, $data_vessel["type_id"], 0, $data_nationality['id'], false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment3, $data_vessel["type_id"], 0, $data_nationality['id'], false, $offset));
            } else if ($department_dan_nationality) {

                /* Department dan Nationality terisi */
                //echo "<script>alert('department dan nationality');</script>";
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
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment3, 0, $data_dept['department_id'], $data_nationality['id'], false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment3, 0, $data_dept['department_id'], $data_nationality['id'], false, $offset));
            } else if ($hanya_nationality) {
                //echo "<script>alert('hanya nationality');</script>";
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
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment2, 0, 0, $data_nationality['id'], false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment2, 0, 0, $data_nationality['id'], false, $offset));
            } elseif ($hanya_department) {
                /* Hanya Department terisi */
                //echo "<script>alert('hanya department');</script>";
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
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment2, 0, $data_dept["department_id"], '', false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment2, 0, $data_dept["department_id"], '', true, $offset));
            } elseif ($hanya_vessel) {
                /* Hanya Vessel terisi */
                //echo "<script>alert('hanya vessel');</script>";
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
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment2, $data_vessel["type_id"],0, '', false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment2, $data_vessel["type_id"], 0,'', true, $offset));
            }
            else{
                /* Hanya Keyword */
                //echo "<script>alert('hanya keyword');</script>";
                $data['search_data'] = array(
                    'keyword' => $segment1
                );
                $url .= "/$segment1/";

                if (is_numeric($segment2)) {
                    $offset = empty($segment2) ? 0 : $segment2;
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacantDashboard($segment1, 0,0, '', false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacantDashboard($segment1, 0, 0,'', true, $offset));
            }
        }
        else {
            /* Searching dari page vacantsea di muali di sini */
            $v3 = false;
       

             if($segment1 == "more-than-10000000"){
                $segment1 = "10000000-500000000";
             }else if($segment1 == "less-than-1000000"){
                $segment1 = "0-1000000";
             }else if($segment2 == "more-than-10000000"){
                $segment2 = "10000000-500000000";
             }else if($segment2 == "less-than-1000000"){
                $segment2 = "0-1000000";
             }else if($segment3 == "more-than-10000000"){
                $segment3 = "10000000-500000000";
             }else if($segment3 == "less-than-1000000"){
                $segment3 = "0-1000000";
             }


           if ((is_numeric(explode('-', $segment1)[0]) && is_numeric(explode('-', $segment1)[1])) || is_numeric(substr($segment2, 3)) || is_numeric(substr($segment2, 1))) $v3 = true;

            $v2 = false;
            $segment1 = $v3 ? $segment1 : strpos($segment1, "Security") ?  $segment1 :  str_replace('-', ' ', $segment1);
            $data_dept = $this->department_model->get_detail_department_by_name($segment1);

            if(!$v3) if ((
 (is_numeric(explode('-', $segment2)[0]) && is_numeric(explode('-', $segment2)[1]))) || is_numeric(substr($segment2, 3)) || is_numeric(substr($segment2, 1))) $v3 = true;

            $segment2 = $v3 ? $segment2 : str_replace('-', ' ', $segment2);
            $data_rank = $this->rank_model->get_rank_detail_by_rank($segment2);

            $v1 = empty($data_dept) ? false : true;
            if ($v1) {
                if(empty($data_rank))
                {
                    if (strpos($segment2, "-")) if ((is_numeric(explode('-', $segment2)[0]) && is_numeric(explode('-', $segment2)[1])) || is_numeric(substr($segment2, 1))) $v3 = true;
                }
                else {
                    $v2 = true;
                    if ((is_numeric(explode('-', $segment3)[0]) && is_numeric(explode('-', $segment3)[1])) || is_numeric(substr($segment2, 3)) || is_numeric(substr($segment2, 1))) $v3 = true;
                }
            }

            if ($v1 && $v2 && $v3) {
               // echo "xxx";
                /* /Department/  rank  /sallary  / */
                $url .= "/$segment1/$segment2/$segment3/";
                if (strpos($segment3, "%3E") == 0) $segment3 = str_replace("%3E", ">", $segment3);
                if (strpos($segment3, "%3C") == 0) $segment3 = str_replace("%3C", "<", $segment3);
                if (is_numeric($segment4)) {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'rank' => $data_rank['rank_id'],
                        'sallary' => $segment3
                    );
                    $offset = empty($segment4) ? 0 : $segment4;
                    $segment4 = "";
                } else {
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'sallary' => $segment3,
                        'keyword' => $segment4,
                        'rank' => $data_rank['rank_id']
                    );
                    $offset = empty($segment5) ? 0 : $segment5;
                    $url .= $v3 ? $segment4 : "";
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacant($segment4, $data_dept["department_id"], $data_rank["rank_id"], $segment3, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacant($segment4, $data_dept["department_id"], $data_rank["rank_id"], $segment3, true, $offset));
            } elseif ($v1 && $v2) {
                    //        echo "tanpa sallary <hr>";
                /* /Department/  rank  / */
                $url .= "/$segment1/$segment2/";

                if (is_numeric($segment3)) {
                    //jika page offset
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'rank' => $data_rank['rank_id'],
                        'sallary' => $segment3
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    if (is_numeric($segment4)) $offset = empty($segment4) ? 0 : $segment4;
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'keyword' => $segment3,
                        'rank' => $data_rank['rank_id']
                    );
                    $url .= $segment3;
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacant($segment3, $data_dept["department_id"], $data_rank["rank_id"], "", false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacant($segment3, $data_dept["department_id"], $data_rank["rank_id"], "", true, $offset));
            }elseif ($v1 && $v3) {
                //echo "tanpa rank $segment2 <hr>";
                /* /Department/  sallary  / */
                $url .= "/$segment1/$segment2/";

                if (is_numeric($segment3)) {
                    //jika page offset
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'sallary' => $segment2
                    );
                    $offset = empty($segment3) ? 0 : $segment3;
                    $segment3 = "";
                } else {
                    if (is_numeric($segment4)) $offset = empty($segment4) ? 0 : $segment4;
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'sallary' => $segment2,
                        'keyword' => $segment3
                    );
                    $url .= $segment3;
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacant($segment3, $data_dept["department_id"], 0, $segment2, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacant($segment3, $data_dept["department_id"], 0, $segment2, true, $offset));
            }else if ($v1) {
                //echo "hanya department <hr>";
                /*/ department / */
                $url .= "/$segment1/";

                if (is_numeric($segment2)) {
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id']
                    );
                } else {
                    $offset = empty($segment3) ? 0 : $segment3;
                    $data['search_data'] = array(
                        'department' => $data_dept['department_id'],
                        'keyword' => $segment2
                    );
                    $url .= $segment2;
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacant($segment2, $data_dept["department_id"], 0, 0, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacant($segment2, $data_dept["department_id"], 0, 0, true, $offset));
            } else if ($v3) {
               // echo "hanya salary <hr>";
                if (strpos($segment1, "%3E") == 0) $segment1 = str_replace("%3E", ">", $segment1);
                if (strpos($segment1, "%3C") == 0) $segment1 = str_replace("%3C", "<", $segment1);
                /*/ sallary / */
                $url .= "/$segment1/";

                if (is_numeric($segment2)) {
                    $offset = empty($segment2) ? 0 : $segment2;
                    $segment2 = "";
                    $data['search_data'] = array(
                        'sallary' => $segment1
                    );
                } else {
                    $offset = empty($segment3) ? 0 : $segment3;
                    $data['search_data'] = array(
                        'sallary' => $segment1,
                        'keyword' => $segment2
                    );
                    $url .= $segment2;
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacant($segment2, $data_dept["department_id"], 0, $segment1, false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacant($segment2, $data_dept["department_id"], 0, $segment1, true, $offset));
            } else {
               // echo "keyword <hr>";
                /* Search hanya Keyword */
                if (is_numeric($segment2)) {
                    $offset = empty($segment2) ? 0 : $segment2;
                    $data['search_data'] = array(
                        'keyword' => $segment1
                    );
                    $url .= "/$segment1/";
                }
                elseif(is_numeric($segment1)) {
                    $offset = empty($segment1) ? 0 : $segment1;
                    $segment1 = "";
                }
                else
                {
                    $data['search_data'] = array(
                        'keyword' => $segment1
                    );
                    $url .= "/$segment1/";
                }
                $offset -= $offset == 0 ? 0:1;
                $offset *= 5;
                $vacant = $this->vacantsea_model->getSearchVacant($segment1, 0, 0, "", false, $offset);
                $tvacant = count($this->vacantsea_model->getSearchVacant($segment1, 0, 0, "", true, $offset));
            }
        }

        $data['vacantsea'] = $vacant;
        $data['total_vacant'] = $tvacant;
        $data['page'] = $url;
        $this->directPage($data);
    }


    
    function index()
    {
        $data['page'] = "index";
        $sess_data = $this->session->all_userdata();
        $username = $this->session->userdata("username");
        $data['can_apply'] = empty($username) ? "0":"1";
        $vacant_akhir = $this->vacantsea_model->get_last_vacantsea();

        $url = $this->uri->segment(3);
        $limit = empty($url) ? 0 : $url;
        $limit -= $limit == 0 ? 0:1;
        $limit *= 5;
        $data["vacantsea"] = $this->vacantsea_model->getSearchVacant("",0,0,"",false, $limit);
        $vacant = $this->vacantsea_model->getSearchVacant("",0,0,"",true, $limit);

        if (!empty($sess_data['username'])){
            /* Untuk konten Login Di mulai di sini */
            $data["pelaut"] = $this->user_model->get_detail_pelaut_byid($sess_data["id_user"]);
            $data["rank_pelaut"] = $this->rank_model->get_rank_bydept($data["pelaut"]["department"]);
            $data["vacantsea"] = empty($data["rank_pelaut"]) ? $this->vacantsea_model->get_vacantsea_panel(false, $limit) : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"], $limit);
            $vacant = empty($data["rank_pelaut"]) ? $this->vacantsea_model->get_vacantsea_panel(true, $limit) : $this->vacantsea_model->get_vacantsea_panelbydept($data["pelaut"]["department"], true, $limit);
        }
        $data["total_vacant"] = count($vacant);

        foreach ($vacant_akhir as $row) $data['id_paling_akhir'] = $row['vacantsea_id'];
        foreach ($data['vacantsea'] as $row) $data['id_pertama'] = $row['vacantsea_id'];

        $this->directPage($data);
    }

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

    protected function directPage($data="")
    {
        /* Data untuk di halaman index paling luar */
        $data['dt_js_under'] = "vacantsea/js_under";
        $data['keyword'] = "informasea, vacantsea, informasea vacantsea";
        $data['title']	= "Vacantsea";
        $data['template'] = "template";

//        echo $data['search_data']['sallary'];
        /* Pagination Begin Here */
        $this->load->library("pagination");
        $config["base_url"] = base_url("vacantsea/".$data['page']);
        $config["total_rows"] =  $data['total_vacant'];
        $config["per_page"] =  5;
        $config["use_page_numbers"] = true;
        $config['num_tag_open'] = "<li class='btn btn-primary' style='background-color: transparent'>";
        $config['num_tag_close'] = "</li>&nbsp;";
        $config['cur_tag_open'] = "<li class='btn btn-primary disabled' style='background-color: transparent; color: black'><b>";
        $config['cur_tag_close'] = "</b></li>&nbsp;";
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = "<li class='btn btn-primary' style='background-color: transparent'>";
        $config['next_tag_close'] = "</li>&nbsp;";
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = "<li class='btn btn-primary' style='background-color: transparent'>";
        $config['prev_tag_close'] = "</li>&nbsp;";
        $config['last_link'] = 'Last &gt;';
        $config['last_tag_open'] = "<li class='btn btn-primary' style='background-color: transparent'>";
        $config['last_tag_close'] = "</li>&nbsp;";
        $config['first_link'] = '&lt; First';
        $config['first_tag_open'] = "<li class='btn btn-primary' style='background-color: transparent'>";
        $config['first_tag_close'] = "</li>&nbsp;";

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();

        /* Pagination End Here */

        $data['ship_type'] = $this->vacantsea_model->call_ship_type();
        $data['department'] = $this->vacantsea_model->call_department();
        $data['rank'] = $this->vacantsea_model->call_rank();
        $data['coc'] = $this->vacantsea_model->call_coc();

        run_tracker("vacantsea");
        $this->load->view('index',$data);
    }

    function detail()
    {
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



        $username = $this->session->userdata("username");
        $data['can_apply'] = empty($username) ? "0":"1";

        $data['vacantsea'] = $this->vacantsea_model->detail_vacantsea($segment3);
        $check_applicant = $this->vacantsea_model->check_applicant($data['vacantsea']['vacantsea_id']);
        $data['already_applied'] = !empty($check_applicant) ? true:false;
        $data['dt_js_under'] = "vacantsea/js_under";
        $data['title'] = ucfirst($data['vacantsea']['vacantsea']);
        $data['template'] = "vacantsea_detail/template_detail"; // punya detail
        $id_perusahaan = $data['vacantsea']['id_perusahaan'];
        $data['company'] = $this->vacantsea_model->get_data_perusahaan($id_perusahaan);
        $data["nationality"] = $this->nation_model->get_detail_nationality($data["company"]["id_nationality"]);
        $data["department"] = $this->department_model->get_detail_department($data["vacantsea"]["department"]);
        $data["rank"] = $this->rank_model->get_rank_detail($data["vacantsea"]["rank_id"]);
        $data["ship_type"] = $this->ship_model->get_ships_type($data["vacantsea"]["ship_type"]);
        $data["ship"] = $this->ship_model->get_detail_ship($data["vacantsea"]["ship"]);


        $this->load->view('index', $data);

    }

    function apply()
    {
        $sess_data = $this->session->all_userdata();
        if (empty($sess_data['username'])) {
            $data['destination'] = $this->input->post("destination");
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
        $this->authentification_model->close_access();

        $username =  $this->session->userdata("username");
        $id = $this->input->post('vacantsea_id');
      
        if(!isset($username) || $username == "")
        {
            header("location:".base_url());
        }
        else
        {
            $this->vacantsea_model->insert_applicant();
            // $data['isinya'] = "Data has been successfully saved";
            $data['vacantsea']  = $this->vacantsea_model->detail_vacantsea($id);
            $data['company']    = $this->input->post('name_company') ;
            $this->load->view("modal-confirmation",$data);
        }
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



