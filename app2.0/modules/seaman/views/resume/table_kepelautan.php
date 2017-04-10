<button class="float-right btn btn-filled btn-sm" id="kepelautan-btn" modal="form-kepelautan">
    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;<?=$this->lang->line("edit")?>
</button>

<div class="clearfix"></div>
<table class="table table-bordered hover">
    <thead>
      <th>
          <?=$this->lang->line("last_education")?>
      </th>
      <th>
          COC Class
      </th>
      <th>
          Rank
      </th>
      <th>
          <?=$this->lang->line("vessel_type")?>
      </th>
      <th>
          <?=$this->lang->line("expected_salary")?>
      </th>
    </thead>
    <tbody>
      <td>
        <?php echo $profile['last_education']?>
      </td>
      <td>
        <?php
              $coc = $this->coc_model->get_coc_detail($profile['coc_class']);
              
              echo $coc['coc_class'];
            
        ?>
      </td>
      <td>
        <?php
             
          $rank = $this->rank_model->get_rank_detail($profile['rank']);
          $vessel_type = $this->vessel_model->get_ship_type_detail($profile['vessel_type']);
          echo $rank['rank'];
          
        ?>
      </td>
      <td>
        <?php echo $vessel_type['ship_type']; ?>
      </td>
      <td>
        <span style="font-weight:bold;color:#0C0"> 
            <?=$profile['exp_sallary_curr']." ".number_format($profile['expected_sallary'])." / ".$profile['sallary_range']?> 
        </span>
      </td>
    </tbody>
</table>