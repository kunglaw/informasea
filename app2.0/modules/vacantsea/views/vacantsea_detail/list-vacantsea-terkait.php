<?php
	if(count($vacantsea_terkait) != 0){ 
	
		$ship_type_text = "";
		if(!empty($ship_type["ship_type"]))
		{
			$ship_type_text = "or <i> $ship_type[ship_type] </i>";	
		}

?>
<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4> <?=$this->lang->line("related_vacantsea")?> : <i> <?php echo $rank["rank"]?> </i><?=" $ship_type_text" ?> </h4>
  </a>
  <?php
		foreach($vacantsea_terkait as $row) {
	
		$rank          = $this->rank_model->get_rank_detail($row["rank_id"]);
		$ship_type    = $this->ship_model->get_ships_type($row["ship_type"]);
	
		$now = date('Y-m-d');
		$vacantsea_id = $row['vacantsea_id'];
		$check_applicant    = $this->vacantsea_model->check_applicant($row['vacantsea_id']);
		$already_applied    = !empty($check_applicant) ? true:false;
		$cek_status         = $this->vacantsea_model->GetApplicant("where id_vacantsea='$vacantsea_id' AND username='$user_pelaut'")->row_array();
  
  ?>
          <a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]."/".replace_disallowed_char($row['vacantsea'])); ?>" target="_blank" class="list-group-item">
              <span class="custom-h4" data-toggle="tooltip" data-placement="top" title="<?=$row["vacantsea"]?>">
                 <?=$row["vacantsea"];?> / <?php echo !empty($ship_type["ship_type"]) ? $ship_type["ship_type"] : "none"?> /  <?=$vacantsea["perusahaan"] ?>
              </span>
             
          </a>
  <?php
		}
	}
  ?>
</div>