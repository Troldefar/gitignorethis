<?php

/* 
 * Router
 * package core\router
*/

namespace App\Core;

class Router {

    /**
     * Routes
     * Simple table until i get my life straight
     * @var array
    */

    protected array $routes = [];

    /**
     * params
     * Paramters for the current route
     * @var array
    */

    protected array $params = [];

    /**
     * Regex for checking if valid controller / action
     * Minor regex to check if controller / action exists
     * @var string
    */

    protected string $validityHandler = '/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/';

    /**
     * Setter for routes
     * @return void
    */

    public function setRoute(string $route, array $params): void {
        $this->routes[$route] = $params;
    }

    /**
     * Getter for routes
     * @return route
    */

    public function getRoutes(string $key = '') {
        if ($key === '') return $this->routes;
        return $this->routes[$key];
    }

    /**
     * Check if requsted controller/method exists
     * @return boolean
    */

    public function match(string $url): bool {
        if (preg_match($this->validityHandler, $url, $matches)) {
            $params = [];
            foreach ($matches as $key => $match) if (is_string($key)) $params[$key] = $match;
            $this->setParamsIfRouteMatch($params);
            return true;
        }
        return false;
    }

    /**
     * Setter for parameters 
     * @return void
    */

    public function setParamsIfRouteMatch(array $params): void {
        $this->params = $params;
    }

    /**
     * Getter for params 
     * @return array
    */

    public function getParams(): array {
        return $this->params;
    }

}