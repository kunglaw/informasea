<?php
$username_comp= $this->session->userdata('username_company');
$fullname     = $this->session->userdata('contact_person');
$name_company = $this->session->userdata('nama_perusahaan');
$email        = $this->session->userdata('email_perusahaan');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?=$title;?> | Admin Informasea</title>

  <?php
  $this->load->view('css');
  ?>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  
</head>
<body>
  <nav class="blue" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="http://informasea.com" target="_blank" class="brand-logo"><img src="<?php echo asset_url('img/logo.png');?>"></a>
      <ul class="right hide-on-med-and-down">
        <li><i class="material-icons">person</i></li>
        <li><a href="<?=base_url($username_comp.'/home');?>" style="color:white"><?=$name_company;?></a></li>
      </ul>


      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center blue-text text-darken-2">&nbsp;</h1>
        <div class="row center">
          <h5 class="header col s12 light">DO MORE WITH INFORMASEA ACCOUNT PRO</h5>
        </div>
        <!-- <div class="row center">
          <a href="#" id="download-button" class="btn-large waves-effect waves-light btn blue darken-2">Get Started</a>
        </div> -->
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="<?php echo asset_url('img/img_bg_landing.png');?>" alt="Unsplashed background img 1"></div>
  </div>


  <div class="container">
    <?php 
    // $this->load->view('include/product');
    include "include/product.php";
    ?>
  </div>

<?php /*

  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">ACCOUNT PRO INFORMASEA FOR BUSINESS</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="<?php echo asset_url('img/img_bg_about.png');?>" alt="Unsplashed background img 2"></div>
  </div> */ ?>

  <div class="container">
  <?php 
  //$this->load->view("include/info_customer"); 
  include "include/info_customer.php";
  ?>
  </div>


 <!--  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="<?php echo asset_url('img/background3.jpg');?>" alt="Unsplashed background img 3"></div>
  </div> -->

  <footer class="page-footer blue darken-2">
    <?php 
    // $this->load->view("include/footer");
    include "include/footer.php";
    ?>
  </footer>


  <!--  Scripts-->
  <?php $this->load->view("js_under"); ?>

  </body>
</html>