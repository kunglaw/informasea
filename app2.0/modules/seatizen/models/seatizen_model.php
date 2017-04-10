<?php // model seatizen, module seatizen;
	
	if(!defined('BASEPATH')) exit ('No Direct Script Access allowed');
	
	class Seatizen_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		public function seatizen_list()
		{
			$username = $this->session->userdata("username");
			
			if($username == "")
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and `show` = 'TRUE' order by pelaut_id desc";
			}
			else
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and `show` = 'TRUE' and username <> '$username' order by pelaut_id desc ";
			}
			$q = $this->db->query($str);
			$f = $q->result_array();			
			return $f;				
		}
		
		
		function list_seatizen_panel($limit = 5)
		{
			$username = $this->session->userdata("username");
			
			if($username == "")
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and `show` = 'TRUE' order by pelaut_id desc LIMIT $limit";
			}
			else
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and `show` = 'TRUE' and username <> '$username' order by pelaut_id desc LIMIT $limit";
			}
			$q = $this->db->query($str);
			$f = $q->result_array();			
			return $f;			
		}
		
		function suggested_friend($param )
		{
			$by 		 = $param["by"];
			$limit 	  = $param["limit"];
			$id_pelaut  = $param["detail_pelaut"]["pelaut_id"];
			$kebangsaan = $param["detail_pelaut"]["kebangsaan"];
			$rank	   = $param["detail_pelaut"]["rank"];	  
			
			if(!empty($id_pelaut))
			{
				$non_id_user = " AND a.pelaut_id <> $id_pelaut ";
				$syrat = "AND ( b.rank = '$kebangsaan' OR a.kebangsaan = '$kebangsaan') and `show` = 'TRUE' ";
			}
			else
			{
				$syarat = "";	
			}
			
			if(!empty($limit))
			{
				$limit = "limit $limit";	
			}
			
			
			if($by == "nationality")
			{
				$str  = "SELECT * FROM pelaut_ms a, profile_resume_tr b ";	
				$str .= "WHERE a.pelaut_id = b.pelaut_id ";
				$str .= "AND a.kebangsaan = '$kebangsaan' ";
				$str .= "AND activation = 'ACTIVE' $non_id_user and `show` = 'TRUE' ";
				$str .= $limit;
				
			}
			else if($by == "rank")
			{
				$str  = "SELECT * FROM pelaut_ms a, profile_resume_tr b ";	
				$str .= "WHERE a.pelaut_id = b.pelaut_id ";
				$str .= "AND b.rank = '$rank' ";
				$str .= "AND activation = 'ACTIVE' $non_id_user and `show` = 'TRUE' ";
				$str .= $limit;
			}
			else
			{	
				$str  = "SELECT * FROM pelaut_ms a, profile_resume_tr b ";	
				$str .= "WHERE a.pelaut_id = b.pelaut_id ";
				$str .= $syarat;
				$str .= "AND activation = 'ACTIVE' $non_id_user and `show` = 'TRUE'";
				$str .= $limit;
			}
			
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;
			
			
		}
		
		function record_seatizen(){
			$str = "select * from pelaut_ms where activation = 'ACTIVE' and `show` = 'TRUE'";
			$q = $this->db->query($str);
			$f = $q->num_rows();
			return $f;
		}
		
		function list_seatizen($count = false, $offset = 0){
			
			$offset = $this->uri->segment(3);
			if($offset > 1){

			$offset = $offset * 20;
			$offset = $offset - 20;
			} else {
				$offset = 0;
			}
			$username = $this->session->userdata("username");
			
				$str = "select * from pelaut_ms ";
			
			if($username == ""){
				$str .= "where activation = 'ACTIVE' AND `show` = 'TRUE' order by pelaut_id desc";
			} else {
				$str .= "where activation = 'ACTIVE' AND `show` = 'TRUE' order by pelaut_id desc";	
			}
			if(!$count) $str .= " LIMIT $offset,20";
			

			$q = $this->db->query($str);
			$f = $q->result_array();
			return $f;

		
		}
		
		// untuk panel
		function list_seatizen_notfriend($username = "")
		{
			$hasil = array();
			if($username == "")
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' AND `show` = 'TRUE' order by pelaut_id DESC LIMIT 5";
				$q = $this->db->query($str);
				$f = $q->result_array();
				
				$hasil = $f;
				
			}	
			
			
			else
			{
				$str2 = "select * from pelaut_ms where activation = 'ACTIVE' and username = '$username' AND `show` = 'TRUE' ";
				$q2 = $this->db->query($str2);
				$f2 = $q2->row_array();
				$fs = explode("|",$f2['array_teman']);
				//print_r($fs);
				
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and username <> '$username' AND `show` = 'TRUE' order by pelaut_id DESC LIMIT 5";
				$q = $this->db->query($str);
				$f = $q->result_array();
				//print_r($fs);
				
				$i = 0;
				foreach($f as $row)
				{
					
					if(!in_array($row['pelaut_id'],$fs))
					{
						$hasil[] = $row;
					}
					
					if($i == 4)
					{
						break;	
					}
				}
				
			}
			
			return $hasil;
			
		}
		
		function check_seatizen($username) // untuk cek saat registrasi 
		{
			
			$str = "select * from pelaut_ms where username = '$username' ";// and activation = 'ACTIVE' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array();
			
			return $f; 	
			
		}

		function jumlah_teman($username){
			$str = "SELECT count(array_teman) FROM pelaut_ms WHERE username = '$username' and activation ='ACTIVE'";
			$q = $this->db->query($str);
			return $q;
		}
		
	
		function detail_seatizen($key)
		{
			
			$str = "select * from pelaut_ms where username = '$key' OR pelaut_id = '$key' "; //and activation = 'ACTIVE' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array();
			
			return $f; 	
			
		}

		function get_last_seatizen(){
			$username = $this->session->userdata("username");

			if(empty($username)){
			$str = "SELECT * FROM pelaut_ms WHERE `show` = 'TRUE' ORDER BY pelaut_id DESC
			LIMIT 10";
			}else{
				$str = "SELECT * FROM pelaut_ms where `show` = 'TRUE' AND username <> '$username' ORDER BY pelaut_id DESC
				LIMIT 10";
			}
			$q = $this->db->query($str);
			$r = $q->result_array();
			return $r;
		}
		
		function list_seatizen_lim()
		{
			$username = $this->session->userdata("username");
			
			$pelaut_id = $this->input->post('pelaut_id');	
			//echo $pelaut_id; exit;	
			
			$jml_setting = $this->input->post('jml_setting');
			
			if($username == "")
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' order by pelaut_id desc limit 5";
			}
			else
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and username <> '$username' order by pelaut_id desc limit 5";
			}
			
			$q = $this->db->query($str);
			$f = $q->result_array();			
			return $f;				
		}
		
		function list_seatizen_lim_plus()
		{   
		    $username = $this->session->userdata("username");
			
			$pelaut_id = $this->input->post('pelaut_id');	
			//echo $pelaut_id; exit;	
			
			$jml_setting = $this->input->post('jml_setting');
			
			if($username == "")
			{
				
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and pelaut_id < '$pelaut_id'  order by pelaut_id desc limit 5";
			}
			else
			{
				$str = "select * from pelaut_ms where activation = 'ACTIVE' and pelaut_id < '$pelaut_id' and username <> '$username'  order by pelaut_id desc limit 5";	
			}
			//harusnya ada order by createdate
			$q = $this->db->query($str);
			return $f = $q->result_array();
			
			
		}
		
		function check_sisa_list($pelaut_id){
			
			$username = $this->session->userdata("username");
			$str = "select * from pelaut_ms where activation = 'ACTIVE' and pelaut_id < '$pelaut_id' and username <> '$username'  order by pelaut_id desc";
			$q = $this->db->query($str);
			$f = $q->num_rows();
			
			return $f;
			
		}



		
		function seatizenSearch($search, $nationality = '' , $ship_id = 0 , $dept_id = 0, $rank = 0 ,$coc = 0 , $count=false,$offset = 0){
			$username = $this->session->userdata('username');

			$this->load->model('ship_model');
			$this->load->model('department_model');
			$this->load->model('rank_model');
			$this->load->model('coc_model');
			$search = str_replace('%20',' ',$search);
			$ship = $this->ship_model->get_detail_ship_type_by_name($search);
			$department = $this->department_model->get_detail_department_by_name($search);
			$rank_class = $this->rank_model->get_rank_detail_by_rank($search);
			$coc_class = $this->coc_model->get_detail_coc_by_name($search);

			//echo "Keyword : ".$search."<br>";



			$str = " SELECT pelaut_ms.pelaut_id,array_teman,friend_request,receive_request,nama_depan,nama_belakang,username,rank,kebangsaan,department FROM pelaut_ms LEFT JOIN profile_resume_tr ON pelaut_ms.pelaut_id = profile_resume_tr.pelaut_id WHERE activation = 'Active' and `show` = 'TRUE' ";

					if(!empty($username)){
						//$str .= " AND username <> '$username'";
					}

					if(!empty($ship)){
						$str  .= " AND profile_resume_tr.vessel_type = $ship[type_id] ";
					}

					if(!empty($department)){
						$str .= " AND profile_resume_tr.department = $department[department_id] ";
					}

					if(!empty($rank_class)){
						$str .= " AND profile_resume_tr.rank = $rank_class[rank_id] ";
					}

					if(!empty($coc_class)){
						$str .= " AND coc_class = $coc_class[id_coc_class] ";
					}

					if(!empty($ship) OR !empty($department) OR !empty($rank_class) OR !empty($coc_class)){
								if(!empty($search) OR !empty($nationality) OR $ship_id != 0 OR $dept_id != 0 OR $rank != 0 OR $coc != 0) $str .= "OR (";		
					}else{
						if(!empty($search) OR !empty($nationality) OR $ship_id != 0 OR $dept_id != 0 OR $rank != 0 OR $coc != 0) $str .= "AND (";
							
					}

								
					if(!empty($search)) $str .= "( pelaut_ms.nama_depan LIKE '%$search%' OR pelaut_ms.nama_belakang LIKE '%$search%' OR pelaut_ms.kebangsaan LIKE '%$search')";


					if(empty($search) AND $nationality != ''){

						$str .= " pelaut_ms.kebangsaan = '$nationality'";

					} else if(!empty($search) AND $nationality != ''){
						$str .= " AND pelaut_ms.kebangsaan = '$nationality'";
					}

					if(empty($search) AND empty($nationality) AND $ship_id != 0)  {
						$str .= " profile_resume_tr.vessel_type = '$ship_id'";
					} else if((!empty($search) OR !empty($nationality)) AND $ship_id != 0) {
						$str .= " AND profile_resume_tr.vessel_type = '$ship_id'";
					}

					if(empty($search) AND empty($nationality) AND $ship_id == 0 AND $dept_id != 0){
						$str .= " profile_resume_tr.department = '$dept_id'";
						//echo "<br> disini <hr>";
					} else if((!empty($search) OR !empty($nationality) OR $ship_id != 0) AND $dept_id !=0){
						$str .= "AND profile_resume_tr.department = '$dept_id'";
						// echo "<br> Ship id :".$ship_id."<br> Dept id :".$dept_id."<br>";
						// echo "<br> Lagi disini <hr>";
					} else if(empty($search) AND empty($nationality) AND $ship_id ==0 AND $dept_id ==0){
						$str .= "";
					}


				if($rank != 0 AND (!empty($keyword) OR !empty($nationality) OR $ship_id != 0 OR $dept_id != 0)) $str .= " AND profile_resume_tr.rank = '$rank'";
				else if($rank !=0 AND empty($keyword) AND empty($nationality) AND $ship_id ==0 AND $dept_id == 0) $str .= " profile_resume_tr.rank = '$rank'";


					if($coc != 0) $str .= " AND profile_resume_tr.coc_class = '$coc'";

        			if (!empty($search) || !empty($nationality) || $dept_id != 0 || $ship_id != 0 || $rank != 0) $str .= ") ";

						
					if (!$count) $str .= "ORDER BY pelaut_ms.pelaut_id DESC LIMIT $offset,10";
					
					
				        $q = $this->db->query($str);
					 //echo "<b><br>".$q->num_rows()."<br></b>";

			        $f = $q->result_array();
				        return $f;


		}


		// function getSearchSeatizenDashboard($keyword, $vessel_id=0, $dept_id=0, $nationality_id = '', $count=false, $limit=0)
  //  		 {		
   		 	
		// 	$this->load->model('ship_model');
		// 	$this->load->model('department_model');
		// 	$this->load->model('rank_model');
		// 	$this->load->model('coc_model');
		// 	$search = str_replace('%20',' ',$Keyword);
		// 	$ship = $this->ship_model->get_detail_ship_type_by_name($keyword);
		// 	$department = $this->department_model->get_detail_department_by_name($keyword);
	


  //   	$username = $this->session->userdata('username');
  //       $str = " select pelaut_ms.pelaut_id,array_teman,friend_request,receive_request,nama_depan,nama_belakang,username,rank,kebangsaan,department from pelaut_ms LEFT JOIN profile_resume_tr ON pelaut_ms.pelaut_id = profile_resume_tr.pelaut_id WHERE activation = 'Active' ";

  //       if(!empty($username)){
  //       	// $str .= "AND username <> '$username' ";
  //       }

  //       if(!empty($ship)){
  //       	$str .= " AND profile_resume_tr.vessel_type = $ship[type_id]";
  //       }
  //       if(!empty($department)){
  //       	$str .= " AND profile_resume_tr.department = $department[department_id]";
  //       }

  //       if(!empty($ship) OR !empty($department)) {
  //       			if(!empty($keyword) || $vessel_id != 0 || $dept_id != 0 || !empty($nationality_id)) {
  //      		$str .= " OR (";
  // 		}
  //       } else { 
  //       	if(!empty($keyword) || $vessel_id != 0 || $dept_id != 0 || !empty($nationality_id)) {
  //      		$str .= " AND (";
  // 		}}

       
  //       /* Keyword */
  //       if (!empty($keyword)) $str .= "(pelaut_ms.nama_depan like '%$keyword%' or pelaut_ms.nama_belakang like '%$keyword%' OR pelaut_ms.kebangsaan LIKE '%$keyword%')";
   		
  //       /* Vessel Type */
  //       if ($vessel_id != 0 && empty($keyword)){
  //        $str .= " profile_resume_tr.vessel_type = '$vessel_id'";	
        
  //       }

  //        else if ($vessel_id != 0 && !empty($keyword)){
		// 	$str .= " AND profile_resume_tr.vessel_type = '$vessel_id'";
		// }
  //       /* Department */
  //       if ($dept_id != 0 && empty($keyword) && empty($vessel_id)) {

  //       	$str .= " profile_resume_tr.department = '$dept_id'";
  //       } else if($dept_id != 0 && $vessel_id != ""){
  //       	$str .= " AND profile_resume_tr.department = '$dept_id'";
  //       } 
  //       else if ($dept_id != 0 && !empty($keyword)) {
  //       	$str .= " AND profile_resume_tr.department = '$dept_id'";
		
		// }
  //       	/* Nationality */
  //       if (!empty($nationality_id) && empty($keyword) && $dept_id == 0 AND $vessel_id == 0){
  //       	$str .= " pelaut_ms.kebangsaan = '$nationality_id'";
        	
        
  //      }
  //      else if($nationality_id != '' && ($vessel_id != "" OR $dept_id != "" OR !empty($keyword))){
  //      	$str .= " AND pelaut_ms.kebangsaan = '$nationality_id'";
   
  //      }

  //       else if ($nationality_id != '' && !empty($keyword) AND (!empty($dept_id) OR !empty($vessel_id))) {
  //       	$str .= " AND pelaut_ms.kebangsaan = '$nationality_id'";
    
  //      }

  //       if (!empty($keyword) || $dept_id != 0 || $vessel_id != 0 || $nationality_id != '') $str .= ") ";


	
  //       $str .= " order by pelaut_ms.pelaut_id desc";
  //       if (!$count) $str .= " LIMIT $limit,10";
       	
  //      	echo "<div style='display:none'>".$str."</div>";
      	
  //       $q = $this->db->query($str);
        
  //       $f = $q->result_array();
  //       return $f;
  //   }

		function getSearchSeatizenDashboard($keyword, $vessel_id=0, $dept_id=0, $nationality_id = '', $count=false, $limit=0)
   		 {		
   		 	
			$this->load->model('ship_model');
			$this->load->model('department_model');
			$this->load->model('rank_model');
			$this->load->model('coc_model');
			$search = str_replace('%20',' ',$Keyword);
			$ship = $this->ship_model->get_detail_ship_type_by_name($keyword);
			$department = $this->department_model->get_detail_department_by_name($keyword);
	


    	$username = $this->session->userdata('username');
        // $str = " select pelaut_ms.pelaut_id,array_teman,friend_request,receive_request,nama_depan,nama_belakang,username,rank,kebangsaan,department from pelaut_ms LEFT JOIN profile_resume_tr ON pelaut_ms.pelaut_id = profile_resume_tr.pelaut_id WHERE activation = 'Active' ";
    	$str = " SELECT pelaut_ms.*, profile_resume_tr.pelaut_id,profile_resume_tr.rank, profile_resume_tr.department,profile_resume_tr.vessel_type FROM pelaut_ms LEFT JOIN profile_resume_tr ON pelaut_ms.pelaut_id = profile_resume_tr.pelaut_id WHERE activation  ='ACTIVE' and `show` = 'TRUE' ";
       
        // if(!empty($username)){
        // 	$str .= " AND username <> '$username' ";
        // }

        if(!empty($ship)){
        	$str .= " AND profile_resume_tr.vessel_type = $ship[type_id]";
        }
        if(!empty($department)){
        	$str .= " AND profile_resume_tr.department = $department[department_id]";
        }

        if(!empty($ship) OR !empty($department)) {
        			if(!empty($keyword) || $vessel_id != 0 || $dept_id != 0 || !empty($nationality_id)) {
       		$str .= " OR (";
  		}
        } else { 
        	if(!empty($keyword) || $vessel_id != 0 || $dept_id != 0 || !empty($nationality_id)) {
       		$str .= " AND (";
  		}}

       
        /* Keyword */
        if (!empty($keyword)) $str .= "(pelaut_ms.nama_depan like '%$keyword%' or pelaut_ms.nama_belakang like '%$keyword%' OR pelaut_ms.kebangsaan LIKE '%$keyword%')";
   		
        /* Vessel Type */
        if ($vessel_id != 0 && empty($keyword)){
         $str .= " profile_resume_tr.vessel_type = '$vessel_id'";	
        
        }

         else if ($vessel_id != 0 && !empty($keyword)){
			$str .= " AND profile_resume_tr.vessel_type = '$vessel_id'";
		}
        /* Department */
        if ($dept_id != 0 && empty($keyword) && empty($vessel_id)) {

        	$str .= " profile_resume_tr.department = '$dept_id'";
        } else if($dept_id != 0 && $vessel_id != ""){
        	$str .= " AND profile_resume_tr.department = '$dept_id'";
        } 
        else if ($dept_id != 0 && !empty($keyword)) {
        	$str .= " AND profile_resume_tr.department = '$dept_id'";
		
		}
        	/* Nationality */
        if (!empty($nationality_id) && empty($keyword) && $dept_id == 0 AND $vessel_id == 0){
        	$str .= " pelaut_ms.kebangsaan = '$nationality_id'";
        	
        
       }
       else if($nationality_id != '' && ($vessel_id != "" OR $dept_id != "" OR !empty($keyword))){
       	$str .= " AND pelaut_ms.kebangsaan = '$nationality_id'";
   
       }

        else if ($nationality_id != '' && !empty($keyword) AND (!empty($dept_id) OR !empty($vessel_id))) {
        	$str .= " AND pelaut_ms.kebangsaan = '$nationality_id'";
    
       }

        if (!empty($keyword) || $dept_id != 0 || $vessel_id != 0 || $nationality_id != '') $str .= ") ";


	
        $str .= " order by pelaut_ms.pelaut_id desc";
        if (!$count) $str .= " LIMIT $limit,10";
       
       //	echo $str;
      	echo "<div style='display:none'>".$str."</div>";
        $q = $this->db->query($str);
        
        $f = $q->result_array();
        return $f;
    }
		
		function get_detail_pelaut_by_id($id){
			$str = "SELECT * FROM pelaut_ms WHERE pelaut_id = '$id' AND activation='Active'";
			$q = $this->db->query($str);
			$r = $q->row_array();
			return $r;
		}
			
		
		function __destruct()
		{
			
		}
		
		
	}


?>