<?php $username= $this->session->userdata("username");?>
<span style="width:60%" align="left"><small><?=base_url("s/".$username)?></small></span>
<span style="width:300px"><?php
	
	for($x=1; $x<=73; $x++)
	{
		echo "&nbsp;";
	}

?></span>
<span style="width:30%" align="right"><small>as seen on <img src="<?php echo LOGO_INFORMASEA_32 ?>"></small></span>
<span style="clear:both"></span>