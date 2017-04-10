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

|$route['default_controller'] = 'welcome';

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

$route['404_override'] = 'custom404';
//$route['default_controller'] = 'seaman/home'; // home default
$config['modules_locations'] = array(APPPATH . "modules/seaman");



$route['seaman'] = 'seaman/profile';
$route['seaman/resume/print'] = 'seaman/resume/print_pdf';



//$route['seaman/profile'] = 'seaman/profile';

$route['profile'] = 'seaman/profile';

// edit ini ....

$route["profile/(:any)"]			= "seaman/resume";
$route['profile/(:any)/experiences'] = "seaman/profile/experiences";

//$route['profile/photo'] = "seaman/profile/photo"; // melihat photo milik user lain 
//$route['profile/photo'] = "seaman/profile/photo";
//$route['profile/(:any)/post/(:num)'] = "seaman/profile/post";



/* End of file routes.php */

/* Location: ./application/config/routes.php */