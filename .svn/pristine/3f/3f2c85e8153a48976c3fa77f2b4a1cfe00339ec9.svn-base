<section class="content">
    <div class="container-fluid landing-container head">
        <div class="section-header text-white mt-60">
            <h4><?=INFORMASEA_SLOGAN?></h4>
        </div>
          <div class="container-fluid">
            <form class="transparent search-form text-white form-inline-custom" role="form" id="frm-search-dashboard">
                <div class="form-group col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <input type="text" class="form-control search-query" id="keywordnya"
                           placeholder="Please enter a keyword">
                </div>
                <div class="form-group col-lg-2 col-md-4 col-xs-6 custom-select">
                    <select class="form-control " id="form-vesel">
                        <option value="">Vesel</option>
                        
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-4 col-xs-6  custom-select">
                    <select class="form-control" id="form-department">
                        <option value="">Department</option>
                        
                    </select>
                </div>
               <div class="form-group col-lg-2 col-md-4 col-xs-6 custom-select">
                    <select class="form-control" id="form-nationality">
                        <option value="">Nationality</option>
                        
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-4 col-xs-6 custom-select">
                    <select class="form-control" id="form-vacantsea">
                        <option value="vacantsea">Vacantsea</option>
                        <option value="seatizen">Seatizen</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-12 col-xs-12">
                <button class="btn btn-filled form-control">&nbsp;Search&nbsp;</button>
                </div>
                <span class="clearfix"></span>
            </form>


        </div>
    </div>
    <?php if($this->session->userdata("type_user") != "company"){?>
    <div class="vacant container-fluid landing-container" style="background-color:#207EC8">
    	<div class="row block">
        	<div class="col-md-6 text-left">
            	
                <h3 class="text-white"> Create your own Vacantsea today</h3>
                
                <p class="text-white"> Many Agencies has been registered and feel the service we provide </p>
                
                <p>
                <a class="btn btn-success btn-lg" href="#" onclick="javascript:quick_vacantsea()">
                	Create Vacantsea for Free
                </a>
                </p>
            
            </div>
            
            <div class="col-md-offset-1 col-md-5 text-left text-white list-vacant">
              
              <h1 class="text-white"> Manage and find your qualified crew </h1>
                            
              <div> 
               <img class="mid-icon pull-left vcon" src='<?= asset_url("img/ic_register_search.svg") ?>' alt="company logo"> 
               
               <span class="pull-left"> Search Crew. Find your qualified crew and candidate </span>
              
               <span class="clearfix"></span>
               
              </div>
              
              <div>
              	
                <img class="mid-icon pull-left vcon" src='<?=asset_url("img/ic_register_managing.svg") ?>' alt="company logo"> 
               
               <span class="pull-left"> Managing and Scheduling crew by just one click on your schedule menu </span>
              
               <span class="clearfix"></span>
              </div>
              
              <div>
              	<img class="mid-icon pull-left vcon" src='<?= asset_url("img/ic_register_social.svg") ?>' alt="company logo"> 
               
               <span class="pull-left"> Posting Jobs and Share automatically on Informasea Social Network </span>
              
               <span class="clearfix"></span>
              
              </div>
                    
               
              
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="container-fluid landing-container">
        <div class="row block block-home">
            <div class="col-md-6 text-left">
                <h1 class="text-link ">
                    Welcome to Informasea <br> Get Your Seatizenship Today
                </h1>

                <p class="text-gray">
                    <?=INFORMASEA_DESC?>
                </p>
                <button class="btn btn-filled">&nbsp;&nbsp;&nbsp;Get The Tour!&nbsp;&nbsp;&nbsp;</button>
            </div>
            
            <div class="col-md-offset-1 col-md-5 text-center">
                <h3 class="text-link">Join us now as..</h3>

                <div class="row center-block text-center text-gray">
                    <div class="center-block pull-left width-40p box-container" 
                        onmouseover="document.getElementById('ic-seaman').src='<?= asset_url("img/ic_landing_seaman_blue.svg")?>'"
                        onmouseout="document.getElementById('ic-seaman').src='<?= asset_url("img/ic_landing_seaman.svg")?>'">
                        <a href="<?php echo base_url("users/register/seaman") ?>">
                        	<img id="ic-seaman" class="img-responsive" src="<?= asset_url("img/ic_landing_seaman.svg")?>" >
                        <button class="btn btn-filled btn-full">Seaman
                        </button></a>
                        
                    </div>
                    or
                    <div class="center-block pull-right width-40p box-container"
                        onmouseover="document.getElementById('ic-company').src='<?=asset_url("img/ic_landing_company_blue.svg")?>'"
                        onmouseout="document.getElementById('ic-company').src='<?=asset_url("img/ic_landing_company.svg")?>'">
                        <a href="<?php echo base_url("users/register/agentsea/") ?>">
                        	<img id="ic-company" class="img-responsive" src="<?=asset_url("img/ic_landing_company.svg")?>" />
                        <button class="btn btn-filled btn-full"> Agentsea </button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <?php /*
    <!-- See list of Vacantsea -->
    <div class="container-fluid landing-container grey-container">
       <div class="block-home">
          <div class="section-header">
              <h3 class="text-link">VACANTSEA</h3>
              <div style="display: inline-block; text-align: center; vertical-align: top;">
                  <hr class="splitter"/>
              </div>
              <p class="text-gray7">Appropriate Vacantsea based on salary, experience, etc</p>
          </div>
          <div class="slider-container vacantsea-responsive text-left ">
              <?php 
                  for($x=0; $x<9; $x++) { ?>
                    <div class="col-md-4">
                    	 <a href="<?php echo base_url("vacantsea"); ?>">
                           <div class="media box white-container">
                              <div class="media-left text-center">
                                  <img class="logo-container" src='<?=base_url("assets/img/maersk_logo.jpg") ?>'
                                       alt="company logo">
                              </div>
                              <div class="media-body">
                                  <div class="media-heading medium text-link ft-18">
                                      PT Maersk Line
                                  </div>
                                  <div class="subtitle text-gray">Annual Salary:</div>
                                  <h4 class="subtitle custom-h4">IDR 90,000,000.00</h4>
                          
                                  <div class="subtitle text-gray">Position:</div>
                                  <h5 class="subtitle custom-h4">Asst. Missile Navigation</h5>
                              </div>
                          </div>
                        </a>
                    </div>
              <?php  }
              ?>
          </div>
          <p class="section-footer ">
              <a href="vacantsea-list.php" class="text-link section-footer">view all vacantsea</a>
          </p>
       </div>
    </div>
    
    <!-- See list of Seatizen -->
    <div class="container-fluid landing-container">
       <div class="block-home">
          <div class="section-header">
              <h3 class="text-link">SEATIZEN</h3>
              <div style="display: inline-block; text-align: center; vertical-align: top;">
                  <hr class="splitter"/>
              </div>
              <p class="text-gray7">Our qualified crew candidate</p>
          </div>
          <div class="slider-container seatizen-responsive">
          	  <?php $sli['col']  = 10; ?>
              <?php $this->load->view('include/seatizen-list-item',$sli) ?>
          </div>
  
          <p class="section-footer"><a href="seatizen.php" class="text-link ">view all seatizen</a></p>
       </div>
    </div>
    
    <!-- See list of Company -->
    <div class="container-fluid landing-container grey-container" id="agentsea-flat">
    	<div class="block-home">
          <div class="section-header">
              <h3 class="text-link">AGENTSEA</h3>
              <div style="display: inline-block; text-align: center; vertical-align: top;">
                  <hr class="splitter"/>
              </div>
              <p class="text-gray7">Our agentsea</p>
          </div>
          <div class="slider-container company-responsive">
              <?php 
                 $this->load->view('include/company-card');  //include("include/company-card.php");
              ?>
          </div>
  
          <p class="text-center section-footer">
              <a href="company-list.php" class="text-link ">view all agentsea</a>
          </p>
        </div>
    </div>
    
    <!-- See list of testimonal -->
    <div class="container-fluid landing-container" id="testimonial">
    	<div class="block-home">
          <div class="section-header">
              <h3 class="text-link">TESTIMONIALS</h3>
              <div style="display: inline-block; text-align: center; vertical-align: top;">
                  <hr class="splitter"/>
              </div>
              <p class="text-gray7">Our seatizen says</p>
          </div>
          
  
          <div class="container-fluid testimonial-responsive center-block">
              
          		<?php $this->load->view('include/testimonial-card'); //include("include/testimonial-card.php") ?>
             
          </div>
        </div>
    </div>
	
	*/ ?>
    
    

</section>



<!-- <a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm8.staticflickr.com/7501/15812584301_1d63602c58_b.jpg" title="elgol sunset (matty brooks)">
	<img src="http://farm8.staticflickr.com/7501/15812584301_1d63602c58_m.jpg" alt="" />
</a> -->