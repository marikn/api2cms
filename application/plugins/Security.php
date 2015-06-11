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
            $acl->addRole($roles['users'], $roles['guest']);
            $acl->addRole($roles['admins'], $roles['users']);
            $acl->addRole($roles['api']);

            $resources = $this->_defineResources();

            foreach ($resources['private'] as $resource => $actions) {
                $acl->addResource($resource, $actions);

                foreach ($actions as $action) {
                    $acl->allow('Administrators', $resource, $action);
                }
            }

            foreach ($resources['protected'] as $resource => $actions) {
                $acl->addResource($resource, $actions);

                foreach ($actions as $action) {
                    $acl->allow('Users', $resource, $action);
                }
            }

            foreach ($resources['public'] as $resource => $actions) {
                $acl->addResource($resource, $actions);

                foreach ($actions as $action) {
                    $acl->allow('Guests', $resource, $action);
                }
            }
        }

        return $this->persistent->acl;
    }

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {

    }

    protected function _defineRules()
    {
        $roles = array(
            'guests' => new Role('Guests'),
            'users'  => new Role('Users'),
            'admins' => new Role('Administrators'),
            'api'    => new Role('API\'s'),
        );

        return $roles;
    }

    protected function _defineResources()
    {
        $resources = array();

        $resources['private']   = array(new Resource('API2CMS\Admin\Index'), array('index', 'edit', 'add'));
        $resources['protected'] = array(new Resource('API2CMS\Frontend\Cabinet'), array('list', 'info'));
        $resources['public']    = array(new Resource('API2CMS\Frontend\Index'), array('index'));
        $resources['api']       = array(new Resource('API2CMS\API\Articles'), array('list', 'info'));

        return $resources;
    }
}