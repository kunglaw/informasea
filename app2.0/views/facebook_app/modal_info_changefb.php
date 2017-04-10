<div id="fb-info" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Info</h4>
      </div>
      <div class="modal-body">
        <?php
			// saran untuk user agar logout facebooknya dengan membuka facebook 
		
		?>
        <p> Using another account ? logout from facebook first </p>
		
        <span class="clearfix"></span>
		
      </div>
	  <div class="modal-footer">
		<button id="klwtu" class="btn btn-default" data-dismiss="modal" aria-label="Close">Got it </button>
		
		
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$(document).ready(function(){
	
	$("#fb-info").modal({
		show:true/*,
		backdrop:"static",
		keyboard:false*/
	});
	
});
</script>