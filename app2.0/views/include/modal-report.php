<?php //modal report

$id_user    = $this->session->userdata('id_user');
$id_perusahaan = $this->session->userdata('id_perusahaan');
echo $from;
?>
     <script src="<?php echo asset_url("js/jquery.form.min.js");?>"></script>

<style>
    .modal-rep{
        color:black;
    }
    .modal-backdrop
    {
        z-index:-1 !important;  
    }
</style>

<div class="modal fade modal-rep" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 10001">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary" style="padding:-20px 0 -20px 0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Report Problem </h4>
      </div>
      <div class="modal-body">

     
        <div id="hasilnyaaa">   </div>

        <div id="form-report-problem">
            <form method="POST" id="form-report" action="<?php echo base_url('home/report_process/add_report_process');?>" enctype="multipart/form-data"> 
           <?php // <form method="POST" id="form-report" enctype="multipart/form-data"> ?>
                <div class="form-group">
                    <?php if(empty($id_perusahaan) AND !empty($id_user)){ ?>
                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                    <?php } else if(!empty($id_perusahaan) AND empty($id_user)) {  ?>
                    <input type="hidden" name="id_user" value="<?php echo $id_perusahaan; ?>">
                    <?php } ?>
                    <label>
                        Where is the problem ? 
                    </label>
                    <select name="page" id="page" class="form-control" style="width:60%;">
                        <option value='' <?php if(!isset($from)) echo "disabled selected" ?>> Select a page </option>
                        <?php 
                            $list_halaman = array('home', 'vacantsea', 'seatizen', 'agentsea', 'resume', 'friends'); 
                            for ($i=0; $i < count($list_halaman); $i++) { 
                                $selected = "";
                                if(isset($from)){ if($list_halaman[$i] == $from) $selected = "selected";}
                                echo "<option value='$list_halaman[$i]' $selected>".ucfirst($list_halaman[$i])."</option><br>";
                            }
                        ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label>
                    Report your problem
                </label>
                <textarea name="report" id="report" class="form-control" style="resize:none;" rows="8"> </textarea>
                </div>
                <div class="form-group">
                    <label>
                        Image : 
                    </label>
                    <input type="file" name="gambar" id="gambar" accept="image/x-png,image/gif,image/jpeg">
                </div>
                    <button class="btn btn-success" id="add-report-btn" type="submit"> <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Save </button>
                <button class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Cancel </button>
           

            </form>
        </div>
        </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<script>

<?php if(isset($calling)) echo "$('#modal-report').modal({show : 'true', backdrop : 'static'}).on('hidden.bs.modal', function () { $('.modal-resume').modal('show'); });"; ?>
    $("#form-report").ajaxForm({
        url:'<?php echo base_url("home/report_process/add_report_process");?>',
        type:'POST',
        dataType:'json',
        resetForm:true,
        beforeSubmit: function(){
            $('#hasilnyaaa').html('<div class="alert alert-success"> Thanks for your report... </div>');
            setTimeout(function(){

            $('#modal-report').modal("hide");
            $("#hasilnyaaa").html(' ');
            $("#gambar").val('');
            $("#report").val(' ');
            $("#page").val('');



            },2000)
        },
        success:function(data){
            $('#hasilnyaaa').html(data);
        }
    });

</script>