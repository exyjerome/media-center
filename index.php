<?php
error_reporting(E_ALL);
session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Session.php';

spl_autoload_register (function($class) {
    include __DIR__ . '/controllers/' . $class . '.php';
});

$router = new AltoRouter();

include __DIR__ . '/config/routes.php';

$match = $router->match();

if ($match) {
    if (true == is_string($match['target'])) {
        $parts      = explode('@', $match['target']);
        $controller = new $parts[0]();
        $method     = $controller->{$parts[1]}();
        print $method;
    }
}
