<?php // content detail , menu vacantsea, module vacantsea 


// $username = $this->session->userdata("username");
$this->load->model("photo/photo_mdl");
echo $vacantsea['id_perusahaan'];
$cover = $this->photo_mdl->get_company_cover($comp_id);
$nama_perusahaan = str_replace(' ', '_', $vacantsea['perusahaan']);
$ss = explode(".",$cover['nama_gambar']);
$url_cover = img_url("photo/photo/".$company['username']."/cover/$ss[0]"."_thumb.".$ss[1]);
$url_img = img_url("company/photo/".$company['username']."/ship/".$ship['image_ship']);
// echo $url_img;
if(empty($cover))
{
    $url_cover = base_url("assets/img/pattern-cover.png");
}

?>

<script src="<?php echo base_url('assets/js/jquery-1.9.0.min.js') ?>"></script>
  

<script src="<?php echo base_url('assets/js/raty/jquery.raty.min.js') ?>" type="text/javascript"></script>

<!--[if lte IE 8]>
<div id="browser-upgrade-div" class="alert alert-warning browser-check-text"> browser tak mendukung  </div>
<![endif]-->

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row" id="header-content">
                <!-- <div style="background-image:url(<?php echo $url_cover; ?>); height:315px; margin-top:-15px;  background-repeat:no-repeat; background-size:cover">
            </div> 
            <div class="position_panel" style="margin-top: 10px">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-top: 30px">         
                  <div class="logo_sm_wrap">
                      <img id="company_logo" data-original="#" class="img-responsive" 
                      src="<?php echo img_url("company/$company_name/ship/".$ship['image_ship']) ?>" width="100px" height="100px">
                  </div>
                </div>            
            </div>
            
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">             
                <div class="job-position-wrap" style="margin-top: 30px" style="text-align:center">   -->
                <h1 align="center"><b><?php echo $ship['ship_name']; ?></b></h1>
                <h3 align="center"><?php echo ucfirst($detail_ship['ship_type']) ?></h3>

                <!-- <p align="justify" class="apply-now-bar-desc"><?php //echo $vacantsea['description'] ?></p>
                    <p><?php //echo $vacantsea['navigation_area'] ?> - <span style="font-weight:bold; color:#0C0">
          <?php //echo $vacantsea['sallary_curr']." ".number_format($vacantsea['annual_sallary']) ?></span></p> -->
                <!-- </div>
            </div> -->
            </div>
            <!-- end header content -->

            <hr class="" style="border:1px double black"/>

            <div class="row" id="middle-content">

                <div class="container col-lg-10 col-md-10 col-sm-10" style="margin-left:75px">
                    <img src="<?php echo $url_img; ?>" align="center" >
                    <br>
                    <p align="center"><a target="_blank" href="<?php echo $url_img ?>">click here to view original size</a></p>
                </div>

                <div class="container col-lg-6 col-md-6 col-sm-6" style="border-right:1ps solid #999; margin: 35px 0px 0px 75px">
                    <h3 class="h3-title"><i class="fa fa-image icon_header"></i>  IMAGE INFO</h3>
                    <div class="unselectable wrap-text" id="job_description">
                        <div class="table-responsive">
                            <table class="table-condensed">
                                <tr>
                                    <td width="40%">Author</td>
                                    <td width="1">:</td>
                                    <td class="tbl-bold" >
                                        <?php echo $ship['author'] ?></td>
                                </tr>
                                <tr>
                                    <td>Number of Views</td>
                                    <td>:</td>
                                    <td class="tbl-bold"><?php echo $ship['number_of_views'] ?></td>
                                </tr>
                                <tr>
                                    <td>Rating</td>
                                    <td>:</td>
                                    <td class="tbl-bold"><div id="prd"></div></td>
                                </tr>
                                
                            </table>
                        </div><!-- end table -->
                    </div><!-- END QUALIFICATION -->
                </div>

                <div class="col-lg-5 col-md-5 col-sm-5" style="margin:35px 0px 0px -10px">
                    <!-- company snapshot -->
                    <div id="company_snapshot">
                        <h3 class="h3-title"><i class="fa fa-ship icon_header"></i> SHIP INFO</h3>
                        <table class="table-condensed">
                            <tr>
                                <td>Ship Name</td>
                                <td>:</td>
                                <td><?php echo $ship['ship_name'] ?></td>
                            </tr>
                            <tr>
                                <td>IMO</td>
                                <td>:</td>
                                <td><?php echo $ship['IMO'] ?></td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>:</td>
                                <td><?php echo $detail_ship['ship_type'] ?></td>
                            </tr>
                            <tr>
                                <td>Weight</td>
                                <td>:</td>
                                <td><?php echo $ship['weight'] ?> kg</td>
                            </tr>
                            <tr>
                                <td>Engine</td>
                                <td>:</td>
                                <td><?php echo $ship['engine'] ?></td>
                            </tr>
                            <!-- <tr>
                                <td>Type</td>
                                <td>:</td>
                                <td><?php //echo $detail_ship['ship_type'] ?></td>
                            </tr> --><!--
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>London Office :UCB House 3 George Street Watford, WD18 0BX</td>
                    </tr>-->
                        </table>
                        <hr>
                        <div class="company-overview wrap-text">
                            <p id="company_overview" class="cmpy_desc_p"><?php echo $ship['description'] ?></p>
                        </div>
                    </div>
                    <!-- end company snapshot -->

                    <!-- company photo -->
                    <div id="gallery" hidden=true>
                        <h3 class="h3-title"><i class="fa fa-camera-retro icon_header"></i> COMPANY PHOTO</h3>
                        <div class="gallery-main-wrap">

                            <div id="main-vid" data-youtube-id="mECVN3MVO3Q"></div>
                            <div id="main-img" style="display: none;"></div>
                            <div id="main-img-caption" style="display: none;">
                                <svg height="55" width="100%">
                                    <defs>
                                        <linearGradient id="img-caption-grad" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" style="stop-color:rgba(0,0,0,0);stop-opacity:0" />
                                            <stop offset="100%" style="stop-color:rgba(0,0,0,0.65);stop-opacity:1" />
                                        </linearGradient>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#img-caption-grad)" />
                                </svg>
                                <p id="main-img-caption-text"></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="gallery-carousel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="gallery-thumb">
                        <li><img data-original="#" data-video="#" title="Video" /></li> 
     
                        <li><img data-original="#" class="img-responsive" title="" src="<?php echo base_url("assets/img/mane-20141014095813_mc-ckimage.jpg") ?>" /></li>
                        <li><img data-original="#" title="" /></li>
                        <li><img data-original="#" title="" /></li>
                </ul>
               </div>-->
                    <!-- end company photo -->

                    <div id="company_overview" HIDDEN=true>
                        <h3 id="overview" class="h3-title"><i class="fa fa-building-o icon_header"></i> DESCRIPTION</h3>
                        <div class="company-overview wrap-text">
                            <p id="company_overview" class="cmpy_desc_p"><?php echo $company['description'] ?></p>
                        </div>
                    </div>



                </div>

            </div>

            <hr class="" style="border:1px double black"  />

            <!-- <div class="row" id="footer-content">
            <div class="apply-now-wrap">
                <div class="">
                    <div id="apply-now-owa" class="col-lg-6 col-md-6 col-sm-5 col-xs-12 text-left apply-now-owa"></div>
                    
                      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-right apply-now-desc">  
                        <a type="button" class="btn btn-link apply-now-save" target="_blank" href="#">Save this job</a>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-right apply-btn-wrap container">
                          <form action="#" method="post">
                              <input type="hidden" value="1434772" name="job_id" id="job_id" />
                              <input type="hidden" value="1435270" name="advertisement_id" id="advertisement_id" />
                              <input type="hidden" value="40" name="s" id="s" />
                              <input type="hidden" value="1" name="AdvertisementSource" id="AdvertisementSource" />
                              <input type="hidden" name="fr" id="fr" value="" />
                              <a id="apply_button" type="submit" class="btn btn-primary btn-lg apply-btn-padding " data-tracker="#" 
                              href="<?php //echo base_url("vacantsea/apply/$id_segment/$title_segment")?>">Apply Now</a>
                              
                          </form>
                      </div>                      
                </div>
                <div class="row apply-now-bar-row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 apply-now-bar">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-0 text-left">
                        <p id="posting_date" class="apply-now-bar-desc hidden-xs">Advertised: 07-November-2014</p>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                      <p id="closing_date" class="apply-now-bar-desc">
                                                  Closing on 27-November-2014</p>
                      </div>
                  </div>
                </div>
            </div>
          </div> -->

        </div>
    </div>
</div>
<script>
  $(function() {
    $('#prd').raty({
      number: 5, starOff: "<?php echo img_url('rate/star-off-big.png') ?>", starOn: " <?php echo img_url('rate/star-on-big.png') ?>", width: 180, scoreName: "score",
    });
  });
</script>

<script>
  $(document).on('click', '#submit', function() {
<?php
if (!isset($USER_ID)) {
  ?>
      alert("You need to have a account to rate this product?");
      return false;
<?php } else { ?>
      var score = $("#score").val();
      if (score.length > 0) {
        $("#rating_zone").html('processing...');
        $.post("update_ratings.php", {
          pid: "<?php echo $_GET["pid"]; ?>",
          uid: "<?php echo $USER_ID; ?>",
          score: score
        }, function(data) {
          if (!data.error) {
            // success message
            $("#avg_ratings").html(data.updated_rating);
            $("#rating_zone").html(data.message).show();
          } else {
            // failure message
            $("#rating_zone").html(data.message).show();
          }
        }, 'json'
                );
      } else {
        alert("select the ratings.");
      }

<?php } ?>
  });
</script>