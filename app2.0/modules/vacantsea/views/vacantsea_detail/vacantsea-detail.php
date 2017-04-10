<?php
$username_comp      = $company["username"]; // username company
$username_seaman    = $this->session->userdata("username"); // username seaman
$vacantsea_title 	= $title;

$id = $this->uri->segment(3);
$sess_data = $this->session->all_userdata();
$id_user = $this->session->userdata("id_user");
$id_company = $this->session->userdata('id_perusahaan');

// check id_perusahaan dahulu
if(($id_company != $vacantsea["id_perusahaan"]) && $id_company != "")
{
	$sallary = " - ";
}
else
{
	$smt = explode(" - ",$vacantsea["annual_sallary"]);
				
	if(count($smt) == 1)
	{
		if(!empty($vacantsea["annual_sallary"]))
		{
			$sallary = !empty($id_company) ? $vacantsea['sallary_curr']." ".number_format($vacantsea["annual_sallary"])." $vacantsea[sallary_range] " 
			: $this->lang->line("please_login");
		}
		else
		{
		  	$sallary = " - ";	
		}
	}
	else
	{
		if(!empty($vacantsea["annual_sallary"]))
		{
		  $sallary = !empty($id_company) ? $vacantsea['sallary_curr']." ".number_format($smt[0])." - ".
		  number_format($smt[1]).
		  " $vacantsea[sallary_range] " 
		  : $this->lang->line("please_login");
		}
		else
		{
		  $sallary = " - ";	
		}
	}
}
	

if($id_user != "")
{
	//$sallary =  $vacantsea['sallary_curr']." ".number_format($vacantsea["annual_sallary"])." $vacantsea[sallary_range]";
	// mengecek apakah annual sallary aray atau bukan 
	$smt = explode(" - ",$vacantsea["annual_sallary"]);
					
	if(count($smt) == 1)
	{
		if(!empty($vacantsea["annual_sallary"])){
		
		  $sallary = !empty($id_user) ? $vacantsea['sallary_curr']." ".number_format($vacantsea["annual_sallary"])." $vacantsea[sallary_range] " 
		  : $this->lang->line("please_login");
		}
		else
		{
		  $sallary = " - ";	
		}
	}
	else
	{
		if(!empty($vacantsea["annual_sallary"]))
		{
		  $sallary = !empty($id_user) ? $vacantsea['sallary_curr']." ".number_format($smt[0])." - ".
		  number_format($smt[1]).
		  " $vacantsea[sallary_range] " 
		  : $this->lang->line("please_login");
		}
		else
		{
		  $sallary = " - ";	
		}
	}
	
}


// disarankan untuk membuat library baru
if(empty($sess_data["username_company"]) && ($sess_data["username"]))
{
	$class_text = "text-danger";
}
else
{
	$class_text =  "text-success";
}

$create = date_create($vacantsea['create_date']);
$expired = date_create($vacantsea['expired_date']);

$create = date_format($create, 'F d, Y');
$expired = date_format($expired, 'F d, Y');

//cek status vacantsea : process, reject, approve
$vacantsea_id       = $this->uri->segment(3);
$q_applicant        = $this->company_model->getapplicant("where id_vacantsea='$vacantsea_id' and username='$username_seaman' ")->row_array();
$status_applicant   = $q_applicant['status'];

//get logo company
$logo_company           = check_logo_agentsea($username_comp);

?>

