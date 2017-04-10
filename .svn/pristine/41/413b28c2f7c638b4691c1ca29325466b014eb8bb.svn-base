<?php // content center , menu photo, module photo ?>
<script src="<?php echo base_url("assets/js/jquery.form.min.js");?>"></script>
<style>
.subpic{
	float:left; /* important */
	position:relative; /* important(so we can absolutely position the description div */ 
}
div.description{
	position:absolute; /* absolute position (so we can position it where we want)*/
	bottom:0px; /* position will be on bottom */ /* INGEET. UBAH INI NYA */
	left:0px;
	width:100%;
	/* styling bellow */
	background-color:black;
	font-family: 'tahoma';
	font-size:15px;
	color:white;
	opacity:0.6; /* transparency */
	filter:alpha(opacity=60); /* IE transparency */
}
p.description_content{
	padding:10px;
	margin:0px;
	font-weight:bold;
	opacity:0.9;
}

.list-pic{
	position:absolute; /* absolute position (so we can position it where we want)*/
	top:0px; /* position will be on bottom */ /* INGEET. UBAH INI NYA */
	right:0px;
}


</style>
<?php
	$id_user = $this->session->userdata("id_user");
?>
<div id="" class="col-md-12">
    <div class="panel panel-default"> 
        <div class="panel-body">
            <h3 class=""> Applied Job  </h3>
            <div> Here , you can checked the Vacantsea's you've already applied. </div>
            <hr />
            <?php
			foreach($applied_job as $row)
			{
				$vacantsea = $this->vacantsea_model->get_vacantsea_id($row['id_vacantsea']);
				$company = $this->company_model->get_detail_company($vacantsea['id_perusahaan']);
			?>
            <div class="col-lg-6" col-xs-6>
            	
                <div class="panel panel-default" style="border-radius:0">
                	<div class="panel-body" >
                      <div class="row" style="padding:0 10px 0 10px">
                        <span class="clearfix"></span>
                        <span class=""><img src="<?php echo base_url("assets/ulogo/$company[logo_image]") ?>" width="100" height="50" class="pull-left" style="margin-right:5px;" /> </span>
                        
                        <span class="dropdown messages-menu pull-right">
                          <a class="pull-right label label-primary dropdown-toggle" data-toggle="dropdown" style="font-size:14px" >
                            <span class="caret" >&nbsp;</span>
                             
                          </a>
                          <ul class="dropdown-menu pull-right" >
                            <li>
                              <a href="#">Canceling Applied Vacantsea</a>
                            </li>
                          </ul>
                        </span>
                       
                       
                        
                        <div><b><a href="<?php ?>"> <?php echo $vacantsea['vacantsea']; ?> </a></b></div>
                        <div class=""> <?php echo $company['nama_perusahaan']; ?></div>
                      </div>
                      
                    </div>
                    <div class="panel-footer">
                    	<a href="#" class="small-box-footer">
                          <?php $jml_applicant = $this->vacantsea_model->jml_applicant($id_vacantsea = $row['id_vacantsea'],$id_pelaut = $id_user); 
						  echo $jml_applicant." applicant";
						  ?>
                        </a>
                    </div>
                
                </div> 
            
            </div>
            <?php
			}
			
			?>
            
            
            
            <div role="tabpanel" hidden=true>
            <ul class="nav nav-tabs" role="tablist">
              
               <li role="presentation" class="active" id="pt-tab">
                 <a href="#photo_timeline" aria-controls="albums" role="tab" data-toggle="tab">Timeline</a>
              </li>
              <li role="presentation" id="photo-tab">
                 <a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a>
              </li>
              <li role="presentation" id="albums-tab">
                 <a href="#albums" aria-controls="albums" role="tab" data-toggle="tab">Albums</a>
              </li>
               
              
  
            </ul>
            
              <div class="tab-content">
               
                <div role="tabpanel" class="tab-pane" id="photos">
                    <span id="info_photo"></span>
                    <div>
                     
                    
                    </div>
                </div>
                
                <div role="tabpanel" class="tab-pane" id="albums">
                   <span id=""></span>
                    <div>
                     
                        sadfasdasdasdasdasdasd
                    </div>
                </div>
                
                 <div role="tabpanel" class="tab-pane active" id="photo_timeline">
                   <span id=""></span>
                    <div>
                     
                        
                    </div>
                </div>
                
                
              </div>
            </div>
            
        </div>
    </div>
        
</div><!-- col-md-8 -->