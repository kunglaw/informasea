<?php

// class vacantsea model, module vacantsea;

if(!defined('BASEPATH')) exit ('no direct script access allowed ');

class vacantsea_model extends CI_Model{
	
 private $quniv = "SELECT 
				vacantsea.*, 
				perusahaan.id_perusahaan, 
				perusahaan.activation_code, 
				perusahaan_setting.*
				
				FROM vacantsea,perusahaan,perusahaan_setting
				
				WHERE 
					
					perusahaan.id_perusahaan = vacantsea.id_perusahaan AND 
					perusahaan.id_perusahaan = perusahaan_setting.id_perusahaan
					
					AND perusahaan_setting.status = 'VERIFIED' 
					AND perusahaan.activation_code = 'ACTIVE' 
					
					AND vacantsea.stat = 'open'
					AND perusahaan.official = 'Agent'
					
        		 "; 
	/* private $quniv = "SELECT 
				vacantsea.*, 
				perusahaan.id_perusahaan, 
				perusahaan.activation_code, 
				perusahaan_setting.*
				
				FROM vacantsea,perusahaan,perusahaan_setting
				
				WHERE 
					
					vacantsea.data_scrap <> '' AND vacantsea.stat = 'open' OR ( 
					
					perusahaan_setting.status = 'VERIFIED' 
					AND perusahaan.activation_code = 'ACTIVE' 
                    AND perusahaan.official = 'Agent'
                        
                    )
					
					GROUP BY vacantsea.vacantsea_id 
					
					
					
        		 "; */
	
	function __construct()
	{
		parent::__construct();
		
			
	}
	//								$f , "create_date", "desc"
	private function bubble_short($f,$field,$sort)
	{
		$array_size = count($f);
		for($i = 0; $i < $array_size; $i ++) {
			for($j = 0; $j < $array_size; $j ++) {
				if($sort == "desc")
				{
				  if ($f[$i]["$field"] > $f[$j]["$field"]) {
					  
					  $tem = $f[$i];
					  $f[$i] = $f[$j];
					  $f[$j] = $tem;
					  
				  }
				}
				else // asc
				{
				  if ($f[$i]["$field"] < $f[$j]["$field"]) {
					  
					  $tem = $f[$i];
					  $f[$i] = $f[$j];
					  $f[$j] = $tem;
					  
				  }
					
				}
			}
		}
		return $f;
		
		
	}
	
    function get_vacantsea()
    {
        $sql = $this->db->get_where("vacantsea",array("stat"=>"open"));

        $f = $sql->result_array();

        return $f;

    }
	
	// buat modal insert_vacantsea
	function insert_vacantsea()
	{
		$vacantsea_title = $this->input->post("vacantsea_title");
		$id_perusahaan   = $this->input->post("id_perusahaan");
		$perusahaan	  = $this->input->post("perusahaan");
		//$description	 = $this->input->post("description");
		
		$department	  = $this->input->post("department");
		$rank_id 		 = $this->input->post("rank_id");
		$ship_type	   = $this->input->post("ship_type");
		
		//$nav_area		= $this->input->post("navigation_area");
		$annual_sallary  = $this->input->post("annual_sallary");
		$sallary_range   = $this->input->post("sallary_range"); 
		
		//$contract_dynamic= $this->input->post("contract_dynamic");
		//$benefits		= $this->input->post("benefits");
		//$nationality	 = $this->input->post("nationality"); 
		
		$str  = "INSERT into vacantsea SET 					 ";
		$str .= "vacantsea			= '$vacantsea_title'	,";
		$str .= "id_perusahaan		= '$id_perusahaan'		,";
		$str .= "perusahaan			= '$perusahaan'			,";
		//$str .= "description		= '$description'		,";
		$str .= "department			= '$department'			,";
		$str .= "rank_id			= '$rank_id' 			,";
		$str .= "ship_type			= '$ship_type'			,";
		//$str .= "navigation_area	= '$nav_area'			,";
		$str .= "annual_sallary 	= '$annual_sallary'		,";
		$str .= "sallary_range		= '$sallary_range'		 ";
		//$str .= "contract_dynamic	= '$contract_dynamic'	,";
		//$str .= "benefits			= '$benefits'			,";
		//$str .= "nationality		= '$nationality'		,";
		
		$q = $this->db->query($str);	
		
		return $q;
	}
	
