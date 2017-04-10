<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed ');
	
	// timeline model , module general guest
	
	class timeline_model extends CI_Model{
		
		function __construct()
		{
			parent::__construct();	
			
			//echo "timeline_model jalan ...";
			
			
		}
		
		
		public function jml_data()
		{
			$id_timeline = $this->input->post('id_timeline');
			$jml_setting = $this->input->post('jml_setting');
			
			$str = "select * from timeline where id_timeline < '$id_timeline' order by id_timeline desc limit '$jml_setting'";
			$kkdata = $this->db->query($str)->result_array();
			
			foreach($kkdata as $row)
			{	
				
				$id_terakhir = $row['id_timeline'];
			}
			
			return $id_terakhir;
			
		}
		
		public function get_tml()
		{
			//echo $this->session->userdata("pelaut_id");
			//print_r($this->session->all_userdata());
			
			$id_timeline = $this->input->post('id_timeline');
			$jml_setting = $this->input->post('jml_setting');
			
			
			if(!empty($id_timeline))
			{
				//$str = "select * from timeline where id_timeline < '$id_timeline' order by id_timeline desc limit $jml_setting";
				$str = "select * from timeline where id_timeline < '$id_timeline' order by id_timeline desc";
			}
			else
			{
				//$str = "select * from timeline order by datetime desc limit 5";
				$str = "select * from timeline order by datetime desc";
			}
			//echo $str; exit;
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			//print_r($f); exit;
			
			return $f;	
			
		}
		
		public function detail_timeline($id_timeline)
		{
			$str = "select * from timeline where id_timeline = '$id_timeline'";
			$q = $this->db->query($str);
			$f = $q->row_array();
			
			return $f;
			
			
		}
		
		public function get_self_tml()
		{
			
			$username = $this->session->userdata("username");
			
			$id_timeline = $this->input->post('id_timeline');
			$jml_setting = $this->input->post('jml_setting');
			
			
			if(!empty($id_timeline))
			{
				$str = "select * from timeline where (username = '$username' or `to` = '$username') and id_timeline < '$id_timeline' order by id_timeline desc limit $jml_setting";
				//$str = "select * from timeline where (username = '$username' or `to` = '$username') and id_timeline < '$id_timeline' order by id_timeline desc";
				//echo "<p>$id_timeline</p>";
			}
			else
			{
			
				$str = "select * from timeline where username = '$username' or `to` = '$username' order by datetime desc limit 5";
				//$str = "select * from timeline where username = '$username' or `to` = '$username' order by datetime desc";
			}
			//echo $str; exit;
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			//print_r($f); exit;
			
			return $f;	
			
		}
		
		public function get_person_timeline($username){
			
			$id_timeline = $this->input->post('id_timeline'); 
			$jml_setting = $this->input->post('jml_setting'); 
			
			//echo $str = "select * from timeline where (username = '$username' or `to` = '$username') and id_timeline < '$id_timeline' order by id_timeline desc limit $jml_setting <br> ";
			
			//echo $str = "select * from timeline where username = '$username' or `to` = '$username' order by datetime desc limit 5 <br> ";
			
			if(!empty($id_timeline))
			{
				$str = "select * from timeline where (username = '$username' or `to` = '$username') and id_timeline < '$id_timeline' order by id_timeline desc limit $jml_setting";
				//$str = "select * from timeline where (username = '$username' or `to` = '$username') and id_timeline < '$id_timeline' order by id_timeline desc";
				//echo "<p>$id_timeline</p>";
			}
			else
			{
			
				$str = "select * from timeline where username = '$username' or `to` = '$username' order by datetime desc limit 5";
				//$str = "select * from timeline where username = '$username' or `to` = '$username' order by datetime";
			}
			//echo $str; exit;
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			//print_r($f); exit;
			
			return $f;	
			
			
		}
		
		
		function get_realname($username)
		{
			$str = "select nama_depan , nama_belakang from pelaut_ms where username = '$username' ";
			$q = $this->db->query($str);
			$f = $q->row_array();
			
			return $f['nama_depan']." ".$f['nama_belakang'];
			
		}
		
		function insert_photo_timeline($dt_tml)
		{
			// insert photo to timeline information
			$ip = $_SERVER['REMOTE_ADDR'];
			
			//$dt_tml[''] = !isset($to) && !empty($to) ? $to : "";
			
			$str  	 = "insert into timeline				";
			$str 	.= "set content= '$dt_tml[content]',	";
			$str 	.= "photo 		= '$dt_tml[photo]',		";
			$str 	.= "pelaut_id 	= '$dt_tml[pelaut_id]',	";
			$str 	.= "username 	= '$dt_tml[username]',	";
			$str 	.= "datetime 	= now(),				";
			$str 	.= "title 		= '$dt_tml[title]',		";
			$str 	.= "type 		= 'Photo',		";	
			//$str 	.= "`to`		= '$dt_tml[to]',		";
			$str 	.= "ip_address = '$ip'					";
			
			//echo $str."<br>"; //exit;
			
			$q = $this->db->query($str);
			
			return $q;
			
				
		}
		
		function insert_timeline($dt_tml)
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$dt_tml['content'] = str_replace(chr(13),"<br>",$dt_tml['content']);
			//$dt_tml[''] = !isset($to) && !empty($to) ? $to : "";
			
			$str  	 = "insert into timeline				";
			$str 	.= "set content= '$dt_tml[content]',	";
			$str 	.= "photo 		= '$dt_tml[photo]',		";
			$str 	.= "pelaut_id 	= '$dt_tml[pelaut_id]',	";
			$str 	.= "username 	= '$dt_tml[username]',	";
			$str 	.= "datetime 	= now(),				";
			$str 	.= "title 		= '$dt_tml[title]',		";
			$str 	.= "type 		= '$dt_tml[type]',		";	
			$str 	.= "`to`		= '$dt_tml[to]',		";
			$str 	.= "ip_address = '$ip'					";
			
			echo $str."<br>"; //exit;
			
			echo $q = $this->db->query($str);
			
			return $q;
				
			
		}
		
		
		
		
	}

?>