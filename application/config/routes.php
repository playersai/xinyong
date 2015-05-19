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

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['admin_article/(:num)/(:num)'] = "admin_article/index/$1/$2";
$route['admin_article/(:num)'] = "admin_article/index/$1/1";
$route['admin_vote/(:num)/(:num)'] = "admin_vote/index/$1/$2";
$route['admin_vote/(:num)'] = "admin_vote/index/$1/1";
$route['admin_vedio/(:num)/(:num)'] = "admin_vedio/index/$1/$2";
$route['admin_vedio/(:num)'] = "admin_vedio/index/$1/1";
$route['admin_feedback/(:num)/(:num)'] = "admin_feedback/index/$1/$2";
$route['admin_feedback/(:num)'] = "admin_feedback/index/$1/1";
$route['admin_photo/(:num)/(:num)'] = "admin_photo/index/$1/$2";
$route['admin_photo/(:num)'] = "admin_photo/index/$1/1";

$route['admin_ads/(:num)/(:num)'] = "admin_ads/index/$1/$2";
$route['admin_ads/(:num)'] = "admin_ads/index/$1/1";
$route['admin_topic/(:num)/(:num)'] = "admin_topic/index/$1/$2";
$route['admin_topic/(:num)'] = "admin_topic/index/$1/1";

$route['interaction/(:num)/(:num)'] = "interaction/index/$1/$2";
$route['interaction/(:num)'] = "interaction/index/$1/1";

$route['topic_page/(:num)/(:num)'] = "topic_page/cat/$1/$2";
$route['topic_page/(:num)'] = "topic_page/cat/$1/1";

$route['category/(:num)/(:num)'] = "category/index/$1/$2/";
$route['category/(:num)'] = "topic_page/cat/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */