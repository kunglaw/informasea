<?php

	

	$profile = $resume["profile"];

	$pelaut  = $resume["pelaut"];

	$fullname = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];

	$rank = $this->rank_model->get_rank_detail($profile["rank"]);

	$profile 		= $resume['profile'];







	$pelaut	     = $resume['pelaut'];

	$competency 	 = $resume['competency'];

	$proficiency  	= $resume['proficiency'];

	$experience 	 = $resume['experience'];

	$document	   = $resume['document'];

	$medical        = $resume['medical'];

	$visa           = $resume['visa'];



	$distinct_ship_type = $this->sea_record_model->getDistinctShipTypeCrew($pelaut["pelaut_id"]);

	$distinct_rank 	  = $this->sea_record_model->getDistinctExperienceRankCrew($pelaut["pelaut_id"]);



?>



<!DOCTYPE html>



<html>



<head>



<title><?=$fullname?>- Curriculum Vitae</title>



<meta name="viewport" content="width=device-width"/>

<meta name="description" content="The Curriculum Vitae of <?=$fullname?>."/>

<meta charset="UTF-8"> 







<link type="text/css" rel="stylesheet" href="<?=asset_url("css/cv/fancy1/style.css")?>">

<link rel="stylesheet" type="text/css" href="<?=asset_url("css/bootstrap.css")?>" />



<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>





<script type="text/javascript" src="<?=asset_url("js/jquery.min.js")?>" ></script>

<script type="text/javascript" src="<?=asset_url("js/jquery-ui-1.11.4.custom/jquery-ui.js")?>"></script>

<script type="text/javascript" src="<?=asset_url("js/bootstrap.min.js")?>" ></script>

<script type="text/javascript" src="<?=asset_url("js/script.js")?>"></script>



<script src="https://code.highcharts.com/highcharts.js"></script>

<script src="https://code.highcharts.com/modules/data.js"></script>

<script src="https://code.highcharts.com/modules/drilldown.js"></script>





<link href="<?php echo asset_url("css/jquery.dataTables.css") ?>" type="text/css" rel="stylesheet" />



<!--[if lt IE 9]>



<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>



<![endif]-->



<style>



	body{



		background-color:#181818 !important;

		font-family: 'Rokkitt', Helvetica, Arial, sans-serif;

		z-index:-1000;



	}



	thead{



		font-weight:bold;	



	}

	

	.table-profile tr

	{

		height:30px;

			

	}

	

	.table-profile td

	{

		width:30%;	

	}

	

	#contactDetails

	{

		

		width:33%;	

	}

	

	#contactDetails li

	{

		word-wrap: break-all;

	}

	

	#alert-resume

	{

		z-index:1000;

			

	}

	

	.modal-backdrop

	{



		z-index:-1 !important;	



	}



</style>



</head>



