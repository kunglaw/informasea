<?php // menu



$username 			= $this->uri->segment(2);

	

	$data  = $this->uri->segment(3);

	if($data == "home" OR $data == ""){

		$active_home = "active";

	} else if($data == "profile"){

		$active_profile = "active";

	} else if($data == "vacantsea"){

		$active_vacantsea = "active";

	} else if($data == "photos"){

		$active_photo = "active";

	}

?>



<ul class="nav nav-custom" role="tablist">

  <li role="presentation" class="<?=$active_home;?>"><a href="<?=base_url("agentsea/$username");?>"><?=$this->lang->line("home")?></a></li>

  <li role="presentation" class="<?=$active_profile;?>"><a href="<?=base_url("agentsea/$username/profile");?>">Profile</a></li>

  <li role="presentation" class="<?=$active_vacantsea;?>"><a href="<?=base_url("agentsea/$username/vacantsea");?>" ><?=$this->lang->line("vacantsea")?></a></li>

  <!-- <li role="presentation" class="active"><a href="<?=base_url("agentsea/$username/information");?>" >Information</a></li> -->

  <!-- <li role="presentation" class="<?=$active_photo;?>"><a href="<?=base_url("agentsea/$username/photos");?>" >Photos</a></li> -->

  <!-- <li role="presentation"><a href="<?=base_url("agentsea/$username/ships");?>" >Ships</a></li> -->

  <!-- <li role="presentation"><a href="<?=base_url("agentsea/$username/more");?>" >More</a></li> -->

</ul>