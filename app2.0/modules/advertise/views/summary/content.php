<div class="col-md-9 seatizen-list-container">


    <div class=" text-white text-center"
         style="margin:-10px; height:200px; padding:50px; background-repeat:no-repeat;background-size:cover;background-image: url(<?=asset_url('img/img_bg_about.png')?>)">


       <img id="about-logo" src="<?=LOGO_INFORMASEA_BIG?>">

    </div>

    <div style="height: 20px"></div>
	
    <p><h2> Summary #<?=$confirm["id_ad"]?></h2></p>
    <hr>
    
    <div class="row">
    	<!-- content -->
       
        <?php $this->load->view("summary/invoice"); ?>
        
    </div>
   
</div>