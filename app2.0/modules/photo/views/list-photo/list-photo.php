<?php //list-photo, include photo, ctrl photo , module photo  ?>
<ul id="list-photo-person" class="image-grid image-grid-5 photo-box">
<?php $this->load->helper("text");
	
	if(empty($photo))
	{
		echo "You have no Photo yet";
	}
	
	foreach($photo as $row){
	
	$nama_gambar = explode(".",$row['nama_gambar']);
?>


<?php
		if($row['id_album'] == 0)
		{
			$row['album'] = "My Photo";	
		}
		
		
		$str_path = "photo/$username/thumbnail/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
		$url = pathup($str_path);
		$img_url = img_url($str_path);
		if(!is_file($url))
		{
			$str_path = "photo/$username/resume/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
			$url = pathup($str_path);
			$img_url = img_url($str_path);

			if(!is_file($url))
			{
				
				$str_path = "photo/$username/cover/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
				$url = pathup($str_path);
				$img_url = img_url($str_path);
				if(!is_file($url))
				{
					$str_path = "photo/$username/profile_pic/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
					$url = pathup($str_path);
			        $img_url = img_url($str_path);
				}
			}
		}
		
		$title_photo = !empty($row['description']) ? $row['description'] : "Photo";
	?>
	<?php echo '<li>' ?>
	  
      <div style="background-image:url(<?=$img_url?>); background-size:cover; height:218px;" class="col-md-12">
      </div>
      <!-- <img src="<?=$img_url?>" style="height:218px;" class="img-responsive" alt=""> -->
      <div class="text-container"><p><?=character_limiter($title_photo,10)?> </p> </div>
      
      <div class="dropdown">      
        <button type="button" class="btn icon-block icon-block-sm btn-filled-black btn-xs dropdown-toggle" 
        data-toggle="dropdown" aria-expanded="true">
          <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Download</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="javascript:make_profile_picture(<?php echo $row['id_pptr']?>)">Set as Profile Picture</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="javascript:make_resume_picture(<?php echo $row['id_pptr']?>)">Set as Resume Photo</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="javascript:make_cover_picture(<?php echo $row['id_pptr']?>)"> Set as Cover Picture </a> </li>
          <li role="presentation"><a role="menuitem" tabindex="-1" onclick="javascript:delpa(<?php echo $row['id_pptr']?>)">Delete</a></li>
        </ul>
      </div>
                
                
    <?php echo '</li>'; ?>
    <?php
	}

?>
</ul>

