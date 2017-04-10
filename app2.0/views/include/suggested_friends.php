<?php //suggested friend ?>

<?php /* <script>

	function tes(id,friend,request,deletef,konfirm)
    {
        $("#btnaddfriend_"+id).hide();
        $("#btndelfriend_"+id).hide();
        $("#btnwaiting_"+id).hide();
        $("#btnconfirm_"+id).hide();

        //alert(id+"friend :"+friend+"req :"+request+"delete :"+deletef);
        if(friend){
        $("#btnaddfriend_"+id).show();
        $("#btndelfriend_"+id).hide();
        $("#btnwaiting_"+id).hide();
        $("#btnconfirm_"+id).hide();
       }else if(request){
        $("#btnaddfriend_"+id).css('display','none');
        $("#btndelfriend_"+id).hide();
        $("#btnwaiting_"+id).show();
        $("#btnconfirm_"+id).hide();
        // alert("#btnaddfriend_"+id);
       }else if(deletef){
        $("#btnaddfriend_"+id).hide();
        $("#btndelfriend_"+id).show();
        $("#btnwaiting_"+id).hide();
        $("#btnconfirm_"+id).hide();
       } else if(konfirm) {
        $("#btnaddfriend_"+id).hide();
        $("#btnwaiting_"+id).hide();
        $("#btndelfriend_"+id).hide();
        $("#btnconfirm_"+id).show();
       }
    //alert(id+" "+friend+" "+request+" "+deletef)
    }

   function addFriend(id){
        var id_teman = $("#id_teman_"+id).val();
        $.ajax({
            url : "<?php echo base_url("seatizen/seatizen_ajax/add_friend") ?>",
            data :"id_teman="+id_teman,
            type: "POST",
            success:function(data){
                //alert(data);
                    $("#btnaddfriend_"+id).hide();
                    $("#btnwaiting_"+id).show();
                    $("#btndelfriend_"+id).hide();
            }

        })

    }

   function terima_teman(id){
		var id_teman = $("#id_teman_"+id).val();
		$.ajax({
			url:"<?php echo base_url("seatizen/seatizen_ajax/terima_teman") ?>",
			data:'id_teman='+id_teman,
			type:"POST",
			success:function(data){
				//alert(data);
				$("#btnaddfriend_"+id).hide();
				$("#btnwaiting_"+id).hide();
				$("#btndelfriend_"+id).show();
				$("#btnconfirm_"+id).hide();
			}
		})
	}

   function deleteFriend(id){
        var id_teman = $("#id_teman_"+id).val();
		if(confirm("apakah anda ingin menghapus teman ini ? ")){
			$.ajax({
				url : "<?php echo base_url("seatizen/seatizen_ajax/delete_friend"); ?>",
				data: "id_teman="+id_teman,
				type:"POST",
				success:function(data){
				//    alert(data);
						$("#btnaddfriend_"+id).show();
						$("#btnwaiting_"+id).hide();
						$("#btndelfriend_"+id).hide();
				}
	
			});
		}

    }
	
   function batal_terima(id){
        var id_teman = $("#id_teman_"+id).val();
        $.ajax({
            url:"<?php echo base_url("seatizen/seatizen_ajax/batal_terima") ?>",
            data:'id_teman='+id_teman,
            type:'POST',
            success:function(data){
                $("#btnaddfriend_"+id).show();
                $("#btndelfriend_"+id).hide();
                $("#btnconfirm_"+id).hide();
                $("#btnwaiting_"+id).hide();
            }

        })
    }

   function batalrequest(id){
		var id_teman = $("#id_teman_"+id).val();
		//alert('aku disini');
		$.ajax({
			url : "<?php echo base_url("seatizen/seatizen_ajax/batalrequestfriend"); ?>",
			data: "id_teman="+id_teman,
			type:"POST",
			success:function(data){
			 //  alert(data);
					$("#btnaddfriend_"+id).show();
					$("#btnwaiting_"+id).hide();
					$("#btndelfriend_"+id).hide();   
			}
		})
	}
	
   function getAllDepartmentList()
   {
	   var s = "<?php echo $this->uri->segment(4) ?>";
	   var datanya = "idnya=<?php if(!empty($search_data['department'])) echo $search_data['department']; else echo '0' ?>";
	   
	   $.ajax({
			url:"<?php echo base_url("seatizen/list_department") ?>",
			type:"POST",
			data:datanya,
		   success: function(data) {
				$("#get_department_vacant").html(data);
			}
		});
		
		var x = $("#get_department_vacant").val();
		var rank = "<?php if(!empty($search_data['rank'])) echo $search_data['rank']; else echo '0' ?>";
		if(rank != 0) {
			var data_rank = "s="+s+"&id_department=" + x + "&idnya=" + rank;
			getAllRankList(data_rank);
		}
        
    }
    
  function getAllShipList() 
  {
	  var datanya = "idshipnya = <?php if(!empty($search_data['ship'])) echo $search_data['ship']; else echo '0' ?>";
	  $.ajax({
		  url:"<?php echo base_url("seatizen/list_ship") ?>",
		  type:"POST",
		  data:datanya,
		  success: function(data) {
			  $("#get_ship_vacant").html(data);
		  }
	  });
	  
  }

  function getAllNation(){
	  var datanya = "idnation = <?php if(!empty($search_data['nation'])) echo $search_data['name']; else echo '0' ?>";
	  $.ajax({
		  url:"<?php echo base_url("seatizen/list_nation") ?>",
		  type:"POST",
		  data:datanya,
		  success:function(data){
			  $("#get_nation_seatizen").html(data);
		  }
	  })
  }

  function getAllRankList(datanya){
		  $.ajax({
			  url:"<?php echo base_url("seatizen/list_rank"); ?>",
			  type:"POST",
			  data:datanya,
			  success:function(hasil){
				  $("#get_rank_vacant").html(hasil);
			  }
		  });
  }
  
  function getAllCocList(datanya){
	  $.ajax({
		  url:"<?php echo base_url("seatizen/list_coc"); ?>",
		  type:"POST",
		  data:datanya,
		  success:function(hasil){
			  $("#get_coc_class").html(hasil);
		  }
	  });
  }
  
  
   function deletefriend(id_friend){
	  //alert('aku disini');
	  var type_modal = "delete-friend-modal";
	  get_modal_friend(type_modal,id_friend);
  
   }
  
   function login(){
	  var type_modal = "modal-login";
	  get_modal_friend(type_modal,99999);
   }


</script> */ ?>
<div class="tmpa_modal"></div>
<div style="margin:20px 0 20px 0">
<?php ?>
</div>
<?php
	
	$arr = array("nationality","rank","all");
	$pelaut_id = $this->session->userdata("id_user");
	
	$dp = $this->user_model->get_detail_pelaut_byid($pelaut_id);
	$param = array("by"=>"","detail_pelaut" =>$detail_pelaut,"limit" => 6);
	$suggested_friends = $this->seatizen_model->suggested_friend($param);

