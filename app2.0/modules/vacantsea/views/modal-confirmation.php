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

<div class="modal bs-example-modal-md fade" id="myModalx" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header bg-success">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:location.href='<?php echo base_url("vacantsea") ?>'"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">You have been applied to:</h4>

            </div>

            <div class="modal-body">

                <?php /*echo $isinya */?>

                <?php

                    $username   = $this->session->userdata("username");

                ?>

                <br />

                <table class="table table-stripped ">

                    <tr>

                        <td>Company</td>

                        <td>:</td>

                        <td><?php echo "<b>".$company."</b>";?></td></tr>

                    <tr>

                        <td>Title</td>

                        <td>:</td>

                        <td><?php echo "<b>".$vacantsea['vacantsea']."</b>";?></td></tr>

                    <tr>

                        <td>End</td>

                        <td>:</td>

                        <td><?php echo "<b>".date('F d, Y', strtotime($vacantsea['expired_date']))."</b>";?></td></tr>

                </table>

                <span class="push-right">

                  <button type="button" name="" class="btn btn-default btn-lg" onclick="javascript:location.href='<?php echo base_url("vacantsea") ?>'">Close </button>

                  <button type="button" name="" class="btn btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url("profile/".$username."/applied-vacantsea");?>'">View applied vacantsea </button>&nbsp;



                </span>

            </div>

            <div class="clearfix"> </div>



        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $("#myModalx").modal({

        "show" : 'true',

        "backdrop" : 'static'

    });

</script>

