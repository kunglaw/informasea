<?php //center content, menu home, module : default / guest / pelaut 


// cek pertemanan
$this->load->model('seaman/friendship_model');

$pelaut_id_login = $this->session->userdata("id_user");
//$cf = $this->friendship_model->show_friend($);


?>

<div id="content" class="col-md-6">
    
    <?php
	if($this->session->userdata("user") == "pelaut")
	{
		$this->load->view('seaman/post_timeline');
	}
	
	
	?>
    
    <div id="list_timeline">
    	
        
        
    </div>
    
    <script>
		
		function get_list_timeline()
		{
			//alert("asasas");
			$.ajax({
				
				
				type : "POST",
				url : "<?php echo base_url("seaman/home/get_list_timeline"); ?>",
				data:"x=1",
				success : function(data)
				{
					//alert(data);
					$("#list_timeline").html(data);	
				}
				
				
				
			});
			
			
		}
		
		
		$(document).ready(function(e) {
			
			
			get_list_timeline();
			
        });
		
		
	</script>
    
    
	
    
    <!-- <div class="panel panel-default"> 
      
      <div class="panel-body">
        <?php //$this->load->view('dummy/dummy_text')?>
      </div>
    </div> -->
    
  
</div>