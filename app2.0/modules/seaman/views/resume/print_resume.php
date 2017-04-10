
<?php
  $profile       = $resume['profile'];
  $pelaut        = $resume['pelaut'];
  $competency    = $resume['competency'];
  $proficiency   = $resume['proficiency'];
  $experience    = $resume['experience'];
  $document      = $resume['document'];
  $medical       = $resume['medical'];
  $visa          = $resume['visa'];
  
  $id_user = $this->session->userdata('id_user');
  $this->load->model('users/user_model');
  $a = $this->user_model->get_detail_pelaut_byid($id_user);
  
?>
<html>
<head>
    <title> Resume  <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang']; ?> </title>
    <link href="<?=asset_url("img/favicon.ico")?>" rel="icon" type="image/x-icon"/>
    <link href="<?=asset_url("img/favicon.ico")?>" rel="icon" type="image/x-icon"/>
    <!--    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/normalize.css")?>" />-->
    <!--    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/font.css")?>" />-->
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/bootstrap.min.css")?>" />
    <!--    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/animate.css")?>" /> -->
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/informasea-kunglaw.css")?>" >
    <link rel="stylesheet" href="<?=asset_url("js/jquery-ui-1.11.4.custom/jquery-ui.min.css")?>" >
    
    
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/font-awesome/css/font-awesome.css")?>" />
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/informasea.css")?>" />
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/utilities.css")?>" />
  

    <!--  <link rel="stylesheet" type="text/css" href="<?=base_url("assets/plugin/plugins/flexslider/flexslider.css")?>" />-->
    <!--    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/full-slider.css")?>"  />-->
    
    <!--[if IE]>
    <script src="<?=base_url("assets/js/html5shiv.min.js")?>" ></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js")?>" ></script>
    <![endif]-->
    <script type="text/javascript" src="<?=asset_url("js/jquery.min.js")?>" ></script>
    <script type="text/javascript" src="<?=asset_url("js/bootstrap.min.js")?>" ></script>
    <script type="text/javascript" src="<?=asset_url("js/jquery-ui-1.11.4.custom/jquery-ui.js")?>"></script>
    <style>
   table {
    width: 100%;
    font-size: 12px;
   }

   table,tr,td {
    border:1px solid black;
    padding:15px;
   }

   .table-bordered{
    border-color:black;
    padding:5px;
   }

   .table-bordered, th, td {
    padding:10px;
   }
    thead {
      border-bottom:2px solid;
    }

    thead, th {
      border:2px solid;
      border-bottom:2px solid;
    }

    td {
      border:2px solid;
    }

    th {
      border-bottom:2px solid;
    }

    tr {
      border:2px solid;
    }

    </style>
</head>

