<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 29/06/2015
 * Time: 12:00
 */
?>

<script>

    $(document).ready(function () {

        function getAllDepartmentList()
        {
            $(".prev-data").hide();
            $(".first-data").hide();
            $.ajax({
                url:"<?php echo base_url("index.php/vacantsea/list_department") ?>",
                success: function(data) {
                    $("#get_department_vacant").html(data);
                }
            });
        }

        getAllDepartmentList();

        $("#get_department_vacant").change(function(){
            $.ajax({
                url:"<?php echo base_url("index.php/vacantsea/list_rank") ?>",
                type: "POST",
                data:"id_department=" + $(this).val(),
                success: function(data) {
                    $("#get_rank_vacant").html(data);
                }
            });
        });

        $("#src-vacant-btn").click(function () {

            var dept = $("#get_department_vacant").val();
            var rank = $("#get_rank_vacant").val();
            var keyword = $("#key-vacant").val();
            var url = "<?=base_url("index.php/vacantsea/")?>/search/";
            if(dept != "") {
                $.ajax({
                    url: "<?php echo base_url("index.php/vacantsea/getData") ?>",
                    type: "POST",
                    data: "id_dept=" + dept+"&id_rank="+rank,
                    success: function (res) {
                        var hasil = String(res);
                        hasil = hasil.split("&");
                        hasil[0] = hasil[0].replace(/ /g,"-"); /*Department*/
                        hasil[1] = hasil[1].replace(/ /g,"-"); /*Rank*/
                        if((hasil[0] != "") && (hasil[1] != "")) url+=hasil[0]+"/"+hasil[1];
                        else if(hasil[0] != "" && hasil[1] == "")url+=hasil[0];
                        url+="/"+(keyword != undefined ? keyword: "")+"`";
                        window.location = url;
                    }
                });
            }
            else window.location = url+= (keyword != undefined ? keyword: "")+"`";
//        alert(url);
        });

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
                    if(view >= <?= $total_vacant/5 ?>){
                        $(".next-data").attr({id: dt[1], href:"#"+dt[1]}).hide();
                        $(".prev-data").attr({id: dt[0], href:"#"+dt[0]});
                        $(".last-data").hide();
                    }
                    else {
                        $(".next-data").prop({id: dt[1], href:"#"+dt[1]});
//                        alert($(".next-data").attr("id"));
                        $(".prev-data").attr({id: dt[0], href:"#"+dt[0]}).show();
                        $(".first-data").show();
                    }
                    var s = document.getElementById("link-pg-"+view).className;
                    s = "text-link disabled";
                    alert(s);
//                    $("a#link-pg-"+view).className += " disabled";
//
//                    $("a#link-pg-"+(view-1)).className = "text-link";
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
                    if(view <= 1){
                        $(".next-data").attr({id: dt[1], href:"#"+dt[1]});
                        $(".prev-data").attr({id: dt[0], href:"#"+dt[0]}).hide();
                        $(".first-data").hide();
                    }
                    else {
                        $(".next-data").attr({id: dt[1], href:"#"+dt[1]}).show();
                        $(".prev-data").attr({id: dt[0], href:"#"+dt[0]});
                        $(".last-data").show();
                    }
                }
            });

            /* Ajax untuk mengganti data dalam div */
            $.ajax({
                type: "POST",
                url: "<?=base_url("vacantsea/next_data/prev")?>",// parameter dari load data
                data: "x=1&id_terakhir="+vacantsea_id,
                success: function(html){
//                    $(".style_fb").remove();
                    $("div#listnya").html(html); //ganti

                }
            });

        });
        /* Link Previous End Here */

    });
</script>