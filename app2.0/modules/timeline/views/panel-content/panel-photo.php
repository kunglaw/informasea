<?php // panel-content/panel-photo , module timeline ?>
<?php
$this->load->module("timeline");

if($row['photo'] != "" ){
	
	$ss = explode(".",$row['photo']);
	if($row['type'] == "status")
	{
		$dimension = getimagesize(pathup("timeline/$row[username]/big/$row[photo]"));
		$new_dimension = $this->timeline->resize_dimension($dimension[0],$dimension[1]);
		$url_photo = img_url("timeline/$row[username]/big/$row[photo]");
		$respon_type = "responsive_img($new_dimension[width],$new_dimension[height],$row[id_timeline]);";
	}
	else if($row['type'] == "Photo")
	{
		$dimension_pt = getimagesize(pathup("photo/$row[username]/big/$row[photo]"));
		$new_dimension_pt = $this->timeline->resize_dimension($dimension_pt[0],$dimension_pt[1]);
		$url_photo = img_url("photo/$row[username]/big/$row[photo]");
		$respon_type = "responsive_img($new_dimension_pt[width],$new_dimension_pt[height],$row[id_timeline]);";
	}
	else if($row['type'] == "Resume")
	{
		$dimension_pt = getimagesize(pathup("photo/$row[username]/resume/$ss[0]"."_thumb.".$ss[1]));
		$new_dimension_pt = $this->timeline->resize_dimension($dimension_pt[0],$dimension_pt[1]);
		$url_photo = img_url("photo/$row[username]/resume/$ss[0]"."_thumb.".$ss[1]);
		$respon_type = "responsive_img($new_dimension_pt[width],$new_dimension_pt[height],$row[id_timeline]);";
	}
	else if($row['type'] == "profile_pic")
	{

		$dimension_pt = getimagesize(pathup("photo/$row[username]/profile_pic/$ss[0]"."_thumb.".$ss[1]));
		$new_dimension_pt = $this->timeline->resize_dimension($dimension_pt[0],$dimension_pt[1]);
		$url_photo = img_url("photo/$row[username]/profile_pic/$ss[0]"."_thumb.".$ss[1]);
		$respon_type = "responsive_img($new_dimension_pt[width],$new_dimension_pt[height],$row[id_timeline]);";
	}
	else if($row['type'] == "cover")
	{
		$dimension_pt = getimagesize(pathup("photo/$row[username]/cover/$ss[0]"."_thumb.".$ss[1]));
		$new_dimension_pt = $this->timeline->resize_dimension($dimension_pt[0],$dimension_pt[1]);
		$url_photo = img_url("photo/$row[username]/cover/$ss[0]"."_thumb.".$ss[1]);
		$respon_type = "responsive_img($new_dimension_pt[width],$new_dimension_pt[height],$row[id_timeline]);";
	}
}
?>
	
  <!--   <img class="img-responsive" src='<?=$url_photo?>' width="" height="" alt="" id="" style="border:1px solid #CCC"> -->
<?php
// $profil_pic 	= "Gambar Sitizen";
$title 			= "Aries Dimas Yudhistira ";
$datetime 		= date('d-F-Y H:i:s', strtotime($row['datetime']));
// $keterangan 	= $row['content'];

?>
    <a href="<?=$url_photo;?>" data-toggle="lightbox" data-profil="<?=$profil_pic;?>" data-title="<?=$title;?>" data-tanggal="<?=$datetime;?>" data-footer="<?=$keterangan;?>" data-gallery="imagesizes">
        <img src="<?=$url_photo;?>" class="img-responsive" width="" height="" alt="" id="" style="border:1px solid #CCC">
    </a>
  
    <p class="clearfix editable" id="editable-<?=$id_timeline?>">
       	<?php echo $row['content']; ?>
        <?php // content , komentar , status ?>
    </p>
    
    <script>
		<?php echo $respon_type; ?>
	</script>