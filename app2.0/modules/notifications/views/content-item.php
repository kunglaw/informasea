<div class="tmp_modal">
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

$array_teman = $pribadi['array_teman'];
$array_teman = explode("|",$array_teman);
$list_request = explode("|",$pribadi['friend_request']);
$list_terima = explode("|",$pribadi['receive_request']);
?>
 
<?php if(!empty($seatizen)) {
	foreach($seatizen as $row):
        $id = $row['pelaut_id'];
    $resume = $this->profile_resume_model->get_profile_resume($id);
    $annual_sallary = @$row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
    $rank = $this->rank_model->get_rank_detail($resume['rank']);
    $nationality = $this->nation_model->get_detail_nationality($row['kebangsaan']);
    $flag_name = strtolower($nationality['flag']);
    $flag = asset_url("flags/$flag_name");
   $img = $this->user_model->get_profile_pic($row['pelaut_id']);
   $nama = $row['nama_depan']." - ".$row['nama_belakang'];
   $a = explode(".",$img);
   $b = @$a[0]."_thumb.".@$a[1];
	if($img){ 
    $path_img = img_url("photo/".$row['username']."/profile_pic/".$b);
	} else {
		$path_img = asset_url("img/user.jpg");
	}




    ?>

   <div class="col-md-<?php echo $col; ?> seatizen-item-container">
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="min-height:210px;">
        <div class="pull-left medium-img-container" href="#">
            <a href="<?=base_url("profile/".$row['username']."/resume") ?>"> 
            <img class="media-object img-responsive" src='<?=$path_img ?>' alt="user-image">
        </a>
        </div>
        <div class="media-body"> 
         
            <?php if(!empty($rank['rank'])){ ?> 
            <div class="subtitle text-link seatizen-role">  <i class="fa fa-certificate"></i> 
 <a href="<?=base_url("seatizen/search?rank=".$rank['rank']) ?>">
  <?php echo $rank['rank']; ?> </a> </div>
            <?php } ?>
            <div class="seatizen-name"><a href="<?=base_url("profile/".$row['username']."/resume") ?>" class="text-Link"> <?php echo $row['nama_depan']."&nbsp;".$row['nama_belakang']; ?> </a></div>
			<div class="subtitle text-gray seatizen-role"> <span style="float:left;margin-right:10px;"> <img class="img-responsive" src='<?=$flag; ?>' alt=" ">
            </span><span style="float:left"><a href="<?=base_url("seatizen/search/?nationality=".$row['kebangsaan'])?>"> <?=$row['kebangsaan'] ?></span> </a>
            </div>
			<div style="clear:both;"> </div>
      <br>
			<input type="hidden" id="id_teman_<?php echo $row['pelaut_id']; ?>" value="<?php echo $row['pelaut_id']; ?>">
			<?php if(!empty($id_user) AND empty($company)){
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
                   Confirm
                </button>
                <ul class="dropdown-menu" role="menu" style="z-index:1000;">
                    <li style="z-index:1000;"><a onclick="terima_teman(<?php echo $id; ?>)"> Add as Friends </a> </li>
  <!--          <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> Cancel Request </a> </li> -->  
                  <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> Delete request </a> </li>
                
                </ul> 
            </div>
            <button class="btn btn-filled pull-left btn-custom-font" onclick="addFriend(<?php echo $id; ?>)" id="btnaddfriend_<?php echo $row['pelaut_id'];?>"><i class="fa fa-plus"></i> Add as Friend</button>
		     <div class="btn-group dropup">
             <button class="btn btn-success pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btnwaiting_<?php echo $id; ?>"> Waiting .. </button>
             <ul class="dropdown-menu" role="menu">
                <li><a onclick="batalrequest(<?php echo $id; ?>)"> Cancel Request </li> </a>
             </ul>
         </div>
         <div class="btn-group dropup">
                <button href="#" class="btn btn-2x btn-danger pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btndelfriend_<?php echo $row['pelaut_id']; ?>">  Friend </button>
                  <ul class="dropdown-menu" role="menu">
                     <!-- <li><a href="#" data-toggle="modal" data-target="#modalDelete"> <i class="fa fa-minus"> </i> UnFriend </a> </li> -->
                     <li><a onclick="javascript:deletefriend(<?php echo $row['pelaut_id']; ?>)"> <i class="fa fa-minus"> </i> UnFriend </a> </li>
                  </ul>
        </div>

          <?php  //echo "tes('$id','$visFriend', '$visRequest','$visDelFriend');" ?>
        	<?php } else  if($id_user == "" AND empty($company))  { ?>

                <button class="btn btn-filled pull-left btn-custom-font" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"> </i> Add as Friend </button>

            <?php
            } else { ?>
            <a class="btn btn-filled pull-left btn-custom-font" href="<?php echo base_url("profile/".$row['username']."/resume") ?>"> View Resume </a>
          <?php  }	
            ?>
            <?php //if($isRatingEnabled) { ?>
                <!-- <div class="star-rating pull-right" style="display: inline-block">
                    <span class="fa fa-star" data-rating="1"></span>
                    <span class="fa fa-star" data-rating="2"></span>
                    <span class="fa fa-star" data-rating="3"></span>
                    <input type="hidden" name="whatever" class="rating-value" value="3">
                </div> -->
            <?php //} ?>
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>



    <?php $this->load->view('modal-login'); ?>
   <!-- <?php $this->load->view('modal_delete'); ?> -->
<script>
tes('<?php echo $id; ?>','<?php echo $visFriend; ?>','<?php echo $visRequest; ?>','<?php echo $visDelFriend; ?>','<?php echo $visConfirm; ?>');
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

