<?php

class Test extends CI_Controller{

	

	function __construct()
	{

		

		parent::__construct();

		//$this->authentification_model->close_access();

		

	}
	
	
	function register_table()
	{
		$this->load->library('table');

		$str = "SELECT * FROM pelaut_ms_bayangan";
		$q = $this->db->query($str);
		$f = $q->result_array();
		
		echo '<script type="text/javascript" src="https://www.informasea.com/informasea_assets/js/jquery.min.js" ></script>
    <script type="text/javascript" src="https://www.informasea.com/informasea_assets/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	
	 <link rel="stylesheet" type="text/css" href="https://www.informasea.com/informasea_assets/css/bootstrap.css" />
	<link href="https://www.informasea.com/informasea_assets/css/jquery.dataTables.css" type="text/css" rel="stylesheet" />';
		
		$template = array(
			  'table_open'            => '<table class="table" border="1" cellpadding="10" cellspacing="0" style="overflow:scroll; ">',
	  
			  'thead_open'            => '<thead>',
			  'thead_close'           => '</thead>',
	  
			  'heading_row_start'     => '<tr>',
			  'heading_row_end'       => '</tr>',
			  'heading_cell_start'    => '<th>',
			  'heading_cell_end'      => '</th>',
	  
			  'tbody_open'            => '<tbody>',
			  'tbody_close'           => '</tbody>',
	  
			  'row_start'             => '<tr>',
			  'row_end'               => '</tr>',
			  'cell_start'            => '<td>',
			  'cell_end'              => '</td>',
	  
			  'row_alt_start'         => '<tr>',
			  'row_alt_end'           => '</tr>',
			  'cell_alt_start'        => '<td>',
			  'cell_alt_end'          => '</td>',
	  
			  'table_close'           => '</table>'
	  );
	  
	  $this->table->set_template($template);	
	  
	  echo "<center><h2>User register from IATGI </h2></center>";
	  echo "<hr>";
	  
	  echo "<div class='container' style='overflow:scroll'>";
	  echo $this->table->generate($q);
	  echo "</div>";
	  echo "<hr>";
	  
	  echo "<center><a href='http://temp1.iatgi.or.id/register' target='_blank'><button class='btn btn-lg btn-primary'> Register to IATGI</button></a></div>";
	}


	function send_email_testing()

	{

		error_reporting(E_ALL);

		$this->load->library("my_email");

		$dt['nama'] = "Raditya Pratama";

						$dt['email'] = "radityapratama@informasea.com";

						$dt['two_months'] = 1;

						$dt['tambahannya'] = "";

		$template = $this->load->view("email_reminder_resume", $dt, true);



			/* $content = array(



				"subject" 		=> "Hello Seatizen",

				"subject_title"  => WEBSITE,

				"to" 			 => array($dt['email'],"alhusna901@gmail.com","admin@informasea.com"), //ganti dengan email seatizen

				"data" 		   => array("email_to"=>$dt['email'],"template"=>$template, "msg_tambahan"=>$dt['tambahannya']),

				"message" 		=> "new-email-template",

				"mv" 			 => TRUE

			); */

			

			 $content = array(



				"subject" 		=> "Selamat Datang di Informasea.com",

				"subject_title"  => WEBSITE,

				"to" 			 => $dt['email'], //ganti dengan email seatizen

				"data" 		   => array("email_to"=>$dt['email'],"content_template"=>$template, "msg_tambahan"=>""),

				"message" 		=> "template_email2016/new_email_template",

				"mv" 			 => TRUE

			); 

			



			$user = "info";



			$data = $content["data"];

			

			$dtt["content_template"] = $template;

			// $this->load->view($content["message"],$dtt);

			$this->my_email->send_email($user,$content);

			echo $this->my_email->get_email_message();

	}



	function read_webmail()

