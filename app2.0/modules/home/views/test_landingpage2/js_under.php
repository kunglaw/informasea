<?php //js_under ?>
	<!-- <script src="js/jquery-1.11.1.min.js"></script> -->

	<script src="<?=asset_url("js/landingpage2/smoothWheel.js")?>"></script>

	<!-- <script src="js/bootstrap.min.js"></script> -->

	<script src="<?=asset_url("js/landingpage2/owl.carousel.js")?>"></script>

	<script src="<?=asset_url("js/landingpage2/jquery.prettyPhoto.js")?>"></script>

	<script src="<?=asset_url("js/landingpage2/images-loaded.js")?>"></script>

	<script src="<?=asset_url("js/landingpage2/jquery.count.js")?>"></script>

	<script src="<?=asset_url("js/landingpage2/knobify.js")?>"></script>

	<script src="<?=asset_url("js/landingpage2/isotope.js")?>"></script>

	<script src="<?=asset_url("js/landingpage2/main.js")?>"></script>
    
    <script type="text/javascript" src="<?=asset_url("js/script.js")?>" ></script>
	<script type="text/javascript" src="<?=asset_url("plugin/plugins/slick/slick.min.js")?>" ></script>
    
    <script>
	
	var type = "POST";

    function fillComboBox(){

        $.ajax({

            url:"<?php echo base_url("/vacantsea/list_department") ?>",

            success: function(data) {

                $("#form-department").html(data);

            }

        });



        $.ajax({

            url:"<?php echo base_url("/home/listVesselType") ?>",

            success: function(data) {

                $("#form-vesel").html(data);

            }

        });



        $.ajax({

            url:"<?php echo base_url("/home/listNationality") ?>",

            success: function(data) {

                $("#form-nationality").html(data);

            }

        });

    }

    fillComboBox();
	
    function fill_hidden_modal(dest, id) {
        $("#destination").val(id+"-"+dest+"-vacantsea");
        // $("#id-vacantsea").val(id);
    }
     $("#frm-search-dashboard").submit(function (e) {

        var keyword = $("#keywordnya").val();

        var department = $("#form-department").val();
        var vessel_type = $("#form-vesel").val();
        var nationality = $("#form-nationality").val();
        var search_by = $("#form-vacantsea").val();
        // var url = "<?php echo base_url("home/search") ?>";
         var data = "keyword="+keyword+"&department="+department+"&vessel_type="+vessel_type+"&nationality="+nationality+"&search_by="+search_by;
    
         // if(keyword != ""){
         //    window.location = "<?=base_url();?>seatizen/search_dashboard/"+keyword;
         // }  

         var url = "<?php echo base_url();?>"+search_by+"/search_dashboard";

     $.ajax({
            type: "POST",
            url:"<?=base_url('home/getdata');?>",
            data:data,
            success: function (hasilnya) {



                var hasil = String(hasilnya);

                hasil = hasil.split("&");
                hasil[0] = hasil[0].replace(/ /g,"-"); /* Nation */
                        hasil[1] = hasil[1].replace(/ /g,"-"); /* ship */
                        hasil[2] = hasil[2].replace(/ /g,"-");


                    if(keyword != ""){
                    
                        keyword = keyword.replace(/ /g,"-");
                        url+="/"+keyword+"";
                    }
                    //full
                    if(hasil[0] != "" && hasil[1] != "" && hasil[2] != ""){
                        url+="?vessel_type="+hasil[0]+"&department="+hasil[1]+"&nationality="+hasil[2];
                    }
                    //tanpa nationality
                    else if(hasil[0] != "" && hasil[1] != "" && hasil[2] == ""){
                        url+="?vessel_type="+hasil[0]+"&department="+hasil[1];
                    }
                    //cuma vessel 
                    else if(hasil[0] != "" && hasil[1] == "" && hasil[2] == ""){
                        url+="?vessel_type="+hasil[0];
                    }
                    //tanpa department
                    else if(hasil[0] != "" && hasil[1] == "" && hasil[2] != ""){
                        url+="?vessel_type="+hasil[0]+"&nationality="+hasil[2];
                    }
                    //department nationality
                    else if(hasil[0] == "" && hasil[1] != "" && hasil[2] != ""){
                        url+="?department="+hasil[1]+"&nationality="+hasil[2];
                    }
                    //department
                    else if(hasil[0] == "" && hasil[1] != "" && hasil[2] == ""){
                        url+="?department="+hasil[1];
                    }//nationality
                    else if(hasil[0] == "" && hasil[1] == "" && hasil[2] != ""){
                        url+="?nationality="+hasil[2];
                    }

                    else{
                        url = url;
                    }

                    window.location = url;

            }
        });
        e.preventDefault();
    });

    // $("#frm-search-dashboard").submit(function (e) {

    //     var keyword = $("#keywordnya").val();

    //     var department = $("#form-department").val();
    //     var vessel_type = $("#form-vesel").val();
    //     var nationality = $("#form-nationality").val();
    //     var search_by = $("#form-vacantsea").val();
    //     var url = "<?php echo base_url("home/search") ?>";
    //      var data = "keyword="+keyword+"&department="+department+"&vessel_type="+vessel_type+"&nationality="+nationality+"&search_by="+search_by;
    
    //  $.ajax({
    //         type: type,
    //         url:url,
    //         data:data,
    //         success: function (hasilnya) {
    //             window.location = hasilnya;
    //         }
    //     });
    //     e.preventDefault();
    // });

    /* $(document).ready(function () {
	
		//$('.image-link').magnificPopup({type:'image'});
		$('.test-popup-link').magnificPopup({
		  type: 'image'
		  // other options
		});
		
		$(".test-popup-link").click();
		
        var $vacantseaSlides = 3;
        var $seatizenSlides = 2;
        var $companySlides = 3;
        var $testimonialSlides = 2;
        $('.testimonial-responsive').slick({
            autoplay: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: $testimonialSlides,
            slidesToScroll: $testimonialSlides,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
        $('.company-responsive').slick({
            autoplay: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: $companySlides,
            slidesToScroll: $companySlides,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
        $('.seatizen-responsive').slick({
            autoplay: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: $seatizenSlides,
            slidesToScroll: $seatizenSlides,
            responsive: [
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
        $('.vacantsea-responsive').slick({
            autoplay: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: $vacantseaSlides,
            slidesToScroll: $vacantseaSlides,
            responsive: [
                {
                    breakpoint: 1064,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    }); */
	
	</script>