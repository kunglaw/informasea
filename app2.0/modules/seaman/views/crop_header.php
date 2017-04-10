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

      

      <a href="#" onclick="" >

      <div class="icon-block icon-block-md btn-filled" id="btn-browse-crop">

          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>

          <span>Browse</span>

      </div></a>

      

    </div>

    <?php } ?>

    

    <form id="form-crop-cover" method="post" style="display:none" action="<?=base_url("photo/photo_crop/cropping")?>" enctype="multipart/form-data" >

      <input type="file" name="img_input" id="img_input" class="" />

      <input type="hidden" name="nama_gambar" value="<?php echo $cover['nama_gambar'] ?>" />

      <input type="hidden" name="photo_type" value="cover" />

      <input type="hidden" name="img_data" id="img_data" />

      <input type="hidden" name="img_src" id="img_src" />

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

    <img src="<?php echo $url_cover ?>" alt="picture" id="cover_img" height="200">

    

</div>

<span id="target-ajax-form"></span>

<span id="data_url"> data url </span>

<style>

	.btn-cover a div{

		position:relative !important;

		float:right;	

		margin-left:10px;	

		

	}

	

	#crop-header{

		width: 100%;

		height: 240px;

		overflow: hidden;

		z-index: 2;

		position: relative;	

		

	}

	

	#crop-header > #cover_img { width: 100%; top:0px; position:absolute }

	

	.guillotine-window{

		top:0px; position:absolute !important; 	

	}

</style>

<link href='<?=asset_url("plugin/guillotine/jquery.guillotine.css")?>' media='all' rel='stylesheet'>

<!-- <link href='demo.css' media='all' rel='stylesheet'> -->

<script src="<?=asset_url("plugin/guillotine/jquery.guillotine.js")?>"></script>

<script type="text/javascript">



function setData(dt)

{

	var widthN = $("#cover_img").prop("naturalWidth"); 

	var heightN = $("#cover_img").prop("naturalHeight");

	

	var tinggiN = parseInt(heightN);

	var tinggi = parseInt(dt.h);

	var yy = parseInt(dt.y);

	var hy = (yy*tinggiN)/tinggi; 

	

	var json = [

	  '{"x":' + dt.x,

	  '"y":' + dt.y,//parseInt(dt.y+(tinggi-565)),

	  '"height":'+ dt.h,

	  '"width":' + dt.w,

	  '"naturalWidth":' + widthN,

	  '"naturalheight":' + heightN,

	  '"rotate":' + dt.angle + '}'

	].join();	

	

	$("#img_data").val(json);

	$("#data_url").html(json);

	// alert(json);

}



function guillotine_run() {

	

  guillotine();

  var picture = $('#cover_img');

  

  // Make sure the image is completely loaded before calling the plugin

  picture.one('load', function(){

	// Initialize plugin (with custom event)

	picture.guillotine({eventOnChange: 'guillotinechange'});

	picture.guillotine('fit');



	// Display inital data

	var data = picture.guillotine('getData');

	/*for(var key in data) { 

		$('#'+key).val(data[key]);

	}*/

	

	// init set data

	setData(data);



	// Bind button actions

	/* $('#rotate_left').click(function(){ picture.guillotine('rotateLeft'); });

	$('#rotate_right').click(function(){ picture.guillotine('rotateRight'); });

	$('#fit').click(function(){ picture.guillotine('fit'); });

	$('#zoom_in').click(function(){ picture.guillotine('zoomIn'); });

	$('#zoom_out').click(function(){ picture.guillotine('zoomOut'); });*/



	// Update data on change

	picture.on('guillotinechange', function(ev, data, action) {

	  data.scale = parseFloat(data.scale.toFixed(4));

	  setData(data);

	  /* for(var k in data) 

	  { 

	  	

	  	$('#'+k).val(data[k]);  

	  }*/

	});

  });



  // Make sure the 'load' event is triggered at least once (for cached images)

  if (picture.prop('complete')) picture.trigger('load')

};





$(document).ready(function(e) {

	

    $("#btn-browse-crop").click(function(){

		$("#img_input").click();	

	});

	

	$("#btn-save-crop").click(function(){

		$("#submit_crop").click();

		

	});

	

	$("submit_crop").click(function(){

		alert("submit crop active ");

	});

	

	$("#img_input").change(function(event){

		$("#cover_img").attr('src',URL.createObjectURL(event.target.files[0]));

		

		//guillotine();

		guillotine_run();

		//naturalD();

	});

	

	/* $("#form-crop-cover").submit(function(){

		alert("submiiiiiittt");

	});*/

	

	//guillotine();

	//guillotine_run();

	

	var options = {

		

		target:"#target-ajax-form",

		contentType:"application/json",

		beforeSubmit:showRequest,

		success:showResponse	

		

	}

	$("#form-crop-cover").ajaxForm(options);

});

</script>