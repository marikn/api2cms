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
use Phalcon\Db\Adapter\Pdo\Postgresql   as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt        as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory   as MetaDataAdapter;
use Phalcon\Session\Adapter\Files       as SessionAdapter;
use Phalcon\Logger\Adapter\File         as LogsAdapter;
use Phalcon\Flash\Direct                as Flash;
use Phalcon\Mvc\Application;
use Phalcon\Security;
use Phalcon\Mvc\Dispatcher;
use API2CMS\Auth\Auth;

class Bootstrap
{
    public static function run()
    {
        $di = new FactoryDefault();

        $config = include APPLICATION_PATH . '/configs/config.php';
                  include APPLICATION_PATH . '/configs/loader.php';

        $di->set('url', function() use ($config) {
            $url = new UrlResolver();
            $url->setBaseUri        ($config->url->baseUri);
            $url->setStaticBaseUri  ($config->url->staticBaseUri);

            return $url;
        }, true);

        $di->setShared('view', function() use ($config) {
            $view = new View();

            return $view;
        });

        $di->set('db', function() use ($config) {
            return new DbAdapter($config->db->toArray());
        });

        $di->set('modelsMetadata', function() {
            return new MetaDataAdapter();
        });

        $di->setShared('session', function() {
            $session = new SessionAdapter();
            $session->start();

            return $session;
        });

        $di->setShared('logger', function() {
            return new LogsAdapter(APPLICATION_PATH . '/logs/' . APPLICATION_ENV . '.log');
        });

        $di->set('auth', function() {
            return new Auth();
        });

        $di->set('security', function() {
            $security = new Security();
            $security->setWorkFactor(12);

            return $security;
        });

        $di->set('router', function() use ($config) {
            return require APPLICATION_PATH . '/configs/routes.php';
        });

        $di->set('flash', function() {
            return new Flash(array(
                'error'     => 'alert alert-danger',
                'success'   => 'alert alert-success',
                'notice'    => 'alert alert-info',
                'warning'   => 'alert alert-warning'
            ));
        });

        $application = new Application();

        $application->registerModules($config->modules->toArray());
        $application->setDI($di);

        echo $application->handle()->getContent();
    }
}