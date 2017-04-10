<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Controller informasea, module informasea

class Home extends MX_Controller {
	
	function __construct()
	{
		//error_reporting(E_ALL);
		parent::__construct();
		
		load_all_language();
		
		$this->load->model("vessel_model");
		$this->load->model("department_model");
		$this->load->model("nation_model");
	}
	
	function index()
	{
		//session_start(); // keperluan captcha
		/* $data['head']	 = "head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "meta"; // meta tambahan, di head
		$data['js_top']   = "js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "template";
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view('index',$data); */
		
		
		
		$data['head']	 = "landingpage2/head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "landingpage/meta"; // meta tambahan, di head
		$data['js_top']   = "landingpage2/js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "landingpage2/template";
		$data['footer']   = "landingpage2/footer";
		$data['js_under'] = "landingpage2/js_under"; 
		
		$this->load->view('landingpage2/index',$data);
	}
	
	function index2()
	{
		$data['head']	 = "test_landingpage2/head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "landingpage/meta"; // meta tambahan, di head
		$data['js_top']   = "test_landingpage2/js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "test_landingpage2/template";
		$data['footer']   = "test_landingpage2/footer";
		$data['js_under'] = "test_landingpage2/js_under"; 
		
		$this->load->view('test_landingpage2/index',$data);
		
	}
	
	function index_backup()
	{
		//session_start(); // keperluan captcha
		/* $data['head']	 = "head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "meta"; // meta tambahan, di head
		$data['js_top']   = "js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "template";
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view('index',$data); */
		if($this->session->userdata("username") == "ariesdimasy")
		{
			echo $keyword;
			
		}
		
		$data['head']	 = "landingpage/head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "landingpage/meta"; // meta tambahan, di head
		$data['js_top']   = "landingpage/js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "landingpage/template";
		$data['footer']   = "landingpage/footer";
		$data['js_under'] = "landingpage/js_under"; 
		
		$this->load->view('landingpage/index',$data);
	}
	
	function index_test()
	{
		
		//session_start(); // keperluan captcha
		/* $data['head']	 = "head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "meta"; // meta tambahan, di head
		$data['js_top']   = "js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "template";
		$data['footer']   = "footer";
		$data['js_under'] = "js_under"; 
		
		$this->load->view('index',$data); */
		
		$data['head']	 = "landingpage/head";
		$data['title']	= "Home";	
		//$data['css']	  = "css"; //css tambahan, di head
		$data['meta']	 = "landingpage/meta"; // meta tambahan, di head
		$data['js_top']   = "landingpage/js_top"; // js tambahan, di head
		
		//include
		//$data['navbar']   = "";
		$data['template'] = "landingpage/template";
		$data['footer']   = "landingpage/footer";
		$data['js_under'] = "landingpage/js_under"; 
		
		$this->load->view('landingpage/index',$data);
	}
	
	

