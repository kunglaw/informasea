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

		height:120%;

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
	
	.form-group{
		
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
		
		padding-top:100px;	
		
	}
	
	#section-second .box-ss{
		
		margin-top:20px;
		margin-right:1%;
		margin-left:2%;
		padding:20px;
		width:30%;
		float:left;
		border:1px solid #999;
		
	}
	
	#section-second .box-ss img{
		
		width:15%;
		height:15%;
		float:left;
		
	}
	
	#section-second .box-ss .text-box{
		
		float:right;
		width:80%;		
		
	}
	
	#section-second .box-ss .text-box p{
		
		font-size:14px;
		text-align:justify;	
		
	}
	
	#section-second .box-ss h4{
		
		text-transform:uppercase;
		
	}
	
	#section-second .box-ss button{
		
		text-transform:uppercase;
		
		
	}
	/* end second section */
	
	#third-section{
		
			
		
	}
	
	#third-section #agentsea-list{
		
		border:1px solid-black;
		
	}
	
	#third-section #agentsea-list h2{
		
		text-transform:uppercase;
		margin-bottom:30px;	
			
		
	}
	
	#third-section #agentsea-list ul{
		
		text-transform:uppercase;
		list-style-type:none;
		text-decoration:none;
		margin-left:-40px;	
			
		
	}
	
	#third-section #agentsea-list ul li{
		
			
		
	}
	
	#third-section #agentsea-list ul li img{
		
		
		text-transform:uppercase;	
		width:10%;
		height:10%;
		float:left;
		padding:10px;
		background-color:#3093e4;
			
		
	}
	
	#third-section #agentsea-list ul li div{
		
		text-transform:uppercase;	
		margin-left:10px;
		margin-bottom:40px;
		margin-left:20px;
		float:left;
			
		
	}
	
	#third-section #agentsea-list ul li div span{
		
		display:block;
			
		
	}
	
	#third-section #seatizen-list{
		
		
			
	}
	
	#third-section #seatizen-list ul{
		
		list-style-type:none;
		text-decoration:none;
		margin-left:-40px;
			
	}
	
	#third-section #seatizen-list h2{
		
		text-transform:uppercase;
		margin-bottom:30px;	
			
		
	}
	
	#third-section #seatizen-list ul li{
		
		
			
	}
	
	#third-section #seatizen-list ul li img{
		
		text-transform:uppercase;	
		width:10%;
		height:10%;
		float:left;
		padding:10px;
		background-color:#3093e4;
			
	}
	
	#third-section #seatizen-list ul div{
		
		
		margin-left:10px;
		margin-bottom:40px;
		margin-left:20px;
		float:left;
			
	}
	
	#third-section #seatizen-list ul span{
		
		display:block;
		
	}
	
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



</style>