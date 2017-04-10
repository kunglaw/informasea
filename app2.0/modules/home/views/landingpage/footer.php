<?php // footer, ALL MODULES, GENERAL ?>
<style>
	/* #footer
	{
		height:50px !important; 
	}
	
	#footer .container-fluid, #footer .row{
		height:50px !important; 
	} */
</style>

<div id="footer" class="full footer-container footer-container-bg">
    <div class="container-fluid ">
        <div class="row" style="">
           
            <div class="pull-left text-right">
                <p>Copyright 2015 Informasea TM All Rights Reserved.
                </p>
            </div>
            
            <div class="pull-right">
                <ul>
                    <li><a href="<?=base_url("about")?>"> About </a></li>
                    <li><a href="<?=base_url('contact');?>"> Contact Us </a> </li>
                    <?php if($this->session->userdata('id_user') != "" OR $this->session->userdata('id_perusahaan') != ""){


                    }else{ ?>
                    <li><a href="<?=base_url("login")?>"> Login </a></li>
                    <li><a href="<?=base_url();?>users/register/agentsea"> Register Agentsea </a> </li>
<!--                     <li><a href="#"> Register Vacantsea </a> </li>
 -->                    <?php } ?>
                    <!-- <li><a href="#">Informasea</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Brand</a></li>
                    <li><a href="#">Contact</a></li> -->
                    <li><a href="<?=base_url('infr-policy');?>">Privacy</a></li>
                    
<!--                     <li><a href="#">Terms & Condition</a></li>
 -->                <!--     <li><a href="#">Security</a></li> 
                 -->
                </ul>
            </div>
            
        </div>
    </div>
</div>