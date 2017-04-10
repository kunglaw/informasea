<?php // left_content.php module : guest , seaman, general ?>
<?php
	
	$username = $this->session->userdata("username");
	$this->load->model("users/user_model");
	$this->load->model("photo/photo_mdl");
	
	$pelaut = $this->user_model->get_detail_pelaut($username);
	$friends = explode("|",$pelaut['array_teman']);	
?>

<div class="col-md-3">    
  <div id="left-bar" class="panel panel-default hidden-phone">
      <div class="panel-body">
        <?php 
		
			$this->load->view('left_profile');
		?>
      </div>
  </div>

    <?php // My Job ?>
    <?php $this->load->view('content/myjobtimeline-panel'); ?>
 
<?php // menu ?>
<?php $this->load->view('content/menu-panel'); ?>

<?php // Works ?>
<?php $this->load->view("content/companies-panel");?>

<?php // Ship ?>
<?php $this->load->view("content/ship-experience-panel"); ?>

<?php // Friends 
$this->load->view("content/friends-panel");
?>
 
<?php // Photo 
$this->load->view("content/photo-panel");
?> 
 
</div>