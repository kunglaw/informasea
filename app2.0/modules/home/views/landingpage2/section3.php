<?php // section3 ?>

<style>

	@-moz-document url-prefix() {

	  fieldset { display: table-cell; }

	}

	

	table tbody tr td{

		overflow:hidden

	}

</style>

<?php

	$id_user = $this->session->userdata("id_user");

	$this->load->model("vacantsea/vacantsea_model");

	$this->load->model("company/company_model");

	$vacantsea = $this->vacantsea_model->get_vacantsea_panel();

	$jml_vacantsea = count($this->vacantsea_model->get_vacantsea());

	

	

?>

<section>

	<div class="container">

    <div class="row title text-center">



			<h3>GOOD VACANTSEA</h3>



			<!--<h6 class="alt">What We Offer</h6>-->



		</div>

<!--		<div class="row text-left no-margin">

			<h3 class="small-margin">GOOD VACANTSEA</h3>

-->			<!-- <h6 class="alt small-margin">Your job for the future</h6> -->

		<!--</div>-->

		<div class="row">

			<div class="col-md-12">

				<p class="blue-color"> Latest Vacantsea <!-- <?=$jml_vacantsea?> Vacantsea Found --> </p>

                

                <div class="table-responsive">

                    <table class="table table-striped">

                        <thead>

                        <tr>

                            <th>Vacantsea Title</th>

                            <th>Agentsea</th>

                            <th>Vessel Type</th>

                            <!-- <th>Location</th> -->

                            <th>Contract Dynamic</th>

                            <th>&nbsp;</th>

                        </tr>

                        </thead>

                        <tbody class="">

                            <?php

                                foreach($vacantsea as $row)

                                {

                                    $q = "select * from ship_type where type_id = '$row[ship_type]'";

                                    $exec = $this->db->query($q);

                                    $dt_vessel = $exec->row_array();

                                    
									if($row["id_perusahaan"] > 0)
									{
                                    	$company = $this->company_model->get_detail_company($row["id_perusahaan"]);
									}
									else
									{
										$company = json_decode($row["data_scrap"],TRUE);	
									}
                                    

                                    if(!empty($row["annual_sallary"])){

    

                                        $smt = explode(" - ",$row["annual_sallary"]);

                                        

                                        //print_r($smt);

                                        

                                        if(count($smt) == 1)

                                        {

                                            $sallary = !empty($id_user) ? $row['sallary_curr']." ".number_format($row["annual_sallary"])." $row[sallary_range] " 

                                            : "Login";

                                        }

                                        else

                                        {

                                            $sallary = !empty($id_user) ? $row['sallary_curr']." ".number_format($smt[0])." - ".

                                            number_format($smt[1]).

                                            " $row[sallary_range] " 

                                            : "Login";	

                                        }

                                    }

                                    else 

                                    {

                                        $sallary = !empty($id_user) ? "Negotiable" : "Login";

                                            

                                    }

                                    

                                    //echo "$company[username] <br>";

                            ?>

                            <tr>

                                <td style="">

                                	<span class="">
									
                                    <?php if($row["id_perusahaan"] > 0){ $url = base_url("agentsea/$company[username]"); }else{ $url = "#"; }?>
                                    
                                    <a href="<?=$url?>" >

                                    <img height="46" width="46" class="img-thumbnail" src="<?=check_logo_agentsea($company["username"])?>" alt="">											

                                    </a>

                                    </span>

                                    <span style="" class="" title="<?=$row["vacantsea"]?>" data-toggle="tooltip" data-placement="top">

                                        <a href="<?=base_url("vacantsea/detail/".$row["vacantsea_id"]."/".url_title($row['vacantsea'])); ?>">

											

											<?=substr($row["vacantsea"],0,30)?>

                                        </a>

                                    </span>

                                    <span class="clearfix"></span>

                                </td>

                                <td>
								   <?php if(empty($row["id_perusahaan"])){?>
                                    <a href="<?=base_url("agentsea/$company[username]")?>">
                                    	<?=$row["perusahaan"]?>
                                    </a>
								   <?php } else {?>
                                   
                                   	<?=$row["perusahaan"]?>
                                   <?php } ?>
                                </td>

                                <td>

                                    <?php

                                        /*if($row["contract_dynamic"] != "")

                                        {

                                            $option_text = $row["contract_dynamic"];

                                        }

                                        else if($row["contract_type"] != "")

                                        {

                                            $option_text = $row["contract_type"];

                                        }

                                        else if($row["benefits"] != "")

                                        {

                                            $option_text = $row["benefits"];

                                        }

                                        else if($row["experience"] != "")

                                        {

                                            $option_text = $row["experience"];

                                        }*/

                                    ?>

                                    <?php if($dt_vessel != null){ ?>

                                    <span class="pill medium green"><?=$dt_vessel["ship_type"]?></span>

                                    <?php } ?>

                                </td>

                                <!--<td>

                                    New York City

                                </td>-->

                                <td>

                                    <?=$row['contract_dynamic']?>

                                    <!--24$/h-->

                                    <?php 

                                        /* // echo number_format($row['annual_sallary'])." $row[sallary_curr]$row[sallary_range]" 

                                        if($sallary == "Login")

                                        {

                                            echo "<span class='pill medium blue' title='Please login to view the sallary' 

                                            data-toggle='modal' data-target='#myModal' onclick=\"fill_hidden_modal('detail',$row[vacantsea_id])\" style='cursor:pointer'>$sallary</span>";

                                        }

                                        else

                                        {

                                            echo $sallary;

                                        } */

                                   ?>

                                </td>

                                <td class="">

                                    <a href="#" data-toggle='modal' data-target='#myModal' class="btn btn-small blue btn-apply" onclick="fill_hidden_modal('apply', <?php echo $row['vacantsea_id'] ?>)">Apply</a>

                                </td>

                            </tr>

                            <?php

                            }

  

                            ?>

                        

                        </tbody>

                    </table>

                </div>

                

              

                            

                <div class="row">

                    <div class="col-md-12 text-right">

                      <a href="<?=base_url("vacantsea")?>"><i class="fa fa-angle-double-right"></i> see all vacantsea</a>

                    </div>

                </div>

                

				<!-- <div class="tabs-container">

					<div class="tab-nav">

						<a href="#" class="active">For Seafarer</a>

			

					</div>

					<div class="tab-holder">

						<div class="tab">

							

						</div>

						

					</div>

				</div> -->

			</div>

		</div>

	</div>

</section>

