<div class="modal fade modal-resume" id="modal-form-add-prof" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog "><!-- large -->
    <div class="modal-content"> 
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> <?=$this->lang->line("add")?> Proficiency <button type="button" class="close" id="close-modal-btn" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
            
        </div>
        <script>
        	function add_proficiency_process()
			{
				
				var formData = new FormData($("#form-add-proficiency form")[0]);
				
				$.ajax({
					
					type:"POST",
					url:"<?php echo base_url("seaman/resume_process/add_proficiency_process"); ?>",
					data	:formData,
					// data: formData,
					async   : false,
					cache   : false,
					contentType	: false,
					processData	: false,
					dataType	   : "json",
					beforeSend     : function(){
						
						$("#add-proficiency-btn").button('loading');
						
					},
					
					success:function(data){
						
						$("#add-proficiency-btn").button('loading');
						if(data.status == "error")
						{
							$("#add-proficiency-btn").button('reset');
						}
						else
						{
							$("#add-proficiency-btn").button('loading');
							
						}
						
						$("#info").html(data.message);
						// setTimeout(function() { 
						// 	location.reload(); 
						// }, 3000);
						
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
						<label for="certificate" style="width:100%"><?=$this->lang->line("certificate")?> </label>
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
            			                              <option value="other"> <?=$this->lang->line("other")?> </option>

            			</select>

            			<br>
            	<input type="text" value="" name="proficiency_lain" id="proficiency_lain" placeholder="Type of proficiency" class="form-control" style="width:80%;" />


                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%"><?=$this->lang->line("number")?> <?=$this->lang->line("certificate")?> </label>
                        <input type="text" name="no_certificate" id="no_certificate" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%"><?=$this->lang->line("issued_date")?> </label>
                        <input type="text" name="date_issue" id="date_issue" class="form-control" style="width:80%; background-color: white" readonly>
                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%"><?=$this->lang->line("issued_place")?> </label>
                        <input type="text" name="place_issue" id="place_issue" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="certificate" style="width:100%"><?=$this->lang->line("expired_date")?> </label>
                    	<input type="text" name="expired_date" id="expired_date" class="form-control" style="width:80%; background-color: white" readonly>
                    </div>
                    <div class="form-group">
                        <label for="expired_date">
                                <?php //$date_expired_lbl?>
                                <?=$this->lang->line("attachment")?>
                        </label>
                        
                        <div>
                        
                        <input style="display:none" type='file' title="" name="attachment" id="attachment" autocomplete="off" >
                        <a class="label label-default" title="upload new attachment" onClick="$('#attachment').click()">&nbsp;
						<?=$this->lang->line("edit")?>&nbsp; 
                         </a>
                         &nbsp;
                        <span id="nama_file_resume" class="label label-info"></span>
                        </div>
                    
                    </div>
					
                    <button class="btn btn-warning pull-left" onclick="call_report_form()" type="button" data-loading-text="Loading..."> &nbsp; 
                    <b> <?=$this->lang->line("report_problem")?> </b></button>
                        
                    <button class="btn btn-danger pull-right" data-dismiss="modal"> <span class="glyphicon glyphicon-remove-circle"></span>&nbsp; 
                    <b> <?=$this->lang->line("cancel")?> </b> </button>
                    <span class="pull-right">&nbsp;</span>
                    <button class="btn btn-success pull-right" id="add-proficiency-btn" type="button" data-loading-text="Loading..."> 
                        <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; <b> <?=$this->lang->line("cancel")?> </b>
                    </button>
                    
                    <span class="clearfix"></span>
                    
                    
            	</form>
            </div>
        
        </div><!-- Modal Body -->
        
    </div><!-- Modal Content -->
  </div><!-- Modal dialog -->
</div><!-- Modal -->

<script>
	 
	 $("#attachment").change(function(){
		var pinp = $(this).val();
		$("#nama_file_resume").html(pinp);
	 });
	 
	 $("#certificate").change(function(){
			var pilihan = $(this).val();
			if(pilihan == 'other') $("#proficiency_lain").show();
			else $("#proficiency_lain").hide().val("");
		});

		$("#expired_date").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth:true,
			changeYear:true,
		}).on('change', function () {
	        var myVal = $(this).val();
	        // alert(myVal);
	        var minDate = new Date(myVal);

	        /* Pengecekan tidak lebih besar dari hari ini */
	        var x = new Date();
	        if(x > minDate) minDate = minDate;
	        else minDate = x;

	        $('#date_issue').removeClass('hasDatepicker').datepicker({
	            dateFormat:"yy-mm-dd",
	            changeMonth:true,
	            changeYear:true,
	            maxDate : minDate

	        });
	    });


	$("#date_issue").datepicker({
		dateFormat:"yy-mm-dd",
		changeMonth:true,
		changeYear:true,
		yearRange: "-20:+0", // last hundred years
		maxDate:0
		
	}).on('change', function () {
        var myVal = $(this).val();
        // alert(myVal);
        var minDate = new Date(myVal);


        $('#expired_date').removeClass('hasDatepicker').datepicker({
            dateFormat:"yy-mm-dd",
            changeMonth:true,
            changeYear:true,
            minDate : minDate

        });
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