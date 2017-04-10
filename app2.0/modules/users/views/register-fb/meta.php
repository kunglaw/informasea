<?php //meta untuk module users , page login  ?>

<?php
	/*
		data page meta diambil dari database SEO 
	*/
?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/> -->

    <meta name="description"  content="<?=$meta_user["description"]?>"/>
    <meta name="viewport"     content="width=device-width, initial-scale=1">
    <link rel="canonical"     href="<?php echo base_url() ?>" />
    <meta name="robots"       content="<?=$meta_user["robots"]?>" />
    <meta name="googlebot"    content="<?=$meta_user["google_bot"]?>" />
    <meta name="author"       content="<?=WEBSITE?>" />
    <meta name="copyright"    content="<?=WEBSITE?>" />
    <meta name="distribution" content="<?=$meta_user['distribution']?>" />
    <meta name="rating"       content="<?=$meta_user['rating']?>" />
    <meta name="keywords" content="<?php echo $meta_user['keyword']; ?>" />


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