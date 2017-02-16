<?php

define('ROOT', dirname(__DIR__));

require ROOT . '\app\App.php';

App::load();

if(isset($_GET['p'])){
    $view = $_GET['p'];
} else {
    $view = 'article-index';
}

$view = explode('-', $view);

if($view[0] == 'admin'){
    $controller = '\App\Controller\Admin\\Admin' . ucfirst ($view[1]) . 'Controller';
    $action = $view[2];
} else {
    $controller = '\App\Controller\\' . ucfirst ($view[0]) . 'Controller';
    $action = $view[1];
}

$controller = new $controller();
$controller->$action();
