<script>
    $(".load_data").click(function(){

        var vacantsea_id = $(this).attr("id");
        var jml_setting = $("#setting").attr("class");

        // tambahan kalau misalkan user klik search
        var keyword = $("#keyword").val();
        var sallary = $("#sallary").val();
        var ship_type = $("#ship_type").val();
        var get_id_department = $("#get_id_department").val();
        var get_rank = $("#get_rank").val();
        var coc_class = $("#coc_class").val();
        var page = $("#page").val(); // trigger yang menyatakan dia harus ke get_list_vacantsea atau ke search vacantsea*/

        var url_action = "<?php echo base_url("vacantsea/get_list_vacantsea_plus") ?>";
        if(page != "")
        {
            url_action = "<?php echo base_url("vacantsea/search_vacantsea_plus") ?>"
        }

        //alert(url_action);
        //alert($("form#parameter-paging").serialize());

        if(vacantsea_id != 9999){

            $.ajax({
                type: "POST",
                url:url_action,                               // parameter dari load data
                data: "vacantsea_id="+ vacantsea_id +"&jml_setting="+jml_setting + "&x=1&"+$("form#parameter-paging").serialize(),
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

$this->load->model("rank_model");
$this->load->model('company/company_model');
$this->load->model('nation_model');
$this->load->helper('text_helper');
$this->load->helper('date_format_helper');

$id_user = $this->session->userdata("id_user");

//foreach($job as $row){

?>


<div class="panel-heading-vacantsea">
    <h4><b> Company Overview </b></h4>
</div>

<hr />

<?php
echo $company['description'];
?>

<hr />
<div class="panel-heading-vacantsea">
    <h4><b> Gallery </b></h4>
</div>
<!-- Carousel
 ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Example headline.</h1>
                    <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Another example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>One more for good measure.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->
<hr />

<div class="panel-heading-vacantsea">
    <h4><b> All Jobs from this Company </b></h4>
</div>
<hr/>
<?php
$this->load->view("list_company_vacantsea", $data);
    ?>