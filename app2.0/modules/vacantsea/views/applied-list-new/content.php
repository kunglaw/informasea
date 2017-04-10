<?php // content center , detail, module guest / pelaut 

	$username = $this->session->userdata("username");
?>
	 
<script>
</script>

<div class="col-md-9">
   <?php
	
	
	$this->load->view("menu_myjob.php");
	$id_user = $this->session->userdata("id_user");
	
	?>
  
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
                    	<a href="#" class="small-box-footer see-applicant-btn" id="" onclick="view_applicant(<?php echo $row['id_vacantsea'] ?>,
						<?php echo $id_user ?>)" >
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
</div>

<?php // dimana ada link see applicant. disitu ada ... ?>
<span class="list-applicant-temp"></span>

<script>
	function view_applicant(id_vacantsea,id_pelaut)
	{
		$.ajax({
			
			type:"POST",
			url:"<?php echo base_url("vacantsea/list_applicant"); ?>",
			data:"x=1&id_vacantsea="+id_vacantsea+"&id_pelaut="+id_pelaut,
			success: function(data){
				
				//alert(data);
				$(".list-applicant-temp").html(data);
			}
			
		});
	}
	
	$(document).ready(function(e) {
       
    });

</script>


        	