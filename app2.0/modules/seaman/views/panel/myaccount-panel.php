<?php //my account panel ?>
<?php 
$username_url = $this->uri->segment(2); 
//$username_url = $this->session->userdata("username");

if($username_url == "")
{
	$username_url = $this->session->userdata("username");
}
//echo $username_url; 

$this->load->model('resume/resume_model');
$this->load->model('department_model');
$this->load->model('rank_model');
$this->load->model('vacantsea/vacantsea_model');
$this->load->model('profile_resume_model');
$reserve = $this->authentification->reserve($this->session->userdata('username')); 
//print_r($reserve);
$seatizen = $this->user_model->get_detail_pelaut($username);
$seatizen_resume = $this->resume_model->get_profile_resume($seatizen['pelaut_id']);
$rank = $this->rank_model->get_rank_detail($seatizen_resume['rank']);
$department = $this->department_model->get_detail_department($seatizen_resume['department']);
//echo $this->session->userdata('id_user');
$apply_vacantsea  = $this->vacantsea_model->list_applied($this->session->userdata('id_user'));
$jml_apply = $this->vacantsea_model->jml_applied($this->session->userdata('id_user'));
$check_resume = $this->profile_resume_model->cek_lengkap_resume($this->session->userdata('id_user'));
 //print_r($cek_resume);
    if($check_resume["result"] == TRUE){ 
        $status = "Complete";

    } else{
        $status = "UnComplete";
    }
?>
<div class="widget-box my-account">
    <div class="widget-box-header">
        <div class="text-gray widget-box-title">Profile </div>
        
        <?php if($reserve){  ?>
          <div class="text-link widget-box-seemore">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </div>
        <?php } ?>
        
        <div style="clear: both"></div>
    </div>
    <?php $date = $seatizen['tanggal_lahir'];
	
	if(!empty($date))
	{
		$date2 = date("d M Y",strtotime($seatizen['tanggal_lahir']));
	}
	else
	{
		$date2 = "-";	
	}
	
	?>
    <p><span class="text-link subtitle"><?=$this->lang->line("birth_date")?></span><br><?php echo $date2; ?>
    </p>

    <!-- <p><span class="text-link subtitle">Email</span><br>eldorado@marcopolo.com
    </p> -->
    <p><span class="text-link subtitle">Department</span><br><?=e_field($department['department']) ?>
    </p>

    <p><span class="text-link subtitle">Rank</span><br><?=e_field(format_rank($rank['rank'])) ?>
    </p>

    <p><span class="text-link subtitle"><?=$this->lang->line("nationality")?></span><br><?=e_field(flag_nationality($seatizen["kebangsaan"]))?>
    </p>

    
</div>


<?php if($this->session->userdata('username') == $username_url){ ?>
<div class="widget-box my-account">
    <div class="widget-box-header">
    	<div class="widget-box-header" style="margin-bottom:15px;">
         <div class="text-gray widget-box-title"> Resume </div>
        
         <?php if($status == "Complete") { ?> 
                <a class="text-link widget-box-seemore" href="<?php echo base_url("seaman/resume") ?>">Status :  <?php echo $status; ?> </a>
         <?php } else { ?>                
                <a class="text-danger widget-box-seemore" href="<?php echo base_url("seaman/resume") ?>"> Status : <?php echo $status; ?> </a>
         <?php } ?>
         
        </div>
		 <div class="clearfix"></div>
      
        <div classs="widget-box-header" style="margin-top:10px;">
            <div class="text-gray widget-box-title"> Applied Vacantsea (<?php echo $jml_apply; ?>) </div>
            <a href="<?php echo base_url("profile/".$username_url."/applied-vacantsea") ?>" class="text-link widget-box-seemore">See All</a>
            <div style="clear: both"></div>
            <p> </p>
            <ul>
            <?php 
        
                if(!empty($apply_vacantsea)){
                    foreach($apply_vacantsea as $ap){ 
                        $vacantsea = $this->vacantsea_model->get_vacantsea_id($ap['id_vacantsea']);
                        ?>
        
        
                    <li style="list-style:none;"><a href="<?php echo base_url("vacantsea/detail/".$vacantsea['vacantsea_id']) ?>"> 
        
                        <?php echo $vacantsea['vacantsea'] ?> </a> </li>
        
        
                    <?php
                 }
        
                } else{
                    echo "No Applied Vacantsea";
                }
                ?>
            </ul>
        </div>    
	

  
	</div>
</div>
<?php } ?>

    