<?php

/**

 * Created by PhpStorm.

 * User: a

 * Date: 03/07/2015

 * Time: 19:48

 */

?>



<option value="0"><?=$this->lang->line("vessel_type")?></option>

<?php

    foreach($list_vessel as $row):

?>

    <option value="<?php echo $row['type_id'] ?>"><?php echo $row['ship_type'] ?></option>

<?php endforeach; ?>