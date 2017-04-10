<?php // js_top, friends, module seaman ?>



<!-- load js_top profile  -->

<link href="<?php echo asset_url("css/jquery.dataTables.css") ?>" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<?=asset_url("js/script.js")?>" ></script>

<script type="text/javascript" src="<?=asset_url("plugins/slick/slick.min.js")?>" ></script>

<script src="<?php echo asset_url("js/jquery.dataTables.min.js"); ?>"></script>

<script>

function tes(id,friend,request,deletef,konfirm,element)
{
	
	var keterangan = "start from : ";
		$(".btnaddfriend_"+id).hide();
	$(".btndelfriend_"+id).hide();
	$(".btnwaiting_"+id).hide();
	$(".btnconfirm_"+id).hide();

	//alert(id+"friend :"+friend+"req :"+request+"delete :"+deletef);
    keterangan += friend+", req: "+request+", del: "+deletef+",konf: "+konfirm+" --> ";
	if(friend){
	//alert("friend");
	keterangan += "friend aktif";
	$(".btnaddfriend_"+id).show();
	$(".btndelfriend_"+id).hide();
	$(".btnwaiting_"+id).hide();
	$(".btnconfirm_"+id).hide();
   }else if(request){
 //alert("request");
    keterangan += "request aktif";
    $(".btnaddfriend_"+id).css('display','none');
	$(".btndelfriend_"+id).hide();
	$(".btnwaiting_"+id).show();
	$(".btnconfirm_"+id).hide();
	// alert(".btnaddfriend_"+id);
   }else if(deletef){
	//alert("deletef");
    keterangan += "deleteFriend aktif";
	$(".btnaddfriend_"+id).hide();
	$(".btndelfriend_"+id).show();
	$(".btnwaiting_"+id).hide();
	$(".btnconfirm_"+id).hide();
   } else if(konfirm) {
	//alert("konfirm");
    keterangan += "confirmFriend aktif";
	$(".btnaddfriend_"+id).hide();
	$(".btnwaiting_"+id).hide();
	$(".btndelfriend_"+id).hide();
	$(".btnconfirm_"+id).show();
   }

	console.log(id+", "+keterangan);

}



function addFriend(id){

	//alert('add friend');

        var id_teman = $("#id_teman_"+id).val();

        $.ajax({

            url : "<?php echo base_url("seatizen/seatizen_ajax/add_friend") ?>",

            data :"id_teman="+id_teman,

            type: "POST",

            success:function(data){

            	//alert(data);

                    $(".btnaddfriend_"+id).hide();

                    $(".btnwaiting_"+id).show();

                    $(".btndelfriend_"+id).hide();

            }



        })



    }



   function terima_teman(id){

    var id_teman = $("#id_teman_"+id).val();

    $.ajax({

        url:"<?php echo base_url("eatizen/seatizen_ajax/terima_teman") ?>",

        data:'id_teman='+id_teman,

        type:"POST",

        success:function(data){

            $(".btnaddfriend_"+id).hide();

            $(".btnwaiting_"+id).hide();

            $(".btndelfriend_"+id).show();

            $(".btnconfirm_"+id).hide();

        }

    })

}



    // function deleteFriend(id){

    //     var id_teman = $("#id_teman_"+id).val();

    //     if(confirm("apakah anda ingin menghapus teman ini ? ")){

    //     $.ajax({

    //         url : "<?php echo base_url("seatizen/seatizen_ajax/delete_friend"); ?>",

    //         data: "id_teman="+id_teman,

    //         type:"POST",

    //         success:function(data){

    //                 $(".btnaddfriend_"+id).show();

    //                 $(".btnwaiting_"+id).hide();

    //                 $(".btndelfriend_"+id).hide();

    //         }



    //     })

    // }



    // }



    function batalrequest(id){

        var id_teman = $("#id_teman_"+id).val();

        $.ajax({

            url : "<?php echo base_url("/seatizen/seatizen_ajax/batalrequestfriend"); ?>",

            data: "id_teman="+id_teman,

            type:"POST",

            success:function(data){



                    $(".btnaddfriend_"+id).show();

                    $(".btnwaiting_"+id).hide();

                    $(".btndelfriend_"+id).hide();   

            }

        })

    }



    function deletefriend(id_friend){



        //alert('aku disini');

        var type_modal = "delete-friend-modal";

        get_modal(type_modal,id_friend);

     }





     function bedadeletefriend(id_friend){

        //alert('haii');

        var type_modal = "delete-friend-modal-2";

        get_modal2(type_modal,id_friend);

     }

   </script>