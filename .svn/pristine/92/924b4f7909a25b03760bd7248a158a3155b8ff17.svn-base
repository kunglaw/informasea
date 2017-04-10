<?php //js top applied vacantsea ?>

<script>
	  function get_modal(type_modal,id_update)
   {

      var data = "x=1&modal="+type_modal+"&id_update="+id_update;
      
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