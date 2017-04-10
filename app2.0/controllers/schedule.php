<?php 

	class Schedule extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();
				
		}
		
		function index()
		{
			// $client = new Google_Client();
			// $client->setApplicationName("My Application");
			// $client->setDeveloperKey("AIzaSyD84Hpuob2dzDYNjlE6ZfWBtc5xVkrKo5k");
			// $service = new Google_CalendarService($client);
			// $events = $service->events->listEvents('primary');

			// while(true) {
			//   foreach ($events->getItems() as $event) {
			//     echo $event->getSummary();
			//   }
			//   $pageToken = $events->getNextPageToken();
			//   if ($pageToken) {
			//     $optParams = array('pageToken' => $pageToken);
			//     $events = $service->events->listEvents('primary', $optParams);
			//   } else {
			//     break;
			//   }
			// }

			$url_gcal = "https://www.googleapis.com/calendar/v3/calendars/mne2s01feqmkq4hff7pto75cnk@group.calendar.google.com/events?key=AIzaSyD84Hpuob2dzDYNjlE6ZfWBtc5xVkrKo5k";

			$response = $this->get_web_page($url_gcal);
			// print_r($response);
			$resArr = array();
			$resArr = json_decode($response, true);
			// echo "<pre>";
			// print_r($resArr);
			// echo $resArr['items'][0]['summary'];
			// echo "</pre>";
			 // exit;
			$data['gcal_data'] = json_encode($resArr);
			// echo "</pre>";
			// exit;
			
			$this->load->view("schedule/index", $data);
			
		}
		
// 		$response = get_web_page("http://socialmention.com/search?q=iphone+apps&f=json&t=microblogs&lang=fr");
// $resArr = array();
// $resArr = json_decode($response);
// echo "<pre>"; print_r($resArr); echo "</pre>";

		function get_web_page($url) {
		    $options = array(
		        CURLOPT_RETURNTRANSFER => true,   // return web page
		        CURLOPT_HEADER         => false,  // don't return headers
		        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
		        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
		        CURLOPT_ENCODING       => "",     // handle compressed
		        CURLOPT_USERAGENT      => "test", // name of client
		        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
		        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
		        CURLOPT_TIMEOUT        => 120,    // time-out on response
		    ); 

		    $ch = curl_init($url);
		    curl_setopt_array($ch, $options);

		    $content  = curl_exec($ch);

		    curl_close($ch);

		    return $content;
		}
		
	}