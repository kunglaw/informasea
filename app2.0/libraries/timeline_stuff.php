<?php 

	class Timeline_stuff
	{
		
		
		
		function __construct()
		{
			

		}
		
		function create_friends_link($tml)
		{
			
			$CI =& get_instance(); 
			$id_pelaut_session = $CI->session->userdata("id_user");
			//echo $tml; echo "<br>";
			$exp_tml = explode(" ",$tml);
			$words = "";
			
			foreach($exp_tml as $word){
				
				if(substr($word,0,1) == "@")
				{
					$usernamef = substr($word,1);
					
					// check usernamenya 
					$strf = "select * from pelaut_ms WHERE username = '$usernamef' ";
					$qf   = $CI->db->query($strf);
					$ff   = $qf->row_array(); 
					
					// check friendship 
					$CI->load->model("seaman/friendship_model");
					$fe = $CI->friendship_model->check_friend2($ff['pelaut_id'], $id_pelaut_session);  
					
					if(!empty($ff) && $fe == TRUE)
					{
						$href   = base_url("profile/$usernamef");
					 
						$output = "<a href='$href' target='_blank' > $word </a> ";
					}
					else
					{
						$output = $word;	
					}
				}
				else
				{
					$output = $word;	
				}
				
				$words .= " ".$output; 
			}
			
			$words = trim($words);
			
			return $words ;
		}
		
		function arr_mention($tml)
		{
			$CI =& get_instance(); 
			$CI->load->helper("notification_helper");
			$id_pelaut_session = $CI->session->userdata("id_user");
			$usender 		   = $CI->session->userdata("username");
			//echo $tml; echo "<br>";
			$exp_tml = explode(" ",$tml);
			$words = "";
			
			foreach($exp_tml as $word){
				
				if(substr($word,0,1) == "@")
				{
					$usernamef = substr($word,1);
					
					// check usernamenya penerima
					$strf = "select * from pelaut_ms WHERE username = '$usernamef' ";
					$qf   = $CI->db->query($strf);
					$ff   = $qf->row_array(); 
										
					// check friendship 
					$CI->load->model("seaman/friendship_model");
					$fe = $CI->friendship_model->check_friend2($ff['pelaut_id'], $id_pelaut_session);  
					
					if(!empty($ff) && $fe == TRUE)
					{
						
						$result[] = $usernamef;
					}
					
				}
				
				
				
			}
			
			return $result;
			
		}
		
		function is_mentioned($tml)
		{
			$CI =& get_instance(); 
			$CI->load->helper("notification_helper");
			$id_pelaut_session = $CI->session->userdata("id_user");
			$usender 		   = $CI->session->userdata("username");
			//echo $tml; echo "<br>";
			$exp_tml = explode(" ",$tml);
			$words = "";
			
			foreach($exp_tml as $word){
				
				if(substr($word,0,1) == "@")
				{
					$usernamef = substr($word,1);
					
					// check usernamenya penerima
					$strf = "select * from pelaut_ms WHERE username = '$usernamef' ";
					$qf   = $CI->db->query($strf);
					$ff   = $qf->row_array(); 
										
					// check friendship 
					$CI->load->model("seaman/friendship_model");
					$fe = $CI->friendship_model->check_friend2($ff['pelaut_id'], $id_pelaut_session);  
					
					if(!empty($ff) && $fe == TRUE)
					{
						// kasih notifikasi ke user yang di tuju 
						// notification_helper
										// penerima notif
						mention($usender,$usernamef);
					}
					
				}
				
				
				
			}
			
		}
							
		function makeLinks($tml) {
			
			$reg_exUrl 	 = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			$urls 	   	  = array();
			$urlsToReplace = array();
			
			if(preg_match_all($reg_exUrl, $tml, $urls)) {
				
				$numOfMatches = count($urls[0]);
				$numOfUrlsToReplace = 0;
				
				for($i=0; $i<$numOfMatches; $i++) {
					$alreadyAdded = false;
					$numOfUrlsToReplace = count($urlsToReplace);
					
					for($j=0; $j<$numOfUrlsToReplace; $j++) {
						
						if($urlsToReplace[$j] == $urls[0][$i]) {
							$alreadyAdded = true;
						}
					}
					if(!$alreadyAdded) {
						array_push($urlsToReplace, $urls[0][$i]);
					}
				}
				
				$numOfUrlsToReplace = count($urlsToReplace);
				
				for($i=0; $i<$numOfUrlsToReplace; $i++) {
					// echo $urlsToReplace[$i]."<br>";
					$tml = str_replace($urlsToReplace[$i], "<a href=\"".$urlsToReplace[$i]."\" target=\"_blank\">".$urlsToReplace[$i]."</a> ", $tml);
					
				}
				
				return $tml;
				
			} else {
				
				return $tml;
			}
			
		}
		
		function email_notif($arr)
		{
			
			$CI =& get_instance();
			
			$CI->load->library("my_email");
			
			$dt_template = $arr["dt_template"];
			
			$content_email = $arr["content_email"];
		
			$content = array(
			
				"subject" => $arr["subject"], // 
				"subject_title" => "Informasea",
				"to" => $arr["email_to"],
				"data" => $dt_template,
				"message" => $content_email, // message ini bukan path, jadi bukan load view
				//"alt_message" => "ini adalah atl message",
				"mv" => TRUE,
				"amv" => FALSE
				
			);
			
			$user = "info";
			
			// alhusna901 adalah salah satu config dari email.php di folder config
			// ini bisa diganti berdasarkan settingan di config/email.php
			$CI->my_email->send_email($user,$content);
		}
		
		function result($tml)
		{
			//$CI =& get_instance();
			// URUTAN TIDAK BOLEH BERUBAH 
			$result = $this->makeLinks($tml);
			$result = $this->create_friends_link($result);
			
			
			return $result;	
		}
		
		function __destruct()
		{
			
		}
		
		
	}
	