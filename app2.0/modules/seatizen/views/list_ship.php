<option value=""> <?=$this->lang->line("vessel_type")?> </option>

<?php foreach($ship_jx as $row){ ?>

<option value="<?php echo $row['type_id'] ?>">  <?php echo $row['ship_type']; ?> </option>

<?php } ?>