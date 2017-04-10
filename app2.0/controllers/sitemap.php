<?php

	class Sitemap extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();	
			
		}
		
		function index()
		{
			
			$this->load->view("sitemap_index");
		}

		function profile()
		{
			$this->load->view("sitemap_profile");	
		}
		
		function vacantsea()
		{
			$now = date("Y-m-d");
			
			$str = "SELECT 
		vacantsea.*, perusahaan.id_perusahaan, perusahaan.activation_code
		
		FROM vacantsea,perusahaan
		
		WHERE 
			
		perusahaan.id_perusahaan = vacantsea.id_perusahaan AND perusahaan.activation_code = 'ACTIVE' AND perusahaan.tampil = 1 AND
		
		vacantsea.stat = 'open' AND vacantsea.expired_date > '$now' ORDER BY create_date ASC, vacantsea_id DESC LIMIT 0,25000";
		
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			$data["vacantsea"] = $f;
			
			$this->load->view("sitemap_vacantsea",$data);
		}
		
		function seatizen()
		{
			$str = "select * from pelaut_ms where activation = 'ACTIVE' and `show` = 'TRUE' order by pelaut_id DESC LIMIT 0,25000";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			$data["seatizen"] = $f;
			
			$this->load->view("sitemap_seatizen",$data);
			
		}
		
		function agentsea()
		{
			$str = "SELECT a.*,b.* FROM perusahaan a, perusahaan_setting b WHERE a.id_perusahaan = b.id_perusahaan AND a.activation_code = 'ACTIVE' AND role = 'manager' AND a.tampil = 1 order by a.create_date DESC LIMIT 0,25000";
			$q = $this->db->query($str);
			$f = $q->result_array();
			
			$data["agentsea"] = $f; 
			
			$this->load->view("sitemap_agentsea",$data);
		}
		
		
	}