<?php
/**
 * Created by PhpStorm.
 * User: Mohamad
 * Date: 5/7/2015
 * Time: 10:09 AM
 */
$this->load->view('js_top'); 

$this->load->model("rank_model");
$this->load->model('profile_resume_model');
$this->load->model('nation_model');

$this->load->helper('text_helper');
$this->load->helper('date_format_helper');


$id_user = $this->session->userdata("id_user");
$company  = $this->session->userdata("id_perusahaan");

if($id_user != ""){
    $company = "";
    //echo $id_user;
} else if($id_user  == "" && $company != ""){
    $company;
   // echo $company;
} else{
  $id_user = "";
  $company = "";
}
// echo $company;
// exit;

$array_teman  = $pribadi['array_teman'];
$array_teman  = explode("|",$array_teman);
$list_request = explode("|",$pribadi['friend_request']);
$list_terima  = explode("|",$pribadi['receive_request']);


  $seatizen 	   = $this->profile_resume_model->get_profile_pelaut($id);
  //$resume 	    = $this->profile_resume_model->get_profile_resume($id);
  
  $annual_sallary = @$seatizen['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$seatizen['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
  $username	   = $seatizen['username'];
  
  $rank 		   = $this->rank_model->get_rank_detail($seatizen['rank']);
  $rank_url	   = strtolower(str_replace(" ","-",$rank['rank']));
  
  $nationality    = $this->nation_model->get_detail_nationality($seatizen['kebangsaan']);
  $nat_url		= strtolower(str_replace(" ","-",$nationality['name']));
  $flag_name 	  = strtolower($nationality['flag']);
  $flag 	       = asset_url("flags/$flag_name");
  
  $img 			= $this->user_model->get_profile_pic($seatizen['pelaut_id']);
  $nama 		   = $seatizen['nama_depan']." ".$seatizen['nama_belakang'];
  $a 			  = explode(".",$img);
  $b 			  = @$a[0]."_thumb.".@$a[1];
  
  $exist_img 	  = pathup("photo/".$seatizen['username']."/profile_pic/".$b); 
  if($img && file_exists($exist_img)){ 
  
  	  $path_img = img_url("photo/".$seatizen['username']."/profile_pic/".$b);
	  
  } else {
	  
	  $path_img = asset_url("img/ic_landing_seaman_blue.svg");
	  
  }

?>

<div class="list-group-item">
        <div class="media">
            <div class="media-left text-center">
                <a href="<?= base_url("profile/$username")?>">
                
                <img src="<?=$path_img?>" alt="" id="img-profile-company" class="thumbnail block " style="border:1px solid #CCC" height="89" width="102" />
               
                </a>
                <div class="text-gray applicants ft-12"></div>
            </div>
            <div class="media-body">
                <div class="pull-left media-heading medium">
                    <a href="<?= base_url("profile/".$username."/resume")?>" class="text-link"><h4><?=$nama;?></h4></a>
                </div>
               
                <span class="clearfix"></span>
                
                <div class="subtitle text-gray custom-h4"  >
                	<a href="<?=base_url("seatizen/search/?rank=$rank_url")?>">
                		<img src="<?=asset_url("img/star-small.png")?>" width="16" height="16" />
                    	<?=$rank['rank']?>
                    </a>
                </div>
               
                <p class="subtitle text-gray custom-h4">
                    
				  <?php if(!empty($nationality)){ ?>
                  <a href="<?=base_url("seatizen/search/?nationality=".$nat_url);?>">
                      <img src="<?=$flag?>">
                      <?=$nationality['name']; ?>
                  </a>    
                  <?php } else {echo "  ";} ?>
                        
                </p>
                
                
                <p style="width:87%" align="justify"> </p>
            </div>
        </div>
    </div>