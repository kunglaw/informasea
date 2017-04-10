<?php
/**
 * Created by PhpStorm.
 * User: Aries Dimas Yudhistira
 * Date: 5/5/2015
 * Time: 1:13 PM
 */
?>
<?php
	$this->load->model("vessel_model");
	
	$ship = $this->vessel_model->ship_panel();
	

?>
<!-- <?php if(!empty($ship)){	 ?>
<div class="widget-box">
    <div class="text-gray widget-box-title">New Ship</div>
    <a href="#" class="text-link widget-box-seemore">See All</a>
    
    <?php
	  foreach($ship as $row)
	  {
		 
		 $url_gambar = base_url("assets/img/no-photo1_thumb.jpg");
		  
		  if(is_file("assets/ulogo/$row[image_ship]") && !empty($row['image_ship']))
		  {
			  $url_gambar = base_url("assets/ship/$row[image_ship]");
		  }
		  
		  
	?>
    
    <div style="clear: both"></div>
    <div class="media">
        <a class="pull-left small-img-container" href="#">
            <img class="media-object img-responsive" src='<?= base_url("assets/img/user.jpg") ?>' alt="user-image">
        </a>
        <div class="media-body">
            <div class="text-grey"><?php echo $row['ship_name']; ?></div>
        </div>
    </div>
    
    <?php
	  }
	?>
    
</div>
<?php } ?> -->
