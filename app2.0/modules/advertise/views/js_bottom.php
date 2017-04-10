<script></script>
<style>
	.ui-datepicker-month, .ui-datepicker-year{
		color:#000	
	}
</style>
<script>
	
	function list_ad_page(id_page)
	{
		$.ajax({
			type:"POST",
			url:"<?=base_url("advertise/list_ad_area")?>",
			data:"id_page="+id_page,
			success: function(data)
			{
				$("#ad_area").html(data);
				
			}
			
		})
			
		
	}
	
	$("#ad_page").change(function(e) {
        id_page  = $("#ad_page").val();
		
	
		
		list_ad_page(id_page);
    });
	
	$("#start_date").datepicker({
		
		minDate: 0,
		changeMonth: true,
        changeYear: true,
		dateFormat: "yy-mm-dd"
			
	});

	/*
	    Form
    */
    $('.registration-form fieldset:first-child').fadeIn('slow');
	$('#payment-conf-form fieldset:first-child').fadeIn('slow');
    
    $('.registration-form input[type="text"], input[type="file"] ,.registration-form select').on('focus', function() {
    	$(this).removeClass('input-error');
    });
	
	$('#payment-conf-form input[type="text"], input[type="file"] ,#payment-conf-form select').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step
    $('.registration-form .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	
    	parent_fieldset.find('input[type="text"],select,input[type="file"]').each(function() {
    		if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
	    		$(this).next().fadeIn();
	    	});
    	}
    	
    });
    
    // previous step
    $('.registration-form .btn-previous').on('click', function() {
    	$(this).parents('fieldset').fadeOut(400, function() {
    		$(this).prev().fadeIn();
    	});
    });
    
	//submit payment conf
	$("#payment-conf-form").on('submit', function(e) {
		
		
		var err = [];
		
    	$(this).find('input[type="text"], input[type="file"],select').each(function() {
    		if( $(this).val() == "" ) {
				
				err.push($(this).attr("name")); 
    			e.preventDefault();
    			$(this).addClass('input-error');
				
    		}
    		else {
				e.preventDefault();
    			$(this).removeClass('input-error');
				
    		}
			
			
    	});
		
		if(err[0] == null)
		{
			var formData = new FormData($(this)[0]);
			
			$.ajax({
				
				type:"POST",
				url:"<?=base_url("advertise/payment_process")?>",
				async   : false,
				cache   : false,
				contentType	: false,
				processData	: false,
				data:formData,
				dataType:"JSON",
				success: function(data)
				{
					
					if(data.status == "success")
					{
						$(".info-ad").html(data.message);	
					}
					else if(data.status == "error")
					{
						$(".info-ad").html(data.message);
					}
					
					setInterval(function(){
						
						// redirect ke payment confirmation
						window.location = "<?=base_url("advertise/summary/?id_order=")?>"+data.id_order+"";
						
					},3000);
					
				}
				
				
			});	
			
			return false;
		}
		
			
	});
	
    // submit
    $('.registration-form').on('submit', function(e) {
    	
		var err = [];
		
    	$(this).find('input[type="text"], input[type="file"],select').each(function() {
    		if( $(this).val() == "" ) {
				
				err.push($(this).attr("name")); 
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
				e.preventDefault();
    			$(this).removeClass('input-error');
				
    		}
			
			
    	});
		
		if(err[0] == null)
		{
		  var formData = new FormData($(this)[0]);
		  	
		  $.ajax({
			  type:"POST",
			  url :"<?=base_url("advertise/request_process")?>",
			  data:formData,
			  async   : false,
			  cache   : false,
			  contentType	: false,
			  processData	: false,
			  dataType:"JSON",
			  success: function(data)
			  {
				  $(".info-ad").html(data.message);
				  
				  if(data.status == "success")
				  {
					setInterval(function(){
						
						// redirect ke payment confirmation
						window.location = "<?=base_url("advertise/payment_confirmation/?id_order=")?>"+data.id_order+"";
						
					},3000);
				  }
			  }
			  
		  });
		}
    	
		return false;
    });


</script>