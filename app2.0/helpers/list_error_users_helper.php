<?php

 // list _error 

	function list_login_error($num)

	{

		if($num == md5(1))

		{

			$message = "Username or Password are Incorrect";

		}
		
		else if($num == md5(2))
		{

			$message  = "Your account has not activated yet, <ul> ";

			

			$message .= " <li> please check your email and search email from informasea.com 

			about Activation account, and click the button Activate</li> ";		

			

			$message .= " <li> if you're not find the email, please check at Spam. </li> ";

			

			

			$message .= " <li> if you're not find again in spam section, you have to click 'Send Activation Code'  

			button to send the activation code again </li </ul> ";	

			

		}
		
		else if($num == md5(4))
		{
			//$message  = " Your Account has been Blocked. Please Contact your administrator at <a href='".base_url("contact")."'> Contact </a>. ";
			//$message .= " Write your email account in email field for verification process ";
			$message = "Your Account has been Blocked. Please <a href='".base_url("users/register")."' target='_blank'>Registered</a> again using another email address, or 
			send your CV to info@informasea.com and our team will help to unblocked your account.";	
		}
		
		else 
		{
			$message = "";
				
		}

		

		return $message;

			

		

	}

?>