<?php
	$modal_size = !empty($modal_size) ? $modal_size : ""; 
	$bg = !empty($bg) ? $bg : "bg-primary"; 

?>
<div class="modal fade" id="modal-general" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog <?=$modal_size?>">

    <div class="modal-content">

      <div class="modal-header <?=$bg?>">

        

        <h4 class="modal-title"><?=$title?></h4>

      </div>

      <div class="modal-body">

        <?=$desc?>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->

</div><!-- /.modal -->



<script>

$(document).ready(function(e) {

    $("#modal-general").modal({

		backdrop:"static",

		show:true

	});

});



</script>