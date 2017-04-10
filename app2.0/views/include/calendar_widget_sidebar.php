<link href='<?php echo asset_url("plugin/fullcalendar") ?>/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo asset_url("plugin/fullcalendar") ?>/fullcalendar.print.css' rel='stylesheet' media='print' />

<style type="text/css">

	.event-tooltip {

		width: 100px !important;
		background: /*rgba(0, 0, 0, 0.85)*/white;
		color:/*#FFF*/black;
		padding:10px;
		position:absolute;
		z-index:10001;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border: 1px solid black;
		border-radius: 4px;
		cursor: pointer;
		font-size: 11px;

     }
	 
	 iframe #calendarContainer1 #div.bubble{
		 
		width:200px !important;	 
		
	 }

</style>

<script src='<?php echo asset_url("plugin/fullcalendar") ?>/lib/moment.min.js'></script>
<!-- <script src='<?php echo asset_url("plugin/fullcalendar") ?>/lib/jquery.min.js'></script> -->

<script type="text/javascript">
	var list_events = [];
</script>

<script src='<?php echo asset_url("plugin/fullcalendar") ?>/fullcalendar.min.js'></script>
<script src='<?php echo asset_url("plugin/fullcalendar") ?>/gcal.js'></script>

<script>

var hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus', 'September', 'Oktober', 'November', 'Desember'];

	$(document).ready(function() {

		$('#calendar').fullCalendar({

			header: {

				left: 'prev,next today',

				center: 'title',

				right: 'month,listYear'

			},

			displayEventTime: false, // don't show the time column in list view

			// THIS KEY WON'T WORK IN PRODUCTION!!!

			// To make your own Google API key, follow the directions here:

			// http://fullcalendar.io/docs/google_calendar/

			googleCalendarApiKey: 'AIzaSyD84Hpuob2dzDYNjlE6ZfWBtc5xVkrKo5k',

			// US Holidays
			//events: https://calendar.google.com/calendar/embed?src=en.indonesian%23holiday@group.v.calendar.google.com
			events: 'mne2s01feqmkq4hff7pto75cnk@group.calendar.google.com',

			eventClick: function(event) {

				// opens events in a popup window

				// console.log(event);
				window.open(event.url, 'gcalevent', 'width=700,height=600');

				return false;

			},

			// Event Mouseover

        eventMouseover: function(calEvent, jsEvent, view){

				var start_date = calEvent.startDate;
				var end_date = calEvent.endDate;
				var dt = new Date(start_date);
				var nama_hari = hari[dt.getDay()-1];
				var nama_bulan = bulan[dt.getMonth()];
	
				// console.log(dt+"\nhari : "+nama_hari+", bulan: "+nama_bulan);
	
				var waktu_pelaksanaan = start_date+" - "+end_date;
				if(start_date === end_date) waktu_pelaksanaan = nama_hari+", "+dt.getDate()+" "+nama_bulan+" "+dt.getFullYear();
	
				// console.log(waktu_pelaksanaan);
	
				var tooltip = '<div class="event-tooltip">' + "<h3>" + calEvent.title + '</h3><br>' + "Location : " + calEvent.location+"<br>Waktu Pelaksanaan: "+waktu_pelaksanaan/*+"<br><center>"+start_time+" - "+end_time+"</center>"*/;
	
				$("body").append(tooltip);
	
				$(this).mouseover(function(e) {
	
					$(this).css('z-index', 10000);
	
					$('.event-tooltip').fadeIn('500');
	
					$('.event-tooltip').fadeTo('10', 1.9);
	
				}).mousemove(function(e) {
	
					$('.event-tooltip').css('top', e.pageY + 10);
	
					$('.event-tooltip').css('left', e.pageX + 20);
	
				});
	
			},
	
			eventMouseout: function(calEvent, jsEvent) {
	
				$(this).css('z-index', 8);
	
				$('.event-tooltip').remove();
	
			},

			

			loading: function(bool) {

				$('#loading').toggle(bool);

			}


		});

		for (var i = 0; i < list_events.length; i++) {

			console.log(list_events[i]);

		}

		// console.log(JSON.stringify(list_events[0]));
		// console.log(list_events.length);
		// console.log(list_events.location);

	});

	// alert(JSON.stringify(list_events)+"\n"+list_events[0]);
	// alert(list_events);
	// console.log(list_events);
	// 	console.log(list_events[0]);

	function testing() {

		var gcal_data = <?php echo $gcal_data ?>;

		$.each(gcal_data.items, function (key, val) {

			// console.log("judulnya: "+val['summary']+"\nlokasinya: "+val['location']);

		})

	}

	testing();

</script>

<style>

	#loading {

		display: none;

		position: absolute;

		top: 10px;

		right: 10px;

	}
	
	#calendar {
		max-width: 400px;
		margin: 0 auto;
	}

</style>

	<iframe src="https://calendar.google.com/calendar/embed?height=600&amp;showTitle=0&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=mne2s01feqmkq4hff7pto75cnk%40group.calendar.google.com&amp;color=%23875509&amp;ctz=Asia%2FJakarta" style="border-width:0" width="100%" height="350" frameborder="0" scrolling="no"></iframe>
    
    <br>

	<?php if(isset($_GET['test'])){

		if($_GET['test'] == 1){

			echo "<hr><div id='loading'>loading...</div>

			<div id='calendar'></div>";

		}

	} ?>