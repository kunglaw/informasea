 <!-- <script src="http://maps.googleapis.com/maps/api/js?key=YOUR_KEY"></script> -->
 	  <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
 	 <style type="text/css">
      	div.gm-style{
      		margin-left: -15px;
      		margin-top: -15px;
      	}
      </style>
      <script>
	    var map ;
		
		
		
	  	function editButton(controlDiv, map) {

			// Set CSS for the control border.
			var controlUI = document.createElement('div');
			controlUI.style.backgroundColor = '#fff';
			controlUI.style.border = '2px solid #fff';
			controlUI.style.borderRadius = '3px';
			controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
			controlUI.style.cursor = 'pointer';
			controlUI.style.marginBottom = '22px';
			controlUI.style.textAlign = 'center';
			controlUI.title = 'Click to edit Map';
			controlDiv.appendChild(controlUI);
	
			// Set CSS for the control interior.
			var controlText = document.createElement('div');
			controlText.style.color = 'rgb(25,25,25)';
			controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
			controlText.style.fontSize = '16px';
			controlText.style.lineHeight = '38px';
			controlText.style.paddingLeft = '5px';
			controlText.style.paddingRight = '5px';
			controlText.innerHTML = 'Edit Map';
			controlUI.appendChild(controlText);
	
			// Setup the click event listeners: simply set the map to Chicago.
			controlUI.addEventListener('click', function() {
			 
			 edit_map();
			
			  
			});
	
		}

		
	  	function initialize() {
			
			var myCenter = new google.maps.LatLng(<?=$latitude?>,<?=$longitude?>);
			
			var mapProp = {
			  center:myCenter,
			  zoom:10,
			  mapTypeId:google.maps.MapTypeId.ROADMAP
			};
			
			var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
			
			// Create the DIV to hold the control and call the CenterControl()
			// constructor passing in this DIV.
			var buttonControl = document.createElement('div');
			// buttonControl.style.cssText = "margin-left: -15px; margin-top: -15px";
			var centerControl = new editButton(buttonControl, map);
			
			buttonControl.index = 1;
        	
			<?php 
			$username_sess = $this->session->userdata("username_company");
			if(!empty($username_sess)){?>
			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(buttonControl);
			<?php } ?>
			
			var marker=new google.maps.Marker({
				position:myCenter,
			});
		  
			marker.setMap(map);
		}
		

		google.maps.event.addDomListener(window, 'load', initialize);
	  </script>
      
      
      <div class="tab-content">
      		
      	<div role="tabpanel" class="tab-pane active box" id="googleMap" style="height:400px">
      		
        </div>
      </div><br>