<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\API\Controllers;

use API2CMS\Bridge;

class BridgeController extends Controller
{
    public function createAction()
    {
        $token = $this->auth->generateToken();

        $this->_response->appendResult(array('token' => $token));
        $data = $this->_response->getData();

        $this->response->setJsonContent($data);
        $this->response->send();
    }

    public function downloadAction()
    {
        $token = $this->auth->getToken();

        $bridge = new Bridge();

        $bridge->download($token);

        $this->response->setJsonContent(array('response_code' => 0, 'response_message' => 'It is method for get bridge'));
        $this->response->send();
    }
}