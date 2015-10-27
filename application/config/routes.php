<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "products";
$route['products/show/(:num)'] = "products/show/$1";
$route['products/cart/(:any)'] = "products/cart/$1";
$route['admins/edit_product/(:any)'] = "admins/edit_product/$1";
$route['admin'] = "admins/login";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */