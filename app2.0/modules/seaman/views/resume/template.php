<?php // template resume, controller resume, module seaman ?>
<?php
	
	// cookie
	$register_fb_email = $this->input->cookie("register_fb_email");
	
	if($register_fb_email == TRUE)
	{
?>
		<script>
			
			
			var dt = ["<?php echo base_url("general/modal")?>",
			"content/modal/modal-alert-registerfb-email",
			"Facebook Register",
			"We have sent your password to your email. Next time, you can login by <b>facebook<b> or <b>login form<b> by using your username and password."];
			modal_general(dt);
		
		
		</script>
<?php	
	}

?>
<div class="container-fluid">
    <div class="row">        
        <?php $this->load->view("resume/content",$dt_content); ?>
        
        <?php //$this->load->view("resume/right_content");?>
    </div>
</div>


