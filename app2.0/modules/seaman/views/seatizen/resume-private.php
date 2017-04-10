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
  $medical      = $resume['medical'];
  $visa         = $resume['visa'];

  //print_r($profile);

 
  //$this->load->view("menu_myjob.php");

  $id_perusahaan = $this->session->userdata('id_perusahaan');
  $id_user_ses   = $this->session->userdata('id_user');
  $xzx 	 	   = $this->uri->segment(2);
  $fullname 	  = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];
  $rank 	 	  = $this->rank_model->get_rank_detail($profile['rank']);

                   

?>    

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<?php 
	$this->load->model("seaman/sea_record_model");
	$distinct_ship_type = $this->sea_record_model->getDistinctShipTypeCrew($pelaut["pelaut_id"]);
	$distinct_rank 	  = $this->sea_record_model->getDistinctExperienceRankCrew($pelaut["pelaut_id"]);
	
	//print_r($distinct_ship_type);
?>

<div class="container-resume block">

    <div class="header-text">     
    	
        <div class="pull-left">
          	<h3><?=$this->lang->line("curriculum_vitae") ?></h3>
        </div>
        
        <div class="pull-right">
        	<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" 
                href="https://www.facebook.com/sharer/sharer.php?app_id=1655530184684604&sdk=joey&u=<?=base_url("s/$xzx")?>&display=popup&ref=plugin&src=share_button"
                title="Share your resume on facebook">
                
                <div class="btn btn-social btn-facebook ">
                  <span class="fa fa-facebook"></span>
                  Share <span class="count-box"></span>
                </div>
            
            </a>
            
            <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=<?=base_url("s/$xzx")?>" title="Share your resume on Google+">
				<div class="btn btn-social btn-google">
				  <span class="fa fa-google"></span>
				 
				  Share
            	</div>
            </a>
            
            <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://twitter.com/intent/tweet?status=<?=$fullname?> - <?=$rank["rank"]?> <?=base_url("s/$xzx")?>"
            title="Share your resume on Twitter">
				<div class="btn btn-social btn-twitter">
				  
					<span class="fa fa-twitter"></span>
					
					Tweet
				  
				</div>
			</a>
            
            <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=base_url("s/$xzx")?>&title=<?=$fullname?> - <?=$rank["rank"]?>&source=<?=base_url("s/$xzx")?>"
            title="Share your resume on Linkedin">
                <div class="btn btn-social btn-linkedin">
                  <span class="fa fa-linkedin"></span>
                 
                  Share
                </div>
            </a>
            
        </div>
		<span class="clearfix"></span>
    </div>

    <span class="header-text"><?=$this->lang->line("infr_privacy_resume")?></span>

        <br>

