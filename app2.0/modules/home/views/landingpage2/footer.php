<?php // footer ?>

<style>
	p{
		font-size:16px !important;
			
	}
	
	footer{
		padding:0px !important;	
		
	}
	
	.container-footer{
		width:100%;
		padding-right: 15px !important;
		padding-left: 15px !important;
		margin-right: auto !important;
		margin-left: auto !important;	
	}
	
	
	#footer-baru {
	
		padding-bottom:0;
		background:#373e46;
		
		/*margin-bottom:auto;
		margin-right:auto;*/
	
	}
	
	
	#footer-baru .heading {
	
		color:white;
		margin-bottom:20px;
		margin-top:20px;
	
	}
	
	#footer-baru #footer-left
	{
		padding:60px 25px 30px 25px;
		padding-bottom:30px;
		
	}
	
	#footer-baru #footer-right
	{
		padding:60px 30px 0px 30px;
		background-color:#3093e4; /*background kanan*/
		height:100%;
		
	}
	
	#footer-baru a {
		
		color:#3093e4;
		font-weight:bolder;
		display:block;
		margin:5px 0;
	
	}
	
	#footer-baru a:hover {
	
		color:white;
	
	}

	
	#footer-baru .bottom {
	
		background:#565f69;
	
	}
	
	
	
	#footer-baru .bottom .column-bottom {
	
		padding:10px 0;
	
	}

	
	#footer-baru p {
	
		color:white;
	
	}

	
	#footer-baru img.logo-white {
	
		
		margin-bottom:20px;
	
	}
	
	#footer-baru .form-bootstrap div.ma{
	
		margin-bottom:25px !important;
	}
	
	#footer-baru input.form-control{
	
		background:#FFF;
		border-radius:10px;
		height:40px;	
	}
	
	#footer-baru button.btn
	{
		border-radius:10px;
	}
	
	#footer-baru textarea.form-control{
		border-radius:10px;
		
	}
	
	#footer-baru .sosmed-list{
		
		margin-right:-3%;
		line-height:50%;
			
	}
	
	#footer-baru .sosmed-list img{
		
		border-radius:10px;	
	}

</style>
<footer id="footer-baru">
   
   
    <div class="container">
      
        <div id="footer-left" class="col-md-6 col-sm-10">

            <div class="row" style="">
              
              <img src="<?=LOGO_INFORMASEA_WHITE?>" style="width:300px; height:73px;" class="logo-white img-responsive" alt="">

              <p align="justify">Informasea makes seafarers (we call it seatizen furthermore) and maritime employers (we call it company furthermore) has no gap to share any information. Each seatizen not only may share ANYTHING to others as their status but also may get invitation to walk on interview from any company. Updating CV and sea record in resume menu, may help seatizen to have a good impression for the company. Seatizen may find a preferable vacantsea based on their experience, salary, etc.</p>
              
            </div>
            <span class="clearfix"></span>
            
            <div class="row" style="">
            
                <h4 class="heading no-margin"><b>Sitemap : </b></h4>

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
            
            
            <div class="row">
                <h4 class="heading no-margin"><b>Follow Us  : </b></h4>
                
                <div class="col-md-2 col-sm-2 col-xs-2 sosmed-list">
                    <a href="https://plus.google.com/+informasea" target="_blank">
                        <img src="<?=asset_url("img/logo_sosmed/google_plus_button.png")?>" class="img img-responsive" style="" title="google"> 
                    </a>
                </div>
                
                <div class="col-md-2 col-sm-2 col-xs-2 sosmed-list">
                    <a href="https://www.facebook.com/informasea" target="_blank">
                        <img src="<?=asset_url("img/logo_sosmed/facebook_button.png")?>" class="img img-responsive" style="" title="facebook">
                    </a>
                </div>
                
                <div class="col-md-2 col-sm-2 col-xs-2 sosmed-list" >
                    <a href="https://twitter.com/informasea" target="_blank">
                        <img src="<?=asset_url("img/logo_sosmed/twitter_button2.jpg")?>" class="img img-responsive" style="" title="twitter">
                    </a>
                </div>
                
                <div class="col-md-2 col-sm-2 col-xs-2 sosmed-list">
                	<a href="https://www.linkedin.com/company/informasea-com" target="_blank">
                		<img src="<?=asset_url("img/logo_sosmed/linkedin_button.png")?>" class="img img-responsive" style="" title="linkedin">
                    </a>
                </div>
                
                <div class="col-md-2 col-sm-2 col-xs-2 sosmed-list">
                	<a href="#">
                		<img src="<?=asset_url("img/logo_sosmed/line_button2.png")?>" class="img img-responsive" style="" title="id:informasea">
                    </a>
                </div>
                
            </div>
             <span class="clearfix"></span>

        </div>

        <div id="footer-right" class="col-md-5 col-md-offset-1 col-sm-10">
           <div class="row">
            <h2 class="heading"><b> CONTACT US </b></h2>
            
            <form role="form" class="form-bootstrap" action="<?php echo base_url("home/send_mail_depan")?>" method="post">
    
                <div class="form-group ma" style="">
                    <!-- <label for="">Name: </label> --> 
                    <input type="text" class="form-control" id="name" name="nama" placeholder="Name" required>
    
                </div>
    
                <div class="form-group ma">
                    <!-- <label for="">Email:
                    <span style="font:10px;font-weight:lighter;color:#CCC">(Your email address will not be published) </span>
                    </label> -->
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email (Your email address will not be published)" required>
    
                </div>
    
                <div class="form-group ma">
                    <!-- <label for="">Subject: </label> -->
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="subject" required>
    
                </div>
    
                <div class="form-group ma">
                    <!-- <label for="">Message: </label> -->
                    <textarea class="form-control" id="password" name="message" cols="20" rows="1" style="resize:none;" placeholder="message" required></textarea>
    
                </div>
                
                <div class="form-group">
                    <?php
                    echo "<img src='".base_url("general/generate_captcha")."' id='captcha-img'>";
                    ?><br>
                    <a hidden="true"  style="color:#FFF; text-decoration:underline" href="#captcha-img" onclick="
                    document.getElementById('captcha-img').src='<?=base_url("general/generate_captcha")?>?'+Math.random();
                    document.getElementById('captcha-img').focus();"
                    id="change-image">Not readable? Change text.</a>
                    <input type="text" name="input_capt" style="color:black" placeholder="type the text above here ... ">
                </div>
                <br>
    
                <div class="form-group">
    
                    <button type="submit" name="" style="margin-top:-5px" 
                    class="btn btn-success btn-lg"> <b>Send</b> </button>
    
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
            
            </form>
            
            <!-- <form>

                <input type="text" class="form-control" placeholder="Enter your email">

                <button type="button" class="btn blue no-margin">Subscribe now!</button>

            </form> -->
		   </div>
        </div>
	
     
    </div><!-- container -->

	<span class="clearfix"></span>

	<div class="col-md-12 bottom no-padding no-margin">

		<div class="container">

			<div class="col-md-12 no-padding text-left column-bottom">

				<p>Copyright &copy; <span class="blue-color">Informasea.com</span> | All right reserved</p>

			</div>

		</div>

	</div>
	<span class="clearfix"></span>
    
</footer>
<span class="clearfix"></span>