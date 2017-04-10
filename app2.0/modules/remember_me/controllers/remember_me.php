<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 05/06/2015
 * Time: 9:57
 */

class remember_me extends MX_Controller {
    function __construct(){
        //load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');
		
		$session_set_value = $this->session->all_userdata();
		if($session_set_value['remember_me'] != 1)
		{
			$this->session->unset_userdata('logged_in');
		}
    }

    function index($data = ""){
        $session_set_value = $this->session->all_userdata();
		print_r($session_set_value);
        if((isset($session_set_value)) && !empty($session_set_value['logged_in']) && $session_set_value['remember_me'] == 1){

            $this->load->view("admin_page");
        }
        else {
            $data['title'] = "Login Remember Me Example";
            $data['template'] = "template";
            $data["remember_me"] = isset($session_set_value) ? $session_set_value : 0;
            
			$this->load->view("index", $data);
        }
    }

    function login_auth(){
        // Retrieve session data
        $session_set_value = $this->session->all_userdata();
        if((isset($session_set_value)) && !empty($session_set_value['logged_in']) && $session_set_value['remember_me'] == 1){
            $this->load->view("admin_page");
        }
        else {
            // Check for validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                    $remember = $this->input->post('autologin');
                    if ($remember) {
                        // Set remember me value in session
                        $this->session->set_userdata('remember_me', TRUE);
                    }
                    $sess_data = array(
                        'username' => $username,
                        'password' => $password
                    );
                    $this->session->set_userdata('logged_in', $sess_data);
                    $this->load->view('admin_page');
            }
        }
    }

    function logout(){
        $this->session->sess_destroy();
        $this->index();
    }

    function __destruct(){}
}