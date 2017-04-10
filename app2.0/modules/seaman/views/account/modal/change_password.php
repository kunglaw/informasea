<style>



#passwordStrength
{
	height:20px;
	display:block;
	float:left;
	color:#FFF;
}

.strength0
{
	width:250px;
	background:#cccccc;
}

.strength1
{
	width:50px;
	background:#ff0000;
}

.strength2
{
	width:100px;	
	background:#ff5f5f;
}

.strength3
{
	width:150px;
	background:#56e500;
}

.strength4
{
	background:#4dcd00;
	width:200px;
}

.strength5
{
	background:#399800;
	width:250px;
}


</style>

<script>
function passwordStrength(password,form_group)
{
	//alert(form_group);
	$(form_group+" .passwordStrength").removeClass("hidden");
	//alert(form_group+" .passwordStrength");
	
	var desc = new Array();
	desc[0] = "Very Weak";
	desc[1] = "Weak";
	desc[2] = "Better";
	desc[3] = "Medium";
	desc[4] = "Strong";
	desc[5] = "Strongest";

	var score   = 0;

	//if password bigger than 6 give 1 point
	if (password.length > 6) score++;

	//if password has both lower and uppercase characters give 1 point	
	if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;

	//if password has at least one number give 1 point
	if (password.match(/\d+/)) score++;

	//if password has at least one special caracther give 1 point
	if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score++;

	//if password bigger than 12 give another 1 point
	if (password.length > 12) score++;

	 $(form_group+" .passwordStrength #passwordDescription").html(desc[score]) ;
	 $(form_group+" .passwordStrength").className = "strength" + score;
	 
	 //alert(form_group+" .passwordStrength #passwordDescription");
}
</script>
<div class="modal fade" id="change-password-modal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" id="form-change-password" role="form" onSubmit="return false">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
      	<div id="info-change-password"></div>
        <span class="clearfix"></span>
        <div class="form-group" id="op">
        	<label> Old Password </label>
            <input type="password" name="old_password" id="old_password" class="form-control inputPassword" onKeyUp="passwordStrength(this.value,'#op')" >
            
        </div>
        <div class="form-group" id="np">
        
        	<label> New Password </label>
            <input type="password" name="new_password" id="new_password" class="form-control inputPassword" onKeyUp="passwordStrength(this.value,'#np')"> 
           <div id="" class="passwordStrength  strength0 hidden"><span id="passwordDescription"></span></div>
            <span class="clearfix"></span>
        
        </div>
        <div class="form-group" id="rnp">
        	<label>Retype New Password </label>
            <input type="password" name="retype_new_password" id="retype_new_password" class="form-control inputPassword" onKeyUp="passwordStrength(this.value,'#rnp')">
            <div id="" class="passwordStrength  strength0 hidden"><span id="passwordDescription"></span></div>
            <span class="clearfix"></span>
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
    
	$("#change-password-modal").modal({
		show:"true",
		backdrop:"static"	
		
	});
	
	$("#form-change-password").submit(function(){
		
		$.ajax({
			url:"<?=base_url("seaman/account_setting/change_password_process")?>",
			type:"POST",
			data:$("#form-change-password").serialize(),
			dataType:"json",
			error: function(err)
			{
				alert(err.responseText);	
			},
			success: function(res)
			{
				$("#info-change-password").html(res.info);	
				
				if(res.reload == "true")
				{
					setTimeout(function(){ location.reload(); },3000);	
				}
			}
			
			
		});
		
		
	});
	
	
});


</script>