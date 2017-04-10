<?php
	$username_session = $this->session->userdata("username");
?>

<style type="text/css">
    .media{
        padding-left: 10px;
    }
    #dropdown-notification .notification-header, #dropdown-notification .notification-footer, #page-notification .notification-header {
        padding: 8px 10px;
        margin: -5px 0px;
        
        font-weight: 100;
        background-color: #f6f4f5;
    }
    .notification-header{
        color: black;
    }

    .notification-footer{
        color: blue;
        text-decoration: none;
        text-align: center;
    }

</style>
<ul class="nav navbar-nav navbar-right" >
    <li class="dropdown notifnya" style="">  
        

        <a style="font-size: 1em;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bell"><div class="badge notifikasi" style="float: right"></div></i></a>

        <ul class="dropdown-menu" id="dropdown-notification" role="menu" style="min-width: 400px;">

        <?php $this->load->view("include/notifications-listing.php") //include("include/notifications-listing.php"); ?>

        </ul>
    </li>
    <li>
    	<a href="<?php echo base_url("seaman/resume") ?>" class="pull-right" id="nama_dropdown" style="margin:0 0 0 0;">
            <b style="margin:0 0 0 -7px"><?php $nama = word_limiter($this->session->userdata("nama"),2); echo str_replace(".","6",$nama);  ?></b>
        </a>  

        <a href="<?php echo base_url("seaman/resume") ?>" class="pull-right <?=$active_nih_seaman;?>" style="margin:-5px 0px -17px 0px;">
            <img src="<?php echo check_profile_seaman($this->session->userdata("username")) ?>" class="hidden-xs hidden-sm" width="30" height="30" style="float:left; margin:0px 0px -4px 0px;  border:1px solid #CCC; background-color:#FFF">
        </a>
    </li>
    <li>
    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"

        aria-expanded="false"><span><i class="glyphicon glyphicon-menu-hamburger"></i></span></a>

        <ul class="dropdown-menu dropdown-menu-blue" role="menu" style="background-color:#2a2e33">

            <li>

            		<a href="<?= base_url("seaman/resume"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_profile.svg")?>"> My Profile

                  </a>

            </li>

           <!--  <li>

            		<a href="<?= base_url("dashboard"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_home.svg")?>"> Dashboard

                  </a>

            </li> -->

            <!-- <li>

            		<a href="<?= base_url("seatizen"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_seatizen.svg")?>"> Seatizen

                  </a>

            </li>

            <li>

            		<a href="<?= base_url("vacantsea"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_vacantsea.svg")?>"> Vacantsea</a></li>

            <li>

            		<a href="<?= base_url("agentsea"); ?>">

            			<img class="icon" src="<?=asset_url("img/ic_company.svg")?>"> Agentsea

                  </a>

            </li> -->

            <li>
            	  <a onclick="javascript:" href="<?php echo base_url("users/users_process/logout")?>">

                  	<img class="icon" src="<?=asset_url("img/ic_logout.svg")?>"> 

                  	Log out

                  </a>
            </li>

                  

            <li class="divider"></li>

            <!-- <li><a href="#">Informasea</a></li>

            <li><a href="#">Career</a></li>

            <li><a href="#">News</a></li>

            <li><a href="#">Brand</a></li>-->

            <li><a href="<?=base_url('infr-policy');?>">Privacy</a></li>

            <!--

            <li><a href="#">Term & Condition</a></li>



            <li><a href="#">Security</a></li>

            <li><a href="#">Security</a></li> -->

            <li><a href="<?=base_url("contact")?>">Contact Us</a></li>

            <li><a href="#" data-toggle="modal" data-target="#modal-report"> Report Problem </a> </li>

        </ul>
    </li>

</ul>