<div class="modal fade modal-resume" id="modal-form-update-experience" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog"><!-- large -->

    <div class="modal-content"> 

    	<div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">

        	<h4> <?=$this->lang->line("edit")?> <?=$this->lang->line("sea_service_record")?> <button type="button" class="close" id="close-modal-btn" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> </h4>

            

        </div>

        

        

        

    	<div class="modal-body">

          <script>

		  

		  	function reset_juga()

			{

				//load_ship_type();

				load_ship();

			}

			

		  	function update_experience_process()

			{

				

				$.ajax({

					

					type:"POST",

					url:"<?php echo base_url("seaman/resume_process/update_experience_process"); ?>",

					data:$("#form-update-experience form").serialize(),

					success:function(data){

							

						$("#info").html(data);

						//setTimeout(function() { location.reload(); }, 2000);

					}

					

				});

				

				

			}

			

			function load_ship_type()

			{

							

				$.ajax({

				  url:'<?php echo base_url("seaman/resume/resume_data"); //get_ship_type ?>',

				  type:'POST',

				  data: 'x=1&function=get_ship_type&curr_type=<?php echo $experience['ship_type_id'] ?>',

				  success: function(data) {

					  //$("info").html(json);

					$("#ship_type").html(data);

					  

					  

				  }

				});	

			}

			

			function load_ship_by_type()

			{

				var type_id = $("#ship_type").val();

				

				$.ajax({

				  url:'<?php echo base_url("seaman/resume/resume_data"); //get_ship_bytype ?>',

				  type:'POST',

				  data: 'x=1&function=get_ship_bytype&type_id='+type_id,

				 // dataType: 'json',

				  success: function(data) {

					//alert(data);

					//$("#info").html("type_id="+type_id+"&load_ship_by_type()&get_ship_bytype"+data);

					$("#vessel_id").html(data);

					 

					  

				  }

				});

				

				

			}

			

			function load_ship_type_row()

			{

				var vessel_id = $("#vessel_id").val();

							

				$.ajax({

				  url:'<?php echo base_url("seaman/resume/resume_data"); // get_ship_type_byvi ?>',

				  type:'POST',

				  data: 'x=1&function=get_ship_type_byvi&vessel_id='+vessel_id,

				 // dataType: 'json',

				  success: function(data) {

					//$("#info").html("vessel_id="+vessel_id+"&load_ship_type_row()&get_ship_type_byvi&"+data);

					$("#ship_type").html(data);

					 

					  

				  }

				});	

			}

			

			$("#add-experience-btn").click(function(){

				

				update_experience_process();

			});

		  	

			$(document).ready(function(e) {

                load_ship_type();

            });

			

		  </script>

          <div id="form-update-experience">

          	<div id="info">   

            

            

            </div>

        	<form>         

                <input type="hidden" value="<?php echo $this->session->userdata("id_user"); ?>" name="pelaut_id" />

                <input type="hidden" value="<?php echo $this->session->userdata("username"); ?>" name="username" />

                <input type="hidden" value="<?php echo $experience['experience_id']?>" name="experience_id" />       

                <?php // via json encode ?>

                <div class="form-group">

                	<input type="hidden" value="<?php echo $this->session->userdata("id_user"); ?>" name="pelaut_id" />

                    <input type="hidden" value="<?php echo $this->session->userdata("username"); ?>" name="username" />

            		<label for="vessel_name">

                    		<?=$this->lang->line("vessel_name")?>

                    </label>

                    <!-- <input type="" title="autocomplete" name="vessel_name" id="vessel_name" data-id="id_ship" class="form-control" style="width:80%" > -->

                    <input type="text" name="vessel_name" id="vessel_name" value="<?=$experience['ship_name']?>" class="form-control" style="width:80%">

                  

            	</div>

                

                <div class="form-group">

                	<div class="row">

                      

                      <div class="col-md-3">

                        <label><?=$this->lang->line("size")?> </label>

                        <input type="text" value="<?=$experience['weight']?>" name="weight" id="weight" class="form-control"/>

                      </div>

                      

                      <div class="col-md-3">

                         <label>&nbsp;</label>

                        <?php

							$selected_grt = "";

							$selected_dwt = "";

							if($experience['satuan'] == "GRT")

							{

								$selected_grt = "selected='selected'";

							}

							else if($experience['satuan'] == "DWT")

							{

								$selected_dwt = "selected='selected'";

							} else if($experience['satuan'] == "m3"){

								$selected_m3 = "selected='selected'";

							} else if($experience['satuan'] = "TEU"){

								$selected_teu = "selected='selected'";

							}

						?>

                        <select name="satuan" class="form-control" >

                        	<option value="GRT" <?=$selected_grt?> >GRT</option>

                        	<option value="DWT" <?=$selected_dwt?> >DWT</option>

                        	<option value="m3" <?=$selected_m3?> > M&sup3;</option>

                        	<option value="TEU" <?=$selected_teu?>> TEU </option>

                        </select>

                      </div>

                      

                    </div>

                </div>

                

                <div class="form-group">

            		<label for="ship_type">

                    		<?=$this->lang->line("ship_type")?>

                    </label>

                    <info></info>

                    <select name="ship_type" id="ship_type" class="form-control" style="width:80%" >

                    

                    </select>

                  

            	</div>

                <div class="form-group">

                	<label for="rank_id">

                    		Rank

                    </label>

                   <select class="form-control" name="rank_id" id="rank_id" style="width:80%" >

                   

                    </select>

                     <script>

						$(document).ready(function(e) {

							

                            $.ajax({

							  url:'<?php echo base_url("seaman/resume/resume_data"); ?>', // menuju controller resume_data

							  type:'POST',

							  data: 'x=1&function=rank_json&id_department=<?php echo $resume['profile']['department']  ?>&curr_rank=<?php echo $experience['rank_id'] ?>',

							  success: function(data) {

								 

								  $("#rank_id").html(data);

							  }

							});

                        });

					

					

					</script>

                

                </div>

                <div class="form-group">

                	<label for="trade_area_line">

                    		<?=$this->lang->line("trade_area_line")?>

                    </label>

                    <input type="" title="" name="trade_area_line" id="trade_area_line" value="<?php echo $experience["trade_area"] ?>" class="form-control" style="width:80%" >

                

                </div>

                <div class="form-group">

                	<label for="company">

                    		<?=$this->lang->line("company")?>

                    </label>

                    <input type="" title="" name="company" id="company" data-id="id_company" class="form-control" value="<?php echo $experience["company"] ?>" style="width:80%" >

                

                </div>

                 <div class="form-group">

                	<label for="periode_from">

                    		<?=$this->lang->line("sign_on")?>

                    </label>

                    <input type="" title="" name="periode_from" id="periode_from" value="<?php echo $experience["periode_from"] ?>" data-id="periode_from" class="form-control" style="width:80%; background-color: white;" readonly >

                

                </div>

            	<div class="form-group">

                	<label for="periode_to">

                    		<?=$this->lang->line("sign_off")?>

                    </label>

                    <input type="" title="" name="periode_to" id="periode_to" value="<?php echo $experience["periode_to"] ?>" 
                    data-id="periode_to" class="form-control" style="width:80%; background-color: white;" readonly >

                

                </div>
				
                 <button class="btn btn-warning pull-left" onclick="call_report_form()" type="button" data-loading-text="Loading..."> &nbsp; 
                <b> <?=$this->lang->line("report_problem")?> </b></button>
                    
                <button class="btn btn-danger pull-right" data-dismiss="modal"> <span class="glyphicon glyphicon-remove-circle"></span>&nbsp; 
                <b> <?=$this->lang->line("cancel")?> </b> </button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-success pull-right" id="add-experience-btn" type="button" data-loading-text="Loading..."> 
                    <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; <b> <?=$this->lang->line("save")?> </b>
                </button>
                
                <span class="clearfix"></span>

            </form>

          </div>

        </div><!-- modal-body -->

        

    </div><!-- modal-content -->

  </div><!-- modal-dialog --> 

