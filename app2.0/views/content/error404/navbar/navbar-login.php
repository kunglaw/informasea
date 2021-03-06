<?php
    $url = base_url();
	$user = $this->session->userdata("user");
    $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
  	$this->load->helper('list_error_users_helper');
  	
	// facebook app 
	//$this->load->view("facebook_app/facebook_login");
	
	// google app
	//$this->load->view("google_app/google_login");
?>

<link rel="stylesheet" type="text/css" href="<?=asset_url("css/social-buttons-3.css")?>" />
<!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.2/css/font-awesome.min.css" rel="stylesheet"> -->
<nav class="navbar navbar-default navbar-fixed-top hidden-xs" role="navigation">
    <div class="container-fluid">
       <div class="block-home">   
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?=base_url("home")?>">
                  <img src="<?php echo asset_url("img/logo.png")?>" alt="logo">
              </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="mobile-menu">
           
              <ul class="nav navbar-nav main-menu text-white hidden-md hidden-sm">
                <!--   <li>
                  	  <a href="<?= base_url("dashboard"); ?>" >
                  		<span class="nav-sprite text-center" aria-hidden="true"></span>DASHBOARD
                      </a>
                  </li> -->
                  <li>
                  	  <a href="<?= base_url("vacantsea"); ?>">
                      	<span class="nav-sprite text-center" aria-hidden="true"></span>VACANTSEA
                      </a>
                  </li>
                  <li>
                  	  <a href="<?= base_url("seatizen"); ?>">
                      		<span class="nav-sprite text-center" aria-hidden="true"></span>SEATIZEN
                      </a>
                  </li>
                  <li><a href="<?=base_url("agentsea");?>"><span class="nav-sprite text-center" aria-hidden="true"></span>AGENTSEA</a></li>
              </ul>
              <form role="search" class="navbar-form navbar-search-form navbar-left" action="<?=base_url("search")?>" method="get">
                  <div class="input-group">
                      <input type="text" class=" search-query form-control" placeholder="Search Informasea" name="keyword" id="keyword"/>
                      <span class="input-group-btn">
                          <button class="btn btn-nav-search" type="button">
                              <span class=" glyphicon glyphicon-search"></span>
                          </button>
                      </span>
                  </div>
              </form>
              
              <?php ?>
             
          </div>
          <!-- /.navbar-collapse -->
       </div> 
    </div>
    <!-- /.container-fluid -->
</nav>
<?php //$this->load->view('modal-report'); ?>
<?php
$id_user = $this->session->userdata("id_user");

?>
<div class="modal fade modal-resume" id="modal-form-add-document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"><!-- large -->
    <div class="modal-content"> 
      <div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
          <h4> Report Problem <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h4>
            
        </div>

<!--        --><?php //print_r($myDocument); ?>
         
      <div class="modal-body">
          <script>
        function add_document_process()
      {
        var data = $("#form-add-document form").serialize();
//                alert(data);

        $.ajax({

          type:"POST",
          url:"<?php echo base_url("seaman/resume_process/add_document_process"); ?>",
          data: data,
          success:function(data){

            $("#info").html(data);
                        //$("#modal-form-add-document").hide();
                        //location.reload();
          },
                    error:function(ds){
                        alert("error nih :(");
                    }
        });
      }
      
      $("#add-document-btn").click(function(){
        add_document_process();
      });
      
      </script>
          <div id="form-add-document">
            <div id="info">   
            

            </div>
          <form>
                <?php // via json encode ?>
                <div class="form-group">
                  <input type="hidden" value="<?php echo $id_pelaut; ?>" name="pelaut_id" />
                  <input type="hidden" value="document" name="source" />
                  <input type="hidden" value="<?php echo $this->session->userdata("username"); ?>" name="username" />
            
                <label for="doc_type">
                        Country
                    </label>
                    <!-- <input type="" title="autocomplete" name="vessel_name" id="vessel_name" data-id="id_ship" class="form-control" style="width:80%" > -->
                    <select class="form-control" style="width: 50%;" name="national">
                        <option value="">- select -</option>

                        <?php

                        $this->load->model('nation_model');
                        $user = $this->nation_model->get_nationality_pelaut($id_user);                      
                        $nation = $this->nation_model->get_nationality_except($user['kebangsaan']);

                        $k = $this->db->query("SELECT country FROM document_tr WHERE pelaut_id = '$id_user' AND 
                            type_document = 'document'");
                        $l = $k->result_array();
                        foreach($l as $m){
                            $n[] = $m['country'];
                        }

                       //$nation = $this->nation_model
                            foreach($nation as $row)
                            {
                                if(!in_array($row['name'],$n)){ ?>

                                <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                               <?php         }   
                                    else {

                                    }
                                ?>
                                <?php
                            }
                        ?>
                      
                    </select>

                    <br><!--
                   <input type="text" value="" name="type" id="type" placeholder="type of document .. " class="form-control" style="width:80%;" /> -->

              </div>
                
                <div class="form-group">
                <label for="number">
                        Number
                    </label>
                    
                    <input type="text" value="" name="number" id="number" placeholder="" class="form-control" style="width:80%"  />
                    
                  
              </div>
                <div class="form-group">
                  <label for="place">
                         Issued Place
                    </label>
                    <input type="text" value="" name="place" id="place" class="form-control" style="width:80%"  />
                
                </div>
                <div class="form-group">
                    <label for="date_issued">
                        <?php //$date_issued_lbl?>
                        Issued date
                    </label>
                    <input type="text" value="" name="date_issued" id="date_issued" class="form-control" style="width:80%" autocomplete="off">

                </div>
<!--                <div class="form-group">-->
<!--                  <label for="date_issued">-->
<!--                        Date Issued-->
<!--                    </label>-->
<!--                    <input type="" title="" name="date_issued" id="date_issued" class="form-control" style="width:80%" autocomplete="off" >-->
<!--                -->
<!--                </div>-->
                <div class="form-group">
                  <label for="expired_date">
                        <?php //$date_expired_lbl?>
                            Expiry date
                    </label>
                    <input title="" name="date_expired" id="date_expired" class="form-control" style="width:80%" autocomplete="off">
                
                </div>
                 
                <button class="btn btn-success" id="add-document-btn" type="button"> <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Save </button>
          <button class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Cancel </button>
            </form>
          </div>
        </div><!-- modal-body -->
        
    </div><!-- modal-content -->
  </div><!-- modal-dialog --> 
</div><!-- modal -->




<script>
	$('#error-tip').popover({
		trigger: 'hover',
		'placement': 'left',
		html:true,
		animation:true
		
	});

</script>