<?php // js under module users ?>
<script type="text/javascript" src="<?php echo asset_url('plugin/sweet_alert/sweetalert.js') ?>"></script>
<script type="text/javascript">
	
	function register_process(from) {
		// body...
		 var func = "users";
          if(from == "agentsea") func = "company";
          $.ajax({
          	type: "POST",
          	url : "<?php echo base_url() ?>users/"+func+"_process/register_process_all",
          	data: $("#register-"+from).serialize(),
			dataType:"JSON",
          	success:function (output) {
          		//output = output.split("|");
				
          		swal(output.status, output.message, output.status);
				
				var a = output.a;
				var e = output.e;
				var x = output.x;
				var u = output.u;
				var p = output.p;

				var urlurl = "<?=base_url("users/activate_agentsea")?>"+"/?email="+e+"&x="+x+"&u="+u+"&p="+p+"";
								
				if(output.status != "error")
				{
          			$("#register-"+from).trigger("reset");
					setInterval(function(){ window.location.replace(urlurl); },3000);
					//alert("<?=base_url("users/activate_agentsea")?>"+"/?a="+a+"&email="+e+"&x="+x+"&u="+u+"&p="+p+"");
				}
          	}
          });
        
	}
        

	$(document).ready(function() {
		$('#footer').removeClass('footer-container-bg');
		$("#username_info").hide();
		
		
		$("#register-fb #fb_username").change(function(){
			
			var username = $(this).val();
		
			check_all_username(username);
			
		});
		
		$("#register-fb #fb_email").change(function(){
			
			var email = $(this).val();
		
			check_all_email(email);
		});
		
		$("#register-seaman #username_reg").change(function(){
	
			var username = $(this).val();
		
			check_all_username(username, "seaman");
			

		});

		$("#register-seaman #username_seaman").change(function(){
	
			var username = $(this).val();
		
			check_all_username(username, "seaman");
			

		});
		
		$("#register-agentsea #username_agentsea").change(function(){
		
			var username = $(this).val();
			var role	 = $("#role").val();			
			
			if(role == "manager")
			{
				//alert("role:"+role+" - username");
				//check_username_company(username);
							check_all_username(username, "agentsea");
				//							check_username_agent(username);	


			}
			else
			{
				//alert("role:"+role+" - agent username");

				//check_username_company(username);
							check_all_username(username, "agentsea");
				//check_username_agent(username);	
			}
		});
		
		
		
		$("#register-seaman #email_seaman").change(function(){
			var email = $(this).val();
			
			check_all_email(email, "seaman");
			
		});

		$("#register-seaman #email").change(function(){
			var email = $(this).val();
			
			check_all_email(email, "seaman");
			
		});

		$("#register-seaman #re_email").change(function(){

			var re_email = $(this).val();
			var email = $("#email").val();

			
			check_cocok(re_email,email);

		});
		
		$("#register-agentsea #email_agentsea").change(function(){
			var email = $(this).val();
			
			
			check_email_company(email);
			
			
		});
		
		
		/* $("#register-agentsea #role").change(function(){
			
			var username = $("#username").val();
			var email    = $("#email").val();
			
			var role  = $("#role").val();	
			
			if(role == "manager")
			{
				change_element();
				check_username_company(username);
				check_email_company(email);
			}
			else
			{
				change_element();
				check_username_agent(username);
				check_email_agent(email);	
			}
		})*/
		
		
		
		
		
	});
	
	
</script>