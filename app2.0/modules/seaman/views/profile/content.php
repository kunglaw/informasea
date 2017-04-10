<?php // content, timeline, controller profile, modules seaman  ?>

<div id="main-profile" class="col-md-9">

	<?php $dt_header['username'] = $username; $reserve = $this->authentification->reserve(); ?>

    <?php //$this->load->view("header",$dt_header); ?>

    <?php $this->load->view($header,$dt_header); ?>

    

    <div role="tabpanel">

        <!-- Nav tabs -->

        <?php $dt_navbar['tml_active'] = "active"; ?>

        <?php //$this->load->view('navbar-profile',$dt_navbar)?>

        <?php 

                    //$navbar_profile = !empty($navbar_profile) ? $navbar_profile : "navbar-profile";

                    $navbar_profile = "navbar-profile";

                    if($reserve == false)

                    {

                        

                        $navbar_profile = "navbar-profile-free";

                    }

                ?>

                <?php $this->load->view($navbar_profile,$dt_navbar)?>

        <!-- Tab panes -->

        <?php if($is_preview && ($position == "top_left")){

                echo "<div class=\"col-md-12\">

                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>

             </div>";

            }

            elseif ($is_preview) {

                generate_preview_ads('top_left');

             } 

             /*

            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database

            else{

                generate_ads_container($list_iklan['top_left']);

            }

            */

    ?>

        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="timeline">

                <div class="row">

                    <div class="col-md-4 hidden-xs">

                        <?php $this->load->view('panel/myaccount-panel')?>


                        <?php $this->load->view('panel/photo-panel') ?>
                        

                        <?php $this->load->view("include/list-friends.php")?>

                    </div>

                    <div class="col-md-8">

                        

                        <?php



                          if($this->session->userdata("user") == "pelaut" && $is_friend)

                          {

                              $this->load->view('timeline/write-post-block.php');

                          }

                        

                        ?>

                        <?php $this->load->view('timeline/template-profile'); ?>

                    </div>

                </div>

            </div>

            <!-- 

            <div role="tabpanel" class="tab-pane" id="account">...</div>

            <div role="tabpanel" class="tab-pane" id="photos">

                <?php //$this->load->view("include/gallery.php"); ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="friends">...</div>

            <div role="tabpanel" class="tab-pane" id="resume">

                <?php //$this->load->view("include/resume.php"); ?>

            </div>

            -->

        </div><!-- tab-content -->

        

    </div>

    <?php if($is_preview && ($position == "bottom_left")){

                echo "<div class=\"col-md-12\">

                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>

             </div>";

            }

            elseif ($is_preview) {

                generate_preview_ads('bottom_left');

             } 

             /*

            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database

            else{

                generate_ads_container($list_iklan['bottom_left']);

            }

            */

    ?>

</div>