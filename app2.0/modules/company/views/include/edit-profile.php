<?php 
$ListNationality    = $this->company_model->get_nationality();
?>
<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="MyModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Edit Profile</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
        <div>
                <form id="frm-profile-agentsea" >
                <div class="col-sm-12" id="container_msg"></div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="<?=$nama_perusahaan;?>" required="required"/>
                        <input type="hidden" name="id_perusahaan" value="<?=$id_perusahaan;?>">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?=$username;?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" class="form-control" id="website" name="website" value="<?=$website;?>" required="required"/>
                    </div>
                     <div class="form-group">
                        <label>Nationality</label>
                        <select class="form-control" id="nationality" name="nationality">
                          <?php
                          $no = 1;
                          foreach($ListNationality->result_array() as $key){
                            echo "<option value='$key[id]|$key[name]'";
                                  if ($key['name']==$nationality) {
                                    echo "selected";
                                  }
                            echo ">$key[name]</option>";
                          }
                          ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contact Us</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?=$contact;?>" required="required"/>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?=$no_telp;?>" required="required"/>
                    </div>           
                    <div class="form-group">
                        <label>Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" value="<?=$fax;?>" required="required"/>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?=$email;?>" required="required"/>
                    </div>         
                </div><!-- /.col-sm-4-->
                
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea rows="5" class="form-control" id="address" name="address"><?=$address;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="5" class="form-control" id="description" name="description"><?=$description;?></textarea>
                    </div>
                </div><!-- /.col-sm-4-->
              </form>
        </div>
        <div class="clearfix"></div>
        </div><!-- /.box-body -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Update Change" id="btn_update">
      </div>
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$("#btn_update").click(function (){
  var username  = document.getElementById("username").value;

  $.ajax({
      type  : "POST",
      url   : "<?=base_url('company/EditProfile');?>",
      data  : $("#frm-profile-agentsea").serialize(),
      success:function(data){
        $("#container_msg").html(data);
        setTimeout(function(){
          window.location="<?=base_url('agentsea/" + username + "/profile');?>";
        }, 2000);
      }
  });
});
</script>