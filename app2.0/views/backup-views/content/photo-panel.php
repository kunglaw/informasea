<?php // general panel, left panel, self panel ?>
<?php
	$this->load->model("photo/photo_mdl");
	$username = $this->uri->segment(2);
	if(empty($username))
	{
		$username = $this->session->userdata("username");
	}
	
	// ASAL DATA
	$photo = $this->photo_mdl->photo_panel($username);

?>

<?php
if(!empty($photo)){
?>
<div class="list-group" style="margin:15px 0 0 0">
    <a href="#" class="list-group-item active">
      <b> Photos </b>
    </a>
   	<div class="list-group-item">
    <div class="row"> 
   	<?php
	foreach($photo as $row){
		
		$ss = explode(".",$row['nama_gambar']);
		
		//$url = base_url("assets/photo/$username/thumbnail/$ss[0]"."_thumb.".$ss[1]);
		$str_path = "photo/$username/thumbnail/$ss[0]"."_thumb.".$ss[1];
		$img_url = img_url($str_path);
		$path = pathup($str_path);
		
		if(!is_file($path))
		{
			$str_path = "photo/$username/resume/$ss[0]"."_thumb.".$ss[1];
			$path = pathup($str_path);
			$img_url = img_url($str_path);
			
			if(!is_file($path))
			{
				$str_path = "photo/$username/cover/$ss[0]"."_thumb.".$ss[1];
				$path = pathup($str_path);
			    $img_url = img_url($str_path);
				
				if(!is_file($path))
				{
					$str_path = "photo/$username/profile_pic/$ss[0]"."_thumb.".$ss[1];
					$img_url = img_url($str_path);
					$path = pathup($str_path);
					
				}
			}
		}
		
		else if(empty($row['nama_gambar']) || !is_file($url))
		{
			$url = base_url("assets/img/no-photo1_thumb.jpg");
		}
		
	?>
    <a href="<?php echo base_url("photo/detail/".strtolower($ss[0]).""); ?>">
   		<img style="border:1px solid #CCC; height:86px; width:86px;" src="<?php echo $img_url; ?>" class="pull-left" />
    </a>
    <?php
	}
	?>
    
    </div>
    </div>
</div>
<?php
}
?>