<body onload="window.print()">
  <div class="wrapper">

    <section style="position:relative; border-top:1px solid black;
    padding:5px;margin:0% 5%;">
      <div class="row">
        <div class="col-xs-12">
           <h2>
          Informasea
          <small class="pull-right"><?php $today = getdate(); echo $today['year'] ?></small>
          </h2>
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-xs-12 table-responsive">  
            <h1 class="text-center"><u> CURRICULUM VITAE </u> </h1>
            <table class="table" style="width:100%;border:2px solid;">
                <tr>
                  <td width="35%"> Name / Gender </td>
                  <td width="65%"><b> <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang']; ?> </b> / <?php echo $pelaut['gender']; ?> </td>
                  <td width="100%" rowspan="5" valign="top">
                      <div class="subpic" id="subpic" style="margin-bottom:5px;margin-right:5px;">
					  <?php
                        /* $this->load->model('photo/photo_mdl');
                        $resume_pic = $this->photo_mdl->get_photo_resume();
                        $username = $this->session->userdata('username');
                        if(!empty($resume_pic))
                        {
                            $ss = explode(".",$resume_pic['nama_gambar']);
                            $url = img_url("photo/$username/resume/$ss[0]"."_thumb.".$ss[1]);
                            
                        }
                        else
                        {
                            $url = asset_url("img/img_default.png");
                        }*/
						
						// $url = check_img_resume($pelaut["username"]);
                    ?>       
           <img src="<?=$url?>" alt="ini poto" style="width:113px ; height:151px;">
         </div>
         <div id=""> </div>
       </td>
      </tr>
      <tr>
      <td> Nationality / Status </td>
      <td> <?php echo $pelaut['kebangsaan']." / ".$pelaut['status_perkawinan']; ?> </td>
      </tr>
      <tr>
      <td> Place / Date of Birth </td>
      <td> <?php if($pelaut['tempat_lahir'] != "" AND $pelaut['tanggal_lahir'] != "0000-00-00"){ echo $pelaut['tempat_lahir']." / ".$pelaut['tanggal_lahir'];}

      else { 
        echo "-";
      } ?> </td>
      </tr>
      <tr>
        <td> Height / Weight / Clothes / Shoes Size </td>
        <td> <?=$profile['height']; ?> cm / <?=$profile['weight']; ?> kg / <?=$profile['clothes_size']; ?> / <?=$profile['shoes_size'];?> </td>
      </tr>



     <!--  <tr>
      <td> Religion </td>
      <td> <?php //echo $pelaut['agama']; ?> </td>
      </tr> -->
      <!-- <tr>
        <td> Height/Weight </td>
        <td> <?php //echo $profile['height']; ?> cm / <?php echo $profile['weight']; ?> kg </td>
      </tr>
      <tr>
          <td> Clothes / Shoes size </td>
          <td> <?php //echo $profile['clothes_size']; ?> / <?php echo $profile['shoes_size']; ?> </td>
        </tr> -->
        <tr>
          <td> Email / Phone </td>
          <td> <?php echo $pelaut['email']." / ".$pelaut['handphone']; ?> </td>
        </tr>
        <tr>
          <td> Next of kin / Relationship </td>
          <td colspan="2"> <?php echo $pelaut['keluarga_terdekat']; ?> / <?=$pelaut['hubungan']; ?> </td>
        </tr>
              <tr>
                <td> Next of kin Phone / Email </td>
                <td colspan="2">  </td>
              </tr>
            </table>
          </div>
        </div>
      
      <br>
      <div class="row">
      <div class="col-xs-12 table-responsive">
          <table class="table   display" border="1">
              <tr align="center">
                <th width="24%"> Last Education </th>
                <th> COC Class </th>
                <th> Rank </th>
                <th> Vessel Type </th>
                <th> Expected Sallary </th>
              </tr>
            <tbody>
            <tr>
              <td> <?php echo $profile['last_education']; ?> </td>
              <td><?php $coc = $this->coc_model->get_coc_detail($profile['coc_class']);
                   echo $coc['coc_class']; ?>
              </td>
              <td><?php 
                  $rank = $this->rank_model->get_rank_detail($profile['rank']);
                  $vessel_type = $this->vessel_model->get_ship_type_detail($profile['vessel_type']);
                  echo $rank['rank']; ?>
              </td>
              <td> <?php echo $vessel_type['ship_type']; ?> </td>
              <td> 
                  <span style="font-weight:bold;color:#0C0"> 
                    <?=$profile['exp_sallary_curr']." ".number_format($profile['expected_sallary'])." / ".$profile['sallary_range']?> 
                  </span>
              </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-xs-12 table-responsive">
            <h3> Travel Document </h3>
            <table class="example2 table" border="1">
                <tr align="center">
                  <th width="24%"> Type </th>
                  <th> Number </th>
                  <th> Issued Place </th>
                  <th> Issued Date </th>
                  <th> Expiry Date </th>
                </tr>
              <tbody>
                   <?php foreach($document as $row) {
          if ($row['type_document'] == "document") {
              $date_issued = date_format_str($row['date_issued']);
              $date_expired = date_format_str($row['date_expired']);
      
              // $a = explode("|",$row['type']);
              // $b = implode(" ",$a);
      
      ?>
          <tr>
            <?php 
            if($row['type'] != 'Passport') { ?>
      
            <td><?php echo $row['country']." ".$row['type']; ?></td>
           <?php } else { ?>
           <td> <?php echo $row['type']; ?> </td>
          <?php } ?>
            <td><?php echo $row['number'] ?> </td>
            <td><?php echo $row['place'] ?> </td>
            
            <td><?php echo $date_issued ?></td>
            <td><?php echo $date_expired ?></td>
          </tr>
      <?php   
            } 
        }
      ?>
      	 </tbody>
            </table>
            <br>
            
             <h3> Visa </h3>
             <table class="example2 table  " border="1">
                <tr align="center">
                  <th width="24%;"> Type </th>
                  <th> Number </th>
                  <th> Issued Place </th>
                  <th> Issued Date </th>
                  <th> Expiry Date </th>
                </tr>
               <tbody>
      <?php foreach($visa as $row){ 
      $date_issued = date_format_str($row['date_issued']);
                                  $date_expired = date_format_str($row['date_expired']);
      
      ?>
      <tr>
         <td><?php echo $row['type'] ?></td>
                        <td><?php echo $row['number'] ?> </td>
                        <td><?php echo $row['place'] ?> </td>
      
                        <td><?php echo $date_issued ?></td>
                        <td><?php echo $date_expired ?></td>  
                         </tr>
      <?php } ?>            
      </tbody>
             </table>
             <br>
            
            <h3> Medical Record </h3>
            <table class="example2 table  " border="1">
                <tr align="center">
                  <th width="24%"> Type </th>
                  <th> Number </th>
                  <th> Issued Place </th>
                  <th> Issued Date </th>
                  <th> Expiry Date </th>
                  </tr>
              <tbody>
			  <?php
        
        
              foreach($medical as $row) {
                  if ($row['type_document'] == "medical" || $row['type_document'] == "medical_cert") {
                      $date_issued = date_format_str($row['date_issued']);
                      $date_expired = date_format_str($row['date_expired']);
        
                      ?>
                      <tr>
                          <td><?php echo $row['type'] ?></td>
                          <td><?php echo $row['number'] ?> </td>
                          <td><?php echo $row['place'] ?> </td>
        
                          <td><?php echo $date_issued ?></td>
                          <td><?php echo $date_expired ?></td>
                      </tr>
                      
        
                  <?php
                  }
              }
              ?>
              </tbody>
             </table>
             <br>
             
          </div>
        </div>
      
      
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <h2> COC and Endorsement </h2>
        <table class="table   display" border="1">
        <tr align="center">
        <th width="26%"> Certificate of Competency </th>
        <th> No License </th>
        <th> Issued Place & Issued Date </th>
        <th> Expiry Date </th>
      </tr>
      <tbody>
      <?php
      foreach($competency as $row){
         
         if($row['grade_license'] != "Certificate of Endorsement" && $row['type'] == "coc")
         {
             $e = "UNLIMITED";
         }
         else
         {
             $e = date_format_str($row['expired_date']);
         }
         
      ?>
      <tr>
      <?php $n = ""; if($row['type'] == "cor" OR $row['grade_license'] == "Certificate of Endorsement"){ 
        $n = $row['negara']; } 
        ?>
        <td><?php echo $n." ".$row['grade_license'] ?></td>
        <td>
        
          <?php echo $row['no_license']?></td>
        <!-- <td><?php echo $row['negara']?></td> -->
        <td><?php 
        if($row['place_issued'] != "" AND $row['date_issued'] != "0000-00-00"){
    echo $row['place_issued']." , ".date_format_str($row['date_issued']);
} else if ($row['place_issued'] == "" AND $row['date_issued'] != "0000-00-00"){
  echo $row['date_issued'];
} else if ($row['place_issued'] != "" AND $row['date_issued'] == "0000-00-00"){
  echo $row['place_issued'];
} else {
  echo "";
}
         ?></td>
        <td><?php echo $e; ?></td>
      
      </tr>
      <?php
      }
      ?>
      </tbody>
      </table>
      </div>
      </div>
      
      <div class="row">
      <div class="col-xs-12 table-responsive">
      <h2>  Certificate of Proficiency  </h2>
      <table class="table   display" border="1">
        <tr align="center"> 
          <th width="26%"> Certificate of Proficiency </th>
          <th>  Number </th>
          <th> Issued Place </th>
          <th> Issued Date </th>
          <th> Expiry Date </th>
        </tr>
        <tbody>
      <?php
      foreach($proficiency as $row2)
      {
      ?>
        <tr>
          <td><?php echo $row2['sertifikat_stwc']; ?></td>
          <td>
            <?php echo $row2['no_sertifikat']; ?>
          
          <td><?php echo $row2['place_issue']; ?></td>
          <td><?php echo date_format_str($row2['date_issue']); ?></td>
          <td><?=date_format_str($row2['expired_date']); ?> </td>
         
        </tr>
      
      <?php
      }
      ?>
      </tbody> 
      </table>
      </div>
      </div>
    
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <h2> Sea Service Record </h2>
          <table class="table   display" border="1">
              <tr align="center">
                <th width="26%"> Vessel Name </th>
                <th> Vessel Type </th>
                <th> Size </th>
                <th> Rank </th>
                <th> Company </th>
                <th> Periode </th>
              </tr>
            <tbody>
              <?php
                  $this->load->model("vessel_model");
                  
                  $vessel_model = $this->vessel_model;
              
                  foreach($experience as $row)
                  {
                      //$vessel_name = $vessel_model->get_ship_detail($row['ship_id']);
                      $vessel_type = $vessel_model->get_ship_type_detail($row['ship_type_id']);
                      $rank       = $this->resume_model->get_rank_detail($row['rank_id']);
                      
                      $periode_from = date_format_str($row['periode_from']);
                      $periode_to = date_format_str($row['periode_to']);
                      $create_date = date_format_str($row['datetime']);
                      $last_update = date_format_str($row['last_update']);
                       
              ?>
              <tr data-toggle="popover" data-content="Created: <?php echo $create_date; ?> Updated : <?php echo $last_update; ?> " id="data-update" data-placement="bottom" >
              
                <td ><?php echo $row['ship_name'] ?> </td>
                <td ><?php echo $vessel_type['ship_type'] ?> </td>
                <?php 
                if($row['satuan'] == 'm3'){
                  $satuan = "m&sup3;";
                }else{
                  $satuan = $row['satuan'];
                }
                ?>
                <td ><?php echo $row['weight']."  ".$satuan  ?></td>
                
                <td><?php  echo $rank['rank'] ?> </td>
                
                <td><?php echo $row['company'] ?></td>
                
                <td ><?php echo $periode_from ?> ~ <?php echo $periode_to; ?></td>
               
              </tr>
              <?php
                  }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    
    </section>
    
  </div>

