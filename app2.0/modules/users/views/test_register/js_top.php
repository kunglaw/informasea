<?php // js_top , module users ?>

<!-- load js_top -->

<script src="<?php echo asset_url("plugin/ms-dropdown-master/js/msdropdown/jquery.dd.min.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url("plugin/ms-dropdown-master/css/msdropdown/dd.css"); ?>" />

<script language="javascript">
$(document).ready(function(e) {
try {
	$("form #ext_num").msDropDown();
	$("form #nationality").msDropDown();
	$("form #nama_perusahaan_select").msDropDown();
} catch(e) {
	//alert(e.message);
}
});
</script>

<script language="Javascript">
  function disable_form() {
    var limit = document.forms[0].elements.length;
    for (i=0;i<limit;i++) {
      document.forms[0].elements[i].disabled = true;
    }
  }
  
  function enable_form()
  {
	var limit = document.forms[0].elements.length;
    for (i=0;i<limit;i++) {
      document.forms[0].elements[i].disabled = false;
    }
	  
  }
  
</script>

<script>
	
	
	function check_all_username(username)
	{
		if(username == "")
		{
			$("#username_info").hide();

		}
		else
		{
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/users_sosmed/check_all_username")?>",
				data:"x=1&username="+username,
				error: function(data)
				{
					alert(data.responseText);
				},
				success: function(data){
					if(data == "true")
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i> &nbsp; username available");
						$("#username_info").addClass("alert-success");
						$("#username_info").removeClass("alert-danger");
						$("#username_info i").addClass("glyphicon-ok");
						$("#username_info").removeClass("glyphicon-remove");
						
						
					}
					else
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i> &nbsp; username has been used");
						$("#username_info").addClass("alert-danger");
						$("#username_info").removeClass("alert-success");
						$("#username_info i").addClass("glyphicon-remove");
						$("#username_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
	}
	
	function check_all_email(email)
	{
		if(email == "")
		{
			$("#email_info").hide();

		}
		else
		{
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/users_sosmed/check_all_email")?>",
				data:"x=1&email="+email,
				error: function(data)
				{
					alert(data.responseText);
				},
				success: function(data){
					
					if(data == "true")
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i> &nbsp; email available");
						$("#email_info").addClass("alert-success");
						$("#email_info").removeClass("alert-danger");
						$("#email_info i").addClass("glyphicon-ok");
						$("#email_info").removeClass("glyphicon-remove");
						
						
					}
					else
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i> &nbsp; email has been used");
						$("#email_info").addClass("alert-danger");
						$("#email_info").removeClass("alert-success");
						$("#email_info i").addClass("glyphicon-remove");
						$("#email_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
	}
	
	function check_username(username)
	{   
		if(username == "")
		{
			$("#username_info").hide();
		}
		else
		{
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/users_process/cajax_username")?>",
				data:"x=1&username="+username,
				error: function(data)
				{
					alert(data.responseText);
				},
				success: function(data){
					if(data == 0)
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i> &nbsp; username available");
						$("#username_info").addClass("alert-success");
						$("#username_info").removeClass("alert-danger");
						$("#username_info i").addClass("glyphicon-ok");
						$("#username_info").removeClass("glyphicon-remove");
						
						
					}
					else
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i> &nbsp; username has been used");
						$("#username_info").addClass("alert-danger");
						$("#username_info").removeClass("alert-success");
						$("#username_info i").addClass("glyphicon-remove");
						$("#username_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
		
	}
	
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

	function check_cocok(re_email,email){



		if(email == "")
		{
			$("#reemail_info").hide();
		}
		else
		{
			if(re_email != email){
				
				$("#reemail_info").show();
				$("#reemail_info").html("<i class='glyphicon'></i>&nbsp; Email doesn't match");
				$("#reemail_info").addClass("alert-danger");
				$("#reemail_info").removeClass("alert-success");
				$("#reemail_info").addClass("glyphicon-remove");
				("#reemail_info").removeClass("glyphicon-ok");
			}else{
						$("#reemail_info").show();
						$("#reemail_info").html("<i class='glyphicon'></i> &nbsp; Email match");
						$("#reemail_info").addClass("alert-success");
						$("#reemail_info").removeClass("alert-danger");
						$("#reemail_info i").addClass("glyphicon-ok");
						$("#reemail_info").removeClass("glyphicon-remove");				
			}

		}

	}
	
	
	function check_username_agent(username)
	{
		if(username == "")
		{
			$("#username_info").hide();
		}
		else
		{
			
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/company_process/cajax_username_agent")?>",
				data:"x=1&username="+username,
				error: function(data)
				{
					alert("something wrong: "+data.responseText)
				},
				success: function(data){

					obj = JSON.parse(data)
					
					if(obj.value == "true")
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#username_info").addClass("alert-success");
						$("#username_info").removeClass("alert-danger");
						$("#username_info i").addClass("glyphicon-ok");
						$("#username_info").removeClass("glyphicon-remove");
						
						
					}
					else
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#username_info").addClass("alert-danger");
						$("#username_info").removeClass("alert-success");
						$("#username_info i").addClass("glyphicon-remove");
						$("#username_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}	
	}
	
	function check_username_company(username)
	{   
		if(username == "")
		{
			$("#username_info").hide();
		}
		else
		{
			
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/company_process/cajax_username")?>",
				data:"x=1&username="+username,
				error: function(data)
				{
					alert("something wrong: "+data.responseText)
				},
				success: function(data){

					obj = JSON.parse(data)
					
					if(obj.value == "true")
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#username_info").addClass("alert-success");
						$("#username_info").removeClass("alert-danger");
						$("#username_info i").addClass("glyphicon-ok");
						$("#username_info").removeClass("glyphicon-remove");
						
						
					}
					else
					{
						$("#username_info").show();
						$("#username_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#username_info").addClass("alert-danger");
						$("#username_info").removeClass("alert-success");
						$("#username_info i").addClass("glyphicon-remove");
						$("#username_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
		
	}
	
	function check_email_agent(email)
	{
		if(email == "")
		{
			$("#email_info").hide();
		}
		else
		{
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/company_process/cajax_email_agent")?>",
				data:"x=1&email="+email,
				error: function(data)
				{
					alert(data);
				},
				success: function(data){
					
					obj = JSON.parse(data)
					if(obj.value == "true")
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#email_info").addClass("alert-success");
						$("#email_info").removeClass("alert-danger");
						$("#email_info i").addClass("glyphicon-ok");
						$("#email_info").removeClass("glyphicon-remove");
						
					}
					else
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#email_info").addClass("alert-danger");
						$("#email_info").removeClass("alert-success");
						$("#email_info i").addClass("glyphicon-remove");
						$("#email_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
	}
	
	function check_email_company(email)
	{ 
		if(email == "")
		{
			$("#email_info").hide();
		}
		else
		{
			$.ajax({
			
				type:"POST",
				url:"<?=base_url("users/company_process/cajax_email")?>",
				data:"x=1&email="+email,
				error: function(data)
				{
					alert(data);
				},
				success: function(data){
					
					obj = JSON.parse(data)
					if(obj.value == "true")
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#email_info").addClass("alert-success");
						$("#email_info").removeClass("alert-danger");
						$("#email_info i").addClass("glyphicon-ok");
						$("#email_info").removeClass("glyphicon-remove");
						
					}
					else
					{
						$("#email_info").show();
						$("#email_info").html("<i class='glyphicon'></i>"+obj.info);
						$("#email_info").addClass("alert-danger");
						$("#email_info").removeClass("alert-success");
						$("#email_info i").addClass("glyphicon-remove");
						$("#email_info").removeClass("glyphicon-ok");
					}
					
				}
				
			});
		}
		
	}
	
	function change_element()
	{
		var role = $("#role").val();
		
		if(role == "manager")
		{
			$.ajax({
				
				type:"POST",
				url:"<?=base_url("users/company_process/change_role")?>",
				data:"x=1&role="+role,
				success: function(data)
				{
					$("#element_company_name").html(data);
				}
				
				
			});
		}
		else
		{
			$.ajax({
				
				type:"POST",
				url:"<?=base_url("users/company_process/change_role")?>",
				data:"x=1&role="+role,
				success: function(data)
				{
					$("#element_company_name").html(data);
				}
				
				
			});
		}
		
	}

</script>