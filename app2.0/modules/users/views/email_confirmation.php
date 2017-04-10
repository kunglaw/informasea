<div class="modal fade" id="modal-confirmation-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"><!-- large -->
    <div class="modal-content">
     
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> Form Email Confirmation <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
            
        </div>
        
        <div class="modal-body">
        
        <p> <small>
        	* We need your email, because of further information 
        </small></p>
        
        <form class=" form-email-confirm" id='ask-data' role="form">
        	<div class="form-group">
            	<label for="" style=""> Email </label>
                <span id="email_info">
                
                </span>
                <input type="email" value="" name="email" id="email" class="form-control" required autocomplete="off" />
            </div>
            
            <button class="submit-email btn btn-success" type="button"> Submit Email </button>
        </form>
        
        </div>
         
    	<!-- modal-body-->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
<script>
	
	function check_email(email)
	{ 
		if(email == "")
		{
			$("#email_info").hide();
		}
		else
		{
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/users_process/cajax_email")?>",
				data:"x=1&email="+email,
				error: function(data)
				{
					alert(data.responseText);
				},
				success: function(data){
					
					obj = JSON.parse(data);
					
					if(obj.value == "true")
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i> &nbsp;"+obj.info);
						$("#email_info").addClass("alert-success");
						$("#email_info").removeClass("alert-danger");
						$("#email_info i").addClass("glyphicon-ok");
						$("#email_info").removeClass("glyphicon-remove");
						
					}
					else
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i> &nbsp;"+obj.info);
						$("#email_info").addClass("alert-danger");
						$("#email_info").removeClass("alert-success");
						$("#email_info i").addClass("glyphicon-remove");
						$("#email_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
		
		
		
		
	}

	$(document).ready(function(e) {
        
		$(".submit-email").click(function(){
			
			$("#fb-form #fb_email").val($("#ask-data input[type=email]").val());
			send_data_facebook();
				
		});
		
		$("#ask-data #email").change(function(){
			
			var email = $(this).val();
			check_email(email);
			
		});
		
		$("#modal-confirmation-email").modal({
			backdrop:"static",
			show:true	
		});
		
    });


</script>