<?php // list-photo-album , photo, controller photo , module photo  ?>

<?php
	
	$nama_gambar = explode(".",$tml['photo']);
?>

<ul id="list-album-person" class="image-grid image-grid-5 photo-box">
	<li class="pull-left">
    
    	 <img src="<?php echo img_url("timeline/$username/thumbnail/$nama_gambar[0]"."_thumb."."$nama_gambar[1]"); ?>" >
         <div class="text-container"><p>Photo Timeline </p> </div>
         
    </li>
    <?php
		
		$pt = $this->photo_mdl->select_last_photo($username);
		//print_r($pt);
		$nama_gambar = explode(".",$pt['nama_gambar']);
		
		
		$url      = img_url("photo/$username/thumbnail/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
		$url_path = pathup("photo/$username/thumbnail/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
		if(!is_file($url_path))
		{
			$url 		= img_url("photo/$username/resume/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
			$url_path   = pathup("photo/$username/resume/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
			if(!is_file($url_path))
			{
				$url 		= img_url("photo/$username/cover/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
				$url_path   = pathup("photo/$username/cover/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
				if(!is_file($url_path))
				{
					$url 		= img_url("photo/$username/profile_pic/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
					$url_path   = pathup("photo/$username/profile_pic/$nama_gambar[0]"."_thumb.".$nama_gambar[1]);
				}
			}
		}
		
	?>
    <li>
    	<img src="<?php echo $url; ?>" class="img-responsive"  >
        <div class="text-container"><p>Photo</p></div>
    </li>
	<?php foreach($album as $row){
			$this->photo_mdl->select_last_photo_album($username,$row['id_album']);
        	echo '<li>'; ?>
	
   
            <img src="<?php echo base_url("assets/photo/$username/$row[photo]"); ?>" style="width:150px; height:150px;" >
            <div class="text-container"><p><?=character_limiter($row['album'],10)?></p> </div>
                
    <?php          
            echo '</li>';}
    ?>
    
</ul>