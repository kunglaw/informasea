		  <style>
              #bs-example-navbar-collapse-1 ul li {
               font-weight:bold;
               border-left:#CCC solid 1px;
          
              }
          </style>

          <?php
 			$url_cover   = check_cover_agentsea($company["username"]);
			$profile_pic = check_logo_agentsea_thumb($company["username"]); 
			//          echo $url_cover;
          ?>        

            <div class="panel-body row" style="background-image:url(<?php echo $url_cover ?>); height:315px; margin-top: -15px;background-repeat:no-repeat; background-size:cover">
               <div class="panel-body position_panel" style="margin-top: 170px">
                
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">						
                      <div class="logo_sm_wrap">
                        <img id="company_logo" data-original="#" class="img-responsive" src="<?php echo $profile_pic ?>" 
                        style="background-color:#FFF">
                      </div>						

                    </div>
                    <h1><?php echo $company["nama_perusahaan"]; ?></h1>
        	     </div>
            </div>
            <nav class="navbar bg-primary row" style="margin-top:-20px; color:#000 !important" >
                <div class="container-fluid">
                   <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header" style="width:262px">
                  
                    </div>
                  
  				      	
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        
                        <li class="active"><a href="<?php echo base_url("company/home/".$company['id_perusahaan']."/".$company['nama_perusahaan']) ?>">Home</a></li>
                        <li class="active"><a href="<?php echo base_url("company/get_detail_company/".$company['id_perusahaan']."/".$company['nama_perusahaan']) ?>">Profile</a></li>
                        <li><a href="<?php echo base_url("company/list_company_vacantsea/".$company['id_perusahaan']."/".$company['nama_perusahaan'])?>">Vacantsea</a></li>
                        <li><a href="<?php echo base_url("company/information/".$company['id_perusahaan']."/".$company['nama_perusahaan'])?>">Information</a></li>
                        <li><a href="<?php echo base_url("company/company_photos/".$company['id_perusahaan']."/".$company['nama_perusahaan'])?>">Photo</a></li>
                        <li><a href="<?php echo base_url("company/ships_list/".$company['id_perusahaan']."/".$company['nama_perusahaan'])?>">Ships</a></li>
                        <li><a href="#" style="border-right:#CCC solid 1px">More</a></li>
                       
                      </ul>
                      
                      <!-- <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                          </ul> -->
                        <!-- </li>
                      </ul> -->
                      </div>
                      </div>
                      </nav>