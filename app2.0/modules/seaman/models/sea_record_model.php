<?php if(!defined('BASEPATH')) exit ('No direct script access allowed ');



class sea_record_model extends CI_Model{

	

	function get_all_experience($id)

	{

		$str	  = "select * from experiences_crew where crew_id = '$id' order by sign_off desc";

		$q 		= $this->db->query($str);

		return $f = $q->result_array();

	}

	

	function get_experience($id)

	{



		$company_id	= $this->session->userdata('id_perusahaan');



			if($company_id == ""){

			$company_id = $this->session->userdata('id_perusahaan_agent');

		}



		$str	  = "select * from experiences_crew where crew_id = '$id' and perusahaan_id = '$company_id' order by sign_off desc";

		$q 		= $this->db->query($str);

		return $f = $q->result_array();



	}



	function vessel_type($id_type)

	{

		# code...

		$str	  = "select * from ship_type where type_id = '$id_type'";

		$q 		= $this->db->query($str);

		return $f = $q->row_array();

	}

	function get_company($id_perusahaan)

	{

		# code...

		$str	  = "select * from perusahaan where id_perusahaan = '$id_perusahaan'";

		$q 		= $this->db->query($str);

		return $f = $q->row_array();

	}



	function getLatestAppraisalSeatizen($id_pelaut, $limit=true)

	{

		# code...

		$str = "select * from experiences_appraisal where id_pelaut = '$id_pelaut' order by no_urut desc ";

		if($limit) $str .= "limit 5";

		$q = $this->db->query($str);

		return $q->result_array();	

	}



	function getExperienceAppraisal($id_exp)

	{

		// $str	  = "select * from experiences_crew where experience_id = '$id_exp'";

		// $q 		= $this->db->query($str);

		// $dtExp = $q->row_array();

		# code...

		$str	  = "select * from experiences_appraisal where id_experience = '$id_exp'";

		$q 		= $this->db->query($str);

		return $f = $q->row_array();

	}



	function getAllAppraisalFromCompany($company_id, $pelaut_id)

	{

		// $str	  = "select * from experiences_crew where experience_id = '$id_exp'";

		// $q 		= $this->db->query($str);

		// $dtExp = $q->row_array();

		# code...

		$str	  = "select * from experiences_appraisal where id_perusahaan = '$company_id' and id_pelaut = '$pelaut_id'";

		$q 		= $this->db->query($str);

		return $f = $q->result_array();

	}

	

	function detail_crew_experience($id)

	{

		

		$str = "select * from experiences_crew where experience_id = '$id' ";	

		$q = $this->db->query($str);

		$f = $q->row_array();

		

		return $f;

	}
	
	function allSeaRecordByShipType($id, $ship_type)
	{

		# code...

		$type_user	= $this->session->userdata('type_user');

		$tabelnya = "experiences";

		$idnya = "pelaut_id";

		$str	  = "select * from $tabelnya where $idnya = '$id' and ship_type_id = '$ship_type'";

		$str 	 .= " order by periode_to desc";
		

		$q 		= $this->db->query($str);

		return $f = $q->result_array();

	}



	function allSeaRecordByRank($id, $rank_id)
	{

		# code...

		$type_user	= $this->session->userdata('type_user');

		$tabelnya 	 = "experiences";

		$idnya 		= "pelaut_id";

		$str	  	  = "select * from $tabelnya where $idnya = '$id' and rank_id = '$rank_id'";

		if($type_user !== "pelaut") $str .= " order by periode_to desc";

		// echo $str;

		$q 		= $this->db->query($str);

		return $f = $q->result_array();

	}
	
	//distinct
	
	function getAllExperiencesByRankAndShipTypeCrew($pelaut_id, $ship_type_id, $rank_id=0)
	{
		# code...
		$str = "SELECT * FROM `experiences` where pelaut_id = '$pelaut_id' and ship_type_id = '$ship_type_id'";
		if($rank_id!=0) $str.=" and rank_id = '$rank_id'";
		$exec = $this->db->query($str);
		return $exec->result_array();
	}

	function getDistinctRankByShipTypeCrew($pelaut_id, $ship_type_id)
	{
		# code...
		$str = "SELECT distinct rank_id FROM `experiences` where pelaut_id = '$pelaut_id' and ship_type_id = '$ship_type_id'";
		$exec = $this->db->query($str);
		return $exec->result_array();
	}

	function getDistinctExperienceRankCrew($pelaut_id)
	{
		$str = "SELECT distinct rank_id FROM `experiences` where pelaut_id = '$pelaut_id'";
		$exec = $this->db->query($str);
		return $exec->result_array();
	}

