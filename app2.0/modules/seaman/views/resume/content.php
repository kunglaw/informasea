<?php // content, resume, controller resume, modules seaman  ?>

<div id="main-profile" class="col-md-12">
	<?php $dt_header['username'] = $username; ?>
    
    <?php $this->load->view("header",$dt_header); ?>
    
    <div role="tabpanel">
        <!-- Nav tabs -->
        <?php $navbar_profile = !empty($navbar_profile) ? $navbar_profile : "navbar-profile"?>
        <?php $this->load->view($navbar_profile,$dt_navbar); ?>
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
    <span class="clearfix"></span>
        <div class="tab-content">
             
            <div role="tabpanel" class="tab-pane active" id="resume">
                <?php $this->load->view("resume/resume"); ?>
            </div>
           
        </div>
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
                generate_ads_container($list_iklan['top_left']);
            }
            */
    ?>
</div>