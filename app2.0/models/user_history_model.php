<?php

	class User_history_model extends CI_Model{
		
		function get_view_seaman($username)
		{
			$str = "select * from user_history WHERE action LIKE '%username=$username%' ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;
			
		}
		
	}