<style>
	#klwtu
	{
		color:#000 !important;	
		
	}
	
	#lwau
	{
		color:#000;	
	}

</style>
<div id="fb-modal-prompt" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reauthentificating Facebook</h4>
      </div>
      <div class="modal-body">
        <?php
			// modal ini muncul hanya saat ada SESSION FB yang aktif di browser
			
			// check apakah ada FB yang aktif atau tidak 
				// kalau ada munculkan Foto dan Nama user tersebut
				// dan muncul 2 pilihan, 
				  // keep login with this user
				  		// jika user mengklik keep login with this user
						// maka langsung jalankan FB Javascript SDK
						// dan modal FB untuk request password akan muncul 
				  // login with another user
				  		// jalankan FB.logout() di javascript
						// maka langsung jalankan FB Javascript SDK 
						// dan modal FB untuk request username dan password akan muncul 
		
		?>
        <p>you are using this account to login. </p>
		<img id="img-profile-fb" src="" style="margin-right:20px" class="pull-left">
		<h4 class="pull-left" id="name-fb"></h4>
        <span class="clearfix"></span>
		
      </div>
	  <div class="modal-footer">
		<button id="klwtu" onclick="javascript:keep_login()" class="btn btn-default">Keep Login with this user</button>
		<button id="lwau" onclick="javascript:another_user()" class="btn btn-default">Login with another user</button>
		
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$(document).ready(function(){
	
	 FB.api('/me',  'GET',
		//{"fields":"id,name,first_name,last_name,cover,location,address,birthday,picture,email,religion,gender"},
		{"fields":"id,name,first_name,last_name,cover,picture,email,religion,gender"},
		//{"fields":"id,name,location,birthday"},
		function(response) {
			
			//alert(response.toSource());
			$("#img-profile-fb").attr("src",response.picture.data.url);
			$("#name-fb").html(response.name);
		
		
	  });
	
	$("#fb-modal-prompt").modal({
		show:true,
		backdrop:"static",
		keyboard:false
	});
	
});

function keep_login()
{
	$("#fb-modal-prompt").hide();
	fb_login();
}

function another_user()
{
	logoutsos();
	$("#fb-modal-prompt").hide();
	fb_login();
}

</script>