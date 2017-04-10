<div class="container-fluid">
  <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <h2> Cropping Photo </h2>
        </div>
        <div class="panel-body">
            <button id="resume" onclick="resume_crop_modal()" class="btn btn-primary"> Resume Photo </button>
            <button id="" onclick="profile_crop_modal()" class="btn btn-primary"> Profile Photo</button>
        <div>
      </div>
  </div>
</div>
<span class="crop_temp">
	
</span>
<span class="clearfix"></span>
<script>
	
	function resume_crop_modal(){
		$.ajax({
		
			type:"POST",
			url:"<?=base_url("photo/photo_crop/crop_modal")?>",
			data:"x=1&type=resume&user=seaman",// type = list(resume,profile_pic,header); user = list(seaman,company)
			success: function(data){
				
				//alert(data);
				$(".crop_temp").html(data);
			}
			
		});
	}
	
	function profile_crop_modal(){
		$.ajax({
		
			type:"POST",
			url:"<?=base_url("photo/photo_crop/crop_modal")?>",
			data:"x=1&type=profile_pic&user=seaman",// type = list(resume,profile_pic,header); user = list(seaman,company)
			success: function(data){
				
				//alert(data);
				$(".crop_temp").html(data);
			}
			
		});
	}

</script>