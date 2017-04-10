<section class="content container-fluid">
    <div class="row">

        <?php $this->load->view("left-content/left-seatizen"); ?>

        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2>Register by Google as
                    <button class="btn btn-filled" onClick="javascript:location.href = '<?=base_url("users/register/seaman")?>' ">
                    	SEAMAN</button>
                    <!-- <button class="btn btn-transparent" onClick="javascript:location.href = '<?=base_url("users/register/agentsea")?>' ">
                    AGENTSEA</button>-->
                </h2>
            </div>
           <?php if(!empty($info['email']) || !empty($info['username']) || !empty($ve)){ ?>
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
             <?php if(!empty($info['username'])){ ?>
             	<div>
                	<?php echo $info['username']; ?>
                </div>
                
             <?php } ?>  
             
                        
          </div><br />
          <?php } 
		    else if ( !empty($success) )
			{
			 	echo $success;
		   
		    }?>
            <!-- success end -->
            
            <form class="transparent register-form" method="post" action="<?= base_url("users/users_sosmed/register_google_process") ?>" id="register-seaman">
            	<input type="hidden" name="google_id" id="google_id" value="" />
                <div class="form-group">
                	<label for="username_reg">Username</label> &nbsp; 
                    <span id="username_info" class="label">
                    	
                    </span>
                    <input type="text" class="form-control" name="username_reg" id="username_reg" placeholder="Username" 
                    value="<?=$_COOKIE["username_reg"];?>">
                </div>
                <div class="form-group pull-left" style="width: 49%">
                	<label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name"
                    value="<?=$_COOKIE["first_name"]?>">
                </div>
                <div class="form-group pull-right" style="width: 49%">
                	<label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"
                    value="<?=$_COOKIE["last_name"]?>">
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                	<label for="email">Email</label>&nbsp;
                    <span id="email_info" class="label">
                    	
                    </span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                    value="<?=$_COOKIE["email"]?>" >
                </div>
                <div class="form-group">
                	<label for="re_email">Re-Enter Email</label>
                    <input type="email" class="form-control" name="re_email" id="re_email" placeholder="Re-enter Email">
                </div>
                <div class="form-group">
                	<label for="password_reg">Password</label>
                    <input type="password" class="form-control" name="password_reg" id="pasword" placeholder="Password">
                </div>
                <div class="form-group">
                	<label for="re_password">Re-Enter Password</label>
                    <input type="password" class="form-control" name="re_password" id="re-pasword"
                           placeholder="Re-enter Password">
                </div>
                <div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div>
                <div class="pull-left" style="font-size: 12px">
                	By Clicking Register, You agree to our <a href="#" class="text-link"> terms </a>
                </div>
                <div class="pull-right">
                    <button class="btn btn-filled" type="submit">Register</button>
                </div>
                <div class="clearfix"></div>
                
            </form>
        </div>
    </div>
</section>