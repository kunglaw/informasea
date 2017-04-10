
<section class="content container-fluid">
    <div class="row">
        <div class="block text-white">
        <center>
                <h2>Register as
                    <!-- <button class="btn btn-filled" onClick="javascript:location.href = '<?php //base_url("users/register/seaman")?>' ">
                      SEAMAN</button>
                    <button class="btn btn-transparent" onClick="javascript:location.href = '<?php //base_url("users/register/agentsea")?>' ">
                    AGENTSEA</button> -->
                </h2>
                </center>
            </div>
        <?php //$this->load->view("left-content/left-seatizen") ?>
        <div class="col-md-6 text-white m-t-1" style="border-right: 2px solid white">
            <div class="block text-white">
        <center>
                <h2>Seafarer</h2>
                </center>
            </div>
           <?php if(!empty($info['email']) || !empty($info['username']) || !empty($ve)){ ?>
           <div style="margin:0px 0 0px 0;" class="alert alert-danger row">
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
            <!-- success end ===> action="<?php // base_url("users/users_process/register_process_all") ?>" method="post"
             -->
            
            <form class="transparent register-form" id="register-seaman">
                <div class="form-group">
                  <label for="username_seaman">Username</label>&nbsp;
                    <span id="username_seaman_info" class="label">
                      
                    </span>
                    <input type="text" class="form-control" name="username_seaman" id="username_seaman" placeholder="Username"
                    value="<?=$username?>" >
                </div>
                <div class="form-group">
                  <label for="email">Email</label>&nbsp;
                    <span id="email_seaman_info" class="label">
                      
                    </span>
                    <input type="email" class="form-control" name="email_seaman" id="email_seaman" placeholder="Email"
                    value="<?=$email?>" >
                </div>
                
                <div class="form-group">
                  <label for="password_reg_seaman">Password</label>
                    <input type="password" class="form-control" name="password_reg_seaman" id="pasword_reg_seaman" placeholder="Password">
                </div>
                <!-- <div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div> -->
                <center>
                <div>

          <?php
                  echo "<img src='".base_url("general/generate_captcha")."' id='captcha-img2'>";
                  ?><br>
                  <a  style="color:#FFF; text-decoration:underline" href="#captcha-img" onclick="
                  document.getElementById('captcha-img2').src='<?=base_url("general/generate_captcha")?>?'+Math.random();
                  document.getElementById('captcha-img2').focus();"
                  id="change-image">Not readable? Change text.</a><br>
                  <input type="text" name="input_capt" style="color:black" placeholder="type the text above here ... ">
              </div>
                <div style="font-size: 12px">
                  By Clicking Register, You agree to our <a href="#" class="text-link"> terms </a>
                </div>
                <br>
                
                <div>
                    <button type="button" class="btn btn-filled" onclick="register_process('seaman')" style="width: 40%;font-size: 14pt;">Register</button>
                    <br>
                    OR
                    <br>
                    <button class="btn btn-primary" type="button" onclick="get_modal_login()" style="width: 20%;font-size: 12pt;">Facebook</button>
                    <button class="btn btn-danger" type="button" id="btn-google-login-register" style="width:20%; font-size:16px; "> Google  </button>
                    <!-- <button class="btn btn-social-icon btn-facebook" onclick="get_modal_login()" title="Login with Facebook"> 
                      <i class="fa fa-facebook"></i>
                  </button> -->
                </div>

                <div class="clearfix"></div>

                </center>
            </form>
        </div>
        <div class="col-md-6 text-white m-t-1">
            <div class="block text-white">
        <center>
                <h2>Agentsea</h2>
                </center>
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
            <!-- success end action="<?php //echo base_url("users/company_process/register"); ?>" 
            role="form" method="post" -->
            
            <form class="transparent register-form"  id="register-agentsea">
              
                 <?php // role ini menentukan submit akan di process kemana 
          
        ?>
                <!-- <div class="form-group">
                  <label for="username">Company Name</label>
                    <span id="element_company_name">
                      <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Company Name" 
                      value="<?php //set_value('nama_perusahaan');?>">
                    </span>
                </div>
                
                <div class="form-group">
                  <label for="username">Company Phone</label>
                    <span class="clearfix"></span>
                    <?php
           // $ext_num = $this->nation_model->get_nationality();
          ?>
                    <select name="ext_num" id="ext_num" class="form-control pull-left" style="width:30%">
                      <?php //foreach($ext_num as $row){ ?>
                      <option value="<?php //$row['kode_telp']?>&<?=$row['id']?>" data-image="<?php //strtolower(asset_url("flags/$row[flag]"))?>">
                          <?php //$row['kode_telp']?> - <?php //$row['name']?>
                        </option>
                        <?php //} ?>
                    </select>
                    
                    <input style="width:70%" type="text" class="form-control pull-right" id="phone_number" name="phone_number" placeholder="Company Phone Number" value="<?php //set_value('phone_number');?>">
                    <span class="clearfix"></span>
                </div> -->
                <div class="form-group pull-left" style="width: 49%">
                  <label for="company_name">Company Name</label>
                  
                    <input type="text" value="<?=set_value('company_name');?>" class="form-control" id="nama_agentsea" name="nama_agentsea" placeholder="Company Name">
                </div>
                <div class="form-group pull-right" style="width: 49%">
                  <label for="username">Company Username</label>
                  
                    <span id="username_agentsea_info" class="label" >
                      
                    </span>
                   
                    <input type="text" value="<?=set_value('username');?>" class="form-control" id="username_agentsea" name="username_agentsea" placeholder="Company Username">
                </div>
                <!-- <div class="form-group">
                  <label for="username">Company Username</label>
                  
                    <span id="username_agentsea_info" class="label" >
                      
                    </span>
                   
                    <input type="text" value="<?=set_value('username');?>" class="form-control" id="username_agentsea" name="username_agentsea" placeholder="Company Username">
                    <!-- <span style="color:#999; font-style:italic; font-size:11px">If you register as Manager , Username will be set as your url </span><br />
                    <span style="color:#999; font-style:italic;  font-size:11px">eg: informasea.com/company/username </span> --
                    
                </div> -->
                
                
                <div class="form-group pull-left" style="width: 49%">
                  <label for="email">Email</label>
                    <span id="email_agentsea_info" class="label">
                      
                    </span>
                    <input type="email" value="<?=set_value('email');?>"  class="form-control" id="email_agentsea" name="email_agentsea" placeholder="username@company.com">
                    <span style="color:#999; font-style:italic; font-size:11px"> Free email address (gmail, yahoo , etc ) is not acceptable</span>
                    <br />
                    <span style="color:#999; font-style:italic; font-size:11px"> 
                      <a href="<?=alpha_url("user/register")?>" target="_blank"> register </a> for free email address   
                    </span>
                </div>

                <div class="form-group pull-right" style="width: 49%">
                  <label for="username">Company Phone</label>

                    <span class="clearfix"></span>

                    <?php

            $ext_num = $this->nation_model->get_nationality();

          ?>

                    <select name="ext_num_agentsea" id="ext_num" class="form-control pull-left" style="width:40%">

                      <!-- <option selected >- Select a Country - </option> -->

                      <?php foreach($ext_num as $row){ ?>

                      <option value="<?=$row['kode_telp']?>&<?=$row['id']?>" data-image="<?=strtolower(asset_url("flags/$row[flag]"))?>">

                          <?=$row['kode_telp']?> - <?=$row['iso_alpha2']?>

                        </option>

                        <?php } ?>

                    </select>

                    

                    <input style="width:60%" type="text" class="form-control pull-right" id="phone_number_agentsea" name="phone_number_agentsea" placeholder="Company Phone Number">

                    <span class="clearfix"></span>
                </div>
                <span class="clearfix"></span>
                
                <div class="form-group pull-left" style="width:49%">
                  <label for="password">Password</label>
                    <input type="password" class="form-control" id="pasword_agentsea" name="password_agentsea" placeholder="Password">
                </div>
                
                <div class="form-group pull-right" style="width:49%">
                  <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder="website">
                </div>
                
                 <span class="clearfix"></span>
                
                <center>
                <div>

          <?php
                  echo "<img src='".base_url("general/generate_captcha")."' id='captcha-img'>";
                  ?><br>
                  <a style="color:#FFF; text-decoration:underline" href="#captcha-img" onclick="
                  document.getElementById('captcha-img').src='<?=base_url("general/generate_captcha")?>?'+Math.random();
                  document.getElementById('captcha-img').focus();"
                  id="change-image">Not readable? Change text.</a><br>
                  <input type="text" name="input_capt" style="color:black" placeholder="type the text above here ... ">
              </div>
                <div style="font-size: 12px">
                  By Clicking Register, You agree to our <a href="#" class="text-link"> terms </a>
                </div>
                <br>
                
                <div>
                    <button class="btn btn-filled" type="button" onclick="register_process('agentsea')" style="width: 40%;font-size: 14pt;">Register</button>
                </div>

                <div class="clearfix"></div>
                <br>
                </center>
            </form>
        </div>
    </div>
</section>