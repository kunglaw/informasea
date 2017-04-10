<?php // content detail , menu vacantsea, module vacantsea 

$rank = $this->rank_model->get_rank_detail($vacantsea['rank_id']);
$ship_type = $this->vessel_model->get_ship_type_detail($vacantsea['ship_type']);
$ship  = $this->vessel_model->get_ship_detail($vacantsea['ship']);
$nationality = $this->nation_model->get_detail_nationality($vacantsea['id_nationality']);

$id_segment = $this->uri->segment(2);
$title_segment = $this->uri->segment(3);

// $username = $this->session->userdata("username");
  $this->load->model("photo/photo_mdl");
  $cover = $this->photo_mdl->get_company_cover($vacantsea['id_perusahaan']);
  $nama_perusahaan = str_replace(' ', '_', $vacantsea['perusahaan']);
  $ss = explode(".",$cover['nama_gambar']);
  $url_cover = img_url("photo/$nama_perusahaan/cover/$ss[0]"."_thumb.".$ss[1]);
  if(empty($cover))
  {
    $url_cover = base_url("assets/img/pattern-cover.png");
  }

?>

<!--[if lte IE 8]>
<div id="browser-upgrade-div" class="alert alert-warning browser-check-text"> browser tak mendukung  </div>
<![endif]-->

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <div class="panel panel-default">
        <div class="panel-body">
        
          <div class="row" id="header-content">
            <div style="background-image:url(<?php echo $url_cover; ?>); height:315px; margin-top:-15px;  background-repeat:no-repeat; background-size:cover">
            </div>
            <div class="position_panel" style="margin-top: 10px">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">						
                  <div class="logo_sm_wrap">
                  	<?php
						 $path_img = img_url("company/photo/$company[username]/profil_pic/$company[logo_image]");
						if(!file_exists("../infrasset/company/photo/$company[username]/profil_pic/$company[logo_image]"))
						{
							$path_img = asset_url("img/img_default.png");
						}
					?>
                      <img id="company_logo" data-original="#" class="img-responsive" src="<?php echo $path_img ?>">
                  </div>
                </div>						
            </div>
            
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">					   
                <div class="job-position-wrap">	
                    <h4><a target="_blank" href="#"><u><?php echo $vacantsea['perusahaan']; ?></u></a></h4>					    
                    <h3><?php echo ucfirst($vacantsea['vacantsea']) ?></h3>
                    <p align="justify" class="apply-now-bar-desc"><?php echo $vacantsea['description'] ?></p>
                    <p><?php echo $vacantsea['navigation_area'] ?> - <span style="font-weight:bold; color:#0C0">
					<?php echo $vacantsea['sallary_curr']." ".number_format($vacantsea['annual_sallary']) ?></span></p>
                </div>
            </div>
          </div>
          <!-- end header content -->
          
          <hr class="" style="border:1px double black"  /> 
          
          <div class="row" id="middle-content"> 
          	
            <div class="container col-lg-6 col-md-6 col-sm-6" style="border-right:1ps solid #999">
              <h3 class="h3-title"><i class="fa fa-edit icon_header"></i> QUALIFICATION</h3>
              <div class="unselectable wrap-text" id="job_description"> 
                  <div class="table-responsive">
                  	<table class="table table-stripped" >
                      <tr>
                          <td width="40%">Department</td>
                          <td width="1">:</td>
                          <td class="tbl-bold" >
						  <?php 
						  $vd = $vacantsea['department'];
						  $department = $this->department_model->get_detail_department($vd);
						  echo $department['department'] ?></td>
                      </tr>
                      <tr>
                          <td>Rank</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $rank['rank'] ?></td>
                      </tr>
                      <tr>
                          <td>Ship Type</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $ship_type['ship_type'];  ?></td>
                      </tr>
                      <tr>
                          <td>Navigation Area/Country</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $vacantsea['navigation_area'] ?></td>
                      </tr>
                      <tr>
                          <td>Salary</td>
                          <td>:</td>
                          <td style="color:#0C0; font-weight:bold"><?php echo $vacantsea['sallary_curr']." ".number_format($vacantsea['annual_sallary'])." ".$vacantsea['sallary_rank'] ?> </td>
                      </tr>
                      <tr>
                          <td>Contract Type</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $vacantsea['contract_type'] ?></td>
                      </tr>
                      <tr>
                          <td>Contract Dynamics</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $vacantsea['contract_dynamic'] ?></td>
                      </tr>
                      <tr>
                          <td>Benefits</td>
                          <td>:</td>
                          <td class="tbl-bold">-</td>
                      </tr>
                      <tr>
                          <td valign="top">Description</td>
                          <td>:</td>
                          <td class="tbl-bold"><p align="justify"><?php echo $vacantsea['description'] ?></p></td>
                      </tr>
                      <tr>
                          <td>Vessel Name</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $ship['ship_name'] ?></td>
                      </tr>
                      <tr>
                          <td>Requested Certificates</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $vacantsea['requested_certificates'] ?></td>
                      </tr>
                      <tr>
                          <td>Required Certificates of Competency</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $vacantsea['requested_coc'] ?></td>
                      </tr>
                      <tr>
                          <td>Nationality</td>
                          <td>:</td>
                          <td class="tbl-bold"><?php echo $nationality['name'] ?></td>
                      </tr>
                  </table>
                  </div><!-- end table -->
           	  </div><!-- END QUALIFICATION -->
          	</div>
            
            <div class="col-lg-5 col-md-5 col-sm-5">
            <!-- company snapshot -->
               <div id="company_snapshot">
                 <h3 class="h3-title"><i class="fa fa-list-alt icon_header"></i> COMPANY SNAPSHOT</h3>
                 <table class="table table-stripped">
                    <tr>
                        <td>Web</td>
                        <td>:</td>
                        <td><a href="#"><?php echo $company['website'] ?></a></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><a href=""><?php echo $company['email'] ?></a></td>
                    </tr><!--
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>London Office :UCB House 3 George Street Watford, WD18 0BX</td>
                    </tr>-->
                    <tr>
                        <td>Phone No.</td>
                        <td>:</td>
                        <td><?php echo $company['no_telp'] ?></td>
                    </tr>
                 </table> 
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
            
              <div id="company_overview">
              <h3 id="overview" class="h3-title"><i class="fa fa-building-o icon_header"></i> COMPANY OVERVIEW</h3>			
                  <div class="company-overview wrap-text">
                      <p id="company_overview" class="cmpy_desc_p"><?php echo $company['description'] ?></p>
                  </div>
              </div>
                
               
                  
            </div>
            
          </div>
          
          <hr class="" style="border:1px double black"  /> 
          
          <div class="row" id="footer-content">
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
                              href="<?php echo base_url("vacantsea/apply/$id_segment/$title_segment")?>">Apply Now</a>
                              
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
          </div>
          
        </div>
    </div>
