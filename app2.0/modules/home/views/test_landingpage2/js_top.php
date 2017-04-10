<?php //js_top, module home ?>



<!-- <script type="text/javascript" src="<?=asset_url("js/jquery.jcarousel.js")?>" ></script> --> <!-- buat slider -->

<!-- <script type="text/javascript" src="<?=asset_url("js/owl.carousel.min.js");?>" ></script> --> <!-- landing page -->



<script src="<?=asset_url("plugin/jquery.validate/jquery.validate.min.js")?>"> </script>



<!-- Magnific Popup core JS file -->

<!-- <link href="<?=asset_url("plugin/magnific-popup/magnific-popup.css")?>" rel="stylesheet"> -->

<!-- <script src="<?=asset_url("plugin/magnific-popup/magnific-popup.js")?>" ></script> -->



<!-- Latest compiled and minified JavaScript -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>



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