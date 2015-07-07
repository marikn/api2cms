<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Api\Controllers;

class IndexController extends AbstractController
{
    public function apiAction()
    {
        $this->view->disable();

        $this->response->setJsonContent(array('response_code' => 101, 'response_message' => 'Unified CMS API'));
        $this->response->send();
    }
}