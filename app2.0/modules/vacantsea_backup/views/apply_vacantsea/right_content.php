<?php // right content, menu vacantsea, module vacantsea ?>
<style>
#right-content .panel .panel-body{
	
	padding:10px 30px 10px 30px;	
}
</style>

<div class="col-md-3 row" id="right-content">
<div id="" class="panel panel-default">
          
  <div class="panel-body" >
  	<div class="">
    	<?php $this->load->view('dummy/dummy_ad')?>
    </div>
  </div>
 
</div>

<?php // vacantsea right panel 
$this->load->view("content/vacantsea-panel");

// company panel
//$this->load->view("content/company-panel");








?>
</div>

