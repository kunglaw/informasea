<div class="modal fade delete-experience-modal modal-resume" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header"> <h4> <?=$this->lang->line("delete_confirmation")?> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4> </div>

      <div class="modal-body "> 

      	 <?=$this->lang->line("delete_confirmation_text")?> <?=$this->lang->line("sea_service_record")?> ?         

      </div>

      <div class="modal-footer">  

         <button type="button" class="btn btn-danger btn-sm pull-right" data-dismiss="modal" id="no-btn"> <?=$this->lang->line("no")?> </button>

        	<span style="margin:5px" class="pull-right"></span>

         <button type="button" class="btn btn-primary btn-sm pull-right" id="yes-btn" > <?=$this->lang->line("yes")?> </button>
            

         <div class="clearfix"></div>

      </div>

    </div>

  </div>

</div>



<script>

	

	function delete_experience_tr()

	{

		

		$.ajax({

			

			type:"post",

			url:"<?php echo base_url("seaman/resume_process/delete_experience_process") ?>",

			data:"x=1&id_update=<?php echo $experience['experience_id'] ?>",

			success: function(data){

				

				$(".delete-experience-modal").modal("hide");

				setTimeout(function() { location.reload(); }, 2000);

				

				

			}

			

		});

		

	}

	

	$(document).ready(function(e) {

        $(".delete-experience-modal").modal("show");

		

		$("#yes-btn").click(function(){ 

			

			delete_experience_tr();

			

		})

    });

</script>