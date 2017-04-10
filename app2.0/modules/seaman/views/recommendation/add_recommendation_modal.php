<?php
	$profile = $resume['profile']; 
	$pelaut  = $resume['pelaut'];
	
	$profile_sender = $resume_sender["profile"];
	$pelaut_sender = $resume_sender["pelaut"];
	
	$fullname = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];
	$fullname_sender = $pelaut["nama_depan"]." ".$pelaut["nama_belakang"];
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
<div class="modal fade" id="add-recommendation-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="z-index:1000"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Give <?=$fullname?> a Recommendation</h4>
      </div>
      <form id="add-recommendation-form" class="" >
        <div class="modal-body center-block" style="width:80%">
          <div class="recommendation-temp"></div>
          	<input type="hidden" name="id_pelaut" id="id_pelaut" value="<?=$pelaut["pelaut_id"]?>">
            <input type="hidden" name="id_recommendation" id="id_recommendation" value="">
	
                <div class="form-group center-block" >
                        
                  <label for="department">
                      Your Department                    	
                  </label>
                  <select class="form-control" name="department" id="department" disabled>
                      <option value="" <?php if(empty($profile_sender['department'])){ echo "selected=selected"; }else{ echo ""; } ?>>
                      - <?=$this->lang->line("select")?>- Department -</option>
					  <?php
                          foreach($department as $row){
                              
                              $sd  = "";
                              if($profile_sender['department'] == $row['department_id'])
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
                       
                        get_rank(department_id,"<?=$profile_sender['rank']?>"); 
                        
                    });
      
                  </script>
                </div>
                
                <div class="form-group center-block">
                  <label> Your Rank</label>
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
              
             <hr>
            
            <div class="form-group center-block" >
              <label><?=$pelaut["nama_depan"]?> Sea Record</label>
              <select name="sea_record" id="sea_record" class="form-control">
                <?php
                    // experience dari controller 
                    foreach($experience as $rowe){ ?>
                    <?php
                        $ship_type   = $this->vessel_model->get_ships_type($rowe["ship_type_id"]);
                        $rank 		= $this->rank_model->get_rank_detail_byid($rowe["rank_id"]);
                        $total_exp   = $this->experience_model->total_experience_row($rowe["experience_id"]);
						
						$sign_on = date_format(date_create($rowe["periode_from"]),"M Y");
						$sign_off = date_format(date_create($rowe["periode_to"]),"M Y");
						
                    ?>
                    <option value="<?=$rowe["experience_id"]?>">
                            
                        <?=$ship_type["ship_type"]?> / <?=$rank["rank"]?> / <?=$rowe["company"]?> / 
                       <?=$sign_on?> - <?=$sign_off?>
                    </option>
                <?php }?>
              </select>
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
        $("#add-recommendation-modal").modal({
			show:true	
		});
    });
    
	<?php 
	$id_user = $this->session->userdata("id_user");
	if(!empty($id_user)){ ?>
	  var department_id = $("#department").val(); 
	  //get_coc_class(department_id,"<?=$profile_sender['coc_class']?>");
	  get_rank(department_id,"<?=$profile_sender['rank']?>"); 
	<?php } ?>
	
	//alert("work");
	
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
	
	
</script>