<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<?php 
	$this->load->model("seaman/sea_record_model");
	$distinct_ship_type = $this->sea_record_model->getDistinctShipTypeCrew($pelaut["pelaut_id"]);
	$distinct_rank 	  = $this->sea_record_model->getDistinctExperienceRankCrew($pelaut["pelaut_id"]);
	
	//print_r($distinct_ship_type);
?>



<?php //print_r($resume); exit;?>


<button class="pull-right btn btn-filled btn-sm " id="profile-btn" modal="form-profile">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;<?=$this->lang->line("edit")?>
</button>
<div class="clearfix"></div>

<div class="bio-resume block">
    <div class="media">
        <div class="pull-left">
            
            <img class="img-responsive media-object" src="<?=check_img_resume($pelaut['username'])?>" alt="ini poto" >
         
            <center><a href="#" onclick="javascript:resume_crop_modal()" title="Click to Change the photo">
            <?=$this->lang->line("edit")?> Photo</a></center>
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
                            <td> <?php echo ucfirst($pelaut['gender']); ?> </td>
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
                            <td><?=$this->lang->line("birth_place")?>/<?=$this->lang->line("birth_date")?></td>
                            <td>:</td>
                            <td> 
                              <?php if($pelaut['tempat_lahir'] == "" || $pelaut['tanggal_lahir'] == "0000-00-00"){  
							  	if($pelaut['tempat_lahir'] == "" && $pelaut['tanggal_lahir'] != "0000-00-00")
								{
                                	echo "- /".date_format_str($pelaut['tanggal_lahir']);
								}
								else
								{
									echo $pelaut['tanggal_lahir'];
								}
                              } else {  
                                echo $pelaut['tempat_lahir']; ?>, <?php echo date_format_str($pelaut['tanggal_lahir']);
                              }
                              ?>
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
                    <table class="table-responsive ">
                        <tr>
                            <td style="width: 170px"><?=$this->lang->line("height")?>/<?=$this->lang->line("weight")?></td>
                            <td>:</td>
                            <td>  <?php echo $profile['height']; ?> cm / <?php echo $profile['weight']; ?> kg</td>
                        </tr>
                        <tr>
                            <td><?=$this->lang->line("clothes_shoes")?> </td>
                            <td>:</td>
                            <td>  <?php echo $profile['clothes_size']; ?> / <?php echo $profile['shoes_size']; ?> </td>
                        </tr>
                        <tr>
                            <td><?=$this->lang->line("address")?></td>
                            <td>:</td>
                            <td> <?php echo $pelaut['alamat']; ?> </td>
                        </tr>
                        <tr>
                            <td><?=$this->lang->line("phone")?>/<?=$this->lang->line("handphone")?></td>
                            <td>:</td>
                            <td> <?php echo $pelaut['telepon']." / ".$pelaut['handphone']; ?> </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td> <?php echo $pelaut['email']; ?> </td>
                        </tr>
                        <tr>
                            <td><?=$this->lang->line("next_of_kin")?>/ <?=$this->lang->line("relationship")?></td>
                            <td>:</td>
                            <td> <?php echo $pelaut['keluarga_terdekat']?> / <?php echo $pelaut['hubungan']; ?> </td>
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