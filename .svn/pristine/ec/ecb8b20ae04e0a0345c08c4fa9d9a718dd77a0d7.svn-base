<?php include("include/header.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="row filter">
                <form action="" method="POST" role="form" class="form-inline-custom">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <input id="search-company" type="text" class="form-control" name="" id="" rows="1"
                       placeholder="Search Company Name or Job Title">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-4">
                        <select class="form-control">
                            <option value="all salary"> All Salary</option>
                            <option value="0 - 500 USD"> 0-500 usd</option>
                            <option value="500 - 1000 USD"> 500-1000 usd</option>
                            <option value=">1000 USD"> >1000 usd</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-4">
                        <select class="form-control">
                            <option value="others">others</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                    <span class="clearfix"></span>
                </form>
            </div>
            <div class="row">
                <h4 class="text-gray">Vacantsea List (10)</h4>
            </div>
            <div class="row vacantsea-list">
                <?php include("include/vacantsea-list-item.php") ?>
            </div>
            <div class="row my-pagination">
                <div class="pull-left">
                    Go to page
                    <input class="goto-input" type="text">
                    <button class="btn-filled btn" type="submit"> Go</button>
                </div>
                <div class="pull-right">
                    <a class="text-link disabled" href="#">1</a>
                    <a class="text-gray" href="#">2</a>
                    <a class="text-gray" href="#">3</a>
                    <a class="text-gray" href="#">4</a>
                    <a class="text-gray" href="#">5</a>
                    <a class="text-link" href="#">next</a>
                    <a class="text-link" href="#">last</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 hidden-xs hidden-sm">
            <?php include("include/sponsor-box.php"); ?>
            <?php include("include/new-seatizen-box.php"); ?>
            <?php include("include/new-ship-box.php"); ?>
            <?php include("include/new-company-box.php"); ?>
            <?php include("include/new-vacantsea-box.php"); ?>
        </div>
    </div>
</div>
<?php include("include/footer.php") ?>
<script>

</script>