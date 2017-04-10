<option value="0"> Nation </option>
<?php foreach($nation as $row){ ?>
<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>