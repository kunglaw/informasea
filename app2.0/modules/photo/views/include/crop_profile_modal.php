<?php // PROFILE ?>

<?php $this->load->view("head_crop") ?>

<script src="<?=asset_url("plugin/cropper-master/main_profile.js")?>" ></script>



<?php

  $this->load->model("photo/photo_mdl");

  $username  			= $this->session->userdata("username");

  //$username_company 	= $this->session->userdata("username_company");

  //$username_agent	  = $this->session->userdata("username_agent");

  $user_type  		   = $this->session->userdata("user");

  

  $pp = $this->photo_mdl->get_photo_pp($username);

  //$cpp = $this->photo_mdl->update_profile_pic($pp['id_pptr']);

?>



<div id="crop-avatar" class="container">

<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">

  <div class="modal-dialog modal-lg">

      <div class="modal-content">

          <form class="avatar-form" action="<?php echo base_url("photo/photo_crop/cropping");?>" enctype="multipart/form-data" method="post">

              <div class="modal-header bg-primary">

                  <button class="close" data-dismiss="modal" type="button">&times;</button>

                  <h4 class="modal-title" id="avatar-modal-label">Change Profile</h4>

              </div>

              <div class="modal-body">

                  <div class="avatar-body">



                      <!-- Upload image and data -->

                      <div class="avatar-upload" style="width:100%">

                           <input class="form-control" name="photo_type" value="profile" type="hidden">

                           <input type="hidden" name="crop_width"  value="200" />

                           <input type="hidden" name="crop_height" value="200" />

                           <input class="form-control nama_gambar" name="nama_gambar" value="<?=$pp['nama_gambar']?>" type="hidden" />

                      	   <div class="form-group">

                            <!-- <label class="">Avatar Src : </label> -->

                            <input class="avatar-src form-control" name="img_src" value="" type="hidden">

                          </div>

                          <div class="form-group">

                          	<!-- <label>Avatar Data</label>--> 

                          	<input class="avatar-data form-control" name="img_data" type="hidden">

                          </div>

                          <div class="form-group">

                          	<label for="avatarInput">Local upload</label>

                          	<input class="avatar-input" id="img_input" name="img_input" type="file">

                          </div>

                      </div>



                      <!-- Crop and preview -->

                      <div class="row">

                          <div class="col-md-9">

                              <div class="avatar-wrapper">

                              	<img src="<?php echo img_url("photo/$username/profile_pic/$pp[nama_gambar]");?>" alt="Picture"/>

                              </div>

                          </div>

                          <div class="col-md-3">

                              <div class="avatar-preview preview-lg"></div>

                              <div class="avatar-preview preview-md"></div>

                              <div class="avatar-preview preview-sm"></div>

                          </div>

                      </div>



                      <div class="row avatar-btns">

                          <div class="col-md-9">

                              <div class="btn-group">

                                  <button class="btn btn-primary btn-left" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>

                                  <!-- <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>

                                  <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>

                                  <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button> -->

                              </div>

                              <div class="btn-group">

                                  <button class="btn btn-primary btn-right" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>

                                  <!-- <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>

                                  <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>

                                  <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button> -->

                              </div>

                          </div>

                          <div class="col-md-3">

                              <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>

                          </div>

                      </div>

                  </div>



              </div>

              <!-- <div class="modal-footer">

                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>

              </div> -->

          </form>

      </div>

  </div>

</div>

</div>

        

<script>

    $(document).ready(function(){

        $('#avatar-modal').modal({

            show:"true",

            backdrop:"static"

        });

		

		$(".avatar-src").val($(".avatar-wrapper img").attr("src"));// klo image tidak kosong

		

		$(".btn-left").click(function(){

			$('.avatar-wrapper > img').cropper('rotate',-90);	

		});

		

		$("#img_input").change(function(event){

			

			var tmppath = URL.createObjectURL(event.target.files[0]);

			//$("img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));

			$(".avatar-wrapper img").attr('src',URL.createObjectURL(event.target.files[0]));

			$(".avatar-preview img").attr('src',URL.createObjectURL(event.target.files[0]));

			

			//$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");

		});

		

		$(".btn-right").click(function(){

			$('.avatar-wrapper > img').cropper('rotate',90);

		});

		

		/* $(".avatar-save").click(function(){

			

			$.ajax({

				

				url:"<?php echo base_url("photo/photo_crop/cropping");?>",

				data:$(".avatar-form").serialize(),

				type:"POST",

				success: function(resp)

				{

					alert("response = "+resp);

				},

				error: function(err)

				{

					alert("error ="+err);	

				}

				

			});

			

		}); */

	

		

		

    });

	

	/* CREATE URL in file type

	$('#i_file').change( function(event) {

var tmppath = URL.createObjectURL(event.target.files[0]);

    $("img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));

    

    $("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");

});*/

	

	/* $(".avatar-wrapper > img").cropper({

	  aspectRatio: 2/3,

	  //preview: ".img-preview",

	  strict:true,

	  guides:false,

	  dragCrop: false,

	  //preview: this.$avatarPreview.selector,

	  cropBoxMovable: false,

	  cropBoxResizable: false,

	  

	  /* crop: function(e) {

		$("#dataX").val(Math.round(e.x));

		$("#dataY").val(Math.round(e.y));

		$("#dataHeight").val(Math.round(e.height));

		$("#dataWidth").val(Math.round(e.width));

		$("#dataRotate").val(e.rotate);

		$("#dataScaleX").val(e.scaleX);

		$("#dataScaleY").val(e.scaleY);

	  } 

	});*/

	

	var $image = $('.avatar-wrapper > img'),

    cropBoxData,

    canvasData;



	$('#avatar-modal').on('shown.bs.modal', function () {

	  $image.cropper({

		//autoCropArea: 0.5,

		aspectRatio: 1/1,

		strict:true,

		preview:".avatar-preview",

		guides:false,

		dragCrop: false,

		cropBoxMovable: false,

	  	cropBoxResizable: false,

		built: function () {

		  // Strict mode: set crop box data first

		  $image.cropper('setCropBoxData', cropBoxData);

		  $image.cropper('setCanvasData', canvasData);

		},

		crop:function(e) {

		  var json = [

                  '{"x":' + e.x,

                  '"y":' + e.y,

                  '"height":' + e.height,

                  '"width":' + e.width,

                  '"rotate":' + e.rotate + '}'

                ].join();



            $(".avatar-data").val(json); // pemberian value kepada avatar data

	    } 

	  });

	}).on('hidden.bs.modal', function () {

	  cropBoxData = $image.cropper('getCropBoxData');

	  canvasData = $image.cropper('getCanvasData');

	  $image.cropper('destroy');

	});

	

</script>