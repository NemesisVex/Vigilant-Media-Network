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
| 	example.com/class/method/id/
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

$route['default_controller'] = "aus";
$route['404_override'] = '';

$route['members'] = "members/members";
$route['members/login'] = "members/members/login";
$route['members/logout'] = "members/members/logout";
$route['members/password'] = "members/members/password";
$route['members/generate_password'] = "members/members/generate_password";
$route['members/change_password/(:any)'] = "members/members/change_password/$1";
$route['members/update_password/(:any)'] = "members/members/update_password/$1";
$route['members/register'] = "members/members/register";
$route['members/register/results'] = "members/members/register_results";
$route['members/register/(:any)'] = "members/members/register/$1";
$route['members/profile/edit'] = "members/members/edit";
$route['members/profile/edit/(:num)'] = "members/members/edit/$1";
$route['members/profile/update/(:num)'] = "members/members/update/$1";
$route['members/add'] = "members/members/add";
$route['members/post/rss/add'] = "members/post/rss_add";
$route['members/post/rss/edit/(:num)'] = "members/post/rss_edit/$1";
$route['directory'] = "as_directory";
$route['directory/posts/(:num)'] = "as_directory/posts/$1";
$route['directory/posts/(:num)/(:num)'] = "as_directory/posts/$1/$2";
$route['directory/feed/(:num)'] = "as_directory/feed/$1";
$route['directory/feed/(:num)/(:num)'] = "as_directory/feed/$1/$2";
$route['aus/contact/sent'] = "aus/contact_sent";


/* End of file routes.php */
/* Location: ./application/config/routes.php */