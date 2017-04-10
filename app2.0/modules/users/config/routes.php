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

$route["users/register/agentsea"]			= "users/register_all";
$route["users/register/seaman"]			  = "users/register_all";

$route['users/login'] 			 	 = 'users/login';
$route['users/activation'] 			= 'users/activate_account';
$route['users/login/universal']	   = 'users/login_univ';
$route['users/login/agentsea'] 		= 'users/login_company';
$route["users/login/agentsea_modal"]  = "users/login_company_modal";
$route['users/forgotpass']	 		= "users/forgotpass";
$route["users/forgotpass/agentsea"]   = "users/forgotpass_company";

$route["users/login/agentsea_modal/process"] = "users/company_process/agentsea_login_modal_process";
$route["users/login/agentsea_modal/test"]	= "users/company_process/test";
$route["users/login/agentsea_modal"]  		 = "users/login_company_modal";

$route["users/register/register-fb"]		 = "users/register_fb";
$route["users/register/register-google"]	 = "users/register_google";


$route["users/register"]			  		 = "register_all";







/* End of file routes.php */
/* Location: ./application/modules/users/config/routes.php */