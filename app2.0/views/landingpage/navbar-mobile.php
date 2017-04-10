<?php
// navbar mobile 

	$id_user = $this->session->userdata("id_user");
	$nama = $this->session->userdata("nama");
	$user = $this->session->userdata("id_user");
	$username = $this->session->userdata("username");
	
	$dpelaut = $this->user_model->get_detail_pelaut($username);
	$rank 	= $this->rank_model->get_rank_detail($dpelaut['rank']); 
	
	//print_r($this->session->all_userdata());
	

?>
<nav class="navbar navbar-default navbar-fixed-top visible-xs" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- <a href="<?=base_url();?>" class="navbar-brand">Informasea</a> -->
            <div class="navbar-brand">
                <img src="<?php echo asset_url("img/logo.png")?>" alt="logo">
            </div>
            
            
            <ul class="nav-mobile pull-right">
                <?php if(!empty($user) && $user == "pelaut") { ?>
                <li><a href="#"><i class="glyphicon glyphicon-search"></i></a></li>
                  <li class="dropdown notifnya"> 
                      <div class="notif-badge notifikasi">
                      </div>
                      
                      <a style="font-size: 1em;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bell"></i></a>
                      
                      <ul class="dropdown-menu" id="dropdown-notification" role="menu">
                      <?php $this->load->view("include/notifications-listing.php") //include("include/notifications-listing.php"); ?>
                      </ul>  
                            
                  </li>

                 <?php } ?>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-expanded="false"><span><i class="glyphicon glyphicon-menu-hamburger"></i></span></a>
                    
                    <ul class="dropdown-menu dropdown-menu-blue" role="menu">
                        <?php if(!empty($user)) { ?>
                          <li>
                          		<a href="<?=base_url("seaman/resume"); ?>">
                                	<img class="icon" src="<?=asset_url("img/ic_profile.svg")?>"> My Profile
                                </a>
                          </li>
                        <!--   <li>
                          		<a href="<?//= base_url("dashboard"); ?>">
                                	<img class="icon" src="<?//=asset_url("img/ic_home.svg")?>"> Dashboard
                                </a>
                          </li> -->
                        <?php } ?>
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
                          <!-- <li>
                          		<a href="<?php // echo base_url("users/users_process/logout")?>">
                                	<img class="icon" src="<?//=asset_url("img/ic_logout.svg")?>"> 
                                	Log out
                                </a>
                          </li> -->
                        <?php if(!empty($user)) { ?>
                          <li>
                          		<a href="<?php echo base_url("users/users_process/logout")?>">
                                	<img class="icon" src="<?=asset_url("img/ic_logout.svg")?>"> 
                                	Log out
                                </a>
                          </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <!-- <li><a href="#">Informasea</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Brand</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Term & Condition</a></li>
                        <li><a href="#">Security</a></li> -->

                                                <li><a href="<?php echo base_url('infr-policy');?>">Privacy</a></li>

                        <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>

                    </ul>
                </li>
            </ul>
           
            
            <?php if(empty($user) && $user == "") { ?>
                <!-- <a href="dashboard.php" type="button" class="btn btn-login navbar-btn pull-right">Log In</a> -->
            <ul class="nav pull-right">
              <li class="dropdown" id="menuLogin">
                <a class="btn btn-login navbar-btn dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">
                    Log In</a>
                <div class="dropdown-menu" style="padding:17px;">
                  <form class="form" id="formLogin" role="form" action="<?=base_url("users/users_process/login_process")?>" method="post">
                    <input type="hidden" value="<?=!empty($_GET['login_attemp']) ? $_GET['login_attemp'] : 0 ?>" name="login_attemp"  />
                   <input type="hidden" value="<?=$this->uri->segment(1)?>" name="page" id="lastpage" />
                    <div class="form-group">
                       
                        <?php if($show_modal == 1 || $_GET['sm'] == 1){ ?>
                        
                          <span id="error-tip" class="glyphicon glyphicon-exclamation-sign" data-container="body" 
                          data-toggle="popover" data-placement="left" data-content="<?=$description?>" style="cursor:pointer" >
                          </span><span><?=$description?></span>        
                                  
                        <?php } ?>
                 
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="User Name" name="username_lg"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password_lg"/>
                    </div>
                    	<button type="submit" id="btnLogin" class="btn btn-primary form-control" style="margin-bottom:10px">Login</button>
                        
                        <button type="button" class="btn btn-facebook form-control" onClick="get_modal_login()"><i class="fa fa-facebook"></i> &nbsp; Login </button>
                  </form>
                </div>
              </li>
            </ul>
            <?php } ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>