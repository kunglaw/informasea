<span class="modal-temp"></span>
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
    <style>
		.navbar-default{
			/* border-color:#FFF !important; */
			padding-bottom:40px;	
		}	

		.navbar-fixed-top{
			background-color:#2a2e33;
			color:#FFF;	
		}
		
		.navbar .container{
			margin-top:20px;	
		}
		
		#bs-example-navbar-collapse-1 ul li a{
			
			color:#FFF !important;	
			
		}		
		/*form*/
		
		.form-bootstrap .form-control {
			display: block;
			width: 100%;
			height: 34px;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			color: #555;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius:5px !important;
			
		}
		.form-bootstrap button, .form-bootstrap input, .form-bootstrap select, .form-bootstrap textarea {
			font-family: inherit;
			
		}
		
		.form-bootstrap button, .form-bootstrap input, .form-bootstrap optgroup, .form-bootstrap select, .form-bootstrap textarea {
			margin: 0;
			font: inherit;
			
		}
		
	
	</style>
	<link rel="stylesheet" href="<?=asset_url("css/social-buttons-3.css")?>" type="text/css" />
    
<?php /* <nav class="navbar navbar-default navbar-fixed-top">
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
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="bs-example-navbar-collapse-1">
				<span class="sr-only">Togge navigation</span>
				<i class="fa fa-ellipsis-v"></i>
			</button>
			<a class="navbar-brand" href="#" style="padding: 0px; margin-top: -5px;"><img src="<?php echo asset_url("img/logo_blue.png")?>" alt="logo" width="200" height="50" style="line-height:-100px; ">&nbsp;</a>
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
                <!-- <li>
				<form class="navbar-form" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
				</li> -->
            </ul>
			<?php
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

</nav> */ ?>

<?php include "navbar-example.php";?>