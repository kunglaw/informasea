<option value= ''> COC Class </option>
<?php foreach($coc_class as $row){ ?>
<option value="<?php echo $row['id_coc_class']; ?>"> <?php echo $row['coc_class']; ?> </option>
<?php } ?>