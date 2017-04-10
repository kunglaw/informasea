<?php // template register agentsea ?>

<section class="content container-fluid">
    <div class="row">
        <?php $this->load->view("left-content/left-agentsea") ?>
        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2>Create Vacantsea for FREE !!
                    
                </h2>
            </div>
          <?php $error 		   = $this->session->flashdata("error");  			 ?>
          <?php $success_company = $this->session->flashdata("success_company");  
		  
		  	if(!empty($error)){
				
				$dt_info["bg"]		   = "bg-danger";
				$dt_info["modal_title"]  = "Error"; 
				$dt_info["body_message"] = $error;
				
				$this->load->view("users/create-vacantsea/email-info",$dt_info); 
				
				echo "<div class='alert alert-danger'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <p> <div class='glyphicon glyphicon-exclamation-sign'></div> Error </p>".$error."</div>";
				
			}
			else if(!empty($success_company))
			{
				$dt_info["bg"]		   = "bg-success";
				$dt_info["modal_title"]  = "Success"; 
				$dt_info["body_message"] = $success_company;
				$this->load->view("users/create-vacantsea/email-info",$dt_info); 
				echo "<div class='alert alert-success'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$success_company."</div>";
			}
			
		  ?>
            
            <form class="transparent register-form" action="<?php echo base_url("users/company_process/create_vacantsea_process"); ?>" 
            role="form" method="post" id="register-agentsea">
            	
                <?php // role ini menentukan submit akan di process kemana ?>
                
                <input type="hidden" name="t" id="t" value="<?=filter($_GET['t'])?>" >
                
                 <div class="form-group">
                	<!-- <label for="title_vacantsea">Title Vacantsea</label> -->
                    <input type="text" class="form-control" name="title_vacantsea" id="title_vacantsea" placeholder="Title Vacantsea"
                    value="<?=set_value('title_vacantsea');?>">
                 </div>
                 
                 <div class="form-group" style="">
                    <!-- <label for="vessel_type">
                       Vessel Type                   	
                    </label> -->
                    <select class="form-control" name="vessel_type" title="select vessel type">
                    	<option value="" selected> - Select Vessel Type  - </option>
                    <?php
                        foreach($vessel_type as $row){
							
                            $svt = "";
                            if($row['type_id'] == $profile['vessel_type'] )
                            {
                              $svt = "selected='selected'";  
                            }
                            
                    ?>
                        <option value="<?php echo $row['type_id']; ?>" <?php echo $svt; ?> ><?php echo $row['ship_type']; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                  </div>
                  
                  <div class="form-group" style="">
                    <!-- <label for="department">
                        Department                    	
                    </label> -->
                    <select class="form-control" name="department" id="department" title="select department">
                    <option value="" selected> - Select Department - </option>
                    <?php
                        
                        foreach($department as $row){
                            
                            $sd  = "";
                            if($profile['department'] == $row['department_id'])
                            {
                                $sd = "selected='selected'";
                            }
                    ?>
                        <option value="<?php echo $row['department_id']; ?>" <?php echo $sd ?>><?php echo $row['department']; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <script>
                      $("#department").change(function(e)
                      { 
                          var department_id = $(this).val(); 
                          get_coc_class(department_id,"<?=$profile['coc_class']?>");
                          get_rank(department_id,"<?=$profile['rank']?>"); 
                          
                      });
                      
                     
					 function get_coc_class(department_id,id_coc_class)
					  {
                          $.ajax({
                              
                              type:"POST",
                              url:"<?php echo base_url("seaman/resume/get_coc_class"); ?>",
                              data:"department_id="+department_id+"&id_coc_class="+id_coc_class,
                              success: function(data)
                              {
                                  $("#coc_class").html(data);
                              }
                              
                          });
                      }
                      
                    </script>
                  </div>
                  
                  <!-- <div class="form-group" style="width:80%">
                    <label for="coc_class">
                        COC Class                    	
                    </label>
                    <select class="form-control" name="coc_class" id="coc_class">
                    <?php
                        
                        //foreach($coc_class as $row){
                         // $scc = "";
                          //if($profile['coc_class'] == $row['id_coc_class'])
                          //{
                              $scc = "selected='selected'";	
                          //}
                    ?>
                          
                        <option value="<?php //echo $row['id_coc_class']; ?>" <?php //echo $scc ?> ><?php //echo $row['coc_class']; ?></option>
                    <?php
                          
                       // }
                    ?>
                    </select>
                    <script>
            
                    
                    </script>
                  </div> -->
                  
                  <div class="form-group" style="">
                    <!-- <label for="rank">
                       Rank                 	
                    </label> -->
                    <select class="form-control" name="rank" id="rank" title="select rank">
                    <option value="" selected> - Select Rank - </option>
                    <?php
                       
                        foreach($rank as $row){
                             $sr = "";
                            if($row['rank_id'] == $profile['rank'] ){
                              $sr = "selected='selected'";  
                            }
                    ?>
                        <option value="<?php echo $row['rank_id']; ?>" <?php echo $sr ?>><?php echo $row['rank']; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                     <script>
                      
                      function get_rank(department_id,id_rank)
                      {
                          $.ajax({
                              
                              type:"POST",
                              url:"<?php echo base_url("seaman/resume/get_rank"); ?>",
                              data:"department_id="+department_id+"&id_rank="+id_rank,
                              success: function(data)
                              {
                                  $("#rank").html(data);
                              }
                              
                          });
                      }
                      
                    </script>
                  </div>
                
                <div class="form-group">
                	<div class="pull-left" style="width:27%">
                          
                          <select name="sallary_curr" id="sallary_curr" class="form-control">
                              <?php
                                $selected_dollar = "";
                                $selected_euro = "";
                                $selected_rp = "";
                                $selected_sgd = "";
                                
                                if($profile['exp_sallary_curr'] == "USD")
                                {
                                  $selected_dollar = "selected='selected'"; 
                                }
                                else if($profile['exp_sallary_curr'] == "EURO")
                                {
                                   $selected_euro = "selected='selected'"; 
                                }
                                else if($profile['exp_sallary_curr'] == "IDR")
                                {
                                   $selected_rp = "selected='selected'"; 
                                }
                                else if($profile['exp_sallary_curr'] == "SGD")
                                {
                                   $selected_sgd = "selected='selected'"; 
                                }
                              ?>
                           
                              <option value="USD" <?php echo $selected_dollar ?> >USD</option>
                              <option value="EURO" <?php echo $selected_euro ?> >EURO</option>
                              <option value="IDR" <?php echo $selected_rp ?> >IDR</option>
                              <option value="SGD" <?php echo $selected_sgd ?> >SGD</option>
                         
                          
                          </select>
                    </div>
                	<!-- <label for="title_vacantsea">Sallary</label> -->
                    <input type="text" class="form-control pull-left" name="sallary" id="sallary" placeholder="Sallary"
                    value="<?=set_value('sallary');?>" style="width:40%">
                    
                    <div class="pull-left" style="width:23%">
                          <select name="sallary_range" id="sallary_range" class="form-control">
                            <?php
                              $selected_day 		= "";
                              $selected_month 	  = "";
                              $selected_year	   = "";
                              
                              if($profile['sallary_range'] == "day")
                              {
                                  $selected_day 		= "selected='selected'";
                              }
                              else if($profile['sallary_range'] == "month")
                              {
                                  $selected_month 		= "selected='selected'";
                              }
                              else if($profile['sallary_range'] == "year")
                              {
                                  $selected_year 		= "selected='selected'";
                              }
                            
                            ?>
                            <option value="day" <?=$selected_day?> >/ Day</option>
                            <option value="month" <?=$selected_month?> >/ Month</option>
                            <option value="year" <?=$selected_year?> >/ Year</option>
                        
                          </select>
                    </div>
                    <span class="clearfix"></span>
                    
                </div>
                
                <div class="form-group">
                	<!-- <label for="title_vacantsea">Write More detail ... </label> -->
                    <textarea name="description" class="form-control" id="description" placeholder="Write More detail ..." ><?=set_value("description")?></textarea>
                </div>
                
                <div class="form-group">
                	<!-- <label for="username">Company Name</label>-->
                    <span id="element_company_name">
                      <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Company Name" 
                      value="<?=!empty($cprofile["company_name"]) ? $cprofile["company_name"] : set_value('nama_perusahaan');?>">
                    </span>
                </div>
                
                <div class="form-group">
                	<!-- <label for="email">Email</label> -->
                    <span id="email_info" class="label"></span>
                    <input type="email" <?=!empty($cprofile["email"]) ? "readonly" : "";?> value="<?=!empty($cprofile["email"]) ? $cprofile["email"] : set_value('email');?>"  class="form-control" id="email" name="email" placeholder="company email">
                   <!--  <span style="color:#999; font-style:italic; font-size:11px"> Free email address (gmail, yahoo , etc ) is not acceptable</span>
                    <br />
                    <span style="color:#999; font-style:italic; font-size:11px"> 
                    	<a href="<?=alpha_url("user/register")?>" target="_blank"> register </a> for free email address   
                    </span> -->
                </div>
                
                <!-- <div class="form-group">
                	<label for="username">Company Phone</label>
                    <span class="clearfix"></span>
                    <?php
						//$ext_num = $this->nation_model->get_nationality();
					?>
                    <select name="ext_num" id="ext_num" class="form-control pull-left" style="width:30%">
                    	<?php foreach($ext_num as $row){ ?>
                    	<option value="<?=$row['kode_telp']?>&<?=$row['id']?>" data-image="<?=strtolower(asset_url("flags/$row[flag]"))?>">
                        	<?=$row['kode_telp']?> - <?=$row['name']?>
                        </option>
                        <?php } ?>
                    </select>
                    
                    <input style="width:70%" type="text" class="form-control pull-right" id="phone_number" name="phone_number" placeholder="Company Phone Number" value="<?=set_value('phone_number');?>">
                    <span class="clearfix"></span>
                </div> -->
                
                <?php /* <div class="form-group">
                	<label for="username">Company Username</label>
                  
                    <span id="username_info" class="label" >
                    	
                    </span>
                   
                    <input type="text" value="<?=set_value('username');?>" class="form-control" id="username" name="username" placeholder="Company Username">
                    <span style="color:#999; font-style:italic; font-size:11px">If you register as Manager , Username will be set as your url </span><br />
                    <span style="color:#999; font-style:italic;  font-size:11px">eg: informasea.com/company/username </span>
                    
                </div> */ ?>
               	
                <div class="form-group">
                	<!-- <label for="first_name">Contact Person</label> --> 
                    <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person"
                    value="<?=!empty($cprofile["contact_person"]) ? $cprofile["contact_person"] :set_value('contact_person');?>">
                </div>
              	
                <!-- <div class="form-group">
                	<label for="nationality">Nationality</label>
                    <select name="nationality" id="nationality" class="form-control">
                    	<option value="">- Select Country -</option>
                        <?php foreach($ext_num as $row){ ?>
                        <option value="<?=$row['id']?>" data-image="<?=base_url("assets/flags/$row[flag]")?>">
                        	<?=$row['name']?>
                        </option>
                        <?php } ?>
                    </select>
                </div> -->
                
                <!-- <div class="form-group">
                	<label for="reemail">Re-Enter Email</label>
                    <input type="email" class="form-control" id="reemail" name="reemail" placeholder="Re-enter Email">
                </div>-->
                
                <?php /* <div class="form-group">
                	<label for="password">Password</label>
                    <input type="password" class="form-control" id="pasword" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                	<label for="re-password">Re-Enter Password</label>
                    <input type="password" class="form-control" id="re-password" name="repassword" placeholder="Re-enter Password">
                </div> */ ?>
                <!-- <div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div> -->
                <div>
				  <?php
                  echo "<img src='".base_url("users/generate_captcha")."' id='captcha-img'>";
                  ?><br>
                  <a hidden="true"  style="color:#FFF; text-decoration:underline" href="#captcha-img" onclick="
                  document.getElementById('captcha-img').src='<?=base_url("test/run_captcha")?>?'+Math.random();
                  document.getElementById('captcha-img').focus();"
                  id="change-image">Not readable? Change text.</a>
                  <input type="text" name="input_capt" style="color:black" placeholder="type the text above here ... ">
            	</div>
                <div class="pull-left" style="font-size: 12px">
                	By Clicking Register, You agree to our <a href="#" class="text-link"> terms </a>
                </div>
                <div class="pull-right">
                	<a href='<?=base_url("login")?>'> Login </a> Or 
                    <button class="btn btn-filled">Register</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</section>