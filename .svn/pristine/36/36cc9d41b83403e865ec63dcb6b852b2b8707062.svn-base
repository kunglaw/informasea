<?php // list-photo-timeline , photo, controller photo , module photo  ?>

<ul id="list-photo-person" class="image-grid image-grid-5 photo-box">
<?php $this->load->helper("text");
	
	if(empty($photo))
	{
		echo "You have no Photo yet";
	}
	
	foreach($photo as $row){
	
	$nama_gambar = explode(".",$row['photo']);
?>


<?php
		if($row['id_album'] == 0)
		{
			$row['album'] = "My Photo";	
		}
		
		
		$str_path = "timeline/$username/thumbnail/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
		$url = pathup($str_path);
		$img_url = img_url($str_path);
		
	?>
	<?php echo '<li>' ?>

      <div style="background-image:url(<?=$img_url?>); background-size:cover; height:218px;" class="col-md-12">
      </div>
      <!-- <img src="<?=$img_url?>" style="height:218px;" class="img-responsive" alt=""> -->
      <div class="text-container"><p> Photo ... </p> </div>
      
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