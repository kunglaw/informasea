<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <?php
  	
	$css = !empty($css) ? $css : ""; // tambahan css 
	$data['css'] = $css;
	
	$this->load->view('head.php',$data);
	$this->load->view('javascript');
	 
  ?>
  </head>
  <body class="skin-blue">
  	<?php //$this->load->view('seaman/menu_seaman_adlte')?>
    <div id="wrapper" class="container">
    
    <!-- navbar fixed -->
    <div id="header" class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container" style="width:60%">
        <div class="navbar-header" style="width:7%">
          <a href="<?php echo base_url(); ?>" class="navbar-brand" style="color:#FFF; font-weight:bold">Informasea</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        
        <!-- menu -->
        
        <?php
			if($this->session->userdata("user") == "pelaut")
			{ 
				$this->load->view('seaman/menu_seaman');
			}
			else if($this->session->userdata("user") == "")
			{
				//$a = Modules::load('default_controller/home');
				//$this->load->modules('default_controller');
				//$a->menu();
				$this->load->view('menu');
				//$this->load->controller('home/menu');
			}
			//$a = $this->session->all_userdata();
			//print_r($a);
			//echo $a['session_id'];
			//echo $this->session->();
		?>
        <!-- end menu  -->
        
      </div>
    </div>
    
    <?php 	
		
		//$this->load->view("breadcrumb");
		
		// template 
		$this->load->view($template);		
	?> 
    
    
    
    </div>
    
    <?php 
		// footer
		$this->load->view("footer");
	?>
    
    <!-- <div style="margin-bottom:-200px"></div> -->
    <?php /*<footer>
      	<div class="row">
       		<p>informasea.com</p> 
      	</div> 
      </footer> */ 
	  
	 
	  
	  
	  ?> 
      <script>
		$(document).ready(function(e) {
            $("#pushstat").hide();
        });
	
	
	</script>    
  
 	<noscript>activate javascript</noscript>
  
  
  </body>

</html>
