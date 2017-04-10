
<script>


    // Create an array.
//    var letters = ['ab', 'cd', 'ef'];

    // Call the ShowResults callback function for each
    // array element.
//    letters.forEach(ShowResults);

   // alert('<?php echo $search_data['sallary'] ?>');
    $(document).ready(function () {

         function getAllShipList() 
        {
            var datanya = "idshipnya = <?php if(!empty($search_data['ship'])) echo $search_data['ship']; else echo '0' ?>";
            $.ajax({
                url:"<?php echo base_url("vacantsea/list_ship") ?>",
                type:"POST",
                data:datanya,
                success: function(data) {
                    $("#get_ship_vacant").html(data);
                }
            });
            
        }


        function getAllDepartmentList(e)
        {
            var s = "<?php echo $search_data['department']; ?>";
            $(".prev-data").hide();
            $(".first-data").hide();
            var datanya = "idnya=<?php if(!empty($search_data['department'])) echo $search_data['department']; else echo '0' ?>";
            $.ajax({
                url:"<?php echo base_url("/vacantsea/list_department") ?>",
                data:datanya,
                type:"POST",
                success: function(data) {
                    $("#list-dept-vacant").html(data);
                }
            });
        }

        getAllDepartmentList();
        getAllShipList();

        var idxxx = '<?php echo $search_data["department"] ?>';
        if(idxxx != "") getAllRankList("s=&id_department="+idxxx);


        function getAllRankList(datanya){
//            alert("imhere");
            datanya += "&idnya="+<?php echo !empty($search_data["rank"]) ? $search_data["rank"]:"0" ?>;
            $.ajax({
                url:"<?php echo base_url("vacantsea/list_rank") ?>",
                type: "POST",
                data: datanya,
                success: function(hasil) {
                    $("#list-rank-vacant").html(hasil);
                }
            });
        }

        $("#list-dept-vacant").change(function(){
            var data = "s=&id_department=" + $("#list-dept-vacant").val();
            getAllRankList(data);
        });

        /* Aksi saat button apply di page vacantsea-detail atau di vacantsea-list di klik */

        $(".apply-vacant-button").click(function (e) {
			
			//alert("aaaa");
			
            var current_url = window.location.href.replace('#','');
			//alert(current_url);

            var can_apply = "<?php echo $can_apply ?>";
            //alert(can_apply);

            // can_apply = can_apply == "" ? 0 : 1;
            // alert(can_apply);
            var dt = $("#url-data").val().split('&');
			
			//alert(dt);
			
            var id_apply = dt[0];
			var dt1 = dt[1];
            var title = dt1.replace("/ /g",'-');
            title = title.replace(',','');
            title = title.replace('.',''); 
			title = title.replace('(','');
            title = title.replace(')','');
            title = title.replace('/','');
			
			
			
            var url = "<?= base_url("vacantsea/apply") ?>/" + id_apply + "/" + title;
			
            if (can_apply == 0) {
				
                $.ajax({
                    url: url,
                    type:"POST",
                    data:"destination="+current_url+"&idapply="+id_apply, //harus sertakan destination untuk menyimpan langkah selanjutnya setelah login
                    success: function (hasil) {
						
                        $("#modal-login").html(hasil);
                        //$("#myModal").modal("show");
                    }
                });
            } else {
                $.ajax({
                    url: url,
                    type:"POST",
                    data:"idapply="+id_apply, //harus sertakan destination untuk menyimpan langkah selanjutnya setelah login
                    success: function (hasil) {
                       $("#modal-login").html(hasil);
                    }
                });
                window.location = url;
            }
        });

        $("#frm-search-vacantsea").submit(function (e) {
            e.preventDefault();
            var dept = $("#list-dept-vacant").val();
            var rank = $("#list-rank-vacant").val();
            var sallary = $("#list-sallary-vacant").val();
            var vessel  = $("#get_ship_vacant").val();


            var keyword = $("#key-vacant").val();
            var url = "<?php echo base_url("/vacantsea/search")?>";
         
                $.ajax({
                    url: "<?php echo base_url("vacantsea/getData") ?>",
                    type: "POST",
                    data: "id_ship="+vessel+"&id_dept="+dept+"&id_rank="+rank,
                    success: function (res) { 
                       
                        var hasil = String(res);
                        hasil = hasil.split("&");
                        hasil[0] = hasil[0].replace(/ /g,"-");
                        hasil[1] = hasil[1].replace(/ /g,"-"); /*Department*/
                        hasil[2] = hasil[2].replace(/ /g,"-"); /*Rank*/
                        

                        if(keyword != ""){
                            url+="/"+keyword+"/";
                        }

                        if((hasil[0] != 0) && (hasil[1] != "") && (hasil[2] != "")){
                            url+="?vessel_type="+hasil[0]+"&department="+hasil[1]+"&rank="+hasil[2];
                        }else if((hasil[0] != 0) && (hasil[1] != "") && (hasil[2] == "")){
                            url+="?vessel_type="+hasil[0]+"&department="+hasil[1];
                        }else if((hasil[0] != 0) && (hasil[1] == "")){
                            url+="?vessel_type="+hasil[0];
                        }else if((hasil[0] == 0) && (hasil[1] != "") && (hasil[2] != "")){
                            url+="?department="+hasil[1]+"&rank="+hasil[2];
                        }else if((hasil[0] == 0) && (hasil[1] != "") && (hasil[2] == "")){
                            url+="?department="+hasil[1];
                        }else{

                        }



                        window.location = url;
                    }
                });
            
           

        });

//        var view=1;
        /* Aksi saat link First dan Last di Klik */

        /* Aksi saat link First di Klik */
        $(".first-data").click(function () {
            view=1;
            var vacantsea_id = "<?= $id_pertama ?>";
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_id/next")?>",
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    var dt = html.split('&');
                    stateButton("prev", dt[1], dt[0], view);
                }
            });

            /* Ajax untuk mengganti data dalam div */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_data/next")?>",// parameter dari load data
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    $("div#listnya").html(html); //ganti
                }
            });
        });

        /* Akhir dari Aksi Link First di Klik */

        /* Aksi saat link Last di Klik */
        $(".last-data").click(function () {
            view=<?=$total_vacant/5?>;
            var vacantsea_id = "<?= $id_pertama ?>";
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_id/prev")?>",
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    var dt = html.split('&');
                    stateButton("prev", dt[1], dt[0], view);
                }
            });

            /* Ajax untuk mengganti data dalam div */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_data/prev")?>",// parameter dari load data
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    $("div#listnya").html(html); //ganti
                }
            });

        });
        /* Akhir dari Aksi Link Last di Klik */

        /* Akhir dari Aksi Link First dan Last di Klik */

        function stateButton(state, next_id, prev_id, hit)
        {
            if(state == "next") {
                if (hit >= <?= $total_vacant/5 ?>) {
                    $(".next-data").attr({id: next_id, href: "<?=base_url("vacantsea/")?>/#" + (hit + 1)}).hide();
                    $(".prev-data").attr({id: prev_id, href: "<?=base_url("vacantsea/")?>/#" + (hit - 1)});
                    $(".last-data").hide();
                }
                else {
                    $(".next-data").prop({id: next_id, href: "<?=base_url("vacantsea/")?>/#" + (hit + 1)});
                    $(".prev-data").attr({id: prev_id, href: "<?=base_url("vacantsea/")?>/#" + (hit - 1)}).show();
                    $(".first-data").show();
                }
            }
            else
            {
                if(hit <= 1){
                    $(".next-data").attr({id: next_id, href:"<?=base_url("vacantsea/")?>/#"+(hit+1)});
                    $(".prev-data").attr({id: prev_id, href:"<?=base_url("vacantsea/")?>/#"+hit-1}).hide();
                    $(".first-data").hide();
                }
                else {
                    $(".next-data").attr({id: next_id, href:"<?=base_url("vacantsea/")?>/#"+(hit+1)}).show();
                    $(".prev-data").attr({id: prev_id, href:"<?=base_url("vacantsea/")?>/#"+(hit-1)});
                    $(".last-data").show();
                }
            }
            var s = document.getElementById("link-pg-"+hit).className;
            var x = document.getElementById("link-pg-"+(hit-1)).className;
            s = "text-link disabled";
            x = "text-gray";
            location.reload();
        }

        /* Aksi saat link next dan previous di klik */

        /* Link Next Begin Here */
        var view=1;
        $(".next-data").click(function(){
            view++;
            var vacantsea_id = $(".next-data").attr("id");

            /* Ajax untuk mengganti id di button next */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_id/next")?>",
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    var dt = html.split('&');
                    stateButton("next", dt[1], dt[0], view);
                }
            });

            /* Ajax untuk mengganti data dalam div */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_data/next")?>",// parameter dari load data
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    $("div#listnya").html(html);
                }
            });

        });

        /* Link Next End Here */

        /* Link Previous Begin Here */
        $(".prev-data").click(function(){
            view--;
            var vacantsea_id = $(".prev-data").attr("id");
            //            alert(vacantsea_id);
            /* Ajax untuk mengganti id di button next */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_id/prev")?>",
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    var dt = html.split('&');
                    stateButton("prev", dt[1], dt[0], view);
                }
            });

            /* Ajax untuk mengganti data dalam div */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_data/prev")?>",// parameter dari load data
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
                    $("div#listnya").html(html); //ganti
                }
            });
        });
        /* Link Previous End Here */

        /* Akhir dari Aksi Link Next dan Previous */
    });
    // popover
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})

</script>
  <!-- IMPORTANT: Replace EXAMPLE with your forum shortname -->
    
    <script id="dsq-count-scr" src="//informaseacom.disqus.com/count.js" async></script>