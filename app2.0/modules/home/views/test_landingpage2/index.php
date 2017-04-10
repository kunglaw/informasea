<?php



include "iflychat/iflychatsettings.php";



include "iflychat/iflychatuserdetails.php";



include "iflychat/iflychat.php";



global $iflychat_userinfo;


// echo $_SERVER['REMOTE_ADDR'];
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
    <div class="stickyLogos">
		      <ul>
		      <li><h6>Premium Spot</h6></li>
		      	  <li><a href="http://www.karirrakyat.com/perusahaan/PT_MITRA_INSAN_SEJAHTERA/4258" target="_blank"><img src="/images/stickyLogos/mis.png" title="Lowongan kerja dari PT Mitra Insan Sejahtera"></a>
		          </li>
			  <li><a href="http://www.karirrakyat.com/perusahaan/PT_Dunia_Tehnik/3851" target="_blank"><img src="/images/stickyLogos/duniaTeknik_sl.png" title="Lowongan kerja dari PT_Dunia_Tehnik"></a>
		          </li>
			  <!--
		      	  <li><a href="http://www.karirrakyat.com/lowongan-kerja/PT_Satriakarya_Adiyudha_(SKAY)/SALESMAN_SALESGIRL_TANGGERANG_(_SLS_TGR)/11378" target="_blank"><img src="/images/stickyLogos/skay.jpg" title="Lowongan kerja dari PT Satriakarya Adiyudha"></a>
		          </li>
		          <li><a href="http://www.karirrakyat.com/perusahaan/ORANG-TUA%20GROUP%20RETAIL/3456" target="_blank"><img src="/images/stickyLogos/orangtua_sl.png" title="Lowongan kerja dari ORANG TUA GROUP RETAIL"></a>
		          </li>--><!--
		           <li><a href="http://www.karirrakyat.com/perusahaan/pt-century-franchisindo-utama-century-pharma/3410" target="_blank"><img src="/images/stickyLogos/centuryPharma_sl.png" title="Lowongan kerja dari PT. Century Franchisindo Utama (Century Pharma)"></a>
		          </li>-->
		          <li><a href="http://www.karirrakyat.com/perusahaan/Indomarco-Prismatama,%20PT/3401" target="_blank"><img src="/images/stickyLogos/indomaret_sl.png" title="Lowongan kerja dari PT Indomarco Prismatama" class="animated flip"></a>
		          </li><!--
		          <li><a href="http://www.karirrakyat.com/perusahaan/dunkin-donut/3395" target="_blank"><img src="/images/stickyLogos/dunkinDonut_sl.png" title="Lowongan kerja dari Dunkin Donuts Indonesia" class="animated flip"></a>
		          </li>--><!--
		          <li><a href="http://www.karirrakyat.com/perusahaan/pt-yakult-indonesia-persada/934" target="_blank"><img src="/images/stickyLogos/yakult_sl.png" title="Lowongan kerja dari PT Yakult Indonesia Persada"></a>
		          </li>--><!--
		          <li><a href="http://www.karirrakyat.com/perusahaan/PT_Home_Center_Indonesia_(Informa)/847" target="_blank"><img src="/images/stickyLogos/informa_sl.png" title="Lowongan kerja PT. Home Center Indonesia (Informa)"></a>
		          </li>-->
			  <!--
		          <li><a href="http://www.karirrakyat.com/perusahaan/pt-electronic-city-indonesia/917" target="_blank"><img src="/images/stickyLogos/ecity_sl.png" title="Lowongan kerja dari PT Electronic City Indonesia"></a>
		          </li>-->
		      </ul>
		</div>

	<?php $this->load->view("test_landingpage2/navbar",$dt_navbar); ?>

    <?php $this->load->view("test_landingpage2/template",$dt_template); ?>

    <?php $this->load->view("test_landingpage2/footer",$dt_footer); ?>

    <?php $this->load->view("test_landingpage2/js_under",$dt_js_under); ?>

    <?php

	  $cek_session  = $this->session->userdata("user");


	  if (!empty($cek_session)) {

		  print $ifly_html_code;


	  }

	?>

  </body>

</html>

