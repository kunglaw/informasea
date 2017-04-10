<form role="form" class="" action="<?=base_url("users/users_process/login_universal")?>" method="post">
   <input type="hidden" value="<?=!empty($_GET['login_attemp']) ? $_GET['login_attemp'] : 0 ?>" name="login_attemp"  />
   <input type="hidden" value="<?=$this->uri->segment(1)?>" name="page" id="lastpage" />
   
   <div class="form-group"> 	 
              <?php if($show_modal == 1 || $_GET['sm'] == 1){ ?>
            
        <span id="error-tip" class="glyphicon glyphicon-exclamation-sign" data-container="body" 
        data-toggle="popover" data-placement="left" data-content="<?=$description?>" style="cursor:pointer" >
        </span><span><?=$description?></span>        
            
      <?php } ?>
   
    </div>
    <div class="form-group">
        <label for="username_lg"> Username or Email: </label>
        <input type="text" class="form-control" placeholder="Username or Email" name="username_lg"/>
    </div>
    <div class="form-group">
        <label for="password"> Password : </label>
        <input type="password" class="form-control" placeholder="Password" name="password_lg"/>
    </div>        
    <button class="btn btn-login" type="submit">
        <span class="text-white">Log In</span>
    </button>
     
</form>