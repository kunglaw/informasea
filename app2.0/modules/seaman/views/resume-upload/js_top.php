<?php // js_top, experience, module seaman ?>



<!-- load js_top profile  -->

<link href="<?php echo asset_url("css/jquery.dataTables.css") ?>" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<?=asset_url("js/script.js")?>" ></script>

<script type="text/javascript" src="<?=asset_url("plugins/slick/slick.min.js")?>" ></script>

<script src="<?php echo asset_url("js/jquery.dataTables.min.js"); ?>"></script>



<script>

	function download_resume(resume_id){

		$.ajax({

			type:"POST",

			data:"id_resume_file="+resume_id,

			url:"<?php echo base_url('seaman/resume/download_resume') ?>",

			success:function(data){			

			}

		});		

	}

	function delete_resume(resume_id){

		var type_modal = "modal-delete-resume-upload";

		get_modal(type_modal,resume_id);

		

	}



</script>