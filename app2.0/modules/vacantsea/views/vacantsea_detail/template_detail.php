<?php // template detail vacantsea ?>

    <div class="container-fluid">

    

        <div class="small-block">

            <a href="<?=base_url("vacantsea")?>" class="text-link"><span class="fa fa-reply"></span>&nbsp;<?=$this->lang->line("back_to_vacantsea")?> </a>

        </div>

        <div class="row">

            <?php



            // left content

            //$this->load->view("content/vacantsea/left_content");

            // center content
			if($vacantsea["id_perusahaan"] != 0)
			{
            	$this->load->view("vacantsea_detail/vacantsea-detail");
			}
			else
			{
				$this->load->view("vacantsea_detail/vacantsea-detail-scrap");
			}

            // right content
            $this->load->view("right_content");

            ?>

        </div>

    </div>

<?php // end template ?>