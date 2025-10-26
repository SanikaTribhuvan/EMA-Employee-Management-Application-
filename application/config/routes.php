<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Custom Routes
$route['dashboard'] = 'dashboard';
$route['employees'] = 'employees';
$route['employees/create'] = 'employees/create';
$route['employees/edit/(:num)'] = 'employees/edit/$1';
$route['employees/delete/(:num)'] = 'employees/delete/$1';
$route['chart'] = 'chart';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';