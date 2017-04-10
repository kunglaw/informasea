<span class="modal-temp"></span>
<!-- navbar08577 -->
<?php
    $url = base_url();
    $user = $this->session->userdata("user");
    $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	$this->load->helper("text_helper");
    $this->load->helper('list_error_users_helper');
  
?>

<?php 
	// view navbar/menu , module seaman
	//$this->load->helper("text"); 
	
	//$this->load->model("application/modules/users/models/user_model");
	$this->load->model("users/user_model"); // dari module users 
	$this->load->model("rank_model");
	
	$id_user      = $this->session->userdata("id_user");
	$nama         = $this->session->userdata("nama");
	$user         = $this->session->userdata("user");
	$username     = $this->session->userdata("username");
    $user_company = $this->session->userdata("user_company");
	
	if($username != "")
	{
		$dpelaut   = $this->user_model->get_detail_pelaut($username);
		$rank      = $this->rank_model->get_rank_detail($dpelaut['rank']); 
	}
	
	if(empty($user))
	{
		//$url = "assets/user_img/noprofilepic.bmp";
		$nama = "Guest";
		$url = "user_img/noprofilepic_small.png";
		
	}else{	
    $profile_pic = $this->user_model->get_profile_pic($id_user);

	  $nama_gambar = explode(".",$profile_pic);
	  $str_path_small = "photo/$username/profile_pic/$nama_gambar[0]"."_small.".$nama_gambar[1];
	  $str_path_thumb = "photo/$username/profile_pic/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
	  
	  $url = pathup($str_path_small);
	  $url_thumb = pathup($str_path_thumb);
	 
	  if(empty($profile_pic) || !file_exists($url))
	  {
		  $str_path_small = "photo/$username/profile_pic/$nama_gambar[0].".$nama_gambar[1];
	  	  $str_path_thumb = "photo/$username/profile_pic/$nama_gambar[0].".$nama_gambar[1];
		  
      	  $url 	   = pathup("photo/$username/profile_pic/$nama_gambar[0].".$nama_gambar[1]); 
		  $url_thumb = pathup("photo/$username/profile_pic/$nama_gambar[0].".$nama_gambar[1]);
		  
		  if(!file_exists($url))
		  {
		  	$str_path_small = "img/img_default.png";
		  	$str_path_thumb = "img/img_default.png";
		  }
	  }
	}
	
	function word2_limiter($string, $word_limit) {
		$words = explode(" ",$string);
		return implode(" ",array_splice($words,0,$word_limit));
  }
	//print_r($this->session->all_userdata());
?>

<link rel="stylesheet" href="<?=asset_url("css/social-buttons-3.css")?>" type="text/css" />

<!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.2/css/font-awesome.min.css" rel="stylesheet"> -->
<nav class="navbar navbar-default navbar-fixed-top hidden-xs" role="navigation" >
    <div class="container-fluid" id="header-navigation">
       <div class="block-home">   
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand" href="<?=base_url("home")?>">
                  <img src="<?php echo asset_url("img/logo.png")?>" alt="logo">&nbsp;
              </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="mobile-menu">
                 
          <?php 
		  
		  // facebook app 
			$this->load->view("facebook_app/facebook_login");
			
		  // google app
		  $this->load->view("google_app/google_login");
		  
		  //linkedin app
		  //$this->load->view("linkedin_app/linkedin_login");
		  
          if($user == "pelaut") { 
            include "navbar-seatizen.php"; // jangan pake $this->load->view

          }elseif($user_company == "company"){
            include "navbar-company.php";
		  }
		  else if($user_company == "agent"){
			include ("navbar-agent.php");
		  }
		  else {
			
            $err = !empty($err) ? $err : $_GET['err'];
            $merr = list_login_error($err);

            $title	  	  = "Login Error";
            $description 	= validation_errors()." ".$merr;
          ?>
          	<?php /* <div class="nav navbar-form navbar-right btn-group" style="margin-left:-25px; margin-top:10px; ">
              <button type="button" class="btn btn-primary dropdown-toggle" 
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-plus-sign"></span>
                  <span>Connect</span>
              
              </button>
              <ul class="dropdown-menu" >
                <li >
                	<button  class="btn btn-block btn-social btn-facebook" onclick="fb_login()" title="Login with Facebook" > 
                    	<i class="fa fa-facebook"></i>
                        <span> Sign in with facebook </span>
                    </button>
                </li>
                
                <li>
                  <button class="btn btn-social btn-google-plus" id="btn-google-login" title="Login with Google+"> 
                      <i class="fa fa-google-plus"></i>
                      <span> Sign in with Google+ </span>
                  </button> 
                </li>
                
                <li>
                  <button class="btn btn-social btn-linkedin" id="btn-linkedin-login" title="Login with Linkedin" onclick="javascript:location.href = 'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=759o6tx97v0loq&redirect_uri=http://informasea.com/users/users_sosmed/linkedin&state=987654321&scope=r_basicprofile' "> 
                      <i class="fa fa-linkedin"></i>
                      <span> Sign in with LinkedIn </span>
                  </button>
                </li>
                
              </ul>
            </div> */ ?>
            <ul class="nav navbar-nav navbar-right" style="">
            	 <li class="pull-left dropdown" style="margin:0 5px 0 0">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        LOGIN
                    </a>
                    <div class="dropdown-menu" style="">
                      <span class="arrow"></span>
                      <div class="">
                          <form role="form" class="" action="<?=base_url("users/users_process/login_universal")?>" method="post">
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
                                  
                                  <input type="text" class="form-control" placeholder="Username or Email" name="username_lg"/>
                              </div>
                              <div class="form-group">
                                 
                                  <input type="password" class="form-control" placeholder="Password" name="password_lg"/>
                              </div>        
                              <div class="form-group">
                			  	  <input name="remember_me" id="remember_me" value="0" class="" type="checkbox"> &nbsp; 
                                  <?=$this->lang->line("remember")?> <?=$this->lang->line("me")?>
                			  </div>
                              <div class="form-group">
                              	<a href="https://www.informasea.com/users/forgotpass" class=" text-link"><?=$this->lang->line("forgot")?> Password ? </a>
                              </div>
                              
                              <button class="btn btn-login form-control" type="submit" >
                                  <span class="text-white">Log In</span>
                              </button>
                              
                              <span><hr style="margin-bottom:10px !important"></span>
                              
                              <p class="" align="center"> <?=$this->lang->line("or")?> Login <?=$this->lang->line("by")?> : </p>
                              <button type="button" class="btn btn-facebook form-control" onclick="get_modal_login()" title="Login with Facebook"
                              style="margin-bottom:8px"> 
                                  <i class="fa fa-facebook"></i> Facebook
                              </button> <br> 
                              
                              <button type="button" class="btn btn-google form-control" 
                              id="btn-google-login" title="Login with Google+"> 
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
                <li class="pull-left dropdown" style="margin:0 5px 0 0">
                   <a href="<?=base_url("users/register_all")?>"> REGISTER </a>
                </li>
            	<li class="pull-left" style="margin:10px 15px 0 0"> 			<?php // dari folder facebook app ?>
                  <button class="btn btn-social-icon btn-facebook" onclick="get_modal_login()" title="Login with Facebook"> 
                      <i class="fa fa-facebook"></i>
                  </button> 
                </li>
                <?php
					$nation = $this->session->userdata("lang");
					if($nation == "" || $nation == "english")
					{
						
						$flag = "id.png";
						$lang2 = "Indonesian";	
					}
					else
					{
						$lang2 = "English";
						$flag = "gb.png";	
					}
				
				?>
                <li>
                  <a href="<?=base_url("lang/change")?>" title="change language to <?=$lang2?>">
                      <img src="https://www.informasea.com/informasea_assets/flags/<?=$flag?>" width="20" height="20"> 
                  </a>
           
                </li>
                <!-- <li class="pull-right"> 
                  <button class="btn btn-social-icon btn-google-plus" id="btn-google-login" title="Login with Google+"> 
                      <i class="fa fa-google-plus"></i>
                  </button> 
                </li> -->
                <?php /* <li>
                   <button class="btn btn-social-icon btn-linkedin" id="btn-linkedin-login" title="Login with Linkedin"> 
                      <i class="fa fa-linkedin"></i>
                  </button> 
                
                </li> */ ?>
            </ul>
            <?php // bekas form lama ?>
            <style> 
			
			  .activenih {     border-bottom:#2064ab 5px solid; 
				  font-weight: bold;
			  }
  
			  .activenih:hover {
				  border-bottom:none;
			  }
			
 			</style>
            
<?php if($this->uri->segment(1) == "vacantsea"){
	
        $activenih = "activenih";
		
    }else if($this->uri->segment(1) == "seatizen"){
		
        $activenih_s = "activenih";
		
    }else if($this->uri->segment(1) == "agentsea" OR $this->uri->segment(1) == "company"){
		
        $activenih_c = "activenih";
		
    } else if($this->uri->segment(1) == "seaman"){
		
        $active_nih_seaman = "activenih";
    }
    ?>
            <ul class="nav navbar-nav navbar-left">
                <li class="<?=$activenih;?>"><a href="<?= base_url("vacantsea"); ?>">VACANTSEA</a></li>
                <li class="<?=$activenih_s;?>"><a href="<?= base_url("seatizen"); ?>">SEATIZEN</a></li>
                <li class="<?=$activenih_c;?>"><a href="<?= base_url("agentsea"); ?>">AGENTSEA</a></li>
                
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