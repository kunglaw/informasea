<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

// STRING
if(!function_exists('nonull_to_default'))
{
	
	function nonull_to_default($value)
	{
		
		$default = "<em> - data belum tersedia </em>";
		
		if($value == NULL)
		{
			return $default;
			
		}
		else
		{
			return $value;	
			
		}
		
		
	}
	
	
}

// ANGKA
if(!function_exists('nol_to_default'))
{
	
	function nol_to_default($value)
	{
		
		$default = "<em> - data belum tersedia </em>";
		
		if($value <= 0)
		{
			return $default;
			
		}
		else
		{
			return $value;	
			
		}	
	}	
}

// DATE
if(!function_exists('dnull_to_default'))
{
	function dnull_to_default($value)
	{
		
		$default = "<em>- data belum tersedia -</em>";
		
		if($value == "0000-00-00")
		{
			return $default;
		}
		else
		{
			return $value;
			
		}
		
	}
}


// ARRAY
if(!function_exists('rnull_to_default'))
{
	
	function rnull_to_default($value)
	{
		$default = "<em> - Data belum tersedia - </em>";
		
		if(count($value))
		{
			
		}
		
		
	}
	
	
}