<?php //post-comment-timeline, module timeline   ?>

<?php
  
  // post comment , module seaman
  
  $this->load->model("users/user_model"); // dari module users 
  
  $username = $this->session->userdata("username");
  $id_user = $this->session->userdata("id_user");
  $nama = $this->session->userdata("nama");
  $user = $this->session->userdata("user");
  
  $url = check_profile_seaman($username);

?>

<div class="post-comment-block">
    <form id="form_comment_<?php echo $id_timeline; ?>">
    	<input type="hidden" value="<?php echo $id_timeline; ?>" name="id_timeline"   />
        <div class="form-group col-md-1 col-xs-2">
          <a class="pull-left small-img-container" href="#">
              <img class="img-responsive" src='<?= $url ?>' alt="user-image">
          </a>
        </div>
        <div class="form-group has-feedback col-md-9 col-xs-7">
            <label class="sr-only" for="exampleInputEmail3">Email address</label>
            <input type="text" autocomplete="off" name="post_content" class="form-control comment-this-tml" idnya="<?php echo $id_timeline ?>" id="post_content_<?php echo $id_timeline; ?>" placeholder="Write a comment">
            <!-- <i class="glyphicon glyphicon-camera form-control-feedback"></i> -->
        </div>
        <div class="form-group col-md-2 col-xs-3">
            <button class="btn btn-filled form-control" type="button" name="" id="post_it_<?php echo $id_timeline; ?>" 
            onClick="post_comment(<?php echo $id_timeline; ?>);" >Post</button>
        </div>
    </form>
    <span class="clearfix"></span>
</div>

<script>

  var users = function () {
        var tmp = null;
        $.ajax({
          async: false,
          type:"POST",
          data:"x=1",
          url:"<?=base_url("timeline/list_friend")?>",
          dataType:"json",
          global: false,
          'success': function (data) {
            tmp = data;
          }
        });
        return tmp;
      }();

  var enter = true;

	$('.comment-this-tml').suggest('@', {
            data: users,
            map: function(user) {
              return {
                
                value: user.username,
                text: '<img src="'+user.profile_pic+'" width="30" height="30" style="border:1px solid grey"> &nbsp; <strong>'+user.username+'</strong> <small>'+user.fullname+'</small>'
                
              }
            },
            onselect: function (x,item) {
              // body...
              enter = false;
              var suggest_value = item.value;
              $.ajax({
                url : "<?php echo base_url('timeline/self_detail') ?>",
                data: "username="+suggest_value,
                type: "POST",
                dataType:"json",
                success:function (output) {
                  // body...
                  check_and_change_input("<a href='#'>"+output.nama_depan+" "+output.nama_belakang+"</a>");
                }
              });
              
            }
          });
  check_and_change_input('abc');
  function check_and_change_input(changed_value) {
    // body...
    var element = $('.comment-this-tml');
    var val = element.val();
    if(val != "") {
      var id = element.attr("idnya");
      var new_val = $("#post_content_"+id).val();
      new_val = new_val.split(' ');
      
      // val_change = new_val[new_val.length-2];
    }
  }

	$("#post_content_<?php echo $id_timeline; ?>").keydown(function(e){
    if(enter){
      if(e.keyCode == 13) {
        e.preventDefault();
        post_comment(<?php echo $id_timeline; ?>);
        
      }
    }
    else {
      enter = true;
    }
    	
	});
    

</script>