<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class friendship_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		
		//echo "model friendship_model jalan";
			
		
	}
	
	function show_friend($pelaut_id = ""){
		
		if($pelaut_id != "")
		{
		  $str = "select * from pelaut_ms where pelaut_id = '$pelaut_id' or username = '$pelaut_id' ";
		  $q = $this->db->query($str);
		  $f = $q->row_array();
		  
		  $arr = explode("|",$f['array_teman']);
		}
		else
		{
		  $arr = "";	
		}
		
		return $arr;
		
		
	}
	
	function detail_friend($pelaut_id)
	{
		
		$str = "select * from pelaut_ms where pelaut_id = '$pelaut_id' or username = '$pelaut_id' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
		
	}
	
	// username variation untuk menandakan timeline tersebut dari seseorang atau dari diri sendiri
	function username_variation($id_timeline = "")
	{
		//panggil friendship_model untuk mengetahui nama lengkap dari username
		$this->load->model("timeline_model");
		$dtml = $this->timeline_model->detail_timeline($id_timeline);
		$nama_self = $this->friendship_model->detail_friend($dtml['username']);
		$nama_to = $this->friendship_model->detail_friend($dtml['to']);
		
		if($dtml['to'] != "")
		{
			$username_variation = "<a href='".base_url("profile/$nama_self[username]")."'>$nama_self[nama_depan] $nama_self[nama_belakang]</a> 
			<span class='glyphicon glyphicon-chevron-right'></span>&nbsp;<a href='".base_url("profile/$dtml[to]")."'>$nama_to[nama_depan] $nama_to[nama_belakang]</a>";	
		}
		else
		{
			$username_variation = "<a href='".base_url("profile/$nama_self[username]")."'>$nama_self[nama_depan] $nama_self[nama_belakang]</a>";	
		}
		
		return $username_variation;
	}

	function cekProfileFriends($id_pelaut_timeline, $id_pelaut_session)
	{
		# code...
		$friends = $this->show_friend($id_pelaut_session);
		if(in_array($id_pelaut_timeline,$friends)) return TRUE;
		else return FALSE;
	}
	
	function check_friends($id_pelaut_timeline, $id_pelaut_session = "")
	{
		//echo "<p>".$id_pelaut_session."</p>";
		if($id_pelaut_session != "")
		{  
		  $friends = $this->show_friend($id_pelaut_session); // array teman2 username yang aktif
		  //print_r($friends);
		  //echo $id_pelaut_timeline;
		  
		  if(in_array($id_pelaut_timeline,$friends))
		  {
			  //echo "benar";
			  return TRUE;
			  
			  
		  }
		  else
		  {
			  //echo "salah";
			  return FALSE;	
			  
		  }
		}
		else
		{
			return TRUE;	
			
		}
		
		
		// username friends yang aktif 

	}
	
	// untuk kepentingan username link / mention 
	function check_friend2($id_pelaut_timeline, $id_pelaut_session = "")
	{
		 $friends = $this->show_friend($id_pelaut_session); // array teman2 username yang aktif
		  //print_r($friends);
		  //echo $id_pelaut_timeline;
		  
		  if(in_array($id_pelaut_timeline,$friends))
		  {
			  //echo "benar";
			  return TRUE;
			  
			  
		  }
		  else
		  {
			  //echo "salah";
			  return FALSE;	
			  
		  }
	}
	
	
	
}


