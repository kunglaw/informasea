<?php $this->load->view('seatizen/css'); ?>
<?php
/*
 *
 * Created by PhpStorm.
 * User: a
 * Date: 12/06/2015
 * Time: 20:38
 */
$total_page = $total_vacant/5;
$view=1;
$username = $this->session->userdata("username");


$list_value = array(
    "0-1000000", "1000000-4999999", "5000000-9999999", "10000000-500000000"
);

$list_text = array(
    "&lt; 1.000.000", "1.000.000 - 4.999.999", "5.000.000 - 9.999.999", "&gt; 10.000.000"
)

?>
<div class="col-md-9">
    <div class="row filter">
        <form id="frm-search-vacantsea" action="" method="POST" role="form" class="form-inline-custom">
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <input id="key-vacant" type="text" class="form-control" name="" rows="1"
                       placeholder="<?=$this->lang->line("key_search_placeholder")?>" value="<?php if(!empty($search_data['keyword'])) echo $search_data['keyword'] ?>">
            </div>
             <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <select class="form-control" id="get_ship_vacant" data-align="right" name="get_ship_vacant">
                   
                </select>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <select class="form-control" id="list-dept-vacant" name="list-dept-vacant">
                    <!-- Rank Ajax List Here -->
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select class="form-control" id="list-rank-vacant" name="list-rank-vacant">
                    <option value="">Ranks</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <button type="submit" id="src-vacant-btn" class="btn btn-primary form-control"><?=$this->lang->line("search")?></button>
            </div>
            <span class="clearfix"></span>
        </form>
    </div>
    <div class="row">
        <h4 class="text-gray">Vacantsea List 
        
            <?php if($this->uri->segment(3) != "" OR $_GET['department'] != "" OR $_GET['rank'] != "" OR $_GET['sallary'] != "" ){
                echo " : ";
            }
			
			$sess_username = $this->session->userdata("username");
			if(!empty($sess_username))
			{
				
				$pelaut = $this->user_model->get_detail_pelaut($username);
				  
				$department = $this->department_model->get_detail_department($pelaut["department"]);
				
				if($page == "all")
				{
				  $btn_dept = "<a href='".base_url("vacantsea")."'> View as $department[department] </a>";
				  echo " > all | $btn_dept";
				}
				else
				{
				  
				  
				  $btn_view_all = "<a href='".base_url("vacantsea/all")."'> view all </a>";
				  
				  echo " > Department : ".$department["department"]." | $btn_view_all"; 
				}
			}
			else
			{
				echo " > all";
			}
		  // echo ($is_preview) ? "ini hanya preview" : "";

            ?>

            <?php if($this->uri->segment(3) != "" AND $this->uri->segment(2) != "index"){ 
            echo $this->uri->segment(3);  } 
            if($_GET['department'] != "" AND $this->uri->segment(3) != ""){
                echo "/".str_replace('-',' ',$_GET['department']) ;
            } else{
                echo str_replace('-', ' ', $_GET['department']);
            }


            if($_GET['rank'] != ""){
                echo "/".str_replace('-',' ',$_GET['rank']); 
            }

            if($_GET['sallary'] != "" AND ($_GET['department'] != "" OR $_GET['rank'] != "" OR $this->uri->segment(3) != "")){
                echo "/".str_replace('-',' ',$_GET['sallary']);
            }else{
                echo str_replace('-',' ',$_GET['sallary']);
            }

             ?></h4>

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
            */ ?>
             
    </div>
    <!-- Paging atas -->
    <!-- <div class="row my-pagination">
        <div class="pull-right"> -->
            <?//= $pagination ?>
<!--            <a class="text-link first-data btn btn-primary" style="background-color: transparent" style="border-bottom: 1px" id="--><?//=$id_pertama?><!--" href="#1">First</a>-->
<!--            <a class="text-link prev-data btn btn-primary" style="background-color: transparent" id="--><?//=$id_pertama?><!--" href="#">Previous</a>-->
<!--            --><?php
//            /* Menampilkan paging */
//            if($total_vacant > 5) :
//                for($x=0;$x<$total_page;$x++):
//                    if($x==0) $class = "text-link disabled";
//                    else $class = "text-gray"; ?>
<!--                    <a class="btn btn-primary --><?//=$class?><!--" id="link-pg---><?//=$x+1?><!--" style="background-color: transparent" href="#">--><?//=$x+1?><!--</a>-->
<!--                --><?php
//                endfor;
//                ?>
<!--                <a class="text-link next-data btn btn-primary" style="background-color: transparent" id="--><?//=$id_pertama?><!--" href="#2">Next</a>-->
<!--                <a class="text-link last-data btn btn-primary" style="background-color: transparent" id="--><?//=$id_paling_akhir?><!--" href="#--><?//=$total_page?><!--">Last</a>-->
<!--            --><?php
//            endif;
//            ?>
      <!--   </div>
    </div> -->
    
    <div class="row vacantsea-list" id="listnya">
        <?php
        $col = 6;
        if($this->session->userdata('nama_perusahaan') OR $this->session->userdata('username_agent')){

            include_once("content-item_p.php");
        } else {
			
         	include_once("content-item.php");
        }
        ?>
    </div>
    <?php if($is_preview && ($position == 'bottom_left')){
                echo "<div class=\"col-md-12\">
                 <center><img src=\"".asset_url('img/ex_space_iklan.png')."\" width='700' height='90' alt='untuk banner iklan disini' style='padding: 10px 50px'></center>
             </div>";
            }elseif ($is_preview) {
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
        <?php if(!empty($username) && $x != 1){ ?>
        
        <?php } ?>
        <div class="pull-right pagination">

            <div class="pagination" style="float:right;">
           <ul>
            <?= $pagination ?>
        </ul>
<!--            <a class="text-link first-data btn btn-primary" style="background-color: transparent" style="border-bottom: 1px" id="--><?//=$id_pertama?><!--" href="#1">First</a>-->
<!--            <a class="text-link prev-data btn btn-primary" style="background-color: transparent" id="--><?//=$id_pertama?><!--" href="#">Previous</a>-->
<!--            --><?php
//            /* Menampilkan paging */
//            if($total_vacant > 5) :
//                for($x=0;$x<$total_page;$x++):
//                    if($x==0) $class = "text-link disabled";
//                    else $class = "text-gray"; ?>
<!--                    <a class="btn btn-primary --><?//=$class?><!--" id="link-pg---><?//=$x+1?><!--" style="background-color: transparent" href="#">--><?//=$x+1?><!--</a>-->
<!--                --><?php
//                endfor;
//                ?>
<!--                <a class="text-link next-data btn btn-primary" style="background-color: transparent" id="--><?//=$id_pertama?><!--" href="#2">Next</a>-->
<!--                <a class="text-link last-data btn btn-primary" style="background-color: transparent" id="--><?//=$id_paling_akhir?><!--" href="#--><?//=$total_page?><!--">Last</a>-->
<!--            --><?php
//            endif;        
              ?>
          </div>
         
        </div>
    </div>

    <div id="modal-login">
        <!--Ajax-->
    </div>
</div>

<?php //$this->load->view("js_under") ?>

