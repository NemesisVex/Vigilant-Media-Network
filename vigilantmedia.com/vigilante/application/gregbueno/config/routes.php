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

$route['default_controller'] = "gb";
$route['404_override'] = '';

$route['gb/contact/sent'] = "gb/contact_sent";

$route['sakufu'] = "sakufu/index";
$route['sakufu/entry/(:any)'] = "sakufu/index/entry/$1";
$route['sakufu/category/(:any)'] = "sakufu/index/category/$1";
$route['sakufu/date/(:any)'] = "sakufu/index/date/$1";
$route['sakufu/about'] = "sakufu/index/about";
$route['sakufu/contact'] = "sakufu/index/contact";
$route['sakufu/contact/sent'] = "sakufu/index/contact_sent";

$route['meisakuki'] = "meisakuki/index";
$route['meisakuki/entry/(:any)'] = "meisakuki/index/entry/$1";
$route['meisakuki/category/(:any)'] = "meisakuki/index/category/$1";
$route['meisakuki/date/(:any)'] = "meisakuki/index/date/$1";
$route['meisakuki/about'] = "meisakuki/index/about";
$route['meisakuki/contact'] = "meisakuki/index/contact";
$route['meisakuki/contact/sent'] = "meisakuki/index/contact_sent";

$route['journal'] = "journal/index";
$route['journal/entry/(:any)'] = "journal/index/entry/$1";
$route['journal/category/(:any)'] = "journal/archives/category/$1";
$route['journal/about'] = "journal/index/about";
$route['journal/cast'] = "journal/index/cast";
$route['journal/links'] = "journal/index/links";
$route['journal/contact'] = "journal/index/contact";
$route['journal/contact/sent'] = "journal/index/contact_sent";

$route['vexvox'] = "vexvox/index";
$route['vexvox/entry/(:any)'] = "vexvox/index/entry/$1";
$route['vexvox/category/(:any)'] = "vexvox/archives/category/$1";
$route['vexvox/date/(:any)'] = "vexvox/index/date/$1";
$route['vexvox/about'] = "vexvox/index/about";
$route['vexvox/contact'] = "vexvox/index/contact";
$route['vexvox/contact/sent'] = "vexvox/index/contact_sent";

/* End of file routes.php */
/* Location: ./application/config/routes.php */