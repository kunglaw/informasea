<?php



include "iflychat/iflychatsettings.php";



include "iflychat/iflychatuserdetails.php";



include "iflychat/iflychat.php";



global $iflychat_userinfo;



$iflychat_settings = new iFlyChatSettings();



$iflychat = new iFlyChat($iflychat_settings->iflychat_settings, $iflychat_userinfo->getUserDetails());



$ifly_html_code = $iflychat->getHtmlCode();



?>



<!DOCTYPE html>

<html lang="en">

<head>
	
    <?php $this->load->view("googleadsense"); ?>
    
	<?php $this->load->view("landingpage2/head")?>

</head>

  <body>
	<?php
    	//google analitics
		$this->load->view("googleanalitics");
	?>
    
	<?php $this->load->view("landingpage2/navbar",$dt_navbar); ?>

    <?php $this->load->view("landingpage2/template",$dt_template); ?>

    <?php $this->load->view("landingpage2/footer",$dt_footer); ?>

    <?php $this->load->view("landingpage2/js_under",$dt_js_under); ?>

    <?php

	  $cek_session  = $this->session->userdata("user");


	  if (!empty($cek_session)) {

		  print $ifly_html_code;


	  }

	?>

  </body>

</html>

