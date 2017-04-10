<div class="panel-heading-vacantsea">
    <h2><b> Ships </b></h2>
   </div>
   <hr/>

<?php if(empty($ships))
{
  echo "<h4><b>Sorry this company doesn't have a Ship</b></h4>";
}
?>

<div class="row">

<?php

  foreach ($ships as $row) {

    if(!is_null($row['image_ship']) && $row['image_ship'] != "")
    {
      $type = $this->ship_model->get_ships_type($row['id_ship_type']);
      $gbr = explode('.', $row['image_ship']);
      $str_path = "company/photo/".$company['username']."/ship/$gbr[0]".".".$gbr[1];
    
      $url = pathup($str_path);
      $img_url = img_url($str_path);

    // if(!is_file($url))
    // {
    //   $str_path = "photo/$company_name/resume/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
    //   $url = pathup($str_path);
    //   $img_url = img_url($str_path);

    //   if(!is_file($url))
    //   {
    //     $str_path = "photo/$company_name/cover/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
    //     $url = pathup($str_path);
    //     $img_url = img_url($str_path);
    //     if(!is_file($url))
    //     {
    //       $str_path = "photo/$company_name/profile_pic/$nama_gambar[0]"."_thumb.".$nama_gambar[1];
    //       $url = pathup($str_path);
    //           $img_url = img_url($str_path);
    //     }
    //   }
    // }
  
?>

<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo $img_url ?>" alt="loading .... " >
      <div class="caption">
        <h4><b><?php echo $row['ship_name']; ?></b></h4>
        <?php echo $type['ship_type'] ?>
        <hr>
        <!-- <p><?php?></p> -->
        <p align="right"><a href="<?php echo base_url("company/ship_detail/".$row['id_perusahaan']."/".$title."/".$row['ship_id']) ?>" class="btn btn-primary" role="button">Show Detail</a></p>
      </div>
    </div>
  </div>


<?php }
} ?>
</div>