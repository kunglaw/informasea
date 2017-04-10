<!doctype html>

  <?php

      

    $css = !empty($css) ? $css : "css"; // tambahan css 

    $meta = !empty($meta) ? $meta : "meta"; // tambahan meta

    $js_top = !empty($js_top) ? $js_top : "js_top"; // tambahan js_top

    

    $dt_head['css']   = $css;

    $dt_head['meta']   = $meta;

    $dt_head['js_top'] = $js_top;

    

      $this->load->view('head',$dt_head); // include general head



  ?>

  <style>

#myProgress {
  position: relative;
  width: 100%;
  height: 30px;
  background-color: #ddd;
}



#myBar {

  position: absolute;

  width: 0%;

  height: 100%;

  background-color: red;

  color: white;

}



#label {

  text-align: center;

  line-height: 30px;

  color: white;

}

a[disabled="disabled"] {

        pointer-events: none;

    }

</style>

  <body>



<section class="content container-fluid">

    <div class="row">

        <div class="block text-white">

        <center>

                <h2>Activation Step

                    <!-- <button class="btn btn-filled" onClick="javascript:location.href = '<?php //base_url("users/register/seaman")?>' ">

                      SEAMAN</button>

                    <button class="btn btn-transparent" onClick="javascript:location.href = '<?php //base_url("users/register/agentsea")?>' ">

                    AGENTSEA</button> -->

                </h2>

                <div id="myProgress" style="width: 60%;">

                <div id="myBar">

                  <div id="label">0%</div>

                </div>

              </div>

              <br>

                </center>

            </div>

        <?php //$this->load->view("left-content/left-agentsea") ?>

        <div class="col-md-2">&nbsp;</div>

        <div class="col-md-8 text-white m-t-1">

            <form class="transparent register-form" id="form-activation-agentsea">



              <ul class="nav nav-tabs">

                <li class="active"><a href="#tab1" data-toggle="tab" disabled="disabled">Step 1</a></li>

                <!-- <li><a href="#tab2" data-toggle="tab" disabled="disabled">Step 2</a></li> -->

                <li><a href="#tab3" data-toggle="tab" disabled="disabled">Summary</a></li>

              </ul>

              <div class="tab-content">

                <div class="tab-pane active" id="tab1">

                <center>

                  

                  <br>

                  

                <div class="form-group" style="width: 60%">

                  <label for="first_name">Contact Person</label>

                    <input onchange="fill_progress('contact_person', 1)" type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person"

                    value="<?=set_value('contact_person');?>">

                </div>

                  <br>

                <div class="pull-right">

                  <a class="btn btn-primary btnNext" id="lastNext">Next</a>

                  </div>

                  <br>

                  <br>

                  </center>

                </div>

                <div class="tab-pane" id="tab2">

                </div>

                <div class="tab-pane" id="tab3">

                  <center>

                  <br>

                  <h2>Your Data :</h2>

                  <hr style="width: 60%">

                  <table style="font-size: 12pt;">

                    <tr>

                      <td width="40%">Company Name</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="full-name-agentsea"><?php echo $company_name ?></td>

                    </tr>

                    <tr>

                      <td width="40%">Nationality</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="nationality-agentsea"><?php echo $kenegaraan; ?></td>

                    </tr>

                    <tr>

                      <td width="40%">Phone Number</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="phone-agentsea"><?php echo $no_telp ?></td>

                    </tr>

                    <tr>

                      <td width="40%">Contact Person</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="cp-agentsea">Engine</td>

                    </tr>

                    <tr>

                      <td width="40%">Email</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="email-agentsea"><?php echo $email_agentsea ?></td>

                    </tr>

                  </table>

                  <br>

                  <div class="pull-left">

                  <a class="btn btn-primary btnPrevious">Previous</a>

                  </div>

                  <div class="pull-right">

                  <a class="btn btn-success" id="submit-activation">Submit</a>

                  </div>

                  <br>

                  <br>

                  </center>

                </div>

              </div>

              <input type="hidden" name="username_agentsea" value="<?php echo $dt_username ?>">

              <input type="hidden" name="email_agentsea" value="<?php echo $dt_email ?>">

              <input type="hidden" name="id_agentsea" value="<?php echo $id_agentsea ?>">

              <input type="hidden" name="x" value="1">

              </form>

        </div>

        <div class="col-md-2">&nbsp;</div>
    </div>

    

</section>

    <?php $this->load->view("footer",$dt_footer); ?>

  <script type="text/javascript" src="<?php echo asset_url('plugin/sweet_alert/sweetalert.js') ?>"></script>

<script type="text/javascript">

