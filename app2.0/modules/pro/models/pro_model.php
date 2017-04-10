<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pro_model extends CI_Model {
	
	function nationality($where=""){
		$sql 	= "select * from nationality ".$where;
		$query 	= $this->db->query($sql);
		return $query;
		
	}
	
}

