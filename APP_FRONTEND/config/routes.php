<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['^th/(.+)$'] = '$1';
$route['^en/(.+)$'] = '$1';

$route['^en$'] = $route['default_controller'];
$route['^th$'] = $route['default_controller'];

$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
