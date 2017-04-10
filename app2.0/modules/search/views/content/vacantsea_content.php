<?php
	$this->load->model("rank_model");
	$this->load->model('company/company_model');
	
	$this->load->model("vacantsea/vacantsea_model");
	$this->load->model('nation_model');
	$this->load->helper('text_helper');
	$this->load->helper('date_format_helper');
	$id_user = $this->session->userdata("id_user");
	
	$vacantsea = $this->vacantsea_model->get_vacantsea_id($id);
	$company   = $this->company_model->get_detail_company($vacantsea['id_perusahaan']);
	
	$class_text         = !empty($id_user) ? "text-success" : "text-danger";
	$annual_sallary     = $vacantsea['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>" . "<b style='color:#5cb85c'>" . $vacantsea['sallary_curr'] . " " . number_format($vacantsea['annual_sallary']) . "</b>" : "";
	
	$rank               = $this->rank_model->get_rank_detail($vacantsea['rank_id']);
	$user_pelaut        = $this->session->userdata("username");
	$nationality        = $this->nation_model->get_detail_nationality($vacantsea['id_nationality']);
	$flag_nationality   = strtolower($nationality['flag']);
	
	if(empty($flag_nationality))
	{
		$url_flag = "";	
	}
	else
	{
		$url_flag = "<img src='".asset_url("flags/$flag_nationality")."'>";	
	}
	
	$jml_applicant      = $this->vacantsea_model->jml_applicant($vacantsea['vacantsea_id'], $id_user);
	$jml_applicant      = $jml_applicant == 0 ? "" : " $jml_applicant applicant";
	$check_applicant    = $this->vacantsea_model->check_applicant($vacantsea['vacantsea_id']);
	$already_applied    = !empty($check_applicant) ? true:false;
	$description	    = !empty($vacantsea['description']) ? $vacantsea['description'] : "There is no description";
	
	$username_comp      = $company["username"];
    $logo_img           = $this->company_model->get_logoimage2($username_comp);
	$path_img           = img_url("company/photo/$username_comp/profil_pic/$logo_img");
	$now                = date('Y-m-d');
	
	if(empty($logo_img) || !is_file(pathup("company/photo/$username_comp/profil_pic/$logo_img")))
	{
		$path_img = asset_url("img/ic_landing_company_blue.svg");	
	}
	
	$cek_status         = $this->vacantsea_model->GetApplicant("where id_vacantsea='$vacantsea_id' AND username='$user_pelaut'")->row_array();
?>

<div class="list-group-item">
            <div class="media">
                <div class="media-left text-center">
                    <img src="<?= $path_img ?>" alt="" id="img-profile-company" class="logo-container thumbnail block "
                         style="border:1px solid #CCC" height="54" width="102"/>
                    <input type="hidden" id="url-data" value="">
                    <?php 
	 if($cek_status['status'] == "Approved"){
                        echo "<button type='button' class='btn btn-full btn-success'><i class='glyphicon glyphicon-ok'></i> Approved</button>";

                    }elseif($cek_status['status'] == "Rejected"){
                        echo "<button type='button' class='btn btn-full btn-danger'><i class='glyphicon glyphicon-remove'></i> Rejected</button>";

                    }
		else if($already_applied) { ?>
                        <div class="text-success applicants ft-12"><small>already applied</small></div>
                    <?php }else{ 
                        if ($now > $vacantsea['expired_date']) {
                        echo "<button type='button' class='btn btn-full' data-container='body' data-toggle='popover' data-placement='bottom' data-content='Sorry, Vacantsea Expired'>Apply</button> ";
                        }else{
                        ?>
                      <!-- <a href="#" onclick="document.getElementById('url-data').value = '<?php echo $vacantsea['vacantsea_id']."&".$vacantsea['vacantsea']?>'" class="btn btn-filled btn-full block apply-vacant-button">
                            Apply
                        </a> -->
		<a href="<?=base_url("vacantsea/apply/".$vacantsea['vacantsea_id']."/".$title)?>" class="btn btn-filled btn-full block apply-vacant-button">  Apply
                        </a>
                        <?php
                        }
                    }
                        ?>
                    <div class="text-gray applicants ft-12"><small><a href="#"><?= $jml_applicant ?></a></small></div>
                </div>
                <div class="media-body">
                     <a href="<?= base_url("vacantsea/detail/".$vacantsea["vacantsea_id"]); ?>" class="subtitle text-link">
                        <h4 class="custom-h4"><?= $vacantsea["vacantsea"] ?></h4>
                    </a>
                    <div class="float-left media-heading medium">
                        <a href="<?=base_url("company/".$username_comp."/home");?>" class="text-link"><small><?= $detail_comp["nama_perusahaan"] ?></small></a>
                    </div>
                   <!--  <div class="float-right subtitle text-gray">
                        Posted: <?//= date_format_simple($vacantsea['create_date']); ?>
                    </div> -->
                    <div style="clear: both"></div>
                    <div class="subtitle text-gray" >Placement : <?=$url_flag?> <?= $nationality["name"] ?></div>
                    <div class="subtitle custom-h4">Rank : <?= $rank["rank"] ?></div>
                    <div class="subtitle text-gray">Annual Salary :</div>
                    <h4 class="<?php echo $class_text ?> custom-h4"><?=$sallary ?></h4>
                    <h7 class="text-danger custom-h7"><?= $sallary ?></h7>
                    <div class="subtitle text-gray">&nbsp;</div>
                    <div class="subtitle text-gray">Descripton:</div>
                    <div style="float:left; width:80%"><p><?=$description;?></p></div>
                    <div class="float-right subtitle" style="float:right"> 
                       <div class="text-muted"> Posted: <?php echo date('F d, Y', strtotime($vacantsea['create_date']));?></div> 
                            <?php
                            $d1     = strtotime($vacantsea['expired_date']);
                            $end    = ceil(($d1-time())/60/60/24);
                            if ($end > "3") {
                                if ($end > 1 && $end <=7) {
                                    $expired    = $end;
                                   echo "<div class='text-muted' title='".$expired_date."'>End : <b>".$expired." Days Left</b> </div>";
                                }elseif ($end > 7 && $end <= 31) {
                                    $expired    = $end/7;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted' title='".$expired_date."'>End : <b>".$expired." Weeks Left</b> </div>";
                                }elseif ($end > 31 && $end <=365 ) {
                                    $expired    = $end/31;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted' title='".$expired_date."'>End : <b>".$expired." Month Left</b> </div>";
                                }elseif ($end > 365 ) {
                                    $expired    = $end/365;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted' title='".$expired_date."'>End : <b>".$expired." Year Left</b> </div>";

                                }
                                
                            }elseif($end == "0"){
                                echo "<div class='text-danger' title='".$expired_date."'>End : <b>Today Left</b> </div>";
                            }else{
                                echo "<div class='text-danger' title='".$expired_date."'>End : <b>Expired </b> </div>";
                            }?>    
                    </div>
                </div>
            </div>
        </div>