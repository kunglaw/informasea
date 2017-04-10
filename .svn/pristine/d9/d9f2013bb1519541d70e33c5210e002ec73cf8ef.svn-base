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
				url:url_action,																// parameter dari load data
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
   	<h2><b> Vacantsea </b></h2>
   </div>
   <hr />
   
    <?php
	
	foreach($vacantsea as $row){
		 $annual_sallary = $row['annual_sallary'] > 0 ? "<b>Annual Sallary: </b>"."<b style='color:#5cb85c'>".$row['sallary_curr']." ".number_format($row['annual_sallary'])."</b>" : "";
		 $rank = $this->rank_model->get_rank_detail($row['rank_id']);
		 $nationality = $this->nation_model->get_detail_nationality($row['id_nationality']);
		 $jml_applicant = $this->vacantsea_model->jml_applicant($row['vacantsea_id'],$id_user);
	?>
         <div class="row-tml container">
        	<div id="profile-pic" class="">
            	<a href="#"> <img src="<?php echo base_url("assets/ulogo/".$this->company_model->get_logoimage($row['id_perusahaan'])) ?>" alt="" id="img-profile-company" class="img-rounded" style="border:1px solid #CCC" height="54" width="102" /> </a>
            </div>
            
        	<div class="" id="" style="">
            	<p class="mini-margin-6">
                <b class="mini-margin-6"><a href="<?php echo base_url("vacantsea/detail/".$row['vacantsea_id']); ?>" style="line-height:12px !important;"> <?php echo ucfirst($row["perusahaan"])  ?> </a> </b>
                
                 <?php $check_applicant = $this->vacantsea_model->check_applicant($row['vacantsea_id']); 
		  
				  if(!empty($check_applicant))
				  {
					  $title_applied = "you are already applied this vacantsea.";
					  echo "<span class='label label-success pull-right' title='$title_applied'> Already Applied </span>";
				  }
				  
				  ?>
                  
                
                </p>
               
                <p class="mini-margin-6"><?php echo $nationality['name'] ?></p>
                <div class="mini-margin-6"><b><?php echo isset($row['rank_id']) ? $rank['rank'] : ""; ?></b></div> 
                
            </div>
            
       	  </div><!-- row-tml -->
          
         <div id="" class="row" style="margin:20px 0 0 0">
          <div><b><a href="<?php echo $this->vacantsea_model->url_segment_db($row['vacantsea_id']);?>"> <?php  echo $row['vacantsea']; ?> </a></b></div>										
          <div><?php echo $annual_sallary ?></div>
          
          <div style="margin:5px 0 10px 10px">
		  <?php 	echo !empty($row['description']) ? word_limiter($row['description'],100) : " There is no description in this Job Vacantsea ";   ?>
          </div>
          
          <span class="pull-left" >Posted : <?php echo date_format_simple($row['create_date']); ?></span>
          <?php $applicant = "<span class='pull-right'><a href='#'>See $jml_applicant Applicant</a></span>"; 
		  
		  if($jml_applicant > 0)
		  {
			  echo $applicant;
		  }
		  
		  ?>
          <span class="clearfix"></span>
            
          </div><!-- content-tml -->
          <hr /> 
          
    <?php
	}
	
	?>
      
    
    <?php
   //}	
	?> 
          
    <?php // paging
	 $v = 0;
	 if(count($job) >= 10)
	 {
	 	$v = $this->vacantsea_model->check_sisa_list($row['vacantsea_id']);	
	 }
	 if($v > 0){
	 ?>
     <!--
     1. id = $row['vacantsea_id'].
     2. dikirim ke ajax, ditampung dlm var vacantesa_id.
     3. kirim ke controller
     
     -->
      <a id="<?php echo $row['vacantsea_id']; ?>" href="#" class="load_data" >
    
        <span class="style_fb" id="style_fb">Show More <img src="<?php echo base_url("assets/img/arrow1.png"); ?>" /> </span> 
        <input type="hidden" id="setting" class='10'> <!-- ganti class="  " kalo mau ganti jumlah vacantsea yg tampil-->
        <form id="parameter-paging">
          <input type="hidden" value="<?php echo !empty($keyword) ? $keyword : "" ?>" name="keyword" id="keyword" />
          <input type="hidden" value="<?php echo !empty($sallary) ? $sallary : "" ?>" name="sallary" id="sallary" />
          <input type="hidden" value="<?php echo !empty($ship_type) ? $ship_type : "" ?>" name="ship_type" id="ship_type" />
          <input type="hidden" value="<?php echo !empty($department) ? $department : "" ?>" name="department" id="department" />
          <input type="hidden" value="<?php echo !empty($rank_id) ? $rank_id : "" ?>" name="rank_id" id="rank_id" />
          <input type="hidden" value="<?php echo !empty($coc_class) ? $coc_class : "" ?>" name="coc_class" id="coc_class" />
          
          <!-- untuk dapat dilihat prosesnya kemana -->
          <input type="hidden" value="<?php echo !empty($page) ? $page : "" ?>" name="page" id="page" />
        </form>
      
      </a>
     <?php
	 }
	 else
	 {?>
        
   
        <span>There is no data </span>
      
        
		 
	 <?php 
	 }
     ?> 
     <hr class="" style="border:1px double black"  /> 
          