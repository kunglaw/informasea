<?php // content center , menu vacantsea, module vacantsea ?>

<div id="content" class="col-md-6">

    <!-- start list vacantsea -->
    <div class="panel panel-default" id="panel-vacantsea">
        <div class="panel-body">
            <div id="list_vacantsea">

            </div>
            <div id="modal-login">
                <!--Ajax-->
            </div>
        </div>
    </div>
</div>

<script>
    function get_list_vacantsea()
    {
        $.ajax({
            type :"POST",
            url:"<?php echo base_url("vacantsea/vacantsea/get_list_vacantsea") ?>",
            data:"x=1",
            success: function(data) {
                //alert (data);
                $("#list_vacantsea").html(data);
            } /*end success*/
        });
    }

    $(document).ready(function(e) {

        get_list_vacantsea();

    });
</script>