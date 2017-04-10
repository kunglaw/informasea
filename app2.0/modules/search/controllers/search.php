<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Search extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->authentification->underconst_access();
		
		//BAHASA
		$lang_session = $this->session->userdata("lang");
		if(empty($lang_session)) $lang_session = "english"; // nama folder
		$this->lang->load('general', $lang_session);
		
		// =================================
		
		//$this->authentification->close_access();
		$this->load->model("search_model");
		
	}
	
	function filter()
	{
		$keyword = $this->input->post("keyword",true);
		
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("keyword","Keyword","required|xss_clean");
		$this->form_validation->set_rules("page","Page","xss_clean");
		
		if($this->form_validation->run() == true)
		{
			$k = explode(" ",$keyword);
			if(count($k) > 1)
			{
				$keyword = implode("-",$k);
				
			}
			else
			{
				$keyword = $k[0];	
			}
			//exit($keyword);
			header("location:".base_url("search/$keyword"));
		}
		else
		{
			//show_404('custom404');
			$this->index();
		}
	}
	
	function index($keyword = "")
	{
		
		// jadikan spasi kembali
		$k = explode("-",$keyword);
		if(count($k) > 1)
		{
			$keyword = str_replace("-"," ",$keyword);
		}
		else
		{
			$keyword = $k[0];	
		}
		
		//exit("keyword = ".$keyword);
		
		$this->load->library('table');
		$tmpl = array (
			'table_open'          => '<table border="1" cellpadding="4" cellspacing="0">',
  
			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>',
			'heading_cell_end'    => '</th>',
  
			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',
  
			'row_alt_start'       => '<tr>',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',
  
			'table_close'         => '</table>'
		);
  
	    $this->table->set_template($tmpl); 

		
		$data['title'] 	= "Search";
		$data['css'] 	  = "css";
		$data['js_top']   = "js_top";
		$data['js_under'] = "js_under";
		$data['template'] = "template";
		
		$data['search']   = $this->search_model->search();
		
		$pelaut_ms 		= $this->search_model->s_pelaut($keyword);
		$coc 	   		  = $this->search_model->s_competency($keyword);
		$doc	   		  = $this->search_model->s_document($keyword);
		$prof	  		 = $this->search_model->s_proficiency($keyword);
		$exp	   		  = $this->search_model->s_experience($keyword);
		$vacant		   = $this->search_model->s_vacantsea($keyword);
		$comp	  		 = $this->search_model->s_company($keyword);
		
		$merge 			= array("pelaut"=>$pelaut_ms,"coc"=>$coc,"doc"=>$doc,"prof"=>$prof,"exp"=>$exp,"vacant"=>$vacant,"comp"=>$comp);
		$filter 		   = $this->search_model->filter($merge);
		$group_by 		 = $this->search_model->group_by($filter);
		
		
		$data['dt']	   = $group_by;
		$data['keyword']  = $keyword;
		
		$this->load->view('index',$data);
		
		/**/
		
		/* echo "<form action='".base_url("search/filter")."' method='post'><input type='text' name='keyword' value='$keyword' ></form>";
		echo "<h1>Search '$keyword' </h1>";

		$this->table->set_heading(array("id","name","category","table","point"));
		echo $this->table->generate($filter);
		
		echo "<hr><h2>Pelaut</h2>";
		$dpelaut = $this->search_model->view_data($pelaut_ms);
		echo $this->table->generate($dpelaut);
		echo "<hr><h2> Pelaut:COC Class </h2>";
		$dcoc = $this->search_model->view_data($coc);
		echo $this->table->generate($dcoc);
		echo "<hr><h2> Pelaut:Document </h2>";
		$ddoc = $this->search_model->view_data($doc);
		echo $this->table->generate($ddoc);
		echo "<hr><h2> Pelaut:Proficiency </h2>";
		$dprof = $this->search_model->view_data($prof);
		echo $this->table->generate($dprof);
		echo "<hr><h2> Pelaut:Experience </h2>";
		$dexp = $this->search_model->view_data($exp);
		echo $this->table->generate($dexp);
		echo "<hr><h2> Vacantsea </h2>";
		$vac = $this->search_model->view_data($vacant);
		echo $this->table->generate($vac);
		echo "<hr><h2> Company </h2>";
		$com = $this->search_model->view_data($comp);
		echo $this->table->generate($com);
		
		
		
		//$this->output->enable_profiler(TRUE);
		//$this->output->set_profiler_sections($sections);
		//$this->load->view("index",$data);*/
		
	}
	
	function __destruct()
	{
		
			
	}
	
	
	
}