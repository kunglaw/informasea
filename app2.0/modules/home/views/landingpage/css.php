<?php // css khusus landing page  ?>
<!--[if lt IE 7 ]>
  <html class="no-js ie6 oldie" lang="en"> <![endif]-->
  <!--[if IE 7 ]>
  <html class="no-js ie7 oldie" lang="en"> <![endif]-->
  <!--[if IE 8 ]>
  <html class="no-js ie8 oldie" lang="en"> <![endif]-->
  <!--[if IE 9 ]>
  <html class="no-js ie9" lang="en"> <![endif]-->
  <!--[if (gte IE 10)|!(IE)]> >
  <html class="no-js" lang="en"> 
  <!<![endif]-->
<style>
	.head{
		
		margin:-40px auto 0 auto;  
		position: relative;
		
		width: 100%;  

		height:200%;

		max-width: 1920px;
		
		background-image: url('<?=asset_url("img/img-bg-landing-page.jpg")?>');
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center;
	}
	
	.darker-background
	{
		position:absolute;
		top:0;
		left:0;
		width:100%;
		height:100%;
		background: rgba(70, 72, 82, 0.3);
			
	}
	
</style>

<link rel="stylesheet" type="text/css" href="<?=asset_url("plugin/plugins/slick/slick.css")?>" />
<link rel="stylesheet" type="text/css" href="<?=asset_url("plugin/plugins/slick/slick.css")?>" />
<link rel="stylesheet" type="text/css" href="<?=asset_url("plugin/plugins/slick/slick-theme.css")?>" />

<!-- landingpage -->
<link rel="stylesheet" type="text/css" href="<?=asset_url("css/landingpage/animate.css")?>" />
<link rel="stylesheet" type="text/css" href="<?=asset_url("css/landingpage/owl.carousel.min.css")?>" />

<style>

/* landingpage */
	
	/*darker-background*/
	
	/*first-section*/
		
	#first-section{
		
			
		
	}
	
	#first-section div.container-fluid{
		
		position:absolute;
		top:0;
		left:0;
		right:0;
		width:100%;
		height:100%;
		
	}
	
	#first-section div.row{
		position:absolute;
		display:table-cell;
		top:0;
		left:0;
		right:0;
		width:100%;
		height:100%;
		vertical-align:middle;	
	}
	
	#first-section div.row #carousel-example-generic 
	{
		display:table-cell;
		position:absolute;
		top:0;
		left:0;
		right:0;
		width:100%;
		height:100%;
	}
	
	#carousel-example-generic .carousel-inner
	{
		top:25% !important;
	}
	
	#first-section .text-box{
		 position: relative;
  		 top:25%;
		 bottom:auto;
		
	}
	
	#first-section .text-box h2,h1{
		
		font-weight:bolder;
		font-size:36px;
		margin-bottom:25px;
		text-transform:uppercase;
	
	}
	
	#first-section .text-box p{
		
		font-size:14px;
		width:40%;
		
		margin-left:auto;
		margin-right:auto;
	
	}
	
	#first-section .text-box p input
	{
		margin-top:50px;
		width:30%;	
		background:url('<?=asset_url('img/btn-search-landingpage.png');?>');
		background-repeat:no-repeat;
		background-size:cover;
	}
	
	#first-section ul{
		
		font-weight:bolder;
		list-style-type:none;
		margin-left:auto;
		margin-right:auto;
		width:40%;
		
	
	}
	
	#first-section ul li{
		
		margin-bottom:10px;
		display:block;
		
	
	}
	
	#first-section ul li img{
		
		width:5%;
		margin-right:10px;
	
		
	
	}
	
	#first-section ul li span{
		
		line-height:50px;
		font-size:14px;
		
	
	}
	
	
	/*end first-section */
	
	/*search */
	#searchbar {
		
		height:0 !important; 
			
	}
	
	#searchbar .row {
		
		text-align:center;
			
	}
	
	#searchbar form{
		margin-top:13px;
		background-color:#2a2e33;	
	}
	
	.btn-search-bg
	{
		/* background-color:#F63; */
		background-image:url('<?=asset_url('img/btn-search-landingpage.png');?>');
		background-size:cover;
	}
	
	#frm-search-dashboard .form-group{
		
		margin-bottom:0px !important; 
			
	}
	
	.landing-container{
		
		border-top:none !important;
		
	}
	
	.landing-container-slider{
			
		min-height:600px;
		
	}
	
	/* section landingpage kedua */
	#section-second{
		
		padding-top:80px;
		color:#207EC8;	
		
	}
	
	.test-row
	{
		display:inline-block;
		width:117%; /*ini yg membuat 3 kotak ketengah */
			
	}
	
	#section-second .box-ss{
		
		margin-top:20px;
		margin-right:1%;
		margin-left:2%;
		padding:20px;
		/* width:30%; */
		float:left;
		border:1px solid #999;
		
		 min-height:380px;
		
	}
	
	#section-second .text-box ul{
		 
		list-style-type:none;
		margin-left:-20px;
		margin-bottom:20px;
	}
	
	#section-second .text-box ul li{
		 
		margin-bottom:10px;
		
	}
	
	#section-second p.bawah {
		position:absolute;
		
		bottom: 20px;
		right:20px;
		left:20px;
		
	}
	
	#section-second .box-ss #aaa{
		
		width:15%;
		height:15%;
		float:left;
		
	}
	
	#section-second .box-ss .text-box{
		
		float:right;
		width:80%;		
		padding-bottom: 50px;
	}
	
	#section-second .box-ss .text-box p{
		
		font-size:14px;
			
		
	}
	
	#section-second .box-ss h3{
		
		text-transform:uppercase;
		
	}
	
	#section-second .box-ss button{
		
		text-transform:uppercase;
		
		
	}
	/* end second section */
	
	
	
	/*footer*/
	
	#footer
	{
		background-color:#283645;
		height:50px;	
		line-height:25px;
	}
	
	/*footer end*/
	
	/* .col-centered{
		float: none;
		margin: 0 auto;
	} */

/* end landingpage */

.btn-huge{

    padding-top:20px;
    padding-bottom:20px;

}

.modal-backdrop{
	
	z-index:0 !important;
		
}

.vacantsea-responsive .white-container:hover{
	
	border-left:2px #3093E4 solid;
	
}

.seatizen-item-container .box:hover , .seatizen-item:hover 
{
	border-left:2px #3093E4 solid;
	cursor:pointer;
}

#agentsea-flat .white-container:hover{
	
	border-left:2px #3093E4 solid;
	cursor:pointer;
}

#testimonial-card:hover
{
	border-left:2px #3093E4 solid;
	cursor:pointer;
}


/* non hover */

.vacantsea-responsive .white-container{
	
	border-left:2px #D3D3D3 solid;
	
}

.seatizen-item
{
	border-left:2px #D3D3D3 solid;
}

#agentsea-flat .white-container{
	
	border-left:2px #D3D3D3 solid;
	
}

#testimonial-card
{
	border-left:2px #D3D3D3 solid;
	cursor:pointer;
}

/* vacantsea */

.vacant .vcon
{
	width:5% !important;	
	
}

.vacant .list-vacant{
	
		
	
}

.vacant .list-vacant span{
	
		
	line-height:50px;
}


/* RESPONSIVE */

/*------------------------------------------
  Responsive Grid Media Queries - 1280, 1024, 768, 480
   1280-1024   - desktop (default grid)
   1024-768    - tablet landscape
   768-480     - tablet 
   480-less    - phone landscape & smaller
--------------------------------------------*/
/* tambahan kunglaw */
@media all and (min-width: 1420px) and (max-width: 1900px){ 

	
	#first-section .text-box p input{
		width:40% !important;	
	}
	
	#first-section ul{
		width:45% !important;
	}

}

@media all and (min-width: 1280px) and (max-width: 1420px)  { 

	#first-section .text-box h2
	{
		width:80% !important;
		margin-left:auto;
		margin-right:auto;	
	}
	
	#first-section .text-box p input{
		width:50% !important;	
	}
	
	#first-section ul{
		width:105% !important;
	}

}

@media all and (min-width: 1024px) and (max-width: 1280px)
{ 
	#first-section .text-box h1.text-white
	{
		width:80%;
		margin-left:auto;
		margin-right:auto;	
	}
	
	#first-section .text-box h2
	{
		width:70% !important;
		margin-left:auto;
		margin-right:auto;	
	}
	
	#first-section .text-box p input{
		width:45% !important;	
	}
	
	#first-section ul{
		width:45% !important;
	}
	
	#first-section ul li span{
		line-height:30px;
	}

}

