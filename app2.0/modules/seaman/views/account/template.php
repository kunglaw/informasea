<?php // template account, module seaman ?>

<div class="container-fluid">
    <div class="row">        
        <?php $this->load->view("account/content",$dt_content); ?>
        
        <?php $this->load->view("account/right_content");?>
    </div>
</div>