$("#lastNext").click(function () {

  // $("#full-name-agentsea").html($("#first_name").val()+" "+$("#last_name").val());

  var nationalitynya = $("#ext_num option:selected").text().split(" - ");

  $("#nationality-agentsea").html(nationalitynya[1]);

  // $("#phone-agentsea").html("<?php //echo $ ?>");


  $("#cp-agentsea").html($("#contact_person").val());

})

var full_width = 100;

function get_rank(dept_id) {

  var data = "dept_id="+dept_id;

  $.ajax({

    data: data,

    url : "<?php echo base_url() ?>users/get_rank",

    type: "POST",

    success:function (output) {

      $("#rank_choice").html(output);

    }

  });

}

var value_lama = "<?php echo $first_name ?>";

$(document).ready(function () {

  

  if("<?php echo $first_name ?>" != "" && "<?php echo $last_name ?>" != "") {

    move(min, persen+=50, 1);

      min+=50;

    }

  else if("<?php echo $first_name ?>" != "") {

    move(min, persen+=25, 1);

      min+=25;

  }

  else if("<?php echo $last_name ?>" != "") {

    move(min, persen+=25, 1);

      min+=25;

  }

})



  $("#submit-activation").click(function () {

    var data = $("#form-activation-agentsea").serialize();

    $.ajax({

    	data: data,

    	type: "POST",

    	url : "<?php echo base_url('users/company_process/activate_process') ?>",

    	success:function(output){

        //alert(output);

    		output = output.split("|");

    		swal(output[2], output[1], output[2]);

    		setTimeout(function () {

    		// 	// body...

    			window.location = '<?php echo base_url("users/login_company") ?>';

    		}, 3000);

    		

    	}

    });

  })
  var isi_form = {ext_num: "", phone_number: "", contact_person: ""};
  function fill_progress(id, dibagi) {

    // body...

    var type = $("#"+id).prop("nodeName");

    var value = $("#"+id).val();

    

    dibagi = Math.ceil(full_width/dibagi);



    if(type == "SELECT"){

      if(id == "ext_nums") {

        if(!sudah_pilih_negara){

          sudah_pilih_negara=true;

          update_progress_bar(value, dibagi);

        }

      }

      else if(id.indexOf('dept')) {

        if(!sudah_pilih_dept){

          sudah_pilih_dept=true;

          update_progress_bar(value, dibagi);

        }

      }

      else if(id.indexOf('rank')) 

      {

        if(!sudah_pilih_rank){

          sudah_pilih_rank=true;

          update_progress_bar(value, dibagi);

        }

      }

    }

    else{

      if((isi_form[id] == "" && value != "") || (isi_form[id] != "" && value == "")) update_progress_bar(value, dibagi);
    isi_form[id] = value;

    }

  }



  function update_progress_bar(value, dibagi) {
      // $("#lastNext").hide();
    
    if(value == ""){

      

      move(min, persen-=dibagi, 0);

      min-=dibagi;


    }

    else{

      value_lama = value;

      move(min, persen+=dibagi, 1);

      min+=dibagi;

    }

  }



  var sudah_pilih_negara = false;

  var sudah_pilih_dept = false;

  var sudah_pilih_rank = false;

$("#lastNext").hide("fast");

  function move(min,max, next) {
$("#lastNext").css("display", "none");
    // var elem = document.getElementById("mybar"); 

    var width = min;

    if(min >= 0 && max <= 101){

    var id = setInterval(frame, 10);

    // $("#lastNext").hide("fast");

    function frame() {

      if(next==1){

        if (width >= max || width == 100) {

            clearInterval(id);

        } else {

            width++; 

            $("#myBar").css("width", width + '%');

            $("#myBar #label").html(width + '%');



            if(width > 25) {

              $("#myBar").css("background-color", 'yellow');

              $("#myBar #label").css('color', "black");

            }

            if(width > 75) {

              $("#myBar").css("background-color", 'green');

              $("#myBar #label").css('color', "white");

            }

            if(width >= 100) $("#lastNext").show("fast");



            // elem.style.width = ; 

        }

      }

      else{

       if (width <= max || width == 0) {

            clearInterval(id);

        } else {

            width--; 

            $("#myBar").css("width", width + '%');

            $("#myBar #label").html(width + '%');

            // elem.style.width = ; 

        } 

        

    }

      }

    }

}

// var no=1;

var min = 0;

var persen = 0;

   $('.btnNext').click(function(){

  $('.nav-tabs > .active').next('li').find('a').trigger('click');

  // move(min, persen+=50, 1);

  // min+=50;

  });



    $('.btnPrevious').click(function(){

    $('.nav-tabs > .active').prev('li').find('a').trigger('click');

    // move(min, persen-=50, 0);

    // min-=50;

  });

    

  

  



</script>

  </body>



</html>