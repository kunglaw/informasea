<?php

/**

 * Created by PhpStorm.

 * User: USER

 * Date: 17/12/2015

 * Time: 16:00

 */

?>





<div class="col-md-6 text-white hidden-sm hidden-xs m-t-1">

    <h1><?=$this->lang->line("welcome_informasea")?></h1>



    <div class="media">

        <div class="media-body">

            <h4><?=INFORMASEA_DESC?></h4>

        </div>

    </div>



    <div class="media">

        <div class="pull-left">

            <img class="large-icon" src='<?= asset_url("img/ic_register_search.svg") ?>'

                 alt="company logo">

        </div>

        <div class="media-body">

            <div class="media-heading"><h4><?=$this->lang->line("search_vacantsea")?></h4></div>

            <p>

                
                <?=$this->lang->line("search_vacantsea_desc")?>

            </p>

        </div>

    </div>

    <div class="media">

        <div class="pull-left">

            <img class="large-icon" src='<?= asset_url("img/ic_register_social.svg") ?>'

                 alt="company logo">

        </div>

        <div class="media-body">

            <div class="media-heading"><h4><?=$this->lang->line("social_network")?></h4></div>

            <p>

                
                <?=$this->lang->line("social_network_desc")?>

            </p>

        </div>

    </div>



    <div class="media">

        <div class="pull-left">

            <img class="large-icon" src='<?= asset_url("img/ic_register_managing.svg") ?>'

                 alt="company logo">

        </div>

        <div class="media-body">

            <div class="media-heading"><h4><?=$this->lang->line("managing_schedule")?></h4></div>



            <p>
				<?=$this->lang->line("managing_schedule")?>
                

            </p>

        </div>

    </div>

</div>