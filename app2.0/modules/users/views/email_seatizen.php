                         <?php
	//$str_url;
	//$pelaut;$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$this->load->model('profile_resume_model');
	
?>
  <div style="background-color:#E8E8E8">
      <center>
      <table style="width:100%;max-width:800px;margin:20px auto;border-radius:7px;border-spacing:0;border-collapse:collapse" align="center">
          
          <tbody style="border-spacing:0;border-collapse:collapse">
          <tr style="height:23px;overflow:hidden">
              <td style="height:23px;overflow:hidden;background:#2ab8e7;border-radius:6px 6px 0 0;padding:0;margin:0">&nbsp;</td>
          </tr>
          
          
          <tr>
              <td style="width:auto;padding:20px 60px 15px;background:#2ab8e7;;border-bottom:3px solid #dedede">
                  <h1 style="margin:0;font-size:30px;font-family:'Trebuchet MS';line-height:1.1em">
                  	<a style="text-decoration:none;color:#2ab8e6" href="<?php echo base_url("home"); ?>" target="_blank">
                  		<img src="<?=asset_url('img/logo.png');?>">informasea</a></h1>
              </td>
  
          </tr>
          
          
          <tr>
              <td style="background:#fff;font-size:16px;font-family:'Open Sans',arial,sans-serif;padding:15px 60px;color:#7d7878">
  
                  
  
	  
                  <h3>Gabung dengan teman teman yang mungkin anda kenal dibawah ini.</h3>
  
  	
                  <div class="row">
  					<?php $col=6; $this->load->model('rank_model'); 
            $this->load->model('users/user_model'); 
            foreach($seatizen as $row){ 

  						$id = $row['pelaut_id'];
		$resume = $this->profile_resume_model->get_profile_resume($id);
		$annual_sallary = @$row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
		$rank = $this->rank_model->get_rank_detail($resume['rank']);
		$nationality = $this->nation_model->get_detail_nationality($row['kebangsaan']);
		$flag_name = strtolower($nationality['flag']);
		$flag = asset_url("flags/$flag_name");
		$img = $this->user_model->get_profile_pic($row['pelaut_id']);
		$nama = $row['nama_depan']." - ".$row['nama_belakang'];
		$a = explode(".",$img);
		$b = @$a[0]."_thumb.".@$a[1];
		
		if(empty($img) || !file_exists(pathup("photo/".$row['username']."/profile_pic/".$b))){ 
			$path_img = asset_url("img/ic_landing_seaman_blue.svg");
			
		} else {
			//$path_img = asset_url("img/user.jpg");
			$path_img = img_url("photo/".$row['username']."/profile_pic/".$b);
		}

  					 ?>

  					   <div class="col-md-<?php echo $col; ?> seatizen-item-container">
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>" style="min-height:176px">
        <div class="pull-left medium-img-container" href="#">
            <a href="<?=base_url("profile/".$row['username']."/resume") ?>"> 
            <img class="media-object img-thumbnail" src='<?=$path_img ?>' alt="user-image">
        </a>
        </div>
        <div class="media-body">
            <div class="seatizen-name">
               <a href="<?=base_url("profile/".$row['username']."/resume") ?>" class="text-Link"> 
			   <?php echo $row['nama_depan']."&nbsp;".$row['nama_belakang']; ?> </a>
            </div>
            <?php if(!empty($rank['rank'])){ ?> 
            <div class="subtitle text-link seatizen-role">
               <img src="<?=asset_url("img/star-small.png")?>" width="16" height="16" />
               <a href="<?=base_url("seatizen/search?rank=".$rank['rank']) ?>">
               <?php echo $rank['rank']; ?> </a> </div>
            <?php } ?>
		  	<?php if($flag_name != ""){ ?>
    		   <div class="subtitle text-gray seatizen-role"> 
               <span style="float:left;margin-right:10px;">
               	<img class="" src='<?=$flag; ?>' alt=" ">
                <a href="<?=base_url("seatizen/search/?nationality=".$row['kebangsaan'])?>"> <?=$row['kebangsaan'] ?></a>
               </span> 
            </div>
            <?php } ?>
			<div style="clear:both;"> </div>
<br />
			<input type="hidden" id="id_teman_<?php echo $row['pelaut_id']; ?>" value="<?php echo $row['pelaut_id']; ?>">
			
           
            <a class="btn btn-filled pull-left btn-custom-font" href="<?php echo base_url("profile/".$row['username']."/resume") ?>"> View Resume </a>
         
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>

  					<?php } ?>
  				</div>
              </td>
          </tr>

          <br>
          <tr>
          	<td style="background:#fff;width:100%;height:80px;"> 

          		<center>
          	 <a class="btn btn-lg btn-filled btn-custom-font" href="http://informasea.com/seatizen" target="_blank"> View All </a> </td>
        	</center>
        	<br>
        	<br>
          </tr>
           <tr>
          	<td style="background:#fff;width:100%;"> 


          	</td>
          </tr>
                    <tr>
<br>
          <br>
               <td style="background:#bdbdbd;padding:10px 60px;font-size:12px;font-family:'Open Sans',arial,sans-serif;color:#000;border-radius:0 0 6px 6px">
                  © 2015 informasea, All rights reserved.  | <a style="color:#000;text-decoration:none" href="mailto:info@informasea.com" target="_blank">info.informasea.com</a>
              </td>

              
          </tr>
          </tbody>
          
      </table>
      </center>
      <div class="yj6qo"></div><div class="adL"></div>
  </div>