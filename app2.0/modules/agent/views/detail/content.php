<?php // content detail, untuk timeline detail.

?>

<div id="content-detail" class="col-md-10">
   
    <div class="panel panel-default"> 
     
      <div class="panel-body">
         <div class="row-tml">
        	<div id="detail-img-content" class="">
            	<a href="#"> <img src="<?php echo base_url("assets/img/profile-pic-no.gif"); ?>" alt="" id="detail-img" class="img-rounded" /> </a>
            </div>
            
        	<div class="col-md-10" id="detail-tagname">
            	<p class="mini-margin-6"><b><a href="<?php echo "#"; ?>"> <?php echo "lorem bro"  ?> </a> </b></p>
                <p class="mini-margin-6"><?php echo "lorem bro"  ?></p> 
            </div>
            
       	  </div>
          
          <div class="clearfix"></div>
          
          <div id="detail-description" class="">
          <p><b><a href="#"> <?php echo "lorem bro"  ?> </a></b></p>
          <p><?php $this->load->view('dummy/dummy_text')  ?></p>
          	<div class="clearfix"></div>
            
          
          <?php
		  
          	//$this->load->view('dummy/dummy_text')
			
          ?>
          </div>
        <div>
        
        
        </div>
      </div>
    </div>
    
  
</div>

