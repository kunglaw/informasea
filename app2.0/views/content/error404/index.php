<!DOCTYPE html>
<html>  
  <head>
      <?php 
      
             $css = !empty($css) ? $css : "css"; // tambahan css 
			$meta = !empty($meta) ? $meta : "meta"; // tambahan meta
			 $js_top = !empty($js_top) ? $js_top : "js_top"; // tambahan js_top
			
            $dt_head['css']  	= $css;
            $dt_head['meta']   = $meta;
            $dt_head['js_top'] = $js_top;
            $dt_head['title'] = $title;
            //echo "<br>".$head." : ";
            //print_r($dt_head);
            $this->load->view($head,$dt_head);
            //echo "hello2";
             
     ?>
  </head>

  <body>
      <div id="wrapper">
          <header id="header">
          
			<?php 
			$this->load->view("content/error404/navbar/navbar"); 
			//$this->load->view("include/navbar");
			//$this->load->view("include/navbar-mobile");
			$this->load->view("content/error404/navbar/navbar-mobile"); 
			?>
          
          </header>
      </div>
	  <?php
          $this->load->view($template,$data);
      ?>
      
      <?php $this->load->view("content/error404/footer"); ?>
  </body>
</html>

<?php $this->load->view("content/error404/js_under");  ?>
