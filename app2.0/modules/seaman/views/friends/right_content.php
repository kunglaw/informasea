<?php // friends, right content ?>

<div id="right-widget" class="col-md-3">
	
    <?php 
		
		$this->load->view("adsense/sidebar_adsense"); 
	
	?>
    <?php if($is_preview && ($position == "top_right")){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }
            elseif ($is_preview) {
                generate_preview_ads('top_right', 'vertical');
             } 
             /*
            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database
            else{
                generate_ads_container($list_iklan['top_right'], 'vertical');
            }
            */
    ?>
    <span class="clearfix"></span>
	<?php $this->load->view('include/sponsor-box.php'); ?>

    <?php $this->load->view("include/new-seatizen-box.php"); ?>

    <?php $this->load->view("include/new-ship-box.php"); ?>

    <?php $this->load->view("include/new-company-box.php"); ?>

    <?php $this->load->view("include/new-vacantsea-box.php"); ?>
    <?php if($is_preview && ($position == "bottom_right")){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }
            elseif ($is_preview) {
                generate_preview_ads('bottom_right', 'vertical');
             } 
             /*
            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database
            else{
                generate_ads_container($list_iklan['bottom_right'], 'vertical');
            }
            */
    ?>
</div>