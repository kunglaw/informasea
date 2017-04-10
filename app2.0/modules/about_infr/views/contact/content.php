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

    <div class="row">
        <div class="col-md-7">

            <?php if(!empty($info['email']) || !empty($info['nama']) || !empty($ve)){ ?>
           <div style="margin:0px 0 0px 0" class="alert alert-warning row">
           <?php // nilai variabel ini dari users/register.php ?>
             <p> <div id="" class="glyphicon glyphicon-exclamation-sign">

             </div> Error </p>

             <div class="">
                <?php //echo validation_errors(); ?>
                <?php echo $ve; ?>
             </div>

             <?php if(!empty($info['email'])){ ?>
                <div>
                    <?php echo $info['email']; ?>
                </div>

             <?php } ?>
             <?php if(!empty($info['nama'])){ ?>
                <div>
                    <?php echo $info['nama']; ?>
                </div>

             <?php } ?>


          </div><br />
          <?php }
            else if ( !empty($success) )
            {
                echo $success;

            }?>
        <form role="form" action="<?php echo base_url("about_infr/contact/send_mail")?>" method="post">

            <div class="form-group">
                <label for="">Name: </label>
                <input type="text" class="form-control" id="name" name="nama" placeholder="" required>

            </div>

            <div class="form-group">
                <label for="">Email:
                <span style="font:10px;font-weight:lighter;color:#CCC">(Your email address will not be published) </span>
                </label>
                <input type="text" class="form-control" id="email" name="email" placeholder="" required>

            </div>

            <div class="form-group">
                <label for="">Subject: </label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="" required>

            </div>

            <div class="form-group">
                <label for="">Message: </label>
                <textarea class="form-control" id="password" name="message" cols="10" rows="5" style="resize:none;" required> </textarea>

            </div>
                            <div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div>

            <br>

            <div class="form-group">

                <button type="submit" name="" class="btn btn-lg btn-primary"> Send </button>

            </div>

        <br><br><br><br><br>
        </form>



    </div>

        <div class="col-md-4 col-xs-12 tentang" style="margin-left:50px">

            <h3> Contact Informasea </h3>
            <br>
            <p><b>Address : </b></p>
            <p>
                <span style="font-size:14px;">
                        <?=ADDRESS?>
                </span>
            </p>


        </div>
   </div>
</div>

<?php //$this->load->view("js_under") ?>