    function get_last_vacantsea(){
        $str = $this->quniv."ORDER BY create_date ASC, vacantsea_id DESC limit 10";

        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;

    }
	
	function vacantsea_view($id_vacantsea)
	{
		$str = "SELECT * FROM log_vacantsea WHERE vacantsea_id = '$id_vacantsea'";	
		$q   = $this->db->query($str);
		$f   = $q->result_array();
		
		return $f;
		
	}

    // untuk panel - right
    function get_vacantsea_panel($count=false, $offset=0)
    {
		
	   $now = date("Y-m-d H:i:s");
	   
       $str = "SELECT a.vacantsea,
					   a.expired_date,
					   a.create_date,
					   a.vacantsea_id,
					   a.navigation_area,
					   a.annual_sallary,
					   a.contract_type,
					   a.contract_dynamic,
					   a.department,
					   a.rank_id,
					   a.ship_type,
					   a.perusahaan,
					   
					   b.id_perusahaan,
					   b.nama_perusahaan
					   
					   FROM 
					   
					   vacantsea a, perusahaan b
					   
					   WHERE 
					   
					   (a.id_perusahaan = b.id_perusahaan )
					   
					   AND b.activation_code = 'ACTIVE'  AND stat = 'open' AND a.expired_date > '$now'
					   
					   ORDER BY a.create_date DESC"; // AND tampil = 1 
					   
           if(!$count) $str.=" LIMIT $offset, 5";

//        echo $str;
        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }

//     function get_vacantsea_panel_a($count=false, $offset=0)
//     {
//         $str = "SELECT * FROM vacantsea order by create_date desc, vacantsea_id desc";
//         if(!$count) $str.=" LIMIT $offset, 10";

// //        echo $str;
//         $q = $this->db->query($str);
//         $f = $q->result_array();
//         return $f;
//     }


    function get_vacantsea_panel_a($count=false, $offset=0)
    {

        $str = $this->quniv."ORDER BY vacantsea.expired_date DESC";

        if(!$count) $str.=" LIMIT $offset, 10";

        //  echo $str."<br>";

        $q = $this->db->query($str);
        $f = $q->result_array();
		
		$result = $this->bubble_short($f,"create_date","desc");
		
        return $result;
    }


    function get_vacantsea_panel_plus($id_vacantsea, $count=false)
    {
        $str = $this->quniv."AND vacantsea_id < '$id_vacantsea'  
				ORDER BY vacantsea.create_date desc, vacantsea.vacantsea_id DESC";
        
		if(!$count) $str.=" LIMIT 5";

        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }

    function get_vacantsea_panel_minus($id_vacantsea, $count=false)
    {
        $str = $this->quniv."ORDER BY vacantsea.create_date ASC, vacantsea.vacantsea_id ASC";
        if(!$count) $str.=" LIMIT 5";
        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }


    // function get_vacantsea_panelbydept($id_dept,$count=false)
    // {
    //     $str = "select * from vacantsea where department = '$id_dept' order by create_date desc, vacantsea_id desc";
    //     if(!$count) $str.=" LIMIT 5";

    //     $q = $this->db->query($str);
    //     $f = $q->result_array();
    //     return $f;
    // }


    function get_vacantsea_panelbydept($id_dept,$count=false,$limit)
    {
        $str = $this->quniv."AND vacantsea.department = '$id_dept' ORDER BY 
				vacantsea.expired_date DESC, vacantsea.create_date DESC";
        if(!$count) $str.=" LIMIT $limit, 10";


       // echo $str;

        $q = $this->db->query($str);
        $f = $q->result_array();
		
		$result = $this->bubble_short($f,"create_date","desc");
		
        return $result;
    }


