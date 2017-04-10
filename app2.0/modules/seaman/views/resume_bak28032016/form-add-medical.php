<div class="modal fade modal-resume" id="modal-form-add-medical" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><!-- large -->
        <div class="modal-content">
            <div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
                <h4> Add Medical Record <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>

            </div>



            <div class="modal-body">
                <script>
                    function add_medical_process()
                    {
                        var data = $("#form-add-medical form").serializeArray();

                        var new_data = new Array();
                        var z=0;
                        jQuery.each(data, function (i, field) {
                            new_data[z] = field.name+'='+field.value;
                            z++;
                        });
                        var doc_type = new_data[3].split("=");

                        for(z=0;z<new_data.length;z++)
                        {
                            dt = new_data[z].split("=");
                            if(z==0) data = dt[0]+"="+dt[1];
                            else {
                                if(z==1) {
                                    dt[1] = doc_type[1] == "Medical Certificate" ? "medical_cert" : "medical";
                                }
                                data += "&" + dt[0] + "=" + dt[1];
                            }
                        }
                        $.ajax({
                            type:"POST",
                            url:"<?php echo base_url("seaman/resume_process/add_document_medical"); ?>",
                            data:data,
                             beforeSend: function(){
                            $("#add-medical-btn").button('loading');        
                            },
                            success:function(data){

                                $("#info").html(data);
                                //$("#modal-form-add-medical").hide();
                               // location.reload();
                            //setTimeout(function() { location.reload(); }, 3000);
                            },
                            error:function(ts){
                                alert(ts.responseText);
                            }


                        });
                    }

                    $("#add-medical-btn").click(function(){

                        add_medical_process();
                    });

                </script>
                <div id="form-add-medical">
                    <div id="info">

                    </div>
                    <form>
                        <?php // via json encode ?>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $id_pelaut; ?>" name="pelaut_id" />
                            <input type="hidden" value="medical" name="source" />
                            <input type="hidden" value="<?php echo $this->session->userdata("username"); ?>" name="username" />
                            <label for="doc_type">
                                Type
                            </label>
                            <!-- <input type="" title="autocomplete" name="vessel_name" id="vessel_name" data-id="id_ship" class="form-control" style="width:80%" > -->
                            <select class="form-control" style="width: 50%;" name="document_type" id="doc_type">
                                <option value="">- select -</option>
                                <?php

                                    $this->load->model('document_model');

                                //iqbal
                            $document_pribadi = $this->db->query("SELECT type FROM document_tr WHERE pelaut_id = '$id_pelaut' AND (type_document = 'medical' or type_document = 'medical_cert')");
                            $a = $document_pribadi->result_array();
                            foreach($a as $b){
                                $xz[] = $b['type'];
                            }



                                foreach($myDocument as $row)
                                {  
                                        if(!in_array($row['medical'],$xz)){ ?>
                             ?>
                                    <option value="<?= $row['medical'] ?>"><?= $row['medical'] ?> </option>
                                 <?php
                                  } else{

                                  }
                                }
                                ?>
                             <option value="other"> Other </option>
                            </select>
                            <br>
                            <input type="text" value="" name="type" id="type" placeholder="type of document .. " class="form-control" style="width:80%;" />

                        </div>

                        <div class="form-group">
                            <label for="number">
                                Number
                            </label>

                            <input type="text" value="" name="number" id="number" placeholder="" class="form-control" style="width:80%"  />


                        </div>
                        <div class="form-group">
                            <label for="place">
                                Place
                            </label>
                            <input type="text" value="" name="place" id="place" class="form-control" style="width:80%"  />

                        </div>
                                        <div class="form-group">
                                        	<label for="date_issued">
                                            		Issued Date
                                            </label>
                                            <input type="" title="" name="date_issued" id="date_issued" class="form-control" style="width:80%" autocomplete="off" >
                                        </div>
                        <div class="form-group">
                            <label for="expired_date">
                                Expiry Date
                            </label>
                            <input type="" title="" name="date_expired" id="date_expired" class="form-control" style="width:80%" autocomplete="off">

                        </div>

                        <button class="btn btn-success" id="add-medical-btn" type="button" data-loading-text="Loading ...."> <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Save </button>
                        <button class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Cancel </button>
                    </form>
                </div>
            </div><!-- modal-body -->

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<script>

    $("#doc_type").change(function(){
        var pilihan = $(this).val();
        if(pilihan == 'other') $("#type").show();
        else $("#type").hide().val("");
    });

    $("#date_issued").datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth:true,
        changeYear:true,
        gotoCurrent: true,
        yearRange: "<?=$date_issued?>", // last hundred years
		maxDate:0

    });

    $("#date_expired").datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth:true,
        changeYear:true,
        gotoCurrent: true,
        yearRange: "<?=$date_expired?>" // last hundred years

    });

    $(document).ready(function(e) {
        $("#type").hide();
        $("#modal-form-add-medical").modal({
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