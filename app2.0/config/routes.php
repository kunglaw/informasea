<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= "home";
$route['404_override'] 		  = "custom404";

//CONTROLLER 
$route["test"]				  = "test";

// shortned url 
$route["s/(:any)"]			  = "seaman/profile/resume";

//searching 
$route["search/filter"] = "search/filter";
$route["search/(:any)"] = "search/index/$1";

//vacantsea
$route["vacantsea"]						  = "vacantsea";
$route['vacantsea/preview'] 				  = "vacantsea";
$route["vacantsea/all"]					  = "vacantsea/all";
$route["vacantsea/detail/(:num)/(:any)"]     = "vacantsea/detail";
$route["vacantsea/detail/(:num)"]     		= "vacantsea/detail";
$route["vacantsea/search/(:any)"]		    = "vacantsea/search";
$route['vacantsea/(:num)/(:any)'] 			= "vacantsea/detail";
$route['vacantsea/(:num)/(:any)/preview'] 	= "vacantsea/detail";
$route["vacantsea/list_rank"]				= "vacantsea/list_rank";
$route["vacantsea/list_department"]		  = "vacantsea/list_department";
$route["vacantsea/list_ship"]				= "vacantsea/list_ship";
// $route['vacantsea/detail/(:num)']	= "vacantsea/detail";

/* Contract from Infradmin */
$route['contract/negotiate/(:num)/(:any)']			= "contract/negotiate_contract";
$route['contract/agree/(:num)/(:any)']			= "contract/contract_agree";

// company
$route['agentsea']					   		 = "company";
/* Untuk preview iklan */
$route['agentsea/preview']					   		 = "company";
$route['agentsea/list/page/preview']				   = "company";
$route['agentsea/list/page/(:num)/preview']			= "company";
$route['agentsea/search/(:any)/preview']			   = "company/search";
$route['agentsea/(:any)/home/preview'] 		   		 = "company/detail";
$route['agentsea/(:any)/profile/preview']			  = "company/detail";
$route['agentsea/(:any)/vacantsea/preview']	  	   	= "company/detail";
$route['agentsea/(:any)/information/preview']    	  = "company/detail";
$route['agentsea/(:any)/photos/preview']		 	   = "company/detail";
$route['agentsea/(:any)/ships/preview']		  	   	= "company/detail";
$route['agentsea/(:any)/more/preview']		    	 = "company/detail";
$route['agentsea/(:any)/photos/(:num)/preview']	   	= "company/detail";
$route['agentsea/(:any)/ships/(:num)/preview']		 = "company/detail";
$route['agentsea/(:any)/vacantsea/(:num)/preview']	 = "company/detail";
/* Untuk preview iklan */
$route['agentsea/list/page']				   = "company";
$route['agentsea/list/page/(:num)']			= "company";
$route['agentsea/search/(:any)']			   = "company/search";
$route['agentsea/(:any)/home'] 		   		 = "company/detail";
$route['agentsea/(:any)/profile']			  = "company/detail";
$route['agentsea/(:any)/vacantsea']	  	   	= "company/detail";
$route['agentsea/(:any)/information']    	  = "company/detail";
$route['agentsea/(:any)/photos']		 	   = "company/detail";
$route['agentsea/(:any)/ships']		  	   	= "company/detail";
$route['agentsea/(:any)/more']		    	 = "company/detail";
$route['agentsea/(:any)/photos/(:num)']	   	= "company/detail";
$route['agentsea/(:any)/ships/(:num)']		 = "company/detail";
$route['agentsea/(:any)/vacantsea/(:num)']	 = "company/detail";
$route['agentsea/(:any)']				      = "company/detail"; 

// jaga - jaga klo masih ada yang menggunakan /company
$route['company']					   		 = "company";

/* Untuk preview iklan */
$route['company/preview']					   		 = "company";
$route['company/list/page/preview']				   = "company";
$route['company/list/page/(:num)/preview']			= "company";

$route['company/search/(:any)']					   = "company/search";
$route['company/search/(:any)/preview']			   = "company/search";
$route['company/(:any)/home/preview'] 		   		 = "company/detail";
$route['company/(:any)/profile/preview']			  = "company/detail";
$route['company/(:any)/vacantsea/preview']	  	   	= "company/detail";
$route['company/(:any)/information/preview']    	  = "company/detail";
$route['company/(:any)/photos/preview']		 	   = "company/detail";
$route['company/(:any)/ships/preview']		  	   	= "company/detail";
$route['company/(:any)/more/preview']		    	 = "company/detail";
$route['company/(:any)/photos/(:num)/preview']	   	= "company/detail";
$route['company/(:any)/ships/(:num)/preview']		 = "company/detail";
$route['company/(:any)/vacantsea/(:num)/preview']	 = "company/detail";
/* Untuk preview iklan */

