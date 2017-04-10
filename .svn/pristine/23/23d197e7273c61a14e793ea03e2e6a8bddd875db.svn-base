
<?php // template login 

?>
<section class="content container-fluid">
    <div class="row">
        <?php $this->load->view("left-content/left-seatizen")?>

        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2> Forgot Password </h2>
            </div>          
             
              <?php
				echo $ve;
				if($this->session->flashdata('error') != "")
				{
					echo $this->session->flashdata('error');
				}
			 ?> 
            <form class="transparent register-form" role="form" action="<?=base_url("users/users_process/forgotpass")?>" method="post" >
              
                <div class="form-group">
                
                	<label>Send password to Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="your email" >
                </div>
               
                <a href="<?php echo base_url("users/login")?>" class="pull-left text-link">Login </a>
                
                <div class="pull-right">
                    <button class="btn btn-filled">Send</button>
                </div>
                <span class="pull-right">&nbsp; Or &nbsp;</span>
                 <a href="<?=base_url("users/register")?>" class="pull-right text-link">Register to Informasea</a>
                 
                <div class="clearfix"></div>
               
            </form>
        </div>
    </div>
</section>

