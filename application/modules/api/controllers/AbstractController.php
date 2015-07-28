<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Api\Controllers;

use API2CMS\Account;
use API2CMS\Connector;
use API2CMS\Models\Accounts;
use API2CMS\Models\Sites;
use API2CMS\Site;
use Phalcon\Mvc\Controller;

class AbstractController extends Controller
{
    public function beforeExecuteRoute($dispatcher)
    {
        $this->view->disable();
        $this->response->setContentType('application/json');

        $apiKey = $this->request->getHeader('HTTP_X_API_KEY');
        $token  = $this->request->getHeader('HTTP_X_TOKEN');

        try {
            $this->_apiAuth($apiKey, $token);
            $this->_init($apiKey, $token);
        } catch (\API2CMS\Auth\Exception $e) {
            return $dispatcher->forward(array(
                'namespace'  => 'API2CMS\Api\Controllers',
                'controller' => 'error',
                'action'     => 'error',
                'params'     => array('code' => $e->getCode(), 'message' => $e->getMessage())
            ));
        } catch (\API2CMS\Connector\Exception $e) {
            return $dispatcher->forward(array(
                'namespace'  => 'API2CMS\Api\Controllers',
                'controller' => 'error',
                'action'     => 'error',
                'params'     => array('code' => $e->getCode(), 'message' => $e->getMessage())
            ));
        } catch (\Exception $e) {
            return $dispatcher->forward(array(
                'namespace'  => 'API2CMS\Api\Controllers',
                'controller' => 'error',
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