     function getdata(){
		 
        $this->load->model('ship_model');

        $search_by = $this->input->post('search_by');
        $department = $this->input->post('department');
        $vessel_type = $this->input->post('vessel_type');
        $nationality = $this->input->post('nationality');
        $keyword = $this->input->post('keyword');

        if($department != ""){
            $data_dept = $this->department_model->get_detail_department($department);
        }

        if($vessel_type != 0){
            $data_ship = $this->ship_model->get_ships_type($vessel_type);
        }

        if($nationality != 0){
            $data_nationality = $this->nation_model->get_detail_nationality($nationality);
        }


       
        echo $data_ship['ship_type']."&".$data_dept['department']."&".$data_nationality['name'];



    }

   
     function search()
    {
        $search_by = $this->input->post("search_by");
        $department = $this->input->post("department");
        $vessel_type = $this->input->post("vessel_type");
        $nationality = $this->input->post("nationality");
        $keyword = $this->input->post("keyword");
        $dept2 = $this->department_model->get_detail_department($department);
        $ship_type = $this->vessel_model->get_shiptype_byshipid($vessel_type);

        if($department != "")
        { 
            $department = str_replace(' ', '-',$dept2['department'] ); 
        }
        if($vessel_type != "")
        { 
            $vessel_type = str_replace(' ','-',$ship_type['ship_type']); 
        }
        if($nationality != "")
        {
            $nationality = str_replace(' ','-',$this->nation_model->get_detail_nationality($nationality)['name']);
            
        }
        $url = "$search_by/search_dashboard";

        if($vessel_type != "" && $department != ""){
            $url .= "/$vessel_type/$department";
        }else if($vessel_type == "" && $department != ""){
            $url .= "/$department";
        }else if($vessel_tpe != "" && $department == ""){
            $url .= "/$vessel_type";
        }
        if($keyword == "" AND $department == "" AND $vessel_type == "" AND $nationality != ""){
            //hanya nationality
            $url .= "?nationality=$nationality";
        } else if($keyword == "" AND $department == "" AND $vessel_type != "" AND $nationality == ""){
            //hanya vessel
            $url .= "?vessel_type=$vessel_type";
        } else if($keyword == "" AND $department != "" AND $vessel_type == "" AND $nationality == ""){
            //hanya department
            $url .= "?department=$department";
        } else if($keyword == "" AND $department != "" AND $vessel_type != "" AND $nationality == ""){
            //department vessel
            $url .= "?vessel=$vessel_type&department=$department";
        } else if($keyword == "" AND $department != "" AND $vessel_type == "" AND $nationality != ""){
            //department nationality
            $url .= "?department=$department&nationality=$nationality";
        } else if($keyword == "" AND $department == "" AND $vessel_type != "" AND $nationality != ""){
            //vessel nationality
            $url .= "?vessel=$vessel_type&nationality=$nationality";
        }else if($keyword == "" OR empty($keyword)){
            //tanpa keyword
            $url .= "?vessel_type=$vessel_type&department=$department&nationality=$nationality";
        }  else if($keyword != "" AND $vessel_type != "" AND $department != "" AND $nationality == ""){
            //keyword vessel department
            $url .="/$keyword?vessel=$vessel_type&department=$department";
        } else if($keyword != "" AND $vessel_type != "" AND $department != "" AND $nationality ==""){
            
            //keyword vessel nationality
            $url .= "/$keyword?vessel=$vessel_type&department=$department";
        } else if($keyword != "" AND $vessel_type != "" AND $department == "" AND $nationality != ""){
            $url .= "/$keyword?vessel=$vessel_type&nationality=$nationality";
        } else if($keyword != "" AND $vessel_type == "" AND $department != "" AND $nationality != ""){
            $url .= "/$keyword?department=$department&nationality=$nationality";
        } else if($keyword == "" AND $vessel_type == "" AND $department == "" AND $nationality == ""){
            $url .= "";
        } 
        else{
             $url .= "/$keyword/?vessel_type=$vessel_type&department=$department&nationality=$nationality";
        }

    




        /* yang lamaa */
        // if($department!="") $department = str_replace(' ','-', $this->department_model->get_detail_department($department)["department"]);
        // if($vessel_type!="") $vessel_type = str_replace(' ','-', $this->vessel_model->get_shiptype_byshipid($vessel_type)["ship_type"]);
        // if($nationality!="") $nationality= str_replace(' ','-', $this->nation_model->get_detail_nationality($nationality)["name"]);


        // $url = "$search_by/search_dashboard";
        // if ($vessel_type != "" && $department != "" && $nationality != "") $url .= "/$vessel_type/$department/$nationality";
        // else if ($vessel_type != "" && $department != "" && $nationality == "") $url .= "/$vessel_type/$department";
        // else if ($vessel_type != "" && $department == "" && $nationality != "") $url .= "/$vessel_type/$nationality";
        // else if ($vessel_type == "" && $department != "" && $nationality != "") $url .= "/$department/$nationality";
        // else if ($vessel_type == "" && $department == "" && $nationality != "") $url .= "/$nationality";
        // else if ($vessel_type == "" && $department != "" && $nationality == "") $url .= "/$department";
        // else if ($vessel_type != "" && $department == "" && $nationality == "") $url .= "/$vessel_type";

      //  $url .= "/$keyword";
         echo base_url($url);
    
    }
   
    function listVesselType(){
        $data['list_vessel'] = $this->vessel_model->get_ship_type();
        $this->load->view("vessel-list",$data);
    }

    function listNationality(){
        $data['list_nationality'] = $this->nation_model->get_nationality();
        $this->load->view("nationality-list",$data);
    }





