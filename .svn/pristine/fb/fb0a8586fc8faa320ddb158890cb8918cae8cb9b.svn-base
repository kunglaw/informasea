<?php  // content center , menu vacantsea, module vacantsea ?>


<div id="content row" class="col-md-9" style="margin: 5px 0px 0px 10px">

    <!-- start list vacantsea -->
    <div class="panel panel-default" id="panel-vacantsea">

        <div class="panel-body">
            <div id="list_vacantsea">

            </div>
        </div>
    </div>
</div>
<script>
    var interval    =   0;
//    function start(){
//        setTimeout( function(){
//            ajax_function();
//            interval    =   60;
//            setInterval( function(){
//                ajax_function();
//            }, interval*1000);
//        }, interval*1000);
//    }

    function ajax_function(){
//        alert("Hello");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("vacantsea/cobacobasince")?>",
//                context: document.body,
            data: "z=2015-04-13 05:28:22",
            success: function(result){
                $('div#list_vacantsea').html(result);
            }
        });
    }

    function updatePanel() {
        setInterval(function () {
            ajax_function();
        }, 1000 * 60);
    }

    $(document).ready(function(e) {
//        keyword = "<?php //echo $page; ?>//";
        // alert(keyword+"testing");
        updatePanel();
    });

    function doStuff() {
//                time = "<?php //since("2015-04-13 02:30:30") ?>//";
        alert("Hello");
    }
</script>