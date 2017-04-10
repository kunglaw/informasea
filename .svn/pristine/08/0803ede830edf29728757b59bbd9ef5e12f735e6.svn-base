<?php
/**
 * Created by PhpStorm.
 * User: Mohamad
 * Date: 5/7/2015
 * Time: 10:48 AM
 */
    $isRatingEnabled = true;
?>

<?php
    
	for($y = 0; $y < 9; $y++) {              
              
?>
<div class="col-md-<?php echo $col; ?> seatizen-item-container" >
    <div class="media  <?php echo ($col == 1) ? 'box' : 'seatizen-item'; ?>">
        <div class="pull-left medium-img-container" href="#">
            <img class="media-object img-responsive" src='<?=base_url("assets/img/user.jpg"); ?>' alt="user-image">
        </div>
        <div class="media-body">
            <div class="subtitle text-link seatizen-role">  <i class="fa fa-certificate"></i> Second Machine Engineer</div>
            <div class="seatizen-name"><a href="#" class="text-Link">Eldorado</a></div>
            <div class="subtitle text-gray seatizen-years">10 years</div>
            <button class="btn btn-filled pull-left btn-custom-font"><i class="fa fa-plus"></i> Add as Friend</button>
            <?php if($isRatingEnabled) { ?>
                <div class="star-rating pull-right" style="display: inline-block">
                    <span class="fa fa-star" data-rating="1"></span>
                    <span class="fa fa-star" data-rating="2"></span>
                    <span class="fa fa-star" data-rating="3"></span>
                    <input type="hidden" name="whatever" class="rating-value" value="3">
                </div>
            <?php } ?>
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>
<?php
	} 
?>

