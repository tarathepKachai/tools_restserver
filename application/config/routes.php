<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8

$route['parts/test'] = 'api/Parts_Controller/test';
$route['parts/dept'] = 'api/Parts_Controller/get_all_department';
$route['parts/device_by_id'] = 'api/Parts_Controller/get_device_by_id';

$route['parts/paytran_list'] = 'api/Parts_Controller/paytran_list';
$route['parts/paydetail_by_id'] = 'api/Parts_Controller/paydetail_by_id';
$route['parts/paytran_by_id'] = 'api/Parts_Controller/paytran_by_id';
$route['parts/search_paytran'] = 'api/Parts_Controller/search_paytran';
$route['parts/rcvdetail_list'] = 'api/Parts_Controller/rcvdetail_list';


$route['user/auth'] = 'api/User_Controller/Login_check';
$route['user/check_rmms_session'] = 'api/User_Controller/check_rmms_session';

$route['parts/Insert_rcvtran'] = 'api/Parts_Controller/insert_rcvtran';

$route['parts/rcvtran_list'] = 'api/Parts_Controller/rcvtran_list';
$route['parts/rcvdetail_by_id'] = 'api/Parts_Controller/rcvdetail_by_id';
$route['parts/rcvtran_cancel'] = 'api/Parts_Controller/rcvtran_cancel';
$route['parts/stock_list'] = 'api/Parts_Controller/stock_list';

$route['parts/test_line'] = 'api/Parts_Controller/test_line';
$route['parts/line_notify'] = 'api/Parts_Controller/line_notify';

