<?php // seatizen panel , general, right panel ?>
<?php
$username = $this->session->userdata("username");
$this->load->model("seatizen/seatizen_model");
$this->load->model("profile_resume_model","prtr");
$this->load->model("photo/photo_mdl");
$this->load->model('nation_model');

$dtseatizen = $this->seatizen_model->list_seatizen_notfriend($username);

?>
<?php if(!empty($dtseatizen)){ ?>
<div class="widget-box">
	<div class="text-gray widget-box-title"><?=$this->lang->line("new_seatizen")?></div>
      <a href="<?php echo base_url("seatizen"); ?>" class="text-link widget-box-seemore">See All</a>
	<?php foreach($dtseatizen as $row){ ?>
      <?php
	  	$url_gambar = check_profile_seaman($row['username']);
		$profile = $this->prtr->get_profile_resume($row["pelaut_id"]);
		$rank = $this->rank_model->get_rank_detail_byid($profile["rank"]);
	  ?>
      
      <div style="clear: both"></div>
      <div class="media">
          <a class="pull-left small-img-container" href="<?php echo base_url("profile/$row[username]/resume");?>">
              <img class="media-object img-responsive img-thumbnail" src='<?=$url_gambar ?>' style="width:46px; height:46px" alt="user-image">
          </a>
          <span class="pull-right" >
              <a href="<?php echo base_url("profile/$row[username]/resume");?>" ><i class="fa fa-plus-square-o fa-2x text-link container-fa"></i></a>
          </span>
          <div class="media-body"> 
              <div class="text-grey">
              <?php $nation = $this->nation_model->get_detail_nationality($row['kebangsaan'])?>
                <a href="<?php echo base_url("profile/$row[username]/resume");?>" >  
               	 <?php echo ucfirst($row['nama_depan']." ".$row["nama_belakang"]); ?> 
                </a>
              </div>
              <?php if(!empty($nation)){ ?>
              <div class="subtitle">
              	<a href="<?=strtolower(base_url("seatizen/search/$row[kebangsaan]"));?>">
                	<?=flag($row['kebangsaan'])?>
                </a>
                <a href="<?=base_url("seatizen/search?rank=$rank[rank]")?>">
                	<?php echo " $rank[rank]"; ?>
                </a>
              </div>
              <?php } ?>
          </div>
      </div>
    <?php } ?>
</div>
<?php } ?>