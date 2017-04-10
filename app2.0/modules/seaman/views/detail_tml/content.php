<?php
$this->load->model('seaman/friendship_model');
?>

<span class="tml-modal-alert">

</span>
<style type="text/css">
/*pop up gambar*/
.modal-backdrop
{
    z-index:-1 !important;  
}
</style>

<?php // content 
$username     = $tml['username']; 
$username_url = $this->uri->segment(2);

if($username != "" && $username != $this->session->userdata("username")){
	
	$dtSeatizenSession = $this->seatizen_model->detail_seatizen($this->session->userdata("username"));
	$dtSeatizenUrl = $this->seatizen_model->detail_seatizen($username);

	$is_friend = $this->friendship_model->cekProfileFriends($dtSeatizenUrl['pelaut_id'], $dtSeatizenSession['pelaut_id']);
}
else $is_friend = true;

$url            = check_profile_seaman($tml['username']);
$cf             = $this->friendship_model->check_friends($tml['pelaut_id'],$pelaut_id_login); // cek pertemanan kalau ingin comment
$jml_komentar   = $this->comment_tml_model->jumlah_komentar($tml['id_timeline']);


?>

<div class="col-md-5 pull-right" id="timeline-content">
	
    <div class="timestamp-block"> <?php $dfb = date_format_db($tml['datetime']); echo since($tml['datetime']); ?></div>
	
    <div class="post-block">
    
		<div class="media">
			<a class="pull-left small-img-container" href="#">
				<img class="media-object img-responsive" src='<?php  echo $url; ?>' style="border:1px solid #CCC" alt="Media-Object">
			</a>
			<div class="pull-right">
			<button class="btn btn-sm btn-facebook" onclick="share_timeline()" id="share-this-timeline">share</button>
			<!-- <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" 
                href="https://www.facebook.com/sharer/sharer.php?app_id=1655530184684604&sdk=joey&u=<?=current_url()?>&display=popup&ref=plugin&src=share_button">
                
                <div class="btn btn-social btn-facebook ">
				  <span class="fa fa-facebook"></span>
				  Share <span class="count-box"></span>
				</div>
                
                </a> -->
				<!-- <i class=""> Share</i> -->
				<!-- <i class=""></i> -->
			</div>
			<div class="media-body">
				<p class="media-heading ">
               
                	<span class="text-link a-18">
						<?php echo $this->friendship_model->username_variation($tml['id_timeline']); ?>
                       
                    </span>
                		
                <br> <?=nl2br($tml['title'])?></p>
			</div>
		</div>
        
        <div id="panel-content">
         
          <?php
			
			$dt_panel['row'] = $tml;
		  	if($tml['type'] == "Photo" || $tml['type'] == "profile_pic" || $tml['type'] == "Resume" || $tml['type'] == "cover")
			{
				$this->load->view("timeline/panel-content/panel-photo",$dt_panel);
			}
			else
			{
				$this->load->view("timeline/panel-content/panel-status",$dt_panel);
			}
		  
		  ?>
        </div>
        
        <span class="clearfix"></span>
		<div class="pull-left">
          <div class="fb-like" data-href="<?=current_url()?>" 
          data-layout="button_count" 
          data-action="like" 
          data-show-faces="false" 
          data-share="false"></div> 
        </div> 
		
        <span class="pull-left"> &nbsp; &nbsp; </span>
        
		<a class="text-link pull-left" href="#" id="jumlah_komentarnya_<?php echo $tml['id_timeline']?>"> <?php echo $jml_komentar; ?> comment</a>
        <span class="clearfix"></span>
        <?php // comment block ?>
        
		<div id="list_comment_timeline_<?php echo $tml['id_timeline']?>"> 
        	
        </div>
	     
		<script>
			
              get_list_comment(<?php echo $tml['id_timeline']?>);
              // matiin dolo sementara, takut error 
			  /* setInterval(function () {
                  
                  get_list_comment(<?php //echo $row['id_timeline']?>);
				  
              }, 5000);*/
        </script>
        <?php
	
        //print_r($cf);												 // ubah expressi ini jika sudah ada fitur pertemanan
        if(($this->session->userdata("user") == "pelaut" && $is_friend)){
            $data['id_timeline'] = $tml['id_timeline'];
            $this->load->view('timeline/post-comment-timeline',$data);
        } 

        ?>
	</div>
</div>