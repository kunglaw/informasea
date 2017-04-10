   <div class="row">

          <div class="col-xs-12 table-responsive">

          <h1 class="text-center"><?=strtoupper($this->lang->line("curriculum_vitae"))?></h1>

            <table class="table table-bordered table-hover table-striped" style="width:100%">

					<?php //foreach($crew_detail_p as $crew_detail) { ?>

                    <tr>

                      <td width="30%">Name / Gender </td>

                      <td width="70%"><b><?php echo $crew_detail['crew_name'] ?></b> / <?php echo $crew_detail['gender']?></td>

                      <td width="70%" rowspan="5" valign="middle" >

                       <div class="subpic" id="subpic" style="margin-bottom:5px; margin-right:5px;">



                       <img src="<?php echo base_url('assets/user_img/'.$pp['nama_gambar']) ?>" alt="" style="width:113px ; height:151px;"/>                    

                       </div>

                       <div id="">

                       

                       </div>                      

                      </td>

                    </tr>

                    <tr>

                      <td>Nationality / Status </td>

                      <td>

					  <?php 

					  	if(!empty($crew_detail['kebangsaan']) || !empty($crew_detail['status_perkawinan'])) {

							echo $crew_detail['kebangsaan']." / ".  $crew_detail['status_perkawinan'];

						} else {

							echo "-";

						}

					  	 

					  ?>

                      </td>

                    </tr>

                    <tr>

                      <td>Place / Date of Birth </td>

                      <td >

					  <?php 

					  	if(!empty($crew_detail['tempat_lahir']) || !empty($crew_detail['tanggal_lahir'])) {

							echo $crew_detail['tempat_lahir']  ." / ".  $crew_detail['tanggal_lahir'];

						} else {

							echo "-";

						}

					  	 

					  ?>

                      </td>

                    </tr>

                    <tr>

                      <td>Religion</td>

                      <td >

					  <?php 

					  	if(!empty($crew_detail['agama'])) {

							echo $crew_detail['agama'];

						} else {

							echo "-";

						}

					  	 

					  ?>

                      </td>

                    </tr>

                    <tr>

                      <td>Height / Weight </td>

                      <td>

					  <?php 

					  	if(!empty($crew_detail['tinggi']) || !empty($crew_detail['berat'])) {

							 echo $crew_detail['tinggi'] ." cm / " .   $crew_detail['berat']. " Kg";

						} else {

							echo "-";

						}

					  	 

					  ?>

                      </td>

                    </tr>

                    <tr>

                      <td >COC Class / Vessel Type </td>

                      <td colspan="2">

                      <?php

                      	$coc = $this->coc_model->get_coc_detail($crew_detail['coc_class']);

						$vessel_type = $this->ship_model->vessel_type($crew_detail['vessel_type']);

						if(!empty($coc['coc_class']) && ($vessel_type['ship_type']))

						{

							echo $coc['coc_class']." / ".$vessel_type['ship_type'];

						} else {

							echo "-";

						}

					  ?>

                      </td>

                    </tr>

                    <tr>

                      <td >Rank</td>

                      <td colspan="2">

                      <?php

					  	if(!empty($crew_detail['crew_rank'])) {

                      	$rank = $this->rank_model->get_rank($crew_detail['crew_rank']);

						echo $rank['rank'];

						} else { echo "-";}

					  ?>

                      </td>

                    </tr>

                    <tr>

                      <td>Clothes Size / Shoes Size</td>

                      <td colspan="2">

					  	<?php 

							if(!empty($crew_detail['clothes_size']) || !empty($crew_detail['shoes_size'])) {

								echo $crew_detail['clothes_size']." / ". $crew_detail['shoes_size'];

							} else { echo "-"; }

						?>

                      </td>

                    </tr>                

                    

                    <tr>

                      <td>Address</td>

                      <td colspan="2"><?php echo $crew_detail['alamat']; ?></td>

                    </tr>

                    <tr>

                      <td>Phone / Handphone</td>

                      <td colspan="2"><?php echo $crew_detail['telepon']." / ".$crew_detail['handphone']; ?></td>

                    </tr>

                    <tr>

                      <td>Email</td>

                      <td colspan="2"><?php echo $crew_detail['email']; ?></td>

                    </tr>

                    <tr>

                      <td>Last Education</td>

                      <td colspan="2">Merchant Marine Academy ( AIP / PLAP / STIP ) Jakarta</td>

                    </tr>

                    <tr>

                      <td>Next of kin </td>

                      <td colspan="2"><?php echo $crew_detail['keluarga_terdekat']; ?></td>

                    </tr>

                    <?php //} ?>

                    

                  </table>

          </div><!-- /.col -->

        </div><!-- /.row -->



        <div class="row">

          <div class="col-xs-12 table-responsive">

          	<h2>CERTIFICATE OF COMPETENCY</h2>

          	<table class="table table-bordered table-hover table-striped" style="width:100%">

            	<tr>

                	<th>Certificate of STWC</th>

                	<th>Certificate No</th>

                	<th>Issued Place</th>

                	<th> Issued Date</th>

                	<th>Expiry Date</th>

                </tr>

                

                <?php foreach($competency as $row){ ?>

                <tr>

                	<td><?php echo $row['grade_license'] ?></td>

                	<td><?php echo $row['no_license'] ?></td>

                	<td><?php echo $row['place_issued'] ?></td>

                	<td><?php echo $row['date_issued'] ?></td>

                	<td><?php echo $row['expired_date'] ?></td>

                </tr>

                <?php } ?>

            </table>

          </div>

        </div><!-- /.row -->

        

        <div class="row">

          <div class="col-xs-12 table-responsive">

          	<h2>CERTIFICATE OF PROFICIENCY</h2>

          	<table class="table table-bordered table-hover table-striped" style="width:100%">

            	<tr>

                	<th>Certificate</th>

                	<th>Certificate No</th>

                	<th>Issued Place</th>

                	<th>Issued Date</th>

                </tr>

                

                <?php foreach($profiency as $row){ ?>

                <tr>

                	<td><?php echo $row['sertifikat_stwc'] ?></td>

                	<td><?php echo $row['no_sertifikat'] ?></td>

                	<td><?php echo $row['place_issue'] ?></td>

                	<td><?php echo $row['date_issue'] ?></td>

                </tr>

                <?php } ?>

            </table>

          </div>

        </div><!-- /.row -->

        

        <div class="row">

          <div class="col-xs-12 table-responsive">

          <h2>DOCUMENT</h2>

          

          </div>

        </div><!-- /.row -->

        

        <div class="row">

          <div class="col-xs-12 table-responsive">

         	<h2>SEA SERVICE RECORD</h2>

          	<table class="table table-bordered table-hover table-striped" style="width:100%">

            	<tr>

                	<th>Vessel Name/Type</th>

                	<th>DWT/GRT</th>

                	<th>Rank</th>

                	<th>Company</th>

                	<th>Area</th>

                	<th>Sign On</th>

                	<th>Sign Off</th>

                </tr>

                

                <?php foreach($experience as $row){ ?>

                <tr>

                	<td>

						<?php $a = $this->ship_model->get_vessel($row['ship_id']); echo $a['ship_name'] ?>

                        <small><?php $b = $this->ship_model->vessel_type($row['ship_type_id']); echo " / ".$b['ship_type'] ?></small>

                    </td>

                    <td><?php $c = $this->ship_model->get_vessel($row['ship_id']); echo $c['weight'] ?></td>

                	<td><?php $r = $this->rank_model->get_rank($row['rank_id']); echo $r['rank']; ?></td>

                	<td><?php echo $row['company'] ?></td>

                	<td><?php echo $row['trade_area'] ?></td>

                	<td><?php echo $row['periode_from'] ?></td>

                	<td><?php echo $row['periode_to'] ?></td>

                </tr>

                <?php } ?>

            </table>

          </div>

        </div><!-- /.row -->