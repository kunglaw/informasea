<?php //js_top, module home ?>

<link href="<?=asset_url("plugin/jquery.steps/jquery.steps.css")?>" rel="stylesheet" type="text/css"  />
<script src="<?=asset_url("plugin/jquery.steps/jquery.steps.min.js")?>"></script>
<script src="<?=asset_url("plugin/jquery.validate/jquery.validate.min.js")?>"> </script>

<script>

function quick_vacantsea()

{

	$.ajax({

		

		url:'<?=base_url("home/modal/create_vacantsea")?>',	

		data:"x=1",

		type:"POST",

		

		error: function(err)

		{

			alert(err.responseText);

		},

		success: function(res)

		{

			$(".modal-temp").html(res);

		}

		

	})

	

	

}



</script>