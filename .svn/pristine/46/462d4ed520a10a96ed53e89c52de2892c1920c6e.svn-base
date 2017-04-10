<?php //experience, page experience, profile, module user ?>
<div class="box">
  <div class="box-header">
      <h4 class="box-heading header-text">Experience
      <button class="btn btn-filled btn-sm pull-right" id="experience-btn" modal="form-add-experience"> 
          <span class="glyphicon glyphicon-plus"></span> Add 
      </button>
      </h4>
      
      <span class="clearfix"></span>
  </div>
  
  <div class="box-content">
    <div class="jajamama"></div>
    <span class="clearfix"></span>
    <table class="table table-bordered" id="data-table-experience" style="font-size:12px">
        <thead style="font-weight:bold; " class="bg-primary">
        <tr>
          <td width="">Vessel Name</td>
          <td width="">Vessel Type </td>
          <td>Size</td>
          <td>Rank</td>
          
          <td>Company</td>
          <td>Trade Area Line</td>
         
          <td width="20%">Periode</td>
          <td width="15%">Action</td>
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
          <td ><?php echo $row['ship_name'] ?> </td>
          <td ><?php echo $vessel_type['ship_type'] ?> </td>
          <td ><?php echo $row['weight']." / ".$row['satuan']  ?></td>
          
          <td><?php  echo $rank['rank'] ?> </td>
          
          <td><?php echo $row['company'] ?></td>
          <td><?php echo $row['trade_area']; ?></td>
          <td ><?php echo $periode_from ?> - <?php echo $periode_to; ?></td>
          <td> 
            <button class="btn btn-default btn-xs experience-update-btn" modal="form-update-experience" title="Update" 
            onclick="javascript:update_experience(<?php echo $row['experience_id']?>)">
                <span class="glyphicon glyphicon-edit"></span> 
            </button>
            
            <button class="btn btn-default btn-xs experience-delete-btn" modal="delete-experience-modal" 
            onclick="javascript:delete_experience(<?php echo $row['experience_id']?>)" title="Delete">
                <span class="glyphicon glyphicon-remove"></span> 
            </button>
            
            <button id="data-update" type="button" class="btn btn-default btn-xs" data-toggle="popover" 
            data-content="Created: <?php echo $create_date; ?> <br> Updated : <?php echo $last_update; ?> " ><i class="glyphicon glyphicon-calendar"></i></button>  
          </td>
        </tr>
        <?php
            }
        ?>
       </tbody>
    </table>
	</div>
</div>