<div class="container">
	<h3>Loading State</h3>
    <hr />
  	
    <h4> Catatan: setiap bentuk form yang memiliki button submit, wajib memiliki loading state pada button submitnya. contoh form: </h4>
    <ul>
    	<li> Form Cropping Profile Picture & Resume Picture </li>
        <li> Form Resume -> Add maupun Update </li>
        <li> Semua Form yang yang terletak pada modal yang memerlukan AJAX untuk melakukan Submit </li>
    
    </ul>
	<hr> 
    
    <a href="http://jsfiddle.net/deC37/"> Source </a>
    <button type="button" id="fat-btn" data-loading-text="loading..." class="btn btn-primary">
        Loading state
    </button>
    
    <script>
            $(function() {
              var btn = $('#fat-btn').click(function () {
                btn.button('loading');
                setTimeout(function () {
                  btn.button('reset');
                }, 3000)
              })
            })
    </script>
    <hr>
    
    <a href="http://getbootstrap.com/javascript/#buttonstring"> Source </a>
    <button type="button" id="myButton" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off">
      Loading state
    </button>
    
    <script>
      $('#myButton').on('click', function () {
        var btna = $(this);
		btna.button('loading');
        setTimeout(function () {
				  btna.button('reset');
                  alert('business logic');
				  
        }, 3000)
        
      })
    </script>
    
    <hr>
    
    <form>
      <p> Tombol ini menjalankan fungsi AJAX : </p>
      <button type="button" id="btn-mymodal" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off">
        Loading state
      </button>
    </form>
    
    <script>
		$("#btn-mymodal").click(function(){
			
			$.ajax({
				
				url:"<?=base_url("test/modal_alert")?>",
				data:"x=1",
				type:"POST",
				beforeSend: function(){
					
					$("#btn-mymodal").button('loading');
					
				},
				complete: function(){
					$("#btn-mymodal").button('reset');
				},
				error: function(err)
				{
					alert("error:"+err.responseText);
				},
				success: function(){
					$("#btn-mymodal").button('reset');
					alert("success");
				}
				
				
			});
			
		})
	
	</script>

</div>