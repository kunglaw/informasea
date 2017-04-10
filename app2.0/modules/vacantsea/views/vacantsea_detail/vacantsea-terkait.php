<?php
      
if(count($vacantsea_terkait) != 0){ 
	
	$ship_type_text = "";
	if(!empty($ship_type["ship_type"]))
	{
		$ship_type_text = "or <i> $ship_type[ship_type] </i>";	
	}

?>
	  <h3> <?=$this->lang->line("related_vacantsea")?> : <i> <?php echo $rank["rank"]?> </i><?=" $ship_type_text" ?> </h3>

<div class="row">
	<br>
<?php foreach($vacantsea_terkait as $row) {

	$rank          = $this->rank_model->get_rank_detail($row["rank_id"]);
	$ship_type    = $this->ship_model->get_ships_type($row["ship_type"]);

	$now = date('Y-m-d');
	$vacantsea_id = $row['vacantsea_id'];
	$check_applicant    = $this->vacantsea_model->check_applicant($row['vacantsea_id']);
	$already_applied    = !empty($check_applicant) ? true:false;
	$cek_status         = $this->vacantsea_model->GetApplicant("where id_vacantsea='$vacantsea_id' AND username='$user_pelaut'")->row_array();

 ?>

  <div class="col-md-3">
<div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="height:180px;margin-bottom:25px;">
	   
		<div class="media-body">
           <a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]."/".replace_disallowed_char($row['vacantsea'])); ?>" 
           class="subtitle text-link">
				<h4 class="custom-h4" data-toggle="tooltip" data-placement="top" title="<?=$row["vacantsea"]?>">
				<?=substr($row["vacantsea"],0,20);?>..</h4>
			</a>
			<div class="float-left media-heading medium">
				<a href="<?=base_url("agentsea/".$username_comp."/home");?>" class="text-link"><small>
				<?= $detail_comp["nama_perusahaan"] ?></small></a>
			</div>
		   <!--  <div class="float-right subtitle text-gray">
				Posted: <?//= date_format_simple($row['create_date']); ?>
			</div> -->
			<div style="clear: both"></div> 
			<?php if($row['navigation_area'] != ""){ ?> 

<!--                     <div class="subtitle text-gray" >Navigation Area : <?php // echo $row['navigation_area'];?></div>
-->
			<?php } ?>
			<div class="subtitle custom-h4" data-toggle="tooltip" data-placement="top" title="<?=$rank["rank"]?> / <?=$ship_type["ship_type"]?>">
				<?=substr($rank["rank"],0,8) ?>... / <?=substr($ship_type["ship_type"],0,8)?>...
			</div>
			<div class="subtitle text-gray"><?=$this->lang->line("salary")?> :  <span class="text-danger custom-h7">
				<?php echo  $row['sallary_curr']." ".number_format($row["annual_sallary"]); ?> </span>
			</div>
		
			<!-- <h4 class="<?php //echo $class_text ?> custom-h4"><?//= $sallary ?></h4> -->



			<h7 class="text-danger custom-h7">
				
			</h7>
			 <!-- <div class="subtitle text-gray"> Contract dynamic </div>
			<div style="float:left;width:80%;"> <p> <?php //echo $row['contract_dynamic']; ?> </p> </div> 
			<div class="subtitle text-gray">&nbsp;</div><!-- 
			<div class="subtitle text-gray">Descripton:</div>
			<div style="float:left; width:80%"><p><?php// echo $row['description'];?></p></div> -->
		 
			<div class="subtitle"> 
			   <div class="text-muted pull-right"><?php //$a = date('F d, Y', strtotime($row['create_date']));

			   $b = explode(" ",$a);
			   if($b[0] != "march"){
					$b[0] = substr($b[0],0,3);
			   }

			echo $b[0]." ".$b[1]." ".$b[2];


			   ?></div> 
					<?php
					$d1     = strtotime($row['expired_date']);
					$end    = ceil(($d1-time())/60/60/24);
					if ($end > "3") {
						if ($end > 1 && $end <=7) {
							$expired    = $end;
						   echo "<div class='text-muted pull-left' title='".$expired_date."'>".
						   $this->lang->line("end")." : <b>".$expired." ".
						   $this->lang->line("days")." ".
						   $this->lang->line("left")."</b> </div>";
						}elseif ($end > 7 && $end <= 31) {
							$expired    = $end/7;
							$expired    = round($expired,0);
							echo "<div class='text-muted pull-left' title='".$expired_date."'>".
							$this->lang->line("end")." : <b>".$expired." ".
						   $this->lang->line("weeks")." ".
						   $this->lang->line("left")."</b> </div>";
						}elseif ($end > 31 && $end <=365 ) {
							$expired    = $end/31;
							$expired    = round($expired,0);
							echo "<div class='text-muted pull-left' title='".$expired_date."'>".
							$this->lang->line("end")." : <b>".$expired." ".
						   $this->lang->line("month")." ".
						   $this->lang->line("left")."</b> </div>";
						}elseif ($end > 365 ) {
							$expired    = $end/365;
							$expired    = round($expired,0);
							echo "<div class='text-muted pull-left' title='".$expired_date."'>".
							$this->lang->line("end")." : <b>".$expired." ".
						   $this->lang->line("year")." ".
						   $this->lang->line("left")."</b> </div>";

						}
						
					}elseif($end == "0"){
						echo "<div class='text-danger pull-left' title='".$expired_date."'>".
						   $this->lang->line("end")." : <b>Today Left</b> </div>";
					}else{
						echo "<div class='text-danger pull-left' title='".$expired_date."'>".
						   $this->lang->line("end")." : <b>Expired </b> </div>";
					}?>    
			</div>
		</div>
	</div>
</div>

<?php } ?>

</div>
<?php } ?>