<?php

use App\services\renders\TwigRenderer;

include dirname(__DIR__) . "/vendor/autoload.php";

$controllerName = 'good';
if (!empty($_GET['c'])) {
    $controllerName = $_GET['c'];
}

$actionName = '';
if (!empty($_GET['a'])) {
    $actionName = $_GET['a'];
}

$controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /** @var App\controllers\Controller $controller */
    $controller = new $controllerClass(new TwigRenderer());
    echo $controller->run($actionName);
}