	function getDistinctShipTypeCrew($pelaut_id)
	{
		# code...
		$str = "SELECT distinct ship_type_id FROM `experiences` where pelaut_id = '$pelaut_id'";
		$exec = $this->db->query($str);
		return $exec->result_array();
	}
	
	function getDistinctDepartment($pelaut_id)
	{
		
		$str = "SELECT distinct b.department_id FROM `experiences` a, rank b, department c WHERE a.pelaut_id = '$pelaut_id' AND b.id_department = c.id_department ";
		$exec = $this->db->query($str);
		return $exec->result_array();
		
	}

	function experience_other_company($id)

	{

		$company_id	= $this->session->userdata('id_perusahaan');

		

		$str	  = "select * from experiences_crew where crew_id = '$id' and perusahaan_id <> '$company_id' order by sign_off desc";

		$q 		= $this->db->query($str);

		return $f = $q->result_array();

	}

	

	function check_on_board($id)

	{

		$today = getdate();		//$d	 = $today['mday'];	$m	 = $today['mon'];	$y	 = $today['year'];

														

		$a = $this->latest_sign_off($id);

		

		//foreach($a as $row)

		//{

			$sign_off = new DateTime ($a['sign_off']);

			if($sign_off > $today)

			{

				$str = "update crew_ms set crew_status = 'ON BOARD' where id_crew = '$id' ";

				$q = $this->db->query($str);

			} 

		//} 

	}

	

	function add_seaRecord_process()

	{



		$vessel 	  	= $this->input->post('vessel_name',true);

		$a		  	 	= $this->ship_model->get_vessel($vessel);

		$ship_id 		= $this->input->post('ship_id');

		$vessel_name 	= $a['ship_name'];

		$ship_type   	= $a['id_ship_type'];

		$weight	  		= $a['weight'];



		$rank			= $this->input->post('rank_experience',true);

		$area			= $this->input->post('trade_area',true);



		$sign_in  		= date('Y-m-d', strtotime($this->input->post('experience_from',true)));

		$sign_off 		= date('Y-m-d', strtotime($this->input->post('experience_to',true)));



		// $sign_in	 = $this->input->post('experience_from',true);

		// $sign_off	= $this->input->post('experience_to',true);		

		



		$crew_id		= $this->input->post('crew_id');

		$company_id 	= $this->session->userdata('id_perusahaan');

		$company_name 	= $this->session->userdata('nama_perusahaan');

		

		$this->form_validation->set_rules('ship_name','<i>Vessel Name</i>','required');

		$this->form_validation->set_rules('rank_experience','<i>Rank</i>','required');

		$this->form_validation->set_rules('trade_area','<i> Area</i>','required');



		$this->form_validation->set_rules('experience_from','<i>Sign On</i>','required');

		$this->form_validation->set_rules('experience_to','<i>Sign Off</i>','required');

		

		//print_r($this->input->post());

		

		if($this->form_validation->run() == TRUE)

		{



			// $str = "INSERT INTO experiences_crew (crew_id,ship_id,ship_name,rank_id,company,sign_on,sign_off,datetime,trade_area,ship_type_id,

			// 	last_update,weight,perusahaan_id,last_update,weight,perusahaan_id,author) 

			// 	VALUES ('$crew_id','$ve" 





			$str = "INSERT INTO 

			`experiences_crew`(`crew_id`, `ship_id`, `ship_name`, `rank_id`, `company`, `sign_on`, `sign_off`, `datetime`, `trade_area`, `ship_type_id`, `last_update`, `weight`, `perusahaan_id`,author) 

			VALUES 

			('$crew_id','$vessel','$vessel_name','$rank','$company_name','$sign_in','$sign_off',now(),'$area','$ship_type',now(),'$weight','$company_id','1')";

			

			

			//echo $str;exit;

			

			$q = $this->db->query($str);

			

			echo "<div class='alert alert-success' style='margin:5px 30px;'> 

                                        <i class='fa fa-check'></i> 

                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>

                                        <b>Succes!</b> Service Record has been added.</div>";

				echo "<script>

				  setTimeout(function(){ location.reload(); }, 3000)</script>";

		} else

		{

			echo "<div class='alert alert-danger'>

			<i class='fa fa-warning'></i>

			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";

		}

		$this->check_on_board($crew_id);

	}

	

	function sea_record_update() 

