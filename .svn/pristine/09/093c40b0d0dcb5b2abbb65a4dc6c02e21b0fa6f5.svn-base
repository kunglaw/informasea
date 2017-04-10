<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 14/04/2015
 * Time: 13:51
 */

if($hasil == "berhasil update")
{
    $class = "bg-primary";
    $kepala = "Success";
    $pesan = "Your Data has been updated";
}
elseif($hasil == "password tidak match")
{
    $class = "bg-warning";
    $kepala = "Warning";
    $pesan = "Sorry, Field New Password and Retype Password doesn't match";
}
elseif($hasil == "kosong")
{
    $class = "bg-warning";
    $kepala = "Warning";
    $pesan = "Sorry, Field New Password and Retype Password cannot be blank";
}
elseif($hasil == "password lama salah")
{
    $class = "bg-danger";
    $kepala = "Failed";
    $pesan = "Sorry, Your old Password is wrong !";
}
else {}

?>

<div class="modal fade bs-example-modal-lg" id="myModala">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header <?= $class ?>">

                <h2 class="modal-title">
                    <?= $kepala ?>
                </h2>
            </div>

                <div class="modal-body">
                    <h3><?= $pesan ?></h3>
<!--                    --><?//= $query ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function(){
        $("#myModala").modal("show");
    });
</script>