    /* === Function Search === */
    function getSearchVacant($keyword, $dept_id=0, $rank_id=0, $sallary="", $count=false, $limit=0)
    {
        $between = false;
        if($sallary === 0) $sallary = "";
        if ($sallary != "") {
            if (strpos($sallary, "-")) {
                $between = true;
                $sallary = explode('-', $sallary);
            }
            else{
                if(strpos($sallary, "%3E")==0) $sallary = str_replace("%3E",">",$sallary);
                if(strpos($sallary, "%3C")==0) $sallary = str_replace("%3C","<",$sallary);
            }
        }



        $str = $this->quniv;
		
        if (!empty($sallary) || !empty($keyword) || $dept_id != 0 || $rank_id != 0) 
		
		$str .= " AND ( 
		perusahaan.id_perusahaan = vacantsea.id_perusahaan ) AND ( ";
				
		else  
		
		$str .= "AND ( perusahaan.id_perusahaan = vacantsea.id_perusahaan )";

        /* Keyword */
        if (!empty($keyword)) $str .= "(vacantsea like '%$keyword%' or perusahaan like '%$keyword%')";

        /* Department and Rank */
        if ($dept_id != 0 && empty($keyword)) $str .= " department = '$dept_id'";
        else if ($dept_id != 0 && !empty($keyword) && $rank_id == 0) $str .= " AND department = '$dept_id'";
        if ($dept_id != 0 && $rank_id != 0) $str .= " AND rank_id = '$rank_id'";

        /* Sallary */
        if (!empty($keyword) && ($sallary != "" && $between && $dept_id!=0)) $str .= " AND annual_sallary between " . $sallary[0] . " AND " . $sallary[1];
        elseif (!empty($keyword) && ($sallary != "" && !$between && $dept_id!=0)) $str .= " AND annual_sallary $sallary";
        elseif (empty($keyword) && $sallary != "" && $between && $dept_id!=0) $str .= " AND annual_sallary between " . $sallary[0] . " AND " . $sallary[1];
        elseif (empty($keyword) && $sallary != "" && !$between&& $dept_id!=0) $str .= " AND annual_sallary $sallary";
        elseif (empty($keyword) && $sallary != "" && $between && $dept_id==0) $str .= " annual_sallary between " . $sallary[0] . " AND " . $sallary[1];
        elseif (empty($keyword) && $sallary != "" && !$between&& $dept_id==0) $str .= " annual_sallary $sallary";
        
		if (!empty($sallary) || !empty($keyword) || $dept_id != 0 || $rank_id != 0) $str .= ") ";

        $str .= " AND perusahaan.tampil=1 order by vacantsea.expired_date DESC";
        if (!$count) $str .= " LIMIT $limit,10";
        //echo "<br><b>".$str."</b><br>";
        $q = $this->db->query($str);
        $f = $q->result_array();
		
		$result = $this->bubble_short($f,"create_date","desc");
		
        return $result;
    }

    function vacantsea_terkait($rank,$vessel,$id){

        $now = date('Y-m-d');
        $str = $this->quniv."AND (vacantsea.rank_id = '$rank' OR vacantsea.ship_type = '$vessel') AND vacantsea.vacantsea_id <> '$id' 
				AND vacantsea.expired_date >= $now ORDER BY expired_date DESC LIMIT 8";
				
        $q = $this->db->query($str);
        $f = $q->result_array();
        //echo $str;
        return $f;

    }


    function getSearchVacantnew($keyword, $vessel_id = 0, $dept_id=0, $rank_id=0, $count=false, $limit=0)
    {
      
        $str = $this->quniv;
				
        if (!empty($keyword) || $vessel_id != 0 || $dept_id != 0 || $rank_id != 0) $str .= " AND (";

        /* Keyword */
        if (!empty($keyword)) $str .= "(vacantsea like '%$keyword%' or perusahaan like '%$keyword%')";

        /* Department and Rank */


        /* ship */

        if($vessel_id != 0 && empty($keyword)) $str .= " ship_type = '$vessel_id'";
        else if($vessel_id != 0 && !empty($keyword)) $str .= " AND ship_type = '$vessel_id'";

        if ($dept_id != 0 && empty($keyword) && $vessel_id == 0) $str .= " department = '$dept_id'";
        else if ($dept_id != 0 && (!empty($keyword) OR $vessel_id != 0) && $rank_id == 0) $str .= " and department = '$dept_id'";
        if ($dept_id != 0 && $rank_id != 0) $str .= " and rank_id = '$rank_id'";

        if(!empty($keyword) OR $vessel_id != 0 OR $dept_id != 0 OR $rank_id !=0) $str .= ")";


        $str .= " order by vacantsea.expired_date DESC";

        if (!$count) $str .= " LIMIT $limit,10";
        //echo "<br><b>".$str."</b><br>";
       //     echo "<br><b>".$str."</b><br>";
        //echo $str;
        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }


