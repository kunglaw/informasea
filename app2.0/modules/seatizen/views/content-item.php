<div class="tmpa_modal">
        <?php // ini untuk ajax page looohh ?>                
</div>

<?php
/**
 * Created by PhpStorm.
 * User: Mohamad
 * Date: 5/7/2015
 * Time: 10:09 AM
 */
$this->load->view('js_top'); 
$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$this->load->model('profile_resume_model');
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
?>
 
<?php if(!empty($seatizen)) {
  $p=0;
	foreach($seatizen as $row):
    if($seatizen[$p++] == null) break;
       $id = $row['pelaut_id'];
		$resume = $this->profile_resume_model->get_profile_resume($id);
		$annual_sallary = @$row['annual_sallary'] > 0 ? "<b>".$this->lang->line("annual_salary").": </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
		$rank = $this->rank_model->get_rank_detail($resume['rank']);
		$nationality = $this->nation_model->get_detail_nationality($row['kebangsaan']);
		$flag_name = strtolower($nationality['flag']);
		$flag = asset_url("flags/$flag_name");
		$img = $this->user_model->get_profile_pic($row['pelaut_id']);
		$nama = $row['nama_depan']." - ".$row['nama_belakang'];
		$a = explode(".",$img);
		$b = @$a[0]."_thumb.".@$a[1];
		
		$path_img = check_profile_seaman($row["username"]);

?>

   <div class="col-md-<?php echo $col; ?> seatizen-item-container">
   	
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="min-height:176px">
    	
        <div class="pull-left medium-img-container" href="#" style="text-align:center">
        	
          <a href="<?=base_url("profile/".$row['username']."/resume") ?>"> 
          <img class="media-object img-thumbnail" src='<?=$path_img ?>' alt="user-image">
          </a>
            
        </div>
        <div class="media-body">
        	<?php 
			$crl = $this->profile_resume_model->cek_lengkap_resume($id);
			if($crl["result"] == TRUE){//if($row['community'] == "CAAIP"){  ?>
        	<div class="ribbon"> <span title="resume complete"> 
            <!-- <img src="http://findicons.com/files/icons/2118/nuvola/128/services.png" 
           width="11" height="11"> -->
            complete </span></div>
            <?php } else echo "" ?>
            
            <div class="seatizen-name">
               <a href="<?=base_url("profile/".$row['username']."/resume") ?>" class="text-Link"> 
			   <?php echo $row['nama_depan']."&nbsp;".$row['nama_belakang']; ?> </a>
            </div>
            <?php if(!empty($rank['rank'])){ ?> 
            <div class="subtitle text-link seatizen-role">
               <?=format_rank($resume['rank']) ?>
            </div>
            <?php } ?>
		  	<?php if($flag_name != ""){ ?>
    		<div class="subtitle text-gray seatizen-role"> 
               <a href="<?=base_url("seatizen/search/?nationality=$nationality[name]")?>"> 
               <?= flag_nationality($nationality['id']); ?>
               </a>
            </div>
            <?php } ?>
			<div style="clear:both;"> </div>
<br />
			<input type="hidden" id="id_teman_<?php echo $row['pelaut_id']; ?>" value="<?php echo $row['pelaut_id']; ?>">
			<?php


             if(!empty($id_user) AND empty($company)){
                if($row['pelaut_id'] != $this->session->userdata('id_user')) {
					
				if(in_array($row['pelaut_id'],$array_teman)) {
                    $visFriend = false;
                    $visDelFriend = true;
                    $visRequest = false;
                    $visConfirm = false; 
				} else if(in_array($row['pelaut_id'],$list_request)){ 
                    $visFriend = false;
                    $visDelFriend = false;
                    $visRequest = true;
                    $visConfirm = false;
                    
                } else if(in_array($row['pelaut_id'],$list_terima)){
                    $visFriend = false;
                    $visDelFriend = false;
                    $visRequest=  false;
                    $visConfirm = true;
             }
                else { 
                    $visFriend = true;
                    $visDelFriend = false;
                    $visRequest = false;
                    $visConfirm = false;
		   } 

               // echo "$id, $visFriend, $visRequest, $visDelFriend";
             ?>
            <div class="btn-group dropup">
                <button type="button" class="btn btn-2x btn-info pull-left btn-custom-font dropdown-toggle"
                id="btnconfirm_<?php echo $id; ?>" data-toggle="dropdown">
                   <?=$this->lang->line("confirm")?>
                </button>
                <ul class="dropdown-menu" role="menu" style="z-index:1000;">
                    <li style="z-index:1000;"><a onclick="terima_teman(<?php echo $id; ?>)"> <?=$this->lang->line("add_friend")?> </a> </li>
  <!--          <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> Cancel Request </a> </li> -->  
                  <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> Delete request </a> </li>
                
                </ul> 
            </div>
            
            <button class="btn btn-filled pull-left btn-custom-font" onclick="addFriend(<?php echo $id; ?>)" id="btnaddfriend_<?php echo $row['pelaut_id'];?>">
            	<i class="fa fa-plus"></i> <?=$this->lang->line("add_friend")?>
             </button>
		     	<div class="btn-group dropup">
             <button class="btn btn-success pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btnwaiting_<?php echo $id; ?>"> Waiting .. </button>
             <ul class="dropdown-menu" role="menu">
                <li><a onclick="batalrequest(<?php echo $id; ?>)"> <?=$this->lang->line("cancel_request")?> </a></li> 
             </ul>
         </div>
         <div class="btn-group dropup pull-left">
                <button href="#" class="btn btn-2x btn-danger pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" 
                id="btndelfriend_<?php echo $row['pelaut_id']; ?>">  <?=$this->lang->line("friend")?> </button>
                
                <ul class="dropdown-menu" role="menu">
                   <!-- <li><a href="#" data-toggle="modal" data-target="#modalDelete"> <i class="fa fa-minus"> </i> UnFriend </a> </li> -->
                   <li><a onclick="javascript:deletefriend(<?php echo $row['pelaut_id']; ?>)"> <i class="fa fa-minus"> </i> 
                   <?=$this->lang->line("unfriend")?> </a> </li>
                </ul>
         </div>

          <?php  }//echo "tes('$id','$visFriend', '$visRequest','$visDelFriend');" ?>
		  <?php } else  if($id_user == "" AND empty($company))  { ?>

              <button class="btn btn-filled pull-left btn-custom-font" onclick="login()"> <i class="fa fa-plus"> </i> <?=$this->lang->line("add_friend")?> </button>

          <?php
          }

           else { ?>
          <a class="btn btn-filled pull-left btn-custom-font" href="<?php echo base_url("profile/".$row['username']."/resume") ?>"> View Resume </a>
          <?php  }	
          ?>
            
            <div class="pull-left" style="margin-left:10px;">
            	<span title="total view" style="color:#999; font-size: 9pt;">
            	&nbsp;<i class="glyphicon glyphicon-eye-open"></i>
                <?php $aa = $this->uhm->get_view_seaman($row['username']);
					echo count($aa);
			    ?>
                </span>
            </div>
            
            <div class="pull-left" style="margin-left:10px;">
            
            	<span title="Experience in Rank <?=$rank['rank']?>" style="color:#999;font-size: 9pt">
              <?php 

              	$selisihnya = count_experience($row["pelaut_id"]);
              	
              // $selisihnya = date_difference($getDate["first_date"],$getDate["last_date"]); 
              if($selisihnya != ""){

              ?>
                &nbsp;<i class="glyphicon glyphicon-list-alt"></i>
                
            	<?php
					
					echo $selisihnya;
        }
            	?>
              
                </span>
                
            </div>
            
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>



    <?php //$this->load->view('modal-login'); ?>
   <?php //$this->load->view('modal_delete'); ?>
<script>
tes('<?php echo $id; ?>','<?php echo $visFriend; ?>','<?php echo $visRequest; ?>','<?php echo $visDelFriend; ?>','<?php echo $visConfirm; ?>',".seatizen-item-container");
</script>
<?php
endforeach;
} else { 
?>
<div class="list-group-item">
    <div class="media">
        <h2 class="text-gray">Not Found</h2>
    </div>
</div>



<?php
}
?>

