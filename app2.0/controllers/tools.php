<?php
class Tools extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
 
        // this controller can only be called from the command line
        //if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
    }
	
	public function message($to = 'World')
	{
		$this->load->library("my_email");
				$email_from  = "alhusna901@informasea.com"; 
				$ex 	      = explode("@",$email_from);
				$user		= $ex[0];

			
				$content = array(
				
					"subject" => "test class email",
					"subject_title" => "informasea.com",
					"to" => "alhusna901@gmail.com",
					"message" => "yang penting ke kirim", // message ini bukan path, jadi bukan load view
					"alt_message" => "ini adalah atl message",
					"mv" => FALSE,
					"amv" => FALSE
					
				);
				
				// alhusna901 adalah salah satu config dari email.php di folder config
				// ini bisa diganti berdasarkan settingan di config/email.php
				$this->my_email->send_email($user,$content);
	}
}
?>