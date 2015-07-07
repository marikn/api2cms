<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Api\Controllers;

class ErrorController extends AbstractController
{
    public function show404Action()
    {
        $this->response->setJsonContent(array('response_code' => 1, 'response_message' => 'API method not found'));
        $this->response->setStatusCode(404);

        $this->response->send();
    }

    public function show403Action()
    {
        $this->response->setJsonContent(array('response_code' => 2, 'response_message' => 'Incorrect API credentials'));
        $this->response->setStatusCode(403);

        $this->response->send();
    }
}