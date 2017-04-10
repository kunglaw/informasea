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

        <?php //$this->load->view("left-content/left-seatizen") ?>

        

        



        <div class="col-md-2">&nbsp;</div>

        <div class="col-md-8 text-white m-t-1">

            <form class="transparent register-form" id="form-activation-seatizen">



              <ul class="nav nav-tabs">

                <li class="active"><a href="#tab1" data-toggle="tab" disabled="disabled">Step 1</a></li>

                <li><a href="#tab2" data-toggle="tab" disabled="disabled">Step 2</a></li>

                <li><a href="#tab3" data-toggle="tab" disabled="disabled">Summary</a></li>

              </ul>

              <div class="tab-content">

                <div class="tab-pane active" id="tab1">

                <center>

              <br>

                <div class="form-group pull-left" style="width: 49%">

                  <label for="first_name" class="pull-left">First Name</label>

                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" 
                    onblur="fill_progress('first_name',2)" value="<?=$first_name?>">

                </div>

                <div class="form-group pull-right" style="width: 49%">

                  <label for="last_name" class="pull-left">Last Name</label>

                    <input type="text" class="form-control" name="last_name" onblur="fill_progress('last_name',2)" id="last_name" placeholder="Last Name" value="<?=$last_name?>">

                </div>

                

              <br>



                <div class="pull-right">

                  <a class="btn btn-primary btnNext">Next</a>

                  </div>

                  <br>

                  <br><br>

                  <br>

                  </center>

                </div>

                <div class="tab-pane" id="tab2">

                <center>

                  

                  <br>

                  <div class="form-group" style="width:60%">

                  <label for="ext_num" class="pull-left" >Nationality</label>

                    <span class="clearfix"></span>

                    <?php

            $ext_num = $this->nation_model->get_nationality();

          ?>

                    <select name="ext_num" id="ext_nums" class="form-control pull-left" style="width:100%;" onchange="fill_progress('ext_nums', 3)">

                      <option value="" disabled selected>- Select Your Nationality -</option>

                      <?php foreach($ext_num as $row){ ?>

                      <option value="<?php echo $row['kode_telp']."&"?><?php echo $row['id']?>" data-image="<?php echo strtolower(asset_url("flags/$row[flag]"))?>">

                          <?php echo $row['kode_telp']." - "?><?php echo $row['name']?>

                        </option>

                        <?php } ?>

                    </select>

                    

                    

                    <span class="clearfix"></span>

                </div>

                <div class="form-group" style="width:60%">

                  <label for="dept_choice" class="pull-left" >Department</label>

                    <span class="clearfix"></span>

                    <?php

                    $q = "select * from department";

                    $exec = $this->db->query($q);

                    $ext_num = $exec->result_array();

          ?>

                    <select name="dept_choice" id="dept_choice" class="form-control pull-left" style="width:100%;" onchange="get_rank(this.value);fill_progress('dept_choice', 3)">

                      <option value="" disabled selected>- Select Your Department -</option>

                      <?php foreach($ext_num as $row){ ?>

                      <option value="<?php echo $row['department_id']?>">

                          <?php echo $row['department']?>

                        </option>

                        <?php } ?>

                    </select>

                    

                    

                    <span class="clearfix"></span>

                </div>

                <div class="form-group" style="width:60%">

                  <label for="rank_choice" class="pull-left" >Rank</label>

                    <span class="clearfix"></span>

                    

                    <select name="rank_choice" id="rank_choice" class="form-control pull-left" style="width:100%;" onchange="fill_progress('rank_choice', 3)">

                      <option value="" disabled selected>- Please select your Department first -</option>

                      

                    </select>

                    <span class="clearfix"></span>

                </div>

                  <br>

                  <div class="pull-left">

                  <a class="btn btn-primary btnPrevious">Previous</a>

                  </div>

                <div class="pull-right">

                  <a class="btn btn-primary btnNext" id="lastNext">Next</a>

                  </div>

                  <br>

                  <br>

                  </center>

                </div>

                <div class="tab-pane" id="tab3">

                  <center>

                  <br>

                  <h2>Your Data :</h2>

                  <hr style="width: 60%">

                  <table style="font-size: 12pt;">

                    <tr>

                      <td width="40%">Full Name</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="full-name-seatizen">Raditya PRatama</td>

                    </tr>

                    <tr>

                      <td width="40%">Nationality</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="nationality-seatizen">Indonesia</td>

                    </tr>

                    <tr>

                      <td width="40%">Department</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="department-seatizen">Engine</td>

                    </tr>

                    <tr>

                      <td width="40%">Rank</td>

                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>

                      <td id="rank-seatizen">1st Engineer</td>

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

              <input type="hidden" name="username_seatizen" value="<?php echo $dt_username ?>">

              <input type="hidden" name="email_seatizen" value="<?php echo $dt_email ?>">

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

  $("#full-name-seatizen").html($("#first_name").val()+" "+$("#last_name").val());

  var nationalitynya = $("#ext_num option:selected").text().split(" - ");



  $("#nationality-seatizen").html(nationalitynya[1]);

  $("#department-seatizen").html($("#dept_choice option:selected").text());

  $("#rank-seatizen").html($("#rank_choice option:selected").text());

})



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
var last_name1 = $("#last_name").val();
var first_name1 = $("#first_name").val();
var first_name2 = first_name1.trim();
var last_name2 = last_name1.trim();

