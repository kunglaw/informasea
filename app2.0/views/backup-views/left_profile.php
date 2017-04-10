<?php // left profile  

//$this->load->model("application/modules/users/models/user_model");
$this->load->model("users/user_model"); // dari module users 
$this->load->model("rank_model");

$id_user = $this->session->userdata("id_user");
$nama = $this->session->userdata("nama");
$user = $this->session->userdata("user");
$username = $this->session->userdata("username");

$dpelaut = $this->user_model->get_profile_resume($id_user);
$rank 	= $this->rank_model->get_rank_detail($dpelaut['rank']); 

if(empty($user))
{
	//$url = "assets/user_img/noprofilepic.bmp";
	$nama = "Guest";
	$url = "assets/user_img/noprofilepic_small.png";
	
}
else{
	
  $profile_pic = $this->user_model->get_profile_pic($id_user);
  $nama_gambar = explode(".",$profile_pic);
  $str_small = "photo/$username/profile_pic/$nama_gambar[0]"."_small.".$nama_gambar[1];
  $url 	   = img_url($str_small);
  
  if(empty($profile_pic) || !is_file(pathup("photo/$username/profile_pic/".$ss[0]."_small.".$ss[1])))
  {
	  
	  $url = "assets/user_img/noprofilepic_small.png";
  }
}

//print_r($this->session->all_userdata());

?>
<a href="<?php echo base_url("profile/$username") ?>">
<img src="<?php echo $url; ?>"  class="img-rounded hidden-xs hidden-sm" width="40" height="40" style="float:left; margin:0px 0px 10px 0px; border:1px solid #CCC">
</a>
<div style="margin-left:10px; float:left"> 
	<b> <a href='<?php echo base_url("profile/$username") ?>' id="nama_profile"> <?php echo $nama ?> </a> </b>
    <div>
    	 <?php if(!empty($dpelaut['rank']) ){ ?>
         <li class="glyphicon glyphicon-star"></li>
         <?php echo "<a href='#'>".$rank['rank']."</a>" ?>
         <?php } ?> 
    </div>
    <div>
		 <?php if(!empty($dpelaut['city']) && !empty($dpelaut['kebangsaan'])){ ?>
         <i class="glyphicon glyphicon-home"></i>
         <?php echo "<a href='#'> ".$dpelaut['city']."</a> , <a href='#'> ".$dpelaut['kebangsaan']." </a>" ?>
         <?php } ?> 
    </div>
    <div>
    	 <?php if(!empty($dpelaut['gender'])){ ?>
         <li class="glyphicon glyphicon-user"></li>
         <?php echo ucfirst($dpelaut['gender']) ?>
         <?php } ?> 
    </div>
    <div> <i class="glyphicon glyphicon-cog"></i><a href="#"> Edit Profile </a> </div>
</div>
<div class="clearfix"></div>







