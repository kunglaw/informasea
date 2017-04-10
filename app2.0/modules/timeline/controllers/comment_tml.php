<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class comment_tml extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		//$this->authentification_model->close_access();
		
		$this->load->model('comment_tml_model'); 
		$this->load->model('timeline_model');
		$this->load->model('users/user_model');
		//var_dump($this->load->model('users/user_model'));echo "<br>";
		
		//var_dump($this->load->helper('date_format_helper'));
	}
	
	function index()
	{
		echo "ini index dari controller comment_tml";
		
	}
	
	// AJAX
	function get_comment()
	{
		//$this->authentification_model->close_access();
		$this->authentification->ajax_access();
		
		$id_timeline = $this->input->post('id_timeline');
		//print_r($this->input->post()); exit;
		
		/*echo "<script> alert('post_xyz:".$this->input->post("x")."') </script>"; */
		//$id_timeline = $this->input->post('id_timeline');
		//$data['comment'] = Modules::run("timeline");
		$data['comment'] = $this->comment_tml_model->get_comment($id_timeline);
		
		//var_dump(12); echo "<br>";
		//print_r($data['comment']);// exit;
		//Modules::run('seaman');
		$this->load->view('list-comment-timeline',$data);
		// ubah expressi ini jika sudah ada fitur pertemanan
		
	}
	
	function insert_comment()
	{
		//$id_time
		$this->authentification->close_access();
		//$this->authentification_model->ajax_access();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('post_content', 'Comment', 'required');
		$this->form_validation->set_rules('id_timeline','ID Timeline','required');
	
		if ($this->form_validation->run() == FALSE)
		{
			echo $data['info'] =  validation_errors();
			//$this->load->view('component/modal',$data);
		}
		else
		{
			$data['info'] = "";
			$insert = $this->comment_tml_model->insert_comment();
		}
		
		echo json_encode($data);
	
	}
	
	function delete_comment()
	{
		//$id_time
		$this->authentification->close_access();
		//$this->authentification_model->ajax_access();		
		$this->load->library('form_validation');
		
		$id_comment_tml = $this->input->post("id_comment_tml");
	
		if(!empty($id_comment_tml))
		{	
			$this->comment_tml_model->delete_comment($id_comment_tml);  
		}
		else
		{
			echo "this comment cannot deleted";	
		}
		
	}
	
	function __destruct()
	{
		
	}
	
	
	
	
}


