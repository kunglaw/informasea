<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class friendship extends MX_Controller{
	
	
	function __construct()
	{
		parent::__construct();	
		$this->authentification->underconst_access();
		//echo "<p> construct jalan </p>";
		$this->authentification_model->close_access();
		$this->load->model('friendship_model');
	}
	
	function index()
	{
		print_r($this->session->all_userdata());
		
		// contoh user id = 1
		$id = $this->input->post('id_pelaut'); // punya alhusna_99 (Aries Dimas Yudhistira)
		$pelaut_id = !empty($id) ? $id : 1;
		
		$data['self'] = $this->friendship_model->detail_friend($pelaut_id);
		$data['arr_teman'] = $this->friendship_model->show_friend($pelaut_id);
		
		//print_r($a);

		$this->load->view('friendship_content',$data);
		
	}
	
	function test_pelaut()
	{
		$this->load->model('timeline_model');
		
		$timeline = $this->timeline_model->get_tml();
		$kk = array();
		
		//print_r($timeline);echo "<hr>";
		
		foreach($timeline as $row)
		{
			 $kk[] = $row;
			
			
		}
		
		//print_r($kk);
		foreach($kk as $bb)
		{
			echo "<p> "; 
			echo $bb['id_timeline']; echo "-";
			echo $bb['content'];
			echo "</p>";	
			
		}
		
		
	}
	
	
	
	
}

