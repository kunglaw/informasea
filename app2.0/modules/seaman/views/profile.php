<?php include("include/header.php"); ?>
<div class="container-fluid">
    <div class="row">
        
        
        <?php $this->load->view($content,$dt_content); ?>
        
        <?php $this->load->view($left_content);?>
    </div>
</div>

<?php $this->load->view($js_under)?>
<?php include('include/footer.php') ?>
