<div class="box">
	<div class="box-header">
		<h4 class="box-heading pull-left header-text">Photos</h4>
		<div class="pull-right">
			<button class="btn btn-sm btn-filled"><i class="fa fa-plus"></i> Create Album</button>
			<button class="btn btn-sm btn-filled"><i class="fa fa-plus"></i> Upload Photo</button>
		</div>
		<span class="clearfix"></span>
	</div>
	
	
	<div role="tabpanel">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#ptimeline" aria-controls="ptimeline" role="tab" data-toggle="tab">Timeline</a></li>
			<li role="presentation"><a href="#pphotos" aria-controls="pphotos" role="tab" data-toggle="tab">Photos</a></li>
			<li role="presentation"><a href="#palbums" aria-controls="palbums" role="tab" data-toggle="tab">Albums</a></li>
		</ul>
		<br>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="ptimeline">
			
			<ul id="gallery" class="image-grid image-grid-5">
				<?php for($i=0; $i<20; $i++)
					echo '<li>

							<img src="assets/img/img_default.png" alt="">
							<div class="text-container"><p>Photo Timeline..</p> </div>
							
							<button type="button" class="btn icon-block icon-block-sm btn-filled-black btn-xs photo-options" data-toggle="popover" data-trigger="focus">
							<span class="glyphicon glyphicon-option-horizontal" aria-hidden="true">
							</span>
							</button>
						</li>';
				?>
			</ul>
			</div>
			<div role="tabpanel" class="tab-pane" id="pphotos">...</div>
			<div role="tabpanel" class="tab-pane" id="palbums">...</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.photo-options').popover({
			html:true,
			placement: 'bottom',
			content: '\
			<ul class="custom-list">\
				<li><a href="#">Download</a></li> \
				<li><a href="#">Make Profile Picture</a></li> \
				<li><a href="#">Make Resume Photo</a></li> \
				<li><a href="#">Delete</a></li> \
			</ul>\
			' 
		});
	});
	
</script>