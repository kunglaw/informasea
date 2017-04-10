<?php
	$profile = $resume['profile']; 
	$pelaut  = $resume['pelaut'];
	
	$fullname = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];
?>
<script>
	/* function update_recommendation_process(id_recommendation)
	{
		$.ajax({
			
			type:"POST",	
			url:"<?=base_url("")?>",
			data:"id_recommendation="+id_recommendation,
			success: function(dt)
			{
				$(".recommendation-temp").html(dt);
			}
			
		});	
	
	}*/

</script>
<div class="modal fade" id="add-recommendation-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit recommendation for <?=$fullname?></h4>
      </div>
      <form id="add-recommendation-form">
        <div class="modal-body center-block" style="width:80%">
          <div class="recommendation-temp"></div>
		  	
            <div class="form-group" >
            		<input type="hidden" name="id_pelaut" value="<?=$pelaut["pelaut_id"]?>">
                    <input type="hidden" name="id_recommendation" value="<?=$recommendation["id_recommendation"]?>" >
                    <label for="department">
                        <?=$pelaut["nema_depan"]?> Department                    	
                    </label>
                    <select class="form-control" name="department" id="department" disabled>
                    	<option value="" <?php if(empty($profile['department'])){ echo "selected=selected"; }else{ echo ""; } ?>>
                        - <?=$this->lang->line("select")?>- Department -</option>
                    <?php
                        foreach($department as $row){
                            
                            $sd  = "";
                            if($profile['department'] == $row['department_id'])
                            {
                                $sd = "selected='selected'";
                            }
                    ?>
                        <option value="<?php echo $row['department_id']; ?>" <?php echo $sd ?>><?php echo $row['department']; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <script>
                      $("#department").change(function(e)
                      { 
                          var department_id = $(this).val(); 
                         
                          get_rank(department_id,"<?=$recommendation['rank']?>"); 
                          
                      });
                      
                     
					 
                      
                    </script>
                  </div>
            
            <div class="form-group">
              <label>Rank</label>
              <select name="rank" id="rank" class="form-control" >
              </select>
            </div>
            <script>
                      
			  function get_rank(department_id,id_rank)
			  {
				  $.ajax({
					  
					  type:"POST",
					  url:"<?php echo base_url("seaman/resume/get_rank"); ?>",
					  data:"department_id="+department_id+"&id_rank="+id_rank,
					  success: function(data)
					  {
						  $("#rank").html(data);
					  }
					  
				  });
			  }
			  
			</script>
            
            <div class="form-group">
              	  <label for="potition"> Your Position </label>
                  <input type="text" name="position" id="position" class="form-control" value="<?=$recommendation["position"]?>" >
            </div>
            
            <div class="form-group" style="">
              <label> Recommendation </label>
              <textarea name="recommendation" class="form-control" id="recommendation" placeholder=""><?=$recommendation["recommendation"]?></textarea>
            </div>
          
        </div>
        <div class="modal-footer">
		  <div class="center-block" style="width:80%">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	
	$(document).ready(function(e) {
        $("#add-recommendation-modal").modal({
			show:true	
		});
    });
	
	var department_id = $("#department").val(); 
		//get_coc_class(department_id,"<?=$profile['coc_class']?>");
        get_rank(department_id,"<?=$profile['rank']?>"); 
	

	$("form#add-recommendation-form").submit(function(){
		$.ajax({
			
			type:"POST",
			url:"<?=base_url("seaman/recommendation/add_recommendation_process")?>",
			data:$(this).serialize(),
			dataType:"json",
			success: function(result)
			{
				
				$(".recommendation-temp").html(result.message);
			}
		
		
		}); return false;
		
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