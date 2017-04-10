<section class="content">
    	
        <div id="first-section" class="container-fluid head landing-container-slider landing-container" >
        
       
        
        <?php /* dipasang caurosel */ ?>
        <div class="darker-background">
          <div class="container-fluid block">
              <div class="row" style="margin-left:0px">
              	 
               
             		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      </ol>
                            
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        
                        <div class="item">
                         <div class="text-box">
                           <h1 class="text-white" align="center"> <?=INFORMASEA_SLOGAN?> </h1>
                            <?php /*
                           <p class="text-white" align="center"> <?=INFORMASEA_DESC?> </p>
                           */ ?>

                           <p align="center" class="">
                            <a href="<?php echo base_url('users/register');?>" target="_blank">
                           	<input type="button" value="GET YOUR SEATIZENSHIP TODAY" 
                            style="" class="btn btn-lg btn-huge btn-block text-white"> </a>
                           </p>
                           
                           <span class="clearfix"></span>
                         </div>
                        </div>
                        
                       <div class="item active">
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
          <div class="container-fluid block" style="padding-right: 5%; padding-left:5%">
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
                <img src="<?=asset_url("img/shadow-search-landingpage.png")?>" class="hidden-xs" style="width:100%" >
                
              </div>
          </div>
       	</div>
    
    
    <!-- <div class="vacant container-fluid landing-container" style="background-color:#207EC8">
    	<div class="row block block-home">
        
        </div>
    </div> -->
      <div class="clearfix"> </div>
    <?php //if( $this->session->userdata("user") == ""){?>

    <div id="section-second" class="container-fluid landing-container">
        <div class="row block">
        	 
             <!-- popup gambar -->
          	 <!-- <a class="test-popup-link" href="<?=asset_url("img/kartu-lebaran.png")?>" hidden>Open popup</a> -->
             
            <div class="test-row">
                <div class="box-ss col-md-3 col-sm-10 col-xs-10">
                  <img src="<?=asset_url("img/sailor-ico-blue.png")?>" class="img-responsive" id="aaa">
                  <div class="text-box">
                      <h3><b> Seatizen </b></h3>
                        <p> Find your preferable vacantsea based on your qualification and expectation. </p>
                        <ul>
                          <li>
                          	  <div> <b> Apply Vacantsea </b></div> 
                              <span> Apply and leave a message to promote yourself. <br> be the first to get hired! </span> 
                          </li>
                          <li>
                              <div>  <b> Seafarers Networking </b> </div> 
                          </li>
                          <li>
                              <div> <b> Expired Document Reminder </b></div>
                              <span> Keep your resume up to date! </span> 
                          </li>
                        </ul>
                    </div>
                    
                    <span class="clearfix"></span>
                    
                    <!-- paling bawah -->
                    <?php if( $this->session->userdata("user") == ""){ ?>
                    <p align="center" class="bawah"><a href="<?=base_url("users/register_all")?>" target="_blank" class="btn btn-lg btn-primary"> Register Now </a></p>
                    <?php } ?>
                    
                
                </div>
             
                <div class="box-ss col-md-3 col-sm-10 col-xs-10">
                  <img src="<?=asset_url("img/ship-ico-blue.png")?>" class="img-responsive" id="aaa">
                  <div class="text-box">
                      <h3><b> Agentsea </b></h3>
<!--                         <p><h5> Manage and find your qualified crew </h5></p>
 -->
                        <ul style="list-style-image: url('<?php echo asset_url('icon.png');?>');" id="stylelistnya">
                    <!--      <li> <div> <b> Search Crew </b></div> 
                              <span> Find your qualified crew and candidate </span> 
                            </li>
                            <li>
                              <div>  <b> Managing and Scheduling crew by just one click </b> </div> 
                                <span> on your schedule menu </span> 
                            </li>
                            <li>
                              <div> <b> Posting Jobs and Share  </b></div>
                                <span> automatically on Informasea Social Network </span> 
                            </li> -->
                            <li> 
                            	<div> <b> Hire Crew and Get Crew resume automatically </b> </div> 
                            </li>
                            <li>
                            	<div> <b> Manage Document </b> </div> 
                                <span>  Expired document reminder </span> 
                            </li>
                            <li>
                            	<div><b> Scheduling crew contract  </b> </div>
                                <span> No more worries about crews ship assignment </span> 
                            </li>
                            <li> 
                            	<div> <b>  Post and Share Vacantsea </b> </div> 
                            </li>

                        </ul>
                      
                    </div>
                    
                    <span class="clearfix"></span>
                    
                    <!-- paling bawah -->
                    <?php if( $this->session->userdata("user") == ""){ ?>
                    <p align="center" class="bawah"><a href="<?=base_url("users/register_all")?>" target="_blank" class="btn btn-lg btn-primary"> Register Now </a></p>
                    <?php } ?>
                    
                
                </div>
            
                <div class="box-ss col-md-3 col-sm-10 col-xs-10">
                  <img src="<?=asset_url("img/create-vacantsea-blue.png")?>" class="img-responsive" id="aaa">
                  <div class="text-box">
                      <h3><b> Create Vacantsea </b></h3>
                      <!--
                      <p> lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. </p>
                      -->
                          <ul>
                          <li> <div> <b> Post and Share Vacantsea </b></div> 
                              <span> to any social network </span> 
                            </li>
                            <li>
                              <div>  <b> Get Applicant and Sort them </b> </div> 
                                <span> based on experience  </span> 
                            </li>
                            <li>
                              <div><b> Send message to any applicant </b> </div>
                            </li>
                            <li>
                              <div> <b> Hire Crew and  Manage Crews document immedately </b></div>
