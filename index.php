<?php
session_start();

spl_autoload_register (function($class) {
    include __DIR__ . '/controllers/' . $class . '.php';
});

$app = new App ();
$router = $app->getRouter();

$app->require('/vendor/autoload.php')
    ->require('Session.php');

include __DIR__ . '/config/routes.php';

$app->mapRoutes([
    '/spotify/' => [
        'controller' => 'Spotify@Home',
        'condition'  => 'Spotify@Authed'
    ],
]);

$router->dispatch();
