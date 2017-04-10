<?php
/**
 * Created by PhpStorm.
 * User: Mohamad
 * Date: 5/5/2015
 * Time: 1:11 PM
 */
?>

<?php
	//$this->load->model("vacantsea/vacantsea_model");
	$this->load->model("company/company_model");
	$this->load->helper("text_helper");
	
	$sss = "SELECT vacantsea.*,
	perusahaan.id_perusahaan,
	perusahaan.tampil,
	perusahaan.activation_code 
	
	FROM vacantsea LEFT JOIN perusahaan ON 
	
	perusahaan.id_perusahaan = vacantsea.id_perusahaan 
	
	WHERE perusahaan.activation_code = 'ACTIVE' AND stat = 'open'   ORDER BY vacantsea_id DESC LIMIT 5";
	
	$qq 			 = $this->db->query($sss);
	$vacant 		 = $qq->result_array();
	
	//print_r($vacant);
	
if(!empty($vacant)){ 
?>
<div class="widget-box">
    <div class="text-gray widget-box-title"><?=$this->lang->line("new_vacantsea")?></div>
    <a href="<?=base_url("vacantsea")?>" class="text-link widget-box-seemore">See All</a>
    <div style="clear: both"></div>
    <?php
	foreach($vacant as $row)
	{
		if($row["id_perusahaan"] > 0)
		{
			$detail_comp = $this->company_model->get_detail_company($row['id_perusahaan']);
			$url_company = base_url("company/".$detail_comp['username']."/home");
		}
		else
		{
			$detail_comp = json_decode($row["data_scrap"],TRUE);
			$url_company = "#";	
		}
		
		$url_gambar = check_logo_agentsea_thumb($detail_comp['username']);
	?>
        <div class="media" title="<?php echo ucfirst($row['perusahaan'])." - ".$row['vacantsea']  ?>">
            <a class="pull-left small-img-container" href="<?php echo base_url() ?>">
                <img class="media-object img-responsive img-thumbnail" src='<?php echo $url_gambar ?>' alt="user-image" style="width:46px; height:46px">
            </a>
            <div class="media-body">
                <div class="text-link"><a href="<?php echo $url_company ?>"><?php echo ucfirst($row['perusahaan']); ?></a></div>
                <div class="subtitle">
                    <a href="<?php echo base_url("vacantsea/detail/".$row['vacantsea_id']); ?>"> 
                    <?php echo word_limiter($row['vacantsea'],3); ?> </a></div>
            </div>
        </div>
     <?php
		
	}
	?>
</div>
<?php } ?>