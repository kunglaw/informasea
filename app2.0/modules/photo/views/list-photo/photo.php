<?php //experience, page photo, profile, module user ?>

<?php 
	$username_url = $this->uri->segment(2);
	$this->load->model('seatizen/seatizen_model');
	$check_username = $this->seatizen_model->check_seatizen($username_url);
	
	if(empty($check_username))
	{
		$username = $this->session->userdata("username");
	}
?>
<span id="modal-form"></span>
<div class="box">
	<div class="box-header">
		<h4 class="box-heading pull-left header-text">Photos</h4>
		<div class="pull-right">
			<button class="btn btn-sm btn-filled"><i class="fa fa-plus"></i> Create Album</button>
			<button class="btn btn-sm btn-filled" id="upload-btn"><i class="fa fa-plus"></i> Upload Photo</button>
		</div>
		<span class="clearfix"></span>
	</div>
	
	
	<div role="tabpanel">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li id="tabtml" role="presentation" class="active">
            	<a href="#ptimeline" aria-controls="ptimeline" role="tab" data-toggle="tab">Timeline</a>
            </li>
			<li id="tabphoto" role="presentation">
            	<span id="info_photo"></span>
            	<a href="#pphotos" aria-controls="pphotos" role="tab" data-toggle="tab">Photos</a>
            </li>
			<li id="tabalbum" role="presentation">
            	<a href="#palbums" aria-controls="palbums" role="tab" data-toggle="tab">Albums</a>
            </li>
		</ul>
		<br>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="ptimeline">
				<div><?php // load ajax ?></div>			
			</div>
			<div role="tabpanel" class="tab-pane" id="pphotos">
            	<div><?php // load ajax ?></div>
            </div>
			<div role="tabpanel" class="tab-pane" id="palbums">
            	<div><?php // load ajax ?></div>
            </div>
		</div>
	</div>
</div>

