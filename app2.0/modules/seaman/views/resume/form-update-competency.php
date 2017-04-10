<div class="modal fade modal-form-update-comp modal-resume" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog "><!-- large -->
    <div class="modal-content"> 
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> <?=$this->lang->line("edit")?> COC and Endorsement <!-- Certificate of Competency --> <button type="button" id="close-modal-btn" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
        </div>
         
    	<div class="modal-body">
        	<script>
				function update_competency_process()
				{
					var formData = new FormData($("#form-update-competency form")[0]);
					
					$.ajax({
						
						type:"post",
						url 	 :"<?php echo base_url("seaman/resume_process/edit_competency_process"); ?>",
						data	:formData,
						// data: formData,
						async   : false,
						cache   : false,
						contentType	: false,
						processData	: false,
						dataType	   : "json",
						beforeSend     : function(){
							$("#competency-update-btn").button('loading');
						},
						
						success:function(data){
							
							if(data.status == "error")
							{
								$("#competency-update-btn").button('reset');
							}
							else
							{
								$("#competency-update-btn").button('loading');
								
							}
							
							$("#info").html(data.message);
							// setTimeout(function() { 
							// 	location.reload(); 
							// }, 3000);
							
						}
						
					});
				}
				
				$(document).ready(function(e) {
                    $("#competency-update-btn").click(function(){
						
						update_competency_process();
						
					});
                });
				
				
			
			</script>
            <div id="info">
            
            </div>
            <div id="form-update-competency">
            	<form role="form" class="" method="post">
                	<input type="hidden" value="<?php echo $competency['id_licenses']; ?>" name="id_license" id="id_license" />
                	<div class="form-group">
                		<?php
                			if($competency['type'] == 'coc') {
                				$a = "Certificate of Endorsement";
                			} else{
                				$a = "Certificate of Competency ";
                			}	
                			 ?>
                    	
                    	<label for="" style="display:block"> <?php echo $a; ?> </label>

                    	<?php 
							$this->load->model('nation_model');
							$id_user = $this->session->userdata('id_user');
							$nationa = $this->nation_model->get_nationality_pelaut($id_user);
							$nation = $this->nation_model->get_nationality_except($nationa['kebangsaan']);
							
							$readonly = "readonly";
							if($competency["type"] == "cor")
							{
								$readonly = "";	
							}
														
                         if($competency['type'] != 'coc'){ ?>
                        <select name="negara" id="negara" class="form-control" style="width:80%">
                       <?php
                            $neg = $competency['negara'];    
                            $z = $this->db->query("SELECT negara FROM competency_tr WHERE pelaut_id = '$id_user' AND negara != '$neg'");
							$xx = $z->result_array();
							foreach($xx as $m){
								$negg[] = $m['negara'];
							}
								 foreach($nation as $row)
								{
	
	
									if(!in_array($row['name'],$negg)){ 
									
									$select_nation = '';
									if($row['name'] == $type || $row['name'] == $competency['negara']) {
									$select_nation = "selected='selected'";
									}?>
									<option value="<?= $row['name'] ?>" <?=$select_nation?>><?= $row['name'] ?></option>
									<?php
								}  else{

                            }}
                            ?>
                        </select>
                        <?php } else{  ?>
                        <input type="hidden" name="negara" value="<?php echo $nationa['kebangsaan']; ?>">
                       <?php } ?>

                        
                        <input type="hidden" value="<?=$competency['type']?>" name="type"  />
                    </div>
                    <div class="form-group">
                    	<label> <?=$this->lang->line("grade_license")?></label>
                        <input type="text" value="<?php echo $competency['grade_license'] ?>" name="grade_license" id="grade_license" class="form-control" 
                        style="width:80%" <?=$readonly?> >
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block"><?=$this->lang->line("no_license")?> </label>
                        <input type="text" value="<?php echo $competency['no_license'] ?>" name="no_license" id="no_license" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block"><?=$this->lang->line("issued_place")?> </label>
                        <input type="text" value="<?php echo $competency['place_issued'] ?>" name="place_issue" id="place_issue" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block"><?=$this->lang->line("issued_date")?> </label>
                        <input type="text" value="<?php echo date_picker_format($competency['date_issued']) ?>" name="date_issue" id="date_issue" class="form-control" style="width:80%; background-color: white" readonly>
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block"><?=$this->lang->line("expired_date")?> </label>
                        <input type="text" value="<?php echo date_picker_format($competency['expired_date']) ?>" name="expired_date" id="expired_date" class="form-control" style="width:80%; background-color: white" readonly>
                    </div>
                    	
                    <div class="form-group">
                        <label for="expired_date">
                                <?php //$date_expired_lbl?>
                                <?=$this->lang->line("attachment")?>
                        </label>
                        
                        <div>
                        <?=$competency['attachment']?>&nbsp;&nbsp;&nbsp;
                        
                        <input style="display:none" type='file' title="" name="attachment" id="attachment" autocomplete="off" >
                        <a class="label label-default" title="upload new attachment" onClick="$('#attachment').click()">
                        &nbsp;<?=$this->lang->line("edit")?>&nbsp;</a>
                        &nbsp;
                        <span id="nama_file_resume" class="label label-info"></span>
                        </div>
                    
                    </div>
                    
                    <button class="btn btn-warning pull-left" onclick="call_report_form()" type="button" data-loading-text="Loading..."> &nbsp; 
                        <b> <?=$this->lang->line("report_problem")?> </b></button>
                            
                        <button class="btn btn-danger pull-right" data-dismiss="modal"> <span class="glyphicon glyphicon-remove-circle"></span>&nbsp; 
                        <b> <?=$this->lang->line("cancel")?> </b> </button>
                        
                        <span class="pull-right">&nbsp;</span>
                        <button class="btn btn-success pull-right" id="competency-update-btn" type="button" data-loading-text="Loading..."> 
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; <b> <?=$this->lang->line("save")?> </b>
                        </button>
                        
                        <span class="clearfix"></span>

            	</form>
            </div>
        

        </div><!-- modal-body-->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<script type="text/javascript">
	
	$("#attachment").change(function(){
		var pinp = $(this).val();
		$("#nama_file_resume").html(pinp);
	});
	
	$("#date_issue").datepicker({
		dateFormat:"yy-mm-dd",
		changeMonth:true,
		changeYear:true,
		yearRange: "<?=$date_issued?>", // last hundred years
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
	
	$("#expired_date").datepicker({
		dateFormat:"yy-mm-dd",
		changeMonth:true,
		changeYear:true,
		yearRange: "<?=$date_expired?>" // last hundred years
		
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
	
	$(document).ready(function(e) {
        $(".modal-form-update-comp").modal({
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