<?php // template , module dashboard ?>

<section class="content container-fluid">
  <div class="row">
      <div class="col-md-3 hidden-sm hidden-xs">
          
          <?php $this->load->view("left-content"); ?>
         
      </div>
      
      <div class="col-md-6 main">
		  <?php /* content.php , diambil dari module timeline */?>
          <?php //$this->load->view('timeline/template'); ?>
          <?php $this->load->view('timeline/write-post-block.php'); ?>
          <?php $this->load->view('timeline/template-dashboard'); ?>
      </div>
      
      <div class="col-md-3 hidden-sm hidden-xs">
          <?php $this->load->view("right-content"); ?>
      </div>
  </div>
</section>