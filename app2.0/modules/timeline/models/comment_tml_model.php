<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Comment_tml_model extends CI_Model{
	
	function get_comment($id_timeline = '')
	{
		if(empty($id_timeline))
		{
			$id_timeline = $this->input->post('id_timeline');
		}
		
		$str = "select * from comment_timeline WHERE id_timeline = '$id_timeline' LIMIT 5";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f; 
		
	}
	
	function get_all_comment($id_timeline = '')
	{
		if(empty($id_timeline))
		{
			$id_timeline = $this->input->post('id_timeline');
		}
		
		$str = "select * from comment_timeline where id_timeline = '$id_timeline'";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f; 
	}

	function jumlah_komentar($id_timeline=  ''){
		//$id_timeline = $this->input->post('id_timeline');

		$str = "SELECT * FROM comment_timeline WHERE id_timeline = '$id_timeline'";
		$q = $this->db->query($str);
		$f = $q->num_rows();
		return $f;
	}
	
	function insert_comment()
	{
		$id_timeline = $this->input->post("id_timeline",true);
		$content1	 = $this->input->post("post_content",true);
		$ip_address  = $_SERVER['REMOTE_ADDR'];
		$username 	 = $this->session->userdata("username");
		
		$content = htmlentities($content1,ENT_QUOTES);
		$this->load->helper('link_stuff_helper');
		$content = autolink($content);
		
		$str  = "insert into comment_timeline set  			";
		$str .= "content 	 = '$content'				   ,";
		$str .= "id_timeline = '$id_timeline'			   ,";
		$str .= "datetime 	 = now()					   ,";
		$str .= "ip_address  = '$ip_address'			   ,";
		$str .= "username 	 = '$username'				    ";
		
		//echo $str;
		
		$this->db->query($str);
		
	}
	
	function delete_comment($id_comment_timeline = '')
	{
		if(empty($id_comment_timeline)) $id_comment_timeline = $this->input->post("id_comment_timeline");	
		
		$str = "DELETE FROM comment_timeline WHERE id_comment_timeline = '$id_comment_timeline' ";
		$q   = $this->db->query($str);		
		
	}
	
	
	
}