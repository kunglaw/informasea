<?php // module timeline,  post-timeline ?>
<script src="<?php echo base_url("assets/js/jquery.form.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/jquery.autosize.min.js"); ?>" ></script>

<div class="write-status-block">
	<div class="bullet-block">
		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
		post-timeline, module timeline: Write Something
	</div>
    <form action="<?php echo base_url("timeline/insert"); ?>" id="form_timeline" method="post" enctype="multipart/form-data">	
      <textarea name="timeline" id="timeline" cols="30" rows="3" placeholder="What's happening today?"> post timeline </textarea>
      <?php
        
        $ctrl = !empty($ctrl) ? $ctrl : "";
        
        if($ctrl == "" || $ctrl == "profile"){
            
            $to = "";
            
        }
        else if($ctrl == "detail")
        {
            $to = $this->uri->segment(2);
            
        }
        
      ?>
      <input type="hidden" value="<?php echo $to ?>" name="to" id="to" />
      <input type="file" value="" name="picture" id="picture" style="display:none" />
      <input type="hidden" value="1" name="x" id="x"/>
      <div class="bullet-block text-link pull-left">
          <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Upload &nbsp; &nbsp;
          <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Location</span>
      </div>
      <button type="submit" class="btn btn-filled pull-right">Post</button>
    </form>
    <script>
	  $("#picture").change(function(){
		  
		  $("#pt-footer .clearfix").html($("#picture").val());
		 	
	  });
	</script>
	<div class="clearfix"></div>
</div>

<script>
function post_timeline()
{
	$.ajax({
		
		type:"POST",
		url:"",
		data:"x=1",
		success: function(){
			
			alert("bisa looooo");
			
		}
	
	});
}
</script>
<style>

	/*post_timeline*/
	
	#dashboard_timeline
	{
		padding-left:18px;
		padding-right:16px;
			
	}
	
	.effect_enter {
		-webkit-transition: height 0.2s;
		-moz-transition: height 0.2s;
		transition: height 0.2s;
	}
	  
	  #timeline{

		outline:none;
		width: 100%; 
		color:#000; 
		border:none; 
		resize:none;
		outline-offset:0;
		overflow:auto;
		  
	  }


</style>

<script type="text/javascript">
	
	$(document).ready(function(){
		
		 //$(".clearfix .progress").css({"display":"none"});
		 //$(".clearfix .progress").attr("hidden","true");
		 
		
		 /*$('#post_timeline').on('click', function () {
		  
		  // business logic...
		  
		  
		 
		})*/
	   
	   //var $btn = $("#post_timeline").button('loading');
	   var options = {
				
			target : "#info",
			//data:"timeline="+$("#timeline").val()+"&to="+$("#to").val(),//$("#form_timeline").serialize(),
			beforeSubmit:showRequest,
			uploadProgress:up,
			success:showResponse
  
	   }
	   
	   $("#form_timeline").ajaxForm(options); 
	   //$btn.button('reset');
	  
	   $("#timeline").autosize();
		
	});
	
	function showRequest(formData, jqForm, options) { 
		//$("#loader").slideToggle("slow",function(){ });
		//$("#pt-footer .clearfix").html("posting .");
		//$("#pt-footer .clearfix").html("posting ..");
		//$("#pt-footer .clearfix").html("posting ...");	
		
		/*if($("#timeline").val() == "" && $("#picture").val() == "")
		{ 
		   return false;
		}
		else
		{
			return true;
		}*/
		return true;
	} 
	 
	// post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  { 
			alert("responseText : "+responseText);
			
			//$("#loader").slideToggle("slow",function(){ });
			$("#pt-footer .clearfix").html("success");
			$("#pt-footer .clearfix").html("",2000);
			$("#timeline").val("");
			alert("get_list_timeline start....  ");
			get_list_timeline();
			alert("get_list_timeline bisa ");
	 
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