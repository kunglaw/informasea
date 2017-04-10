<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 02/07/2015
 * Time: 12:17
 */
  $this->load->view("google_app/google-login-modal");
?>
<style>
    .modal-backdrop
    {
        z-index:-1 !important;
    }

</style>

<!-- Modal -->
<div class="modal bs-example-modal-md fade" id="myModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" id="login-close-modal-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Please Login First </h4>
            </div>
            <div class="modal-body">
                <div id="hasil-proses">
                    <!--Ajax-->
                </div>
                <form class="register-form form-bootstrap" role="form" id="frm-login-first">
                <input type="hidden" name="halaman_tujuan" id="halaman-tujuan">
                <input type="hidden" name="id_vacantsea" id="id-vacantsea">
                	<div class="form-group">
                    	
                        <button type="button" class="btn btn-facebook form-control" onclick="get_modal_login()" title="Login with Facebook" style="margin-bottom:8px"> 
                            <i class="fa fa-facebook"></i>
                            Login with Facebook
                        </button>
                        
                        <button type="button" class="btn btn-google form-control" 
                        id="btn-google-login-modal" title="Login with Google+"> 
                            <i class="fa fa-google-plus"></i>
                             Login with Google+
                        </button>
                    	
                    </div> 
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username_lg" name="username_lg" >
                        <input type="hidden" value="0" id="login_attemp" />
                        <input type="hidden" value="<?php echo $destination ?>" name="dest" id="destination" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_lg" name="password_lg" >
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" id="remember_me" class="" /> &nbsp; Remember Me
                    </div>
                    <a href="<?php echo base_url("users/forgotpass")?>" class="pull-left text-link">Forgot Password ? </a>
					
                    
                    <div class="pull-right" style="margin-left:10px">
                        <button type="button" id="login-first-btn" class="form-control normal blue">Log in</button>
                        <!-- <button type="button" id="login-first-btn1" class="form-control normal blue">Test</button> -->
                    </div>
                    
                   
                    
                    <span class="pull-right">&nbsp; Or &nbsp;</span>
                    	<a href="<?=base_url("users/register")?>" class="pull-right text-link">Register to Informasea</a>

                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="clearfix"> </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
	$("#myModal").modal("show");
    $("#login-first-btn1").click(function (e) {
        var halaman_tujuan = $("#destination").val();
        // var id_vacantsea = $("#id-vacantsea").val()
        alert(halaman_tujuan);
    });
    $("#login-first-btn").click(function (e) {
        var login_temp = $("#login_attemp").val();
        var url = "<?php echo base_url("users/users_process/login_first_process")?>";
        var dest = $("#destination").val();
        var data = $("#frm-login-first").serialize();
        $.ajax({
            url:url,
            type:"POST",
            data:data,
            success:function(hasil){
                hasilnya = hasil.split('||');
                $("#hasil-proses").html(hasilnya[1]); //berisi data div (hasilnya[1])
                if(hasilnya[0] == "success") //berisi status proses (hasilnya[0])
                {
                    var dest = hasilnya[2];
					// alert (dest);
                     setTimeout(function () {
                        window.location = dest;
                    }, 2000);  //delay selama 2 detik
                }
            }
        });
        e.preventDefault();
//        path = path.replace('#','');
//        alert(path);
    });
</script>