<?php //CSS Company ?>
<link rel="stylesheet" type="text/css" href="<?=asset_url("plugin/lightbox/ekko-lightbox.css");?>">

<style>
/*paging*/
.pagination {
	height: 36px;
	margin: 18px 0;
}.pagination ul {
	display: inline-block;
}.pagination li {
	display: inline;
	margin-left: 2px;
	margin-right: 2px;
}.pagination a {
	padding: 6px 12px;
}.pagination a:hover,.pagination .active a {
	background-color: #ECF6FF;
	border: 1px solid;
	border-color: #2e6da4;
}

#notfound{
	text-align: center;
	background-color: #ECF6FF;
	font-size: 30px;
	font-style: bold;
	border-radius: 5px;
}.available{
	color: black;
	font-style: bold;
	background-color: red;
	border-radius: 15px;
	padding: 4px 8px 4px 8px;
	margin-bottom: 50px;
	text-align: right;
}

/*pop up gambar*/
.modal-backdrop
{
	z-index:-1 !important;	
}
/*sub-header*/
.sub-header-left{
	float: left;
}
.sub-header-right{
	float: right;
}
/*expired date*/
.title-expired{
	color: red;
	cursor: pointer;
}
</style>