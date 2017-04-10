<?php

	class advertise_model extends CI_Model{
		
		private $db3;
		
		function __construct()
		{
			parent::__construct();
			$this->db3 = $this->load->database(DB_SETTING3,TRUE);	
			
		}
		
		function list_ad_request()
		{
			$str = "SELECT * FROM admin_advertise_list ";
			$q = $this->db3->query($str);
			$f = $q->result_array();
			
			return $f;	
			
		}
		
		function list_ad_area()
		{
			
			$str = "SELECT * FROM admin_ad_area WHERE active = 'TRUE' ";	
			$q   = $this->db3->query($str);
			$f   = $q->result_array();
			
			return $f; 
			
		}
		
		function list_ad_page()
		{
			$str = "SELECT * FROM admin_ad_page";
			$q = $this->db3->query($str);
			$f = $q->result_array();
			
			return $f;	
			
		}
		
		function list_ad_periode()
		{
			$str = "SELECT * FROM admin_ad_periode";
			$q = $this->db3->query($str);
			$f = $q->result_array();
			
			return $f;	
			
		}
		
		function detail_ad_page($id_page)
		{
			$str = "SELECT * FROM admin_ad_page WHERE id_page = '$id_page' ";
			$q = $this->db3->query($str);
			$f = $q->row_array();
			
			return $f;
			
		}

		function detail_ad_periode($id_periode)
		{
			$str = "SELECT * FROM admin_ad_periode WHERE id_periode = '$id_periode' ";
			$q   = $this->db3->query($str);
			$f   = $q->row_array();
			
			return $f; 	

		}
		
		function detail_ad_user($email)
		{
			$str = "SELECT * FROM admin_ad_user WHERE email = '$email' oR id_user_ad = '$email' ";
			$q = $this->db3->query($str);
			$f = $q->row_array();
			
			return $f;
		}
		
		function detail_ad_request($id_order)
		{
		   $str = "SELECT * FROM admin_advertise_list WHERE id_ad = '$id_order' ";
		   $q   = $this->db3->query($str);
		   $f   = $q->row_array(); 
		   
		   return $f;
				
		}
		
		function detail_ad_payment($id_order)
		{
		   $str = "SELECT * FROM admin_ad_payconf WHERE id_ad = '$id_order' ";
		   $q   = $this->db3->query($str);
		   $f   = $q->row_array();
		   
		   return $f;			
		}
		
		function generate_no_order($id_order)
		{
			$m = date("m");
			$d = date("d");
			
			$stat 	  = strlen(100);
			$sid_order = strlen($id_order);
			
			$zero = $stat - $sid_order;
			$gen_zero = "";
			for($i=1;$i<=$zero;$i++)
			{
				
				$gen_zero .= "0";	
			}
			//			   4    2  2          4
			return $no_order = "OAD0".$m.$gen_zero.$id_order;		
			
			
		}
		
		function detail_ad_area($id_area)
		{
			$str = "SELECT * FROM admin_ad_area WHERE id_area = '$id_area' OR area_name = '$id_area' ";
			$q = $this->db3->query($str);
			$f = $q->row_array();
			
			return $f;	
			
		}
		
		function total_payment($id_order)
		{
			$detail_order = $this->detail_ad_request($id_order);
			$detail_area = $this->detail_ad_area($detail_order["id_area"]);
			$detail_periode = $this->detail_ad_periode($detail_order["id_periode"]);
			$detail_page = $this->detail_ad_page($detail_order["id_page"]);
			
			//$total_periode = $detail_order["quantity_periode"] * $detail_periode["price"];
			$total_page = $detail_page["price"];
			$total_area = $detail_area["price"] * $detail_order["quantity_periode"];
			
			$total =  $total_area;
			
			$result = array(
				
				"tatal_page"=>$total_page,
				"total_area"=>$total_area,
				"total"=>$total
				
			);
			
			return $result;
		}
		
		function last_request_ad()
		{
			$str = "SELECT * FROM admin_advertise_list ORDER BY create_date DESC LIMIT 1";
			$q = $this->db3->query($str);
			$f = $q->row_array();
			
			return $f;	
			
		}
		
		function insert_request_ad($arr)
		{
			$id_ad			   = $arr["id_ad"];
			$id_user_ad		  = $arr["id_user_ad"];
			$ad_name 		  	 = $arr["ad_name"];
			$id_page 			 = $arr["id_page"];
			$id_area 		  	 = $arr["id_area"]; 
			$id_periode 	   	  = $arr["id_periode"];
			$quantity_periode    = $arr["quantity_periode"];
			$ad_alternative_text = $arr["ad_alternative_text"];
			$ad_target_url 	   = $arr["ad_target_url"];
			$start_date		  = $arr["start_date"];
			$ad_description 	  = $arr["ad_description"];
			$filename			= $arr["filename"];
			$purpose_bank		= $arr["purpose_bank"];
			
			$now = date("Y-m-d H:i:s");
			$ip_address = $_SERVER["REMOTE_ADDR"];
			$user_agent = $this->input->user_agent();
			
			$detail_periode = $this->detail_ad_periode($id_periode);
			$ap = $detail_periode["amount_periode"];
			$rp = $detail_periode["range_periode"];
			$total = $quantity_periode * $ap;
			
			$expired_date = date('Y-m-d', strtotime("+$total ".$rp."s", strtotime($start_date))); 
			
			$this->db3->set("id_ad",$id_ad);
			$this->db3->set("id_user_ad",$id_user_ad);			
			$this->db3->set('ad_name', $ad_name);
			//$this->db3->set("id_page",$id_page);
			$this->db3->set('id_area', $id_area);
			$this->db3->set('id_periode', $id_periode);
			$this->db3->set("quantity_periode",$quantity_periode);
			$this->db3->set("ad_alternative_text",$ad_alternative_text);
			$this->db3->set("ad_target_url",$ad_target_url);
			$this->db3->set("ad_description",$ad_description);
			
			$this->db3->set("status","off");
			$this->db3->set("media",$filename); //filename 
			$this->db3->set("create_date",$now);
			$this->db3->set("last_update",$now);
			$this->db3->set("start_date",$start_date);
			$this->db3->set("expired_date",$expired_date);
			$this->db3->set("purpose_bank",$purpose_bank);
			
			$this->db3->set("ip_address",$ip_address);
			$this->db3->set("user_agent",$user_agent);
			
			$this->db3->insert('admin_advertise_list'); 
			//$order = $this->last_request_ad();
			return $id_ad;
		}
		
		function update_paid_status($id_order)
		{
			$str = "UPDATE admin_advertise_list SET paid_status = 'pending_confirm' WHERE id_ad = '$id_order' ";
			$q   = $this->db->query($str);
			
			return $q; 	
			
		}
		
		function insert_ad_user($arr)
		{
			$name    = $arr["name"];
			$email   = $arr["email"];
			$no_telp = $arr["no_telp"];
			
			$ip_address = $_SERVER["REMOTE_ADDR"];
			$user_agent = $this->input->user_agent();
			
			$this->db3->set("name",$name);
			$this->db3->set("email",$email);
			$this->db3->set("no_telp",$no_telp);
			
			$this->db3->set("ip_address",$ip_address);
			$this->db3->set("user_agent",$user_agent);
			
			$this->db3->insert("admin_ad_user");
			
			return $this->db3->insert_id();
			
		}
		
		function payment_process($arr)
		{
			$an_account   = $arr["an_account"];
			$bank_account = $arr["bank_account"];
			$total_transfer = $arr["total_transfer"];
			$purpose_bank = $arr["purpose_bank"]; 
			$id_ad 		= $arr["id_ad"];
			$transfer_note= $arr["transfer_note"];
			
			$ip_address = $_SERVER["REMOTE_ADDR"];
			$user_agent = $this->input->user_agent();
			
			$this->db3->set("bank_account",$bank_account);
			$this->db3->set("bank_account_an",$an_account);
			$this->db3->set("total",$total_transfer);
			$this->db3->set("purpose_bank",$purpose_bank);
			$this->db3->set("id_ad",$id_ad);
			$this->db3->set("transfer_note",$transfer_note);
			
			$this->db3->set("ip_address",$ip_address);
			$this->db3->set("user_agent",$user_agent);
			
			$this->db3->insert("admin_ad_payconf");
			
			
		}
		
		
		
	}