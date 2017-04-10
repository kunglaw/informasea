<?php
$this->load->library('check_resume');
//
//$username = $this->session->userdata("username");
//$this->load->model('vacantsea/vacantsea_model');
//$pelaut_id = $this->session->userdata("id_user");
//
//$jml_applied = $this->vacantsea_model->jml_applied($pelaut_id);
//
//
//?>
<!---->
<!--<div class="list-group" style="margin:15px 0 0 0">-->
<!--    <a class="list-group-item active">-->
<!--        <b> <span class="glyphicon glyphicon-briefcase"></span> &nbsp My Job </b>-->
<!--    </a>-->
<!--    <a href="--><?php //echo base_url("seaman/resume"); ?><!--" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>&nbsp Resume</a>-->
<!--    <a href="--><?php //echo base_url("vacantsea/applied_job"); ?><!--" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Applied Job <span class="badge bg-primary">-->
<!--  --><?php //echo $jml_applied; ?><!--</span> </a>-->
<!--    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Interview Invitation</a>-->
<!--    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Resume Requests</a>-->
<!--    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Interview Schedule</a>-->
<!--</div>-->

<?php
$username_url = $this->uri->segment(2);
$this->load->model('seatizen/seatizen_model');
$check_username = $this->seatizen_model->check_seatizen($username_url);
$photo_url = "profile/photo/$username";



if(empty($check_username))
{
    $username = $this->session->userdata("username");
    $photo_url = "photo";
}
?>

<?php
	// menguji kelengkapan resume dan waktu pengupdatannya 
	
	
	// check resume dari library check_resume
	$check_data = $this->check_resume->check_data();
	$check_time = $this->check_resume->check_time();
	
	//print_r($check_time);
	
	$file_resume 		= $check_data['file_resume'];
	$profile_resume 	 = $check_data['profile_resume'];
	$competency 		 = $check_data['competency'];
	$document 		   = $check_data['document'];
	$experience 		 = $check_data['experience'];
	$proficiency 		= $check_data['proficiency'];
	
	$warning = ""; //TRUE
	if(!empty($file_resume) && !empty($profile_resume) && !empty($competency) && !empty($document) && 
	!empty($experience) && !empty($proficiency))
	{
		$fr 				 = $check_time['file_resume'];
		$pr			 	 = $check_time['profile_resume'];
		$c		          = $check_time['competency'];
		$d	    		  = $check_time['document'];
		$e		          = $check_time['experience'];
		$p				  = $check_time['proficiency'];
		
		if($fr['number'] >= 1 && $fr['unit'] == "year")
		{
			$warning = "<i class='label label-danger label-as-badge ' title='fr'>
          	<i class='fa fa-warning fa-lg'></i> </i>";
		}
		else if($pr['number'] >= 1 && $pr['unit'] == "year")
		{
			$warning = "<i class='label label-danger label-as-badge ' title='pr'>
          	<i class='fa fa-warning fa-lg'></i> </i>";
		}
		else if($c['number'] >= 1 && $c['unit'] == "year")
		{
			$warning = "<i class='label label-danger label-as-badge ' title='c'>
          	<i class='fa fa-warning fa-lg'></i> </i>";
		}
		else if($d['number'] >= 1 && $d['unit'] == "year")
		{
			$warning = "<i class='label label-danger label-as-badge ' title='d'>
          	<i class='fa fa-warning fa-lg'></i> </i>";
		}
		else if($e['number'] >= 1 && $e['unit'] == "year")
		{
			$warning = "<i class='label label-danger label-as-badge ' title='e'>
          	<i class='fa fa-warning fa-lg'></i> </i>";
		}
		else if($p['number'] >= 1 && $p['unit'] == "year")
		{
			$warning = "<i class='label label-danger label-as-badge ' title='p'>
          	<i class='fa fa-warning fa-lg'></i> </i>";
		}
	}
	else
	{
		$warning = "<i class='label label-danger label-as-badge ' title='Resume Data didnt Complete'>
          <i class='fa fa-warning fa-lg'></i> </i>";
	}

?>


<div class="list-group" style="margin:15px 0 0 0">
    <a class="list-group-item active">
        <b> <span class="glyphicon glyphicon-user"></span> &nbsp My Profile </b>
    </a>
    <a href="<?php echo base_url("profile/$username/account");?>" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Account 
    </a>
    <a href="<?php echo base_url("seaman/resume"); ?>" class="list-group-item">
      <span class="glyphicon glyphicon-list-alt"></span>
      &nbsp <span>Resume</span>
      
       <?php echo $warning ?>
       
    </a>
<!--    <a href="--><?php //echo base_url($photo_url)?><!--" class="list-group-item"><span class="glyphicon glyphicon-picture"></span> &nbsp; Photo Album</a>-->
<!--    <a href="--><?php //echo base_url("profile/$username/friends");?><!--" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp; Friends</a>-->
<span class="clearfix"></span>
</div>

<style>
	
	.label-as-badge {
		border-radius: 1em;
		
		float:right;
		
	}
	

</style>