$route['company/(:any)/home'] 		   		 = "company/detail";
$route['company/(:any)/profile']			  = "company/detail";
$route['company/(:any)/vacantsea']	  	    = "company/detail";
$route['company/(:any)/information']    	  = "company/detail";
$route['company/(:any)/photos']		 	   = "company/detail";
$route['company/(:any)/ships']		  	    = "company/detail";
$route['company/(:any)/more']		    	 = "company/detail";
$route['company/(:any)/photos/(:num)']	    = "company/detail";
$route['company/(:any)/ships/(:num)']		 = "company/detail";
$route['company/(:any)/vacantsea/(:num)']	 = "company/detail";
// $route['company/(:any)']					  = "company/detail";



/* === Untuk preview iklan === */
$route['profile/preview']							 	 = "seaman/profile";
$route['profile_seatizen/(:any)/preview'] 			 	 = "seatizen/profile/detail";

//$route['profile/(:any)/detail']			  = "seaman/profile/detail";
//$route['profile/(:any)/photo'] 	   		  = "seaman/profile/photo";
//$route['profile/(:any)/experience']  		  = "seaman/profile/experience";
//$route['profile/(:any)/appraisal/(:any)']   = "seaman/profile/save_session";

$route['profile/(:any)/appraisal'] 	   	  				= "seaman/profile/appraisal";
$route['profile/(:any)/friends/preview'] 	 		  	  = "seaman/profile/friends";
$route['profile/(:any)/about/preview'] 	   				= "seaman/profile/about";
$route['profile/(:any)/account/preview'] 	 		  	  = "seaman/profile/account";
$route['profile/(:any)/resume/preview'] 	  		   	   = "seaman/profile/resume";
$route['profile/(:any)/applied-vacantsea'] 	      		= "seaman/profile/appliedvacantsea";
$route['profile/(:any)/applied-vacantsea/(:num)/preview'] = "seaman/profile/appliedvacantsea";
$route['profile/(:any)/timeline/detail/(:num)/preview']   = "seaman/profile/detail_tml/$1";
/* === Preview Iklan === */

//seaman
$route['seaman/profile'] 			 		  = "seaman/resume";
$route['profile']							 = "seaman/profile";
$route['profile_seatizen/(:any)'] 			 = "seatizen/profile/detail";

$route['profile/(:any)/friends'] 	 		  	  = "seaman/profile/friends";
$route['profile/(:any)/about'] 	   				= "seaman/profile/about";
$route['profile/(:any)/account'] 	 		  	  = "seaman/profile/account";
$route['profile/(:any)/resume'] 	  		   	   = "seaman/profile/resume";
$route['profile/(:any)/applied-vacantsea'] 	      = "seaman/profile/appliedvacantsea";
$route['profile/(:any)/applied-vacantsea/(:num)']   = "seaman/profile/appliedvacantsea";
$route['profile/(:any)/timeline/detail/(:num)']     = "seaman/profile/detail_tml/$1"; 
$route["profile/(:any)/recommendation"]			 = "seaman/profile/recommendation";
$route["profile/(:any)/resume_print"]			   = "seaman/profile/resume_print";

//$route['profile/(:any)'] 			 		  	  = "seaman/profile"; // INGAT, (:any) harus dibawah
$route['profile/(:any)'] 			 		  	  = "seaman/profile"; //resume"; // suatu saat harus ganti
$route['profile/(:any)/preview'] 			 	  = "seaman/profile"; //resume"; // suatu saat harus ganti
$route['seaman/resume/preview'] 				   = 'seaman/resume';
$route['seaman/resume/print'] 					 = 'seaman/resume/print_pdf';

$route["seatizen"]								= "seatizen";
$route['seatizen/preview'] 						= 'seatizen';
$route["seatizen/getData"]				  		= "seatizen/getData";
$route["seatizen/search/(:any)"]				  = "seatizen/search";
$route['seatizen/complete/resume'] 				= 'seatizen/show_all_complete_resume';
$route['seatizen/complete/resume/(:num)'] 		 = 'seatizen/show_all_complete_resume';
$route["seatizen/list_ship"]					  = "seatizen/list_ship";
$route["seatizen/list_department"]				= "seatizen/list_department";
$route["seatizen/list_nation"]					= "seatizen/list_nation";
$route["seatizen/list_coc"]					   = "seatizen/list_coc";
$route["seatizen/list_rank"]					  = "seatizen/list_rank";

//users

$route['register']				   		     	= "users/register_all";
$route['register_all']				   		    = "users/register_all";

$route['activation']				   		      = "users/activate_account";
				
$route['login']				      		       = "users/login";
$route['forgotpass']						   	  = "users/forgotpass";

$route['about'] 					  		       = "about_infr/about";

$route['our-policy']   					       	  = "about_infr/about/privacy";
$route['contact']  						      	 = "about_infr/contact";
$route['infr-policy'] 						  	 = "about_infr/about/privacy";

$route['welcome/(:any)'] 					  = "custom404"; // matikan 

// HARUS PALING TERAKHIR
//$route["(:any)"]							  = "seaman/profile";



/* End of file routes.php */
/* Location: ./application/config/routes.php */