<?php // js_top, module timeline ?>
<!-- plugin css -->
<link rel="stylesheet" href="<?=asset_url("plugin/mention-plugin/css/bootstrap-suggest.css")?>">
<link rel="stylesheet" href="<?=asset_url("plugin/mention-plugin/css/highlight-github.css")?>">

<!-- marked -->
<script src="<?=asset_url("plugin/mention-plugin/js/marked.min.js")?>"></script>
<script src="<?=asset_url("plugin/mention-plugin/js/highlight.pack.js")?>"></script>

<!-- plugin script -->
<script src="<?=asset_url("plugin/mention-plugin/js/bootstrap-suggest.js")?>"></script>

<!-- x-editable -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('plugin/sweet_alert/sweetalert.css') ?>">
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script type="text/javascript" src="<?php echo asset_url('plugin/sweet_alert/sweetalert.js') ?>"></script>
  
<script>
	
	function fb_share_status(url_status)
	{
		FB.ui({
		  method: 'share',
		  display: 'popup',
		  href: url_status,
		}, function(response){});
		
	}
	
    function get_list_comment(id_timeline)
    {
        $.ajax({

            type : "POST",
            url : "<?php echo base_url("timeline/comment_tml/get_comment"); ?>", // nanti diganti
            data:"id_timeline="+id_timeline+"&x=1",
            success : function(data)
            {
                $("#list_comment_timeline_"+id_timeline).html(data);
                $("#jumlah_komentarnya_"+id_timeline).html()
            }
        });

    }
	
	function post_comment(id_timeline)
	{
		//alert($("#form_comment_<?php echo $id_timeline; ?>").serialize());
		$.ajax({
			
			type:"POST",
			url:"<?php echo base_url("timeline/comment_tml/insert_comment"); ?>",
			data:$("#form_comment_"+id_timeline).serialize(),
			dataType:"json",
			success:function(data){
				
				//alert($("#form_comment_<?php echo $id_timeline; ?>").serialize());
				if(data.info == "")
				{ 
				 
				  get_list_comment(id_timeline);
				  
				  $("#post_content_"+id_timeline).val("");
				  //reset();
				}
				else
				{
				  alert(data.info);
				  $("#alert_modal").html(data);	
				}
				
			}
			
			
		}); return false;
		
		
	}
	
	function delete_comment(id_comment_tml)
	{
		$.ajax({
			
			type:"POST",
			url:"<?php echo base_url("timeline/comment_tml/delete_comment"); ?>",
			data:"id_comment_tml="+id_comment_tml,
			success:function(data){
				
				
				if(data == "")
				{ 
				 
				  get_list_comment(id_timeline);
				  $("#post_content_"+id_timeline).val("");
				  //reset();
				}
				else
				{
				 
				  $("#alert_modal").html(data);	
				}
				
			}
			
			
		}); return false;
		
	}
	
    function del_tml(id_tml,dturl,url)
    {
        $.ajax({
            type:"POST",
            data:dturl+"&id_tml="+id_tml,
            url:url,
            success: function(data){
                //alert(data);
                $(".tml-modal-alert").html(data);
            }
        });
    }
	
	function del_comment_tml(id_comment_tml,dturl,url)
    {
        $.ajax({
            type:"POST",
            data:dturl+"&id_tml="+id_tml,
            url:url,
            success: function(data){
                //alert(data);
                $(".tml-modal-alert").html(data);
            }
        });
    }

    function responsive_img(nw,nh,id_timeline)
    {
        var nw_width = nw
        var nw_height = nh;

        var sub_content_tml_width = $("#sub-content-tml").width();
        var sub_content_tml_height = $("#sub-content-tml").height();

        //alert(sub_content_tml_width+" and "+sub_content_tml_height);

        p_width = Math.round(( nw_width / sub_content_tml_width ) * 100);
        p_height = Math.round(( nw_height / sub_content_tml_width ) * 100);

        if(p_width > 100)
        {
            p_width = 100;
        }

        $(".img-"+id_timeline).attr("width",p_width+"%");
        $(".img-"+id_timeline).attr("height",p_height+"%");

    }

    // $('.load_data').click(function() {

    //     var id_timeline = $(this).attr("id");
    //     var jml_setting = $("#setting").attr("class");

    //     <?php

    //     // variable penting
    //     $username_url = $this->input->post('username');
    //     $username_login = $this->session->userdata('username');
    //     $pelaut_id_login = $this->session->userdata("id_user");
    //     $ctrl = $this->input->post('ctrl'); // menentukan view detail atau profile

    //     $cf = $this->friendship_model->show_friend($pelaut_id_login);
    //      ?>
         
    //     var nn = "<?php echo $ctrl; ?>";
    //     var username_url = "<?php echo $username_url; ?>";
    //     var username_login = "<?php echo $username_login; ?>";
        
    //     if(nn == "profile" && (username_url == username_login))
    //     {
    //         url_address = '<?php echo base_url('timeline/timeline/get_self_timeline_plus')?>';
    //     }
    //     else if(nn == "detail" && (username_url != username_login))
    //     {
    //         url_address = '<?php echo base_url('timeline/timeline/get_self_timeline_plus')?>';
    //     }
    //     else
    //     {
    //         url_address = '<?php echo base_url('timeline/timeline/get_list_timeline_plus')?>';
    //     }
        
    //     //alert("id_timeline="+ id_timeline +"&jml_setting="+jml_setting+"&x=1&ctrl="+nn+"&HALAMAN = list_timeline ");

    //     if(id_timeline != 9999){

    //         $.ajax({
    //             type: "POST",
    //             url: url_address,
    //             data: "id_timeline="+ id_timeline +"&jml_setting="+jml_setting+"&x=1&ctrl="+nn+"&username="+username_url,
    //             beforeSend:  function() {
    //                 $('span.load_data').append('<img src="<?php echo base_url("assets/img/facebook_style_loader.gif"); ?>" />');
    //             },
    //             success: function(html){
    //                 $(".style_fb").remove();
    //                 $("div#list-timeline").append(html); //ganti
    //             },
    //             error:function()
    //             {
    //                 alert("terjadi kesalahan");
    //             }
    //         });
    //     }
    //     return false;
    // });

</script>