</div><!-- modal -->



<script>

	

	$("#periode_from").datepicker({

		dateFormat:"yy-mm-dd",

		changeMonth:true,

		changeYear:true,

		// yearRange: "-20:+0", // last hundred years

		// maxDate:0

		

	}).on('change', function () {
		var myVal = $(this).val();
		// alert(myVal);
        var minDate = new Date(myVal);
  
        $('#periode_to').removeClass('hasDatepicker').datepicker({
        	dateFormat:"yy-mm-dd",
        	changeMonth:true,
        	changeYear:true,
        	minDate : minDate

        });
    });

    // $("#periode_to").change(function () {
    // 	var minDate = new Date($(this).datepicker("getDate"));
    // 	alert(minDate);
    //         $('#periode_from').datepicker('setEndDate', minDate);
    // })


	$("#periode_to").datepicker({

		dateFormat:"yy-mm-dd",

		changeMonth:true,

		changeYear:true,

		// yearRange: "-30:+0", // last hundred years

		// maxDate:0,
		// minDate : periode_awal
		}).on('change', function () {
			var myVal = $(this).val();
			// alert(myVal);
	        var minDate = new Date(myVal);

	  		/* Pengecekan tidak lebih besar dari hari ini */
	        var x = new Date();
	        if(x > minDate) minDate = minDate;
	        else minDate = x;

	        $('#periode_from').removeClass('hasDatepicker').datepicker({
	        	dateFormat:"yy-mm-dd",
	        	changeMonth:true,
        		changeYear:true,
	        	maxDate : minDate
	        });
    });

	

	$(document).ready(function(e) {

        $("#modal-form-update-experience").modal({

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