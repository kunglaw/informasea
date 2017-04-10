<div class="modal fade" id="change-email-modal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" id="form-change-email" role="form" onSubmit="return false">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Add New email</h4> 
      </div>
      <div class="modal-body">
      	<span id="info-change-email"></span>
        
        <div class="form-group">
        	<label> Primary Email </label>   
        	<br>     	
        	<input type="checkbox" id="email" value="<?=$email;?>" checked="checked" name="email_lama"> <?=$email; ?>
        	<br>
        	<!-- 	
            <input type="email" name="new_email" id="new_email" class="form-control" value="<?php //echo $email?>" readonly="readonly"> -->
           <input type="checkbox" id="email2" value="<?=$email2;?>" name="email_baru"> <?=$email2;?> <a href="#" id="remove_email2"> Remove </a>
        </div>	

      <!-- 	<span id="add_email">  <a href="#" id="another_email_nih"> Add Another Email </a> </span>


      	<div class="form-group" style="display:none;" id="form-email-lain">

      		<label> Another Email </label>
      		<input type="email" name="another_email" id="another_email" class="form-control">
      		<a href="#" id="close" class="pull-right"> Close </a>
      	</div>  -->
      
        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" disabled="disabled" id="btn-savee">Save changes</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

$(document).ready(function(e) {
    
	$("#change-email-modal").modal({
		show:"true",
		backdrop:"static"	
		
	});

	$("#email2").change(function(){

		$("#email").removeAttr("checked");

		$("#btn-savee").removeAttr("disabled");

	})	

	$("#email").change(function(){


		$("#email2").removeAttr("checked");

				$("#btn-savee").attr("disabled",'disabled');


	});

	$("#remove_email2").click(function(){

		var email2 = $("#email2").val();

		$.ajax({
			url:"<?=base_url('seaman/account_setting/delete_email2');?>",
			type:"post",
			data:"email2="+email2,
			dataType:"JSON",
			error:function(err){
				alert(err.responseText);
			},
			success:function(res){
				$("#info-change-email").html(res.info);

				if(res.reload== "true"){
					setTimeout(function(){ location.reload();}, 3000);
				}
			}
		})

	})
	
	$("#form-change-email").submit(function(){
			
			var email1 = $("#email").val();
			var email2 = $("#email2").val();
			var data = "email_lama="+email1+"&email_baru="+email2;

		$.ajax({
			url:"<?=base_url("seaman/account_setting/new_primary_email")?>",
			type:"POST",
			data:data,
			dataType:"JSON",
			error: function(err)
			{
				alert(err.responseText);	
			},
			success: function(res)
			{
				$("#info-change-email").html(res.info);	
				
				if(res.reload == "true")
				{
					setTimeout(function(){ location.reload(); },3000);	
				}
			}
			
			
		});
		
		
	});
	
	
});


</script>