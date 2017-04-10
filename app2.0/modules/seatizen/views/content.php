<?php $this->load->view('css'); 

/*

 *

 * Created by PhpStorm.

 * User: a

 * Date: 12/06/2015

 * Time: 20:38

 */

?>



<div class="col-md-9">

    <div class="row filter">

      <form id="frm-search-seatizen" action="" method="POST" role="form" class="form-inline-custom">

          <div class="m-b-1">

              <div class="form-group col-lg-12">

                

                  <input type="text" class="form-control" placeholder="Search name or nationality or ship type or department or rank or coc class " id="keyseatizen" 

                  value="<?php if(!empty($search_data['keyword'])) echo $search_data['keyword'] ?>">

                  </div>

              <span class="clearfix"></span>

          </div>

          <div>

               <div class="form-group col-lg-2 col-md-4 col-sm4 col-xs-4">

                  <select class="form-control" id="get_nation_seatizen">

                      <option value=""> <?=$this->lang->line("nation")?> </option>

                  </select>

              </div>

              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">

                  <select class="form-control" id="get_ship_vacant" name="id_ship">

                      <option value=""><?=$this->lang->line("vessel_type")?></option>

                  </select>

              </div>

              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">

                 <select class="form-control" id="get_department_vacant" name="id_dept">

          <option value=""> Departments</option>

          <!-- Rank Ajax List Here  -->

      </select>

              </div>

              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">

                  <select class="form-control" id="get_rank_vacant" name="id_rank">

          <option value="">Ranks</option>

      </select>

              </div>

              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">

                  <select class="form-control" id="get_coc_class" name="id_coc">

          <option value="">COC Class</option>

      </select>

              </div>

              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">

                  <button type="submit" class="btn btn-primary form-control" id="search_seatizen_btn" name="search"><?=$this->lang->line("search")?></button>

                  </div>

              <span class="clearfix"></span>

          </div>

          

      </form>

  </div>
	
    
    
    <?php 
	$segment3 = $this->uri->segment(3); 
	if(!empty($seatizen_all)) {
		
	  if($segment3 == 1 || empty($segment3)){ 
		  
		  $col = 6;
		  
	  ?>
    <?php if($is_preview && ($position == "top_left")){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }
            elseif ($is_preview) {
                generate_preview_ads('top_left');
             } 
             /*
            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database
            else{
                generate_ads_container($list_iklan['top_left']);
            }
            */
    ?>
    <span class="clearfix"></span>
	  <div class="row container">
  
		 <h4 class="text-gray"> Promote yourself by completing resume like seatizen below <a href="<?php echo base_url('seatizen/complete/resume') ?>">Complete Resume</a> </h4>
	  </div>
	  <div class="row seatizen-list-container" id="listnya">
		  <?php 
			  
				  include_once("content-item-complete.php"); 
			  
		  ?>
	  </div> <br>
	  <?php } 
	
	}?>
    
    
    <div class="row container">

        

        <h4 class="text-gray"> Seatizen List </h4> 

    </div>

    
    
    <div class="row seatizen-list-container" id="listnya">

        <?php $col = 6;

        include_once("content-item.php");

        ?>

    </div>

    <?php if($is_preview && ($position == "bottom_left")){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }
            elseif ($is_preview) {
                generate_preview_ads('bottom_left');
             } 
             /*
            aktifkan perintah ini jika ingin langsung tampil iklan berdasarkan database
            else{
                generate_ads_container($list_iklan['bottom_left']);
            }
            */
             ?>

    <!-- Paging Bawah -->

			

    <div class="row my-pagination">

	 

				<div class="pagination" style="float:right;">

                    <ul>

				<?php echo $pagination; ?>

				    </ul>

                </div>

    </div>

</div>



<?php 

    //echo $this->output->enable_profiler(TRUE);

$this->load->view("js_under") ?>



