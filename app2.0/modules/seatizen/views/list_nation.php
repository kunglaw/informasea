<option value="0"> <?=$this->lang->line("nation")?> </option>

<?php 

foreach($nation as $row){

	$selected = '';

	if($search_data['nationality'] == $row['name']) $selected = "selected='selected'";

 ?>

<option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>>  <?php echo $row['name']; ?> </option>

<?php } ?>