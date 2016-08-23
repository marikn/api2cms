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
use Phalcon\Events\Manager;
use API2CMS\Plugins\Security            as Acl;

class Bootstrap
{
    private $_di;

    public function __construct($di)
    {
        $this->_di = $di;
    }

    public function run($options = array())
    {
        $config = include APPLICATION_PATH . '/configs/config.php';
                  include APPLICATION_PATH . '/configs/loader.php';

        $this->_di->set('url', function() use ($config) {
            $url = new UrlResolver();
            $url->setBaseUri        ($config->url->baseUri);
            $url->setStaticBaseUri  ($config->url->staticBaseUri);

            return $url;
        }, true);

        $this->_di->set('db', function() use ($config) {
            return new DbAdapter($config->db->toArray());
        });

        $this->_di->set('modelsMetadata', function() {
            return new MetaDataAdapter();
        });

        $this->_di->setShared('session', function() {
            $session = new SessionAdapter();
            $session->start();

            return $session;
        });

        $this->_di->setShared('logger', function() {
            return new LogsAdapter(APPLICATION_PATH . '/logs/' . APPLICATION_ENV . '.log');
        });

        $this->_di->set('auth', function() {
            return new API2CMS\Auth();
        });

        $this->_di->set('security', function() {
            $security = new Security();
            $security->setWorkFactor(12);

            return $security;
        });

        $this->_di->set('router', function() use ($config) {
            return require APPLICATION_PATH . '/configs/routes.php';
        });

        $this->_di->set('flash', function() {
            return new Flash(array(
                'error'     => 'alert alert-danger',
                'success'   => 'alert alert-success',
                'notice'    => 'alert alert-info',
                'warning'   => 'alert alert-warning'
            ));
        });

        $this->_di->set('eventsManager', function() {
            $eventsManager = new Manager();
            $eventsManager->attach('dispatch:beforeDispatch', new Acl());

            return $eventsManager;
        });

        $this->_di->set('cache', function() {
            $redis = new Redis();
            $redis->connect("localhost", "6379");

            $frontend = new Phalcon\Cache\Frontend\Data(array(
                'lifetime' => 3600
            ));

            $cache = new Phalcon\Cache\Backend\Redis($frontend, array(
                'redis' => $redis
            ));

            return $cache;
        });

        $this->_di->set('bridge', function() use($config) {
            return $config->bridge;
        });

        $application = new Application($this->_di);

        $application->registerModules($config->modules->toArray());

        return $application->handle()->getContent();
    }
}