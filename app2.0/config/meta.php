<?php

	// meta.php
	$year = date("Y");
	
	$keyword = array(
			
			"Lowongan Pelaut $year",
			"Job Seafarer $year",
			"Seafarer Resume $year",
			"Vacancy for Seafarer $year",
			"Seafarer $year",
			"Seafarer Job $year",
			"Seafarer Vacancy $year",
	);
	
	$config["title_tag"] = implode(" | ",$keyword);
	$config["meta_keyword"] = implode(" , ",$keyword);