<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "products"; 
$route['cart'] = "products/cart";
$route['checkout'] = "/users";
$route['products/remove/(:num)'] = "products/remove/$1";
$route['products/show/(:num)'] = "products/show/$1";
$route['products/add_cart/(:any)'] = "products/add_cart/$1";
$route['admins/edit_product/(:any)'] = "admins/edit_product/$1";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */