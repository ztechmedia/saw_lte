<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'AppController';
$route['404_override'] = 'AppController/pageNotFound';
$route['translate_uri_dashes'] = FALSE;

//admin routes
$route['admin'] = 'AppController';
$route['admin/reset_form'] = 'AppController/resetForm';
$route['admin/reset'] = 'AppController/reset';

//dasboard
$route['admin/dashboard'] = 'DashboardController/dashboard';
$route['admin/logs'] = 'DashboardController/logs';

//users
//@view
$route['admin/users/(:num)'] = 'UsersController/users/$1';
$route['admin/users-table/(:num)'] = 'UsersController/usersTable/$1';
$route['admin/users/create/(:num)'] = 'UsersController/create/$1';
$route['admin/users/(:num)/edit'] = 'UsersController/edit/$1';
//@action
$route['admin/users/add'] = 'UsersController/add';
$route['admin/users/(:num)/update'] = 'UsersController/update/$1';
$route['admin/users/(:num)/delete'] = 'UsersController/delete/$1';

//auth routes
//@view
$route['login'] = 'AuthController/login';
$route['forgot-password'] = 'AuthController/forgotPassword';
$route['reset-password/(:any)'] = 'AuthController/resetPassword/$1';
//@action
$route['auth/login'] = 'AuthController/authLogin';
$route['auth/send-link-forgot'] = 'AuthController/sendLinkForgot';
$route['auth/reset/(:any)'] = 'AuthController/reset/$1';
$route['logout'] = 'AppController/logout';

//alternatives
//@view
$route['admin/alternatives'] = 'AlternativeController/alternatives';
$route['admin/alternatives-table'] = 'AlternativeController/altTable';
$route['admin/alternatives/create'] = 'AlternativeController/create';
$route['admin/alternatives/(:num)/edit'] = 'AlternativeController/edit/$1';
//@action
$route['admin/alternatives/add'] = 'AlternativeController/add';
$route['admin/alternatives/(:num)/update'] = 'AlternativeController/update/$1';
$route['admin/alternatives/(:num)/delete'] = 'AlternativeController/delete/$1';

//criteria
//@view
$route['admin/criterias'] = 'CriteriaController/criterias';
$route['admin/criterias-table'] = 'CriteriaController/criteriaTable';
$route['admin/criterias/create'] = 'CriteriaController/create';
$route['admin/criterias/(:num)/edit'] = 'CriteriaController/edit/$1';
//@action
$route['admin/criterias/add'] = 'CriteriaController/add';
$route['admin/criterias/(:num)/update'] = 'CriteriaController/update/$1';
$route['admin/criterias/(:num)/delete'] = 'CriteriaController/delete/$1';

//criteria
//@view
$route['admin/subcriterias/(:num)'] = 'SubcriteriaController/subcriterias/$1';
$route['admin/subcriterias-table/(:num)'] = 'SubcriteriaController/subcriteriasTable/$1';
$route['admin/subcriterias/loadsub/(:num)'] = 'SubcriteriaController/loadSub/$1';
$route['admin/subcriterias/create'] = 'SubcriteriaController/create';
$route['admin/subcriterias/(:num)/edit'] = 'SubcriteriaController/edit/$1';
//@action
$route['admin/subcriterias/add'] = 'SubcriteriaController/add';
$route['admin/subcriterias/(:num)/update'] = 'SubcriteriaController/update/$1';
$route['admin/subcriterias/(:num)/delete'] = 'SubcriteriaController/delete/$1';

//result
//@view
$route['admin/results'] = 'ResultController/results';
$route['admin/print_results'] = 'ResultController/printResults';