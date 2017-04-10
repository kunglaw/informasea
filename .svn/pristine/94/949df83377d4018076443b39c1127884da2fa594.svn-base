<div class="modal fade delete-competency-modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> <h4> Delete Confirmation <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4> </div>
      <div class="modal-body "> 
      	 Are you sure want to delete this "<strong><?php echo $nama; ?></strong>" Friends ?         
      </div>
      <div class="modal-footer">  
       
        <button type="button" class="btn btn-danger btn-sm pull-right" data-dismiss="modal" id="no-btn"> No </button>
        	<span style="margin:5px" class="pull-right"></span>
         <button type="button" class="btn btn-primary btn-sm pull-right" id="yes-btn" > Yes </button>
            
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<script>
	
	function deleteFriend(id)
	{
		var id_teman = id;
		$.ajax({
			type:"POST",
			url:"<?php echo base_url("seatizen/seatizen_ajax/delete_friend") ?>",
			data:"id_teman="+id_teman,
			success: function(data){
				
					$(".delete-competency-modal").modal("hide");
                    $("#btndelfriend_"+id).hide();
                    $("#btnaddfriend_"+id).show();

			}
			
		});
		
	}
	
	$(document).ready(function(e) {
        $(".delete-competency-modal").modal("hide");
	
		$("#yes-btn").click(function(){ 
			
			deleteFriend(<?php echo $id_seatizen; ?>);
				setTimeout(100);
			
		})
    });
</script>