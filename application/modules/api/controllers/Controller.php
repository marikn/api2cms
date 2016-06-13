<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\API\Controllers;

use API2CMS\Account;
use API2CMS\Connector;
use API2CMS\Models\Accounts;
use API2CMS\Models\Sites;
use API2CMS\Response;
use API2CMS\Site;

abstract class Controller extends \Phalcon\Mvc\Controller
{
    protected $_response;

    public function beforeExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        $this->_response = new Response();

        $this->view->disable();
        $this->response->setContentType('application/json');

        $apiKey = $this->request->getHeader('HTTP_X_API_KEY');
        $token  = $this->request->getHeader('HTTP_X_TOKEN');

        try {
            $controller = $dispatcher->getControllerName();

            switch ($controller) {
                case 'bridge':
                    $this->auth->checkAccountByApiKey($apiKey);
                    if ($dispatcher->getActionName() == 'download') {
                        if (!preg_match('/^[a-f0-9]{32}$/i', $token)) {
                            throw new \API2CMS\Auth\Exception('Incorrect site key', 403);
                        }

                        $this->auth->setToken($token);
                    }

                    return true;
                case 'error':
                    return true;
                default:
                    $this->_apiAuth($apiKey, $token);
                    $this->_init($apiKey, $token);

                    break;
            }
        } catch (\API2CMS\Auth\Exception $e) {
            $dispatcher->forward(array(
                'namespace'  => 'API2CMS\API\Controllers',
                'controller' => 'error',
                'action'     => 'error',
                'params'     => array('code' => $e->getCode(), 'message' => $e->getMessage())
            ));
        } catch (\API2CMS\Connector\Exception $e) {
            $dispatcher->forward(array(
                'namespace'  => 'API2CMS\API\Controllers',
                'controller' => 'Error',
                'action'     => 'error',
                'params'     => array('code' => $e->getCode(), 'message' => $e->getMessage())
            ));
        } catch (\Exception $e) {
            $dispatcher->forward(array(
                'namespace'  => 'API2CMS\API\Controllers',
                'controller' => 'Error',
                'action'     => 'error',
                'params'     => array('code' => 500, 'message' => 'Internal Service Error')
            ));
        }
    }

    private function _apiAuth($apiKey, $token)
    {
        $this->auth->apiCheck($apiKey, $token);
    }

    private function _init($apiKey, $token)
    {
        $account = Accounts::findFirst("apiKey='$apiKey'");

        $accountInstance = Account::getInstance();
        $accountInstance->init($account);

        $site = Sites::findFirst("siteKey='$token'");

        $siteInstance = Site::getInstance();

        $siteInstance->init($site);
        $siteInstance->check();
    }
}