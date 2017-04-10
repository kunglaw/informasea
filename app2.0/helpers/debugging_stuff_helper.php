<?php
	
	if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	if ( ! function_exists('alert'))
	{
	  function alert($text = "")
	  {
		  return "<script type='text/javascript'> alert('$text'); </script>";
	  }
	}
	
?>