<?php if(empty($id_perusahaan) AND empty($id_user_ses)){ ?> 

    <?php } ?>

   	<br />

    

    <div class="clearfix"></div>

    <div class="bio-resume block">

        <div class="media">

            <div class="pull-left">

              <?php

               $this->load->model('photo/photo_mdl');

          $resume_pic = $this->photo_mdl->get_photo_resume_orang();



          $username = $this->uri->segment(2);

         // print_r($resume_pic);

          if(!empty($resume_pic))

          {

            $ss = explode(".",$resume_pic['nama_gambar']);

            //print_r($ss[0]);

            $url = img_url("photo/$username/resume/$ss[0]"."_thumb.".$ss[1]);

            

          }

          else

          {

            $url = asset_url("img/img_default.png");

          }

          ?>



                <img class="img-responsive media-object" src="<?php echo $url; ?>">

            </div>

            <div class="media-body">

                <div class="row">

                    <div class="col-md-4">

                        <table class="table-responsive">

                            <tr>

                                <td style="width: 150px"><?=$this->lang->line("name")?></td>

                                <td>:</td>

                                <td> <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang'] ?> </td>

                            </tr>

                            <tr>

                                <td><?=$this->lang->line("gender")?></td>

                                <td>:</td>

                                <td> <?php echo $pelaut['gender']; ?> </td>

                            </tr>

                            <tr>

                                <td><?=$this->lang->line("nationality")?></td>

                                <td>:</td>

                                <td> <?php echo $pelaut['kebangsaan']; ?> </td>

                            </tr>

                            <tr>

                                <td>Status</td>

                                <td>:</td>

                                <td> <?php echo $pelaut['status_perkawinan']; ?> </td>

                            </tr>

                            <tr>



                                <!-- <td>Place/Date of Birth</td>

                                <td>:</td>

                                <td> <?php //echo $pelaut['tempat_lahir']; ?>, <?php //echo date_format_str($pelaut['tanggal_lahir']); ?></td> 

                                 -->



                                 <td> Age </td>

                                <td> : </td>

                                <td>

                                <?php  

                                  $w = date('Y-m-d');

                                  if($pelaut['tanggal_lahir'] != "0000-00-00"){





                                    $now = new DateTime($w);

                                  $tgl = new DateTime($pelaut['tanggal_lahir']);



                                  $c = $now->diff($tgl);



                                  echo $c->y;

                                  ?>

                                  years old

                                  <?php }  else {

                                    echo "-";

                                  } ?>

                                </td>



                            </tr>

                            <tr>

                                <td><?=$this->lang->line("religion")?></td>

                                <td>:</td>

                                <td> <?php echo $pelaut['agama']; ?> </td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-4">

                        <table class="table-responsive">

                            <tr>

                                <td style="width: 150px"><?=$this->lang->line("height")?>/<?=$this->lang->line("weight")?></td>

                                <td>:</td>

                                <td>  <?php echo $profile['height']; ?> cm / <?php echo $profile['weight']; ?> kg</td>

                            </tr>

                            <tr>

                                <td><?=$this->lang->line("clothes_shoes")?></td>

                                <td>:</td>

                                <td>  <?php echo $profile['clothes_size']; ?> / <?php echo $profile['shoes_size']; ?> </td>

                            </tr>

                            <tr>

                                <td><?=$this->lang->line("address")?></td>

                                <td>:</td>

                                <td> -  <?php //echo $pelaut['alamat']; ?> </td>

                            </tr>

                            <tr>

                                <td><?=$this->lang->line("phone")?>/<?=$this->lang->line("handphone")?></td>

                                <td>:</td>

                                <td>  - <?php //echo $pelaut['telepon']." / ".$pelaut['handphone']; ?> </td>

                            </tr>

                            <tr>

                                <td>Email</td>

                                <td>:</td>

                                <td>  - <?php //echo $pelaut['email']; ?> </td>

                            </tr>

                            <tr>

                                <td><?=$this->lang->line("next_of_kin")?></td>

                                <td>:</td>

                                <td> <?php echo $pelaut['keluarga_terdekat']?> </td>

                            </tr>

                        </table>

                    </div>
                    
                    <div class="col-md-4" id="container" style="height:200px">
                
                
                	</div>

                </div>

            </div>

        </div>

    </div>

    <script>
	$(function () {
		
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Overview'
        },
        subtitle: {
            text: '<?php echo $pelaut["nama_depan"]." ".$pelaut["nama_belakang"]; ?>'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Duration (days)'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },

        tooltip: {
          formatter: function() {
            var years = Math.floor((this.y)/365) <= 0 ? 0 : Math.floor((this.y)/365);
            var text_years = years != 0 ? years+'y': '';
            var total_days = years*365;
            var sisa_hari = (this.y) - total_days;
            
            var months = Math.floor(sisa_hari/30) <= 0 ? 0 : Math.floor(sisa_hari/30);
            var text_months = months != 0 && years != 0 ? " "+months+'m': months != 0 && years == 0 ? months+'m': '';
            
            var total_days = months*30;
            var sisa_hari = sisa_hari - total_days;
            // alert(sisa_hari);
            var text_hari = sisa_hari != 0 && ((months != 0 && years != 0) || (months != 0 && years == 0) || (months == 0 && years != 0)) ? " "+sisa_hari+'d': sisa_hari != 0 && months == 0 ? sisa_hari+'d': '';
            
            var total = text_years+text_months+text_hari;
            var name = this.series.name;
            var xx1 = name == "Overview" ? '<br>': 'name : ';
            var xx2 = name == "Overview" ? ':': '<br>';
            var xx3 = name == "Overview" ? '<br>Click column to see detail': '';
            // alert(xx);
            return '<span style="font-size:11px">'+this.series.name+'</span> '+xx1+' <span style="color:'+this.point.color+'">'+this.point.name+'</span>'+xx2+' <b>' + total + '</b>'+xx3;
        }
        },

        series: [{
            name: 'Overview',
            colorByPoint: true,
            data: [
            <?php 
              $mz=0;
			  
              $total_days_in_ship = 0;
              foreach ($distinct_ship_type as $value) {
                # code...
				
				
                $dtShipType = $this->vessel_model->get_ships_type($value['ship_type_id']);
               
                $dtExperiences = $this->sea_record_model->allSeaRecordByShipType($pelaut['pelaut_id'], $value['ship_type_id']);
				
                // print_r($dtExperiences);
                
                foreach ($dtExperiences as $row) {
                  # code...
                  $datetime1 = new DateTime($row['periode_from']);
                  $datetime2 = new DateTime($row['periode_to']);
                  $difference = $datetime1->diff($datetime2);
                  $total_days_in_ship += $difference->days;
                }
                // if($mz != count($distinct_ship_type)-1) echo "{ name:'".$dtShipType['ship_type']."', y: $total_days, drilldown: '".$dtShipType['ship_type']."' },\n";
                // else echo "{ name:'".$dtShipType['ship_type']."', y:$total_days, drilldown: '".$dtShipType['ship_type']."' }";
                // $mz++;
              }

              $total_days_in_rank = 0;
             
              foreach ($distinct_rank as $value) {
				   //print_r($value); 
              	# code...$dtShipType = $this->vessel_model->get_ships_type($value['ship_type_id']);
                
              	$dtExperiences = $this->sea_record_model->allSeaRecordByRank($pelaut['pelaut_id'], $value['rank_id']);
              	// print_r($dtExperiences);
              	foreach ($dtExperiences as $row) {
                  # code...
                  $datetime1 = new DateTime($row['periode_from']);
                  $datetime2 = new DateTime($row['periode_to']);
                  $difference = $datetime1->diff($datetime2);
                  $total_days_in_rank += $difference->days;
                }
              }
              // print_r($dtCrew);
              // echo $dtCrew['create_date'];
              $join_since=0;
              if($dtCrew['create_date'] !== "0000-00-00 00:00:00"){
              	// echo "hai";
              	$datetime1 = new DateTime($dtCrew['create_date']);
                  $datetime2 = new DateTime(date('Y-m-d H:i:s'));
                  $difference = $datetime1->diff($datetime2);
                  $join_since=$difference->days;
              }
               ?>
            {
                name: 'Ship',
                y: <?php echo $total_days_in_ship ?>,
                drilldown: 'Ship Type'
            }, {
                name: 'Rank',
                y: <?php echo $total_days_in_rank ?>,
                drilldown: 'Rank'
            }/* , {
                name: 'Join Since',
                y: <?php echo $join_since ?>
            }*/]
        }],
        drilldown: {
            series: [
            
            {
                name: 'Ship',
                id: 'Ship Type',
                data: [
                <?php 
              
              	$mz=0;
              	foreach ($distinct_ship_type as $value) {
	                # code...
	                $dtShipType = $this->vessel_model->get_ships_type($value['ship_type_id']);
	               
	                // echo $dtCrew['id_crew'];
	                $dtExperiences = $this->sea_record_model->allSeaRecordByShipType($pelaut['pelaut_id'], $value['ship_type_id']);
	              
	                $total_days = 0;
	                foreach ($dtExperiences as $row) {
	                  # code...
	                  $datetime1 = new DateTime($row['periode_from']);
	                  $datetime2 = new DateTime($row['periode_to']);
	                  $difference = $datetime1->diff($datetime2);
	                  $total_days += $difference->days;
	                }
	                if($mz != count($distinct_ship_type)-1) echo "[ '".$dtShipType['ship_type']."', $total_days ],\n";
	                else echo "[ '".$dtShipType['ship_type']."', $total_days ],\n";
	                $mz++;
	            } ?>
                    
                ]
            }, {
                name: 'Rank',
                id: 'Rank',
                data: [
                <?php 
              
              	$mz=0;
              	foreach ($distinct_rank as $value) {
	                # code...
	                $dtRank = $this->rank_model->get_rank_detail($value['rank_id']);
	                
	                // echo $dtCrew['id_crew'];
	                $dtExperiences = $this->sea_record_model->allSeaRecordByRank($pelaut['pelaut_id'], $value['rank_id']);
	                // print_r($dtExperiences);
	                $total_days = 0;
	                foreach ($dtExperiences as $row) {
	                  # code...
	                  $datetime1 = new DateTime($row['periode_from']);
	                  $datetime2 = new DateTime($row['periode_to']);
	                  $difference = $datetime1->diff($datetime2);
	                  $total_days += $difference->days;
	                }
	                if($mz != count($distinct_rank)-1) echo "[ '".$dtRank['rank']."', $total_days ],\n";
	                else echo "[ '".$dtRank['rank']."', $total_days ],\n";
	                $mz++;
	            } ?>
                    
                ]
            }]
        }
    });
	  });
	</script>

   <br />

   <div class="clearfix"></div>

    <table class="table table-bordered hover">

        <thead>

          <th>

             <?=$this->lang->line("last_education")?>

          </th>

          <th>

              COC Class

          </th>

          <th>

              Rank

          </th>

          <th>

              <?=$this->lang->line("vessel_type")?>

          </th>

          <th>

              <?=$this->lang->line("expected_salary")?>

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

	<?php /* datatable */ ?>

    <div id="data-table-document">

        <div ><h3>  <?=$this->lang->line("document")?> <?=$this->lang->line("and")?> <?=$this->lang->line("medical_record")?> </h3></div>

        <br />

        <div class="clearfix"></div> 

       	<h5> <?=$this->lang->line("document_record")?> </h5>   

        <br />

        <table class="table table-bordered hover">

            <thead>

            <th><?=$this->lang->line("type")?></th>

            <th><?=$this->lang->line("number")?></th>

            <th><?=$this->lang->line("issued_place")?></th>

            <th><?=$this->lang->line("issued_date")?></th>

            <th><?=$this->lang->line("expired_date")?></th>

            

            </thead>

            <tbody>

            

            <?php foreach($document as $row) {

                  if ($row['type_document'] == "document") {

                      $date_issued = date_format_str($row['date_issued']);

                      $date_expired = date_format_str($row['date_expired']);

    

            ?>

                  <tr>

                    <?php 

                    if($row['type'] == 'Passport'){ ?>

                    <td><?php echo $row['type']; ?></td>

                  <?php    } else { ?>

                    <td><?php echo $row['country']." ".$row['type'] ?></td>

                    <?php } ?>

                    <td>



                      <?php 

                      if(!empty($id_perusahaan) AND empty($id_user)){

                         echo $row['number'];

                      }else{

                        echo " - ";

                      }

                     ?> 





                    </td>

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

        <br><br>
        
        <h5> Visa </h5>
        
        <table class="table table-bordered hover">
        
        <thead>
        
        <th><?=$this->lang->line("type")?></th>
        
        <th><?=$this->lang->line("number")?></th>
        
        <th><?=$this->lang->line("issued_place")?></th>
        
        <th><?=$this->lang->line("issued_date")?></th>
        
        <th><?=$this->lang->line("expired_date")?></th>
        
        </thead>
        
        <tbody>
        
        <?php 
        
        foreach($visa as $row){ ?>
        
        <tr>
        
        <td> <?php echo $row['type']; ?> </td>
        
        <td> <?php echo $row['number']; ?> </td>
        
        <td> <?php echo $row['place']; ?> </td>
        
        <td> <?php echo date_format_str($row['date_issued']); ?> </td>
        
        <td> <?php echo date_format_str($row['date_expired']); ?> 
        
        <?php /*
        
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
        
           
        
                if ($difference->y == 0 AND $difference->d <= 180 AND $difference->m <= 6 AND $difference->days <= 180){
        
        
        
                  echo "<small class='label label-warning pull-right'> Expired in ".$difference->days." Days </small>";
        
        
        
                }
        
        
        
              } */
        
        
        
        
        
                          ?>
        
        
        
        
        
        
        
        
        
        </td>
        
        </tr>
        
        
        
        
        
        <?php } ?>
        
        
        
        </tbody>
        
        </table>    
        
        <br>

        <br>
        
        <h5> <?=$this->lang->line("medical_record")?> </h5>
        
        <?php //$this->load->view('form-add-experience')?>
        
        <br />
        
        <table class="table table-bordered hover">
        
            <thead style="font-weight:bold; " class="">
        
           
        
                <th><?=$this->lang->line("type")?></th>
        
                <th><?=$this->lang->line("number")?></th>
        
                <th><?=$this->lang->line("issued_place")?></th>
        
                <th><?=$this->lang->line("issued_date")?></th>
        
                <th><?=$this->lang->line("expired_date")?></th>
        
            
        
            </thead>
        
            <tbody>
        
            <?php
        
            foreach($medical as $row) {
        
                if ($row['type_document'] == "medical" || $row['type_document'] == "medical_cert") {
        
                    $date_issued = date_format_str($row['date_issued']);
        
                    $date_expired = date_format_str($row['date_expired']);
        
        
        
                    ?>
        
                    <tr>
        
                        <td><?php echo $row['type'] ?></td>
        
                        <td>
        
                          <?php if(!empty($id_perusahaan) AND empty($id_user)){
        
                            echo $row['number'];
        
                            }else{
        
                              echo "-";
        
                            }
        
                            ?>
        
                        </td>
        
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
    

    <div id="data-table-competency" class="jarak">

        <div>

            <h3> COC and endorsement </h3>

            <br />

        </div>

        

        <div class="clearfix"></div>

        <table class="table table-bordered hover">

            <thead>

            <th>

                Certificate of Competency

            </th>

            <th>

                <?=$this->lang->line("no_license")?>

            </th>

            <th><?=$this->lang->line("issued_place")?> & <?=$this->lang->line("issued_date")?> <?php //$date_issued_lbl?></th>

                <th><?=$this->lang->line("expired_date")?> <?php //$date_expired_lbl?></th

            ></thead>

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

              <?php $n = ""; if($row['type'] == "cor" OR $row['grade_license'] == "Certificate of Endorsement"){ $n = $row['negara']; } ?>

                <td><?php echo $n." ".$row['grade_license']; ?></td>

                <td>

                  <?php 

                  if(!empty($id_perusahaan) AND empty($id_user)){

                      

                   echo $row['no_license']; 

                    }else{



                  } ?>
                      -

                    <?php //echo $row['no_license']; ?>

                  </td>

                <!-- <td><?php echo $row['negara']?></td> -->

                <td>

                     <?php if(!empty($row['place_issued']) AND !empty($row['date_issued'])) { 

                    echo $row['place_issued']." , ".date_format_str($row['date_issued']);

                   } else if(!empty($row['place_issued']) AND empty($row['date_issued'])){

                    echo $row['place_issued']." ";

                   }else if(empty($row['place_issued']) AND !empty($row['date_issued'])){

                    echo date_format_str($row['date_issued'])." ";

                   }else{

                    echo " - ";

                   }?>



                  </td>

                <td><?php echo $e; ?></td>

               

              </tr>

             <?php

             }

             ?>

            </tbody>

            </table>


    </div>


    <div id="data-table-proficiency" class="jarak">

      <div><h3> Certificate of proficiency </h3>        

      </div>

      

      <div class="clearfix" style="margin-bottom: 10px"></div>

      <div class="clearfix"></div>

      <table class="table table-bordered hover" >

          <thead>

            <tr>
              <th><?=$this->lang->line("certificate")?></th>

              <th><?=$this->lang->line("number")?> </th>

              <th><?=$this->lang->line("issued_place")?></th>

              <th><?=$this->lang->line("expired_date")?> <?php //$date_expired_lbl?></th>


            </tr>

          </thead>

          <tbody>

              <?php

              foreach($proficiency as $row2)

              {

              ?>

                <tr>

                  <td><?php echo $row2['sertifikat_stwc']; ?></td>

                  <td><!-- <a href='http://pelaut.dephub.go.id' target='_blank'> -->

                    <?php if(!empty($id_perusahaan) AND empty($id_user)){ ?>

                    <form method="POST" action="http://pelaut.dephub.go.id/index.php?hal=src" target="_blank"> 

                      <?php //echo substr($row2['no_sertifikat'],0,12); ?>

                    <input type="hidden" name="name" value="<?php echo substr($row2['no_sertifikat'],0,10); ?>">

                    <input type="submit" value="<?php echo $row2['no_sertifikat']; ?>" style="background:none;

                    border:none;color:#3366cc;onhover:color:red;">

                  </form>

                    

                  <?php 

                    }else{



                    }

                    ?>

                    </td>

                  <td><?php echo $row2['place_issue']; ?></td>

                  <td><?php echo date_format_str($row2['date_issue']); ?></td>

                  

                </tr>

  

              <?php

              }

              ?>

              </tbody>    

      </table>

    </div>            

    <div id="data-table-experience" class="jarak">  

      <div><h3> <?=$this->lang->line("sea_service_record");?> </h3>

     	<br />

      </div>

      

      <div class="clearfix" style="margin-bottom: 10px"></div>

      <div class="clearfix"></div>

      <table class="table table-bordered hover">

          <thead>

            <tr>

              <th width=""><?=$this->lang->line("vessel_name");?></th>

              <th width=""><?=$this->lang->line("vessel_type");?> </th>

              <th><?=$this->lang->line("size");?></th>

              <th>Rank</th>
              
              <th><?=$this->lang->line("company");?></th>               

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

                        $rank 		= $this->resume_model->get_rank_detail($row['rank_id']);

                        

                        $periode_from = date_format_str($row['periode_from']);

                        $periode_to = date_format_str($row['periode_to']);

                        $create_date = date_format_str($row['datetime']);

                        $last_update = date_format_str($row['last_update']);

                         

                ?>

                <tr title="Data update" data-toggle="popover" data-content="Create Date: <?php echo $create_date; ?> Last Update : <?php echo $last_update; ?> " id="data-update" data-placement="bottom" >

                

                  <?php 

                  

                   if($id_user_ses != '' AND empty($id_perusahaan)){ ?>

                   <td> -  <?php //echo $row['ship_name']; ?> </td>

                   <?php } else if(empty($id_user_ses) AND !empty($id_perusahaan)) { ?>



                  <td ><?php echo $row['ship_name'] ?> </td> 

                   <?php } else{

                    echo "<td> - </td>";

                   } ?>



                  <td ><?php echo $vessel_type['ship_type'] ?> </td>

                  <?php if($id_user_ses != '' AND empty($id_perusahaan)){ ?>

                  <td> - </td>

                  <?php } else { ?>

                   <td><?php echo $row['weight']."  ".$row['satuan']  ?></td>

                          

                    <?php } ?>



                  <td><?php  echo $rank['rank'] ?> </td>

                  

                  <td><?php echo $row['company'] ?> </td>

                  

                  <td ><?php echo $periode_from ?> ~ <?php echo $periode_to; ?></td>

                 

                </tr>


                <?php

                    }

                ?>

         </tbody>

      </table>

   	</div>

      <br>

    <div class="clearfix"> </div>



  <div class="box-header">

      <h3><?=$this->lang->line("resume_upload")?>

        <?php if($this->session->userdata('username') == $this->uri->segment(2)){ ?>

      <button class="btn btn-filled btn-sm pull-right" id="resume-upload-btn" modal="form-upload-resume"> 

          <span class="glyphicon glyphicon-plus"></span> Add 

      </button>

      <?php } ?>

      </h3>

      

      <span class="clearfix"></span>

  </div>

  

    <div class="hasilupload"></div>

    <span class="clearfix"></span>

    <?php 

     $id = $this->session->userdata('id_perusahaan');

     if($id == ""){

      $id = $this->session->userdata('id_perusahaan_agent');

     }

            $str = "SELECT * FROM applicant_tr WHERE id_pelaut = '$pelaut_id'";

            $q = $this->db->query($str);

            $f = $q->result_array();



            if(count($f) > 0){

              foreach($f as$row){

              $str2 = "SELECT * FROM vacantsea WHERE vacantsea_id = '$row[id_vacantsea]' AND id_perusahaan = '$id'";

              $q2 = $this->db->query($str2);

              $f2 = $q2->result_array();


              if($q2->num_rows() != 0){

                $a = "ADA";

              }else{

                $a = "TIDAK";

              }

              }

            }else{

              $a = "TIDAK";

            }



            //echo $a;

            ?>

    <table class="table table-bordered">

        <thead>

        <tr>

          <th><?=$this->lang->line("title")?> </th>

          <th><?=$this->lang->line("upload_date")?> </th>

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

                    <?php if($a == "ADA"){ ?>

                <span class="glyphicon glyphicon-download"></span> 

            </a>

            

            <?php if($this->session->userdata('username') != "" AND $this->session->userdata('username') == $username_url){ ?>

            <button class="btn btn-default btn-xs experience-delete-btn" modal="modal-delete-resume-upload" 

            onclick="javascript:delete_resume(<?php echo $row['id_resume_file']?>)" title="Delete">

                <span class="glyphicon glyphicon-remove"></span> 

            </button>

            <?php } ?>

             <?php } ?>

           </span>

          </td>

        </tr>

        <?php

            }

        ?>

       </tbody>

    </table>





</div>