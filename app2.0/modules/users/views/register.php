<!doctype html>
  <head>
  <?php $this->load->view("googleadsense"); ?>
  <?php
   	  
	  $css = !empty($css) ? $css : "css"; // tambahan css 
	  $meta = !empty($meta) ? $meta : "meta"; // tambahan meta
	  $js_top = !empty($js_top) ? $js_top : "js_top"; // tambahan js_top
	  
	  $dt_head['css']  	= $css;
	  $dt_head['meta']   = $meta;
	  $dt_head['js_top'] = $js_top;
	  
      $this->load->view('head',$dt_head); // include general head

  ?>
  </head>
  <body>
  	  <?php $this->load->view("googleanalitics") ?>
      <div id="wrapper">
          <header id="header">
          
              <?php 
			  	  
                  if(empty($navbar))
                  {
                    $this->load->view('include/navbar.php',		$dt_navbar);          
                    $this->load->view('include/navbar-mobile.php',$dt_navbar); 
                  }
                  else
                  {
                    $this->load->view($navbar,$dt_navbar); 
					 
                  }
              ?>
          </header>
      </div>
      
      <?php
          if(!empty($info) )
          {
              $dt_template['info'] = $info;
          }
          
          if(!empty($ve) )
          {
              $dt_template['ve'] = $ve;	
          }
		  
		  $dt_template["username_reg"] = $username_reg;
		  $dt_template["first_name"]   = $first_name;
		  $dt_template["last_name"]	= $last_name;
		  $dt_template["email"]		= $email;
          
          $this->load->view($template,$dt_template);
      	  //exit('sasasasasas');
      ?>
      
      <?php $this->load->view("footer",$dt_footer); ?>
  
  </body>
</html>
	  <?php $this->load->view($js_under,$dt_js_under); ?>
