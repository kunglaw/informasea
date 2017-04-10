<?php
	$username 			= $this->uri->segment(2);
	//cek profil pic company
	if ($cek_profile->num_rows() > 0) {
		foreach ($cek_profile->result() as $row) {
		$nama_gambar 	= $row->nama_gambar;
		$profil_pic     = img_url("company/photo/$username/profil_pic/$nama_gambar");
		}
	}else{
		$profil_pic  	= img_url("company/default/img_default.png");
	}
	//cek cover company
	if ($cek_cover->num_rows() > 0) {
		foreach ($cek_cover->result() as $row) {
		$nama_gambar 	= $row->nama_gambar;
		$cover    		= img_url("company/photo/$username/cover/$nama_gambar");
		}
	}else{
		$cover 			= img_url("company/default/cover_default.jpg");
	}
?>
		<!-- <div class="col-md-9"> -->
			<?php
				// $data['cover'] 			 = $cover;
				// $data['profile_pic']	 = $profil_pic;
				// $data['company_name']	 = $company[0]['nama_perusahaan'];
				// $data['company_location']= $company[0]['location'];
				// $data['btn_dashboard']	 = $btn_dashboard;
			?>
			<?php //$this->load->view("header",$data); ?>
			<!-- <div role="tabpanel">
			  <!-- Nav tabs --
			  <div id="sticky-anchor"></div>
			  <div class="widget-box" id="sticky">
			  
			  	<?php //$this->load->view("menu"); ?>
              
			  </div> -->
			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active box" id="home">
			    	<div class="about">
			    		<h4 class="text-gray">Ships</h4>
			    		<!-- <p>ini adalah halaman ships</p> -->
			    	</div>
			
			    	<?php include('include/ships-list-item.php'); ?>
			    </div>
			  
			  </div>
			</div>

		<!-- </div> -->