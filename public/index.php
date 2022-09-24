<?php

/*************************
 * Front
 * Routing module
 * 
*************************/

require_once '../Core/Router.php';

$router = new App\Core\Router();

$router->setRoute('', ['controller' => 'Home', 'action' => 'index']);
$router->setRoute('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->setRoute('posts/new', ['controller' => 'Posts', 'action' => 'create']);

$url = $_SERVER['QUERY_STRING'];

$router->match($url);