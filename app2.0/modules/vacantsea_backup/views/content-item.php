<?php
/**
 * Created by PhpStorm.
 * User: Mohamad
 * Date: 5/7/2015
 * Time: 10:09 AM
 */

$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$id_user = $this->session->userdata("id_user");


?>

<?php foreach($vacantsea as $row):
    $annual_sallary = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
    $rank = $this->rank_model->get_rank_detail($row['rank_id']);
    $nationality = $this->nation_model->get_detail_nationality($row['id_nationality']);
    $jml_applicant = $this->vacantsea_model->jml_applicant($row['vacantsea_id'],$id_user);
    $jml_applicant = $jml_applicant == 0 ? "" : $jml_applicant;
    $detail_comp = $this->company_model->get_detail_company($row["id_perusahaan"]);
    $username_comp = $detail_comp["username"];
    $logo_img = $detail_comp["logo_image"];
    $path_img = img_url("company/photo/$username_comp/logo/$logo_img");
    ?>

    <div class="list-group-item">
        <div class="media">
            <div class="media-left text-center">
                <img src="<?= $path_img ?>" alt="" id="img-profile-company" class="logo-container thumbnail block " style="border:1px solid #CCC" height="54" width="102" />
                <button class="btn btn-filled btn-full block">
                    Apply
                </button>
                <div class="text-gray applicants ft-12"><?=$jml_applicant?></div>
            </div>
            <div class="media-body">
                <div class="float-left media-heading medium">
                    <a href="#" class="text-link"><h4><?=$detail_comp["nama_perusahaan"]?></h4></a>
                </div>
                <div class="float-right subtitle text-gray">Posted: <?= date_format_simple($row['create_date']); ?></div>
                <div style="clear: both"></div>
                <div class="subtitle text-gray"><?= $nationality["name"] ?></div>
                <div class="subtitle custom-h4"><?= $rank["rank"]?></div>
                <div class="subtitle text-gray">Annual Salary:</div>
                <h4 class="text-link custom-h4" >IDR Rp. <?= number_format($row["annual_sallary"]) ?></h4>
                <div class="subtitle text-gray">Position:</div>
                <a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"])?>" class="subtitle text-link"><h4 class="custom-h4"><?=$row["vacantsea"]?></h4></a>

                <p><?=$row["description"]?> </p>
            </div>
        </div>
    </div>
<?php
endforeach;
?>