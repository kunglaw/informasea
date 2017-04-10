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
$id_perusahaan = $this->session->userdata("id_perusahaan");
?>

<?php
if(!empty($vacantsea)) {
    // print_r($this->session->all_userdata());
    foreach ($vacantsea as $row):
        $sallary = "";
        if(!empty($row["annual_sallary"])){
            if(!empty($id_user) || !empty($id_perusahaan)){
                if($id_perusahaan == $row['id_perusahaan']) 
				{
				
					//sallary = $row['sallary_curr']." ".number_format($row["annual_sallary"]);
				
					$smt = explode(" - ",$row["annual_sallary"]);
					
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
            }
            else{
                $sallary = $this->lang->line("please_login");
            }
        }
        else $sallary = $row['sallary_curr']." 0";

        $vacantsea_id       = $row['vacantsea_id'];
        $class_text         = !empty($id_user) ? "text-success" : "text-danger";
        $annual_sallary     = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>" . "<b style='color:#5cb85c'>" . $row['sallary_curr'] . " " . number_format($row['annual_sallary']) . "</b>" : "";
        $rank               = $this->rank_model->get_rank_detail($row['rank_id']);
        $user_pelaut        = $this->session->userdata("username");
        $nationality        = $this->nation_model->get_detail_nationality($row['id_nationality']);
        $flag_nationality   = strtolower($nationality['flag']);
        $jml_applicant      = $this->vacantsea_model->jml_applicant($row['vacantsea_id'], $id_user);
        $jml_applicant      = $jml_applicant == 0 ? "" : " $jml_applicant ".$this->lang->line("applicant");
        $check_applicant    = $this->vacantsea_model->check_applicant($row['vacantsea_id']);
        $already_applied    = !empty($check_applicant) ? true:false;
        if(!empty($row["id_perusahaan"]))
		{
        	$detail_comp        = $this->company_model->get_detail_company($row["id_perusahaan"]) ;
		}
		else
		{
			$detail_comp        = json_decode($row["data_scrap"],TRUE);
		}
        $username_comp      = $detail_comp["username"];
         $cov = $this->vacantsea_model->get_photo_company($username_comp);
		
		$view 	  	   	   = $this->vacantsea_model->vacantsea_view($row["vacantsea_id"]);
		$total_view		 = count($view);
		
        //logo company 
        $logo_company       = check_logo_agentsea_thumb($username_comp);

        //cek status 
        $cek_status         = $this->vacantsea_model->GetApplicant("where id_vacantsea='$vacantsea_id' AND username='$user_pelaut'")->row_array();
        $mess_applicant     = $cek_status['message'];
        $mess_hire          = $this->lang->line("congratulation")." !!";
       

    $a = array(".","(",")"," ");    

    $title = str_replace($a,'-',$row['vacantsea']);
            if(!file_exists("../infrasset/company/photo/$username_comp/logo/$logo_img"))
        {
            $path_img = asset_url("img/img_default.png");
        }
        $now                = date('Y-m-d');

        // echo $row['id_perusahaan']." = ".$id_perusahaan."<br>";
        $style = "";
        if($id_perusahaan != $row['id_perusahaan']) $style = "background-color: #F3F4F5";
        ?>
    
       <div class="col-md-<?php echo $col; ?> seatizen-item-container" style="<?php echo $style ?>">
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="min-height:300px;">
                <div class="media-left text-center">
                    <img src="<?=$logo_company ?>" alt="" id="img-profile-company" class="logo-container thumbnail block "
                         style="border:1px solid #CCC" height="54" width="102"/>
                
                    <div class="text-gray applicants ft-12"><small>
                       <?php if($this->session->userdata('id_perusahaan') == $row['id_perusahaan']) { ?>
                       
                        <a href="http://agent.informasea.com/hire_crew/applicant_list/<?=$vacantsea_id;?>" target="_blank"><?=$jml_applicant ?></a>
                    	<center><span class="applicants ft-12"><small><?= $total_view ?> <?=$this->lang->line("views")?> </small></span></center>
                        
                        <?php } else { 
						
                        ?>
                			<a href="#">  <?=$jml_applicant; ?> </a>
                            <center><span class="applicants ft-12"><small><?= $total_view ?> <?=$this->lang->line("views")?> </small></span></center>
                		<?php
                        }?>
                    </small>


                </div>



                </div>
                <div class="media-body">
                     <a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]); ?>" class="subtitle text-link">
                        <h4 class="custom-h4"><?= $row["vacantsea"] ?></h4>
                    </a>
                     <div class="float-left media-heading medium">
                        <?php if(!empty($row["id_perusahaan"])){ ?>
                        <a href="<?=base_url("agentsea/".$username_comp."/home");?>" class="text-link"><small>
						<?= $detail_comp["nama_perusahaan"] ?></small></a>
                        <?php }else{ ?>
                        	
                            <?= $detail_comp["company"] ?>
                        	
                        <?php } ?>
                        
                        <?php if($row["admin_post"] >= 1) echo "&nbsp; <small class='text-gray subtitle'> (".$this->lang->line("posted_by")." : Informasea.com) </small> "; ?>
                    </div>
                   <!--  <div class="float-right subtitle text-gray">
                        Posted: <?//= date_format_simple($row['create_date']); ?>
                    </div> -->
                    <div style="clear: both"></div>
                    <?php if($row['navigation_area'] != "") { ?>
                    <div class="subtitle text-gray" >Navigation Area : <?=$row['navigation_area'];?></div>
                    <?php } ?>
                    <div class="subtitle custom-h4">Rank : <?= $rank["rank"] ?></div>
                    <div class="subtitle text-gray"><?=$this->lang->line("salary")?> :</div>
                    <!-- <h4 class="<?php //echo $class_text ?> custom-h4"><?//= $sallary ?></h4> -->
                    <h7 class="text-danger custom-h7"><?= $sallary ?></h7>
                    <div class="subtitle text-gray">&nbsp;</div>
                   <!--  <div class="subtitle text-gray">Descripton:</div>
                    <div style="float:left; width:80%"><p><?=$row['description'];?></p></div> -->

                    <div class="subtitle text-gray"> <?=$this->lang->line("dynamic_contract")?> </div>
                    <div style="float:left;width:80%;"> <p> <?=$row['contract_dynamic']; ?> </p> </div>
                    <div style="clear:both"> </div>
                    <div class="subtitle"> 
                       <div class="text-muted pull-left"> <?=$this->lang->line("posted") ?>:
 <?php $a = date('F d, Y', strtotime($row['create_date']));

                       $b = explode(" ",$a);
                       if($b[0] != "march"){
        $b[0] =                         substr($b[0],0,3);
                       }

                    echo $b[0]." ".$b[1]." ".$b[2];

                    ?>
                        </div> 
                            <?php
                            $d1     = strtotime($row['expired_date']);
                            $end    = ceil(($d1-time())/60/60/24);
                            if ($end > "3") {
                                if ($end > 1 && $end <=7) {
                                    $expired    = $end;
                                   echo "<div class='text-muted pull-right' title='".$expired_date."'> ".
								   $this->lang->line("end")
								   ." ".$this->lang->line("days_left")." : <b>".$expired." ".
								   $this->lang->line("days_left")."</b> </div>";
                                }elseif ($end > 7 && $end <= 31) {
                                    $expired    = $end/7;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-right' title='".$expired_date."'>End : <b>".$expired." ".
									$this->lang->line("weeks_left")." </b> </div>";
                                }elseif ($end > 31 && $end <=365 ) {
                                    $expired    = $end/31;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-right' title='".$expired_date."'>End : <b>".$expired." ".
									$this->lang->line("days_left")." </b> </div>";
                                }elseif ($end > 365 ) {
                                    $expired    = $end/365;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-right' title='".$expired_date."'>End : <b>".$expired." Year Left</b> </div>";

                                }
                                
                            }elseif($end == "0"){
                                echo "<div class='text-danger pull-right' title='".$expired_date."'>End : <b>Today Left</b> </div>";
                            }else{
                                echo "<div class='text-danger pull-right' title='".$expired_date."'>End : <b>Expired </b> </div>";
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
            <h2 class="text-gray">Not Found</h2>
        </div>
    </div>
<?php
}
?>