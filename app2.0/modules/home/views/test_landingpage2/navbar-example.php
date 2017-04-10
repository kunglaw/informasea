<span class="modal-temp"></span>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<!-- <div class="navbar-top text-right">
<div class="social">
				<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
				<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
				<a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a>
				<a href="#" class="vine"><i class="fa fa-vine"></i></a>
				<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
			</div>
		</div> -->
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<i class="fa fa-ellipsis-v"></i>
			</button>
			<a class="navbar-brand" href="<?=base_url()?>"><img src="<?php echo asset_url("img/logo_blue.png")?>" ></a>
		</div>
		
        <?php
			// facebook app 
			$this->load->view("facebook_app/facebook_login");
			
		  // google app
		  $this->load->view("google_app/google_login");
		?>
        
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<ul class="nav navbar-nav navbar-left">
            	<?php if($user_company == "company"){ ?>
                <li>

					  <?php if($this->session->userdata('account_type') != "Alpha"){ ?>
          
                      	<a href="<?= base_url("agentsea/".$username."/home"); ?>" >
                        	<span class="nav-sprite text-center" aria-hidden="true"></span>HULL
          				</a>
          
                      <?php } else { ?>
          
                      	<a href="<?=alpha_url($username."/home");?>"> 
                        	<span class="nav-sprite text-center" aria-hidden="true"></span>HULL
          				</a>
                      <?php } ?>
                      
   				</li>
                <?php } else if($user_company == "agent"){ ?>
                	<a href="<?= base_url("company/".$username."/home"); ?>" >

                        <span class="nav-sprite text-center" aria-hidden="true"></span>HULL
            
                    </a>
                <?php } ?>
            	<li class=""><a href="<?=base_url("vacantsea")?>">VACANTSEA</a></li>
                <li class=""><a href="<?=base_url("seatizen")?>">SEATIZEN</a></li>
                <li class=""><a href="<?=base_url("agentsea")?>">AGENTSEA</a></li>
            </ul>
            
			<?php /* <ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="index.html">Home</a></li>
				<li class="dropdown active">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">How it Works? <span class="caret"></span></a>
		          <ul class="dropdown-menu animated pulse" role="menu">
		            <li><a href="about.html">About</a></li>
		            <li><a href="features.html">Features</a></li>
		            <li><a href="plans_and_pricings.html">Plans and Pricings</a></li>
		          </ul>
		        </li>
				<li class="dropdown active">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="caret"></span></a>
		          <ul class="dropdown-menu animated pulse" role="menu">
		            <li><a href="blog.html">Blog List</a></li>
		            <li><a href="blog_single.html">Blog Single</a></li>
		          </ul>
		        </li>
		        <li class="dropdown active">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Job Seekers <span class="caret"></span><sup class="pill blue">10</sup></a>
		          <ul class="dropdown-menu animated pulse" role="menu">
		            <li><a href="profile_employer.html">Employer Profile</a></li>
		            <li><a href="job_search.html">Job Search</a></li>
		          </ul>
		        </li>
				<li class="dropdown active">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employeers <span class="caret"></span><sup class="pill blue">48</sup></a>
		          <ul class="dropdown-menu animated pulse" role="menu">
		            <li><a href="profile_worker.html">Worker Profile</a></li>
		            <li><a href="employers_list.html">Search Employers</a></li>
		            <li><a href="worker_search.html">Worker Search</a></li>
		          </ul>
		        </li>
				<li><a href="contact.html">Contact</a></li>
                <li><a href="#">Login</a></li>
				<li></li>
			</ul> */ 
				
				if($user == "pelaut") { 
				  include "navbar-seatizen.php"; // jangan pake $this->load->view
	  
				}elseif($user_company == "company"){
				  include "navbar-company.php";
				}
				else if($user_company == "agent"){
				  include "navbar-agent.php";
				}
				else
				{
				  include "navbar-guest.php";
				}
			
			
			?>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>