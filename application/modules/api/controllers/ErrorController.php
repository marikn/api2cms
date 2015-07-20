<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Api\Controllers;

use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    public function errorAction()
    {
        $params = $this->dispatcher->getParams();

        if (!isset($params['code']) || !isset($params['message'])) {
            return $this->dispatcher->forward(array(
                'action' => 'internal',
            ));
        }

        $this->response->setJsonContent(array('response_code' => 0, 'response_message' => $params['message']));
        $this->response->setStatusCode($params['code']);

        $this->response->send();
    }

    public function internalAction()
    {
        $this->response->setJsonContent(array('response_code' => 0, 'response_message' => 'Internal service error'));
        $this->response->setStatusCode(500);

        $this->response->send();
    }
}