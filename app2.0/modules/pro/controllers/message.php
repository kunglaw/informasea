<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MX_Controller {
	function __construct()
	{
		parent::__construct();
	}
		
	
	public function index()
	{
		$data['title']	= "Message";
		$this->load->view('message', $data);
		
	}
}
	