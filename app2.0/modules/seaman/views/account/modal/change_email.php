<div class="modal fade" id="change-email-modal">

  <div class="modal-dialog">

    <div class="modal-content">

    <form method="post" id="form-change-email" role="form" onSubmit="return false">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      <h4 class="modal-title"><?=$this->lang->line("add_new_email")?></h4> 

      </div>

      <div class="modal-body">

      	<span id="info-change-email"></span>

        

        <div class="form-group">

        	<label> <?=$this->lang->line("primary_email")?> </label>

            <input type="email" name="new_email" id="new_email" class="form-control" value="<?=$email?>" readonly="readonly">

        </div>	



      	<span id="add_email">  <a href="#" id="another_email_nih"> <?=$this->lang->line("add_another_email")?> </a> </span>





      	<div class="form-group" style="display:none;" id="form-email-lain">



      		<label><?=$this->lang->line("another_email")?> </label>

      		<input type="email" name="another_email" id="another_email" class="form-control">

      		<a href="#" id="close" class="pull-right"> Close </a>

      	</div> 

      

        





      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" disabled="disabled" id="btn-savee">Save changes</button>

      </div>

    </form>

    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->

</div><!-- /.modal -->



<script>



$(document).ready(function(e) {

    

	$("#change-email-modal").modal({

		show:"true",

		backdrop:"static"	

		

	});



	$("#another_email_nih").click(function(){



		$("#form-email-lain").show();

		$(this).hide();

		$("#btn-savee").removeAttr('disabled');



			});



	$("#close").click(function(){

		$("#form-email-lain").hide();

		$("#another_email_nih").show();

		$("#btn-savee").attr('disabled','disabled');



	});

	

	$("#form-change-email").submit(function(){

		

		$.ajax({

			url:"<?=base_url("seaman/account_setting/change_email_process")?>",

			type:"POST",

			data:$(this).serialize(),

			dataType:"JSON",

			error: function(err)

			{

				alert(err.responseText);	

			},

			success: function(res)

			{

				$("#info-change-email").html(res.info);	

				

				if(res.reload == "true")

				{

					setTimeout(function(){ location.reload(); },3000);	

				}

			}

			

			

		});

		

		

	});

	

	

});





</script>