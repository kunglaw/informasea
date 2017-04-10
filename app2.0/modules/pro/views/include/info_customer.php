
<div class="section">

  <div class="row">
    <div class="col s12 center">
      <h3><i class="large material-icons blue-text">person</i></h3>
      <h4>Tell us about yourself</h4>
		
        <form class="col s12 left" method="post" id="form-id" action="<?=base_url('pro/proses_upgrade');?>" >
        
            <div class="row"><!--Row 1-->
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate" name="full_name" value="<?=$fullname;?>">
                <label for="icon_prefix">Full Name</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">assignment_ind</i>
                <input id="icon_telephone" type="tel" class="validate" name="company_name" value="<?=$name_company;?>">
                <label for="icon_telephone">Name Company</label>
              </div>
            </div>
    
            <div class="row"> <!-- Row 2 -->
              <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_telephone" type="tel" class="validate" name="no_telp">
                <label for="icon_telephone">No Tlp</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">mail</i>
                <input id="icon_email" type="email" class="validate" name="email" value="<?=$email;?>">
                <label for="icon_email">E-mail</label>
              </div>
            </div>  
    
           <div class="row"> <!-- Row 4 -->
              <div class="input-field col s6">
                <i class="material-icons prefix">local_library</i>
                <input id="icon_telephone" type="text" class="validate" name="from_bank">
                <label for="icon_telephone">Your Bank</label>
              </div>
             
              <div class="input-field col s5">
                  <select class="browser-default" name="purpose_bank">
                  <option style="display:none">Choose Purpose Bank</option>
                  <option value="BCA">BCA : 088999999 a/n Rini Julistia</option>
                  <option value="BRI">BRI : 077776666 a/n Rini Julistia</option>
                  <option value="CIMB Niaga">CIMB Niaga : 066333333 a/n Rini Julistia</option>
                  <option value="Mandiri">Mandiri : 0222333333 a/n Rini Julistia</option>
                </select>
                </div>
            </div>
    
            <div class="row"> <!-- Row 3 -->
              <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="icon_my_location" type="number" class="validate" name="postal_code">
                <label for="icon_my_location">Postal Code</label>
              </div>
              <!-- <div class="input-field col s1">
                <i class="material-icons prefix">place</i>
                <input id="icon_my_location" type="text" class="validate" value="" >
                <label for="icon_my_location"></label>
              </div> -->
              <div class="input-field col s5">
                <i class="material-icons prefix"></i>
                <select class="browser-default" id="icon_location_on" name="account_pilihan">
                  <option style="display:none">Choose Your Account</option>
                  <option value="Advance"> Advance </option>
                  <option value="Premium"> Premium </option>
                  
                </select>
            </div>
          </div> 
    
            <div class="row"> <!--Row 5 -->
              <div class="col s6 left">
                <input type="checkbox" id="test5" required />
                <label for="test5">I agree to the <a href="#">Terms</a>.</label> 
              </div>
            </div>
        
    
    
          <div class="row center">
            <div class="input-field col s12">
                <button type="submit" id="download-button" class="btn-large waves-effect waves-light btn"><i class="material-icons right">shopping_cart</i>Buy now</button>
            </div>
          </div>

      </form>
      
      <script>
		
			$("#form-id").submit(function(e){
				
				$.ajax({
					
					type	:$("#form-id").attr("method"),
					data	:$("#form-id").serialize(),
					url	 :$("#form-id").attr("action"),
					dataType:"json",
					success: function(res)
					{
						alert(res.message);	
					},
					error:function(err)
					{
						alert(err.responseText);
					}
					
				}); 
				
				return false;				
			});
			//$("#form-id").submit();
		
		
		</script>
      
    </div>
  </div>


</div>