<div class="tmp_modal">
		<?php // ini untuk ajax page looohh ?>                
</div>





<?php



  $profile 		= $resume['profile'];
  $pelaut	     = $resume['pelaut'];
  $competency 	 = $resume['competency'];
  $proficiency  	= $resume['proficiency'];
  $experience 	 = $resume['experience'];
  $document	   = $resume['document'];
  $medical        = $resume['medical'];
  $visa           = $resume['visa'];

 

  $id_user = $this->session->userdata('id_user');


  $this->load->model('users/user_model');
  $a = $this->user_model->get_detail_pelaut22($id_user);
  //print_r($profile);
  $xzx = $this->session->userdata('username');


    if($pelaut['kebangsaan'] == ""){
      echo "<script>$(document).ready(function(){
      get_modal('form-profile','#profile-btn')});</script>";
    }else{
      
    }

//   $str22 = "SELECT * FROM log_seatizen WHERE username = '$xzx'";
//   $qqz = $this->db->query($str22);
//   if(count($qqz) == 2){
//     echo "<script>$(document).ready(function(){
//       get_modal('form-profile','#profile-btn')});</script>";
//     }else{ 


// }
  //$this->load->view("menu_myjob.php");
  
?>    


<div class="container-resume block">
    <h4 class="header-text">     <small>
                        <a href="<?php echo base_url('seaman/resume/cv_print') ?>?id_seatizen=<?php echo $this->session->userdata('id_user'); ?>" target="_blank" title="print all data">
                        <span class="fa fa-print fa-lg"></span></a>
                        <a href="<?php echo base_url('seaman/resume/doc_download')?>?id_seatizen=<?php echo $id_user;?>" target="_blank" title="Download doc"> 
                            <span class="fa fa-file-text"> </span> 
                        </a>
                    </small> &nbsp; Curicullum Vitae &nbsp;&nbsp;&nbsp;
                    </h4>
    <div class="subtitle pull-left text-gray">
      Informasea does not provide or sell an access to seatizen resume to any company! <br>
        complete resume becomes visible to an agentsea only when you apply to a vacantsea! 


    </div>
    <br>
    <br>
    <div class="subtitle pull-left text-gray">Basic Info ("Address","Phone Number",and "Email" will be hidden from
        others)
    </div>
    <button class="pull-right btn btn-filled btn-sm " id="profile-btn" modal="form-profile">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Edit
    </button>
    <div class="clearfix"></div>
    <div class="bio-resume block">
        <div class="media">
            <div class="pull-left">
            	
                <img class="img-responsive media-object" src="<?=check_img_resume($pelaut['username'])?>" alt="ini poto" >
             
                <center><a href="#" onclick="javascript:resume_crop_modal()" title="Click to Change the photo">Edit Photo</a></center>
            </div>
            <div class="media-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-responsive">
                            <tr>
                                <td style="width: 150px">Name</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang'] ?> </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>:</td>
                                <td> <?php echo ucfirst($pelaut['gender']); ?> </td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['kebangsaan']; ?> </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['status_perkawinan']; ?> </td>
                            </tr>
                            <tr>
                                <td>Place/Date of Birth</td>
                                <td>:</td>
                                <td> 
                                  <?php if($pelaut['tempat_lahir'] == "" OR $pelaut['tanggal_lahir'] == "0000-00-00"){  
                                    echo "-";
                                  } else {  
                                    echo $pelaut['tempat_lahir']; ?>, <?php echo date_format_str($pelaut['tanggal_lahir']);
                                  }
                                  ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['agama']; ?> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table-responsive">
                            <tr>
                                <td style="width: 170px">Height/Weight</td>
                                <td>:</td>
                                <td>  <?php echo $profile['height']; ?> cm / <?php echo $profile['weight']; ?> kg</td>
                            </tr>
                            <tr>
                                <td>Clothes / Shoes size</td>
                                <td>:</td>
                                <td>  <?php echo $profile['clothes_size']; ?> / <?php echo $profile['shoes_size']; ?> </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['alamat']; ?> </td>
                            </tr>
                            <tr>
                                <td>Phone/Handphone</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['telepon']." / ".$pelaut['handphone']; ?> </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['email']; ?> </td>
                            </tr>
                            <tr>
                                <td>Next of kin/Relationship</td>
                                <td>:</td>
                                <td> <?php echo $pelaut['keluarga_terdekat']?> / <?php echo $pelaut['hubungan']; ?> </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <button class="float-right btn btn-filled btn-sm" id="kepelautan-btn" modal="form-kepelautan">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Edit
    </button>
    
    <div class="clearfix"></div>
    <table class="table table-bordered hover">
        <thead>
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
    
    
    <div class="data-table-document">
        <div ><h3>  Document and Medical Record </h3></div>
        
        <div class="clearfix"></div>    
        
        <h5> Document Record <button class="btn btn-filled btn-sm pull-right" id="document-btn" modal="form-add-document"> 
            <span class="glyphicon glyphicon-plus"></span> Add 
        </button> </h5>
        <br />
        
        <table class="table table-bordered hover">
            <thead>
            <th>Type</th>
            <th>Number</th>
            <th>Issued Place</th>
            <th>Issued Date</th>
            <th>Expiry Date</th>
            <th>Action</th>
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
                   <td> <?php echo $row['country']." ".$row['type']; ?> </td>
                  <?php } ?>
                    <td><?php echo $row['number'] ?> </td>
                    <td><?php echo $row['place'] ?> </td>
                    
                    <td><?php echo $date_issued ?></td>
                    <td><?php echo $date_expired ?>

                      <?php 
                        $now = date('Y-m-d');
                        if($row['date_expired'] == "0000-00-00"){
                          echo "";
                        } else  if($row['date_expired'] <= $now){
                          echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                        }      else if($row['date_expired'] <= $now){
                        echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                      } else if($row['date_expired'] > $now){
                        $expired_date = new DateTime($row['date_expired']);
                        $now = new DateTime(date('Y-m-d'));

                        $difference = $expired_date->diff($now);
                   
                        // if ($difference->y == 0 AND $difference->d <= 180 AND $difference->m <= 6 AND $difference->days <= 180){

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->days." Days </small>";

                       // }

                          // if($difference->y == 0 AND $difference->d <= 30 AND $difference->m <=6 AND $difference->days <= 180){
                          //     echo "<small class='label label-warning pull-right'> Expired in ".$difference->m.' Months and '.$difference->d.' days';                
                          // }
                        if($difference->y == 0 AND $difference->m <=6 AND $difference->days <= 180){

                              if($difference->m != 0 AND $difference->d != 0){

                                    echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months and ".$difference->d." days left'>".$difference->m." m  ".$difference->d." d left </small>";

                              } else if($difference->m != 0 AND $difference->d == 0){
                                  echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months left'>".$difference->m." m left </small>";
                              } else if($difference->m == 0 AND $difference->d != 0){
                                echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->d." days left'>".$difference->d." d left </small>";
                              }

                        }

                      }



                        ?>

                    </td>
                    <td>


                      <button class="btn btn-default btn-xs document-update-btn" modal="form-update-document" title="Update" 
                      onclick="javascript:update_document(<?=$row['document_id']?>)" >
                        <span class="glyphicon glyphicon-edit"></span> 
                      </button>
                      <?php if($row['type'] == 'Passport' OR ($row['country'] == $a['kebangsaan'])) { 

                      } else { ?>
                      <button class="btn btn-default btn-xs document-delete-btn" modal="delete-document-modal" title="Delete" 
                      onclick="javascript:delete_document(<?=$row['document_id']?>)" >
                        <span class="glyphicon glyphicon-remove"></span> 
                      </button>
                      <?php } ?>
                    </td>
                  </tr>
            <?php 	
                    } 
                }
            ?>
            </tbody>
        </table>
        
         <br>

         <h5> Visa <button class="btn btn-filled btn-sm pull-right" id="visa_btn" id_pelaut="<?php echo $document[0]['pelaut_id'] ?>" modal="form-add-visa"> <span class="glyphicon glyphicon-plus"> </span> Add </button>
          <br /> </h5>
          <table class="table table-bordered hover">
            <thead>
               <th>Type</th>
            <th>Number</th>
            <th>Issued Place</th>
            <th>Issued Date</th>
            <th>Expiry Date</th>
            <th>Action</th>
            </thead>
            <tbody>
              <?php 
              foreach($visa as $row){ ?>
              <tr>
              <td> <?php echo $row['type']; ?> </td>
              <td> <?php echo $row['number']; ?> </td>
              <td> <?php echo $row['place']; ?> </td>
              <td> <?php   
              if($row['date_issued'] != "0000-00-00"){
                echo date_format_str($row['date_issued']);
              } else {
                echo "";
              }
              ?>
               </td>
              <td> <?php echo date_format_str($row['date_expired']); ?> 
              <?php 
                                  $now = date('Y-m-d');
                                  if($row['date_expired'] <= $now){
                                    echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                                  }     
                                  else if($row['date_expired'] <= $now){
                        echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                      } else if($row['date_expired'] > $now){
                        $expired_date = new DateTime($row['date_expired']);
                        $now = new DateTime(date('Y-m-d'));

                        $difference = $expired_date->diff($now);
                   
                        // if ($difference->y == 0 AND $difference->d <= 180 AND $difference->m <= 6 AND $difference->days <= 180){

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->days." Days </small>";

                        // }


                       if($difference->y == 0 AND $difference->m <=6 AND $difference->days <= 180){

                              if($difference->m != 0 AND $difference->d != 0){

                                    echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months and ".$difference->d." days left'>".$difference->m." m  ".$difference->d." d left </small>";

                              } else if($difference->m != 0 AND $difference->d == 0){
                                  echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months left'>".$difference->m." m left </small>";
                              } else if($difference->m == 0 AND $difference->d != 0){
                                echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->d." days left'>".$difference->d." d left </small>";
                              }

                        }


                      }


                                  ?>




              </td>
              <td> 
                   <button class="btn btn-default btn-xs document-update-btn" modal="form-update-document" title="Update" 
                                    onclick="javascript:update_visa(<?=$row['document_id']?>)" >
                                      <span class="glyphicon glyphicon-edit"></span> 
                                    </button>
                                    
                                    <button class="btn btn-default btn-xs document-delete-btn" modal="delete-document-modal" title="Delete" 
                                    onclick="javascript:delete_visa(<?=$row['document_id']?>)" >
                                      <span class="glyphicon glyphicon-remove"></span> 
                                    </button>

              </td>
            </tr>
 

              <?php } ?>

            </tbody>
          </table>

          <br>
            
            <?php //$this->load->view('form-add-experience')?>
            
            <h5> Medical Record <button class="btn btn-filled btn-sm pull-right" id="medical-btn" id_pelaut="<?php echo $document[0]['pelaut_id'] ?>" modal="form-add-medical"><span class="glyphicon glyphicon-plus"></span> Add </button>
            <br> </h5> 
                    <table class="table table-bordered hover">
            <thead>
            <th>Type</th>
            <th>Number</th>
            <th>Issued Place</th>
            <th>Issued Date</th>
            <th>Expiry Date</th>
            <th>Action</th>
            </thead>
                    <tbody>
                    <?php


                    foreach($medical as $row) {
                        if ($row['type_document'] == "medical" || $row['type_document'] == "medical_cert") {
                            //$date_issued = date_format_str($row['date_issued']);
                            $date_expired = date_format_str($row['date_expired']);

                            ?>
                            <tr>
                                <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['number'] ?> </td>
                                <td><?php echo $row['place'] ?> </td>

                                <td>
                                
                                <?php   
              if($row['date_issued'] != "0000-00-00"){
                echo date_format_str($row['date_issued']);
              } else {
                echo "";
              }
              ?> 
                                </td>
                                <td><?php echo date_format_str($date_expired); ?>
                                  <?php 
                                  $now = date('Y-m-d');
                                  if($row['date_expired'] <= $now){
                                    echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                                  }     
                                  else if($row['date_expired'] <= $now){
                        echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                      } else if($row['date_expired'] > $now){
                        $expired_date = new DateTime($row['date_expired']);
                        $now = new DateTime(date('Y-m-d'));

                        $difference = $expired_date->diff($now);
                   
                        // if ($difference->y == 0 AND $difference->d <= 180 AND $difference->m <= 6 AND $difference->days <= 180){

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->days." Days </small>";

                        // }
                    if($difference->y == 0 AND $difference->m <=6 AND $difference->days <= 180){

                              if($difference->m != 0 AND $difference->d != 0){

                                    echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months and ".$difference->d." days left'>".$difference->m." m  ".$difference->d." d left </small>";

                              } else if($difference->m != 0 AND $difference->d == 0){
                                  echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months left'>".$difference->m." m left </small>";
                              } else if($difference->m == 0 AND $difference->d != 0){
                                echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->d." days left'>".$difference->d." d left </small>";
                              }

                        }
                      }


                                  ?>

                                </td>
                                <td>
                                    <button class="btn btn-default btn-xs document-update-btn" modal="form-update-document" title="Update" 
                                    onclick="javascript:update_medical(<?=$row['document_id']?>)" >
                                      <span class="glyphicon glyphicon-edit"></span> 
                                    </button>
                                    
                                    <button class="btn btn-default btn-xs document-delete-btn" modal="delete-document-modal" title="Delete" 
                                    onclick="javascript:delete_document(<?=$row['document_id']?>)" >
                                      <span class="glyphicon glyphicon-remove"></span> 
                                    </button>
                                </td>
                            </tr>
                            

                        <?php
                        }
                    }
                    ?>
                    </tbody>

                </table>
        
    </div>

    
    <div id="data-table-competency" class="jarak">
        <div>
            <h3> COC and Endorsement </h3> <span> (the "Number" of document will be hidden from others) </span>
            
            <button class="pull-right btn btn-filled btn-sm" id="coc-btn" modal="form-add-competency">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add
            </button>
        </div>
        
        <div class="clearfix"></div>
          <br />
        <table class="table table-bordered hover">
            <thead>
            <th>
                Certificate of Competency
            </th>
            <th>
                No License
            </th>
            <th>Issued Place & Issued Date <?php //$date_issued_lbl?></th>
                <th>Expiry Date <?php //$date_expired_lbl?></th>
                
               <th width="15%">Action</th>
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
                <td> <?php echo $row['no_license']; ?> 
                  <!-- <form method="POST" action="http://pelaut.dephub.go.id/index.php?hal=src" target="_blank"> 
                  <input type="hidden" name="name" value="<?php //echo substr($row['no_license'],0,10); ?>">
                    <input type="submit" value="<?php // echo $row['no_license']; ?>" style="background:none;
                    border:none;color:#3366cc;">
                  </form>
                  <?php //echo $row['no_license']?> --></td>
                <!-- <td><?php echo $row['negara']?></td> -->
                <td>  <?php 
                  if(empty($row['place_issued']) AND empty($row['date_issued'])){
                    echo " ";
                  }else if(!empty($row['place_issued']) AND empty($row['date_issued'])){
                    echo $row['date_issued'];
                  } else if(empty($row['place_issued']) AND !empty($row['date_issued'])){
                    echo date_format_str($row['date_issued']);
                  }else{
                     echo $row['place_issued']." , ".date_format_str($row['date_issued']);
                  }
                  ?></td>
                <td><?php echo $e; ?>
                  <?php 
                  $now = date('Y-m-d');
                   if($e != "UNLIMITED"){
                          if($row['expired_date'] == "0000-00-00"){
                                
                              echo "";
                          }
                      else if($row['expired_date'] <= $now){
                        echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                      } else if($row['expired_date'] > $now){
                        $expired_date = new DateTime($row['expired_date']);
                        $now = new DateTime(date('Y-m-d'));

                        $difference = $expired_date->diff($now);
                   
                        // if ($difference->y == 0 AND $difference->d <= 180 AND $difference->m <= 6 AND $difference->days <= 180){

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->days." Days </small>";

                        // }

                        if($difference->y == 0 AND $difference->m <=6 AND $difference->days <= 180){

                              if($difference->m != 0 AND $difference->d != 0){

                                    echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months and ".$difference->d." days left'>".$difference->m." m  ".$difference->d." d left </small>";

                              } else if($difference->m != 0 AND $difference->d == 0){
                                  echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months left'>".$difference->m." m left </small>";
                              } else if($difference->m == 0 AND $difference->d != 0){
                                echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->d." days left'>".$difference->d." d left </small>";
                              }

                        }

                      }




                }
                  ?>
                </td>
                <td>
                    
                    <!-- <button class="btn btn-default btn-xs competency-update-btn" modal="form-update-competency" 
                    onclick="javascript:edit_cocend(<?=$row['id_licenses']?>)" title="Update">
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button> -->

                    <button class="btn btn-default btn-xs competency-update-btn" modal="form-update-competency" 
                    onclick="javascript:edit_cocend(<?=$row['id_licenses']?>)" title="Update">
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>


                    
                    <?php if($row['type'] != "coc"){ ?>
                    <button class="btn btn-default btn-xs competency-delete-btn" modal="delete-competency-modal" 
                    onclick="javascript:delete_cocend(<?=$row['id_licenses']?>)" title="Delete">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button>
                    <?php } ?>
                                  
                </td>
              </tr>
             <?php
             }
             ?>
            </tbody>
            </table>
        </table>
    </div>
    
    <div id="data-table-proficiency" class="jarak">
      <div><h3> Certificate of Proficiency </h3>
      
      	<button class="pull-right btn btn-filled btn-sm"  id="proficiency-btn" modal="form-add-proficiency">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add
      	</button>
        
      </div>
      
      <div class="clearfix" style="margin-bottom: 10px"></div>
      <div class="clearfix"></div>
      <table class="table table-bordered hover" >
          <thead>
            <tr>
              
              <th>Certificate</th>
              <th>Number </th>
              <th>Issued Place </th>
              <th> Issued Date </th>
              <th>Expiry Date <?php //$date_expired_lbl?></th>
              <th width="15%">Action</th>
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
                  <td> <?php echo date_format_str($row2['expired_date']); ?>
                    <?php 
                    $now = date('Y-m-d');
                    if($row2['expired_date'] == "0000-00-00"){
                      echo "";
                    }else if($row2['expired_date'] <= $now){
                        echo "<small class='label label-danger pull-right'><i class='fa fa-tag'></i> Expired</small>";
                      } else if($row2['expired_date'] > $now){
                        $expired_date = new DateTime($row2['expired_date']);
                        $now = new DateTime(date('Y-m-d'));

                        $difference = $expired_date->diff($now);
                        // if($difference->y==0 AND $difference->d <=30 AND $difference->m <= 6){
                        //      if($difference->y==0 AND $difference->d == 0 AND $difference->m <= 6){

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->m." months </small>";
                        //      }else {

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->m." months and ".$difference->d." Days </small>";
                        //      }
                        // } else

                        // if ($difference->y == 0 AND $difference->d <= 180 AND $difference->m <= 6 AND $difference->days <= 180){

                        //   echo "<small class='label label-warning pull-right'> Expired in ".$difference->days." Days </small>";
                        // }

                        if($difference->y == 0 AND $difference->m <=6 AND $difference->days <= 180){

                              if($difference->m != 0 AND $difference->d != 0){

                                    echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months and ".$difference->d." days left'>".$difference->m." m  ".$difference->d." d left </small>";

                              } else if($difference->m != 0 AND $difference->d == 0){
                                  echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->m." months left'>".$difference->m." m left </small>";
                              } else if($difference->m == 0 AND $difference->d != 0){
                                echo "<small class='label label-warning pull-right' data-toggle='tooltip' data-placement='top' title='".$difference->d." days left'>".$difference->d." d left </small>";
                              }

                        }


                      }

                     
                      ?>


                   </td>
                  <td> 
                    <button class="btn btn-default btn-xs proficiency-update-btn" modal="form-update-proficiency" title="Update" 
                    onclick="javascript:update_proficiency(<?php echo $row2['id_sertifikat']?>)">
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>
                    
                    <button class="btn btn-default btn-xs proficiency-delete-btn" modal="delete-proficiency-modal" title="Delete"
                    onclick="javascript:delete_proficiency(<?php echo $row2['id_sertifikat']?>)">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button>
                  </td>
                </tr>
  
              <?php
              }
              ?>
              </tbody>    
      </table>
    </div>
            
            
            
    <div id="data-table-experience" class="jarak">  
      <div><h3> Sea Service Record </h3>
      <button class="pull-right btn btn-filled btn-sm" id="experience-btn" modal="form-add-experience">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add
      </button>
      </div>
      
      <div class="clearfix" style="margin-bottom: 10px"></div>
      <div class="clearfix"></div>
      <table class="table table-bordered hover">
          <thead>
            <tr>
              <th width="">Vessel Name</th>
              <th width="">Vessel Type </th>
              <th>Size</th>
              <th>Rank</th>
              <th>Company</th>               
              <th width="20%">Periode</th>
              <th width="13%">Action</th>
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
                        $rank 		= $this->resume_model->get_rank_detail($row['rank_id']);
                        
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
                    $satuan = "M&sup3;";
                  }else{
                    $satuan = $row['satuan'];
                  }
                  ?>
                  <td ><?php echo $row['weight']."  ".$satuan  ?></td>
                  
                  <td><?php  echo $rank['rank'] ?> </td>
                  
                  <td><?php echo $row['company'] ?></td>
                  
                  <td ><?php echo $periode_from ?> ~ <?php echo $periode_to; ?></td>
                  <td > 
                    <button class="btn btn-default btn-xs experience-update-btn" modal="form-update-experience" title="Update" 
                    onclick="javascript:update_experience(<?php echo $row['experience_id']?>)">
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>
                    
                    <button class="btn btn-default btn-xs experience-delete-btn" modal="delete-experience-modal" title="Delete"
                    onclick="javascript:delete_experience(<?php echo $row['experience_id']?>)">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button>
                   
                  </td>
                </tr>
                
                </tr>
                <?php
                    }
                ?>
         </tbody>
      </table>
   	</div>

    <br>
    

  <div class="box-header">
      <h3>Certificate/Document Upload 
      <button class="btn btn-filled btn-sm pull-right" id="resume-upload-btn" modal="form-upload-resume"> 
          <span class="glyphicon glyphicon-plus"></span> Add 
      </button>
      </h3>
          <div class="subtitle pull-left text-gray">

     Upload your scan document and appraisal/performance report. <br>
        Only agentsea with applied vacantsea can view your document </div>
      
      <span class="clearfix"></span>
  </div>
  
    <div class="hasilupload"></div>
    <span class="clearfix"></span>
    <table class="table table-bordered">
        <thead>
        <tr>
          <th>Title </th>
          <th>Upload date </th>
        </tr>
        </thead>
       <tbody>
        <?php
            //$this->load->model("vessel_model");
        
           // $vessel_model = $this->vessel_model;
            $no =1;
            foreach($file_resume as $row)
            {
                //$vessel_name = $vessel_model->get_ship_detail($row['ship_id']);
             $title  = $row['title'];
            $uploadtime = $row['datetime'];
        ?>
        <tr>
          <td ><?php echo $title; ?> </td>
          <td ><?php echo $uploadtime  ?>
            <span class="pull-right">

              <a class="btn btn-default btn-xs experience-update-btn" href="<?php echo base_url("seaman/resume/download_resume/$row[id_resume_file]") ?>">
                <span class="glyphicon glyphicon-download"></span> 
            </a>
            
            <button class="btn btn-default btn-xs experience-delete-btn" modal="modal-delete-resume-upload" 
            onclick="javascript:delete_resume(<?php echo $row['id_resume_file']?>)" title="Delete">
                <span class="glyphicon glyphicon-remove"></span> 
            </button>

            </span>

          </td>
          
         
          
          
        </tr>
        <?php
            }
        ?>
       </tbody>
    </table>
</div>
