<?php

// class vacantsea model, module vacantsea;

if(!defined('BASEPATH')) exit ('no direct script access allowed ');

class vacantsea_model extends CI_Model{

    function get_vacantsea()
    {
        $sql = $this->db->get('vacantsea');

        $f = $sql->result_array();

        return $f;

    }

    // untuk panel - right
    function get_vacantsea_panel($count=false)
    {
        $str = "SELECT * FROM vacantsea order by create_date desc, vacantsea_id desc";
        if(!$count) $str.=" LIMIT 5";

        $q = $this->db->query($str);
//        echo $str;
        $f = $q->result_array();
        return $f;
    }

    function get_vacantsea_panel_plus($id_vacantsea, $count=false)
    {
        $str = "select * from vacantsea where vacantsea_id < '$id_vacantsea' order by create_date desc, vacantsea_id desc";
        if(!$count) $str.=" LIMIT 5";

        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }

    function get_vacantsea_panel_minus($id_vacantsea, $count=false)
    {
        $str = "select * from vacantsea where vacantsea_id > '$id_vacantsea' order by create_date asc, vacantsea_id asc";
        if(!$count) $str.=" LIMIT 5";
        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }


    function get_vacantsea_panelbydept($id_dept,$count=false)
    {
        $str = "select * from vacantsea where department = '$id_dept' order by create_date desc, vacantsea_id desc";
        if(!$count) $str.=" LIMIT 5";

        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }

    /* === Function Search === */
    function getSearchVacant($search, $dept_id="", $rank_id="", $count=false)
    {
        $str = "select * from vacantsea where ((vacantsea like '%$search%' or description like '%$search%')";
        if(!empty($dept_id)) $str.=" and department = '$dept_id'";
        if(!empty($rank_id)) $str.=" and rank_id = '$rank_id'";

        $str.=") order by create_date desc, vacantsea_id desc";
        if(!$count) $str.=" LIMIT 5";

        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }
    /* === End Here === */

    function get_company_vacantsea($id_perusahaan, $count=false)
    {
        $str = "select * from vacantsea where id_perusahaan = '$id_perusahaan' order by create_date desc, vacantsea_id desc";
        if(!$count) $str.=" LIMIT 5";

        $q = $this->db->query($str);
        $f = $q->result_array();

        return $f;
    }

    function get_vacantsea_id($vacantsea_id)
    {
        $str = "select * from vacantsea where vacantsea_id = $vacantsea_id ";
        $q = $this->db->query($str);
        return $f = $q->row_array();
    }

    function search_vacantsea($keyword = "", $department = "", $rank_id = "", $ship_type = "")
    {
        //$keyword = $this->input->get("");
        // $page = $this->input->get("page"); // untuk dikirimkan kembali ke ajax

        // $keyword = $this->input->get("keyword");
        // $department = $this->input->get("department");
        // $rank_id = $this->input->get("rank_id");
        // $ship_type = $this->input->get("ship_type");

        $str  = "select * from vacantsea where 			  ";

        if($keyword != "querykey"){
            $str .= "( vacantsea LIKE '%$keyword%'			  ";
            $str .= "or perusahaan LIKE '%$keyword%'		  ";
            $str .= "or description LIKE '%$keyword%') or ";
        }

        if($rank_id!=""){
            $str .= "(department = '$department' 		 and   ";
            $str .= "rank_id = '$rank_id')				 OR	  ";
        }
        else{//if($keyword=="department") {
            $str .= "department = '$department' 		 OR   ";
            $str .= "rank_id = '$rank_id'				 OR	  ";
        }
        $str .= "ship_type = '$ship_type'		 	  	  ";


        $str .= "order by vacantsea_id desc limit 3  ";
//			 echo $str;
        //echo $str; exit;
        // echo $str." --> Hello World";
        $q = $this->db->query($str);
        $f = $q->result_array();
        // $hasil = array('job' => $f,
        // 'keyword' => $keyword,
        // 'department' => $department,
        // 'rank_id' => $rank_id,
        // 'ship_type' => $ship_type,
        // 'page' => $page);

        //echo json_encode(array());
        return $f; // dikirim ke controller vacantsea, function search_vacantsea

    }

