<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header <?=$bg?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=$modal_title?></h4>
      </div>
      <div class="modal-body" style="color:#000">
        <?=$body_message?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(document).ready(function(e) {
        $("#myModal").modal({
			
			show:true,
			backdrop:'static'
				
		});
    });

</script>