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
use API2CMS\Site;
use Phalcon\Mvc\Controller;

class AbstractController extends Controller
{
    public function initialize()
    {
        $apiKey     = $this->request->getHeader('HTTP_X_API_KEY');
        $token      = $this->request->getHeader('HTTP_X_TOKEN');

        $this->_apiAuth($apiKey, $token);
        $this->_init($apiKey, $token);

        $this->view->disable();

        $this->response->setContentType('application/json');
    }

    private function _apiAuth($apiKey, $token)
    {
        try {
            $this->auth->apiCheck($apiKey, $token);
        } catch (\API2CMS\Auth\Exception $e) {
            $this->dispatcher->forward(array(
                'module'     => 'api',
                'controller' => 'error',
                'action'     => 'show403'
            ));
        }
    }
    private function _init($apiKey, $token)
    {
        $account = Accounts::findFirst("apiKey='$apiKey'");

        $accountInstance = Account::getInstance();
        $accountInstance->init($account);

        $site = $account->getSites("siteKey='$token'")->toArray();
        $site = array_shift($site);

        $siteInstance = Site::getInstance();
        $siteInstance->init($site);

        $connector = Connector::getInstance();
        $connector->uri = $site['siteUrl'] . 'cms_bridge/bridge.php';

        $connector->check();
    }
}