</div>

<?php /* 
<div id="content-detail" class="col-md-9 col-lg-9 col-sm-9">
    <section class="container header-separator-xs">
		<div id="position_card" class="row">
		<div class="col-lg-9 col-md-9 col-sm-9 col-sx-9">
			<div class="panel panel-default">
				
                <div class="panel-body position_panel">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">						
                    <div class="logo_sm_wrap">
                        <img id="company_logo" data-original="#" class="img-responsive" src="<?php echo base_url('assets/ulogo/'.$company["logo_image"]) ?>">
                    </div>						
                </div>
                
                <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">					   
                    <div class="job-position-wrap">	
                        <h5><a target="_blank" href="#"><u><?php echo $vacantsea['perusahaan']; ?></u></a></h5>					    
                        <h3><?php echo $vacantsea['vacantsea'] ?></h3>
                        <p align="justify" class="apply-now-bar-desc"><?php echo $vacantsea['description'] ?></p>
                        <p><?php echo $vacantsea['navigation_area'] ?> - <span style="font-weight:bold; color:#0C0"><?php echo $vacantsea['annual_sallary'] ?></span></p>
                    </div>
                </div>
                    
                    
				</div>
			</div>
		</div>
	</div>
	</section>	


<section class="container">
    <div class="row">
	<div class="col-lg-9 col-md-9 col-sm-9 col-sx-9" style="padding-left:0px !important; padding-right:0px !important;">
    
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">					
        <div class="panel panel-clean">
            <div class="panel-body">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
           		<h3 class="h3-title"><i class="fa fa-edit icon_header"></i> QUALIFICATION</h3>
                <div class="unselectable wrap-text" id="job_description"> 
                        <div class="table-responsive">
                        <table class="table table-stripped">
                            <tr>
                                <td>Department</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['departement'] ?></td>
                            </tr>
                            <tr>
                                <td>Rank</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['rank'] ?></td>
                            </tr>
                            <tr>
                                <td>Ship Type</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['ship_type'] ?></td>
                            </tr>
                            <tr>
                                <td>Navigation Area/Country</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['navigation_area'] ?></td>
                            </tr>
                            <tr>
                                <td>Salary</td>
                                <td>:</td>
                                <td style="color:#0C0; font-weight:bold"><?php echo $vacantsea['annual_sallary'] ?></td>
                            </tr>
                            <tr>
                                <td>Contract Type</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['contract_type'] ?></td>
                            </tr>
                            <tr>
                                <td>Contract Dynamics</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['contract_dynamic'] ?></td>
                            </tr>
                            <tr>
                                <td>Benefits</td>
                                <td>:</td>
                                <td class="tbl-bold">-</td>
                            </tr>
                            <tr>
                                <td valign="top">Description</td>
                                <td>:</td>
                                <td class="tbl-bold"><p align="justify"><?php echo $vacantsea['description'] ?></p></td>
                            </tr>
                            <tr>
                                <td>Vessel Name</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['ship'] ?></td>
                            </tr>
                            <tr>
                                <td>Requested Certificates</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['requested_certificates'] ?></td>
                            </tr>
                            <tr>
                                <td>Required Certificates of Competency</td>
                                <td>:</td>
                                <td class="tbl-bold"><?php echo $vacantsea['requested_coc'] ?></td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>:</td>
                                <td class="tbl-bold">-</td>
                            </tr>
                        </table>
                        </div><!-- end table -->
                 </div><!-- END QUALIFICATION -->
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
    <div class="panel panel-clean">
        <div class="panel-body">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="h3-title"><i class="fa fa-list-alt icon_header"></i>COMPANY SNAPSHOT</h3>
                         <table class="table table-stripped">
                         	<tr>
                                <td>Web</td>
                                <td>:</td>
                                <td><a href="#"><?php echo $company['website'] ?></a></td>
                            </tr>
                         	<tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><a href=""><?php echo $company['email'] ?></a></td>
                            </tr><!--
                         	<tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>London Office :UCB House 3 George Street Watford, WD18 0BX</td>
                            </tr>-->
                         	<tr>
                                <td>Phone No.</td>
                                <td>:</td>
                                <td><?php echo $company['no_telp'] ?></td>
                            </tr>
                         </table>   
            </div>
        </div>
    </div>																
    
    <div class="panel panel-clean visible-lg visible-md visible-sm">
        <div class="panel-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="gallery">
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
            </div>
            <div id="gallery-carousel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="gallery-thumb">
                        <li><img data-original="#" data-video="#" title="Video" /></li> 
     
                        <li><img data-original="#" class="img-responsive" title="" src="<?php echo base_url("assets/img/mane-20141014095813_mc-ckimage.jpg") ?>" /></li>
                        <li><img data-original="#" title="" /></li>
                        <li><img data-original="#" title="" /></li>
                </ul>
            </div>
        </div>
    </div>								
    
    <div class="panel panel-clean">
        <div class="panel-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 id="overview" class="h3-title"><i class="fa fa-building-o icon_header"></i> COMPANY OVERVIEW</h3>			
                <div class="company-overview wrap-text">
                	<p id="company_overview" class="cmpy_desc_p"><?php echo $company['description'] ?></p>
               </div>
            </div>
        </div>
    </div>								
    
    </div>                                
</div>
</div>
</section>


  <section class="container">
  <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
          <div class="panel panel-clean">
              <div class="panel-body apply-now-panel">
                  <div class="apply-now-wrap">
                      <div class="row">
                          <div id="apply-now-owa" class="col-lg-6 col-md-6 col-sm-5 col-xs-12 text-left apply-now-owa"></div>
                          	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-right apply-now-desc">	
                              <a type="button" class="btn btn-link apply-now-save" target="_blank" href="#">Save this job</a>
                         	</div>
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-right apply-btn-wrap">
                              <form action="#" method="post">
                                  <input type="hidden" value="1434772" name="job_id" id="job_id" />
                                  <input type="hidden" value="1435270" name="advertisement_id" id="advertisement_id" />
                                  <input type="hidden" value="40" name="s" id="s" />
                                  <input type="hidden" value="1" name="AdvertisementSource" id="AdvertisementSource" />
                                  <input type="hidden" name="fr" id="fr" value="" />
                                  <button id="apply_button" type="submit" class="btn btn-primary btn-lg apply-btn-padding " data-tracker="#">Apply Now</button>
                                  
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
              </div>
          </div>
      </div>
  </div>
  <div></div>
  </section>

</div> */  ?>
