<?php // content, photo, controller profile, modules seaman  ?>

<div id="main-profile" class="col-md-9">
	<?php $dt_header['username'] = $username; ?>
    <?php $this->load->view($header,$dt_header); ?>
    
    <div role="tabpanel">
        <!-- Nav tabs -->
        <?php $this->load->view($navbar_profile,$dt_navbar)?>
        <!-- Tab panes -->
        
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="friends">
                <span class="clearfix"></span>
				<?php $reserve = $this->authentification->reserve();  
                
                    if($reserve == true)
                    {
                        $this->load->view('list-photo/photo');	
                    }
                    else
                    {
                        $this->load->view('list-photo/photo-person');	
                    }
                
                ?>
                                       
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
</div>