<?php if(!defined('BASEPATH')) exit ('No Direct Script access allowed');

if(!function_exists('url_segment_db'))
{
	
	
}

if(!function_exists('json_arr_row'))
{
	function json_arr_row($json = "")
	{
		if(empty($json))
		{
			$json = file_get_contents('php://input');
		}
		
		$arr = array();
		foreach (explode('&', $json) as $row) {
			$param = explode("=", $row);
			$key = urldecode($param[0]);
			$dt  = urldecode($param[1]);
			/*if ($param) {
				printf("Value for parameter \"%s\" is \"%s\"<br/>\n", urldecode($param[0]), urldecode($param[1]));
			}*/
			
			$arr[$key] = $dt; 
		}
		
		return $arr;
		
	}
}

if(!function_exists('json_arr_assoc'))
{
	function json_arr_assoc($json)
	{
		
		
	}
}

if(!function_exists('arr_json_assoc'))
{
	function arr_json_assoc($json)
	{
		
		
	}
}

if(!function_exists('arr_json_row'))
{
	function arr_json_row($json)
	{
		
		
	}
}


	

?>