<ul class="nav navbar-nav navbar-right">
   <li class="dropdown" style="margin:0 0px 0 0">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="alse">
                  LOGIN
              </a>
              <div class="dropdown-menu" style="color:#000">
                <span class="arrow"></span>
                <div class="">
                    <form role="form" class="form-bootstrap" action="<?=base_url("users/users_process/login_universal")?>" method="post" >
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
                            
                            <input type="text" class="form-control normal" placeholder="Username or Email" name="username_lg"/>
                        </div>
                        <div class="form-group">
                           
                            <input type="password" class="form-control normal" placeholder="Password" name="password_lg"/>
                        </div>        
                        <div class="form-group">
                            <input name="remember_me" id="remember_me" value="0" class="" type="checkbox"> &nbsp; Remember Me
                        </div>
                        <div class="form-group">
                          <a href="https://www.informasea.com/users/forgotpass" 
                          style="text-decoration:underline !important; color:#03F !important">Forgot Password ? </a>
                        </div>
                        
                        <button class="btn form-control normal blue" type="submit" >
                            <span class="text-white">Log In</span>
                        </button>
                        
                        <!-- <span><hr style="margin-bottom:10px !important"></span> -->
                        
                        <p class="" align="center"> Or Login By : </p>
                        <button type="button" class="btn btn-facebook form-control normal" onclick="get_modal_login()" 
                        title="Login with Facebook"
                        style=""> 
                            <i class="fa fa-facebook"></i> Facebook
                        </button> <br> 
                        
                        <button type="button" class="btn btn-google form-control normal" id="btn-google-login" title="Login with Google+"> 
                            <i class="fa fa-google-plus"></i>
                             Google+ 
                        </button>
                         
                    </form>
                </div>
              </div>
              <style>
                  .dropdown-menu {
                      width: 300px !important;
                      padding:10px 20px !important;
                  }
              </style>
          </li>
   <!-- <li class="">
        <a href="#">LOGIN</a>
   </li> -->
   <li class=""><a href="<?=base_url("users/register")?>">REGISTER</a></li>
</ul>