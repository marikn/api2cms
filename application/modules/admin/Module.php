<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Admin;

use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'API2CMS\Admin\Controllers' => APPLICATION_PATH . '/modules/admin/controllers/',
                'API2CMS\Admin\Models'      => APPLICATION_PATH . '/modules/admin/models/',
            )
        );

        $loader->register();
    }

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('API2CMS\Admin\Controllers');

            return $dispatcher;
        });

        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir('../modules/admin/views/');

            return $view;
        });
    }
}