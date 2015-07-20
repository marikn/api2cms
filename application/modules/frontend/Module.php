<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend;

use API2CMS\Plugins\Security;
use Phalcon\Di;
use Phalcon\Events\Manager;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt        as VoltEngine;

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
                'API2CMS\Frontend\Controllers' => APPLICATION_PATH . '/modules/frontend/controllers/',
                'API2CMS\Frontend\Models'      => APPLICATION_PATH . '/modules/frontend/models/',
                'API2CMS\Frontend\Forms'       => APPLICATION_PATH . '/modules/frontend/forms/',
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
            $eventsManager = Di::getDefault()->geteventsManager();

            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('API2CMS\Frontend\Controllers');
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });

        $di->set('view', function() {
            $view = new View();

            $view->setViewsDir(APPLICATION_PATH . '/modules/frontend/views/');
            $view->registerEngines(array(
                '.volt' => function ($view, $di) {

                    $volt = new VoltEngine($view, $di);

                    $volt->setOptions(array(
                        'compiledPath' => APPLICATION_PATH . '/cache/',
                        'compiledSeparator' => '_'
                    ));

                    return $volt;
                }
            ));

            return $view;
        });
    }
}