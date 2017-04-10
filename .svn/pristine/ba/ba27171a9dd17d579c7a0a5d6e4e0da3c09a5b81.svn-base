<?php // left-profile, module dashboard ?>

<?php
$this->load->model("users/user_model"); // dari module users 
$this->load->model('rank_model');
$this->load->model("photo/photo_mdl");


$id_user = $this->session->userdata("id_user");
$nama = $this->session->userdata("nama");
$user = $this->session->userdata("user");
$username = $this->session->userdata("username");

$cover = $this->photo_mdl->get_photo_cover();
	
$ss = explode(".",$cover['nama_gambar']);
//print_r($ss);
$url_cover = img_url("photo/$username/cover/$ss[0]"."_thumb.".$ss[1]);

if(empty($cover))
{
	$url_cover = base_url("assets/img/pattern-cover.png");
}

if(empty($user))
{
	//$url = "assets/user_img/noprofilepic.bmp";
	$nama = "Guest";
	$url = "assets/user_img/noprofilepic.png";
	
}
else{
	
  $profile_pic = $this->user_model->get_profile_pic($id_user);
  $pelaut 	  = $this->user_model->get_pelaut($id_user);
  $pelaut_id   = $this->user_model->get_profile_resume($id_user);
  $rank 		= $this->rank_model->get_rank_detail($pelaut_id['rank']);
  
 
  
  $ss = explode(".",$profile_pic);
  $url = img_url("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1]);
  
  if(empty($profile_pic) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_thumb.".$ss[1])))
  {
	  
	  $url = base_url("assets/img/img_default.png");
  }
}

//print_r($this->session->all_userdata());

?>

<div class="profile" style="background-image: url('<?=$url_cover?>') ">
    <div class="profile-text-container">
        <div class="profile-name">
            <a class="text-white" href="<?php echo base_url("profile/$username"); ?>">
                <h4><?php echo $nama ?></h4>
            </a>
        </div>
        <div class="profile-job"><?php echo $rank['rank']?></div>
        <div class="profile-nation"><?php echo $pelaut['kebangsaan']?></div>
    </div>
    <button class="btn icon-block btn-filled">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
    </button>
    <img class="img-responsive profile-picture" src='<?=$url;?>' width="99" height="99">
</div>