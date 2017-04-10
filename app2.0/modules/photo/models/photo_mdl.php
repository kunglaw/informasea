<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class photo_mdl extends CI_Model
{
	public function get_photo($username)
	{
		$str = "select * from photo_pelaut_tr where username = '$username' order by id_pptr DESC";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
	
	}
	
	/* pagination */
	
	public function prevp($username = "",$id_pptr)
	{
		if(empty($username))
		{
			$username = $this->session->userdata("username");	
		}
		
		$offset = $id_pptr;
		
		/* cek dahulu jumlah data*/
		$str = "select id_pptr from photo_pelaut_tr where username = '$username' and id_pptr between 0 and $offset";
		$q = $this->db->query($str);
		$jml = $q->num_rows() - 1;
		$prev_jml = $jml - 1;
		
		if($prev_jml >= 0){
			 
		  $str1 = "select * from photo_pelaut_tr where username = '$username' order by id_pptr ASC LIMIT $prev_jml,1";
		  $q1 = $this->db->query($str1);
		  $f = $q1->row_array();
		}
		else
		{
		  $f['nama_gambar'] = "";
		}
		return $f['nama_gambar'];
	}
	
	public function nextp($username = "",$id_pptr)
	{
		if(empty($username))
		{
			$username = $this->session->userdata("username");	
		}
		
		$offset = $id_pptr;
		
		/* cek dahulu jumlah data*/
		$str = "select id_pptr from photo_pelaut_tr where username = '$username' and id_pptr between 0 and $offset";
		$q = $this->db->query($str);
		$jml = $q->num_rows() - 1;
		$next_jml = $jml + 1;
		
		/* */
		$str1 = "select * from photo_pelaut_tr where username = '$username' order by id_pptr ASC LIMIT $next_jml,1";
		$q1 = $this->db->query($str1);
		$f = $q1->row_array();
		
		return $f['nama_gambar'];
	}
	
	/* end of pagination */
	
	public function photo_panel($username = "")
	{
		if(empty($username))
		{
			$username = $this->session->userdata("username");	
		}
		
		$str = "select * from photo_pelaut_tr where username = '$username' order by datetime DESC limit 6";	
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
	}
	
	public function check_photo($photo = "")
	{
		if($photo != "")
		{
			$str = "select * from photo_pelaut_tr where nama_gambar like '$photo%' or nama_gambar = '$photo' ";
			$q = $this->db->query($str);
			$f = $q->row_array();
			return $f;
		}
		else
		{
			return array();	
		}
	}	
	
	// get photo berdasarkan id_pptr
	public function get_photo_id($id_pptr = "")
	{
		$str = "select * from photo_pelaut_tr where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}

	function get_company_photos($id_perusahaan)
	{
		$str = "select * from photo_perusahaan_tr where id_perusahaan = '$id_perusahaan' order by datetime desc";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
	}
	
	// get photo berdasarkan username
	public function get_photo_username()
	{
		$username = $this->session->userdata("username");
		$str = "select * from photo_pelaut_tr where username = '$username' ";	
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}
	
	/*===========================  Bagian Cover ============================== */
	public function get_photo_cover($username = "")
	{
		if($username == "")
		{
			$username = $this->session->userdata("username");
		}
		
		$str = "select * from photo_pelaut_tr where username = '$username' and cover = 1";
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}

	public function get_company_cover($id_perusahaan)
	{
		
		$str = "select * from photo_perusahaan_tr where (id_perusahaan = '$id_perusahaan' or username = '$id_perusahaan') and cover = 1";
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}
										// id_pptr yg akan dijadikan profile pic 
	public function update_cover($id_pptr)
	{
		$str = "UPDATE photo_pelaut_tr set cover = '1' where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);
	}
	
	// menjadikan yang tadinya profile pic menjadi 
										// id_pptr profile pic yang akan dijadikan gambar biasa
	public function update_cover_deselect($id_pptr)
	{
		$str = "UPDATE photo_pelaut_tr set cover = '0' where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);
	}
	/* ======================== end of Cover ======================================= */
	
	/*===========================  Bagian Profile Picture ============================== */
	// get photo berdasarkan username untuk mencari profile pic 
	
	public function delete_profilepic($idpptr)
	{
		$username = $this->session->userdata("username");

		$str = "DELETE from photo_pelaut_tr where (username = '$username' or id_pptr = '$idpptr') and profile_pic = 1 ";
		$q = $this->db->query($str);
		
		return $q;
	}
	
	public function get_photo_pp($username = "")
	{
		if($username == "")
		{
			$username = $this->session->userdata("username");
		}
		
		$str = "select * from photo_pelaut_tr where username = '$username' and profile_pic = 1";
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}
										// id_pptr yg akan dijadikan profile pic 
	public function update_profile_pic($id_pptr)
	{
		$str = "UPDATE photo_pelaut_tr set profile_pic = '1' where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);
	}
	
	// menjadikan yang tadinya profile pic menjadi 
										// id_pptr profile pic yang akan dijadikan gambar biasa
	public function update_pp_deselect($id_pptr)
	{
		$str = "UPDATE photo_pelaut_tr set profile_pic = '0' where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);
	}
	
	public function get_profile_perusahaan($perusahaan_id)
	{
		$str = "SELECT * FROM photo_perusahaan_tr where ( id_perusahaan = '$perusahaan_id' OR username = '$perusahaan_id' )  AND  profile_pic = 1";
		$q = $this->db->query($str);	
		$f = $q->row_array();
		
		return $f;
	}
	
	/* ======================== end of Profile pic ======================================= */
	
	/* ======================== resume picture =========================================== */
	
	public function delete_resume($idpptr)
	{
		$username = $this->session->userdata("username");

		$str = "DELETE from photo_pelaut_tr where (username = '$username' or id_pptr = '$idpptr')  and resume = 1 ";
		$q = $this->db->query($str);
		
		return $q;	
	}
	
	public function get_photo_resume()
	{
		$username = $this->session->userdata("username");
		$str = "select * from photo_pelaut_tr where username = '$username' and resume = '1'";
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}

	public function get_photo_resume_orang(){
		$username = $this->uri->segment(2);
		$str = "SELECT * FROM photo_pelaut_tr WHERE username = '$username' AND resume = '1'";
		$q = $this->db->query($str);
		$f = $q->row_array();

		return $f;
	}
	
	public function update_resume_pic($id_pptr)
	{
		$str = "UPDATE photo_pelaut_tr set resume = '1' where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);	
	}
	
	public function update_resume_deselect($id_pptr)
	{
		$str = "UPDATE photo_pelaut_tr set resume = '0' where id_pptr = '$id_pptr' ";
		$q = $this->db->query($str);
	}
	/* ======================== end resume pic ====================================*/
	 	
	public function album_photo($username) // GET ALBUM DARI DATABASE
	{
		$str = "select * from album where username = '$username' and album <> 0 order by id_album DESC";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
		
	}
	
	function select_last_photo_album($username,$id_album) // sendiri
	{
		$str = "select * from photo_pelaut_tr where id_album = '$id_album' and username = $username order by id_pptr DESC LIMIT 1";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
	}
	
	function select_last_phototml($username)
	{
		$str = "select * from timeline where username = '$username' and `type` = 'status' and photo <> '' order by id_timeline DESC LIMIT 1";;
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
	}
	
	function select_last_photo ($username)
	{
		$str = "select * from photo_pelaut_tr where username = '$username' order by id_pptr DESC LIMIT 1";;
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
	}
	
	
	
	// untuk halaman sendiri 
	public function get_self_tml()
	{
		$username = $this->session->userdata("username");
		$str = "select * from timeline where (username = '$username' or `to` = '$username') and photo <> '' and type = 'status' order by id_timeline DESC";
		
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
			
	}

	
	// untuk halaman orang lain 
	public function get_person_timeline($username){
		
		$str = "select * from timeline where (username = '$username' or `to` = '$username') and photo <> ''  and type = 'status' order by id_timeline DESC";
		
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
		
	}
	
	function insert_photo($dt_tml)
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		
		//$dt_tml[''] = !isset($to) && !empty($to) ? $to : "";
		$description = $this->input->post("description",true);
		
		$description = !isset($description) ? $description : $dt_tml["file_description"];
		
		$str  	 = "insert into photo_pelaut_tr set				 		  ";
		$str 	.= "nama_gambar		= '$dt_tml[nama_gambar]'			 ,";
		$str 	.= "size_gambar 		= '$dt_tml[size_gambar]'			 ,";
		$str 	.= "id_pelaut 			= '$dt_tml[id_pelaut]'				 ,";
		$str 	.= "type_gambar	 	= '$dt_tml[type_gambar]'			 ,";
		$str 	.= "title				= '$dt_tml[title]'					 ,";			
		$str 	.= "datetime 			= now()								 ,";
		$str 	.= "description		= '$description'					 ,";
		$str 	.= "profile_pic 		= ''								 ,";
		$str 	.= "username	 		= '$dt_tml[username]'				 ,";	
		$str 	.= "ip_address	 		= '$ip'								 ,";
		$str 	.= "agent				= '".$_SERVER['HTTP_USER_AGENT']."'	,";
		$str 	.= "id_album			= ''						 		  ";
		
		//echo $str."<br>"; exit;
		
		$q = $this->db->query($str);
		
		return $this->db->insert_id();
			
		
	}
}/* end class */