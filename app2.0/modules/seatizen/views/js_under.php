<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 29/06/2015
 * Time: 12:00
 */
?>
<script>
 function get_modal(type_modal,id_update)
     {
       //alert('tes');
      // var url = "<?php echo base_url("seatizen/seatizen_ajax/modal"); ?>";
       //alert(url);

            //var data = "x=1&modal="+type_modal+"&id_update="+id_update;
            //alert(data);
            
            $.ajax({
            
            type:"POST",
            data:"x=1&modal="+type_modal+"&id_update="+id_update,
            url:"<?php echo base_url("seatizen/seatizen_ajax/modal"); ?>",
            success: function(data){
             // alert(data);
                $(".tmpa_modal").html(data);
                
            }
            
            
            
        });
     }
</script>
<script>

$(document).ready(function () {
   
	getAllDepartmentList();
		getAllShipList();
		getAllNation();
        $("#get_department_vacant").change(function(){
			var data  = "s=&id_department="+ $("#get_department_vacant").val();
			getAllRankList(data);	
			getAllCocList(data);
      
        });



 
        $("#frm-search-seatizen").submit(function (e) {
			 	e.preventDefault();
			 //alert('tes');
            var nation = $("#get_nation_seatizen").val(); 
            var ship = $("#get_ship_vacant").val();
            var dept = $("#get_department_vacant").val();
            var rank = $("#get_rank_vacant").val();
            var keyword = $("#keyseatizen").val();
            var coc = $("#get_coc_class").val();
            var url = "<?php echo base_url("seatizen/search")?>";
            // alert(nation);
                $.ajax({
                    url: "<?php echo base_url("seatizen/getData") ?>",
                    type: "POST",
                    data: "id_nation="+ nation +"&id_ship="+ ship + "&id_dept="+ dept +"&id_rank= "+ rank +"&id_coc=" + coc,
                   success: function (res) {
                       var hasil = String(res);
                     // alert(hasil);
                        hasil = hasil.split("&");
						hasil[0] = hasil[0].replace(/ /g,"-"); /* Nation */
                        hasil[1] = hasil[1].replace(/ /g,"-"); /* ship */
                        hasil[2] = hasil[2].replace(/ /g,"-"); //department
                        hasil[3] = hasil[3].replace(/ /g,"-"); //rank
                        hasil[4] = hasil[4].replace(/ /g,"-"); //coc class            
                        // var vv = hasil[0];
                        // alert(vv);
                        if(keyword != ""){
                          url+="/"+keyword+"/";
                        }
                          

                        if((hasil[0] != 0) && (hasil[1] != "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] != "")) {
                            url+="?nationality="+hasil[0]+"&ship="+hasil[1]+"&department="+hasil[2]+"&rank="+hasil[3]+"&coc_class="+hasil[4];
                          //  alert('nation ship department rank coc');
                      } else if((hasil[0] != 0) && (hasil[1] != "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] == "")){
                            url+="?nationality="+hasil[0]+"&ship="+hasil[1]+"&department="+hasil[2]+"&rank="+hasil[3];
                            //alert('nation ship department rank');
                       } else if((hasil[0] != 0) && (hasil[1] != "") && (hasil[2] != "") && (hasil[3] == "") && (hasil[4] == "")) {
                            url+="?nationality="+hasil[0]+"&ship="+hasil[1]+"&department="+hasil[2];
                          //  alert('nation ship department')
                        }else if((hasil[0] != 0) && (hasil[1] != "") && (hasil[2] == "") && (hasil[3] == "") && (hasil[4] =="")){
                            url+="?nationality="+hasil[0]+"&ship="+hasil[1];
                          //  alert('nation ship');
                       } else if((hasil[0] != "") && (hasil[1] == "") && (hasil[2] == "") && (hasil[3] == "") && (hasil[4] == "")){
                            url+="?nationality="+hasil[0];
                            //alert('just nation');
                        }else if((hasil[0] == 0) && (hasil[1] != "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] != "")) {
                            url+="?ship="+hasil[1]+"&department="+hasil[2]+"&rank="+hasil[3]+"&coc_class"+hasil[4];
                            //alert('ship department rank coc');
                       } else if((hasil[0] == 0) && (hasil[1] != "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] == "")) {
                            url+="?ship="+hasil[1]+"&department="+hasil[2]+"&rank="+hasil[3];
                           // alert('ship department rank');
                        }else if((hasil[0] == 0) && (hasil[1] != "") && (hasil[2] != "") && (hasil[3] == "") && (hasil[4] == "")){
                            url+="?ship="+hasil[1]+"&department="+hasil[2];
                            //alert('ship department');
                       } else if((hasil[0] == 0) && (hasil[1] != "") && (hasil[2] =="") && (hasil[3] =="") && (hasil[4] == "")) {
                            url+="?ship="+hasil[1];
                            //alert('ship');
                       } else if((hasil[0] == 0) && (hasil[1] == "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] != "")) {
                            url+="?department="+hasil[2]+"&rank="+hasil[3]+"&coc_class="+hasil[4];
                            //alert('department rank coc');
                       } else if((hasil[0] == 0) && (hasil[1] == "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] =="")) {
                            url+="?department="+hasil[2]+"&rank="+hasil[3];
                            //alert('department rank');
                       } else if((hasil[0] == 0) && (hasil[1] == "") && (hasil[2] != "") && (hasil[3] == "") && (hasil[4] != "")) {
                            url+="?department="+hasil[2]+"&coc_class="+hasil[4];
                           // alert('department coc');
                       } else if((hasil[0] == 0) && (hasil[1] == "") && (hasil[2] != "") && (hasil[3] =="") && (hasil[4] =="")) {
                            url+="?department="+hasil[2];
                          //  alert('department');
                        }else if((hasil[0] != 0) && (hasil[1] == "") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] != "")) {
                            url+="?nationality="+hasil[0]+"&department="+hasil[2]+"&rank="+hasil[3]+"&coc_class="+hasil[4];
                           // alert('nation department rank coc');
                       } else if((hasil[0] != 0) && (hasil[1] =="") && (hasil[2] != "") && (hasil[3] != "") && (hasil[4] =="")) {
                            url+="?nationality="+hasil[0]+"&department="+hasil[2]+"&rank="+hasil[3];
                          //  alert('nation department rank');
                       } else if((hasil[0] != 0) && (hasil[1] == "") && (hasil[2] != "") && (hasil[3] =="") && (hasil[4] =="")) {
                            url+="?nationality="+hasil[0]+"&department="+hasil[2];
                           // alert('nation department');
                       } else { 
                          //  alert('hello');
                            }

                      

                         //alert(url);
                        window.location = url;
                    }
                });
          
//        alert(url);
        });
  })
</script>