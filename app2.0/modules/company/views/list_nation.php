<option value="0"> <?=$this->lang->line("nation")?> </option>

<?php 

foreach($nation as $row){

	$f = strtolower($row['name']);

	$z = str_replace(" ","-",$f);

 ?>

<option value="<?php echo $z?>">  <?php echo $row['name']; ?> </option>

<?php } ?>