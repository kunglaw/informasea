<?php // template detail vacantsea ?>   
<div class="col-md-12 col-lg-12 col-sm-12">
  <div class="row">
	  
	  <?php
		
		// left content 
		//$this->load->view("content/vacantsea/left_content");
		
		// center content 
		$this->load->view($halaman_detail);
		
		// right content 
		$this->load->view("right_content_detail");
		
	  ?>
	  <div class="clearfix"></div>
  </div>     
</div>
<?php // end template ?>