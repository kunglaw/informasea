<?php

	$username 			= $this->uri->segment(2);

	

?>

		<!-- <div class="col-md-9"> -->

			<?php
			
				//$data['btn_dashboard']	 = $btn_dashboard;

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

			    		<h4 class="text-gray"><?=$this->lang->line("vacantsea")?></h4>

			    	<!-- 	<p>ini adalah halaman vacantsea</p> -->

			    	</div>

			    	<?php 

			    	include('include/vacantsea2-list-item.php'); 

			    	// include('include/edit-vacant.php');

			    	?>

			    </div>

			    

			  </div>

			</div>



		<!-- </div> -->