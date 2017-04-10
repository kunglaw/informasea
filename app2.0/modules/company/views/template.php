

<?php // template company ?>

    <div class="container-fluid">

        <div class="row">

        	<?php

        	if ($detail == "detail_company") {
                 
    
                echo "<div class='col-md-9'>";
                
                $data['btn_dashboard']   = $btn_dashboard;
                if($content == "content_ships") {
                    $data['cover']           = $cover;
                    $data['profile_pic']     = $profil_pic;
                    $data['company_name']    = $company[0]['nama_perusahaan'];
                    $data['company_location']= $company[0]['location'];
                }
                $this->load->view("header",$data); 
                echo "<div role=\"tabpanel\">
                      <!-- Nav tabs -->
                      <div id=\"sticky-anchor\"></div>
                      <div class=\"widget-box\" id=\"sticky\">";
                      
                      $this->load->view("menu");
              
                echo "</div>";
                if($is_preview && ($position == "top_left")){
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

                echo "<span class='clearfix'></span>";

        		$this->load->view($content);

                if($is_preview && ($position == "bottom_left")){
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
                echo "</div>";
        	}elseif($search == "search") {

                $this->load->view("search");

                // $this->load->view("right_content");

            }else{

        		$this->load->view("content");

            	//$this->load->view("right_content");

        	}

$this->load->view("right_content");

        	?>

        </div>

    </div>

<?php // end template ?>