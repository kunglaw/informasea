<?php
	$coc_class = $resume['profile']['coc_class'];
	$rank = $resume['profile']['rank'];
	$vessel_type = $resume['profile']['vessel_type'];
	$q = "select coc_class from coc_class where id_coc_class = '$coc_class'";
	$exec = $this->db->query($q);
	$dt_coc = $exec->row_array();

	$q = "select rank from rank where rank_id = '$rank'";
	$exec = $this->db->query($q);
	$dt_rank = $exec->row_array();

	$q = "select ship_type from ship_type where type_id = '$vessel_type'";
	$exec = $this->db->query($q);
	$dt_vessel = $exec->row_array();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Resume Print</title>
		
		<link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
		<style type="text/css">
		@media all{
			table.data {
			  margin: 0 auto;
			  width: 100%;
			  border-collapse: collapse;
			  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
			}
			tbody {
			  color: #000;
			}
			table.data th, table.data td {
			  padding: 5px 10px;
			  border: 2px solid #EEF7FB;
			  font-size:12px;
			}
			table.data tr {
			  font: normal 14px Tahoma, Geneva, sans-serif;
			  background: #bfbfbe;
			  
			}
			table.data td {
			  -webkit-transition: all 0.7s ease-in-out 0s;
			  -moz-transition: all 0.7s ease-in-out 0s;
			  -o-transition: all 0.7s ease-in-out 0s;
			  transition: all 0.7s ease-in-out 0s;
			  font-size:12px;
			}
			table.data tr:nth-child(2n+0) {
			  background: #dadada;
			}
			table.data td:hover, table.data td:nth-child(2n+0):hover {
			  background: #EEF7FB;
			}
			table.data th {
			  background: #3EA4D0;
			  color: #DAEEF6;
			  text-shadow: 1px 1px 0 #1F627F;
			  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25), 0 0 100px rgba(0, 0, 0, 0.15) inset;
			  font: bold 16px Arial, Helvetica, sans-serif;
			}

			.judul-tulisan{
				background-color: #3093e4;
			}
			
		
		}
			
		</style>
	</head>
	<body>
		<!-- <div id="background"> -->
		<div class="row" style="margin-left: 10px; margin-top: 100px">
			<div class="col-md-4">
				<!-- Content Kiri -->
				<div style="width:100%;">
					<div style="width: 40%; position: absolute">
						<img src="<?php echo check_img_resume($resume['pelaut']['username']) ?>" width="100" height="133" style="background-color: white">
					</div>
					<div style="width: 80%; margin-left: 150px; float: left; margin-top: -160px">
						<h2 style="text-transform: uppercase"><?php echo $nama_pelaut ?></h2>
						<table border="0">
						<tr>
							<td width="175">Nationality / Status</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['pelaut']['kebangsaan'] ?> / <?php echo $resume['pelaut']['status_perkawinan'] ?></td>
						</tr>
						<tr>
							<td>Place / Date of Birth</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['pelaut']['tempat_lahir'] ?> / <?php echo date('d F Y', strtotime($resume['pelaut']['tanggal_lahir'])) ?></td>
						</tr>
						<tr>
							<td>Height / Weight</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['profile']['height'] ?> cm / <?php echo $resume['profile']['weight'] ?> kg</td>
						</tr>
						<tr>
							<td>Clothes / Shoes Size</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['profile']['clothes_size'] ?> / <?php echo $resume['profile']['shoes_size'] ?></td>
						</tr>
						<tr>
							<td>Phone No</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['pelaut']['telepon']." / ".$resume['pelaut']['handphone'] ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['pelaut']['email'] ?></td>
						</tr>
						<tr>
							<td>Next of Kin / Relationship</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['pelaut']['keluarga_terdekat'] ?> / <?php echo $resume['pelaut']['hubungan'] ?></td>
						</tr>
					</table>
						<!-- <p style="text-align: justify; font-size: 14pt;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
					</div>
					<div style="width: 40%; position: absolute">
						&nbsp;
					</div>
					<div style="width: 80%; margin-left: 150px; float: left; margin-top:10px ">
						<!-- <h4>
                        <img src="<?php echo asset_url() ?>img/professional-curriculum--16.png" width="30" height="30" > 
                        <u>Last Education</u></h4> -->
						<table border="0">
						<tr>
                        	<td width="175">Last Education</td>
							<td>&nbsp;:&nbsp;</td>
							<td colspan="3" style="font-weight: 700"><?php echo $resume['profile']['last_education'] ?></td>
							
						</tr>
						<!-- <tr>
							<td colspan="3" style="font-weight: 700">&nbsp;</td>
							
						</tr>-->
						<?php if($dt_coc != null){ ?>

						<tr>
							<td width="175">COC Class</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $dt_coc['coc_class'] ?></td>
						</tr>
						<?php } if($dt_rank != null){ ?>
						<tr>
							<td >Rank</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $dt_rank['rank'] ?></td>
						</tr>
						<?php } if($dt_vessel != null){ ?>
						<tr>
							<td >Vessel Type</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $dt_vessel['ship_type'] ?></td>
						</tr>
						<?php } if(($resume['profile']['exp_sallary_curr'] != "") and ($resume['profile']['expected_sallary'] != "") and ($resume['profile']['sallary_range'])) { ?>
						<tr>
							<td >Expected Salary</td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $resume['profile']['exp_sallary_curr']." ".number_format($resume['profile']['expected_sallary'])."/".$resume['profile']['sallary_range'] ?></td>
						</tr>
						<?php } ?>
					</table>
						<!-- <p style="text-align: justify; font-size: 14pt;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
					</div>
					<!-- <hr style="width: 120px; border: 2px solid black; text-align: left"> -->
					
				</div>
				<!-- <div id="TwitterIcon"><img src="images/TwitterIcon.png"></div> -->
				<!-- <div id="StarWebsite"><img src="images/StarWebsite.png"></div> -->
				<!-- <div id="EmailIcon"><img src="images/EmailIcon.png"></div> -->
				<!-- <div id="HeartTel"><img src="images/HeartTel.png"></div> -->
				<!-- <div id="YourName" style="font-size: 32pt; font-weight: 700; text-align: center">RADITYA PRATAMA</div>
				<div id="IntroText" style="text-align: justify; font-size: 24pt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<!-- <img src="images/IntroText.png"> </div> -->
				<!-- <div id="Symbol"><img src="images/Symbol.png" width="75"></div> -->
				<!-- <div id="IMGBackgroundBox"><img src="images/IMGBackgroundBox.png"></div> -->
				<!-- <div id="IMGUnderline"><img src="images/IMGUnderline.png" width="120"></div> -->
				<!-- <div id="Photograph"></div> -->
				<span class="clearfix"></span>
			</div>
			<div class="col-md-8">
				<!-- Content Kanan -->
				<br>
				<?php if(($resume['document'] != null) or ($resume['medical'] != null) or ($resume['visa'] != null)){ ?>
				<h3 style="color: white;" class="judul-tulisan">DOCUMENTS</h3>
				<?php if($resume['document'] != null){ ?>
				<h5 ><u>Travel Document</u></h5>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Document Name</th>
						<th>ID</th>
						<th>Issued Place</th>
						<th>Issued Date</th>
						<th>Expired Date</th>
					</tr>
					<?php 
					$x=1;
					
					foreach ($resume['document'] as $row) {
						if($row['type_document'] != "document") continue;

						echo "<tr>";
						echo "<td>$x</td>";
						echo "<td>$row[country] $row[type]</td>";
						echo "<td>$row[number]</td>";
						echo "<td>$row[place]</td>";
						echo "<td>$row[date_issued]</td>";
						echo "<td>$row[date_expired]</td>";
						echo "</tr>";
						$x++;
					}
					 ?>
					
				</table>
				<?php } if($resume['medical'] != null) { ?>
				<!-- <ul>
					<li>Document 1 #numberIDofDocument
						<br>testing 123123123
						<br>&nbsp;
					</li>
					<li>Document 2 #numberIDofDocument</li>
					<li>Document 3 #numberIDofDocument</li>
				</ul> -->
				<h5><u>Medical Record</u></h5>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Document Name</th>
						<th>ID</th>
						<th>Issued Place</th>
						<th>Issued Date</th>
						<th>Expired Date</th>
					</tr>
					<?php
						$x=1;
						foreach ($resume['medical'] as $row) {
							

							echo "<tr>";
							echo "<td>$x</td>";
							echo "<td>$row[type]</td>";
							echo "<td>$row[number]</td>";
							echo "<td>$row[place]</td>";
							echo "<td>$row[date_issued]</td>";
							echo "<td>$row[date_expired]</td>";
							echo "</tr>";
							$x++;
						}
						
					?>
					
				</table>
				<?php } if($resume['visa'] != null){ ?>
				<h5><u>Visa</u></h5>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Document Name</th>
						<th>ID</th>
						<th>Issued Place</th>
						<th>Issued Date</th>
						<th>Expired Date</th>
					</tr>
					<?php
						$x=1;
						
						foreach ($resume['visa'] as $row) {
							

							echo "<tr>";
							echo "<td>$x</td>";
							echo "<td>$row[type]</td>";
							echo "<td>$row[number]</td>";
							echo "<td>$row[place]</td>";
							echo "<td>$row[date_issued]</td>";
							echo "<td>$row[date_expired]</td>";
							echo "</tr>";
							$x++;
						}
						
					?>
				</table>
				<?php } //tutup dari visa ?>
				<hr>
				<?php } //tutup dari document 
					if($resume['compentency'] != null) {
				?>
				<h3 class="judul-tulisan" style="color: white">COC and ENDORSEMENT</h3>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Document Name</th>
						<th>ID</th>
						<th>Issued Place</th>
						<th>Issued Date</th>
						<th>Expired Date</th>
					</tr>
					<?php
						$x=1;
						
						foreach ($resume['compentency'] as $row) {
							

							echo "<tr>";
							echo "<td>$x</td>";
							echo "<td>$row[grade_license]</td>";
							echo "<td>$row[no_license]</td>";
							echo "<td>$row[place_issued]</td>";
							echo "<td>$row[date_issued]</td>";
							echo "<td>$row[expired_date]</td>";
							echo "</tr>";
							$x++;
						}
						
					?>
				</table>
				<hr>
				<?php }
					if($resume['proficiency'] != null){
				 ?>
				<h3 class="judul-tulisan" style="color: white;">Certificate of Proficiency</h3>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Document Name</th>
						<th>ID</th>
						<th>Issued Place</th>
						<th>Issued Date</th>
						<th>Expired Date</th>
					</tr>
					<?php
						$x=1;
						
						foreach ($resume['proficiency'] as $row) {
							

							echo "<tr>";
							echo "<td>$x</td>";
							echo "<td>$row[sertifikat_stwc]</td>";
							echo "<td>$row[no_sertifikat]</td>";
							echo "<td>$row[place_issue]</td>";
							echo "<td>$row[date_issue]</td>";
							echo "<td>$row[expired_date]</td>";
							echo "</tr>";
							$x++;
						}
						
					?>
				</table>
				<hr>
				<?php }
					if($resume['experience'] != null){
				 ?>
				<h3 class="judul-tulisan" style="color: white;">Sea Service Record</h3>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Vessel Name</th>
						<th>Vessel Type</th>
						<th>Size</th>
						<th>Rank</th>
						<th>Company</th>
						<th>Period</th>
					</tr>
					<?php
						$x=1;
						
						foreach ($resume['experience'] as $row) {
							$q = "select rank from rank where rank_id = '$row[rank_id]'";
							$exec = $this->db->query($q);
							$dt_rank_exp = $exec->row_array();

							$q = "select ship_type from ship_type where type_id = '$row[ship_type_id]'";
							$exec = $this->db->query($q);
							$dt_vessel_exp = $exec->row_array();

							echo "<tr>";
							echo "<td>$x</td>";
							echo "<td>$row[ship_name]</td>";
							echo "<td>$dt_vessel_exp[ship_type]</td>";
							echo "<td>$row[weight] $row[satuan]</td>";
							echo "<td>$dt_rank_exp[rank]</td>";
							echo "<td>$row[company]</td>";
							echo "<td>".date("M d, Y", strtotime($row['periode_from']))." - ".date("M d, Y", strtotime($row['periode_to']))."</td>";
							echo "</tr>";
							$x++;
						}
					
					?>
				</table>
				<hr>
				<?php } ?>
				<!-- <div id="Background"><img src="images/Background.png"></div>
				<div id="layer_2004"><img src="images/layer_2004.png"></div>
				<div id="layer_20052007"><img src="images/layer_20052007.png"></div>
				<div id="MatriculatedInstitut"><img src="images/MatriculatedInstitut.png"></div>
				<div id="BAGraphicDesignMulti"><img src="images/BAGraphicDesignMulti.png"></div>
				<div id="HeadingBG"><img src="images/HeadingBG.png"></div>
				<div id="EDUCATIONHeading"><img src="images/EDUCATIONHeading.png"></div>
				<div id="GraphicDesign"><img src="images/GraphicDesign.png"></div>
				<div id="WebDevelopment"><img src="images/WebDevelopment.png"></div>
				<div id="WebDesign"><img src="images/WebDesign.png"></div>
				<div id="WebsiteDesignsitemap"><img src="images/WebsiteDesignsitemap.png"></div>
				<div id="HeadingBG_0"><img src="images/HeadingBG_0.png"></div>
				<div id="SKILLSHeading"><img src="images/SKILLSHeading.png"></div>
				<div id="CoverSCorners"><img src="images/CoverSCorners.png"></div>
				<div id="layer_20072008"><img src="images/layer_20072008.png"></div>
				<div id="layer_20082009"><img src="images/layer_20082009.png"></div>
				<div id="2009Present"><img src="images/2009Present.png"></div>
				<div id="CreativeDirectorComp"><img src="images/CreativeDirectorComp.png"></div>
				<div id="WebsiteDesignerCompa"><img src="images/WebsiteDesignerCompa.png"></div>
				<div id="GraphicDesignerCompa"><img src="images/GraphicDesignerCompa.png"></div>
				<div id="HeadingBG_1"><img src="images/HeadingBG_1.png"></div>
				<div id="EXPERIENCEHeading"><img src="images/EXPERIENCEHeading.png" width="120"></div> -->
			</div>
		</div>

		

			
		<!-- </div> -->
		<script type="text/javascript" src="<?php echo asset_url() ?>js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="<?php echo asset_url() ?>bootstrap/js/bootstrap.min.js"></script>
 </body>
 </html>