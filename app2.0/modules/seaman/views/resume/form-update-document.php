<div class="modal fade modal-resume" id="modal-form-update-document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"><!-- large -->
    <div class="modal-content"> 
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> <?=$this->lang->line("edit")?>  Document <button type="button" class="close" id="close-modal-btn" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
            
        </div>
         
    	<div class="modal-body">
          <script>
		  	function update_document_process()
			{
				//var data = $("#form-update-document form").serialize();
				var formData = new FormData($("#form-update-document form")[0]);
				//alert(data);

				$.ajax({
					
					type		: "POST",
					url		 : "<?php echo base_url("seaman/resume_process/tes_update_document"); ?>",
					data		: formData,
					async	   : false,
                    cache	   : false,
					contentType : false,
                    processData : false,
					dataType	: "json",
					beforeSend  : function(){
                        $("#update-document-btn").button('loading');
                    },
					
					success:function(data){
						
						if(data.status == "error")
						{
							$("#update-document-btn").button('reset');
						}
						else
						{
							$("#update-document-btn").button('loading');
							
						}
						
						$("#info").html(data.message);
						// setTimeout(function() { 
						// 	location.reload(); 
						// }, 3000);
						
					}
                    
					
				});
				
				
			}

			$("#update-document-btn").click(function(){
				
				update_document_process();
			});
			
		
		  
		  </script>


			<?php
				$a = explode("|",$document['type']);
				$type = $a[0];
			?>
          <div id="form-update-document">
          	<div id="info">              </div>
        	<form>                
                <div class="form-group">
                	<input type="hidden" value="<?php echo $this->session->userdata("id_user"); ?>" name="pelaut_id" />
                    <input type="hidden" value="<?php echo $this->session->userdata("username"); ?>" name="username" />
                    <input type="hidden" value="<?php echo $document['document_id']; ?>" name="id_update" />       
                    <input type="hidden" name="tipenya" value="<?php echo $document['type']; ?>">
            		<label for="doc_type">
                    	<?=$this->lang->line("country")?> 
                    </label>
                    <!-- <input type="" title="autocomplete" name="vessel_name" id="vessel_name" data-id="id_ship" class="form-control" style="width:80%" > -->
                    <?php         
                        $id_user = $this->session->userdata('id_user');  
                        $this->load->model('nation_model');
                        $user = $this->nation_model->get_nationality_pelaut($id_user); 
                        $nation = $this->nation_model->get_nationality_except($user['kebangsaan']);

                        if($document['type'] == 'Passport' OR $document['country'] == $user['kebangsaan']){
                        ?>
                        <br>
                        <input type="text" name="national" value="<?php echo $user['kebangsaan']; ?>"  class="form-control" style="width:80%" readonly> 
                        <?php
                        } else {
                        ?>
                        <input type="text" name="national" value="<?php echo $document['country']; ?>" class="form-control" style="width:80%;" readonly>
                        <?php
                        } ?> 

                 <?php /*       ?>

                    <select class="form-control" style="width: 50%;" name="national">
	<!--                        <option value="">- select  -</option> -->

                        <?php 
                        $dokko = $document['country'];
                         $z = $this->db->query("SELECT country FROM document_tr WHERE pelaut_id = '$id_user' AND 
                            type_document = 'document' AND country != '$dokko'");
                        $xx = $z->result_array();
                        foreach($xx as $m){
                            $negg[] = $m['country'];
                        }
                       //$nation = $this->nation_model
                            foreach($nation as $row)
                            {


                                if(!in_array($row['name'],$negg)){ 
                            	
                                $select_nation = '';
                            	if($row['name'] == $type || $row['name'] == $document['country']) {
								$select_nation = "selected='selected'";
                            	}?>
                                <option value="<?= $row['name'] ?>" <?=$select_nation?>><?= $row['name'] ?></option>
                                <?php
                            }  else{

                            }} 
                        ?>

                    </select>
                    <?php } */ ?>
                 
                </div>
                
                <div class="form-group">
            		<label for="number"> 
                    	<?=$this->lang->line("number")?>  
                    </label> 
                    
                    <input type="text" value="<?php echo $document['number']; ?>" name="number" id="number" placeholder="" class="form-control" style="width:80%"  />
                    
                  
            	</div>
                <div class="form-group">
                	<label for="place">
                    	<?=$this->lang->line("issued_place")?>  
                    </label>
                    <input type="text" value="<?php echo $document['place']; ?>" name="place" id="place" class="form-control" style="width:80%"  />
                
                </div>
                <div class="form-group">
                	<label for="date_issued">
                        <?=$this->lang->line("issued_date")?> 
                    	<?php //$date_issued_lbl?>
                    </label>
                    <input type="text" title="" value="<?php echo date_picker_format($document['date_issued']); ?>" name="date_issued" id="date_issued" class="form-control" style="width:80%; background-color: white" readonly autocomplete="off" >
                
                </div>
                <div class="form-group">
                	<label for="expired_date">
                        <?=$this->lang->line("expired_date")?> 
                    		<?php //$date_expired_lbl?>
                    </label>
                    <input type="text" title="" value="<?php echo date_picker_format($document['date_expired']); ?>" name="date_expired" id="date_expired" class="form-control" style="width:80%; background-color: white" readonly autocomplete="off">
                
                </div>
                <div class="form-group">
                    <label for="expired_date">
						<?php //$date_expired_lbl?>
                        <?=$this->lang->line("attachment")?> 
                    </label>
                    
                    <div>
                    <?=$document['attachment']?>&nbsp;&nbsp;&nbsp;
                    
                    <input style="display:none" type='file' title="" name="attachment" id="attachment" autocomplete="off" >
                    <a class="label label-default" title="upload new attachment" onClick="$('#attachment').click()">&nbsp;edit&nbsp;</a>
                    &nbsp;
                        <span id="nama_file_resume" class="label label-info"></span>
                    </div>
                
                </div>
                
                <button class="btn btn-warning pull-left" onclick="call_report_form()" type="button" data-loading-text="Loading..."> &nbsp; 
                <b> <?=$this->lang->line("report_problem")?>  </b></button>
                    
                <button class="btn btn-danger pull-right" data-dismiss="modal"> <span class="glyphicon glyphicon-remove-circle"></span>&nbsp; 
                <b> <?=$this->lang->line("cancel")?>  </b> </button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-success pull-right" id="update-document-btn" type="button" data-loading-text="Loading..."> 
                    <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; <b> <?=$this->lang->line("save")?>  </b>
                </button>
                
                <span class="clearfix"></span>
            </form>
          </div>
        </div><!-- modal-body -->
        
    </div><!-- modal-content -->
  </div><!-- modal-dialog --> 
