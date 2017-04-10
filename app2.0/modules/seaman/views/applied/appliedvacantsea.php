<div class="tmp_modal"> <?php // for ajax ?> 

</div>


<?php 



  $username = $this->session->userdata('username');
  $username_perusahaan = $this->session->userdata('username_company'); 
  if($this->uri->segment(2) != $username){
    header('location:'.base_url('profile/'.$this->uri->segment(2).'/resume'));
  }

$jmlh_applied = $this->vacantsea_model->jml_applied($this->session->userdata('id_user'));
?>
<div class="box">
  <div class="box-header">
      <h4 class="box-heading header-text"> <?=$this->lang->line("applied_vacantsea")?> (<?php echo $jmlh_applied; ?>) </h4>
      <span class="clearfix"></span>
  </div>
  
 <!--  <div class="box-content">
    <div class="jajamama"></div> -->
    <?php

$this->load->model('nation_model');
$this->load->model('company/company_model');

      if(!empty($vacantsea)){
        foreach($vacantsea as $vac){
          $vacantsea = $this->vacantsea_model->get_vacantsea_id($vac['id_vacantsea']);

           $vacantsea_id   = $vacantsea['vacantsea_id'];
    $vacantsea_title      = $vacantsea['vacantsea'];
    $perusahaan     = $vacantsea['perusahaan'];
    $description    = $vacantsea['description'];
    $departement_id = $vacantsea['departement'];
    $rank_id        = $vacantsea['rank_id'];
    $ship_id        = $vacantsea['ship_type'];
    $navigation_area    = $vacantsea['navigation_area'];
    $annual_sallary     = $vacantsea['annual_sallary'];
    $contract_type      = $vacantsea['contract_type'];
    $contract_dinamic   = $vacantsea['contract_dinamic'];
    $ship               = $vacantsea['ship'];
    $requested_certificates   = $vacantsea['requested_certificates'];
    $requested_coc      = $vacantsea['requested_coc'];
    $nationality_id     = $vacantsea['id_nationality'];
    $create_date        = $vacantsea['create_date'];
    $expired_date       = $vacantsea['expired_date'];
    $benefits           = $vacantsea['benefits'];
    $sallary_range      = $vacantsea['sallary_range'];
    $sallary_curr       = $vacantsea['sallary_curr'];
    $experience         = $vacantsea['experience'];
    //$logo               = img_url("company/default/maersk_logo.jpg");

    $placement          = $this->nation_model->get_detail_nationality($nationality_id);
    $company 			= $this->company_model->get_detail_company($vacantsea['id_perusahaan']);
    $logo_img 		   = $company['logo_image'];
    $rank 			   = $this->rank_model->get_rank_detail($vacantsea['rank_id']);
    $username_comp 	  = $company['username'];
   
    $flag_placement     = strtolower($placement['flag']);

    //cek status vacantsea : process, reject, approve
    $q_applicant        = $this->company_model->getapplicant("where id_vacantsea='$vacantsea_id' and username='$username' ")->row_array();
    $status_applicant   = $q_applicant['status'];
    $mess_applicant     = $q_applicant['message'];
    $mess_hire          = "Congratulation !! ";

    //get logo company 
    $logo_company       = check_logo_agentsea_thumb($username_comp);
    ?>
   <div class="list-group-item">
    <div class="media">
        <div class="media-left text-center">
            <img src="<?=$logo_company;?>" alt="company logo"
            class="logo-container thumbnail block " width="115" height="115">
            <?php
              $now    = date("Y-m-d");
              if ($status_applicant == "Approved") {
                echo "<button type='button' class='btn btn-lg btn-info' data-toggle='tooltip' data-placement='bottom' title='".$mess_applicant."'>
                <i class='glyphicon glyphicon-ok'></i> Approved</button>";

              }elseif ($status_applicant == "Rejected") {
                echo "<button type='button' class='btn btn-full btn-danger' data-toggle='tooltip' data-placement='bottom' title='".$mess_applicant."' >
                <i class='glyphicon glyphicon-remove'></i> Rejected</button>";

              }elseif ($status_applicant == "Hire") {
                echo "<button type='button' class='btn btn-full btn-success' data-toggle='tooltip' data-placement='bottom' title='".$mess_hire."'>
                <i class='glyphicon glyphicon-ok'></i> You are hired</button>";
              
              }elseif ($now > $expired_date) {
                echo "<button type='button' class='btn btn-full btn-default'><b>Expired</b></button>";

              }else{
              ?>
                <button class="btn btn-full btn-warning" onclick="javascript:cancel_apply(<?php echo $vac['id_aplicant']; ?>)"> 
                <i class="fa fa-minus"> </i>  
                <b><?=$this->lang->line("cancel")?> <?=$this->lang->line("apply")?></b></button>
              <?php } ?>
        </div>

        <div class="media-body">
            <a href="<?=base_url("vacantsea/detail/".$vacantsea_id);?>" class="subtitle text-link" target="_blank">
            <h4 class="custom-h4"><?=$vacantsea_title;?></h4></a>
            <div class="float-left media-heading medium">
                <a href="<?=base_url("agentsea/$username_comp/home")?>" class="text-link"><small><?=$perusahaan;?></small></a></div>
            <div class="float:right">
                <?php
              ?>
            </div>

            <div style="clear: both"></div>
            <div class="subtitle text-gray"><?=$this->lang->line("navigation_area")?> : <?=$navigation_area;?></div>
            <div class="subtitle custom-h4">Rank : <?=$rank['rank'];?></div>
            <?php
                if (!empty($annual_sallary)) {
                   echo "<div class='subtitle text-gray'>".$this->lang->line("annual_salary").":</div>";
                   echo "<h4 class='text-link custom-h4'>".$sallary_curr." ".number_format($annual_sallary)."</h4>"; 
                }
            ?>
            <div class="subtitle text-gray"><?=$this->lang->line("description")?>:</div>
            <div style="float:left; width:80%"><p><?=$description;?></p></div>
            <div class="float-right subtitle" style="float:right"> 
               <div class="text-muted"> <?=$this->lang->line("posted")?>: <?php echo date('F d, Y', strtotime($create_date));?></div> 
                    <?php
                    $d1     = strtotime($expired_date);
                    $end    = ceil(($d1-time())/60/60/24);
                    $now    = date("Y-m-d");

                    if ($end > "3") {
                        if ($end > 1 && $end <=7) {
                            $expired    = $end;
                           echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." : <b>".$expired." days left</b> </div>";
                        }elseif ($end > 7 && $end <= 31) {
                            $expired    = $end/7;
                            $expired    = round($expired,0);
                            echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." : <b>".$expired." Week left</b> </div>";
                        }elseif ($end > 31 && $end <=365 ) {
                            $expired    = $end/31;
                            $expired    = round($expired,0);
                            echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." : <b>".$expired." Month left</b> </div>";
                        }elseif ($end > 365 ) {
                            $expired    = $end/365;
                            $expired    = round($expired,0);
                            echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." : <b>".$expired." Year left</b> </div>";

                        }
                        
                    }elseif($end >= "0"){
                        echo "<div class='text-danger' title='".$expired_date."'>".$this->lang->line("end")." : <b>".$end." days left </b> </div>";
                    }else{
                        echo "<div class='text-danger' title='".$expired_date."'>".$this->lang->line("end")." : <b>Expired </b> </div>";
                    }?>    
            </div>
        </div>

    </div>
</div>

   <?php 
      }
?>
<div class="pagination" style="float:right; margin-top:3%">
<ul>
   <?php echo $this->pagination->create_links(); ?>
</ul>
</div>
<?php
      } else{
       echo "No Vacantsea applied ";
      }
      ?>
  <!--  <span class="clearfix"></span> -->
	<!-- </div> -->
</div>

<script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

</script>