	{

		

		$this->load->model('ship_model');

		

		$experience_id		= $this->input->post('id');

		

		$ship_name	 	= $this->input->post('ship_name');

		$ship_type		= $this->ship_model->get_vessel($ship_name);//print_r($ship_type);

		$rank	  		 = $this->input->post('rank');

		$trade_area	   = $this->input->post('trade_area');

		$date_from	    = $this->input->post('date_from');

		$date_to	      = $this->input->post('date_to');

		$type_lama	    = $this->input->post('type_lama');

		

		//print_r($this->input->post());

		

		if(!empty($ship_name)) {

			$str = "update experiences_crew set ship_id = '$ship_name', ship_name = '$ship_type[ship_name]', ship_type_id = '$ship_type[id_ship_type]', 		weight='$ship_type[weight]', last_update = now() where experience_id = '$experience_id' ";

		} else if(!empty($rank)) {			

			$str = "update experiences_crew set rank_id = '$rank', last_update= now() where experience_id = '$experience_id' ";

		} else if(!empty($trade_area)) {

			$str = "update experiences_crew set trade_area = '$trade_area', last_update= now() where experience_id = '$experience_id' ";

		} else if(!empty($date_from)) {			

			$str = "update experiences_crew set sign_on = '$date_from', last_update= now() where experience_id = '$experience_id' ";

		} else {

			$str = "update experiences_crew set sign_off = '$date_to', last_update= now() where experience_id = '$experience_id' ";

		}

		//echo $str;

		$q = $this->db->query($str);

		

		// select query

		

		$str	  = "select * from experiences_crew where experience_id = '$experience_id'";

		$q 		= $this->db->query($str);

		 $f = $q->row_array();

		

		// echo DB

		if(!empty($ship_name)) { 

			$b = $this->ship_model->vessel_type($ship_type['id_ship_type']);

			$vessel_type =  "<small class='ship_type' id='$experience_id'> $b[ship_type] </small>";

			echo "<script>

					$(document).ready({

					$('small.ship_type').remove();});

			

			</script>";

			$a = $this->ship_model->get_vessel($f['ship_id']); echo $a['ship_name'] ."/". $vessel_type;

		}  else if(!empty($rank)) {

			$b = $this->rank_model->get_rank($f['rank_id']); echo $b['rank'];

		} else if(!empty($trade_area)) {				

			echo $f['trade_area'];

		} else if(!empty($date_from)) {				

			echo $f['sign_on'];

		} else if(!empty($date_to)) {				

			echo $f['sign_off'];

		} else { echo "-"; }

		

			

		$this->check_on_board($f['crew_id']);

	}

	

	function sea_record_delete($id)

	{//echo $id;exit;

		$str = "DELETE FROM `experiences_crew` WHERE experience_id = '$id'";

		$q = $this->db->query($str);

		

			echo "<script>

				  setTimeout(function(){ $('.alert-warning').hide() })</script>";

		

		echo "<div class='alert alert-success' style='margin:5px 30px;'> 

                                        <i class='fa fa-check'></i> 

                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>

                                        <b>Succes!</b> Sea Record has been delete.</div>";

		

			echo "<script>

				  setTimeout(function(){ location.reload(); }, 2000)</script>";

		

	}

	

	function download_sea_record($id)

	{

		// kode author = 2 = seatizen,hanya bisa delete, tidak edit

		$company_id	= $this->session->userdata('id_perusahaan');

		

		$str	  = "select * from experiences where pelaut_id = '$id'";

		$q 		= $this->db->query($str);

		$f 		= $q->result_array();

		//print_r($f);

		

		if(!empty($f)) {

		

			foreach($f as $row) {



				$vessel 		  = $row['ship_name'];

				$rank			= $row['rank_id'];

				$company_name  	= $row['company'];

				$sign_on   		 = $row['periode_from'];

				$sign_off 		= $row['periode_to'];

				$datetime		= $row['datetime'];

				$area			= $row['trade_area'];

				$ship_type	   = $row['ship_type_id'];

				$weight		  = $row['weight'];

				$satuan 	  = $row['satuan'];

				$id_experience_tr = $row['experience_id'];

				$crew_id	   	 = $this->crew_model->crew_by_id($id);



				$author = $crew_id['crew_name'];



			//print_r($crew_id['id_crew']);

			

				$strr = " SELECT * FROM experiences_crew WHERE id_experience_tr = '$id_experience_tr' AND crew_id = '$crew_id[id_crew]' AND perusahaan_id = '$company_id'";

				$fs = $this->db->query($strr);

				$jml = $fs->num_rows();

				



				if($jml > 0){



				} else {

$str = "INSERT INTO `experiences_crew`(`crew_id`, `ship_id`, `ship_name`, `rank_id`, `company`, `sign_on`, `sign_off`, `datetime`,  `trade_area`, `ship_type_id`, `last_update`, `weight`,satuan, `perusahaan_id`,author,id_experience_tr) VALUES ('$crew_id[id_crew]','','$vessel','$rank','$company_name','$sign_on','$sign_off','$datetime','$area','$ship_type',now(),'$weight','$satuan','$company_id','2','$id_experience_tr')";

				$q = $this->db->query($str);

				}



				

				

				

			} //end foreach

			

				if($jml > 0){

					echo "<div class='alert alert-danger'>			<i class='fa fa-warning'></i>

<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>X</button>

				No New sea record </div>";

				}else{

						echo "<div class='alert alert-success' style='margin:5px 30px;'> 

					<i class='fa fa-check'></i> 

					<b>Please wait a momment ..</b> the Sea Record will be downloaded.</div>";

				echo "<script>

				  setTimeout(function(){ location.reload(); }, 2000)</script>";

				}

			

				

		} else {

			echo "<div class='alert alert-info' style='margin:5px 30px;'><i class='fa fa-info'></i> 

					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>

					This seatizen does not have Sea Record. 

				  </div>";

		}

		

		if(!empty($crew_id)) {

		$this->check_on_board($crew_id);

		}

	}

	

	

	

	

	