</div><!-- modal -->

<script>
	
	$("#attachment").change(function(){
		var pinp = $(this).val();
		$("#nama_file_resume").html(pinp);
	});
	$("#date_issued").datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth:true,
        changeYear:true,
        gotoCurrent: true,
        yearRange: "<?=$date_issued?>",
        maxDate:0
        
    }).on('change', function () {
        var myVal = $(this).val();
        // alert(myVal);
        var minDate = new Date(myVal);


        $('#date_expired').removeClass('hasDatepicker').datepicker({
            dateFormat:"yy-mm-dd",
            changeMonth:true,
            changeYear:true,
            minDate : minDate

        });
    });
    
    $("#date_expired").datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth:true,
        changeYear:true,
        gotoCurrent: true,
        yearRange: "<?=$date_expired?>"
        
    }).on('change', function () {
        var myVal = $(this).val();
        // alert(myVal);
        var minDate = new Date(myVal);

        /* Pengecekan tidak lebih besar dari hari ini */
        var x = new Date();
        if(x > minDate) minDate = minDate;
        else minDate = x;

        $('#date_issued').removeClass('hasDatepicker').datepicker({
            dateFormat:"yy-mm-dd",
            changeMonth:true,
            changeYear:true,
            maxDate : minDate

        });
    });
	
	$(document).ready(function(e) {
        $("#modal-form-update-document").modal({
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
