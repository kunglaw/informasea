<?php
	
	if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class company_model extends CI_Model{
		
		// private $general_query = " AND b.status = 'VERIFIED' AND a.activation_code = 'ACTIVE' AND a.tampil = 1 ";
		private $general_query = " AND a.activation_code = 'ACTIVE' AND b.status = 'VERIFIED' AND b.valid_email = 'valid' AND a.tampil = 1 AND a.official = 'Agent' ";
		
		function __construct()
		{
			$general_query = $this->general_query;	
		}
		
		public function get_company($where)
		{
			$s = "SELECT a.*,b.* FROM perusahaan a LEFT JOIN perusahaan_setting b ON a.id_perusahaan = b.id_perusahaan ".$this->general_query.$where;
			$q = $this->db->query($s);
			//$f = $q->result_array($q);
			return $q;
		}

		function company_index($count=false,$offset=0){
			$str = "SELECT a.*,b.* FROM perusahaan a, perusahaan_setting b WHERE a.id_perusahaan = b.id_perusahaan ".$this->general_query." order by a.create_date DESC";

			if(!$count){
				$str .= " LIMIT $offset, 10";
			}
			$a = $this->db->query($str);
			$f = $a->result_array();
			return $f;
		}
		
		public function get_nationality($where=""){
			$s = "select * from nationality ".$where;
			$q = $this->db->query($s);
			return $q;
		}
		
		public function count_company(){
			
			$q = $this->db->query("SELECT * FROM perusahaan a, perusahaan_setting b WHERE a.id_perusahaan = b.id_perusahaan ".$this->general_query);
			$f = $q->num_rows();
			return $f;
		}
		
		public function count_vacantsea($where){
			$s = "select * from vacantsea ".$where;
			$q = $this->db->query($s);
			return $q;	
		}
		
		public function count_ship($where=""){
			$s = "select * from ship ".$where;
			$q = $this->db->query($s);
			return $q;
		}
		
		public function get_photo($where){
			$s = "select * from photo_perusahaan_tr ".$where;
			$q = $this->db->query($s);
			return $q;
		}
		public function vacantsea($where){
			$s = "select a1.*, a2.rank, a3.username
			 from vacantsea a1 left join rank a2 ON a1.rank_id=a2.rank_id 
			 inner join perusahaan a3 ON a1.id_perusahaan=a3.id_perusahaan inner join perusahaan_setting a4 ON a1.id_perusahaan = a4.id_perusahaan  ".$where;
			$q = $this->db->query($s);
			return $q;
		}
		public function ship($where){
			$s = "select a1.*, a2.username, a2.nama_perusahaan
			from ship a1 left join perusahaan a2 ON a1.id_perusahaan=a2.id_perusahaan inner join perusahaan_setting a4 ON a1.id_perusahaan = a4.id_perusahaan ".$where;
			$q = $this->db->query($s);
			return $q;
		}
		
		//untuk panel
		public function get_company_panel()
		{
			$str = "select * from perusahaan a, perusahaan_setting b WHERE a.id_perusahaan = b.id_perusahaan ".$this->general_query." order by create_date DESC LIMIT 5";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;	
		}
		
		public function get_detail_company($id_perusahaan = "")
		{
			$str = "select * from perusahaan where id_perusahaan = '$id_perusahaan' OR nama_perusahaan LIKE '%$id_perusahaan%' ";
			$q = $this->db->query($str);
			$f = $q->row_array();
			
			return $f;	
		}
		
		
		public function get_logoimage($id_perusahaan)
		{
			$str = "select * from perusahaan where id_perusahaan = '$id_perusahaan' ";
			
			$q = $this->db->query($str);
			
			$f = $q->row_array();
			
			$image = $f['logo_image'];
			
			return $image;	
		}
		
		public function get_logoimage2($id_perusahaan)
		{
			$str = "select * from photo_perusahaan_tr WHERE (id_perusahaan = '$id_perusahaan' OR username = '$id_perusahaan') AND profile_pic = 1 AND cover = '0'";
			
			$q = $this->db->query($str);
			
			$f = $q->row_array();
			
			$image = $f['nama_gambar'];
			
			return $image;	
		}
		
		public function list_company_lim()
		{
			$id_perusahaan = $this->input->post('id_perusahaan');	
			//echo $pelaut_id; exit;	
			
			$jml_setting = $this->input->post('jml_setting');
			
			$str = "select * from perusahaan a, perusahaan_setting b where a.id_perusahaan = b.id_perusahaan AND a.status = 'VERIFIED' AND tampil = 1 order by id_perusahaan desc limit 10";
			$q = $this->db->query($str);
			$f = $q->result_array();			
			return $f;
		}


		function get_search_company($keyword = "", $nationality_id = 0, $count=false,$limit=0){
			$username = $this->session->userdata('username');
			

			$str = "SELECT * FROM perusahaan a,  perusahaan_setting b WHERE a.id_perusahaan = b.id_perusahaan AND a.status = 'VERIFIED' ";
			if($keyword != "" OR $nationality_id != 0){
				$str .= " AND  ";


				if($keyword != "" AND $nationality_id == 0){
					$str .= " nama_perusahaan LIKE '%$keyword%' ";
				}else if($keyword != "" AND $nationality_id != 0){
					$str .= " nama_perusahaan LIKE '%$keyword' AND id_nationality = '$nationality_id'";
				}else if($keyword == "" AND $nationality_id != 0){
					$str .= " id_nationality = '$nationality_id'";
				}

			}

			$str .= " AND tampil = 1 ";


			if(!$count){
				$str .= " ORDER BY id_perusahaan DESC LIMIT $limit,5";
			}
			//echo $str;
			$a = $this->db->query($str);
			$f = $a->result_array();
			return $f;
				
		}

		// function get_search_company($keyword, $nationality_id = "", $count=false,$limit=0){
		// 	$username = $this->session->userdata('username');

		// 	$str = "SELECT * FROM perusahaan WHERE activation_code = 'ACTIVE' ";
		// 	if(!empty($keyword) or $nationality_id != ""){
		// 			$str .= " AND ";
		// 			if($nationality_id != ""){
		// 			$str .= " nationality = '$nationality_id'";
		// 		} 

		// 		if(!empty($keyword) AND $nationality_id != ""){
		// 			$str .= "AND nama_perusahaan LIKE '%$keyword%'";
		// 		} else if(!empty($keyword) AND $nationality_id = ""){
		// 			$str .= " nama_perusahaan LIKE '%$keyword%'";
		// 		}



		// 	}

		// 	if(!$count){
		// 		$str .= " ORDER BY id_perusahaan DESC LIMIT $limit,5";
		// 	}



				
		// }


		function search_company($keyword="",$ship_type="")
		{
				$str = "select * from perusahaan a, perusahaan_setting b where a.id_perusahaan = b.id_perusahaan AND a.status = 'VERIFIED' ";
				$str .= "nama_perusahaan like '%$keyword%'";

			if(empty($keyword) && isset($ship_type))
			{
				$str = "select type_id from ship_type where ship_type = '$ship_type'";
				$q = $this->db->query($str);
				$result = $q->row_array();

				$str = "select id_perusahaan from ship where id_ship_type = '".$result['type_id']."'";
				$q = $this->db->query($str);
				$result = $q->row_array();

				$str = "select * from perusahaan where id_perusahaan = '".$result['id_perusahaan']."'";
			}

			$q = $this->db->query($str);
			$rCompany = $q->result_array();
			return $rCompany; // dikirim ke controller vacantsea, function search_vacantsea
			
		}
		
		function search_company_plus($keyword="", $department="", $rank_id="", $ship_type="", $pelaut_id="", $jml_setting="")
		{
			$newsallary = str_replace("Rp. ", '', $sallary);
			$newsallary = str_replace('.', '', $newsallary);
			$newsallary = explode('-', $newsallary);
			$sall1 = $newsallary[0];
			$sall2 = $newsallary[1];

			$str = "select * from profile_resume_tr where (";
				$str .= "(pelaut_id < '$pelaut_id') and ";
				$str .= "first_name like '%$keyword%' or ";
				$str .= "last_name like '%$keyword%' or ";
				$str .= "expected_sallary between '$sall1' and '$sall2') ";
				
			$q = $this->db->query($str);
			$rProfile = $q->result_array();
			// echo $str;
			// echo "Hallo";
			$str = "select * from pelaut_ms where (";
				$str .= "(pelaut_id < '$pelaut_id') and ";
				$str .= "nama_depan like '%$keyword%' or ";
				$str .= "nama_belakang like '%$keyword%' or ";
				$str .= "vessel_type = '$ship_type' or ";
				$str .= "department = '$department' or ";
				$str .= "rank = '$rank_id' or ";
				$str .= "coc_class = '$coc_class'";
			
			$str .= ")";
			// echo $str;
			$q = $this->db->query($str);
			$rPelaut = $q->result_array();
			return array('profile_pelaut' => $rProfile, 'data_pelaut' => $rPelaut); // dikirim ke controller vacantsea, function search_vacantsea
		}
		
		public function list_company_lim_plus()
		{	
			$id_perusahaan = $this->input->post('id_perusahaan');	
			//echo $pelaut_id; exit;	
			
			$jml_setting = $this->input->post('jml_setting');
			
			$str = "select * from perusahaan a, perusahaan_setting b where a.id_perusahaan = b.id_perusahaan AND a.status = 'VERIFIED' and a.id_perusahaan < '$id_perusahaan'  AND tampil = 1 order by a.id_perusahaan desc limit 10"; //harusnya ada order by createdate
			$q = $this->db->query($str);
			return $f = $q->result_array();			
		}
		
		public function check_sisa_list($id_perusahaan){
			
			$str = "select * from perusahaan a,  perusahaan_setting b where a.id_perusahaan = b.id_perusahaan AND a.status = 'VERIFIED' and id_perusahaan < '$id_perusahaan'  order by id_perusahaan desc limit 10";
			$q = $this->db->query($str);
			$f = $q->num_rows();
			
			return $f;
		}

		public function general_table($table="", $where=""){
			$sql 	= "select * from $table ".$where;
			$query 	= $this->db->query($sql);

			return $query;
		}

		public function getapplicant($where=""){
		    $sql    = "select * from applicant_tr ".$where;

		    $query  = $this->db->query($sql);
		    return $query;
		}

		public function count_applicant($where=""){
			$sql 	= "select count(*) as 'jumlah' from applicant_tr ".$where;
			$query	= $this->db->query($sql);

			return $query;
		}

	}
?>