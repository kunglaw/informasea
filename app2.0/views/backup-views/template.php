<?php // template default ?>

<div class="col-md-12">
  <div class="row">
	    
	  <?php
		
		// left content 
		$this->load->view('left_content');
		
		// center content 
		$this->load->view('content');
		
		// right content 
		$this->load->view('right_content');
		
	  ?>
	  
  </div>     
</div>
