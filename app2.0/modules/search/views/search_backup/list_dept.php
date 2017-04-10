<option value="">Departments</option>

<?php foreach($dept_jx as $row) { ?>

   <option value="<?php echo $row['department_id'] ?>"><?php echo $row['department'] ?></option>
<?php } ?>