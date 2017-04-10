<?php // content center , menu company, module company



?>



<div id="content" class="col-md-6">

          

    <div id="list_company">

      <div class="panel panel-default"> 

     	<div class="panel-body">

        

        </div>

      </div>

    </div>

   

   <script>

		

		function get_detail_company()

		{

			

			$.ajax({

				

				

				type : "POST",

				url : "<?php echo base_url("company/get_detail_company"); ?>",

				success : function(data)

				{

					$("#list_company .panel .panel-body").html(data);	

				}

			});

		}

		$(document).ready(function(e) {

			get_detail_company();

			

        });


	</script>


</div>



