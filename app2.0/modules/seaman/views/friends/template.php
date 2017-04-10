<?php // template friends, module seaman ?>
<style type="text/css">
	.seatizen-item-container{
		/*min-height: 278px;*/
		height: 278px;
	}

	@media(max-width: 990px){
		.seatizen-item-container{
			/*min-height: 200px;*/
			height: 200px;

		}
	}
	@media(min-width: 1548px){
		.seatizen-item-container{
			/*min-height: 200px;*/
			height: 200px;
		}
	}
</style>
<div class="container-fluid">
    <div class="row">        
        <?php $this->load->view("friends/content",$dt_content); ?>
        
        <?php $this->load->view("friends/right_content");?>
    </div>
</div>


