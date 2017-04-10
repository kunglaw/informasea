<?php

function ck_array($array, $key, $value)
{
    //$results = array();
	print_r($array);echo "<hr>";
    if (is_array($array)) {
		// kalau datanya sudah ada , TIDAK dimasukkan
        if (isset($array[$key]) && $array[$key] == $value) {
            //$results[] = $array;
			$result = FALSE;
        }
		// kalau datanya belum ada , DIMASUKKAN
		else
		{
			echo "<p> true ? <p>";
			$result = TRUE;
		}

        /* foreach ($array as $subarray) {
            //$results = array_merge($results, search($subarray, $key, $value));
        }*/
    }

    return $result;
}

function search_array($arrkey, $array) {
	   
	   foreach ($array as $key => $val) {
		   if ($val['username'] === $arrkey['username'] && $val['category'] === $arrkey['category']) {
			  //echo "<div> no insert </div>";
			
			  $res = $key;
			   
		   }
		   else
		   {
			   
			   $res = 0;
		   }
		   
	   }
	   
	   return $res;
	  
	   
}

function search_in_array($srchvalue, $array)
{
    if (is_array($array) && count($array) > 0)
    {
        $foundkey = array_search($srchvalue, $array);
        if ($foundkey === FALSE)
        {
            foreach ($array as $key => $value)
            {
                if (is_array($value) && count($value) > 0)
                {
                    $foundkey = search_in_array($srchvalue, $value);
                    if ($foundkey != FALSE)
                        return $foundkey;
                }
            }
        }
        else
            return $foundkey;
    }
}

function group_array($arr,$val,$category)
{
	$result = array_filter($arr, function($ar) {
   		
		if($category == "seaman")
		{
			return ($ar['username'] == $val['username'] && $ar['category'] == $val['category']);
   	    	//return ($ar['name'] == 'cat 1' AND $ar['id'] == '3');// you can add multiple conditions
		}
	});	
	
	return $result;
}