<?php  //navbar-profile, modules seaman, page account, username = $this->uri->segment(2);

		$username = $this->uri->segment(2);	


$dts = $this->session->all_userdata();
    if($this->uri->segment(3) == 'friends'){
        $fr_active = 'active';
    } else if($this->uri->segment(3) == 'resume'){
        $r_active = 'active';
    } else if($this->uri->segment(3) == 'appraisal'){
        $appr_active = 'active';
    }
?>
<div id="sticky-anchor"></div>
                
<div class="widget-box col-md-12" id="sticky">
    <ul class="nav nav-custom" role="tablist">
       <li role="presentation" class="<?=$tml_active?>">
            <a href="<?=base_url("profile/$username")?>">Timeline</a>
        </li>
       <!--  <li role="presentation">
            <a href="<?=base_url("profile/$username/photo")?>" class="<?=$pt_active?>" >Photos</a>
        </li> -->
        <li role="presentation" class="<?=$fr_active?>">
            <a href="<?=base_url("profile/$username/friends")?>"><?=$this->lang->line("friend")?></a>
        </li>
                	<?php
				//$username_company_sess = $this->session->userdata("id_perusahaan");
                //$username_user = $this->session->userdata("id_user"); 
				//if(!empty($username_company_sess) AND empty($id_user)){ 
                    //echo "<script>alert('oi');</script>";
			?>
            	<li id="resume-tab" role="presentation" class="<?=$r_active?>">
            		<a href="<?=base_url("profile/$username/resume")?>">Resume</a>
                </li>
                
                <li>
                	<a href="<?=base_url("profile/$username/recommendation")?>">Recommendation</a>
                </li>
                <?php if(isset($dts['id_perusahaan'])): ?>
                <li id="resume-tab" role="presentation" class="<?=$appr_active?>">
                    <a href="<?=base_url("profile/$username/appraisal")?>">Appraisal</a>
                </li>
            <?php endif; ?>
                
          <!--   <?php //}else{  ?> -->
            	<!-- <li role="presentation" class="<?=$ex_active?>">
            		<a href="<?=base_url("profile/$username/experience")?>">Experience</a>
                </li> -->
                
           <!--  <?php // } ?> -->
    </ul>
</div>