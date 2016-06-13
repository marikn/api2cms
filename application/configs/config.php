<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

return new \Phalcon\Config(array(
    'db' => array(
        'host'      => 'pgsql',
        'username'  => 'api2cms',
        'password'  => 'temp123',
        'dbname'    => 'api2cms',
    ),
    'redis' => array(
        'host'       => 'localhost',
        'port'       => 6379,
        'auth'       => 'foobared',
        'persistent' => false
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
            'className' => 'API2CMS\API\Module',
            'path' => APPLICATION_PATH . '/modules/api/Module.php',
        ),
    ),
    'bridge' => array(
        'buildDir'      => PUBLIC_PATH . '/tmp',
        'bridgeDirName' => 'cms_bridge'
    )
));