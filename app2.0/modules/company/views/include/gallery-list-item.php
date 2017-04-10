<?php
$username       = $company[0]['username'];

?>

<ul class="image-grid image-grid-5">
<?php
if(!empty($photo))
{
	  foreach ($photo as $photo_company) {
		  
		$logo_img     = $photo_company["nama_gambar"];
		$username     = $photo_company['username'];
		
		$path_img     = "";
		$profile_pic  = "";
	  
		$title        = $company[0]['nama_perusahaan'];
		$datetime     = date("F d, Y H:i:s", strtotime($photo_company['datetime']));
		$keterangan   = $photo_company['keterangan'];
		
		?>
		<li>
		  <a href="<?=$path_img;?>" data-toggle="lightbox" data-profil="<?=$profil_pic;?>" data-title="<?=$title;?>" data-tanggal="<?=$datetime;?>" 		data-footer="<?=$keterangan;?>" data-gallery="imagesizes">
			  <img src="<?=$path_img;?>">
		  </a>
		</li>

<?php } 

}
else
{
	echo "<p> - there is no photo </p>";	
}
?>
</ul>