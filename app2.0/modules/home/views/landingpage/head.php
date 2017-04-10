<?php // head, ALL MODULES, GENERAL 
	$this->load->config("meta");
	$title_tag = $this->config->item("title_tag");
?>
	
    <title> <?php echo $title ?> | <?php echo WEBSITE ?> - <?=INFORMASEA_SLOGAN?> | <?=$title_tag?>  </title>

    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta charset="utf-8">
    <?php 
		
		$this->load->view(@$meta); // satu page , satu meta 
		
	?>
    <link href="<?=asset_url("img/favicon.png")?>" rel="icon" type="image/x-icon"/>
    <!--    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/normalize.css")?>" />-->
    <!--    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/font.css")?>" />-->
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/bootstrap.min.css")?>" />
   
    <link rel="stylesheet" href="<?=asset_url("js/jquery-ui-1.11.4.custom/jquery-ui.min.css")?>" >
    
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/font-awesome/css/font-awesome.css")?>" />
    <!-- <link rel="stylesheet" type="text/css" href="<?=asset_url("css/informasea.css")?>" /> -->
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/informasea_new.css")?>" /> <!-- khusus untuk landing page -->
    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/utilities.css")?>" />

    <?php $this->load->view("landingpage/css"); ?>    
    
    <!-- 	<link rel="stylesheet" type="text/css" href="<?=asset_url("plugin/plugins/flexslider/flexslider.css")?>" />-->
    <!--    <link rel="stylesheet" type="text/css" href="<?=asset_url("css/full-slider.css")?>"  />-->
    
    <!--[if IE]>
    <script src="<?=asset_url("js/html5shiv.min.js")?>" ></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js")?>" ></script>
    <![endif]-->
    
    <?php // URUTAN INI TIDAK BOLEH BERUBAH ?>
    <script type="text/javascript" src="<?=asset_url("js/jquery.min.js")?>" ></script>
    <script type="text/javascript" src="<?=asset_url("js/jquery-ui-1.11.4.custom/jquery-ui.js")?>"></script>
    <script type="text/javascript" src="<?=asset_url("js/bootstrap.min.js")?>" ></script>
    
    <?php $this->load->view("autologout"); ?>
    
	<!-- <script type="text/javascript" src=""<?=asset_url("plugin/plugin/flexslider/jquery.flexslider.js")?>" ></script> -->

	<?php $this->load->view(@$js_top,@$dt_js_top); ?>
    
    <!-- google -->
    <?php $this->load->view("google_app/google_platform"); ?>
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
    
    
	