<?php //vacantsea ?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/> -->


<link rel="alternate" 	 hreflang="id" href="<?=base_url("agentsea")?>" />
<link rel="canonical" 	 href="<?php echo base_url("agentsea") ?>" />
<link rel="img_src" 	   href="<?=check_logo_agentsea_sosmed($company['username']);?>" />
<link rel="shortcut_icon" href="<?=FAVICON?>" />
    
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
	$this->load->config("meta");
	$keyword_meta = $this->config->item("meta_keyword");
	
	$md .= "$company[description]";	
	
	$meta_description = $md;
?>

<meta name="robots" 	   content="index, follow" />
<meta name="googlebot" 	content="index, follow" />
<meta name="author" 	   content="Informasea" />
<meta name="description"  content="<?=$meta_description?>"/>
<meta name="copyright" 	content="Informasea" />
<meta name="contact"	  content="<?=CONTACT?>" />
<meta name="distribution" content="global" />
<meta name="rating" 	   content="general" />

<meta name="keywords" 	 content="<?php echo $keyword; ?>,<?=$keyword_meta?>" />

<!-- You can use open graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    
<!-- meta detail vacantsea -->
<meta property="og:url"           content="<?=current_url()?>" />
<meta property="og:type"          content="Vacantsea" />
<meta property="og:title"         content="<?=$company['nama_perusahaan']." - ".$md?>" />
<meta property="og:description"   content="<?php echo $company['description']; ?>" />
<meta property="og:image"         content="<?=check_logo_agentsea_sosmed($company['username']);?>" />

<!-- twitter -->
<meta name="twitter:card" 		 content="summary" />
<meta name="twitter:site" 		 content="@informasea" />
<meta name="twitter:creator" 	  content="<?=WEBSITE?>" />
<meta name="twitter:description"  content="<?=$company['description']?>" />
<meta name="twitter:image"   		content="<?=check_logo_agentsea_sosmed($company['username']);?>"  />