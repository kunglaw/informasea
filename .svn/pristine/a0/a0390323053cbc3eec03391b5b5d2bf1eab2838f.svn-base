<?php $this->load->view('seatizen/css'); ?>

<div class="col-md-9">
    <div class="row filter">
        <form action="" method="POST" role="form" class="form-inline-custom" id="frm-search-agentsea">
            <div class="form-group col-lg-8 col-md-4 col-sm-4 col-xs-12">
                <input type="text" class="form-control" name="keyword" id="list-keyword" rows="1" placeholder="Search Company Name">
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <select class="form-control" name="nationality" id="list-nationality">
            
                </select>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
<!--                 <input type="submit" id="sbmt-agent" class="btn btn-primary form-control" value="Search">
 -->                                  <button type="submit" class="btn btn-primary form-control" id="sbmt-agent" name="search">Search</button>

            </div>
            <span class="clearfix"></span>
        </form>
    </div>
<div class="row">
        <div class="pull-left"><h4 class="text-gray">Agentsea List </h4></div>
        <div class="pull-right"><p class="demo demo4_top"></p></div>
    </div>
    <!-- Paging atas -->
    <div class="row vacantsea-list" id="listnya">
        <?php include_once("content-item.php");?>
    </div>

    <!-- Paging Bawah -->
    <div class="row my-pagination">
     
                <div class="pagination" style="float:right;">
                    <ul>
                <?php echo $pagination; ?>
                    </ul>
                </div>
    </div>

</div>
<?php $this->load->view("js_under");?>