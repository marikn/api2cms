<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'test',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/api/controllers/',
        'modelsDir'      => APP_PATH . '/app/api/models/',
        'migrationsDir'  => APP_PATH . '/app/api/migrations/',
        'viewsDir'       => APP_PATH . '/app/api/views/',
        'pluginsDir'     => APP_PATH . '/app/api/plugins/',
        'libraryDir'     => APP_PATH . '/app/api/library/',
        'cacheDir'       => APP_PATH . '/app/api/cache/',
        'baseUri'        => '/api2cms/',
    )
));
