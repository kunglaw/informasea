<?php //experience, halaman friend teman page friends, profile, module user ?>
<div class="tmp_modal">
<?php // ajax dimari  ?>
</div>

<div class="box">

  <div class="box-header">
      <h3 class="box-heading header-text"><?=$this->lang->line("friend")?></h3>
      
      <span class="clearfix"></span>
  </div>
  
  <div class="box-content">
    <div class="jajamama"></div>
    
      <?php
    
    $id_perusahaan = $this->session->userdata('id_perusahaan');
    $id_user=  $this->session->userdata('id_user');
    $data_user = $this->user_model->get_detail_pelaut_byid($id_user);
    $array_pribadi = $data_user['array_teman'];
    $array_pribadi = explode("|",$array_pribadi);
    $list_request = explode("|",$data_user['friend_request']); 
    $list_terima = explode("|",$data_user['receive_request']);
    if($id_user != ""){
      $id_perusahaan = '';
    } else{
      $id_perusahaan;
    }
    $friends = $detail_pelaut['array_teman'];
      if($friends == ''){
        echo $this->lang->line("y_nofriend");
      }else{
  
    $friends = explode("|",$detail_pelaut['array_teman']);        
     }
     $list_username_friends = "";
     $xx=0;
  if(!empty($friends) OR $friends != ''){ 

    foreach($friends as $row){ 
      $a = $this->user_model->get_detail_pelaut_byid($row);
	  
	  if(empty($a)) continue;
	   $list_username_friends .= ", '$a[username]'";
      $c = $this->resume_model->get_profile_resume($row);

      $s = $this->rank_model->get_rank_detail($c['rank']);
  
      $url_gambar = check_profile_seaman($a['username']);
      
      $info_tambahan = isset($s['rank']) ? $s['rank'] : "";
      if($a['rank'] == 0)
      {
        $info_tambahan = $a['city']." , ".$a['kebangsaan']; 
        
        if($a['kebangsaan'] == "" && $a['city'] == "")
        {
          
         $info_tambahan = $a['gender'];  
        }
        
        else if($a['city'] == "")
        {
          
          $info_tambahan = $a['kebangsaan'];  
        }
        
      }
    $namanya = $a['nama_depan']." ".$a['nama_belakang'];
          $batas = substr($namanya, 0, 10);
    ?>
        <div class="col-md-4 seatizen-item-container" >
            <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>">
                <div class="pull-left medium-img-container" href="#">
                    <img class="media-object img-responsive" src='<?php echo $url_gambar; ?>' alt="user-image">
                </div>
                <div class="media-body">
                    
                    
          <?php if(!empty($s['rank'])){ ?> 
                    <div class="subtitle text-link seatizen-role">
                      <i class="fa fa-certificate"></i>
            <?php echo $s['rank']?>
                    </div>
                    <?php } ?>
                    
                    <div class="">
                      <!-- <a href="<?php//base_url("profile/$a[username]/resume")?>" class="text-link">
              <?php //echo "".$a['nama_depan']." ".$a['nama_belakang'].""; ?>

                        </a> -->
                        <a href="<?=base_url("profile/$a[username]/resume")?>" title="<?php echo $namanya ?>" class="text-link">
                        <?php echo $batas."..."; ?> 
                      </a>
                    </div>
                    <div class="subtitle text-gray seatizen-years"><?php echo ucfirst($info_tambahan)  ?></div>
                    <input type="hidden" id="id_teman_<?php echo $a['pelaut_id']; ?>" value="<?php echo $a['pelaut_id']; ?>">
      
                    <?php 
                   if(empty($id_perusahaan) AND $id_user != '') { 

                     if(in_array($a['pelaut_id'],$array_pribadi)){
                            //echo "wei";
                             $visFriend = false;
                        $visDelFriend = true;
                        $visRequest = false;
                        $visConfirm = false; 

                      } else if(in_array($a['pelaut_id'],$list_request)){ 
                   

                    $visFriend = false;
                    $visDelFriend = false;
                    $visRequest = true;
                    $visConfirm = false;
                    
                      } else if(in_array($a['pelaut_id'],$list_terima)){
                          $visFriend = false;
                          $visDelFriend = false;
                          $visRequest=  false;
                          $visConfirm = true;
                     
                     } else if($a['pelaut_id'] == $id_user){
                            $visFriend = false;
                            $visDelFriend = false;
                            $visRequest = false;
                            $visConfirm =false;
                      //  echo "haia";
                       } else{
                              $visFriend = true;
                              $visDelFriend = false;
                              $visRequest = false;
                              $visConfirm = false;
                       }

                    ?>


             <div class="btn-group dropup">
                <button type="button" class="btn btn-2x btn-info btnconfirm_<?php echo $a['pelaut_id']; ?> pull-left btn-custom-font dropdown-toggle"
                id="btnconfirm_<?php echo $a['pelaut_id']; ?>" data-toggle="dropdown">
                   <?=$this->lang->line("confirm")?>
                </button>
                <ul class="dropdown-menu" role="menu" style="z-index:1000;">
                    <li style="z-index:1000;"><a href="#" onclick="terima_teman(<?php echo $a['pelaut_id']; ?>)">  <?=$this->lang->line("add_friend")?> </a> </li>
                  <li style="z-index:1000;"><a href="#" onclick="batal_terima(<?php echo $a['pelaut_id']; ?>)"> <?=$this->lang->line("cancel_request")?> </a> </li>
                </ul> 
            </div>
            
            <button class="btn btn-filled pull-left btnaddfriend_<?php echo $a['pelaut_id'];?> btn-custom-font" onclick="addFriend(<?php echo $a['pelaut_id']; ?>)" id="btnaddfriend_<?php echo $a['pelaut_id'];?>">
              <i class="fa fa-plus"></i>  <?=$this->lang->line("add_friend")?></button>
         
          <div class="btn-group dropup">
             <button class="btn btn-success btnwaiting_<?php echo $a['pelaut_id']; ?> pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btnwaiting_<?php echo $a['pelaut_id']; ?>">  <?=$this->lang->line("waiting")?> .. </button>
             <ul class="dropdown-menu" role="menu">
                <li><a onclick="batalrequest(<?php echo $a['pelaut_id']; ?>)"> <?=$this->lang->line("cancel_request")?> </a> </li> 
             </ul>
          </div>
         
         <div class="btn-group dropup">
                <button href="#" class="btn btn-2x btn-danger btndelfriend_<?php echo $a['pelaut_id']; ?> pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btndelfriend_<?php echo $a['pelaut_id']; ?>">   <?=$this->lang->line("friend")?> </button>
                  <ul class="dropdown-menu" role="menu">
                     <!-- <li><a href="#" data-toggle="modal" data-target="#modalDelete"> <i class="fa fa-minus"> </i> UnFriend </a> </li> -->
                     <li><a onclick="javascript:deletefriend(<?php echo $a['pelaut_id']; ?>)"> <i class="fa fa-minus"> </i> 
                      <?=$this->lang->line("unfriend")?>
                     </a> </li>
                  </ul>
       	 </div>


                   <!-- <button class="btn btn-filled pull-left btn-custom-font"><i class="fa fa-plus"></i> Add as Friend</button> -->
                  <?php }else if($this->session->userdata('id_perusahaan') != "" AND $this->session->userdata('id_user') != "") {  ?>
                   <a class="btn btn-filled pull-left btn-custom-font" href="<?php echo base_url("profile/".$a['username']."/resume") ?>"> 
                   	<?=$this->lang->line("view_resume")?>
                   </a>
          

                    <?php }else{ ?>
<!--                                     <button class="btn btn-filled pull-left btn-custom-font" onclick="login()"> <i class="fa fa-plus"> </i> Add as Friend </button>
 -->
              <button class="btn btn-filled pull-left btn-custom-font" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"> </i> 
			  	<?=$this->lang->line("add_friend")?> 
              </button>

                    <?php } ?>


                  <!--  <?php if($isRatingEnabled) { ?>
                        <div class="star-rating pull-right" style="display: inline-block">
                            <span class="fa fa-star" data-rating="1"></span>
                            <span class="fa fa-star" data-rating="2"></span>
                            <span class="fa fa-star" data-rating="3"></span>
                            <input type="hidden" name="whatever" class="rating-value" value="3">
                        </div>
                    <?php } ?> -->
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>
       <?php
       $id_a = $a['pelaut_id'];
       ?>
 <script>
tes('<?php echo $id_a; ?>','<?php echo $visFriend; ?>','<?php echo $visRequest; ?>','<?php echo $visDelFriend; ?>','<?php echo $visConfirm; ?>');
</script>
        <?php
    }
  } 
    ?>
        <span class="clearfix"></span>
  </div>
