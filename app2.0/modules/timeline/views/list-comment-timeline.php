<?php //list-comment-timeline, module timeline ?>

<div class="comment-block">
	
	 
      
      <?php
		  foreach($comment as $row)
		  {
			  
			 $img_profile = check_profile_seaman($row['username']);
      
	  ?>
      
      <div class="media comment-item">
          <a class="pull-left small-img-container" href="#">
              <img class="media-object img-responsive" src='<?php  echo $img_profile; ?>' style="border:1px solid #CCC" alt="user-image">
          </a>
          <div class="media-body">
              <div>
                  <a href="<?php echo base_url("profile/".$row['username']); ?>" class="media-heading pull-left">
                  		<b><?php echo $name = $this->timeline_model->get_realname($row['username']);  ?></b>
                  </a>
                   <span class="pull-right small-subtitle">
                   		<i class="glyphicon glyphicon-align-justify" onClick="delete_comment()"></i>
                   </span>
                  <span class="pull-right small-subtitle">
				  	<?php echo date('H:i', strtotime($row['datetime'])) ?> 
                  	&nbsp;
                  </span>
                 
                  <span class="clearfix"></span>
              </div>
              <p><?php echo $row['content']?></p>
          </div>
      </div>
      
      <?php
		  }
	  ?>
      
      <?php if(count($comment) > 5){ ?>
      <!-- <div class="comment-details">
          <a href="">View 5 more comment..</a>
      </div> -->
      <?php }  ?>
      
</div>

