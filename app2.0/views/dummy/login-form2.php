<div class="row">
	<div class="container">
      <div class="panel panel-default col-md-4">
      	<div class="panel-body"> 
            <form role="form" class="" action="<?=base_url("test/login_process")?>" method="post">
            
                <div class="form-group"> 	 
                  
				 
                 
                   <?php 
				   //if(!empty($this->session->flashdata("tmes"))){
				   		echo $this->session->flashdata("tmes");
				   //}
					?>
                 
  
               
                </div>
                <div class="form-group">
                    <label for="username_lg"> Username or Email: </label>
                    <input type="text" class="form-control"  name="username_lg"/>
                </div>
                <div class="form-group">
                    <label for="password"> Password : </label>
                    <input type="password" class="form-control" name="password_lg"/>
                </div> 
                <div class="form-group">
                    <input type="checkbox" name="remember_me" value="1" > Remember Me
                </div>       
                <button class="btn btn-login" type="submit">
                    <span class="text-white">Log In</span>
                </button>
                 
            </form>
        </div>
      </div>
    </div>
</div>