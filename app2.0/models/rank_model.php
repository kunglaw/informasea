<?php if(!defined('BASEPATH')) exit ('no direct script access allowed');

class Rank_model extends CI_Model{
	
	//private $db;
	
	function __constrcut()
	{
		parent::__construct();
		//$this->db = $this->load->database("default",true);
	}
	
	function get_rank()
	{
		// harus berdasarka n
		$str = "select * from rank";	
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
	}
	
	function test()
	{
		echo "why ?";	
	}
	
	
	function get_rank_detail($id) // by id_department atau rank_id
	{
		
		
		$str = "select * from rank where rank_id = '$id' or id_department = '$id' ";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
	}
	
	function get_rank_detail_byid($id) // by id_department atau rank_id
	{
		
		
		$str = "select * from rank where rank_id = '$id'";
		$q = $this->db->query($str);
		$f = $q->row_array();
		
		return $f;
		
	}

    function get_rank_detail_by_rank($rank_name) // by id_department atau rank_id
    {
        $str = "select * from rank where rank = '$rank_name'";
        $q = $this->db->query($str);
        $f = $q->row_array();

        return $f;

    }
	
	function get_rank_bydept($id_department)
	{
		$str = "select * from rank where id_department = '$id_department' ";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		return $f;
	}
	
	function insert_rank()
	{
		
	}
	
	function update_rank()
	{
		
		
	}
	
	function delete_rank()
	{
		
		
	}
	
	
}


?>