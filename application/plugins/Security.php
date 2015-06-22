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

            $acl->addRole($roles['guests']);
            $acl->addRole($roles['users'], $roles['guests']);
            $acl->addRole($roles['admins'], $roles['users']);
            $acl->addRole($roles['apis']);

            $resources = $this->_defineResources();

            foreach ($resources['private'] as $resource) {
                $acl->addResource($resource['resource'], $resource['actions']);

                foreach ($resource['actions'] as $action) {
                    $acl->allow('admins', $resource['resource'], $action);
                }
            }

            foreach ($resources['protected'] as $resource) {
                $acl->addResource($resource['resource'], $resource['actions']);

                foreach ($resource['actions'] as $action) {
                    $acl->allow('users', $resource['resource'], $action);
                }
            }

            foreach ($resources['public'] as $resource) {
                $acl->addResource($resource['resource'], $resource['actions']);

                foreach ($resource['actions'] as $action) {
                    $acl->allow('guests', $resource['resource'], $action);
                }
            }


            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {$this->session->destroy();
        $identity = $this->session->get('identity');

        $role = 'guests';

        if (!$identity){
            $role = 'guests';
        } else if ($identity->role == 'user') {
            $role = 'users';
        } else if ($identity->role == 'admin') {
            $role = 'admin';
        }

        $module     = $dispatcher->getModuleName();
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        $acl = $this->getAcl();
        $allowed = $acl->isAllowed($role, 'API2CMS\\' . ucfirst($module) . '\\' . ucfirst($controller), $action);

        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward(array(
                'module'     => 'frontend',
                'controller' => 'error',
                'action'     => 'show403'
            ));

            $this->session->destroy();
            return false;
        }
    }

    protected function _defineRules()
    {
        $roles = array(
            'guests' => new Role('guests'),
            'users'  => new Role('users'),
            'admins' => new Role('admins'),
            'apis'   => new Role('apis'),
        );

        return $roles;
    }

    protected function _defineResources()
    {
        $resources = array();

        $resources['private'][]   = array('resource' => new Resource('API2CMS\Admin\Index'), 'actions' => array('index', 'edit', 'add'));

        $resources['protected'][] = array('resource' => new Resource('API2CMS\Frontend\Profile'), 'actions' => array('index', 'info'));

        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Index'), 'actions' => array('index'));
        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Session'), 'actions' => array('login', 'signup'));
        $resources['public'][]    = array('resource' => new Resource('API2CMS\Frontend\Error'), 'actions' => array('show404', 'show403'));

        $resources['api'][]       = array('resource' => new Resource('API2CMS\API\Articles'), 'actions' => array('list', 'info'));

        return $resources;
    }
}