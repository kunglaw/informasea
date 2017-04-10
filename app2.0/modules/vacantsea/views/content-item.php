<?php
/**
 * Created by PhpStorm.
 * User: Mohamad
 * Date: 5/7/2015
 * Time: 10:09 AM
 */

$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$id_user = $this->session->userdata("id_user");
?>

<?php


if(!empty($vacantsea)) {
    foreach ($vacantsea as $row):
	 
	  
        if(!empty($row["annual_sallary"])){
			
			$smt = explode(" - ",$row["annual_sallary"]);
			
			//print_r($smt);
			
			if(count($smt) == 1)
			{
            	$sallary = !empty($id_user) ? $row['sallary_curr']." ".number_format($row["annual_sallary"])." $row[sallary_range] " 
				: $this->lang->line("please_login");
			}
			else
			{
				$sallary = !empty($id_user) ? $row['sallary_curr']." ".number_format($smt[0])." - ".
				number_format($smt[1]).
				" $row[sallary_range] " 
				: $this->lang->line("please_login");	
			}
        }
		else 
		{
			$sallary = !empty($id_user) ? $this->lang->line("negotiable") : $this->lang->line("please_login");
				
		}

        $vacantsea_id       = $row['vacantsea_id'];
        $class_text         = !empty($id_user) ? "text-success" : "text-danger";
        $annual_sallary     = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>" . "<b style='color:#5cb85c'>" . $row['sallary_curr'] . " " . number_format($row['annual_sallary']) . " / $row[sallary_range] </b>" : "";
        $rank               = $this->rank_model->get_rank_detail($row['rank_id']);
        $user_pelaut        = $this->session->userdata("username");
        $nationality        = $this->nation_model->get_detail_nationality($row['id_nationality']);
        $flag_nationality   = strtolower($nationality['flag']);
        
		$jml_applicant      = $this->vacantsea_model->jml_applicant($row['vacantsea_id'], $id_user);
        $jml_applicant      = $jml_applicant == 0 ? "" : " $jml_applicant ".$this->lang->line("applicant");
	
		$view 	  	   	   = $this->vacantsea_model->vacantsea_view($row["vacantsea_id"]);
		$total_view		 = count($view);
		
        $check_applicant    = $this->vacantsea_model->check_applicant($row['vacantsea_id']);
        $already_applied    = !empty($check_applicant) ? true:false;
		
		if($row["id_perusahaan"] != 0)
		{
        	$detail_comp        = $this->company_model->get_detail_company($row["id_perusahaan"]) ;
		}
		else
		{
			$detail_comp        = json_decode($row["data_scrap"],TRUE);
		}
		
        $username_comp      = $detail_comp["username"];
        
        //logo company
        
        $logo_company       =  check_logo_agentsea_thumb($username_comp);
        

        //cek status applicant
        $cek_status         = $this->vacantsea_model->GetApplicant("where id_vacantsea='$vacantsea_id' AND username='$user_pelaut'")->row_array();
        $mess_applicant     = $cek_status['message'];
        $mess_hire          = $this->lang->line("congratulation")." !!";
       

		$a = array(".","(",")"," ");	

		$title = str_replace($a,'-',$row['vacantsea']);
   
		// 	if(!file_exists("../infrasset/company/photo/$username_comp/profil_pic/$logo_img"))
		// {
		// 	//$path_img = asset_url("img/img_default.png");
  //           $path_img = asset_url("img/ic_landing_company_blue.svg");
		// }
		
        $now                = date('Y-m-d');
       
        ?>
    
       		<div class="col-md-<?php echo $col; ?> seatizen-item-container">
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="height:300px;">
    			
                <div class="media-left text-center">
                    <img src="<?=$logo_company ?>" alt="" id="img-profile-company" class="logo-container thumbnail block "
                         style="border:1px solid #CCC" height="54" width="102"/>
                    <input type="hidden" id="url-data" value="<?=$row["vacantsea_id"]?>&<?=replace_disallowed_char($row['vacantsea'])?>">
                    <?php 
                    	if($cek_status['status'] == "Approved"){
                            echo "<button type='button' class='btn btn-full btn-info' data-toggle='tooltip' data-placement='bottom' title='".$mess_applicant."'>
                            <i class='glyphicon glyphicon-ok'></i>".$this->lang->line("approved")."</button>";

                        }else if($cek_status['status'] == "Rejected"){
                            echo "<button type='button' class='btn btn-full btn-danger' data-toggle='tooltip' data-placement='bottom' title='".$mess_applicant."'>
                            <i class='glyphicon glyphicon-remove'></i> ".$this->lang->line("rejected")."</button>";

                        }else if ($cek_status['status'] == "Hire") {
                            echo "<button type='button' class='btn btn-full btn-success' data-toggle='tooltip' data-placement='bottom' title='".$mess_hire."'>
                            ".$this->lang->line("hired")."</button>";

                        }else if($already_applied) {
                            echo "<div class='text-success applicants ft-12'><small>".$this->lang->line("has_apply")."</small></div>";

                        }else{ 
                        if ($now > $row['expired_date']) {
                            echo "<button type='button' class='btn btn-full' data-container='body' data-toggle='popover' data-placement='bottom' data-content='Sorry, Vacantsea Expired'>".$this->lang->line("expired")."</button> ";
                        }else{
                        ?>
                      <!-- <a href="#" onclick="document.getElementById('url-data').value = '<?php echo $row['vacantsea_id']."&".$row['vacantsea']?>'" class="btn btn-filled btn-full block apply-vacant-button">
                            Apply
                        </a> -->
                        <?php 
                        if($this->session->userdata('id_user') == ""){ ?>
                        
                        	<a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]."/".replace_disallowed_char($row['vacantsea'])); ?>" 
                                class="btn btn-filled btn-full block">  <?=$this->lang->line("apply")?>
                                
                            </a>
                        
                       <?php  }else{?> 


							<a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]."/".replace_disallowed_char($row['vacantsea'])); ?>" 
                            class="btn btn-filled btn-full block">  <?=$this->lang->line("apply")?>
                            
                        </a>
                        <?php }
                        }
                    }
                        ?>
                    <span class="text-gray applicants ft-12"><small><a href="#"><?= $jml_applicant ?> </a></small></span>
                    <center><span class="applicants ft-12"><small><?= $total_view ?> <?=$this->lang->line("views")?> </small></span></center>
                </div>
                
                <div class="media-body">
                    <a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]."/".replace_disallowed_char($row['vacantsea'])); ?>" class="subtitle text-link">
                        <h4 class="custom-h4"><?= $row["vacantsea"] ?></h4>
                    </a>
                    <div class="float-left media-heading medium">
                    	<?php if($row["id_perusahaan"] != 0){ ?>
                        <a href="<?=base_url("agentsea/".$username_comp."/home");?>" class="text-link"><small>
						<?= $detail_comp["nama_perusahaan"] ?></small></a>
                        <?php }else{ ?>
                        	
                            <?= $detail_comp["company"] ?>
                        	
                        <?php } ?>
                        
                        <?php if($row["admin_post"] >= 1) echo "&nbsp; <small class='text-gray subtitle'> (".$this->lang->line("posted_by")." : Informasea.com) </small>"; ?>
                    </div>
                   <!--  <div class="float-right subtitle text-gray">
                        Posted: <?//= date_format_simple($row['create_date']); ?>
                    </div> -->
                    <div style="clear: both"></div> 
                    <?php if($row['navigation_area'] != ""){ ?> 

                    <div class="subtitle text-gray" ><?=$this->lang->line("navigation_area")?> : <?=$row['navigation_area'];?></div>

                    <?php } ?>
                    <div class="subtitle custom-h4">Rank : <?= $rank["rank"] ?></div>
                    <div class="subtitle text-gray"><?=$this->lang->line("salary")?> :</div>
                    <!-- <h4 class="<?php //echo $class_text ?> custom-h4"><?//= $sallary ?></h4> -->
                    <h7 class="text-danger custom-h7"><?= $sallary ?></h7>
                     <div class="subtitle text-gray"> <?=$this->lang->line("contract_type")?> </div>
                    <div style="float:left;width:80%;"> <p> <?=$row['contract_dynamic']; ?> </p> </div>
                    <div class="subtitle text-gray">&nbsp;</div><!-- 
                    <div class="subtitle text-gray">Descripton:</div>
                    <div style="float:left; width:80%"><p><?=$row['description'];?></p></div> -->
                    <br>
                    <br>
                    <div class="subtitle"> 
                       <div class="text-muted pull-left"> <?=$this->lang->line("posted")?>:<?php $a = date('F d, Y', strtotime($row['create_date']));

                       $b = explode(" ",$a);
                       if($b[0] != "march"){
        					$b[0] = substr($b[0],0,3);
                       }

                    echo $b[0]." ".$b[1]." ".$b[2];


                       ?></div> 
                            <?php
                            $d1     = strtotime($row['expired_date']);
                            $end    = ceil(($d1-time())/60/60/24);
                            if ($end > 0) { //sebelumnya > 3
                                if ($end >= 1 && $end <=7) {
                                    $expired    = $end;
                                   echo "<div class='text-muted pull-right' title='".$expired_date."'>".$this->lang->line("end")." : <b>"
								   .$expired." ".$this->lang->line("days_left")."</b> </div>";
                                }elseif ($end > 7 && $end <= 31) {
                                    $expired    = $end/7;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-right' title='".$expired_date."'>".$this->lang->line("end")." : <b>"
									.$expired." ".$this->lang->line("weeks_left")."</b> </div>";
                                }elseif ($end > 31 && $end <=365 ) {
                                    $expired    = $end/31;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-right' title='".$expired_date."'>".$this->lang->line("end")." : <b>"
									.$expired." ".$this->lang->line("month_left")."</b> </div>";
                                }elseif ($end > 365 ) {
                                    $expired    = $end/365;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-right' title='".$expired_date."'>".$this->lang->line("end")." : <b>"
									.$expired." ".$this->lang->line("year_left")."</b> </div>";

                                }
                                
                            }elseif($end == "0"){
                                echo "<div class='text-danger pull-right' title='".$expired_date."'>".$this->lang->line("end")." : <b>
								".$this->lang->line("today")."</b> </div>";
                            }else{
                                echo "<div class='text-danger pull-right' title='".$expired_date."'>".$this->lang->line("end")." : <b>".
								$this->lang->line("expired")
								." </b> </div>";
                            }?>    

                    </div>
                </div>
            </div>
        </div>
    	<?php
		 
		 
    endforeach;
}else { ?>
    <div class="list-group-item">
        <div class="media">
            <h2 class="text-gray"><?=$this->lang->line("not_found")?></h2>
        </div>
    </div>
<?php
}
?>

<script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

</script>