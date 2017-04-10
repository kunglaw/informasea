<?php
$username       = $company[0]['username'];
//cek profil pic company
if ($cek_profile->num_rows() > 0) {
  foreach ($cek_profile->result() as $row) {
  $nama_gambar  = $row->nama_gambar;
  $profil_pic     = img_url("company/photo/$username/profil_pic/$nama_gambar");
  }
}else{
  $profil_pic   = img_url("company/default/img_default.png");
}
?>
<div role="tabpanel" class="tab-pane active box" id="home">
    <div class="vacantsea-photos">
    <span class="clearfix"></span>
        <ul class="image-grid image-grid-5">
            <?php 
            foreach ($GetShips->result_array() as $rows) {
                $logo_img     = $rows["logo_image"];
                $username     = $rows['username'];
                $path_img     = img_url("company/photo/$username/ship/$logo_img"); //gambar dalam database
                $path_ls      = img_url("company/default/ship_default.jpg"); // gambar default

                $title        = $rows['ship_name'];
                // $datetime     = date("F d, Y H:i:s", strtotime($photo_company['datetime']));
                $datetime     = "Author : ".$rows['author'];
                $keterangan   = $rows['description'];
                ?>
                <li>
                <a href="<?=$path_ls;?>" data-toggle="lightbox" data-profil="<?=$profil_pic;?>" data-title="<?=$title;?>" data-tanggal="<?=$datetime;?>" data-footer="<?=$keterangan;?>" data-gallery="imagesizes">
                    <img src="<?=$path_ls;?>">
                </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<div class="pagination" style="float:right; margin-top:3%">
<ul>
    <?php echo $this->pagination->create_links(); ?>
</ul>
</div>