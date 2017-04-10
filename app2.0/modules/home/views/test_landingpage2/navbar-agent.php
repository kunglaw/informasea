<?php

$id_perusahaan= $this->session->userdata("id_perusahaan");

$username     = $this->session->userdata("username_agent");



$this->load->model("company/company_model");

$username_company = $this->company_model->get_detail_company($id_perusahaan);



$profil_pic   = $this->user_model->GetProfilPic("where id_perusahaan='$id_perusahaan'")->result_array();



$nama_gbr     = $profil_pic[0]['nama_gambar'];





if(empty($nama_gbr) || !file_exists("../infrasset/company/photo/".$username_company['username']."/"."profil_pic/".$nama_gbr))

{

	$ggg = asset_url("user_img/noprofilepic_small.png");

}

else

{

	$ggg = img_url('company/photo/'.$username_company['username'].'/'.'profil_pic/'.$nama_gbr);	

}

?>

<ul class="nav navbar-nav navbar-right">

    <!-- <li>

        <div class="notif-badge">10</div>

        <a href="#" style="font-size: 1em;" ><i class="glyphicon glyphicon-envelope"></i></a>

    </li>

    <li class="dropdown">

        <div class="notif-badge">10</div>

        <a style="font-size: 1em;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bell"></i></a>

        <ul class="dropdown-menu" id="dropdown-notification" role="menu">

        <?php $this->load->view("include/notifications-listing.php") //include("include/notifications-listing.php"); ?>

        </ul>        

    </li> -->

  <li>

    	<a href="<?=base_url('agentsea/'.$username_company['username'].'/home');?>" class="dropdown-toggle pull-right" id="nama_dropdown" style="margin:0 0 0 0;">

            <b style="margin:0 0 0 -7px"><?php $nama = word_limiter($this->session->userdata("contact_person"),2); echo str_replace(".","6",strtoupper($nama));  ?></b>

        </a>  

        

        <a href="<?php echo base_url('agentsea/'.$username_company['username'].'/home') ?>" class="pull-right" style="margin:-5px 0px -17px 0px;">

            <img src="<?php echo $ggg ?>" class="hidden-xs hidden-sm" width="30" height="30" style="float:left; margin:0px 0px -4px 0px;  border:1px solid #CCC;">

        </a>

    </li>

    <li class="dropdown">

        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"

        aria-expanded="false"><span><i class="glyphicon glyphicon-menu-hamburger"></i></span></a>

        <ul class="dropdown-menu dropdown-menu-blue" role="menu">

           <!--  <li>

            		<a href="<?= base_url("profile"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_profile.svg")?>"> My Profile

                  </a>

            </li> -->

            <li>

            		<a href="<?= base_url("agentsea/".$username."/home"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_home.svg")?>"> Hull

                  </a>

            </li>

            <li>

            		<a href="<?= base_url("seatizen"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_seatizen.svg")?>"> Seatizen

                  </a>

            </li>

            <li>

            		<a href="<?= base_url("vacantsea"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_vacantsea.svg")?>"> Vacantsea</a></li>

            <li>

            		<a href="<?= base_url("company"); ?>">

            			<img class="icon" src="<?=asset_url("img/ic_company.svg")?>"> Agentsea

                  </a>

            </li>

            <li>

            		<a href="<?php echo base_url("users/users_process/logout")?>">

                  	<img class="icon" src="<?=asset_url("img/ic_logout.svg")?>"> Log out

                  </a>

            </li>

                  

            <li class="divider"></li>

            <!-- <li><a href="#">Informasea</a></li>

            <li><a href="#">Career</a></li>

            <li><a href="#">News</a></li>

            <li><a href="#">Brand</a></li> -->

            <li><a href="#">Contact</a></li>

            <!-- <li><a href="#">Privacy</a></li>

            <li><a href="#">Term & Condition</a></li>

            <li><a href="#">Security</a></li>-->

        </ul>

    </li>

</ul>