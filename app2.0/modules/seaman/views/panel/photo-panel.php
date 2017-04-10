<?php //photo panel, profile, module seaman ?>

<?php

	$this->load->model("photo/photo_mdl");

	$username = $this->uri->segment(2);

	if(empty($username))

	{

		$username = $this->session->userdata("username");

	}

	

	// ASAL DATA

	$photo = $this->photo_mdl->photo_panel($username);



?>



<?php

if(!empty($photo)){

?>

<div class="widget-box">

    <div class="widget-box-header">

        <div class="text-gray widget-box-title"><?=$this->lang->line("photos")?></div>

        <a href="<?php echo base_url("profile/".$username."/photo") ?>" class="text-link widget-box-seemore">See All</a>

        <div style="clear: both"></div>

    </div>



    <ul class="image-grid image-grid-3">

    <?php

	foreach($photo as $row){

		

		$ss = explode(".",$row['nama_gambar']);

		

		//$url = base_url("assets/photo/$username/thumbnail/$ss[0]"."_thumb.".$ss[1]);

		$str_path = "photo/$username/thumbnail/$ss[0]"."_thumb.".$ss[1];

		$img_url = img_url($str_path);

		$path = pathup($str_path);

		

		if(!is_file($path))

		{

			$str_path = "photo/$username/resume/$ss[0]"."_thumb.".$ss[1];

			$path = pathup($str_path);

			$img_url = img_url($str_path);

			

			if(!is_file($path))

			{

				$str_path = "photo/$username/cover/$ss[0]"."_thumb.".$ss[1];

				$path = pathup($str_path);

			    $img_url = img_url($str_path);

				

				if(!is_file($path))

				{

					$str_path = "photo/$username/profile_pic/$ss[0]"."_thumb.".$ss[1];

					$img_url = img_url($str_path);

					$path = pathup($str_path);

					

				}

			}

		}

		

		else if(empty($row['nama_gambar']) || !is_file($url))

		{

			$url = asset_url("img/no-photo1_thumb.jpg");

		}

		

	?>

       <li>

       	<a href="<?php echo base_url("photo/detail/".strtolower($ss[0]).""); ?>">

			<img src="<?php echo $img_url; ?>" alt=''>

        </a>

       </li>

    <?php

	}

	?>



    </ul>

</div>

<?php

}

?>