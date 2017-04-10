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
	$sallary = " 0 ";
}
else
{
	$smt = explode(" - ",$vacantsea["annual_sallary"]);
				
	if(count($smt) == 1)
	{
		if(!empty($vacantsea["annual_sallary"]))
		{
			$sallary = !empty($id_company) ? $vacantsea['sallary_curr']." ".number_format($vacantsea["annual_sallary"])." $vacantsea[sallary_range] " 
			: "Please Login to view the Salary";
		}
		else
		{
		  	$sallary = !empty($id_company) ? " Negotiable" : "Please Login to view the Salary";	
		}
	}
	else
	{
		if(!empty($vacantsea["annual_sallary"]))
		{
		  $sallary = !empty($id_company) ? $vacantsea['sallary_curr']." ".number_format($smt[0])." - ".
		  number_format($smt[1]).
		  " $vacantsea[sallary_range] " 
		  : "Please Login to view the Salary";
		}
		else
		{
		  $sallary = " Negotiable ";	
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
		  : "Please Login to view the Salary";
		}
		else
		{
		  $sallary = !empty($id_user) ? " Negotiable" : "Please Login to view the Salary";	
		}
	}
	else
	{
		if(!empty($vacantsea["annual_sallary"]))
		{
		  $sallary = !empty($id_user) ? $vacantsea['sallary_curr']." ".number_format($smt[0])." - ".
		  number_format($smt[1]).
		  " $vacantsea[sallary_range] " 
		  : "Please Login to view the Salary";
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
$now                = date('Y-m-d');

//get logo company
$logo_company           = check_logo_agentsea($username_comp);

?>

<div class="col-md-9">
<?php if($is_preview && ($position == "top_left")){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }
            elseif ($is_preview) {
                generate_preview_ads('top_left');
             } 
             /*
            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database
            else{
                generate_ads_container($list_iklan['top_left']);
            }
            */
    ?>
    <span class="clearfix"></span>
    <div class="box">
        <div class="media">
        	
            
            <a class="pull-left" href="<?=base_url('agentsea/'.$username_comp.'/home');?>">
                <img src="<?= $logo_company ?>" id="img-profile-company" class="thumbnail block " style="border:1px solid #CCC" height="80" width="90" />
            </a>

            <div class="media-body">
                <div class="pull-left">
                    <h4 class="media-heading"><span class="text-link"><a href="<?=base_url('agentsea/'.$username_comp.'/home');?>">
                        <?= $company["nama_perusahaan"] ?> </a> </span></h4>
                        
                    

                    <p><span class="text-gray"><?=$nationality["name"]?></span><br>
                        <b title="Rank : <?=$rank['rank'];?>"><?=$rank["rank"]?></b></p>
                </div>
                <?php
					if(!empty($sess_data["username_company"]) && $sess_data["username"] == $username_comp)
					{
				?>
                		<a href="<?="http://agent.informasea.com/edit_vacant/$company[id_perusahaan]&$company[username]&$vacantsea[vacantsea_id]_key"?>" target="_blank">
                          <button class="btn btn-primary pull-right">
                             <i class="glyphicon glyphicon-edit"></i> Edit 
                          </button>
                		</a>
                <?php
					}
					
				?>
                
                   
                <!--                            <div class="pull-right">-->
                <!--                                <button type="button" class="btn btn-outline">Save Job</button>-->
                <!--                                <button type="button" class="btn btn-filled">Apply</button>-->
                <!--                            </div>-->
                <span class="clearfix"></span>
            </div>
        </div>
        <div class="information">
            <!-- <h5 class="text-gray">
                About company:
            </h5>

            <p class="text-gray7"><?=$company["description"]?></p> -->
            <table class="text-gray7">
                <tr>
                    <td>Web</td>
                    <td>:</td>
                    <td><a href="#" class="text-link"><?=$company["website"]?> </a></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?=$company["email"]?></td>
                </tr> 
                <tr>
                    <td>Phone number</td>
                    <td>:</td>
                    <td><?=$company["no_telp"]?></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="information">
            <h5 class="text-gray">Salary</h5>

            <h3 class="<?php echo $class_text ?> small-margin-top"><?= $sallary ?></h3>

            <h5 class="text-gray">Title</h5>

            <h3 class="text-link small-margin-top"><?=$vacantsea["vacantsea"]?></h3>

            <h5 class="text-gray">Description:</h5>
            <p class="text-gray7"><?=$vacantsea["description"]?></p>
            <?php
            $qualification = [
			
                'Department',
                'Rank',
                'Ship Type',
                'Navigation Area',
                'Salary',
                'Contract Type',
                'Contract Dynamic',
				"Minimum experience",
                'Benefits',
                'Vessel Name',
                'Requested Certificates',
                'Required Certificates of Competency',
                'Seaman Nationality'
            ];
			
            $qlt_value = [
			
                $department["department"],
                $rank["rank"],
                $ship_type["ship_type"],
                $vacantsea['navigation_area'],
                $vacantsea["annual_allary"],
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
                <div class="pull-left">
                	
                	<i><a href="<?=base_url()?>"> informasea.com </a> does NOT charge any processing fees for job applications or for employments with us or for any external recruitment agents. If you are asked to pay any fees, please reject to pay and <a href="<?=base_url("contact")?>"> contact us </a> immediately.</i>
                </div>
                <div class="pull-right">
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
									?> 
									<a href='#' id='' class='pull-right btn btn-filled apply-vacant-button'><?=$this->lang->line("apply")?> </a> <?php 
									 }
								}
								else
								{
									echo "<a href='#' class='pull-right btn btn-filled apply-vacant-button'>".$this->lang->line("please_login")." </a>";
								}
							}
                            
                        }
                    ?>    
                   


                   
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
              <div class="g-plusone"></div>
			  <br><br>

	   <?php } // end if($now < $vacantsea['expired_date']) ?>
       
      <span class="clearfix"></span>
      
      <div class="fb-comments" data-href="<?=current_url()?>" data-numposts="5" data-width="700"></div>
      
      <span class="clearfix"></span>
       <?php
      if($is_preview && ($position == "bottom_left")){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }
            elseif ($is_preview) {
                generate_preview_ads('bottom_left');
             } 
             /*
            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database
            else{
                generate_ads_container($list_iklan['bottom_left']);
            }
            */
      ?>
      <span class="clearfix"></span>
       <?php
      
       if(count($vacantsea_terkait) != 0){ 
	   		
			$ship_type_text = "";
			if(!empty($ship_type["ship_type"]))
			{
				$ship_type_text = "or <i> $ship_type[ship_type] </i>";	
			}
	   
	   ?>
              <h3> Related Vacantsea : <i> <?php echo $rank["rank"]."</i> $ship_type_text" ?> </h3>

       <div class="row">
            <br>
        <?php foreach($vacantsea_terkait as $row) {

            $rank          = $this->rank_model->get_rank_detail($row["rank_id"]);
        	$ship_type    = $this->ship_model->get_ships_type($row["ship_type"]);

            $now = date('Y-m-d');
            $vacantsea_id = $row['vacantsea_id'];
            $check_applicant    = $this->vacantsea_model->check_applicant($row['vacantsea_id']);
       	    $already_applied    = !empty($check_applicant) ? true:false;
            $cek_status         = $this->vacantsea_model->GetApplicant("where id_vacantsea='$vacantsea_id' AND username='$user_pelaut'")->row_array();
			
			// check id_perusahaan dahulu
			/*if(($id_company != $vacantsea["id_perusahaan"]) && $id_company != "")
			{
				$sallary = " 0 ";
			}
			else
			{
				$smt = explode(" - ",$vacantsea["annual_sallary"]);
							
				if(count($smt) == 1)
				{
					if(!empty($vacantsea["annual_sallary"]))
					{
						$sallary = !empty($id_company) ? $vacantsea['sallary_curr']." ".number_format($vacantsea["annual_sallary"])." $vacantsea[sallary_range] " 
						: "Please Login to view the Salary";
					}
					else
					{
						$sallary = !empty($id_company) ? " Negotiable" : "Please Login to view the Salary";	
					}
				}
				else
				{
					if(!empty($vacantsea["annual_sallary"]))
					{
					  $sallary = !empty($id_company) ? $vacantsea['sallary_curr']." ".number_format($smt[0])." - ".
					  number_format($smt[1]).
					  " $vacantsea[sallary_range] " 
					  : "Please Login to view the Salary";
					}
					else
					{
					  $sallary = " Negotiable ";	
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
					  : "Please Login to view the Salary";
					}
					else
					{
					  $sallary = !empty($id_user) ? " Negotiable" : "Please Login to view the Salary";	
					}
				}
				else
				{
					if(!empty($vacantsea["annual_sallary"]))
					{
					  $sallary = !empty($id_user) ? $vacantsea['sallary_curr']." ".number_format($smt[0])." - ".
					  number_format($smt[1]).
					  " $vacantsea[sallary_range] " 
					  : "Please Login to view the Salary";
					}
					else
					{
					  $sallary = " - ";	
					}
				}
				
			}*/

         ?>
     
          <div class="col-md-3">
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="height:180px;margin-bottom:25px;">
               
                <div class="media-body">
                     <a href="<?= base_url("vacantsea/detail/".$row["vacantsea_id"]."/".replace_disallowed_char($row['vacantsea'])); ?>" class="subtitle text-link">
                        <h4 class="custom-h4" data-toggle="tooltip" data-placement="top" title="<?=$row["vacantsea"]?>">
						<?=substr($row["vacantsea"],0,20);?>..</h4>
                    </a>
                    <div class="float-left media-heading medium">
                        <a href="<?=base_url("agentsea/".$username_comp."/home");?>" class="text-link"><small>
						<?= $detail_comp["nama_perusahaan"] ?></small></a>
                    </div>
                   <!--  <div class="float-right subtitle text-gray">
                        Posted: <?//= date_format_simple($row['create_date']); ?>
                    </div> -->
                    <div style="clear: both"></div> 
                    <?php if($row['navigation_area'] != ""){ ?> 

<!--                     <div class="subtitle text-gray" >Navigation Area : <?php // echo $row['navigation_area'];?></div>
 -->


                    <?php } ?>
                    <div class="subtitle custom-h4" data-toggle="tooltip" data-placement="top" title="<?=$rank["rank"]?> / <?=$ship_type["ship_type"]?>">
					
						<?=substr($rank["rank"],0,8) ?>... / <?=substr($ship_type["ship_type"],0,8)?>...
                    
                    </div>
                                        <div class="subtitle text-gray">Salary :  <span class="text-danger custom-h7"> 

                            <?php echo  $row['sallary_curr']." ".number_format($row["annual_sallary"]); ?> </span>
                    </div>
                
                    <!-- <h4 class="<?php //echo $class_text ?> custom-h4"><?//= $sallary ?></h4> -->



                    <h7 class="text-danger custom-h7">
                        
                    </h7>
                     <!-- <div class="subtitle text-gray"> Contract dynamic </div>
                    <div style="float:left;width:80%;"> <p> <?php //echo $row['contract_dynamic']; ?> </p> </div> 
                    <div class="subtitle text-gray">&nbsp;</div><!-- 
                    <div class="subtitle text-gray">Descripton:</div>
                    <div style="float:left; width:80%"><p><?php// echo $row['description'];?></p></div> -->
                    <br>
                    <br>
                    <div class="subtitle"> 
                       <div class="text-muted pull-right"><?php //$a = date('F d, Y', strtotime($row['create_date']));

                       $b = explode(" ",$a);
                       if($b[0] != "march"){
        $b[0] =                         substr($b[0],0,3);
                       }

                    echo $b[0]." ".$b[1]." ".$b[2];


                       ?></div> 
                            <?php
                            $d1     = strtotime($row['expired_date']);
                            $end    = ceil(($d1-time())/60/60/24);
                            if ($end > "3") {
                                if ($end > 1 && $end <=7) {
                                    $expired    = $end;
                                   echo "<div class='text-muted pull-left' title='".$expired_date."'>End : <b>".$expired." Days Left</b> </div>";
                                }elseif ($end > 7 && $end <= 31) {
                                    $expired    = $end/7;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-left' title='".$expired_date."'>End : <b>".$expired." Weeks Left</b> </div>";
                                }elseif ($end > 31 && $end <=365 ) {
                                    $expired    = $end/31;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-left' title='".$expired_date."'>End : <b>".$expired." Month Left</b> </div>";
                                }elseif ($end > 365 ) {
                                    $expired    = $end/365;
                                    $expired    = round($expired,0);
                                    echo "<div class='text-muted pull-left' title='".$expired_date."'>End : <b>".$expired." Year Left</b> </div>";

                                }
                                
                            }elseif($end == "0"){
                                echo "<div class='text-danger pull-left' title='".$expired_date."'>End : <b>Today Left</b> </div>";
                            }else{
                                echo "<div class='text-danger pull-left' title='".$expired_date."'>End : <b>Expired </b> </div>";
                            }?>    
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>

       </div>
       <?php } ?>

      
      
    
    <!-- alternatif facebook button -->
    
    
</div>



<script>
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
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>


<div id="modal-login">
    <!--Ajax-->
</div>