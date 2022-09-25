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
     * Setter for routes
     * Step 1 converts the passed route to a regex thus escaping forward slashes
     * step 2 converts variables etc {controller}
     * step 3 makes it able to handle options arguments etc /posts/2379/delete
     * step 4 Adds start and end delimters including the insensitive flag
     * step 5 sets the route
     * @return void
    */

    public function setRoute(string $route, array $params = []): void {
        $route = preg_replace('/\//', '\\/', $route);
        var_dump($route);echo'<br>';
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    /**
     * Getter for routes
     * @return route
    */

    public function getRoutes(string $optionalKey = '') {
        if ($optionalKey === '') return $this->routes;
        return $this->routes[$optionalKey];
    }

    /**
     * Check if requsted controller/method exists
     * If there's a match set additional params
     * @return boolean
    */

    public function match(string $url): bool {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $params = [];
                foreach ($matches as $key => $match) if (is_string($key)) $params[$key] = $match;
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Loop matches based on regex 
     * set params accordingly if present
     * @return void
    */

    public function loopMatches(array $matches): void {
        $params = [];
        foreach ($matches as $key => $match) if (is_string($key)) $params[$key] = $match;
        $this->setParams($params);
    }

    /**
     * Setter for parameters 
     * @return void
    */

    public function setParams(array $params): void {
        $this->params = $params;
    }

    /**
     * Getter for params 
     * @return array
    */

    public function getParams(): array {
        return $this->params;
    }

    /**
     * Setter for routes
     * @return router
    */

    public function setTable(): Router {
        $this->setRoute('', ['controller' => 'Home', 'action' => 'index']);
        $this->setRoute('posts', ['controller' => 'Posts', 'action' => 'index']);
        $this->setRoute('{controller}/{action}');
        $this->setRoute('admin/{controller}/{action}');
        $this->setRoute('{controller}/{id:\d+}/{action}');
        return $this;
    }

}