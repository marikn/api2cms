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
        'controllersDir' => APP_PATH . '/app/web/controllers/',
        'modelsDir'      => APP_PATH . '/app/web/models/',
        'migrationsDir'  => APP_PATH . '/app/web/migrations/',
        'viewsDir'       => APP_PATH . '/app/web/views/',
        'pluginsDir'     => APP_PATH . '/app/web/plugins/',
        'libraryDir'     => APP_PATH . '/app/web/library/',
        'cacheDir'       => APP_PATH . '/app/web/cache/',
        'baseUri'        => '/api2cms/',
    )
));
