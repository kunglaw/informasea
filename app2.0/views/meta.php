<?php //halaman home,depan,landing informasea ?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/> -->
<?php

	$this->load->config("meta");
	$keyword_meta = $this->config->item("meta_keyword");
	
	$md = "desc:";
	
	$meta_description = $md;
?>
<link rel="canonical" 	  href="<?php echo base_url() ?>" />
<link rel="img_src" 	    href="<?=LOGO_INFORMASEA?>" />
<link rel="shortcut_icon"  href="<?=FAVICON?>" />

<meta name="description"   content="<?=META_DESCRIPTION?>"/>
<meta name="viewport" 	  content="width=device-width, initial-scale=1">
<meta name="robots" 		content="index, follow" />
<meta name="googlebot" 	 content="index, follow" />
<meta name="author" 		content="<?=WEBSITE?>" />
<meta name="copyright" 	 content="<?=WEBSITE?>" />
<meta name="contact"	   content="<?=CONTACT?>" />
<meta name="distribution"  content="global" />
<meta name="rating" 		content="general" />

<meta name="keywords" 	  content="<?php echo @$keyword; ?>,<?=$keyword_meta?>" />

<!-- og -->
<meta property="og:url"           content="<?=current_url()?>" />
<meta property="og:type"          content="Website" />
<meta property="og:title"         content="<?=$title?>" />
<meta property="og:description"   content="<?=META_DESCRIPTION?>" />
<meta property="og:image"         content="<?=LOGO_INFORMASEA?>" />

<!-- twitter -->
<meta name="twitter:card" 		 content="summary" />
<meta name="twitter:site" 		 content="@informasea" />
<meta name="twitter:creator" 	  content="<?=WEBSITE?>" />
<meta name="twitter:description"  content="<?=META_DESCRIPTION?>" />
<meta name="twitter:image"   		content="<?=LOGO_INFORMASEA?>"  />


<?php /* <meta name="description" content="DUMET School adalah tempat Kursus Website, Web Design, SEO, Programming dll. Lokasinya di Jakarta Barat, Selatan, Timur, Utara dan Pusat." />
<link rel="alternate" hreflang="id" href="http://www.dumetschool.com/" />
<link rel="canonical" href="http://www.dumetschool.com/" />

<!-- rrU4KmRQO62AcfbmnYAga6sj_b4 -->

<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<meta name="author" content="DUMET School" />
<meta name="contact" content="info@dumetschool.com" />
<meta name="copyright" content="PT Duta Media Teknologi" />
<meta name="distribution" content="global" />
<meta name="rating" content="general" />
<meta charset="UTF-8" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control: max-age=3600, must-revalidate" content="no-cache" />
<meta http-equiv="Expires" content="Wed, 20 Apr 2015 20:00:00 GMT" />
<meta name="keywords" content="kursus website, web design, seo" /> */ ?>