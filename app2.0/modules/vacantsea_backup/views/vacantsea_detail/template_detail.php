<?php // template detail vacantsea ?>
    <div class="container-fluid">
        <div class="small-block">
            <a href="<?=base_url("vacantsea")?>" class="text-link"><span class="fa fa-reply"></span>&nbsp;Back to Vacantsea List </a>
        </div>
        <div class="row">
            <?php

            // left content
            //$this->load->view("content/vacantsea/left_content");

            // center content
            $this->load->view("vacantsea_detail/vacantsea-detail");

            // right content
            $this->load->view("right_content");

            ?>

        </div>
    </div>
<?php // end template ?>