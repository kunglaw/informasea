<?php

// Fatal error: Can't use method return value in write context in /home/infr6975/public_html/informasea/app2.0/modules/company/views/include/vacantsea-list-item.php on line 9
$this->load->model('nation_model');
$this->load->model('vacantsea/vacantsea_model');

$username           = $this->uri->segment(2);
$username_pelaut    = $this->session->userdata('username');
$get_vacantsea      = $this->company_model->vacantsea("where username='$username' AND stat = 'open' order by create_date desc limit 5");

$get_vacantsea	  = $get_vacantsea->result_array();

if(!empty($get_vacantsea))
{
  foreach ($get_vacantsea as $key) {
  
	  $vacantsea_id   = $key['vacantsea_id'];
	  $vacantsea      = $key['vacantsea'];
	  $perusahaan     = $key['perusahaan'];
	  $description    = $key['description'];
	  $departement_id = $key['departement'];
	  $rank_id        = $key['rank_id'];
	  $ship_id        = $key['ship_type'];
	  $navigation_area    = $key['navigation_area'];
	  $annual_sallary     = $key['annual_sallary'];
	  $contract_type      = $key['contract_type'];
	  $contract_dinamic   = $key['contract_dinamic'];
	  $ship               = $key['ship'];
	  $requested_certificates   = $key['requested_certificates'];
	  $requested_coc      = $key['requested_coc'];
	  $nationality_id     = $key['id_nationality'];
	  $create_date        = $key['create_date'];
	  $expired_date       = $key['expired_date'];
	  $benefits           = $key['benefits'];
	  $sallary_range      = $key['sallary_range'];
	  $sallary_curr       = $key['sallary_curr'];
	  $experience         = $key['experience'];
	  $logo               = img_url("company/default/maersk_logo.jpg");
      
	 
	  $placement          = $this->nation_model->get_detail_nationality($nationality_id);
	  $flag_placement     = strtolower($placement['flag']);
  
	  $username_pelaut    = $this->session->userdata("username"); // username seaman
	  $q_applicant        = $this->company_model->getapplicant("where id_vacantsea='$vacantsea_id' and username='$username_pelaut' ")->row_array();
	  $status_applicant   = $q_applicant['status'];
	  $mess_applicant     = $q_applicant['message'];
	  $mess_hire          = "Congratulation !! ";
  
	  //count applicant
	  $sum_applicant      = $this->company_model->count_applicant("where id_vacantsea='$vacantsea_id'")->row_array();
  
  ?>
  <div class="list-group-item">
	  <div class="media">
		  <div class="media-left text-center">
			  <img src="<?=$profil_pic;?>" alt="company logo"
				   class="logo-container thumbnail block " width="115" height="115">
					  <?php
					  //V.2
					  $id_perusahaan      = $this->session->userdata("id_perusahaan");
					  $username_company   = $this->session->userdata("username_company"); // username company
					  $username_sitizen   = $this->session->userdata("username"); // username seaman
					  $type_user          = $this->session->userdata("type_user");
  
					  $d1     = strtotime($expired_date);
					  $end    = ceil(($d1-time())/60/60/24);
					  $now    = date("Y-m-d");
  
					  if ($type_user == "pelaut" || $user == "pelaut") { // LOGIN : PELAUT
						  if ($now > $expired_date) { // jika expired
							  echo "<button type='button' class='btn btn-full' >".$this->lang->line("expired")."</button> ";
						  
						  }else{ 
							  if ($status_applicant == "Processed") {
								  echo "<div class='text-success applicants ft-12'><small>".$this->lang->line("already_applied")."</small></div>";
  
							  }elseif ($status_applicant == "Approved") {
								  echo "<button type='button' class='btn btn-full btn-info' data-toggle='tooltip' data-placement='bottom' title='".$mess_applicant."'>
								  <i class='glyphicon glyphicon-ok'></i> ".$this->lang->line("approved")."</button>";
  
							  }elseif ($status_applicant == "Rejected") {
								  echo "<button type='button' class='btn btn-full btn-danger' data-toggle='tooltip' data-placement='bottom' title='".$mess_applicant."'>
								  <i class='glyphicon glyphicon-remove'></i> ".$this->lang->line("rejected")."</button>";
  
							  }elseif ($status_applicant == "Hire") {
								  echo "<button type='button' class='btn btn-full btn-success' data-toggle='tooltip' data-placement='bottom' title='".$mess_hire."'>
								  <i class='glyphicon glyphicon-ok'></i> ".$this->lang->line("hired")."</button>";
								  
							  }else{
								  echo "<a href='".base_url('vacantsea/detail/'.$vacantsea_id)."' class='btn btn-filled btn-full block apply-vacant-button'>".
								  $this->lang->line("apply")
								  ."</a>";
							  }
  
							   //count applicant
							  if ($sum_applicant['jumlah'] > 0) {
								  echo "<div class='text-gray applicants ft-12'><small>".$sum_applicant['jumlah']." ".$this->lang->line("aplicant")."</small></div>";
							  }
						  }
  
					  }elseif ($type_user == "company" || $type_user == "agent") { //LOGIN : COMPANY AND AGENT
						  //count applicant 
						  if ($sum_applicant['jumlah'] > 0) {
							  echo "<div class='text-gray applicants ft-12'><small>
							  <a href='$url/applicant_list/".$id_perusahaan."&".$username_company."&".$vacantsea_id."_key"."' target='_blank'>".$sum_applicant['jumlah']." applicant</a>
							  </small></div>";
						  }
  
					  }else{ // USER NOT LOGIN
						  echo "<button class='btn btn-full btn-filled apply-vacant-button' data-toggle='modal' data-target='#myModal'>Apply</button>";
						   //count applicant
						  if ($sum_applicant['jumlah'] > 0) {
							  echo "<div class='text-gray applicants ft-12'><small>".$sum_applicant['jumlah']." applicant</small></div>";
						  }
					  }
					  
					  $views 	  	   	   = $this->vacantsea_model->vacantsea_view($vacantsea_id);
	  				  $total_view		 = count($views);
					  ?>
                       <center><span class="applicants ft-12"><small><?= $total_view ?> <?=$this->lang->line("views")?> </small></span></center>
		  </div>
		  <div class="media-body">
          
			  <a href="<?=base_url("vacantsea/detail/".$vacantsea_id);?>" class="subtitle text-link" target="_blank">
              <h4 class="custom-h4"><?=$vacantsea;?></h4></a>
              
			  <div class="float-left media-heading medium">
				  <a href="<?=base_url("agentsea/$username/home")?>" class="text-link"><small><?=$perusahaan;?></small></a></div>
			  <div class="float:right">
				  <?php
					  $username           = $this->uri->segment(2);
					  if (!empty($username_company) AND $username_company==$username) {
  						 
						 $company_password = $company[0]["password"];
						 
						  /* echo "<a href='$url/edit_vacant/".$id_perusahaan."&".$username_company."&".$vacantsea_id."_key"."' target='_blank'>
							  <span style='cursor:pointer' class='glyphicon glyphicon-edit sub-header-right'></span></a>";*/
						 
						  echo "<a href='$url/edit_vacant/".$id_perusahaan."&".$username_company."&vacantsea&company&$company_password&".$vacantsea_id."_key"."' target='_blank'>
							  <span style='cursor:pointer' class='glyphicon glyphicon-edit sub-header-right'></span></a>";
						 
						  /* echo "<a href='$url/edit_vacant/".$id_perusahaan."&".$username_company."&vacantsea&company&
						  dfdsdsfds&".$vacantsea_id."_key"."' target='_blank'>*/
						  
					  }
				  ?>
			  </div>
  
			  <div style="clear: both"></div>
			  <div class="subtitle text-gray"><?=$this->lang->line("navigation_area")?> : <?=$navigation_area;?></div>
			  <div class="subtitle custom-h4">Rank : <?=$key['rank'];?></div>
			  <?php
				  echo "<div class='subtitle text-gray'>".$this->lang->line("salary").":</div>";
				  if (!empty($username_company) || !empty($username_sitizen)) {
					  if (!empty($annual_sallary)) {
						  
						echo "<h7 class='text-danger custom-h7'>".$sallary_curr." ".number_format($annual_sallary)." $sallary_range</h7>"; 
						 
					  }else{
						  
						  echo "Negotiable";
						  
					  }
				  }else{
					  
					  echo "<h7 class='text-danger custom-h7'>".$this->lang->line("please_login")."</h7>";
					  
				  }
			  ?>
			  <div class="subtitle text-gray">&nbsp;</div>
			  <div class="subtitle text-gray"><?=$this->lang->line("description")?>:</div> 
			  <div style="width:80%; float:left"><p><?=$description;?></p></div>
			  <div class="float-right subtitle" style="float:right"> 
				 <div class="text-muted"> <?=$this->lang->line("posted")?>: <?php echo date('F d, Y', strtotime($create_date));?></div> 
				  <?php
					  if ($end >= "1") {
						  if ($end > 1 && $end <=7) {
							  $expired    = $end;
							  echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." : <b>".$expired." ".
							  $this->lang->line("day")."</b> ".$this->lang->line("left")."</div>";
						  }elseif ($end > 7 && $end <= 31) {
							  $expired    = $end/7;
							  $expired    = round($expired,0);
							  echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." :  <b>".$expired." ".
							  $this->lang->line("week")."</b> ".$this->lang->line("left")."</div>";
						  }elseif ($end > 31 && $end <=365 ) {
							  $expired    = $end/31;
							  $expired    = round($expired,0);
							  echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." :  <b>".$expired." ".
							  $this->lang->line("month")."</b> ".$this->lang->line("left")."</div>";
						  }elseif ($end > 365 ) {
							  $expired    = $end/365;
							  $expired    = round($expired,0);
							  echo "<div class='text-muted' title='".$expired_date."'>".$this->lang->line("end")." :  <b>".$expired." ".
							  $this->lang->line("year")."</b> ".$this->lang->line("left")."</div>";
  
						  }
						  
					  }elseif($end == "0"){
						  echo "<div class='text-danger' title='".$expired_date."'>".$this->lang->line("end")." :  <b>".$this->lang->line("today")." </b> </div>";
					  }elseif ($now > $expired_date) {
						  echo "<div class='text-danger' title='".$expired_date."'><b>".$this->lang->line("expired")." </b> </div>";
					  }
				  ?>
			  </div>
		  </div>
	  </div>
  </div>
  <?php
  }
}
else
{
	echo "<p> -".$this->lang->line("no_vacantsea")." </p>";	
}
  ?>

<?php //$this->load->view('modal-login'); ?>
<script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

</script>