$(document).ready(function () {

  if((first_name2 != "" && last_name2 != "") && (first_name2.length > 2 && last_name2.length > 2) ) {
	  
      move(min, persen+=50, 1);
      min+=50;

  }

  else if(first_name2 != "" && first_name2.length > 2  ) {
	  
    move(min, persen+=25, 1);

      min+=25;

  }

  else if(last_name2 != "" && last_name2.length > 2 ) {
	
    move(min, persen+=25, 1);

      min+=25;

  }
  //alert(first_name2.length);

})



  $("#submit-activation").click(function () {

    var data = $("#form-activation-seatizen").serialize();

    $.ajax({

    	data: data,

    	type: "POST",

    	url : "<?php echo base_url('users/users_process/activate_process') ?>",

    	success:function(output){

    		output = output.split("|");

    		swal(output[2], output[1], output[2]);

    		setTimeout(function () {

    			// body...

    			window.location = '<?php echo base_url('seaman/resume') ?>';

    		}, 3000);

    		

    	}

    });

  })

  var isi_form = {first_name: "<?php echo $first_name ?>", last_name: "<?php echo $last_name ?>"};
  
  function fill_progress(id, dibagi) {

    // body...

    var type = $("#"+id).prop("nodeName");

    var value = $("#"+id).val();
	
	value = value.trim();

    dibagi = Math.ceil(50/dibagi);
    // alert(width);
    // $("#lastNext").hide("fast");
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

    if(value == ""){

      move(min, persen-=dibagi, 0);

      min-=dibagi;

		// console.log($("#lastNext").css("display"));
      

    }

    else{

      value_lama = value;

      move(min, persen+=dibagi, 1);

      min+=dibagi;

    }
    // alert(width);
    // if (width < 100) {console.log("saya masih di bawah 100");$("#lastNext").hide("fast");}
  }



  var sudah_pilih_negara = false;

  var sudah_pilih_dept = false;

  var sudah_pilih_rank = false;

$("#lastNext").hide("fast");
var width=0;

  function move(min,max, next) {

    // var elem = document.getElementById("mybar"); 

    width = min;

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
            // console.log(width);
            if(width >= 100) {console.log("saya sudah 100++"); $("#lastNext").show("fast");}



            // elem.style.width = ; 

        }

      }

      else{

       if (width <= max || width == 0) {
       	// console.log("saat berkurang : "+width);
       		$("#lastNext").css("display", "none");

            clearInterval(id);
            
        } else {
            width--; 
            $("#myBar").css("width", width + '%');
            $("#myBar #label").html(width + '%');

            if(width > 75) {

              $("#myBar").css("background-color", 'green');

              $("#myBar #label").css('color', "white");

            }else if(width > 25) {

              $("#myBar").css("background-color", 'yellow');

              $("#myBar #label").css('color', "black");

            }
            else{
            	$("#myBar").css("background-color", 'red');

              	$("#myBar #label").css('color', "white");
            }
            


            

            // elem.style.width = ; 

        } 

        

    }

      }

    }
    // console.log(width);
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