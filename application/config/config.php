<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

return new \Phalcon\Config(array(
    'db' => array(
        'host'      => 'localhost',
        'username'  => 'postgres',
        'password'  => 'sk.cnhfn0h',
        'dbname'    => 'api2cms',
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