<?php // view navbar, module default ( guest )  ?>

<div class="navbar-collapse collapse" id="navbar-main">
 <div class="col-md-6" id="menu-bar">
  <ul class="navbar-nav nav">
    <li><a href="<?php echo base_url("vacantsea"); ?>/" >Vacantsea</a></li>
    <li><a href="<?php echo base_url("seatizen"); ?>" >Seatizen</a></li>
     <li><a href="<?php echo base_url("company"); ?>" >Company</a></li>
  </ul>
 </div>
 
  
 <div class="col-md-4" id="right-menu">
  <ul class="navbar-nav nav  navbar-right">
      <li><a href="<?php echo base_url('users/users') ?>">Sign Up</a></li>
      <li><a href="<?php echo base_url('users/users') ?>">Login</a></li>      
  </ul> 
 </div>
 
  
</div>