</body>







<?php /*
<body onload="window.print()" style="padding-top:30px;">
<div class="container-resume block" style="width:89%;margin:0 auto;">
    <h2 class="text-center"> Curicullum Vitae </h4>
    <div class="clearfix"></div>
    <div class="bio-resume block" style="border:none;">
        <div class="media">
                <?php
          $this->load->model('photo/photo_mdl');
                    $resume_pic = $this->photo_mdl->get_photo_resume();
                    $username = $this->session->userdata('username');
                    if(!empty($resume_pic))
                    {
                        $ss = explode(".",$resume_pic['nama_gambar']);
                        $url = img_url("photo/$username/resume/$ss[0]"."_thumb.".$ss[1]);
                        
                    }
                    else
                    {
                        $url = asset_url("img/img_default.png");
                    }
                ?>            <div class="media-body"> 
               <img src="<?=$url?>" alt="ini poto" style="float:left;">
              
                        <table style="padding:2px;width:78%;float:right;">
                            <tr>
                                <td style="border-right:0;">Name</td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;"> <strong> <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang']  ?> </strong> </td>
                                <td style="border-right:0;"> Height/Weight </td>
                                <td style="border-left:0;border-right:0">:</td>
                                <td style="border-left:0;">  <?php echo $profile['height']; ?> cm / <?php echo $profile['weight']; ?> kg </td>
                            </tr>
                            <tr>
                                <td style="border-right:0;">Gender</td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;"> <?php echo $pelaut['gender']; ?> </td>
                                <td style="border-right:0"> Clothes/Shoes Size </td>
                                <td style="border-left:0;border-right:0"> : </td>
                                <td style="border-left:0"> <?php echo $profile['clothes_size']; ?> / <?php echo $profile['shoes_size']; ?> </td>
                            </tr>
                            <tr>
                                <td style="border-right:0;">Nationality</td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;"> <?php echo $pelaut['kebangsaan']; ?> </td>
                                <td style="border-right:0"> Address </td>
                                <td style="border-left:0;border-right:0;"> : </td>
                                <td style="border-left:0"> <?php echo $pelaut['alamat']; ?> </td>
                            </tr>
                            <tr>
                                <td style="border-right:0;">Status</td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;"> <?php echo $pelaut['status_perkawinan']; ?> </td>
                                <td style="border-right:0"> Phone/Handphone</td> 
                                <td style="border-left:0;border-right:0"> : </td>
                                <td style="border-left:0"> <?php echo $pelaut['telepon']." / ".$pelaut['handphone']; ?> </td>
                            </tr>
                            <tr>
                                <td style="border-right:0;">Place/Date of Birth</td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;"> <?php echo $pelaut['tempat_lahir']; ?>, <?php echo date_format_str($pelaut['tanggal_lahir']); ?></td>
                                <td style="border-right:0;"> Email </td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;">  <?php echo $pelaut['email']; ?> </td>
                            </tr>
                            <tr>
                                <td style="border-right:0;">Religion</td>
                                <td style="border-left:0;border-right:0;">:</td>
                                <td style="border-left:0;"> <?php echo $pelaut['agama']; ?> </td>
                                <td style="border-right:0"> Next of kin </td>
                                <td style="border-left:0;border-right:0;"> : </td>
                                <td style="border-left:0"> <?php echo $pelaut['keluarga_terdekat']?>  </td>
                            </tr>
                        </table>
                
        </div>
    </div>
  </div>
    
    <div class="clearfix"></div>
    <br>
    <br>
    <table>
        <thead style="background:white;color:black;">
          <th>
              Last Education
          </th>
          <th>
              COC Class
          </th>
          <th>
              Rank
          </th>
          <th>
              Vessel Type
          </th>
          <th>
              Expected Sallary
          </th>
        </thead>
        <tbody>
          <td>
            <?php echo $profile['last_education']?>
          </td>
          <td>
            <?php
                  $coc = $this->coc_model->get_coc_detail($profile['coc_class']);
                  
                  echo $coc['coc_class'];
                
            ?>
          </td>
          <td>
            <?php
                 
              $rank = $this->rank_model->get_rank_detail($profile['rank']);
              $vessel_type = $this->vessel_model->get_ship_type_detail($profile['vessel_type']);
              echo $rank['rank'];
              
            ?>
          </td>
          <td>
            <?php echo $vessel_type['ship_type']; ?>
          </td>
          <td>
            <span style="font-weight:bold;color:#0C0"> 
                <?=$profile['exp_sallary_curr']." ".number_format($profile['expected_sallary'])." / ".$profile['sallary_range']?> 
            </span>
          </td>
        </tbody>
    </table>
    
    <br>
    <br>
    <div class="data-table-document">
        <div ><h3>  Document and Medical Record </h3></div>
        
        <div class="clearfix"></div>    
        
        <h5> Document Record </h5>
        <br />

        
        <table>
            <thead>
            <th>Type</th>
            <th>Number</th>
            <th>Issued Place</th>
            <th>Issued Date</th>
            <th>Expiry Date</th>
            </thead>
            <tbody>
            
            <?php foreach($document as $row) {
                  if ($row['type_document'] == "document") {
                      $date_issued = date_format_str($row['date_issued']);
                      $date_expired = date_format_str($row['date_expired']);

                      // $a = explode("|",$row['type']);
                      // $b = implode(" ",$a);
    
            ?>
                  <tr>
                    <?php 
                    if($row['type'] != 'Passport') { ?>

                    <td><?php echo $row['country']." ".$row['type']; ?></td>
                   <?php } else { ?>
                   <td> <?php echo $row['type']; ?> </td>
                  <?php } ?>
                    <td><?php echo $row['number'] ?> </td>
                    <td><?php echo $row['place'] ?> </td>
                    
                    <td><?php echo $date_issued ?></td>
                    <td><?php echo $date_expired ?></td>
                  </tr>
            <?php   
                    } 
                }
            ?>
            </tbody>
        </table>
        
         <br>
            
            <?php //$this->load->view('form-add-experience')?>
            
            <h5> Medical Record </h5> 
            <br>
                    <table>
            <thead>
            <th>Type</th>
            <th>Number</th>
            <th>Issued Place</th>
            <th>Issued Date</th>
            <th>Expiry Date</th>
            </thead>
                    <tbody>
                    <?php


                    foreach($document as $row) {
                        if ($row['type_document'] == "medical" || $row['type_document'] == "medical_cert") {
                            $date_issued = date_format_str($row['date_issued']);
                            $date_expired = date_format_str($row['date_expired']);

                            ?>
                            <tr>
                                <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['number'] ?> </td>
                                <td><?php echo $row['place'] ?> </td>

                                <td><?php echo $date_issued ?></td>
                                <td><?php echo $date_expired ?></td>
                            </tr>
                            

                        <?php
                        }
                    }
                    ?>
                    </tbody>

                </table>
        
    </div>    
    <br>

      <h5> Visa </h5>
      <br>
      <table>
        <thead>
<th>Type</th>
            <th>Number</th>
            <th>Issued Place</th>
            <th>Issued Date</th>
            <th>Expiry Date</th>
          </thead>
          <tbody>
            <?php foreach($visa as $row){ 
              $date_issued = date_format_str($row['date_issued']);
                                          $date_expired = date_format_str($row['date_expired']);

              ?>
              <tr>
                 <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['number'] ?> </td>
                                <td><?php echo $row['place'] ?> </td>

                                <td><?php echo $date_issued ?></td>
                                <td><?php echo $date_expired ?></td>  
                                 </tr>
            <?php } ?>            
          </tbody>
        </table>
    <br>
    <div id="data-table-competency" class="jarak">
        <div>
            <h3> COC and Endorsement </h3> 
        </div>
        
        <div class="clearfix"></div>
          <br />
        <table>
            <thead>
            <th>
                Certificate of Competency
            </th>
            <th>
                No License
            </th>
            <th>Issued Place & Issued Date <?php //$date_issued_lbl?></th>
                <th>Expiry Date <?php //$date_expired_lbl?></th>
                
            </thead>
            <tbody>
             <?php
             foreach($competency as $row){
                 
                 if($row['grade_license'] != "Certificate of Endorsement" && $row['type'] == "coc")
                 {
                     $e = "UNLIMITED";
                 }
                 else
                 {
                     $e = date_format_str($row['expired_date']);
                 }
                 
             ?>
              <tr>
              <?php $n = ""; if($row['type'] == "cor" OR $row['grade_license'] == "Certificate of Endorsement"){ 
                $n = $row['negara']; } 
                ?>
                <td><?php echo $n." ".$row['grade_license'] ?></td>
                <td>
                  <form method="POST" action="http://pelaut.dephub.go.id/index.php?hal=src" target="_blank"> 
                  <input type="hidden" name="name" value="<?php echo substr($row['no_license'],0,10); ?>">
                    <input type="submit" value="<?php echo $row['no_license']; ?>" style="background:none;
                    border:none;color:#3366cc;">
                  </form>
                  <?php //echo $row['no_license']?></td>
                <!-- <td><?php echo $row['negara']?></td> -->
                <td><?php echo $row['place_issued']." , ".date_format_str($row['date_issued']) ?></td>
                <td><?php echo $e; ?></td>
      
              </tr>
             <?php
             }
             ?>
            </tbody>
            </table>
        </table>
    </div>
    <br>
    <br>
    <div id="data-table-proficiency" class="jarak">
      <div><h3> Certificate of Proficiency </h3>
     
        
      </div>
      
      <div class="clearfix" style="margin-bottom: 10px"></div>
      <div class="clearfix"></div>
      <table>
          <thead>
            <tr>
              
              <th>Certificate</th>
              <th>Number </th>
              <th>Place Issued</th>
              <th>Issued Date </th>
              <th>Expiry Date <?php //$date_expired_lbl?></th>
            </tr>
          </thead>
          <tbody>
              <?php
              foreach($proficiency as $row2)
              {
              ?>
                <tr>
                  <td><?php echo $row2['sertifikat_stwc']; ?></td>
                  <td><a title="Data Sertifikat" data-toggle="popover" data-content="" 
                  id="data-sertifikat" href="#">
                  <form method="POST" action="http://pelaut.dephub.go.id/index.php?hal=src" target="_blank"> 
                  <input type="hidden" name="name" value="<?php echo substr($row2['no_sertifikat'],0,10); ?>">
                    <input type="submit" value="<?php echo $row2['no_sertifikat']; ?>" style="background:none;
                    border:none;color:#3366cc;onhover:color:red;">
                  </form>
                  <?php //echo $row2['no_sertifikat']; ?></a></td>
                  
                  <td><?php echo $row2['place_issue']; ?></td>
                  <td><?php echo date_format_str($row2['date_issue']); ?></td>
                  <td><?=date_format_str($row2['expired_date']); ?> </td>
                 
                </tr>
  
              <?php
              }
              ?>
              </tbody>    
      </table>
    </div>
            
            <br>
            <br>
            
    <div id="data-table-experience" class="jarak">  
      <div><h3> Sea Service Record </h3>
      </div>
      
      <div class="clearfix" style="margin-bottom: 10px"></div>
      <div class="clearfix"></div>
      <table>
          <thead>
            <tr>
              <th width="">Vessel Name</th>
              <th width="">Vessel Type </th>
              <th>Size</th>
              <th>Rank</th>
              <th>Company</th>               
              <th width="20%">Periode</th>
            </tr>
          </thead>
          <tbody>
                <?php
                    $this->load->model("vessel_model");
                    
                    $vessel_model = $this->vessel_model;
                
                    foreach($experience as $row)
                    {
                        //$vessel_name = $vessel_model->get_ship_detail($row['ship_id']);
                        $vessel_type = $vessel_model->get_ship_type_detail($row['ship_type_id']);
                        $rank       = $this->resume_model->get_rank_detail($row['rank_id']);
                        
                        $periode_from = date_format_str($row['periode_from']);
                        $periode_to = date_format_str($row['periode_to']);
                        $create_date = date_format_str($row['datetime']);
                        $last_update = date_format_str($row['last_update']);
                         
                ?>
                <tr data-toggle="popover" data-content="Created: <?php echo $create_date; ?> Updated : <?php echo $last_update; ?> " id="data-update" data-placement="bottom" >
                
                  <td ><?php echo $row['ship_name'] ?> </td>
                  <td ><?php echo $vessel_type['ship_type'] ?> </td>
                  <?php 
                  if($row['satuan'] == 'm3'){
                    $satuan = "m&sup3;";
                  }else{
                    $satuan = $row['satuan'];
                  }
                  ?>
                  <td ><?php echo $row['weight']."  ".$satuan  ?></td>
                  
                  <td><?php  echo $rank['rank'] ?> </td>
                  
                  <td><?php echo $row['company'] ?></td>
                  
                  <td ><?php echo $periode_from ?> ~ <?php echo $periode_to; ?></td>
                 
                </tr>
                
                </tr>
                <?php
                    }
                ?>
         </tbody>
      </table>
    </div>
</div>
<br>
<br> */ ?>