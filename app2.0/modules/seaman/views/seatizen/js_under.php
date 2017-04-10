<?php // js_under , profile?>
<script src="<?php echo asset_url("js/jquery.dataTables.min.js"); ?>"></script>
<script>
	/* $('.link-to-medical-attachment a.data-gambar-medical, .link-to-document-attachment a.data-gambar-document, .link-to-visa-attachment a.data-gambar-visa, .link-to-coc-attachment a.data-gambar-coc, .link-to-proficiency-attachment a.data-gambar-proficiency').vanillabox(); */
	
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
		  "info":     false,
		  "searching":false
	  
	  });
	  
  }
  
  function show_table_experience()
  {
	  $("#data-table-experience table").DataTable({
		  
		  "paging":   false,
		  "ordering": false,
		  "info":     false,
		  "searching":false
		  
	  
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

</script>