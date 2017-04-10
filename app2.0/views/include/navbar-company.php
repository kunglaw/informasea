<?php

$id_perusahaan= $this->session->userdata("id_perusahaan");

$username     = $this->session->userdata("username_company");

$profil_pic   = $this->user_model->GetProfilPic("where id_perusahaan='$id_perusahaan' and profile_pic = 1")->result_array();

$nama_gbr    = $profil_pic[0]['nama_gambar'];

$account_type = $this->session->userdata('account_type');



?>

<style> .activenih {     border-bottom:#2064ab 5px solid; 

    font-weight: bold;

}



    .activenih:hover {

        border-bottom:none;

    }

 </style>

<?php if($this->uri->segment(3) == "home" or $this->uri->segment(3) == "profile" or $this->uri->segment(3) == "vacantsea"){

        $activenih = "activenih";

    }else if($this->uri->segment(1) == "vacantsea" and $this->uri->segment(3) == ""){

        $activenih_v = "activenih";

    }else if($this->uri->segment(1) == "agentsea" OR $this->uri->segment(1) == "company" and $this->uri->segment(3) == ""){

        $activenih_c = "activenih";

    } else if($this->uri->segment(1) == "seatizen" and $this->uri->segment(3) == ""){

        $active_nih_seaman = "activenih";

    }

    ?>

<ul class="nav navbar-nav main-menu text-white hidden-md hidden-sm">

    <li class="<?= $activenih ?>">

            <?php if($account_type != "Alpha"){ ?>

    	  <a href="<?= base_url("agentsea/".$username."/home"); ?>" >

    		<?php } else { ?>

            <a href="<?=alpha_url($username."/home");?>">

            <?php } ?>

            <span class=" nav-sprite text-center" aria-hidden="true"></span>HULL

        </a>

    </li>

    <li class="<?= $activenih_v ?>">

    	  <a href="<?= base_url("vacantsea"); ?>">

        	<span class=" nav-sprite text-center" aria-hidden="true"></span><?=strtoupper($this->lang->line("vacantsea"))?>

        </a>

    </li>

    <li class="<?= $active_nih_seaman ?>">

    	  <a href="<?= base_url("seatizen"); ?>">

        		<span class=" nav-sprite text-center" aria-hidden="true"></span><?=strtoupper($this->lang->line("seatizen"))?>

        </a>

    </li>

    <li class="<?= $activenih_c ?>"><a href="<?= base_url("agentsea"); ?>">

    	<span class=" nav-sprite text-center" aria-hidden="true"></span><?=strtoupper($this->lang->line("agentsea"))?></a></li>

</ul>

<!-- <form role="search" class="navbar-form navbar-search-form navbar-left" action="<?=base_url("search/filter")?>" method="post">

    <div class="input-group">

        <input type="text" class=" search-query form-control" placeholder="Search Informasea" name="keyword" id="keyword"/>

        <input type="hidden" value="<?=current_url()?>" name="page" id="page"/>

        

        <span class="input-group-btn">

            <button class="btn btn-nav-search" type="submit">

                <span class=" glyphicon glyphicon-search"></span>

            </button>

        </span>

    </div>

</form> -->



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

        <?php if($account_type != "Alpha"){ ?>

        

    	<a href="<?=base_url('agentsea/'.$username.'/home');?>" class="dropdown-toggle pull-right" id="nama_dropdown" style="margin:0 0 0 0;">

            <?php } else { ?>

            <a href="<?=alpha_url($username."/home");?>" class="dropdown-toggle pull-right" id="nama_dropdown" style="margin:0 0 0 0;">

            <?php } ?>

            <b style="margin:0 0 0 -7px"><?php $nama = word_limiter($this->session->userdata("nama_perusahaan"),2); echo str_replace(".","6",strtoupper($nama));  ?></b>

        </a>  

        <?php if($account_type != "Alpha"){ ?>

        <a href="<?php echo base_url('agentsea/'.$username.'/home') ?>" class="pull-right" style="margin:-5px 0px -17px 0px;">

            <?php } else { ?>

        <a href="<?php echo alpha_url($username.'/home') ?>" class="pull-right" style="margin:-5px 0px -17px 0px;">



            <?php }?>

            <img src="<?php echo img_url('company/photo/'.$username.'/logo/'.$nama_gbr); ?>" class="hidden-xs hidden-sm" width="30" height="30" style="float:left; margin:0px 0px -4px 0px;  border:1px solid #CCC;">

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

                    <?php if($account_type != "Alpha"){ ?>

            		<a href="<?= base_url("agentsea/".$username."/home"); ?>">

                        <?php }else{ ?>

                        <a href="<?=alpha_url($username."/home");?>">

                        <?php } ?>

                  	<img class="icon" src="<?=asset_url("img/ic_home.svg")?>"> Hull

                  </a>

            </li>

            <li>

            		<a href="<?= base_url("seatizen"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_seatizen.svg")?>"> <?=strtoupper($this->lang->line("seatizen"))?>

                  </a>

            </li>

            <li>

            		<a href="<?= base_url("vacantsea"); ?>">

                  	<img class="icon" src="<?=asset_url("img/ic_vacantsea.svg")?>"> <?=strtoupper($this->lang->line("vacantsea"))?></a></li>

            <li>

            		<a href="<?= base_url("agentsea"); ?>">

            			<img class="icon" src="<?=asset_url("img/ic_company.svg")?>"> <?=strtoupper($this->lang->line("agentsea"))?>

                  </a>

            </li>

            <li>

            		<a href="<?php echo base_url("users/users_process/logout")?>">

                  	<img class="icon" src="<?=asset_url("img/ic_logout.svg")?>"> <?=strtoupper($this->lang->line("logout"))?>

                  </a>

            </li>

                  

            <li class="divider"></li>

            <!-- <li><a href="#">Informasea</a></li>

            <li><a href="#">Career</a></li>

            <li><a href="#">News</a></li>

            <li><a href="#">Brand</a></li> -->

            <li><a href="#"><?=$this->lang->line("contact_us")?></a></li>

            <!-- <li><a href="#">Privacy</a></li>

            <li><a href="#">Term & Condition</a></li>

            <li><a href="#">Security</a></li>-->

        </ul>

    </li>

</ul>