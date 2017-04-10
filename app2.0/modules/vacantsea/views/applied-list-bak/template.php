<?php // template module seaman ?>   
<div class="col-md-12">
  <div class="row">
        
    <div class="col-md-9">
    <div class="row">	
        <?php 
			
			$this->load->view('applied-list/header');
		
		?>
        
        
        <div class="col-md-12">
        <div class="row">
            <?php
				
				$this->load->view('applied-list/content');
			?>
            
            
        </div>    
        </div>
     
     </div><!-- row -->
     </div>
    
     <?php
	 	
		$this->load->view('applied-list/right_content');
	 
	 ?>
  
  </div><!-- row --> 
</div><!-- col-md-14 -->
<?php // end template ?>