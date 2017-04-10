<?php //js_top, module home ?>
<link href="<?=asset_url("plugin/jquery.steps/jquery.steps.css")?>" rel="stylesheet" type="text/css"  />
<script src="<?=asset_url("plugin/jquery.steps/jquery.steps.min.js")?>"></script>

<script type="text/javascript" src="<?=asset_url("js/jquery.jcarousel.js")?>" ></script> <!-- buat slider -->
<script type="text/javascript" src="<?=asset_url("js/owl.carousel.min.js");?>" ></script> <!-- landing page -->

<script src="<?=asset_url("plugin/jquery.validate/jquery.validate.min.js")?>"> </script>

<!-- Magnific Popup core JS file -->
<link href="<?=asset_url("plugin/magnific-popup/magnific-popup.css")?>" rel="stylesheet">
<script src="<?=asset_url("plugin/magnific-popup/magnific-popup.js")?>" ></script>

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

/* function parallax()
{
	 
	 var scrolled = $(window).scrollTop();
	 $('.head').css('top', -(scrolled) * 0.2 + 'px');
	
	
}

$(window).scroll(function(e){
	
    parallax();
	
}); */

</script>