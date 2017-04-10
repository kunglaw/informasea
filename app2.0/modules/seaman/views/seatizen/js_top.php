<?php // js_top, profile, module seaman ?>



<!-- load js_top profile  -->



<script type="text/javascript" src="<?=asset_url("js/script.js")?>"></script>

<script type="text/javascript" src="<?php echo asset_url('plugin/vanillabox/jquery.vanillabox.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('plugin/vanillabox/jquery.vanillabox-0.1.7.min.js') ?>"></script>

<script type="text/javascript" src="<?=asset_url("plugins/slick/slick.min.js")?>"></script>

<link href="<?php echo asset_url("css/jquery.dataTables.css") ?>" type="text/css" rel="stylesheet" />

<script>



function tes(id,friend,request,deletef,konfirm)

    {

        var keterangan = "start from : ";

        $("#btnaddfriend_"+id).hide();

    $("#btndelfriend_"+id).hide();

    $("#btnwaiting_"+id).hide();

    $("#btnconfirm_"+id).hide();



    //alert(id+"friend :"+friend+"req :"+request+"delete :"+deletef);

    if(friend){

    //alert("friend");

    keterangan += "friend aktif";

    $("#btnaddfriend_"+id).show();

    $("#btndelfriend_"+id).hide();

    $("#btnwaiting_"+id).hide();

    $("#btnconfirm_"+id).hide();

   }else if(request){

 //alert("request");

    keterangan += "request aktif";

    $("#btnaddfriend_"+id).css('display','none');

    $("#btndelfriend_"+id).hide();

    $("#btnwaiting_"+id).show();

    $("#btnconfirm_"+id).hide();

    // alert("#btnaddfriend_"+id);

   }else if(deletef){

    //alert("deletef");

    keterangan += "deleteFriend aktif";

    $("#btnaddfriend_"+id).hide();

    $("#btndelfriend_"+id).show();

    $("#btnwaiting_"+id).hide();

    $("#btnconfirm_"+id).hide();

   } else if(konfirm) {

    //alert("konfirm");

    keterangan += "confirmFriend aktif";

    $("#btnaddfriend_"+id).hide();

    $("#btnwaiting_"+id).hide();

    $("#btndelfriend_"+id).hide();

    $("#btnconfirm_"+id).show();

   }



    console.log(id+", "+keterangan);

    }



function addFriend(id){

        var id_teman = $("#id_teman_"+id).val();

        $.ajax({

            url : "<?php echo base_url("seatizen/seatizen_ajax/add_friend") ?>",

            data :"id_teman="+id_teman,

            type: "POST",

            success:function(data){

                    $("#btnaddfriend_"+id).hide();

                    $("#btnwaiting_"+id).show();

                    $("#btndelfriend_"+id).hide();

            }



        })



    }



    function terima_teman(id){

    var id_teman = $("#id_teman_"+id).val();

    $.ajax({

        url:"<?php echo base_url("seatizen/seatizen_ajax/terima_teman") ?>",

        data:'id_teman='+id_teman,

        type:"POST",

        success:function(data){

            $("#btnaddfriend_"+id).hide();

            $("#btnwaiting_"+id).hide();

            $("#btndelfriend_"+id).show();

            $("#btnconfirm_"+id).hide();

        }

    })

}



    function batal_terima(id){

        var id_teman = $("#id_teman_"+id).val();

        $.ajax({

            url:"<?php echo base_url("seatizen/seatizen_ajax/batal_terima") ?>",

            data:'id_teman='+id_teman,

            type:'POST',

            success:function(data){

                $("#btnaddfriend_"+id).show();

                $("#btndelfriend_"+id).hide();

                $("#btnconfirm_"+id).hide();

                $("#btnwaiting_"+id).hide();

            }



        })

    }



    // function deleteFriend(id){

    //     var id_teman = $("#id_teman_"+id).val();

    //     if(confirm("apakah anda ingin menghapus teman ini ? ")){

    //     $.ajax({

    //         url : "<?php echo base_url("index.php/seatizen/delete_friend"); ?>",

    //         data: "id_teman="+id_teman,

    //         type:"POST",

    //         success:function(data){

    //                 $("#btnaddfriend_"+id).show();

    //                 $("#btnwaiting_"+id).hide();

    //                 $("#btndelfriend_"+id).hide();

    //         }



    //     })

    // }



    // }



    function batalrequest(id){

        var id_teman = $("#id_teman_"+id).val();

        $.ajax({

            url : "<?php echo base_url("seatizen/seatizen_ajax/batalrequestfriend"); ?>",

            data: "id_teman="+id_teman,

            type:"POST",

            success:function(data){



                    $("#btnaddfriend_"+id).show();

                    $("#btnwaiting_"+id).hide();

                    $("#btndelfriend_"+id).hide();   

            }

        })

    }

   </script>