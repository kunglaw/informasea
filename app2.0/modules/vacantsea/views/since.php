<script>
    $(".load_data").click(function(){

        var vacantsea_id = $(this).attr("id");
        var jml_setting = $("#setting").attr("class");

        // tambahan kalau misalkan user klik search
        var keyword = $("#keyword").val();
        var sallary = $("#sallary").val();
        var ship_type = $("#ship_type").val();
        var get_id_department = $("#department").val();
        var get_rank = $("#rank_id").val();
        var coc_class = $("#coc_class").val();
        var page = $("#page").val(); // trigger yang menyatakan dia harus ke get_list_vacantsea atau ke search vacantsea*/
        // alert(get_id_department);
        // alert(keyword);
        var url_action = "<?php echo base_url("vacantsea/get_list_vacantsea_plus") ?>";
        if(page == "search_vacant")
        {
            // alert("hallo");
            url_action = "<?php echo base_url("vacantsea/search_vacantsea_plus") ?>";
        }

        if(vacantsea_id != 9999){

            $.ajax({
                type: "POST",
                url:url_action,																// parameter dari load data
                data: "page="+page+"&keyword="+keyword+"&sallary="+sallary+"&ship_type="+ship_type+"&department="+get_id_department+"&rank_id="+get_rank+"&coc_class="+coc_class+"&vacantsea_id="+ vacantsea_id +"&jml_setting="+jml_setting + "&x=1&"+$("form#parameter-paging").serialize(),
                beforeSend:  function() {
                    $('span.load_data').append('<img src="<?php echo base_url("assets/img/facebook_style_loader.gif"); ?>" />');
                },
                success: function(html){
                    //alert(vacantsea_id);
                    /*keyword = ""; // harus diganti, jangan kosong
                     sallary = "";
                     ship_type = "";
                     get_id_department = "";
                     get_rank = "";
                     coc_class = "";
                     page = "";*/

                    //alert(html);

                    $(".style_fb").remove();
                    $("div#list_vacantsea").append(html); //ganti

                }
            });

        }
        return false;
    });
</script>

<?php
// echo $page;
$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');
$id_user = $this->session->userdata("id_user");

//foreach($job as $row){
//pengecekan jumlah data departemen dan ditampilkan menjadi 2 bagian
$jml_departemen = count($department);
if($jml_departemen%2==1)
{
    $panel1 = floor($jml_departemen/2);
    $panel2 = ceil($jml_departemen/2);
}
else $panel1 = $panel2 = ($jml_departemen/2);

?>
<div class="panel-heading-vacantsea">
    <?php $dept = $dept_name==""?"":$dept_name; ?>
    <h4><b> Vacantsea List by Department <?php echo $dept; ?> </b></h4>
</div>
<hr />

<div class="panel-body col-md-12">
    <!-- untuk 3 list departemen pertama -->
    <?php echo $results ?>
</div>
