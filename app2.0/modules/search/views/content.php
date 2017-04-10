<?php
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
      <form id="frm-search" role="form" action="<?=base_url("search/filter")?>" method="post" >
          <div class="m-b-1">
            <div class="form-group col-lg-10">
              
           	<input name="keyword" type="text" class="form-control" placeholder="Search name or nationality or ship type or department or rank or coc class or anything " id="keyword" value="<?php if(!empty($keyword)) echo $keyword ?>">
           
            </div>
            
            <div class="col-lg-2">
              <button type="submit" class="btn btn-primary form-control" id="search-btn" name="search">Search</button>
            </div>
            
            <span class="clearfix"></span>
          </div>
          
          <!-- <div>
               <div class="form-group col-lg-2 col-md-4 col-sm4 col-xs-4">
                  <select class="form-control" id="get_nation_seatizen">
                      <option value=""> Nation </option>
                  </select>
              </div>
              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">
                  <select class="form-control" id="get_ship_vacant" name="id_ship">
                      <option value="">Ship Type</option>
                  </select>
              </div>
              <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-4">
                 <select class="form-control" id="get_department_vacant" name="id_dept">
                  <option value=""> Departments</option>
                  <!-- Rank Ajax List Here 
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
                  <button type="submit" class="btn btn-primary form-control" id="search_seatizen_btn" name="search">Search</button>
                <!---
                   <input type="submit" name="search" value="Search" class="btn btn-primary form-control"> 
               
                  </div>
              <span class="clearfix"></span>
          </div> -->
          
      </form>
   </div>
   
    <div class="row">
        <h4 class="text-gray"> Search Result :  <?=$keyword?></h4>
    </div>
  
    <div class="row" id="">
      
	  <?php
        foreach($dt as $row){
          if($row['category'] == "seaman")
          {
              $this->load->view("search/content/seaman_content",$row);
          }
		  else if($row['category'] == "agentsea")
		  {
			  $this->load->view("search/content/agentsea_content",$row);
		  }
		  else if($row['category'] == "vacantsea")
		  {
			  $this->load->view("search/content/vacantsea_content",$row);
		  }
        }
      ?> 
      
      <!-- <pre><?php //print_r($dt); ?></pre> -->
             
    </div>
  
    <!-- Paging Bawah -->
            
    <div class="row my-pagination">
     
                <div class="pull-right">
                <?php //echo $pagination; ?>
                </div>
    </div>
</div>

<?php $this->load->view("js_under") ?>
