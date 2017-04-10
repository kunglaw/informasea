<?php if(!defined('BASEPATH')) exit ('No Direct Script access allowed ') ;

if(!function_exists('autolink'))
{
	function autolink($string)
	{
		$content_array = explode(" ", $string);
		$output = '';
		$dns_list = list_dns();
		
		foreach($content_array as $content)
		{
		  $ss = explode(".",$content,2);	
		  
		  // dns_list
		  if(in_array($ss[1],$dns_list))
		  {
			  $content = '<a href="http://' .$content. '" target="new">' . $content . '</a>';
		  }
		  else
		  {
			  //starts with http://
			  if(strtolower(substr($content, 0, 7)) == "http://")
			  $content = '<a href="' . $content . '" target="new">' . $content . '</a>';
			  
			  //starts with https://
			  if(strtolower(substr($content, 0, 8)) == "https://")
			  $content = '<a href="' . $content . '" target="new">' . $content . '</a>';
			  
			  //starts with www.
			  if(strtolower(substr($content, 0, 4)) == "www.")
			  $content = '<a href="http://' . $content . '" target="new">' . $content . '</a>';
			  
			  //ends with .com
			  if(strtolower(substr($content, -4)) == ".com")
			  $content = '<a href="http://' .$content. '" target="new">' . $content . '</a>';
		  }
		
		  $output .= " " . $content;
		}
		
		$output = trim($output);
		return $output;
	}	
	
	function replace_disallowed_char($title)
	{
		$allowed_char = "a-z 0-9~%.:_\-\&";
		$empty_char = array("*","@","(",")","^","!",">","<",",","{","}","[","]","|","."); 
		// replace empty
		$strip_char = array(" ","_","+","/");// replace trip
		
		$rep_empchar  = str_replace($empty_char,"",$title);
		$rep_stripchar= str_replace($strip_char,"-",$rep_empchar);
		
		$title  = strtolower($rep_stripchar);
		
		return $title;
		
		
	}
	
	function list_dns()
	{
		$CI =& get_instance();
		$str = "select * from dns_list";
		$q = $CI->db->query($str);
		$f = $q->result_array();
		
		foreach($f as $row)
		{
			$nama_dns[] = $row['dns'];
				
		}
		
		return $nama_dns;	
	}
	
}
