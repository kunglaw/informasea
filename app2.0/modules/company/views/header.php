<link href="<?=asset_url("plugin/cover-reposition/cover-style.css")?>" rel="stylesheet">

<script src="<?=asset_url("js/jquery.form.min.js")?>"></script>



<script>

    function change_cover()

    {

        //alert("test");

        var crop_header = $("#crop-header");

        

        $("#profile-header").hide();

        $("#crop-header").show();

        

        repositionCover();

        

    }



</script>

 <?php

    $username_uri 			  = $this->uri->segment(2);

 	$data['company']	   = $this->company_model->get_company("where username='$username_uri'")->row_array();

	

	$cover 		 = check_cover_agentsea($username_uri);

	$profile_pic   = check_logo_agentsea_thumb($username_uri);

	$company_name  = $company['nama_perusahaan'];

	$nationality   = $company['nationality'];

	$website	   = $company['website'];

 

 ?>

 <div id="profile-header" style="background-image:url(<?=$cover?>); background-repeat:no-repeat; background-size:cover">

 <?php if($this->session->userdata('id_perusahaan') != "" AND ($this->uri->segment(2) == $this->session->userdata('username_company'))) { ?>

   <a href="#" onclick="javascript:change_cover()"><div class="icon-block icon-block-md btn-filled">

        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>

    </div> </a>



    <?php } else {



    } ?>

    <img src="<?=$cover?>" alt="" class="img-responsive" width="100%">

    <div class="media">

        <a class="pull-left" href="#">

            <img class="media-object" src="<?=$profile_pic;?>" alt="Image" style="background-color:#FFF">

        </a>

        <div class="media-body text-white">

            <h3 class="media-heading "><?=$company_name?></h3>

            <br>

            <p class="sub-header-left"><?=$website;?><br><b><?=flag_nationality($nationality)?></b></p>

            <p class="sub-header-right"><?=$btn_dasboard;?></p>

        </div>

    </div>

    <div class="profile-text-container">

    </div>

</div>



<?php include "crop_header_new.php"; ?>