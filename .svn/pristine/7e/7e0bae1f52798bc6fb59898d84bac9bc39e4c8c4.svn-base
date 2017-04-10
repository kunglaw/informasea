<?php
class MY_Exceptions extends CI_Exceptions {

    public function show_404($page = "", $log_error = true)
    {
        $CI =& get_instance();
		//$array['header'] = "";
		//$array["message"] = "";
		$data['message'] = "Error";
		$data['header'] = "Error 404 , Page Not Found";
		$data['template'] = 'content/error404/template';
        $CI->load->view('content/error404/index',$data);
        echo $CI->output->get_output();
        exit;
    }
}
?>