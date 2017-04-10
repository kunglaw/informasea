<?php // modal alert , module timeline ?>

<div class="modal fade modal-alert" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> <h4> Delete Confirmation <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4> </div>
      <div class="modal-body "> 
      <?php // $description terdapat $item 
	  // contoh setting : 
	  /*
	  	$item = "Item1";
		$description = "Are you sure want to delete $item ? ";
		

	  */
	  ?>
      Are You Sure to delete this Comment ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm pull-right" data-dismiss="modal" id="no-btn"> No </button>
        	<span style="margin:5px" class="pull-right"></span>
         <button type="button" class="btn btn-primary btn-sm pull-right" onclick="yes(<?=$id_timeline?>)" id="yes-btn"> Yes </button>
            
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
	function yes(idnya)
	{

		$.ajax({
			
			type:"post",
			url:"<?php echo base_url('timeline/delete_timeline') ?>",
			data:"id_tml="+idnya,
			success: function(data){
				swal("Your Timeline has been Deleted");
				$(".modal-alert").modal("hide");

				setTimeout(function () {
					// body...
					location.reload();
				}, 2000);
				
				//$(".timeline-content-"+id_tml).slideUp("slow");
				
				
			}
			
		});
		
	}
	
	$(document).ready(function(e) {
        $(".modal-alert").modal("show");
		
		
    });
</script>