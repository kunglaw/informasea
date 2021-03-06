<?php

$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$id_user = $this->session->userdata("id_user");

?>

<?php foreach($list as $row):
    //$annual_sallary = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
    //$rank = $this->rank_model->get_rank_detail($row['rank_id']);
    $id_perusahaan      = $row['id_perusahaan'];
    $des_comp           = $row["description"];

    $nationality        = $this->nation_model->get_detail_nationality($row['id_nationality']);
    $name_nationality   = strtolower(str_replace(" ", "-", $nationality['name']));
    $flag_nationality   = $nationality['flag'];

    //$jml_applicant      = $this->vacantsea_model->jml_applicant($row['vacantsea_id'],$id_user);

    $detail_comp        = $this->company_model->get_detail_company($row["id_perusahaan"]);
    $name_company       = $detail_comp["nama_perusahaan"];
    $username_comp      = $detail_comp["username"];
    $logo_img           = $this->company_model->get_logoimage2($username_comp);
    $path_img      	   = img_url("company/photo/$username_comp/profil_pic/$logo_img");	
	
    $jml_vacantsea      = $this->company_model->count_vacantsea("where id_perusahaan='$id_perusahaan'")->num_rows();
    $jml_available      = $this->company_model->count_vacantsea("where id_perusahaan='$id_perusahaan' AND expired_date >= curdate()")->num_rows();
    $jml_ship           = $this->company_model->count_ship("where id_perusahaan='$id_perusahaan'")->num_rows();
	
	$path_img = check_logo_agentsea_thumb($username_comp);
	
    ?>

    <div class="list-group-item">
        <div class="media">
            <div class="media-left text-center"><br />
                <a href="<?= base_url("company/".$username_comp."/home")?>">

                <img src="<?= $path_img ?>" alt="" id="img-profile-company" class="thumbnail block " style="border:1px solid #CCC" height="80" width="102" />    
                </a>
                <div class="text-gray applicants ft-12"></div>
            </div>
            <div class="media-body">
                <div class="float-left media-heading medium" style="float:left;margin-top:15px;">
                    <?php if($this->session->userdata('id_perusahaan') == $row['id_perusahaan'] AND $this->session->userdata('account_type') == "Alpha"){ ?>
                    <a href="<?= alpha_url($username_comp."/home")?>" class="text-link"><h4><?=$name_company;?></h4></a>
                    <?php } else{ ?>
                    <a href="<?= base_url("agentsea/".$username_comp."/home")?>" class="text-link"><h4><?=$name_company;?></h4></a>

                    <?php } ?> 
                </div>
                <div style="clear: both; float:left" class="subtitle text-gray">
                    
				  <?php if(!empty($name_nationality)){ ?>
                  <a href="<?=base_url("company/search?nationality=".$name_nationality);?>">
                      <img src="<?=strtolower(asset_url("flags/".$flag_nationality));?>">
                      <?=$nationality['name']; ?>
                  </a>    
                  <?php } else {echo "  ";} ?>
                        
                </div>
                <div class="float-right subtitle text-gray" style="float:right">
                    <?php if (!empty($jml_available)){ ?>
                        <a href="<?=base_url("company/$username_comp/vacantsea");?>" style="color:#b5b5b5">Available : <?=$jml_available;?></a><br />
                    <?php } 
                    if(!empty($jml_vacantsea)){ ?>
                        <a href="<?=base_url("company/$username_comp/vacantsea");?>" style="color:#b5b5b5">Vacantsea : <?=$jml_vacantsea; ?></a><br />
                    <?php } 
                    if(!empty($jml_ship)){ ?>
                        <a href="<?=base_url("company/$username_comp/ships");?>" style="color:#b5b5b5">Ships : <?= $jml_ship;?></a><br />
                    <?php } ?>
                </div>         
                <div style="clear: both"></div> 
                <p style="width:87%" align="justify"><?=$des_comp?> </p>
            </div>
        </div>
    </div>
<?php
endforeach;
?>