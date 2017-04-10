<?php // self panel ?>
<?php
	$username_url = $this->uri->segment(2);
	$this->load->model('seatizen/seatizen_model');
	$check_username = $this->seatizen_model->check_seatizen($username_url);
	
	if(empty($check_username))
	{
		$username = $this->session->userdata("username");
	}
	
	$this->load->model("users/user_model");
	$this->load->model("photo/photo_mdl");
	$this->load->model("rank_model");
	
	$pelaut = $this->user_model->get_detail_pelaut($username);
	$friends = explode("|",$pelaut['array_teman']);	
?>
<div class="list-group" style="margin:15px 0 15px 0">
    <a href="#" class="list-group-item active">
      <b> Friends </b> <li class="badge"><?php echo count($friends) ?></li>
    </a>
    <?php
	$i = 0;
	if(!empty($friends)){
	  foreach($friends as $row)
	  {
		  
		  $a = $this->user_model->get_detail_pelaut_byid($row);
		  //print $a['rank'];
		  $s = $this->rank_model->get_rank_detail($a['rank']);
		  //print_r($s);
		  $b = $this->photo_mdl->get_photo_pp($a['username']);
		 
		  $url_gambar = base_url("assets/user_img/noprofilepic_small.png");
		  
		  if(!empty($b))
		  {
			$ss = explode(".",$b['nama_gambar']);
			if(is_file(pathup("photo/$a[username]/small/$ss[0]"."_small.".$ss[1])))
			{
				
				$url_gambar = img_url("photo/$a[username]/small/$ss[0]"."_small.".$ss[1]);
			}
		  }
		  
		  $info_tambahan = isset($s['rank']) ? $s['rank'] : "";
		  if($a['rank'] == 0)
		  {
			$info_tambahan = $a['city']." , ".$a['kebangsaan']; 
			
			if($a['kebangsaan'] == "" && $a['city'] == "")
			{
				
			   $info_tambahan = $a['gender'];  
			}
			
			else if($a['city'] == "")
			{
				
				$info_tambahan = $a['kebangsaan'];	
			}
			
		  }
		  
		  
	  ?>
	  <a href="<?php echo base_url("profile/$a[username]"); ?>" class="list-group-item" style="margin-bottom:-20px">
	  <img src="<?php echo $url_gambar; ?>" width="40" height="40"  style="border:1px solid #CCC; margin-right:5px;" class="pull-left" />
	  <b class="pull-left" style=""><?php echo "".$a['nama_depan']." ".$a['nama_belakang'].""; ?>
      </b> 
      <span class="row" style=""><?php echo ucfirst($info_tambahan)  ?></span>
      <span class="clearfix"></span>
	  </a>
	  <?php
	  
	  	if ($i == 5){ break; }
		$i++;
	  }
	}
	else
	{
		echo "<a href='#' class='list-group-item'><li></li> Start Adding Friends </a>";	
	}
	?>
   
     
 </div>
 <span class="clearfix"></span>