<body id="top">



	<div class="modal fade" id="alert-resume" tabindex="-1" role="dialog">

      <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="modal-title"> Info </h4>

          </div>

          <div class="modal-body">

            <div class="container"> 

            	<ul>

                	<li>Please using <b style="font-size:16px">Mozilla Firefox</b> for better print out </li>

            		<li>Press <b style="font-size:16px">Ctrl + P </b> for print CV </li>

                    

                </ul>

            </div>

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal"> Ok </button>

           

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->





    <div id="cv" class="instaFade">

        

        

        

        <div class="mainDetails">

    

            <div id="headshot" class="quickFade">

                <img src="<?=check_img_resume($pelaut["username"])?>" alt="Alan Smith" />

            </div>

    

            <div id="name">

    

                <h2 class="quickFade delayTwo"><?=$fullname?></h2>

                <h3 class="quickFade delayThree"><?=$rank["rank"]?></h3>

                <div>for <i style="font-style:italic !important"><?=count_experience($pelaut["pelaut_id"],"bulat_full")?> </i></div>

                <div>of <i style="font-style:italic !important"> <?=total_count_experience($pelaut["pelaut_id"],"bulat_full")?></i> total experience</div>

    

            </div>

    

    

            <div id="contactDetails" class="quickFade delayFour">

    

                <ul>

                    <li><i class="glyphicon glyphicon-link"></i> : <?="www.informasea.com/s/".$pelaut["username"]?></li>

                    <li><i class="glyphicon glyphicon-envelope"></i> : <a target="_blank"><?=$pelaut["email"]?></a></li>

                    <li><i class="glyphicon glyphicon-earphone"></i> : <?=$pelaut["handphone"]?></li>

                    <li><i class="glyphicon glyphicon-home"></i> : <?=$pelaut["alamat"]?></li>

    

                </ul>

    

            </div>

    

            <div class="clear"></div>

    

        </div>

    

        

    

        <div id="mainArea" class="quickFade delayFive">

    

            <section>

    

             

    

                <div class="" style="width:45%; float:left">

    

                    <table class="table-responsive table-profile">

    

                        <tr>

                            <td><?=$this->lang->line("gender")?></td>

                            

                            <td>: <?php echo $pelaut['gender']; ?> </td>

                        </tr>

    

                        <tr>

                            <td><?=$this->lang->line("nationality")?></td>

                            

                            <td>: <?php echo $pelaut['kebangsaan']; ?> </td>

                        </tr>

                        <tr>

                            <td>Status</td>

                            

                            <td> : <?php echo $pelaut['status_perkawinan']; ?> </td>

                        </tr>

                        <tr>

    

                            <td> Age </td>

                            

                            <td> :

    

                            <?php  

							  $aaa = date_format_db($pelaut['tanggal_lahir']);

    						  if(!empty($aaa)){ 	

                              $w = date('Y-m-d');

    

                                $now = new DateTime($w);

                                $tgl = new DateTime($pelaut['tanggal_lahir']);

                                $c = $now->diff($tgl);

                                echo $c->y." years old";

							  }

    

                              ?>

    

                             

    

                            </td>

    

                        </tr>

                        

    

                    </table>

    

                </div>

                

                <div class="" style="width:45%; float:left">

    

                    <table class="table-responsive table-profile">

                        <tr>

                            <td style="width: 150px"><?=$this->lang->line("height")?>/<?=$this->lang->line("weight")?></td>

                            

                            <td>:  <?php echo $profile['height']; ?> cm / <?php echo $profile['weight']; ?> kg</td>

    

                        </tr>

                        <tr>

                            <td><?=$this->lang->line("clothes_shoes")?></td>

                            

                            <td>: <?php echo $profile['clothes_size']; ?> / <?php echo $profile['shoes_size']; ?> </td>

                        </tr>

                        

                        <tr>

    

                            <td><?=$this->lang->line("religion")?></td>

                            

                            <td>: <?php echo $pelaut['agama']; ?> </td>

    

                        </tr>

                        <tr>

    

                            <td><?=$this->lang->line("next_of_kin")?> / Relationship</td>

                            

                            <td>: <?php echo $pelaut['keluarga_terdekat']?> / <?=$pelaut["hubungan"]?> </td>

                        </tr>

    

                    </table>

    

                </div>

    

             

              <span class="clearfix">&nbsp;</span>

            </section>

    

            

    

            <section>

    

            

    

                <div class="table-title">

    

                  <h3>Profile</h3>

    

                </div>

    			  

                  <?php if(empty($profile["describe"])){ ?>

                 

                  <p>In my current role as Senior Marketing Executive at Software Company X Ltd, I have been responsible for increasing incoming client enquiries for our B2B product lines by 156% in under 12 months, which helped the business increase its revenue by 55% year-on-year.</p>

                  <?php }else{ ?>

                  <p>

				   <i class='fa fa-quote-left' aria-hidden='true'></i> &nbsp

				  <?=$profile["describe"]?> 

                  &nbsp; <i class='fa fa-quote-right' aria-hidden='true'></i>

                  </p>

                  <?php } ?>

    

                <div class="clear"></div>

    

                <span class="clearfix"></span>

    

            </section>

    

               <span class="clearfix"></span>

               

               <div class="table-title">

    

                  <h3>Overview</h3>

    

                </div>

               

               <div class="container-fluid">

                    <div style="width:49%; float:left; margin-right:10px; border:2px #000" id="chart-temp-rank" > chart-temp  </div>

                    

                    <div style="width:49%; float:left; border:2px #000" id="chart-temp-ship" >  </div>

               </div>

               

               <span class="clearfix">&nbsp;</span>

    

               <script>

                  $(function () {

                    

                    //alert(this.toSource());

                    

                    $("#chart-temp-rank").highcharts({

                        

                        chart: {

                            type: 'column',

							borderWidth:1

                        },

                        title: {

                            text: 'Rank'

                        },

                        subtitle: {

                            text: '<?php echo $pelaut["nama_depan"]." ".$pelaut["nama_belakang"]; ?>'

                        },

                        xAxis: {

                            type: 'category'

                        },

                        yAxis: {

                            

                            title: {

                                text: 'Duration (Months)'

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

                            

                            var months = this.y;

                            var years = Math.floor((this.y)/12) <= 0 ? 0 : Math.floor((this.y)/12);

                            var text_years = years != 0 ? years+'y': '';

                            var total_month = years*12;

                            var sisa_month = (this.y) - total_month;

                            

                        

                            var text_months = sisa_month != 0 && years != 0 ? " "+sisa_month+'m': sisa_month != 0 && years == 0 ? sisa_month+'m': '';

                            

                            

                            

                            var total = text_years+text_months;

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

                                      if($mz != count($distinct_rank)-1)

                                           echo "[ '".$dtRank['rank']."',".days_to_months_int($total_days)." ],\n";

                                      else echo "[ '".$dtRank['rank']."',".days_to_months_int($total_days)." ],\n";

                                      $mz++;

                                  } 

                                

                               ?>

                            ]

                        }]

                        

                    });

                });

                </script>

                

               <script>

                  $(function () {

                    // Create the chart

                    $("#chart-temp-ship").highcharts({

                        

                        chart: {

                            type: 'column',

							borderWidth:1

                        },

                        title: {

                            text: 'Ship'

                        },

                        subtitle: {

                            text: '<?php echo $pelaut["nama_depan"]." ".$pelaut["nama_belakang"]; ?>'

                        },

                        xAxis: {

                            type: 'category'

                        },

                        yAxis: {

                            

                            title: {

                                text: 'Duration (Months)'

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

                            var months = this.y;

                            var years = Math.floor((this.y)/12) <= 0 ? 0 : Math.floor((this.y)/12);

                            var text_years = years != 0 ? years+'y': '';

                            var total_month = years*12;

                            var sisa_month = (this.y) - total_month;

                            

                        

                            var text_months = sisa_month != 0 && years != 0 ? " "+sisa_month+'m': sisa_month != 0 && years == 0 ? sisa_month+'m': '';

                            

                            

                            

                            var total = text_years+text_months;

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

                                        if($mz != count($distinct_ship_type)-1) 

                                             echo "[ '".$dtShipType['ship_type']."', ".days_to_months_int($total_days)." ],\n";

                                        else echo "[ '".$dtShipType['ship_type']."', ".days_to_months_int($total_days)." ],\n";

                                        $mz++;

                                    }

                                

                               ?>

                            ]

                        }]

                        

                    });

                });

                </script>

    

            <section>

    

               <span class="clearfix"></span>

    

              <div id="data-table-document">  

    

    

                <div class="table-title" ><h3>  <?=$this->lang->line("document")?> <?=$this->lang->line("and")?> <?=$this->lang->line("medical_record")?> </h3></div>

    

                <div class="clearfix"></div> 

    

                <h5 class="table-title"> <?=$this->lang->line("document_record")?> </h5>

    

                <table class="table table-bordered hover" border="1">

    

        

    

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
                                 echo $row['number'];

    

        

    

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

    

                

    

                <h5 class="table-title"> Visa </h5>

    

              

    

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

    

                

    

                </td>

    

                

    

                </tr>

    

    

    

                <?php } ?>

    

     

    

                </tbody>

    

                

    

                </table> 

    

                

    

                <h5 class="table-title"> <?=$this->lang->line("medical_record")?> </h5>

    

            

    

                <table class="table table-bordered hover">

    

                

    

                    <thead style="" class="">

    

    

    

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

    

                

    

                                  <?php  echo $row['number'];?>

    

                

    

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

    

              

    

            </section>

    

            

    

            <section>

    

                

    

                <div class="table-title"><h3> COC and endorsement </h3></div>

    

                 

    

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

    

    

    

                      <?php echo $row['no_license']; ?>

    

    

    

                    </td>

    

    

    

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

    

    

    

            </section>

    

            

    

            <section>

    

                

    

            <div class="table-title"><h3> Certificate of proficiency </h3></div>

    

            

    

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

    

    

    

                       <?php echo $row2['no_sertifikat']; ?>

    

    

    

                      </td>

    

    

    

                      <td><?php echo $row2['place_issue']; ?></td>

    

    

    

                      <td><?php echo date_format_str($row2['date_issue']); ?></td>

    

    

    

                      

    

    

    

                    </tr>

    

    

    

      

    

    

    

                  <?php

    

    

    

                  }

    

    

    

                  ?>

    

    

    

                  </tbody>    

    

    

    

          </table>

    

            </section>

    

            

    

            <section>

    

            

    

                <div class="table-title"><h3> <?=$this->lang->line("sea_service_record");?> </h3></div>

    

                

    

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

    

    

    

                      <td ><?php echo $row['ship_name'] ?> </td> 

    

                      <td ><?php echo $vessel_type['ship_type'] ?> </td>

    

                      <td><?php echo $row['weight']."  ".$row['satuan']  ?></td>

    

                      <td><?php  echo $rank['rank'] ?> </td>

    

                      <td><?php echo $row['company'] ?> </td>

    

                      <td ><?php echo $periode_from ?> ~ <?php echo $periode_to; ?></td>

    

                    </tr>

    

                    

    

                    <?php



                        }

   

                    ?>



             </tbody>

          </table>



         </section>

    

      </div>

    

    </div>

	<script>

        $(document).ready(function(e) {

           $("#alert-resume").modal({

              

              "show":true

               

           });

        });

    </script>



</body>



</html>