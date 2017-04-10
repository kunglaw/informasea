<?php // modal alert , module timeline ?>

<div class="modal fade modal-alert" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> <h4> <?php echo $title ?> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4> </div>
      <div class="modal-body "> 
      <?php // $description terdapat $item 
	  // contoh setting : 
	  /*
	  	$item = "Item1";
		$description = "Are you sure want to delete $item ? ";
		

	  */
	  ?>
      <?php ?>
      <?php echo $description."<br>" ?>    
      
      </div>
      <div class="modal-footer">  
       
        <button type="button" class="btn btn-danger btn-sm pull-right" data-dismiss="modal" id="no-btn"> No </button>
        	<span style="margin:5px" class="pull-right"></span>
         <button type="button" class="btn btn-primary btn-sm pull-right" id="yes-btn" > Yes </button>
            
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<?php
	// seeting $arrdata
	// $arr = array(1 => "a" => 2 => "b");
	// $arrkeys = array_keys($arrdata);
	
	/*
	$i = 0; // itteration
	$hasil = ""; // definisi awal
		foreach($arr as $row )
		{
			$key = $arrkeys[$i];
			$data = $row[$i];
			$hasil .= "$key=$data&"; 
			
		}
		
		$arrdata = substr($hasil,-1);
	
	
	*/
	
?>

<script>
	function yes(id_vacantsea)
	{
		$.ajax({
			
			type:"post",
			url:"<?php echo base_url($url) ?>",
			data:"<?php echo $str_url ?>",
			success: function(data){
				
				$(".modal-alert").modal("hide");
				location.reload();
				//$(".timeline-content-"+id_tml).slideUp("slow");
				
				
			}
			
		});
		
	}
	
	$(document).ready(function(e) {
        $(".modal-alert").modal("show");
		
		$("#yes-btn").click(function(){ 
			
			yes(<?php echo $id_vacantsea ?>);
			
		})
    });
</script>