<?php // template login 

?>
<section class="content container-fluid">
    <div class="row">

        <?php $this->load->view("left-content/left-agentsea") ?>

        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2> Forgot Password 
                  <button class="btn btn-transparent" onClick="javascript:location.href = '<?=base_url("users/forgotpass")?>' ">
                      SEAMAN</button>
                  <button class="btn btn-filled" onClick="javascript:location.href = '<?=base_url("users/forgotpass/agentsea")?>' ">
                  AGENTSEA</button>
                </h2>
            </div>          
             
             <?php
				echo $ve;
				if($this->session->flashdata('error') != "")
				{
					echo $this->session->flashdata('error');
				}
				
				if($this->session->flashdata('success') != "")
				{
					echo $this->session->flashdata('success');
				}
			 ?> 
             
            <form class="transparent register-form" role="form" action="<?=base_url("users/company_process/forgotpass")?>" method="post" >
              
                <div class="form-group">
                
                	<label>Send password to Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="your email" >
                </div>
                
                <div class="form-group">
                	<div class="g-recaptcha" data-sitekey="6LcFQgkTAAAAACqUmwpvnuFlJc9f8eqjkdRP7Tq2"></div>
                </div>
                
                <a href="<?php echo base_url("users/login/agentsea")?>" class="pull-left text-link">Login </a>
                
                <div class="pull-right">
                    <button class="btn btn-filled">Send</button>
                </div>
                <span class="pull-right">&nbsp; Or &nbsp;</span>
                 <a href="<?=base_url("users/register/agentsea")?>" class="pull-right text-link">Register to Informasea</a>
                 
                <div class="clearfix"></div>
               
            </form>
        </div>
    </div>
</section>

