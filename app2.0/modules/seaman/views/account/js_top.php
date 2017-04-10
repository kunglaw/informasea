<?php // js_top, account, module seaman ?>

<!-- load js_top profile  -->

<script type="text/javascript" src="<?=asset_url("js/script.js")?>" ></script>
<script type="text/javascript" src="<?=asset_url("plugins/slick/slick.min.js")?>" ></script>

<div class="temp-setting"></div>
<script>
	function change_password_modal()
	{
		$.ajax({
			type:"POST",
			url:"<?=base_url("seaman/account_setting/change_password_modal")?>",	
			data:"x=1",
			success: function(res)
			{
				
				$(".temp-setting").html(res);
				
			}
			
			
		})
		
	}

	function change_username_modal(){

		$.ajax({
			type:"POST",
			data:"x=1",
			url:"<?=base_url('seaman/account_setting/change_username_modal')?>",
			success:function(res){

				$(".temp-setting").html(res);

			}
		})

	}

	function change_primary_email(){

		$.ajax({
			type:"POST",
			data:"x=1",
			url:"<?=base_url('seaman/account_setting/change_primary_email');?>",
			success:function(res){
				$(".temp-setting").html(res);
			}
		})

	}

	
	function change_name_modal()
	{
		$.ajax({
			
			type:"POST",
			url:"<?=base_url("seaman/account_setting/change_name_modal") ?>",
			data:"x=1",
			success: function(res)
			{
				$(".temp-setting").html(res);
					
			}
			
			
		});
		
	}
	
	function change_email_modal()
	{
		$.ajax({
			type:"POST",
			url:"<?=base_url("seaman/account_setting/change_email_modal")?>",	
			data:"x=1",
			success: function(res)
			{
				
				$(".temp-setting").html(res);
				
			}
			
			
		})
		
	}
	
	function edit_cover_letter()
	{
		$.ajax({
			type:"POST",
			url:"<?=base_url("seaman/account_setting/cover_letter_modal")?>",	
			data:"x=1",
			success: function(res)
			{
				
				$(".temp-setting").html(res);
				
			}
			
			
		})
		
	}
</script>