    function search_vacantsea_plus($keyword="", $department="", $rank_id="", $ship_type="", $vacantsea_id="", $jml_setting="")
    {
        //$keyword = $this->input->get("");

        // $keyword = $this->input->GET("keyword");
        // $department = $this->input->GET("department");
        // $rank_id = $this->input->GET("rank_id");
        // $ship_type = $this->input->GET("ship_type");

        // $vacantsea_id = $this->input->post('vacantsea_id');
        //echo $vacantsea_id; exit;

        // $jml_setting = $this->input->post('jml_setting');

        $str  = "select * from vacantsea where (vacantsea_id < '$vacantsea_id') and ";

        if(!empty($keyword))
        {
            $str .= "(vacantsea like '%$keyword%' 			";
            $str .= "or perusahaan like '%$keyword%'   		";
            $str .= "or description like '%$keyword%'  		";
        }

        if(!empty($department))
        {
            $str .= "or department = '$department' 	";
        }

        if(!empty($rank_id))
        {
            $str .= "or rank_id = '$rank_id'			";
        }

        if(!empty($ship_type))
        {
            $str .= "or ship_type = '$ship_type')	";

        }

        $str .= "order by vacantsea_id desc limit 3  ";
        // echo $str;
        $q = $this->db->query($str);
        $f = $q->result_array();

        // $hasil = array('job_plus' => $f)
        // 'keyword' => $keyword,
        // 'department' => $department,
        // 'rank_id' => $rank_id,
        // 'ship_type' => $ship_type,
        // "page" => $page);

        return $f;

    }

    function jml_applicant($id_vacantsea = "",$id_pelaut = "")
    {
        // berdasarkan jumlah pihak( kandidat ) yang melamar di 1 vacantsea
        $str = "select * from applicant_tr where id_vacantsea = '$id_vacantsea' and id_pelaut <> '$id_pelaut' group by id_pelaut ";
        $q = $this->db->query($str);
        $f = $q->num_rows();

        return $f;
    }


    // list applicant by vacantsea
    function applicant_vacantsea($id_vacantsea,$id_pelaut)
    {
        // berdasarkan jumlah pihak( kandidat ) yang melamar di 1 vacantsea
        $str = "select * from applicant_tr where id_vacantsea = '$id_vacantsea' and id_pelaut <> '$id_pelaut' group by id_pelaut ";
        $q = $this->db->query($str);
        $f = $q->result_array();

        return $f;
    }

    function jml_applied($id_pelaut = "")
    {
        // berdasarkan vacantsea dan pelaut_id yang melamar
        $str = "select * from applicant_tr where id_pelaut = '$id_pelaut' group by id_vacantsea ";
        $q = $this->db->query($str);
        $f = $q->num_rows();

        return $f;
    }

    function list_applied($id_pelaut = "")
    {
        // berdasarkan vacantsea dan pelaut_id yang melamar
        $str = "select * from applicant_tr where id_pelaut = '$id_pelaut' group by id_vacantsea ";
        $q = $this->db->query($str);
        $f = $q->result_array();

        return $f;
    }


    function check_applicant($id_vacantsea = "")
    {
        $username 	 = $this->session->userdata("username");

        $str = "select * from applicant_tr where id_vacantsea = '$id_vacantsea' and username = '$username' ";
        $q = $this->db->query($str);
        $f = $q->result_array();

        return $f;
    }

    function insert_applicant()
    {
        $username =  $this->session->userdata("username");
        if(!isset($username) || $username == "")
        {
            header("location:".base_url());
        }

        $id_pelaut 	= $this->input->post("id_pelaut",true);
        $promotion 	= $this->input->post("promotion",true);
        $file_resume  = $this->input->post("file_resume",true);
        $id_vacantsea = $this->input->post("id_vacantsea",true);

        $ip_address   = $_SERVER['REMOTE_ADDR'];

        $str 	 = "insert into applicant_tr set		 ";
        $str 	.= "id_pelaut    = '$id_pelaut'		,";
        $str 	.= "promotion 	  = '$promotion'		,";
        $str 	.= "file_resume  = '$file_resume'		,";
        $str 	.= "id_vacantsea = '$id_vacantsea'		,";

        $str 	.= "datetime     = now()		 		,";
        $str 	.= "ip_address   = '$ip_address'		,";
        $str 	.= "username     = '$username'			 ";

        //echo $str; exit;

        $q = $this->db->query($str);

    }

