<?php // header seatizen, profile. module seaman
/*
	buat person yang tidak aktif, alias, dia tidak login 
*/

 ?>
<?php
	//$this->load->model('users/user_model');
	// nilai $username dari controller
	$username = $this->uri->segment(2);//username yang ada di url 
	
	$this->load->model('resume_model');
	$this->load->model('rank_model');
	
	$reserve = $this->authentification->reserve();
	$cover = $this->photo_mdl->get_photo_cover($username);
	$seatizen = $this->user_model->get_detail_pelaut($username);
	$seatizen_resume = $this->resume_model->get_profile_resume($seatizen['pelaut_id']);
	$rank = $this->rank_model->get_rank_detail($seatizen_resume['rank']);
	$friends = explode("|",$seatizen['array_teman']);
	
	$ss = explode(".",$cover['nama_gambar']);
	
	$url_cover = img_url("photo/$username/cover/$ss[0]"."_thumb.".$ss[1]);
	
	if(empty($cover))
	{
		//http://localhost/informasea/assets/img/img_ship.png
		$url_cover = asset_url("img/img_ship.png");
	}
	
?>

<?php

if(!empty($seatizen))
{
	
  $profile_pic = $this->photo_mdl->get_photo_pp($username);
  
  $pp = explode(".",$profile_pic['nama_gambar']);
  
  
  $url = img_url("photo/$username/profile_pic/$pp[0]"."_thumb.".$pp[1]);
  
  if(empty($profile_pic))
  {
	  
	  $url = asset_url("img/img_default.png");
  }
  $nama = $seatizen['nama_depan']." ".$seatizen['nama_belakang'];
}

//print_r($this->session->all_userdata());

?>

<div id="profile-header" style="background-image:url(<?php echo $url_cover ?>); background-repeat:no-repeat; background-size:cover">
    
    <div class="media" style="z-index:10">
    
        <a class="pull-left" href="#">
            <img class="media-object" src="<?php echo $url; ?>" alt="Image">
        </a>
        
        <div class="media-body text-white"  >
        
            <div class="pull-left">
            	
                <h3 class="media-heading "><?php echo $nama ?></h3>
                
                <br>
                
                <p> <?=$rank['rank']?> <br>
                  <?php if($seatizen['kebangsaan'] == ''){ ?>
                  <b><?=$seatizen['gender']?> </b>
                  <?php } else { ?>

                    <b><?=$seatizen['kebangsaan']?>, <?=$seatizen['gender']?></b>
                  <?php } ?>
                </p>
            </div>
            
            <div class="box text-center text-white pull-right hidden-xs"><h4>Friends</h4>
                <h2><?php echo count($friends) ?></h2>
            </div>
            
            <div class="clearfix"></div>
            
        </div>
        
    </div>
    
    <div style="height:50px; width:100%; background-color:#999; opacity:0.4; margin-top:106px;">
    
    </div>
    <div class="profile-text-container">
    
    
    </div>
    
</div>