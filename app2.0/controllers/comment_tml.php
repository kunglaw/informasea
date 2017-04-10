<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class comment_tml extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		//$this->authentification_model->close_access();
		
		$this->load->model('comment_tml_model');
		$this->load->model('timeline_model');
		$this->load->model('users/user_model');
		
		$this->load->helper('date_format_helper');
	}
	
	function index()
	{
		
		
		
	}
	
	// AJAX
	function get_comment()
	{
		//$this->authentification_model->close_access();
		$this->authentification_model->ajax_access();
		//echo $this->input->post('id_timeline');
		//print_r($this->input->post()); exit;
		
		/*echo "<script> alert('post_xyz:".$this->input->post("x")."') </script>"; */
		
		$data['comment'] = $this->comment_tml_model->get_comment();
		
		//print_r($data['comment']);
		//echo "parah";
		$this->load->view('seaman/list_comment',$data);
			
		
	}
	
	// PRIVATE
	function insert_comment()
	{
		$this->authentification_model->close_access();
		//$this->authentification_model->ajax_access();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('post_content', 'Comment', 'required');
		$this->form_validation->set_rules('id_timeline','ID Timeline','required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['info'] =  validation_errors();
			$this->load->view('component/modal',$data);
		}
		else
		{
			$data['info'] = "";
			$insert = $this->comment_tml_model->insert_comment();
		}
		
		
		
		
	}
	
	function __destruct()
	{
		
			
	}
	
	
	
	
}


