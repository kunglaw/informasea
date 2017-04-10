<?php

	class Recommendation_model extends CI_Model{
		
		function __construct()
		{
			parent::__construct();
			
		}
		
		function recommendation_list()
		{
			$str = "SELECT * FROM recommendation_tr ";
			$q = $this->db->query($str);
			$f = $q->result_array();

			return $f;
		}
		
		// recommendation list by 
		function rec_list_by_exp($experience_id)
		{
			$str = "SELECT * FROM recommendation_tr WHERE experience_id = '$experience_id' ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;
		}
		
		function rec_group_exp()
		{
			$str = "SELECT * FROM recommendation_tr GROUP BY experience_id ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;		
			
		}
		
		function rec_by_pelaut($id_pelaut)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_pelaut = '$id_pelaut' ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;	
		}
		
		function rec_comp_by_rank($id_pelaut,$rank_receiver,$id_perusahaan)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_pelaut = '$id_pelaut' AND rank_receiver = '$rank_receiver' AND id_perusahaan = '$id_perusahaan' ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;	
			
		}
		
		function rec_exp_pelaut_group($id_pelaut)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_pelaut = '$id_pelaut' GROUP BY experience_id";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;
			
			
		}
		
		function rec_comp_groupbyrank($id_pelaut)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_pelaut = '$id_pelaut' AND experience_id = 0 AND id_perusahaan <> 0 GROUP BY rank_receiver ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;	
			
		}
		
		function detail_recommendation($id_recommendation)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_recommendation = '$id_recommendation'";
			$q = $this->db->query($str);	
			$f = $q->row_array();
			
			return $f;
			
		}
		
		// memberikan rekomendasi lebih dari 2 , pada satu experience tidak diperbolehkan 
		function check_recommendation($id_pelaut_sender,$id_pelaut,$experience_id)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_pelaut_sender = '$id_pelaut_sender' AND id_pelaut = '$id_pelaut' AND experience_id = '$experience_id' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array();
			
			return $f;
			
		}
		
		function check_recommendation_comp($id_perusahaan,$id_pelaut,$rank_receiver)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_perusahaan = '$id_perusahaan' AND id_pelaut = '$id_pelaut' AND rank_receiver = '$rank_receiver' ";
			$q   = $this->db->query($str);
			$f   = $q->row_array();
			
			return $f;
			
		}
		
		function check_rec_bysender($id_pelaut_sender,$id_pelaut)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_pelaut_sender = '$id_pelaut_sender' AND id_pelaut = '$id_pelaut' ";
			$q   = $this->db->query($str);
			$f   = $q->result_array();
			
			return $f;
			
		}
		
		function check_rec_bycomp($id_perusahaan,$id_pelaut)
		{
			$str = "SELECT * FROM recommendation_tr WHERE id_perusahaan = '$id_perusahaan' AND id_pelaut = '$id_pelaut' ";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			return $f;
			
		}
		
		function add_recommendation($arr)
		{
			$id_pelaut 		= $arr["id_pelaut"];
			$id_pelaut_sender = $arr["id_pelaut_sender"];
			$experience_id	= $arr["experience_id"];
			$rank			 = $arr["rank"];
			$recommendation   = $arr["recommendation"];
			$position		 = $arr["position"];
			
			$id_perusahaan	= $this->session->userdata("id_perusahaan");
			$id_pelaut_sender = $this->session->userdata("id_user");
			
			$ip_address	   = $this->input->ip_address();
			$user_agent	   = $this->input->user_agent();
			
			
			$str  = "INSERT INTO recommendation_tr SET					 ";
			$str .= "id_pelaut 				= '$id_pelaut'			 	,";
			$str .= "id_perusahaan			= '$id_perusahaan'			,";
			$str .= "id_pelaut_sender		= '$id_pelaut_sender'	 	,";
			$str .= "experience_id			= '$experience_id'			,";
			if(!$id_pelaut_sender == "")
			{
				$str .= "rank				= '$rank'					,";
			}
			else if($id_perusahaan != "")
			{
				$str .= "rank_receiver		= '$rank'					,";
				$str .= "position			= '$position'				,";	
			}
			$str .= "recommendation			= '$recommendation'			,";
			$str .= "ip_address				= '$ip_address'				,";
			$str .= "user_agent				= '$user_agent'				,";
			$str .= "create_date			= now()						,";
			$str .= "last_update			= now()						 ";
			
			$this->db->query($str);
			
		}
		
		function update_recommendation($arr)
		{
			$id_recommendation= $arr["id_recommendation"];
			$id_pelaut 		= $arr["id_pelaut"];
			$id_pelaut_sender = $arr["id_pelaut_sender"];
			$experience_id	= $arr["experience_id"];
			$rank			 = $arr["rank"];
			$recommendation   = $arr["recommendation"];
			$position		 = $arr["position"];
			
			$id_perusahaan	= $this->session->userdata("id_perusahaan");
			$ip_address	   = $this->input->ip_address();
			$user_agent	   = $this->input->user_agent();
			
			
			$str  = "UPDATE recommendation_tr SET					 	 ";
			//$str .= "id_pelaut_sender		= '$id_pelaut_sender'	 	,";
			//$str .= "experience_id		= '$experience_id'			,";
			if(!$id_pelaut_sender == "")
			{
				$str .= "rank				= '$rank'					,";
			}
			else if($id_perusahaan != "")
			{
				$str .= "position			= '$position'				,";
				$str .= "rank_receiver		= '$rank'					,";	
			}
			$str .= "recommendation			= '$recommendation'			,";
			$str .= "ip_address				= '$ip_address'				,";
			$str .= "user_agent				= '$user_agent'				,";
			//$str .= "create_date			= now()						,";
			$str .= "last_update			= now()						 ";
			$str .= "WHERE id_recommendation = '$id_recommendation'		 ";
			
			//echo $str;
			
			$this->db->query($str);
		}
		
		
		
		
		
	}