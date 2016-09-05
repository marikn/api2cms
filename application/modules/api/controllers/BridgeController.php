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

        $bridge  = new Bridge();

        $content = $bridge->download($token);

        $this->response->setHeader('Content-Disposition', 'attachment; filename="cms_bridge.zip"');
        $this->response->setHeader('Content-Transfer-Encoding', 'binary');
        $this->response->setHeader('Pragma', 'public');

        $this->response->setContentType('application/zip');
        $this->response->setContent($content);
        $this->response->send();
    }
}