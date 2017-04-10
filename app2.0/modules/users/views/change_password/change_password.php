<?php // template login 

?>
<style>



#passwordStrength
{
    height:20px;
    display:block;
    float:left;
    color:#FFF;
}

.strength0
{
    width:250px;
    background:#cccccc;
}

.strength1
{
    width:50px;
    background:#ff0000;
}

.strength2
{
    width:100px;    
    background:#ff5f5f;
}

.strength3
{
    width:150px;
    background:#56e500;
}

.strength4
{
    background:#4dcd00;
    width:200px;
}

.strength5
{
    background:#399800;
    width:250px;
}


</style>

<script>
function passwordStrength(password,form_group)
{
    //alert(form_group);
    $(form_group+" .passwordStrength").removeClass("hidden");
    //alert(form_group+" .passwordStrength");
    
    var desc = new Array();
    desc[0] = "Very Weak";
    desc[1] = "Weak";
    desc[2] = "Better";
    desc[3] = "Medium";
    desc[4] = "Strong";
    desc[5] = "Strongest";

    var score   = 0;

    //if password bigger than 6 give 1 point
    if (password.length > 6) score++;

    //if password has both lower and uppercase characters give 1 point  
    if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;

    //if password has at least one number give 1 point
    if (password.match(/\d+/)) score++;

    //if password has at least one special caracther give 1 point
    if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;

    //if password bigger than 12 give another 1 point
    if (password.length > 12) score++;

     $(form_group+" .passwordStrength #passwordDescription").html(desc[score]) ;
     $(form_group+" .passwordStrength").className = "strength" + score;
     
     //alert(form_group+" .passwordStrength #passwordDescription");
}
</script>


<section class="content container-fluid">
    <div class="row">

        <?php $this->load->view("left-content/left-seatizen")?>

        <div class="col-md-6 text-white m-t-1">
            <div class="block">
                <h2> Change Password 
                
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
             
            <form class="transparent register-form" role="form" action="<?=base_url("users/users_process/change_password")?>" method="post" >
              		
                    <input type="hidden" value="<?=$email?>" name="email_fr" />
                    <input type="hidden" value="<?=$username?>" name="username_fr" />
                    <input type="hidden" value="<?=$no_token?>" name="no_token" id="no_token" />
                                        
                    <div class="form-group" id="np">
        
                        <label> New Password </label>
                        <input type="password" name="new_password" id="new_password" class="form-control inputPassword" onKeyUp="passwordStrength(this.value,'#np')"> 
                       <div id="" class="passwordStrength  strength0 hidden"><span id="passwordDescription"></span></div>
                        <span class="clearfix"></span>
                    
                    </div>
                    
                    <div class="form-group" id="rnp">
                        <label>Retype New Password </label>
                        <input type="password" name="retype_new_password" id="retype_new_password" class="form-control inputPassword" onKeyUp="passwordStrength(this.value,'#rnp')">
                        <div id="" class="passwordStrength  strength0 hidden"><span id="passwordDescription"></span></div>
                        <span class="clearfix"></span>
                     </div>
                
                <div class="pull-right">
                    <button class="btn btn-filled">Change Password</button>
                </div>
                 
                <div class="clearfix"></div>
               
            </form>
        </div>
    </div>
</section>