<!--                                 <span> Complete your resume will make agencies to find you easier </span> 
 -->                            </li>
                        </ul>

                    </div>
                    
                    <span class="clearfix"></span>
                    
                    <?php if( $this->session->userdata("user") == ""){ ?>
                    <p align="center" class="bawah">
                    	<a href="<?=base_url("users/create_vacantsea")?>" target="_blank">
                    		<button class="btn btn-lg btn-primary"> Create Now </button>
                        </a>
                    </p>
                    <?php } ?>
                    
                
                </div>
                <span class="clearfix"></span>
            </div>
        </div>
        <span class="clearfix"></span>
          
    </div>



    <?php /*
    <div id="section-second" class="container-fluid landing-container">
        <div class="row block">
         	
            <div class="test-row">
                <div class="box-ss col-md-3 col-sm-10 col-xs-10">
                	<img src="<?=asset_url("img/sailor-ico-blue.png")?>" class="img-responsive" id="aaa">
                	<div class="text-box">
                      <h3> Seatizen Register </h3>
                        <p> Informasea helps you to find your preferable vacantsea based on your qualification and expectation. </p>
                      	<ul>
                        	<li> <!-- <div> <b> Search Vacantsea </b></div> 
                            	<span> Find your preferable jobs on department, rank , sallary, ect </span>  -->
                              <div><b>  Apply Vacantsea </b> </div>
                              <span>  Apply and leave a message to promote yourself . <br>
                                be the first to get hired ! </span>
                            </li>
                            <li>
                            	<div>  <b> Seafers Networking </b> </div> 
                                <span> Keep in touch with all seafarer and manning agencies </span> 
                            </li>
                            <li><!-- 
                            	<div> <b> Managing Schedule </b></div>
                                <span> Complete your resume will make agencies to find you easier </span>  -->
                                <div><b> Expired document reminder </b> </div>
                                <span> Keep your resume to up to date! </span>


                            </li>
                        </ul>
                     
                    </div>
                    
                    <span class="clearfix"></span>
                    <br>
                    <!-- paling bawah -->
                    <p align="center"><a href="<?=base_url("users/register")?>" target="_blank" class="btn btn-lg btn-primary"> REGISTER NOW </a></p>
                    
                
                </div>
            
                <div class="box-ss col-md-3 col-sm-10 col-xs-10">
                	<img src="<?=asset_url("img/ship-ico-blue.png")?>" class="img-responsive" id="aaa">
                	<div class="text-box">
                      <h3> Agentsea Register </h3>
                        <p><h5> Manage and find your qualified crew </h5></p>
                      	<ul>
                        	<li class="fa fa-cog"> <div> <b> Search Crew </b></div> 
                            	<span> Find your qualified crew and candidate </span> 
                            </li>
                            <li>
                            	<div>  <b> Managing and Scheduling crew by just one click </b> </div> 
                                <span> on your schedule menu </span> 
                            </li>
                            <li>
                            	<div> <b> Posting Jobs and Share  </b></div>
                                <span> automatically on Informasea Social Network </span> 
                            </li>
                        </ul>
                      
                    </div>
                    
                    <span class="clearfix"></span>
                    
                    <!-- paling bawah -->
                    <p align="center" class="bawah"><a href="<?=base_url("users/register/agentsea")?>" target="_blank" class="btn btn-lg btn-primary"> REGISTER NOW </a></p>
                    
                
                </div>
            
                <div class="box-ss col-md-3 col-sm-10 col-xs-10">
                	<img src="<?=asset_url("img/create-vacantsea-blue.png")?>" class="img-responsive" id="aaa">
                	<div class="text-box">
                      <h3> Create Vacantsea </h3>
                      <!--
                      <p> lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. </p>
                      -->
                          <ul>
                          <li> <div> <b> Post and Share Vacantsea </b></div> 
                              <span> to any social network </span> 
                            </li>
                            <li>
                              <div>  <b> Get Applicant and Sort them </b> </div> 
                                <span> based on experience  </span> 
                            </li>
                            <li>
                              <div><b> Send message to any applicant </b> </div>
                            </li>
                            <li>
                              <div> <b> Hire Crew and  Manage Crews document immedately </b></div>
<!--                                 <span> Complete your resume will make agencies to find you easier </span> 
 -->                            </li>
                        </ul>

                    </div>
                    
                    <span class="clearfix"></span>
                    
                    <p align="center" class="bawah"><button class="btn btn-lg btn-primary" onClick="quick_vacantsea()"> Create Now </button></p>
                    
                
                </div>
                <span class="clearfix"></span>
            </div>
        </div>
        <span class="clearfix"></span>
          
    </div> */ ?>
    <?php //} ?>
    
    <div style="background-image:url('<?=asset_url("img/wave-landing-page.jpg")?>'); height:20px; z-index:40;">
	   <?php // list air ?>
    </div>
    
    <?php $this->load->view("third-section"); ?>
    
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