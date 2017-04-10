<div>
  <p><h3> Dear Mr/s <?=$contact_person?>, </h3> </p> 
	<?php
		
		$str = "SELECT a . * , b.pelaut_id, b.rank
					FROM pelaut_ms a, profile_resume_tr b
					WHERE a.pelaut_id = b.pelaut_id
					AND a.username = '$applicant[username]' ";
		$q   = $this->db->query($str);
		$f   = $q->row_array();
		
		$str2 = "SELECT * FROM rank WHERE rank_id = '$f[rank]' ";
		$q2   = $this->db->query($str2);
		$f2   = $q2->row_array();
	
	?>
    <p> <div><a href="<?=base_url("profile/$applicant[username]")?>"> <b> <?=$applicant_name?> / <?=$f2["rank"]?> / <?=$experience?> </b> </a> has applied on 
    <a href="<?=base_url("vacantsea/detail/$vacantsea[vacantsea_id]")?>" ><b> <?=$vacantsea["vacantsea"]?> </b></a> </h3> 
    at <b> <?=date_format(date_create($applicant["datetime"]), "d M Y - H:i:s")?> </b></div>
     </p>
     
     <?php if(!empty($promotion)){?>
     <p>
     	<div> Promotion : </div>
     	<div> "<?=$promotion?>" </div>
     </p>
     <?php } ?>
     
    <p><b> Visit your dashboard to see all applicant and send them a message, or close this vacantsea. </b> </p>
    
    <center>
  	<div style="
              background-color:#FF9900;
              width:350px;
              height:50px;
              
              margin-top:40px;
              margin-bottom:50px;
              display:inline-block;
              line-height:10px;
          ">
          
          <a href="<?=$str_btn?>" style="text-decoration:none; text-align:center;" target="_blank">
              <!-- button --> 
              <h2 style="color:#FFF; vertical-align:middle">
              	<?php
					if(!empty($vacantsea["data_scrap"]))
					{
						echo "See Vacantsea";	
					}
					else
					{
						echo "See All aplicant";	
					}
				?>
              </h2>    
          </a>
          </div>
   </center>

</div>