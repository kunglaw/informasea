
<?php //experience, page experience, profile, module user ?>
<div class="box">
  <div class="box-header">
      <h4 class="box-heading header-text">Resume Upload </h4>
      
      <span class="clearfix"></span>
  </div>
  
  <div class="box-content">
    <div class="jajamama"></div>
    <span class="clearfix"></span>
    <table class="table table-bordered" id="data-table-experience" style="font-size:12px">
        <thead style="font-weight:bold; " class="bg-primary">
        <tr>
          <td width="">No </td>
          <td width="">Title </td>
          <td>Upload date </td>
        </tr>
        </thead>
       <tbody>
        <?php
            $this->load->model("vessel_model");
        
            $vessel_model = $this->vessel_model;
            $no =1;
            foreach($file_resume as $row)
            {
                //$vessel_name = $vessel_model->get_ship_detail($row['ship_id']);
             $title  = $row['title'];
            $uploadtime = $row['datetime'];
        ?>
        <tr>
          <td ><?php echo $no++; ?> </td>
          <td ><?php echo $title; ?> </td>
          <td ><?php echo $uploadtime  ?></td>
        </tr>
        <?php
            }
        ?>
       </tbody>
    </table>
	</div>
</div>