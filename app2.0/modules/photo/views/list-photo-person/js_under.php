<?php // js_under , list-photo-person, photo_ajax, photo?>
<!-- list-photo-person-kunglaw -->
<script type="text/javascript">
    // $(document).ready(function(){

    // });

    var activeTab = null;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      activeTab = e.target;
      console.log(activeTab);
      if($(activeTab).attr('href') == "#resume") {
        $('#right-widget').addClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-12');
      } else {
        $('#right-widget').removeClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-9');
      }
    });

    /*function changeLayout() {
        $('#right-widget').addClass('hidden-md');
    }*/

    if($('#resume-tab').hasClass('active')) {
        alert('done deal!');
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });
</script>
		
<script>
	<!-- tooltip bro -->
	$('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
	<!-- popover bro -->
	$('#data-update[data-toggle="popover"]').popover({
		
		trigger: 'hover',
		'placement': 'top',
		animation:true,
		container:false,
		content:'',
		delay:1, // { "show": 500, "hide": 100 }
		html:true,
		//placement:'right',
		//'selector':'false',
		template:'<div class="popover col-md-4" style="border:1px solid #CCC" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
		//title:'',
		//viewport:{ selector: 'body', padding: 0 }
		
	});
  </script>
  <?php
 
	  $username_url = $this->uri->segment(2);
	  $this->load->model('seatizen/seatizen_model');
	  $check_username = $this->seatizen_model->check_seatizen($username_url);
	  
	  if(empty($check_username))
	  {
		  $username = $this->session->userdata("username");
	  }
	  else
	  {
		  $username = $username_url;  
	  }
  ?>
  <script>
	  // LOAD PHOTO
	  $(document).ready(function(e) {
		  get_photo_timeline('<?=$username?>'); 
		  get_photo('<?=$username?>'); // get list photo
		  get_album('<?=$username?>');	
	  });
  </script>
  
  <script>	  
	  
	  function get_photo(username)
	  {
		  $.ajax({
			  
			  url:"<?php echo base_url("photo/photo_ajax/get_photo_person") ?>",
			  type:"POST",
			  data:"x=1&username="+username,
			  error: function(){
				  
				  
				  //alert("terjadi kesalahan");
				  
			  },
			  success: function(data){
				  
				  $("#pphotos div").html(data);
	
			  }
			  
			  
		  });	
	  }
	  
	  function get_photo_timeline(username)
	  {
		  
		  $.ajax({
			  
			  url:"<?php echo base_url("photo/photo_ajax/get_photo_persontml") ?>",
			  type:"POST",
			  data:"x=1&username="+username,
			  error: function(){
				  
				  
				  //alert("terjadi kesalahan");
				  
			  },
			  success: function(data){
				  
				  $("#ptimeline div").html(data);
				  
			  }
			  
			  
		  });	
	  }
	  
	  function get_album(username)
	  {
		  $.ajax({
			  
			  url:"<?php echo base_url("photo/photo_ajax/get_album_person") ?>",
			  type:"POST",
			  data:"x=1&username="+username,
			  error: function(){
				  
				  
				  //alert("terjadi kesalahan di album");
				  
			  },
			  success: function(data){
				  
				  $("#palbums div").html(data);
			  }
			  
			  
		  });	
			  
	  }
  </script>

