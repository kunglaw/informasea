<?php

    $url = base_url();

	$user = $this->session->userdata("user");

    $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

  	$this->load->helper('list_error_users_helper');

  

?>



<nav class="navbar navbar-default navbar-fixed-top hidden-xs" role="navigation">

    <div class="container-fluid">

       <div class="block-home">   

          <div class="navbar-header">

              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu">

              <span class="sr-only">Toggle navigation</span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              </button>

              <a class="navbar-brand" href="<?=base_url("home")?>">

                  <img src="<?php echo asset_url("img/logo.png")?>" alt="logo">

              </a>

          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->

          <div class="collapse navbar-collapse" id="mobile-menu">

                 

              <?php if($user == "pelaut") { ?>

              <ul class="nav navbar-nav main-menu text-white hidden-md hidden-sm">

                  <li>

                  	  <a href="<?= base_url("dashboard"); ?>" >

                  		<span class="nav-sprite text-center" aria-hidden="true"></span>DASHBOARD

                      </a>

                  </li>

                  <li>

                  	  <a href="<?= base_url("vacantsea"); ?>">

                      	<span class="nav-sprite text-center" aria-hidden="true"></span><?=strtoupper($this->lang->line("vacantsea"))?>

                      </a>

                  </li>

                  <li>

                  	  <a href="<?= base_url("seatizen"); ?>">

                      		<span class="nav-sprite text-center" aria-hidden="true"></span><?=strtoupper($this->lang->line("seatizen"))?>

                      </a>

                  </li>

                  <li><a href="/informasea.v2/informasea_design/company-list.php"><span class="nav-sprite text-center" aria-hidden="true"></span>
                  <?=strtoupper($this->lang->line("agentsea"))?></a></li>

              </ul>

              <form role="search" class="navbar-form navbar-search-form navbar-left" action="<?=base_url("search")?>">

                  <div class="input-group">

                      <input type="text" class=" search-query form-control" placeholder="<?=$this->lang->line("search")?> Informasea"/>

                      <span class="input-group-btn">

                          <button class="btn btn-nav-search" type="button">

                              <span class=" glyphicon glyphicon-search"></span>

                          </button>

                      </span>

                  </div>

              </form>

              

              <ul class="nav navbar-nav navbar-right">

                  <li>

                      <div class="notif-badge">10</div>

                      <a href="#" style="font-size: 1em;" ><i class="glyphicon glyphicon-envelope"></i></a>

                  </li>

                  <li class="dropdown">

                      <div class="notif-badge">10</div>

                      <a style="font-size: 1em;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bell"></i></a>

                      <ul class="dropdown-menu" id="dropdown-notification" role="menu">

                      <?php $this->load->view("include/notifications-listing.php") //include("include/notifications-listing.php"); ?>

                      </ul>        

                  </li>

                  <li class="dropdown">

                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"

                      aria-expanded="false"><span><i class="glyphicon glyphicon-menu-hamburger"></i></span></a>

                      <ul class="dropdown-menu dropdown-menu-blue" role="menu">

                          <li>

                          		<a href="<?= base_url("profile"); ?>">

                                	<img class="icon" src="assets/img/ic_profile.svg"> My Profile

                                </a>

                          </li>

                          <li>

                          		<a href="<?= base_url("dashboard"); ?>">

                                	<img class="icon" src="assets/img/ic_home.svg"> Dashboard

                                </a>

                          </li>

                          <li>

                          		<a href="<?= base_url("seatizen"); ?>">

                                	<img class="icon" src="assets/img/ic_seatizen.svg"> Seatizen

                                </a>

                          </li>

                          <li>

                          		<a href="<?= base_url("vacantsea"); ?>">

                                	<img class="icon" src="assets/img/ic_vacantsea.svg"> Vacantsea</a></li>

                          <li>

                          		<a href="<?= base_url("company"); ?>">

                          			<img class="icon" src="assets/img/ic_company.svg"> agentsea

                                </a>

                          </li>

                          <li>

                          		<a href="#"><img class="icon" src="assets/img/ic_logout.svg"> 

                                	Log out</a>

                                </li>

                                

                          <li class="divider"></li>

                          <li><a href="#">Informasea</a></li>

                          <li><a href="#">Career</a></li>

                          <li><a href="#">News</a></li>

                          <li><a href="#">Brand</a></li>

                          <li><a href="#">Contact</a></li>

                          <li><a href="#">Privacy</a></li>

                          <li><a href="#">Term & Condition</a></li>

                          <li><a href="#">Security</a></li>

                      </ul>

                  </li>

              </ul>

              <?php } else { ?>

  			  

              <?php

				  /*$err = !empty($err) ? $err : $_GET['err'];

				  $merr = list_login_error($err);

					  

				  $title	  	  = "Login Error";

				  $description 	= validation_errors()." ".$merr;*/

			  

			  ?>

              

              <!-- <form role="form" class="navbar-form navbar-right" action="<?=base_url("users/users_process/login_process")?>" method="post">

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

                  <button class="btn btn-login" type="submit">

                      <span class="text-white">Log In</span>

                  </button>

                  

              </form>  -->

              <ul class="nav navbar-nav navbar-left">

                  <li><a href="<?= base_url("vacantsea"); ?>">VACANTSEA</a></li>

                  <li><a href="<?= base_url("company"); ?>">AGENTSEA</a></li>

              </ul>

  

              <?php } ?>

          </div>

          <!-- /.navbar-collapse -->

       </div> 

    </div>

    <!-- /.container-fluid -->

</nav>



<script>

	$('#error-tip').popover({

		trigger: 'hover',

		'placement': 'left',

		html:true,

		animation:true,

		

	});



</script>