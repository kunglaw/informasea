<?php
// HALAMAN yang ingin di taruh Alert

// sedikit settingan
$arrdata['x'] 		= 1;
$arrdata['kampret']  = "kampret";
$arrdata['url']  	  = "welcome/test/modal_alert";
$arrdata['title']  	= "ini hanyalah test";
$arrdata['item']	 = "barang1";
$arrdata["description"] = "are you sure want to delete this motherfucker $arrdata[item] ? ";

$dtl = json_encode($arrdata);
//$datalist = json_decode($dtl,true);

//print_r($datalist);

$this->load->view('test/test-typehead');
?>
<!--<textarea style="width:500px; height:300px; background:#CCC; color:#000; text-align:left" disabled="disabled">
<script>
	var datalist = "<?php echo $datalist; ?>";
	$("#btn-alert").click(function(){
		$.ajax({
			type:"POST",
			data:datalist,
			url:"<?php echo base_url("test/modal_alert")?>",
			dataType:"json",
			success: function(data){
				
				$("#test-alert").html(data);
				
			}
		});
	});
</script>
</textarea>-->
<button class="btn btn-default" id="btn-alert"> Click Me </button>
<div id="test-alert">

</div>
<script>
	var datalist = <?php echo $dtl.""; ?>;
	$("#btn-alert").click(function(){
		$.ajax({
			
			type:"POST",
			data:datalist,
			url:"<?php echo base_url("test/modal_alert")?>",
			//dataType:"json",
			contentType:"application/json",
			success: function(data){
				$("#test-alert").html(data);
				
			}
		});
	});
</script>