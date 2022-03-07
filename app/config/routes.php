<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'init';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

$route['productos']                          = 'Dash/ManagerProductos';
$route['rest_productos']['get']              = 'Rest/Productos';
$route['rest_productos']['post']             = 'Rest/Productos';
$route['rest_productos/:num']['put']         = 'Rest/Productos';
$route['rest_productos/:num']['delete']      = 'Rest/Productos';
$route['rest_productos/producto/:num']['get'] = 'Rest/Productos/producto';
$route['productos/informe']                  = 'Dash/ManagerProductos/informe';
$route['productos/pagina_productos/:num']['post'] = 'Dash/ManagerProductos/pagina_productos';