<?php // halaman apply vacant 



$rank = $this->rank_model->get_rank_detail($vacantsea['rank_id']);

$profile_resume;

$ship_type = $this->vessel_model->get_ship_type_detail($vacantsea['ship_type']);

$ship  = $this->vessel_model->get_ship_detail($vacantsea['ship']);

$nationality = $this->nation_model->get_detail_nationality($vacantsea['id_nationality']);

$user_id = $this->session->userdata("id_user");



?>

<div id="apply_page">

	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">

      <div class="panel panel-default">

      	

        <div class="panel-body">

        

        	<h3> <?php echo $title ?> - <?php echo $company['nama_perusahaan'] ?></h3>

            <h4 style="font-weight:bold; color:#0C0" title="Sallary">

			<?php echo $vacantsea['sallary_curr']." ".number_format($vacantsea['annual_sallary']) ?>  <?php echo $vacantsea['sallary_range'] ?> </h4>

            <p><?=$this->lang->line("navigation_area")?> : <?php echo $vacantsea['navigation_area'] ?> </p>

            <hr />

            <p> Qualification : </p>

            <div class="table-responsive col-md-6 row">

              <table class="table table-stripped ">

                <tr>

                    <td width="40%">Department</td>

                    <td width="1">:</td>

                    <td class="tbl-bold" >

                    <?php 

                    $vd = $vacantsea['department'];

                    $department = $this->department_model->get_detail_department($vd);

                    echo $department['department'] ?></td>

                </tr>

                <tr>

                    <td>Rank</td>

                    <td>:</td>

                    <td class="tbl-bold"><?php echo $rank['rank'] ?></td>

                </tr>

                <tr>

                    <td><?=$this->lang->line("ship_type")?></td>

                    <td>:</td>

                    <td class="tbl-bold"><?php echo $ship_type['ship_type'];  ?></td>

                </tr>

                <tr>

                    <td><?=$this->lang->line("experience")?></td>

                    <td>:</td>

                    <td class="tbl-bold"><?php echo $vacantsea['experience'];  ?></td>

                </tr>

              </table>

            </div>

            

            <br class="row" />

          

            

            <div id="profil" class="row container col-md-12">

            <form method="post" class="" id="form-apply">

              <div class="row container col-md-12">

                <p class="row container">

				<?php $check_applicant = $this->vacantsea_model->check_applicant($vacantsea['vacantsea_id']); 

                  

                  if(!empty($check_applicant))

                  {

                      echo "<h4><span class='label label-warning ' role='alert'>

					  <span class='glyphicon glyphicon-warning-sign'></span>&nbsp;

					  you are already applied this vacantsea, if you're update your resume and applied back this vacantsea, please continue

					  

					  </span></h4>";

                  }

                  

                  ?>

                </p>

              

                  <h4 class=""> <?=$this->lang->line("promote")?> </h4>

                  <p><?=$this->lang->line("prmote_explain")?> </p>

                    <div class="form-group col-md-7">

                      <input type="hidden" value="<?php echo $user_id ?>" id="id_pelaut" name="id_pelaut" />

                      <input type="hidden" value="" id="file_resume" name="file_resume" />

                      <input type="hidden" value="<?php echo $vacantsea['vacantsea_id']; ?>" id="id_vacantsea" name="id_vacantsea" />

                      <textarea class="form-control row" rows="10" draggable="false" name="promotion" placeholder="promote.." ></textarea>

                    </div>

                   <div class="col-md-5">

                    <div class="panel panel-default">

                       <div class="panel-body">

                          <div class="">

                            <div> Informasea Resume &nbsp; <a href="<?php echo base_url("seaman/resume"); ?>" target="new"> View </a> </div>

                            <div> Uploaded Resume &nbsp; <a href="#"> View </a> / <a href="#"> Edit </a></div>

                          </div>

                          <hr />

                          <p>Expected sallary : <?php echo $profile_resume['exp_sallary_curr'] ?> <?php echo number_format($profile_resume['expected_sallary']); ?>  </p>

                          <p>Email : <?php echo $profile_resume['email'] ?>  </p>

                          <p>Phone Number : <?php echo $profile_resume['phone'] ?> / <?php echo $profile_resume['handphone'] ?>   </p>

                         </div>

                      </div>

                   </div>

              </div>

            

              <div class="row container col-md-10">

              	<span class="push-right">

                  <button type="button" name="" id="apply-btn" class="btn btn-success btn-lg" >Send Application </button>&nbsp;

                  <button type="button" name="" class="btn btn-default btn-lg" onclick="javascript:location.href='<?php echo base_url("") ?>'">Cancel </button>

                </span>

              </div>

            </form> 

            </div>



        </div>

      </div>

    </div>

</div>



<script>

	$("#apply-btn").click(function(){

		$.ajax({

			type:"POST",

			data:$("#form-apply").serialize(),

			url:"<?php echo base_url("vacantsea/apply_submit"); ?>",

			success: function(data)

			{

				//alert(data);

				$("#info").html(data);

				//location.href = "<?php echo base_url("vacantsea") ?>";

			}			

		});

		

		

	})



</script>