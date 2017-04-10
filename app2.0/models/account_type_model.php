<?php

	class Account_type_model extends CI_Model{
		
		function list_account_type()
		{
			$str = "SELECT * FROM account_type ";
			$q   = $this->db->query($str);
			$f   = $q->result_array();
			
			return $f;
				
		}
		
		function detail_account_type($at)
		{
			$str = "SELECT * FROM account_type WHERE account = '$at' OR alias = '$at' OR id_account = '$at' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array();	
			
			return $f;
			
		}
		
		function synchronize_perusahaan()
		{
			$str = "SELECT a.*,b.* FROM perusahaan a, perusahaan_setting b WHERE a.id_perusahaan = b.id_perusahaan ";
			$q   = $this->db->query($str);
			$ff  = $q->result_array();
			
			$result = "";
			foreach($ff as $row)
			{
				$result[] = $row['id_perusahaan'];	
				
			}
			
			$str22 = "SELECT * FROM perusahaan_setting ";
			$q22  = $this->db->query($str22);
			$ff22  = $q22->result_array();
			
			$result22 = "";
			foreach($ff22 as $row22)
			{
				//print_r($result);
				if(!in_array($row22['id_perusahaan'],$result))
				{
					//echo "DELETE $row22[id_perusahaan] .. <br> ";
					$str = "DELETE FROM perusahaan_setting WHERE id_perusahaan = '$row22[id_perusahaan]' ";
					$q = $this->db->query($str);	
					echo "DELETE $row22[id_perusahaan] .. <br> ";
				}
				else
				{
					echo "$row22[id_perusahaan] AMAN ... <br>";	
				}
			}	
		}
		
	}