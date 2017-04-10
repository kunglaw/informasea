<?php // list-timeline-plus ?>

<?php
$this->load->model('seaman/friendship_model');
?>

<span class="tml-modal-alert"></span>

<script type="text/javascript">
    $('.load_data').click(function() {

        var id_timeline = $(this).attr("id");
        var jml_setting = $("#setting").attr("class");

        <?php

        // variable penting
        $username_url = $this->input->post('username');
        $username_login = $this->session->userdata('username');
        $pelaut_id_login = $this->session->userdata("id_user");
        $ctrl = $this->input->post('ctrl'); // menentukan view detail atau profile

        $cf = $this->friendship_model->show_friend($pelaut_id_login);
         ?>

        var nn = "<?php echo $ctrl; ?>";
        var username_url = "<?php echo $username_url; ?>";
        var username_login = "<?php echo $username_login; ?>";

        if(nn == "profile" && (username_url == username_login))
        {
            url_address = '<?php echo base_url('timeline/timeline/get_self_timeline_plus')?>';
        }
        else if(nn == "detail" && (username_url != username_login))
        {
			// url_address = '<?php echo base_url('timeline/timeline/get_self_timeline_plus')?>';
            url_address = '<?php echo base_url('timeline/timeline/get_person_timeline_plus')?>';
        }
        else
        {
            url_address = '<?php echo base_url('timeline/timeline/get_list_timeline_person_plus')?>';
        }
		
        // alert("id_timeline="+ id_timeline +"&jml_setting="+jml_setting+"&x=1&ctrl="+nn+"&HALAMAN = list_timeline ");

        if(id_timeline != 9999){

            $.ajax({
                type: "POST",
                url: url_address,
                data: "id_timeline="+ id_timeline +"&jml_setting="+jml_setting+"&x=1&ctrl="+nn+"&username="+username_url,
                beforeSend:  function() {
                    $('span.load_data').append('<img src="<?php echo base_url("assets/img/facebook_style_loader.gif"); ?>" />');
                },
                success: function(html){
                    $(".style_fb").remove();
                    $("div#list-timeline").append(html); //ganti
                },
                error:function()
                {
                    alert("terjadi kesalahan");
                }
            });
        }
        return false;
    });
</script>

<?php
	$username_url = $this->uri->segment(2);

	if($username != "" && $username != $this->session->userdata("username")){
		$dtSeatizenSession = $this->seatizen_model->detail_seatizen($this->session->userdata("username"));
		$dtSeatizenUrl = $this->seatizen_model->detail_seatizen($username);

		$is_friend = $this->friendship_model->cekProfileFriends($dtSeatizenUrl['pelaut_id'], $dtSeatizenSession['pelaut_id']);
	}
	else $is_friend = true;

foreach($timeline_plus as $row){


    $url            = check_profile_seaman($row['username']);
    $cf             = $this->friendship_model->check_friends($row['pelaut_id'],$pelaut_id_login); // cek pertemanan kalau ingin comment
    $jml_komentar   = $this->comment_tml_model->jumlah_komentar($row['id_timeline']);

?>
    <div class="post-container" id="timeline-content">
        
        <div class="timestamp-block"><?php $dfb = date_format_db($row['datetime']); echo since($row['datetime']); ?></div>
        
        <div class="post-block">
        
            <div class="media">
                <a class="pull-left small-img-container" href="#">
                    <img class="media-object img-responsive" src='<?php  echo $url; ?>' style="border:1px solid #CCC" alt="Media">
                </a>
                <div class="pull-right">
				  <?php $url_status = base_url("profile/$row[username]/timeline/detail/$row[id_timeline]"); ?>
                  <i class=""><button class="btn btn-sm btn-facebook" onclick="fb_share_status('<?=$url_status?>')" id="share-this-timeline">share</button>  </i>
                  <i class="fa fa-share-alt fa-fw fa-2x text-grayc6 "></i>
				</div>
                <div class="media-body">
                    <p class="media-heading ">
                   
                        <span class="text-link a-18">
                            <?php echo $this->friendship_model->username_variation($row['id_timeline']); ?>
                        </span>
                    
                    <br> <?=$row['title']?></p>
                </div>
            </div>
            
            <div id="panel-content">
              <?php
                 
                $dt_panel['row'] = $row;
                if($row['type'] == "Photo" || $row['type'] == "profile_pic" || $row['type'] == "Resume" || $row['type'] == "cover")
                {
                    $this->load->view("panel-content/panel-photo",$dt_panel);
                }
                else
                {
                    $this->load->view("panel-content/panel-status",$dt_panel);
                }
              ?>
            </div>
           
            <a class="text-link" href="<?php print base_url("profile/$row[username]/timeline/detail/$row[id_timeline]")?>">See Detail</a>
            <span class="text-link">●</span>
            <!-- <a class="text-link" href="#">20 Likes</a>
            <span class="text-link">●</span> -->
            <a class="text-link" href="#"><?=$jml_komentar;?> comment</a>
            
            
            <div id="list_comment_timeline_<?php echo $row['id_timeline']?>">
                
            </div>
        
            <script>
                  //alert("asasasas");
                  get_list_comment(<?php echo $row['id_timeline']?>);
            </script>
            <?php
            //print_r($cf);												 // ubah expressi ini jika sudah ada fitur pertemanan
            if(($this->session->userdata("user") == "pelaut" && $cf == TRUE) || $pelaut_id_login == $row['pelaut_id']){
                $data['id_timeline'] = $row['id_timeline'];
                $this->load->view('post-comment-timeline',$data);
            }
    
            ?>
        </div>
    </div> 
<?php

}
// end foreach
// ======================================================================================================== //

?>



<?php // paging 				// rule ini harus sama dengan yang diatas
if($jml_data_angka > 0){
    //echo "jml_data_angka = ".$jml_data_angka."<br> id_timeline = ".$row['id_timeline'];
    ?>
    <a id="<?php echo $row['id_timeline']; ?>" href="#" class="load_data" >
        <div class="panel panel-default style_fb">
            <div class="panel-body" id="style_fb">
                <span>Show More <i class="glyphicon glyphicon-triangle-bottom"></i> </span>
                <input type="hidden" value="" id="setting" class='5'>
            </div>
        </div>
    </a>
<?php
}
else
{ //echo "jml_data_angka = ".$jml_data_angka."<br> id_timeline = ".$row['id_timeline'];
    ?>

    <div class="panel panel-default style_fb">
        <div class="panel-body" id="style_fb">
            <span>There is no data </span>
        </div>
    </div>


<?php
}
//Modules::run("timeline");

//echo "lalala";*/
?>