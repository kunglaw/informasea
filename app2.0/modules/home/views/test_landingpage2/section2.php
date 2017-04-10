<?php //section2 ?>

<style>

	section .feature{
		min-height:520px !important;	

	}
</style>

<section class="section2">

	<div class="container">

		<div class="row title text-center">

			<h3>OFFERING THE BEST DEAL</h3>

			<h6 class="alt">What We Offer</h6>

		</div>

		<div class="row">

			<div class="col-md-4 feature text-center">

				<img src="<?=asset_url("img/sailor-ico-blue.png")?>" alt="" width="110" height="111" >
				
				<div class="text-box">

                      <h3><b> Seatizen </b></h3>

                        <p align="left"> Find your preferable vacantsea based on your qualification and expectation. </p>

                        <ul style="text-align:left">

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

                    

                    	<a href="<?=base_url("users/register_all")?>" class="btn read-more"><b>Register Now<b></a>

                    <?php } ?>

				

			</div>

			<div class="col-md-4 feature text-center">

				<!-- <img src="<?=asset_url("landingpage2/img/letter.png")?>" alt=""> -->
				<img src="<?=asset_url("img/ship-ico-blue.png")?>" width="110" height="111" id="aaa">
				<div class="text-box">

                      <h3><b> Agentsea </b></h3>

<!--                         <p><h5> Manage and find your qualified crew </h5></p>

 -->

                        <ul style="text-align:left;" id="stylelistnya">

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

                            	<div> <b> Hire Crew and Download Crew's Resume </b> </div> 

                            </li>

                            <li>

                            	<div> <b> Manage Crew's Document </b> </div> 

                                <span>Expired document notification</span> 

                            </li>

                            <li>

                            	<div><b> Scheduling crew contract  </b> </div>

                                <span>No more worries about crews ship assignment </span> 

                            </li>

                            <li> 

                            	<div> <b>  Post and Share Vacantsea </b> </div> 

                            </li>



                        </ul>

                      

                    </div>

                    

                    <span class="clearfix"></span>

                    

                    <!-- paling bawah -->

                    <?php if( $this->session->userdata("user") == ""){ ?>

                    

                    	<a href="<?=base_url("users/register_all")?>" class="btn read-more"><b> Register now </b></a>

                    <?php } ?>

				

			</div>

			<div class="col-md-4 feature text-center">

				<!-- <img src="<?=asset_url("landingpage2/img/watch.png")?>" alt=""> -->
                 <img src="<?=asset_url("img/create-vacantsea-blue.png")?>" width="110" height="111" id="aaa">

				<div class="text-box">

                      <h3><b> Create Vacantsea </b></h3>

                      <!--

                      <p> lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. lorem ipsum sit dolor amet. </p>

                      -->

                          <ul style="text-align:left">

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

                    	

                        <a href="<?=base_url("users/create_vacantsea")?>" class="btn read-more"><b>Create Now</b></a>

                    </p>

                    <?php } ?>

				

			</div>

		</div>

	</div>

</section>
