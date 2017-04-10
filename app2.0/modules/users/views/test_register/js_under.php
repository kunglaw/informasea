<?php // js under module users ?>

<script>
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
		
			check_username(username);
			

		});
		
		$("#register-agentsea #username").change(function(){
		
			var username = $(this).val();
			var role	 = $("#role").val();			
			
			if(role == "manager")
			{
				//alert("role:"+role+" - username");
				check_username_company(username);
			}
			else
			{
				//alert("role:"+role+" - agent username");
				check_username_agent(username);	
			}
		});
		
		
		
		$("#register-seaman #email").change(function(){
			var email = $(this).val();
			
			check_email(email);
			
		});

		$("#register-seaman #re_email").change(function(){

			var re_email = $(this).val();
			var email = $("#email").val();

			
			check_cocok(re_email,email);

		});
		
		$("#register-agentsea #email").change(function(){
			var email = $(this).val();
			var role  = $("#role").val();	
			
			if(role == "manager")
			{
				//alert("role:"+role+" - email");
				check_email_company(email);
			}
			else
			{
				//alert("role:"+role+" - email");
				check_email_agent(email);	
			}
			
		});
		
		
		$("#register-agentsea #role").change(function(){
			
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
		})
		
		
		
		
		
	});
	
	
</script>