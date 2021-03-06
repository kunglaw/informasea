<?php

$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$id_user = $this->session->userdata("id_user");

?>

<?php foreach($list as $row):

    $nationality        = $this->nation_model->get_detail_nationality($row['id_nationality']);
    $name_nationality   = strtolower(str_replace(" ", "-", $nationality['name']));
    $flag_nationality   = $nationality['flag'];
    //$jml_applicant      = $this->vacantsea_model->jml_applicant($row['vacantsea_id'],$id_user);
    $detail_comp        = $this->company_model->get_detail_company($row["id_perusahaan"]);
    $id_perusahaan      = $row['id_perusahaan'];
    $username_comp      = $detail_comp["username"];
    $logo_img           = $this->company_model->get_logoimage2($username_comp);
    $path_img           = img_url("company/photo/$username_comp/profil_pic/$logo_img");
    $jml_vacantsea      = $this->company_model->count_vacantsea("where id_perusahaan='$id_perusahaan'")->num_rows();
    $jml_available      = $this->company_model->count_vacantsea("where id_perusahaan='$id_perusahaan' AND expired_date >= curdate()")->num_rows();
    $jml_ship           = $this->company_model->count_ship("where id_perusahaan='$id_perusahaan'")->num_rows();

    $exist_logo          = pathup("company/photo/$username_comp/profil_pic/$logo_img");
    
    if(!file_exists($exist_logo) || empty($logo_img))
    {
        $path_img = asset_url("img/ic_landing_company_blue.svg");
    }

?>

    <div class="list-group-item">
        <div class="media">
 <div class="media-left text-center"><br />
                <a href="<?= base_url("agentsea/".$username_comp."/home")?>">
                
                
                <img src="<?= $path_img ?>" alt="" id="img-profile-company" class="thumbnail block " style="border:1px solid #CCC" height="80" width="102" />
                
                </a>
                <div class="text-gray applicants ft-12"></div>
            </div>
            <div class="media-body">
                <div class="float-left media-heading medium" style="margin-top:15px;">
                    <a href="<?= base_url("company/".$username_comp."/home")?>" class="text-link"><h4><?=$detail_comp["nama_perusahaan"]?></h4></a>
                </div>
                <?php if($nationality['name'] != ""){ ?> 
                <div style="clear: both; float:left" class="subtitle text-gray">
                    <a href="<?=base_url("company/search?nationality=".$name_nationality);?>">
                        <img src="<?=strtolower(asset_url("flags/".$flag_nationality));?>">
                        <?=$nationality["name"]; ?>
                    </a>    
                </div>
                <?php } ?>
                <div class="float-right subtitle text-gray" style="float:right">
                    <?php if (!empty($jml_available)){ ?>
                        <a href="<?=base_url("company/$username_comp/vacantsea");?>" style="color:#b5b5b5"><?=$this->lang->line("availabele")?> : <?=$jml_available;?></a><br />
                    <?php } 
                    if(!empty($jml_vacantsea)){ ?>
                        <a href="<?=base_url("company/$username_comp/vacantsea");?>" style="color:#b5b5b5"><?=$this->lang->line("vacantsea")?> : <?=$jml_vacantsea; ?></a><br />
                    <?php } 
                    if(!empty($jml_ship)){ ?>
                        <a href="<?=base_url("company/$username_comp/ships");?>" style="color:#b5b5b5"><?=$this->lang->line("ship")?> : <?= $jml_ship;?></a><br />
                    <?php } ?>
                </div>
                <div style="clear: both"></div>                
                
                <p style="width:60%" align="justify"><?=$row["description"]?> </p>
            </div>
        </div>
    </div>
<?php
endforeach;
?>
<div id='notfound'><?//=$notfound;?></div>