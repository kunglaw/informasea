<div class="tmp_modal">
		<?php // ini untuk ajax page looohh ?>                

</div>

<?php

  $profile 		= $resume['profile'];
  $pelaut	     = $resume['pelaut'];
  $competency 	 = $resume['competency'];
  $proficiency  	= $resume['proficiency'];
  $experience 	 = $resume['experience'];
  $document	   = $resume['document'];
  $medical        = $resume['medical'];
  $visa           = $resume['visa'];
  
  $xzx = $this->session->userdata('username');
  
  $id_user  = $this->session->userdata('id_user');
  $fullname = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];
  $rank 	 = $this->rank_model->get_rank_detail($profile['rank']);

  $this->load->model('users/user_model');

  $a = $this->user_model->get_detail_pelaut22($id_user);

  //print_r($profile);

	if($pelaut['gender'] == "" || empty($pelaut['kebangsaan'])){

      echo "<script>$(document).ready(function(){

     	get_modal('form-profile','#profile-btn')

	  }); </script>";

    }

	else if(empty($profile["rank"])){

       echo "<script>$(document).ready(function(){
      	get_modal('form-kepelautan','#kepelautan-btn') 
	  }); </script>";

    }

?>    

<div id="modal-container"></div>



<div class="container-resume block">

    <h4 class="header-text">     
    	
        <div class="pull-left">
          <small>
              <a href="<?php echo base_url("profile/$xzx/resume_print") ?>" target="_blank" title="print all data" class="btn btn-primary">
              <span class="fa fa-print fa-lg"></span> &nbsp; <b>Print</b> </a>
              <!-- <a href="<?php echo base_url('seaman/resume/doc_download')?>?id_seatizen=<?php echo $id_user;?>" target="_blank" title="Download doc">  -->
                  <!-- <span class="fa fa-file-text"> </span> 
              </a> -->
          </small> 
        </div>
        
        <div class="pull-right">
        	<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" 
                href="https://www.facebook.com/sharer/sharer.php?app_id=1655530184684604&sdk=joey&u=<?=base_url("s/$xzx")?>&display=popup&ref=plugin&src=share_button"
                title="Share your resume on facebook">
                
                <div class="btn btn-social btn-facebook ">
                  <span class="fa fa-facebook"></span>
                  Share <span class="count-box"></span>
                </div>
            
            </a>
            
            <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=<?=base_url("s/$xzx")?>" title="Share your resume on Google+">
				<div class="btn btn-social btn-google">
				  <span class="fa fa-google"></span>
				 
				  Share
            	</div>
            </a>
            
            <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://twitter.com/intent/tweet?status=<?=$fullname?> - <?=$rank["rank"]?> <?=base_url("s/$xzx")?>"
            title="Share your resume on Twitter">
				<div class="btn btn-social btn-twitter">
				  
					<span class="fa fa-twitter"></span>
					
					Tweet
				  
				</div>
			</a>
            
            <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=base_url("s/$xzx")?>&title=<?=$fullname?> - <?=$rank["rank"]?>&source=<?=base_url("s/$xzx")?>"
            title="Share your resume on Linkedin">
                <div class="btn btn-social btn-linkedin">
                  <span class="fa fa-linkedin"></span>
                 
                  Share
                </div>
            </a>
            
        </div>
		<span class="clearfix"></span>
    </h4>
    
    <h3><?=$this->lang->line("curriculum_vitae") ?></h3>
    
	<span class="clearfix"></span>
    
    <div class="subtitle pull-left text-gray">

      <?=$this->lang->line("infr_privacy_resume")?>

    </div>

    <br>

    <br>

    <div class="subtitle pull-left text-gray"><?=$this->lang->line("basic_info_text")?></div>

    <?php include "table_bio_resume.php";?>

    <?php include "table_kepelautan.php"; ?>

    <?php include "table_describe.php"; ?>

    <?php include "table_document_record.php"; ?>

    <?php include "table_competency.php"; // coc and endorsement ?>

    <?php include "table_proficiency.php"; ?>      

    <?php include "table_sea_record.php"; ?>

    <?php include "table_document_upload.php"; ?>



</div>



