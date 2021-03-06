<div class="modal fade modal-form-update-comp modal-resume" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog "><!-- large -->
    <div class="modal-content"> 
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> Edit COC and Endorsement <!-- Certificate of Competency --> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
        </div>
         
    	<div class="modal-body">
        	<script>
				function update_competency_process()
				{
					$.ajax({
						
						type:"post",
						url :"<?php echo base_url("seaman/resume_process/edit_competency_process"); ?>",
						data:$("#form-update-competency form").serialize(),
						success: function(data){
							$("#info").html(data);	
							
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

                        <input type="hidden" value="<?php echo $competency['grade_license'] ?>" name="grade_license" id="grade_license" class="form-control" style="width:80%" readonly>
                        <input type="hidden" value="<?=$competency['type']?>" name="type"  />
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block">No License </label>
                        <input type="text" value="<?php echo $competency['no_license'] ?>" name="no_license" id="no_license" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block">Issued Place </label>
                        <input type="text" value="<?php echo $competency['place_issued'] ?>" name="place_issue" id="place_issue" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block">Issued Date </label>
                        <input type="text" value="<?php echo date_picker_format($competency['date_issued']) ?>" name="date_issue" id="date_issue" class="form-control" style="width:80%">
                    </div>
                    <div class="form-group">
                    	<label for="" style="display:block">Expiry Date </label>
                        <input type="text" value="<?php echo date_picker_format($competency['expired_date']) ?>" name="expired_date" id="expired_date" class="form-control" style="width:80%">
                    </div>
                    	<?php 
						if($competency['type'] == 'coc'){ 
						
						}else{ ?>
                    <div class="form-group"> 
                    <!--	<label for="" style="display:block">Country </label> -->
                        	
                        <?php } ?>
                        <!-- <input type="text" value="<?php echo $competency['negara'] ?>" name="negara" id="negara" class="form-control" style="width:80%"> -->
                    </div>
                      <button class="btn btn-success" id="competency-update-btn" type="button"> <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Save </button>
    <button class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Cancel </button>
            	</form>
            </div>
        

        </div><!-- modal-body-->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<script type="text/javascript">
	$("#date_issue").datepicker({
		dateFormat:"yy-mm-dd",
		changeMonth:true,
		changeYear:true,
		yearRange: "<?=$date_issued?>", // last hundred years
		maxDate:0
		
	});
	
	$("#expired_date").datepicker({
		dateFormat:"yy-mm-dd",
		changeMonth:true,
		changeYear:true,
		yearRange: "<?=$date_expired?>" // last hundred years
		
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