	function latest_sign_off($id)

	{

		//$id			= $this->input->get("id_seatizen");

		$company_id	= $this->session->userdata('id_perusahaan');

		

		$str	  = "select * from experiences_crew where crew_id = '$id' and perusahaan_id = '$company_id' order by sign_off desc limit 1";

		//echo $str;

		$q 		= $this->db->query($str);

		return $f = $q->row_array();	

		

		//print_r($f);

		

	}

	

	function jml_experience_each_rank($id)

	{

		//$i	 = $this->get_all_experience($id);

		$a	 = $this->get_experience($id);

		//$b	 = $this->experience_other_company($id);

		$c	 = $this->latest_sign_off($id);

		

		//print_r($a);	echo "<hr>";	 print_r($b); echo "<hr>"; 

		//print_r($c); echo "<hr>";

		

		

		//print_r($last_rank); echo "<hr>";

		

		// cek apakah $last_rank ada di $b

		

		

		if(!empty($c))

		{

			$last_rank = $c['rank_id'];

				foreach($a as $row)

				{

					if($row['rank_id'] == $last_rank)

					{

						$today	= new DateTime(date("Y-m-d"));

						

						$datetime1 = new DateTime($row['sign_on']);

						$datetime2 = new DateTime($row['sign_off']);

						$difference = $datetime1->diff($datetime2);

						

						

						$ydays = $difference->y;

						$mdays = $difference->m;

						$ddays = $difference->d;

						

						//echo "<span class='text-green'>".$difference->y.' years, ' .$difference->m.' months, ' .$difference->d.' days'."</span>";echo "<hr>";

						

						$total_y [] = $ydays;

						$total_m [] = $mdays;

						$total_d [] = $ddays;

						

						

					}

				}

						

						$jml_y = array_sum($total_y);

						$jml_m = array_sum($total_m);

						$jml_d = array_sum($total_d);

						

				//echo "<hr>";

				

				//foreach($b as $row)

//				{

//					if($row['rank_id'] == $last_rank)

//					{

//						$today	= new DateTime(date("Y-m-d"));

//						

//						$datetime1 = new DateTime($row['sign_on']);

//						$datetime2 = new DateTime($row['sign_off']);

//						$difference = $datetime1->diff($datetime2);

//						

//						

//						$ydays = $difference->y;

//						$mdays = $difference->m;

//						$ddays = $difference->d;

//						

//						

//					//echo "<span class='text-purple'>".$difference->y.' years, ' .$difference->m.' months, ' .$difference->d.' days'."</span>";echo "<hr>";

//						

//						$total_y [] = $ydays;

//						$total_m [] = $mdays;

//						$total_d [] = $ddays;

//						

//					}

//				}

				

						

						$jml_y = array_sum($total_y);

						$jml_m = array_sum($total_m); //9

						$jml_d = array_sum($total_d); //31

						

						//echo $jml_y. "-" . $jml_m ."-". $jml_d; echo "<hr>";

						

						$d = floor($jml_d/30); //1

						if($d > 0)

						{

							$b = $d + $jml_m; //echo $b;exit; //10

							$h = $jml_d - ($d * 30);

						} else 

						{

							$b = $jml_m;

							$h = $jml_d;	

						}

						

						$m = floor($b/12); //   15/12

						if($m > 0)

						{

							$y = $jml_y + $m;

							$b = $b -  ($m * 12); // 15-(1*12) 

						} else {

							$y = $jml_y;

							$b = $b;	

						}

						

						echo "<span> ".$y .' years, ' . $b .' months, ' . $h .' days' ."</span>"; 

				

		} else {

			echo "no sea record";	

		}

		

				

		

	}

}



