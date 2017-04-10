<?php //experience, page experience, profile, module user ?>
<style>
	
	.border1
	{
		border:1px solid black;
		margin-right:15px;
	}
	
	
	

</style>
<div class="box">

  <div class="box-header">

      <h4 class="box-heading header-text"> Print Fancy Resume </h4>
      <span class="clearfix"></span>

  </div>
  <div class="box-content">

    <span class="clearfix"></span>
		 <?php
			$str = "select * from cv_template ";
			$q = $this->db->query($str);
			$f = $q->result_array();
		?>
        <div class="" style=" width:100%;" align="center">
            <div class="row-centered" style="">
                <?php foreach($f as $row){ ?>
                <div class="col-md-2 border1 col-centered" id="<?=$row["id_cv_template"]?>" style="height:219px;"  data-toggle="tooltip" 
                title=" <img src='<?=asset_url("css/cv/$row[template]/$row[template].png")?>' width='150%' height='150%' style'display:inline-block; float:right' /> ">
                  
                  <a href="<?=asset_url("css/cv/$row[template]/$row[template].png")?>" target="_blank">
                   <img src="<?=asset_url("css/cv/$row[template]/$row[template].png")?>" width="100%" height="100%"> 
                  </a>
    
                </div>
                <?php } ?>
                
                <span class="clearfix" id=""></span>
            </div>
            <form method="post" action="<?=base_url("seaman/resume/print_process")?>">
              <div>
                 <?php foreach($f as $row){ ?>
                  <div class="col-md-2 col-centered">
                      <label> <input type="radio" name="cv_type" value="<?=$row["id_cv_template"]?>"> <?=$row["template"]?> </label>
                  </div>
                  <?php } ?>
                  <span class="clearfix"></span>
              </div>
              <br>
              <div>
                   <input type="submit" value="print" class="btn btn-primary" >
              </div>
            </form>
        </div>
        <div id="preview"></div>
	</div>
</div>
<style>
	.tooltip > .tooltip-inner {
	  border: 1px solid;	  
	 
	  
	  background-color: white;
	  background: white;
	   
	  opacity: 100 !important;
	  filter: alpha(opacity=100);
	} 
	
	.tooltip.in{opacity:1!important;}
	
	/* centered columns styles */
.row-centered {
    text-align:center;
}
.col-centered {
    display:inline-block;
    float:none;
    /* reset the text-align */
    text-align:left;
    /* inline-block space fix */
    margin-right:10px;
}
	
	/* .tooltip > .tooltip-arrow { border-bottom-color:black; } */

</style>
<script>
//$("#print1").load("https://www.informasea.com/cv/type1");
function view_img(id)
{
	var img_src = $("#id img").attr("src");
	
	$(".border1#"+id).hover(function() {
    	$(document).mousemove(function(event) {
			//$(".border1#"+id+" img").css({"position":"absolute","left":event.clientX ,"top":event.clientY }).show();    
			$("#preview").html("<img src='"+img_src+"' style='display:block'>");
			$("#preview").css({"position":"absolute","left":event.clientX ,"top":event.clientY }).show();
		});    
	});
	
	//$(document).bind("click",function(){
    	//$(document).unbind("mousemove");
    	//$(".border1#"+id+" img").hide();
	//});
	
}

$('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'right',
    html: true
	
});



//end movement with click on the div.

</script>