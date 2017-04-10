<div id="quick-modal-vacantsea" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <div id="example-form">
            <div>
                <h3>Account</h3>
                
                <section>
                <br />
                <form id="form-agentsea">
                	<div class="form-group">
                    	<label for="userName">User name *</label>
                    	<input id="userName" name="userName" type="text" class="required form-control">
                    </div>
                    <div class="form-group">
                    	<label for="password">Password *</label>
                    	<input id="password" name="password" type="text" class="required form-control">
                    </div>
                    <div class="form-group">
                    	<label for="confirm">Confirm Password *</label>
                    	<input id="confirm" name="confirm" type="text" class="required form-control">
                   	</div>
                    <p>(*) Mandatory</p>
                </form>
                </section>
                
                
                <h3>Profile</h3>
                
                <section>
                <form id="form-vacantsea">
                	<div class="form-group">
                      <label for="name">First name *</label>
                      <input id="name" name="name" type="text" class="required form-control">
                    </div>
                    <div class="form-group">
                      <label for="surname">Last name *</label>
                      <input id="surname" name="surname" type="text" class="required form-control">
                    </div>
                    <div class="form-group">
                      <label for="email">Email *</label>
                      <input id="email" name="email" type="text" class="required email form-control">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input id="address" name="address" type="text" class="form-control">
                    </div>
                    <p>(*) Mandatory</p>
                </form>
                </section>
                
                
            </div>
        </div>

      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(document).ready(function(e) {
		
      $("#quick-modal-vacantsea").modal({
		  keyboard:false,
		  show:true,
		  backdrop:"static"
		  
		  
	  });
	  
	  

	  var divform = $("#example-form");
	  var formagentsea = $("#form-agentsea");
	  
	  formagentsea.validate({
		  errorPlacement: function errorPlacement(error, element) { element.before(error); },
		  rules: {
			  confirm: {
				  equalTo: "#password"
			  }
		  }
	  });
	  
	  divform.children("div").steps({
		  
		  headerTag: "h3",
		  bodyTag: "section",
		  transitionEffect: "slideLeft",
		  
		  onStepChanging: function (event, currentIndex, newIndex)
		  {
			  formagentsea.validate().settings.ignore = ":disabled,:hidden";
			  return formagentsea.valid();
		  },
		  
		  onFinishing: function (event, currentIndex)
		  {
			  formagentsea.validate().settings.ignore = ":disabled";
			  return formagentsea.valid();
		  },
		  
		  onFinished: function (event, currentIndex)
		  {
			  alert("Submitted!");
		  }
	  });




	  

    


	   
    }); // document ready
</script>
