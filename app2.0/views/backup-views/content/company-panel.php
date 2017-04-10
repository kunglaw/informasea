<?php
	$this->load->model("company/company_model");
	
	$company = $this->company_model->get_company_panel();
	
if(!empty($company)){	
?>

<div class="panel panel-default" style="margin:0 0 0 0">
    <div class="panel-heading">
      <b> Company </b>
    </div>
    <div class="panel-body">
    <?php
	  foreach($company as $row)
	  {
		 
		  $url_gambar = "assets/user_img/noprofilepic_small.png";
		  
		  if(is_file("assets/ulogo/$row[logo_image]") && !empty($row['logo_image']))
		  {
			  
			  $url_gambar = base_url("assets/ulogo/$row[logo_image]");
		  }
		  
		  
	  ?>
	  <div class="row cybox" style="display:block">
	  <img src="<?php echo $url_gambar; ?>" width="40" height="40"  style="border:1px solid #CCC; margin-right:5px;" class="pull-left" />
	  <a href="#" class="pull-left" ><b  style="margin:0 0 0 0px"><?php echo $row['nama_perusahaan']; ?></b></a>
      
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
	.cybox a b { }
	.cybox a { width:70%; margin-left:10px;}
</style>
 
 

<style>
  .cybox {display:block; margin-bottom:10px;}
  .cybox img { }
  .cybox div { margin-bottom: 0 }
</style>