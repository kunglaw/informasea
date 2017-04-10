<?php // crop header ?>

<script>	
	function cancel_crop_cover()
	{
		//alert("test");
		var crop_header = $("#crop-header");
		
		$("#reset-form").click();
		location.reload();
	}
	
	/* function naturalD()
	{
		/* var image = new Image();
		image.src = $("#cover_img").attr("src");
		//alert('width: ' + $("#cover_img").prop("naturalWidth") + ' and height: ' + $("#cover_img").prop("naturalHeight"));
		
	} */ 
	
	
	
	function showRequest(formData, jqForm, options) { 
		// formData is an array; here we use $.param to convert it to a string to display it 
		// but the form plugin does this for you automatically when it submits the data 
		//var queryString = $.param(formData); 
	 
		// jqForm is a jQuery object encapsulating the form element.  To access the 
		// DOM element for the form do this: 
		// var formElement = jqForm[0]; 
	 
		//alert('About to submit: \n\n' + queryString); 
	 
		// here we could return false to prevent the form from being submitted; 
		// returning anything other than false will allow the form submit to continue 
		return true; 
	}
	
	// post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  { 
		// for normal html responses, the first argument to the success callback 
		// is the XMLHttpRequest object's responseText property 
	 
		// if the ajaxForm method was passed an Options Object with the dataType 
		// property set to 'xml' then the first argument to the success callback 
		// is the XMLHttpRequest object's responseXML property 
	 
		// if the ajaxForm method was passed an Options Object with the dataType 
		// property set to 'json' then the first argument to the success callback 
		// is the json data object returned by the server 
	 
		/* alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
			'\n\nThe output div should have already been updated with the responseText.'); */
	}  
</script>

<script type="text/javascript">

function reset_form_element (e) {
    e.wrap('<form>').parent('form').trigger('reset');
    e.unwrap();
}

function browse()
{
	$("form #img_input").click();	
}

function repositionCover() {
    $('.cover-wrapper').hide();
    $('.cover-resize-wrapper').show();
    //$('.cover-resize-buttons').show();
    //$('.default-buttons').hide();
    $('.screen-width').val($('.cover-resize-wrapper').width());
	
	$("input[name=img_src]").val($(".cover-resize-wrapper img").attr("src"));
	
	// HEIGHT IMAGE GAK BENER. STATIS.
	
	/* y1 	= $('.timeline-header-wrapper').height();
	width = $(".timeline-header-wrapper").width();
	y2 	= $('.cover-resize-wrapper').find('img').height(); 
	$("#default-width").val(width);
	$("#target-ajax-form").html("position:"+ui.position.top+" & height : "+y2+" & default-width = "+width);*/
	
    $('.cover-resize-wrapper img')
    .css('cursor', 's-resize')
    .draggable({
        scroll: false,
        
        axis: "y",
        
        cursor: "s-resize",
        
        drag: function (event, ui) {
			
            y1 	= $('.timeline-header-wrapper').height();
			width = $(".timeline-header-wrapper").width(); 
            y2 	= $('.cover-resize-wrapper').find('img').height();
			$("#default-width").val(width);
           
            if (ui.position.top >= 0) {
				
                ui.position.top = 0;
				
            }
            else
            if (ui.position.top <= (y1-y2)) {
				
                ui.position.top = y1-y2;
				
            }
        },
        
        stop: function(event, ui) {
			$('.cover-resize-wrapper').find('img').css("height","");
			$('.cover-resize-wrapper').find('img').css("left","");
			$('.cover-resize-wrapper').find('img').css("bottom","");
            $('input.cover-position').val(ui.position.top);
			$('input.image-height').val(y2);
			//$("#target-ajax-form").html("position:"+ui.position.top+" & height : "+y2+" & default-width = "+width);
        }
    });
}

function saveReposition() {
    
    if ($('input.cover-position').length == 1) {
		
        posY = $('input.cover-position').val();
        $('form.cover-position-form').submit();
		
    }
}

function cancelReposition() {
	$("#img-input").val("");
    $('.cover-wrapper').show();
    $('.cover-resize-wrapper').hide();
    //$('.cover-resize-buttons').hide();
    //$('.default-buttons').show();
    $('input.cover-position').val(0);
    $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');
	
	reset_form_element($('#img_input'));
}

reset_form_element($('#img_input'));

</script>

<div id="crop-header" style="display:none;">
	
    <?php if($reserve == true || $this->uri->segment(2) == "resume"){ ?>
    <div class="btn-cover">  
      
      <a href="#" onclick="javascript:cancel_crop_cover()" >
      <div class="icon-block icon-block-md btn-danger" id="btn-cancel-crop">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          <span>Cancel</span>
      </div></a>
      
        
      <a href="#">
      <div class="icon-block icon-block-md btn-success" id="btn-save-crop">
          <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
          <span>Save</span>
      </div>
      </a>
      
      <a href="#" onclick="browse()" >
      <div class="icon-block icon-block-md btn-filled" id="btn-browse-crop" >
          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
          <span>Browse</span>
      </div></a>
      
    </div>
    <?php } ?>
    
    <form id="cover-position-form" class="cover-position-form" method="post" style="display:none" enctype="multipart/form-data" >
      <input type="file" name="img_input" id="img_input" class="" value="" />
      <input type="hidden" name="default-width" id="default-width" value="" />
      <input type="text" name="nama_gambar" value="<?php echo $cover['nama_gambar'] ?>" />
      <input type="text" name="photo_type" value="cover" />
      <input type="text" name="img_data" id="img_data" />
      <input type="text" name="img_src" id="img_src" value="" />
      <input type="hidden" name="image-height" id="image-height" class="image-height" />
	  <input type="hidden" name="cover-position" id="cover-position" class="cover-position" > 
      <? //{"x":281.59999999999997,"y":76.80000000000001,"height":614.4,"width":460.8,"rotate":0} ?>
      <? /* {"x":180.52830188679246,"y":31.24528301886791,"width":849.5094339622641,"
	  height":637.132075471698,"rotate":0,"scaleX":1,"scaleY":1} */ ?>
      <? /* {"naturalWidth":1440,"naturalHeight":1080,"aspectRatio":1.3333333333333333,"width":509.49812385185203,"height":382.12359288888905,"left":0,"top":0} */ ?>
      
      <!-- <input id='x' name="x" type="text">
      <input id='y' name="y" type="text">
      <input id='w' name="width" type="text">
      <input id='h' name="height" type="text">
      <input id='scale' name="scale" type="text">
      <input id='angle' name="angle" type="text"> -->
      
      <input type="submit" name="submit_crop" id="submit_crop"  />
      <input type="reset" name="reset" id="reset-form" />

	</form>
    <div class="timeline-header-wrapper">

      <div class="cover-container">
	  
            <div class="cover-wrapper">
                <img src="<?php echo $url_cover_thumb ?>">
                <div class="cover-progress"></div>
            </div>
            
            <div class="cover-resize-wrapper">
                <img src="<?php echo $url_cover ?>" >
                <div class="drag-div" align="center">Drag to reposition</div>
                <div class="cover-progress"></div>
            </div>
    
      </div>
   </div>

</div>

<span id="target-ajax-form"> </span>
<span id="data_url"> </span>


<style>
	.btn-cover a div{
		position:relative !important;
		float:right;	
		margin-left:10px;	
		
	}
	
	#crop-header{ width: 100%;
		height: 240px;
		overflow: hidden;
		z-index: 2;
		position: relative; }
	
	
	/* #crop-header > .timeline-header-wrapper{ width: 100%; top:0px; position:absolute } */
	
	/*.guillotine-window{
		top:0px; position:absolute !important; 	
	}*/
</style>

<script>
$(function(){
	
	$("form #img_input").change(function(event){
		//alert("berubah");
		$(".cover-resize-wrapper img").attr("src",URL.createObjectURL(event.target.files[0]));
		//$("#img_src").removeAttr("value");
		repositionCover();
	});
 
	 
	 $("#btn-save-crop").click(function(){
		
		saveReposition();
		 
	 });
	 
    //$('.cover-resize-wrapper').height($('.cover-resize-wrapper').width()*0.3);

    $('form.cover-position-form').ajaxForm({
        url:  '<?=base_url("photo/photo_crop/cropping_cover")?>',
        /* dataType:  'json', */ 
        beforeSend: function() {
            $('.cover-progress').html('Repositioning...').fadeIn('fast').removeClass('hidden');
			$(".btn-cover").hide();
			$(".drag-div").hide();
        },
        
        success: function(responseText) {	
        	$('.cover-progress').html('Cover has been changed').fadeIn('fast').removeClass('hidden');		
        	location.reload();
			//$("#cover-position-form #img_input").removeAttr("value");
			//$("#cover-position-form").trigger("reset");
			show_modal_md("Crop Header",responseText);
			//document.getElementById("cover-position-form").reset;
			//
			
            /* if ((responseText.status) == 200) {
                $('.cover-wrapper img')
                    .attr('src', responseText.url + '?' + new Date().getTime())
                    .load(function () {
                        $('.cover-progress').fadeOut('fast').addClass('hidden').html('');
                        $('.cover-wrapper').show();
                        $('.cover-resize-wrapper')
                            .hide()
                            .find('img').css('top', 0);
                        $('.cover-resize-buttons').hide();
                        $('.default-buttons').show();
                        $('input.cover-position').val(0);
                        $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');
                    });
            }*/
			
			//location.reload();
        }
    });
});  
</script>