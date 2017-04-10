<option value="">Departments</option>

<?php foreach($dept_jx as $row) { ?>

    <?php
    $selected = "";
    if($idnya == $row['department_id']) $selected="selected";
    ?>
   <option value="<?php echo $row['department_id'] ?>" <?php echo $selected ?> ><?php echo $row['department'] ?></option>
<?php } ?>