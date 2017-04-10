<?php // footer, ALL MODULES, GENERAL ?>
<?php $this->load->view("footer2"); ?>
<?php /* <div id="footer" class="full footer-container footer-container-bg hidden-sm hidden-xs">
    <div class="container-fluid ">
        <!-- <div class="row"> -->
            <div class="pull-left">
                <ul>
                    <li><a href="<?=base_url("about")?>"> <?=$this->lang->line("about_us")?> </a></li>
                    <li><a href="<?=base_url('contact');?>"> <?=$this->lang->line("contact_us")?> </a> </li>
                    <?php if($this->session->userdata('id_user') != "" OR $this->session->userdata('id_perusahaan') != ""){


                    }else{ ?>
                    <li><a href="<?=base_url("login")?>"> Login </a></li>
                    <li><a href="<?=base_url();?>users/register/agentsea"> <?=$this->lang->line("register")?>  <?=$this->lang->line("agentsea")?></a> </li>
<!--                     <li><a href="#"> Register Vacantsea </a> </li>
 -->                    <?php } ?>
                    <!-- <li><a href="#">Informasea</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Brand</a></li>
                    <li><a href="#">Contact</a></li> -->
                    <li><a href="<?=base_url('infr-policy');?>"><?=$this->lang->line("privacy")?></a></li>
                    
<!--                     <li><a href="#">Terms & Condition</a></li>
 -->                <!--     <li><a href="#">Security</a></li> 
                 --></ul>
            </div>
            <div class="pull-right text-right">
                <p>Copyright 2015 Informasea TM All Rights Reserved.
                </p>
            </div>
        <!-- </div> -->
    </div>
</div> */ ?>
