<?php // content, experience, controller profile, modules seaman  ?>

<div id="main-profile" class="col-md-9">
	<?php $dt_header['username'] = $username; ?>
    <?php $this->load->view($header,$dt_header); ?>
    <div role="tabpanel">

        <!-- Nav tabs -->

        <?php $navbar_profile = !empty($navbar_profile) ? $navbar_profile : "navbar-profile" ?>
        <?php $this->load->view($navbar_profile,$dt_navbar)?>
        <!-- Tab panes -->

        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="experience">

                <span class="clearfix"></span>

				<?php $reserve = $this->authentification->reserve();
                    
					/*if($reserve == true)
                    {
                        $this->load->view('resume_print/resume_print');	
                    }
                    else
                    {
                        $this->load->view('resume_print/resume_print_free');	
                    }*/
					
					$this->load->view('resume_print/resume_print');	
                ?>
            </div>
        </div><!-- tab-content -->

    </div>

</div>