<?php // vacantsea panel. right panel ?> 

<?php
	$this->load->model("vacantsea/vacantsea_model");
	$this->load->model("company/company_model");
	$this->load->helper("text_helper");
	
	$vacant = $this->vacantsea_model->get_vacantsea_panel();
	
	

?>

<div id="" class="panel panel-default hidden-xs" style="margin-top:15px;">
  
  <div class="panel-heading ">
  <b> New Vacantsea </b>
  </div>
  
  <div class="panel-body">
    
    <?php
	foreach($vacant as $row)
	{
		
		$company = $this->company_model->get_logoimage($row['id_perusahaan']);
	
		$url_gambar = base_url("assets/ulogo/$company");
		
		if($company == "" || !is_file("assets/ulogo/$company"))
		{
			 $url_gambar = base_url("assets/user_img/noprofilepic_small.png");	
		}
	?>
   	<div class="row cbox" style="display:block" title="<?php echo ucfirst($row['perusahaan'])." - ".$row['vacantsea']  ?>" >
    	<img src="<?php echo $url_gambar ?>" width="40" height="40" class="pull-left"  style="border:1px solid #CCC" />
        <div class="pull-left" style="margin:0 0 0 10px" >
        	<a href="<?php echo "#";?>"><b><?php echo ucfirst($row['perusahaan']); ?></b></a>
        	<div><?php echo word_limiter($row['vacantsea'],3); ?></div>
        </div>
    
    </div>
    <?php
	}
	?>
 
  
  </div>
 
</div>




<style>
  .cbox {display:block; margin-bottom:10px;}
  .cbox img { }
  .cbox div { margin-bottom: 0 }
</style>