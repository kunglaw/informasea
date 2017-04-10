

<div class="modal fade delete-resume-upload modal-resume" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header"> <h4> <?=$this->lang->line("delete_confirmation")?>

      	<br>

      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4> </div>

      <div class="modal-body "> 

      	<?=$this->lang->line("delete_confirmation_text")?> "<strong>resume </strong>" item ?         

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

	

	function delete_resume_upload()

	{

	

		$.ajax({

			

			type:"post",

			url:"<?php echo base_url("seaman/resume/delete_resume_upload") ?>",

			data:"x=1&id_update=<?php echo $resume_upload['id_resume_file'] ?>",

			success: function(data){

				

				setTimeout(function() {

				$(".delete-resume-upload").modal("hide"),location.reload(); }, 2000);

				

			}

			

		});

		

	}

	

	$(document).ready(function(e) {

        $(".delete-resume-upload").modal("show");

		

		$("#yes-btn").click(function(){ 

			

			delete_resume_upload();

			

		})

    });

</script>