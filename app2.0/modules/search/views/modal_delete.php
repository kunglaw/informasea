<div class="modal fade delete-competency-modal modal-resume" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> <h4> Delete Confirmation <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4> </div>
      <div class="modal-body"> 
      	 Are you sure want to delete this "<strong><?php echo $seatizen["nama_depan"]; ?></strong>" Friends ?         
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
	
	function delete_competency_tr()
	{
		
		$.ajax({
			
			type:"post",
			url:"<?php echo base_url("seatizen/seatizen_ajax/delete_friend") ?>",
			data:"id_teman=<?php echo $seatizen['pelaut_id'] ?>",
			success: function(data){
				//alert('tes');
				$("#btndelfriend_<?php echo $seatizen['pelaut_id']; ?>").hide();
				$(".modal-footer").hide();
				$(".modal-body").html("You has sucessfully unfriend <?php echo $seatizen['nama_depan']; ?>");

				setTimeout(function() {

				$(".delete-competency-modal").modal("hide");
			},3000);

				$("#btnaddfriend_<?php echo $seatizen['pelaut_id']; ?>").show();
				
			}
			
		});
		
	}
	
	$(document).ready(function(e) {
        $(".delete-competency-modal").modal("show");
		
		$("#yes-btn").click(function(){ 
			
			delete_competency_tr();
			
		})
    });
</script>