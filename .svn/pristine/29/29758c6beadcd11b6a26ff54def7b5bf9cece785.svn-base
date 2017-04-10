<?php
class MY_Exceptions extends CI_Exceptions {

    public function show_404($page = "", $log_error = true)
    {
        $CI =& get_instance();
		//$array['header'] = "";
		//$array["message"] = "";
        
        $data['head']    = "content/error404/head";
      $data['title']    = "The Page you're looking for was not found";  
      $data['css']    = "content/error404/css"; //css tambahan, di head
      $data['meta']  = "content/error404/meta"; // meta tambahan, di head
      $data['js_top']   = "content/error404/js_top"; // js tambahan, di head
      
      $data['template'] = 'content/error404/template';
      $data['message']  = "The Page you are looking for was not found";
      $data['header']   = "Error 404 , Page Not Found";
      
      $data['footer']   = "content/error404/footer";
      $data['js_under'] = "content/error404/js_under"; 

		//$data['message'] = "Error";
		//$data['header'] = "Error 404 , Page Not Found";
		//$data['template'] = 'content/error404/template';
        $CI->load->view('content/error404/index',$data);
        echo $CI->output->get_output();
        exit;
    }
}
?>