	{

		$emailAddress = 'radityapratama@informasea.com'; // Full email address

	    $emailPassword = '[oJi_7*[[E{w';        // Email password

	    $domainURL = 'mail.informasea.com';              // Your websites domain

	    $host = "{".$domainURL.":993/imap/ssl/novalidate-cert}INBOX";

	    $useHTTPS = false;                       // Depending on how your cpanel is set up, you may be using a secure connection and you may not be. Change this from true to false as needed for your situation



	    /* BEGIN MESSAGE COUNT CODE */



	    $inbox = imap_open($host,$emailAddress,$emailPassword) or die('Cannot connect to domain:' . imap_last_error());

	    $oResult = imap_search($inbox, 'ALL');

	    if($oResult) {



			/* begin output var */

			$output = '';



			/* put the newest emails on top */

			// rsort($oResult);



			/* for every email... */

			echo "<pre>";

			foreach($oResult as $email_number) {

				$overview = imap_fetch_overview($inbox,$email_number,0);

				$overview = json_decode(json_encode($overview), true);

				echo strpos($overview[0]['subject'], 'utf-8'). ":";

				// echo strlen($overview[0]['subject']);

				if(strpos($overview[0]['subject'], 'utf-8') > -1) {

					// echo "sebelum -> ".$overview[0]['subject'];

					$overview[0]['subject'] = str_replace("=?utf-8?Q?", "", $overview[0]['subject']);

					$overview[0]['subject'] = str_replace("=?utf-8?B?", "", $overview[0]['subject']);

					$overview[0]['subject'] = str_replace("?=", "", $overview[0]['subject']);

					$overview[0]['subject'] = base64_decode($overview[0]['subject']);

				}

				/*else */echo $overview[0]['subject'];

				echo "<br>";

				// echo $overview[0]->subject."<br>";

			}

			echo "</pre>";

			imap_close($inbox);

			exit;

			foreach($oResult as $email_number) {



			    /* get information specific to this email */

			    $overview = imap_fetch_overview($inbox,$email_number,0);

			    $message = imap_fetchbody($inbox,$email_number,2);



			    /* output the email header information */

			    // $output.= ($overview[0]->seen ? 'read' : 'unread');

			    $output.= $overview[0]->subject.'<BR>';

			    // $output.= $overview[0]->from.'<BR>';

			    // $output.= 'on '.$overview[0]->date.'<BR>';

			    



			    // /* output the email body */

			    // $output.= $message.'<BR>';

			}



			echo $output;

			} 

	    if(empty($oResult))

	        $nMsgCount = 0;

	    else

	        $nMsgCount = count($oResult);



	    imap_close($inbox);



	    echo('<p>You have '.$nMsgCount.' unread messages.</p>');



	    /* END MESSAGE COUNT CODE */



	    echo('<a href="http'.($useHTTPS ? 's' : '').'://'.$domainURL.':'.($useHTTPS ? '2096' : '2095').'/login/?user='.$emailAddress.'&pass='.$emailPassword.'&failurl=http://'.$domainURL.'" target="_blank">Click here to open your inbox.</a>');

	}

	

	



		function show_mac_address()

		{

			error_reporting(E_ALL);

			// echo "hai";

			// ob_start();  

			// //  //mendapatkan detail ipconfing menggunakan CMD  

			// system('ipconfig /all');  

			// //  // mendapatkan output kedalam variable  

			// $mycom = ob_get_contents();  

			// //  // membersihkan output buffer  

			// ob_clean();  

			// $findme = "Physical";  

			// //  // mencari perangkat fisik | menemukan posisi text perangkat fisik  

			// //  //Search the "Physical" | Find the position of Physical text  

			// $pmac = strpos($mycom, $findme);  

			// //  // mendapatkan alamat peragkat fisik  

			// $mac=substr($mycom,($pmac+36),17);  

			// //  //menampilkan Mac Address  

			// echo $mac;  

			echo "<pre>";

			echo $_IP_SERVER = $_SERVER['SERVER_ADDR'];

		    echo $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 

		    if($_IP_ADDRESS == $_IP_SERVER)

		    {

		        ob_start();

		        system('ipconfig /all');

		        $_PERINTAH  = ob_get_contents();

		        ob_clean();

		        $_PECAH = strpos($_PERINTAH, "Physical");

		        $_HASIL = substr($_PERINTAH,($_PECAH+36),17);

		        echo $_HASIL;   

		    } else {

		        $_PERINTAH = "arp -a $_IP_ADDRESS";

		        ob_start();

		        system($_PERINTAH);

		        $_HASIL = ob_get_contents();

		        ob_clean();

		        $_PECAH = strstr($_HASIL, $_IP_ADDRESS);

		        $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));

		        $_HASIL = substr($_PECAH_STRING[1], 0, 17);

		        echo "IP Anda : ".$_IP_ADDRESS."

