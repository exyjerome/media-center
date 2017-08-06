<?php

$router->map('GET', '/', 'Home@Page');

$router->map('GET', '/spotify/login', 'Spotify@Auth');
$router->map('GET', '/spotify/pause', 'Spotify@Pause');
$router->map('GET', '/spotify/play',  'Spotify@Play');
$router->map('GET', '/spotify/skip',  'Spotify@Skip');
$router->map('GET', '/spotify/previous',  'Spotify@Previous');
$router->map('GET', '/spotify/volume_up',  'Spotify@VolumeUp');
$router->map('GET', '/spotify/volume_down',  'Spotify@VolumeDown');
$router->map('GET', '/spotify/current',  'Spotify@Current');

// $router->map('GET', '/spotify/:action', 'Spotify@');