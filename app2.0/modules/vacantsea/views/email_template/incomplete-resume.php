<div>
	<h2 style="font-size:36px; color:#337AB7"> Hello Applicant !</h2>
	<h4>Dear <?=$applicant["nama_depan"]." ".$applicant["nama_belakang"]?> , </h4>
    
    <div>
    	Thank you for choosing informasea.com as your partner.
		On <?=date("Y-m-d")?> our system detected that you have been applied to vacantsea below :
 
    </div>
    
   <ul>
    <?php if(!empty($vacantsea)){ //jika applicant list tidak kosong?>
	  <?php 
	  
	  		foreach($vacantsea as $row){ 
	  			
				$str2 = "SELECT * FROM rank WHERE rank_id = '$row[rank_id]' ";
				$q2   = $this->db->query($str2);
				$f2   = $q2->row_array();
				
				$str3 = "SELECT * FROM perusahaan WHERE id_perusahaan = '$row[id_perusahaan]'";
				$q3   = $this->db->query($str3);
				$f3   = $q3->row_array();
	  			
				//SCRAP
				$data_scrap = json_decode($row["data_scrap"],TRUE);
				
				$nama_perusahaan = $f3['nama_perusahaan'];
				if($f3["id_perusahaan"] != 0 )
				{
					$nama_perusahaan = $data_scrap["company"];
				}
				
				$url_title = url_title($row['vacantsea']);
	  ?>
          <li>
          	  <a href="<?=base_url("vacantsea/detail/$row[vacantsea_id]/$url_title")?>">
		  		<?=$row['vacantsea']?> / <?=$f2["rank"]?> / <?=$nama_perusahaan?> 
              </a>
          </li>
      <?php } ?>
    <?php } // jika applicant list kosong , maka mungculkan masa expired vacantseanya dan sediakan fitur untuk memperpanjang masanya  ?>
    </ul>
    
    <p>
    	<?=$f3['nama_perusahaan']?> has received a link to your resume in informasea.com and may download your CV right away.
    </p>
    
    <p> However, your resume has not complete yet. Do you need any help to complete your resume? </p>
    
    <p> Send us your CV, our admin will complete it for you. </p>
    
    <p> Do not worry about your password, its your privacy always. </p>
    
    <p> By completing resume, especially sea record, will give you more opportunity to get hired. </p>
    
    <p> Or click button below to complete your resume. </p>

 	<div style="
        background-color:#FF9900;
        width:350px;
        height:50px;
        
        margin-top:40px;
        margin-bottom:50px;
        display:inline-block;
        line-height:10px;
    ">
    
    <a href="<?=base_url("users/login")?>" style="text-decoration:none; text-align:center;" target="_blank">
        <!-- button --> 
        <h2 style="color:#FFF; vertical-align:middle">Update Resume</h2>    
    </a>
    </div>
    
</div>