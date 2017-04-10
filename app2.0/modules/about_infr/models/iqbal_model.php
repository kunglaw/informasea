<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Iqbal_model extends CI_Model {


		function get_user(){
			$a = $this->db->query("SELECT * FROM pelaut_ms WHERE activation = 'ACTIVE' LIMIT 6");
			$f = $a->result_array();
			return $f;
		}

		function detail_user($id){
			$a = "SELECT * FROM profile_resume_tr WHERE pelaut_id = '$id'";
			$q = $this->db->query($a);
			$f = $q->row_array();
			return $f;
		}


		function get_pp($id){
			$a = "SELECT * FROM photo_pelaut_tr WHERE id_pelaut = '$id' AND profile_pic = 1";
			$q = $this->db->query($a);
			$f = $q->row_array();
			return $f;
		}


		function get_vacantsea(){
			$a = $this->db->query("SELECT * FROM vacantsea LIMIT 6");
			$f = $a->result_array();
			return $f;
		}


	}