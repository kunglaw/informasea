<section class="content">
    	
        <div id="first-section" class="container-fluid head landing-container-slider landing-container" >
        
        <?php /* dipasang caurosel */ ?>
        <div class="darker-background">
          <div class="container-fluid block">
              <div class="row">
              	 
               
             		<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      </ol>
                            
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                         <div class="text-box">
                           <h1 class="text-white" align="center"> <?=INFORMASEA_SLOGAN?> </h1>
                           
                           <p class="text-white" align="center"> <?=INFORMASEA_DESC?></p>
                           
                           <p align="center" class="">
                           	<input type="button" value="GET STARTED NOW" 
                            style="" 
                            class="btn btn-lg btn-huge btn-block text-white">
                           </p>
                           
                           <span class="clearfix"></span>
                         </div>
                        </div>
                        <div class="item">
                          <div class="text-box">
                 <h2 class="text-white" align="center"> Manage and find your qualified Crew </h2>
                 
                 <ul class="text-white">
                      <li> <img src="<?=asset_url("img/ic_register_search.svg")?>" class="pull-left"> <span> Search Crew, Find your qualified crew and candidate </span> </li>
                      <li> <img src="<?=asset_url("img/ic_register_managing.svg")?>" class="pull-left"> <span> managing and Scheduling crew by just one click on your schedule menu </span> </li>
                      <li> <img src="<?=asset_url("img/ic_register_social.svg")?>" class="pull-left"> <span> Posting Jobs and Share automatically on Informasea social media </span> </li>
                 
                 </ul>
                 <span class="clearfix"></span>
               </div>
                        </div>
                          
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                 
                 
                 <span class="clearfix"></span>
			  </div>
            
          </div>
          </div>
    	</div>
    	
        <div id="searchbar" class="container-fluid head" >
          <div class="container-fluid block">
              <div class="row">
        
                <form class="search-form text-white form-inline-custom" role="form" id="frm-search-dashboard">
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
                    <button class="btn btn-search-bg text-white form-control"><span class="glyphicon glyphicon-search"></span> &nbsp;Search&nbsp;</button>
                    </div>
                    <span class="clearfix"></span>
                </form>
                <img src="<?=asset_url("img/shadow-search-landingpage.png")?>" >
                
              </div>
          </div>
       	</div>
    
    <?php if($this->session->userdata("type_user") != "company"){?>
    <!-- <div class="vacant container-fluid landing-container" style="background-color:#207EC8">
    	<div class="row block block-home">
        
        </div>
    </div> -->
    <?php } ?>
    
    <div id="section-second" class="container-fluid landing-container">
        <div class="row block block-home">
         
                <div class="box-ss center-block col-md-3">
                	<img src="<?=asset_url("img/sailor-ico-blue.png")?>" class="">
                	<div class="text-box">
                      <h4> Seatizen Register </h4>
                      <p> lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. </p>
                    </div>
                    <p align="center"><button style="" class="btn btn-lg btn-default"> Register Now </button></p>
                    <span class="clearfix"></span>
                
                </div>
            
                <div class="box-ss center-block col-md-3">
                	<img src="<?=asset_url("img/ship-ico-blue.png")?>" class="">
                	<div class="text-box">
                      <h4> Agentsea Register </h4>
                      <p> lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. </p>
                      
                    </div>
                    <p align="center"><button class="btn btn-lg btn-primary"> Register Now </button></p>
                    <span class="clearfix"></span>
                
                </div>
            
                <div class="box-ss center-block col-md-3">
                	<img src="<?=asset_url("img/create-vacantsea-blue.png")?>" class="">
                	<div class="text-box">
                      <h4> Create Vacantsea </h4>
                      <p> lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. </p>
                    </div>
                    <p align="center"><button class="btn btn-lg btn-default"> Create Now </button></p>
                    <span class="clearfix"></span>
                
                </div>
                <span class="clearfix"></span>
            </div>
            <span class="clearfix"></span>
          
    </div>
    
    <div style="background-image:url('<?=asset_url("img/wave-landing-page.jpg")?>'); height:20px; z-index:40;">
	   <?php // list air ?>
    </div>
    
    <div id="third-section" class="container-fluid landing-container" style="background-color:#207EC8">
    	<div class="row block">
        	<div class="pull-left col-md-5" id="agentsea-list">
            
            	<h2 class="text-white"> Agentsea List </h2>
                <ul>
                <?php //foreach($agentsea_list as $row ){ ?>
                	<li>
                    	<img src="<?=asset_url("img/icon-ship.png")?>" class="img">
                        <div class="text-white">
                        	<span>PT Timur Ship Management</span> 
                            <span>3rd Engineer Officer</span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li>
                    	<img src="<?=asset_url("img/icon-ship.png")?>" class="img">
                        <div class="text-white">
                        	<span>PT Timur Ship Management</span> 
                            <span>3rd Engineer Officer</span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li>
                    	<img src="<?=asset_url("img/icon-ship.png")?>" class="img">
                        <div class="text-white">
                        	<span>PT Timur Ship Management</span> 
                            <span>3rd Engineer Officer</span>
                        </div>
                        
                        <span class="clearfix"></span>
                    </li>
            	
                
                
                <?php //} ?>
                </ul>
                
                <button class="btn btn-filled"> Read More </button>
                
            </div>
            
            <div class="pull-left col-md-5" id="seatizen-list">
            	<h2 class="text-white"> Seatizen List </h2>
                <ul>
                <?php //foreach($agentsea_list as $row ){ ?>
                	<li>
                    	<img src="<?=asset_url("img/seaman-ico.png")?>" class="img">
                        <div class="text-white">
                        	<span>Aries Dimas Yudhistira</span> 
                            <span>Indonesia</span>
                            <span>3rd Engineer Officer</span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li>
                    	<img src="<?=asset_url("img/seaman-ico.png")?>" class="img">
                        <div class="text-white">
                        	<span>Aries Dimas Yudhistira</span> 
                            <span>Indonesia</span>
                            <span>3rd Engineer Officer</span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
                    <li>
                    	<img src="<?=asset_url("img/seaman-ico.png")?>" class="img">
                        <div class="text-white">
                        	<span>Aries Dimas Yudhistira</span> 
                            <span>Indonesia</span>
                            <span>3rd Engineer Officer</span>
                        </div>
                        <span class="clearfix"></span>
                    </li>
            	
                <?php //} ?>
                </ul>
                
                <button class="btn btn-filled"> Read More </button>
                
            </div>
            
            <span class="clearfix"></span>
        </div>
    </div>
    
    <!-- <div class="container-fluid landing-container">
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
    </div> -->
    
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