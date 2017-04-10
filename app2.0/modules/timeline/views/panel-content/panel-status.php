<?php // panel-content/panel-status, module timeline  ?>
<?php
	
	// di include ke list-timeline dan list-timeline-plus
$this->load->module("timeline");
?>

<?php $this->load->library("timeline_stuff"); ?>
<p style="font-size:14px">
	<?php
	
	if($row['photo'] != "" ){
		$ss = explode(".",$row['photo']);
		$dimension = getimagesize(pathup("timeline/$row[username]/big/$row[photo]"));
		$new_dimension = $this->timeline->resize_dimension($dimension[0],$dimension[1]);
		$url_photo = img_url("timeline/$row[username]/big/$row[photo]");
		$respon_type = "responsive_img($new_dimension[width],$new_dimension[height],$row[id_timeline]);";
	?>
	 <img src="<?php echo $url_photo ?>" class="img-responsive" />
    <?php
	}
	?>
    <br />
     
     <span class="editable" id="editable-<?=$row['id_timeline']?>">
	 <?php 
	    echo $this->timeline_stuff->result($row['content']); // content , komentar , status 
     ?>
     </span>
     <script>
		  
		  $("#edit-tml-btn-<?=$row["id_timeline"]?>").click( function(e){
			  
			  e.stopPropagation();
			   $("#editable-<?=$row['id_timeline']?>").editable({
			  	
				type:  'textarea',
				title: 'Enter Status',
				pk:"<?=$row['id_timeline']?>",
				highlight:"#fffff",
				/* ajaxOptions: {
					type: 'POST',
					//dataType: 'json',
					url:"<?=base_url('test/update_tml')?>",
					success:function(res)
					{
						alert(res);	
					}
				},*/
				url: function (param) {
					// body...
					return $.ajax({
						type: 'POST',
						// dataType: 'json',
						data: "dt="+JSON.stringify(param),
						async: true,
						url:"<?=base_url('timeline/update')?>",
						success:function(res)
						{
							alert("success");
							
						},
						error: function (xhr, textStatus, errorThrown) {
							// body...
							console.log('error bos : '+errorThrown+"\n"+textStatus);
						}
					});
				},
				complete:function()
				{
					$(this).editable('toggleDisable');	
				},
				// send: "always",
				mode: "inline"/*,
				error:function(err)
				{
					alert("errornya : "+err.responseText);	
				},
				success: function(res, newValue) {
				  alert("hasilnya "+newValue);
				  //alert(res.msg);
				  //alert(response.toSource());
				  //alert(response.toSource());
				   if(!response.success) return response.msg;
			    }*/
				
			  
		  	  });
			  $("#editable-<?=$row['id_timeline']?>").editable("toggle");
			  
		  });
	 </script>
     
</p>

 <script>
		<?php echo $respon_type; ?>
 </script>