<?php // new email activation code for agentsea ?>
<!-- 
bg-primary : #337AB7
bg-success: #DFF0D8
bg-info   : #D9EDF7
bg-warning : #FCF8E3
bg-danger: #F2DEDE
-->

<div style="
margin:0 auto;  
padding:0; 
font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; 
width:80%;
font-size:14px; 
border:1px solid black; ">
  
    <div style="
    background-color:#2ab8e7; 
    height:100px;
    margin-top:0px;
    padding:20px 20px 0px 20px;
    display:block;
    " >
      <!-- header -->
        <div style="clear:both"></div>
        <center>
          <a href="<?=base_url()?>" style="text-decoration:none;display:block; "> 
              <img src="<?=LOGO_INFORMASEA_BIG?>" alt="informasea" style="line-height:100px" 
              title="<?=TITLE." - ".INFORMASEA_SLOGAN?>" >
              <!-- <h1 style="color:#FFF; font-size:48px"><?=TITLE?></h1>--> 
          </a>
          <div style="color:#FFF; display:block; "><?=INFORMASEA_SLOGAN?></div>
        </center>
    </div>
    
    <div style="min-height:200px;
    padding:10px 20px 10px 20px;
    ">
      <!-- body -->
        <center> <h2 style="font-size:36px; color:#337AB7"> Pekerjaan yang mungkin cocok untuk anda </h2> </center>
        
        <?php /*
        <div style="line-height:20px">




          <!-- text -->
          <div> <h2> Informasea helps you to find your preferable vacantsea based on your qualification and expectation .</h2> 
            
            <ul style="line-height:20px; font-weight:bold">
              <li> build your network from our seafarers and company database </li>
                <li> complete your resume to make yourself noticeable by agentsea </li>
                <li> aplly any preferable vacantsea </li>
                <li> promote yourself to impress agentsea </li>
            </ul>
            
            </div>
          
        </div>
        
        <center>
        <a href="<?=$str_url?>" style="text-decoration:none">
          <div style="
              background-color:#337AB7;
              width:250px;
              height:50px;
              line-height:50px; 
              margin-top:50px;
              margin-bottom:50px;
          ">
              <!-- button --> 
              <h2 style="color:#FFF; vertical-align:middle">Activate Account</h2>    
          
          </div>
        </a>
        </center>
        
        <!-- info -->
        <div>
          <div>Have fun on board.</div>
            <div><b style="color:#337AB7">Informasea</b> team, </div>
            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b>
            
            <p>This Email was sent to <b><?=$email_to?></b> from 
            <b><a href="mailto:<?=$config["smtp_user"]?>" style="text-decoration:none"><?=$config["smtp_user"]?></a></b> 
            in accordance with 
            <a href="<?=base_url("our_policy")?>" style="text-decoration:none">our policy</a> </p>
            
            <p>* please, do not reply any kind of message to this email </p>
        </div>
            */ ?>
        <?php 
            $this->load->model('rank_model');
          $this->load->model('vacantsea/vacantsea_model'); 
          $this->load->model('company/company_model'); 

          foreach($vacantsea as $row){  

            $vacantsea_id       = $row['vacantsea_id'];
        $class_text         = !empty($id_user) ? "text-success" : "text-danger";
        $annual_sallary     = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>" . "<b style='color:#5cb85c'>" . $row['sallary_curr'] . " " . number_format($row['annual_sallary']) . "</b>" : "";
        $rank               = $this->rank_model->get_rank_detail($row['rank_id']);
        $user_pelaut        = $this->session->userdata("username");
        $nationality        = $this->nation_model->get_detail_nationality($row['id_nationality']);
        $flag_nationality   = strtolower($nationality['flag']);
        $jml_applicant      = $this->vacantsea_model->jml_applicant($row['vacantsea_id']);
        $jml_applicant      = $jml_applicant == 0 ? "" : " $jml_applicant applicant";
        $check_applicant    = $this->vacantsea_model->check_applicant($row['vacantsea_id']);
        $already_applied    = !empty($check_applicant) ? true:false;

        $detail_comp        = $this->company_model->get_detail_company($row["id_perusahaan"]);
        $username_comp      = $detail_comp["username"];
        
        //logo company
        
        $logo_company       = $this->authentification_model->cek_logo_company($username_comp);

            ?>


               <div style="width:48%;float:left;margin-right:5px;margin-bottom:10px;border:1px solid;min-height:300px;">
          <div style="clear:both;"> </div>
        <div style="width:95%;margin:0 auto;">
                <div style="float:left;width:30%;padding:5px;">
                  <br>
                  <br>
                    <img src="<?=$logo_company ?>" alt="" id="img-profile-company" class="logo-container thumbnail block "
                         style="border:1px solid #CCC" height="54" width="102"/>
                    <input type="hidden" id="url-data" value="">
                <button href="http://informasea.com/vacantsea/" style="background:none;background:#2ab8e7;border:none; width:100%;padding:5px;color:white;">Apply</button>



                </div>
                <div style="float:right;width:62%;">
                        <h4 class="custom-h4" style="color:#2ab8e7"><?= $row["vacantsea"] ?></h4>
                    <div class="float-left media-heading medium">
                        <a href="<?=base_url("agentsea/".$username_comp."/home");?>" class="text-link" style="color:#2ab8e7;"><small><?= $detail_comp["nama_perusahaan"] ?></small></a>
                    </div>
                   <!--  <div class="float-right subtitle text-gray">
                        Posted: <?//= date_format_simple($row['create_date']); ?>
                    </div> -->
                                        <div class="subtitle custom-h4">Rank : <?= $rank["rank"] ?></div>

                    <div style="clear: both"></div> 
                    <?php if($row['navigation_area'] != ""){ ?> 
                    <div class="subtitle text-gray" >Navigation Area : <?=$row['navigation_area'];?></div>
                    <?php } ?>
                    <div class="subtitle text-gray">Annual Salary :</div>
                    <!-- <h4 class="<?php //echo $class_text ?> custom-h4"><?//= $sallary ?></h4> -->
                    <h7 class="text-danger custom-h7" style="color:red;"><?=$sallary ?></h7>
                                        <div class="subtitle text-gray"> Contract dynamic </div>

                                        <div style="float:left;width:80%;"> <p> <?=$row['contract_dynamic']; ?> </p> </div>


      <!-- 


                    <div class="subtitle text-gray">Descripton:</div>
                    <div style="float:left; width:80%"><p><?=$row['description'];?></p></div> -->
                </div>
              </div>

        </div>
            


          <?php }



          ?>
        
    
    </div>
    <div style="background-color:#CCC; height:30px; line-height:30px;
    padding:10px 20px 10px 20px; display:block">
      <!-- footer -->
     
        <b style="float:left"> <a href="<?=base_url("about")?>" style="text-decoration:none"> About </a> </b>
        <span style="float:right"> copyright @ 2014 - <?=WEBSITE?> . All right reserved </span>
        
        
    </div>
  
</div>