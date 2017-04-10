<?php
include "iflychat/iflychatsettings.php";
include "iflychat/iflychatuserdetails.php";
include "iflychat/iflychat.php";

global $iflychat_userinfo;
$iflychat_settings = new iFlyChatSettings();
$iflychat = new iFlyChat($iflychat_settings->iflychat_settings, $iflychat_userinfo->getUserDetails());
$ifly_html_code = $iflychat->getHtmlCode();
?>
<?php // index, module home ?>
<!DOCTYPE html>
<html>
  <head>
        <?php
			$meta = !empty($meta) ? $meta : "meta"; // tambahan meta
			$js_top = !empty($js_top) ? $js_top : "js_top"; // tambahan js_top
			
            $dt_head['meta']   = $meta;
            $dt_head['js_top'] = $js_top;
            
            $this->load->view('head',$dt_head);
             
        ?>
  </head>
  <body>
  <?php 
	  	
		$social_platform = !empty($social_platform) ? $social_platform : "social_platform";
	  	$this->load->view(@$social_platform,@$dt_social_platform); 
  ?>
  
      <div id="wrapper">
          <header id="header">
          	<?php $this->load->view('include/navbar',$dt_navbar); //include('include/navbar.php'); ?>            
          	<?php $this->load->view('include/navbar-mobile',$dt_navbar_mobile); //include('include/navbar-mobile.php'); ?>
          </header>
      </div>
  
      <?php
          $this->load->view('template',	$dt_template);
          $this->load->view('footer',	  $dt_footer);   
      ?>
   <!-- print iflychat -->
  <?php
  $cek_session  = $this->session->userdata("user");
  if (!empty($cek_session)) {
      print $ifly_html_code;
  }
  ?>
  </body>

</html>
	  <?php $this->load->view('js_under', $dt_js_under);?>
