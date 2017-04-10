<div class="row">
	<div class="container">
      <div class="panel panel-default">
      	<div class="panel-heading"> 
        	<h3 class="panel-title"> Welcome to Informasea </h3>
  
        </div>
      	<div class="panel-body"> 
        
        	<a href="<?=base_url("test/logout2")?>"> Logout </a>
            
            <hr>
            
            <?php 
			print_r($this->session->all_userdata()) ?> 
            <hr>
            <?php
				$username_sess = $this->input->cookie("usess");
				$email_sess	= $this->input->cookie("esess");
				
				print_r($username_sess);
				print_r($email_sess);
			?>
        </div>
      </div>
    </div>
</div>