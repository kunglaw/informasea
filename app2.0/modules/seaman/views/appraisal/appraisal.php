<?php error_reporting(E_ALL) ;
$this->load->model("rank_model");
?>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/AdminLTE.min.css') ?>"> -->

<style type="text/css">

  .direct-chat .box-body {

  border-bottom-right-radius: 0;

  border-bottom-left-radius: 0;

  position: relative;

  overflow-x: hidden;

  padding: 0;

}

.direct-chat.chat-pane-open .direct-chat-contacts {

  -webkit-transform: translate(0, 0);

  -ms-transform: translate(0, 0);

  -o-transform: translate(0, 0);

  transform: translate(0, 0);

}

.direct-chat-messages {

  -webkit-transform: translate(0, 0);

  -ms-transform: translate(0, 0);

  -o-transform: translate(0, 0);

  transform: translate(0, 0);

  padding: 10px;

  height: 250px;

  /*overflow: auto;*/

}

.direct-chat-msg,

.direct-chat-text {

  display: block;

}

.direct-chat-msg {

  margin-bottom: 10px;

}

.direct-chat-msg:before,

.direct-chat-msg:after {

  content: " ";

  display: table;

}

.direct-chat-msg:after {

  clear: both;

}

.direct-chat-messages,

.direct-chat-contacts {

  -webkit-transition: -webkit-transform 0.5s ease-in-out;

  -moz-transition: -moz-transform 0.5s ease-in-out;

  -o-transition: -o-transform 0.5s ease-in-out;

  transition: transform 0.5s ease-in-out;

}

.direct-chat-text {

  border-radius: 5px;

  position: relative;

  padding: 5px 10px;

  background: #d2d6de;

  border: 1px solid #d2d6de;

  margin: 5px 0 0 50px;

  color: #444444;

}

.direct-chat-text:after,

.direct-chat-text:before {

  position: absolute;

  right: 100%;

  top: 15px;

  border: solid transparent;

  border-right-color: #d2d6de;

  content: ' ';

  height: 0;

  width: 0;

  pointer-events: none;

}

.direct-chat-text:after {

  border-width: 5px;

  margin-top: -5px;

}

.direct-chat-text:before {

  border-width: 6px;

  margin-top: -6px;

}

.right .direct-chat-text {

  margin-right: 50px;

  margin-left: 0;

}

.right .direct-chat-text:after,

.right .direct-chat-text:before {

  right: auto;

  left: 100%;

  border-right-color: transparent;

  border-left-color: #d2d6de;

}

.direct-chat-img {

  border-radius: 50%;

  float: left;

  width: 40px;

  height: 40px;

}

.right .direct-chat-img {

  float: right;

}

.direct-chat-info {

  display: block;

  margin-bottom: 2px;

  font-size: 12px;

}

.direct-chat-name {

  font-weight: 600;

}

.direct-chat-timestamp {

  color: #999;

}

.direct-chat-contacts-open .direct-chat-contacts {

  -webkit-transform: translate(0, 0);

  -ms-transform: translate(0, 0);

  -o-transform: translate(0, 0);

  transform: translate(0, 0);

}

.direct-chat-contacts {

  -webkit-transform: translate(100%, 0);

  -ms-transform: translate(100%, 0);

  -o-transform: translate(100%, 0);

  transform: translate(100%, 0);

  position: absolute;

  top: 0;

  bottom: 0;

  height: 250px;

  width: 100%;

  background: #222d32;

  color: #fff;

  overflow: auto;

}

.contacts-list > li {

  border-bottom: 1px solid rgba(0, 0, 0, 0.2);

  padding: 10px;

  margin: 0;

}

.contacts-list > li:before,

.contacts-list > li:after {

  content: " ";

  display: table;

}

.contacts-list > li:after {

  clear: both;

}

.contacts-list > li:last-of-type {

  border-bottom: none;

}

.contacts-list-img {

  border-radius: 50%;

  width: 40px;

  float: left;

}

.contacts-list-info {

  margin-left: 45px;

  color: #fff;

}

.contacts-list-name,

.contacts-list-status {

  display: block;

}

.contacts-list-name {

  font-weight: 600;

}

.contacts-list-status {

  font-size: 12px;

}

.contacts-list-date {

  color: #aaa;

  font-weight: normal;

}

.contacts-list-msg {

  color: #999;

}

.direct-chat-danger .right > .direct-chat-text {

  background: #dd4b39;

  border-color: #dd4b39;

  color: #ffffff;

}

.direct-chat-danger .right > .direct-chat-text:after,

.direct-chat-danger .right > .direct-chat-text:before {

  border-left-color: #dd4b39;

}

.direct-chat-primary .right > .direct-chat-text {

  background: #3c8dbc;

  border-color: #3c8dbc;

  color: #ffffff;

}

