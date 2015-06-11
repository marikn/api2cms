<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;

$router = new Router(false);

$router->add('/', array(
    'module' => 'frontend',
    'controller' => 'index',
    'action' => 'index'
))->setName('default');

foreach ($config->get('modules') as $key => $module) {
    switch ($key) {
        case 'api':
            $controllers = array(
                'articles',
                'users',
                'comments'
            );

            $api = new RouterGroup(array(
                'module'     => 'api',
            ));

            $api->setPrefix('/api/v1.0');

            $api->addGet('/{controller:(' . implode('|', $controllers) . ')}', array(
                'action'     => 'list',
            ));

            $api->addGet('/{controller:(' . implode('|', $controllers) . ')}/{id:\d+}', array(
                'action'     => 'info',
            ));

            $router->mount($api);
            break;
        case 'frontend':
            $router->add('/:controller/:action', array(
                'module' => $key,
                'controller' => '1',
                'action' => '2',
//                'params' => 1
            ))->setName($key);
            $router->add('/', array(
                'module' => $key,
                'controller' => 'index',
                'action' => 'index',
//                'params' => 1
            ))->setName($key);
            break;
//        default:
//            $router->add('/' . $key . '/:params', array(
//                'module' => $key,
//                'controller' => 'index',
//                'action' => 'index',
//                'params' => 1
//            ))->setName($key);
//
//            $router->add('/' . $key . '/:controller/:params', array(
//                'module' => $key,
//                'controller' => 1,
//                'action' => 'index',
//                'params' => 2
//            ));
//
//            $router->add('/' . $key . '/:controller/:action/:params', array(
//                'module' => $key,
//                'controller' => 1,
//                'action' => 2,
//                'params' => 3
//            ));
//
//            break;
    }
}

$router->notFound(array(
    'module'        => 'frontend',
    'controller'    => 'index',
    'action'        => '_404'
));

return $router;