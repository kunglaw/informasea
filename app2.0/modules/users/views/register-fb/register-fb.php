<section class="content container-fluid">
    <div class="row">

        <?php $this->load->view("left-content/left-seatizen"); ?>

        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2>Register by Facebook as
                    <button class="btn btn-filled" onClick="javascript:location.href = '<?=base_url("users/register/seaman")?>' ">
                    	SEAMAN</button>
                    <!-- <button class="btn btn-transparent" onClick="javascript:location.href = '<?=base_url("users/register/agentsea")?>' ">
                    AGENTSEA</button> -->
                </h2>
            </div>
           <?php if(!empty($info['email']) || !empty($info['username']) || !empty($ve)){ ?>
           <div style="margin:0px 0 0px 0" class="alert alert-warning row">
           <?php // nilai variabel ini dari users/register.php ?>
           	 <p> <div id="" class="glyphicon glyphicon-exclamation-sign">
                    
             </div> Error </p>
             
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
		    else if($this->session->flashdata("error") != "")
			{
				echo $this->session->flashdata("error");
			}
		    else if ( !empty($success) )
			{
			 	echo $success;
		   
		    }?>
            <!-- success end -->
            
            <form class="transparent register-form" method="post" action="<?= base_url("users/users_sosmed/register_fb_process") ?>" id="register-fb">
            	<input type="hidden" value="<?=$this->input->cookie("fb_id",true)?>" name="fb_id" id="fb_id" >
                <input type="hidden" value="<?=$this->input->cookie("fb_gender",true)?>" name="fb_gender" id="fb_gender" />
                <input type="hidden" value="<?=$this->input->cookie("fb_religion",true)?>" name="fb_religion" id="fb_religion" />
                <input type="hidden" value="<?=$this->input->cookie("no_token",true)?>" name="no_token" id="no_token" />
                
                <div class="form-group">
                	<label for="fb_username">Username</label> &nbsp; 
                    <span id="username_info" class="label">
                    	
                    </span>
                    <input type="text" class="form-control" name="fb_username" id="fb_username" placeholder="Username" 
                    value="<?=$this->input->cookie("username",true)?>">
                </div>
                <div class="form-group pull-left" style="width: 49%">
                	<label for="fb_first_name">First Name</label>
                    <input type="text" class="form-control" name="fb_first_name" id="fb_first_name" placeholder="First Name"
                    value="<?=$this->input->cookie("fb_first_name",true)?>">
                </div>
                <div class="form-group pull-right" style="width: 49%">
                	<label for="fb_last_name">Last Name</label>
                    <input type="text" class="form-control" name="fb_last_name" id="fb_last_name" placeholder="Last Name"
                    value="<?=$this->input->cookie("fb_last_name",true)?>">
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                	<label for="fb_email">Email</label>&nbsp;
                    <span id="email_info" class="label">
                    	
                    </span>
                    <input type="email" class="form-control" name="fb_email" id="fb_email" placeholder="Email"
                    value="<?=$this->input->cookie("fb_email",true)?>" >
                </div>
                <div class="form-group">
                	<label for="re_email">Re-Enter Email</label>
                    <input type="email" class="form-control" name="re_email" id="re_email" placeholder="Re-enter Email">
                </div>
                <div class="form-group">
                	<label for="fb_password">Password</label>
                    <input type="password" class="form-control" name="fb_password" id="fb_password" placeholder="Password">
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