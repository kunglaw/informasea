<?php // content , module timeline ?>
<script> alert("template"); </script>
<?php 
$this->load->view("js_top");
 //$this->load->view('post-timeline',$dt_post_timeline); 

?>
<div id="list-timeline"></div>
<script>

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
	
	
	$(document).ready(function(e) {
		
		get_list_timeline();
		
	});
	
	
</script>
<?php $this->load->view('js_under'); ?>