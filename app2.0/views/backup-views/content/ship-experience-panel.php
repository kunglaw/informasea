<?php // self panel, left panel ?>
<?php
	$this->load->model("experience_model");
	$this->load->model("vessel_model");
	$exp = $this->experience_model->get_exp_gbcompany();
?>
<?php
if(!empty($exp))
{
?>
<div class="list-group" style="margin:15px 0 0 0" >
    <a href="#" class="list-group-item active" title="Work Experience Companies">
      <b> Vessel Experience </b>
    </a>
    <?php
	
	foreach($exp as $row)
	{
		//$ship = $this->vessel_model->get_ship_byname($row['ship_name']);
		
		if(empty($ship['gambar']) /*|| !is_file()*/ )
		{
			$url_gambar = base_url("assets/img/no-photo1_small.jpg");
		}
	?>
    <a href="#" class="list-group-item">
    	<img src="<?php echo $url_gambar ?>" height="40" width="40" style="border:1px solid #CCC" >
        <b > <?php echo $row['ship_name'] ?> </b>
    </a>
    <?php
	}
	?>
    
</div>
<?php
}
?>

