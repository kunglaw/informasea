<?php //list-photo, include photo, ctrl photo , module photo  ?>
<ul id="list-photo-person" class="image-grid image-grid-5">
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
		$title_photo = !empty($row['description']) ? $row['description'] : $row['nama_gambar'];
	?>
	<?php echo '<li>' ?>

      <div style="background-image:url(<?=$img_url?>); background-size:cover; height:218px;" class="col-md-12">
      </div>
      <!-- <img src="<?=$img_url?>" style="height:218px;" class="img-responsive" alt=""> -->
      <div class="text-container"><p> <?=character_limiter($title_photo,10)?></p> </div>
      
      <button type="button" class="btn icon-block icon-block-sm btn-filled-black btn-xs photo-options" 
      data-trigger="focus" data-toggle="popover">
        <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true">
        </span>
      </button>
                
                
    <?php echo '</li>'; ?>
    <?php
	}

?>
</ul>

<script>
	//$(".photo-options").click(function(){ alert('sasas'); });
	$(document).ready(function(e) {
        $(".photo-options").popover({
			  html:true,
			  placement: 'bottom',
			  content: '\
			  <ul class="custom-list" style="background-color:black">\
				  <li><a href="#">Download</a></li> \
			  \ </ul>\ ' 
		  });
    });

</script>

<style>
	.popover{
		background-color:#000;	
	}
</style>