    function url_segment_db($vacantsea_id = 1)
    {
        //include "System/Core/Loader.php";
        // membentuk url yang mengarahkan ke detail vacantsea.
        $db = $this->get_vacantsea_id($vacantsea_id);

        $split_str = explode(" ",$db['vacantsea']);
        $str_join = strtolower(implode("-",$split_str));


        $segment1 = "vacantsea";



        $segment2 = $db['vacantsea_id'];

        $replace_segment3 = array(
            "/" => '',
            "," => ''


        );

        $str_replace = str_replace(array_keys($replace_segment3),array_values($replace_segment3),$str_join);

        $segment3 = trim($str_replace);

        return base_url("$segment1/$segment2/$segment3");


    }

    function detail_vacantsea($vacantsea_id)
    {

        $str = "select * from vacantsea where vacantsea_id = '$vacantsea_id' ";
        $q = $this->db->query($str);
        $f = $q->row_array();

        return $f;

    }

    function get_data_perusahaan($id_perusahaan)
    {
        $str = "select * from perusahaan where id_perusahaan = '$id_perusahaan' ";
        $q = $this->db->query($str);
        $f = $q->row_array();

        return $f;
    }

    function department_list()
    {
        // $vacantsea_id = $this->input->post('vacantsea_id');

        // $jml_setting = $this->input->post('jml_setting');

        $str = "select * from department order by department_id asc"; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function list_vacantsea_by_rank($rank_id)
    {
        # code...
        $str = "select * from vacantsea where rank_id = '$rank_id'"; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function rank_department($id_department)
    {
        // $vacantsea_id = $this->input->post('vacantsea_id');

        // $jml_setting = $this->input->post('jml_setting');

        $str = "select * from rank where id_department = '$id_department'"; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacant_by_department($id_department)
    {
        // $vacantsea_id = $this->input->post('vacantsea_id');

        // $jml_setting = $this->input->post('jml_setting');

        $str = "select * from vacantsea where department = '$id_department'"; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacantsea_limit()
    {
        $vacantsea_id = $this->input->post('vacantsea_id');

        $jml_setting = $this->input->post('jml_setting');

        $str = "select * from vacantsea order by vacantsea_id desc limit 10 "; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacantsea_limit_by_department($id_department)
    {
//            $vacantsea_id = $this->input->post('vacantsea_id');
//
//            $jml_setting = $this->input->post('jml_setting');

        //$str = "select * from vacantsea where id_perusahaan = '$id_department' order by vacantsea_id desc limit 10 "; //harusnya ada order by createdate

        $str = "select * from vacantsea order by vacantsea_id desc limit 10 "; //harusnya ada order by createdate


//            echo $str;
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacantsea_limit_plus()
    {
        $vacantsea_id = $this->input->post('vacantsea_id');
        //echo $vacantsea_id; exit;

        $jml_setting = $this->input->post('jml_setting');

        $str = "select * from vacantsea where vacantsea_id < '$vacantsea_id'  order by vacantsea_id desc limit 10"; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();


    }

    function check_sisa_list($vacantsea_id){

        $str = "select * from vacantsea where vacantsea_id < '$vacantsea_id'  order by vacantsea_id desc limit 3";
        $q = $this->db->query($str);
        $f = $q->num_rows();

        return $f;
    }

    function check_sisa_list_search($vacantsea_id, $keyword, $department, $rank_id){

        $str = "select * from vacantsea where (vacantsea_id < '$vacantsea_id') and (vacantsea like '%$keyword%' or perusahaan like '%$keyword%' or description like '%$keyword%' or department = '$department' or rank_id = '$rank_id') order by vacantsea_id desc limit 3";
        $q = $this->db->query($str);
        $f = $q->num_rows();

        return $f;
    }

    function call_ship_type()
    {
        $this->load->model('vessel_model'); // ship
        return $f = $this->vessel_model->get_ship_type();
    }

    function call_department()
    {
        $str = "select * from department";
        $q = $this->db->query($str);
        return $f = $q->result_array();
    }

    function call_rank()
    {
        $id_department = $this->input->post('id_department');
        $str = "select * from rank where id_department = '$id_department'";
        $q = $this->db->query($str);
        return $f = $q->result_array();
    }

    function call_coc()
    {
        $str = "select * from coc_class";
        $q = $this->db->query($str);
        return $f = $q->result_array();
    }
}

?>