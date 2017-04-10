<?php

$username       = $company[0]['username'];
//cek profil pic company
/* $cek_profile  $cek_profile->num_rows();
if ($cek_profile > 0) {
  foreach ($cek_profile->result() as $row) {
  $nama_gambar  = $row->nama_gambar;
  $profil_pic     = img_url("company/photo/$username/profil_pic/$nama_gambar");
  }
}else{
  $profil_pic   = img_url("company/default/img_default.png");
} */

$photos = $photos->result_array();

?>
<?php if(!empty($photos)){ ?>
<div role="tabpanel" class="tab-pane active box" id="home">
	
    <div class="vacantsea-photos">
    <span class="clearfix"></span>
        <ul class="image-grid image-grid-5">
            <?php 
            	foreach ($photos as $photo_company) {
                $logo_img     = $photo_company["nama_gambar"];
                $username     = $photo_company['username'];
                $path_exists  = is_file("../infrasset/company/photo/$username/ship/$logo_img");

                if ($path_exists == "1") { // check image 
                  $path_img     = img_url("company/photo/$username/ship/$logo_img"); // for image dynamic
                }else{
                  $path_img      = img_url("company/default/ic_landing_company_blue.svg"); // for image default  
                }

                $title        = $company[0]['nama_perusahaan'];
                $datetime     = date("F d, Y H:i:s", strtotime($photo_company['datetime']));
                $keterangan   = $photo_company['keterangan'];
                // $path_exists  = is_file("../infrasset/company/photo/$username/ship/$logo_img");

                //   if ($path_exists == "1") { // check image 
                //     $path_img     = img_url("company/photo/$username/ship/$logo_img"); // for image dynamic

                //   }else{
                //     $path_img      = img_url("company/default/ic_landing_company_blue.svg"); // for image default  
                //   }
                ?>
                <li>
                <a href="<?=$path_img;?>" data-toggle="lightbox" data-profil="<?=$profil_pic;?>" data-title="<?=$title;?>" data-tanggal="<?=$datetime;?>" data-footer="<?=$keterangan;?>" data-gallery="imagesizes">
                    <img src="<?=$path_img;?>">
                </a>
                </li>
            <?php } 
			?>
        </ul>
        
    </div>
</div>
<?php }
	  else
	  {
		  echo "<p>- There is no photo </p>";	
	  }
?>

<div class="pagination" style="float:right; margin-top:3%">
<ul>
    <?php echo $this->pagination->create_links(); ?>
</ul>
</div>