		        MAC ADDRESS Anda : ".$_HASIL;

		    }

			// $ipAddress=$_SERVER['REMOTE_ADDR'];

			// 	$macAddr=false;

				 

			// 	#run the external command, break output into lines

			// 	$arp="arp -a $ipAddress";

			// 	$lines=explode("\n", $arp);

				 

			// 	#look for the output line describing our IP address

			// 	foreach($lines as $line)

			// 	{

			// 	   $cols=preg_split('/\s+/', trim($line));

			// 	   if ($cols[0]==$ipAddress)

			// 	   {

			// 	       $macAddr=$cols[1];

			// 	   }

			// 	}

			// 	echo $macAddr;

			echo "</pre>";



		}

	

	function index()

	{

		$this->load->helper("cookie");

		

		$data["title"] 	= "Index - Informasea.com";

		$data["template"] = "dummy/index";

		$this->load->view("index",$data);

	}

	

	function login_form()

	{

		$this->check_session2();

		//error_reporting(E_ALL);

		$data["title"] 	= "Login Test";

		$data["template"] = "dummy/login-form2";

		$this->load->view("index",$data);

	}

	

	function check_session2()

	{

		$this->load->helper("cookie");

		

		$username_sess = get_cookie("usess");

		$email_sess	= get_cookie("esess");

		

		$userdata 	  = $this->session->all_userdata();

		//print_r($userdata["user_data"]); exit;

		//print_r($username_sess);

		//print_r($email_sess);

		

		

		if(!empty($username_sess) && !empty($email_sess) && empty($userdata["user_data"]))

		{

			$str = "SELECT username,email,nama_depan,nama_belakang FROM pelaut_ms WHERE username = '$username' ";

			$q   = $this->db->query($str);

			$f   = $q->row_array();

			

			$dt_session = array(

					

				"name" 	 => $f["nama_depan"]." ".$f["nama_belakang"],

				"email" 	=> $f["email"],

				"username" => $f["username"],

				"type" 	 => "pelaut"

			

			);

			

			$this->session->set_userdata($dt_session);

			

			header("location:".base_url("test/index"));

		}

		else if(!empty($userdata["user_data"]))

		{

			

			header("location:".base_url("test/index"));

		}

		

		

	}


	
	

	function test_compact()

	{

		$name = "dimas";

		$email = "alhusna901@gmail.com";

		$address = "Jl. Pinang Tangsel";

		$company = "informasea";

		

		$list_var = array("name","company","email","address");

		

		$result = compact($list_var);

		

		print_r($result);

		//print_r($list_var);

			

	}

	

	function email_temp()

	{

		//$data["content_template"] = "<center><h3> Lorem ipsum sit dolor amet </h3></center>";

		

		$dt["company_name"] = "PT Informasea Sejahtera";

		$dt["username_company"] = "informasea_test";

		$dt["email_company"] = "dimas@informasea.com";

		

		$data["content_template"] = $this->load->view("users/email/template_2016/approval_agentsea_by_admin",$dt,true);

		

		$this->load->view("template_email2016/new_email_template",$data);

	}



	function test_tel()

	{

		echo "<input type='tel' name='test_tel' >";	

	}

	

	function test_form()

	{

		echo "<form id='test' action='".base_url("test/test_process")."' method='post' >

					<input type='text' name='input_capt'>

					<input type='submit' name='lala' value='submit'>

				</form>	";

	}
	

	function email_agentsea_template($dt)

	{

		$this->load->config("email");

		$config = $this->config->item($dt["user"]);

		

		$data["config"]	 = $config;

		$data["email_to"]   = $dt["email_to"];

		$data["str_url"]    = base_url("home");

		

		$content_email  = $this->load->view("users/email/email-activation-agentsea",$data,true);

		$content_email .= $this->load->view("users/email/email-activation-seatizen",$data,true);	

		

		return $content_email;

	}

	

	function new_email_template()

	{

		$this->load->config("email");

		$config = $this->config->item("alhusna901");

		

		$data["config"]	 = $config;

		//$data["email_from"] = "info@informasea.com";

		$data["email_to"]   = "email@email.com";

		$data["str_url"]    = "#";

		

		//$this->load->view("users/email/email-activation-seatizen",$data);

		//$this->load->view("users/email/email-activation-agentsea",$data);

		//$this->load->view('test/test');

		$this->load->view("users/email/new-email-template");

		//$this->load->view("users/email/email-activation-agentsea");

	}

	

	function test_config()

	{

		$data['title'] 	   = "just dummy text here";

		$data["template"]	= "dummy/dummy-text-new";

		

		$constant = array(BASE_URL,IMG_URL,ASSET_URL);

		$config   = array(base_url(),img_url(),asset_url());

		

		$default_img = array("di_agentsea"=>DEFAULT_IMG_LIST_AGENTSEA,

		"di_seaman"=>DEFAULT_IMG_LIST_SEAMAN,

		"dti_agentsea"=>DEFAULT_IMG_DT_AGENTSEA,

		"dti_seaman"=>DEFAULT_IMG_DT_SEAMAN,

		"dtc_agentsea"=>DEFAULT_IMG_COVER_AGENT,

		"dtc_seaman"=>DEFAULT_IMG_COVER_SEAMAN);

		

		$arr	  = array("constant" => $constant,"config"=>$config,"default_img"=>$default_img);

		$data['arr'] = $arr;

		

		$this->load->view("index",$data);	

		

	}

	

	function test_email()

	{

		

		echo "<h2> Send Email Template </h2>";

		echo "<p> this is a system can send a template email for test </p>";

		echo "<hr>";

		

		echo "<form method='post' action='".base_url("test/test_email_process")."'>";

		

		echo "<label> Email to </label> <br> ";

		echo "<input type='email' name='email' value='' style='width:200px'> ";

		echo "<input type='submit' value='Submit Email' >";

		echo "</form>"; 

	}


	function test_mail_second()

	{

		$this->load->library('email');

		

		$config['protocol']     = 'smtp';

		$config['smtp_host']    = 'ssl://smtp.gmail.com';

		$config['smtp_port']    = 587;

		$config['smtp_timeout'] = '7';

		$config['smtp_user']    = 'alhusna901@gmail.com';

		$config['smtp_pass']    = 'coolmangenius';

		$config['smtp_crypto']  = 'tls';

		$config['charset']      = 'utf-8';

		$config['mailtype']     = 'text'; // or html

		$config['validation']   = TRUE; // bool whether to validate email or not

		$config['crlf'] 		 = "\r\n";      //should be "\r\n"

		$config['newline'] 	  = "\r\n";   //should be "\r\n"

		//$config['user_agent']   = "suka2 gue dong";

		

		$this->email->initialize($config);



		$this->email->from('alhusna901@gmail.com', 'Kunglaw Ady');

		$this->email->to('ariesdimasy@gmail.com');

		

		$this->email->subject('Email Test');

		$this->email->message('Testing the email class.');

		

		if ($this->email->send())

        echo "Mail Sent!";

			else

				echo "There is error in sending mail!";

		

		

		echo $this->email->print_debugger();

	}

	

	function view_modal_alert()

	{

		// halaman utama untuk melakukan testing

		

		$data['title'] = "Testing Page";

		$data['header'] = "Modal Alert for All";

		$data['template'] = "content/dummy_page/template";

		$data['halaman_detail'] = "test/test-alert";

		$this->load->view('index',$data);

		

	}

	

	function test_pageurl()

	{

		$data['url'] = $this->uri->uri_string();

		$this->load->view("dummy/form_url",$data);	

	}

	

	function test_download()

	{

		$this->load->helper('download');

		

		$data = file_get_contents("../infrasset/photo/noprofilepic.bmp"); ;

		$name = 'mawut.bmp';

		

		force_download($name, $data); 

				

		$data['title'] = "Testing Download";

		$data['header'] = "DOWNLOAD CUK!!";

		$data['template'] = "content/dummy_page/template";

		$data['halaman_detail'] = "test/test-download";

		$this->load->view('index',$data);	

	}

	

	function test_loading_state()

	{

		$data['title']    = "loading state";

		$data['template'] = "dummy/loading-state";

		

		$this->load->view("index",$data);	

	}

	

	function test_token()
	{

		$this->load->library("token");

		$this->load->helper("date");

		

		

		$token = $this->token->generate(64);

		

		$now = date("Y-m-d H:i:s");

		$make_time = date();

		

		$data = array("no_token"=>"oiRD0rlehJiulGsl7DhK9vbxwaY1jxxtbIu2A84nKAU4Bqnt9sPnufvaVRcrNSag","expiry_date <"=>"$now");

		

		/* $data_insert = array("page"=>"test","email"=>"alhusna901@gmail.com","type_user"=>"pelaut",

		"no_token"=>$token); */

		

		//$insert_token = $this->token->insert_token($data_insert) or die(mysql_error());

		

		echo "<pre>";

		

			$str = "SELECT * FROM token_tbl order by create_date DESC";

			$q = $this->db->query($str);

			$f = $q->result_array();

			print_r($f);

		

		

		echo "</pre>";

		

		print_r($data);

		

		echo "<br> ";

		

		$check_token = $this->token->check_token($data);

		print_r($check_token); 

	}

	

	function modal_alert()
	{

		$this->load->helper("url_segment_helper");

		$arr = json_arr_row("");

		$data = $arr;

		

		//print_r($data);

		$this->load->view("test/test-autocomplete-modal",$data);

		//$this->load->view('');	

	}
	
	function test_json()
	{
		$arr = array(
			"ad_top_right",
			"ad_top_left",
			"ad_bottom_left",
			"ad_bottom_right",
			"ad_fixed_left",
			"ad_fixed_right"
		); 
		
		$arr_list = array(
			
			"ad_top_right",
			"ad_top_left",
			"ad_bottom_left",
			"ad_bottom_right",
			"ad_fixed_left"
			
		);
		
		
		$arr_json = json_encode($arr);
		$arr_json_list = json_encode($arr_list);
		
		print($arr_json);echo "<br>";
		echo $arr_json_list;
		
		echo "<hr>";
		
		$arr_b = json_decode($arr_json);
		
		print_r($arr_b);	
		
		
		
		
		
	}

	

	function show_modal()

	{

		$data['title'] = $this->input->post("title");

		$data['desc'] = $this->input->post("desc");

		

		$this->load->view("content/modal/alert",$data);	

	}

	

	



	function test_url()

	{

		$data['title'] = "Testing Url Image";

		$data['header'] = "Image Url for All";

		$data['template'] = "content/dummy_page/template";

		$data['halaman_detail'] = "test/test_url_image";

		$this->load->view('index',$data);

	}

	

	function view_session()

	{

		$this->load->library('session');

		$arr = $this->session->all_userdata();

		

		$data['title'] = "session";

		$data['header'] = "view all session";

		$data['template'] = "content/dummy_page/template";

		//$data['halaman_detail'] = "test/test-alert";

		$data['description'] = $arr;

		

		echo "<pre>";

		print_r($data); echo"</pre>"; exit;

				

		$this->load->view('index',$data);		

	}

	function form_upload_photo()

	{

		$this->load->view("photo/form_upload_photo");	

	}

	

	function test_delete()

	{

		$data_del = array("nama"=>"dimas");

		//$this->db->where($data_del)

		$del = $this->db->delete("test",$data_del);

		

		echo "test delete ... ";	

		

	}



	

	/* function clean_all()

	{

		echo "<h2> Be Carefull about this Program </h2><hr>";

		// Remember to activate this only for test

		$u = $this->input->get("u");

		$p = $this->input->get("p");

		if($u == "alhusna_99" && $p = "999999")

		{

		  $str_hapus_dt_tml = "truncate timeline";

		  $this->db->query($str_hapus_dt_tml);

		  echo "<p> Delete all timeline successfull </p>";

		  $files = glob('assets/timeline/*'); // get all file names

		  foreach($files as $file){ // iterate files

			if(is_file($file))

			  unlink($file); // delete file

			  echo "<p> Delete 1 item photo timeline successfull </p>";

		  }

		  

		  $str_hapus_dt_photo = "truncate photo_pelaut_tr";

		  $this->db->query($str_hapus_dt_photo);

		  echo "<p> Delete all photo data successfull </p>";

		  

		  $files = glob('assets/timeline/*'); // get all file names

		  foreach($files as $file){ // iterate files

			if(is_file($file))

			  unlink($file); // delete file

			  echo "<p> Delete 1 item photo album successfull </p>";

		  }

		}

		else

		{

			show_404();

		}

		

	} */

	

	/* function delete_all_image()// jika tidak ada di timeline

	{

		echo "<h2> Hapus Photo yang tidak ada timeline nya </h2>";

		

		$str = "select * from photo_pelaut_tr a,timeline b where a.nama_gambar = b.photo ";

		$q = $this->db->query($str);	

		$f = $q->result_array();

		

		//print_r($f);

		

		// Photo yang ada timeline nya 

		$iptml = 0;

		foreach($f as $row_tml)

		{

			//print_r($row_tml); echo "<hr>";

			$pttml[] = $row_tml;

			$nama_gmbrtml[] = $row_tml['nama_gambar'];  	

			$iptml++;	

		}	

		echo "<h3> Photo yang ada timeline nya  : </h3>";

		print_r($nama_gmbrtml);

		echo "<hr>";

		echo "<h2>".$iptml."</h2>";

		

		echo "<hr>";

		

		$str2 = "select * from photo_pelaut_tr";

		$q2 = $this->db->query($str2);	

		$f2 = $q2->result_array();

		

		foreach($f2 as $row_photo)

		{

			if(!in_array($row_photo['nama_gambar'],$nama_gmbrtml))

			{

				

				$str_delete = "delete from photo_pelaut_tr where id_pptr = '$row_photo[id_pptr]'";

				$q = $this->db->query($str_delete);

				//echo "<img src='".base_url("assets/photo/$row_photo[username]/big/$row_photo[nama_gambar]")."' width='100' height='100' >";

			}

		}

		

	} */

	

	function __destruct()

	{

		

		//echo "<!-- end -->";	

	}

	

	

}