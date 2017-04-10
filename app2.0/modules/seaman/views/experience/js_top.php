<?php // js_top, experience, module seaman ?>

<!-- load js_top profile  -->
<link href="<?php echo asset_url("css/jquery.dataTables.css") ?>" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?=asset_url("js/script.js")?>" ></script>
<script type="text/javascript" src="<?=asset_url("plugins/slick/slick.min.js")?>" ></script>
<script src="<?php echo asset_url("js/jquery.dataTables.min.js"); ?>"></script>

<script>
	function update_experience(experience_id){
		
		
		var type_modal = "form-update-experience";
		get_modal(type_modal,experience_id);
		
	}
	function delete_experience(experience_id){
		
		
		var type_modal = "delete-experience-modal";
		get_modal(type_modal,experience_id);
		
	}
</script>