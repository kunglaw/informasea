<?php
	$this->load->model("vessel_model");
	
	$ship = $this->vessel_model->ship_panel();
	
if(!empty($ship)){	
?>

<div class="panel panel-default" style="margin:15px 0 0 0">
    <div class="panel-heading">
      <b> New Ships </b>
    </div>
    <div class="panel-body">
    <?php
	  foreach($ship as $row)
	  {
		 
		 $url_gambar = base_url("assets/img/no-photo1_thumb.jpg");
		  
		  if(is_file("assets/ulogo/$row[image_ship]") && !empty($row['image_ship']))
		  {
			  $url_gambar = base_url("assets/ship/$row[image_ship]");
		  }
		  
		  
	  ?>
	  <div class="row cybox" style="display:block">
	  <img src="<?php echo $url_gambar; ?>" width="40" height="40"  style="border:1px solid #CCC; margin-right:5px;" class="pull-left" />
	  <a href="#"><b class="pull-left" style="margin:0 0 0 10px"><?php echo $row['ship_name']; ?></b></a>
      
	  </div>
	  <?php
	  }
	?>
    </div>
 </div>
 <?php
}
 ?>
 
 

<style>
  .cybox {display:block; margin-bottom:10px;}
  .cybox img { }
  .cybox div { margin-bottom: 0 }
</style>