<?php

class App {
    public $routerClass = 'AltoRouter_Extended';
    public function include ($file)
    {
        include __DIR__ . '/' . $file;
        return $this;
    }
    public function require ($file)
    {
        require __DIR__ . '/' . $file;
        return $this;
    }
    public function getRouter ()
    {
        $this->router = new $this->routerClass;
        return $this->router;
    }
}

class AltoRouter_Extended extends AltoRouter {
    public function dispatch ()
    {
        $match = $this->match();
        if ($match) {
            if (true == is_string($match['target'])) {
                $parts = explode('@', $match['target']);
                $controller = new $parts[0];
                return $controller->{$parts[1]}();
            } elseif (true == is_callable($match['target'])) {
                print call_user_func($match['target']);
            }
        }
    }

    /**
     * Condiotionally add a route, on a certain day etc.
     *
     * @return void
     */
    public function condMap (Callable $condition, Array $route)
    {
        if (true == call_user_func($condition)) {
            $route = (object) $route;
            $this->map($route->method, $route->path, $route->callback);
        }
    }
}


/**
 * @example condMap
 */
$route = [
    'method'   => 'GET',
    'path'     => '/login',
    'callback' => 'App@Login',
];
$router->condMap(function(){
    if (true == true) {
        return true;
    }
}, $route);