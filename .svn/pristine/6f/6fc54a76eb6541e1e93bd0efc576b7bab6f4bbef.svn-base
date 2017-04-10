<script src="<?=asset_url('js/validasi_angka.js');?>" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
       dateFormat:"yy-mm-dd",
        minDate:0 
    });
  });
  </script>


<div class="modal fade modal_add_vacant" id="" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
 <div class="modal-dialog" style="width:1000px !important">
 <div class="modal-content"> 
    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        	<h4> Create New Vacantsea <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
        </div>
         
    	<div class="modal-body">
            <div id="info"> </div>
            <div >
            	<form role="form" action="" method="post" id="frm_vacantsea">
                	<div class="box-body">
                		<div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" value="" id="title" name="title" required="required"/>
                                </div>
                                
                                <div class="form-group">
                                    <label>Navigation Area</label>
                                    <input type="text" class="form-control" value="" id="nav_area" name="nav_area"/>
                                </div>
                                <div class="form-group">
                                    <label>Vesel Type</label>
                                    <select class="form-control" name="ship_type" id="ship_type">
                                        <option style="display:none"></option>
                                        <?php
                                        foreach ($ship_type->result_array() as $rows) {
                                            echo "<option value='".$rows['type_id']."'>".$rows['ship_type']."</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Vessel Name</label>
                                    <select class="form-control" name="ship_id" id="ship_name">
                                        <option style="display:none"></option>
                                        <!-- get in vessel type -->
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="departement"> Departement </label>
                                    <select class="form-control" id="get_id_department" name="department_id">
                                        <option style="display:none"></option>
                                        <?php
                                        foreach ($department->result_array() as $rows) {
                                            echo "<option value='".$rows['department_id']."'>".$rows['department']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    &nbsp;
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                
                                <div class="form-group">
                                    <label for="rank">Rank</label>
                                    <select class="form-control" name="rank_id" id="get_rank">
                                        <option style="display:none"></option>
                                        <!-- get in department -->
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                <label>Salary</label>
                                    <div  class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control" name="salary_curr" id="sallary_curr">
                                            <option style="display:none"></option>
                                            <option value="IDR" >IDR</option>
                                            <option value="SGD" >SGD</option>
                                            <option value="USD" >USD</option>
                                            <option value="EUR" >EUR</option>
                                        </select>  
                                    </div>
                                    <div class="col-sm-4">
                                    <input type="text" class="form-control" id="salary" name="salary" onkeydown="return numbersonly(this, event)" placeholder="number"/>
                                    </div>
                                    <div class="col-sm-4" style="margin-bottom:-20px !important">
                                    <select class="form-control" id="sal_type" name="salary_type">
                                        <option value="/day"  >/ Day</option>
                                        <option value="/month"  >/ Month</option>
                                        <option value="/year" >/ Year</option>
                                    </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Contract Dynamics</label>
                                    <input type="text" class="form-control" value="" id="contract_dyn" name="contract_dyn"/>
                                </div>
                                <div class="form-group">
                                    <label>Benefits</label>
                                    <input type="text" class="form-control" value="" id="benefits" name="benefits"/>
                                </div>
                                <div class="form-group">
                                    <label>Requested Certificate</label>
                                    <input type="text" class="form-control" value="" id="req_cert" name="req_cert"/>
                                </div>
                             
                                <div class="form-group">
                                    &nbsp;
                                </div>
                            </div><!-- /.col-sm-4-->
                            
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Requested COC</label>
                                    <input type="text" class="form-control" value="" id="req_coc" name="req_coc"/>
                                </div>
                                <div class="form-group">
                                    <label> Nationality </label>
                                    <select class="form-control" id="nationality" name="nationality_id">
                                        <option style="display:none"></option>
                                        <?php
                                        foreach ($nationality->result_array() as $rows) {
                                            echo "<option value='".$rows['id']."'>".$rows['name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Expired Date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input  id="datepicker" name="sign_on" type="text">
                                    <input  name="expired_dt" type="text" value="0000-00-00" style="display:none">
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label>Minimum Experience</label>
                                    <textarea class="form-control" id="experience" name="experience" rows="5" ></textarea>
                                </div>
                            </div><!-- /.col-sm-4-->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea class="form-control" rows="4" id="detail" name="detail"></textarea>
                                </div>
                            </div>

                            </div>
                            
                            <div class="clearfix"></div>
                     </div><!-- /.box-body -->
                     
                     <div class="box-footer">
                     <button type="button" class="btn btn-success" id="btn_submit" data-dismiss="modal"><i class="glyphicon glyphicon-floppy-disk"></i> Create Vacantsea</button>
                     </div>
            </form>
            </div>
        

        </div><!-- modal-body-->
    </div><!-- modal-content -->
 </div>
 </div>
<script type="text/javascript">
    $(document).ready(function(e) {
       $(".modal_add_vacant").modal("show");
    });

    $("#ship_type").change(function(){
        var id_ship_type = document.getElementById("ship_type").value;
        $.ajax({
            type    : "POST",
            url     : "<?=base_url('company/modal_company');?>",
            data    : "modal_type=ship_name&id_ship_type=" + id_ship_type,
            success:function(data){
                $("#ship_name").html(data);
            }
        });
    });

    $("#get_id_department").change(function(){
        var department_id   = document.getElementById("get_id_department").value;
        $.ajax({
            type    : "POST",
            url     : "<?=base_url('company/modal_company');?>",
            data    : "modal_type=rank&department_id=" + department_id,
            success:function(data){
                $("#get_rank").html(data);
            }
        });
    });

    $("#btn_submit").click(function(){
        $.ajax({
            type    : "POST",
            url     : "<?=base_url('company/vacantsea_add');?>",
            data    : $("#frm_vacantsea").serialize(),
            success:function(data){
                alert(data);
                // $("#container_modal").html(data);
                setTimeout(function(){
                    window.location="<?=base_url('agentsea/ottoman/home');?>";
                }, 2000);

            }
        });

    });
	


</script>                    