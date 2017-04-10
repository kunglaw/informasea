<?php //section7 

	// di group dahulu vacantsea berdasarkan rank
	// jumlah vacantsea berdasarkan rank
	// temukan total vacantsea 
	
	//load model rank
	$this->load->model("rank_model");
	$this->load->model("department_model");
	
	$str_general = "SELECT vacantsea.*, perusahaan.id_perusahaan, perusahaan.activation_code FROM vacantsea,perusahaan WHERE perusahaan.id_perusahaan = vacantsea.id_perusahaan AND perusahaan.activation_code = 'ACTIVE' AND perusahaan.tampil = 1 AND vacantsea.stat = 'open' ";
	
	$str_vac = "$str_general ORDER BY create_date ASC, vacantsea_id DESC";
	$q_vac = $this->db->query($str_vac);
	$f_vac = $q_vac->result_array();
	
	// GROUP BY RANK
	$str_gvac = "$str_general GROUP BY rank_id ORDER BY create_date ASC, vacantsea_id DESC";
	$q_gvac = $this->db->query($str_gvac);
	$f_gvac = $q_gvac->result_array();
	
	
	$jml_vacantsea = count($f_vac);
	
?>



<section>

	<div class="container">
		
		<div class="row title text-center">

			<h3>JOB STATISTIC</h3>

			<h6 class="alt">Here are the Most Popular Categories</h6>

		</div>

		<div class="row">
		  <?php
			foreach($f_gvac as $row)
			{
				//load
				
				$rank = $this->rank_model->get_rank_detail_byid($row["rank_id"]);
				$department = $this->department_model->get_detail_department($rank["id_department"]);
				
				$str_vacperrank = $str_general." AND department = '$rank[id_department]' ";
				$q_vacperrank = $this->db->query($str_vacperrank);
				$f_vacperrank = $q_vacperrank->result_array();
				
				$jml_vacperrank = count($f_vacperrank);
				$percent = ($jml_vacperrank / $jml_vacantsea) * 100;
								
				//echo $row["rank_id"]." <br>";	
		  ?>
			<div class="col-md-4 col-sm-6 col-xs-12 statistic" title="<?=$jml_vacperrank." vacantseas "?>">

				<div class="left-column">

					<input class="dial" value="<?=$percent?>" data-readonly="true" data-fgColor="#22c0e8" data-linecap="round" data-width="70" data-inputcolor="#2f2f2f">

				</div>

				<div class="right-column">
					<?php
						$dept = url_title($department["department"]);
						$rank2 = url_title($rank["rank"]); 
					?>
					<a href="<?=base_url("vacantsea/search?department=$dept&rank=$rank2")?>" target="_blank"><h3> <?=$rank["rank"]?></h3></a>

				</div>

			</div>
		  <?php 
			}
		  ?>
            
			<?php /* 
			<div class="col-md-4 col-sm-6 col-xs-12 statistic">

				<div class="left-column">

					<input class="dial" value="71" data-readonly="true" data-fgColor="#65be3e" data-linecap="round" data-width="60" data-inputcolor="#2f2f2f">

				</div>

				<div class="right-column">

					<h5>Development</h5>

					<p>Using the outcomes from the best  Analysis, we will put together a plan.</p>

				</div>

			</div>

			<div class="col-md-4 col-sm-6 col-xs-12 statistic">

				<div class="left-column">

					<input class="dial" value="63" data-readonly="true" data-fgColor="#ec6be1" data-linecap="round" data-width="60" data-inputcolor="#2f2f2f">

				</div>

				<div class="right-column">

					<h5>Internet & Marketing</h5>

					<p>Using the outcomes from the best  Analysis, we will put together a plan.</p>

				</div>

			</div>

			<div class="col-md-4 col-sm-6 col-xs-12 statistic">

				<div class="left-column">

					<input class="dial" value="76" data-readonly="true" data-fgColor="#fb4848" data-linecap="round" data-width="60" data-inputcolor="#2f2f2f">

				</div>

				<div class="right-column">

					<h5>Design & Architecture</h5>

					<p>Using the outcomes from the best  Analysis, we will put together a plan.</p>

				</div>

			</div>

			<div class="col-md-4 col-sm-6 col-xs-12 statistic">

				<div class="left-column">

					<input class="dial" value="90" data-readonly="true" data-fgColor="#3fccc7" data-linecap="round" data-width="60" data-inputcolor="#2f2f2f">

				</div>

				<div class="right-column">

					<h5>Educational</h5>

					<p>Using the outcomes from the best  Analysis, we will put together a plan.</p>

				</div>

			</div>

			<div class="col-md-4 col-sm-6 col-xs-12 statistic">

				<div class="left-column">

					<input class="dial" value="63" data-readonly="true" data-fgColor="#faba20" data-linecap="round" data-width="60" data-inputcolor="#2f2f2f">

				</div>

				<div class="right-column">

					<h5>Business & Lifestyle</h5>

					<p>Using the outcomes from the best  Analysis, we will put together a plan.</p>

				</div>

			</div>
			*/ ?>

		</div>

	</div>

</section>