<?php

$router->map('GET', '/', 'Home@Page');



$router->map('GET', '/spotify/login', 'Spotify@Auth');
$router->map('GET', '/spotify/pause', 'Spotify@Pause');
$router->map('GET', '/spotify/play', 'Spotify@Play');