<?php
	$username = $this->session->userdata("username");
	$album = $this->photo_mdl->album_photo($username);
?>
<div class="modal fade" id="modal-form-upload">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
       
        <h4 class="modal-title">Form Upload Photo</h4>
      </div>
      <form action="<?php echo base_url("photo/photo_process/insert_photo") ?>" id="form-upload-photo" method="post"  enctype="multipart/form-data">
      
      <div class="modal-body">
      	
            <div class="form-group">
                <label for="" style="display:block">Photo </label>
                 <input type="file" name="picture" id="picture-inp" style="display:none" />
                 
                 <input type="button" id="browse" class="btn btn-success" value="Choose Photo">
                 <p id="nama-gambar"></p>
            </div>
            <?php
			if(!empty($album)){
			?>
            <div class="form-group">
            	<label for="" style="display:block">Album </label>
                <select class="form-control" name="album">
                <?php
                foreach($album as $row)
                {
                ?>
                    <option value="<?php echo $row['id_album'] ?>"><?php echo $row['album'] ?></option>
                <?php	
                }
                ?>
                </select>            
            </div>
            <?php
			}else{
			?>
            <div class="form-group">
            	<label for="" style="display:block">Make a new Album </label>
                <input type="text" name="album" value="" >        
            </div>
            <?php
			}
			?>
            <div class="form-group">
                <label for="" style="display:block">description </label>
                <input type="text" value="" name="description" id="description" class="form-control" style="width:80%">
            </div>
           
             
        
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save-changes">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$(document).ready(function(e) {
    $('#modal-form-upload').modal({
  		keyboard: false,
		backdrop:"static"
	})
	
	var options = {
			
	  target : "#info_photo",
	   //url:    "<?php base_url("photo/insert_photo") ?>" ,       // override for form's 'action' attribute 
	   //type:   "POST",        // 'get' or 'post', override for form's 'method' attribute
	   data:"x=1", 
	  
	  beforeSubmit:showRequest,
	  success:showResponse
  
	 }
	 
	$("#form-upload-photo").ajaxForm(options);
	
	// click picture input
	$("#browse").click(function(){ $("#picture-inp").click(); });
	
	// dsfdsfs
	$("#picture-inp").change(function(){
		var pinp = $(this).val();
		$("#nama-gambar").html(pinp);
	});
	
	/*// upload
	$("#save-changes").click(function(){
		
		
	})*/
});

function showRequest(formData, jqForm, options) { 
	// processing 
	return true;
} 
 

function showResponse(responseText, statusText, xhr, $form)  { 
	
		
	/* $(".tab-content div").attr("class","tab-pane");
	$("div[role=tabpanel] ul li").attr("class",""); */
	
	$("#tabtml").removeClass("active");
	$("#ptimeline").removeClass("active");
	$("#tabalbum").removeClass("active");
	$("#palbum").removeClass("active");
	
	$("#tabphoto").addClass("active"); // tab 
	$("#pphoto").addClass("active"); // content - tab
	
	//get_photo_timeline(); 
	get_photo(); // get list photo
	get_album();
	
	$("#modal-form-upload").modal("hide");
	

}
</script>