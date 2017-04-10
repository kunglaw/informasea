<?php //experience free, page experience, profile, module user ?>
<div class="box">
    <div class="box-header">
        <h4 class="box-heading header-text">Experience
        </h4>
        
        <span class="clearfix"></span>
    </div>
    
    <div class="box-content">
      <table id="data-table-experience" class="table table-bordered" style="font-size:12px">
          <thead style="font-weight:bold; " class="bg-primary">
          <tr>
            
            <td width="">Vessel Type </td>
            <td>Rank</td>
            
            <td>Company</td>
            <td>Trade Area Line</td>
           
            <td width="20%">Periode</td>
          </tr>
         </thead>
         <tbody>
          <?php
              $this->load->model("vessel_model");
              
              $vessel_model = $this->vessel_model;
          
              foreach($experience as $row)
              {
                  //$vessel_name = $vessel_model->get_ship_detail($row['ship_id']);
                  $vessel_type = $vessel_model->get_ship_type_detail($row['ship_type_id']);
                  $rank 		= $this->resume_model->get_rank_detail($row['rank_id']);
                  
                  $periode_from = date("M d, Y",strtotime($row['periode_from']));
                  $periode_to = date("M d, Y",strtotime($row['periode_to']));
                  $create_date = date("M d, Y",strtotime($row['datetime']));
                  $last_update = date("M d, Y",strtotime($row['last_update']));
                   
          ?>
          <tr>
            
            <td ><?php echo $vessel_type['ship_type'] ?> </td>
            
            <td><?php  echo $rank['rank'] ?> </td>
            
            <td><?php echo $row['company'] ?></td>
            <td><?php echo $row['trade_area']; ?></td>
            <td ><?php echo $periode_from ?> - <?php echo $periode_to; ?></td>
            
          </tr>
          <?php
              }
          ?>
         </tbody>
      </table>
	</div>
</div>