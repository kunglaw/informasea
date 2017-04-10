<?php // template vacantsea\
	if($_SERVER['REMOTE_ADDR'] == '36.78.4.103' && $is_preview && ($position == "_left")){
		echo "<div class=\"stickyLogos\" style='background-color: yellow; width: 90px; height: 400px'>
		      Your Ads Space Here
		      <br>
		      (Fixed Left)<br>
		      90x400 pixel
		</div>";
	}
 ?>
 <!-- <ul>
		      <li><h6>Premium Spot</h6></li>
		      	  <li><a href=\"http://www.karirrakyat.com/perusahaan/PT_MITRA_INSAN_SEJAHTERA/4258\" target=\"_blank\"><img src=\"/images/stickyLogos/mis.png\" title=\"Contoh Ads\"></a>
		          </li>
			  <li><a href=\"http://www.karirrakyat.com/perusahaan/PT_Dunia_Tehnik/3851\" target=\"_blank\"><img src=\"/images/stickyLogos/duniaTeknik_sl.png\" title=\"Contoh Ads\"></a>
		          </li> -->
			  <!--
		      	  <li><a href=\"http://www.karirrakyat.com/lowongan-kerja/PT_Satriakarya_Adiyudha_(SKAY)/SALESMAN_SALESGIRL_TANGGERANG_(_SLS_TGR)/11378\" target=\"_blank\"><img src=\"/images/stickyLogos/skay.jpg\" title=\"Contoh Ads\"></a>
		          </li>
		          <li><a href=\"http://www.karirrakyat.com/perusahaan/ORANG-TUA%20GROUP%20RETAIL/3456\" target=\"_blank\"><img src=\"/images/stickyLogos/orangtua_sl.png\" title=\"Contoh Ads\"></a> 
		          </li>--><!-- Lowongan kerja dari ORANG TUA GROUP RETAIL
		           <li><a href=\"http://www.karirrakyat.com/perusahaan/pt-century-franchisindo-utama-century-pharma/3410\" target=\"_blank\"><img src=\"/images/stickyLogos/centuryPharma_sl.png\" title=\"Lowongan kerja dari PT. Century Franchisindo Utama (Century Pharma)\"></a>
		          </li>-->
		          <!-- <li><a href=\"http://www.karirrakyat.com/perusahaan/Indomarco-Prismatama,%20PT/3401\" target=\"_blank\"><img src=\"/images/stickyLogos/indomaret_sl.png\" title=\"Contoh Ads\" class=\"animated flip\"></a>
		          </li> --><!--Lowongan kerja dari PT Indomarco Prismatama
		          <li><a href=\"http://www.karirrakyat.com/perusahaan/dunkin-donut/3395\" target=\"_blank\"><img src=\"/images/stickyLogos/dunkinDonut_sl.png\" title=\"Contoh Ads\" class=\"animated flip\"></a>
		          </li>--><!-- Lowongan kerja dari Dunkin Donuts Indonesia
		          <li><a href=\"http://www.karirrakyat.com/perusahaan/pt-yakult-indonesia-persada/934\" target=\"_blank\"><img src=\"/images/stickyLogos/yakult_sl.png\" title=\"Lowongan kerja dari PT Yakult Indonesia Persada\"></a>
		          </li>--><!--
		          <li><a href=\"http://www.karirrakyat.com/perusahaan/PT_Home_Center_Indonesia_(Informa)/847\" target=\"_blank\"><img src=\"/images/stickyLogos/informa_sl.png\" title=\"Lowongan kerja PT. Home Center Indonesia (Informa)\"></a>
		          </li>-->
			  <!--
		          <li><a href=\"http://www.karirrakyat.com/perusahaan/pt-electronic-city-indonesia/917\" target=\"_blank\"><img src=\"/images/stickyLogos/ecity_sl.png\" title=\"Lowongan kerja dari PT Electronic City Indonesia\"></a>
		          </li>-->
		      <!-- </ul> -->
    <div class="container-fluid">
        <div class="row">

            <?php $this->load->view("content"); ?>
            <?php $this->load->view("right_content"); ?>

        </div>
    </div>
<?php // end template ?>