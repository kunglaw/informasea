<?php

	class Test extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("Profile_resume_model","prm");
		}
		
		function index()
		{
			
			
			$this->load->library("table");
			$this->table->set_heading('Ship_name', 'rank_id', 'company',"periode_from","periode_to","pelaut_id");
			$dt = $this->prm->last_experience();
			echo "<title> Test </title>";
			
			foreach($dt as $row)
			{
				$str = "SELECT * FROM rank WHERE rank_id = '$row[rank_id]'";
				$q2 =  $this->db->query($str);
				$f2 = $q2->row_array();
				
				$row["rank_id"] = $f2["rank"];
				$data[] = $row;
			}
			
			$template = array(
			
				'table_open'            => '<table border="1" cellpadding="4" cellspacing="0">'
				
			);
			
			$this->table->set_template($template);
			echo $this->table->generate($data); 
			
			// get last data
			$last_array = end($dt);
			//print_r($last_array);
			echo"<hr>";
			$first_array = reset($dt);
			//print_r($first_array);
			
			//$date1 = new DateTime("2007-03-24");
			//$date2 = new DateTime("2009-06-26");
			$date1 = new DateTime($first_array["periode_from"]);
			$date2 = new DateTime($last_array["periode_to"]);
			
			$interval = $date1->diff($date2);
			echo $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
			
			// shows the total amount of days (not divided into years, months and days like above)
			//echo "difference " . $interval->days . " days ";
			
			
		}
		
		function test2()
		{
			$getDate = $this->prm->last_experience(5);
			print $getDate["first_date"]; 
			//print_r($getDate);
			//echo date_difference($getDate["first_date"],$getDate["last_date"]);
				
		}
		
		
	}