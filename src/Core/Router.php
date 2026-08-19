<?php
$routes = [
    '/' => [
        'controller' => 'EleveController',
        'action' => 'liste'
    ]
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/note_gestion/public', '', $uri);
$uri = $uri == '' ? '/' : $uri;

$route = $routes[$uri] ?? $routes['/'];

$controllerName = $route['controller'];
$action = $route['action'];

// CORRECTION ICI -> $controllerName et pas $controller
require_once __DIR__ . "/../Controllers/" . $controllerName . ".php";

$controller = new $controllerName();
$controller->$action();