<div class="col-md-9">
    <div class="box">
        <div class="media">
        	
            
            <a class="pull-left" href="<?=base_url('agentsea/'.$username_comp.'/home');?>">
                <img src="<?= $logo_company ?>" id="img-profile-company" class="thumbnail block " style="border:1px solid #CCC" height="80" width="90" />
            </a>

            <div class="media-body">
                <div class="pull-left" style="width:40%">
                	<h5 class="text-link small-margin-top"><?=$vacantsea["vacantsea"]?></h5>
                   	<h5 class="<?php echo $class_text ?> small-margin-top" ><?= $sallary ?></h5>
                    <p><b title="Rank : <?=$rank['rank'];?>"><?=$rank["rank"]?></b></p>
                    <p><span class="text-gray"><?=$nationality["name"]?></span><br>
                   
                </div>
                <div class="pull-right" style="width:40%">
                	 <h4 class="media-heading" style="text-align:right"><span class="text-link"><a href="<?=base_url('agentsea/'.$username_comp.'/home');?>">
                        <?php echo !empty($vacantsea["id_perusahaan"]) ? $company["nama_perusahaan"] : $company["company"] ?> </a> </span></h4>
                     <div class="information">
                        <!-- <h5 class="text-gray">
                            About company:
                        </h5>
            
                        <p class="text-gray7"><?=$company["description"]?></p> -->
                        <table class="text-gray7" align="right" style="text-align:right">
                            <tr>
                               
                                <td><a href="<?=$company["website"]?>" target="_blank" class="text-link"><?=$company["website"]?> </a></td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <?php
                                        if(empty($username_seaman))
                                        {
                                            $class_promotion_btn = "apply-vacant-button";
                                        }
                                        else
                                        {
                                            $class_promotion_btn = "";	
                                        }
                                    ?>
                                    <!-- <a href="#promotion" tabindex="promotion" title="click here to apply" class="<?=$class_promotion_btn?>">
                                        Send application to email
                                    </a> -->
                                    <?=$company["email"]?> </td>
                            </tr> 
                            <tr>
                                
                                <td><?=$company["no_telp"]?></td>
                            </tr>
                        </table>
                    </div>
                
                </div>
                <div class="pull-right" style="width:10%">
                	<?php
						if($sess_data["username_company"] == $company["username"])
						{
					?>
							<a href="<?="http://agent.informasea.com/edit_vacant/$company[id_perusahaan]&$company[username]&$vacantsea[vacantsea_id]_key"?>" target="_blank">
							  <button class="btn btn-primary pull-right">
								 <i class="glyphicon glyphicon-edit"></i> <?=$this->lang->line("edit") ?> 
							  </button>
							</a>
					<?php
						}
						
					?>
                </div>
                
                   
                <!--                            <div class="pull-right">-->
                <!--                                <button type="button" class="btn btn-outline">Save Job</button>-->
                <!--                                <button type="button" class="btn btn-filled">Apply</button>-->
                <!--                            </div>-->
                <span class="clearfix"></span>
            </div>
        </div>
        
        <hr>
        <div class="information">

            <h5 class="text-gray"><?=$this->lang->line("description");?>:</h5>
            
            <p class="text-gray7"><?=paragraph($vacantsea["description"]) //helper article_helper?></p>
            <hr>
            
            <?php
			
			$ship_type_lang 			= $this->lang->line("vessel_type");
			$nav_area_lang  			 = $this->lang->line("navigation_area");
			$salary_lang 			   = $this->lang->line("salary");
			$contract_type_lang 		= $this->lang->line("contract_type");
			$contract_dynamic_lang 	 = $this->lang->line("dynamic_contract");
			$minimum_experience_lang   = $this->lang->line("minimum_experience");
			$benefits_lang		     = $this->lang->line("benefits");
			$vessel_name_lang	      = $this->lang->line("vessel_name"); 
			//$req_cert_lang			 = $this->lang->line
			$seaman_nationality_lang   = $this->lang->line("seaman_nationality");
			
            $qualification = [
			
                'Department',
                "Rank",
                "$ship_type_lang",
                $nav_area_lang,
              
                "$contract_type_lang",
                "$contract_dynamic_lang",
				"$minimum_experience_lang",
                "$benefits_lang",
                $vessel_name_lang,
                'Requested Certificates',
                'Required Certificates of Competency',
                $seaman_nationality_lang
            ];
			
            $qlt_value = [
			
                $department["department"],
                $rank["rank"],
                $ship_type["ship_type"],
                $vacantsea['navigation_area'],
                
                $vacantsea['contract_type'],
                $vacantsea['contract_dynamic'],
				$vacantsea["experience"],
                $vacantsea['benefits'],
                $ship['ship_name'],
                $vacantsea['requested_certificates'],
                $vacantsea['requested_coc'],
                $nationality["name"]
				
            ]; ?>
            <div class="row text-gray7">
                <div class="col-md-6">
                    <table>

                        <?php
                        for ($i = 0; $i < 8; $i++) {
                            echo '<tr>
										<td>' . $qualification[$i] . '</td>
										<td>:</td>
										<td>';
                                        if(!empty($qlt_value[$i])){
                                            echo $qlt_value[$i];
                                        }else{
                                            echo "-";
                                        } 
                                        echo '</td>
									</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <?php
                        for ($i = 8; $i < 12; $i++) {
                            echo '<tr>
								<td>' . $qualification[$i] . '</td>
								<td>:</td>
								<td>';
								if(!empty($qlt_value[$i])){
									echo $qlt_value[$i];
								}else{
									echo "-";
								}
								echo '</td>
							</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
            <br>

            <div>
                <div class="pull-left">
                    <p class="text-gray7"><span class="text-link">Posted</span>: <?php echo $create ?> &nbsp;
                        &nbsp; <span
                            class="text-link">End</span>: <?= $expired ?></p>
                </div>
                <span class="clearfix"></span>
                <div class="">
                	
                	<i>
                    	
                        	<?=$this->lang->line("disclaimer_vacantsea")?>
                       
                    </i>
                </div>
                <div class="col-md-12">
                    <?php 
						
                        if($status_applicant == "Processed"){ 
                            echo "<div class='text-success applicants ft-12'><small>You've already applied for this vacant</small></div>";

                        }elseif ($status_applicant == "Approved") {
                            echo "<div class='text-success applicants ft-12'><small>Approved</small></div>";

                        }elseif ($status_applicant == "Rejected") {
                            echo "<div class='text-danger applicants ft-12'><small>Rejected</small></div>";

                        }elseif ($status_applicant == "Canceled") {
                            echo "<div class='text-warning applicants ft-12'><small>Canceled</small></div>";

                        }elseif ($status_applicant == "Hire") {
                            echo "<div class='text-success applicants ft-12'><small>Hire</small></div>";

                        }else{
							// echo "tes";
							// EXPIRED
							if ($now > $vacantsea['expired_date']) {
								
                           	 	echo "<button type='button' class='btn btn-full' data-container='body' data-toggle='popover' 
								data-placement='bottom' data-content='Sorry, Vacantsea Expired'> Expired </button> ";
							
                        	}else{
								echo "<input type='hidden' value='".$id."&".$vacantsea['vacantsea']."' id='url-data'>";
								$now            = date('Y-m-d');
								$id_perusahaan  = $this->session->userdata('id_perusahaan');
								$username_agent = $this->session->userdata('username_agent');
								$type_user      = $this->session->userdata("user");
	
	
								if ($type_user == "pelaut") {
									if ($now > $vacantsea['expired_date']) {
										
										echo "<button type='button' class='btn btn-full' data-container='body' data-toggle='popover' data-placement='top' data-content='Sorry, Vacantsea Expired'>Expired</button> ";
										
									}else{
									// echo "saya di daal";
										echo "<br>";
										$dt_apply["vacantsea"] = $vacantsea;
										$dt_apply["company"]   = $company;
										
										$this->load->view("form_apply",$dt_apply);
									?> 
									<!-- <a href='#' id='' class='pull-right btn btn-filled apply-vacant-button'>Apply </a> -->
								<?php 
									 }
								}
								else
								{
									echo "<a href='#' class='pull-right btn btn-filled apply-vacant-button'>".$this->lang->line("apply")."</a>";
								}
							}
                            
                        }
                    ?>    
                   
					<span class="clearfix"> </span>

                   
                </div>
              	
            </div>
           
           
            <span class="clearfix"> </span>
            
        </div>
       
    </div>
    <br>
    <?php
	  if($now < $vacantsea['expired_date']){ ?>
		  
			<?php //share facebook ?>
			  <div class="pull-left">
				<!-- Your share button code -->
				
				<!-- <div class="fb-share-button" data-href="<?=current_url()?>"></div> -->
				<!-- u=http%3A%2F%2Finformasea.com%2Fvacantsea%2Fdetail%2F58%2Ftitle-vacantsea-premium-agent -->
				
                <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" 
                href="https://www.facebook.com/sharer/sharer.php?app_id=1655530184684604&sdk=joey&u=<?=current_url()?>&display=popup&ref=plugin&src=share_button">
                
                <div class="btn btn-social btn-facebook ">
				  <span class="fa fa-facebook"></span>
				  Share <span class="count-box"></span>
				</div>
                
                </a>
                
                
                &nbsp;
                
                <!-- <a href="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fexample.com%2F">
				<div class="btn btn-social btn-facebook ">
				  <span class="fa fa-facebook"></span>
				 
				  Like
				</div>
                </a> -->
				
				 &nbsp;
				 
				<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=<?=current_url()?>">
				<div class="btn btn-social btn-google">
				  <span class="fa fa-google"></span>
				 
				  Share
				</div>
				</a>
				
				&nbsp;
				
				<!-- <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=<?=current_url()?>">
				<div class="btn btn-social btn-google">
				  <span class="fa fa-google"></span>
				 
				  +1
				</div>
				</a>
				
				&nbsp; -->
				
				<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://twitter.com/intent/tweet?status=<?=$vacantsea['vacantsea']?>+<?=current_url()?>">
				<div class="btn btn-social btn-twitter">
				  
					<span class="fa fa-twitter"></span>
					
					Tweet
				  
				</div>
				</a>
				
                &nbsp;
                
                <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=current_url()?>&title=<?=$vacantsea['vacantsea']?>&source=<?=base_url()?>">
                  <div class="btn btn-social btn-linkedin">
                    <span class="fa fa-linkedin"></span>
                   
                    Share
                  </div>
                </a>
				 
				
				 
				 <!-- <div class="fb-like" data-href="<?=replace_disallowed_char($vacantsea['vacantsea'])?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> -->
				 
				 &nbsp;
				 
			  </div>
              
              <span class="col-md-1 pull-left"></span>
              
              <div class="pull-left">
              	<div class="fb-like" data-href="<?=current_url()?>" 
                data-layout="button_count" 
                data-action="like" 
                data-show-faces="false" 
                data-share="false"></div> 
              </div>
              
              &nbsp;
              
              
              <!-- Place this tag where you want the +1 button to render. -->
              <style> #___plusone_0{ width:70px !important;}</style>
              <div class="g-plusone"></div>
              
              <a href="http://bufferapp.com/add" class="buffer-add-button" data-count="horizontal" ></a>
			  <script type="text/javascript" src="https://static.buffer.com/js/button.js"></script>
              
			  <br><br>

	   <?php } // end if($now < $vacantsea['expired_date']) ?>
       
      <span class="clearfix"></span>
      <!-- <div id="disqus_thread"><!-- DISQUS </div>-->
      <span class="clearfix"></span>
       
       <div class="row">
       		<div class="col-md-6">
            	<?php 
					//include "list-vacantsea-terkait.php";
					//$this->load->view("vacantsea_detail/vacantsea-terkait");
					$this->load->view("vacantsea_detail/list-vacantsea-terkait");
				?>
            </div>
            <div class="col-md-6">
            	<?php $this->load->view("vacantsea_detail/magz_news");?>
            </div>
       <?php //include "vacantsea-terkait.php"; 
	   	
	   
	   ?>
       </div>
      
      
      
    
    <!-- alternatif facebook button -->
    
    
</div>



<!-- <script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    /*
    var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        
        s.src = '//informaseacom.disqus.com/embed.js';
        
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript> -->


<div id="modal-login">
    <!--Ajax-->
</div>