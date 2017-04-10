<footer>

	<div class="container">
    
		<div class="row">

			<div class="col-md-3 col-sm-10">

				<img src="<?=LOGO_INFORMASEA?>" style="width:250px; height:50px" class="logo-white" alt="">

				<p align="justify">Informasea makes seafarers (we call it seatizen furthermore) and maritime employers (we call it company furthermore) has no gap to share any information. Each seatizen not only may share ANYTHING to others as their status but also may get invitation to walk on interview from any company. Updating CV and sea record in resume menu, may help seatizen to have a good impression for the company. Seatizen may find a preferable vacantsea based on their experience, salary, etc.</p>

			</div>

			<div class="col-md-3 col-sm-10 text-left">

				<h4 class="heading no-margin">Sitemap</h4>

				<hr class="blue">

				<div class="col-md-4 no-padding">

					<a href="<?=base_url()?>">Home</a>

					<a href="<?=base_url("vacantsea")?>">Vacantsea</a>

					<a href="<?=base_url("agentsea")?>">Agentsea</a>

					<a href="<?=base_url("Seatizen")?>">Seatizen</a>

				</div>

				<div class="col-md-4 no-padding">

					<a href="<?=base_url("about")?>">About Us</a>

					<a href="<?=base_url("contact")?>">Contact Us</a>

					<a href="<?=base_url("infr-policy")?>">Privacy Policy</a>

				</div>
                
                <div class="col-md-4 no-padding">

					<a href="<?=base_url("login")?>">Login</a>

					<a href="<?=base_url("register")?>">Register</a>

				</div>

			</div>

			<!-- <div class="col-md-3 col-sm-6 text-left">

				<h4 class="heading no-margin">Twitter Widget</h4>

				<hr class="blue">

				<div class="twitter-feed">

					<p class="no-margin"><strong>@cravious</strong>500 new jobs for freelance graphic designer</p>

					<p class="muted"># 2 hours ago</p>

				</div>

				<div class="twitter-feed">

					<p class="no-margin"><strong>@cravious</strong>500 new jobs for freelance graphic designer</p>

					<p class="muted"># 2 hours ago</p>

				</div>

			</div> -->

			<div class="col-md-5 col-sm-10 text-left">
				
                <h2 class="heading"> CONTACT US </h2>
    			<hr class="blue">
                <form role="form" class="form-bootstrap" action="<?php echo base_url("home/send_mail_depan")?>" method="post">
        
                    <div class="form-group">
                        <!-- <label for="">Name: </label> --> 
                        <input type="text" class="form-control" id="name" name="nama" placeholder="Name" required>
        
                    </div>
        
                    <div class="form-group">
                        <!-- <label for="">Email:
                        <span style="font:10px;font-weight:lighter;color:#CCC">(Your email address will not be published) </span>
                        </label> -->
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email (Your email address will not be published)" required>
        
                    </div>
        
                    <div class="form-group">
                        <!-- <label for="">Subject: </label> -->
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="subject" required>
        
                    </div>
        
                    <div class="form-group">
                        <!-- <label for="">Message: </label> -->
                        <textarea class="form-control" id="password" name="message" cols="10" rows="1" style="resize:none;" placeholder="message" required></textarea>
        
                    </div>
                    
                    <div class="form-group">
                        <?php
						echo "<img src='".base_url("users/generate_captcha")."' id='captcha-img'>";
						?><br>
						<a hidden="true"  style="color:#FFF; text-decoration:underline" href="#captcha-img" onclick="
						document.getElementById('captcha-img').src='<?=base_url("test/run_captcha")?>?'+Math.random();
						document.getElementById('captcha-img').focus();"
						id="change-image">Not readable? Change text.</a>
						<input type="text" name="input_capt" style="color:black" placeholder="type the text above here ... ">
        			</div>
                    <br>
        
                    <div class="form-group">
        
                        <button type="submit" name="" style="margin-top:-5px" class="btn blue"> Send </button>
        
                    </div>
        
                    <br>
        
                          <?php if(!empty($info['email']) || !empty($info['nama']) || !empty($ve)){ ?>
                   <div style="margin:0px 0 0px 0" class="alert alert-warning row">
                   <?php // nilai variabel ini dari users/register.php ?>
                     <p> <div id="" class="glyphicon glyphicon-exclamation-sign">
        
                     </div> Error </p>
        
                     <div class="">
                        <?php //echo validation_errors(); ?>
                        <?php echo $ve; ?>
                     </div>
        
                     <?php if(!empty($info['email'])){ ?>
                        <div>
                            <?php echo $info['email']; ?>
                        </div>
        
                     <?php } ?>
                     <?php if(!empty($info['nama'])){ ?>
                        <div>
                            <?php echo $info['nama']; ?>
                        </div>
        
                     <?php } ?>
        
        
                  </div><br />
                  <?php }
                    else if ( !empty($success) )
                    {
                        echo $success;
        
                    }?>
                <br><br><br><br><br>
                </form>
                
				<!-- <form>

					<input type="text" class="form-control" placeholder="Enter your email">

					<button type="button" class="btn blue no-margin">Subscribe now!</button>

				</form> -->

			</div>

		</div>

	</div>

	<div class="row bottom no-padding no-margin">

		<div class="container">

			<div class="col-md-12 no-padding text-left column-bottom">

				<p>Copyright &copy; <span class="blue-color">Informasea.com</span> | All right reserved</p>

			</div>

		</div>

	</div>

</footer>