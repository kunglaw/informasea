<div class="modal fade modal-resume" id="modal-form-add-prof" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog "><!-- large -->
    <div class="modal-content"> 
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> Add Proficiency <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
            
        </div>
        <script>
        	function add_proficiency_process()
			{
				
				$.ajax({
					
					type:"POST",
					url:"<?php echo base_url("seaman/resume_process/add_proficiency_process"); ?>",
					data:$("#form-add-proficiency form").serialize(),
					 beforeSend: function(){
                    $("#add-proficiency-btn").button('loading');
                    },
                    success:function(data){
							
						$("#info").html(data);
						
					}
					
				});
				
				
			}
			
			$("#add-proficiency-btn").click(function(){
				
				add_proficiency_process();
			});
			
			        
        </script>
    	<div class="modal-body">
        	<div id="form-add-proficiency">
    			<div id="info">
                
                </div>
            	<form action="#" method="post">
            		<div class="form-group">
						<label for="certificate" style="width:100%">Certificate </label>
							<select name="certificate" id="certificate" class="form-control" style="width:80%;">
            			<?php 
            			$this->load->model('proficiency_model');
            			$id = $this->session->userdata('id_user');
            			$punya = $this->proficiency_model->get_proficiency_pribadi($id);
            			foreach($punya as $row){
            				$x[] = $row['sertifikat_stwc'];
            			}


            			$ke = $this->proficiency_model->get_proficiency_all();

            				foreach($ke as $row){
            					if(!in_array($row['proficiency'],$x)){
            						?>
            						<option value="<?=$row['proficiency'];?>"> <?=$row['proficiency'];?> </option>
            						<?php
            					}
            				}

            			?>
            			                              <option value="other"> Other </option>

            			</select>

            			<br>
            	<input type="text" value="" name="proficiency_lain" id="proficiency_lain" placeholder="Type of proficiency" class="form-control" style="width:80%;" />


                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%">No Certificate </label>
                        <input type="text" name="no_certificate" id="no_certificate" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%">Issued Date </label>
                        <input type="text" name="date_issue" id="date_issue" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%">Issued Place </label>
                        <input type="text" name="place_issue" id="place_issue" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%">Expiry Date </label>
                    	<input type="text" name="expired_date" id="expired_date" class="form-control" style="width:80%">
                    </div>

                    <button class="btn btn-success" id="add-proficiency-btn" type="button" data-loading-text="Loading ..."> <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Save </button>
    <button class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Cancel </button>
                    
                    
            	</form>
            </div>
        
        </div><!-- Modal Body -->
        
    </div><!-- Modal Content -->
  </div><!-- Modal dialog -->
</div><!-- Modal -->

<script>

 $("#certificate").change(function(){
        var pilihan = $(this).val();
        if(pilihan == 'other') $("#proficiency_lain").show();
        else $("#proficiency_lain").hide().val("");
    });

		$("#expired_date").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth:true,
			changeYear:true,
		});


	$("#date_issue").datepicker({
		dateFormat:"yy-mm-dd",
		changeMonth:true,
		changeYear:true,
		yearRange: "-20:+0", // last hundred years
		maxDate:0
		
	});
	
	$(document).ready(function(e) {
		$("#proficiency_lain").hide();
        $("#modal-form-add-prof").modal({
			backdrop:"static",
			show:true	
		});
    });

	// Since confModal is essentially a nested modal it's enforceFocus method
	// must be no-op'd or the following error results 
	// "Uncaught RangeError: Maximum call stack size exceeded"
	// But then when the nested modal is hidden we reset modal.enforceFocus
	var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
	
	$.fn.modal.Constructor.prototype.enforceFocus = function() {};
	
	$confModal.on('hidden', function() {
		$.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
	});
	
	$confModal.modal({ backdrop : false });

</script>