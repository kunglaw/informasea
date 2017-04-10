<?php // template applied job ?>   
<div class="col-md-12">
  <div class="row">
	  
	  <?php
		
		// left content 
		//echo "INI LEFT CONTENT";
		$this->load->view("applied-list-new/left_content");
		
		// center content 
		
		$this->load->view("applied-list-new/content");
		
		// right content 
		//echo "INI RIGHT CONTENT";
		//$this->load->view("right_content");
		
	  ?>
	  
  </div>     
</div>
<?php // end template ?>