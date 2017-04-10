<?php 

$username = $this->session->userdata("username"); 
$this->load->model('vacantsea/vacantsea_model');
$pelaut_id = $this->session->userdata("id_user");
	
$jml_applied = $this->vacantsea_model->jml_applied($pelaut_id);


?>

<div class="list-group" style="margin:15px 0 0 0">
  <a class="list-group-item active">
    <b> <span class="glyphicon glyphicon-briefcase"></span> &nbsp My Job </b>
  </a>
  <a href="<?php echo base_url("seaman/resume"); ?>" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>&nbsp Resume</a>
  <a href="<?php echo base_url("vacantsea/applied_job"); ?>" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Applied Job <span class="badge bg-primary">
  <?php echo $jml_applied; ?></span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Interview Invitation</a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Resume Requests</a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-asterisk"></span> &nbsp;Interview Schedule</a>
</div>