<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url                     as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql        as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt        as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory   as MetaDataAdapter;
use Phalcon\Session\Adapter\Files       as SessionAdapter;
use Phalcon\Logger\Adapter\File         as LogsAdapter;

class Bootstrap
{
    public static function run()
    {
        $di = new FactoryDefault();

        $config = include APPLICATION_PATH . '/config/config.php';
        /**
         * The URL component is used to generate all kind of urls in the application
         */
        $di->set('url', function () use ($config) {
            $url = new UrlResolver();
            $url->setBaseUri        ($config->url->baseUri);
            $url->setStaticBaseUri  ($config->url->staticBaseUri);

            return $url;
        }, true);

        /**
         * Setting up the view component
         */
        $di->setShared('view', function () use ($config) {
            $view = new View();

            $view->registerEngines(array(
                '.volt' => function ($view, $di) use ($config) {

                    $volt = new VoltEngine($view, $di);

                    $volt->setOptions(array(
                        'compiledPath' => $config->application->cacheDir,
                        'compiledSeparator' => '_'
                    ));

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));

            return $view;
        });

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function () use ($config) {
            return new DbAdapter($config->db->toArray());
        });

        /**
         * If the configuration specify the use of metadata adapter use it or use memory otherwise
         */
        $di->set('modelsMetadata', function () {
            return new MetaDataAdapter();
        });

        /**
         * Start the session the first time some component request the session service
         */
        $di->setShared('session', function () {
            $session = new SessionAdapter();
            $session->start();

            return $session;
        });

        $di->setShared('logger', function() {
            return new LogsAdapter(APPLICATION_PATH . '/logs/' . APPLICATION_ENV . '.log');
        });

        /**
         * Loading routes from the routes.php file
         */
        $di->set('router', function () use ($config) {
            return require APPLICATION_PATH . '/config/routes.php';
        });

        $application = new \Phalcon\Mvc\Application();

        $application->registerModules($config->modules->toArray());
        $application->setDI($di);

        echo $application->handle()->getContent();
    }
}