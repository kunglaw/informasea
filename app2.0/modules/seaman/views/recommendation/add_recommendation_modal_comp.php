<?php
	$profile = $resume['profile']; 
	$pelaut  = $resume['pelaut'];
	
	$fullname = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];

?>
<script>

	function load_check_recommendation()
	{
		//var id_pelaut_sender = "<?=$this->session->userdata("id_user")?>";
		var id_pelaut		= $("#id_pelaut").val();
		var sea_record	   = $("#sea_record").val();
		
		$.ajax({
			
			type:"POST",
			url:"<?=base_url("seaman/recommendation/load_check_recommendation")?>",
			data:"id_pelaut="+id_pelaut+"&sea_record="+sea_record,
			dataType:"JSON",
			success: function(dt)
			{
					
				$("#recommendation").html(dt.recommendation);
				$("#id_recommendation").html(dt.id_recommendation);
			}
			
		});	
		
	}
	
	load_check_recommendation();


</script>
<div class="modal fade" id="add-recommendation-modal-comp" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Give <?=$fullname?> a Recommendation</h4>
      </div>
      <form id="add-recommendation-form" method="post" >
        <div class="modal-body center-block" style="width:80%">
          <div class="recommendation-temp"></div>
          	  <input type="hidden" name="id_pelaut" id="id_pelaut" value="<?=$pelaut["pelaut_id"]?>">
             
              <div class="form-group center-block" >

                  <label for="department">
                      <?=$pelaut["nama_depan"]?> Department                    	
                  </label>
                  <select class="form-control" name="department" id="department" disabled>
                      <option value="" <?php if(empty($profile['department'])){ echo "selected=selected"; }else{ echo ""; } ?> >
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
                 
                </div>
                
                <div class="form-group center-block">
                  <label> <?=$pelaut["nama_depan"]?> Rank</label>
                  <select name="rank" id="rank" class="form-control" >
                  	<?php foreach($list_rank as $row){ ?>
                    
                    	<option value="<?=$row["rank_id"]?>"><?=$row["rank"]?></option>
                    <?php } ?>
                  </select>
                </div>
              
               <div class="form-group">
              	  <label for="potition"> Your Position </label>
                  <input type="text" name="position" id="position" class="form-control" >
              </div>
              
              
              <div class="form-group center-block" >
                <label> Recommendation </label>
                <textarea name="recommendation" class="form-control" id="recommendation" placeholder="write recommendation here ..."></textarea>
              </div>

        </div>
        <div class="modal-footer" style="">
          <div class=" center-block" style="width:80%">
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
        $("#add-recommendation-modal-comp").modal({
			show:true	
		});
    });
    
	

	
	$("form#add-recommendation-form").submit(function(){
		
		$.ajax({
			
			type:"POST",
			url:"<?=base_url("seaman/recommendation/add_recommendation_process")?>",
			data:$(this).serialize(),
			dataType:"JSON",
			success: function(result)
			{
				
				$(".recommendation-temp").html(result.message);
			}
		
		
		}); return false;
		
	});
	
	
</script>