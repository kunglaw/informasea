
   <div class="panel-heading-vacantsea">
   	<h2><b> Information </b></h2>
   </div>
   <hr />
   
    <?php
	
	for($i=0;$i<3; $i++){
		 // $annual_sallary = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
		 // $rank = $this->rank_model->get_rank_detail($row['rank_id']);
		 // $nationality = $this->nation_model->get_detail_nationality($row['id_nationality']);
		 // $jml_applicant = $this->vacantsea_model->jml_applicant($row['vacantsea_id'],$id_user);
	?>
         <div class="row-tml container">
        	<!-- <div id="profile-pic" class="">
            	<a href="#"> <img src="<?php //echo base_url("assets/ulogo/".$this->company_model->get_logoimage($row['id_perusahaan'])) ?>" alt="" id="img-profile-company" class="img-rounded" style="border:1px solid #CCC" height="54" width="102" /> </a>
            </div> -->
            
        	<div class="" id="" style="">
            	<p class="">
                <b class=""><a href="#"> Informasi <?php echo $i+1 ?> </a> </b>
                
      	         <!--<?php //$check_applicant = $this->vacantsea_model->check_applicant($row['vacantsea_id']); 
		  
				  // if(!empty($check_applicant))
				  // {
					 //  $title_applied = "you are already applied this vacantsea.";
					 //  echo "<span class='label label-success pull-right' title='$title_applied'> Already Applied </span>";
				  // }
				  
				  ?>
                  
                
                </p>-->
               
                <div class=""><b>Tuesday, March 31 at 19:25 </b></div> 
                
            </div>
            
       	  </div><!-- row-tml -->
          <br>
          <div style="margin:5px 0 10px 10px" align="justify">
		  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
		  <!--<?php //	echo !empty($row['description']) ? word_limiter($row['description'],100) : " Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ";   ?>-->
          </div>
          
          <!-- <span class="pull-left" >Posted : <?php //echo date_format_simple($row['create_date']); ?></span> -->
          <!-- <?php// $applicant = "<span class='pull-right'><a href='#'>See $jml_applicant Applicant</a></span>";
		  
		  // if($jml_applicant > 0)
		  // {
			 //  echo $applicant;
		  // }
		  
		  ?>
          <span class="clearfix"></span>
            
          </div><! content-tml -->
          <hr /> 
          
    <?php
	}
	
	?>
      
    
    <?php
   //}	
	?> 
          
    <?php // paging
	 // $v = 0;
	 // if(count($job) >= 10)
	 // {
	 // 	$v = $this->vacantsea_model->check_sisa_list($row['vacantsea_id']);	
	 // }
	 // if($v > 0){
	 ?>
     <!--
     1. id = $row['vacantsea_id'].
     2. dikirim ke ajax, ditampung dlm var vacantesa_id.
     3. kirim ke controller
     
     -->
      <!-- <a id="<?php //echo $row['vacantsea_id']; ?>" href="#" class="load_data" >
    
        <span class="style_fb" id="style_fb">Show More <img src="<?php //echo base_url("assets/img/arrow1.png"); ?>" /> </span> 
        <input type="hidden" id="setting" class='10'> <! ganti class="  " kalo mau ganti jumlah vacantsea yg tampil-->
        <!--<form id="parameter-paging">
          <input type="hidden" value="<?php //echo !empty($keyword) ? $keyword : "" ?>" name="keyword" id="keyword" />
          <input type="hidden" value="<?php //echo !empty($sallary) ? $sallary : "" ?>" name="sallary" id="sallary" />
          <input type="hidden" value="<?php //echo !empty($ship_type) ? $ship_type : "" ?>" name="ship_type" id="ship_type" />
          <input type="hidden" value="<?php //echo !empty($department) ? $department : "" ?>" name="department" id="department" />
          <input type="hidden" value="<?php// echo !empty($rank_id) ? $rank_id : "" ?>" name="rank_id" id="rank_id" />
          <input type="hidden" value="<?php //echo !empty($coc_class) ? $coc_class : "" ?>" name="coc_class" id="coc_class" />
          
          <! untuk dapat dilihat prosesnya kemana -->
          <!--<input type="hidden" value="<?php //echo !empty($page) ? $page : "" ?>" name="page" id="page" />
        </form>
      
      </a> -->
     <?php
	 // }
	 // else
	 // {
	 	?>
        
   
        <!-- <span>There is no data </span> -->
      
        
		 
	 <?php 
	 // }
     ?> 
     <hr class="" style="border:1px double black"  /> 
          