<?php
$id_perusahaan      = $company['id_perusahaan'];
$nama_perusahaan    = $company['nama_perusahaan'];
$nationality        = $company['nationality'];
$description        = $company['description'];
$website            = $company['website'];
$no_telp            = $company['no_telp'];
$fax                = $company['fax'];
$email              = $company['email'];
$contact            = $company['contact_person'];
$address            = $company['address'];
$profil_pic	     = check_logo_agentsea_thumb($company["username"]);
?>
<br />
<div class="about" id="about">       
    <?php
    if ($this->session->userdata("username_company")!="") {
    //login
    ?>
     <div class="media">
        <a class="pull-left" href="#">
        <img src="<?= $profil_pic ?>" alt="" id="img-profile-company" class="logo-container thumbnail block " style="border:1px solid #CCC" height="54" width="102" />
        </a>
        <div class="media-body">
        <div class="pull-left">
            <h4 class="media-heading"><span class="text-link"><?= $company["nama_perusahaan"] ?></span></h4>
            <p><span class="text-gray"><?=flag_nationality($company["nationality"])?></span></p>
        </div>
        <span class="clearfix"></span>
        </div>
            
    </div>
        <h5 class="text-gray"><?=$this->lang->line("description")?></h5>
        <p class="text-gray7"><?=$description;?></p>

        <table class="text-gray6" width="75%">
            <!-- 
            <tr>
                <td width="20%">No Telp</td>
                <td width="5%">:</td>
                <td><?=e_field($no_telp);?></td></tr>
            <tr>
                <td>Fax</td>
                <td>:</td>
                <td><?=e_field($fax)?></td>
            </tr> 
            -->
            <tr>
                <td><?=$this->lang->line("website")?></td>
                <td>:</td>
                <td><a href="<?=e_href('http://'.$website);?>" target="_blank"><?=e_field($website);?></a></td>
            </tr>
            <tr>
                <td>email</td>
                <td>:</td>
                <td><?=e_field($email);?></td>
            </tr>
            <tr>
                <td><?=$this->lang->line("contact_person")?></td>
                <td>:</td>
                <td><?=e_field($contact);?></td></tr>
            <tr>
                <td><?=$this->lang->line("address")?></td>
                <td>:</td>
                <td><?=e_field($address);?></td></tr>
        </table>
        

    <?php } else { ?>
     <div class="media">
        <a class="pull-left" href="#">
        <img src="<?= $profil_pic ?>" alt="" id="img-profile-company" class="logo-container thumbnail block " style="border:1px solid #CCC" height="54" width="102" />
        </a>
        <div class="media-body">
        <div class="pull-left">
            <h4 class="media-heading"><span class="text-link"><?=$company["nama_perusahaan"]?></span></h4>
            <p><span class="text-gray"><?=flag_nationality($company["nationality"])?></span><br />
            <i><b><?=$website;?></b></i><br>
            <i><b><?=$email;?></b></i>
            </p>
        </div>
        <span class="clearfix"></span>
        </div>
            
    </div>
    
    <h5 class="text-gray"><?=$this->lang->line("vision")?></h5>
    <div style="width:87%"><p class="text-gray7"><?=e_vision($company['visi']);?></p></div>
    
    <h5 class="text-gray"><?=$this->lang->line("mision")?></h5>
    <div style="width:87%"><p class="text-gray7"><?=e_mision($company['misi']);?></p></div>
    
    <h5 class="text-gray"><?=$this->lang->line("description")?></h5>
    <div style="width:87%"><p class="text-gray7"><?=e_desc($description);?></p></div>
    <?php } ?>

</div>
<div id="result_update"></div>