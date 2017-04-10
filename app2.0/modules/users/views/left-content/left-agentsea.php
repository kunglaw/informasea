<?php

/**

 * Created by PhpStorm.

 * User: USER

 * Date: 17/12/2015

 * Time: 15:50

 */

?>



<div class="col-md-6 text-white hidden-sm hidden-xs m-t-1">

    <h1><?=$this->lang->line("welcome_informasea")?> </h1>



    <div class="media">



        <div class="media-body">

            <h4> <?=$this->lang->line("manage_qualified_crew")?> </h4>

        </div>

    </div>



    <div class="media">

        <div class="pull-left">

            <img class="large-icon" src='<?= asset_url("img/ic_register_search.svg") ?>'

                 alt="company logo">

        </div>

        <div class="media-body">

            <div class="media-heading"><h4><?=$this->lang->line("search_crew")?></h4></div>

            <p>
				<?=$this->lang->line("search_crew_desc")?>
               

            </p>

        </div>

    </div>

    <div class="media">

        <div class="pull-left">

            <img class="large-icon" src='<?= asset_url("img/ic_register_managing.svg") ?>'

                 alt="company logo">

        </div>

        <div class="media-body">

            <div class="media-heading"><h4><?=$this->lang->line("managing_scheduling")?></h4></div>

            <p>

                <?=$this->lang->line("managing_scheduling_next")?>

            </p>

        </div>

    </div>



    <div class="media">

        <div class="pull-left">

            <img class="large-icon" src='<?= asset_url("img/ic_register_social.svg") ?>'

                 alt="company logo">

        </div>

        <div class="media-body">

            <div class="media-heading"><h4><?=$this->lang->line("posting_job")?> </h4></div>

            <p>

                <?=$this->lang->line("posting_job_desc")?>

            </p>

        </div>

    </div>

</div>