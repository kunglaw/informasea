<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 02/07/2015
 * Time: 12:17
 */
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Please Login First</h4>
            </div>
            <div class="modal-body">

                <div id="hasil-proses">
                    <!--Ajax-->
                </div>

                <form class="register-form" role="form" id="frm-login-first">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username_lg" name="username_lg" >
                        <input type="hidden" value="0" id="login_attemp" />
                        <input type="hidden" value="<?php echo base_url("seatizen"); ?>" id="destination" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_lg" name="password_lg" >
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" id="remember_me" class="" /> &nbsp; Remember Me
                    </div>
                    <a href="<?php echo base_url("users/forgotpass")?>" class="pull-left text-link">Forgot Password ? </a>

                    <div class="pull-right">
                        <a id="login-first-btn" class="btn btn-filled">Log in</a>
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
    $("#login-first-btn").click(function (e) {
        var login_temp = $("#login_attemp").val();
        var url = "<?php echo base_url("users/users_process/login_first_process")?>";
        var dest = $("#destination").val();
        var data = $("#frm-login-first").serialize();
        //alert(dest);
        $.ajax({
            url:url,
            type:"POST",
            data:data,
            success:function(hasil){
                hasilnya = hasil.split('//');
                //alert(hasilnya[0]);
                $("#hasil-proses").html(hasilnya[1]); //berisi data div (hasilnya[1])
                if(hasilnya[0] = "success") //berisi status proses (hasilnya[0])
                {
                   // alert('ou');
                    setTimeout(function () {
                        window.location = dest;
                    }, 3000); //delay selama 2 detik
                } else{
                 //   alert('woi');
                }
            }
        });
        e.preventDefault();
//        path = path.replace('#','');
//        alert(path);
    });
</script>
