<?php // right content.php module: default ?>

<style>
#right-content .panel .panel-body{
	
	padding:10px 30px 10px 30px;	
}
</style>

<div class="col-md-3 row" id="right-content">
  <?php // TENTANG INFORMASEA
  $this->load->view("content/about-informasea-panel");
  ?>
  
 <?php // seatizen-panel , right 
 $this->load->view('content/seatizen-panel');
 ?>
 
 <?php // vacantsea-panel, right
 $this->load->view('content/vacantsea-panel');
 ?>
 
 <?php // company, right 
 $this->load->view("content/company-panel");
 ?>
 
<!--  --><?php //// UNTUK SHIPS
// $this->load->view("content/right-ship-panel");
// ?>
 

</div>