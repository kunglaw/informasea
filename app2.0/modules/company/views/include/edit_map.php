 <!-- <script src="http://maps.googleapis.com/maps/api/js?key=YOUR_KEY"></script> -->
 	  <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
 	  <script src="<?=asset_url("plugin/jquery-locationpicker/dist/locationpicker.jquery.min.js")?>" ></script>
      
      <div class="tab-content">
      	<div role="tabpanel" class="tab-pane active box" id="googleMap-edit" style="height:400px">
      		
        </div>
      </div>
      <form action="<?=base_url("company/company_process/edit_map_process")?>" method="post" id="form-map" >
       <div class="col-md-3 form-group">
       	<label>Location</label>
      	<input type="text" name="location_name" id="location_name" class="form-control " placeholder="type location here ... ">
       </div>
       <div class="col-md-2 form-group">
       	<label>Latitude</label>
      	<input type="text" name="latitude" id="latitude" class="form-control " placeholder="latitude ... ">
       </div>
       <div class="col-md-2 form-group">
       	<label>Longitude</label>
      	<input type="text" name="longitude" id="longitude" class="form-control " placeholder="longitude ... ">
       </div>
       <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?=$id_perusahaan?>" >
       <div class="col-md-2 form-group">
       	<label>radius</label>
      	<input type="text" name="radius" id="radius" class="form-control " placeholder="radius ... ">
       </div>
      
       <div class="form-group">
       	<label>&nbsp;</label><br>
        <button type="button" class="btn btn-primary hidden"> Advance location </button>
       	<button type="button" class="btn btn-primary " onClick="edit_map_process()"> Done </button>
        <button type="button" class="btn btn-danger " onClick="cancel_edit_map()"> Cancel </button>
       </div>
      </form>
      <span class="clearfix"></span>
      <br>
      
      
      <script>
		  $('#googleMap-edit').locationpicker({
			  location: {
				  latitude: <?=$latitude?>,
				  longitude: <?=$longitude?>
			  },
			  radius: 300,
			  inputBinding: {
				  latitudeInput: $('#latitude'),
				  longitudeInput: $('#longitude'),
				  radiusInput: $('#radius'),
				  locationNameInput: $('#location_name')
			  },
			  enableAutocomplete: true,
			  onchanged: function (currentLocation, radius, isMarkerDropped) {
				  // Uncomment line below to show alert on each Location Changed event
				  //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
			  }
		  });
		  
		  function cancel_edit_map()
		  {
			  location.assign("<?=base_url("company/$username/home")?>");
		  }
		  
		  function edit_map_process()
		  {
			$.ajax({
				
				type:$("#form-map").attr("method"),
				data:$("#form-map").serialize(),
				url:$("#form-map").attr("action"),
				dataType:"json",
				success: function(res)
				{
					alert(res.msg);
					location.assign("<?=base_url("company/$username/home")?>");
				}
				
			});
			  
		  }
	  </script>