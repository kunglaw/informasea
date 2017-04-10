<div class="modal fade" id="change-name-modal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" id="form-change-name" role="form" onSubmit="return false">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change name</h4>
      </div>
      <div class="modal-body">
      	<span id="info-change-name"></span>
        
        <div class="form-group">
        	<label> First Name </label>
            <input type="input" name="first_name" id="first_name" class="form-control" value="<?=$first_name?>" >
        </div>
        <div class="form-group">
        
        	<label> Last Name </label>
            <input type="input" name="last_name" id="last_name" class="form-control" value="<?=$last_name?>" > 
        
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

$(document).ready(function(e) {
    
	$("#change-name-modal").modal({
		show:"true",
		backdrop:"static"	
		
	});
	
	$("#form-change-name").submit(function(){
		
		$.ajax({
			url:"<?=base_url("seaman/account_setting/change_name_process")?>",
			type:"POST",
			data:$(this).serialize(),
			dataType:"JSON",
			error: function(err)
			{
				alert(err.responseText);	
			},
			success: function(res)
			{
				$("#info-change-name").html(res.info);	
				
				if(res.reload == "true")
				{
					setTimeout(function(){ location.reload(); },3000);	
				}
			}
			
			
		});
		
		
	});
	
	
});


</script>