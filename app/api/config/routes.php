<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add(
    "/",
    array(
        "controller" => "index",
        "action"     => "api",
    )
);

return $router;