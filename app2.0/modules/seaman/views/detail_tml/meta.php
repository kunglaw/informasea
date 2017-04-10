<?php // meta detail_tml ?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/> -->
<?php 
	$img_src = !empty($tml['photo']) ? img_url("timeline/$tml[username]/big/$tml[photo]") : check_img_timeline($tml['id_timeline']);

?>
<link rel="alternate" 	 hreflang="id" href="<?php echo base_url("profile/$tml[username]") ?>" />
<link rel="canonical" 	 href="<?php echo base_url("profile/$tml[username]") ?>" />
<link rel="img_src" 	   href="<?=$img_src?>" />
<link rel="shortcut_icon" href="<?=FAVICON?>" />
    
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
	$md .= "username:$dt_pelaut[nama_depan] $dt_pelaut[nama_belakang] ,";
	$md .= "content:$tml[content]		,";
	$md .= "photo:".img_url("timeline/$tml[username]/big/$tml[photo]").",";
	$md .= "type:$tml[type]					,";
	$md .= "to:$tml[to]	,";
	
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

<meta name="keywords" 	 content="<?php echo $keyword; ?>" />

<!-- You can use open graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    
<!-- meta detail detail post -->
<meta property="og:url"           content="<?=current_url()?>" />
<meta property="og:type"          content="Status" />
<meta property="og:title"         content="<?=$dt_pelaut['nama_depan']." ".$dt_pelaut['nama_belakang']." share a Status "?>" />
<meta property="og:description"   content="<?php echo !empty($tml['content']) ? $tml['content'] : "share a media"; ?>" />
<meta property="og:image"         content="<?=check_img_timeline($tml['id_timeline']);?>" />

<!-- twitter -->
<meta name="twitter:card" 		 content="summary" />
<meta name="twitter:site" 		 content="@informasea" />
<meta name="twitter:creator" 	  content="<?=WEBSITE?>" />
<meta name="twitter:description"  content="<?=$vacantsea['description']?>" />
<meta name="twitter:image"   		content="<?=check_logo_agentsea_sosmed($company['username']);?>"  />

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