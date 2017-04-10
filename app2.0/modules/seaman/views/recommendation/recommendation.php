<?php //experience, page experience, profile, module user ?>
<!-- <script src="<?php echo asset_url('plugin/highcharts/highcharts.js') ?>"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script> -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<?php 
	$this->load->model("seaman/sea_record_model");
	$distinct_ship_type = $this->sea_record_model->getDistinctShipTypeCrew($pelaut["pelaut_id"]);
	$distinct_rank 	  = $this->sea_record_model->getDistinctExperienceRankCrew($pelaut["pelaut_id"]);
	
	//print_r($distinct_ship_type);
?>
<style>
	
	.popover-example .popover {
	  position: relative;
	  display: block;
	  margin: 5px;
	  max-width:100% !important;
	  z-index:-1000;
	}
	
	.popover .arrow{
		top:22% !important;
			
	}
	
	.popover-example {
		
	}
	
	.bs-callout {
		padding: 20px;
		margin: 20px 0;
		border: 1px solid #eee;
		border-left-width: 5px;
		border-radius: 3px;
	}
	.bs-callout h4 {
		margin-top: 0;
		margin-bottom: 5px;
	}
	.bs-callout p:last-child {
		margin-bottom: 0;
	}
	.bs-callout code {
		border-radius: 3px;
	}
	.bs-callout+.bs-callout {
		margin-top: -5px;
	}
	.bs-callout-default {
		border-left-color: #777;
	}
	.bs-callout-default h4 {
		color: #777;
	}
	.bs-callout-primary {
		border-left-color: #428bca;
	}
	.bs-callout-primary h4 {
		color: #428bca;
	}
	.bs-callout-success {
		border-left-color: #5cb85c;
	}
	.bs-callout-success h4 {
		color: #5cb85c;
	}
	.bs-callout-danger {
		border-left-color: #d9534f;
	}
	.bs-callout-danger h4 {
		color: #d9534f;
	}
	.bs-callout-warning {
		border-left-color: #f0ad4e;
	}
	.bs-callout-warning h4 {
		color: #f0ad4e;
	}
	.bs-callout-info {
		border-left-color: #5bc0de;
	}
	.bs-callout-info h4 {
		color: #5bc0de;
	}
	
