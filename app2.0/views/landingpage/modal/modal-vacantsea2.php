<style>
	.stepwizard-step p {
		margin-top: 10px;
	}
	
	.stepwizard-row {
		display: table-row;
	}
	
	.stepwizard {
		display: table;
		width: 100%;
		position: relative;
	}
	
	.stepwizard-step button[disabled] {
		opacity: 1 !important;
		filter: alpha(opacity=100) !important;
	}
	
	.stepwizard-row:before {
		top: 14px;
		bottom: 0;
		position: absolute;
		content: " ";
		width: 100%;
		height: 1px;
		background-color: #ccc;
		z-order: 0;
	
	}
	
	.stepwizard-step {
		display: table-cell;
		text-align: center;
		position: relative;
	}
	
	.btn-circle {
	  width: 150px;
	  height: 40px;
	  text-align: center;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
	
	form label.error, span.error
	{
		color:#F00;
		font-size:12px;
		
	}
</style>

<script src="<?=asset_url("plugin/jquery.validate/jquery.validate.js")?>" ></script>
<script src="<?=asset_url("plugin/jquery.validate/additional-methods.min.js")?>" ></script>

<div id="create-vacantsea-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content ">
      
      <div class="modal-body">
      		  
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step" style="">
                      <a href="#step-1" type="button" class="btn btn-lg btn-primary btn-circle" > Create Vacantsea </a>
                      
                  </div>
                  <div class="stepwizard-step">
                      <a href="#step-2" type="button" class="btn btn-lg btn-default btn-circle" disabled="disabled" > Register </a>
                      
                      
                  </div>
                  <div class="stepwizard-step">
                      <a href="#step-3" type="button" class="btn btn-lg btn-default btn-circle" disabled="disabled"> Finish </a>
                      <p></p>
                  </div>
                  
              </div>
             </div>
              
			  <form role="form" id="form-create-vacantsea" >
              <div class="row setup-content" id="step-1">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                      	<span class="info-vacantsea"></span>
                     
                            <div class="form-group">
                                <label class="control-label">Vacantsea Title</label>
                                <input maxlength="200" type="text"  
                                id="vacantsea_title"
                                name="vacantsea_title"
                                required="required" class="form-control"
                                placeholder="Enter Vacantsea Title" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Department</label>
                                <select name="department_id" id="department_id" class="form-control">
                                	
                                	<?php foreach($department as $row){ ?>
                                    	<option value="<?=$row['department_id']?>"><?=$row['department'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <script>
								$("#department_id").change(function(e)
								{ 
									var department_id = $(this).val(); 
									//get_coc_class(department_id,"<?=$profile['coc_class']?>");
									get_rank(department_id); 
									
								});
							</script>
                            <div class="form-group">
                                <label class="control-label">Rank</label>
                                <select name="rank" id="rank" class="form-control">
                                	
                                </select>
                            </div>
                            <div class="form-group">
                            	<label class="control-label">Vessel Type</label>
                                
                                <select name="ship_type" class="form-control">
                                	<?php foreach($ship_type as $raw){ ?>
                                	<option value="<?=$raw['type_id']?>"><?=$raw['ship_type']?></option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                            <div class="form-group">
                            	<label class="control-label"> Sallary </label>
                                <span class="clearfix"></span>
                                <select name="sallary_curr" class="form-control pull-left" style="width:15%">
                                	<option value="IDR">IDR</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="SGD">SGD</option>
                                </select>
                            	<input class="form-control pull-left has-error" name="annual_sallary" id="annual_sallary" style="width:50%" />
                                <select class="form-control pull-left" name="range_sallary" style="width:15%">
                                	<option value="/day">/Day</option>
                                    <option value="/month">/Month</option>
                                    <option value="/year">/Year</option>
                                </select>
                                <span class="clearfix"></span>
                            </div>
                            <p>* You can add more detail later</p>
                            <a></a>
                            <button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>&nbsp;
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">
                            Close 
                            </button>
                            <span class="pull-right">&nbsp; &nbsp;</span>
                            <small class="pull-right"><a href="<?=alpha_url("user/register")?>"> Register  </a> for free email address</small>
                          
                          <span class="clearfix"><br /></span>
                          
                        
                        
                      </div>
                  </div>
              </div>

              <div class="row setup-content" id="step-2">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                      	<span class="info-agentsea"></span>
                        
                          <div class="form-group">
                              <label class="control-label">Company Name</label>
                              <input name="agentsea_name" maxlength="100" type="text" required 
                              class="form-control" placeholder="Enter Company Name"  />
                          </div>
                          <div class="form-group">
                              <label class="control-label">Company Phone</label>
                              <span class="clearfix"></span>
                              <select class="form-control pull-left" name="ext_num" style="width:20%">
                              	<?php foreach($nationality as $rowi){ ?>
                                <option value="<?=$rowi["kode_telp"]?>&<?=$rowi['id']?>" label="test" >
                                	<?=$rowi["kode_telp"]?> - <?=$rowi["name"]?>
                                </option>
                                <?php } ?>
                                
                              </select> 
                              <span class="pull-left">&nbsp;</span>
                              <input maxlength="100" name="phone_number" style="width:77%" type="text" required 
                              class="form-control pull-left" placeholder="Enter Company Phone" />
                              <span class="clearfix"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Company Username</label>
                              <input name="username" id="username" maxlength="100" type="text" required class="form-control" placeholder="Enter Company Username"  />
                              <label id="info-username-agentsea" class="error"></label>
                              <div><small>"please fix this field" : username has been used </small></div>
                              <!-- <div><small> please use another username </small></div> -->
                          </div>
                          <div class="form-group">
                              <label class="control-label">Contact Person</label>
                              <input name="contact_person"  maxlength="100" type="text" required 
                              class="form-control" placeholder="Enter Contact Person"  />
                          </div>
                          <div class="form-group">
                              <label class="control-label">Email</label>
                              <input name="email" id="email"  maxlength="100" type="email" required 
                              class="form-control" placeholder="Enter Email"  />
                              <label id="info-email-agentsea" class="error"></label>
                              <div> <small>"please fix this field" : Either your email has been used or you are using free email service, which is not allowed. please use your company email instead. </small> </div>
                              <div> <small><a href="<?=alpha_url("user/register");?>"> Register </a> for free email address </small> </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Password</label>
                              <input name="password" id="password"  maxlength="100" type="password" 
                              required="required" class="form-control" placeholder="Enter password"  />
                          </div>
                          <div class="form-group">
                              <label class="control-label">Re-Enter Password</label>
                              <input name="re_password" id="re_password" maxlength="100" type="password" 
                              required="required" class="form-control" placeholder="Re-Enter Password"  />
                          </div>
                          
                          <button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
                          <button class="btn btn-default prevBtn pull-right" type="button" >Prev</button>
                          <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close"> Close </button>
                          <span class="clearfix"></span>
                          
                      </div>
                  </div>
              </div>
              
              <div class="row setup-content" id="step-3">
                  <div class="col-xs-12">
                      <div class="col-md-12 ">
                       	 
                         <center style="font-weight:bold">
                          <h3 style="color:#337AB7"><b> One step way to publish your vacantsea </b></h3>
                          
                          <h4 style="color:#337AB7"> Check your email to activate your account then let seatizens apply </h4>
                         </center>
                         
                         <span style="margin:20px"></span>
                        
                         
                         <center>
                         	<div class="bg-primary" style="width:200px; height:50px; 
                            line-height:50px; text-align:center">
                              <a href="" style="color:#FFF" id="email_provider" target="_blank" onClick="submit_finish()">
                              
                                  Activate Now
                                  
                              </a>
                            </div>
                         </center>
                         
                         <span style="margin:20px"></span>
                         
                         <center><p>* activation code will be available only for 1 hour </p></center>
                         
                          <span class="clearfix"></span>
                          <!-- <button class="btn btn-success pull-right" type="submit">Finish!</button> -->
                          <button class="btn btn-default prevBtn pull-right" type="button" >Prev</button>
                          <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close"> Close </button>
                          <span class="clearfix"></span>
                      </div>
                  </div>
              </div>
              </form>
          
		
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>


/* function insert_agentsea()
{
	
	//var ajax;
	
	$.ajax({
		type:"POST",
		data:$("#form-agentsea").serialize(),
		url:"<?=base_url("home/home_process/insert_agentsea")?>",
		//async:false,
		dataType:"JSON",
		error: function(err)
		{
			alert(err.responseText);
		},
		success: function(res)
		{	
			//alert(res.responseText);
			if(res.err == true)
			{
				$(".info-agentsea").html(res.err_message);
				alert("err");
			}
			else
			{
				$(".info-agentsea").html(res.success);
				alert("success");	
			}
		}
		
	});	
	
}

function insert_vacantsea()
{
	//var ajax; 
	
	$.ajax({
		type:"POST",
		data:$("#form-vacantsea").serialize(),
		url:"<?=base_url("home/home_process/insert_vacantsea")?>",
		//async:false,
		dataType:"JSON",
		error: function(err)
		{
			alert(err.responseText);
		},
		success: function(res)
		{	
			//alert(res.responseText);
			if(res.err == true)
			{
				$(".info-vacantsea").html(res.err_message);
				alert("err");
			}
			else
			{
				$(".info-vacantsea").html(res.success);
				alert("success");	
			}
		}
		
	});
	
} */

function get_rank(department_id)
{
	$.ajax({
		
		type:"POST",
		url:"<?php echo base_url("home/home_process/get_rank"); ?>",
		data:"department_id="+department_id,
		success: function(data)
		{
			$("#rank").html(data);
		}
		
	});
}

function submit_finish()
{
	$.ajax({
		type:"POST",
		url:"<?=base_url("home/home_process/create_vacantsea")?>",
		data:$("#form-create-vacantsea").serialize(),
		error: function(err)
		{
			alert(err.responseText);	
		},
		success: function(res)
		{
			
			//alert(res.responseText);
			//alert(res.toSource());
		}
	});
}

function get_data_agentsea()
{
	$.ajax({
		type:"POST",
		url:"<?=base_url("home/home_process/get_vacantsea")?>",
		error: function(err){
			alert(err.responseText);
			
		},
		success:function(res)
		{
				
		}
	})	
}

function validate_vacantsea(form)
{
	
	$(form).validate({
		
		rules:{
			vacantsea_title:{ // dari name element
				required:true	
			},
			department_id:{
				required:true	
			},
			annual_sallary:{
				required:true,
				number:true	
			},
			username:{ // dari name element
				required:true,
				remote:{
					url:"<?=base_url("home/home_process/check_username")?>",
					type:"post",
					data:{
						username:function()
						{
							return $("input#username").val();	
						}
							
					},
					error:function(err)
					{
						//alert(err.responseText);	
					},
					complete:function(res){
						
						
						$("#info-username-agentsea").css("display","inline");
						//$("#info-username-agentsea").html(res.responseText);
						
					}
					
				}	
			},
			//console.log("test");
			agentsea_name:{
				required:true	
			},
			contact_person:{
				required:true	
			},
			email:{
				required:true,
				email:true,
				remote:{
					url:"<?=base_url("home/home_process/check_email")?>",
					type:"post",
					data:{
						email:function(res)
						{
							return $("#form-create-vacantsea input#email").val();
						}
							
					},
					error:function(err)
					{
						//alert(err.responseText);	
					},
					complete:function(res)
					{
						//alert("bababa : "+res.toSource());
						//alert("res : "+res.msg);
						
						if(res.responseText == "false")
						{
							
						}
						
						$("#info-email-agentsea").css("display","inline");
						//$("#info-email-agentsea").html(res.responseText);
					}
					
				}
				
			},
			ext_num:{
				required:true	
			},
			phone_number:{
				required:true,
				number:true	
			},
			password:{
				required:true,
				minlength:6	
			},
			re_password:{
				
				required:true,
				equalTo:"#password"	
			}			
			
		},
		messages:{
			annual_sallary:{
				required:function()
				{
					$("#annual_sallary").closest(".form-group").addClass("has-error");
					
				},
				number:function()
				{
					$("#annual_sallary").closest(".form-group").addClass("has-error");
					
				}
					
			}
			
			
		}
			
		
	});
	
	var hasil = $(form).valid();
	
	return hasil;
}

/* function validate_agentsea(form)
{
	$(form).validate({
		
		rules:{
			username:{ // dari name element
				required:true,
				remote:{
					url:"<?=base_url("home/home_process/check_username")?>",
					type:"post",
					data:{
						username:function()
						{
							return $("input#username").val();	
						}
							
					},
					error:function(err)
					{
						alert(err.responseText);	
					},
					complete:function(res){
						
						$("#info-username-agentsea").html(res.responseText);
						
					}
					
				}	
			},
			//console.log("test");
			agentsea_name:{
				required:true	
			},
			contact_person:{
				required:true	
			},
			email:{
				required:true,
				email:true,
				remote:{
					url:"<?=base_url("home/home_process/check_email")?>",
					type:"post",
					data:{
						email:function(res)
						{
							return $("form#form-create-vacantsea input#email").val();
						}
							
					},
					error:function(err)
					{
						alert(err.responseText);	
					},
					complete:function(res)
					{
						alert("why ? ");
						$("#info-email-agentsea").html(res.responseText);
					}
					
				}
				
			},
			ext_num:{
				required:true	
			},
			phone_number:{
				required:true,
				number:true	
			},
			password:{
				required:true,
				minlength:6	
			},
			re_password:{
				
				required:true,
				equalTo:"#password"	
			}
			
			
		},
		messages:{
			email:{
				remote:"Email has been used"	
				
			},
			username:{
				remote:"Username has been used"	
				
			}
		}
			
		
	});
	
	var hasil = $(form).valid();
	
	return hasil;
}*/

$(document).ready(function(e) {
    
	$("#create-vacantsea-modal").modal({
		
		show:true,
		keyboard:false,
		backdrop:"static"
		
	});
	
	var department_id = $("#department_id").val();
	get_rank(department_id); 
	
	var navListItems = $('div.setup-panel div a'), // link
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
			allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
		
		var navListItems_attr = $(this).attr("href");
		
        var $target = $($(this).attr('href')), // #step-1 , #step-2
            $item   = $(this); // ini nav nya, current
			
		//change_modal_dialog(navListItems_attr);

        if (!$item.hasClass('disabled')) {
			
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide(); // content per form
            $target.show(); // hanya content yg current saja yg muncul 
            //$target.find('input:eq(0)').focus();
        }
		
		
    });

    allNextBtn.click(function(){
		
		// proses validasi
		// juga harus dilakukan disisi PHP
		//navListItems_attr = $(this).attr("href");
		//change_modal_dialog(navListItems_attr);
		
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
			
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			
            //curInputs = curStep.find("input[type='text'],input[type='url']"), // input yg divalidasi 
			
			isValid = false;
			$(".form-group").removeClass("has-error");
			
			
			var valid_vacantsea = validate_vacantsea("#form-create-vacantsea");
			//var valid_agentsea  = validate_agentsea("#form-create-vacantsea");
			
			if(valid_vacantsea == true)
			{
            	isValid = true;
			}
		
			/* for(var i=0; i<curInputs.length; i++){
				
				if (!curInputs[i].validity.valid){
					//isValid = false;
					//$(curInputs[i]).closest(".form-group").addClass("has-error");
				}
			}*/
		
		
			if (isValid)
			{
				// setelah valid barus bisa next
				nextStepWizard.removeAttr('disabled').trigger('click');
				
				if(nextStepWizard.attr("href") == "#step-3")
				{
					
					//submit_finish();
					
					$("#data_agentsea_name").html($("input[name=agentsea_name]").val());
					
					var em = $("#email").val();
					var spl = em.split("@");
					$("#email_provider").attr("href","http://www."+spl[1]);
					
				}
				
			}
			
    });
	
	allPrevBtn.click(function(){
		var navListItems_attr = $(this).attr("href");
		//change_modal_dialog(navListItems_attr);
		
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        $(".form-group").removeClass("has-error");
        prevStepWizard.removeAttr('disabled').trigger('click');
		
		
		
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
	
});


</script>