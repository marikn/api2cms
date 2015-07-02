<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Plugins;

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;

class Security extends Plugin
{
    public function getAcl()
    {
        if (!isset($this->persistent->acl)) {
            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);

            $roles = $this->_defineRules();

            $acl->addRole($roles['guest']);
            $acl->addRole($roles['user'], $roles['guest']);
            $acl->addRole($roles['admin'], $roles['user']);
            $acl->addRole($roles['api']);

            $resources = $this->_defineResources();

            foreach ($resources['private'] as $resource) {
                $acl->addResource($resource['resource'], $resource['actions']);

                foreach ($resource['actions'] as $action) {
                    $acl->allow('admin', $resource['resource'], $action);
                }
            }

            foreach ($resources['protected'] as $resource) {
                $acl->addResource($resource['resource'], $resource['actions']);

                foreach ($resource['actions'] as $action) {
                    $acl->allow('user', $resource['resource'], $action);
                }
            }

            foreach ($resources['public'] as $resource) {
                $acl->addResource($resource['resource'], $resource['actions']);

                foreach ($resource['actions'] as $action) {
                    $acl->allow('guest', $resource['resource'], $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $identity = $this->session->get('identity');

        $role = 'guest';

        if (!$identity){
            $role = 'guest';
        } else if ($identity['role'] == 'user') {
            $role = 'user';
        } else if ($identity['role'] == 'admin') {
            $role = 'admin';
        }

        $module     = $dispatcher->getModuleName();
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if ($module == 'api') {
            $apiKey     = $this->request->getHeader('HTTP_X_API_KEY');
            $siteKey    = $this->request->getHeader('HTTP_X_SITE_KEY');

            $this->auth->apiCheck();
        }

        $allowed = $acl->isAllowed($role, 'API2CMS\\' . ucfirst($module) . '\\' . ucfirst($controller), $action);

        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward(array(
                'module'     => 'frontend',
                'controller' => 'error',
                'action'     => 'show403'
            ));

            return false;
        }
    }

    protected function _defineRules()
    {
        $roles = array(
            'guest' => new Role('guest'),
            'user'  => new Role('user'),
            'admin' => new Role('admin'),
            'api'   => new Role('api'),
        );

        return $roles;
    }

    protected function _defineResources()
    {
        $resources = array();

        $resources['private'][]   = array('resource' => new Resource('API2CMS\Admin\Index'), 'actions' => array('index', 'edit', 'add'));

        $resources['protected'][] = array('resource' => new Resource('API2CMS\Frontend\Profile'), 'actions' => array('index', 'edit', 'sites', 'logs', 'settings'));

        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Index'), 'actions' => array('index'));
        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Session'), 'actions' => array('login', 'signup', 'logout'));
        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Error'), 'actions' => array('show404', 'show403'));
        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Blog'), 'actions' => array('index', 'info'));

        $resources['api'][]       = array('resource' => new Resource('API2CMS\API\Articles'), 'actions' => array('list', 'info'));

        return $resources;
    }
}