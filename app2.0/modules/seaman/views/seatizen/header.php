<?php // header seatizen, profile. module seaman

/*

	buat person yang tidak aktif, alias, dia tidak login 

*/



 ?>

<?php

	//$this->load->model('users/user_model');

	// nilai $username dari controller

//$this->load->view('seatizen/js_top');

	$username = $this->uri->segment(2);//username yang ada di url 

  if($username == "") $username = $this->session->userdata("username");



  $id_user = $this->session->userdata('id_user');

  $id_perusahaan = $this->session->userdata('id_perusahaan');

if($id_user != ""){

  $id_perusahaan = '';



} else if ($id_user == "" AND $id_perusahaan != ""){

  $id_perusahaan;

} else{

  $id_perusahaan = "";

  $id_user = "";

}



  if(!empty($id_user)){

    $detail_user = $this->user_model->get_detail_pelaut_byid($id_user);

    $array_teman = $detail_user['array_teman'];

    $array_teman = explode("|",$array_teman);

    $list_request = $detail_user['friend_request'];

    $list_request = explode("|",$list_request);

    $list_terima = $detail_user['receive_request'];

    $list_terima = explode("|",$list_terima);

  }

	$this->load->model('resume_model');

	$this->load->model('rank_model');

	

	$reserve = $this->authentification->reserve();

	$cover = $this->photo_mdl->get_photo_cover($username);

	$seatizen = $this->resume_model->get_detail_pelaut($username);





      $id_seatizen = $seatizen['pelaut_id'];



	$seatizen_resume = $this->resume_model->get_profile_resume($seatizen['pelaut_id']);

	$rank = $this->rank_model->get_rank_detail($seatizen_resume['rank']);

	$friends = $seatizen['array_teman'];

  if($friends == ''){

    $friends = 0;

  } else{



  $friends = explode("|",$seatizen['array_teman']);

  $friends = count($friends);



    }



	$ss = explode(".",$cover['nama_gambar']);

	

	$url_cover = img_url("photo/$username/cover/$ss[0]"."_thumb.".$ss[1]);

	

	if(empty($cover))

	{

		//http://localhost/informasea/assets/img/img_ship.png

		$url_cover = asset_url("img/img_ship.png");

	}

	

?>



<?php



if(!empty($seatizen))

{

	

 

  $url = check_profile_seaman($username);

  

  $nama = $seatizen['nama_depan']." ".$seatizen['nama_belakang'];

}



//print_r($this->session->all_userdata());



?>



