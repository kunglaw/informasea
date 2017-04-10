<style>
.ui-datepicker { width: 17em; padding: .2em .2em 0; z-index:9000 !important;}
</style>

<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="ModalVacant">
 <div class="modal-dialog" style="width:1000px !important">
 <div class="modal-content"> 
        <div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
            <h4>Edit Vacantsea <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
        </div>
         
        <div class="modal-body">
            <script>
                // function update_vacantsea_process()
                // {//alert("lolololooo");
                //     $.ajax({
                        
                //         type:"post",
                //         url :"<?php echo base_url("index.php/vacantsea/update_process"); ?>",
                //         data:$("#form-update-vacantsea form").serialize(),
                //         success: function(data){
                //             //alert($("#form-update-vacantsea form").serialize());
                //             //alert(data);
                //             $("#info").html(data);  
                //         }
                        
                //     });
                // }
                
                // $(document).ready(function() {
                //     $("#update_button").click(function(){
                //     //alert("lolololooo");
                //         update_vacantsea_process();
                        
                //     });
                // });
                </script>
            
            <div id="info"> </div>
            <div id="form-update-vacantsea">
                <form role="form" action="" method="post">
                    <div class="box-body">
                        <div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" value="<?=$vacantsea ?>" id="vacantsea" name="vacantsea" required="required"/>
                                    <input type="text" value="<?=$vacantsea_id; ?>" name="vacantsea_id" />
                                </div>
                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea class="form-control" rows="8" id="description" name="description"><?=$description; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Navigation Area</label>
                                    <input type="text" class="form-control" value="<?=$navigation_area;?>" id="nav_area" name="nav_area"/>
                                </div>
                                <div class="form-group">
                                    &nbsp;
                                </div>
                            </div><!-- /.col-sm-4-->
                            
                            
                            <div class="col-sm-4">
                               <div class="form-group">
                                    <label>Vessel Name</label>
                                    <select class="form-control" name="ship_name" id="ship_name">
                                    <?php 
                                        foreach($ship as $row) { 
                                            $v = "";
                                            if($row['ship_id'] == $vacantsea_edit['ship'])
                                            {
                                                $v = "selected='selected'";
                                            }
                                    ?>
                                    <option value="<?php echo $row['ship_id'] ?>" <?php echo $v; ?>><?php echo $row['ship_name'] ?></option>
                                    <?php } ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="departement"> Departement </label>
                                    <select class="form-control" id="get_id_department" name="get_id_department">
                                    <?php 
                                        foreach($department as $row) { 
                                            $dept = "";
                                          if($row['department_id'] == $vacantsea_edit['departement'] )
                                          {
                                            $dept = "selected='selected'";  
                                          }
                                    ?>
                                    <option value="<?php echo $row['department_id'] ?>" <?php echo $dept ?>><?php echo $row['department'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rank">Rank</label>
                                    <select class="form-control" name="get_rank" id="get_rank">
                                    <?php 
                                        foreach($rank as $row) { 
                                            $r = "";
                                          if($row['rank_id'] == $vacantsea_edit['rank_id'] )
                                          {
                                            $r = "selected='selected'";  
                                          }
                                    ?>
                                    <option value="<?php echo $row['rank_id'] ?>" <?php echo $r ?>><?php echo $row['rank'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                <label>Annual Salary</label>
                                    <div  class="row">
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo substr($vacantsea_edit['annual_sallary'],0,-7) ?>" id="salary" name="salary"/>
                                    </div>
                                    <div class="col-sm-4" style="margin-bottom:-20px !important">
                                    <?php
                                        $d_select = ""; $m_select = ""; $y_select = "";
                                        
                                        if($sallary_type == "day  ")
                                        {
                                            $d_select = "selected=selected";
                                        } else if($sallary_type == "month")
                                        {
                                            $m_select = "selected=selected";
                                        } else
                                        {
                                            $y_select = "selected=selected";
                                        }
                                    ?>
                                    <select class="form-control" id="sal_type" name="sal_type">
                                        <option value="/day  " <?php echo $d_select ?>>/ Day</option>
                                        <option value="/month" <?php echo $m_select ?>>/ Month</option>
                                        <option value="/year " <?php echo $y_select ?>>/ Year</option>
                                    </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Contract type</label>
                                    <select class="form-control" id="contract_type" name="contract_type">
                                    <option value="contract based">Contract based</option>
                                    <option value="">dfdfd</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    &nbsp;
                                </div>
                            </div><!-- /.col-sm-4-->
                            
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Contract Dynamics</label>
                                    <input type="text" class="form-control" value="<?php echo $vacantsea_edit['contract_dynamic'] ?>" id="contract_dyn" name="contract_dyn"/>
                                </div>
                                <div class="form-group">
                                    <label>Requested Certificate</label>
                                    <input type="text" class="form-control" value="<?php echo $vacantsea_edit['requested_certificates'] ?>" id="req_cert" name="req_cert"/>
                                </div>
                                <div class="form-group">
                                    <label>Requested COC</label>
                                    <input type="text" class="form-control" value="<?php echo $vacantsea_edit['requested_coc'] ?>" id="req_coc" name="req_coc"/>
                                </div>
                                <div class="form-group">
                                    <label> Nationality </label>
                                    <select class="form-control" id="nationality" name="nationality">
                                    <?php 
                                        foreach($nationality as $row) { 
                                        $n = "";
                                        if ($row['id'] == $vacantsea_edit['id_nationality'])
                                        {
                                            $n = "selected = 'selected'";   
                                        }
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo $n; ?>><?php echo $row['name'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Expired Date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepick" name="datepick"/>
                                    </div><!-- /.input group -->
                                </div>
                            </div><!-- /.col-sm-4-->
                            </div>
                            
                            <div class="clearfix"></div>
                     </div><!-- /.box-body -->
                     
                     <div class="box-footer">
                     <button type="button" class="btn btn-primary" id="update_button"><i class="glyphicon glyphicon-floppy-disk"></i> Update Change</button>
                     </div>
            </form>
            </div>
        

        </div><!-- modal-body-->
    </div><!-- modal-content -->
 </div>
 </div>
 <script type="text/javascript">
 
            $("#datepick").datepicker({
                dateFormat:"yy-mm-dd",
                changeMonth:true,
                changeYear:true
                
            });
            
    $(document).ready(function(e) {
       $(".modal-form-edit").modal("show");
    });
    
</script>                    