    function getSearchVacantDashboard($keyword, $vessel_id=0, $dept_id=0, $nationality_id='', $count=false, $limit=0)
    {
        $str = $this->quniv;
		
        if (!empty($nationality_id) || !empty($keyword) || $dept_id != 0 || $vessel_id != 0) $str .= " AND (";

        /* Keyword */
        if (!empty($keyword)) $str .= "(vacantsea like '%$keyword%' or perusahaan like '%$keyword%')";

        /* Vessel Type */
        if ($vessel_id != 0 && empty($keyword)) $str .= " ship_type = '$vessel_id'";
        else if ($vessel_id != 0 && !empty($keyword)) $str .= " and ship_type = '$vessel_id'";

        /* Department */
        if ($dept_id != 0 && empty($keyword) && $vessel_id == 0) $str .= " department = '$dept_id'";
        else if($dept_id != 0 && (!empty($keyword) OR $vessel_id != 0 OR !empty($nationality_id))) $str .= " and department = '$dept_id'";

        /* Nationality */
        if (!empty($nationality_id) && (!empty($keyword) OR $vessel_id != 0 OR $dept_id != 0)){
            $str .= " AND vacantsea.id_nationality = '$nationality_id'";
            /* echo "<script>alert('aku disini');</script>"; */
        } 
        else if (!empty($nationality_id) && !empty($keyword)){
            $str .= " AND vacantsea.id_nationality = '$nationality_id'";
        } 
        else if (!empty($nationality_id) && empty($keyword) && $vessel_id == 0 && $dept_id == 0) {
            $str .= " vacantsea.id_nationality = '$nationality_id'";
            /* echo "<script>alert('aku disini');</script>"; */
        } else if($nationality_id == ''){

        }
//        /* Sallary */
//        if (!empty($keyword) && ($sallary != "" && $between && $dept_id!=0)) $str .= " and annual_sallary between " . $sallary[0] . " and " . $sallary[1];
//        elseif (!empty($keyword) && ($sallary != "" && !$between && $dept_id!=0)) $str .= " and annual_sallary $sallary";
//        elseif (empty($keyword) && $sallary != "" && $between && $dept_id==0) $str .= " annual_sallary between " . $sallary[0] . " and " . $sallary[1];
//        elseif (empty($keyword) && $sallary != "" && !$between&& $dept_id==0) $str .= " annual_sallary $sallary";
        if (!empty($nationality_id) || !empty($keyword) || $dept_id != 0 || $vessel_id != 0) $str .= ") ";
        
        $str .= "ORDER BY vacantsea.expired_date DESC";
        if (!$count) $str .= " LIMIT $limit,10 ";

      //echo "<br><b>".$str."</b><br>";
        //echo $str."<br>";
        $q = $this->db->query($str);

        //echo "<br><B>".$q->num_rows()."<br></b>";
        $f = $q->result_array();
        return $f;
    }

//      function getSearchVacantDashboard($keyword, $vessel_id=0, $dept_id=0, $nationality_id='', $count=false, $limit=0)
//     {
//         $str = "select * from vacantsea ";
//         if (!empty($nationality_id) || !empty($keyword) || $dept_id != 0 || $vessel_id != 0) $str .= " where (";

//         /* Keyword */
//         if (!empty($keyword)) $str .= "(vacantsea like '%$keyword%' or perusahaan like '%$keyword%')";

//         /* Vessel Type */
//         if ($vessel_id != 0 && empty($keyword)) $str .= " ship_type = '$vessel_id'";
//         else if ($vessel_id != 0 && !empty($keyword)) $str .= " and ship_type = '$vessel_id'";

//         /* Department */
//         if ($dept_id != 0 && empty($keyword) && $vessel_id == 0) $str .= " department = '$dept_id'";
//         else if($dept_id != 0 && (!empty($keyword) OR $vessel_id != 0 OR !empty($nationality_id))) $str .= " and department = '$dept_id'";

//         /* Nationality */
//         if (!empty($nationality_id) && (!empty($keyword) OR $vessel_id != 0 OR $dept_id != 0)){
//             $str .= " AND id_nationality = '$nationality_id'";
//             
//         } 
//         else if (!empty($nationality_id) && !empty($keyword)){
//             $str .= " AND id_nationality = '$nationality_id'";
//            
//         } 
//         else if (!empty($nationality_id) && empty($keyword) && $vessel_id == 0 && $dept_id == 0) {
//             $str .= " id_nationality = '$nationality_id'";
//             
//         } else if($nationality_id == ''){

//         }
// //        /* Sallary */
// //        if (!empty($keyword) && ($sallary != "" && $between && $dept_id!=0)) $str .= " and annual_sallary between " . $sallary[0] . " and " . $sallary[1];
// //        elseif (!empty($keyword) && ($sallary != "" && !$between && $dept_id!=0)) $str .= " and annual_sallary $sallary";
// //        elseif (empty($keyword) && $sallary != "" && $between && $dept_id==0) $str .= " annual_sallary between " . $sallary[0] . " and " . $sallary[1];
// //        elseif (empty($keyword) && $sallary != "" && !$between&& $dept_id==0) $str .= " annual_sallary $sallary";
//         if (!empty($nationality_id) || !empty($keyword) || $dept_id != 0 || $vessel_id != 0) $str .= ") ";
        
//         $str .= " order by create_date desc, vacantsea_id desc";
//         if (!$count) $str .= " LIMIT $limit,5 ";

//       //echo "<br><b>".$str."</b><br>";

//         $q = $this->db->query($str);

//         //echo "<br><B>".$q->num_rows()."<br></b>";
//         $f = $q->result_array();
//         return $f;
//     }
    /* === End Here === */
	
