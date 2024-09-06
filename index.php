<?php
require "vendor/autoload.php";
session_start();

use App\System\Conf;

if (isset($_GET['c'])) {
    if (isset(Conf::$routes[$_GET['c']])) {
        $controller = Conf::$routes[$_GET['c']];
        if (isset($_GET['a'])) {
            if (isset($_GET['a2'])) {
                $ctrl = new $controller($_GET['a'], $_GET['a2']);
            } else {
                $ctrl = new $controller($_GET['a']);
            }
        } else {
            $ctrl = new $controller();
        }
    } else {
        $controller = Conf::$routes[Conf::$routeDefaut];
        $ctrl = new $controller();
    }
} else {
    $controller = Conf::$routes[Conf::$routeDefaut];
    $ctrl = new $controller();
}
