<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('SRC_PATH', __DIR__ . '/../src');

require_once SRC_PATH . '/vendor/autoload.php';
require_once SRC_PATH . '/autoloader.php';

$request = new Request();

$controller = new $request->controller;
echo $controller->{$request->action}($request->parameter);
