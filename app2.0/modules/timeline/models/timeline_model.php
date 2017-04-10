	<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed ');
	
	// timeline model , module general guest
	
	class timeline_model extends CI_Model{
		
		
		function __construct()
		{
			if($this->session->userdata("user") != "pelaut")
			{
				return false;
					
			}
		}
		
		
		
		public function get_timeline_byphoto($photo= "")
		{
			if($photo != "")
			{
				$str = "select * from timeline where photo = '$photo'";
				$q = $this->db->query($str);
				$f = $q->row_array();
				return $f;				
			}
		}
		
		public function jml_data($username = "")
		{
			$id_timeline = $this->input->post('id_timeline');
			$jml_setting = $this->input->post('jml_setting');
			
			$str = "select * from timeline where id_timeline < '$id_timeline' and ((username = '$username' AND `to` = '') OR `to` = '$username') order by id_timeline desc limit $jml_setting";
			$kkdata = $this->db->query($str)->result_array();
			
			foreach($kkdata as $row)
			{	
				$id_terakhir = $row['id_timeline'];
			}
			
			return $id_terakhir;
			
		}
		
		function jml_data_angka($id_timeline = "", $username = "") // untuk load more 
		{
			if($id_timeline == "")
			{
				$id_timeline = $this->input->post('id_timeline');
			}
			
			$str = "select * from timeline where id_timeline < '$id_timeline' and ((username = '$username' AND `to` = '') OR `to` = '$username') order by id_timeline desc";
			//echo "<hr>".$str."<hr>";
			$kkdata = $this->db->query($str)->num_rows();
			
			return $kkdata;
		}
		
		public function detail_timeline($id_timeline = '')
		{
			$str = "select * from timeline where id_timeline = '$id_timeline'";
			$q = $this->db->query($str);
			$f = $q->row_array();
			
			return $f;
					
		}
		
		public function get_tml($id_timeline = "", $username = "")
		{
			//echo $this->session->userdata("pelaut_id");
			//print_r($this->session->all_userdata());
			
			if($id_timeline == "")
			{
				$id_timeline = $this->input->post('id_timeline');
			}
			$jml_setting = $this->input->post('jml_setting');

			if($username != "")
				$where_tambahan = "and ((username = '$username' and `to` = '') or `to` = '$username')";
			else $where_tambahan = "";
			
			
			/* ambil data berdasarkan : 
			- Tanggal dan limit 
			kalau datanya sudah banyak, mencapai ribuan bahkan jutaan
			
			- id_timeline terakhir 
			kalau datanya masih sedikit dan jarang yang nge post 
			
			*/
			
			if(!empty($id_timeline))
			{
				$str = "select * from timeline where id_timeline < '$id_timeline' $where_tambahan order by id_timeline desc limit 5";
			}
			else
			{
			
				$str = "select * from timeline order by datetime desc limit 5";
			}
			//echo $str; exit;
			$q = $this->db->query($str);
			// echo $this->db->last_query();
			$f = $q->result_array();
			
			//print_r($f); exit;
			
			return $f;	
			
		}
		
		public function get_self_tml($id_tml = "")
		{
			
			$username = $this->session->userdata("username");
			
			$id_timeline = $id_tml == "" ? $this->input->post('id_timeline'): $id_tml;
			$jml_setting = $this->input->post('jml_setting');
			
			
			if(!empty($id_timeline))
			{
				$str = "select * from timeline where ((username = '$username' and `to` = '') or `to` = '$username') OR mention LIKE '%$username%' and id_timeline < '$id_timeline' order by id_timeline desc limit 5";
				//echo "<p>$id_timeline</p>";
			}
			else
			{
			
				$str = "select * from timeline where (username = '$username' and `to` = '') or `to` = '$username' OR mention LIKE '%$username%' order by datetime desc limit 5";
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
				$str = "select * from timeline where ((username = '$username' and `to` = '') or `to` = '$username') OR mention like '%$username%' and id_timeline < '$id_timeline' order by id_timeline desc limit 5";
				//echo "<p>$id_timeline</p>";
			}
			else
			{
			
				$str = "select * from timeline where (username = '$username' and `to` = '') or `to` = '$username' OR mention like '%$username%' order by datetime desc limit 5";
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
			$str    .= "mention	= '$dt_tml[mention]',	";
			$str 	.= "ip_address = '$ip'					";
			
			//echo $str."<br>"; //exit;
			
			$q = $this->db->query($str);
			
			return $q;
				
			
		}
		
		function delete_timeline($id_timeline)
		{
			//hapus photo jika memang ada data photo di timeline ini
			$str2   = "select * from timeline where id_timeline = '$id_timeline' ";
			$q2 	  = $this->db->query($str2);
			$f2 	  = $q2->row_array();
			//print_r($f2);

			// gambar dulu, baru timeline
			if(!empty($f2['photo']))
			{
				$this->delete_picture($id_timeline); // gambar yang ada di timeline
				
			
				$str33 = "select * from photo_pelaut_tr where nama_gambar = '$f2[photo]' ";
				$q33 = $this->db->query($str33);
				$f33 = $q33->row_array();
				
				if(!empty($f33))
				{
					$this->delete_photo_pelaut_tr($f2['photo']);
					
					$str_del_photo = "delete from photo_pelaut_tr where nama_gambar = '$f2[photo]' ";
					$q_del_photo = $this->db->query($str_del_photo); 
				}
			}
			
			
			// untuk comment nya 
			$str_comment = "delete from comment_timeline where id_timeline = $id_timeline ";
			$q45 = $this->db->query($str_comment);	
			
			// untuk timeline 
			$str = "DELETE from timeline where id_timeline = $id_timeline ";
			$q67 = $this->db->query($str);	
	
		}


        //function radit
        function update_timeline($id_timeline, $content)
        {
            //hapus photo jika memang ada data photo di timeline ini
            $str2   	  = "update timeline set content = '$content' where id_timeline = '$id_timeline'";
            return $q2 	  = $this->db->query($str2);
        }
		
		function delete_photo_pelaut_tr($nama_gambar)
		{
			$this->load->model('photo/photo_mdl');
			$username = $this->session->userdata("username");
			$photo_pelaut_tr = $this->photo_mdl->check_photo($nama_gambar); // get detail photo by nama_photo;
			
			// big
			unlink("assets/photo/$username/big/".$photo_pelaut_tr['photo']);
			
			$ss = explode(".",$photo_pelaut_tr['photo']);
			//print_r($ss);
			//small
			unlink("assets/photo/$username/small/".$ss[0]."_small.".$ss[1]);
			//thumb
			unlink("assets/photo/$username/thumbnail/".$ss[0]."_thumb.".$ss[1]);
		}
		
		function delete_picture($id_timeline)// delete photo timeline
		{
			$username = $this->session->userdata("username");
			$picture = $this->detail_timeline($id_timeline);
			// big
			unlink("assets/timeline/$username/big/".$picture['photo']);
			
			$ss = explode(".",$picture['photo']);
			//print_r($ss);
			//small
			unlink("assets/timeline/$username/small/".$ss[0]."_small.".$ss[1]);
			//thumb
			unlink("assets/timeline/$username/thumbnail/".$ss[0]."_thumb.".$ss[1]);
		}
		
		
		
		
	}

?>