</div>

<?php //$this->load->view("include/suggested_friends"); ?>

<?php //include('suggested_friends_free.php'); ?>
<span class="clearfix"></span>
<br>
<div class="box">
  <div class="box-header">
    <h3 class="box-heading header-text">Suggested Friends</h3>
      
    <span class="clearfix"></span>
  </div>
    <div class="box-content" style="min-height:500px;">

      <?php 
      $org = $this->uri->segment(2); 
      if($this->session->userdata('username') != ""){ 
        $use = $this->session->userdata('username');

		$str = "SELECT * FROM pelaut_ms WHERE username not in ('$org', '$use' $list_username_friends) AND `show` = 'TRUE' LIMIT 6 ";
	 }else{
		$str = "SELECT * FROM pelaut_ms WHERE username not in ('$org' $list_username_friends) AND `show` = 'TRUE' LIMIT 6";
	 }
   // echo $str;

      $f = $this->db->query($str);
      $z = $f->result_array();

      foreach($z as $row) { 
              $a = $this->user_model->get_detail_pelaut_byid($row["pelaut_id"]);
              $c = $this->resume_model->get_profile_resume($row["pelaut_id"]);
              $s = $this->rank_model->get_rank_detail($c['rank']);
              $url_gambar = check_profile_seaman($a["username"]); 

              $info_tambahan = isset($s['rank']) ? $s['rank'] : "";
      if($a['rank'] == 0)
      {
        $info_tambahan = $a['city']." , ".$a['kebangsaan']; 
        
        if($a['kebangsaan'] == "" && $a['city'] == "")
        {
          
         $info_tambahan = $a['gender'];  
        }
        
        else if($a['city'] == "")
        {
          
          $info_tambahan = flag_nationality($a['kebangsaan']);  
        }
        
      }
      $namanya = $a['nama_depan']." ".$a['nama_belakang'];
          $batas = substr($namanya, 0, 10);
              ?>

      <div class="col-md-4 seatizen-item-container">
            <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="min-height:180px;">
                <div class="pull-left medium-img-container" href="#">
                    <img class="media-object img-thumbnail img-responsive" src='<?php echo $url_gambar; ?>' alt="user-image">
                </div>
                <div class="media-body">
                    
                    <div class="">
                      <!-- <a href="<?php//base_url("profile/$a[username]/resume")?>" class="text-link">
              <?php //echo "".$a['nama_depan']." ".$a['nama_belakang'].""; ?> 
                        </a> -->
                        <a href="<?=base_url("profile/$a[username]/resume")?>" title="<?php echo $namanya ?>" class="text-link">
                          <?php echo $batas."..."; ?> 
                        </a>
                    </div>
                    
                    <?php if(!empty($s['rank'])){ ?> 
                    <div class="subtitle text-link seatizen-role">
            <?php echo format_rank($c['rank']) ?>
                    </div>
                    <?php } ?>
                    
                    <div class="subtitle text-gray seatizen-years"><?php echo ucfirst($info_tambahan)  ?></div>
                          <input type="hidden" id="id_teman_<?php echo $row['pelaut_id']; ?>" value="<?php echo $row['pelaut_id']; ?>">

                    <?php
                    $id = $row['pelaut_id'];
                    $id_user = $this->session->userdata('id_user');
                    $array_teman = $data_user['array_teman'];
                    $array_teman  = explode("|",$array_teman);
                    $list_request = explode("|",$data_user['friend_request']);
                    $list_terima  = explode("|",$data_user['receive_request']);

                   if(empty($id_perusahaan) AND $this->session->userdata('id_user') != '') { 
            
             if($row['pelaut_id'] != $this->session->userdata('id_user')) {
    
            if(in_array($row['pelaut_id'],$array_teman)) {
              // echo "posisi1";
              $visFriend  = false;
              $visDelFriend = true;
              $visRequest   = false;
              $visConfirm   = false; 
              
            } else if(in_array($row['pelaut_id'],$list_request)){ 
              //echo "posisi2";
              $visFriend    = false;
              $visDelFriend = false;
              $visRequest   = true;
              $visConfirm   = false;
              
            } else if(in_array($row['pelaut_id'],$list_terima)){
              // echo "posisi3";
              $visFriend    = false;
              $visDelFriend = false;
              $visRequest   =  false;
              $visConfirm   = true;
            
              }
            
            else {
              // echo "posisi4";
              $visFriend = true;
              $visDelFriend = false;
              $visRequest = false;
              $visConfirm = false;
                } 
    
                //        echo "$id, $visFriend, $visRequest, $visDelFriend";
           
           ?>


          <div class="btn-group dropup">
            <button type="button" class="btn btn-2x btn-info btnconfirm_<?php echo $id; ?> pull-left btn-custom-font dropdown-toggle" id="btnconfirm_<?php echo $id; ?>" data-toggle="dropdown">
               <?=$this->lang->line("confirm")?>
            </button>             
            <ul class="dropdown-menu" role="menu" style="z-index:1000;">            
              <li style="z-index:1000;"><a onclick="terima_teman(<?php echo $id; ?>)"> <?=$this->lang->line("add_friend")?> </a> </li>
              <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> <?=$this->lang->line("delete_request")?> </a> </li>
            </ul> 
          </div>

          <button class="btn btn-filled btnaddfriend_<?php echo $row['pelaut_id'];?> pull-left btn-custom-font" onclick="addFriend(<?php echo $id; ?>)" id="btnaddfriend_<?php echo $row['pelaut_id'];?>"><i class="fa fa-plus"></i> 
            <?=$this->lang->line("add_friend")?></button>
                    
           <div class="btn-group dropup">
           <button class="btn btn-success btnwaiting_<?php echo $id; ?> pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" 
           id="btnwaiting_<?php echo $id; ?>"> <?=$this->lang->line("waiting")?> .. </button>
           <ul class="dropdown-menu" role="menu">
            <li><a onclick="batalrequest(<?php echo $id; ?>)"> <?=$this->lang->line("cancel_request")?> </a></li> 
           </ul>
         </div>
         <div class="btn-group dropup">
            <button href="#" class="btn btn-2x btndelfriend_<?php echo $row['pelaut_id']; ?> btn-danger pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btndelfriend_<?php echo $row['pelaut_id']; ?>">  <?=$this->lang->line("friend")?> </button>
              <ul class="dropdown-menu" role="menu">
               <!-- <li><a href="#" data-toggle="modal" data-target="#modalDelete"> <i class="fa fa-minus"> </i> UnFriend </a> </li> -->
               <li><a onclick="javascript:deletefriend(<?php echo $row['pelaut_id']; ?>)"> <i class="fa fa-minus"> </i> 
			   	<?=$this->lang->line("unfriend")?> </a> </li>
              </ul>
        </div>
    
          <?php  }//echo "tes('$id','$visFriend', '$visRequest','$visDelFriend');" ?>
          <?php } 
          else  if($id_user == "" AND empty($company))  { ?>
    
              <button class="btn btn-filled pull-left btn-custom-font" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"> </i> 
              	<?=$this->lang->line("add_friend")?>
               </button>
    
          <?php
          }
    
           else { ?>
          <a class="btn btn-filled pull-left btn-custom-font" href="<?php echo base_url("profile/".$row['username']."/resume") ?>"> 
          	<?=$this->lang->line("view_resume")?>
          </a>
          <?php  }  
          ?>
            
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div> 
<?php
       /*echo*/ $id_a = $a['pelaut_id'];
       // echo " -> $visFriend, $visRequest, $visDelFriend, $visConfirm";
       ?>
 <script>
tes('<?php echo $id_a; ?>','<?php echo $visFriend; ?>','<?php echo $visRequest; ?>','<?php echo $visDelFriend; ?>','<?php echo $visConfirm; ?>');
</script>
      <?php 
      }

      ?>

        <span class="clearfix"></span>


    </div>
        





  </div>