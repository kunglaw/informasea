<?php
	$username 			 = $company['username'];
	$type_user 			= $this->session->userdata("type_user");
	
	//cek type server
	if($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']){
        $url = "http://localhost/agent.informasea";    
    }else{
        $url = "http://agent.informasea.com";   
    }
	
	//cek type_user
	if ($type_user == "company") {
		
		/* $id_perusahaan 	   = $this->session->userdata("id_perusahaan");
		$username 			= $this->session->userdata("username_company");
		$account_type 		= "Premium"; // simpan disini account_type
		$btn_new_vacant 	  = "| <a href='$url/new_vacant/$id_perusahaan&$username&dashboard&$account_type&$pass' target='_blank'>
		<i class='glyphicon glyphicon-plus' ></i> Create new vacantsea</a> 
	
		
		"; */
		
	}else{
		$btn_new_vacant 	= "";
	}
?>
<div id="container_modal"> 
<!-- this container modal -->
</div>

<!-- <div class="col-md-9"> -->
		
 
	<!-- <div role="tabpanel">
	  <!-- Nav tabs --
	  <div id="sticky-anchor"></div>
	  <div class="widget-box" id="sticky"> -->
	  
		<?php //$this->load->view("menu"); 
		$username_company = $company['username']; ?>
              
	  <!-- </div> -->
     
     <script>
		
      	function edit_map()
		{
			href = "<?=base_url("agentsea/$username_company/home")?>";
			tambahan = "?show_edit";
			location.assign(href+tambahan);
		}
      
	  
	 </script>
     
     <?php 
	 	// GOOGLE MAP
		
		$dt['longitude'] 	  = !empty($company['longitude']) ? $company['longitude'] : 0;
		$dt['latitude']  	   = !empty($company['latitude']) ? $company['latitude'] : 0;
		$dt['id_perusahaan']  = $company['id_perusahaan'];
		$dt['username']  	   = $company['username'];
		
		
		if(isset($_GET['show_edit']))
		{
		
			$gms_show = "hidden";
			$gme_show = "";
		}
		else
		{
			$gms_show = "";
			$gme_show = "hidden";
		}
		
	 ?>
     
     <?php if((!empty($dt['longitude']) && !empty($dt['latitude'])) && !isset($_GET['show_edit'])) {  ?>
     <div id="google_map_show" class="<?=$gms_show?>"> 
	 	<?php $this->load->view("include/google_map_box",$dt); // tampil ?>
     </div>
     <?php }  ?>
     
     <?php if($this->session->userdata("username_company") != "" && isset($_GET['show_edit'])){?>
     <div id="google_map_edit" class="<?=$gme_show?>" style="">
	 	<?php $this->load->view("include/edit_map",$dt); // edit ?>
     </div>
     <?php } ?>
     
     <?php if($this->session->userdata("username_company") != "" && !isset($_GET['show_edit']) && (empty($dt['longitude']) && empty($dt['latitude']))) { ?>
     <div class="tab-content">
      <div role="tabpanel" class="tab-pane active box" id="home">
          <center> <button class="btn btn-primary" onClick="edit_map()"> <?=$this->lang->line("add")?> Map ... </button></center> 
      </div>
     </div><br>
     <?php } ?>
      
	  <!-- Tab content -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active box" id="home">
	    	
	    	<div class="about">
	    		<h4 class="text-gray"><?=$this->lang->line("about_company")?> </h4>
	    		<p><?php echo e_about($company['description']);?></p>
	    	</div>
            
	    	<div class="agentsea-photos">
	    		<h4 class="text-gray pull-left"><?=$this->lang->line("photos")?></h4>
	    		<a class="pull-right a-block" href="<?=base_url("agentsea/$username/photos");?>">See all</a>
	    		<span class="clearfix"></span>
	    		<?php $this->load->view('include/gallery-list-item');?>
	    	</div>
			
	    	<div class="agentsea-vacantsea">
	            <h4 class="text-gray pull-left"><?=$this->lang->line("vacantsea")?> <?=$btn_new_vacant;?></h4> 
	            <a class="pull-right a-block" href="<?=base_url("agentsea/$username/vacantsea");?>" >See all</a>
	            <span class="clearfix"></span>
		    	<?php 
		    		include('include/vacantsea-list-item.php'); 
		    	?>
		    </div>

	    </div>
	  </div>

	</div>

<!-- </div> -->

<script type="text/javascript">
$("#new_vacantsea").click(function(){
	$.ajax({
		type 	: "POST",
		url 	: "<?=base_url('company/modal_company');?>",
		data 	: "modal_type=vacant_add",
		success:function(data){
			$("#container_modal").html(data);
		}
	});
});

</script>


<?php //$this->load->view("js_under");?>