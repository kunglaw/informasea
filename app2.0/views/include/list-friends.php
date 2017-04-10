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
	
	$pelaut  = $this->user_model->get_detail_pelaut($username);
	$frienda = $pelaut['array_teman'];
	
	if(!empty($frienda))
	{
		$friends = explode("|",$pelaut['array_teman']);
	}
	else
	{
		$friends = array();	
	}

?>

<?php

?>

<div class="widget-box">
    <div class="text-gray widget-box-title"><?=$this->lang->line("friend")?></div>
    <a href="<?php echo base_url("profile/".$username_url."/friends") ?>" class="text-link widget-box-seemore">See All</a>
    <span class="clearfix"></span>
    <hr />
    
    <?php
	$i = 0;
	
	if(!empty($friends)){
	?>
    	
    	
    <?php
		
		foreach($friends as $row)
		{
			
			
			
			$a = $this->user_model->get_detail_pelaut_byid($row);
			
			if(empty($a)) continue;
			
			//print $a['rank'];
			$s = $this->rank_model->get_rank_detail($a['rank']);
			//print_r($s);
			
		   
			$url_gambar = check_profile_seaman($row['username']);
			
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
				  
				  $info_tambahan = flag_nationality($a['kebangsaan']);	
			  }
			  
			}
		  
		  
	  ?>
    
    <div class="media">
        <a class="pull-left small-img-container" href="<?php echo base_url("profile/".$a['username']) ?>">
            <img class="media-object img-responsive" src='<?php echo $url_gambar; ?>' style="border:1px solid #CCC" alt="user-image">
        </a>
        <div class="media-body">
            <div class="text-grey">
            	<a href="<?php echo base_url("profile/".$a['username']); ?>">
            	<?php echo "".$a['nama_depan']." ".$a['nama_belakang'].""; ?> </a> </div>
            <div class="subtitle"><?php echo ucfirst($info_tambahan)  ?></div>
        </div>
    </div>
    
    <?php
	  
	  	if ($i == 5){ break; }
		$i++;
	  }
	
	}
	else
	{
		echo "<p align='center'>You have no friend</p>";
		echo "<center><a href='".base_url("seatizen")."' class='btn btn-primary btn-lg'><i class='glyphicon glyphicon-plus-sign'></i> Start Adding Friends </a></center>";	
	}
	?>
</div>