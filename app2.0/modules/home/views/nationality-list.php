<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 03/07/2015
 * Time: 20:11
 */
?>

    <option value="0">Nationalities</option>
<?php
foreach($list_nationality as $row):
    ?>
    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
<?php endforeach; ?>