.direct-chat-primary .right > .direct-chat-text:after,

.direct-chat-primary .right > .direct-chat-text:before {

  border-left-color: #3c8dbc;

}

.direct-chat-warning .right > .direct-chat-text {

  background: #f39c12;

  border-color: #f39c12;

  color: #ffffff;

}

.direct-chat-warning .right > .direct-chat-text:after,

.direct-chat-warning .right > .direct-chat-text:before {

  border-left-color: #f39c12;

}

.direct-chat-info .right > .direct-chat-text {

  background: #00c0ef;

  border-color: #00c0ef;

  color: #ffffff;

}

.direct-chat-info .right > .direct-chat-text:after,

.direct-chat-info .right > .direct-chat-text:before {

  border-left-color: #00c0ef;

}

.direct-chat-success .right > .direct-chat-text {

  background: #00a65a;

  border-color: #00a65a;

  color: #ffffff;

}

.direct-chat-success .right > .direct-chat-text:after,

.direct-chat-success .right > .direct-chat-text:before {

  border-left-color: #00a65a;

}

</style>

<div class="container-resume">

  <h4 class="header-text">     <small>

  </small> &nbsp; All Appraisal about <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang']; ?> aa &nbsp;&nbsp;&nbsp;

</h4>

      <!-- <div class="row"> -->

      <?php if(!empty($experiences)): ?>

      <div class="direct-chat-messages">

      <?php 

      $x=0;

      foreach ($experiences as $row) {

      # code...

        $dtCompany = $this->exp->get_company($row['id_perusahaan']);

        $dtExperience = $this->exp->detail_crew_experience($row['id_experience']);

        $dtRank = $this->rank->get_rank_detail($dtExperience['rank_id']);

        $dtShipType = $this->exp->vessel_type($dtExperience['ship_type_id']);

        $logo_company = $this->authentification_model->cek_logo_company($dtCompany['username']);

        ?>

          <!-- Message. Default to the left -->

      <?php if($x % 2 == 0){ ?>

          <div class="col-md-4">

            <div class="direct-chat-msg">

              <div class='direct-chat-info clearfix'>

                <span class='direct-chat-name pull-left'><?php echo $dtCompany['nama_perusahaan'] ?></span>

                <span class='direct-chat-timestamp pull-right'><?php echo date('F, d Y', strtotime($dtExperience['sign_on']))." - ".date('F, d Y', strtotime($dtExperience['sign_off'])) ?></span>

              </div><!-- /.direct-chat-info -->

              <img class="direct-chat-img" src="<?php echo $logo_company ?>" alt="message user image" /><!-- /.direct-chat-img -->

              <div class="direct-chat-text">

              	<p><?php echo "<h5><b>$dtRank[rank]</b> on <b>$dtShipType[ship_type]</b></h5>" ?></p>

                <p><?php echo trim($row['appraisal']) == "" ? "-" : "\"<i>$row[appraisal]</i>\"" ?></p>

                <p class="pull-right"><b><?php echo $dtCompany['contact_person'];  ?></b></p>

                <br>

                

              </div><!-- /.direct-chat-text -->

            </div><!-- /.direct-chat-msg -->

          </div>

          <?php 

        }else{

          ?>

          <div class="col-md-4">

            <div class="direct-chat-msg right">

              <div class='direct-chat-info clearfix'>

                <span class='direct-chat-name pull-right'><?php echo $dtCompany['nama_perusahaan'] ?></span>

                <span class='direct-chat-timestamp pull-left'><?php echo date('F, d Y', strtotime($dtExperience['sign_on']))." - ".date('F, d Y', strtotime($dtExperience['sign_off'])) ?></span>

              </div><!-- /.direct-chat-info -->

              <img class="direct-chat-img" src="<?php echo $logo_company ?>" alt="message user image" /><!-- /.direct-chat-img -->

              <div class="direct-chat-text">

                <p><?php echo "<h5><b>$dtRank[rank]</b> on <b>$dtShipType[ship_type]</b></h5>" ?></p>

                <p><?php echo trim($row['appraisal']) == "" ? "-" : "\"<i>$row[appraisal]</i>\"" ?></p>

                <p class="pull-right"><b><?php echo $dtCompany['contact_person'];  ?></b></p>

                <br>

              </div><!-- /.direct-chat-text -->

            </div><!-- /.direct-chat-msg -->

          </div>

      <?php

    } ?>



  



<?php

$x++;

} ?>

</div>

<?php else: ?>

<h3 align="center">There is no appraisal about <?php echo $pelaut['nama_depan']." ".$pelaut['nama_belakang']; ?></h3>

<br>

  <?php endif; ?>

<!-- </div> -->

<div class="clearfix"></div>

</div>





