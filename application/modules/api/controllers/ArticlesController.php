<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\API\Controllers;

class ArticlesController extends AbstractController
{
    public function listAction()
    {
        $this->view->disable();

        $this->response->setJsonContent(array('response_code' => 0, 'response_message' => 'It is method for list articles'));
        $this->response->send();
    }

    public function infoAction()
    {
        $this->view->disable();

        $id = $this->dispatcher->getParam('id');

        $this->response->setJsonContent(array('response_code' => 0, 'response_message' => 'It is method for get info about article #' . $id));
        $this->response->send();
    }
}