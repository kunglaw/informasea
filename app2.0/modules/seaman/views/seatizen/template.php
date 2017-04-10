<?php // template seatizen, module seaman ?>
 
<?php 

  $username_url = $this->uri->segment(2); // username dari url
  $username_login = $this->session->userdata("username");
  
  if($ctrl == "seatizen")
  {
	  echo "<div class='container-fluid'>";
	  echo "<div class='row'>";
	  $this->load->view("seatizen/content"); 
	  $this->load->view("seatizen/right_content",$dt_content);
	  echo "</div>";
	  echo "</div>";
  }
  else if($ctrl == "resume")
  {
	  if($username_url != $username_login)
	  {
	  	// echo "terst";
		  echo "<div class='container-fluid'>";
		  echo "<div class='row'>";
		  $this->load->view("seatizen/content-resume-private");
		  echo "</div>";
		  echo "</div>";	
	  }
	  else
	  {
		  $this->load->view("resume/template");
	  }
  }

  
?>
       


