<?php
	
	class Ship_Model extends CI_Model{
		
		public function get_ships()
		{
			$str = "select * from ship";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;	
			
		}
		
		public function get_detail_ship($ship)
		{
			$str = "select * from ship where ship_name LIKE '$ship' or ship_id = '$ship' or id_ship_type = '$ship'";
			$q = $this->db->query($str);
			$f = $q->row_array();
			return $f;
		}

		public function get_company_ships($id_perusahaan){
			$str = "select * from ship where id_perusahaan = '$id_perusahaan' ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			return $f;
		}

		public function get_ships_type($id_kapal)
		{
			$str = "select * from ship_type where type_id = '$id_kapal' ";
			$q = $this->db->query($str);
			$f = $q->row_array();
			return $f;
		}
		
		function get_list_ship(){
			$str = "select * from ship_type";
			$q = $this->db->query($str);
			$f = $q->result_array();
			return $f;
		}
		
		function get_detail_ship_type_by_name($ship){
			$str = "select * from ship_type where ship_type = '$ship'";
			$q = $this->db->query($str);
			$f = $q->row_array();
			return $f;
		}
		
	
		
	}

?>