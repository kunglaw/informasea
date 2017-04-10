
<div class="container">
<?php
	//echo $this->session->userdata("lang");
?>
<form action="<?=base_url("testdimas/lang_process")?>" method="post">
	<div class="col-md-2 form-group">
    <?php
		$lang_session = $this->session->userdata("lang");
		if($lang_session == "english")
		{
			$selected_english = "selected=selected";
			$selected_indo = "";	
		}
		else
		{
			$selected_english = "";
			$selected_indo = "selected=selected";
		}
	?>
      <select name="lang" class="form-control">
          <option value="english" <?=$selected_english?> > English </option>
          <option value="indonesian" <?=$selected_indo?> >Indonesian</option>
      </select>
    </div>
    <div class="form-group col-md-2">
    <button class="form-control">Submit</button>
    </div>
    <span class="clearfix"></span>
</form>

<h2> <?=$hello?> </h2>
<hr>
<p><?=$this->lang->line("p1")?></p>
<p><?=$this->lang->line("p2")?></p>
<p><?=$this->lang->line("p3");?></p>

</div>
