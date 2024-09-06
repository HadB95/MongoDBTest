<?php

namespace App\System;

class Conf
{
    public static  $uri = "mongodb://localhost:27017/";

    public static $routes = array(
        'jo' => "App\Ctrl\CtrlJo"
    );

    public static $routeDefaut = "jo";
}
