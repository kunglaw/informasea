<?php //js_top ?>


<?php $this->load->view("timeline/js_top"); ?>

<script>
function share_timeline() {
	// body...
	 FB.ui({
		method: 'share',
		display: 'popup',
		href: '<?php echo current_url() ?>',
	  }, function(response){});
}
</script>