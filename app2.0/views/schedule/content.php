<?php
/*
 *
 * Created by PhpStorm.
 * User: a
 * Date: 12/06/2015
 * Time: 20:38
 */


?>


<!-- <div class="col-md-9 contactpage seatizen-list-container center-block about-header text-white text-center"
     style="background-image: url(<?=asset_url('img/img_bg_about.png')?>)">

        <div class="row">


            <img id="about-logo" src="<?=asset_url('img/img_logo_about.png')?>">

            <h5><?=INFORMASEA_SLOGAN?></h5>

            <!-- <div class="about-header text-center text-white"
                 style="background-image: url(<?=asset_url('img/img_bg_about.png')?>)">

            </div>

        </div>
</div> -->

<div class="col-md-9 seatizen-list-container">


    <div class=" text-white text-center"
         style="margin:-10px; height:200px; padding:50px; background-repeat:no-repeat;background-size:cover;background-image: url(<?=asset_url('img/img_bg_about.png')?>)">


       <img id="about-logo" src="<?=LOGO_INFORMASEA_BIG?>">

    </div>

    <div style="height: 20px"></div>
	
    <h2> Request Ad </h2>
    <hr>
    
    <div class="row">
    	<div class="col-md-7">
        <div class="info-ad"></div>
        <form role="form" action="" method="post" class="registration-form" onSubmit="return false">
        	<fieldset>
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Step 1 / 3</h3>
                        <p>Tell us Your type of the banner :</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="form-group">
                        <label for="ad_name">Ad name</label>
                        <input type="text" name="ad_name" placeholder="Ad name..." class="form-control" id="ad_name">
                    </div>
                    
                    <div class="form-group">
                    	<label for="ad_area">Area</label>
                    	<select class="form-control" name="ad_area" id="ad_area">
                        	<option value="" selected disabled>- Select Area -</option>
                        	<?php foreach($ad_area as $row){ ?>
                        	<option value="<?=$row["id_area"]?>"><?=$row["title"]?></option>
                        	<?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label> Start Date </label>
                    	<input type="text" name="start_date" id="start_date" class="form-control" >
                    </div>
                    <div class="form-group">
                    	<div>
                          <label for='ad_periode'> Periode </label>
                          </div>
                           <span class="clearfix"></span>
                          <div class="pull-left col-md-4">
                          <input type="text" name="quantity_periode" id="quantity_periode" class="form-control" placeholder="quantity..." >  
                          </div>
                          <div class="pull-left"> &nbsp; X &nbsp;</div>
                          <div class="pull-left col-md-4">
                          
                          <!-- <select class="form-control" name="ad_periode" id="ad_periode" >
                              <?php foreach($ad_periode as $row){ ?>
                                  <option value="<?=$row["id_periode"]?>"><?=$row["amount_periode"]." ".$row["range_periode"]?></option>
                              <?php } ?>
                          </select>--> 
                          
                          <?=$row["amount_periode"]." ".$row["range_periode"]?>
                          <input type="hidden" name="ad_periode" id="ad_periode" value="<?=$ad_periode[0]["id_periode"]?>">
                        </div>
                        <span class="clearfix"></span>
                    </div>
                    <div class="form-group">
                        <label for="ad_alternative_text">Ad Alternative Text</label>
                        <input type="text" name="ad_alternative_text" placeholder="Ad Alternative text shows when the ad doesn't show..." class="form-control" id="ad_alternative_text">
                    </div>
                    <!-- <div class="form-group">
                        <label for="ad_alternative_text">Ad Banner Location</label>
                        <input type="text" name="ad_banner_location" placeholder="the url location of the banner..." class="form-control" id="ad_banner_location">
                    </div>--> 
                    <div class="form-group">
                        <label for="ad_target_url">Target Url</label>
                        <input type="text" name="ad_target_url" placeholder="http://..." class="form-control" id="ad_target_url">
                    </div>
                    <div class="form-group">
                        <label for="ad_description">Ad Description</label>
                        <textarea name="ad_description" placeholder="Ad Description..." 
                                    class="form-control" id="ad_description"></textarea>
                    </div>
                    <div class="form-group">
                    	<label>Media</label>
                        <input type="file" name="media" id="media">
                    </div>
                    <button type="button" class="btn btn-next btn-primary">Next</button>
                </div>
            </fieldset>
            
            <fieldset>
                <div class="form-top">
                    <div class="form-top-left">
                        <h3> Step 2 / 3 </h3>
                        <p> Set up your account: </p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-key"></i>
                    </div>
                </div>
                <div class="form-bottom">
                	<div class="form-group">
                    	<label for="name"> Name </label>
                    	<input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email..." class="form-control" id="form-email">
                    </div>
                    <div class="form-group">
                    	<label>No Telp</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" >
                    </div>
                   
                    <button type="button" class="btn btn-previous">Previous</button>
                    <button type="button" class="btn btn-next btn-primary">Next</button>
                   
                </div>
            </fieldset>
            <fieldset>
            	 <div class="form-top">
                    <div class="form-top-left">
                        <h3> Step 3 / 3 </h3>
                        <p> Choose your payment method: </p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-key"></i>
                    </div>
                </div>
                <div class="form-bottom">
                	<div class="form-group">
                    	<div class="pull-left col-md-4">
                        <input type="radio" value="Mandiri" name="purpose_bank" id="mandiri">
                		<label for="mandiri">
                        	
                            <div><img src="https://d11zeux9tyyeep.cloudfront.net/provider/logo-mandiri.jpg" style="width:150px; height:78px"></div>
                            <div> Rini Julistia </div>
                            <div> No. Rekening <?=MANDIRI?> </div>
                        </label>
                        </div>
                        <div class="pull-left col-md-4">
                        <input type="radio" value="BCA" name="purpose_bank" id="bca">
                        <label for="bca">                            
                            <div><img src="https://belanjanyaman.files.wordpress.com/2012/10/bankbca.jpg" style="width:150px; height:78px"></div>
                            <div> Rini Julistia </div>
                            <div> No. Rekening <?=BCA?> </div>
                        </label>
                        </div>
                        <div class="pull-left col-md-4">
                        <input type="radio" value="BRI" name="purpose_bank" id="bri">
                        <label for="bri">                            
                            <div><img src="http://res.cloudinary.com/cermati/image/upload/v1428073853/brands/jncpmca7gh5gu9cteq2t.png" style="width:150px; height:78px"></div>
                            <div> Rini Julistia </div>
                            <div> No. Rekening <?=BRI?> </div>
                        </label>
                        </div>
                        <span class="clearfix"></span>
                	</div>
                    <button type="button" class="btn btn-previous">Previous</button>
                	<button type="submit" class="btn btn-success"> Send Ad Request </button>
            	</div>
            </fieldset>
            
            
		  </form>
        </div>
        <div class="col-md-5">
        <span id="thumbnail-target"></span>
        </div>   		
    </div>
   
</div>
<script type="text/javascript">
	$("#ad_area").change(function () {
		$.ajax({
			type: "POST",
			data: "x=1&id_area="+$(this).val(),
			url : "<?php echo base_url() ?>advertise/get_thumbnail",
			success:function (output) {
				$("#thumbnail-target").html(output);
			}
		});
	})
</script>
<?php //$this->load->view("js_under") ?>

