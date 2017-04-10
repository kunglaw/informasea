<?php

if($_SERVER['SERVER_ADDR'] == "127.0.0.1" || $_SERVER['SERVER_ADDR'] == "::1")
{
	$home = "localhost";	
}
else
{
	$home = $_SERVER['SERVER_ADDR'];
		
}

echo "http://$home/informasea";