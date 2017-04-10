<?php // content , module timeline ?>

<?php $this->load->view("js_top");
 //$this->load->view('post-timeline',$dt_post_timeline); 
	 $username_login = $this->session->userdata("username");
	$username_uri = $this->uri->segment(2);
?>
<div id="list-timeline"></div>
<script>
	// alert("x=1&username=<?php echo $username ?>&ctrl=<?php echo $ctrl ?>");
	function get_self_timeline()
	{
		//alert("get_self_timeline ... ");
		$.ajax({
			type : "POST",
			url : "<?php echo base_url("timeline/timeline/get_self_timeline"); ?>",
			data:"x=1&username=<?php echo $username ?>&ctrl=<?php echo $ctrl ?>",
			error:function(err)
			{
				//alert(err.responseText);	
			},// username dari uri == username login 
			success : function(data)
			{
				//alert(data);
				//alert(" success get self timeline ");
				$("#list-timeline").html(data);	
			}
			
		});

	}

	function get_list_timeline()
	{
		$.ajax({
			
			
			type : "POST",
			url : "<?php echo base_url("timeline/timeline/get_list_timeline"); ?>",
			data:"x=1&username=<?php echo $username ?>&ctrl=<?php echo $ctrl ?>", // username dari uri == username login 
			success : function(data)
			{
				$("#list-timeline").html(data);	
			}
		});
		
	}

	function get_list_timeline_person (usernamenya) {
		// body...
		$.ajax({
			
			
			type : "POST",
			url : "<?php echo base_url("timeline/timeline/get_list_timeline_person"); ?>",
			data:"x=1&username=<?php echo $username ?>&ctrl=<?php echo $ctrl ?>", // username dari uri == username login 
			success : function(data)
			{
				$("#list-timeline").html(data);	
			}
		});

	}
	
	
	$(document).ready(function(e) {

		var username_login = "<?php echo $username_login ?>";
		var username_uri = "<?php echo $username_uri ?>";

		// alert(username_login+" == "+username_uri);
		if(username_login == username_uri || username_uri == "") get_self_timeline();
		else get_list_timeline_person();
		
	});
	
	
</script>
<?php $this->load->view('js_under'); ?>