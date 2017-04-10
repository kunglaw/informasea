<?php  //navbar-profile, modules profile 
$username = $this->session->userdata("username");

$this->load->model('resume_model');
$applied = $this->resume_model->jumlah_apply($this->session->userdata('id_user'));

?>
<div id="sticky-anchor"></div>
<?php 
    if($this->uri->segment(3) == 'account'){
        $acc_active = 'active';
    } else if($this->uri->segment(3) == 'friends'){
        $fr_active = 'active';
    } else if($this->uri->segment(2) == 'resume'){
        $rs_active = 'active';
    } elseif($this->uri->segment(3) == 'applied-vacantsea'){
        $app_active = 'active';
    }
?>
<div class="widget-box col-md-12" id="sticky">
    <ul class="nav nav-custom" role="tablist">
        <li role="presentation" class="<?=$tml_active?>">
            <a href="<?=base_url("profile")?>">Timeline</a></li>
        <li role="presentation" class="<?php echo $acc_active; ?>">
            <a href="<?=base_url("profile/$username/account")?>">
				<?=$this->lang->line("account")?>

            </a>
        </li>
       <!--  <li role="presentation">
            <a href="<?=base_url("profile/$username/photo")?>" class="<?=$pt_active?>" >Photos</a>
        </li> -->
        <li role="presentation" class="<?=$fr_active?>">
            <a href="<?=base_url("profile/$username/friends")?>" class="<?=$fr_active?>" ><?=$this->lang->line("friend")?></a>
        </li>

        <li role="presentation" class="<?=$rs_active;?>">

            <a href="<?=base_url('seaman/resume');?>" class="<?=$rs_active;?>"> Resume </a>

        </li>
        <li >
           <a href="<?=base_url("profile/$username/recommendation")?>"> Recommendation</a>
        </li>

                <!-- 

        <li class="dropdown-prof <?php echo $rs_active; ?>">
        
            <a class="dropdown-toggle" data-toggle="dropdown" role="link"
                aria-expanded="false" onclick="javascript:location.href = '<?php //echo base_url("seaman/resume"); ?>'" 
                href="<?php // echo base_url("seaman/resume"); ?>" >
            Resume <i class="caret"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php //echo base_url("seaman/resume/resume_upload"); ?>">Resume Upload</a></li>
              
            </ul> 
        
        </li>-->
         


        <!-- <li id="resume-tab" role="presentation" class='<?php// echo $rs_active; ?>'>
            <a href="<?=base_url("seaman/resume")?>" class="<?=$r_active?>">Resume</a>
            <ul class="dropdown-menu">
                <li><a href="#"> Resume Upload </a></li>
            </ul>
        </li> -->
        <!-- <li>
        	<a href="<?=base_url("profile/$username/experience")?>" class="<?=$r_active?>">Experience</a>
        </li> -->
        <?php if($applied != 0){ ?> 
         <li class="<?=$app_active?>">
            <a href="<?=base_url("profile/$username/applied-vacantsea")?>"> <?=$this->lang->line("applied_vacantsea")?> </a>
        </li> 
        <?php }?>
    </ul>
</div>


        <style>
</style>
<script>
$('.dropdown-prof').hover(function() {
     $(this).toggleClass('open');
});

</script>