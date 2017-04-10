<?php 
	$username = $this->session->userdata("username");
	if(!empty($username)){
?>
	<script>
		function show_modal()
		{
			$.ajax({
				type:"POST",
				url:"<?=base_url("test/modal")?>",
				data:"x=1",
				success: function(data){
					//alert(data);
					$("#modal-temp").html(data);
				}
				
				
			});
		 }
		 
		 
		 function check_session()
		 {	 
			var xhr = $.ajax({
				type:"POST",
				url:"<?=base_url("test/check_session")?>",
				data:"x=1",
				async: false
				 
			 });
			 
			 return xhr.responseText;
		 }
		 

		 //alert(check_session());
	
	</script>
	<script>
	
		/**
		 * Check if session has expired.
		 */
		var baseURL = '<?php echo base_url(); ?>';
		var lastActivityTime = 0;

		/**
		 * Update last activity time.
		 */
		function updateLastActivity() {
			
			
			
			lastActivityTime = new Date().getTime() / 1000;
			lastActivityTime = Math.floor(lastActivityTime);
			document.cookie = "last_move=" + lastActivityTime + ";";
			
			
			// $("#table-log tbody").append("<tr><td>1</td><td>"+"last_move=" + lastActivityTime+"</td></tr>");
		}
		
		/* 
		}*/

		updateLastActivity();

		setInterval(
			function() {
				var session 	 = check_session();
				var currentTime = new Date().getTime() / 1000;
				currentTime = Math.floor(currentTime);

				var cookieData = document.cookie.split(";");
				var cookieKey = "last_move=";
				
				//alert("start = "+document.cookie);
				
				//alert("ci_crud = "+cookieData.indexOf('ci_crud')+"/n");
				
				for (var i = 0; i < cookieData.length; i++) {

					var cookieValue = cookieData[i];
					//alert(cookieValue[i]);

					while(cookieValue.charAt(0) == ' ') {
						cookieValue = cookieValue.substring(1, cookieValue.length);
					}

					if (cookieValue.indexOf(cookieKey) == 0) {
						lastActivityTime = cookieValue.substring(cookieKey.length, cookieValue.length);
						lastActivityTime = parseInt(lastActivityTime);
					}
				}

				var inactivitySecond = currentTime - lastActivityTime;

				if (inactivitySecond >= 7200) { // set default 7200
					//window.location.href = baseURL + "index.php/test/logout";
					//alert("anda telah logout");
					//alert(cookieValue);
					//alert("logout = "+document.cookie);
					if(session == ""){
						//show_modal();
						window.location.href = baseURL;
						//alert("session tidak kosong = "+session);
						
					}
				}
			},
			72000 // set default 72000, set interval 10 detik, artinya dia selalu me refresh page selama 10 detik
		);

		$(document).ready(function() {

			$(document).mousemove(function() {
				updateLastActivity();
			});

			$(document).click(function() {
				updateLastActivity();
			});

			$(document).keypress(function() {
				updateLastActivity();
			});
		});
		
	</script>
<?php } ?>