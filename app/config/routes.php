<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'init';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

$route['rest_emails']['get']              = 'Rest/Emails';
$route['rest_emails']['post']             = 'Rest/Emails';
$route['rest_emails/:num']['put']         = 'Rest/Emails';
$route['rest_emails/:num']['delete']      = 'Rest/Emails';
$route['rest_emails/email/:num']['get']   = 'Rest/Emails/email';

$route['rest_users']['get']              = 'Rest/Users';
$route['rest_users']['post']             = 'Rest/Users';
$route['rest_users/:num']['put']         = 'Rest/Users';
$route['rest_users/:num']['delete']      = 'Rest/Users';
$route['rest_users/user/:num']['get']    = 'Rest/Users/user';

$route['login']['get']     = 'Auth/Login';
$route['login']['post']    = 'Auth/Login/create';
$route['logout']['get']    = 'Auth/Login/logout';
$route['register']['get']  = 'Auth/Auth/register';
$route['register']['post'] = 'Auth/Auth/create';

$route['productos']                          = 'Dash/ManagerProductos';
$route['rest_productos']['get']              = 'Rest/Productos';
$route['rest_productos']['post']             = 'Rest/Productos';
$route['rest_productos/:num']['put']         = 'Rest/Productos';
$route['rest_productos/:num']['delete']      = 'Rest/Productos';
$route['rest_productos/producto/:num']['get'] = 'Rest/Productos/producto';