<?php // self panel, left panel ?>
<?php
	$this->load->model("experience_model");
	$this->load->model("company/company_model");
	$exp = $this->experience_model->get_exp_gbcompany();
?>
<?php
if(!empty($exp)){
?>
<div class="list-group" style="margin:15px 0 0 0" >
    <a href="#" class="list-group-item active" title="Work Experience Companies">
      <b> Work Exp. Companies </b>
    </a>
    <?php
	
	foreach($exp as $row)
	{
		$comp = $this->company_model->get_detail_company($row['experience_id']);
	?>
    <a href="#" class="list-group-item">
    	<img src="<?php echo base_url("assets/ulogo/".$comp['logo_image']) ?>" height="40" width="40" style="border:1px solid #CCC" >
        <b > <?php echo $row['company'] ?> </b>
    </a>
    <?php
	}
	?>
    
</div>
<?php
}
?>