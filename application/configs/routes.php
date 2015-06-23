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
    'module'     => 'frontend',
    'controller' => 'index',
    'action'     => 'index'
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
                'module' => 'api',
            ));

            $api->setPrefix('/api/v1.0');

            $api->addGet('/{controller:(' . implode('|', $controllers) . ')}', array(
                'action' => 'list',
            ));

            $api->addGet('/{controller:(' . implode('|', $controllers) . ')}/{id:\d+}', array(
                'action' => 'info',
            ));

            $api->addGet('/{controller:(' . implode('|', $controllers) . ')}/count', array(
                'action' => 'count',
            ));

            $api->addPost('/{controller:(' . implode('|', $controllers) . ')}', array(
                'action' => 'create',
            ));

            $api->addPut('/{controller:(' . implode('|', $controllers) . ')}/{id:\d+}', array(
                'action' => 'update',
            ));

            $api->addDelete('/{controller:(' . implode('|', $controllers) . ')}/{id:\d+}', array(
                'action' => 'delete',
            ));

            $router->mount($api);
            break;
        case 'frontend':
            $router->add('/', array(
                'module'     => $key,
                'controller' => 'index',
                'action'     => 'index',
            ))->setName($key);

            $router->add('/login', array(
                'module'     => $key,
                'controller' => 'session',
                'action'     => 'login',
            ))->setName($key);

            $router->add('/signup', array(
                'module'     => $key,
                'controller' => 'session',
                'action'     => 'signup',
            ))->setName($key);

            $router->add('/logout', array(
                'module'     => $key,
                'controller' => 'session',
                'action'     => 'logout',
            ))->setName($key);

            $router->add('/blog', array(
                'module'     => $key,
                'controller' => 'blog',
                'action'     => 'index',
            ))->setName($key);

            $router->add('/blog/{id:\d+}', array(
                'module'     => $key,
                'controller' => 'blog',
                'action'     => 'info',
                'params'     => '1',
            ))->setName($key);

            $router->add('/contact-us', array(
                'module'     => $key,
                'controller' => 'contact',
                'action'     => 'index',
            ))->setName($key);

            $router->add('/how-it-works', array(
                'module'     => $key,
                'controller' => 'index',
                'action'     => 'how-it-works',
            ))->setName($key);

            $router->add('/profile', array(
                'module'     => $key,
                'controller' => 'profile',
                'action'     => 'index',
            ))->setName($key);

            $router->add('/profile/:action', array(
                'module'     => $key,
                'controller' => 'profile',
                'action'     => 1,
            ))->setName($key);

            break;
        case 'admin':
            $admin = new RouterGroup(array(
                'module' => 'admin',
            ));

            $admin->setPrefix('/admin');

            $admin->add('/', array(
                'controller' => 'index',
                'action' => 'index',
            ))->setName($key);

            $router->mount($admin);
            break;
        default:
            break;
    }
}

$router->notFound(array(
        'module'     => 'frontend',
        'controller' => 'error',
        'action'     => 'show404',
    )
);

return $router;