</style>
<div class="box">

  <div class="box-header">

      <h4 class="box-heading header-text">Recommendation 
      	
      </h4>

      <span class="clearfix"></span>

  </div>

  <div class="box-content">
	<div id="recommendation-temp"></div>

    <span class="clearfix"></span>
	<div id="container-chart"></div>	
    
    <?php 
	
	//print_r($experience);
	if(!empty($experience)){
		foreach($experience as $row){ 
			
			$ship_type = $this->vessel_model->get_ships_type($row["ship_type_id"]);
			$rank 	  = $this->rank_model->get_rank_detail($row["rank_id"]);
			$recommendation = $this->recommendation_model->rec_list_by_exp($row["experience_id"]); 
			$total_exp = $this->experience_model->total_experience_row($row["experience_id"]);
			
			$sign_on = date_format(date_create($row["periode_from"]),"M Y");
			$sign_off = date_format(date_create($row["periode_to"]),"M Y");
			
		?>
          <div class="bs-callout bs-callout-primary">
              <div class="pull-left col-md-1">
                  <img src="<?=check_profile_seaman($pelaut["username"])?>" width="90%" class="img">
              </div>
              <div class="pull-left col-md-10">
                <h4><?php echo $fullname ?></h4>
                <b> at  <?=$row["company"]?> / <?=$ship_type["ship_type"]?> / <?=$rank["rank"]?> / 
				<?=$sign_on?> - <?=$sign_off?></b>
              </div>
              <span class="clearfix"></span>
          </div>
    	
        <?php 
			
			foreach($recommendation as $rowa){ 
			
				$pelaut_sender = $this->seatizen_model->detail_seatizen($rowa["id_pelaut_sender"]);  
				$rank		  = $this->rank_model->get_rank_detail($rowa["rank"]);	
			
			?>
            <div class="row">
              <div class="col-md-1">
                  
                  &nbsp;
                  
              </div>
              <div class="col-md-11">
              	<div class="row">
                	<div class=" pull-left" style="width:10%">
                		<img src="<?=check_profile_seaman($pelaut_sender["username"])?>" width="70%" class="img img-thumbnail">
                    </div>
                    <div class=" pull-left" style="width:89%; margin-right:1%">
                    	<div class="popover-example">
                  <div class="popover right">
                    <div class="arrow"></div>
                    <h3 class="popover-title">
                      <div class="pull-left">
                        <b><?=$pelaut_sender["nama_depan"]?> <?=$pelaut_sender["nama_belakang"]?> / <?=$rank["rank"]?></b>
                        
                      </div>
                      <div class="pull-right" style="z-index:1 !important"> 
                      
                      </div>
                      <div class="clearfix"></div>
                    </h3>
                    <div class="popover-content">
                      <p><?=$rowa["recommendation"]?></p>
                    </div>
                  </div>
                </div>
                    </div>
                    <span class="clearfix"></span>
                </div>
              
                
              </div>
            </div>
        <?php } // foreach recommen?>
    
    <?php }// foreach experience 
	}
	
	//print_r($rec_company);
	
	if(!empty($rec_company))
	{
		foreach($rec_company as $rowa)
		{
			$rank 	  = $this->rank_model->get_rank_detail($rowa["rank_receiver"]);
	?>
    		<div class="bs-callout bs-callout-primary">
              <div class="pull-left col-md-1">
                  <img src="<?=check_profile_seaman($pelaut["username"])?>" width="90%" class="img">
              </div>
              <div class="pull-left col-md-10">
                <h4><?php echo $fullname ?></h4>
                <b> as <?=$rank["rank"]?> </b>
              </div>
              <span class="clearfix"></span>
          	</div>
            
             <?php 
			$rec_cc = $this->recommendation_model->rec_comp_by_rank($rowa["id_pelaut"],$rowa["rank_receiver"],$rowa["id_perusahaan"]);
			//var_dump($rec_cc);
			
			foreach($rec_cc as $rowb){ 
			
				$company = $this->company_model->get_company("WHERE a.id_perusahaan='$rowb[id_perusahaan]'")->row_array();
				
			
			?>
            <div class="row">
              <div class="col-md-1">
                  
                  &nbsp;
                  
              </div>
              <div class="col-md-11">
              	<div class="row">
                	<div class=" pull-left" style="width:10%">
                		<img src="<?=check_logo_agentsea($company["username"])?>" width="70%" class="img img-thumbnail">
                    </div>
                    <div class=" pull-left" style="width:89%; margin-right:1%">
                    	<div class="popover-example">
                  <div class="popover right">
                    <div class="arrow"></div>
                    <h3 class="popover-title">
                      <div class="pull-left">
                        <b> <?=$company["nama_perusahaan"]?> / <?=$company["contact_person"]?> / <?=$rowb["position"]?></b>
                        
                      </div>
                      <div class="pull-right" style="z-index:1 !important"> 
                      
                      </div>
                      <div class="clearfix"></div>
                    </h3>
                    <div class="popover-content">
                      <p><?=$rowb["recommendation"]?></p>
                    </div>
                  </div>
                </div>
                    </div>
                    <span class="clearfix"></span>
                </div>
              
                
              </div>
            </div>
        <?php } // foreach recommen?>
    <?php
		}
		
	}
	
	if(empty($experience) && empty($rec_company) ){ ?>
    
    
    	<div> please give <b><?=$fullname?></b> a recommendation  </div>
    
    
    <?php } ?>
    
   
    
    <div class="clearfix"></div>
    
  </div>

</div>

<script>
	/* $('.example-popover').popover({
	  container: 'body'
	}) */
	
</script>

<!-- <script>
	$(function () {
    // Create the chart
    $('#container-chart').highcharts({
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
</script> -->