@media all and (min-width: 768px) and (max-width: 1024px)  { 
	
	
	#first-section .text-box h1.text-white
	{
		width:70%;
		margin-left:auto;
		margin-right:auto;	
	}
	
	#first-section .text-box h2
	{
		width:70% !important;
		margin-left:auto;
		margin-right:auto;	
	}
	
	#first-section .text-box p input{
		width:70% !important;	
	}
	
	#first-section ul{
		width:55% !important;
	}
	
	#first-section ul li span{
		line-height:30px;
	}
	
	/* form search */
	#searchbar img{
		text-align:center;
		width:80%;	
	}
	
	/* ================================== */
	#section-second {
		padding-top:20px; 
	}


}

@media all and (min-width: 480px) and (max-width: 768px) { 
	
	#first-section .text-box p input{
		width:110% !important;	
	}
	
	#first-section h2{
		width:70% !important;
		margin-left:auto;
		margin-right:auto;
	}
	
	#first-section ul{
		width:70% !important;
	}
	
	#first-section li span{
		line-height:10px;
	}
	
	/* ================================== */
	#section-second {
		padding-top:20px; 
	}
	
	#section-second .box-ss{
		
		
		min-height:400px; /*gak boleh dirubah*/
	
	}

}

@media all and (max-width: 480px) { 
	
	#first-section div.row
	{
		left:10px !important;
			
	}
	
	#first-section h1,#first-section .text-box h2{
		font-size:18px !important;
		margin-right:40px;
		margin-left:40px;	
	}
	
	#first-section ul{
		width:100% !important;
	}
	
	#first-section ul li{
		margin-right:50px;
		margin-left:30px;
	}
	
	#first-section ul li span{
		line-height:10px;
		font-size:12px;
		
	}
	
	#first-section #carousel-example-generic
	{
		left:10px !important;	
	}
	
	#first-section .text-box p input{
		width:180% !important;	
		margin-left:-55px;
		margin-right:auto;
	}
	
	/* =========================================== */
	
	#section-second {
		padding-top:0px; 
	}
	
	#section-second .box-ss{
		
		
		min-height:480px; /*gak boleh dirubah*/
	
	}
	
}


/* Portrait */
@media screen and (orientation:portrait) { /* Portrait styles here */ }
/* Landscape */
@media screen and (orientation:landscape) { /* Landscape styles here */ }


/* CSS for iPhone, iPad, and Retina Displays */

/* Non-Retina */
@media screen and (-webkit-max-device-pixel-ratio: 1) {
}

/* Retina */
@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
only screen and (-o-min-device-pixel-ratio: 3/2),
only screen and (min--moz-device-pixel-ratio: 1.5),
only screen and (min-device-pixel-ratio: 1.5) {
}

/* iPhone Portrait */
@media screen and (max-device-width: 480px) and (orientation:portrait) and (-webkit-min-device-pixel-ratio: 1) {
	
	#first-section 
	{
		height:10%;	
	}
	
	#first-section #carousel-example-generic
	{
		left:10px !important;	
	}
	
	#first-section ul{
		width:100% !important;
	}
	
	#first-section ul li{
		line-height:0 !important;
	}
	
	#first-section h1{
		font-size:14px;	
	}
	
	#first-section .item{
		
		margin-right:-20px;
	}	
	
	#first-section .text-box p input{
		
		width:180% !important;
		margin-left:10%;
		margin-right:10%;
	}	
	
	/* ======================================= */
	
	#section-second .box-ss{
		
		min-height:480px;	
	}
	
	
} 

/* iPhone Landscape */
@media screen and (max-device-width: 480px) and (orientation:landscape) {
}

/* iPad Portrait */
@media screen and (min-device-width: 481px) and (orientation:portrait) {
	
	#first-section .text-box p input{
		width:100% !important;	
	}	
	
	#first-section ul li{
		line-height:0 !important;
	}
	
	#section-second .box-ss{
		
		min-height:480px;	
	}
	
}

/* iPad Landscape */
@media screen and (min-device-width: 481px) and (orientation:landscape) {
}


</style>