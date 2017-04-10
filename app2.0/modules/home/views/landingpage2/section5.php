<?php //section5

	$this->load->model("seaman/sea_record_model");

	$this->load->model("rank_model");

	

 ?>



<script src="<?php echo asset_url('plugin/highcharts/highcharts.js') ?>"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- <script src="https://code.highcharts.com/modules/drilldown.js"></script> -->



<section>



	<div class="container">



		<div class="row title text-center">



			<h3> GOOD RESUME </h3>



			<h6 class="alt">Register as Agentsea and Get in Touch with Our Qualified Seatizen </h6>



		</div>



		<div class="row">



			<div class="owl-testimonials">



             <?php



					$this->load->model("seatizen/seatizen_model","sm");



					$this->load->model("seaman/resume_model","rm");

					

					$this->load->model("profile_resume_model","prm");



					//$where = " WHERE activation_code = 'ACTIVE' ORDER BY id_perusahaan DESC LIMIT 5";



					$seatizen_list = $this->sm->seatizen_list();



					$arr_testi = array(



						0=>"We will work with you to fully understand your business and to inform our <a href='#' class='blue-color'>marketing</a>",



						1=>"We can create a brand that stands out and reflects the message you convey",



						2=>"Using the outcomes from the <a href='#' class='blue-color'>Analysis</a>, we will put together a plan for the most effective",



						3=>"We will work with you to fully understand your business and to inform our <a href='#' class='blue-color'>marketing</a>",



						4=>"We can create a brand that stands out and reflects the message you convey",



						5=>"Using the outcomes from the <a href='#' class='blue-color'>Analysis</a>, we will put together a plan for the most effective"



					)



				?>



                <?php 

				$i = 0;



				foreach($seatizen_list as $rowi ){ 



						

					$check_resume_lengkap = $this->prm->cek_lengkap_resume($rowi["pelaut_id"]);

					

					if($check_resume_lengkap["result"] == TRUE){	

						$path_img	 		 = check_profile_seaman($rowi["username"]);

						$profile_resume 	   = $this->rm->get_profile_resume($rowi['pelaut_id']);

				?>



				<div class="text-center">



					<div class="testimonial-box" id="chart-container-<?php echo $rowi['pelaut_id'] ?>" style="width:250px; background-color: transparent; height: 250px">



						<!--<p>“<?php //echo $arr_testi[$i]?><!--”</p>-->



					</div>

					<script type="text/javascript">

						<?php 

							$distinct_ship_type = $this->sea_record_model->getDistinctShipTypeCrew($rowi["pelaut_id"]);

							$distinct_rank 	  = $this->sea_record_model->getDistinctExperienceRankCrew($rowi["pelaut_id"]);

						?>

						$("#chart-container-<?php echo $rowi['pelaut_id'] ?>").highcharts({

				        chart: {

				            type: 'column'

				        },

				        title: {

				            text: ''

				        },

				        subtitle: {

				            text: '<?php echo $rowi["nama_depan"]." ".$rowi["nama_belakang"]; ?>'

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



				        

				            series: [

				             {

				                name: 'Department',

				                // id: 'Rank',

				                data: [

				                <?php 

				              

				              	$mz=0;

				              	foreach ($distinct_rank as $value) {

					                # code...
									
									//rank
					                $dtRank = $this->rank_model->get_rank_detail($value['rank_id']);

					               

					                // echo $dtCrew['id_crew'];

					                $dtExperiences = $this->sea_record_model->allSeaRecordByRank($rowi['pelaut_id'], $value['rank_id']);

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

				                    

				                ],

				                dataLabels: {

				                enabled: true,

				                rotation: -90,

				                color: '#FFFFFF',

				                align: 'right',

				                format: '{point.y}',

				                y: 10, // 10 pixels down from the top

				                style: {

				                    fontSize: '11px',

				                    fontFamily: 'Verdana, sans-serif',

				                    fontWeight: '100'

				                }

				            }

				        }]

				    });

					</script>



					<img src="<?=$path_img?>" class="testimonial-client img-circle" alt="" width='80' height='80'>



					<h4><a class="text-white" href="<?=base_url("profile/$rowi[username]")?>"><?=$rowi['nama_depan']." ".$rowi["nama_belakang"] ?></a></h4>



					<h5 class="alt"><?=format_rank($profile_resume['rank']);?></h5>



				</div>



                <?php 



					if($i>=4)



					{



						$i = 0;	



					}



					$i++;

					

					} // check resume lengkap



				} 



				



				?>



				<!-- <div class="text-center">



					<div class="testimonial-box">



						<p>“We can create a brand that stands out and reflects the message you convey”</p>



					</div>



					<img src="<?=asset_url("landingpage2/img/people/2.png")?>" class="testimonial-client img-circle" alt="">



					<h4>Johnathan Doe</h4>



					<h5 class="alt">Marketing Manager</h5>



				</div>



				<div class="text-center">



					<div class="testimonial-box">



						<p>“Using the outcomes from the <a href="#" class="blue-color">Analysis</a>, we will put together a plan for the most effective ”</p>



					</div>



					<img src="<?=asset_url("landingpage2/img/people/3.png")?>" class="testimonial-client img-circle" alt="">



					<h4>Kennedy Johnson</h4>



					<h5 class="alt">SEO</h5>



				</div>



				<div class="text-center">



					<div class="testimonial-box">



						<p>“We will work with you to fully understand your business and to inform our <a href="#" class="blue-color">marketing</a> ”</p>



					</div>



					<img src="<?=asset_url("landingpage2/img/people/4.png")?>" class="testimonial-client img-circle" alt="">



					<h4>Markus Dovenberg</h4>



					<h5 class="alt">Web Designer</h5>



				</div>



				<div class="text-center">



					<div class="testimonial-box">



						<p>“We can create a brand that stands out and reflects the message you convey”</p>



					</div>



					<img src="<?=asset_url("landingpage2/img/people/2.png")?>" class="testimonial-client img-circle" alt="">



					<h4>Johnathan Doe</h4>



					<h5 class="alt">Marketing Manager</h5>



				</div>



				<div class="text-center">



					<div class="testimonial-box">



						<p>“Using the outcomes from the <a href="#" class="blue-color">Analysis</a>, we will put together a plan for the most effective ”</p>



					</div>



					<img src="<?=asset_url("landingpage2/img/people/3.png")?>" class="testimonial-client img-circle" alt="">



					<h4>Kennedy Johnson</h4>



					<h5 class="alt">SEO</h5>



				</div> -->



                



			</div>



		</div>



	</div>	



</section>