?>
<div class="box">
  <div class="box-header">
  	<h3 class="box-heading header-text">Suggested Friends</h3>
      
    <span class="clearfix"></span>
  </div>
  
  <div class="box-content">
  <?php
  	if(!empty($suggested_friends))
	{
		foreach($suggested_friends as $row)
		{
			$a = $this->user_model->get_detail_pelaut_byid($row["pelaut_id"]);
			$c = $this->resume_model->get_profile_resume($row["pelaut_id"]);

			$s = $this->rank_model->get_rank_detail($c['rank']);
		   
			//$url_gambar = asset_url("img/user.jpg");
			$url_gambar = check_profile_seaman($a["username"]);
			
			$info_tambahan = isset($s['rank']) ? $s['rank'] : "";
			
			if($a['rank'] == 0)
			{
			  $kebangsaan = flag_nationality($a["kebangsaan"]);
			  $info_tambahan = $a['city']." , ".$kebangsaan; 
			  
			  if($a['kebangsaan'] == "" && $a['city'] == "")
			  {
				  
				 $info_tambahan = $a['gender'];  
			  }
			  
			  else if($a['city'] == "")
			  {
				  
				  $info_tambahan = $kebangsaan;	
			  }
			  
			}
  ?>
  
  	 <div class="col-md-4 seatizen-item-container" >
            <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="min-height:180px;">
                <div class="pull-left medium-img-container" href="#">
                    <img class="media-object img-thumbnail img-responsive" src='<?php echo $url_gambar; ?>' alt="user-image">
                </div>
                <div class="media-body">
                    
                    <div class="">
                    	<a href="<?=base_url("profile/$a[username]/resume")?>" class="text-link">
							<?php echo "".$a['nama_depan']." ".$a['nama_belakang'].""; ?> 
                        </a>
                    </div>
                    
                    <?php if(!empty($s['rank'])){ ?> 
                    <div class="subtitle text-link seatizen-role">
						<?php echo format_rank($c['rank']) ?>
                    </div>
                    <?php } ?>
                    
                    <div class="subtitle text-gray seatizen-years"><?php echo ucfirst($info_tambahan)  ?></div>
                    
                    <?php
					$id = $row['pelaut_id'];
					$id_user = $this->session->userdata('id_user');
					$array_teman = $a['array_teman'];
					$array_teman  = explode("|",$array_teman);
					$list_request = explode("|",$row['friend_request']);
					$list_terima  = explode("|",$row['receive_request']);
					
					if(!empty($id_user) AND empty($company)){
						
					   if($row['pelaut_id'] != $this->session->userdata('id_user')) {
		
						if(in_array($row['pelaut_id'],$array_teman)) {
							
							$visFriend 	= false;
							$visDelFriend = true;
							$visRequest   = false;
							$visConfirm   = false; 
							
						} else if(in_array($row['pelaut_id'],$list_request)){ 
						
							$visFriend    = false;
							$visDelFriend = false;
							$visRequest   = true;
							$visConfirm   = false;
							
						} else if(in_array($row['pelaut_id'],$list_terima)){
							
							$visFriend    = false;
							$visDelFriend = false;
							$visRequest   =  false;
							$visConfirm   = true;
					    }
						else { 
						
							$visFriend = true;
							$visDelFriend = false;
							$visRequest = false;
							$visConfirm = false;
				        } 
		
					   // echo "$id, $visFriend, $visRequest, $visDelFriend";
					 ?>
					<div class="btn-group dropup">
						<button type="button" class="btn btn-2x btn-info pull-left btn-custom-font dropdown-toggle" id="btnconfirm_<?php echo $id; ?>" data-toggle="dropdown">
						   Confirm
						</button>
                        
						<ul class="dropdown-menu" role="menu" style="z-index:1000;">
                        
						  <li style="z-index:1000;"><a onclick="terima_teman(<?php echo $id; ?>)"> Add as Friends </a> </li>
		  <!--          <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> Cancel Request </a> </li> -->  
						  <li style="z-index:1000;"><a onclick="batal_terima(<?php echo $id; ?>)"> Delete request </a> </li>
						
						</ul> 
					</div>
					<button class="btn btn-filled pull-left btn-custom-font" onclick="addFriend(<?php echo $id; ?>)" id="btnaddfriend_<?php echo $row['pelaut_id'];?>"><i class="fa fa-plus"></i> Add as Friend</button>
                    
					 <div class="btn-group dropup">
					 <button class="btn btn-success pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btnwaiting_<?php echo $id; ?>"> Waiting .. </button>
					 <ul class="dropdown-menu" role="menu">
						<li><a onclick="batalrequest(<?php echo $id; ?>)"> Cancel Request </a></li> 
					 </ul>
				 </div>
				 <div class="btn-group dropup">
						<button href="#" class="btn btn-2x btn-danger pull-left btn-custom-font dropdown-toggle" data-toggle="dropdown" id="btndelfriend_<?php echo $row['pelaut_id']; ?>">  Friend </button>
						  <ul class="dropdown-menu" role="menu">
							 <!-- <li><a href="#" data-toggle="modal" data-target="#modalDelete"> <i class="fa fa-minus"> </i> UnFriend </a> </li> -->
							 <li><a onclick="javascript:deletefriend(<?php echo $row['pelaut_id']; ?>)"> <i class="fa fa-minus"> </i> UnFriend </a> </li>
						  </ul>
				</div>
		
				  <?php  }//echo "tes('$id','$visFriend', '$visRequest','$visDelFriend');" ?>
					<?php } 
					else  if($id_user == "" AND empty($company))  { ?>
		
						<button class="btn btn-filled pull-left btn-custom-font" onclick="login()"> <i class="fa fa-plus"> </i> Add as Friend </button>
		
					<?php
					}
		
					 else { ?>
					<a class="btn btn-filled pull-left btn-custom-font" href="<?php echo base_url("profile/".$row['username']."/resume") ?>"> View Resume </a>
					<?php  }	
					?>
                   <!-- <?php if($isRatingEnabled) { ?>
                        <div class="star-rating pull-right" style="display: inline-block">
                            <span class="fa fa-star" data-rating="1"></span>
                            <span class="fa fa-star" data-rating="2"></span>
                            <span class="fa fa-star" data-rating="3"></span>
                            <input type="hidden" name="whatever" class="rating-value" value="3">
                        </div>
                    <?php } ?> -->
                    
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div> 
       	<script>
		tes('<?php echo $id; ?>','<?php echo $visFriend; ?>','<?php echo $visRequest; ?>','<?php echo $visDelFriend; ?>','<?php echo $visConfirm; ?>');
		</script> 
  <?php
		}
	}
	else
	{
		echo " - There is no Seatizen ";
	}
  ?>  
  <span class="clearfix"></span>	
  </div>
  
</div>

<?php /* <script>
 	 function get_modal_friend(type_modal,id_update)
     {
       //alert('tes');
       //var url = "<?php echo base_url("seatizen/seatizen_ajax/modal"); ?>";
       //alert(url);

            //var data = "x=1&modal="+type_modal+"&id_update="+id_update;
            //alert(data);
            
            $.ajax({
            
            type:"POST",
            data:"x=1&modal="+type_modal+"&id_update="+id_update,
            url:"<?php echo base_url("seatizen/seatizen_ajax/modal"); ?>",
            success: function(data){
             // alert(data);
                $(".tmpa_modal").html(data);
                
            }
            
            
            
        });
     }
</script> */?>


<?php // profiler(); ?>