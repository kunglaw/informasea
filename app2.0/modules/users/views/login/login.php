<?php // template login ?>

<?php
	
	// HARUSS REDIRECTTT !!! 
	$cookie = $_COOKIE;
	$u_cookie = $cookie['username'];
	$n_cookie = $cookie['name'];
	$p_cookie = $cookie['photo'];
	$c_cookie = $cookie['cover'];
	$s_cookie = $cookie['success'];
	
	$register_fb_nope = $cookie["register_fb_nope"];
?>

<?php
	if($register_fb_nope == TRUE)
	{
?>
		<script>
			
			var dt = ["<?php echo base_url("general/modal")?>",
			"content/modal/modal-alert-registerfb-nope",
			"Facebook Register",
			"The Activation Code has been send to your email,  <a href='#'>$email</a>. please confirm the activation code to your email to complete registration"];
			modal_general(dt);
		
		
		</script>
<?php		
	}

?>


<section class="content container-fluid">
    <div class="row">

        <?php $this->load->view("left-content/left-seatizen"); ?>

        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2>Login as
                    <button class="btn btn-filled" onClick="javascript:location.href = '<?=base_url("users/login/seaman")?>' ">
                    	SEAMAN</button>
                    <button class="btn btn-transparent" onClick="javascript:location.href = '<?=base_url("users/login/agentsea")?>' ">
                    AGENTSEA</button>
                </h2>
            </div>
           	
            <?php
				if($s_cookie != "")
				{
					echo $s_cookie;
				}
				
				if($this->session->flashdata("success") != "")
				{
					echo $this->session->flashdata('success');	
				}
			?>
            
            <form class="transparent register-form" role="form" action="<?=base_url("users/users_process/login_process")?>" method="post" >
               <?php
				  $err = !empty($err) ? $err : $_GET['err'];
				  $merr = list_login_error($err);
					  
				  $title	  	  = "Login Error";
				  //$description 	= $desc." ".$merr;
			  
			  ?>
           	  
              <div class="form-group">
              	              	<div class="col-md-5">
              	<a class="btn btn-block btn-social btn-facebook pull-left" onclick="get_modal_login()">
            		<i class="fa fa-facebook"></i> Log in with Facebook
                </a>
                </div>
                <!-- <div class="col-md-5">
                <a class="btn btn-block btn-social btn-google-plus pull-left" id="btn-google-login">
                  <i class="fa fa-google-plus"></i> Log in with Google
                </a>
                </div> -->
                <span class="clearfix"></span>
              </div>
              
              <?php if($_GET['sm'] ==1 || !empty($desc)) { ?>        
              <div class="alert alert-warning">
                  <p> <span id="" class="glyphicon glyphicon-exclamation-sign">
                    
                  </span> Error </p>
				   <?php if( $_GET['sm'] == 1 ){ 
                      
                      echo $merr;
                   
                    } ?>
                   <?php if(!empty($desc)){ 
                   
                      echo $desc;
                      
                   }?>
					
              </div> 
              <?php } ?>
            	
                <input type="hidden" value="<?=!empty($_GET['login_attemp']) ? $_GET['login_attemp'] : 0 ?>" name="login_attemp"  />
                            
                <div class="form-group">
                <?php
					
					if(!empty($cookie['username']))
					{
				?>	  
                		<!-- <p align="center">
                          <img width="99" height="99" name="" src="<?= $p_cookie ?>" />
                          <h4><?php echo $n_cookie; ?></h4> 
                          <a href="<?=base_url("users/users_process/change_cusername/?login_attemp=$_GET[login_attemp]")?>">Login with another account</a>   
                          <input type="hidden" id="username_lg" name="username_lg" value="<?=$u_cookie?>" readonly="readonly" />
                        </p>-->
                        
                        
                        <?php /* <div class="profile" style="background-image: url('<?=img_url("photo/$u_cookie/cover/".$c_cookie)?>') ">
                            <div class="profile-text-container">
                                <div class="profile-name">
                                    <a class="text-white" href="#">
                                        <h4><?php echo $n_cookie ?></h4>
                                    </a>
                                </div>
                                
                                <!-- <div class="profile-job"></div>
                                <div class="profile-nation"></div> -->
                            </div>
                            
                            <img class="img-responsive profile-picture" src='<?=$p_cookie;?>' width="99" height="99">
                        </div> --> */ ?>
                        
                        
                  <div id="profile-header" style="height:150px; margin-bottom:10px;">                            
                      <img src="<?=$c_cookie?>" alt="" class="img-responsive" width="100%" style="opacity:0.7">
                      <div class="media" style="">
                          <a class="pull-left" href="#">
                              <img class="media-object" src="<?=$p_cookie;?>" alt="Image" style="background-color:white">
                          </a>
                          <input type="hidden" id="username_lg" name="username_lg" value="<?=$u_cookie?>" readonly />
                          <div class="media-body text-white" >
                              <div class="pull-left">
                                  <h3 class="media-heading "><?php echo $n_cookie ?></h3>
                                  
                                      <!-- <p>Captain Ottoman Cruise <br>
                                      <b>Indonesia, Male</b>
                                      </p> -->
                              </div>
                              <!-- <div class="box text-center text-white pull-right hidden-xs"><h4>Friends</h4>
                                  <h2>173</h2>
                              </div>-->
                              <div class="clearfix"></div>
                          </div>
                      </div>
                      <div class="profile-text-container">
                      
                      </div>
                  </div>
                        
                 <a href="<?=base_url("users/users_process/change_cusername/?login_attemp=$_GET[login_attemp]")?>" class="text-link">
                 Login with another account </a>    
                         
                <?php
						
					}
					else{
					
				?>
                	<label>Username</label>
                    <input type="text" class="form-control" id="username_lg" name="username_lg" >
                <?php
					}
				?>
                </div>
                <div class="form-group">
                	<label>Password</label>
                    <input type="password" class="form-control" id="password_lg" name="password_lg" >
                </div>
                <div class="form-group">
                	<input type="checkbox" name="remember_me" id="remember_me" value="<?=$remember_me?>" class="" /> &nbsp; Remember Me
                </div>
                <a href="<?php echo base_url("users/forgotpass")?>" class="pull-left text-link">Forgot Password ? </a>

                <div class="pull-right">
                    <button class="btn btn-filled">Log in</button>
                </div>
                <span class="pull-right">&nbsp; Or &nbsp;</span>
                 <a href="<?=base_url("users/register")?>" class="pull-right text-link">Register to Informasea</a>
                 
                <div class="clearfix"></div>
               
            </form>
        </div>
    </div>
</section>
