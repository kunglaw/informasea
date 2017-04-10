<style> 

	.activenih {     

		border-bottom:#2064ab 5px solid; 

		font-weight: bold;

	}



    .activenih:hover {

        border-bottom:none;

    }

 </style>

<?php if($this->uri->segment(1) == "vacantsea"){

        $activenih = "activenih";

    }else if($this->uri->segment(1) == "seatizen"){

        $activenih_s = "activenih";

    }else if($this->uri->segment(1) == "agentsea" OR $this->uri->segment(1) == "company"){

        $activenih_c = "activenih";

    } else if($this->uri->segment(1) == "seaman"){

        $active_nih_seaman = "activenih";

    }

    ?>





<ul class="nav navbar-nav main-menu text-white hidden-md hidden-sm">

   <!--  <li>

    	  <a href="<?= base_url("dashboard"); ?>" >

    		<span class="nav-sprite text-center" aria-hidden="true"></span>DASHBOARD

        </a>

    </li> -->

    <li class="<?=$activenih;?>"> 

          <a href="<?= base_url("vacantsea"); ?>"> 

            <span class="nav-sprite text-center" aria-hidden="true"></span>VACANTSEA                            



        </a>

    </li>

    <li class="<?=$activenih_s;?>">

          <a href="<?= base_url("seatizen"); ?>">

                <span class="nav-sprite text-center" aria-hidden="true"></span>SEATIZEN

        </a>

    </li> 

    <li class="<?=$activenih_c;?>"><a href="<?= base_url("agentsea"); ?>">

        <span class="nav-sprite text-center" aria-hidden="true"></span>AGENTSEA</a></li>

</ul>

<?php /*

<form role="search" class="navbar-form navbar-search-form navbar-left" action="<?=base_url("search/filter")?>" method="post">

    <div class="input-group">

        <input type="text" class=" search-query form-control" placeholder="Search Informasea" name="keyword" id="keyword"/>

        <input type="hidden" value="<?=current_url()?>" name="page" id="page"/>

        

        <span class="input-group-btn">

            <button class="btn btn-nav-search" type="submit">

                <span class=" glyphicon glyphicon-search"></span>

            </button>

        </span>

    </div>

</form> */ ?>



<ul class="nav navbar-nav navbar-right" >

    <!--  <li>

        <div class="notif-badge">10</div>

        <a href="#" style="font-size: 1em;" ><i class="glyphicon glyphicon-envelope"></i></a>

    </li> -->

    <li class="dropdown notifnya">  

     

        <div class="notif-badge notifikasi"></div>

        <a style="font-size: 1em;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bell"></i></a>

        <ul class="dropdown-menu" id="dropdown-notification" role="menu">

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

    <li class="dropdown" >

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

            <li>

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

            </li>

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

<?php $this->load->view('include/modal-report'); ?>