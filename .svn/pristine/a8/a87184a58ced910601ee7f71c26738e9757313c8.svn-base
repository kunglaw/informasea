<?php	
	$username_url = $this->uri->segment(2);
	$this->load->model('seatizen/seatizen_model');
	$check_username = $this->seatizen_model->check_seatizen($username_url);
	$photo_url = "profile/photo/$username";
	
	if(empty($check_username))
	{
		$username = $this->session->userdata("username");
		$photo_url = "photo";
	}
	
	
	
?>


<div class="list-group" style="margin:15px 0 0 0">
  <a class="list-group-item active">
   <b> <span class="glyphicon glyphicon-user"></span> &nbsp My Profile </b>
  </a>
  <a href="<?php echo base_url("profile/$username/about");?>" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;About </a>
  <a href="<?php echo base_url($photo_url)?>" class="list-group-item"><span class="glyphicon glyphicon-picture"></span> &nbsp; Photo Album</a>
  <a href="<?php echo base_url("profile/$username/friends");?>" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp; Friends</a>
</div>