    function send_mail_depan(){
		
           session_start();
			
			//if($this->input->post("input_capt") == $_SESSION["captcha"]){ echo "benar";}else{ echo "salah";}; exit;
			
            $this->load->library('form_validation');

            /*$g_captcha_response = $_POST['g-recaptcha-response'];

            $json=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcFQgkTAAAAALuuCpbziR8xjiFvaCuY2sg9jTol&response=".$g_captcha_response."&remoteip=".$_SERVER['REMOTE_ADDR']);

            $response = json_decode($json, true);*/

            if($this->input->post("input_capt") == $_SESSION["captcha"]) {

                $nama = $this->input->post("nama", true);
                $email = $this->input->post("email", true);
                $phone = $this->input->post("phone", true);
                $subject = $this->input->post("subject", true);
                $message = $this->input->post("message", true);

                $this->form_validation->set_rules('nama', 'nama', 'required|xss_clean');
                $this->form_validation->set_rules('subject', 'subject', 'required|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                $this->form_validation->set_rules('message', 'message', 'required|xss_clean');

                if($this->form_validation->run() == TRUE) {
					
                    $this->load->library('email');
					
					$config = array();
					$config['protocol']  = 'smtp';
					$config['mailtype']  = 'html';
					$config['priority']  = '1';
					$config['wordwrap']  = FALSE;
					$config['smtp_host'] = 'ssl://mail.informasea.com';
					$config['smtp_port'] = 465;
					$config['smtp_user'] = 'info@informasea.com';
					$config['smtp_pass'] = 'uA8Q_MOh%%Ol';
					
					$this->email->initialize($config);
					
                    $this->email->from($email, $nama);
                    $this->email->to('info@informasea.com');
                    $this->email->subject($subject);
                    $this->email->message($message);

                    $url = base_url("contact");
                    $a = $this->email->send();

                    if ($a) {
						 
						 $f = array(
							  'nama_pengirim' => $nama,
							  'email' => $email,
							  'subject' => "From CU - ".$subject,
							  'message' => $message,
							  'waktu_pengirim' => date('Y-m-d H:i:s')
						 );
	  
						 $this->db->insert("contact_us",$f);
						 
						 $data['head']     = "landingpage2/head";
						 $data['title']  = "Home";   
						 //$data['css']    = "css"; //css tambahan, di head
						 $data['meta']    = "landingpage/meta"; // meta tambahan, di head
						 $data['js_top']   = "landingpage2/js_top"; // js tambahan, di head
						
						 //include
						 //$data['navbar']   = "";
						 $data['template'] = "landingpage2/template";
						 $data['footer']   = "landingpage2/footer";
						 $data['js_under'] = "landingpage2/js_under"; 
	  
						 $data['success'] = "<div class='alert alert-success'>
						 <span class='glyphicon glyphicon-ok'> </span> Thank you </div>";
						 
						 $this->email->print_debugger();
	  
						 $this->load->view('landingpage2/index',$data);
	  
					 	 //  $this->load->view('index', $data);
					}
					else
					{
	  
						$data['head']  = "landingpage2/head";
						$data['title']  = "Home";   
						//$data['css']    = "css"; //css tambahan, di head
						$data['meta']    = "landingpage/meta"; // meta tambahan, di head
						$data['js_top']   = "landingpage2/js_top"; // js tambahan, di head
						
						//include
						//$data['navbar']   = "";
						$data['template'] = "landingpage2/template";
						$data['footer']   = "landingpage2/footer";
						$data['js_under'] = "landingpage2/js_under"; 
						$data['ve'] 	   = $this->email->print_debugger();
				
						$this->load->view('landingpage2/index',$data);
					    // $this->load->view('index', $data);
					}
	  
				} // if validasi
				else
				{
					$data['head']     = "landingpage2/head";
					$data['title']    = "Home";   
					//$data['css']    = "css"; //css tambahan, di head
					$data['meta']     = "landingpage/meta"; // meta tambahan, di head
					$data['js_top']   = "landingpage2/js_top"; // js tambahan, di head
					
					//include
					//$data['navbar']   = "";
					$data['template'] = "landingpage2/template";
					$data['footer']   = "landingpage2/footer";
					$data['js_under'] = "landingpage2/js_under"; 
					$data['ve'] 	   = validation_errors();
			
					$this->load->view('landingpage2/index',$data);	
				}

		 	}
			else
			{
				$data['head']     = "landingpage2/head";
				$data['title']  = "Home";   
				//$data['css']    = "css"; //css tambahan, di head
				$data['meta']    = "landingpage/meta"; // meta tambahan, di head
				$data['js_top']   = "landingpage2/js_top"; // js tambahan, di head
				
				//include
				//$data['navbar']   = "";
				$data['template'] = "landingpage2/template";
				$data['footer']   = "landingpage2/footer";
				$data['js_under'] = "landingpage2/js_under"; 
				$data['ve'] 	   = "you must type the captcha correctly to complete the message";
		
				$this->load->view('landingpage2/index',$data);
						  //  $this->load->view('index', $data);
            }

			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');


			//echo $this->email->print_debugger();
       
        }
	
	function __destruct()
	{
		
	}

}

/* End of file users.php */
/* Location: ./application/modules/informasea/controllers/informasea.php */