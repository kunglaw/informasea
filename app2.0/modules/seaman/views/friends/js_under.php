<?php // js_under , friends?>
<script>
   function get_modal2(type_modal,id_update)
   {

      var data = "x=1&modal="+type_modal+"&id_update="+id_update;
      //alert(data);
      var url = "<?php echo base_url("seaman/resume_ajax/modal"); ?>";
      //alert(url);
      
     
    $.ajax({
      
      type:"POST",
      data:"x=1&modal="+type_modal+"&id_update="+id_update,
      url:"<?php echo base_url("seaman/resume_ajax/modal"); ?>",
      success: function(data){
        //alert('disini');
        //alert(data);
        $(".tmp_modal").html(data);
        
      }, error: function(ts) { 
        alert(ts.responseText); 
      } 
      
      
      
    });
   }
</script>
<script>
   function get_modal(type_modal,id_update)
   {

      var data = "x=1&modal="+type_modal+"&id_update="+id_update;
      //alert(data);
      var url = "<?php echo base_url("seaman/resume_ajax/modal"); ?>";
     // alert(url);
      
     
    $.ajax({
      
      type:"POST",
      data:"x=1&modal="+type_modal+"&id_update="+id_update,
      url:"<?php echo base_url("seaman/resume_ajax/modal"); ?>",
      success: function(data){
        
        //alert(data);
        $(".tmp_modal").html(data);
        
      }, error: function(ts) { 
        alert(ts.responseText); 
      } 
      
      
      
    });
   }
</script>
<script type="text/javascript">
    // $(document).ready(function(){

    // });

    var activeTab = null;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      activeTab = e.target;
      console.log(activeTab);
      if($(activeTab).attr('href') == "#resume") {
        $('#right-widget').addClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-12');
      } else {
        $('#right-widget').removeClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-9');
      }
    });

    /*function changeLayout() {
        $('#right-widget').addClass('hidden-md');
    }*/

    if($('#resume-tab').hasClass('active')) {
        alert('done deal!');
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });
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
</script>

