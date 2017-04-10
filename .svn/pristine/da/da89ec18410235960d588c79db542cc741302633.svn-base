<?php $this->load->view("head_crop") ?>

<script src="<?=asset_url("plugin/cropper-master/main.js")?>" ></script>

<div id="crop-avatar" class="container">
	<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form class="avatar-form" action="<?php echo base_url("photo/photo_crop/cropping");?>" enctype="multipart/form-data" method="post">
              <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                  <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
              </div>
              <div class="modal-body">
                  <div class="avatar-body">

                      <!-- Upload image and data -->
                      <div class="avatar-upload" style="width:100%">
                      	  <div class="form-group">
                            <label class="">Avatar Src : </label>
                            <input class="avatar-src form-control" name="avatar_src" type="text">
                          </div>
                          <div class="form-group">
                          	<label>Avatar Data</label>
                          	<input class="avatar-data form-control" name="avatar_data" type="text">
                          </div>
                          <div class="form-group">
                          	<label for="avatarInput">Local upload</label>
                          	<input class="avatar-input form-control" id="avatarInput" name="avatar_file" type="file">
                          </div>
                      </div>

                      <!-- Crop and preview -->
                      <div class="row">
                          <div class="col-md-9">
                              <div class="avatar-wrapper">
                              	<img  src="<?php echo img_url("test/Desert.jpg")?>"/>
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
                                  <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                  <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                  <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                  <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                              </div>
                              <div class="btn-group">
                                  <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                  <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                  <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                  <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
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
    });
	
	$(".avatar-wrapper > img").cropper({
	  aspectRatio: 16 / 9,
	  autoCropArea: 0.65,
	  strict: true,
	  guides: false,
	  highlight: false,
	  dragCrop: false,
	  cropBoxMovable: false,
	  cropBoxResizable: false
	});
</script>