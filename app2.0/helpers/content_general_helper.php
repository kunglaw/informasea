<?php  // content_general_helper

/*
	dimas 
	- menangani formating 
	- menangani hal - hal kecil 

*/

if(!function_exists("load_all_language"))
{
	function load_all_language()
	{
		$CI =& get_instance();	
		
		//BAHASA
		$lang_session = $CI->session->userdata("lang");
		if(empty($lang_session)) $lang_session = "english"; // nama folder
		$CI->lang->load('general', $lang_session);
		$CI->lang->load("agentsea",$lang_session);
		$CI->lang->load("vacantsea",$lang_session);
		$CI->lang->load("seatizen",$lang_session);
		$CI->lang->load("home",$lang_session);
		$CI->lang->load("users",$lang_session);
		
		
	}
}

if(!function_exists("hidden_element"))
{
	// hilangkan kalau sudah untuk pengetesan
	function hidden_elemet()
	{
		$ip_address = "36.69.167.29";
		
		if($_SERVER["REMOTE_ADDR"] != "$ip_address")
		{
			$class_hidden = "hidden";
		}
		
		return $class_hidden;
	
	}
	
}

if(!function_exists("flag_nationality"))
{
	function flag_nationality($value)
	{
		$CI =& get_instance();	
		// $a = $CI->load->database("infr6975_2015",TRUE);
		
		if(!empty($value))
		{
			$str = "SELECT * FROM nationality WHERE name = '$value' OR id = '$value' ";	
			$q   = $CI->db->query($str);
			$f   = $q->row_array();
		
			$flag = strtolower($f["flag"]);
			$flag_url = asset_url("flags/".$flag);
			$format = "<span title='$f[name]'> <img src='$flag_url'> $f[name] </span>";
		}
		else
		{
			$format = "";	
		}
		
		return $format;	
	}
}

if(!function_exists("flag"))
{
	function flag($value)
	{
		$CI =& get_instance();	
		// $a = $CI->load->database("infr6975_2015",TRUE);
		
		if(!empty($value))
		{
			$str = "SELECT * FROM nationality WHERE name = '$value' OR id = '$value' ";	
			$q   = $CI->db->query($str);
			$f   = $q->row_array();
		
			$flag = strtolower($f["flag"]);
			$flag_url = asset_url("flags/".$flag);
			$format = "<span title='$f[name]'> <img src='$flag_url'> </span>";
		}
		else
		{
			$format = "";	
		}
		
		return $format;	
	}
}

if(!function_exists("format_rank"))
{
	function format_rank($value)
	{
		$CI =& get_instance();
		//$a = $CI->load->database("infr6975_2015",TRUE);
		
		if(!empty($value))
		{
			$str  = "SELECT * FROM rank where rank = '$value' ";
			$q	= $CI->db->query($str);
			$f 	= $q->row_array();
			
			if(empty($f))
			{				
				$str  = "SELECT * FROM rank where rank_id = '$value' ";
				$q	= $CI->db->query($str);
				$f 	= $q->row_array();
			}
						
			$format  = "<img src='".asset_url("img/star-small.png")."' height='16' width='16'>";
			$format .= "<span> $f[rank]</span>";			
		}
		else
		{
			$format  = "";
		}
		
		return $format;
		
	}
}

if(!function_exists("profiler"))
{
	function profiler()
	{
		$CI =& get_instance();
		
		$CI->output->enable_profiler(TRUE);
		
		$sections = array(
			'config'  => TRUE,
			'queries' => TRUE
			);
		
		$CI->output->set_profiler_sections($sections);
		
	}
}

if(!function_exists("filter"))
{
  function filter($val)
  {
	  // $var = filter_input(INPUT_POST,$var_name,FILTER_SANITIZE_STRING);
	  // $var = filter_input(INPUT_POST,$var_name,FILTER_SANITIZE_SPECIAL_CHARS);
	  
	  $val = filter_var($val,FILTER_SANITIZE_STRING);
	  $val = filter_var($val,FILTER_SANITIZE_SPECIAL_CHARS);
	  
	  //$val = filter_var($val,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	  //$val = preg_replace("/[^a-zA-Z0-9]+/", "", $val);
	  //$val = preg_replace('/[^a-zA-Z0-9_-.]|[.]$/s', '', $val);
	  // $var = filter_var($val,FILTER_SANITIZE_URL);
	  
	  return $val;
  }
}
