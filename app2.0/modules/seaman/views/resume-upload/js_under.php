<?php // js_under , experience?>



<script type="text/javascript">

    var activeTab = null;

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

      activeTab = e.target;

      console.log(activeTab);

      if($(activeTab).attr('href') == "#resume") {

        $('#right-widget').addClass('hidden-lg');

        $('#main-profile').attr('class', 'col-md-12');

      } else {

        $('#right-widget').removeClass('hidden-lg');

        $('#main-profile').attr('class', 'col-md-9');

      }

    });



    /*function changeLayout() {

        $('#right-widget').addClass('hidden-md');

    }*/



    if($('#resume-tab').hasClass('active')) {

        alert('done deal!');

    }



    $(function () {

        $(window).scroll(sticky_relocate);

        sticky_relocate();

    });

</script>

		

<script>

	<!-- tooltip bro -->

	$('[data-toggle="tooltip"]').tooltip({'placement': 'top'});

	<!-- popover bro -->

	$('#data-update[data-toggle="popover"]').popover({

		

		trigger: 'hover',

		'placement': 'top',

		animation:true,

		container:false,

		content:'',

		delay:1, // { "show": 500, "hide": 100 }

		html:true,

		//placement:'right',

		//'selector':'false',

		template:'<div class="popover col-md-4" style="border:1px solid #CCC" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'

		//title:'',

		//viewport:{ selector: 'body', padding: 0 }

		

	});

</script>

<script>

	 function get_modal(type_modal,id_update)
	 {

		$.ajax({

			type:"POST",

			data:"x=1&modal="+type_modal+"&id_update="+id_update,

			url:"<?php echo base_url("seaman/resume_ajax/modal"); ?>",

			success: function(data){

				//alert(data);

				$(".hasilupload").html(data);

			}

		});

	 }

</script>

<script>

	function show_table_experience()
	{

		$("#data-table-resume-upload").DataTable({

			"paging":   true,
			"ordering": false,
			"info":     false,
			"searching":true
	

		});

	}

	$(document).ready(function(e) {

		show_table_experience();

		

		$("#resume-upload-btn").click(function(e) { //experience 

			var type_modal = $(this).attr("modal"); 

			get_modal(type_modal,"#resume-upload-btn");

        });

		

		

		

	});    

</script>