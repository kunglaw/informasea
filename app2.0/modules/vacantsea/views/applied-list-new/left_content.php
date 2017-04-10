<?php // LEFT CONTENT RESUME ?>

<div class="col-md-3">
  <div id="left-bar" class="panel panel-default hidden-phone">
      <div class="panel-body">
        <?php 
		  	$this->load->view('resume/left_profile');
		  ?> 
      </div>
  </div> 
  
   <div class="list-group" style="margin:15px 0 0 0">
    <a class="list-group-item active">
     <b> <span class="glyphicon glyphicon-user"></span> &nbsp My Profile </b>
    </a>
    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;About </a>
    <a href="<?php echo base_url("photo")?>" class="list-group-item"><span class="glyphicon glyphicon-picture"></span> &nbsp; Photo Album</a>
    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp; Friends</a>
  </div>
  
 <?php 
 // from general view/content
 $this->load->view('content/myjob-panel'); ?>
 
 <?php 
 // from general view/content
 $this->load->view('content/notification-panel'); ?>
  
  
</div><!-- col-md-4 -->