<div class="box-header">

    <h3><?=$this->lang->line("certificate")?>/<?=$this->lang->line("document")?> <?=$this->lang->line("upload")?> 

    <button class="btn btn-filled btn-sm pull-right" id="resume-upload-btn" modal="form-upload-resume"> 

        <span class="glyphicon glyphicon-plus"></span> <?=$this->lang->line("add")?> 

    </button>

    </h3>

        <div class="subtitle pull-left text-gray">


		<?=$this->lang->line("document_upload_desc")?>
      </div>

    

    <span class="clearfix"></span>

</div>

  <div class="hasilupload"></div>

  <span class="clearfix"></span>

<table class="table table-bordered">

    <thead>

    <tr>

      <th><?=$this->lang->line("title")?> </th>

      <th><?=$this->lang->line("upload_date")?> </th>

    </tr>

    </thead>

   <tbody>

    <?php

        //$this->load->model("vessel_model");

    

       // $vessel_model = $this->vessel_model;

        $no =1;

        foreach($file_resume as $row)

        {

            //$vessel_name = $vessel_model->get_ship_detail($row['ship_id']);

         $title  = $row['title'];

        $uploadtime = $row['datetime'];

    ?>

    <tr>

      <td ><?php echo $title; ?> </td>

      <td ><?php echo $uploadtime  ?>

        <span class="pull-right">



          <a class="btn btn-default btn-xs experience-update-btn" href="<?php echo base_url("seaman/resume/download_resume/$row[id_resume_file]") ?>">

            <span class="glyphicon glyphicon-download"></span> 

        </a>

        

        <button class="btn btn-default btn-xs experience-delete-btn" modal="modal-delete-resume-upload" 

        onclick="javascript:delete_resume(<?php echo $row['id_resume_file']?>)" title="Delete">

            <span class="glyphicon glyphicon-remove"></span> 

        </button>



        </span>



      </td>

       

    </tr>

    <?php

        }

    ?>

   </tbody>

</table>