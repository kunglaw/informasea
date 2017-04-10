<?php
if(!empty($ad))
{ ?>
<div id="right-bar" class="panel panel-default col-md-3 hidden-phone">
   
  <div class="panel-body">
  <h4 class="row"> Advertising </h4>
<?php
	for($i = 1; $i < 4; $i++){
	?>
	<p class="row">
	<img src="<?php echo base_url("assets/img/dummy_ship-3.jpg")?>" name="" id="" style="width:100%">
	<p>
	<div id="title" style="font-weight:bold" class="row"><a href=""> Lorem ipsum sit dolor amet </a> </div>
	<div id="website-ad" class="row"><a href="#">www.loremipsum.com</a> </div>
	</p>
	<p class="row">Lorem ipsum sit dolor amet Lorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor amet </p>
	</p>
	<?php if($i != 4-1){ ?>
	<hr class="row" />
	<?php
	}
  }
?>
 </div>
</div>
<?php
}
?>

