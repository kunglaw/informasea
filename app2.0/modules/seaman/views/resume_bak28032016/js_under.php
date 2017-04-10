<?php // js_under , resume, module seaman?>

<script type="text/javascript">


      var activeTab = null;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      activeTab = e.target;
      console.log(activeTab);
      if($(activeTab).attr('href') == "#resume") {
        $('#right-widget').addClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-12');
      } else {
        $('#right-widget').removeClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-12');
      }
    });

    /*function changeLayout() {
        $('#right-widget').addClass('hidden-md');
    }*/

    if($('#resume-tab').hasClass('active')) {
        //alert('done deal!');
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });
	
	function dt_pelaut(kd_pelaut,no_license)
	{
	  var dt = "kode_pelaut="+kd_pelaut+"&no_license="+no_license;
	  return dt;
	}
	
	function hover_sertifikat(dt)
	{
		$.ajax({
			url:"<?=base_url("resume/resume_ajax/hover_sertifikat")?>",
			type:"POST",
			data:dt,
			error: function(data)
			{
				
				
			},
			beforeSend: function(data){
				
			},
			success: function(data){
				
				
			}

		});
	}
	
</script>

<script>
	
	<!-- tooltip bro -->
	$('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
	<!-- popover bro -->
	$('#data-update[data-toggle="popover"]').popover({
		
		trigger: 'hover',
		'placement': 'top',
		animation:true,
		container:false,
		content:'',
		delay:1, // { "show": 500, "hide": 100 }
		html:true,
		//placement:'right',
		//'selector':'false',
		template:'<div class="popover col-md-4" style="border:1px solid #CCC" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
		//title:'',
		//viewport:{ selector: 'body', padding: 0 }
		
	});
	
	$('#data-sertifikat[data-toggle="popover"]').popover({
		
		trigger: 'hover',
		'placement': 'top',
		animation:true,
		container:false,
		content:hover_sertifikat(dt),
		delay:1, // { "show": 500, "hide": 100 }
		html:true,
		//placement:'right',
		//'selector':'false',
		template:'<div class="popover col-md-4" style="border:1px solid #CCC" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
		//title:'',
		//viewport:{ selector: 'body', padding: 0 }
		
	});
	
</script>

<!-- resume -->


<script src="<?php echo asset_url("js/jquery.dataTables.min.js"); ?>"></script>
<script>

  function show_table_competency()
  {
	  $("#data-table-competency table").DataTable({
		  "paging":   false,
		  "ordering": false,
		  "info":     false,
		  "searching":false
	  });
	  
  }
  
  
  function show_table_proficiency()
  {
	  $("#data-table-proficiency table").DataTable({
		  /*"ajax":""
		  "processing":true,
		  "serverSide":true,*/
		  
		  "paging":   false,
		  "ordering": false,
		  "info":     false
	  
	  });
	  
  }
  
  function show_table_experience()
  {
	  $("#data-table-experience table").DataTable({
		  "paging":   true,
		  "ordering": false,
		  "info":     false,
		  "searching":true
	  
	  });
		  
  }
  
  function show_table_document()
  {
	  $("#data-table-document table").DataTable({
		  "paging":   false,
		  "ordering": false,
		  "info":     false,
		  "searching":false
		  
	  
	  });
		  
  }
  
  // data table setting
  $(document).ready(function(e) {
	  
	  show_table_competency();
	  
	  show_table_proficiency();
	  
	  show_table_experience();
	  
	  show_table_document();
	  
  });        
</script>
    
<script>

 
 $(document).ready(function(e) {
	
		//get_modal("form-profile","#profile-btn");

	
	$("#profile-btn").click(function(e) { // edit profile
		
		beforeResume();
		var type_modal = $(this).attr("modal"); 
		get_modal(type_modal,"#profile-btn");
		
	});
	
	$("#kepelautan-btn").click(function(e) { // kepelautan
		
		beforeResume();
		var type_modal = $(this).attr("modal"); 
		get_modal(type_modal,"#kepelautan-btn");
		
	});
	
	 $("#coc-btn").click(function(e) { // competency
	 
	 	beforeResume();
		var type_modal = $(this).attr("modal"); 
	
		get_modal(type_modal,"#coc-btn");
		
	});

	 $("#visa_btn").click(function(e){
	 	beforeResume();
	 	var type_modal = $(this).attr("modal");

	 	get_modal(type_modal,"#visa_btn");

	 })
	
	 $("#proficiency-btn").click(function(e) { //proficiency
	 	
		beforeResume();
		var type_modal = $(this).attr("modal"); 
		
		get_modal(type_modal,"#proficiency-btn");
		
	});
	
	 $("#experience-btn").click(function(e) { //experience 
	 	beforeResume();
		var type_modal = $(this).attr("modal"); 
		
		get_modal(type_modal,"#experience-btn");
		
	});
	
	$("#document-btn").click(function(e){
		beforeResume();
		var type_modal = $(this).attr("modal");
		
		get_modal(type_modal,"#document-btn");
			
	});
	
	$("#medical-btn").click(function(e){
		
		//alert("sasas");
		beforeResume();
		var type_modal = $(this).attr("modal");

		get_modal(type_modal,"#medical-btn");

	});
	
	/* update zone */
	
	$(".exp-update-btn").click(function(e){ // experience update
		beforeResume();
		var type_modal = $(this).attr("modal");
		
		get_modal(type_modal,".exp-update-btn");
		
	});

		$("#resume-upload-btn").click(function(e) { //experience 
			var type_modal = $(this).attr("modal"); 
			
			get_modal(type_modal,"#resume-upload-btn");
			
        });
	
	
});
</script>

