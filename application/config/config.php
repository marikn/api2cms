<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

return new \Phalcon\Config(array(
    'db' => array(
        'adapter'   => 'Mysql',
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'dbname'    => 'api2cms',
        'options'   => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true
        )
    ),
    'url' => array(
        'baseUri' => '/',
        'staticBaseUri' => '/static/'
    ),
    'modules' => array(
        'frontend' => array(
            'className' => 'API2CMS\Frontend\Module',
            'path' => APPLICATION_PATH . '/modules/frontend/Module.php',
        ),
        'admin' => array(
            'className' => 'API2CMS\Admin\Module',
            'path' => APPLICATION_PATH . '/modules/admin/Module.php',
        ),
        'api' => array(
            'className' => 'API2CMS\Api\Module',
            'path' => APPLICATION_PATH . '/modules/api/Module.php',
        ),
    )
));