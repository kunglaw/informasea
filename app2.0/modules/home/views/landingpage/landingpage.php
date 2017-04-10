<?php
include "iflychat/iflychatsettings.php";
include "iflychat/iflychatuserdetails.php";
include "iflychat/iflychat.php";


global $iflychat_userinfo;
$iflychat_settings = new iFlyChatSettings();
$iflychat = new iFlyChat($iflychat_settings->iflychat_settings, $iflychat_userinfo->getUserDetails());
$ifly_html_code = $iflychat->getHtmlCode();
?>
<?php // index.php , GENERAL, ALL MODULES ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
  <head>
      <?php 
            $css = !empty($css) ? $css : "css"; // tambahan css 
      		$meta = !empty($meta) ? $meta : "meta"; // tambahan meta
      		$js_top = !empty($js_top) ? $js_top : "js_top"; // tambahan js_top
			
            $dt_head['css']  	= @$css;
            $dt_head['meta']   = @$meta;
            $dt_head['js_top'] = @$js_top;
            
            $this->load->view('landingpage/head',$dt_head);
             
     ?>
  </head>
  <body>
  	  <?php 
	  	
		$social_platform = !empty($social_platform) ? $social_platform : "social_platform";
	  	$this->load->view(@$social_platform,@$dt_social_platform); 
	  
	  ?>
      <div id="wrapper">
          <header id="header">
                <?php $this->load->view('landingpage/navbar',@$dt_navbar); //include('include/navbar.php'); ?>            
                <?php $this->load->view('landingpage/navbar-mobile',@$dt_navbar_mobile); //include('include/navbar-mobile.php'); ?>
          </header>
      </div>
  
      <?php
	  	  
          $this->load->view(@$template,	@$dt_template);
		  //if(!empty($footer)){ $footer = $footer; }else{$footer = "footer"; }
		  $footer = !empty($footer) ? $footer : "landingpage/footer";
          $this->load->view(@$footer, @$dt_footer);
		  
      ?>
      <span class="crop_temp"></span><!-- index -->

  <!-- print iflychat -->
  <?php
  $cek_session  = $this->session->userdata("user");
  if (!empty($cek_session)) {
      print $ifly_html_code;
  }
  ?>
  </body>
  <?php $js_under = !empty($js_under) ? $js_under : "landingpage/js_under" ?>
  <?php $this->load->view(@$js_under, @$dt_js_under);?>
</html>
	  