<?php // template register agentsea ?>

<section class="content container-fluid">
    <div class="row">
        <?php $this->load->view("left-content/left-agentsea") ?>
        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2>Register as
                    <button class="btn btn-transparent" onClick="javascript:location.href = '<?=base_url("users/register/seaman")?>' ">
                    	SEAFARER</button>
                    <button class="btn btn-filled" onClick="javascript:location.href = '<?=base_url("users/register/agentsea")?>' ">
                    AGENTSEA</button>
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
            
            <form class="transparent register-form" action="<?php echo base_url("users/company_process/register"); ?>" 
            role="form" method="post" id="register-agentsea">
            	
                 <?php // role ini menentukan submit akan di process kemana 
					
				?>
                <div class="form-group">
                	<label for="first_name">Role</label>
                    <select class="form-control" name="role" id="role">
                    	<option value=""> - Role - </option>
                        <option value="manager">Manager</option>
                        <option value="agent">Agents</option>
                    </select>
                </div>
                
                <div class="form-group">
                	<label for="username">Company Name</label>
                    <span id="element_company_name">
                      <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Company Name" 
                      value="<?=set_value('nama_perusahaan');?>">
                    </span>
                </div>
                
                <div class="form-group">
                	<label for="username">Company Phone</label>
                    <span class="clearfix"></span>
                    <?php
						$ext_num = $this->nation_model->get_nationality();
					?>
                    <select name="ext_num" id="ext_num" class="form-control pull-left" style="width:30%">
                    	<option selected >- Select a Country - </option>
                    	<?php foreach($ext_num as $row){ ?>
                    	<option value="<?=$row['kode_telp']?>&<?=$row['id']?>" data-image="<?=strtolower(asset_url("flags/$row[flag]"))?>">
                        	<?=$row['kode_telp']?> - <?=$row['name']?>
                        </option>
                        <?php } ?>
                    </select>
                    
                    <input style="width:70%" type="text" class="form-control pull-right" id="phone_number" name="phone_number" placeholder="Company Phone Number" value="<?=set_value('phone_number');?>">
                    <span class="clearfix"></span>
                </div>
                
                <div class="form-group">
                	<label for="username">Company Username</label>
                  
                    <span id="username_info" class="label" >
                    	
                    </span>
                   
                    <input type="text" value="<?=set_value('username');?>" class="form-control" id="username" name="username" placeholder="Company Username">
                    <span style="color:#999; font-style:italic; font-size:11px">If you register as Manager , Username will be set as your url </span><br />
                    <span style="color:#999; font-style:italic;  font-size:11px">eg: informasea.com/company/username </span>
                    
                </div>
               	
                <div class="form-group">
                	<label for="first_name">Contact Person</label>
                    <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person"
                    value="<?=set_value('contact_person');?>">
                </div>
              	
                <!-- <div class="form-group">
                	<label for="nationality">Nationality</label>
                    <select name="nationality" id="nationality" class="form-control">
                    	<option value="">- Select Country -</option>
                        <?php foreach($ext_num as $row){ ?>
                        <option value="<?=$row['id']?>" data-image="<?=base_url("assets/flags/$row[flag]")?>">
                        	<?=$row['name']?>
                        </option>
                        <?php } ?>
                    </select>
                </div> -->
                
                <div class="form-group">
                	<label for="email">Email</label>
                    <span id="email_info" class="label">
                    	
                    </span>
                    <input type="email" value="<?=set_value('email');?>"  class="form-control" id="email" name="email" placeholder="username@company.com">
                    <span style="color:#999; font-style:italic; font-size:11px"> Free email address (gmail, yahoo , etc ) is not acceptable</span>
                    <br />
                    <span style="color:#999; font-style:italic; font-size:11px"> 
                    	<a href="<?=alpha_url("user/register")?>" target="_blank"> register </a> for free email address   
                    </span>
                </div>
                
                <!-- <div class="form-group">
                	<label for="reemail">Re-Enter Email</label>
                    <input type="email" class="form-control" id="reemail" name="reemail" placeholder="Re-enter Email">
                </div>-->
                
                <div class="form-group">
                	<label for="password">Password</label>
                    <input type="password" class="form-control" id="pasword" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                	<label for="re-password">Re-Enter Password</label>
                    <input type="password" class="form-control" id="re-password" name="repassword" placeholder="Re-enter Password">
                </div>
                <!-- <div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div> -->
                <div>
				  <?php
                  echo "<img src='".base_url("general/generate_captcha")."' id='captcha-img'>";
                  ?><br>
                  <a hidden="true"  style="color:#FFF; text-decoration:underline" href="#captcha-img" onclick="
                  document.getElementById('captcha-img').src='<?=base_url("general/generate_captcha")?>?'+Math.random();
                  document.getElementById('captcha-img').focus();"
                  id="change-image">Not readable? Change text.</a>
                  <input type="text" name="input_capt" style="color:black" placeholder="type the text above here ... ">
            	</div>
                <div class="pull-left" style="font-size: 12px">
                	By Clicking Register, You agree to our <a href="#" class="text-link"> terms </a>
                </div>
                <div class="pull-right">
                    <button class="btn btn-filled">Register</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</section>