<?php // content detail, untuk timeline detail.

?>

<div id="content-detail" class="col-md-10">
   
    <div class="panel panel-default"> 
     
      <div class="panel-body">
      <h2><?php echo $header ?></h2>
      <hr />
       <?php
	   if(!empty($halaman_detail))
	   { 
	   	 $this->load->view($halaman_detail);
	   }
	   else if(is_array($description))
	   {
		   echo "<pre>";
		   print_r($description);
		   echo "</pre>";
	   }
	   else
	   {
		 echo $description; // isi data berupa string   
	   }
				
		?>
      </div>
    </div>
    
  
</div>

