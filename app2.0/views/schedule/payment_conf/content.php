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
	
    <p><h2> Payment Confirmation </h2></p>
    <hr>
    
    <div class="row">
    	<div class="col-md-5">
        	
        	<div class="info-ad"></div>
        	<form role="form" id="payment-conf-form">
               <fieldset>
                <div class="form-group">
                	<label> A/n Bank Account</label>
                	<input type="text" name="an_account" id="an_account" class="form-control">
                </div>
                
                <div class="form-group">
                	<label> Bank Account </label> 
                    <input type="text" name="bank_account" id="bank_account" class="form-control"  >
                </div>
                
                <div class="form-group">
                	<label> Total Transfer </label>
                	<input type="text" name="total_transfer" id="total_transfer" class="form-control">
                </div>
              
                <input type="hidden" name="purpose_bank" id="purpose_bank" value="<?=$order["purpose_bank"]?>" > 
                <button type="submit" class="btn btn-success"> Submit Confirmation </button>
               </fieldset>
            </form>
        </div>
        <div class="col-md-7">
        	<div class="print-order">
            	<?php $this->load->view("payment_conf/invoice"); ?>
            </div>
        
        </div>
        
    </div>
   
</div>

<?php //$this->load->view("js_under") ?>

