<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\API;

use Phalcon\Di;
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
                'API2CMS\Api\Controllers' => APPLICATION_PATH . '/modules/api/controllers/',
                'API2CMS\Api\Models'      => APPLICATION_PATH . '/modules/api/models/',
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
            $dispatcher->setDefaultNamespace('API2CMS\Api\Controllers');

            return $dispatcher;
        }, true);

        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir('../modules/api/views/');

            return $view;
        });
    }
}