<?php

/*************************
 * Front
 * Routing module
 * @package app\core\router
 * 
*************************/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Core/Router.php';

$router = new App\Core\Router();
$router->setTable();

$url = $_SERVER['QUERY_STRING'];
$router->match($url);

echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes()), true);
echo '</pre>';