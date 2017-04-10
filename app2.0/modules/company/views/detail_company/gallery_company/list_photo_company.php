<!-- <span class="modal-alert-photo"></span> -->
<div class="panel-heading-vacantsea">
   	<h2><b> Gallery </b></h2>
   </div>
   <hr/>
<?php $this->load->helper("text");
	// $company_name = $this->session->userdata("company_name");
	
	if(empty($company_photo))
	{
		echo "You have no Photo yet";
	}
	
	foreach($company_photo as $row){
	
	$nama_gambar = explode(".",$row['nama_gambar']);

		
		$str_path = "photo/$company_name/thumbnail/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
		
		$url = pathup($str_path);
		$img_url = img_url($str_path);
		if(!is_file($url))
		{
			$str_path = "photo/$company_name/resume/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
			$url = pathup($str_path);
			$img_url = img_url($str_path);

			if(!is_file($url))
			{
				$str_path = "photo/$company_name/cover/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
				$url = pathup($str_path);
				$img_url = img_url($str_path);
				if(!is_file($url))
				{
					$str_path = "photo/$company_name/profile_pic/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
					$url = pathup($str_path);
			        $img_url = img_url($str_path);
				}
			}
		}
	?>
    


    <div class="subpic" id="subpic" style="margin-bottom:5px; margin-right:5px;">
    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">
      <img src="<?php echo $img_url; ?>" alt='error' style="width:150px; height:150px;" >
    </a>
      
      
      <!-- <div class="dropdown list-pic">
        <a href="#" class="dropdown-toggle btn btn-sm btn-default" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        	<span class="glyphicon glyphicon-list-alt" id=""></span>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Download</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="javascript:make_profile_picture(<?php //echo $row['id_pptr']?>)">Make Profile Picture</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="javascript:make_resume_picture(<?php //echo $row['id_pptr']?>)">Make Resume Photo</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" onclick="javascript:delpa(<?php //echo $row['id_pptr']?>)">Delete</a></li>
        </ul>
      </div> -->
      <!-- 
      <div class='description'>
              <! description content -->
              <!-- <p class='description_content'><?php //echo character_limiter($row['album'],10); ?></p> -->
              <!-- end description content -
      </div> -->
      </div>
    <!-- </div>	 -->
<?php
	}

?>

<div class="modal fade bs-example-modal-lg" id="modal-form-upload">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
       
        <h4 class="modal-title">Company Gallery</h4>
      </div>
      <form action="<?php echo base_url("photo/insert_photo") ?>" id="form-upload-photo" method="post"  enctype="multipart/form-data">
      
      <div class="modal-body">
      	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Example headline.</h1>
                    <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Another example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>One more for good measure.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