	/* === List Vacantsea applied by applicant/pelaut  ==== */
	function list_vacantsea_byapplicant($key) 
	{
		$str = "SELECT * FROM applicant_tr WHERE id_pelaut = '$key' AND hiring IS NULL ";
		$q   = $this->db->query($str);
		$f   = $q->result_array(); // sudah dapat id_vacantsea nya 
		
		
		$vacantsea = array();
		
		if(!empty($f))
		{
			foreach($f as $row)
			{
				
				//print_r($this->detail_vacantsea($row['id_vacantsea']));
				$vacantsea[] = $this->detail_vacantsea($row['id_vacantsea']);
			}
		}
		
		return $vacantsea;
			
	}
	
    function get_company_vacantsea($id_perusahaan, $count=false)
    {
        $str = $this->quniv."AND id_perusahaan = '$id_perusahaan' 
				order by vacantsea.expired_date DESC";
				
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

        $str  = $this->quniv."AND ";

        if($keyword != "querykey"){
            $str .= "( vacantsea LIKE '%$keyword%'            ";
            $str .= "or perusahaan LIKE '%$keyword%'          ";
            $str .= "or description LIKE '%$keyword%') or ";
        }

        if($rank_id!=""){
            $str .= "(department = '$department'         and   ";
            $str .= "rank_id = '$rank_id')               OR   ";
        }
        else{//if($keyword=="department") {
            $str .= "department = '$department'          OR   ";
            $str .= "rank_id = '$rank_id'                OR   ";
        }
        $str .= "ship_type = '$ship_type'                 ";


        $str .= "order by vacantsea_id desc limit 3  ";
//           echo $str;
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

        $str  = $this->quniv."AND 
				
				(vacantsea_id < '$vacantsea_id') and ";

        if(!empty($keyword))
        {
            $str .= "(vacantsea like '%$keyword%'           ";
            $str .= "or perusahaan like '%$keyword%'        ";
            $str .= "or description like '%$keyword%'       ";
        }

        if(!empty($department))
        {
            $str .= "or department = '$department'  ";
        }

        if(!empty($rank_id))
        {
            $str .= "or rank_id = '$rank_id'            ";
        }

        if(!empty($ship_type))
        {
            $str .= "or ship_type = '$ship_type')   ";

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

    function list_applied_vacantsea_seaman($id_pelaut,$count=FALSE,$offset){
        $str = "SELECT * FROM applicant_tr WHERE id_pelaut = '$id_pelaut' group by id_vacantsea ";

            if(!$count){
                $str .= "LIMIT $offset,5";
            }

        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }


    function check_applicant($id_vacantsea = "")
    {
        $username    = $this->session->userdata("username");

        $str = "select * from applicant_tr where id_vacantsea = '$id_vacantsea' and username = '$username' ";
        $q = $this->db->query($str);
        $f = $q->row_array();

        return $f;
    }

    function insert_applicant()
    {
        $username =  $this->session->userdata("username");
        if(!isset($username) || $username == "")
        {
            header("location:".base_url());
        }

        $id_pelaut  = $this->input->post("id_pelaut",true);
        $promotion  = $this->input->post("promotion",true);
        $file_resume  = $this->input->post("file_resume",true);
        //$id_vacantsea = $this->input->post("id_vacantsea",true);
		$id_vacantsea = $this->input->post("vacantsea_id",TRUE); 

        $ip_address   = $_SERVER['REMOTE_ADDR'];

        $str     = "insert into applicant_tr set         ";
        $str    .= "id_pelaut    = '$id_pelaut'     	 ,";
        $str    .= "promotion    = '$promotion'         ,";
        $str    .= "file_resume  = '$file_resume'       ,";
        $str    .= "id_vacantsea = '$id_vacantsea'      ,";

        $str    .= "datetime     = now()                ,";
        $str    .= "ip_address   = '$ip_address'        ,";
        $str    .= "username     = '$username'           ";

        //echo $str; exit;

        $this->db->query($str);

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

        $str = $this->quniv."AND 
				
				department = '$id_department'"; //harusnya ada order by createdate
				
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacantsea_limit()
    {
        $vacantsea_id = $this->input->post('vacantsea_id');

        $jml_setting = $this->input->post('jml_setting');

        $str = $this->quniv."
				
				order by vacantsea.create_date desc limit 10 "; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacantsea_limit_by_department($id_department)
    {
//            $vacantsea_id = $this->input->post('vacantsea_id');
//
//            $jml_setting = $this->input->post('jml_setting');

        //$str = "select * from vacantsea where id_perusahaan = '$id_department' order by vacantsea_id desc limit 10 "; //harusnya ada order by createdate

        $str = $this->quniv."			
				order by vacantsea.vacantsea_id desc limit 10 "; //harusnya ada order by createdate


//            echo $str;
        $q = $this->db->query($str);

        return $f = $q->result_array();
    }

    function vacantsea_limit_plus()
    {
        $vacantsea_id = $this->input->post('vacantsea_id');
        //echo $vacantsea_id; exit;

        $jml_setting = $this->input->post('jml_setting');

        $str = $this->quniv."				
				vacantsea_id < '$vacantsea_id'  order by vacantsea_id desc limit 10"; //harusnya ada order by createdate
        $q = $this->db->query($str);

        return $f = $q->result_array();


    }

    function check_sisa_list($vacantsea_id){

        $str = $this->quniv."AND 
				
				vacantsea_id < '$vacantsea_id'  order by vacantsea_id desc limit 3";
        $q = $this->db->query($str);
        $f = $q->num_rows();

        return $f;
    }

    function check_sisa_list_search($vacantsea_id, $keyword, $department, $rank_id){

        $str = $this->quniv."AND 
				
				(vacantsea_id < '$vacantsea_id') and (vacantsea like '%$keyword%' or perusahaan like '%$keyword%' or vacantsea.description like '%$keyword%' or department = '$department' or rank_id = '$rank_id') order by create_date desc limit 3";
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
    function list_applied_vacantsea(){
        $str = "SELECT * FROM applicant_tr WHERE id_pelaut = '$id_pelaut' group by id_vacantsea ORDER BY datetime DESC LIMIT 5";
        $q = $this->db->query($str);
        $f = $q->result_array();
        return $f;
    }

    function get_detail_applicant($id_aplicant = ''){
        $str = "SELECT * FROM applicant_tr WHERE id_aplicant = '$id_aplicant'";
        $q = $this->db->query($str);
        $f = $q->row_array();
        return $f;
    }
     function GetApplicant($where){
        $sql    = "select * from applicant_tr ".$where;
    
        $query  = $this->db->query($sql);
        return $query;
    }


    function get_photo_company($username){
        $str = "SELECT * FROM photo_perusahaan_tr WHERE username = '$username' AND profile_pic = 1";
        $q = $this->db->query($str);
        $f = $q->row_array();
        return $f;
    }
}