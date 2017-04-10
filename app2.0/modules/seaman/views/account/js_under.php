<?php // js_under , account?>

<script type="text/javascript">
    // $(document).ready(function(){

    // });

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

<!-- <script>
	var old_username, old_pass, old_email, new_username, new_password, new_email;

	$(document).ready(function(){
		$('#doneAccount').hide();
		$("#editAccount").click(function(){
			$('#tabelAkun').css("background-color", "#CCCCCC");
			$('#editAccount').hide();
			$('#doneAccount').show();
			$('#username').css({"background-color": "white", "border": "1px"}).prop('readonly', false);
			$('#email').css({"background-color": "white", "border": "1px"}).prop('readonly', false);
			$('#txtold_password').css({"background-color": "white", "border": "1px"}).prop('readonly', false);
			$('#txtnew_password').css({"background-color": "white", "border": "1px"}).prop('readonly', false);
			$('#password').css({"background-color": "white", "border": "1px"}).prop('readonly', false);
			$("#old_password").show();
			$("#new_pass").show();
			$("#repass").show();
			$("#realpass").hide();


			old_username = $("#username").val();
			old_email = $("#email").val();
			old_pass = $("#password").val();

		});
		$("#doneAccount").click(function(){
			$('#tabelAkun').css("background-color", "white");
			$('#editAccount').show();
			$('#doneAccount').hide();
			$('#username').css({"background-color": "transparent", "border": "0", "border-color" : "black"}).prop('readonly', true);
			$('#email').css({"background-color": "transparent", "border": "0", "border-color" : "black"}).prop('readonly', true);
			$('#txtold_password').css({"background-color": "transparent", "border": "0", "border-color" : "black"}).prop('readonly', true);
			$('#txtnew_password').css({"background-color": "transparent", "border": "0", "border-color" : "black"}).prop('readonly', true);
			$('#password').css({"background-color": "transparent", "border": "0", "border-color" : "black"}).prop('readonly', true);
			$("#old_password").hide();
			$("#new_pass").hide();
			$("#repass").hide();
			$("#realpass").show();

			var username = $("#username").val();
			var email = $("#email").val();
			var password = $("#password").val();
			var idnya = "<?php echo $detail_pelaut['pelaut_id'] ?>";
			var old_pass = $('#txtold_password').val();
			var new_pass = $('#txtnew_password').val();

//                alert(idnya);
			new_username = username;
			new_email = email;
			new_password = password == old_pass ? "":password;

//                alert(new_username+" dan "+new_password+" dan "+new_email);
			if(new_password != "" || old_pass != "" || new_pass != "") {
//                    alert("Hallo");
				$.ajax({
					type: "POST",
					url: "<?php echo base_url("seaman/profile/processUpdate"); ?>",
					data: "x=1&id_pelaut=" + idnya + "&username=" + new_username + "&email=" + new_email + "&password=" + new_password+"&old_pass="+old_pass+"&repass="+new_pass,
					success: function (data) {
//                            alert(data);
						updateNewData();
						//alert(data);
						$("#result").html(data);
					}
//                    error : function(){
//                        alert("Error bro");
//                    }
				});
			}
		});
	});

	function updateNewData()
	{
		var user = new_username == ""?old_username:new_username;
		var email = new_email == ""?old_email:new_email;
		var pass = new_password == ""?old_pass:new_password;
		$("#txtold_password").val("");
		$("#txtnew_password").val("");
		$("#password").val("");
	}
</script> -->