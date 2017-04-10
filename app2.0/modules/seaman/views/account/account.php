<?php //experience, page friends, profile, module user ?>

<div class="box">

  <div class="box-header">

      <h4 class="box-heading header-text">Account Setting 

      <!-- <button class="btn btn-primary pull-right" id="editAccount" >

      		<i class="fa fa-edit"></i>Edit</button> -->

            <!-- <button class="btn btn-success pull-right" id="doneAccount"><i class="fa fa-edit"></i>Done</button> -->

      </h4>

      

      <span class="clearfix"></span>

  </div>

  

  <div class="box-content">

          <div class="unselectable wrap-text" style="margin-top: 10px;" id="job_description">

              

              

              	 <div class="panel panel-default">

                  <div class="panel-heading"><h5><b> Profile </b></h5></div>

              	  

                  <div class="table-responsive ">

                      <table class="table table-stripped panel-body" id="" style="">

                          <tr>

      

                              <td>Username</td>

                              <td>:</td>

                              <td class="tbl-bold"> <?php echo $detail_pelaut['username']; ?> </td>

                             <td align="center">

                                 <?php

                               if(count($edit_username) > 0){ ?>

    

                                <?php } else { ?>

                                                            <a href="#" onclick="javascript:change_username_modal()">Edit</a>

    

                                <?php 

                                } ?>

                              </td>

                          </tr>

                          <tr style="cursor: hand">

                              <td width="30%">Name</td>

                              <td width="1">:</td>

                              <td class="tbl-bold">

                                  <?php

                                  echo $detail_pelaut['nama_depan'] ?> <?php echo $detail_pelaut['nama_belakang'] ?>

                                  

                              </td>

                              <td align="center">

                                <a href="#" onclick="javascript:change_name_modal()">Edit</a>

                              </td>

                          </tr>

                          <tr>

                              <td>Email</td>

                              <td>:</td>

                              <td class="tbl-bold"><?php echo $detail_pelaut['email'] ?></td>

                              <td align="center">

    

                                <?php if($detail_pelaut['email2'] != "" OR $detail_pelaut['email2'] != NULL){ ?>

                                <a href="#" onclick="javascript:change_primary_email()"> Edit </a>

                                <?php 

                                }else{  ?>

                                     <a href="#" onclick="javascript:change_email_modal()">Edit</a>

    

                                <?php } ?>

                              </td>

                          </tr>

                          <!-- 

                          <tr id="old_password" hidden="hidden">

                              <td>Old Password</td>

                              <td>:</td>

                              <td class="tbl-bold">

                                <?php /* <input type="password" autocomplete="false" size="50" style="background-color: transparent; border: 0" readonly name="password" id="txtold_password" value=""> */ ?>

                              </td>

                          </tr>

                          <tr id="new_pass" hidden="hidden">

                              <td>New Password</td>

                              <td>:</td>

                              <td class="tbl-bold">

                              

                              <?php /* <input type="password" autocomplete="false" size="50" style="background-color: transparent; border: 0" readonly name="password" id="txtnew_password" value=""> */ ?>

                              

                              </td>

                          </tr>

                          <tr>

                              <td><p id="repass" hidden="hidden">Retype Password</p><p id="realpass">Password</p></td>

                              <td>:</td>

                              <td class="tbl-bold">

                                <?php /* <input type="password" autocomplete="false" size="50" style="background-color: transparent; border: 0" readonly name="password" id="password" value=""> */ ?>

                              </td>

                          </tr> -->

      

                      </table>

                  </div>

                 </div>

                 

                 <div class="panel panel-default"> 

                  <div class="panel-heading">

                  	 

                  		<h5 class="pull-left"><b> Cover Letter </b></h5> 

                        <div class="pull-right col-md-1" style="" onclick="edit_cover_letter()">

                        	<a href="#" class="" style="margin-left:20%; margin-right:80%"> Edit </a>

                        </div>

                        <div class="clearfix"></div>

                    

                  </div>

                 

                   

                

                  <div class="panel-body">  

                    

                    <?php if(!empty($profile["cover_letter"])){ ?>

                   		<?=htmlspecialchars_decode(html_entity_decode($profile["cover_letter"]))?>

                    

                    <?php } ?>

                  </div>  

                  

                 

                   

                 </div>

                  

                 <div class="panel panel-default"> 

                  <div class="panel-heading"><h5><b> Security </b></h5></div>

                  <div class="table-responsive ">

                  <table class="table table-stripped panel-body" id="">

                  	<tr>

                    	<td width="30%" >Password</td>

                        <td width="1">:</td>

                        <td class="tbl-bold"> <?php for($i=0;$i<40;$i++){ echo "*"; $i++; } ?> </td>

                        <td align="center">

                          	<a href="#" onclick="javascript:change_password_modal()">Edit</a>

                        </td>

                    </tr>

                  </table>

                  </div>

                 </div>

                 

                 <!-- 

                 <div class="panel panel-default"> 

                  <div class="panel-heading"><h5><b> Connect </b></h5></div>

                  <table class="table table-stripped panel-body" id="">

                  	<tr>

                    	<td width="30%" >Facebook</td>

                        <td width="1">:</td>

                        <td class="tbl-bold"> <?php for($i=0;$i<40;$i++){ echo "*"; $i++; } ?> </td>

                        <td align="center">

                          	<a href="#">Edit</a>

                        </td>

                    </tr>

                    <tr>

                    	<td width="30%" >Google</td>

                        <td width="1">:</td>

                        <td class="tbl-bold"> <?php for($i=0;$i<40;$i++){ echo "*"; $i++; } ?> </td>

                        <td align="center">

                          	<a href="#">Edit</a>

                        </td>

                    </tr>

                  </table>

                 </div>

                 -->

                 

              </div>

         

          

          <span class="clearfix" ></span>

          

        

          <div id="result"></div>   

  </div>

</div>