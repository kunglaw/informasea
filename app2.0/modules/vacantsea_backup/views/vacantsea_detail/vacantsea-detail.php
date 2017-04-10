<?php
$username_comp = $company["username"];
$logo_img = $company["logo_image"];
$path_img = img_url("company/photo/$username_comp/logo/$logo_img");
$vacantsea_title = $title;
$id = $this->uri->segment(3);
$sess_data = $this->session->all_userdata();
$sallary = !empty($sess_data['username']) ? "Rp. ".number_format($vacantsea["annual_sallary"]) : "Please Login to view the Salary";
?>

<div class="col-md-9">
    <div class="box">
        <div class="media">
            <a class="pull-left" href="#">
                <img src="<?= $path_img ?>" alt="" id="img-profile-company" class="logo-container thumbnail block " style="border:1px solid #CCC" height="54" width="102" />
            </a>

            <div class="media-body">
                <div class="pull-left">
                    <h4 class="media-heading"><span class="text-link"><?= $company["nama_perusahaan"] ?></span></h4>

                    <p><span class="text-gray"><?=$nationality["name"]?></span><br>
                        <b><?=$vacantsea["vacantsea"]?></b></p>
                </div>
                <!--                            <div class="pull-right">-->
                <!--                                <button type="button" class="btn btn-outline">Save Job</button>-->
                <!--                                <button type="button" class="btn btn-filled">Apply</button>-->
                <!--                            </div>-->
                <span class="clearfix"></span>
            </div>
        </div>
        <div class="information">
            <h5 class="text-gray">
                About company:
            </h5>

            <p class="text-gray7"><?=$company["description"]?></p>
            <table class="text-gray7">
                <tr>
                    <td>Web</td>
                    <td>:</td>
                    <td><a href="#" class="text-link"><?=$company["website"]?></a></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?=$company["email"]?></td>
                </tr>
                <tr>
                    <td>Phone number</td>
                    <td>:</td>
                    <td><?=$company["no_telp"]?></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="information">
            <h5 class="text-gray">Annual Salary</h5>

            <h3 class="text-link small-margin-top"><?= $sallary ?></h3>

            <h5 class="text-gray">Position</h5>

            <h3 class="text-link small-margin-top">Relief Master DP Cable Layer Immediate Start</h3>

            <p class="text-gray7"><?=$vacantsea["description"]?></p>
            <h5 class="text-gray">Qualification:</h5>
            <?php
            $qualification = [
                'Department',
                'Rank',
                'Ship Type',
                'Navigation Area/Country',
                'Salary',
                'Contract Type',
                'Contract Dynamic',
                'Benefits',
                'Vessel Name',
                'Requested Certificates',
                'Required Certificates of Competency',
                'Nationality'
            ];
            $qlt_value = [
                $department["department"],
                $rank["rank"],
                $ship_type["ship_type"],
                $vacantsea['navigation_area'],
                $vacantsea["annual_allary"],
                $vacantsea['contract_type'],
                $vacantsea['contract_dynamic'],
                $vacantsea['benefits'],
                $ship['ship_name'],
                $vacantsea['requested_certificates'],
                $vacantsea['requested_coc'],
                $nationality["name"]
            ]; ?>
            <div class="row text-gray7">
                <div class="col-md-6">
                    <table>

                        <?php
                        for ($i = 0; $i < 7; $i++) {
                            echo '<tr>
										<td>' . $qualification[$i] . '</td>
										<td>:</td>
										<td>'.$qlt_value[$i].'</td>
									</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <?php
                        for ($i = 7; $i < 13; $i++) {
                            echo '<tr>
										<td>' . $qualification[$i] . '</td>
										<td>:</td>
										<td>'.$qlt_value[$i].'</td>
									</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
            <br>

            <div>
                <div class="pull-left">
                    <p class="text-gray7"><span class="text-link">Posted</span>: Tuesday, November 18 &nbsp;
                        &nbsp; <span
                            class="text-link">End</span>: Tuesday, November 18</p>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-outline">Save Job</button>
                    <a href="<?= base_url("vacantsea/apply/$id/$vacantsea_title") ?>" class="btn btn-filled">Apply</a>
                </div>
                <span class="clearfix"></span>
            </div>
        </div>
    </div>
</div>