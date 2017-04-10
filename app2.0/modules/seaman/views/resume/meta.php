<?php // meta resume, seatizen, profile, module seaman ?>

<?php //profile
?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/> -->

<meta property="fb:app_id" content="517285028439132" />

<link rel="alternate" 	 hreflang="id" href="<?=base_url("profile/$pelaut[username]")?>" />
<link rel="canonical" 	 href="<?=base_url("profile/$pelaut[username]")?>" />
<link rel="img_src" 	   href="<?=check_img_seaman_sosmed($pelaut["username"])?>" />
<link rel="shortcut_icon" href="<?=FAVICON?>" />
    
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="robots" 	   content="index, follow" />
<meta name="googlebot" 	content="index, follow" />
<meta name="author" 	   content="Informasea" />
<meta name="description"  content="<?=$meta_description?>"/>
<meta name="copyright" 	content="Informasea" />
<meta name="contact"	  content="<?=CONTACT?>" />
<meta name="distribution" content="global" />
<meta name="rating" 	   content="general" />

<meta name="keywords" 	 content="<?php echo $keyword; ?>" />

<!-- You can use open graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    
<!-- meta detail seaman -->
<meta property="og:url"           content="<?=base_url("profile/$pelaut[username]")?>" />
<meta property="og:type"          content="Profile" />
<meta property="og:title"         content="<?=$name." - ".$rank?>" />
<meta property="og:description"   content="<?php echo "$desc"; ?>" />
<meta property="og:image"         content="<?=check_img_seaman_sosmed($pelaut["username"]);?>" />

<!-- twitter -->
<meta name="twitter:card" 		 content="summary" />
<meta name="twitter:site" 		 content="@informasea" />
<meta name="twitter:creator" 	  content="<?=WEBSITE?>" />
<meta name="twitter:description"  content="<?="$desc"?>" />
<meta name="twitter:image"   		content="<?=check_img_seaman_sosmed($pelaut["username"]);?>"  />

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