<div id="profile-header" style="background-image:url(<?php echo $url_cover ?>); background-repeat:no-repeat; background-size:cover">



    

    <div class="media" style="z-index:10">

    

        <a class="pull-left" href="#">

            <img class="media-object" src="<?php echo $url; ?>" alt="Image">

        </a>

        

        <div class="media-body text-white">

        

            <div class="pull-left">

              

                <h3 class="media-heading "><?php echo $nama ?></h3>

                <br>

                <p> <?=$rank['rank']?> <br>

                  <?php if($seatizen['kebangsaan'] == ''){ ?>

                  <b><?=$seatizen['gender']; ?> </b>

                  <?php } else{ ?>



                    <b><?=$seatizen['kebangsaan']?>, <?=$seatizen['gender']?></b>

                  <?php } ?>

                </p>

            </div>

            <div class="box text-center text-white pull-right hidden-xs"><h4><?=$this->lang->line("friend")?></h4>

                <h2><?php echo $friends; ?></h2>

            </div>

            <div class="pull-right" style="margin-top:60px;margin-right:30px;">



              <input type="hidden" value="<?php echo $id_seatizen; ?>" id="id_teman_<?php echo $id_seatizen; ?>">

              <?php 

              if(empty($id_perusahaan) OR $id_user != ""){

              if($id_user != ""){

                if($id_seatizen == $id_user){



                } else {



                 if(in_array($id_seatizen,$array_teman)){

                  $visFriend = false;

                  $visDelFriend = true;

                  $visRequest = false;

                  $visConfirm = false;

                 }else if(in_array($id_seatizen,$list_request)){

                  $visFriend = false;

                  $visDelFriend = false;

                  $visRequest = true;

                  $visConfirm = false;

                 }  else if(in_array($id_seatizen,$list_terima)){

                    $visFriend = false;

                    $visDelFriend = false;

                    $visRequest = false;

                    $visConfirm = true; 

                 }  else{

                  $visFriend = true;

                  $visDelFriend = false;

                  $visRequest =false;

                  $visConfirm = false;

                  }



                }

                  ?>

                <!--  <button class="btn btn-2x btn-info pull-left btn-custom-fon" id="btnconfirm_<?php //echo $id_seatizen; ?>"> Confirm </button> -->

             <div class="btn-group dropup">

              <button type="button" class="btn btn-2x btnconfirm_<?php echo $id_seatizen; ?> btn-info pull-left

               btn-custom-font dropdown-toggle" id="btnconfirm_<?php echo $id_seatizen; ?>" data-toggle="dropdown"> 

               Confirm </button>

                <ul class="dropdown-menu" role="menu">

                  <li><a href="#" onclick="terima_teman(<?php echo $id_seatizen; ?>)"> Add as Friend </a> </li>

                  <li><a href="#" onclick="batal_terima(<?php echo $id_seatizen; ?>)"> Delete request </a> </li>

                </ul>

                </div>



               <button class="btn btn-2x btn-default btnaddfriend_<?php echo $id_seatizen; ?> pull-left btn-custom-font" onclick="addFriend(<?php echo $id_seatizen; ?>)" id="btnaddfriend_<?php echo $id_seatizen; ?>"><i class="fa fa-plus"></i> <?=$this->lang->line("add_friend")?></button>

              <div class="btn-group dropup">

<button class="btn btn-2x btn-default pull-left btn-custom-font btnwaiting_<?php echo $id_seatizen; ?> dropdown-toggle" data-toggle="dropdown" id="btnwaiting_<?php echo $id_seatizen; ?>"> <?=$this->lang->line("waiting")?> .. </button>

                <ul class="dropdown-menu" role="menu">

                  <li><a href="#" onclick="batalrequest(<?php echo $id_seatizen; ?>)"> <?=$this->lang->line("cancel_request")?> </a> </li>

                </ul>

              </div>

              <div class="btn-group dropup">    

                <button href="#" class="btn btn-2x btndelfriend_<?php echo $id_seatizen; ?> btn-danger pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btndelfriend_<?php echo $id_seatizen; ?>">  <?=$this->lang->line("friend")?> </button>

                  <ul class="dropdown-menu te" role="menu">

                      <li><a href="#" data-toggle="modal" data-target="#modalDelete"> <i class="fa fa-minus"> </i> <?=$this->lang->line("unfriend")?> </a> </li>

                  </ul>

              </div>



         <?php  

              } else { ?>

              <button class="btn btn-filled pull-left btn-custom-font" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"> </i> 
			  <?=$this->lang->line("add_friend")?> </button>

              <?php }

            } else{



            }

              ?>

            </div>

            

            <div class="clearfix"></div>

            

        </div>

        

    </div>

  <?php 

  //$this->load->view('seatizen/modal-login');

 $data['id_seatizen'] = $id_seatizen;

 $data['nama'] = $nama;

 $this->load->view('seatizen/modal_delete',$data);

  ?>

<script>

tes('<?php echo $id_seatizen; ?>','<?php echo $visFriend; ?>','<?php echo $visRequest; ?>','<?php echo $visDelFriend; ?>','<?php echo $visConfirm; ?>');

</script>

    <div style="height:50px; width:100%; background-color:#999; opacity:0.4; margin-top:106px;">

    

    </div>

    <div class="profile-text-container">

    </div>

</div>