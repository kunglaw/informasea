<?php
/*
 *
 * Created by PhpStorm.
 * User: a
 * Date: 12/06/2015
 * Time: 20:38
 */
$total_page = $total_vacant/5;
$view=1;
?>
<div class="col-md-9">
    <div class="row filter">
        <form action="" method="POST" role="form" class="form-inline-custom">
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <input id="key-vacant" type="text" class="form-control" name="" rows="1"
                       placeholder="Search Company Name or Job Title">
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <select class="form-control" id="get_department_vacant" name="get_department_vacant">
                    <option value="all salary"> Departments</option>
                    <!-- Rank Ajax List Here -->
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select class="form-control" id="get_rank_vacant" name="get_rank_vacant">
                    <option value="others">Ranks</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <select class="form-control" >
                    <option value="all salary"> Salaries</option>
                    <option value="0 - 500 USD"> 0-500 usd</option>
                    <option value="500 - 1000 USD"> 500-1000 usd</option>
                    <option value=">1000 USD"> >1000 usd</option>
                </select>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <a href="#" id="src-vacant-btn" class="btn btn-primary form-control">Submit</a>
            </div>
            <span class="clearfix"></span>
        </form>
    </div>
    <div class="row">
        <h4 class="text-gray">Vacantsea List (5)</h4>
    </div>
    <!-- Paging atas -->
    <div class="row my-pagination">
        <div class="pull-right">
            <a class="text-link first-data btn btn-primary" style="background-color: transparent" style="border-bottom: 1px" id="<?=$id_pertama?>" href="#">First</a>
            <a class="text-link prev-data btn btn-primary" style="background-color: transparent" id="<?=$id_pertama?>" href="#<?= $id_pertama ?>">Previous</a>
            <?php
            /* Menampilkan paging */
            if($total_vacant > 5) :
                for($x=0;$x<$total_page;$x++):
                    if($x==0) $class = "text-link disabled";
                    else $class = "text-gray"; ?>
                    <a class="btn btn-primary <?=$class?>" id="link-pg-<?=$x+1?>" style="background-color: transparent" href="#"><?=$x+1?></a>
                <?php
                endfor;
                ?>
                <a class="text-link next-data btn btn-primary" style="background-color: transparent" id="<?=$id_pertama?>" href="#<?= $id_pertama ?>">Next</a>

                <a class="text-link last-data btn btn-primary" style="background-color: transparent" id="<?=$id_paling_akhir?>" href="#">Last</a>
            <?php
            endif;
            ?>
        </div>
    </div>
    <div class="row vacantsea-list" id="listnya">
        <?php include_once("content-item.php");
        ?>
    </div>

    <!-- Paging Bawah -->
<!--    <div class="row my-pagination">-->
<!--        <div class="pull-left">-->
<!--            Go to page-->
<!--            <input class="goto-input" type="text">-->
<!--            <button class="btn-filled btn" type="submit"> Go</button>-->
<!--        </div>-->
<!--        <div class="pull-right">-->
<!--            <a class="text-link first-data" id="--><?//=$id_pertama?><!--" href="#">First</a>-->
<!--            <a class="text-link prev-data" id="--><?//=$id_pertama?><!--" href="#">Previous</a>-->
<!--            --><?php
//            /* Menampilkan paging */
//            if($total_vacant > 5) :
//            for($x=0;$x<$total_page;$x++):
//                if($x==0) $class = "text-link disabled";
//                else $class = "text-gray"; ?>
<!--                <a class="--><?//=$class?><!--" href="#">--><?//=$x+1?><!--</a>-->
<!--            --><?php
//            endfor;
//            ?>
<!--                <a class="text-link next-data" id="--><?//=$id_pertama?><!--" href="#">next</a>-->
<!--                <a class="text-link last-data" id="--><?//=$id_paling_akhir?><!--" href="#">last</a>-->
<!--            --><?php
//            endif;
//            ?>
<!--        </div>-->
<!--    </div>-->
</div>

<?php $this->load->view("js_under") ?>

