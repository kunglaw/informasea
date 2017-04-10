<?php

/* Authentification config */

/*
	Under Construction config
	kita set apakah website , under construction atau tidak 
	
	dijalankan oleh library authentification
	
	kalau TRUE maka website underconstruction
	kalau FALSE sebaliknya 

	
*/

$config["underconst"]["set"] = TRUE;
$config["underconst"]["page"] = "under_const"; // controller / halaman yang dijadikan underconstruction

/*
	underconstruction user 
	
	artinya username apa saja yang boleh mengakses informasea.com.
	dibaca dari session

*/

$config["underconst"]["user"] = array(

								  "pelaut" => 
								  array(
									"rifal",
									"rini",
									"alhusna_99",
									"iqbal"
								  ),
								  
								  "agentsea" => 
								  array(
								  
									  "ottoman"
								  
								  ),
								  
								  "agent" => 
								  array(
								  
									  "agent1"
								  )
								
								
								);
/*
	underconstruction ulr 
	
	url apa saja yang di tutup dengan underconstruction page atau tidak.
	url yang dibaca adalah uri->segment yang ke satu
	--> $this->uri->segment
	
	TRUE = berarti di tutup, dengan underconstruction page
	FALSE = berarti di buka

*/
$config["underconts"]["url"] = array(

								// Modules
								  // url yang halaman
								  "users" => FALSE,
								  "vacantsea" => FALSE,
								  "home" => FALSE,
								  "seatizen" => FALSE,
								  "seaman" => FALSE,
									  "resume"=> FALSE,
									  "profile"=>FALSE,
									  "account_setting"=>FALSE,
									  "friendship"=>FALSE,
								  "agentsea" => FALSE, "company" => FALSE,
								  "agent" => FALSE,
								  "dashboard" => FALSE,
								  "about_infr"=>FALSE,
									  "about"=>FALSE,
									  "acontact"=>FALSE,
								  
								  // Module yang bukan halaman
								  "remember_me" => FALSE,
								  "notifications" => FALSE,
								
								  // controller luar
								  "testiqbal" => TRUE,
								  "welcome"=>TRUE,
								  "test"=>TRUE, 
								  "comment_tml"=>TRUE,
								  "uploadfile"=>TRUE,
								  "timeline_bak"=>TRUE
										
										
								);