<?php // left bar , menu vacantsea, module vacantsea  ?>

<script>
	
	$(document).ready(function(e) {
        $("#get_id_department").change(function(){			
			  $.ajax({
				  url:"<?php echo base_url("vacantsea/rank_ajax") ?>",
				  type: "POST",
				  data:"id_department=" + $(this).val(),
				  success: function(data) {
					  
						  $("#get_rank").html(data);
					  }	
			  });		
			
			
		});
		
		function search_vacantsea()
		{
			$.ajax({
				url:"<?php echo base_url("vacantsea/search_vacantsea"); ?>",
				type:"POST",
				data:$("#form-search-vacan").serialize()+"&x=1",
				success:function(data)
				{
					//alert(data);
					$("#list_vacantsea").html(data);
				}
			});
		}
		
		$("#btn-search").click(function(){
			//alert($("#form-search-vacan").serialize());
			
			search_vacantsea();
		});
		
		$("form-search-vacan").submit(function(){
			
			search_vacantsea();
			
		});
		
		$('#keyword').keydown(function(event){
		if(event.keyCode == 13) {
			//event.preventDefault();
			search_vacantsea();	
		  }
		});
		
		
    });
</script>

<div class="col-md-3">  
  <div id="left-bar" class="panel panel-default hidden-phone">
      <div class="panel-body">
      <?php 
        $this->load->view('left_profile'); ?>
      </div>
  </div> 
  
  <?php $this->load->view("content/menu-panel"); ?>
  
  <div id="left-bar" class="panel" style="margin:15px 0 0 0">
  	<div class="panel-heading bg-primary ">
    	<div class="panel-title">Search</div>
    </div>
    <div class="panel-body">
    <form role="form" id="form-search-vacan">
    	<div class="form-group"> 
        	<label for="keyword"> Keyword   </label>
    		<input type="text" value="<?php  ?>" name="keyword" id="keyword" class="form-control"/>
        </div>
        <div class="form-group">
        	<label for="sallary">Sallary  </label>
        	<select class="form-control" name="sallary" id="sallary">
            	<option value="">-Select-</option>
            	<option value="100-300">100 USD - 300 USD</option>
            	<option value="300-600">300 USD - 600 USD</option>
            	<option value="600-900">600 USD - 900 USD</option>
            	<option value="900">>900 USD</option>
            </select>
        
        </div>
        
        <div class="form-group">
        	<label for="ship_type"> Ship Type </label>
            <select class="form-control" name="ship_type" id="ship_type">
            	<option value="">-Select-</option>
            	<?php
                //$selected = "";
				foreach($ship_type as $row) { 
				
				?>
            	<option value="<?php echo $row['type_id'] ?>" <?php echo $selected = "" ?> ><?php echo $row['ship_type'] ?></option>
                <?php 
				} ?>
            </select>        
        </div>
        
        <div class="form-group">
        	<label for="departement"> Departement </label>
            <select class="form-control" id="get_id_department" name="get_id_department">
            	<option value="">-Select-</option>
            	<?php foreach($department as $row) { ?>
            	<option value="<?php echo $row['department_id'] ?>"><?php echo $row['department'] ?></option>
                <?php } ?>
            </select>
        
        </div>
        
        <div class="form-group">
        	<label for="rank">Rank</label>
        	<select class="form-control" name="get_rank" id="get_rank">
            	<option selected="selected" value="">-Select-</option>
            	<!--AJAX "LIST_RANK.PHP" -->
            </select>
            <script>
				$("#get_id_department").change(function(e)
				{ 
					var department_id = $(this).val(); 
					//alert(department_id);
					get_coc_class(department_id);
					get_rank(department_id); 
					
				});
				
				$(document).ready(function(e) {
                    var department_id = $("#get_id_department").val(); 
					//alert(department_id);
					get_coc_class(department_id);
					get_rank(department_id);
                });
				
				function get_rank(department_id)
				{
					$.ajax({
						
						type:"POST",
						url:"<?php echo base_url("vacantsea/get_rank"); ?>",
						data:"department_id="+department_id,
						success: function(data)
						{
					
							$("#get_rank").html(data);
						}
						
					});
				}
				
				
			</script>
        </div>
        
        <div class="form-group">
        	<label for="coc_class">COC Class</label>
            <select class="form-control" name="coc_class" id="coc_class">
            	<option value="">-Select-</option>
            	<?php foreach($coc as $row) { ?>
            	<option value="<?php echo $row['id_coc_class'] ?>"><?php echo $row['coc_class'] ?></option>
                <?php } ?>
            </select>
            <script>
			  function get_coc_class(department_id)
			  {
				 // alert("test:"+department_id);
				  $.ajax({
					  
					  type:"POST",
					  url:"<?php echo base_url("vacantsea/get_coc_class"); ?>",
					  data:"department_id="+department_id,
					  success: function(data)
					  {
						  //alert(data);
						  //alert(department_id);
						  $("#coc_class").html(data);
					  }
					  
				  });
			  }
			
			</script>
        
        </div>
        
        <div class="form-group pull-right">
        	<input type="hidden" value="search_vacant" name="page"  />
                    	
        	<button type="button" class="btn btn-success">
              <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"> <b>Save</b></span>
            </button>
            
            
        	<button type="button" class="btn btn-primary" id="btn-search">
              <span class="glyphicon glyphicon-search" aria-hidden="true" > <b>Search</b></span>
            </button>
        
        </div>
      </form>
    </div>
  </div>

 
  
</div>