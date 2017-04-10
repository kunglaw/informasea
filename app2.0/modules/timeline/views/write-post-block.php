
<?php 
/*	write-post-block , module timeline 
	
	untuk halaman profile, artinya hanya untuk teman
	
*/

	$username_login = $this->session->userdata("username");
	$username_uri = $this->uri->segment(2);
	$username_tujuan = $username_uri;
	if($username_uri == $username_login) $username_tujuan = "";
	// echo $username_login." == ".$username_uri;
?>

<form id="form_timeline" method="post" enctype="multipart/form-data" action="<?php echo base_url("timeline/insert"); ?>" >
  <div class="write-status-block">
      <div class="bullet-block">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
          <span> Write Something </span>
          <span class="progress pull-left" style="margin-left:20px"></span>
          <span id="info" class="label pull-right"></span>
      </div>
      <textarea name="timeline" class="timeline-input-to effect_enter" id="timeline" cols="30" rows="3" placeholder="What's happening today?"></textarea>
      <?php
        
        $ctrl = !empty($ctrl) ? $ctrl : "";
        
        if($ctrl == "" || $ctrl == "profile"){
            
            $to = "";
            
        }
        else if($ctrl == "detail" || $ctrl == "seatizen")
        {
            $to = $this->uri->segment(2);
            
        }
        
      ?>
      <input type="hidden" value="<?php echo $username_tujuan ?>" name="to" id="to" />
      <input type="file" value="" name="picture" id="picture" style="display:none" />
      <input type="hidden" value="1" name="x" id="x"/>
      <div class="bullet-block pull-left">
       
       <div onclick="javascript:document.getElementById('picture').click()" class="pull-left">
          <a style="text-decoration:none" href="#"> 
          	<span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Upload &nbsp; &nbsp; </a>
       </div>
       <span class="pull-left" id="pt-footer" style="margin-left:10px;"> </span>
       <!-- <div class="pull-left">
          <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Location</span>
       </div> -->
      </div>
      <button type="submit" id="submit-tml" class="btn btn-filled pull-right">Post</button>
      <div class="clearfix"></div>
  </div>
</form>

<script>
	  $("#picture").change(function(){
		  
		  $("#pt-footer").html($("#picture").val());
		 	
	  });
</script>

<script type="text/javascript">
	
	//alert('<?php echo $username ?>');
	/*function get_self_timeline()
	{
		//alert("get_self_timeline ... ");
		$.ajax({
			
			
			type : "POST",
			url : "<?php echo base_url("timeline/timeline/get_self_timeline"); ?>",
			data:"x=1&username=<?php echo $username ?>&ctrl=<?php echo $ctrl ?>",
			error:function(err)
			{
				alert(err.responseText);	
			},// username dari uri == username login 
			success : function(data)
			{
				//alert(data);
				//alert(" success get self timeline ");
				$("#list-timeline").html(data);	
			}
			
		});

	}
	
	function get_list_timeline()
	{
		$.ajax({
			
			
			type : "POST",
			url : "<?php echo base_url("timeline/timeline/get_list_timeline"); ?>",
			data:"x=1&username=<?php echo $username ?>&ctrl=<?php echo $ctrl ?>", // username dari uri == username login 
			success : function(data)
			{
				$("#list-timeline").html(data);	
			}
		});
		
	}*/
	
	$(document).ready(function(){
		$("#info").hide();
		/* $("#submit-tml").click(function () {
			// body...
			var data = $("#form_timeline").serialize()+"&x=1"; //timeline="+$("#timeline").val()+"&to="+$("#to").val(),
			$.ajax({
				data : data,
				url  : "<?php echo base_url('timeline/insert') ?>",
				type : "POST",
				success : function (argument) {
					// body...
					var hasilnya = argument.split('|');
					var container_hasil = $("#info");
					var username_login = "<?php echo $username_login ?>";
					var username_uri = "<?php echo $username_uri ?>";
					if(hasilnya[0] == "x") container_hasil.removeClass("label-success").addClass("label-danger");
					else{
						container_hasil.removeClass("label-danger").addClass("label-success");
						if(username_login == username_uri) get_self_timeline();
						else get_list_timeline_person();
					} 

					container_hasil.html(hasilnya[1]);
					container_hasil.show("fast");
					setTimeout(function () {
						// body...
						container_hasil.hide("fast");
					},3000);
					$("#pt-footer .clearfix").html("success");
					$("#pt-footer .clearfix").html("",2000);
					$(".write-status-block textarea#timeline").val("");
					$(".write-status-block textarea#timeline").html("");
					//alert("get_list_timeline start ...  ");
					// tidak jalan sampai sini 
					// get_list_timeline();
					//alert("get_list_timeline end ...  ");
					
					//alert("get_self_timeline end ... ");
				}
			})
		}); */
		
		$(".progress").css({"display":"none"});
		$(".progress").attr("hidden","true");

		var options = {
				  
			  target : "#info",
			  //data:"timeline="+$("#timeline").val()+"&to="+$("#to").val(),//$("#form_timeline").serialize(),
			  beforeSubmit:showRequest,
			  uploadProgress:up,
			  success:showResponse
	
		}
		 
		$("#form_timeline").ajaxForm(options); 
	 
		
	});
	
	function showRequest(formData, jqForm, options) { 
		//$("#loader").slideToggle("slow",function(){ });
		$("#info").html("<span class='label label-primary'> posting .   </span> ");
		$("#info").html("<span class='label label-primary'> posting ..  </span>");
		$("#info").html("<span class='label label-primary'> posting ... </span>");
		
		return true;
	} 
	 
	// post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  {
		// body...
		var hasilnya = responseText.split('|');
		var container_hasil = $("#info");
		var username_login = "<?php echo $username_login ?>";
		var username_uri = "<?php echo $username_uri ?>";
		if(hasilnya[0] == "x") container_hasil.removeClass("label-success").addClass("label-danger");
		else{
			container_hasil.removeClass("label-danger").addClass("label-success");
			if(username_login == username_uri) get_self_timeline();
			else get_list_timeline_person();
		} 

		container_hasil.html(hasilnya[1]);
		container_hasil.show("fast");
		setTimeout(function () {
			// body...
			container_hasil.hide("fast");
		},3000);
		$("#pt-footer").html("success");
		$("#pt-footer").html("",2000);
		$(".write-status-block textarea#timeline").val("");
		$(".write-status-block textarea#timeline").html("");
		//alert("get_list_timeline start ...  ");
		// tidak jalan sampai sini 
		// get_list_timeline();
		//alert("get_list_timeline end ...  ");
		
		//alert("get_self_timeline end ... "); 
		//alert("responseText = "+responseText);
		
		//$("#loader").slideToggle("slow",function(){ });
		//$("#pt-footer .clearfix").html("success");
		//$("#pt-footer .clearfix").html("",2000);
		//$(".write-status-block textarea#timeline").val("");
		//$(".write-status-block textarea#timeline").html("");
		//alert("get_list_timeline start ...  ");
		// tidak jalan sampai sini 
		//get_list_timeline();
		//alert("get_list_timeline end ...  ");
		//get_self_timeline();
		//alert("get_self_timeline end ... ");
	 
		/*alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
		'\n\nThe output div should have already been updated with the responseText.');*/
	}
	
	function up(event, position, total, percentComplete) 
	{   
		$(".progress").removeAttr("hidden");
		
	    var bar = $('.progress-bar');
		var percent = $('.sr-only');
	    //var status = $('#status');
		
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
		//console.log(percentVal, position, total);
    }

</script>