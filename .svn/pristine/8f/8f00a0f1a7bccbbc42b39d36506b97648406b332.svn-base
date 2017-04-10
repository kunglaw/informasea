<?php // seatizen panel , general, right panel ?>
<?php
$username = $this->session->userdata("username");
$this->load->model("seatizen/seatizen_model");
$this->load->model("photo/photo_mdl");
$dtseatizen = $this->seatizen_model->list_seatizen_notfriend($username);


?>

<?php
if(!empty($dtseatizen)){
?>
 <div id="" class="panel panel-default" style="margin-top:15px; ">
  
  <div class="panel-heading">
  <b> New Seatizen </b>
  </div>
  
  <div class="panel-body">
    <div class="">
    <?php
	foreach($dtseatizen as $row)
	{
		
		$b = $this->photo_mdl->get_photo_pp($row['username']);
		$ss = explode(".",$b['nama_gambar']);
		$url_gambar = base_url("assets/photo/$row[username]/profile_pic/$ss[0]"."_small.".$ss[1]);
		
		if($b['nama_gambar'] == "" || !is_file("assets/photo/$row[username]/profile_pic/$ss[0]"."_small.".$ss[1]))
		{
			 $url_gambar = base_url("assets/user_img/noprofilepic_small.png");	
		}
	?>
   	<div class="sbox row" >
    	<img src="<?php echo $url_gambar ?>" width="40" height="40" class="pull-left" style="border:1px solid #CCC" />
        <div class="pull-left" style="margin:0 0 0 10px" ><a href="<?php echo base_url("profile/$row[username]");?>"><b><?php echo ucfirst($row['nama_depan']." ".$row["nama_belakang"]); ?></b></a></div>
    
    </div>
    <?php
	}
	?>
 
</div>
  </div>
 
 </div>
<?php
}
?>



<style>
  .sbox {display:block; margin-bottom:10px;}
  .sbox img { }
  .sbox div { margin-bottom: 0 }
</style>