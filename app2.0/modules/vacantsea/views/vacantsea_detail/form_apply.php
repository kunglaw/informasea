<?php

	$this->load->model("seaman/resume_model");
	
  	$type_user = $this->session->userdata("user");
	$user_id   = $this->session->userdata("id_user");
	$username  = $this->session->userdata("username");
	$name	  = $this->session->userdata("nama"); 
	$email	 = $this->session->userdata("email");


	$resume		= $this->resume_model->get_resume();

	$profile = $resume["profile"];

	if($type_user == "pelaut")
	{

		$readonly = "readonly";	

	}

?>

<div class="clearfix"></div>

<hr>

<div class="">

	<form id="form-apply">

    	<input type="hidden" value="<?php echo $user_id ?>" id="id_pelaut" name="id_pelaut" />
        <input type="hidden" value="" id="file_resume" name="file_resume" />
        <input type="hidden" value="1" id="x" name="x" />
        <input type="hidden" value="<?php echo $vacantsea['vacantsea_id']; ?>" id="vacantsea_id" name="vacantsea_id" />
        <input type="hidden" name="name_company" value="<?php echo !empty($vacantsea["id_perusahaan"]) ? $company["nama_perusahaan"] : $company["company"] ?>">

        

		<div class="form-group">

        	<label><?=$this->lang->line("name")?></label>

            <input type="text" class="form-control" name="name" value="<?=$name?>" <?=$readonly?> >

		</div>

        <div class="form-group col-md-6">

        	<label><?=$this->lang->line("email_from")?></label>

            <input type="text" class="form-control" name="email" value="<?=$email?>" <?=$readonly?> >

        </div>

        <div class="form-group col-md-6">

        	<label><?=$this->lang->line("to")?></label>

            <input type="text" class="form-control" name="email_perusahaan" value="<?=$company["email"]?>" <?=$readonly?> >

        </div>

        <div class="form-group">

        	<label><?=$this->lang->line("promotion")?> / Cover Later </label>

            <textarea class="form-control" rows="5" draggable="false" name="promotion" id="promotion" placeholder="promote.." ><?=htmlspecialchars_decode(html_entity_decode($profile["cover_letter"]))?></textarea>

        </div>

        <!-- <div>

        	<label>Upload resume</label>

        	upload cv

        </div> -->

        <button type="button" id="apply-btn" class='pull-right btn btn-filled'> <?=$this->lang->line("apply")?> </button> 

	</form>

</div>



<!-- Modal -->

<?php /* <div class="modal fade" id="apply-modal" tabindex="-1" role="dialog">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header" style="background-color:#5cb85c !important">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Thank you for choosing informasea.com  </h4>

      </div>

      <div class="modal-body">

        <div> Your application has been sent. </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div> */?>

<!-- <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script> -->

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

<script type="text/javascript">

CKEDITOR.replace( 'promotion' );

$("#apply-btn").click(function () {

  for (instance in CKEDITOR.instances) {

	  CKEDITOR.instances[instance].updateElement();

  }

  var data = $("#form-apply").serialize();

  $.ajax({

    data: data,

    type: "POST",

    url : "<?php echo base_url("vacantsea/apply_submit") ?>",

    success:function (data) {

        //console.log(output);

		//alert(data);

		$("#info").html("");

		$("#modal-login").html("");

		$("#modal-login").html(data);

    }

  });

})

</script>