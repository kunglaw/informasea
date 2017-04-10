<?php // template profile, module seaman ?>

<div class="container-fluid">
    <div class="row">        
        <?php $this->load->view("profile/content",$dt_content); ?>
        
        <?php $this->load->view("profile/right_content");?>
    </div>
</div>


