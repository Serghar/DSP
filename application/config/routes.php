<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "products";
$route['products/cart/(:any)'] = "products/cart/$1";
$route['admin'] = "admins/login";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */